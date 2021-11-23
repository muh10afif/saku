<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Master_ref extends CI_Controller {

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
        $this->wilayah();
    }

    // 23-04-2021
    public function wilayah()
    {
        $data 	= ['title'  => 'Master Wilayah'
                  ];

        $this->template->load('template/index','master_ref/wilayah/lihat', $data);
    }

    // 23-04-2021
    public function cash_bank()
    {
        $data 	= ['title'  => 'Master Cash/Bank'
                  ];

        $this->template->load('template/index','master_ref/cash_bank/lihat', $data);
    }

    // 23-04-2021
    public function currency_rate()
    {
        $data 	= ['title'  => 'Master Curreny Forecast'
                  ];

        $this->template->load('template/index','master_ref/currency_rate/lihat', $data);
    }
}

/* End of file Master_ref.php */
