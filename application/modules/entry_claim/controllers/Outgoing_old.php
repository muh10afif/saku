<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Outgoing extends CI_Controller {

  var $role;
    public function __construct() {
        parent::__construct();
        $this->load->model('cob_lob/m_cob', 'cob');
        $this->load->model('entry_sppa/m_entry_sppa', 'cobs');
        $this->load->model('m_entry_claim', 'outgoing');
        $this->load->model('m_entry_claim', 'nsb');
		    $this->load->model('m_entry_claim');
        $this->load->helper('inputtype_helper');
        $this->role = get_role($this->session->userdata('id_level_otorisasi'));
        if($this->session->userdata('username') == "") {
          redirect(base_url(), 'refresh');
        }
      }


    public function index()
    {
        $this->entry();
    }


    public function entry($value='')
    {
        $data 	= [
            'title'  => 'Entry Claim',
            'list_sppa' => $this->outgoing->list_sppas(),
            // 'list_sppa'  => $this->outgoing->cari_data('tr_sppa_quotation', ['approval' => true, 'sppa_number !=' => null])->result_array(),
            'karyawan'  => $this->outgoing->cari_data_karyawan('m_karyawan')->result_array(),
            'list_nasabah' => $this->nsb->list_nasabah(),
            // 'karyawan' => $this->outgoing->showdatakaryawan(),
                ];

        $this->template->load('template/index','outgoing/entry/lihat', $data);
    }


    public function klaim_nomor_dok()
    {
      
      $cari = $this->outgoing->cari_data_order('tr_data_klaim', ['klaim_nomor_dok !=' => null], 'add_time', 'desc')->row_array();

        if (!empty($cari)) {
        $a =  strpos($cari['klaim_nomor_dok'],"M");
        $b =  strlen($cari['klaim_nomor_dok']); 

        $c =  substr($cari['klaim_nomor_dok'], $a + 2, $b);

        $a = (int) "$c" + 1;

            $kd = str_pad($a, 5, "0", STR_PAD_LEFT);
        } else {
            $kd = str_pad(1, 5, "0", STR_PAD_LEFT);
        }

      $thn = date('Y');

      $kode = "KLM".$kd;

      return $kode;
    }


    // 19-05-2021
    public function get_kode()
    {
      echo json_encode(['klaim_nomor_dok' => $this->klaim_nomor_dok()]);
    }
    


    public function outgoing_code($value='')
    {
      
      $kode = codegenerate('tr_data_klaim','KLM','outgoing','M');
      echo $kode;
    }


    public function showfild($id)
    {
      $this->db->join('tr_sppa_quotation', 'tr_sppa_quotation.id_cob = m_cob.id_cob');
      $this->db->where('tr_sppa_quotation.id_cob', $id);
      $hasil = $this->db->get('tr_sppa_quotation')->result();
      $data = array();
      foreach ($hasil as $key) {
        $this->db->where('id_field_sppa', $key->type_field);
        $hass = $this->db->get('m_field_sppa')->result();
        $iss = array();
        $list['id_lob']               = $key->id_lob;
        $list['fieldnm']              = $hass[0]->field_sppa;
        $list['input_type']           = $key->input_type;
        $list['key_to_param']         = $key->key_to_param;
        $list['if_input_type_select'] = json_decode($key->if_input_type_select, true);
        $iss[] = forinput($list);
        $data[] = $iss;
      }
      echo json_encode($data);
    }
    

    public function ajaxdata($action)
    {
      /*
        rulenya
        0 = update
        1 = delete
        2 = detail atau approve atau custom
      */
      $permisi = explode('_',$action);
      $b1 = ''; $b2 = ''; $b3 = '';
  
      $no   = $this->input->post('start');
      $data = $this->outgoing->get_data_outgoing();

      $datax = array();
      foreach ($data as $key) {
        $tbody = array();

        $no++;
        $tbody[] = "<div align='center'>".$no.".</div>";
        $tbody[] = date('d-m-Y', strtotime($key['tgl_klaim']));
        $tbody[] = $key['no_binding'] != null ? $key['no_binding']:'-';
        $tbody[] = $key['tipe_klaim'] == null ? '-':'-';
        $tbody[] = number_format($key['nilai_klaim'],2,",",".");
        $tbody[] = $key['status_klaim'] == null ? '-':'-';

        if ($permisi[2] == 'true' || $action == '_') {
          $b3 = '<span style="cursor:pointer" class="mr-2 text-primary" data-toggle="tooltip" id="idsppa" data-placement="top" title="Detail" onclick="lihatdetail('.$key['id_data_klaim'].')">
                    <i class="fas fa-info-circle fa-lg"></i>
                  </span>';
        }
        if ($permisi[0] == 'true' || $action == '_') {
          $b1 = '<span style="cursor:pointer" class="mr-2 text-primary" data-toggle="tooltip" id="idsppa" data-placement="top" title="Ubah" onclick="ubahubah('.$key['id_data_klaim'].')">
                  <i class="fas fa-pencil-alt fa-lg"></i>
                </span>';
        }
        if ($permisi[1] == 'true' || $action == '_') {
          $b2 = ' <span style="cursor:pointer" class="text-danger" data-toggle="tooltip" id="idsppa" data-placement="top" title="Hapus" onclick="deletedel('.$key['id_data_klaim'].')">
                    <i class="far fa-trash-alt fa-lg"></i>
                  </span>';
        }
        $tbody[] = $b3.$b1.$b2;
        $datax[] = $tbody;
      }

      $output = [
        "draw"            => $_POST['draw'],
        "recordsTotal"    => $this->outgoing->countalllistout(),
        "recordsFiltered" => $this->outgoing->countfilterlistout(),
        "data"            => $datax
      ];
      echo json_encode($output);
    }


    public function tampil_data_dokumen()
    {
        $id_sppa = $this->input->post('id_data_klaim');

        if ($id_sppa) {
        $list = $this->cobs->cari_data_order('dokumen_klaim', ['id_data_klaim' => $id_sppa], 'add_time', 'size')->result_array();

        $data = array();

        $no   = $this->input->post('start');

        foreach ($list as $o) {
            $no++;
            $tbody = array();

            $tbody[]    = "<div align='center'>".$no.".</div>";
            $tbody[]    = $o['nama_file'];
            $tbody[]    = $o['size'];
            $tbody[]    = "<a href='".base_url()."upload/outgoing/".$o['nama_file']."'><i class='mdi mdi-file-document-outline mdi-24px'></i></a>";
            $data[]     = $tbody;
        }
        
        echo json_encode(['data' => $data]);
        } else {
        echo json_encode(['data' => []]);
        }

    }


    public function tampil_data_dokumen2()
    {
        $id_sppa = $this->input->post('id_data_klaim');

        if ($id_sppa) {
        $list = $this->cobs->cari_data_order('dokumen_klaim', ['id_data_klaim' => $id_sppa], 'add_time', 'size')->result_array();

        $data = array();

        $no   = $this->input->post('start');

        foreach ($list as $o) {
            $no++;
            $tbody = array();

            $tbody[]    = "<div align='center'>".$no.".</div>";
            $tbody[]    = $o['nama_file'];
            $tbody[]    = $o['size'];
            $tbody[]    = "Last Update ".date('d-m-Y H:i:s', strtotime($o['add_time']));
            $tbody[]    = 
            '<a href="'.base_url()."upload/outgoing/".$o['nama_file'].'"><i class="mdi mdi-file-document-outline mdi-24px" data-toggle="tooltip" title="Dokumen"></i></a>&nbsp;&nbsp;
            <i class="icon-trash-bin fa-lg text-danger mr-2" data-toggle="tooltip" title="Hapus" onclick="deletedok('.$o['id_dokumen_klaim'].')"></i>';
            $data[]     = $tbody;
        }
        
        echo json_encode(['data' => $data]);
        } else {
        echo json_encode(['data' => []]);
        }

    }


    public function add()
    {
      $check = $this->input->post();
      $data['klaim_nomor_dok'] = $this->input->post('getkode');
      $data['id_sppa'] = $this->input->post('sppaid');
      $data['pic'] = $this->input->post('pc');
      $data['id_insured'] = $this->input->post('insuredid');
      $data['keterangan_klaim'] = $this->input->post('keteranganklm');
      $data['kejadian'] = $this->input->post('kejdan');
      $data['lokasi_kejadian'] = $this->input->post('lokasikejadian');
      $data['penyebab'] = $this->input->post('sebab');
      $data['nilai_klaim'] = $this->input->post('nilaiklaim');
      $data['add_time'] = date('Y-m-d H:i:s', now('Asia/Jakarta'));
      $data['tgl_klaim'] = date('Y-m-d H:i:s', now('Asia/Jakarta'));
      $data['add_by'] = $this->session->userdata('sesi_id');
      
      $berkas = $this->input->post('berkas');
      $unggah = $this->input->post('upload');
      $deskripsi = $this->input->post('desc');

      $result = $this->db->insert('tr_data_klaim', $data);

      $insert_id = $this->db->insert_id();

      $this->do_upload($unggah, $insert_id, $deskripsi, $berkas);
      
      echo json_encode(['status' => 'sukses']);
    }
    

    public function edit($id)
    {

      $check = $this->input->post();
      $data['id_sppa'] = $this->input->post('sppaid');
      $data['pic'] = $this->input->post('pc');
      $data['id_insured'] = $this->input->post('insuredid');
      $data['keterangan_klaim'] = $this->input->post('keteranganklm');
      $data['kejadian'] = $this->input->post('kejdan');
      $data['lokasi_kejadian'] = $this->input->post('lokasikejadian');
      $data['penyebab'] = $this->input->post('sebab');
      $data['nilai_klaim'] = $this->input->post('nilaiklaim');
      $data['add_time'] = date('Y-m-d H:i:s', now('Asia/Jakarta'));
      $data['tgl_klaim'] = date('Y-m-d H:i:s', now('Asia/Jakarta'));
      
      $berkas = $this->input->post('berkas');
      $unggah = $this->input->post('upload');
      $deskripsi = $this->input->post('desc');
      
      $this->db->where('id_data_klaim', $id);
      $this->db->update('tr_data_klaim', $data);
      
      $insert_id = $this->input->post('id_data_klaim');
      // $insert_id = $this->db->insert_id();

      $this->do_upload($unggah, $insert_id, $deskripsi, $berkas);
      echo json_encode(['status' => 'sukses']);
    }


    function base64_to_jpeg($base64_string, $output_file = 'kosong') 
    {

      // $ifp = fopen( $output_file, 'wb' ); 
      $data = explode( ',', $base64_string );
  
      // fwrite( $ifp, base64_decode( $data[ 1 ] ) );
      // fclose( $ifp ); 
  
      return base64_decode($data[1]); 
    }


    //RFA
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


    public function generateImageData($base64_encoded_data, $berkas)
    {
      $hasil64 = $this->base64_to_jpeg($base64_encoded_data, rand().'_');
      $result = finfo_buffer(finfo_open(), $hasil64, FILEINFO_MIME_TYPE);
      $extension = $this->mime2ext($result);
      // $filename = 'outgoing_'.rand().'.'.$extension;
      $filename = $berkas;
      $path = './upload/outgoing/'.$filename;
      $imageData['image'] = $hasil64;
      $imageData['ext'] = $extension;
      $imageData['path'] = $path;
      $imageData['filename'] = $filename;

      // var_dump($result);die();
      return $imageData;

    }


    public function do_upload($uploadData = array(), $insert_id, $deskripsi, $berkas)
    {
    
      for ($i=0; $i < count($uploadData) ; $i++){
        $getImgData = $this->generateImageData($uploadData[$i], $berkas);
        $move_to_folder = file_put_contents($getImgData['path'],$getImgData['image']);
        $extension = $getImgData['ext'];
        $filename = $getImgData['filename'];
        $path = $getImgData['path'];
        $filesize = filesize($getImgData['path']);
        $hasil = '';
        
        // var_dump($getImgData);die();
        if($getImgData){
          $unggah['id_data_klaim'] = $insert_id;
          $unggah['nama_file'] = $filename;
          $unggah['size'] = $filesize;
          $unggah['deskripsi'] = $deskripsi;
          $unggah['add_time'] = date('Y-m-d H:i:s', now('Asia/Jakarta'));
          $unggah['add_by'] = $this->session->userdata('sesi_id');
          
          $this->db->insert('dokumen_klaim', $unggah);
        
          redirect('outgoing/entry/lihat');
          echo json_encode(['status' => 'sukses']);
        
        }
      } //for
      
    }


    public function upload()
    {
        $data 	= [
                    'title'  => 'Upload Data Claim'
                  ];

        $this->template->load('template/index','outgoing/upload/lihat', $data);
    }


    public function showout($id)
    {
        $data = $this->nsb->showdatabyout($id);
        echo json_encode($data);
    }

    
    public function tampil_detail($id){
      
      $data = $this->nsb->showdatabyout($id);
      echo json_encode($data);
            
    }
    

    public function getdata()
    {
      $id = $this->input->get('sppa_id');
      
      $data = $this->nsb->get_data_list($id);
      $respon['cob'] = $data->cob;
      $respon['kode_cob'] = $data->kode_cob;
      $respon['id_sppa_quotation'] = $data->id_sppa_quotation;
      $respon['lob'] = $data->lob;
      $respon['kode_lob'] = $data->kode_lob;
      $respon['id_lob'] = $data->id_lob;
      $respon['nama_asuransi'] = $data->nama_asuransi;

      echo json_encode($respon);
    }


    public function getdatainsured()
    {
      $id = $this->input->get('id_nasabah');
      
      $data = $this->nsb->showdatainsured($id);
      $respon['kode_nasabah'] = $data->kode_nasabah;
      $respon['nama_nasabah'] = $data->nama_nasabah;
      $respon['tgl_lahir'] = $data->tgl_lahir;
      $respon['tempat_dinas'] = $data->tempat_dinas;
      $respon['alamat_rumah'] = $data->alamat_rumah;
      $respon['nik'] = $data->nik;
      $respon['jenis_kelamin'] = $data->jenis_kelamin;
      $respon['telp'] = $data->telp;

      echo json_encode($respon);
    }


    public function getdatasppa()
    {
      $id = $this->input->get('sppa_id');
      
      $data = $this->nsb->get_data_list($id);
      $respon['cob'] = $data->cob;
      $respon['kode_cob'] = $data->kode_cob;
      $respon['id_sppa_quotation'] = $data->id_sppa_quotation;
      $respon['lob'] = $data->lob;
      $respon['kode_lob'] = $data->kode_lob;
      $respon['no_invoice_entry'] = $data->no_invoice_entry;
      $respon['tahun_cicilan'] = $data->tahun_cicilan;
      $respon['jumlah_cicilan'] = $data->jumlah_cicilan;
      $respon['payment_method'] = $data->payment_method;
      $respon['sppa_number'] = $data->sppa_number;
      $respon['id_lob'] = $data->id_lob;
      $respon['nama_asuransi'] = $data->nama_asuransi;
      $respon['total_tagihan'] = $data->total_tagihan;

      echo json_encode($respon);
    }


    public function remove($id)
    {
      $this->db->where('id_data_klaim',$id);
      $this->db->delete('tr_data_klaim');

      $namafile['nama_file'] = $data->nama_file;

      $path = "./upload/outgoing/".$namafile;
      unlink($path); 

      $this->db->delete('dokumen_klaim', ['id_data_klaim' => $id]);
    
      echo json_encode(['status' => 'sukses']);
    }

    public function removedok($id)
    {
      
      $this->db->where('id_dokumen_klaim',$id);
      $namafile['nama_file'] = $data->nama_file;

      $path = "./upload/outgoing/".$namafile;
      unlink($path); 

      $this->db->delete('dokumen_klaim', ['id_dokumen_klaim' => $id]);

      echo json_encode(['status' => true]);
    }

}

/* End of file Controller Outgoing.php */
