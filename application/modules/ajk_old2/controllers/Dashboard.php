<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

    public function __construct()
	{
		parent::__construct();
		if($this->session->userdata('username') == "")
        {
            redirect(base_url(), 'refresh');
        }
        $this->load->model(array('M_dashboard')); 
	}

    public function index()
    {
        $query =  $this->db->query("SELECT parrent, nama_menu FROM ref_menu LIMIT 5"); 
    
        $record = $query->result_array();
        $dt = [];
    
        foreach($record as $row) {
                $dt['label'][] = $row['nama_menu'];
                $dt['data'][] = (int) $row['parrent'];
        }

        $data 	= [ 'title'         => 'Dashboard',
                    'chart_data'    => json_encode($dt),
                    'parameter'     => $this->M_dashboard->get_data('m_parameter_scoring')->result_array()
                  ];

        $this->template->load('template/index','dashboard', $data);
    }


}

/* End of file Dashboard.php */
