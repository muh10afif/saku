<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class PipelineReport extends CI_Controller {

    var $role;
    public function __construct()
	{
		parent::__construct();
        $this->load->model('report/PipelineReportModel', 'pipeline');    
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
            $tbody[] = $key['add_time'];
            $tbody[] = $key['add_time'];
            $tbody[] = $key['nama_nasabah'];
            $tbody[] = $key['sob'];
            $tbody[] = $key['nama'];
            $tbody[] = $key['nama'];
            $tbody[] = $key['nama'];
            $tbody[] = $key['nama'];
            $tbody[] = $key['nama'];
            $tbody[] = $key['nama'];
            $tbody[] = $key['lob'];
            $tbody[] = $key['nama_asuransi'];
            $tbody[] = $key['nama'];
            $tbody[] = $key['nama'];
            $tbody[] = $key['premium'];
            $tbody[] = $key['nama'];
            $tbody[] = $key['nama'];
            $tbody[] = $key['nama'];
            
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


}

/* End of file Finance.php */
