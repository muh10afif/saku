<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Restitusi extends CI_Controller {

    public function __construct()
	{
		parent::__construct();
        $this->load->model('m_restitusi', 'res');
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
        $data 	= ['title'  => 'Tambah Restitusi',
                    'polis' => $this->res->polis(),
                    'indikator' => $this->res->indikator(),
                    ];

        $this->template->load('template/index','restitusi/tambah', $data);
    }

    // 08-Juni-2021 RFA
    public function simpan_tambah_restitusi()
    {
        
        $date     = date("Ymd", now('Asia/Jakarta'));
        $day     = date("d", now('Asia/Jakarta'));
        $random   = strtoupper(bin2hex(random_bytes(4)));

        $nmr_restitusi = "$day.$date.$random";

        $data['no_restitusi']           = $nmr_restitusi;
        $data['id_polis']               = $this->input->post('id_polis');
        $data['keterangan']             = $this->input->post('keterangan');
        $data['tgl_lapor']              = $this->input->post('tgl_lapor');
        $data['no_rek_debitur']         = $this->input->post('no_rek_debitur');
        $data['tgl_kirim_dok']          = $this->input->post('tgl_kirim_dok');
        $data['nilai_restitusi']        = $this->input->post('nilai_restitusi');
        $data['id_indikator']           = $this->input->post('id_indikator');
        $data['add_by']                 = $this->session->userdata('sesi_id');
        $data['add_time']               = date('Y-m-d');

        $result = $this->db->insert('tr_restitusi', $data);

        echo json_encode(['status' => 'sukses']);
    }
    
    // 08-Juni-2021 RFA
    public function ajaxdata()
    {
        $no   = $this->input->post('start');
        $data = $this->res->get_data_restitusi();
    
        $datax = array();
        foreach ($data as $key) {
            $tbody = array();
    
            $no++;
            $tbody[] = '<input type="checkbox">';
            $tbody[] = "<div align='center'>".$no.".</div>";
            $tbody[] = $key['no_restitusi'];
            $tbody[] = $key['no_polis'];
            $tbody[] = $key['tipe_klaim'];
            $tbody[] = $key['nama_nasabah'];
            $tbody[] = $key['tgl_mulai'];
            $tbody[] = $key['lama_bulan'];
            $tbody[] = number_format($key['nilai_pembiayaan'],2,",",".");
            $tbody[] = $key['rate_premi'];
            $tbody[] = number_format($key['premi'],2,",",".");
            $tbody[] = number_format($key['premi_fax'],2,",",".");
            $tbody[] = '
            <button type="button" class="btn btn-success mr-2"><i class="ti-pencil" onclick="ubahpolis('.$key['id_restitusi'].')"></i></button>
            <button type="button" class="btn btn-danger mr-2"><i class="ti-close" onclick="deleterestitusi('.$key['id_restitusi'].')"></i></button>
            <button type="button" class="btn btn-info"><i class="ti-info" onclick="detail('.$key['id_restitusi'].')"></i></button>';
            $datax[] = $tbody;
        }
    
        $output = [
            "draw"            => $_POST['draw'],
            "recordsTotal"    => $this->res->countallrestitusi(),
            "recordsFiltered" => $this->res->countfilterrestitusi(),
            "data"            => $datax
        ];
        echo json_encode($output);
    }

    public function removerestitusi($id)
    {
        $this->db->where('id_restitusi',$id);
            $this->db->delete('tr_restitusi');
    
        echo json_encode(['status' => 'sukses']);
    }
    

    // 22-04-2021
    public function detail($id_restitusi, $aksi = "")
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
