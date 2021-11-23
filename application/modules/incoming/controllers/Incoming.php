<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Incoming extends CI_Controller {

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
        $this->entry();
    }

    // 23-04-2021
    public function entry()
    {
        $data 	= ['title'  => 'Entry SPPA'
                  ];

        $this->template->load('template/index','incoming/entry/lihat', $data);
    }

    // 23-04-2021
    public function approval()
    {
        $data 	= ['title'  => 'Approval SPPA'
                  ];

        $this->template->load('template/index','incoming/approval/lihat', $data);
    }

    // 23-04-2021
    public function binding()
    {
        $data 	= ['title'  => 'Binding Slip'
                  ];

        $this->template->load('template/index','incoming/binding/lihat', $data);
    }

    // 23-04-2021
    public function cover_notes()
    {
        $data 	= ['title'  => 'Cover Notes'
                  ];

        $this->template->load('template/index','incoming/cover_notes/lihat', $data);
    }

    // 23-04-2021
    public function policy_issue()
    {
        $data 	= ['title'  => 'Police Issue'
                  ];

        $this->template->load('template/index','incoming/police_issue/lihat', $data);
    }

}

/* End of file Incoming.php */
