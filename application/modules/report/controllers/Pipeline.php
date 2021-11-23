<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Reader\Csv;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;

class Pipeline extends CI_Controller {

    var $role;
    public function __construct()
	{
		parent::__construct();
        $this->load->model('PipelineReportModel', 'pipeline');    
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
        $this->pipeline();
    }
    
    // 23-04-2021
    public function pipeline()
    {
        $data 	= ['title'  => 'Pipeline'
                  ];

        $this->template->load('template/index','pipeline/lihat', $data);
    }
    
    // 23-04-2021
    public function pipelineexcel()
    {
        $this->load->view('pipeline/excel');
    }

    
    
    public function ajaxdatapipeline($action)
    {
        $permisi = explode('_',$action);
        $b1 = ''; $b2 = ''; $b3 = '';

        $no   = $this->input->post('start');
        $data = $this->pipeline->get_data_pipeline();
    
        $datax = array();
        foreach ($data as $key) {
            $tbody = array();
    
            $no++;
            $tbody[] = "<div align='center'>".$no.".</div>";
            $tbody[] = $key['add_time'] != null ? date('d-m-Y', strtotime($key['add_time'])):'-';
            $tbody[] = $key['add_time'] != null ? date('d-m-Y', strtotime($key['add_time'])):'-';
            $tbody[] = $key['nama_nasabah'] != null ? $key['nama_nasabah']:'-';
            $tbody[] = $key['sob'] != null ? $key['sob']:'-';
            $tbody[] = $key['nama'] != null ? $key['nama']:'-';
            $tbody[] = $key['nama'] != null ? $key['nama']:'-';
            $tbody[] = $key['nama'] != null ? $key['nama']:'-';
            $tbody[] = $key['nama'] != null ? $key['nama']:'-';
            $tbody[] = $key['nama'] != null ? $key['nama']:'-';
            $tbody[] = $key['nama'] != null ? $key['nama']:'-';
            $tbody[] = $key['lob'] != null ? $key['lob']:'-';
            $tbody[] = $key['nama_asuransi'] != null ? $key['nama_asuransi']:'-';
            $tbody[] = $key['nama'] != null ? $key['nama']:'-';
            $tbody[] = $key['nama'] != null ? $key['nama']:'-';
            $tbody[] = $key['premium'] != null ? $key['premium']:'-';
            $tbody[] = $key['nama'] != null ? $key['nama']:'-';
            $tbody[] = $key['nama'] != null ? $key['nama']:'-';
            $tbody[] = $key['nama'] != null ? $key['nama']:'-';
            
            $datax[] = $tbody;
        }
    
        $output = [
            "draw"            => $_POST['draw'],
            "recordsTotal"    => $this->pipeline->countalllistpipeline(),
            "recordsFiltered" => $this->pipeline->countfilterlistpipeline(),
            "data"            => $datax
        ];
        echo json_encode($output);
    }

    public function cetak_pdf()
    {
        $path   =   BASEPATH . 'upload/pdf';

        $data 	=  "cekkk";
        
        // $update_data = array('tgl_cetak' => date('Y-m-d'), 'id_user' => $this->session->userdata('sesi_id'));
        // $result = $this->pls->updatePolis($data['id_polis'],$update_data);
        
        $mpdf = new \Mpdf\Mpdf();
        // $this->load->library('Mpdf');
        $html = $this->load->view('pipeline/cetak/sertifikat',['data' => $data],true);
        $mpdf->WriteHTML($html);
        
        $mpdf->Output('upload/polis/tes_MPDF.pdf','F');
        
        $this->preview($data, true);
        // redirect('ajk/polis/preview/', $data, true);
    }

    public function cetak_sertifikat($id)
    {
        $path   =   BASEPATH . 'upload/pdf';

        $data 	=  $this->pls->showdatacetak($id);
        $update_data = array('tgl_cetak' => date('Y-m-d'), 'id_user' => $this->session->userdata('sesi_id'));
        $result = $this->pls->updatePolis($data['id_polis'],$update_data);
        
        $mpdf = new \Mpdf\Mpdf();
        $html = $this->load->view('polis/cetak/sertifikat',['data' => $data],true);
        $mpdf->WriteHTML($html);
        
        $mpdf->Output('upload/polis/tes_MPDF.pdf','F');
        
        $this->preview($data, true);
        // redirect('ajk/polis/preview/', $data, true);
    }
    // 27-04-2021
    public function preview()
    {
        $this->load->view('pipeline/cetak/preview_cetak');
        
    }
    // 21-04-2021
    // 03-06-2021 RFA
    public function cetak()
    {
        $data 	= ['title'  => 'Cetak Sertifikat',
                    'list_bank' => $this->pls->cabang_bank(),
                ];

        $this->template->load('template/index','polis/cetak/lihat', $data);
    }


}

/* End of file Finance.php */
