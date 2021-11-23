<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Restitusi extends CI_Controller {

    public function __construct()
	{
		parent::__construct();
		if($this->session->userdata('username') == "")
        {
            redirect(base_url(), 'refresh');
        }
	}

    // 22-04-2021
    public function index()
    {
        $this->restitusi();
    }

    // 22-04-2021
    public function restitusi()
    {
        $data 	= ['title'  => 'Restitusi'
                  ];

        $this->template->load('template/index','restitusi/lihat', $data);
    }

    // 22-04-2021
    public function form_tambah_data()
    {
        $data 	= ['title'  => 'Tambah Restitusi'
                  ];

        $this->template->load('template/index','restitusi/tambah', $data);
    }

    // 22-04-2021
    public function detail($id_restitusi, $aksi)
    {
        $data 	= [ 'title'         => 'Detail Restitusi',
                    'aksi'          => $aksi,
                    'id_restitusi'  => $id_restitusi
                  ];

        $this->template->load('template/index','restitusi/detail', $data);
    }

    // 22-04-2021
    public function cetak()
    {
        $data 	= ['title'  => 'Cetak Nota Restitusi'
                  ];

        $this->template->load('template/index','restitusi/cetak/lihat', $data);
    }

    // 22-04-2021
    public function enquiry()
    {
        $data 	= ['title'  => 'Enquiry Restitusi'
                  ];

        $this->template->load('template/index','restitusi/enquiry', $data);
    }

    // 22-04-2021
    public function posting()
    {
        $data 	= ['title'  => 'Posting Restitusi'
                  ];

        $this->template->load('template/index','restitusi/posting', $data);
    }

    // 22-04-2021
    public function tambah_posting()
    {
        $data 	= ['title'  => 'Tambah Posting'
                  ];

        $this->template->load('template/index','restitusi/tambah_posting', $data);
    }

    // 22-04-2021
    public function bayar()
    {
        $data 	= ['title'  => 'Input Pembayaran Restitusi'
                  ];

        $this->template->load('template/index','restitusi/bayar', $data);
    }

}

/* End of file Restitusi.php */
