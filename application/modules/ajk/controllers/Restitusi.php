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
        $data 	= ['title'  => 'Restitusi',
                    // 'data' => $this->res->get_data_restitusi()

                    ];

                    // var_dump($data);die();
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
        $data['user_input']             = $this->session->userdata('sesi_id');
        $data['add_time']               = date('Y-m-d');

        $result = $this->db->insert('tr_restitusi', $data);

        echo json_encode(['status' => 'sukses']);
    }

    
    // Get data No Polis
    public function getdata()
    {
        $id = $this->input->get('id_polis');
        
        $data = $this->res->get_data_list($id);
        $respon['no_polis'] = $data->no_polis;

        echo json_encode($respon);
    }
    
    // 08-Juni-2021 RFA
    public function ajaxdata()
    {
        $no   = $this->input->post('start');
        $data = $this->res->get_data_restitusi();

        // var_dump($data);die();
    
        $datax = array();
        foreach ($data as $key) {
            $tbody = array();
    
            $no++;
            $tbody[] = '<input type="checkbox" class="check" name="verifikasi[]" value="'. $key['id_restitusi'] .'">';
            $tbody[] = "<div align='center'>".$no.".</div>";
            $tbody[] = $key['no_restitusi'];
            $tbody[] = $key['no_polis'];
            $tbody[] = $key['tipe_klaim'] != null ? $key['tipe_klaim']:'-';
            $tbody[] = $key['tipe_klaim'] != null ? $key['tipe_klaim']:'-';
            $tbody[] = number_format($key['nilai_restitusi'],2,",",".");
            $tbody[] = "0000-00-00";
            $tbody[] = $key['nama_nasabah'];
            $tbody[] = number_format($key['premi'],2,",",".");
            $tbody[] = $key['nama_cabang_bank'];
            $tbody[] = $key['alamat_rumah'];
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

    
    //17-Juni-2021 RFA
    public function verifikasi()
    {
        $dataverifikasi = $this->input->post('ver');

        foreach ($dataverifikasi as $dv){
            
            $data['id_verifikator']   = $this->session->userdata('sesi_id');
            $data['tgl_verifikasi']   = date('Y-m-d');

            $result = $this->res->updateRestitusi($dv, $data);
        }
        if($result == true)
        {
            echo json_encode(['status' => 'sukses']);
        }else{
            echo json_encode(['status' => 'error']);
        }

        $result = $dataverifikasi;
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

    //16-Juni-2021 RFA
    public function tampil_detail($id)
    {
        $data = $this->res->showdatarestitusi($id);
        echo json_encode($data);
    }
    
    // 15-Juni-2021 RFA
    public function ajaxdatacetakres()
    {
        $no   = $this->input->post('start');
        $data = $this->res->get_data_restitusi();
    
        $datax = array();
        foreach ($data as $key) {
            $tbody = array();
    
            $no++;
            $tbody[] = "<div align='center'>".$no.".</div>";
            $tbody[] = $key['no_restitusi'];
            $tbody[] = $key['no_polis'];
            $tbody[] = $key['nilai_restitusi'];
            $tbody[] = "000-00-00";
            $tbody[] = $key['nama_cabang_bank'];
            $tbody[] = $key['nama_nasabah'];
            $tbody[] = $key['tempat_dinas'];
            $tbody[] = $key['alamat_rumah'];
            $tbody[] = '
            <a href="'.base_url().'ajk/restitusi/cetak_nota/'.$key['id_restitusi'].'"><button type="button" class="btn btn-info"><i class="ti-printer" ></i></button></a>
            <button type="button" class="btn btn-info"><i class="ti-info" onclick="detailcetak('.$key['id_restitusi'].')"></i></button>';
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
    // 22-04-2021
    public function cetak()
    {
        $data 	= ['title'  => 'Cetak Nota Restitusi'
                    ];

        $this->template->load('template/index','restitusi/cetak/lihat', $data);
    }
    
    // 27-04-2021
    //15-Juni-2021 RFA
    public function cetak_nota($id)
    {
        $path   =   BASEPATH . 'upload/pdf';
        
        $data 	=  $this->res->showdatacetakres($id);
        // var_dump($data);
        $update_data = array('id_user_cetak' => $this->session->userdata('sesi_id'));
        $result = $this->res->updateRes($data['id_restitusi'],$update_data);
        // var_dump($data['no_restitusi']); die();
        $mpdf = new \Mpdf\Mpdf();
        $html = $this->load->view('restitusi/cetak/nota',['data' => $data],true);
        $mpdf->WriteHTML($html);
        
        $mpdf->Output('upload/restitusi/tes_MPDF.pdf','F');
        
        redirect('ajk/restitusi/preview/', $data, true);

    }

    // 27-04-2021
    public function preview()
    {
        $this->load->view('restitusi/cetak/preview_cetak');
        
    }

    // 22-04-2021
    public function enquiry()
    {
        $data 	= ['title'  => 'Enquiry Restitusi'
                  ];

        $this->template->load('template/index','restitusi/enquiry', $data);
    }

    
    // 08-Juni-2021 RFA
    public function ajaxdataenquiry()
    {
        $no   = $this->input->post('start');
        $data = $this->res->get_data_resenquiry();
    
        $datax = array();
        foreach ($data as $key) {
            $tbody = array();
    
            $no++;
            $tbody[] = "<div align='center'>".$no.".</div>";
            $tbody[] = $key['no_polis'];
            $tbody[] = $key['nama_nasabah'];
            $tbody[] = $key['tgl_mulai'];
            $tbody[] = $key['lama_bulan'];
            $tbody[] = $key['nilai_pembiayaan'];
            $tbody[] = $key['rate_premi'];
            $tbody[] = $key['premi'];
            $tbody[] = $key['premi_fax'];
            $tbody[] = $key['id_verifikator'] != null ? 'OK':'NO';
            $tbody[] = $key['no_sertifikat_klaim'] != null ? 'OK':'NO';
            $tbody[] = '
            <button type="button" class="btn btn-info mr-2"><i class="ti-pencil" onclick="detail('.$key['id_klaim'].')"></i></button>
            <a href="'.base_url()."ajk/klaim/form_tambah_data".'"><button type="button" class="btn btn-success mr-2">K</button></a>
            <a href="'.base_url()."ajk/restitusi/form_tambah_data".'"><button type="button" class="btn btn-success">R</button></a>';
            $datax[] = $tbody;
        }
    
        $output = [
            "draw"            => $_POST['draw'],
            "recordsTotal"    => $this->res->countallresenquiry(),
            "recordsFiltered" => $this->res->countfilterresenquiry(),
            "data"            => $datax
        ];
        echo json_encode($output);
    }

    // 22-04-2021
    public function posting()
    {
        $data 	= ['title'  => 'Posting Restitusi'
                  ];

        $this->template->load('template/index','restitusi/posting', $data);
    }

    // 15-Juni-2021 RFA
    public function ajaxdataposting()
    {
        $no   = $this->input->post('start');
        $data = $this->res->get_data_postingres();
    
        $datax = array();
        foreach ($data as $key) {
            $tbody = array();
    
            $no++;
            $tbody[] = "<div align='center'>".$no.".</div>";
            $tbody[] = $key['no_polis'];
            $tbody[] = $key['nama_nasabah'];
            $tbody[] = $key['nama_cabang_bank'];
            $tbody[] = $key['produk'];
            $tbody[] = number_format($key['premi'],2,",",".");
            $tbody[] = '
            <button type="button" class="btn btn-info"><i class="ti-info" onclick="detailcetak('.$key['id_klaim'].')"></i></button>';
            $datax[] = $tbody;
        }
    
        $output = [
            "draw"            => $_POST['draw'],
            "recordsTotal"    => $this->res->countallpostingres(),
            "recordsFiltered" => $this->res->countfilterpostingres(),
            "data"            => $datax
        ];
        echo json_encode($output);
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

    
    // 21-Juni-2021 RFA
    public function ajaxdatabayar()
    {
        $no   = $this->input->post('start');
        $data = $this->res->get_data_klaimenquiry();
    
        $datax = array();
        foreach ($data as $key) {
            $tbody = array();
    
            $no++;
            $tbody[] = "<div align='center'>".$no.".</div><input type='hidden' name='id_k[]' value='". $key['id_restitusi'] ."'>";
            $tbody[] = '<input type="text" name="proses[]" value="" class="form-control">';
            $tbody[] = '<input type="text" name="tgl_pembayaran[]" value="" class="form-control datepicker text-center">';
            $tbody[] = '<input type="text" name="nilai_pembayaran[]" value="" class="form-control">';
            $tbody[] = $key['no_klaim'];
            $tbody[] = $key['no_polis'];
            $tbody[] = number_format($key['nilai_klaim'],2,",",".");
            $tbody[] = "000-00-00";
            $tbody[] = $key['nama_nasabah'];
            $tbody[] = $key['premi'];
            $tbody[] = $key['nama_cabang_bank'];
            $tbody[] = $key['alamat_rumah'];
            $datax[] = $tbody;
        }
    
        $output = [
            "draw"            => $_POST['draw'],
            "recordsTotal"    => $this->res->countallklaimenquiry(),
            "recordsFiltered" => $this->res->countfilterklaimenquiry(),
            "data"            => $datax
        ];
        echo json_encode($output);
    }

    
    public function editbayarrestitusi()
    {

        $req = $this->input->post();
        if (isset($req['id_restitusi']) && count($req['id_restitusi']) > 0){
            for ($i = 0 ; $i < count($req['nilai_pembayaran']) ; $i++){
                if ($req['nilai_pembayaran'][$i] != null){
                    $data['nilai_pembayaran']         = $req['nilai_pembayaran'][$i];
                    $data['tgl_pembayaran']            = $req['tgl_pembayaran'][$i];
                    $data['id_user_pembayaran']       = $this->session->userdata('sesi_id');
                    $this->db->where('id_restitusi', $req['id_restitusi'][$i]);
                    $this->db->update('tr_restitusi', $data);      
                }
            }
        }
        echo json_encode(['status' => 'sukses']);
    }


    
    // 18-Juni-2021 RFA
    public function ajaxdatatmbhposting()
    {
        $no   = $this->input->post('start');
        $data = $this->res->get_data_tambahpostingres();
    
        $datax = array();
        foreach ($data as $key) {
            $tbody = array();
    
            $no++;
            $tbody[] = "<div align='center'>".$no.".</div><input type='hidden' name='id_k[]' value='". $key['id_klaim'] ."'>";
            $tbody[] = $key['no_polis'];
            $tbody[] = $key['nama_nasabah'];
            $tbody[] = $key['nama_cabang_bank'];
            $tbody[] = $key['produk'];
            $tbody[] = number_format($key['premi'],2,",",".");
            $datax[] = $tbody;
        }
    
        $output = [
            "draw"            => $_POST['draw'],
            "recordsTotal"    => $this->res->countalltambahpostingres(),
            "recordsFiltered" => $this->res->countfiltertambahpostingres(),
            "data"            => $datax
        ];
        echo json_encode($output);
    }

    
    public function editpostingres()
    {
        $req = $this->input->post();
        if (isset($req['id_restitusi']) && count($req['id_restitusi']) > 0){
            for ($i = 0 ; $i < count($req['id_restitusi']) ; $i++){
                if ($req['id_restitusi'][$i] != null){
                    $data['tgl_posting']         = date('Y-m-d');
                    $this->db->where('id_restitusi', $req['id_restitusi'][$i]);
                    $this->db->update('tr_restitusi', $data);      
                }
            }
        }
        echo json_encode(['status' => 'sukses']);
    }

}

/* End of file Restitusi.php */
