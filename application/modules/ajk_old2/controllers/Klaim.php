<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Klaim extends CI_Controller {

    public function __construct()
	{
		parent::__construct();
        $this->load->model('m_klaim', 'klaim');
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
    
    // 07-Juni-2021 RFA
    public function ajaxdata()
    {
        $no   = $this->input->post('start');
        $data = $this->ajk->get_data_polis();
    
        $datax = array();
        foreach ($data as $key) {
            $tbody = array();
    
            $no++;
            $tbody[] = '<input type="checkbox">';
            $tbody[] = "<div align='center'>".$no.".</div>";
            $tbody[] = $key['no_klaim'];
            $tbody[] = $key['no_polis'];
            $tbody[] = $key['tipe_klaim'];
            $tbody[] = $key['jenis_klaim'];
            $tbody[] = $key['nilai_pembiayaan'];
            $tbody[] = number_format($key['nilai_pembiayaan'],2,",",".");
            $tbody[] = $key['rate_premi'];
            $tbody[] = number_format($key['premi'],2,",",".");
            $tbody[] = number_format($key['premi_fax'],2,",",".");
            $tbody[] = '
            <button type="button" class="btn btn-success mr-2"><i class="ti-pencil" onclick="ubahpolis('.$key['id_polis'].')"></i></button>
            <button type="button" class="btn btn-danger mr-2"><i class="ti-close" onclick="deletepolis('.$key['id_polis'].')"></i></button>
            <button type="button" class="btn btn-info"><i class="ti-info" onclick="detail('.$key['id_polis'].')"></i></button>';
            $datax[] = $tbody;
        }
    
        $output = [
            "draw"            => $_POST['draw'],
            "recordsTotal"    => $this->ajk->countallpolis(),
            "recordsFiltered" => $this->ajk->countfilterpolis(),
            "data"            => $datax
        ];
        echo json_encode($output);
    }

    // 07-Juni-2021 RFA
    public function form_tambah_data()
    {
        $data 	= [ 'title'  => 'Tambah Klaim',
                    'polis' => $this->klaim->polis(),
                    'klaimtipe' => $this->klaim->klaimtipe(),
                    'indikator' => $this->klaim->indikator(),
                    'klasifikasiklaim' => $this->klaim->klasifikasiklaim(),
                    'jenisklaim' => $this->klaim->jenisklaim(),
                    ];

        $this->template->load('template/index','klaim/tambah', $data);
    }
    
    // 07-Juni-2021 RFA
    public function simpan_tambah_klaim()
    {
        $data['id_polis']               = $this->input->post('id_polis');
        $data['id_tipe_klaim']          = $this->input->post('id_tipe_klaim');
        $data['keterangan']             = $this->input->post('keterangan');
        $data['tgl_lapor']              = $this->input->post('tgl_lapor');
        $data['tgl_kejadian']           = $this->input->post('tgl_kejadian');
        $data['no_rek_debitur']         = $this->input->post('no_rek_debitur');
        $data['nilai_klaim']            = $this->input->post('nilai_klaim');
        $data['id_klasifikasi_klaim']   = $this->input->post('id_klasifikasi_klaim');
        $data['id_indikator']           = $this->input->post('id_indikator');
        $data['add_by']                 = $this->session->userdata('sesi_id');
        $data['add_time']               = date('Y-m-d');

        $result = $this->db->insert('tr_klaim', $data);

        echo json_encode(['status' => 'sukses']);
    }
    
    // 07-Juni-2021 RFA
    public function editklaim($id)
    {
        $data['id_polis']               = $this->input->post('id_polis');
        $data['id_tipe_klaim']          = $this->input->post('id_tipe_klaim');
        $data['keterangan']             = $this->input->post('keterangan');
        $data['tgl_lapor']              = $this->input->post('tgl_lapor');
        $data['tgl_kejadian']           = $this->input->post('tgl_kejadian');
        $data['no_rek_debitur']         = $this->input->post('no_rek_debitur');
        $data['nilai_klaim']            = $this->input->post('nilai_klaim');
        $data['id_klasifikasi_klaim']   = $this->input->post('id_klasifikasi_klaim');
        $data['id_indikator']           = $this->input->post('id_indikator');
        $data['add_time']               = date('Y-m-d');
        $this->db->where('id_klaim', $id);
        $this->db->update('tr_klaim', $data);
    
        echo json_encode(['status' => 'sukses']);
    }
    
    // 07-Juni-2021 RFA
    public function removeklaim($id)
    {
        $this->db->where('id_klaim',$id);
            $this->db->delete('tr_klaim');
    
        echo json_encode(['status' => 'sukses']);
    }

    // 22-04-2021
    public function detail($id_klaim, $aksi = "")
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
