<?php defined('BASEPATH') OR exit('No direct script access allowed');

class M_param_scoring extends CI_Model
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

    // 07-06-2021
    public function get_data_parameter_scoring()
    {
        $this->_get_datatables_query_parameter_scoring();

        if ($this->input->post('length') != -1) {
            $this->db->limit($this->input->post('length'), $this->input->post('start'));
            
            return $this->db->get()->result_array();
        }
    }

    var $kolom_order_parameter_scoring = [null, 'LOWER(nama_parameter)', 'LOWER(type)', 'CAST(bobot as VARCHAR)', 'LOWER(keterangan)', 'CAST(nilai_parameter as VARCHAR)'];
    var $kolom_cari_parameter_scoring  = ['LOWER(nama_parameter)', 'LOWER(type)', 'CAST(bobot as VARCHAR)', 'LOWER(keterangan)', 'CAST(nilai_parameter as VARCHAR)'];
    var $order_parameter_scoring       = ['id_parameter_scoring' => 'desc'];

    public function _get_datatables_query_parameter_scoring()
    {
        $this->db->from('m_parameter_scoring');
        if ($this->input->post('id_parent_param') != '') {
            $this->db->where('id_parent_parameter', $this->input->post('id_parent_param'));
        }
        
        $b = 0;
        
        $input_cari = strtolower($_POST['search']['value']);
        $kolom_cari = $this->kolom_cari_parameter_scoring;

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

            $kolom_order = $this->kolom_order_parameter_scoring;
            $this->db->order_by($kolom_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
            
        } elseif (isset($this->order_parameter_scoring)) {
            
            $order = $this->order_parameter_scoring;
            $this->db->order_by(key($order), $order[key($order)]);
            
        }
        
    }

    public function jumlah_semua_parameter_scoring()
    {
        $this->db->from('m_parameter_scoring');
        if ($this->input->post('id_parent_param') != '') {
            $this->db->where('id_parent_parameter', $this->input->post('id_parent_param'));
        }

        return $this->db->count_all_results();
    }

    public function jumlah_filter_parameter_scoring()
    {
        $this->_get_datatables_query_parameter_scoring();

        return $this->db->get()->num_rows();
        
    }

}

?>
