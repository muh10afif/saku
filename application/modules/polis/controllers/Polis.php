<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Polis extends CI_Controller {

    public function __construct()
	{
		parent::__construct();
		if($this->session->userdata('username') == "")
        {
            redirect(base_url(), 'refresh');
        }
	}

    // 21-04-2021
    public function index()
    {
        $this->polis();
    }

    // 21-04-2021
    public function polis()
    {
        $data 	= ['title'  => 'Polis'
                  ];

        $this->template->load('template/index','polis/lihat', $data);
    }

    // 21-04-2021
    public function form_tambah_data()
    {
        $data 	= ['title'  => 'Tambah Polis'
                  ];

        $this->template->load('template/index','polis/tambah', $data);
    }

    // 21-04-2021
    public function detail($id_polis, $aksi)
    {
        $data 	= [ 'title'     => 'Detail Polis',
                    'aksi'      => $aksi,
                    'id_polis'  => $id_polis
                  ];

        $this->template->load('template/index','polis/detail', $data);
    }

    // 21-04-2021
    public function cetak()
    {
        $data 	= ['title'  => 'Cetak Sertifikat'
                  ];

        $this->template->load('template/index','polis/cetak/lihat', $data);
    }

    // 21-04-2021
    public function enquiry()
    {
        $data 	= ['title'  => 'Enquiry Polis'
                  ];

        $this->template->load('template/index','polis/enquiry', $data);
    }

    // 21-04-2021
    public function posting()
    {
        $data 	= ['title'  => 'Posting Polis'
                  ];

        $this->template->load('template/index','polis/posting', $data);
    }

    // 21-04-2021
    public function tambah_posting()
    {
        $data 	= ['title'  => 'Tambah Posting'
                  ];

        $this->template->load('template/index','polis/tambah_posting', $data);
    }

}

/* End of file Polis.php */
