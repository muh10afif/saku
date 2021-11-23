<?php defined('BASEPATH') OR exit('No direct script access allowed');

use Xendit\Xendit;

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, OPTIONS");

class Entry_sppa extends CI_controller
{

  public function __construct() {
    parent::__construct();
    $this->load->model('M_entry_sppa', 'entry_sppa');

    $this->aksi_crud        = get_role($this->session->userdata('id_level_otorisasi'));
    $this->id_lvl_otorisasi = $this->session->userdata('id_level_otorisasi');

    $params = array('server_key' => 'Mid-server-nLWxVqauj-08_qNX7oFrPIhc', 'production' => true);
		$this->load->library('midtrans');
		$this->midtrans->config($params);

    $this->load->helper('inputtype_helper');
    if($this->session->userdata('username') == "") {
      redirect(base_url(), 'refresh');
    }

  }

  public function index()
  {
    $data = [ 'title'             => 'Entry SPPA',
              'role'              => $this->aksi_crud,
              'id_lvl_otorisasi'  => $this->id_lvl_otorisasi,
              'id_user'           => $this->session->userdata('sesi_id'),
              'hubungan_klg'      => $this->entry_sppa->cari_data_order('m_hubungan_klg', ['status' => 'kk'], 'id', 'asc')->result_array(),
              'asuransi'          => $this->entry_sppa->cari_asuransi()->result_array(),
              'pengguna_ttg'      => $this->entry_sppa->get_data_order('pengguna_tertanggung', 'nama', 'asc')->result_array(),
              'method'            => $this->entry_sppa->get_method()->result_array(),
              'pekerjaan'         => $this->entry_sppa->get_data_order('m_pekerjaan', 'id_pekerjaan', 'asc')->result_array(),
              'insured'           => $this->entry_sppa->get_insured_mop()->result_array(),
              'method'            => $this->entry_sppa->cari_data_order('m_method', ['status' => 1], 'method', 'asc')->result_array(),
              'bank'              => $this->entry_sppa->get_data_order('m_bank', 'nama_bank', 'asc')->result_array()
            ];

    $this->template->load('template/index', 'V_lihat', $data);
  }

  public function tes_callback()
  {
    $tes = $this->input->post();

    $b = json_decode($tes);
    $c = $b->payment_method;

    $this->db->insert('tr_pembayaran_polis', ['tes_payment_method' => $c]);
    
    echo json_encode(['status' => true]);
    
  }

  public function test_json()
  {
    $d = ['nama'  => 'budi'];

    $a = json_encode($d);
    echo "<br>";
    $b = json_decode($a);

    print_r($a);
  }

  // 27-10-2021
  public function tes_xendit()
  {
    Xendit::setApiKey('xnd_development_yZk4PbvZr1n5tiFhiDWiqUIUfJa6YB46HzE8o1DSIL33r6rszAg1GvhQXbWjY');

    $params = [ 
      'external_id' => 'demo_1475801962607', // TRN190210XXXXXX
      'amount' => 50000
    ];

    $createInvoice = \Xendit\Invoice::create($params);

    echo "<pre>";
    print_r($createInvoice);
    // redirect($createInvoice['invoice_url']);
    echo "</pre>";
  }

  // 23-06-2021
  public function tambah_entry()
  {
    $data = [
      'title'         => 'Form Tambah SPPA',
      'hubungan_klg'  => $this->entry_sppa->cari_data_order('m_hubungan_klg', ['status' => 'kk'], 'id', 'asc')->result_array(),
      'asuransi'      => $this->entry_sppa->cari_asuransi()->result_array(),
      // 'pengguna_ttg'  => $this->entry_sppa->get_list_ptg()->result_array(),
      'pengguna_ttg'  => $this->entry_sppa->get_data_order('pengguna_tertanggung', 'nama', 'asc')->result_array(),
      'method'        => $this->entry_sppa->get_method()->result_array(),
      'pekerjaan'     => $this->entry_sppa->get_data_order('m_pekerjaan', 'id_pekerjaan', 'asc')->result_array(),
      'insured'       => $this->entry_sppa->get_insured_mop()->result_array(),
      'method'        => $this->entry_sppa->cari_data_order('m_method', ['status' => 1], 'method', 'asc')->result_array(),
      'bank'          => $this->entry_sppa->get_data_order('m_bank', 'nama_bank', 'asc')->result_array()
    ];

    $this->template->load('template/index', 'V_tambah_data', $data);
  }

  // 09-11-2021
  public function get_list_mop()
  {
    $id_insured = $this->input->post('id_insured');

    $list = $this->entry_sppa->cari_mop($id_insured)->result_array();
    
    echo json_encode($list);
  }

  // 10-11-2021
  public function get_detail_mop()
  {
    $id_mop = $this->input->post('id_mop');

    $list = $this->entry_sppa->cari_detil_mop($id_mop)->row_array();

    $list_premi = $this->entry_sppa->cari_list_premi($id_mop)->result_array();
    
    echo json_encode(['det' => $list, 'list_premi' => $list_premi]);
  }

  // 11-11-2021
  public function get_list_payment_method()
  {
    $id_method = $this->input->post('id_method');
    
    // $list = $this->entry_sppa->cari_data_order('m_payment_method', ['id_method' => $id_method, 'aktif' => 1], 'nama', 'asc')->result_array();
    $list = $this->entry_sppa->cari_data_order('m_payment_method', ['id_method' => $id_method], 'nama', 'asc')->result_array();

    echo json_encode($list);
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
      $list = $this->entry_sppa->get_data_sppa();
    } else {
      $list = [];
    }

