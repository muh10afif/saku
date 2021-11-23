<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Klaim extends CI_Controller {

    public function __construct()
	{
		parent::__construct();
        $this->load->model('m_klaim', 'klaim');
        $this->load->model('m_polis', 'pls');
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
        $data 	= [
                    'title'     => 'Klaim',
                    'polis'     => $this->klaim->polis(),
                    'list_bank' => $this->pls->cabang_bank(),
                    ];

        $this->template->load('template/index','klaim/lihat', $data);
    }
    
    // 07-Juni-2021 RFA
    public function ajaxdata()
    {
        $no   = $this->input->post('start');
        $data = $this->klaim->get_data_klaim();
    
        $datax = array();
        foreach ($data as $key) {
            $tbody = array();
    
            $no++;
            $tbody[] = '<input type="checkbox" class="check" name="verifikasi[]" value="'. $key['id_klaim'] .'">';
            $tbody[] = "<div align='center'>".$no.".</div>";
            $tbody[] = $key['no_klaim'];
            $tbody[] = $key['no_polis'];
            $tbody[] = $key['tipe_klaim'];
            $tbody[] = $key['tipe_klaim'];
            $tbody[] = number_format($key['nilai_pembiayaan'],2,",",".");
            $tbody[] = "0000-00-00";
            $tbody[] = $key['nama_nasabah'];
            $tbody[] = number_format($key['premi'],2,",",".");
            $tbody[] = $key['nama_cabang_bank'];
            $tbody[] = $key['alamat_rumah'];
            $tbody[] = '
            <span style="cursor:pointer" class="mr-2 text-primary" data-toggle="tooltip" id="idsppa" data-placement="top" title="Detail" onclick="detail('.$key['id_klaim'].')">
                <i class="fas fa-info-circle fa-lg"></i>
            </span>
            <span style="cursor:pointer" class="mr-2 text-primary" data-toggle="tooltip" id="idsppa" data-placement="top" title="Ubah" onclick="ubahklaim('.$key['id_klaim'].')">
                <i class="fas fa-pencil-alt fa-lg"></i>
            </span>
            <span style="cursor:pointer" class="text-danger" data-toggle="tooltip" id="idsppa" data-placement="top" title="Hapus" onclick="deleteklaim('.$key['id_klaim'].')">
                <i class="far fa-trash-alt fa-lg"></i>
            </span>';
            $datax[] = $tbody;
        }
    
        $output = [
            "draw"            => $_POST['draw'],
            "recordsTotal"    => $this->klaim->countallklaim(),
            "recordsFiltered" => $this->klaim->countfilterklaim(),
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

            $result = $this->klaim->updateKlaim($dv, $data);
        }
        if($result == true)
        {
            echo json_encode(['status' => 'sukses']);
        }else{
            echo json_encode(['status' => 'error']);
        }

        $result = $dataverifikasi;
    }

    // Get data No Polis
    public function getdata()
    {
        $id = $this->input->get('id_polis');
        
        $data = $this->klaim->get_data_list($id);
        $respon['no_polis'] = $data->no_polis;

        echo json_encode($respon);
    }
    
    // 15-Juni-2021 RFA
    public function tampil_detail($id)
    {
        $data = $this->klaim->showdataklaim($id);
        echo json_encode($data);
    }
    
    // 07-Juni-2021 RFA
    public function form_tambah_data()
    {
        $data 	= [ 
                    'title'             => 'Tambah Klaim',
                    'polis'             => $this->klaim->polis(),
                    'klaimtipe'         => $this->klaim->klaimtipe(),
                    'indikator'         => $this->klaim->indikator(),
                    'klasifikasiklaim'  => $this->klaim->klasifikasiklaim(),
                    'jenisklaim'        => $this->klaim->jenisklaim(),
                    
                    // 'data' => $this->pls->showpolis($id),
                    ];
                    // var_dump($data);die();

        $this->template->load('template/index','klaim/tambah', $data);
    }
    
    
    // 07-Juni-2021 RFA
    public function simpan_tambah_klaim()
    {
        
        $data['no_klaim']               = rand();
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
        $data['user_input']             = $this->session->userdata('sesi_id');
        $data['add_time']               = date('Y-m-d');

        $unggah = $this->input->post('upload');
        $dokumen = $this->input->post('dokumen');

        $result = $this->db->insert('tr_klaim', $data);

        $insert_id = $this->db->insert_id();

        $this->do_upload($unggah, $insert_id, $dokumen);

        echo json_encode(['status' => 'sukses']);
    }
    
    
    function base64_to_jpeg($base64_string, $output_file = 'kosong') 
    {

        $ifp = fopen( $output_file, 'wb' ); 
        $data = explode( ',', $base64_string );
    
        fwrite( $ifp, base64_decode( $data[ 1 ] ) );
        fclose( $ifp ); 
    
        return base64_decode($data[1]); 
    }


    function mime2ext($mime)
    {
            $all_mimes = '{"png":["image\/png","image\/x-png"],"bmp":["image\/bmp","image\/x-bmp",
            "image\/x-bitmap","image\/x-xbitmap","image\/x-win-bitmap","image\/x-windows-bmp",
            "image\/ms-bmp","image\/x-ms-bmp","application\/bmp","application\/x-bmp",
            "application\/x-win-bitmap"],"gif":["image\/gif"],"jpeg":["image\/jpeg",
            "image\/pjpeg"],"xspf":["application\/xspf+xml"],"vlc":["application\/videolan"],
            "wmv":["video\/x-ms-wmv","video\/x-ms-asf"],"au":["audio\/x-au"],
            "ac3":["audio\/ac3"],"flac":["audio\/x-flac"],"ogg":["audio\/ogg",
            "video\/ogg","application\/ogg"],"kmz":["application\/vnd.google-earth.kmz"],
            "kml":["application\/vnd.google-earth.kml+xml"],"rtx":["text\/richtext"],
            "rtf":["text\/rtf"],"jar":["application\/java-archive","application\/x-java-application",
            "application\/x-jar"],"zip":["application\/x-zip","application\/zip",
            "application\/x-zip-compressed","application\/s-compressed","multipart\/x-zip"],
            "7zip":["application\/x-compressed"],"xml":["application\/xml","text\/xml"],
            "svg":["image\/svg+xml"],"3g2":["video\/3gpp2"],"3gp":["video\/3gp","video\/3gpp"],
            "mp4":["video\/mp4"],"m4a":["audio\/x-m4a"],"f4v":["video\/x-f4v"],"flv":["video\/x-flv"],
            "webm":["video\/webm"],"aac":["audio\/x-acc"],"m4u":["application\/vnd.mpegurl"],
            "pdf":["application\/pdf","application\/octet-stream"],
            "pptx":["application\/vnd.openxmlformats-officedocument.presentationml.presentation"],
            "ppt":["application\/powerpoint","application\/vnd.ms-powerpoint","application\/vnd.ms-office",
            "application\/msword"],"docx":["application\/vnd.openxmlformats-officedocument.wordprocessingml.document"],
            "xlsx":["application\/vnd.openxmlformats-officedocument.spreadsheetml.sheet","application\/vnd.ms-excel"],
            "xl":["application\/excel"],"xls":["application\/msexcel","application\/x-msexcel","application\/x-ms-excel",
            "application\/x-excel","application\/x-dos_ms_excel","application\/xls","application\/x-xls"],
            "xsl":["text\/xsl"],"mpeg":["video\/mpeg"],"mov":["video\/quicktime"],"avi":["video\/x-msvideo",
            "video\/msvideo","video\/avi","application\/x-troff-msvideo"],"movie":["video\/x-sgi-movie"],
            "log":["text\/x-log"],"txt":["text\/plain"],"css":["text\/css"],"html":["text\/html"],
            "wav":["audio\/x-wav","audio\/wave","audio\/wav"],"xhtml":["application\/xhtml+xml"],
            "tar":["application\/x-tar"],"tgz":["application\/x-gzip-compressed"],"psd":["application\/x-photoshop",
            "image\/vnd.adobe.photoshop"],"exe":["application\/x-msdownload"],"js":["application\/x-javascript"],
            "mp3":["audio\/mpeg","audio\/mpg","audio\/mpeg3","audio\/mp3"],"rar":["application\/x-rar","application\/rar",
            "application\/x-rar-compressed"],"gzip":["application\/x-gzip"],"hqx":["application\/mac-binhex40",
            "application\/mac-binhex","application\/x-binhex40","application\/x-mac-binhex40"],
            "cpt":["application\/mac-compactpro"],"bin":["application\/macbinary","application\/mac-binary",
            "application\/x-binary","application\/x-macbinary"],"oda":["application\/oda"],
            "ai":["application\/postscript"],"smil":["application\/smil"],"mif":["application\/vnd.mif"],
            "wbxml":["application\/wbxml"],"wmlc":["application\/wmlc"],"dcr":["application\/x-director"],
            "dvi":["application\/x-dvi"],"gtar":["application\/x-gtar"],"php":["application\/x-httpd-php",
            "application\/php","application\/x-php","text\/php","text\/x-php","application\/x-httpd-php-source"],
            "swf":["application\/x-shockwave-flash"],"sit":["application\/x-stuffit"],"z":["application\/x-compress"],
            "mid":["audio\/midi"],"aif":["audio\/x-aiff","audio\/aiff"],"ram":["audio\/x-pn-realaudio"],
            "rpm":["audio\/x-pn-realaudio-plugin"],"ra":["audio\/x-realaudio"],"rv":["video\/vnd.rn-realvideo"],
            "jp2":["image\/jp2","video\/mj2","image\/jpx","image\/jpm"],"tiff":["image\/tiff"],
            "eml":["message\/rfc822"],"pem":["application\/x-x509-user-cert","application\/x-pem-file"],
            "p10":["application\/x-pkcs10","application\/pkcs10"],"p12":["application\/x-pkcs12"],
            "p7a":["application\/x-pkcs7-signature"],"p7c":["application\/pkcs7-mime","application\/x-pkcs7-mime"],
            "p7r":["application\/x-pkcs7-certreqresp"],"p7s":["application\/pkcs7-signature"],
            "crt":["application\/x-x509-ca-cert","application\/pkix-cert"],
            "crl":["application\/pkix-crl","application\/pkcs-crl"],
            "pgp":["application\/pgp"],"gpg":["application\/gpg-keys"],
            "rsa":["application\/x-pkcs7"],"ics":["text\/calendar"],
            "zsh":["text\/x-scriptzsh"],
            "cdr":["application\/cdr","application\/coreldraw","application\/x-cdr","application\/x-coreldraw","image\/cdr","image\/x-cdr","zz-application\/zz-winassoc-cdr"],
            "wma":["audio\/x-ms-wma"],"vcf":["text\/x-vcard"],"srt":["text\/srt"],"vtt":["text\/vtt"],"ico":["image\/x-icon","image\/x-ico","image\/vnd.microsoft.icon"],"csv":["text\/x-comma-separated-values","text\/comma-separated-values","application\/vnd.msexcel"],"json":["application\/json","text\/json"]}';
            $all_mimes = json_decode($all_mimes,true);
            foreach ($all_mimes as $key => $value) {
                if(array_search($mime,$value) !== false) return $key;
            }
        return false;
    }

    public function generateImageData($base64_encoded_data)
    {
        $hasil64                = $this->base64_to_jpeg($base64_encoded_data, rand().'_');
        $result                 = finfo_buffer(finfo_open(), $hasil64, FILEINFO_MIME_TYPE);
        $extension              = $this->mime2ext($result);
        $filename               = 'klaim_'.rand().'.'.$extension;
        $path                   = './upload/ajk/klaim/'.$filename;
        $imageData['image']     = $hasil64;
        $imageData['ext']       = $extension;
        $imageData['path']      = $path;
        $imageData['filename']  = $filename;

        return $imageData;

    }

    
    public function klaim_nomor_dok()
    {
        $cari = $this->outgoing->cari_data_order('dok_persyaratan_ajk', ['kode_dok_persyaratan_ajk !=' => null], 'add_time', 'desc')->row_array();
            if (!empty($cari)) {
            $a =  strpos($cari['kode_dok_persyaratan_ajk'],"M");
            $b =  strlen($cari['kode_dok_persyaratan_ajk']); 
            $c =  substr($cari['kode_dok_persyaratan_ajk'], $a + 2, $b);
            $a = (int) "$c" + 1;
                $kd = str_pad($a, 5, "0", STR_PAD_LEFT);
            } else {
                $kd = str_pad(1, 5, "0", STR_PAD_LEFT);
            }
        $thn = date('Y');
        $kode = "KLM".$kd;
        return $kode;
    }


    public function get_kode()
    {
        echo json_encode(['kode_dok_persyaratan_ajk' => $this->klaim_nomor_dok()]);
    }

    public function do_upload($uploadData = array(), $insert_id)
    {
            for ($i=0; $i < count($uploadData) ; $i++){
                $getImgData = $this->generateImageData($uploadData[$i]);
                $move_to_folder = file_put_contents($getImgData['path'],$getImgData['image']);
                $extension = $getImgData['ext'];
                $filename = $getImgData['filename'];
                $path = $getImgData['path'];
                $filesize = filesize($getImgData['path']);
                // $kode = $this->load->get_kode($uploadData[$i]);
                $hasil = '';
    
                    if($getImgData){
                        $unggah['id_dok_persyaratan_ajk']   = $insert_id;
                        $unggah['filename']                 = $filename;
                        $unggah['size']                     = $filesize;
                        // $unggah['kode_dok_persyaratan_ajk'] = $kode;
                        $unggah['status']                   = $this->session->userdata('sesi_id');
                        $unggah['add_time']                 = date('Y-m-d');
                        $unggah['add_by']                   = $this->session->userdata('sesi_id');
                        $dokumen['dokumen']                 = $this->input->post('id_polis');

                        $this->db->insert('dok_persyaratan_ajk', $unggah, $dokumen);
                    
                        redirect('outgoing/entry/lihat');
                        echo json_encode(['status' => 'sukses']);
                    }
            }
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
        $data 	= [ 
                    'title'     => 'Detail Klaim',
                    'aksi'      => $aksi,
                    'id_klaim'  => $id_klaim
                    ];
                    
        $this->template->load('template/index','klaim/detail', $data);
    }
    
    // 15-Juni-2021 RFA
    public function ajaxdatacetak()
    {
        $no   = $this->input->post('start');
        $data = $this->klaim->get_data_cetakklm();
    
        $datax = array();
        foreach ($data as $key) {
            $tbody = array();
    
            $no++;
            $tbody[] = "<div align='center'>".$no.".</div>";
            $tbody[] = $key['no_klaim'];
            $tbody[] = $key['no_polis'];
            $tbody[] = $key['tipe_klaim'];
            $tbody[] = $key['tgl_lapor'];
            $tbody[] = $key['tgl_kejadian'];
            $tbody[] = "0000-00-00";
            $tbody[] = "0000-00-00";
            $tbody[] = $key['nama_cabang_bank'];
            $tbody[] = $key['nama_nasabah'];
            $tbody[] = $key['alamat_rumah'];
            $tbody[] = '
            <a href="'.base_url().'ajk/klaim/cetak_nota/'.$key['id_klaim'].'"><button type="button" class="btn btn-info"><i class="ti-printer" ></i></button></a>
            <button type="button" class="btn btn-info"><i class="ti-info" onclick="detailcetak('.$key['id_klaim'].')"></i></button>
            ';
            $datax[] = $tbody;
        }
    
        $output = [
            "draw"            => $_POST['draw'],
            "recordsTotal"    => $this->klaim->countallcetakklm(),
            "recordsFiltered" => $this->klaim->countfiltercetakklm(),
            "data"            => $datax
        ];
        echo json_encode($output);
    }
    

    //15-Juni-2021 RFA
    public function cetak_nota($id)
    {
        $path   =   BASEPATH . 'upload/pdf';
        
        $data 	=  $this->klm->showdatacetakklm($id);
        
        $update_data = array('id_user_cetak' => $this->session->userdata('sesi_id'));
        $result = $this->klm->updateKlaim($data['id_klaim'],$update_data);
        
        $mpdf = new \Mpdf\Mpdf();
        $html = $this->load->view('klaim/cetak/nota',['data' => $data],true);
        $mpdf->WriteHTML($html);
        
        $mpdf->Output('upload/klaim/tes_MPDF.pdf','F');
        
        redirect('ajk/klaim/preview/', $data, true);
    }

    // 22-04-2021
    public function cetak()
    {
        $data 	= ['title'  => 'Cetak Nota Klaim'
                    ];

        $this->template->load('template/index','klaim/cetak/lihat', $data);
    }

    // 27-04-2021
    public function preview()
    {
        $this->load->view('klaim/cetak/preview_cetak');
        
    }

    // 22-04-2021
    public function enquiry()
    {
        $data 	= ['title'  => 'Enquiry Klaim'
                    ];

        $this->template->load('template/index','klaim/enquiry', $data);
    }

    // 15-Juni-2021 RFA
    public function ajaxdataenquiry()
    {
        $no   = $this->input->post('start');
        $data = $this->klaim->get_data_klaimenquiry();
    
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
            "recordsTotal"    => $this->klaim->countallklaimenquiry(),
            "recordsFiltered" => $this->klaim->countfilterklaimenquiry(),
            "data"            => $datax
        ];
        echo json_encode($output);
    }

    // 22-04-2021
    public function posting()
    {
        $data 	= ['title'  => 'Posting Klaim'
                    ];

        $this->template->load('template/index','klaim/posting', $data);
    }

    // 15-Juni-2021 RFA
    public function ajaxdataposting()
    {
        $no   = $this->input->post('start');
        $data = $this->klaim->get_data_postingklm();
    
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
            "recordsTotal"    => $this->klaim->countallpostingklm(),
            "recordsFiltered" => $this->klaim->countfilterpostingklm(),
            "data"            => $datax
        ];
        echo json_encode($output);
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

    
    // 18-Juni-2021 RFA
    public function ajaxdatabayar()
    {
        $no   = $this->input->post('start');
        $data = $this->klaim->get_data_klaimenquiry();
    
        $datax = array();
        foreach ($data as $key) {
            $tbody = array();
    
            $no++;
            $tbody[] = "<div align='center'>".$no.".</div><input type='hidden' name='id_k[]' value='". $key['id_klaim'] ."'>";
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
            "recordsTotal"    => $this->klaim->countallklaimenquiry(),
            "recordsFiltered" => $this->klaim->countfilterklaimenquiry(),
            "data"            => $datax
        ];
        echo json_encode($output);
    }

    
    public function editbayarklaim()
    {

        $req = $this->input->post();
        if (isset($req['id_klaim']) && count($req['id_klaim']) > 0){
            for ($i = 0 ; $i < count($req['nilai_pembayaran']) ; $i++){
                if ($req['nilai_pembayaran'][$i] != null){
                    $data['nilai_pembayaran']         = $req['nilai_pembayaran'][$i];
                    $data['tgl_pembayaran']            = $req['tgl_pembayaran'][$i];
                    $data['id_user_pembayaran']       = $this->session->userdata('sesi_id');
                    $this->db->where('id_klaim', $req['id_klaim'][$i]);
                    $this->db->update('tr_klaim', $data);      
                }
            }
        }
        echo json_encode(['status' => 'sukses']);
    }

    
    // 18-Juni-2021 RFA
    public function ajaxdatatmbhposting()
    {
        $no   = $this->input->post('start');
        $data = $this->klaim->get_data_tambahpostingklm();
    
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
            "recordsTotal"    => $this->klaim->countalltambahpostingklm(),
            "recordsFiltered" => $this->klaim->countfiltertambahpostingklm(),
            "data"            => $datax
        ];
        echo json_encode($output);
    }

    
    public function editpostingklaim()
    {
        $req = $this->input->post();
        if (isset($req['id_klaim']) && count($req['id_klaim']) > 0){
            for ($i = 0 ; $i < count($req['id_klaim']) ; $i++){
                if ($req['id_klaim'][$i] != null){
                    $data['tgl_posting']         = date('Y-m-d');
                    $this->db->where('id_klaim', $req['id_klaim'][$i]);
                    $this->db->update('tr_klaim', $data);      
                }
            }
        }
        echo json_encode(['status' => 'sukses']);
    }


}

/* End of file Klaim.php */
