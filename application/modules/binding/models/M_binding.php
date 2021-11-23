<?php

use Svg\Tag\Group;

defined('BASEPATH') OR exit('No direct script access allowed');

class M_binding extends CI_Model {

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

    public function get_sppa_aktif($id_mop)
    {
        $this->db->select('t.id_sppa_quotation as id, t.sppa_number, p.no_otorisasi_polis, c.cob, l.lob, a.nama_asuransi, t.*, h.id_sob, s.sob, h.nama_sob, p.tgl_approve');
        $this->db->from('tr_sppa_quotation as t');
        $this->db->join('m_cob as c', 'id_cob', 'inner');
        $this->db->join('m_lob as l', 'id_lob', 'inner');
        $this->db->join('tr_approve_sppa as p', 'id_sppa_quotation', 'inner');
        $this->db->join('m_asuransi as a', 'id_asuransi', 'inner');
        $this->db->join('tr_histori_status_sob as h', 'h.id_sppa_quotation = t.id_sppa_quotation', 'inner');
        $this->db->join('m_sob as s', 's.id_sob = h.id_sob', 'left');
        
        $this->db->where('t.cancelation', false);
        $this->db->where('t.status_aktif', true);

        $this->db->where('t.id_mop', $id_mop);

        return $this->db->get();
        
    }

    // 16-05-2021
    public function get_data_binding()
    {
        $this->_get_datatables_query_binding();

        if ($this->input->post('length') != -1) {
            $this->db->limit($this->input->post('length'), $this->input->post('start'));
            
            return $this->db->get()->result_array();
        }
    }

    var $kolom_order_binding = [null, 't.sppa_number', 's.sob', 'c.cob',];
    var $kolom_cari_binding  = ['LOWER(t.sppa_number)', 'LOWER(s.sob)', 'LOWER(c.cob)', 'LOWER(l.lob)'];
    var $order_binding       = ['p.tgl_approve' => 'desc'];

    public function _get_datatables_query_binding()
    {
        $this->db->select('t.id_sppa_quotation as id, t.sppa_number, p.no_otorisasi_polis, c.cob, l.lob, a.nama_asuransi, t.*, h.id_sob, s.sob, h.nama_sob, p.tgl_approve');
        $this->db->from('tr_sppa_quotation as t');
        $this->db->join('m_cob as c', 'id_cob', 'inner');
        $this->db->join('m_lob as l', 'id_lob', 'inner');
        $this->db->join('tr_approve_sppa as p', 'id_sppa_quotation', 'inner');
        $this->db->join('m_asuransi as a', 'id_asuransi', 'inner');
        $this->db->join('tr_histori_status_sob as h', 'h.id_sppa_quotation = t.id_sppa_quotation', 'inner');
        $this->db->join('m_sob as s', 's.id_sob = h.id_sob', 'left');
        
        $this->db->where('t.approval', true);

        if ($this->input->post('id_mop') != '') {
            $this->db->where('t.id_mop', $this->input->post('id_mop'));
        } else {
            $this->db->where('t.id_mop', null);
        }
        
        $this->db->where('t.status_aktif', 't');

        if ($this->input->post('id_lvl_otorisasi') != 0) {
            
            $cr = $this->db->get_where('m_user', ['id_user' => $this->input->post('id_user')])->row_array();
            
            if ($cr['id_level_user'] != 0) {

                $this->db->where('t.add_by', $this->input->post('id_user'));
                
            }   
        }
        
        $b = 0;
        
        $input_cari = strtolower($_POST['search']['value']);
        $kolom_cari = $this->kolom_cari_binding;

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

            $kolom_order = $this->kolom_order_binding;
            $this->db->order_by($kolom_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
            
        } elseif (isset($this->order_binding)) {
            
            $order = $this->order_binding;
            $this->db->order_by(key($order), $order[key($order)]);
            
        }
        
    }

