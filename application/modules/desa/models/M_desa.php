<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class M_desa extends CI_Model {

    var $kolom_order_desa = ['m_desa.desa', 'm_kecamatan.kecamatan'];
    var $kolom_cari_desa  = ['LOWER(m_desa.desa)', 'LOWER(m_kecamatan.kecamatan)'];
    var $order_desa       = ['m_kecamatan.id_kecamatan' => 'desc'];



        //Model Desa
        public function get_data_desa($value='')
        {
        $this->_get_data_desa();
        if ($this->input->post('length') != -1) {
            $this->db->limit($this->input->post('length'), $this->input->post('start'));
            return $this->db->get()->result_array();
        }
        }
    
        public function _get_data_desa()
        {
        $this->db->select('*');
        $this->db->from('m_desa');
        $this->db->join('m_kecamatan','m_kecamatan.id_kecamatan = m_desa.id_kecamatan');
    
        $b = 0;
        $input_cari = strtolower($_POST['search']['value']);
        $kolom_cari = $this->kolom_cari_desa;
    
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
            $kolom_order = $this->kolom_order_desa;
            $this->db->order_by($kolom_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } elseif (isset($this->order_desa)) {
            $order = $this->order_desa;
            $this->db->order_by(key($order), $order[key($order)]);
        }
        }
        

        public function countalllistdesa()
        {
            $this->db->select('*');
            $this->db->from('m_desa');
            $this->db->join('m_kecamatan','m_kecamatan.id_kecamatan = m_desa.id_kecamatan');
            return $this->db->count_all_results();
        }
    
        public function countfilterlistdesa()
        {
            $this->_get_data_desa();
            return $this->db->get()->num_rows();
        }
    
        public function showdatabydes($id)
        {
            $this->db->select('*');
            $this->db->where('id_desa',$id);
            $this->db->join('m_kecamatan', 'm_kecamatan.id_kecamatan = m_desa.id_kecamatan');
            $this->db->join('m_kota', 'm_kota.id_kota = m_kecamatan.id_kota');
            $this->db->join('m_provinsi', 'm_provinsi.id_provinsi = m_kota.id_provinsi');
            // $this->db->join('m_negara', 'm_negara.id_negara = m_provinsi.id_negara');
            $data = $this->db->get('m_desa')->result();
            return $data;
        }

        public function list_kota()
        {
            $this->db->select('*');
            $this->db->from('m_kota');
            $this->db->order_by("m_kota.kota", "asc");
            $data = $this->db->get()->result();
            return $data;
        }

        public function list_desa()
        {
            $this->db->select('*');
            $this->db->from('m_kecamatan');
            $this->db->order_by("m_kecamatan.kecamatan", "asc");
            $data = $this->db->get()->result();
            return $data;
        }
        
        public function listnegara()
        {
        $this->db->select('*');
        $this->db->from('m_negara');
        $this->db->order_by("m_negara.negara", "asc");
        $data = $this->db->get()->result();
        return $data;
        }
        //End Model Desa

}

/* End of file M_master.php */
