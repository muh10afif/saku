<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class M_dashboard extends CI_Model {

    public function get_data($tabel)
    {
        return $this->db->get($tabel);
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

    
    // Menampilkan list asuransi
    public function get_data_asuransi()
    {
        $this->_get_datatables_query_asuransi();

        if ($this->input->post('length') != -1) {
            $this->db->limit($this->input->post('length'), $this->input->post('start'));
            
            return $this->db->get()->result_array();
        }
    }

    var $kolom_order_asuransi = [null, 'kode_asuransi', 'nama_asuransi', 'telp', 'pic'];
    var $kolom_cari_asuransi  = ['kode_asuransi','LOWER(nama_asuransi)', 'telp', 'LOWER(pic)'];
    var $order_asuransi       = ['id_asuransi' => 'desc'];

    public function _get_datatables_query_asuransi()
    {
        $this->db->from('m_asuransi');
        
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
        $this->db->from('m_asuransi');

        return $this->db->count_all_results();
    }

    public function jumlah_filter_asuransi()
    {
        $this->_get_datatables_query_asuransi();

        return $this->db->get()->num_rows();
        
    }
}

/* End of file M_dashboard.php */