    public function jumlah_semua_binding()
    {
        $this->db->select('t.id_sppa_quotation as id, t.sppa_number, p.no_otorisasi_polis, c.cob, l.lob, a.nama_asuransi, t.*, h.id_sob, s.sob, h.nama_sob');
        $this->db->from('tr_sppa_quotation as t');
        $this->db->join('m_cob as c', 'id_cob', 'inner');
        $this->db->join('m_lob as l', 'id_lob', 'inner');
        $this->db->join('tr_approve_sppa as p', 'id_sppa_quotation', 'inner');
        $this->db->join('m_asuransi as a', 'id_asuransi', 'inner');
        $this->db->join('tr_histori_status_sob as h', 'h.id_sppa_quotation = t.id_sppa_quotation', 'inner');
        $this->db->join('m_sob as s', 's.id_sob = h.id_sob', 'left');

        $this->db->where('t.approval', true);

        if ($this->input->post('id_mop') != '') {
            $this->db->where('t.id_mop', $this->input->post('id_mop'));
        } else {
            $this->db->where('t.id_mop', null);
        }
        
        $this->db->where('t.status_aktif', 't');

        if ($this->input->post('id_lvl_otorisasi') != 0) {
            
            $cr = $this->db->get_where('m_user', ['id_user' => $this->input->post('id_user')])->row_array();
            
            if ($cr['id_level_user'] != 0) {

                $this->db->where('t.add_by', $this->input->post('id_user'));
                
            }   
        }
        
        return $this->db->count_all_results();
    }

    public function jumlah_filter_binding()
    {
        $this->_get_datatables_query_binding();

        return $this->db->get()->num_rows();
        
    }

    // 15-07-2021
    public function jumlah_aktif_sppa($id_mop, $nm_endors)
    {
        $this->db->select('t.id_sppa_quotation as id, t.sppa_number, p.no_otorisasi_polis, c.cob, l.lob, a.nama_asuransi, t.*, h.id_sob, s.sob, h.nama_sob');
        $this->db->from('tr_sppa_quotation as t');
        $this->db->join('m_cob as c', 'id_cob', 'inner');
        $this->db->join('m_lob as l', 'id_lob', 'inner');
        $this->db->join('tr_approve_sppa as p', 'id_sppa_quotation', 'inner');
        $this->db->join('m_asuransi as a', 'id_asuransi', 'inner');
        $this->db->join('tr_histori_status_sob as h', 'h.id_sppa_quotation = t.id_sppa_quotation', 'inner');
        $this->db->join('m_sob as s', 's.id_sob = h.id_sob', 'left');
        $this->db->join('tr_endorsment as e', 'e.id_endorsment = t.id_sppa_quotation', 'inner');
        
        $this->db->where('t.cancelation', false);
        $this->db->where('t.status_aktif', true);
        $this->db->where('e.id_mop', $id_mop);
        $this->db->where('e.nama_endorsment', $nm_endors);

        return $this->db->get();
    }

    // 12-07-2021
    public function get_data_binding_detail_dek()
    {
        $this->_get_datatables_query_binding_detail_dek();

        if ($this->input->post('length') != -1) {
            $this->db->limit($this->input->post('length'), $this->input->post('start'));
            
            return $this->db->get()->result_array();
        }
    }

    var $kolom_order_binding_detail_dek = [null, 't.sppa_number', 's.sob', 'c.cob',];
    var $kolom_cari_binding_detail_dek  = ['LOWER(t.sppa_number)', 'LOWER(s.sob)', 'LOWER(c.cob)', 'LOWER(l.lob)'];
    var $order_binding_detail_dek       = ['t.sppa_number' => 'desc'];

