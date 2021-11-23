<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Report extends CI_Controller {

    var $role;
    public function __construct()
	{
		parent::__construct();
        $this->load->model('report/m_report', 'pipeline');    
        $this->load->model('kecamatan/m_kecamatan', 'kec');
        $this->load->model('kecamatan/m_kecamatan', 'des');
        $this->role = get_role($this->session->userdata('id_level_otorisasi'));
		if($this->session->userdata('username') == "")
        {
            redirect(base_url(), 'refresh');
        }
	}

    public function index()
    {
        $this->production_report();
    }

    // 23-04-2021
    public function production_report()
    {
        $data 	= ['title'  => 'Production Report'
                  ];

        $this->template->load('template/index','production_report/lihat', $data);
    }
    
    // 23-04-2021
    public function bank_account()
    {
        $data 	= ['title'  => 'Bank Account'
                  ];

        $this->template->load('template/index','bank_account/lihat', $data);
    }
    // 23-04-2021
    public function mutasi_kas_bank()
    {
        $data 	= ['title'  => 'Closing Book'
                  ];

        $this->template->load('template/index','mutasi_kas_bank/lihat', $data);
    }
    // 23-04-2021
    public function aging()
    {
        $data 	= ['title'  => 'Aging Schedule of OS Statement'
                  ];

        $this->template->load('template/index','aging/lihat', $data);
    }
    // 24-04-2021
    public function alert()
    {
        $data 	= ['title'  => 'Alert of Account Production Placement'
                  ];

        $this->template->load('template/index','alert/lihat', $data);
    }
    // 24-04-2021
    public function journal()
    {
        $data 	= ['title'  => 'Journal Posting'
                  ];

        $this->template->load('template/index','journal/lihat', $data);
    }
    // 24-04-2021
    public function trial()
    {
        $data 	= ['title'  => 'Trial Balance'
                  ];

        $this->template->load('template/index','trial/lihat', $data);
    }
    // 24-04-2021
    public function general()
    {
        $data 	= ['title'  => 'General Ledger'
                  ];

        $this->template->load('template/index','general/lihat', $data);
    }
    // 24-04-2021
    public function profit()
    {
        $data 	= ['title'  => 'Profit and Loss Statement'
                  ];

        $this->template->load('template/index','profit/lihat', $data);
    }
    // 24-04-2021
    public function cash_flow()
    {
        $data 	= ['title'  => 'Cash Flow'
                  ];

        $this->template->load('template/index','cash_flow/lihat', $data);
    }

}

/* End of file Finance.php */
