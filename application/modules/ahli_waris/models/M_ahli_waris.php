<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class M_ahli_waris extends CI_Model {

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
    // Menampilkan list ahli_waris
    public function get_data_ahli_waris()
    {
        $this->_get_datatables_query_ahli_waris();

        if ($this->input->post('length') != -1) {
            $this->db->limit($this->input->post('length'), $this->input->post('start'));
            
            return $this->db->get()->result_array();
        }
    }

    var $kolom_order_ahli_waris = [null, 'LOWER(t.no_polis)', 'LOWER(n.nama)', 'n.nik','n.telp', 'CAST(t.status_polis as VARCHAR)'];
    var $kolom_cari_ahli_waris  = ['LOWER(t.no_polis)', 'LOWER(n.nama)', 'n.nik','n.telp','CAST(t.status_polis as VARCHAR)'];
    var $order_ahli_waris       = ['t.id_sppa_quotation' => 'desc'];

    public function _get_datatables_query_ahli_waris()
    { 
        $this->db->select('t.id_sppa_quotation as id, p.premi, n.nama, n.nik, n.telp, s.nama_asuransi, l.lob, t.*, pa.nama as nama_metode, m.no_transaksi, m.bayar, m.status_bayar');
        $this->db->from('tr_sppa_quotation as t');
        $this->db->join('pengguna_tertanggung as n', 'n.id_pengguna_tertanggung = t.id_pengguna_tertanggung', 'inner');
        $this->db->join('tr_produk_asuransi as p', 'p.id_tr_produk_asuransi = t.id_produk_asuransi', 'inner');
        $this->db->join('m_asuransi as s', 's.id_asuransi = p.id_asuransi', 'inner');
        $this->db->join('m_lob as l', 'l.id_lob = p.id_lob', 'inner');
        $this->db->join('tr_pembayaran_polis as m', 'm.id_sppa_quotation = t.id_sppa_quotation', 'left');
        $this->db->join('m_payment_method as pa', 'pa.id = m.id_payment_method', 'left');
        $this->db->where('t.status_polis !=', 0);

        $b = 0;
        
        $input_cari = strtolower($_POST['search']['value']);
        $kolom_cari = $this->kolom_cari_ahli_waris;

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

            $kolom_order = $this->kolom_order_ahli_waris;
            $this->db->order_by($kolom_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
            
        } elseif (isset($this->order_ahli_waris)) {
            
            $order = $this->order_ahli_waris;
            $this->db->order_by(key($order), $order[key($order)]);
            
        }
        
    }

    public function jumlah_semua_ahli_waris()
    {
        $this->db->select('t.id_sppa_quotation as id, p.premi, n.nama, n.nik, n.telp, s.nama_asuransi, l.lob, t.*, pa.nama as nama_metode, m.no_transaksi, m.bayar, m.status_bayar');
        $this->db->from('tr_sppa_quotation as t');
        $this->db->join('pengguna_tertanggung as n', 'n.id_pengguna_tertanggung = t.id_pengguna_tertanggung', 'inner');
        $this->db->join('tr_produk_asuransi as p', 'p.id_tr_produk_asuransi = t.id_produk_asuransi', 'inner');
        $this->db->join('m_asuransi as s', 's.id_asuransi = p.id_asuransi', 'inner');
        $this->db->join('m_lob as l', 'l.id_lob = p.id_lob', 'inner');
        $this->db->join('tr_pembayaran_polis as m', 'm.id_sppa_quotation = t.id_sppa_quotation', 'left');
        $this->db->join('m_payment_method as pa', 'pa.id = m.id_payment_method', 'left');
        $this->db->where('t.status_polis !=', 0);

        return $this->db->count_all_results();
    }

    public function jumlah_filter_ahli_waris()
    {
        $this->_get_datatables_query_ahli_waris();

        return $this->db->get()->num_rows();
        
    }

    public function cari_ahli_waris($id_sppa)
    {
        $this->db->select('w.*, h.hubungan_klg');
        $this->db->from('m_ahli_waris as w');
        $this->db->join('m_hubungan_klg as h', 'h.id = w.hubungan', 'inner');
        $this->db->where('w.id_tr_sppa_quotation', $id_sppa);
        $this->db->order_by('w.id_ahli_waris', 'asc');
        
        return $this->db->get();
    }

    public function cari_ahli_waris_dari($nik)
    {
        $this->db->select('t.id_sppa_quotation as id, p.premi, n.nama, n.nik, n.telp, n.alamat, s.nama_asuransi, l.lob, t.*, pa.nama as nama_metode, m.no_transaksi, m.bayar, m.status_bayar');
        $this->db->from('tr_sppa_quotation as t');
        $this->db->join('pengguna_tertanggung as n', 'n.id_pengguna_tertanggung = t.id_pengguna_tertanggung', 'inner');
        $this->db->join('tr_produk_asuransi as p', 'p.id_tr_produk_asuransi = t.id_produk_asuransi', 'inner');
        $this->db->join('m_asuransi as s', 's.id_asuransi = p.id_asuransi', 'inner');
        $this->db->join('m_lob as l', 'l.id_lob = p.id_lob', 'inner');
        $this->db->join('tr_pembayaran_polis as m', 'm.id_sppa_quotation = t.id_sppa_quotation', 'left');
        $this->db->join('m_payment_method as pa', 'pa.id = m.id_payment_method', 'left');
        $this->db->join('m_ahli_waris as w', 'w.id_tr_sppa_quotation = t.id_sppa_quotation', 'inner');
        $this->db->where('w.nik', $nik);
        $this->db->where('t.status_polis !=', 0);
        
        return $this->db->get();        
    }
    public function cari_sppa($id_sppa)
    {
        $this->db->select('t.id_sppa_quotation as id, p.premi, n.nama, n.nik, s.nama_asuransi, l.lob, t.*, pa.nama as nama_metode, m.no_transaksi, m.bayar, m.status_bayar');
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

/* End of file M_ahli_waris.php */