    public function _get_datatables_query_binding_detail_dek()
    {
        $this->db->select('t.id_sppa_quotation as id, t.sppa_number, p.no_otorisasi_polis, c.cob, l.lob, a.nama_asuransi, t.*, h.id_sob, s.sob, h.nama_sob');
        $this->db->from('tr_sppa_quotation as t');
        $this->db->join('m_cob as c', 'id_cob', 'inner');
        $this->db->join('m_lob as l', 'id_lob', 'inner');
        $this->db->join('tr_approve_sppa as p', 'id_sppa_quotation', 'inner');
        $this->db->join('m_asuransi as a', 'id_asuransi', 'inner');
        $this->db->join('tr_histori_status_sob as h', 'h.id_sppa_quotation = t.id_sppa_quotation', 'inner');
        $this->db->join('m_sob as s', 's.id_sob = h.id_sob', 'left');
        $this->db->join('tr_endorsment as e', 'e.id_endorsment = t.id_sppa_quotation', 'inner');
        
        // $this->db->where('t.approval', true);

        if ($this->input->post('id_mop') != '') {
            $this->db->where('e.id_mop', $this->input->post('id_mop'));
            $this->db->where('e.nama_endorsment', $this->input->post('nm_endors'));
        } else {
            $this->db->where('t.id_mop', null);
        }
        
        // $this->db->where('t.status_aktif', 't');

        if ($this->id_lvl_otorisasi != 0) {
            
            $cr = $this->db->get_where('m_user', ['id_user' => $this->id_user])->row_array();
            
            if ($cr['id_level_user'] != 0) {

                $this->db->where('t.add_by', $this->id_user);
                
            }   
        }
        
        $b = 0;
        
        $input_cari = strtolower($_POST['search']['value']);
        $kolom_cari = $this->kolom_cari_binding_detail_dek;

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

            $kolom_order = $this->kolom_order_binding_detail_dek;
            $this->db->order_by($kolom_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
            
        } elseif (isset($this->order_binding_detail_dek)) {
            
            $order = $this->order_binding_detail_dek;
            $this->db->order_by(key($order), $order[key($order)]);
            
        }
        
    }

    public function jumlah_semua_binding_detail_dek()
    {
        $this->db->select('t.id_sppa_quotation as id, t.sppa_number, p.no_otorisasi_polis, c.cob, l.lob, a.nama_asuransi, t.*, h.id_sob, s.sob, h.nama_sob');
        $this->db->from('tr_sppa_quotation as t');
        $this->db->join('m_cob as c', 'id_cob', 'inner');
        $this->db->join('m_lob as l', 'id_lob', 'inner');
        $this->db->join('tr_approve_sppa as p', 'id_sppa_quotation', 'inner');
        $this->db->join('m_asuransi as a', 'id_asuransi', 'inner');
        $this->db->join('tr_histori_status_sob as h', 'h.id_sppa_quotation = t.id_sppa_quotation', 'inner');
        $this->db->join('m_sob as s', 's.id_sob = h.id_sob', 'left');
        $this->db->join('tr_endorsment as e', 'e.id_endorsment = t.id_sppa_quotation', 'inner');
        
        // $this->db->where('t.approval', true);

        if ($this->input->post('id_mop') != '') {
            $this->db->where('e.id_mop', $this->input->post('id_mop'));
            $this->db->where('e.nama_endorsment', $this->input->post('nm_endors'));
        } else {
            $this->db->where('t.id_mop', null);
        }
        
        // $this->db->where('t.status_aktif', 't');

        if ($this->id_lvl_otorisasi != 0) {
            
            $cr = $this->db->get_where('m_user', ['id_user' => $this->id_user])->row_array();
            
            if ($cr['id_level_user'] != 0) {

                $this->db->where('t.add_by', $this->id_user);
                
            }   
        }
        
        return $this->db->count_all_results();
    }

    public function jumlah_filter_binding_detail_dek()
    {
        $this->_get_datatables_query_binding_detail_dek();

        return $this->db->get()->num_rows();
        
    }

    // 09-07-2021
    public function get_data_list_endors_dek()
    {
        $this->_get_datatables_query_list_endors_dek();

        if ($this->input->post('length') != -1) {
            $this->db->limit($this->input->post('length'), $this->input->post('start'));
            
            return $this->db->get()->result_array();
        }
    }

