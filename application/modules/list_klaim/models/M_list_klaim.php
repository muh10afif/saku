<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class M_list_klaim extends CI_Model {

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

    // 24-08-2021
    // Menampilkan list list_klaim
    public function get_data_list_klaim()
    {
        $this->_get_datatables_query_list_klaim();

        if ($this->input->post('length') != -1) {
            $this->db->limit($this->input->post('length'), $this->input->post('start'));
            
            return $this->db->get()->result_array();
        }
    }

    var $kolom_order_list_klaim = [null, 'LOWER(t.no_polis)', 'LOWER(n.nama)', 'LOWER(f.manfaat)','LOWER(k.nama_pemohon)', 'LOWER(k.alamat_pemohon)','CAST(k.status_klaim as VARCHAR)', 'CAST(k.add_time as VARCHAR)'];
    var $kolom_cari_list_klaim  = ['LOWER(t.no_polis)', 'LOWER(n.nama)', 'LOWER(f.manfaat)','LOWER(k.nama_pemohon)', 'LOWER(k.alamat_pemohon)', 'CAST(k.status_klaim as VARCHAR)', 'CAST(k.add_time as VARCHAR)'];
    var $order_list_klaim       = ['k.id_data_klaim' => 'desc'];

    public function _get_datatables_query_list_klaim()
    {
        $sts_klaim = $this->input->post('status_klaim');
        
        $this->db->select('t.id_sppa_quotation as id, p.premi, n.nama, s.nama_asuransi, l.lob, t.add_time, t.status_polis, k.*, k.add_time as tgl_klaim, f.manfaat, t.no_polis, pk.tgl_bayar, pk.nilai_bayar, pk.no_rekening, pk.nama_pemilik_rekening, b.nama_bank, f.nilai');
        $this->db->from('tr_sppa_quotation as t');
        $this->db->join('pengguna_tertanggung as n', 'n.id_pengguna_tertanggung = t.id_pengguna_tertanggung', 'inner');
        $this->db->join('tr_produk_asuransi as p', 'p.id_tr_produk_asuransi = t.id_produk_asuransi', 'inner');
        $this->db->join('m_asuransi as s', 's.id_asuransi = p.id_asuransi', 'inner');
        $this->db->join('m_lob as l', 'l.id_lob = p.id_lob', 'inner');
        $this->db->join('tr_data_klaim as k', 'k.id_tr_sppa_quotation = t.id_sppa_quotation', 'inner');
        $this->db->join('m_manfaat as f', 'f.id = k.id_manfaat', 'inner');
        $this->db->join('tr_pembayaran_klaim as pk', 'pk.id_data_klaim = k.id_data_klaim', 'inner');
        $this->db->join('m_bank as b', 'b.id_bank = pk.bank', 'inner');
        $this->db->where('k.status_klaim', $sts_klaim);
        
        $b = 0;
        
        $input_cari = strtolower($_POST['search']['value']);
        $kolom_cari = $this->kolom_cari_list_klaim;

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

            $kolom_order = $this->kolom_order_list_klaim;
            $this->db->order_by($kolom_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
            
        } elseif (isset($this->order_list_klaim)) {
            
            $order = $this->order_list_klaim;
            $this->db->order_by(key($order), $order[key($order)]);
            
        }
        
    }

    public function jumlah_semua_list_klaim()
    {
        $sts_klaim = $this->input->post('status_klaim');
        
        $this->db->select('t.id_sppa_quotation as id, p.premi, n.nama, s.nama_asuransi, l.lob, t.add_time, t.status_polis, k.*, k.add_time as tgl_klaim, f.manfaat, t.no_polis, pk.tgl_bayar, pk.nilai_bayar, pk.no_rekening, pk.nama_pemilik_rekening, b.nama_bank, f.nilai');
        $this->db->from('tr_sppa_quotation as t');
        $this->db->join('pengguna_tertanggung as n', 'n.id_pengguna_tertanggung = t.id_pengguna_tertanggung', 'inner');
        $this->db->join('tr_produk_asuransi as p', 'p.id_tr_produk_asuransi = t.id_produk_asuransi', 'inner');
        $this->db->join('m_asuransi as s', 's.id_asuransi = p.id_asuransi', 'inner');
        $this->db->join('m_lob as l', 'l.id_lob = p.id_lob', 'inner');
        $this->db->join('tr_data_klaim as k', 'k.id_tr_sppa_quotation = t.id_sppa_quotation', 'inner');
        $this->db->join('m_manfaat as f', 'f.id = k.id_manfaat', 'inner');
        $this->db->join('tr_pembayaran_klaim as pk', 'pk.id_data_klaim = k.id_data_klaim', 'inner');
        $this->db->join('m_bank as b', 'b.id_bank = pk.bank', 'inner');
        $this->db->where('k.status_klaim', $sts_klaim);

        return $this->db->count_all_results();
    }

    public function jumlah_filter_list_klaim()
    {
        $this->_get_datatables_query_list_klaim();

        return $this->db->get()->num_rows();
        
    }

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
        $this->db->select('t.id_sppa_quotation as id, p.premi, n.nama, s.nama_asuransi, l.lob, t.*, pa.nama as nama_metode, m.no_transaksi, m.bayar, m.status_bayar, k.*, k.add_by as id_nasabah_klaim, k.add_time as tgl_klaim, f.manfaat, t.no_polis, pk.tgl_bayar, pk.nilai_bayar, pk.no_rekening, pk.nama_pemilik_rekening, b.nama_bank, k.add_by as id_pengguna_tertanggung_klaim');
        $this->db->from('tr_sppa_quotation as t');
        $this->db->join('pengguna_tertanggung as n', 'n.id_pengguna_tertanggung = t.id_pengguna_tertanggung', 'inner');
        $this->db->join('tr_produk_asuransi as p', 'p.id_tr_produk_asuransi = t.id_produk_asuransi', 'inner');
        $this->db->join('m_asuransi as s', 's.id_asuransi = p.id_asuransi', 'inner');
        $this->db->join('m_lob as l', 'l.id_lob = p.id_lob', 'inner');
        $this->db->join('tr_pembayaran_polis as m', 'm.id_sppa_quotation = t.id_sppa_quotation', 'left');
        $this->db->join('m_payment_method as pa', 'pa.id = m.id_payment_method', 'left');
        $this->db->join('tr_data_klaim as k', 'k.id_tr_sppa_quotation = t.id_sppa_quotation', 'inner');
        $this->db->join('m_manfaat as f', 'f.id = k.id_manfaat', 'inner');
        $this->db->join('tr_pembayaran_klaim as pk', 'pk.id_data_klaim = k.id_data_klaim', 'inner');
        $this->db->join('m_bank as b', 'b.id_bank = pk.bank', 'inner');
        
        $this->db->where('t.id_sppa_quotation', $id_sppa);
        
        return $this->db->get();        
    }

    // 13-09-2021
    public function cari_dok_klaim($id_data_klaim)
    {
        $this->db->select('t.*, d.dokumen');
        $this->db->from('tr_dokumen_klaim as t');
        $this->db->join('m_dokumen_klaim as d', 'd.id = t.id_dokumen_klaim', 'inner');
        $this->db->where('t.id_data_klaim', $id_data_klaim);
        $this->db->where('t.nama_file !=', null);
        $this->db->where('t.status', 1);
        
        return $this->db->get();
    }

}

/* End of file M_list_klaim.php */
