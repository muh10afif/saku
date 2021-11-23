<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Polis extends CI_Controller {

    public function __construct()
	{
		parent::__construct();
        $this->load->model('m_dashboard', 'ajk');
        $this->load->model('m_polis', 'pls');
      
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
        $data 	= ['title'  => 'Polis',
                    'list_bank' => $this->pls->cabang_bank(),
                    'list_bank' => $this->pls->cabang_bank(),
                    'nasabah' => $this->pls->nasabah(),
                    'coverage' => $this->pls->coverage(),
                    ];

        $this->template->load('template/index','polis/lihat', $data);
    }

    // 02-Juni-2021 RFA
    public function ajaxdata()
    {
        $no   = $this->input->post('start');
        $data = $this->pls->get_data_polis();
    
        $datax = array();
        foreach ($data as $key) {
            $tbody = array();
    
            $no++;
            $tbody[] = '<input type="checkbox">';
            $tbody[] = "<div align='center'>".$no.".</div>";
            $tbody[] = $key['no_polis'];
            $tbody[] = $key['nama_nasabah'];
            $tbody[] = $key['tgl_mulai'];
            $tbody[] = $key['lama_bulan'];
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
            "recordsTotal"    => $this->pls->countallpolis(),
            "recordsFiltered" => $this->pls->countfilterpolis(),
            "data"            => $datax
        ];
        echo json_encode($output);
    }

    // 21-04-2021
    public function form_tambah_data()
    {
        $data 	= ['title'  => 'Tambah Polis',
                    'list_bank' => $this->pls->cabang_bank(),
                    'nasabah' => $this->pls->nasabah(),
                    'coverage' => $this->pls->coverage(),
                    ];

        $this->template->load('template/index','polis/tambah', $data);
    }

    // 02-Juni-2021 RFA
    public function simpan_tambah_polis()
    {
        $date     = date("Ymd", now('Asia/Jakarta'));
        $random   = strtoupper(bin2hex(random_bytes(4)));

        $nmr_polis = "$date.$random";

        $data['no_polis']               = $nmr_polis;
        $data['no_sertifikat']          = rand();
        $data['id_cabang_bank']         = $this->input->post('idcabangbank');
        $data['id_nasabah']             = $this->input->post('id_nasabah');
        $data['tgl_mulai']              = $this->input->post('tgl_mulai');
        $data['lama_bulan']             = $this->input->post('lama_bulan');
        $data['produk']                 = $this->input->post('produk');
        $data['rate_premi']             = $this->input->post('rate_premi');
        $data['nilai_pembiayaan']       = $this->input->post('nilai_pembiayaan');
        $data['premi']                  = $this->input->post('premi');
        $data['premi_fax']              = $this->input->post('premi_fax');
        $data['premi_rek_koran']        = $this->input->post('premi_rek_koran');
        $data['add_by']                 = $this->session->userdata('sesi_id');
        $data['add_time']               = date('Y-m-d');

        $result = $this->db->insert('tr_polis', $data);

        echo json_encode(['status' => 'sukses']);
    }

    public function editpolis($id)
    {

        $data['id_cabang_bank']         = $this->input->post('idcabangbank');
        $data['id_nasabah']             = $this->input->post('id_nasabah');
        $data['tgl_mulai']              = $this->input->post('tgl_mulai');
        $data['lama_bulan']             = $this->input->post('lama_bulan');
        $data['produk']                 = $this->input->post('produk');
        $data['rate_premi']             = $this->input->post('rate_premi');
        $data['nilai_pembiayaan']       = $this->input->post('nilai_pembiayaan');
        $data['premi']                  = $this->input->post('premi');
        $data['premi_fax']              = $this->input->post('premi_fax');
        $data['premi_rek_koran']        = $this->input->post('premi_rek_koran');
        $data['add_time']               = date('Y-m-d');
        $this->db->where('id_polis', $id);
        $this->db->update('tr_polis', $data);
    
        echo json_encode(['status' => 'sukses']);
    }

    // 09-Juni-2021 RFA
    public function import_excel()
    {
        // $load_excel = $this->load->library('PhpSpreadsheet/Spreadsheet');
        
        $this->load->library(array('excel','session'));
		if (isset($_FILES["fileExcel"]["name"])) {
			$path = $_FILES["fileExcel"]["tmp_name"];
			$object = PHPExcel_IOFactory::load($path);
			foreach($object->getWorksheetIterator() as $worksheet)
			{
				$highestRow = $worksheet->getHighestRow();
				$highestColumn = $worksheet->getHighestColumn();	
				for($row=2; $row<=$highestRow; $row++)
				{
					$id_cabang_bank     = $worksheet->getCellByColumnAndRow(0, $row)->getValue();
					$id_nasabah         = $worksheet->getCellByColumnAndRow(1, $row)->getValue();
					$tgl_mulai          = $worksheet->getCellByColumnAndRow(2, $row)->getValue();
					$lama_bulan         = $worksheet->getCellByColumnAndRow(3, $row)->getValue();
					$produk             = $worksheet->getCellByColumnAndRow(4, $row)->getValue();
					$rate_premi         = $worksheet->getCellByColumnAndRow(5, $row)->getValue();
					$nilai_pembiayaan   = $worksheet->getCellByColumnAndRow(6, $row)->getValue();
					$premi              = $worksheet->getCellByColumnAndRow(7, $row)->getValue();
					$premi_fax          = $worksheet->getCellByColumnAndRow(8, $row)->getValue();
					$premi_rek_koran    = $worksheet->getCellByColumnAndRow(9, $row)->getValue();

					$temp_data[] = array(
						'id_cabang_bank'    => $id_cabang_bank,
						'id_nasabah'        => $id_nasabah,
						'tgl_mulai'         => $tgl_mulai,
						'lama_bulan'        => $lama_bulan,
						'produk'            => $produk,
						'rate_premi'        => $rate_premi,
						'nilai_pembiayaan'  => $nilai_pembiayaan,
						'premi'	            => $premi,
						'premi_rek_koran'	=> $premi_rek_koran,
						'premi_fax'	        => $premi_fax,
					); 	
				}
			}
			$this->load->model('m_polis');
			$insert = $this->m_polis->insert($temp_data);
			if($insert){
				$this->session->set_flashdata('status', '<span class="glyphicon glyphicon-ok"></span> Data Berhasil di Import ke Database');
				redirect($_SERVER['HTTP_REFERER']);
			}else{
				$this->session->set_flashdata('status', '<span class="glyphicon glyphicon-remove"></span> Terjadi Kesalahan');
				redirect($_SERVER['HTTP_REFERER']);
			}
		}else{
			echo "Tidak ada file yang masuk";
		}
	}

    public function getnasabah()
    {
        $id = $this->input->get('nasabahid');
        
        $data = $this->pls->getdatanasabah($id);
        
        $respon['tgl_lahir'] = $data->tgl_lahir;
        $respon['tempat_dinas'] = $data->tempat_dinas;
        $respon['alamat_rumah'] = $data->alamat_rumah;

        echo json_encode($respon);
    }

    public function getcoverage()
    {
        $id = $this->input->get('coverageid');
        
        $data = $this->pls->getdatacoverage($id);
        
        $respon['label'] = $data->label;
        $respon['rate'] = $data->rate;
        $respon['status'] = $data->status;

        echo json_encode($respon);
    }

    
    public function tampil_detail($id)
    {
    
        $data = $this->pls->showdatapolis($id);
        echo json_encode($data);
    
    }


    public function removepolis($id)
    {
        $this->db->where('id_polis',$id);
            $this->db->delete('tr_polis');
    
        echo json_encode(['status' => 'sukses']);
    }

    // 21-04-2021
    public function detail($id_polis, $id, $aksi = "")
    {
        
        $detail = $this->pls->showdatapolis($id);
        $data 	= [ 'title'     => 'Detail Polis',
                    'aksi'      => $aksi,
                    'id_polis'  => $id_polis,
                    'detail'    => $detail,
                    ];

        $this->template->load('template/index','polis/detail', $data);
    }

    
    // 27-04-2021
    public function cetak_sertifikat($id)
    {
        $path   =   BASEPATH . 'upload/pdf';

        // $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => [190, 236]]);
        $data 	=  $this->pls->showdatapolis($id);
                    // echo json_encode($data);
                    // var_dump($data['id_polis']);die();

        $mpdf = new \Mpdf\Mpdf();
        $html = $this->load->view('polis/cetak/sertifikat',['data' => $data],true);
        $mpdf->WriteHTML($html);

        
        // $mpdf->Output(); // buka dengan browser
        // $mpdf->Output('tes_MPDF.pdf','D'); // ini akan mendownload file dengan nama alaiakbar_mPDF

        // $mpdf->Output(realpath($path).'tes_MPDF.pdf','F');

        $mpdf->Output('upload/polis/tes_MPDF.pdf','F');
        
        redirect('ajk/polis/preview/', $data, true);

    }

    
    // 27-04-2021
    public function preview()
    {
        $this->load->view('polis/cetak/preview_cetak');
        
    }

    // 21-04-2021
    // 03-06-2021 RFA
    public function cetak()
    {
        $data 	= ['title'  => 'Cetak Sertifikat'
                ];

        $this->template->load('template/index','polis/cetak/lihat', $data);
    }

    public function ajaxdatacetak()
    {
        $no   = $this->input->post('start');
        $data = $this->pls->get_data_polis();
    
        $datax = array();
        foreach ($data as $key) {
            $tbody = array();
    
            $no++;
            $tbody[] = "<div align='center'>".$no.".</div>";
            $tbody[] = $key['no_polis'];
            $tbody[] = $key['nama_nasabah'];
            $tbody[] = $key['tgl_mulai'];
            $tbody[] = $key['lama_bulan'];
            $tbody[] = number_format($key['nilai_pembiayaan'],2,",",".");
            $tbody[] = $key['rate_premi'];
            $tbody[] = number_format($key['premi'],2,",",".");
            $tbody[] = number_format($key['premi_fax'],2,",",".");
            $tbody[] = $key['premi_rek_koran'];
            $tbody[] = $key['tempat_dinas'];
            $tbody[] = $key['alamat_rumah'];
            $tbody[] = '
            <a href="'.base_url().'ajk/polis/cetak_sertifikat/'.$key['id_polis'].'"><button type="button" class="btn btn-info"><i class="ti-printer" ></i></button></a>
            <button type="button" class="btn btn-info"><i class="ti-info"></i></button>
            ';
            $datax[] = $tbody;
        }
    
        $output = [
            "draw"            => $_POST['draw'],
            "recordsTotal"    => $this->pls->countallpolis(),
            "recordsFiltered" => $this->pls->countfilterpolis(),
            "data"            => $datax
        ];
        echo json_encode($output);
    }

    // 21-04-2021
    public function enquiry()
    {
        $data 	= ['title'  => 'Enquiry Polis'
                    ];

        $this->template->load('template/index','polis/enquiry', $data);
    }

    
    // 02-Juni-2021 RFA
    public function ajaxdataenquiry()
    {
        $no   = $this->input->post('start');
        $data = $this->pls->get_data_polis();
    
        $datax = array();
        foreach ($data as $key) {
            $tbody = array();
    
            $no++;
            $tbody[] = "<div align='center'>".$no.".</div>";
            $tbody[] = $key['no_polis'];
            $tbody[] = $key['nama_nasabah'];
            $tbody[] = $key['tgl_mulai'];
            $tbody[] = $key['lama_bulan'];
            $tbody[] = number_format($key['nilai_pembiayaan'],2,",",".");
            $tbody[] = $key['rate_premi'];
            $tbody[] = number_format($key['premi'],2,",",".");
            $tbody[] = number_format($key['premi_fax'],2,",",".");
            $tbody[] = "-";
            $tbody[] = "-";
            $tbody[] = '
            <button type="button" class="btn btn-info mr-2"><i class="ti-pencil" onclick="detail('.$key['id_polis'].')"></i></button>
            <a href="'.base_url()."ajk/klaim/form_tambah_data".'"><button type="button" class="btn btn-success mr-2">K</button></a>
            <a href="'.base_url()."ajk/restitusi/form_tambah_data".'"><button type="button" class="btn btn-success">R</button></a>';
            $datax[] = $tbody;
        }
    
        $output = [
            "draw"            => $_POST['draw'],
            "recordsTotal"    => $this->pls->countallpolis(),
            "recordsFiltered" => $this->pls->countfilterpolis(),
            "data"            => $datax
        ];
        echo json_encode($output);
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
