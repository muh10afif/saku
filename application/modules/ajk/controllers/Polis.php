<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Reader\Csv;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;

class Polis extends CI_Controller {

    public function __construct()
	{
		parent::__construct();
        $this->load->model('m_dashboard', 'ajk');
        $this->load->model('m_polis', 'pls');
        $this->load->helper(array('url','download'));    
        $this->validcfg = array(
            array('field' => 'idcabangbank', 'label' => 'Cabang Bank', 'rules' => 'required'),
            array('field' => 'id_nasabah', 'label' => 'Nasabah', 'rules' => 'required'),
            array('field' => 'tgl_mulai', 'label' => 'Tanggal Mulai', 'rules' => 'required'),
            array('field' => 'produk', 'label' => 'Produk', 'rules' => 'required'),
            array('field' => 'rate_premi', 'label' => 'Rate Premi', 'rules' => 'required'),
            array('field' => 'premi_fax', 'label' => 'Premi Fax', 'rules' => 'required'),
        );
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
        $data 	= [
            'title'  => 'Polis',
            'list_bank' => $this->pls->cabang_bank(),
            'nasabah' => $this->pls->nasabah(),
            'coverage' => $this->pls->coverage(),
        ];

        $this->template->load('template/index','polis/lihat', $data);
    }

    //Polis
    // 02-Juni-2021 RFA
    public function ajaxdata()
    {
        $no   = $this->input->post('start');
        $data = $this->pls->get_data_polis();
    
        $datax = array();
        foreach ($data as $key) {
            $tbody = array();
    
            $no++;
            $tbody[] = '<input type="checkbox" class="check" name="verifikasi[]" value="'. $key['id_polis'] .'">';
            $tbody[] = "<div align='center'>".$no.".</div>";
            $tbody[] = $key['no_polis'];
            $tbody[] = $key['nama_nasabah'];
            $tbody[] = date('d-m-Y', strtotime($key['tgl_mulai']));
            $tbody[] = $key['lama_bulan']." ".Bulan;
            $tbody[] = number_format($key['nilai_pembiayaan'],2,",",".");
            $tbody[] = $key['rate_premi'];
            $tbody[] = number_format($key['premi'],2,",",".");
            $tbody[] = number_format($key['premi_fax'],2,",",".");
            $tbody[] = '

                <span>
                    <span style="cursor:pointer" class="mr-2 text-primary '.(count($data) > 1?'ttip':'').'" data-toggle="tooltip" id="idsppa" data-placement="top" title="Ubah" onclick="ubahpolis('.$key['id_polis'].')">
                        <i class="fas fa-pencil-alt fa-lg"></i>
                    </span>
                    <span style="cursor:pointer" class="text-danger '.(count($data) > 1?'ttip':'').'" data-toggle="tooltip" id="idsppa" data-placement="top" title="Hapus" onclick="deletepolis('.$key['id_polis'].')">
                        <i class="far fa-trash-alt fa-lg"></i>
                    </span>
                    &nbsp;
                    <span style="cursor:pointer" class="mr-2 text-primary detail '.(count($data) > 1?'ttip':'').'" data-toggle="tooltip" id="idsppa" data-placement="top" title="Detail" name="verifikasi[]" value="'. $key['id_polis'] .'" onclick="detail('.$key['id_polis'].')">
                        <i class="fas fa-info-circle fa-lg"></i>
                    </span>
                </span>
            
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

    public function download()
    {		
		force_download('/ajk/polis.xlsx',NULL);
	}	

    public function verifikasi()
    {
        $dataverifikasi = $this->input->post('ver');

        foreach ($dataverifikasi as $dv){
            
            $data['id_verifikator']   = $this->session->userdata('sesi_id');
            $data['tgl_verifikasi']   = date('Y-m-d');

            $result = $this->pls->updatePolis($dv, $data);
        }
        if($result == true)
        {
            echo json_encode(['status' => 'sukses']);
        }else{
            echo json_encode(['status' => 'error']);
        }

        $result = $dataverifikasi;
    }

    public function singleverifikasi($id)
    {
        
        $dataverifikasi = $this->input->post('ver');
        $data['id_verifikator']   = $this->session->userdata('sesi_id');
        $data['tgl_verifikasi']   = date('Y-m-d');

        $this->db->where('id_polis', $id);
        
        $result =  $this->db->update('tr_polis', $data);
        if($result == true)
            {
                echo json_encode(['status' => 'sukses']);
            }else{
                echo json_encode(['status' => 'error']);
            }
    }

    // 21-04-2021
    public function form_tambah_data()
    {
        $data 	= [
            'title'     => 'Tambah Polis',
            'list_bank' => $this->pls->cabang_bank(),
            'nasabah'   => $this->pls->nasabah(),
            'coverage'  => $this->pls->coverage(),
        ];

        $this->template->load('template/index','polis/tambah', $data);
    }

    // 02-Juni-2021 RFA
    public function simpan_tambah_polis()
    {

        $date     = date("Ymd", now('Asia/Jakarta'));
        $random   = strtoupper(bin2hex(random_bytes(4)));

        $nmr_polis = "$date.$random";
        
                $data['no_polis']               = rand();
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
        $file_mimes = array('application/octet-stream', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');

        if(isset($_FILES['berkas_excel']['name']) && in_array($_FILES['berkas_excel']['type'], $file_mimes)) {
            
            $arr_file = explode('.', $_FILES['berkas_excel']['name']);
            $extension = end($arr_file);
        
            if('csv' == $extension) {
                $reader = new \PhpOffice\PhpSpreadsheet\Reader\Csv();
            } else {
                $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
            }

            $spreadsheet = $reader->load($_FILES['berkas_excel']['tmp_name']);

            $sheetData = $spreadsheet->getActiveSheet()->toArray();
            $excel = [];

            for($i = 1;$i < count($sheetData);$i++)
            { 
                $date     = date("Ymd", now('Asia/Jakarta'));
                $random   = strtoupper(bin2hex(random_bytes(4)));
                
                $nmr_polis = "$date.$random";
                
                $data['no_polis']               = rand();
                $data['no_sertifikat']          = rand();
                $data['id_cabang_bank']         = $sheetData[$i][0];
                $data['id_nasabah']             = $sheetData[$i][1];
                $data['tgl_mulai']              = date('Y-m-d', strtotime($sheetData[$i][2]));
                $data['lama_bulan']             = $sheetData[$i][3];
                $data['produk']                 = $sheetData[$i][4];
                $data['rate_premi']             = $sheetData[$i][5];
                $data['nilai_pembiayaan']       = $sheetData[$i][6];
                $data['premi']                  = $sheetData[$i][7];
                $data['premi_fax']              = $sheetData[$i][8];
                $data['premi_rek_koran']        = $sheetData[$i][9];
                $data['add_by']                 = $this->session->userdata('sesi_id');
                $data['add_time']               = date('Y-m-d');
                $excel[] = $data;
            }
            $this->load->model('m_polis');
            $insert = $this->m_polis->insert($excel);
            
            if($insert == true)
            {
                echo json_encode(['status' => 'sukses']);
                redirect(base_url('ajk/polis'));
            }else{
                echo json_encode(['status' => 'error']);
            }
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
        $data 	= [ 
            'title'     => 'Detail Polis',
            'aksi'      => $aksi,
            'id_polis'  => $id_polis,
            'detail'    => $detail,
        ];

        $this->template->load('template/index','polis/detail', $data);
    }
    
    // 27-04-2021
    // 15-Juni-2021 RFA
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
        $this->load->view('polis/cetak/preview_cetak');
        
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

    public function ajaxdatacetak()
    {
        $no   = $this->input->post('start');
        $data = $this->pls->get_data_cetakpolis();
    
        $datax = array();
        foreach ($data as $key) {
            $tbody = array();
    
            $no++;
            $tbody[] = "<div align='center'>".$no.".</div>";
            $tbody[] = $key['no_polis'];
            $tbody[] = $key['nama_nasabah'];
            $tbody[] = date('d-m-Y', strtotime($key['tgl_mulai']));
            $tbody[] = $key['lama_bulan']. Bulan;
            $tbody[] = number_format($key['nilai_pembiayaan'],2,",",".");
            $tbody[] = $key['rate_premi'];
            $tbody[] = number_format($key['premi'],2,",",".");
            $tbody[] = number_format($key['premi_fax'],2,",",".");
            $tbody[] = $key['premi_rek_koran'];
            $tbody[] = $key['tempat_dinas'];
            $tbody[] = $key['alamat_rumah'];
            $tbody[] = '
            <span>
                <span style="cursor:pointer" class="mr-2 text-primary '.(count($data) > 1?'ttip':'').'" data-toggle="tooltip" id="idsppa" data-placement="top" title="Print">
                <a href="'.base_url().'ajk/polis/cetak_sertifikat/'.$key['id_polis'].'" target="_blank"><i class="fas fa-print fa-lg"></i></a>
                </span>
                &nbsp;
                <span style="cursor:pointer" class="mr-2 text-primary detail '.(count($data) > 1?'ttip':'').'" data-toggle="tooltip" id="idsppa" data-placement="top" title="Detail" onclick="detailcetak('.$key['id_polis'].')">
                    <i class="fas fa-info-circle fa-lg"></i>
                </span>
            </span>
            ';
            $datax[] = $tbody;
        }
    
        $output = [
            "draw"            => $_POST['draw'],
            "recordsTotal"    => $this->pls->countallcetakpolis(),
            "recordsFiltered" => $this->pls->countfiltercetakpolis(),
            "data"            => $datax
        ];
        echo json_encode($output);
    }

    public function ajaxdataposting()
    {
        $no   = $this->input->post('start');
        $data = $this->pls->get_data_postingpolis();
    
        $datax = array();
        foreach ($data as $key) {
            $tbody = array();
    
            $no++;
            $tbody[] = "<div align='center'>".$no.".</div>";
            $tbody[] = $key['no_polis'];
            $tbody[] = $key['nama_nasabah'];
            $tbody[] = $key['cabang_bank'] != null ?  $key['cabang_bank']:'-';;
            $tbody[] = $key['label'];
            $tbody[] = number_format($key['premi'],2,",",".");
            $tbody[] = $key['nama_asuransi'];
            $tbody[] = '

            <span>
                <span style="cursor:pointer" class="mr-2 text-primary '.(count($data) > 1?'ttip':'').'" data-toggle="tooltip" id="idsppa" data-placement="top" title="Print">
                <a href="'.base_url().'ajk/polis/cetak_sertifikat/'.$key['id_polis'].'" target="_blank"><i class="fas fa-print fa-lg"></i></a>
                </span>
                &nbsp;
                <span style="cursor:pointer" class="mr-2 text-primary detail '.(count($data) > 1?'ttip':'').'" data-toggle="tooltip" id="idsppa" data-placement="top" title="Detail" onclick="detailposting('.$key['id_polis'].')">
                    <i class="fas fa-info-circle fa-lg"></i>
                </span>
            </span>

            ';
            $datax[] = $tbody;
        }
    
        $output = [
            "draw"            => $_POST['draw'],
            "recordsTotal"    => $this->pls->countallpostingpolis(),
            "recordsFiltered" => $this->pls->countfilterpostingpolis(),
            "data"            => $datax
        ];
        echo json_encode($output);
    }

        //Polis
    // 02-Juni-2021 RFA
    public function ajaxsimpanposting()
    {
        $no   = $this->input->post('start');
        $data = $this->pls->get_data_simpanposting();
        $asuransi = $this->pls->asuransi();
        $req = $this->input->post(); 
    
        $datax = array();
        foreach ($data as $key) {
            $tbody = array();
    
            $no++;
            $tbody[] = "<div align='center'>".$no.".</div><input type='hidden' name='id_p[]' value='". $key['id_polis'] ."'>";
            $tbody[] = $key['no_polis'];
            $tbody[] = $key['nama_nasabah'];
            $tbody[] = $key['nama_cabang_bank'];
            $tbody[] = $key['produk'];
            $tbody[] = number_format($key['premi'],2,",",".");
            $select = '';
            $select .= '<select name="idasuransi[]" class="select2" require>';
            $select .= '<option value="">-- Pilih Cabang --</option>';
            foreach ($asuransi as $a){
                $selected_value = $a->id_asuransi == $key['id_asuransi'] ? 'selected': '';
                $select .= '<option value="'.$a->id_asuransi.'" '. $selected_value .'>'. $a->nama_asuransi .'</option>';
            }
            $select .= '</select>';
            $tbody[] = $select;
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

    
    public function editposting()
    {

        $req = $this->input->post();
        if (isset($req['id_polis']) && count($req['id_polis']) > 0){
            for ($i = 0 ; $i < count($req['id_asuransi']) ; $i++){
                if ($req['id_asuransi'][$i] != null){
                    $data['id_asuransi']         = $req['id_asuransi'][$i];
                    $this->db->where('id_polis', $req['id_polis'][$i]);
                    $this->db->update('tr_polis', $data);            
                }
            }
        }
        echo json_encode(['status' => 'sukses']);
    }


    //16-Juni-2021 RFA
    public function ajaxtambahposting()
    {
        $no   = $this->input->post('start');
        $data = $this->pls->get_data_postingpolis();
    
        $datax = array();
        foreach ($data as $key) {
            $tbody = array();
    
            $no++;
            $tbody[] = "<div align='center'>".$no.".</div>";
            $tbody[] = $key['no_polis'];
            $tbody[] = $key['nama_nasabah'];
            $tbody[] = $key['cabang_bank'];
            $tbody[] = $key['produk'];
            $tbody[] = number_format($key['premi'],2,",",".");
            $tbody[] = number_format($key['premi_fax'],2,",",".");
            $tbody[] = '
            <a href="'.base_url().'ajk/polis/cetak_sertifikat/'.$key['id_polis'].'"><button type="button" class="btn btn-info"><i class="ti-printer" data-toggle="tooltip" title="Print"></i></button></a>
            <button type="button" class="btn btn-info"><i class="ti-info" data-toggle="tooltip" title="Detail"></i></button>
            ';
            $datax[] = $tbody;
        }
    
        $output = [
            "draw"            => $_POST['draw'],
            "recordsTotal"    => $this->pls->countallpostingpolis(),
            "recordsFiltered" => $this->pls->countfilterpostingpolis(),
            "data"            => $datax
        ];
        echo json_encode($output);
    }

    // Enquiry
    // 21-04-2021
    public function enquiry()
    {
        $data 	= [
            'title'  => 'Enquiry Polis'
        ];

        $this->template->load('template/index','polis/enquiry', $data);
    }
    
    // 02-Juni-2021 RFA
    public function ajaxdataenquiry()
    {
        $no   = $this->input->post('start');
        $data = $this->pls->get_data_enquirypolis();
    
        $datax = array();
        foreach ($data as $key) {
            $tbody = array();
    
            $no++;
            $tbody[] = "<div align='center'>".$no.".</div>";
            $tbody[] = $key['no_polis'];
            $tbody[] = $key['nama_nasabah'];
            $tbody[] = date('d-m-Y', strtotime($key['tgl_mulai']));
            $tbody[] = $key['lama_bulan'].   Bulan;
            $tbody[] = number_format($key['nilai_pembiayaan'],2,",",".");
            $tbody[] = $key['rate_premi'];
            $tbody[] = number_format($key['premi'],2,",",".");
            $tbody[] = number_format($key['premi_fax'],2,",",".");
            $tbody[] = $key['id_verifikator'] != null ? 'OK':'NO';
            $tbody[] = $key['id_user'] != null ? 'OK':'NO';
            $tbody[] = '
            <span style="cursor:pointer" class="mr-2 text-primary '.(count($data) > 1?'ttip':'').'" data-toggle="tooltip" id="idsppa" data-placement="top" title="Detail" onclick="detail('.$key['id_polis'].')">
                <i class="fas fa-info-circle fa-lg"></i>
            </span>
            <a href="'.base_url()."ajk/klaim/form_tambah_data/".$key['id_polis'].'"><button type="button" class="btn btn-success mr-2">K</button></a>
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
