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
              'id_user'           => $this->session->userdata('sesi_id')
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
      'insured'       => $this->entry_sppa->get_insured_mop()->result_array()
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
  public function simpan_entry()
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
      'title'       => 'Detail SPPA',
      'sppa'        => $sppa,
      'masa_polis'  => $wkt['y'],
      'ahli_waris'  => $this->entry_sppa->cari_ahli_waris($id_sppa)->result_array(),
      'manfaat'     => $this->entry_sppa->cari_data_order('m_manfaat', ['id_produk_asuransi' => $sppa['id_produk_asuransi']], 'id', 'asc')->result_array()
    ];

    $this->template->load('template/index', 'V_detail', $data);
  }

}

?>
