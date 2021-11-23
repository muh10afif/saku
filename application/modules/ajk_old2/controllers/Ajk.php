<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Ajk extends CI_Controller {

    public function __construct()
	{
		parent::__construct();
		if($this->session->userdata('username') == "")
        {
            redirect(base_url(), 'refresh');
        }
	}

    public function index()
    {
        $this->dashboard();
    }

    // 23-04-2021
    public function dashboard()
    {
        $data 	= ['title'  => 'Dashboard'
                  ];

        $this->template->load('template/index','dashboard', $data);
    }
}

/* End of file Finance.php */
