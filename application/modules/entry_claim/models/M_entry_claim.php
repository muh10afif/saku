<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class M_entry_claim extends CI_Model {

    public function cari_data($tabel, $where)
    {
        return $this->db->get_where($tabel, $where);
    }

    public function cari_data_order($tabel, $where, $field, $order)
    {
        $this->db->order_by($field, $order);

        return $this->db->get_where($tabel, $where);
    }

    public function get_data_order($tabel, $field, $order)
    {
        $this->db->order_by($field, $order);
        
        return $this->db->get($tabel);
    }

    public function get_data($tabel)
    {
        return $this->db->get($tabel);
    }

    public function input_data($tabel, $data)
    {
        $this->db->insert($tabel, $data);
    }

    public function ubah_data($tabel, $data, $where)
    {
        return $this->db->update($tabel, $data, $where);
    }

    public function hapus_data($tabel, $where)
    {
        $this->db->delete($tabel, $where);
    }
    
    // 22-09-2021
    public function get_data_claim()
    {
        $this->_get_datatables_query_claim();

        if ($this->input->post('length') != -1) {
            $this->db->limit($this->input->post('length'), $this->input->post('start'));
            
            return $this->db->get()->result_array();
        }
    }

    var $kolom_order_claim = [null, 'CAST(tdk.add_time as VARCHAR)', 'LOWER(tsq.no_polis)', 'LOWER(tdk.klaim_nomor_dok)', 'LOWER(m.manfaat)', 'CAST(tdk.status_klaim as VARCHAR)'];
    var $kolom_cari_claim  = ['CAST(tdk.add_time as VARCHAR)', 'LOWER(tsq.no_polis)', 'LOWER(tdk.klaim_nomor_dok)', 'LOWER(m.manfaat)', 'CAST(tdk.status_klaim as VARCHAR)'];
    var $order_claim       = ['tdk.id_data_klaim' => 'desc'];

    public function _get_datatables_query_claim()
    {
        $cr = $this->db->get_where('m_user', ['id_user' => $this->input->post('id_user')])->row_array();

        $this->db->select('tdk.id_data_klaim, tdk.add_time as claim_date, tsq.no_polis, m.manfaat, tdk.klaim_nomor_dok, tdk.status_klaim, tdk.ttd, pt.nama, tdk.alasan_tolak, m.nilai');
        $this->db->from('tr_data_klaim tdk');
        $this->db->join('tr_sppa_quotation tsq', 'tsq.id_sppa_quotation = tdk.id_tr_sppa_quotation', 'inner');
        $this->db->join('pengguna_tertanggung pt', 'pt.id_pengguna_tertanggung = tsq.id_pengguna_tertanggung', 'inner');
        $this->db->join('m_manfaat m', 'm.id = tdk.id_manfaat', 'inner');
        $this->db->where('tdk.status_aktif', 1);
        $this->db->where('tdk.status_klaim', $this->input->post('status_klaim'));
        
        // if ($this->input->post('id_lvl_otorisasi') != 0) {
            
        //     if ($cr['id_level_user'] != 0) {

        //         $this->db->where('t.add_by', $this->input->post('id_user'));
                
        //     }   
        // } 
        
        $b = 0;
        
        $input_cari = strtolower($_POST['search']['value']);
        $kolom_cari = $this->kolom_cari_claim;

        foreach ($kolom_cari as $cari) {
            if ($input_cari) {
                if ($b === 0) {
                    $this->db->group_start();
                    $this->db->like($cari, $input_cari);
                } else {
                    $this->db->or_like($cari, $input_cari);
                }

                if ((count($kolom_cari) - 1) == $b ) {
                    $this->db->group_end();
                }
            }

            $b++;
        }

        if (isset($_POST['order'])) {

            $kolom_order = $this->kolom_order_claim;
            $this->db->order_by($kolom_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
            
        } elseif (isset($this->order_claim)) {
            
            $order = $this->order_claim;
            $this->db->order_by(key($order), $order[key($order)]);
            
        }
        
    }

    public function jumlah_semua_claim()
    {
        $cr = $this->db->get_where('m_user', ['id_user' => $this->input->post('id_user')])->row_array();

        $this->db->select('tdk.id_data_klaim, tdk.add_time as claim_date, tsq.no_polis, m.manfaat, tdk.klaim_nomor_dok, tdk.status_klaim, tdk.ttd, pt.nama, tdk.alasan_tolak, m.nilai');
        $this->db->from('tr_data_klaim tdk');
        $this->db->join('tr_sppa_quotation tsq', 'tsq.id_sppa_quotation = tdk.id_tr_sppa_quotation', 'inner');
        $this->db->join('pengguna_tertanggung pt', 'pt.id_pengguna_tertanggung = tsq.id_pengguna_tertanggung', 'inner');
        $this->db->join('m_manfaat m', 'm.id = tdk.id_manfaat', 'inner');
        $this->db->where('tdk.status_aktif', 1);
        $this->db->where('tdk.status_klaim', $this->input->post('status_klaim'));

        // if ($this->input->post('id_lvl_otorisasi') != 0) {
            
        //     if ($cr['id_level_user'] != 0) {

        //         $this->db->where('t.add_by', $this->input->post('id_user'));
                
        //     }   
        // }
        
        return $this->db->count_all_results();
    }

    public function jumlah_filter_claim()
    {
        $this->_get_datatables_query_claim();

        return $this->db->get()->num_rows();
        
    }

    // 28-09-2021
    public function list_polis()
    {
        $this->db->select('id_tr_sppa_quotation');
        $this->db->from('tr_data_klaim');
        $this->db->group_by('id_tr_sppa_quotation');
        $sppa = $this->db->get()->result_array();

        foreach ($sppa as $s) {
            $list[] = $s['id_tr_sppa_quotation'];
        }
        
        $this->db->select('no_polis, id_sppa_quotation');
        $this->db->from('tr_sppa_quotation');
        $this->db->where('status_polis', 1);
        if (!empty($list)) {
            $this->db->where_not_in('id_sppa_quotation', $list);
        }
        $this->db->order_by('no_polis', 'asc');
        
        return $this->db->get();
        
    }

    public function cari_detail_polis($id_sppa)
    {
        $this->db->select('tsq.id_sppa_quotation, tsq.id_pengguna_tertanggung, m.nama_asuransi, l.kode_lob, l.lob, c.kode_cob, c.cob, tsq.id_produk_asuransi, pt.nama, tpa.premi, tsq.tgl_awal_polis, tsq.tgl_akhir_polis, tsq.no_polis');
        $this->db->from('tr_sppa_quotation tsq');
        $this->db->join('pengguna_tertanggung pt', 'pt.id_pengguna_tertanggung = tsq.id_pengguna_tertanggung', 'inner');
        $this->db->join('tr_produk_asuransi tpa', 'tpa.id_tr_produk_asuransi = tsq.id_produk_asuransi', 'inner');
        $this->db->join('m_asuransi m', 'm.id_asuransi = tpa.id_asuransi', 'inner');
        $this->db->join('m_lob l', 'l.id_lob = tpa.id_lob', 'inner');
        $this->db->join('relasi_cob_lob rcl', 'rcl.id_lob = l.id_lob', 'inner');
        $this->db->join('m_cob c', 'c.id_cob = rcl.id_cob', 'inner');
        $this->db->where('tsq.id_sppa_quotation', $id_sppa);
        
        return $this->db->get();
    }

    // 29-09-2021
    public function get_detail_pengguna($id_pengguna_ptg)
    {
        $this->db->select('pt.nama, pt.tgl_lahir, pt.tempat_lahir, pt.email, pt.nik, pt.telp, pt.jenis_kelamin, pt.alamat, mp.pekerjaan');
        $this->db->from('pengguna_tertanggung pt');
        $this->db->join('m_pekerjaan mp', 'mp.id_pekerjaan = pt.id_pekerjaan', 'inner');
        $this->db->where('pt.id_pengguna_tertanggung', $id_pengguna_ptg); 
        
        return $this->db->get();        
    }

    // 14-10-2021
    public function cari_ahli_waris($id_sppa)
    {
        $this->db->select('w.*, h.hubungan_klg');
        $this->db->from('m_ahli_waris as w');
        $this->db->join('m_hubungan_klg as h', 'h.id = w.hubungan', 'inner');
        $this->db->where('w.id_tr_sppa_quotation', $id_sppa);
        
        return $this->db->get();
    }

    public function cari_sppa($id_sppa)
    {
        $this->db->select('t.id_sppa_quotation as id, p.premi, n.nama, s.nama_asuransi, l.kode_lob, l.lob, c.kode_cob, c.cob, t.*, pa.nama as nama_metode, m.no_transaksi, m.bayar, m.status_bayar, k.*, k.add_by as id_nasabah_klaim, k.add_time as tgl_klaim, f.id as id_manfaat, f.manfaat, t.no_polis, pk.tgl_bayar, pk.nilai_bayar, pk.no_rekening, pk.nama_pemilik_rekening, b.nama_bank, b.id_bank, k.add_by as id_pengguna_tertanggung_klaim');
        $this->db->from('tr_sppa_quotation as t');
        $this->db->join('pengguna_tertanggung as n', 'n.id_pengguna_tertanggung = t.id_pengguna_tertanggung', 'inner');
        $this->db->join('tr_produk_asuransi as p', 'p.id_tr_produk_asuransi = t.id_produk_asuransi', 'inner');
        $this->db->join('m_asuransi as s', 's.id_asuransi = p.id_asuransi', 'inner');
        $this->db->join('m_lob as l', 'l.id_lob = p.id_lob', 'inner');
        $this->db->join('relasi_cob_lob rcl', 'rcl.id_lob = l.id_lob', 'inner');
        $this->db->join('m_cob c', 'c.id_cob = rcl.id_cob', 'inner');
        $this->db->join('tr_pembayaran_polis as m', 'm.id_sppa_quotation = t.id_sppa_quotation', 'left');
        $this->db->join('m_payment_method as pa', 'pa.id = m.id_payment_method', 'left');
        $this->db->join('tr_data_klaim as k', 'k.id_tr_sppa_quotation = t.id_sppa_quotation', 'inner');
        $this->db->join('m_manfaat as f', 'f.id = k.id_manfaat', 'inner');
        $this->db->join('tr_pembayaran_klaim as pk', 'pk.id_data_klaim = k.id_data_klaim', 'inner');
        $this->db->join('m_bank as b', 'b.id_bank = pk.bank', 'inner');
        
        $this->db->where('t.id_sppa_quotation', $id_sppa);
        $this->db->where('k.status_aktif', 1);
        
        return $this->db->get();        
    }

    public function cari_dok_klaim($id_data_klaim)
    {
        $this->db->select('t.*, d.dokumen');
        $this->db->from('tr_dokumen_klaim as t');
        $this->db->join('m_dokumen_klaim as d', 'd.id = t.id_dokumen_klaim', 'inner');
        $this->db->where('t.id_data_klaim', $id_data_klaim);
        $this->db->where('t.nama_file !=', null);
        $this->db->where('t.status', 1);
        $this->db->order_by('t.id_dokumen_klaim', 'asc');
        
        return $this->db->get();
    }

}

/* End of file M_entry_claim.php */