    var $kolom_order_list_endors_dek = [null, 'LOWER(t.nama_endorsment)', "CAST(to_char(t.add_time :: DATE, 'dd-Mon-yyyy') as VARCHAR)", 't.status'];
    var $kolom_cari_list_endors_dek  = ['LOWER(t.nama_endorsment)', "CAST(to_char(t.add_time :: DATE, 'dd-Mon-yyyy') as VARCHAR)", 't.status'];
    var $order_list_endors_dek       = ['t.nama_endorsment' => 'asc'];

    public function _get_datatables_query_list_endors_dek()
    {
        $this->db->select("t.nama_endorsment, t.status, to_char(t.add_time :: DATE, 'dd-Mon-yyyy') as tgl");
        $this->db->from('tr_endorsment as t');
        $this->db->where('t.id_mop', $this->input->post('id_mop'));
        $this->db->group_by('t.nama_endorsment');
        $this->db->group_by('t.status');
        $this->db->group_by('tgl');
        
        $b = 0;
        
        $input_cari = strtolower($_POST['search']['value']);
        $kolom_cari = $this->kolom_cari_list_endors_dek;

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

            $kolom_order = $this->kolom_order_list_endors_dek;
            $this->db->order_by($kolom_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
            
        } elseif (isset($this->order_list_endors_dek)) {
            
            $order = $this->order_list_endors_dek;
            $this->db->order_by(key($order), $order[key($order)]);
            
        }
        
    }

    public function jumlah_semua_list_endors_dek()
    {
        $this->db->select("t.nama_endorsment, t.status, to_char(t.add_time :: DATE, 'dd-Mon-yyyy') as tgl");
        $this->db->from('tr_endorsment as t');
        $this->db->where('t.id_mop', $this->input->post('id_mop'));
        $this->db->group_by('t.nama_endorsment');
        $this->db->group_by('t.status');
        $this->db->group_by('tgl');
        
        return $this->db->count_all_results();
    }

    public function jumlah_filter_list_endors_dek()
    {
        $this->_get_datatables_query_list_endors_dek();

        return $this->db->get()->num_rows();
        
    }

    // 16-05-2021
    public function get_binding()
    {
        $this->db->select('t.id_sppa_quotation as id, t.sppa_number, c.cob, l.lob');    
        $this->db->from('tr_sppa_quotation as t');
        $this->db->join('m_cob as c', 'id_cob', 'inner');
        $this->db->join('m_lob as l', 'id_lob', 'inner');
        $this->db->where('t.approval', false);

        return $this->db->get();
        
    }

    // 24-05-2021
    public function get_endors($id_sppa)
    {
        $this->db->select('t.id_endorsment, t.add_time, t.nama_endorsment, s.sppa_number, s.no_polis, p.no_otorisasi_polis, t.status, s.id_sppa_quotation as id_sppa');
        $this->db->from('tr_endorsment as t');
        $this->db->join('tr_sppa_quotation as s', 'id_sppa_quotation', 'inner');
        $this->db->join('tr_approve_sppa as p', 'id_sppa_quotation', 'inner');
        $this->db->where('t.id_sppa_quotation', $id_sppa);
        $this->db->order_by('t.nama_endorsment', 'asc');
        
        return $this->db->get();
    }

    // 21-06-2021
    public function get_endors_dek($id_mop)
    {
        $this->db->select("t.nama_endorsment, TO_CHAR(t.add_time :: DATE, 'dd/mm/yyyy') as tanggal, t.status, t.id_mop");
        $this->db->from('tr_endorsment as t');
        $this->db->where('t.id_mop', $id_mop);
        $this->db->group_by('t.status');
        $this->db->group_by('t.id_mop');
        $this->db->group_by('t.nama_endorsment');
        $this->db->group_by("TO_CHAR(t.add_time :: DATE, 'dd/mm/yyyy')");
        
        return $this->db->get();
    }

