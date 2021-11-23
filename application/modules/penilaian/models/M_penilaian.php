<?php defined('BASEPATH') OR exit('No direct script access allowed');

class M_penilaian extends CI_Model
{
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

    // 07-06-2021
    public function total_bobot($id_parent)
    {
        $this->db->select('SUM(bobot) as total');
        $this->db->from('m_parameter_scoring');
        $this->db->where('id_parent_parameter', $id_parent);

        return $this->db->get();
    }

    // Menampilkan list asuransi
    public function get_data_asuransi()
    {
        $this->_get_datatables_query_asuransi();

        if ($this->input->post('length') != -1) {
            $this->db->limit($this->input->post('length'), $this->input->post('start'));
            
            return $this->db->get()->result_array();
        }
    }

    var $kolom_order_asuransi = [null, 'nama_asuransi', 'telp', 'pic'];
    var $kolom_cari_asuransi  = ['kode_asuransi','LOWER(nama_asuransi)', 'telp', 'LOWER(pic)'];
    var $order_asuransi       = ['nama_asuransi' => 'asc'];

    public function _get_datatables_query_asuransi()
    {
        $a = $this->db->get_where('m_user', ['id_user' => $this->input->post('id_user')])->row_array();
            
        if ($a['id_level_user'] == 3) {
            $this->db->from('m_asuransi');
            $this->db->where('id_asuransi', $a['id_karyawan']);
        } else {
            $this->db->from('m_asuransi');
        }
        
        $b = 0;
        
        $input_cari = strtolower($_POST['search']['value']);
        $kolom_cari = $this->kolom_cari_asuransi;

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

            $kolom_order = $this->kolom_order_asuransi;
            $this->db->order_by($kolom_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
            
        } elseif (isset($this->order_asuransi)) {
            
            $order = $this->order_asuransi;
            $this->db->order_by(key($order), $order[key($order)]);
            
        }
        
    }

    public function jumlah_semua_asuransi()
    {
        // cari
        $a = $this->db->get_where('m_user', ['id_user' => $this->input->post('id_user')])->row_array();
            
        if ($a['id_level_user'] == 3) {
            $this->db->from('m_asuransi');
            $this->db->where('id_asuransi', $a['id_karyawan']);
        } else {
            $this->db->from('m_asuransi');
        }

        return $this->db->count_all_results();
    }

    public function jumlah_filter_asuransi()
    {
        $this->_get_datatables_query_asuransi();

        return $this->db->get()->num_rows();
        
    }

    public function get_score_grafik()
    {
        $this->db->select('*');
        $this->db->from('m_asuransi');
        $this->db->order_by('score', 'desc');
        $this->db->where('score !=', null);
        $this->db->limit(5);
        
        return $this->db->get();
    }

    // 21-07-2021
    public function cari_data_scoring($id_asuransi)
    {
        $this->db->select('p.id_parameter_scoring, p.bobot, p.type, p.nilai_parameter, s.input, s.hasil');
        $this->db->from('scoring_asuransi as s');
        $this->db->join('m_parameter_scoring as p', 'id_parameter_scoring', 'inner');
        $this->db->where('s.id_asuransi', $id_asuransi);
        
        return $this->db->get();
    }

    // 21-07-2021
    public function get_asuransi()
    {
        $this->db->select('id_asuransi, nama_asuransi, score');
        $this->db->from('m_asuransi');
        $this->db->order_by('nama_asuransi', 'asc');
        
        return $this->db->get();
    }

    // 21-07-2021
    public function get_param_scoring()
    {
        $this->db->select('id_parameter_scoring');
        $this->db->from('m_parameter_scoring');
        $this->db->join('m_parent_parameter', 'id_parent_parameter', 'inner');
        $this->db->order_by('id_parameter_scoring', 'asc');
        
        $list = $this->db->get()->result_array();

        $array_ids = [];
        foreach ($list as $l) {
            array_push($array_ids, $l['id_parameter_scoring']);
        }

        return $array_ids;
    }

    // 21-07-2021
    public function get_scoring_asuransi($id_asuransi)
    {
        $this->db->select('*');
        $this->db->from('scoring_asuransi');
        $this->db->where('id_asuransi', $id_asuransi);
        $this->db->order_by('id_parameter_scoring', 'asc');
        
        $list = $this->db->get()->result_array();

        $array_ids = [];
        foreach ($list as $l) {
            array_push($array_ids, $l['id_parameter_scoring']);
        }

        return $array_ids;
    }

    // 21-07-2021
    public function data_scoring_asuransi($id_asuransi)
    {
        $this->db->select('s.*');
        $this->db->from('scoring_asuransi as s');
        $this->db->join('m_parameter_scoring as p', 'id_parameter_scoring', 'inner');
        $this->db->where('s.id_asuransi', $id_asuransi);
        $this->db->order_by('s.id_parameter_scoring', 'asc');
        
        return $this->db->get();

    }

}

?>
