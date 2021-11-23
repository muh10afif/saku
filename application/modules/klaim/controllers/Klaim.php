<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Klaim extends CI_Controller {

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
        $this->klaim();
    }

    // 22-04-2021
    public function klaim()
    {
        $data 	= ['title'  => 'Klaim'
                  ];

        $this->template->load('template/index','klaim/lihat', $data);
    }

    // 22-04-2021
    public function form_tambah_data()
    {
        $data 	= ['title'  => 'Tambah Klaim'
                  ];

        $this->template->load('template/index','klaim/tambah', $data);
    }

    // 22-04-2021
    public function detail($id_klaim, $aksi)
    {
        $data 	= [ 'title'     => 'Detail Klaim',
                    'aksi'      => $aksi,
                    'id_klaim'  => $id_klaim
                  ];

        $this->template->load('template/index','klaim/detail', $data);
    }

    // 22-04-2021
    public function cetak()
    {
        $data 	= ['title'  => 'Cetak Nota Klaim'
                  ];

        $this->template->load('template/index','klaim/cetak/lihat', $data);
    }

    // 22-04-2021
    public function enquiry()
    {
        $data 	= ['title'  => 'Enquiry Klaim'
                  ];

        $this->template->load('template/index','klaim/enquiry', $data);
    }

    // 22-04-2021
    public function posting()
    {
        $data 	= ['title'  => 'Posting Klaim'
                  ];

        $this->template->load('template/index','klaim/posting', $data);
    }

    // 22-04-2021
    public function tambah_posting()
    {
        $data 	= ['title'  => 'Tambah Posting'
                  ];

        $this->template->load('template/index','klaim/tambah_posting', $data);
    }

    // 22-04-2021
    public function bayar()
    {
        $data 	= ['title'  => 'Input Pembayaran Klaim'
                  ];

        $this->template->load('template/index','klaim/bayar', $data);
    }

}

/* End of file Klaim.php */
