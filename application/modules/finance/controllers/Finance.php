<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Finance extends CI_Controller {

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
        $this->quick_posting();
    }

    // 23-04-2021
    public function quick_posting()
    {
        $data 	= ['title'  => 'Quick Posting'
                  ];

        $this->template->load('template/index','finance/quick_posting/lihat', $data);
    }
    
    // 23-04-2021
    public function p_and_p()
    {
        $data 	= ['title'  => 'Production and Payment'
                  ];

        $this->template->load('template/index','finance/p_and_p/lihat', $data);
    }
    // 23-04-2021
    public function j_entry()
    {
        $data 	= ['title'  => 'Journal Entry'
                  ];

        $this->template->load('template/index','finance/j_entry/lihat', $data);
    }
    // 23-04-2021
    public function closing_book()
    {
        $data 	= ['title'  => 'Closing Book'
                  ];

        $this->template->load('template/index','finance/closing_book/lihat', $data);
    }
    // 23-04-2021
    public function delete_tr()
    {
        $data 	= ['title'  => 'Delete Transaction'
                  ];

        $this->template->load('template/index','finance/delete_tr/lihat', $data);
    }

}

/* End of file Finance.php */
