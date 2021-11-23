<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class M_polis_saku extends CI_Model {

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
    // Menampilkan list polis_saku
    public function get_data_polis_saku()
    {
        $this->_get_datatables_query_polis_saku();

        if ($this->input->post('length') != -1) {
            $this->db->limit($this->input->post('length'), $this->input->post('start'));
            
            return $this->db->get()->result_array();
        }
    }

    var $kolom_order_polis_saku = [null, 'LOWER(t.no_polis)', 'LOWER(n.nama)', 'CAST(t.tgl_awal_polis as VARCHAR)','CAST(t.tgl_akhir_polis as VARCHAR)','LOWER(s.nama_asuransi)', 'CAST(p.premi as VARCHAR)', 'CAST(pa.nama as VARCHAR)'];
    var $kolom_cari_polis_saku  = ['LOWER(t.no_polis)', 'LOWER(n.nama)', 'CAST(t.tgl_awal_polis as VARCHAR)','CAST(t.tgl_akhir_polis as VARCHAR)','LOWER(s.nama_asuransi)', 'CAST(p.premi as VARCHAR)', 'CAST(pa.nama as VARCHAR)'];
    var $order_polis_saku       = ['t.id_sppa_quotation' => 'desc'];

    public function _get_datatables_query_polis_saku()
    {
        $st_polis = $this->input->post('status_polis');
        
        $this->db->select('t.id_sppa_quotation as id, p.premi, n.nama, s.nama_asuransi, l.lob, t.*, pa.nama as nama_metode, m.no_transaksi, m.bayar, m.status_bayar');
        $this->db->from('tr_sppa_quotation as t');
        $this->db->join('pengguna_tertanggung as n', 'n.id_pengguna_tertanggung = t.id_pengguna_tertanggung', 'inner');
        $this->db->join('tr_produk_asuransi as p', 'p.id_tr_produk_asuransi = t.id_produk_asuransi', 'inner');
        $this->db->join('m_asuransi as s', 's.id_asuransi = p.id_asuransi', 'inner');
        $this->db->join('m_lob as l', 'l.id_lob = p.id_lob', 'inner');
        $this->db->join('tr_pembayaran_polis as m', 'm.id_sppa_quotation = t.id_sppa_quotation', 'left');
        $this->db->join('m_payment_method as pa', 'pa.id = m.id_payment_method', 'left');
        $this->db->where('t.status_polis', $st_polis);
        
        $b = 0;
        
        $input_cari = strtolower($_POST['search']['value']);
        $kolom_cari = $this->kolom_cari_polis_saku;

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

            $kolom_order = $this->kolom_order_polis_saku;
            $this->db->order_by($kolom_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
            
        } elseif (isset($this->order_polis_saku)) {
            
            $order = $this->order_polis_saku;
            $this->db->order_by(key($order), $order[key($order)]);
            
        }
        
    }

    public function jumlah_semua_polis_saku()
    {
        $st_polis = $this->input->post('status_polis');
        
        $this->db->select('t.id_sppa_quotation as id, p.premi, n.nama, s.nama_asuransi, l.lob, t.*, pa.nama as nama_metode, m.no_transaksi, m.bayar, m.status_bayar');
        $this->db->from('tr_sppa_quotation as t');
        $this->db->join('pengguna_tertanggung as n', 'n.id_pengguna_tertanggung = t.id_pengguna_tertanggung', 'inner');
        $this->db->join('tr_produk_asuransi as p', 'p.id_tr_produk_asuransi = t.id_produk_asuransi', 'inner');
        $this->db->join('m_asuransi as s', 's.id_asuransi = p.id_asuransi', 'inner');
        $this->db->join('m_lob as l', 'l.id_lob = p.id_lob', 'inner');
        $this->db->join('tr_pembayaran_polis as m', 'm.id_sppa_quotation = t.id_sppa_quotation', 'left');
        $this->db->join('m_payment_method as pa', 'pa.id = m.id_payment_method', 'left');
        $this->db->where('t.status_polis', $st_polis);
        

        return $this->db->count_all_results();
    }

    public function jumlah_filter_polis_saku()
    {
        $this->_get_datatables_query_polis_saku();

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
        $this->db->select('t.id_sppa_quotation as id, p.premi, n.nama, s.nama_asuransi, l.lob, t.*, pa.nama as nama_metode, m.no_transaksi, m.bayar, m.status_bayar');
        $this->db->from('tr_sppa_quotation as t');
        $this->db->join('pengguna_tertanggung as n', 'n.id_pengguna_tertanggung = t.id_pengguna_tertanggung', 'inner');
        $this->db->join('tr_produk_asuransi as p', 'p.id_tr_produk_asuransi = t.id_produk_asuransi', 'inner');
        $this->db->join('m_asuransi as s', 's.id_asuransi = p.id_asuransi', 'inner');
        $this->db->join('m_lob as l', 'l.id_lob = p.id_lob', 'inner');
        $this->db->join('tr_pembayaran_polis as m', 'm.id_sppa_quotation = t.id_sppa_quotation', 'left');
        $this->db->join('m_payment_method as pa', 'pa.id = m.id_payment_method', 'left');
        
        $this->db->where('t.id_sppa_quotation', $id_sppa);
        
        return $this->db->get();        
    }

}

/* End of file M_polis_saku.php */