    $data = array();

    $no   = $this->input->post('start');

    foreach ($list as $o) {
        $no++;
        $tbody = array();

        if ($id_lvl_otorisasi == 0) {
          $detail = "<span style='cursor:pointer' class='mr-3 text-dark detail ttip' data-toggle='tooltip' data-placement='top' title='Detail' data-id='".$o['id_sppa_quotation']."'><i class='fas fa-info-circle fa-lg'></i></span>";
          $a1 = "<span style='cursor:pointer' class='mr-3 text-primary edit ttip' data-toggle='tooltip' data-placement='top' title='Ubah' data-id='".$o['id_sppa_quotation']."'><i class='fas fa-pencil-alt fa-lg'></i></span>";
          $a2 = "<span style='cursor:pointer' class='text-danger hapus ttip' data-toggle='tooltip' data-placement='top' title='Hapus' data-id='".$o['id_sppa_quotation']."'><i class='far fa-trash-alt fa-lg'></i></span>";
        } else {
          if ($update == 'true') {

            if ($delete == 'true') {
              $mrd = "mr-3";
            } else {
              $mrd = "";
            }

            $a1 = "<span style='cursor:pointer' class='".$mrd." text-primary edit ttip' data-toggle='tooltip' data-placement='top' title='Ubah' data-id='".$o['id_sppa_quotation']."'><i class='fas fa-pencil-alt fa-lg'></i></span>";
            $up = true;
          } else {
            $a1 = "";
            $up = false;
          }

          if ($delete == 'true') {
            $a2 = "<span style='cursor:pointer' class='text-danger hapus ttip' data-toggle='tooltip' data-placement='top' title='Hapus' data-id='".$o['id']."'><i class='far fa-trash-alt fa-lg'></i></span>";
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

          $detail = "<span style='cursor:pointer' class='".$mr." text-dark detail ttip' data-toggle='tooltip' data-placement='top' title='Detail' data-id='".$o['id_sppa_quotation']."'><i class='fas fa-info-circle fa-lg'></i></span>";
        }

        $tbody[]    = "<div align='center'>".$no.".</div>";
        $tbody[]    = $o['no_polis'];
        $tbody[]    = $o['nama_asuransi'];
        $tbody[]    = $o['lob'];
        $tbody[]    = $o['tertanggung'];
        $tbody[]    = $o['pengguna_tertanggung'];
        $tbody[]    = number_format($o['total_akhir_premi'],0,'.','.');
        $tbody[]    = number_format($o['total_tagihan'],0,'.','.');
        $tbody[]    = $detail.$a1.$a2;
        $data[]     = $tbody;
    }

    if ($read == 'true' || $id_lvl_otorisasi == 0) {
        $recordsTotal       = $this->entry_sppa->jumlah_semua_sppa();
        $recordsFiltered    = $this->entry_sppa->jumlah_filter_sppa();
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

  public function get_produk_asuransi()
  {
    $id_asuransi = $this->input->post('id_asuransi');

    $option = "<option value=''>Pilih Produk</option>";

    if ($id_asuransi != '') {
      $list = $this->entry_sppa->cari_produk_asuransi($id_asuransi)->result_array();

      foreach ($list as $l) {

        $option .= "<option value='".$l['id_lob']."'>".$l['lob']."</option>";
        
      }
    }

    echo json_encode(['option' => $option]);
    
  }

  public function get_premi()
  {
    $id_asuransi  = $this->input->post('id_asuransi');
    $id_lob       = $this->input->post('id_lob');

    $option = "<option value=''>Pilih Premi</option>";
    $sts_aw = "";

    if ($id_asuransi != '' && $id_lob != '') {
      $list = $this->entry_sppa->cari_produk_asuransi_premi($id_asuransi, $id_lob)->result_array();

      foreach ($list as $l) {

        $option .= "<option value='".$l['premi']."'>".number_format($l['premi'],0,'.','.')."</option>";
        
      }

      $c_lob = $this->entry_sppa->cari_data('m_lob', ['id_lob' => $id_lob])->row_array();

      $sts_aw = $c_lob['punya_ahli_waris'];
    }

    echo json_encode(['option' => $option, 'sts_aw' => $sts_aw]);
    
  }

  public function detail_pengguna_ttg()
  {
    $id_pengguna_ttg = $this->input->post('id_pengguna_ttg');

    $cari = $this->entry_sppa->cari_pengguna_ttg($id_pengguna_ttg)->row_array();

    echo json_encode(['row' => $cari, 'tgl_lahir' => date("d-M-Y", strtotime($cari['tgl_lahir'])), 'tgl_lahir_dmy' => date("d-m-Y", strtotime($cari['tgl_lahir']))]);
    
  }

  // 23-09-2021
  public function get_hubungan_klg()
  {
    $sts_kk = $this->input->post('sts_kk');

    if ($sts_kk == 0) {
      $status = "non kk";
    } else {
      $status = "kk";
    }

    $list = $this->entry_sppa->cari_data_order('m_hubungan_klg', ['status' => $status], 'id', 'asc')->result_array();

    $option = "<option value=''>Pilih</option>";
    foreach ($list as $l) {
      $option .= "<option value='".$l['id']."'>".$l['hubungan_klg']."</option>";
    }

    echo json_encode(['option' => $option]);
  }

  // 23-09-2021
  public function cek_nik()
  {
    $nik_ttg  = $this->input->post('nik_ttg');    
    $nik_aw_1 = $this->input->post('nik_aw_1');    
    $nik_aw_2 = $this->input->post('nik_aw_2');   
    
    $sts = "";
     
    if ($nik_ttg == $nik_aw_1) {
      $sts = "NIK AHLI WARIS 1 SAMA DENGAN NIK TERTANGGUNG, HARAP GANTI!";
    } elseif ($nik_ttg == $nik_aw_2) {
      $sts = "NIK AHLI WARIS 2 SAMA DENGAN NIK TERTANGGUNG, HARAP GANTI!";
    } elseif ($nik_aw_1 == $nik_aw_2) {
      $sts = "NIK AHLI WARIS 1 dan 2 SAMA, HARAP GANTI!";
    }

    echo json_encode(['status' => $sts]);
    
  }

  public function random_strings($length_of_string)
  {
    
      // String of all alphanumeric character
      $str_result = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
    
      // Shuffle the $str_result and returns substring
      // of specified length
      return substr(str_shuffle($str_result), 0, $length_of_string);
  }

  // 24-09-2021
  public function simpan_entry2()
  {
    $id_insurer               = $this->input->post('id_insurer');    
    $id_lob                   = $this->input->post('id_lob');    
    $premi                    = $this->input->post('premi');    
    $id_pengguna_tertanggung  = $this->input->post('id_pengguna_tertanggung');  
    $pilihan_payment          = $this->input->post('pilihan_payment');

    $aksi_ptg                 = $this->input->post('aksi_ptg');

    $nik_ptg                  = $this->input->post('nik_ptg');    
    $nama_ptg                 = $this->input->post('nama_ptg');    
    $tempat_lahir_ptg         = $this->input->post('tempat_lahir_ptg');    
    $tgl_lahir_ptg            = $this->input->post('tgl_lahir_ptg');    
    $jenis_klm_ptg            = $this->input->post('jenis_klm_ptg');    
    $alamat_ptg               = $this->input->post('alamat_ptg');    
    $telp_ptg                 = $this->input->post('telp_ptg');    
    $pekerjaan_ptg            = $this->input->post('pekerjaan_ptg');    
    $email_ptg                = $this->input->post('email_ptg');    

    $this->db->trans_begin();

    if ($aksi_ptg == 'lengkapi') {

      $data_ptg = ['nik'            => $nik_ptg,
                   'nama'           => $nama_ptg,
                   'tempat_lahir'   => $tempat_lahir_ptg,
                   'tgl_lahir'      => date("Y-m-d", strtotime($tgl_lahir_ptg)),
                   'jenis_kelamin'  => ($jenis_klm_ptg == '1') ? 't' : 'f',
                   'alamat'         => $alamat_ptg,
                   'telp'           => $telp_ptg,
                   'id_pekerjaan'   => $pekerjaan_ptg,
                   'email'          => $email_ptg
                  ];

      $this->entry_sppa->ubah_data('pengguna_tertanggung', $data_ptg, ['id_pengguna_tertanggung' => $id_pengguna_tertanggung]);
      
    }

    // cari mop
    $dt_cari = ['id_asuransi'   => $id_insurer,
                'id_lob'        => $id_lob,
                'premi'         => $premi
               ];

    $cari_mop = $this->entry_sppa->cari_data('tr_produk_asuransi', $dt_cari)->row_array();
    $id_mop               = $cari_mop['id_mop'];
    $id_produk_asuransi   = $cari_mop['id_tr_produk_asuransi'];

    $cari_lob = $this->entry_sppa->cari_data('m_lob', ['id_lob' => $id_lob])->row_array();
    $nama_produk = $cari_lob['lob'];

    $cari_pengguna = $this->entry_sppa->cari_data('pengguna_tertanggung', ['id_pengguna_tertanggung' => $id_pengguna_tertanggung])->row_array();

    $data_sppa = ['id_mop'                  => $id_mop,
                  'status_aktif'            => true,
                  'id_pengguna_tertanggung' => $id_pengguna_tertanggung,
                  'id_produk_asuransi'      => $id_produk_asuransi,
                  'status_polis'            => 0,
                  'add_time'                => date("Y-m-d H:i:s", now('Asia/Jakarta')),
                  'add_by'                  => $this->session->userdata('sesi_id')
                 ];

    $this->entry_sppa->input_data('tr_sppa_quotation', $data_sppa);
    $id_tr_sppa_quotation = $this->db->insert_id();
    
    // input ahli waris
    for ($i=1; $i <= 2; $i++) { 

      $data_aw['nik']                   = $this->input->post('nik_aw_'.$i);
      $data_aw['nama']                  = $this->input->post('nama_aw_'.$i);
      $data_aw['alamat']                = ($this->input->post('alamat_aw_'.$i) == '') ? null : $this->input->post('alamat_aw_'.$i);
      $data_aw['hp']                    = $this->input->post('no_hp_aw_'.$i);
      $data_aw['hubungan']              = $this->input->post('id_hubungan_klg_aw_'.$i);
      $data_aw['ahli_waris_ke']         = $i;
      $data_aw['id_tr_sppa_quotation']  = $id_tr_sppa_quotation;

      $this->entry_sppa->input_data('m_ahli_waris', $data_aw);

    }

    // input pembayaran polis
    $no_tr = "TRN".$id_tr_sppa_quotation.date("dmy").$this->random_strings(10);

    if (($pilihan_payment == 3) || ($pilihan_payment == 4)) {
      Xendit::setApiKey('xnd_development_yZk4PbvZr1n5tiFhiDWiqUIUfJa6YB46HzE8o1DSIL33r6rszAg1GvhQXbWjY');

      $params = [ 
        'external_id' => $no_tr,
        'amount'      => $premi
      ];

      $createInvoice = \Xendit\Invoice::create($params);

      $invoice_url = $createInvoice['invoice_url'];
    } else {
      $invoice_url = null;
    }

    $data_pp = ['no_transaksi'      => $no_tr,
                'id_payment_method' => $pilihan_payment,
                'bayar'             => $premi,
                'id_sppa_quotation' => $id_tr_sppa_quotation,
                'status_bayar'      => 0,
                'invoice_url'       => $invoice_url,
                'add_time'          => date("Y-m-d H:i:s", now('Asia/Jakarta')),
                'add_by'            => $this->session->userdata('sesi_id')
              ];

    $this->entry_sppa->input_data('tr_pembayaran_polis', $data_pp);

    if($this->db->trans_status() === FALSE){
      $this->db->trans_rollback();

      echo json_encode(['status' => false]);
     
    }else{
      $this->db->trans_commit();

      if ($pilihan_payment == 2) {

        // Required
        $transaction_details = array(
          'order_id'      => $no_tr,
          'gross_amount'  => $premi, // no decimal allowed for creditcard
        );

        // Optional
        $item1_details = array(
          'price'     => $premi,
          'quantity'  => 1,
          'name'      => $nama_produk
        );

        // Optional
        $item_details = array ($item1_details);

        // Optional
        $billing_address = array(
          'first_name'    => $cari_pengguna['nama'],
          'address'       => $cari_pengguna['alamat'],
          'phone'         => $cari_pengguna['hp']
        );

        // Optional
        $shipping_address = array(
          'first_name'    => $cari_pengguna['nama'],
          'address'       => $cari_pengguna['alamat'],
          'phone'         => $cari_pengguna['hp']
        );

        // Optional
        $customer_details = array(
          'first_name'        => $cari_pengguna['nama'],
          'address'           => $cari_pengguna['alamat'],
          'email'             => $cari_pengguna['email'],
          'phone'             => $cari_pengguna['hp'],
          'billing_address'   => $billing_address,
          'shipping_address'  => $shipping_address
        );

        // Data yang akan dikirim untuk request redirect_url.
            $credit_card['secure'] = true;
            //ser save_card true to enable oneclick or 2click
            //$credit_card['save_card'] = true;

            $time = time();
            $custom_expiry = array(
                'start_time'  => date("Y-m-d H:i:s O",$time),
                'unit'        => 'minute', 
                'duration'    => 2
            );
            
            $transaction_data = array(
                'transaction_details'=> $transaction_details,
                'item_details'       => $item_details,
                'customer_details'   => $customer_details,
                'credit_card'        => $credit_card,
                'expiry'             => $custom_expiry
            );

        error_log(json_encode($transaction_data));
        $snapToken = $this->midtrans->getSnapToken($transaction_data);
        error_log($snapToken);
        echo $snapToken;

      } elseif (($pilihan_payment == 3) || ($pilihan_payment == 4)) {

          echo json_encode(['status' => true, 'invoice_url' => $invoice_url]);
      } 

    }
    
  }

  public function ttes()
  {
    // $a = "209.785.300.21.20001/000/000001";
    // echo strrpos($a,"/");
    // echo "<br>";
    // echo substr($a,-6);
    // echo "<br>";
    // $b = strlen($a);
    // echo "<br>";
    // echo substr($a,0,strrpos($a,"/")+1);
    // echo "<br>";
    // echo substr($a,25,$b);

    // $v = "000001"+4;

    // // echo $v;

    // $t = date('Y-m-d', strtotime('+1 year', now('Asia/Jakarta')) );

    // echo $t;

    $data = [
      'title'         => 'Tes',
    ];

    $this->template->load('template/index', 'V_tes', $data);
  }

  function formatSizeUnits($bytes)
  {
      if ($bytes >= 1073741824)
      {
          $bytes = number_format($bytes / 1073741824, 2) . ' GB';
      }
      elseif ($bytes >= 1048576)
      {
          $bytes = number_format($bytes / 1048576, 2) . ' MB';
      }
      elseif ($bytes >= 1024)
      {
          $bytes = number_format($bytes / 1024, 2) . ' KB';
      }
      elseif ($bytes > 1)
      {
          $bytes = $bytes . ' bytes';
      }
      elseif ($bytes == 1)
      {
          $bytes = $bytes . ' byte';
      }
      else
      {
          $bytes = '0 bytes';
      }

      return $bytes;
  }

  // 18-11-2021
  public function hapus_entry()
  {  
    $id_sppa  = $this->input->post('id_sppa');    

    $this->db->trans_begin();

      $this->entry_sppa->hapus_data('tr_sppa_quotation', ['id_sppa_quotation' => $id_sppa]);
      $this->entry_sppa->hapus_data('tr_approve_sppa', ['id_sppa_quotation' => $id_sppa]);
      $this->entry_sppa->hapus_data('m_ahli_waris', ['id_tr_sppa_quotation' => $id_sppa]);
      $this->entry_sppa->hapus_data('tr_pembayaran_polis', ['id_sppa_quotation' => $id_sppa]);

      $cri = $this->entry_sppa->cari_data('dokumen_sppa', ['id_sppa_quotation' => $id_sppa])->result_array();

      foreach ($cri as $c) {

        $path = "./upload/dokumen/".$c['filename'];
        unlink($path);
        
      }
      
      $this->entry_sppa->hapus_data('dokumen_sppa', ['id_sppa_quotation' => $id_sppa]);

    if($this->db->trans_status() === FALSE){
      $this->db->trans_rollback();

      echo json_encode(['status' => false]);
      
    }else{
      $this->db->trans_commit();

      echo json_encode(['status' => true]);

    }
  }

  // 11-11-2021
  public function simpan_entry()
  {
    $f_entry  = $this->input->post('form_entry');

    $entry = array();
    parse_str($f_entry, $entry);
    
    $id_insurer               = $entry['id_insurer'];    
    $id_lob                   = $entry['id_lob'];    
    $premi                    = $entry['premi'];    
    $id_pengguna_tertanggung  = $entry['id_pengguna_tertanggung'];  
    $pilihan_payment          = $entry['pilihan_payment'];

    $aksi_ptg                 = $entry['aksi_ptg'];
    $aksi_simpan              = $entry['aksi_simpan'];
    $no_polis_edit            = $entry['no_polis'];

    $total_akhir_premi        = str_replace('.','', $entry['total_akhir_premi']);    
    $biaya_admin              = str_replace('.','', $entry['biaya_admin']);  
    $total_tagihan            = str_replace('.','', $entry['total_tagihan']);     

    $nik_ptg                  = $entry['nik_ptg'];     
    $nama_ptg                 = $entry['nama_ptg'];    
    $tempat_lahir_ptg         = $entry['tempat_lahir_ptg'];    
    $tgl_lahir_ptg            = $entry['tgl_lahir_ptg'];    
    $jenis_klm_ptg            = $entry['jenis_klm_ptg'];    
    $alamat_ptg               = $entry['alamat_ptg'];    
    $telp_ptg                 = $entry['telp_ptg'];    
    $pekerjaan_ptg            = $entry['pekerjaan_ptg'];    
    $email_ptg                = $entry['email_ptg'];    

    $id_mop                   = $entry['id_mop'];    
    $id_produk_asuransi       = $entry['id_tr_produksi_asuransi'];       

    $method                   = $entry['method'];    
    $payment_method           = $entry['payment_method'];    
    // $bank                     = $entry['bank'];    



    $this->db->trans_begin();

    if ($aksi_ptg == 'lengkapi') {

      $data_ptg = ['nik'            => $nik_ptg,
                   'nama'           => $nama_ptg,
                   'tempat_lahir'   => $tempat_lahir_ptg,
                   'tgl_lahir'      => date("Y-m-d", strtotime($tgl_lahir_ptg)),
                   'jenis_kelamin'  => ($jenis_klm_ptg == '1') ? 't' : 'f',
                   'alamat'         => $alamat_ptg,
                   'telp'           => $telp_ptg,
                   'id_pekerjaan'   => $pekerjaan_ptg,
                   'email'          => $email_ptg
                  ];

      $this->entry_sppa->ubah_data('pengguna_tertanggung', $data_ptg, ['id_pengguna_tertanggung' => $id_pengguna_tertanggung]);
      
    }

    // cari mop
    // $dt_cari = ['id_asuransi'   => $id_insurer,
    //             'id_lob'        => $id_lob,
    //             'premi'         => $premi
    //            ];

    // $cari_mop = $this->entry_sppa->cari_data('tr_produk_asuransi', $dt_cari)->row_array();
    // $id_mop               = $cari_mop['id_mop'];
    // $id_produk_asuransi   = $cari_mop['id_tr_produk_asuransi'];

    // $cari_lob = $this->entry_sppa->cari_data('m_lob', ['id_lob' => $id_lob])->row_array();
    // $nama_produk = $cari_lob['lob'];

    // $cari_pengguna = $this->entry_sppa->cari_data('pengguna_tertanggung', ['id_pengguna_tertanggung' => $id_pengguna_tertanggung])->row_array();

    $cari = $this->entry_sppa->cari_data('mop', ['id_mop' => $id_mop])->row_array();

    // nomor polis
    $cari_polis = $this->entry_sppa->cari_data_order('tr_sppa_quotation', ['id_mop' => $id_mop], 'no_polis', 'desc')->row_array();

    if (!empty($cari_polis)) {
      $pol = $cari_polis['no_polis'];

      $nmr =  substr($pol,-6);
      $jml = $nmr + 1;

      $n_tr = str_pad($jml, 6, "0", STR_PAD_LEFT);
      $no_polis = $cari['no_mop'].$n_tr;

    } else {

      // cari slash
      // $a1 = strrpos($cari['no_mop'],"/");
      // $a2 = substr($a1,0,$a1+1);
      
      $no_polis = $cari['no_mop']."000001";
      
      // echo strrpos($a,"/");
      // echo "<br>";
      // echo substr($a,-6);
      // echo "<br>";
      // $b = strlen($a);
      // echo "<br>";
      // echo substr($a,0,strrpos($a,"/")+1);
      // echo "<br>";
      // echo substr($a,25,$b);

    }

    if ($aksi_simpan == 'tambah') {
      $no_polis = $no_polis;
    } else {
      $no_polis = $no_polis_edit;
    }

    if ($aksi_simpan == 'tambah') {

      $data_sppa = ['id_mop'                  => $id_mop,
                    'status_aktif'            => true,
                    'id_pengguna_tertanggung' => $id_pengguna_tertanggung,
                    'id_produk_asuransi'      => $id_produk_asuransi,
                    'status_polis'            => 1,
                    'no_polis'                => $no_polis,
                    'tgl_awal_polis'          => date("Y-m-d", now('Asia/Jakarta')),
                    'tgl_akhir_polis'         => date('Y-m-d', strtotime('+1 year', now('Asia/Jakarta')) ),
                    'total_akhir_premi'       => $total_akhir_premi,
                    'biaya_admin'             => $biaya_admin,
                    'total_tagihan'           => $total_tagihan,
                    'add_time'                => date("Y-m-d H:i:s", now('Asia/Jakarta')),
                    'add_by'                  => $this->session->userdata('sesi_id')
                  ];

      $this->db->insert('tr_sppa_quotation', $data_sppa);
      $id_tr_sppa_quotation = $this->db->insert_id();
      
    } else {

      $data_sppa = ['id_mop'                  => $id_mop,
                    'status_aktif'            => true,
                    'id_pengguna_tertanggung' => $id_pengguna_tertanggung,
                    'id_produk_asuransi'      => $id_produk_asuransi,
                    'total_akhir_premi'       => $total_akhir_premi,
                    'biaya_admin'             => $biaya_admin,
                    'total_tagihan'           => $total_tagihan,
                    'updated_time'            => date("Y-m-d H:i:s", now('Asia/Jakarta')),
                    'updated_by'              => $this->session->userdata('sesi_id')
                  ];

      $this->entry_sppa->ubah_data('tr_sppa_quotation', $data_sppa, ['id_sppa_quotation' => $entry['id_sppa_quotation']]);
      $id_tr_sppa_quotation = $entry['id_sppa_quotation'];
      
    }

    if ($aksi_simpan == 'tambah') {

      $data_approve = [ 'id_sppa_quotation'    => $id_tr_sppa_quotation, 
                        'id_asuransi'          => $cari['id_insurer'],
                        'no_otorisasi_polis'   => $no_polis,
                        'tgl_otorisasi'        => date("Y-m-d H:i:s", now('Asia/Jakarta')),
                        'tgl_approve'          => date("Y-m-d H:i:s", now('Asia/Jakarta')),
                        'keterangan_tambahan'  => "",
                        'add_time'             => date("Y-m-d H:i:s", now('Asia/Jakarta')),
                        'add_by'               => $this->session->userdata('sesi_id')
                  ];

      $this->entry_sppa->input_data('tr_approve_sppa', $data_approve);

    }

    if ($aksi_simpan == 'edit') {
      $this->entry_sppa->hapus_data('m_ahli_waris', ['id_tr_sppa_quotation' => $id_tr_sppa_quotation]);
    }
    
    // input ahli waris
    for ($i=1; $i <= 2; $i++) { 

      $data_aw['nik']                   = $entry['nik_aw_'.$i];
      $data_aw['nama']                  = $entry['nama_aw_'.$i];
      $data_aw['alamat']                = ($entry['alamat_aw_'.$i] == '') ? null : $entry['alamat_aw_'.$i];
      $data_aw['hp']                    = $entry['no_hp_aw_'.$i];
      $data_aw['hubungan']              = $entry['id_hubungan_klg_aw_'.$i];
      $data_aw['ahli_waris_ke']         = $i;
      $data_aw['id_tr_sppa_quotation']  = $id_tr_sppa_quotation;

      $this->entry_sppa->input_data('m_ahli_waris', $data_aw);

    }

    // input pembayaran polis
    $no_tr = "TRN".$id_tr_sppa_quotation.date("dmy").$this->random_strings(10);

    // if (($pilihan_payment == 3) || ($pilihan_payment == 4)) {
    //   Xendit::setApiKey('xnd_development_yZk4PbvZr1n5tiFhiDWiqUIUfJa6YB46HzE8o1DSIL33r6rszAg1GvhQXbWjY');

    //   $params = [ 
    //     'external_id' => $no_tr,
    //     'amount'      => $premi
    //   ];

    //   $createInvoice = \Xendit\Invoice::create($params);

    //   $invoice_url = $createInvoice['invoice_url'];
    // } else {
    //   $invoice_url = null;
    // }

    if ($aksi_simpan == 'tambah') {

      $data_pp = ['no_transaksi'      => $no_tr,
                  'id_payment_method' => $payment_method,
                  'bayar'             => $total_tagihan,
                  'id_sppa_quotation' => $id_tr_sppa_quotation,
                  'status_bayar'      => 1,
                  // 'invoice_url'       => $invoice_url,
                  'add_time'          => date("Y-m-d H:i:s", now('Asia/Jakarta')),
                  'add_by'            => $this->session->userdata('sesi_id')
                ];

      $this->entry_sppa->input_data('tr_pembayaran_polis', $data_pp);
      
    } else {

      $data_pp = ['id_payment_method' => $payment_method,
                  'bayar'             => $total_tagihan
                ];

      $this->entry_sppa->ubah_data('tr_pembayaran_polis', $data_pp, ['id_sppa_quotation' => $id_tr_sppa_quotation]);

    }  

    if ($aksi_simpan == 'tambah') {

      $data_id_dokumen  = json_decode($this->input->post('data_id_dokumen'), true);  

      $jumlah = count($data_id_dokumen);

      if ($jumlah != 0) {
        for ($i=0; $i < $jumlah; $i++) { 

            $no_id = $data_id_dokumen[$i];
          
            $nama = $_FILES["dokumen_$no_id"]['name'];
            $size = $_FILES["dokumen_$no_id"]['size'];
            $tmp  = $_FILES["dokumen_$no_id"]['tmp_name'];

            $desc = $this->input->post("desc_$no_id");

            if ($nama != '') {
              $path = "./upload/dokumen/" . $nama;

              move_uploaded_file($tmp, $path);

              $data_dok[] = [ 'filename'          => $nama,
                              'size'              => $this->formatSizeUnits($size),
                              'description'       => $desc,
                              'id_sppa_quotation' => $id_tr_sppa_quotation,
                              'add_time'          => date("Y-m-d H:i:s", now('Asia/Jakarta')),
                              'add_by'            => $this->session->userdata('sesi_id')
                              ];
              
            }
            
        }

        if (!empty($data_dok)) {
          $this->db->insert_batch('dokumen_sppa', $data_dok);
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

  // 15-11-2021
  public function edit_sppa($id_sppa)
  {
    $sppa = $this->entry_sppa->cari_sppa($id_sppa)->row_array();

    $data = [
      'title'             => 'Edit SPPA',
      'list'              => $sppa,
      'aksi'              => 'edit',
      'id_sppa'           => $id_sppa,
      'ahli_waris'        => $this->entry_sppa->get_list_ahli_waris($id_sppa)->result_array(),
      'hubungan_klg'      => $this->entry_sppa->cari_data_order('m_hubungan_klg', ['status' => 'kk'], 'id', 'asc')->result_array(),
      'asuransi'          => $this->entry_sppa->cari_asuransi()->result_array(),
      'pengguna_ttg'      => $this->entry_sppa->get_data_order('pengguna_tertanggung', 'nama', 'asc')->result_array(),
      'method'            => $this->entry_sppa->get_method()->result_array(),
      'pekerjaan'         => $this->entry_sppa->get_data_order('m_pekerjaan', 'id_pekerjaan', 'asc')->result_array(),
      'insured'           => $this->entry_sppa->get_insured_mop()->result_array(),
      'method'            => $this->entry_sppa->cari_data_order('m_method', ['status' => 1], 'method', 'asc')->result_array(),
      'bank'              => $this->entry_sppa->get_data_order('m_bank', 'nama_bank', 'asc')->result_array(),
      'role'              => $this->aksi_crud,
      'id_lvl_otorisasi'  => $this->id_lvl_otorisasi,
      'id_user'           => $this->session->userdata('sesi_id'),
    ];

    $this->template->load('template/index', 'V_edit', $data);
  }

  function beda_waktu($date1, $date2, $format = false) 
  {
    $diff = date_diff( date_create($date1), date_create($date2) );
    if ($format)
      return $diff->format($format);
    
    return array('y' => $diff->y,
          'm' => $diff->m,
          'd' => $diff->d,
          'h' => $diff->h,
          'i' => $diff->i,
          's' => $diff->s
        );
  }

  // 24-09-2021
  public function detail_sppa($id_sppa)
  {
    $sppa = $this->entry_sppa->cari_sppa($id_sppa)->row_array();

    $wkt  = $this->beda_waktu($sppa['tgl_awal_polis'], $sppa['tgl_akhir_polis']);

    $data = [
      'title'             => 'Detail SPPA',
      'sppa'              => $sppa,
      'id_sppa'           => $id_sppa,
      'masa_polis'        => $wkt['y'],
      'ahli_waris'        => $this->entry_sppa->cari_ahli_waris($id_sppa)->result_array(),
      'manfaat'           => $this->entry_sppa->cari_data_order('m_manfaat', ['id_produk_asuransi' => $sppa['id_produk_asuransi']], 'id', 'asc')->result_array(),
      'role'              => $this->aksi_crud,
      'id_lvl_otorisasi'  => $this->id_lvl_otorisasi,
      'id_user'           => $this->session->userdata('sesi_id'),
    ];

    $this->template->load('template/index', 'V_detail', $data);
  }

  // 16-11-2021
  public function simpan_dokumen()
  {
    $aksi         = $this->input->post('aksi');
    $desc         = $this->input->post('desc');
    $id_dokumen   = $this->input->post('id_dokumen');
    $nama_dokumen = $this->input->post('nama_dokumen');
    $id_sppa      = $this->input->post('id_sppa_dok');

    $config['upload_path']    ="./upload/dokumen";
    $config['allowed_types']  ='docx|doc|pdf';
    $config['max_size']       = 20000;
    $config['encrypt_name']   = false;
    
    $this->load->library('upload',$config);

    // $_FILES["files"]["name"] != ''

    if ($aksi == 'Hapus') {
      $path = "./upload/dokumen/".$nama_dokumen;
      unlink($path); 

      $this->db->delete('dokumen_sppa', ['id_dokumen_sppa' => $id_dokumen]);

      echo json_encode(['status' => true]);
    } elseif ($aksi == 'Ubah') {
      
      if ($_FILES["dokumen"]["name"] == '') {

        $data = [ 'description'       => $desc,
                  'id_sppa_quotation' => $id_sppa,
                  'updated_by'        => $this->session->userdata('sesi_id'),
                  'updated_time'      => date('Y-m-d H:i:s', now('Asia/Jakarta'))
                ];
      
        $this->db->update('dokumen_sppa', $data, ['id_dokumen_sppa' => $id_dokumen]);

        echo json_encode(['status' => true]);
        
      } else {
        if($this->upload->do_upload("dokumen")){

          $path = "./upload/dokumen/".$nama_dokumen;
          unlink($path); 

          $data = array('upload_data' => $this->upload->data());
    
          $desc  = $this->input->post('desc');
          $file  = $data['upload_data']['file_name']; 
          $size  = $_FILES['dokumen']['size']; 
    
          $data = [ 'id_sppa_quotation' => $id_sppa,
                    'description'       => $desc,
                    'filename'          => $file,
                    'size'              => $this->formatSizeUnits($size),
                    'id_sppa_quotation' => $id_sppa,
                    'updated_by'        => $this->session->userdata('sesi_id'),
                    'updated_time'      => date('Y-m-d H:i:s', now('Asia/Jakarta'))
                    ];
          
          $this->db->update('dokumen_sppa', $data, ['id_dokumen_sppa' => $id_dokumen]);
    
          echo json_encode(['status' => true]);
        } else {
          echo json_encode(['status' => false]);
        }
      }
      
    } else {

      if($this->upload->do_upload("dokumen")){
        $data = array('upload_data' => $this->upload->data());
  
        $desc  = $this->input->post('desc');
        $file  = $data['upload_data']['file_name']; 
        $size  = $_FILES['dokumen']['size']; 
  
        $data = [ 'id_sppa_quotation' => $id_sppa,
                  'description'       => $desc,
                  'filename'          => $file,
                  'size'              => $this->formatSizeUnits($size),
                  'id_sppa_quotation' => $id_sppa,
                  'add_by'            => $this->session->userdata('sesi_id'),
                  'add_time'          => date('Y-m-d H:i:s', now('Asia/Jakarta')),
                  'updated_by'        => $this->session->userdata('sesi_id'),
                  'updated_time'      => date('Y-m-d H:i:s', now('Asia/Jakarta'))
                  ];
        
        $this->db->insert('dokumen_sppa', $data);
  
        echo json_encode(['status' => true]);
      } else {
        echo json_encode(['status' => false]);
      }
      
    }
    
  }

  public function tampil_data_dokumen()
  {
    $id_sppa = $this->input->post('id_sppa');
    $aksi_d  = $this->input->post('aksi');

    if ($id_sppa) {
      $list = $this->entry_sppa->cari_data_order('dokumen_sppa', ['id_sppa_quotation' => $id_sppa], 'add_time', 'desc')->result_array();

      $data = array();

      $no   = $this->input->post('start');

      foreach ($list as $o) {
          $no++;
          $tbody = array();

          if ($aksi_d == 'detail') {
            $aksi = "<a href='".base_url()."upload/dokumen/".$o['filename']."' class='ttip' data-toggle='tooltip' data-placement='top' title='Download'><i class='mdi mdi-file-document-outline mdi-24px'></i></a>";
          } else {
            $aksi = "<a href='".base_url()."upload/dokumen/".$o['filename']."' class='mr-3 ttip' data-toggle='tooltip' data-placement='top' title='Download'><i class='far fa-file-alt fa-lg'></i></a><span style='cursor:pointer' class='mr-3 text-primary edit ttip' data-toggle='tooltip' data-placement='top' title='Ubah' data-id='".$o['id_dokumen_sppa']."' desc='".$o['description']."' filename='".$o['filename']."'><i class='fas fa-pencil-alt fa-lg'></i></span><span style='cursor:pointer' class='text-danger hapus ttip' data-toggle='tooltip' data-placement='top' title='Hapus' data-id='".$o['id_dokumen_sppa']."' desc='".$o['description']."' filename='".$o['filename']."'><i class='far fa-trash-alt fa-lg'></i></span>";
          }

          if ($o['updated_time']) {
            $dt = date("d-M-Y H:i:s", strtotime($o['updated_time']));
          } else {
            $dt = "-";
          }

          $tbody[]    = "<div align='center'>".$no.".</div>";
          $tbody[]    = $o['description'];
          // $tbody[]    = "<a href='".base_url()."upload/dokumen/".$o['filename']."'>".$o['filename']."</a>";
          // $tbody[]    = force_download("upload/dokumen/".$o['filename']."",NULL);
          $tbody[]    = $o['filename'];
          $tbody[]    = $o['size'];
          $tbody[]    = $dt;
          $tbody[]    = $aksi;
          $data[]     = $tbody;
      }

    
      echo json_encode(['data' => $data]);
    } else {
      echo json_encode(['data' => []]);
    }

  }

  public function download($filename)
  {
    force_download("upload/dokumen/$filename",NULL);
  }

}

?>