    // 19-07-2021
    public function cari_jumlah_endors($id_mop)
    {
        $this->db->select('nama_endorsment');
        $this->db->from('tr_endorsment');
        $this->db->where('id_mop', $id_mop);
        $this->db->group_by('nama_endorsment');
        
        return $this->db->get();
    }

    // 19-07-2021
    public function cari_jumlah_aktif($id_mop)
    {
        $this->db->select('id_sppa_quotation');
        $this->db->from('tr_sppa_quotation');
        $this->db->where('id_mop', $id_mop);
        $this->db->where('cancelation', 'f');
        $this->db->where('status_aktif', 't');
        
        return $this->db->get();
    }

    // 18-06-2021
    public function get_data_binding_dek()
    {
        $this->_get_datatables_query_binding_dek();

        if ($this->input->post('length') != -1) {
            $this->db->limit($this->input->post('length'), $this->input->post('start'));
            
            return $this->db->get()->result_array();
        }
    }

    var $kolom_order_binding_dek = [null, 'm.no_polis_induk', 'm.no_mop', 'm.nama_mop', 'n.nama_nasabah'];
    var $kolom_cari_binding_dek  = ['LOWER(m.no_polis_induk)', 'LOWER(m.no_mop)', 'LOWER(m.nama_mop)', 'LOWER(n.nama_nasabah)'];
    var $order_binding_dek       = ['waktu' => 'desc'];

    public function _get_datatables_query_binding_dek()
    {
        $this->db->distinct();
        $this->db->select("m.id_mop, m.no_polis_induk, m.nama_mop, m.no_mop, n.nama_nasabah, (SELECT p.add_time FROM tr_sppa_quotation as p WHERE p.id_mop = m.id_mop order by p.add_time asc LIMIT 1) as waktu");
        $this->db->from('tr_sppa_quotation as t');
        $this->db->join('mop as m', 'id_mop', 'inner');
        $this->db->join('m_nasabah as n', 'n.id_nasabah = m.id_insured', 'inner');
        
        $b = 0;
        
        $input_cari = strtolower($_POST['search']['value']);
        $kolom_cari = $this->kolom_cari_binding_dek;

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

            $kolom_order = $this->kolom_order_binding_dek;
            $this->db->order_by($kolom_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
            
        } elseif (isset($this->order_binding_dek)) {
            
            $order = $this->order_binding_dek;
            $this->db->order_by(key($order), $order[key($order)]);
            
        }
        
    }

    public function jumlah_semua_binding_dek()
    {
        $this->db->distinct();
        $this->db->select("m.id_mop, m.no_polis_induk, m.nama_mop, m.no_mop, n.nama_nasabah, (SELECT p.add_time FROM tr_sppa_quotation as p WHERE p.id_mop = m.id_mop order by p.add_time asc LIMIT 1) as waktu");
        $this->db->from('tr_sppa_quotation as t');
        $this->db->join('mop as m', 'id_mop', 'inner');
        $this->db->join('m_nasabah as n', 'n.id_nasabah = m.id_insured', 'inner');
        
        return $this->db->count_all_results();
    }

    public function jumlah_filter_binding_dek()
    {
        $this->_get_datatables_query_binding_dek();

        return $this->db->get()->num_rows();
        
    }

    // 21-06-2021
    public function get_field($id_relasi)
    {
        $this->db->select('f.*');
        $this->db->from('m_sppa_field_spec as s');
        $this->db->join('m_field_sppa as f', 'f.id_field_sppa = s.type_field', 'inner');
        $this->db->where('s.id_relasi_cob_lob', $id_relasi);
        $this->db->where('f.cdb', "t");
        
        return $this->db->get();
    }

