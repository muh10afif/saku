<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class M_approval extends CI_Model {

    public function __construct() {
        parent::__construct();
        
        $this->id_lvl_otorisasi = $this->session->userdata('id_level_otorisasi');
        $this->id_user          = $this->session->userdata('sesi_id');

    }
    
    // 16-05-2021
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

    // 05-08-2021
    public function cari_data_sppa($id_user)
    {
        // 'tr_sppa_quotation', ['approval' => false, 'sppa_number !=' => null], 'sppa_number', 'asc'

        $cr = $this->db->get_where('m_user', ['id_user' => $id_user])->row_array();

        $this->db->select('t.*');
        $this->db->from('tr_sppa_quotation as t');
        
        $this->db->where('t.approval', false);
        $this->db->where('t.sppa_number !=', null);

        if ($this->id_lvl_otorisasi != 0) {
            
            
            if ($cr['id_level_user'] != 0) {

                $this->db->where('t.add_by', $id_user);
                
            }   
        }

        $this->db->order_by('t.sppa_number', 'asc');

        return $this->db->get();
    }

    // 16-05-2021
    public function get_data_approval()
    {
        $this->_get_datatables_query_approval();

        if ($this->input->post('length') != -1) {
            $this->db->limit($this->input->post('length'), $this->input->post('start'));
            
            return $this->db->get()->result_array();
        }
    }

    var $kolom_order_approval = [null, 'LOWER(tsq.no_polis)', 'LOWER(ma.nama_asuransi)', 'LOWER(ml.lob)', 'LOWER(s.nama_nasabah)', 'LOWER(mn.nama)'];
    var $kolom_cari_approval  = ['LOWER(tsq.no_polis)', 'LOWER(ma.nama_asuransi)', 'LOWER(ml.lob)', 'LOWER(s.nama_nasabah)', 'LOWER(mn.nama)'];
    var $order_approval       = ['tsq.id_sppa_quotation' => 'desc'];

    public function _get_datatables_query_approval()
    {
        // $cr = $this->db->get_where('m_user', ['id_user' => $this->input->post('id_user')])->row_array();

        // $this->db->select('t.id_sppa_quotation as id, t.sppa_number, c.cob, l.lob, a.nama_asuransi, h.id_sob, s.sob, h.nama_sob, t.approval, t.id_mop');
        // $this->db->from('tr_sppa_quotation as t');
        // $this->db->join('m_cob as c', 'c.id_cob = t.id_cob', 'inner');
        // $this->db->join('m_lob as l', 'l.id_lob = t.id_lob', 'inner');
        // $this->db->join('tr_approve_sppa as p', 'id_sppa_quotation', 'inner');
        // $this->db->join('m_asuransi as a', 'id_asuransi', 'inner');
        // $this->db->join('tr_histori_status_sob as h', 'h.id_sppa_quotation = t.id_sppa_quotation', 'inner');
        // $this->db->join('m_sob as s', 's.id_sob = h.id_sob', 'left');
        
        // $this->db->where('t.approval', true);
        // $this->db->where('t.status_aktif', true);

        // if ($this->input->post('id_lvl_otorisasi') != 0) {
            
            
        //     if ($cr['id_level_user'] != 0) {

        //         $this->db->where('t.add_by', $this->input->post('id_user'));
                
        //     }   
        // }

        $this->db->select('tsq.id_sppa_quotation, tsq.no_polis, mn.nama as pengguna_tertanggung, s.nama_nasabah as tertanggung, ma.nama_asuransi, ml.lob, tsq.total_akhir_premi, tsq.total_tagihan');
        $this->db->from('tr_sppa_quotation tsq');
        $this->db->join('tr_approve_sppa ts', 'ts.id_sppa_quotation = tsq.id_sppa_quotation', 'inner');
        $this->db->join('pengguna_tertanggung mn', 'mn.id_pengguna_tertanggung = tsq.id_pengguna_tertanggung', 'INNER');
        $this->db->join('mop m', 'm.id_mop = tsq.id_mop', 'INNER');
        $this->db->join('m_nasabah s', 's.id_nasabah = m.id_insured', 'INNER');
        $this->db->join('tr_produk_asuransi tpa', 'tpa.id_tr_produk_asuransi = tsq.id_produk_asuransi', 'INNER');
        $this->db->join('m_lob ml', 'ml.id_lob = tpa.id_lob', 'INNER');
        $this->db->join('m_asuransi ma', 'ma.id_asuransi = tpa.id_asuransi', 'inner');
        
        $b = 0;
        
        $input_cari = strtolower($_POST['search']['value']);
        $kolom_cari = $this->kolom_cari_approval;

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

            $kolom_order = $this->kolom_order_approval;
            $this->db->order_by($kolom_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
            
        } elseif (isset($this->order_approval)) {
            
            $order = $this->order_approval;
            $this->db->order_by(key($order), $order[key($order)]);
            
        }
        
    }

    public function jumlah_semua_approval()
    {
        $this->db->select('tsq.id_sppa_quotation, tsq.no_polis, mn.nama as pengguna_tertanggung, s.nama_nasabah as tertanggung, ma.nama_asuransi, ml.lob, tsq.total_akhir_premi, tsq.total_tagihan');
        $this->db->from('tr_sppa_quotation tsq');
        $this->db->join('tr_approve_sppa ts', 'ts.id_sppa_quotation = tsq.id_sppa_quotation', 'inner');
        $this->db->join('pengguna_tertanggung mn', 'mn.id_pengguna_tertanggung = tsq.id_pengguna_tertanggung', 'INNER');
        $this->db->join('mop m', 'm.id_mop = tsq.id_mop', 'INNER');
        $this->db->join('m_nasabah s', 's.id_nasabah = m.id_insured', 'INNER');
        $this->db->join('tr_produk_asuransi tpa', 'tpa.id_tr_produk_asuransi = tsq.id_produk_asuransi', 'INNER');
        $this->db->join('m_lob ml', 'ml.id_lob = tpa.id_lob', 'INNER');
        $this->db->join('m_asuransi ma', 'ma.id_asuransi = tpa.id_asuransi', 'inner');
        
        return $this->db->count_all_results();
    }

    public function jumlah_filter_approval()
    {
        $this->_get_datatables_query_approval();

        return $this->db->get()->num_rows();
        
    }

    // 16-05-2021
    public function get_approval()
    {
        $cr = $this->db->get_where('m_user', ['id_user' => $this->id_user])->row_array();
        
        $this->db->select('t.id_sppa_quotation as id, t.sppa_number, c.cob, l.lob');    
        $this->db->from('tr_sppa_quotation as t');
        $this->db->join('m_cob as c', 'id_cob', 'inner');
        $this->db->join('m_lob as l', 'id_lob', 'inner');
        $this->db->where('t.approval', false);
        $this->db->where('t.sppa_number !=', null);

        if ($this->id_lvl_otorisasi != 0) {
            
            
            if ($cr['id_level_user'] != 0) {

                $this->db->where('t.add_by', $this->id_user);
                
            }   
        }

        return $this->db->get();
        
    }

    // 19-05-2021
    public function data_approve($id_sppa)
    {
        $this->db->select('p.*, a.nama_asuransi, k.nama_karyawan');
        $this->db->from('tr_approve_sppa as p');
        $this->db->join('m_karyawan as k', 'k.id_karyawan = p.id_pegawai', 'inner');
        $this->db->join('m_asuransi as a', 'id_asuransi', 'inner');
        $this->db->where('p.id_sppa_quotation', $id_sppa);
        
        return $this->db->get();
    }

}

/* End of file M_approval.php */
