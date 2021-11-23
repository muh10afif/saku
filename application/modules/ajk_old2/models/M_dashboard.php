<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class M_dashboard extends CI_Model {

    public function get_data($tabel)
    {
        return $this->db->get($tabel);
    }

 
}

/* End of file M_dashboard.php */
