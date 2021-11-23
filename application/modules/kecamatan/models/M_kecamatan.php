<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class M_kecamatan extends CI_Model {

    var $kolom_order_kec = [null,'m_kecamatan.kecamatan', 'm_kota.kota'];
    var $kolom_cari_kec  = ['LOWER(m_kecamatan.kecamatan)', 'LOWER(m_kota.kota)'];
    var $oder_kec       = ['m_kecamatan.id_kecamatan' => 'desc'];



        //Model Desa
        public function get_data_kecamatan($value='')
        {
        $this->_get_data_kecamatan();
        if ($this->input->post('length') != -1) {
            $this->db->limit($this->input->post('length'), $this->input->post('start'));
            return $this->db->get()->result_array();
        }
        }
    
        public function _get_data_kecamatan()
        {
        $this->db->select('*');
        $this->db->from('m_kecamatan');
        $this->db->join('m_kota','m_kota.id_kota = m_kecamatan.id_kota');
    
        $b = 0;
        $input_cari = strtolower($_POST['search']['value']);
        $kolom_cari = $this->kolom_cari_kec;
    
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
            $kolom_order = $this->kolom_order_kecamatan;
            $this->db->order_by($kolom_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } elseif (isset($this->order_kecamatan)) {
            $order = $this->order_kecamatan;
            $this->db->order_by(key($order), $order[key($order)]);
        }
        }
        

        public function countalllistkecamatan()
        {
            $this->db->select('*');
            $this->db->from('m_kecamatan');
            $this->db->join('m_kota','m_kota.id_kota = m_kecamatan.id_kota');
            return $this->db->count_all_results();
        }
    
        public function countfilterlistkecamatan()
        {
            $this->_get_data_kecamatan();
            return $this->db->get()->num_rows();
        }
    
        public function showdatabykec($id)
        {
            $this->db->select('*');
            $this->db->where('m_kecamatan.id_kecamatan',$id);
            $this->db->join('m_kota', 'm_kota.id_kota = m_kecamatan.id_kota');
            $this->db->join('m_provinsi', 'm_provinsi.id_provinsi = m_kota.id_provinsi');
            $this->db->join('m_negara', 'm_negara.id_negara = m_provinsi.id_negara');
            $this->db->order_by("m_kecamatan.kecamatan", "asc");
            $data = $this->db->get('m_kecamatan')->result();
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

        public function listkota()
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
