<?php defined('BASEPATH') OR exit('No direct script access allowed');

class M_parent extends CI_Model
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
    public function total_bobot()
    {
        $this->db->select('SUM(bobot) as total');
        $this->db->from('m_parent_parameter');

        return $this->db->get();
    }

    // 07-06-2021
    // Menampilkan list parent_parameter
    public function get_data_parent_parameter()
    {
        $this->_get_datatables_query_parent_parameter();

        if ($this->input->post('length') != -1) {
            $this->db->limit($this->input->post('length'), $this->input->post('start'));
            
            return $this->db->get()->result_array();
        }
    }

    var $kolom_order_parent_parameter = [null, 'LOWER(parent_parameter)', 'bobot'];
    var $kolom_cari_parent_parameter  = ['LOWER(parent_parameter)','CAST(bobot as VARCHAR)'];
    var $order_parent_parameter       = ['id_parent_parameter' => 'desc'];

    public function _get_datatables_query_parent_parameter()
    {
        $this->db->from('m_parent_parameter');
    
        $b = 0;
        
        $input_cari = strtolower($_POST['search']['value']);
        $kolom_cari = $this->kolom_cari_parent_parameter;

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

            $kolom_order = $this->kolom_order_parent_parameter;
            $this->db->order_by($kolom_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
            
        } elseif (isset($this->order_parent_parameter)) {
            
            $order = $this->order_parent_parameter;
            $this->db->order_by(key($order), $order[key($order)]);
            
        }
        
    }

    public function jumlah_semua_parent_parameter()
    {
        $this->db->from('m_parent_parameter');

        return $this->db->count_all_results();
    }

    public function jumlah_filter_parent_parameter()
    {
        $this->_get_datatables_query_parent_parameter();

        return $this->db->get()->num_rows();
        
    }
}

?>