    // 21-06-2021
    public function list_tertanggung()
    {
        // SELECT t.*
        // FROM tr_sppa_quotation as s 
        // INNER JOIN m_sppa_field_spec as f ON f.id_relasi_cob_lob = s.id_relasi_cob_lob 
        // INNER JOIN m_field_sppa as e ON e.id_field_sppa = f.type_field
        // INNER JOIN pengguna_tertanggung as t ON t.id_pengguna_tertanggung = s.id_pengguna_tertanggung
        // WHERE s.id_mop = 41 AND f.id_relasi_cob_lob = 2 AND e.cdb = 't'
        // GROUP BY t.id_pengguna_tertanggung

        $this->db->select('t.*');
        $this->db->from('tr_sppa_quotation as s');
        $this->db->join('pengguna_tertanggung as t', 't.id_pengguna_tertanggung = s.id_pengguna_tertanggung', 'inner');
        $this->db->where('s.id_mop', $this->input->post('id_mop'));
        
        return $this->db->get();
    }

    // 22-06-2021
    public function list_tertanggung_detail()
    {
        $this->db->select('t.*, s.sppa_number');
        $this->db->from('tr_sppa_quotation as s');
        $this->db->join('pengguna_tertanggung as t', 't.id_pengguna_tertanggung = s.id_pengguna_tertanggung', 'inner');
        $this->db->join('tr_endorsment as e', 'e.id_sppa_quotation = s.id_sppa_quotation', 'inner');
        $this->db->where('s.id_mop', $this->input->post('id_mop'));
        $this->db->where('e.nama_endorsment', $this->input->post('nama_endors'));
        
        return $this->db->get();
    }

    // 25-06-2021
    public function get_data_list_sppa()
    {
        $this->_get_datatables_query_list_sppa();

        if ($this->input->post('length') != -1) {
            $this->db->limit($this->input->post('length'), $this->input->post('start'));
            
            return $this->db->get()->result_array();
        }
    }

    var $kolom_order_list_sppa = [null, 't.sppa_number', 'a.nama_asuransi', 'c.cob'];
    var $kolom_cari_list_sppa  = ['t.sppa_number', 'LOWER(a.nama_asuransi)', 'LOWER(c.cob)'];
    var $order_list_sppa       = ['t.sppa_number' => 'asc'];

    public function _get_datatables_query_list_sppa()
    {
        $this->db->select('t.id_sppa_quotation as id, t.sppa_number, p.*, e.nama_endorsment, e.id_sppa_quotation as id_sppa_en');
        $this->db->from('tr_sppa_quotation as t');
        $this->db->join('pengguna_tertanggung as p', 'id_pengguna_tertanggung', 'inner');
        $this->db->join('tr_endorsment as e', 't.id_sppa_quotation = e.id_endorsment', 'inner');
        $this->db->where('t.id_mop', $this->input->post('id_mop'));
        $this->db->where('e.id_mop', $this->input->post('id_mop'));
        $this->db->where('t.status_aktif', 't');
        
        $b = 0;
        
        $input_cari = strtolower($_POST['search']['value']);
        $kolom_cari = $this->kolom_cari_list_sppa;

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

            $kolom_order = $this->kolom_order_list_sppa;
            $this->db->order_by($kolom_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
            
        } elseif (isset($this->order_list_sppa)) {
            
            $order = $this->order_list_sppa;
            $this->db->order_by(key($order), $order[key($order)]);
            
        }
        
    }

    public function jumlah_semua_list_sppa()
    {
        $this->db->select('t.id_sppa_quotation as id, t.sppa_number, p.*, e.nama_endorsment, e.id_sppa_quotation as id_sppa_en');
        $this->db->from('tr_sppa_quotation as t');
        $this->db->join('pengguna_tertanggung as p', 'id_pengguna_tertanggung', 'inner');
        $this->db->join('tr_endorsment as e', 't.id_sppa_quotation = e.id_endorsment', 'inner');
        $this->db->where('t.id_mop', $this->input->post('id_mop'));
        $this->db->where('e.id_mop', $this->input->post('id_mop'));
        $this->db->where('t.status_aktif', 't');
        
        return $this->db->count_all_results();
    }

    public function jumlah_filter_list_sppa()
    {
        $this->_get_datatables_query_list_sppa();

        return $this->db->get()->num_rows();
        
    }

}

/* End of file M_binding.php */
