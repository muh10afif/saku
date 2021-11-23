<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Entry_claim extends CI_Controller {

    // 27-09-2021
    public function __construct() {
        parent::__construct();
        $this->load->model('M_entry_claim', 'entry_claim');
    
        $this->aksi_crud        = get_role($this->session->userdata('id_level_otorisasi'));
        $this->id_lvl_otorisasi = $this->session->userdata('id_level_otorisasi');
    
        if($this->session->userdata('username') == "") {
          redirect(base_url(), 'refresh');
        }
    
        $url = $this->db->get('m_setting')->row_array();

        $this->url_up   = $url['url_uploads'];
        $this->url_img  = $url['url_images'];
      }

    public function index()
    {
        $data = ['title'             => 'Entry Claim',
                 'role'              => $this->aksi_crud,
                 'id_lvl_otorisasi'  => $this->id_lvl_otorisasi,
                 'id_user'           => $this->session->userdata('sesi_id')
                ];

        $this->template->load('template/index', 'V_lihat', $data);
    }

    public function tampil_data_entry()
    {
        $read               = $this->input->post('read');
        $create             = $this->input->post('create');
        $update             = $this->input->post('update');
        $delete             = $this->input->post('delete');
        $id_user            = $this->input->post('id_user');
        $id_lvl_otorisasi   = $this->input->post('id_lvl_otorisasi');

        if ($read == 'true' || $id_lvl_otorisasi == 0) {
        $list = $this->entry_claim->get_data_claim();
        } else {
        $list = [];
        }

        $data = array();

        $no   = $this->input->post('start');

        foreach ($list as $o) {
            $no++;
            $tbody = array();

            if ($o['status_klaim'] == 3) {
                $aksi = 'ajukan_kembali';
                $txt  = "Ajukan Kembali";
            } else {
                $aksi = '';
                $txt  = "Ubah";
            }

            if ($id_lvl_otorisasi == 0) {
            $detail = "<span style='cursor:pointer' class='mr-3 text-dark detail ttip' data-toggle='tooltip' data-placement='top' title='Detail' data-id='".$o['id_data_klaim']."'><i class='fas fa-info-circle fa-lg'></i></span>";
            $a1 = "<span style='cursor:pointer' class='mr-3 text-primary edit ttip' data-toggle='tooltip' data-placement='top' title='".$txt."' data-id='".$o['id_data_klaim']."' ttd='".$o['ttd']."' aksi='".$aksi."'><i class='fas fa-pencil-alt fa-lg'></i></span>";
            $a2 = "<span style='cursor:pointer' class='text-danger hapus ttip' data-toggle='tooltip' data-placement='top' title='Hapus' data-id='".$o['id_data_klaim']."'><i class='far fa-trash-alt fa-lg'></i></span>";
            } else {
            if ($update == 'true') {

                if ($delete == 'true') {
                $mrd = "mr-3";
                } else {
                $mrd = "";
                }

                $a1 = "<span style='cursor:pointer' class='".$mrd." text-primary edit ttip' data-toggle='tooltip' data-placement='top' title='".$txt."' data-id='".$o['id_data_klaim']."' ttd='".$o['ttd']."' aksi='".$aksi."'><i class='fas fa-pencil-alt fa-lg'></i></span>";
                $up = true;
            } else {
                $a1 = "";
                $up = false;
            }

            if ($delete == 'true') {
                $a2 = "<span style='cursor:pointer' class='text-danger hapus ttip' data-toggle='tooltip' data-placement='top' title='Hapus' data-id='".$o['id_data_klaim']."'><i class='far fa-trash-alt fa-lg'></i></span>";
                $del = true;
            } else {
                $a2 = "";
                $del = false;
            }

            if ($up == true || $del == true) {
                $mr = 'mr-3';
            } else {
                $mr = "";
            }
                $detail = "<span style='cursor:pointer' class='".$mr." text-dark detail ttip' data-toggle='tooltip' data-placement='top' title='Detail' data-id='".$o['id_data_klaim']."'><i class='fas fa-info-circle fa-lg'></i></span>";
            }

            if ($o['status_klaim'] == 0) {
                $status = "<span style='cursor:pointer' class='badge badge-warning text-center ml-2 ubah_status_klaim' data-id='".$o['id']."' id_data_klaim='".$o['id_data_klaim']."' nama_nasabah='".$o['nama']."' no_polis='".$o['no_polis']."' status_klaim='".$o['status_klaim']."' alasan_tolak='".$o['alasan_tolak']."' nilai_ptg='".$o['nilai']."'>Diajukan</span>";
            } elseif ($o['status_klaim'] == 1) {
                $status = "<span style='cursor:pointer' class='badge badge-primary text-center ml-2 ubah_status_klaim' data-id='".$o['id']."' id_data_klaim='".$o['id_data_klaim']."' nama_nasabah='".$o['nama']."' no_polis='".$o['no_polis']."' status_klaim='".$o['status_klaim']."' alasan_tolak='".$o['alasan_tolak']."' nilai_ptg='".$o['nilai']."'>Disetujui</span>";
            } elseif ($o['status_klaim'] == 2) {
                $status = "<span style='cursor:pointer' class='badge badge-primary text-center ml-2 ubah_status_klaim' data-id='".$o['id']."' id_data_klaim='".$o['id_data_klaim']."' nama_nasabah='".$o['nama']."' no_polis='".$o['no_polis']."' status_klaim='".$o['status_klaim']."' alasan_tolak='".$o['alasan_tolak']."' nilai_ptg='".$o['nilai']."'>Dicairkan</span>";
            } elseif ($o['status_klaim'] == 3) {
                $status = "<span style='cursor:pointer' class='badge badge-danger text-center ml-2 ubah_status_klaim' data-id='".$o['id']."' id_data_klaim='".$o['id_data_klaim']."' nama_nasabah='".$o['nama']."' no_polis='".$o['no_polis']."' status_klaim='".$o['status_klaim']."' alasan_tolak='".$o['alasan_tolak']."' nilai_ptg='".$o['nilai']."'>Ditolak</span>";
            }

            $tbody[]    = "<div align='center'>".$no.".</div>";
            $tbody[]    = date("d-m-Y", strtotime($o['claim_date']));
            $tbody[]    = $o['no_polis'];
            $tbody[]    = $o['klaim_nomor_dok'];
            $tbody[]    = $o['manfaat'];
            $tbody[]    = $status;
            $tbody[]    = $detail.$a1.$a2;
            $data[]     = $tbody;
        }

        if ($read == 'true' || $id_lvl_otorisasi == 0) {
            $recordsTotal       = $this->entry_claim->jumlah_semua_claim();
            $recordsFiltered    = $this->entry_claim->jumlah_filter_claim();
        } else {
            $recordsTotal       = 0;
            $recordsFiltered    = 0;
        }

        $output = [ "draw"             => $_POST['draw'],
                    "recordsTotal"     => $recordsTotal,
                    "recordsFiltered"  => $recordsFiltered,   
                    "data"             => $data
                ];

        echo json_encode($output);
    }

    // 14-10-2021
    public function detail_klaim($id_data_klaim)
    {
        $cr     = $this->entry_claim->cari_data('tr_data_klaim', ['id_data_klaim' => $id_data_klaim])->row_array();

        $list   = $this->entry_claim->cari_sppa($cr['id_tr_sppa_quotation'])->row_array();

        $id_user = $this->entry_claim->cari_data('m_user', ['id_pengguna_tertanggung' => $list['id_pengguna_tertanggung']])->row_array();

        $data = ['title'        => 'Detail Klaim',
                 'id_user'      => $id_user['id_user'],
                 'list'         => $list,
                 'ahli_waris'   => $this->entry_claim->cari_ahli_waris($cr['id_tr_sppa_quotation'])->result_array(),
                 'dok_klaim'    => $this->entry_claim->cari_dok_klaim($id_data_klaim)->result_array(),
                 'url_img'      => $this->url_img
                ];

        $this->template->load('template/index', 'V_detail', $data);
        
    }

    public function klaim_nomor_dok()
    {
        $this->db->order_by('id_data_klaim', 'desc');
        $cari = $this->db->get('tr_data_klaim')->row_array();
        if (!empty($cari)) {
            $a = strpos($cari['klaim_nomor_dok'],'M');
            $b = strlen($cari['klaim_nomor_dok']);
            $c = substr($cari['klaim_nomor_dok'], $a + 2, $b);
            $w = (int) $c + 1;
            $kd = str_pad($w, 6, "0", STR_PAD_LEFT);
        } else {
            $kd = str_pad(1, 6, "0", STR_PAD_LEFT);
        }
        return "KLM".$kd;
      
    }

    // 28-09-2021
    public function tambah_claim()
    {
        $data = ['title'                => 'Form Entry Claim',
                 'role'                 => $this->aksi_crud,
                 'id_lvl_otorisasi'     => $this->id_lvl_otorisasi,
                 'id_user'              => $this->session->userdata('sesi_id'),
                 'klaim_nomor_dok'      => $this->klaim_nomor_dok(),
                 'tanggal_klaim'        => date("d F Y", now('Asia/Jakarta')),
                 'list_polis'           => $this->entry_claim->list_polis()->result_array(),
                 'bank'                 => $this->entry_claim->get_data_order('m_bank', 'nama_bank', 'asc')->result_array(),
                 'list_dokumen'         => $this->entry_claim->get_data_order('m_dokumen_klaim', 'id', 'asc')->result_array()
                ];

        $this->template->load('template/index', 'V_tambah_data', $data);
    }

    public function tes()
    {
        // $a = 'Meninggal Dunia akibat kecelakaan';

        // if (strpos($a, 'sakit') !== false) {
        //     echo 'true';
        // } else {
        //     echo 'false';
        // }

        $cari_manfaat = $this->entry_claim->cari_data('m_manfaat', ['id' => 3])->row_array();

        $mn = $cari_manfaat['manfaat'];

        $panjang_str = strpos($mn, 'sakit');
        // echo "<br>";

        if ($panjang_str) {
            echo "true";
        } else {
            echo "false";
        }
    }

    public function get_detail_polis()
    {
        $id_sppa = $this->input->post('id_sppa');

        $option             = "<option value=''>Pilih Tipe Klaim</option>";
        $list               = [];
        $tgl_awal_polis     = "";
        $tgl_akhir_polis    = "";
        $premi              = "";

        if ($id_sppa != '') {
            $list       = $this->entry_claim->cari_detail_polis($id_sppa)->row_array();
            $l_manfaat  = $this->entry_claim->cari_data('m_manfaat', ['id_produk_asuransi' => $list['id_produk_asuransi']])->result_array();

            foreach ($l_manfaat as $m) {
                $option .= "<option value='".$m['id']."'>".$m['manfaat']."</option>";
            }

            $tgl_awal_polis     = date("d-m-Y", strtotime($list['tgl_awal_polis']));
            $tgl_akhir_polis    = date("d-m-Y", strtotime($list['tgl_akhir_polis']));
            $premi              = number_format($list['premi'], 0,'.','.');
        }
        
        echo json_encode(['option' => $option, 'list' => $list, 'tgl_awal_polis' => $tgl_awal_polis, 'tgl_akhir_polis' => $tgl_akhir_polis, 'premi' => $premi]);
    }

    // 29-09-2021
    public function get_detail_pengguna_ptg()
    {
        $id_pengguna_ptg = $this->input->post('id_pengguna_ptg');

        $list = $this->entry_claim->get_detail_pengguna($id_pengguna_ptg)->row_array();

        echo json_encode(['list' => $list, 'tgl_lahir'  => date("d-m-Y", strtotime($list['tgl_lahir']))]);
    }

    public function coba_simpan_sg()
    {

        // folder where signature will be stored
        $id = "55";
        // $folderPath = "upload/user_$id/";
        // $folderPath = "https://api.syariahasuransiku.app/static/dokumen_klaim/user_55/";
        $folderPath = "../../../home/saku/saku_api/_app/static/dokumen_klaim/user_55/";

        // if (!file_exists($folderPath)) {
        //     mkdir($folderPath, 0777, true);
        // }

        // mkdir($folderPath, 0777, true);
        // chmod($folderPath, 0777);

        echo $this->input->post('signed');
        

        exit();
        
        // break the encoded image string
        $image_parts = explode(";base64,", $_POST['signed']);

        // get image type
        $image_type_aux = explode("image/", $image_parts[0]);
        $image_type = $image_type_aux[1];

        // get image data
        $image_base64 = base64_decode($image_parts[1]);

        // create a unique image name
        $image_name = uniqid().time(). '.'.$image_type;

        // concatenate image with the uploads directory
        $file = $folderPath . $image_name;

        // dynamically create an image file
        if(!file_put_contents($file, $image_base64)){
            echo json_encode(['status' => 'Error! the image is not created']);
        } else {
            echo json_encode(['status' => TRUE]);
        }
    }

    public function form_ttd()
    {
        $this->template->load('template/index','Test_ttd');
    }

    public function server_ttd()
    {
        // folder where signature will be stored
        // $folderPath = "uploads/";
        // $folderPath = "../saku_api/_app/static/dokumen_klaim/user_12/";
        $folderPath = $this->url_up."dokumen_klaim/user_12/";

        $signed = $this->input->post('signed');

        $ttr_sig = str_replace('[removed]', "data:image/png;base64,", $signed);
        
        // break the encoded image string
        // $image_parts = explode(";base64,", $_POST['signed']);
        $image_parts = explode(";base64,", $ttr_sig);

        // get image type
        $image_type_aux = explode("image/", $image_parts[0]);
        $image_type = $image_type_aux[1];

        // get image data
        $image_base64 = base64_decode($image_parts[1]);

        // create a unique image name
        $image_name     = uniqid().time(). '.'.$image_type;

        // concatenate image with the uploads directory
        $file   = $folderPath . $image_name;

        // dynamically create an image file
        if(!file_put_contents($file, $image_base64)){
            echo json_encode(['status' => 'Error! the image is not created']);
        } else {
            echo json_encode(['status' => 'sukses']);
        }
    }

    // 26-10-2021
    public function random_strings($length_of_string)
    {
        $str_result = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
        
        return substr(str_shuffle($str_result), 0, $length_of_string);
    }

    // 21-10-2021
    public function simpan_claim()
    {
        $id_data_klaim              = $this->input->post('id_data_klaim');        
        $klaim_nomor_dok            = $this->input->post('klaim_nomor_dok');        
        $id_pengguna_tertanggung    = $this->input->post('id_pengguna_tertanggung');        
        $id_sppa                    = $this->input->post('nomor_polis');        
        $id_manfaat                 = $this->input->post('id_manfaat');        
        $nama_pemohon               = $this->input->post('nama_pemohon');        
        $alamat_pemohon             = $this->input->post('alamat_pemohon');        
        $tgl_waktu_kejadian         = $this->input->post('tgl_waktu_kejadian');        
        $lokasi_kejadian            = $this->input->post('lokasi_kejadian');        
        $penyebab_kejadian          = $this->input->post('penyebab_kejadian');        
        $signed                     = $this->input->post('signed');        
        $no_rekening                = $this->input->post('no_rekening');        
        $nama_pemilik_rekening      = $this->input->post('nama_pemilik_rekening');        
        $bank                       = $this->input->post('bank');
        
        $this->db->trans_begin();

            // cari id_user
            $cari       = $this->entry_claim->cari_data('m_user', ['id_pengguna_tertanggung' => $id_pengguna_tertanggung])->row_array();
            $id_user    = $cari['id_user'];

            // $folderPath = $this->url_img.'dokumen_klaim/user_'.$id_user.'/';
            // $folderPath = 'upload/dokumen_klaim/user_'.$id_user.'/';
            $folderPath = $this->url_up."dokumen_klaim/user_".$id_user."/";

            if (!file_exists($folderPath)) {
                mkdir($folderPath, 0777, true);
                chmod($folderPath, 0777);
            }

            $ttr_sig = str_replace('[removed]', "data:image/png;base64,", $signed);
            
            // break the encoded image string
            $image_parts = explode(";base64,", $ttr_sig);

            $image_type_aux = explode("image/", $image_parts[0]);
            $image_type     = $image_type_aux[1];

            $image_base64 = base64_decode($image_parts[1]);

            $ttd_name = $this->random_strings(8). '.'.$image_type;

            $file = $folderPath . $ttd_name;

            if(!file_put_contents($file, $image_base64, FILE_APPEND)){
                echo json_encode(['status' => 'upload_gagal']);
                exit();
            } 

            $data_klaim = [ 'id_tr_sppa_quotation'   => $id_sppa,
                            'tgl_kejadian'           => date("Y-m-d H:i:s", strtotime($tgl_waktu_kejadian)),
                            'status_klaim'           => 0,
                            'lokasi_kejadian'        => $lokasi_kejadian,
                            'penyebab'               => $penyebab_kejadian,
                            'nama_pemohon'           => $nama_pemohon,
                            'alamat_pemohon'         => $alamat_pemohon,
                            'ttd'                    => $ttd_name,
                            'id_manfaat'             => $id_manfaat,
                            'klaim_nomor_dok'        => $klaim_nomor_dok,
                            'add_time'               => date("Y-m-d H:i:s", now('Asia/Jakarta')),
                            'add_by'                 => $id_user
                        ];

            $this->db->insert('tr_data_klaim', $data_klaim);
            $id_klaim = $this->db->insert_id();

            $data_pembayaran = ['id_data_klaim'         => $id_klaim,
                                'no_rekening'           => $no_rekening,
                                'bank'                  => $bank,
                                'nama_pemilik_rekening' => $nama_pemilik_rekening,
                                'add_by'                => $id_user,
                                'add_time'              => date("Y-m-d H:i:s", now('Asia/Jakarta'))
                                ];

            $this->db->insert('tr_pembayaran_klaim', $data_pembayaran);

            $list_dok_klaim = $this->entry_claim->get_data_order('m_dokumen_klaim', 'id', 'asc')->result_array();

            $config['upload_path']      = $folderPath;
            $config['allowed_types']    = 'PNG|png|jpeg|jpg'; 

            $this->load->library('upload', $config);

            foreach ($list_dok_klaim as $dk) {

                $file = $_FILES['image'.$dk['id']]['tmp_name'];

                if ($file) {
                    if ( ! $this->upload->do_upload('image'.$dk['id'])) {

                        $status     = "error";
                        $msg        = $this->upload->display_errors();

                        echo json_encode(['status' => 'tipe_salah']);
                        exit();
            
                    } else {
                        
                        $dataupload = $this->upload->data();
                        $nama_file  = $dataupload['file_name'];

                        $data_dokumen[] = [ 'id_data_klaim'     => $id_klaim,
                                            'nama_file'         => $nama_file,
                                            'id_dokumen_klaim'  => $dk['id'],
                                            'status'            => 1,
                                            'add_by'            => $id_user,
                                            'add_time'          => date("Y-m-d H:i:s", now('Asia/Jakarta'))
                                        ];

                    }
                }   
                
            }

            $this->db->insert_batch('tr_dokumen_klaim', $data_dokumen);

        if($this->db->trans_status() === FALSE){
            $this->db->trans_rollback();
        
            echo json_encode(['status' => false]);
        }else{
            $this->db->trans_commit();

            echo json_encode(['status' => true]);
        }
    }

    // 26-10-2021
    public function simpan_ubah_claim()
    {
        $id_klaim                   = $this->input->post('id_data_klaim');        
        $status_klaim               = $this->input->post('status_klaim');        
        $klaim_nomor_dok            = $this->input->post('klaim_nomor_dok');        
        $id_pengguna_tertanggung    = $this->input->post('id_pengguna_tertanggung');        
        $id_sppa                    = $this->input->post('nomor_polis');        
        $id_manfaat                 = $this->input->post('id_manfaat');        
        $nama_pemohon               = $this->input->post('nama_pemohon');        
        $alamat_pemohon             = $this->input->post('alamat_pemohon');        
        $tgl_waktu_kejadian         = $this->input->post('tgl_waktu_kejadian');        
        $lokasi_kejadian            = $this->input->post('lokasi_kejadian');        
        $penyebab_kejadian          = $this->input->post('penyebab_kejadian');        
        $signed                     = $this->input->post('signed');        
        $no_rekening                = $this->input->post('no_rekening');        
        $nama_pemilik_rekening      = $this->input->post('nama_pemilik_rekening');        
        $bank                       = $this->input->post('bank');

        
        $this->db->trans_begin();

            $where = ['id_data_klaim'   => $id_klaim];

            // cari data klaim sebelumnya
            $cari_klaim = $this->entry_claim->cari_data('tr_data_klaim', $where)->row_array(); 

            // cari id_user
            $cari       = $this->entry_claim->cari_data('m_user', ['id_pengguna_tertanggung' => $id_pengguna_tertanggung])->row_array();
            $id_user    = $cari['id_user'];

            // $folderPath = $this->url_img.'dokumen_klaim/user_'.$id_user.'/';
            // $folderPath = 'upload/dokumen_klaim/user_'.$id_user.'/';
            $folderPath = $this->url_up."dokumen_klaim/user_".$id_user."/";

            if ($signed != '') {
                if (!file_exists($folderPath)) {
                    mkdir($folderPath, 0777, true);
                    chmod($folderPath, 0777);
                }

                $ttr_sig = str_replace('[removed]', "data:image/png;base64,", $signed);
                
                // break the encoded image string
                $image_parts = explode(";base64,", $ttr_sig);

                $image_type_aux = explode("image/", $image_parts[0]);
                $image_type     = $image_type_aux[1];

                $image_base64 = base64_decode($image_parts[1]);

                $ttd_name = uniqid().time(). '.'.$image_type;

                $file = $folderPath . $ttd_name;

                if(!file_put_contents($file, $image_base64, FILE_APPEND)){
                    echo json_encode(['status' => 'upload_gagal']);
                    exit();
                } 

                $nama_ttd = $ttd_name;
            } else {
                $nama_ttd = $cari_klaim['ttd'];
            }

            $data_klaim = [ 'tgl_kejadian'           => date("Y-m-d H:i:s", strtotime($tgl_waktu_kejadian)),
                            'status_klaim'           => $status_klaim,
                            'lokasi_kejadian'        => $lokasi_kejadian,
                            'penyebab'               => $penyebab_kejadian,
                            'nama_pemohon'           => $nama_pemohon,
                            'alamat_pemohon'         => $alamat_pemohon,
                            'ttd'                    => $nama_ttd,
                            'id_manfaat'             => $id_manfaat,
                            'updated_time'           => date("Y-m-d H:i:s", now('Asia/Jakarta')),
                            'updated_by'             => $this->session->userdata('sesi_id')
                        ];

            $this->entry_claim->ubah_data('tr_data_klaim', $data_klaim, $where);

            $data_pembayaran = ['no_rekening'           => $no_rekening,
                                'bank'                  => $bank,
                                'nama_pemilik_rekening' => $nama_pemilik_rekening,
                                'updated_by'            => $this->session->userdata('sesi_id'),
                                'updated_time'          => date("Y-m-d H:i:s", now('Asia/Jakarta'))
                                ];

            $this->entry_claim->ubah_data('tr_pembayaran_klaim', $data_pembayaran, $where);

            // cari manfaat
            $cari_manfaat = $this->entry_claim->cari_data('m_manfaat', ['id' => $id_manfaat])->row_array();

            $mn = $cari_manfaat['manfaat'];

            $panjang_str = strpos($mn, 'sakit');

            if ($panjang_str) {
                $list_dok_klaim = $this->entry_claim->cari_data_order('m_dokumen_klaim', ['kematian_akibat_sakit' => 1], 'id', 'asc')->result_array();
            } else {
                $list_dok_klaim = $this->entry_claim->cari_data_order('m_dokumen_klaim', ['kematian_akibat_kecelakaan' => 1], 'id', 'asc')->result_array();
            }

            // print_r($id_manfaat);
            // echo "<br>";
            // print_r($cari_manfaat);
            // exit();

            // $list_dok_klaim = $this->entry_claim->get_data_order('m_dokumen_klaim', 'id', 'asc')->result_array();

            $config['upload_path']      = $folderPath;
            $config['allowed_types']    = 'PNG|png|jpeg|jpg'; 

            $this->load->library('upload', $config);

            foreach ($list_dok_klaim as $dk) {

                $cari_dok = $this->entry_claim->cari_data('tr_dokumen_klaim', ['id_data_klaim' => $id_klaim, 'id_dokumen_klaim' => $dk['id'], 'status' => 1])->row_array();

                    $file = $_FILES['image'.$dk['id']]['tmp_name'];

                    if ($file) {
                        if ( ! $this->upload->do_upload('image'.$dk['id'])) {

                            $status     = "error";
                            $msg        = $this->upload->display_errors();

                            echo json_encode(['status' => 'tipe_salah']);
                            exit();
                
                        } else {

                            $dataupload = $this->upload->data();
                            $nama_file  = $dataupload['file_name'];

                            if (!empty($cari_dok)) {

                                $data_dokumen  = [  'nama_file'         => $nama_file,
                                                    'updated_by'        => $this->session->userdata('sesi_id'),
                                                    'updated_time'      => date("Y-m-d H:i:s", now('Asia/Jakarta'))
                                                ];

                                $this->entry_claim->ubah_data('tr_dokumen_klaim', $data_dokumen, ['id' => $cari_dok['id']]);

                            } else {

                                $data_dokumen  = [  'id_data_klaim'     => $id_klaim,
                                                    'nama_file'         => $nama_file,
                                                    'id_dokumen_klaim'  => $dk['id'],
                                                    'status'            => 1,
                                                    'add_by'            => $this->session->userdata('sesi_id'),
                                                    'add_time'          => date("Y-m-d H:i:s", now('Asia/Jakarta'))
                                                ];

                                $this->entry_claim->input_data('tr_dokumen_klaim', $data_dokumen);
                        
                            }
                        }
                    }  
                

            } 

        if($this->db->trans_status() === FALSE){
            $this->db->trans_rollback();
        
            echo json_encode(['status' => false]);
        }else{
            $this->db->trans_commit();

            echo json_encode(['status' => true]);
        }
    }

    // 26-10-2021
    public function simpan_ajukan_kembali_claim()
    {
        $id_dt_klaim                = $this->input->post('id_data_klaim');        
        $status_klaim               = $this->input->post('status_klaim');        
        $klaim_nomor_dok            = $this->input->post('klaim_nomor_dok');        
        $id_pengguna_tertanggung    = $this->input->post('id_pengguna_tertanggung');        
        $id_sppa                    = $this->input->post('nomor_polis');        
        $id_manfaat                 = $this->input->post('id_manfaat');        
        $nama_pemohon               = $this->input->post('nama_pemohon');        
        $alamat_pemohon             = $this->input->post('alamat_pemohon');        
        $tgl_waktu_kejadian         = $this->input->post('tgl_waktu_kejadian');        
        $lokasi_kejadian            = $this->input->post('lokasi_kejadian');        
        $penyebab_kejadian          = $this->input->post('penyebab_kejadian');        
        $signed                     = $this->input->post('signed');        
        $no_rekening                = $this->input->post('no_rekening');        
        $nama_pemilik_rekening      = $this->input->post('nama_pemilik_rekening');        
        $bank                       = $this->input->post('bank');

        
        $this->db->trans_begin();

            $where = ['id_data_klaim'   => $id_dt_klaim];

            // cari data klaim sebelumnya
            $cari_klaim = $this->entry_claim->cari_data('tr_data_klaim', $where)->row_array(); 

            // cari id_user
            $cari       = $this->entry_claim->cari_data('m_user', ['id_pengguna_tertanggung' => $id_pengguna_tertanggung])->row_array();
            $id_user    = $cari['id_user'];

            // $folderPath = $this->url_img.'dokumen_klaim/user_'.$id_user.'/';
            // $folderPath = 'upload/dokumen_klaim/user_'.$id_user.'/';
            $folderPath = $this->url_up."dokumen_klaim/user_".$id_user."/";

            if ($signed != '') {
                if (!file_exists($folderPath)) {
                    mkdir($folderPath, 0777, true);
                    chmod($folderPath, 0777);
                }

                $ttr_sig = str_replace('[removed]', "data:image/png;base64,", $signed);
                
                // break the encoded image string
                $image_parts = explode(";base64,", $ttr_sig);

                $image_type_aux = explode("image/", $image_parts[0]);
                $image_type     = $image_type_aux[1];

                $image_base64 = base64_decode($image_parts[1]);

                $ttd_name = uniqid().time(). '.'.$image_type;

                $file = $folderPath . $ttd_name;

                if(!file_put_contents($file, $image_base64, FILE_APPEND)){
                    echo json_encode(['status' => 'upload_gagal']);
                    exit();
                } 

                $nama_ttd = $ttd_name;
            } else {
                $nama_ttd = $cari_klaim['ttd'];
            }

            // ubah status semua ke 0
            $this->entry_claim->ubah_data('tr_data_klaim', ['status_aktif' => 0], ['id_tr_sppa_quotation' => $cari_klaim['id_tr_sppa_quotation']]);

            $data_klaim = [ 'id_tr_sppa_quotation'   => $cari_klaim['id_tr_sppa_quotation'],
                            'tgl_kejadian'           => date("Y-m-d H:i:s", strtotime($tgl_waktu_kejadian)),
                            'status_klaim'           => 0,
                            'lokasi_kejadian'        => $lokasi_kejadian,
                            'penyebab'               => $penyebab_kejadian,
                            'nama_pemohon'           => $nama_pemohon,
                            'alamat_pemohon'         => $alamat_pemohon,
                            'ttd'                    => $nama_ttd,
                            'id_manfaat'             => $id_manfaat,
                            'klaim_nomor_dok'        => $cari_klaim['klaim_nomor_dok'],
                            'status_aktif'           => 1,
                            'add_time'               => date("Y-m-d H:i:s", now('Asia/Jakarta')),
                            'add_by'                 => $id_user
                        ];

            $this->db->insert('tr_data_klaim', $data_klaim);
            $id_klaim = $this->db->insert_id();

            $data_pembayaran = ['id_data_klaim'         => $id_klaim,
                                'no_rekening'           => $no_rekening,
                                'bank'                  => $bank,
                                'nama_pemilik_rekening' => $nama_pemilik_rekening,
                                'add_by'                => $this->session->userdata('sesi_id'),
                                'add_time'              => date("Y-m-d H:i:s", now('Asia/Jakarta'))
                                ];

            $this->entry_claim->input_data('tr_pembayaran_klaim', $data_pembayaran, $where);

            // input data dokumen sebelumnya
            $cr_dok_sbl = $this->entry_claim->cari_data_order('tr_dokumen_klaim', ['id_data_klaim' => $id_dt_klaim, 'status' => 1], 'id', 'asc')->result_array();

            foreach ($cr_dok_sbl as $cr) {

                $input_dok[] = ['id_data_klaim'       => $id_klaim,
                                'nama_file'           => $cr['nama_file'],
                                'id_dokumen_klaim'    => $cr['id_dokumen_klaim'],
                                'status'              => 1,
                                'add_time'            => $cr['add_time'],
                                'add_by'              => $this->session->userdata('sesi_id')
                                ];
                
            }

            $this->db->insert_batch('tr_dokumen_klaim', $input_dok);

            // cari manfaat
            $cari_manfaat = $this->entry_claim->cari_data('m_manfaat', ['id' => $id_manfaat])->row_array();

            $mn = $cari_manfaat['manfaat'];

            $panjang_str = strpos($mn, 'sakit');

            if ($panjang_str) {
                $list_dok_klaim = $this->entry_claim->cari_data_order('m_dokumen_klaim', ['kematian_akibat_sakit' => 1], 'id', 'asc')->result_array();
            } else {
                $list_dok_klaim = $this->entry_claim->cari_data_order('m_dokumen_klaim', ['kematian_akibat_kecelakaan' => 1], 'id', 'asc')->result_array();
            }

            $config['upload_path']      = $folderPath;
            $config['allowed_types']    = 'PNG|png|jpeg|jpg'; 

            $this->load->library('upload', $config);

            foreach ($list_dok_klaim as $dk) {

                $cari_dok = $this->entry_claim->cari_data('tr_dokumen_klaim', ['id_data_klaim' => $id_klaim, 'id_dokumen_klaim' => $dk['id'], 'status' => 1])->row_array();

                    $file = $_FILES['image'.$dk['id']]['tmp_name'];

                    if ($file) {
                        if ( ! $this->upload->do_upload('image'.$dk['id'])) {

                            $status     = "error";
                            $msg        = $this->upload->display_errors();

                            echo json_encode(['status' => 'tipe_salah']);
                            exit();
                
                        } else {

                            $dataupload = $this->upload->data();
                            $nama_file  = $dataupload['file_name'];

                            if (!empty($cari_dok)) {

                                $data_dokumen  = [  'nama_file'         => $nama_file,
                                                    'updated_by'        => $this->session->userdata('sesi_id'),
                                                    'updated_time'      => date("Y-m-d H:i:s", now('Asia/Jakarta'))
                                                ];

                                $this->entry_claim->ubah_data('tr_dokumen_klaim', $data_dokumen, ['id' => $cari_dok['id']]);

                            } else {

                                $data_dokumen  = [  'id_data_klaim'     => $id_klaim,
                                                    'nama_file'         => $nama_file,
                                                    'id_dokumen_klaim'  => $dk['id'],
                                                    'status'            => 1,
                                                    'add_by'            => $this->session->userdata('sesi_id'),
                                                    'add_time'          => date("Y-m-d H:i:s", now('Asia/Jakarta'))
                                                ];

                                $this->entry_claim->input_data('tr_dokumen_klaim', $data_dokumen);
                        
                            }
                        }
                    }  
                

            } 

        if($this->db->trans_status() === FALSE){
            $this->db->trans_rollback();
        
            echo json_encode(['status' => false]);
        }else{
            $this->db->trans_commit();

            echo json_encode(['status' => true]);
        }
    }

    // 25-10-2021
    public function ubah_klaim($id_data_klaim, $aksi = 'ubah')
    {
        $cari = $this->entry_claim->cari_data('tr_data_klaim', ['id_data_klaim' => $id_data_klaim])->row_array();
        $id_sppa = $cari['id_tr_sppa_quotation'];
        $id_user = $cari['add_by'];

        $data_sppa  = $this->entry_claim->cari_sppa($id_sppa)->row_array();
        $list       = $this->entry_claim->cari_detail_polis($id_sppa)->row_array();
        $l_manfaat  = $this->entry_claim->cari_data('m_manfaat', ['id_produk_asuransi' => $list['id_produk_asuransi']])->result_array();

        $opt_tipe_klaim = "<option value=''>Pilih Tipe Klaim</option>";
        foreach ($l_manfaat as $m) {

            if ($m['id'] == $data_sppa['id_manfaat']) {
                $sel = 'selected';
            } else {
                $sel = '';
            }
            
            $opt_tipe_klaim .= "<option value='".$m['id']."' $sel>".$m['manfaat']."</option>";
        }

        $cari_set = $this->entry_claim->get_data('m_setting')->row_array();

        $url_img = $cari_set['url_images'];
        
        $data = ['title'                => 'Ubah Claim',
                 'aksi'                 => $aksi,
                 'role'                 => $this->aksi_crud,
                 'id_lvl_otorisasi'     => $this->id_lvl_otorisasi,
                 'id_user'              => $this->session->userdata('sesi_id'),
                 'id_data_klaim'        => $id_data_klaim,
                 'list'                 => $data_sppa,
                 'list_dok'             => $this->entry_claim->cari_data_order('tr_dokumen_klaim', ['id_data_klaim' => $id_data_klaim, 'status' => 1], 'id', 'asc')->result_array(),
                 'opt_tipe_klaim'       => $opt_tipe_klaim,
                 'url_img'              => $url_img."dokumen_klaim/user_".$id_user."/",
                 'bank'                 => $this->entry_claim->get_data_order('m_bank', 'nama_bank', 'asc')->result_array(),
                 'list_dokumen'         => $this->entry_claim->get_data_order('m_dokumen_klaim', 'id', 'asc')->result_array()
                ];

        $this->template->load('template/index', 'V_ubah_data', $data);
    }

    // 25-10-2021
    public function hapus_klaim()
    {
        $id_data_klaim = $this->input->post('id_data_klaim');
        
        $this->db->trans_begin();

            $where = ['id_data_klaim' => $id_data_klaim];

            $cari1 = $this->entry_claim->cari_data('tr_data_klaim', $where)->row_array();
            $cari2 = $this->entry_claim->cari_data('tr_dokumen_klaim', $where)->result_array();

            $path = $this->url_up."dokumen_klaim/user_".$cari1['add_by']."/".$cari1['ttd'];
            unlink($path); 

            foreach ($cari2 as $c) {
                $path_dok = $this->url_up."dokumen_klaim/user_".$cari1['add_by']."/".$c['nama_file'];
                unlink($path_dok); 
            }

            $this->entry_claim->hapus_data('tr_data_klaim', $where);
            $this->entry_claim->hapus_data('tr_dokumen_klaim', $where);
            $this->entry_claim->hapus_data('tr_pembayaran_klaim', $where);

        if($this->db->trans_status() === FALSE){
            $this->db->trans_rollback();
        
            echo json_encode(['status' => false]);
        }else{
            $this->db->trans_commit();

            echo json_encode(['status' => true]);
        }
    }

    // 26-10-2021
    public function ubah_status_klaim()
    {
        $id_data_klaim  = $this->input->post('id_data_klaim');        
        $status_klaim   = $this->input->post('status_klaim');        
        $alasan_tolak   = $this->input->post('alasan_tolak');  
        $nilai_ptg      = $this->input->post('nilai_ptg');  

        if ($status_klaim == 2) {

            $data_p = ['tgl_bayar'      => date("Y-m-d", now('Asia/Jakarta')),
                       'nilai_bayar'    => $nilai_ptg
                    ];
            
            $this->entry_claim->ubah_data('tr_pembayaran_klaim', $data_p, ['id_data_klaim' => $id_data_klaim]);
        }      

        $data = ['status_klaim' => $status_klaim,
                 'alasan_tolak' => $alasan_tolak
                ];

        $this->entry_claim->ubah_data('tr_data_klaim', $data, ['id_data_klaim' => $id_data_klaim]);

        echo json_encode(['status' => true]);
    }

}

/* End of file Entry_claim.php */
