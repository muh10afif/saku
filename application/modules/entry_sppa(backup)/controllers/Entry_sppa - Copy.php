<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 *
 */

use PhpOffice\PhpSpreadsheet\Helper\Sample;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;

// use Mpdf\Mpdf;


class Entry_sppa extends CI_controller
{

  public function __construct() {
    parent::__construct();
    $this->load->model('binding/M_binding', 'binding');
    $this->load->model('cob_lob/m_cob', 'cob');
    $this->load->model('M_entry_sppa', 'entry_sppa');
    $this->load->model('business_specifications/M_business_specifications', 'bsp');

    $this->aksi_crud        = get_role($this->session->userdata('id_level_otorisasi'));
    $this->id_lvl_otorisasi = $this->session->userdata('id_level_otorisasi');

    $this->load->helper('inputtype_helper');
    if($this->session->userdata('username') == "") {
      redirect(base_url(), 'refresh');
    }

  }

  // public function tes()
  // {
  //   $cari = $this->db->get('m_sppa_field_spec')->result_array();

  //   foreach ($cari as $c) {
  //     $cari2 = $this->db->get_where('relasi_cob_lob', ['id_lob' => $c['id_lob']])->row_array();
      
  //     $this->db->update('m_sppa_field_spec', ['id_relasi_cob_lob' => $cari2['id_relasi_cob_lob']]);
      
  //   }
    
  // }

  public function tes()
  {
    $startColumn = 'A';
    $endColumn = 'AC';

    $endColumn++;
    for($column = $startColumn; $column !== $endColumn; $column++) {
        echo $column;
        echo "<br>";
    }
  }

  public function format_excel_2($id_relasi)
  {
    
    // Create new Spreadsheet object
    $spreadsheet = new Spreadsheet();

    // Set document properties
    $spreadsheet->getProperties()->setCreator('Legowo Brokers Insurance')
    // ->setLastModifiedBy('Andoyo - Java Web Medi')
    // ->setTitle('Office 2007 XLSX Test Document')
    // ->setSubject('Office 2007 XLSX Test Document')
    // ->setDescription('Test document for Office 2007 XLSX, generated using PHP classes.')
    // ->setKeywords('office 2007 openxml php')
    ->setCategory('Format Excel');

    $this->db->select('p.*');
    $this->db->from('m_sppa_field_spec as s');
    $this->db->join('m_field_sppa as p', 'p.id_field_sppa = s.type_field', 'inner');
    $this->db->where('s.id_relasi_cob_lob', $id_relasi);
    $cari = $this->db->get()->result_array();

    // $i=5;
    // $no=1; 
    // foreach($cari as $data) 
    // {
    //   $spreadsheet->setActiveSheetIndex(0)
    //   ->setCellValue('A'.$i, $no)
    //   ->setCellValue('B'.$i, date('d-m-Y', strtotime($data->add_time)))
    //   ->setCellValue('C'.$i, $data->nama_penyaluran)
    //   ->setCellValue('D'.$i, $data->nominal);
    //   $no++;
    //   $i++;
    // }

    for ($row=1; $row < count($cari); $row++) {
      $col = 1;
      foreach($cari as $key=>$value) {
          $spreadsheet->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $value['field_sppa']);
          $col++;
      }
    }

    // Add some data
    // $spreadsheet->setActiveSheetIndex(0)
    // ->setCellValue('A1', 'KODE PROVINSI')
    // ->setCellValue('B1', 'NAMA PROVINSI')
    // ;

    // Miscellaneous glyphs, UTF-8
    // $i=2; foreach($provinsi as $provinsi) {

    // $spreadsheet->setActiveSheetIndex(0)
    // ->setCellValue('A'.$i, $provinsi->id_provinsi)
    // ->setCellValue('B'.$i, $provinsi->provinsi);
    // $i++;
    // }

    // Rename worksheet
    $spreadsheet->getActiveSheet()->setTitle('Report Excel '.date('d-m-Y H'));

    // Set active sheet index to the first sheet, so Excel opens this as the first sheet
    $spreadsheet->setActiveSheetIndex(0);

    //Redirect output to a client’s web browser (Xlsx)
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment;filename="Format Excel.xlsx"');
    header('Cache-Control: max-age=0');
    // If you're serving to IE 9, then the following may be needed
    header('Cache-Control: max-age=1');

    // If you're serving to IE over SSL, then the following may be needed
    header('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
    header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT'); // always modified
    header('Cache-Control: cache, must-revalidate'); // HTTP/1.1
    header('Pragma: public'); // HTTP/1.0

    $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
    // $name = './upload/xyz.xlsx';
    // $writer->save($name);
    $writer->save('php://output');
    
    return "ok";
  }

  public function index($value='')
  {
    $data = [ 'title'             => 'Entry SPPA',
              'sppa_number'       => $this->sppa_number(),
              'list_sob'          => $this->entry_sppa->getsob(),
              'list_cob'          => $this->entry_sppa->list_cob(),
              'no_reff'           => $this->entry_sppa->get_data_order('mop', 'id_mop', 'desc')->result_array(),
              'nasabah'           => $this->entry_sppa->get_insured_mop()->result_array(),
              'role'              => $this->aksi_crud,
              'id_lvl_otorisasi'  => $this->id_lvl_otorisasi,
              'id_user'           => $this->session->userdata('sesi_id')
            ];

    $this->template->load('template/index', 'entry/lihat', $data);
  }

  // 23-06-2021
  public function tambah_entry()
  {
    $data = [
      'title'       => 'Form Tambah SPPA',
      'sppa_number' => $this->sppa_number(),
      'list_sob'    => $this->entry_sppa->getsob_list(),
      'list_cob'    => $this->entry_sppa->list_cob(),
      'no_reff'     => $this->entry_sppa->get_data_order('mop', 'id_mop', 'desc')->result_array(),
      'nasabah'     => $this->entry_sppa->get_insured_mop()->result_array()
    ];

    $this->template->load('template/index', 'entry/tambah_data', $data);
  }

  // 03-06-2021
  public function format_excel($id_relasi)
  {
    $list = $this->entry_sppa->get_field_sppa($id_relasi)->result_array();

    $data = [ 'data' => $list
            ];

    $this->template->load('template/template_excel', 'entry/V_format_excel', $data);
  }

  // 02-06-2021
  public function list_reff_mop()
  {
    $id_insured = $this->input->post('id_insured');

    $option = "<option value=''>Pilih</option>";

    if ($id_insured == '') {
       $option = $option;
    } else {
      // $cari = $this->entry_sppa->cari_data('mop', ['id_insured' => $id_insured])->result_array();
      $cari = $this->entry_sppa->cari_list_mop($id_insured)->result_array();

      foreach ($cari as $c) {
        $option .= "<option value='".$c['id_mop']."'>".$c['no_reff_mop']." - ".$c['nama_mop']."</option>";
      }
    }

    echo json_encode(['option' => $option]);
  }

  // 10-05-2021 - AFIF
  public function sppa_number($id_sppa = '')
  {
    $cari = $this->entry_sppa->get_data_order('tr_sppa_quotation', 'id_sppa_quotation', 'desc')->row_array();

    // $thn = date('Y');

    // if (!empty($cari)) {
      
    //   $a =  strpos($cari['sppa_number'], $thn);
    //   $b =  strlen($cari['sppa_number']); 

    //   $c =  substr($cari['sppa_number'], $a + 6, $b);

    //   $a = (int) "$c" + 1;

    //   $kd = str_pad($a, 5, "0", STR_PAD_LEFT);

    // } else {
    //     $kd = str_pad(1, 5, "0", STR_PAD_LEFT);
    // }

    if ($id_sppa == '') {
      $idp = $cari['id_sppa_quotation'] + 1;
    } else {
      $idp = $id_sppa;
    }

    $kd = str_pad($idp, 5, "0", STR_PAD_LEFT);

    $thn = date('Y');

    $kode = "TMP.SPPA-$thn.A".$kd;

    return $kode;
  }

  // 19-05-2021
  public function get_kode()
  {
    echo json_encode(['sppa_number' => $this->sppa_number()]);
  }

  // 15-05-2021
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
          $detail = "<span style='cursor:pointer' class='mr-3 text-dark detail ttip' data-toggle='tooltip' data-placement='top' title='Detail' data-id='".$o['id']."' sppa_number='".$o['sppa_number']."'><i class='fas fa-info-circle fa-lg'></i></span>";
          $a1 = "<span style='cursor:pointer' class='mr-3 text-primary edit ttip' data-toggle='tooltip' data-placement='top' title='Ubah' data-id='".$o['id']."' sppa_number='".$o['sppa_number']."'><i class='fas fa-pencil-alt fa-lg'></i></span>";
          $a2 = "<span style='cursor:pointer' class='text-danger hapus ttip' data-toggle='tooltip' data-placement='top' title='Hapus' data-id='".$o['id']."'><i class='far fa-trash-alt fa-lg'></i></span>";
        } else {
          if ($update == 'true') {

            if ($delete == 'true') {
              $mrd = "mr-3";
            } else {
              $mrd = "";
            }

            $a1 = "<span style='cursor:pointer' class='".$mrd." text-primary edit ttip' data-toggle='tooltip' data-placement='top' title='Ubah' data-id='".$o['id']."' sppa_number='".$o['sppa_number']."'><i class='fas fa-pencil-alt fa-lg'></i></span>";
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

          $detail = "<span style='cursor:pointer' class='".$mr." text-dark detail ttip' data-toggle='tooltip' data-placement='top' title='Detail' data-id='".$o['id']."' sppa_number='".$o['sppa_number']."'><i class='fas fa-info-circle fa-lg'></i></span>";
        }

        switch ($o['id_sob']) {
          case 2:
              $this->db->select('nama_asuransi as nama, alamat, telp');
              $this->db->where('id_asuransi', $o['nama_sob']);
              $data_sob = $this->db->get('m_asuransi')->row_array();

              break;
          case 3:
              $this->db->select('nama_nasabah as nama, alamat_rumah as alamat, telp');
              $this->db->where('id_nasabah', $o['nama_sob']);
              $data_sob = $this->db->get('m_nasabah')->row_array();
              
              break;
          case 4:
              $this->db->select('nama, alamat, telp');
              $this->db->where('id_agent', $o['nama_sob']);
              $data_sob = $this->db->get('m_agent')->row_array();

              break;
          case 6:
              $this->db->select('nama, alamat, telp');
              $this->db->where('id_direct', $o['nama_sob']);
              $data_sob = $this->db->get('m_direct')->row_array();

              break;
          case 5:
              $this->db->select('nama, alamat, telp');
              $this->db->where('id_business_partner', $o['nama_sob']);
              $data_sob = $this->db->get('m_business_partner')->row_array();

              break;
          case 7:
              $this->db->select('nama, alamat, telp');
              $this->db->where('id_loss_adjuster', $o['nama_sob']);
              $data_sob = $this->db->get('m_loss_adjuster')->row_array();
              
              break;
          }

        if ($o['sob'] == null) {
            $sob = "-";
        } else {
            $sob = wordwrap($o['sob']." - ".$data_sob['nama'],35,"<br>\n");
        }

        $tbody[]    = "<div align='center'>".$no.".</div>";
        $tbody[]    = $o['sppa_number'];
        $tbody[]    = $sob;
        $tbody[]    = wordwrap($o['cob']." - ".$o['lob'],35,"<br>\n");
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

  // 25-06-2021
  public function tampil_list_dek()
  {
    $id_mop = $this->input->post('id_mop');

    if ($id_mop) {
      $list = $this->entry_sppa->cari_data_list_dek($id_mop)->result_array();

      $data = array();

      $no   = $this->input->post('start');

      foreach ($list as $o) {
          $no++;
          $tbody = array();

          $tbody[]    = "<div align='center'>".$no.".</div>";
          $tbody[]    = $o['sppa_number'];
          $tbody[]    = "<button class='btn btn-primary detail' data-id='".$o['id']."' sppa_number='".$o['sppa_number']."'>Detail</button>";
          $data[]     = $tbody;
      }

      echo json_encode(['data' => $data]);
    } else {
      echo json_encode(['data' => []]);
    }
  }

  // 01-07-2021
  public function tampil_detail_sppa_dek()
  {
      $id_sppa = $this->input->post('id_sppa');

      $where = ['id_sppa_quotation' => $id_sppa];

      // cari detail sob
      $cari2  = $this->entry_sppa->cari_data('tr_histori_status_sob', $where)->row_array();
      $cari3  = $this->entry_sppa->cari_data('m_sob', ['id_sob' => $cari2['id_sob']])->row_array();
      $wh_sob = $cari2['nama_sob'];

      switch ($cari2['id_sob']) {
          case 2:
              $this->db->select('nama_asuransi as nama, alamat, telp');
              $this->db->where('id_asuransi', $wh_sob);
              $data_sob = $this->db->get('m_asuransi')->row_array();

              $this->db->select('id_asuransi as id, nama_asuransi as nama, alamat, telp');
              $this->db->order_by('nama', 'asc');
              $sob = $this->db->get('m_asuransi')->result_array();
              break;
          case 3:
              $this->db->select('nama_nasabah as nama, alamat_rumah as alamat, telp');
              $this->db->where('id_nasabah', $wh_sob);
              $data_sob = $this->db->get('m_nasabah')->row_array();
              
              $this->db->select('id_nasabah as id, nama_nasabah as nama, alamat_rumah as alamat, telp');
              $this->db->order_by('nama', 'asc');
              $sob = $this->db->get('m_nasabah')->result_array();
              break;
          case 4:
              $this->db->select('nama, alamat, telp');
              $this->db->where('id_agent', $wh_sob);
              $data_sob = $this->db->get('m_agent')->row_array();

              $this->db->select('id_agent as id, nama, alamat, telp');
              $this->db->order_by('nama', 'asc');
              $sob = $this->db->get('m_agent')->result_array();
              break;
          case 6:
              $this->db->select('nama, alamat, telp');
              $this->db->where('id_direct', $wh_sob);
              $data_sob = $this->db->get('m_direct')->row_array();

              $this->db->select('id_direct as id, nama, alamat, telp');
              $this->db->order_by('nama', 'asc');
              $sob = $this->db->get('m_direct')->result_array();
              break;
          case 5:
              $this->db->select('nama, alamat, telp');
              $this->db->where('id_business_partner', $wh_sob);
              $data_sob = $this->db->get('m_business_partner')->row_array();

              $this->db->select('id_business_partner as id, nama, alamat, telp');
              $this->db->order_by('nama', 'asc');
              $sob = $this->db->get('m_business_partner')->result_array();
              break;
          case 7:
              $this->db->select('nama, alamat, telp');
              $this->db->where('id_loss_adjuster', $wh_sob);
              $data_sob = $this->db->get('m_loss_adjuster')->row_array();
              
              $this->db->select('id_loss_adjuster as id, nama, alamat, telp');
              $this->db->order_by('nama', 'asc');
              $sob = $this->db->get('m_loss_adjuster')->result_array();
              break;
          }

      $cari     = $this->entry_sppa->get_sppa($id_sppa)->row_array();

      $cari_lob = $this->entry_sppa->cari_data('m_lob', ['id_lob' => $cari['id_lob']])->row_array();

      $cpremi = $this->entry_sppa->get_premi($id_sppa)->result_array();

      $ky = "";
      foreach ($cpremi as $key => $value) {
        if ($value['status'] == 'standar') {
          $ky = $key;
        }
      }

      $ls_premi = $this->moveElement($cpremi, $ky, 0);

      $data = ['tr_sppa'      => $cari,
                'premi'        => $ls_premi,
                'premi_adt'    => $this->entry_sppa->get_premi_adt($id_sppa)->result_array(),
                'sob'          => $cari3['sob'],
                'data_sob'     => $data_sob,
                'rs_sob'       => $sob,
                'sel_sob'      => $wh_sob,
                'detail_lob'   => $this->entry_sppa->get_field_sppa($cari['id_relasi_cob_lob'])->result_array(),
                'insurer'      => $this->binding->get_data('m_asuransi')->result_array(),
                'karyawan'     => $this->binding->get_data('m_karyawan')->result_array(),
                'list_sob'     => $this->entry_sppa->getsob(),
                'list_cob'     => $this->entry_sppa->list_cob(),
                'no_reff'      => $this->entry_sppa->get_data_order('mop', 'id_mop', 'desc')->result_array(),
                'lob'          => $this->entry_sppa->joincoblob($cari['id_cob']),
                'lob_adt'      => $this->entry_sppa->cari_lob($cari['id_lob'])->result_array(),
                'jenis'        => $this->input->post('jenis'),
                'id_sppa'      => $id_sppa,
                'st_diskon'    => $cari_lob['diskon'],
                'nasabah_ptg'  => $this->entry_sppa->cari_data('pengguna_tertanggung', ['id_pengguna_tertanggung' => $cari['id_pengguna_tertanggung']])->row_array()
              ];

      $this->load->view('entry/detail_sppa_dek', $data);  
      
  }

  // 19-05-2021
  public function tampil_edit_sppa($id_sppa)
  {
      // $id_sppa = $this->input->post('id_sppa');

      $where = ['id_sppa_quotation' => $id_sppa];

      // cari detail sob
      $cari2  = $this->entry_sppa->cari_data('tr_histori_status_sob', $where)->row_array();
      $cari3  = $this->entry_sppa->cari_data('m_sob', ['id_sob' => $cari2['id_sob']])->row_array();
      $wh_sob = $cari2['nama_sob'];

      switch ($cari2['id_sob']) {
          case 2:
              $this->db->select('nama_asuransi as nama, alamat, telp');
              $this->db->where('id_asuransi', $wh_sob);
              $data_sob = $this->db->get('m_asuransi')->row_array();

              $this->db->select('id_asuransi as id, nama_asuransi as nama, alamat, telp');
              $this->db->order_by('nama', 'asc');
              $sob = $this->db->get('m_asuransi')->result_array();
              break;
          case 3:
              $this->db->select('nama_nasabah as nama, alamat_rumah as alamat, telp');
              $this->db->where('id_nasabah', $wh_sob);
              $data_sob = $this->db->get('m_nasabah')->row_array();
              
              $this->db->select('id_nasabah as id, nama_nasabah as nama, alamat_rumah as alamat, telp');
              $this->db->order_by('nama', 'asc');
              $sob = $this->db->get('m_nasabah')->result_array();
              break;
          case 4:
              $this->db->select('nama, alamat, telp');
              $this->db->where('id_agent', $wh_sob);
              $data_sob = $this->db->get('m_agent')->row_array();

              $this->db->select('id_agent as id, nama, alamat, telp');
              $this->db->order_by('nama', 'asc');
              $sob = $this->db->get('m_agent')->result_array();
              break;
          case 6:
              $this->db->select('nama, alamat, telp');
              $this->db->where('id_direct', $wh_sob);
              $data_sob = $this->db->get('m_direct')->row_array();

              $this->db->select('id_direct as id, nama, alamat, telp');
              $this->db->order_by('nama', 'asc');
              $sob = $this->db->get('m_direct')->result_array();
              break;
          case 5:
              $this->db->select('nama, alamat, telp');
              $this->db->where('id_business_partner', $wh_sob);
              $data_sob = $this->db->get('m_business_partner')->row_array();

              $this->db->select('id_business_partner as id, nama, alamat, telp');
              $this->db->order_by('nama', 'asc');
              $sob = $this->db->get('m_business_partner')->result_array();
              break;
          case 7:
              $this->db->select('nama, alamat, telp');
              $this->db->where('id_loss_adjuster', $wh_sob);
              $data_sob = $this->db->get('m_loss_adjuster')->row_array();
              
              $this->db->select('id_loss_adjuster as id, nama, alamat, telp');
              $this->db->order_by('nama', 'asc');
              $sob = $this->db->get('m_loss_adjuster')->result_array();
              break;
          }

      $cari = $this->entry_sppa->get_sppa($id_sppa)->row_array();

      $cari_lob = $this->entry_sppa->cari_data('m_lob', ['id_lob' => $cari['id_lob']])->row_array();

      $cpremi = $this->entry_sppa->get_premi($id_sppa)->result_array();

      $ky = "";
      foreach ($cpremi as $key => $value) {
        if ($value['status'] == 'standar') {
          $ky = $key;
        }
      }

      $ls_premi = $this->moveElement($cpremi, $ky, 0);

      $data = [ 'title'        => "Edit SPPA", 
                'tr_sppa'      => $cari,
                'premi'        => $ls_premi,
                'premi_adt'    => $this->entry_sppa->get_premi_adt($id_sppa)->result_array(),
                'sob'          => $cari3['sob'],
                'data_sob'     => $data_sob,
                'rs_sob'       => $sob,
                'sel_sob'      => $wh_sob,
                'detail_lob'   => $this->entry_sppa->get_field_sppa($cari['id_relasi_cob_lob'])->result_array(),
                'insurer'      => $this->binding->get_data('m_asuransi')->result_array(),
                'karyawan'     => $this->binding->get_data('m_karyawan')->result_array(),
                'list_sob'     => $this->entry_sppa->getsob(),
                'list_cob'     => $this->entry_sppa->list_cob(),
                'no_reff'      => $this->entry_sppa->get_data_order('mop', 'id_mop', 'desc')->result_array(),
                'lob'          => $this->entry_sppa->joincoblob($cari['id_cob']),
                'lob_adt'      => $this->entry_sppa->cari_lob($cari['id_lob'])->result_array(),
                'jenis'        => $this->input->post('jenis'),
                'id_sppa'      => $id_sppa,
                'sppa_number'  => $cari['sppa_number'],
                'st_diskon'    => $cari_lob['diskon'],
                'nasabah_ptg'  => $this->entry_sppa->cari_data('pengguna_tertanggung', ['id_pengguna_tertanggung' => $cari['id_pengguna_tertanggung']])->row_array()
              ];

      // $this->load->view('entry/edit_sppa', $data);  

      $this->template->load('template/index', 'entry/edit_sppa', $data);
      
  }

  public function simpan_data_edit_entry()
  {
      $id_sppa        = $this->input->post('id_sppa');
      $id_sob         = $this->input->post('id_sob');
      $id_cob         = $this->input->post('id_cob');
      $id_lob         = $this->input->post('id_lob');
      $nama_sob       = $this->input->post('nama_sob');
      $id_relasi      = $this->input->post('id_relasi');
      $sppa_number    = $this->input->post('sppa_number');
      $no_polis       = $this->input->post('no_polis');
      $no_invoice     = $this->input->post('no_invoice');
      $detail         = $this->input->post('detail');

      $this->db->trans_begin();

      $where = ['id_sppa_quotation' => $id_sppa];

      $data = [   'id_sob'            => $id_sob,
                  'id_cob'            => $id_cob,
                  'id_lob'            => $id_lob,
                  'id_relasi_cob_lob' => $id_relasi,
                  'sppa_number'       => $sppa_number,
                  'no_polis'          => $no_polis,
                  'no_invoice_entry'  => $no_invoice,
                  'add_time'          => date("Y-m-d H:i:s", now('Asia/Jakarta')),
                  'add_by'            => $this->session->userdata('id_user')
              ];

      $this->entry_sppa->ubah_data('tr_sppa_quotation', $data, $where);

      $data2 = [  'id_sob'            => $id_sob,
                  'nama_sob'          => $nama_sob,
                  'id_sppa_quotation' => $id_sppa,
                  'tanggal_perubahan' => date("Y-m-d", now('Asia/Jakarta')),
                  'add_time'          => date("Y-m-d H:i:s", now('Asia/Jakarta')),
                  'add_by'            => $this->session->userdata('id_user')
              ];

      $this->entry_sppa->ubah_data('tr_histori_status_sob', $data2, $where);

      // detail

      $cari = $this->entry_sppa->get_field_sppa($id_relasi)->result_array();

      $data221  = [];
      $list_fil = [];

      $no = 0;
      foreach ($cari as $c) {
          $nm_field = str_replace(" ","_", strtolower($c['field_sppa']));

          $fl = $detail[$no]['value'];

          if ($fl == null || $fl == '') {
            $fl = null;
          } else {
            $fl = $fl;
          }

          if ($c['data_type'] == 'DATE') {
              if ($fl != '' || $fl != null) {
                $fl = date("Y-m-d", strtotime($fl));
              } else {
                $fl = $fl;
              }
          }
          
          $data22 = [$nm_field => $fl];


          if ($c['cdb'] == 't') {

            $data221 += [$nm_field => $fl];

            array_push($list_fil, $data221);
          } else {
            $this->db->update('tr_sppa_quotation', $data22, ['id_sppa_quotation' => $id_sppa]);
          }

          $no++;
      }
      
      if (!empty($list_fil)) {
        $ky = end(array_keys($list_fil));

        $data_ptg = $list_fil[$ky];

        $data_ptg2  = [ 'add_time'  => date("Y-m-d H:i:s", now('Asia/Jakarta')),
                        'add_by'    => $this->session->userdata('sesi_id')
                      ];

        $this->db->insert('pengguna_tertanggung', $data_ptg);
        $id_data_ptg = $this->db->insert_id();

        $this->db->update('pengguna_tertanggung', $data_ptg2, ['id_pengguna_tertanggung' => $id_data_ptg]);
        
        $this->db->update('tr_sppa_quotation', ['id_pengguna_tertanggung' => $id_data_ptg], ['id_sppa_quotation' => $id_sppa]);
      }
      
      // premi
      $tsi                = $this->input->post('tsi');    
      $diskon             = $this->input->post('diskon');    
      $gross_premi        = $this->input->post('gross_premi');    
      $total_diskon       = $this->input->post('total_diskon');    
      $total_persen_premi = $this->input->post('total_persen_premi');    
      $total_akhir_premi  = $this->input->post('total_akhir_premi');    
      $biaya_admin        = $this->input->post('biaya_admin');    
      $total_tagihan      = $this->input->post('total_tagihan');    
      $payment_method     = $this->input->post('payment_method');    
      $tahun_pay          = $this->input->post('tahun_pay');    
      $jumlah_cicilan     = $this->input->post('jumlah_cicilan');    

      // array
      $lob_adt            = $this->input->post('lob_adt');    
      $kalkulasi_tsi_adt  = $this->input->post('kalkulasi_tsi_adt');    
      $pengali_tsi_adt    = $this->input->post('pengali_tsi_adt');    
      $rate_adt           = $this->input->post('rate_adt');    
      $nominal_adt        = $this->input->post('nominal_adt');    
      $rate_all_premi     = $this->input->post('rate_all_premi');    
      $nominal_all_premi  = $this->input->post('nominal_all_premi');    
      $id_coverage        = $this->input->post('id_coverage');    
      $premi_standar      = $this->input->post('premi_standar');    
      $premi_perluasan    = $this->input->post('premi_perluasan');    

      // simpan tr sppa
      $jml    = count($premi_standar);
      $jml_p  = count($premi_perluasan);
      
      $tt_premi_standar = 0;
      for ($i=0; $i < $jml; $i++) { 
      
      $tt_premi_standar += str_replace('.','', $premi_standar[$i]);

      }

      $tt_premi_pls = 0;
      for ($k=0; $k < $jml_p; $k++) { 
      
      $tt_premi_pls += str_replace('.','', $premi_perluasan[$k]);

      }

      $tt_rate = str_replace('.','', $total_akhir_premi);

      $data11 = [ 'total_sum_insured'       => ($tsi == '0') ? null : $tsi,
                  'diskon'                  => ($diskon != '') ? $diskon : null,
                  'gross_premi'             => ($gross_premi != '') ? str_replace('.','', $gross_premi) : null,
                  'total_diskon'            => ($total_diskon != '') ? str_replace('.','', $total_diskon) : null,
                  'total_akhir_premi'       => ($total_akhir_premi != '') ? $tt_rate : null,
                  'total_rate_akhir_premi'  => ($total_persen_premi != '') ? $total_persen_premi : null,
                  'total_premi_standar'     => $tt_premi_standar,
                  'total_premi_perluasan'   => $tt_premi_pls,
                  'biaya_admin'             => ($biaya_admin == '0') ? null : $biaya_admin,
                  'total_tagihan'           => ($total_tagihan == '0') ? null : $total_tagihan,
                  'payment_method'          => $payment_method,
                  'tahun_cicilan'           => ($tahun_pay != '') ? $tahun_pay : null,
                  'jumlah_cicilan'          => ($jumlah_cicilan != '') ? $jumlah_cicilan : null
              ];

      $this->db->update('tr_sppa_quotation', $data11, $where);

      // cek jika ada premi
      $cari = $this->entry_sppa->cari_data('tr_premi', $where)->num_rows();

      if ($cari != 0) {
      $this->db->delete('tr_premi', $where);
      }

      // input premi  
      $jml_c  = count($id_coverage);
      $data_c = [];

      for ($j=0; $j < $jml_c; $j++) { 
      
      $data_c[] = [ 'id_sppa_quotation' => $id_sppa,
                      'id_coverage'       => $id_coverage[$j],
                      'rate'              => $rate_all_premi[$j],
                      'nominal'           => str_replace('.','', $nominal_all_premi[$j]),
                      'add_time'          => date("Y-m-d H:i:s", now('Asia/Jakarta')),
                      'add_by'            => $this->session->userdata('id_user')
                  ];

      }

      $this->db->insert_batch('tr_premi', $data_c);

      // cek jika ada premi adt
      $cari_a = $this->entry_sppa->cari_data('tr_premi_adt', $where)->num_rows();

      if ($cari_a != 0) {
      $this->db->delete('tr_premi_adt', $where);
      }

      // input premi adt 
      $jml_a  = count($lob_adt);

      if ($jml_a != 0) {

      $data_a = [];

      for ($k=0; $k < $jml_a; $k++) { 

          $data_a[] = [   'id_sppa_quotation' => $id_sppa,
                          'id_lob'            => $lob_adt[$k],
                          'pengali_tsi'       => $pengali_tsi_adt[$k],
                          'kalkulasi_tsi'     => str_replace('.','', $kalkulasi_tsi_adt[$k]),
                          'rate'              => $rate_adt[$k],
                          'nominal'           => str_replace('.','', $nominal_adt[$k]),
                          'add_time'          => date("Y-m-d H:i:s", now('Asia/Jakarta')),
                          'add_by'            => $this->session->userdata('id_user')
                      ];

      }

      $this->db->insert_batch('tr_premi_adt', $data_a);

      }


      if($this->db->trans_status() === FALSE){
      $this->db->trans_rollback();

      echo json_encode(['status' => false]);
      }else{
      $this->db->trans_commit();

      echo json_encode(['id_sppa' => $id_sppa]);
      }
  }

  // 19-05-2021
  public function hapus_entry()
  {
    $id_sppa = $this->input->post('id_sppa');

    $this->db->trans_begin();

      $where = ['id_sppa_quotation' => $id_sppa];

      $cari2 = $this->entry_sppa->cari_data('tr_sppa_quotation', $where)->row_array();

      if ($cari2['id_pengguna_tertanggung'] != null) {
        $this->entry_sppa->hapus_data('pengguna_tertanggung', ['id_pengguna_tertanggung' => $cari2['id_pengguna_tertanggung']]);
      }

      $this->entry_sppa->hapus_data('tr_sppa_quotation', $where);
      $this->entry_sppa->hapus_data('tr_premi', $where);
      $this->entry_sppa->hapus_data('tr_premi_adt', $where);
      $this->entry_sppa->hapus_data('tr_histori_status_sob', $where);

      $cari = $this->entry_sppa->cari_data('dokumen_sppa', $where)->result_array();

      foreach ($cari as $c) {

        $file = $c['filename'];
        
        $path = "./upload/dokumen/".$file;
        unlink($path); 

      }

      $this->entry_sppa->hapus_data('dokumen_sppa', $where);

    if($this->db->trans_status() === FALSE){
      $this->db->trans_rollback();

      echo json_encode(['status' => false]);
    }else{
      $this->db->trans_commit();

      echo json_encode(['status' => true]);
    }
  }

  private function moveElement(&$array, $a, $b) {
      $p1 = array_splice($array, $a, 1);
      $p2 = array_splice($array, 0, $b);
      $array = array_merge($p2,$p1,$array);

      return $array;
  }

  public function ttes()
  {
    $cari = $this->entry_sppa->cari_data_order('coverage', ['id_lob' => 8], 'label', 'asc')->result_array();
    // $cari = $this->entry_sppa->cari_data('coverage', ['status' => 'standar'])->row_array();

    $ky = "";
    foreach ($cari as $key => $value) {
      if ($value['status'] == 'standar') {
        $ky = $key;
      }
    }

    echo "<pre>";
    print_r($this->moveElement($cari, $ky, 0));
    echo "</pre>";

  }

  // 10-05-2021
  public function show_premi($id_lob)
  {
    $html = "";

    $cari = $this->entry_sppa->cari_data_order('coverage', ['id_lob' => $id_lob], 'label', 'asc')->result_array();

    $total_persen = 0;

    $ky = "";
    foreach ($cari as $key => $value) {
      if ($value['status'] == 'standar') {
        $ky = $key;
      }
    }

    foreach ($this->moveElement($cari, $ky, 0) as $c) {

      $la = str_replace(' ','_',$c['label']);

      $label = ucwords(str_replace('&','dan',$la));
      
      $html .= "<div class='form-group row'>
                    <label for='no_klaim' class='col-sm-4 col-form-label'>Premi ".ucwords($c['status'])." ".$c['label']."</label>
                    <div class='col-sm-4'>
                      <div class='input-group'>
                        <input type='text' class='form-control text-right rate_all_premi persen total_premi p_persen_".$label."' value='".$c['rate']."' label='".$label."'>
                        <div class='input-group-append'>
                            <span class='input-group-text' id='basic-addon2'>%</span>
                        </div>
                      </div>
                    </div>
                    <div class='col-sm-4'>
                        <input type='text' class='form-control text-right nominal_all_premi premi_".$c['status']." total_premi_rp p_total_".$label."' name='".$c['label']."' aksi='".$c['status']."' value='0' label='".$label."' id_coverage='".$c['id_coverage']."' readonly>
                        <input type='hidden' class='p_total_asli_".$label." premi_asli_".$c['status']."'>
                    </div>
                </div>";

        $total_persen += (float) $c['rate'];
    }

    // cari lob
    $cari_2 = $this->entry_sppa->cari_lob($id_lob)->result_array();

    $option = "<option value=''>Pilih</option>";
    foreach ($cari_2 as $a) {
      $option .= "<option value='".$a['id_lob']."'>".$a['lob']."</option>";
    }

    // cari lob 2 
    $cari_3 = $this->entry_sppa->cari_data('m_lob', ['id_lob' => $id_lob])->row_array();

    echo json_encode(['htmlnya' => $html, 'total_rate' => $total_persen, 'option_lob' => $option, 'kondisi_diskon' => $cari_3['diskon']]);
  }

  public function shwfild($id)
  {
    if ($id != 'pilih') {
      $this->db->join('m_field_sppa_prop', 'm_field_sppa_prop.id_sppa_field_spec = m_sppa_field_spec.id_sppa_field_spec', 'left');
      $this->db->where('m_sppa_field_spec.id_relasi_cob_lob', $id);
      $this->db->order_by('m_field_sppa_prop.id_field_sppa_prop', 'asc');
      $hasil = $this->db->get('m_sppa_field_spec')->result();
      $data = array();
      foreach ($hasil as $key) {
        $this->db->where('id_field_sppa', $key->type_field);
        $hass = $this->db->get('m_field_sppa')->result();

        if ($key->input_type == 'A') {
          $txta = str_replace(" ","_", strtolower($hass[0]->field_sppa));
        } else {
          $txta = '';
        }

        $iss = array();
        $list['id_lob']               = $key->id_lob;
        $list['fieldnm']              = $hass[0]->field_sppa;
        $list['name_id']              = str_replace(" ","_", strtolower($hass[0]->field_sppa));
        $list['input_type']           = $key->input_type;
        $list['sparator_num']         = $key->sparator_number;
        $list['key_to_param']         = $key->key_to_param;
        $list['option_flag']          = $key->option_flag;
        $list['if_input_type_select'] = json_decode($key->if_input_type_select, true);
        $list['input_length']         = json_decode($key->input_length, true);
        $iss                          = forinput($list);

        $data[] = ["html" => $iss,
                   "txta" => $txta
                  ];
      }

    } else {
      $data = [];
    }
    
    echo json_encode($data);
  }

  public function settoc($id)
  {
    $ardata = array();
    $this->db->where('id_sob', $id);
    $nme = $this->db->get('m_sob')->result();
    switch ($id) {
      case 2:
        $this->db->select('id_asuransi as id, nama_asuransi as nama, telp');
        $this->db->order_by('nama', 'asc');
        $ardata[] = $this->db->get('m_asuransi')->result();
        break;
      case 3:
        $this->db->select('id_nasabah as id, nama_nasabah as nama, telp');
        $this->db->order_by('nama', 'asc');
        $ardata[] = $this->db->get('m_nasabah')->result();
        break;
      case 4:
        $this->db->select('id_agent as id, nama, telp');
        $this->db->order_by('nama', 'asc');
        $ardata[] = $this->db->get('m_agent')->result();
        break;
      case 5:
        $this->db->select('id_business_partner as id, nama, telp');
        $this->db->order_by('nama', 'asc');
        $ardata[] = $this->db->get('m_business_partner')->result();
        break;
      case 6:
        $this->db->select('id_direct as id, nama, telp');
        $this->db->order_by('nama', 'asc');
        $ardata[] = $this->db->get('m_direct')->result();
        break;
      case 7:
        $this->db->select('id_loss_adjuster as id, nama, telp');
        $this->db->order_by('nama', 'asc');
        $ardata[] = $this->db->get('m_loss_adjuster')->result();
        break;
      default:
        $ardata[] = [];
    }
    $ardata[] = $nme[0]->sob;
    echo json_encode($ardata);
  }

  public function showboth($id)
  {
    $data = $this->entry_sppa->joincoblob($id);
    echo json_encode($data);
  }

  public function showdetailn()
  {
    $idsob = $this->input->post('isob');
    $idtyp = $this->input->post('ityp');

    $ardata = array();
    if ($idsob != 'pilih') {
    $this->db->where('id_sob', $idsob);
    $nme = $this->db->get('m_sob')->result();

      if ($idtyp != 'pilih') {
        switch ($idsob) {
            case 2:
              $this->db->select('nama_asuransi as nama, alamat, telp');
              $this->db->where('id_asuransi', $idtyp);
              $ardata[] = $this->db->get('m_asuransi')->result();
              break;
            case 3:
              $this->db->select('nama_nasabah as nama, alamat_rumah as alamat, telp');
              $this->db->where('id_nasabah', $idtyp);
              $ardata[] = $this->db->get('m_nasabah')->result();
              break;
            case 4:
              $this->db->select('nama, alamat, telp');
              $this->db->where('id_agent', $idtyp);
              $ardata[] = $this->db->get('m_agent')->result();
              break;
            case 6:
              $this->db->select('nama, alamat, telp');
              $this->db->where('id_direct', $idtyp);
              $ardata[] = $this->db->get('m_direct')->result();
              break;
            case 5:
              $this->db->select('nama, alamat, telp');
              $this->db->where('id_business_partner', $idtyp);
              $ardata[] = $this->db->get('m_business_partner')->result();
              break;
            case 7:
              $this->db->select('nama, alamat, telp');
              $this->db->where('id_loss_adjuster', $idtyp);
              $ardata[] = $this->db->get('m_loss_adjuster')->result();
              break;
          }
          
      }
      $ardata[] = $nme[0]->sob;
    } else {
      $ardata[] = [];
    }
    
    
    echo json_encode($ardata);
  }

  public function create($value='')
  {
    $data = [
      'title' => 'Create Entry SPPA'
    ];
    $this->template->load('template/index', 'create', $data);
  }

  // AFIF
  // 100521
  public function simpan_dokumen()
  {
    $aksi         = $this->input->post('aksi');
    $desc         = $this->input->post('desc');
    $id_dokumen   = $this->input->post('id_dokumen');
    $nama_dokumen = $this->input->post('nama_dokumen');
    $id_sppa      = ($this->input->post('id_sppa') == '') ? null : $this->input->post('id_sppa');
    $sppa_number  = $this->input->post('sppa_number');

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
                  'sppa_number'       => $sppa_number,
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
                    'sppa_number'       => $sppa_number,
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
                  'sppa_number'       => $sppa_number,
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
            $aksi = "<a href='".base_url()."upload/dokumen/".$o['filename']."' class='mr-3 ttip' data-toggle='tooltip' data-placement='top' title='Download'><i class='mdi mdi-file-document-outline mdi-24px'></i></a>";
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

  // 07-07-2021
  public function download($filename)
  {
    force_download("upload/dokumen/$filename",NULL);
  }
  
  // 11-05-2021
  public function tampil_data_termin()
  {
    $id_sppa = $this->input->post('id_sppa');

    if ($id_sppa) {
    
      $list = $this->entry_sppa->cari_data_order('tr_termin_pembayaran', ['id_sppa_quotation' => $id_sppa], 'add_time', 'desc')->result_array();

      $data = array();

      $no   = $this->input->post('start');

      foreach ($list as $o) {
          $no++;
          $tbody = array();

          $tbody[]    = "<div align='center'>".$no.".</div>";
          $tbody[]    = $o['no_dokumen'];
          $tbody[]    = date("d-M-Y", strtotime($o['tgl_bayar']));
          $tbody[]    = number_format($o['jumlah'],0,',','.');
          $tbody[]    = $o['cara_bayar'];
          $tbody[]    = date("d-M-Y", strtotime($o['tgl_terima']));
          $tbody[]    = "<span style='cursor:pointer' class='mr-3 text-primary edit ttip' data-toggle='tooltip' data-placement='top' title='Ubah' data-id='".$o['id_termin_pembayaran']."'><i class='fas fa-pencil-alt fa-lg'></i></span><span style='cursor:pointer' class='text-danger hapus ttip' data-toggle='tooltip' data-placement='top' title='Hapus' data-id='".$o['id_termin_pembayaran']."'><i class='far fa-trash-alt fa-lg'></i></span>";
          $data[]     = $tbody;
      }

    
      echo json_encode(['data' => $data]);
    } else {
      echo json_encode(['data' => []]);
    }

  }

  public function simpan_data_termin()
  {
      $aksi           = $this->input->post('aksi');
      $id_termin      = $this->input->post('id_termin');
      $id_sppa        = $this->input->post('id_sppa');
      $no_dokumen     = $this->input->post('no_dokumen');
      $tgl_bayar      = $this->input->post('tgl_bayar');
      $jumlah         = $this->input->post('jumlah');
      $cara_bayar     = $this->input->post('cara_bayar');
      $tgl_terima     = $this->input->post('tgl_terima');
      $sppa_number    = $this->input->post('sppa_number');

      $data = [ 'id_sppa_quotation' => $id_sppa,
                'no_dokumen'        => $no_dokumen,
                'tgl_bayar'         => date("Y-m-d H:i:s", strtotime($tgl_bayar)),
                'jumlah'            => $jumlah,
                'cara_bayar'        => $cara_bayar,
                'tgl_terima'        => date("Y-m-d H:i:s", strtotime($tgl_terima)),
                'sppa_number'       => $sppa_number,
                'add_time'          => date("Y-m-d H:i:s", now('Asia/Jakarta')),
                'add_by'            => $this->session->userdata('sesi_id')
              ];

      if ($aksi == 'Tambah') {
          $this->entry_sppa->input_data('tr_termin_pembayaran', $data);
      } elseif ($aksi == 'Ubah') {
          $this->entry_sppa->ubah_data('tr_termin_pembayaran', $data, array('id_termin_pembayaran' => $id_termin));
      } elseif ($aksi == 'Hapus') {
          $this->entry_sppa->hapus_data('tr_termin_pembayaran', array('id_termin_pembayaran' => $id_termin));
      }

      echo json_encode($aksi);
  }

  public function ambil_data_termin($id_termin)
  {
    $cari = $this->entry_sppa->cari_data('tr_termin_pembayaran', ['id_termin_pembayaran' => $id_termin])->row_array();

    echo json_encode($cari);
  }

  public function no_polis()
  {
      $thn    = date('ymd', now('Asia/Jakarta'));
      $b      = random_int(1000, 10000);

      $kode   = "$thn$b";

      return $kode;
  }

  // 27-05-2021
  public function tampil_input()
  {
      $data = [ 'sppa_number' =>$this->sppa_number(),
                'list_sob'    => $this->entry_sppa->getsob(),
                'list_cob'    => $this->entry_sppa->list_cob(),
                'no_reff'     => $this->entry_sppa->get_data_order('mop', 'id_mop', 'desc')->result_array()
              ];

      $this->load->view('entry/input_tab', $data);
  }

  function hapus_value_array($array,$value)
  {
      foreach($array as $key=>$val)
      {
          if($val == $value)
          {
              unset($array[$key]);
          }
      }
      return $array;
  }

  // 16-06-2021
  public function tes2()
  {
    // $arr = Array
    // ( Array
    //         (
    //             'nama' => 'bambang',
    //             'telp' => '0823232327',
    //             ['jenis_asuransi'] => 'jiwa'
    //         ),
    //   Array
    //         (
    //             ['nama'] => 'yusuf',
    //             ['telp'] => '0823457789',
    //             ['jenis_asuransi'] => 'jiwa22'
    //         )
    
    // );

    $arr = $this->entry_sppa->get_data('tr_sppa_quotation')->row_array();

    echo "<pre>";
    print_r($arr);
    echo "</pre>";

  }

  public function fun1()
  {
    $a = "3sss2";
    echo "a is " . is_numeric($a) . "<br>";
  }

  public function nama_endorsment($id_mop)
  {
      $cari = $this->entry_sppa->cari_data_order('tr_endorsment', ['id_mop' => $id_mop], 'nama_endorsment', 'desc')->row_array();

      if ($cari != "") {

          $a =  strpos($cari['nama_endorsment'], "-");
          $b =  strlen($cari['nama_endorsment']); 
    
          $c =  substr($cari['nama_endorsment'], $a + 1, $b);
    
          $a = (int) "$c" + 1;
    
          $kd = str_pad($a, 5, "0", STR_PAD_LEFT);
    
      } else {
          $kd = str_pad(1, 5, "0", STR_PAD_LEFT);
      }

      return "Endorsment-".$kd;
  }

  // 21-07-2021
  public function simpan_semua_deklarasi_manual()
  {
    $f_client = $this->input->post('form_client');

    $client = array();
    parse_str($f_client, $client);

    $id_sppa        = $client['id_sppa'];
    $id_mop         = $client['id_mop'];
    $id_sob         = $client['id_sob'];
    $id_cob         = $client['id_cob'];
    $id_lob         = $client['id_lob'];
    $nama_sob       = $client['nama_sob'];
    $id_relasi      = $client['id_relasi'];
    $sppa_number    = $client['sppa_number'];
    $id_entry_sppa  = $client['id_entry_sppa'];

    $crm = $this->entry_sppa->cari_data('mop', ['id_mop' => $id_mop])->row_array();

    if ($id_lob == 'pilih' || $id_lob == '') {
      $id_lob = $crm['id_lob'];
    } else {
      $id_lob = $id_lob;
    }

    $this->db->trans_begin();

          $data = [ 'id_sob'            => ($id_sob == '') ? null : $id_sob,
                    'id_cob'            => $id_cob,
                    'id_lob'            => $id_lob,
                    'id_relasi_cob_lob' => $id_relasi,
                    'id_mop'            => $id_mop,
                    'add_time'          => date("Y-m-d H:i:s", now('Asia/Jakarta')),
                    'add_by'            => $this->session->userdata('sesi_id')
                ];

          $this->entry_sppa->input_data('tr_sppa_quotation', $data);
          $pq = $this->db->insert_id();

            $datah = ['id_sob'            => ($id_sob == '' || $id_sob == 'pilih') ? null : $id_sob,
                      'nama_sob'          => ($nama_sob == '' || $nama_sob == 'pilih') ? null : $nama_sob,
                      'id_sppa_quotation' => $pq,
                      'tanggal_perubahan' => date("Y-m-d", now('Asia/Jakarta')),
                      'add_time'          => date("Y-m-d H:i:s", now('Asia/Jakarta')),
                      'add_by'            => $this->session->userdata('sesi_id')
                    ];

            $this->db->insert('tr_histori_status_sob', $datah);
            
          //akhir histori status sob

          // tr endorsment

            $data_end = [ 'id_sppa_quotation' => $pq, 
                          'id_endorsment'     => $pq,
                          'id_mop'            => $id_mop,
                          'status'            => 'TAMBAH PESERTA',
                          'nama_endorsment'   => $this->nama_endorsment($id_mop),
                          'add_time'          => date("Y-m-d H:i:s", now('Asia/Jakarta')),
                          'add_by'            => $this->session->userdata('sesi_id')
            ];

            $this->entry_sppa->input_data('tr_endorsment', $data_end);

          // akhir tr endorsmnet
          
          // if ($jnss == 'binding') {
          //   // generate binding
          //   $nm1         = str_pad($pq, 3, "0", STR_PAD_LEFT);
          //   $date1       = date("Ymd", now('Asia/Jakarta'));
          //   $random1     = strtoupper(bin2hex(random_bytes(2)));
          //   $no_binding = "BND/$date1/LGW/BIN$nm1$random1";

          //   $this->db->update('tr_sppa_quotation', ['no_binding' => $no_binding], ['id_sppa_quotation' => $pq]);

          // }

            // generate binding
            $nm1         = str_pad($pq, 3, "0", STR_PAD_LEFT);
            $date1       = date("Ymd", now('Asia/Jakarta'));
            $random1     = strtoupper(bin2hex(random_bytes(2)));
            $no_binding = "BND/$date1/LGW/BIN$nm1$random1";

            $this->db->update('tr_sppa_quotation', ['no_binding' => $no_binding, 'sppa_number' => $this->sppa_number($pq)], ['id_sppa_quotation' => $pq]);

          // mop
          
            $cari = $this->entry_sppa->cari_data('mop', ['id_mop' => $id_mop])->row_array();

            $data_approve = [ 'id_sppa_quotation'    => $pq, 
                              'id_asuransi'          => $cari['id_insurer'],
                              'no_otorisasi_polis'   => $this->no_polis(),
                              'tgl_otorisasi'        => date("Y-m-d H:i:s", now('Asia/Jakarta')),
                              'tgl_approve'          => date("Y-m-d H:i:s", now('Asia/Jakarta')),
                              'id_pegawai'           => 4,
                              'keterangan_tambahan'  => "",
                              'add_time'             => date("Y-m-d H:i:s", now('Asia/Jakarta')),
                              'add_by'               => $this->session->userdata('sesi_id')
                        ];

            $this->entry_sppa->input_data('tr_approve_sppa', $data_approve);

            $cari2 = $this->entry_sppa->cari_data('tr_approve_sppa', ['id_sppa_quotation' => $pq])->row_array();

            $this->db->update('tr_sppa_quotation', ['approval' => true, 'no_polis' => $cari2['no_otorisasi_polis']], ['id_sppa_quotation' => $pq]);
                
          // akhir mop

          $carif = $this->entry_sppa->get_field_sppa($id_relasi);

          $c_j = $carif->num_rows();

          $c_k = $carif->result_array();

          if ($c_j != 0) {

            $f_detail = $this->input->post('form_detail');

            $detail = array();
            parse_str($f_detail, $detail);

            $data221  = [];
            $list_fil = [];

            foreach ($c_k as $c) {
                $nm_field = str_replace(" ","_", strtolower($c['field_sppa']));

                $fl = $detail[$nm_field];

                if ($fl == null || $fl == '') {
                  $fl = null;
                } else {
                  $fl = $fl;
                }

                if ($c['data_type'] == 'DATE') {
                    if ($fl != '' || $fl != null) {
                      $fl = date("Y-m-d", strtotime($fl));
                    } else {
                      $fl = $fl;
                    }
                }
                
                $data22 = [$nm_field => $fl];


                if ($c['cdb'] == 't') {

                  $data221 += [$nm_field => $fl];

                  array_push($list_fil, $data221);
                } else {
                  $this->db->update('tr_sppa_quotation', $data22, ['id_sppa_quotation' => $pq]);
                }
                
            }

          }


          if (!empty($list_fil)) {
            $ky = end(array_keys($list_fil));

            $data_ptg = $list_fil[$ky];

            $data_ptg2  = [ 'id_insured'  => $crm['id_insured'],
                            'add_time'    => date("Y-m-d H:i:s", now('Asia/Jakarta')),
                            'add_by'      => $this->session->userdata('sesi_id')
                          ];

            $this->db->insert('pengguna_tertanggung', $data_ptg);
            $id_data_ptg = $this->db->insert_id();

            $this->db->update('pengguna_tertanggung', $data_ptg2, ['id_pengguna_tertanggung' => $id_data_ptg]);
            
            $this->db->update('tr_sppa_quotation', ['id_pengguna_tertanggung' => $id_data_ptg], ['id_sppa_quotation' => $pq]);
          }

          // cari
          $c_l = $this->entry_sppa->cari_data('coverage', ['id_lob' => $id_lob])->num_rows();

          if ($c_l != 0) {

            // premi
            $tsi                = ($this->input->post('tsi') == '') ? null : $this->input->post('tsi');    
            $diskon             = ($this->input->post('diskon') == '') ? null : $this->input->post('diskon'); 
            $gross_premi        = ($this->input->post('gross_premi') == '') ? null : $this->input->post('gross_premi');    
            $total_diskon       = ($this->input->post('total_diskon') == '') ? null : $this->input->post('total_diskon');     
            $total_persen_premi = ($this->input->post('total_persen_premi') == '') ? null : $this->input->post('total_persen_premi');    
            $total_akhir_premi  = ($this->input->post('total_akhir_premi') == '') ? null : $this->input->post('total_akhir_premi');    
            $biaya_admin        = ($this->input->post('biaya_admin') == '') ? null : $this->input->post('biaya_admin');    
            $total_tagihan      = ($this->input->post('total_tagihan') == '') ? null : $this->input->post('total_tagihan');    
            $payment_method     = ($this->input->post('payment_method') == '') ? null : $this->input->post('payment_method');    
            $tahun_pay          = ($this->input->post('tahun_pay') == '') ? null : $this->input->post('tahun_pay');    
            $jumlah_cicilan     = ($this->input->post('jumlah_cicilan') == '') ? null : $this->input->post('jumlah_cicilan');    

            // array
            $lob_adt            = json_decode($this->input->post('lob_adt'), true);    
            $kalkulasi_tsi_adt  = json_decode($this->input->post('kalkulasi_tsi_adt'), true);    
            $pengali_tsi_adt    = json_decode($this->input->post('pengali_tsi_adt'), true);    
            $rate_adt           = json_decode($this->input->post('rate_adt'), true);    
            $nominal_adt        = json_decode($this->input->post('nominal_adt'), true);    
            $rate_all_premi     = json_decode($this->input->post('rate_all_premi'), true);    
            $nominal_all_premi  = json_decode($this->input->post('nominal_all_premi'), true);    
            $id_coverage        = json_decode($this->input->post('id_coverage'), true);    
            $premi_standar      = json_decode($this->input->post('premi_standar'), true);    
            $premi_perluasan    = json_decode($this->input->post('premi_perluasan'), true);    

            // print_r($lob_adt); exit();

            // simpan tr sppa
            $jml    = count($premi_standar);
            $jml_p  = count($premi_perluasan);
            
            $tt_premi_standar = 0;
            for ($i=0; $i < $jml; $i++) { 
              
              $tt_premi_standar += $premi_standar[$i];

            }

            $tt_premi_pls = 0;
            for ($k=0; $k < $jml_p; $k++) { 
              
              $tt_premi_pls += $premi_perluasan[$k];

            }

            $datatt = [ 'total_sum_insured'       => $tsi,
                        'diskon'                  => $diskon,
                        'gross_premi'             => str_replace('.','', $gross_premi),
                        'total_diskon'            => str_replace('.','', $total_diskon),
                        'total_akhir_premi'       => str_replace('.','', $total_akhir_premi),
                        'total_rate_akhir_premi'  => $total_persen_premi,
                        'total_premi_standar'     => $tt_premi_standar,
                        'total_premi_perluasan'   => $tt_premi_pls,
                        'biaya_admin'             => $biaya_admin,
                        'total_tagihan'           => $total_tagihan,
                        'payment_method'          => $payment_method,
                        'tahun_cicilan'           => ($tahun_pay) ? $tahun_pay : null,
                        'jumlah_cicilan'          => ($jumlah_cicilan) ? $jumlah_cicilan : null
                      ];

            $where = ['id_sppa_quotation' => $pq];

            $this->db->update('tr_sppa_quotation', $datatt, $where);

            // cek jika ada premi
            $cari = $this->entry_sppa->cari_data('tr_premi', $where)->num_rows();

            if ($cari != 0) {
              $this->db->delete('tr_premi', $where);
            }

            // input premi  
            $jml_c  = count($id_coverage);
            $data_c = [];

            for ($j=0; $j < $jml_c; $j++) { 
              
              $data_c[] = [ 'id_sppa_quotation' => $pq,
                            'id_coverage'       => $id_coverage[$j],
                            'rate'              => $rate_all_premi[$j],
                            'nominal'           => str_replace('.','', $nominal_all_premi[$j]),
                            'add_time'          => date("Y-m-d H:i:s", now('Asia/Jakarta')),
                            'add_by'            => $this->session->userdata('sesi_id')
                          ];

            }

            $this->db->insert_batch('tr_premi', $data_c);

            // cek jika ada premi adt
            $cari_a = $this->entry_sppa->cari_data('tr_premi_adt', $where)->num_rows();

            if ($cari_a != 0) {
              $this->db->delete('tr_premi_adt', $where);
            }

            // input premi adt 
            $jml_a  = count($lob_adt);

            if ($jml_a != 0) {

              $data_a = [];

              for ($k=0; $k < $jml_a; $k++) { 
                
                $data_a[] = [ 'id_sppa_quotation' => $pq,
                              'id_lob'            => $lob_adt[$k],
                              'pengali_tsi'       => $pengali_tsi_adt[$k],
                              'kalkulasi_tsi'     => str_replace('.','', $kalkulasi_tsi_adt[$k]),
                              'rate'              => $rate_adt[$k],
                              'nominal'           => str_replace('.','', $nominal_adt[$k]),
                              'add_time'          => date("Y-m-d H:i:s", now('Asia/Jakarta')),
                              'add_by'            => $this->session->userdata('sesi_id')
                            ];

              }

              $this->db->insert_batch('tr_premi_adt', $data_a);

            }

          }

          // generate invoice
          $nm       = str_pad($pq, 5, "0", STR_PAD_LEFT);
          $date     = date("Ymd", now('Asia/Jakarta'));
          $random   = strtoupper(bin2hex(random_bytes(4)));

          $nmr_invoice = "INV/$date/Entry/$random";

          $where = ['id_sppa_quotation' => $pq];

          $cari11 = $this->entry_sppa->cari_data('tr_sppa_quotation', $where)->row_array();

          if ($cari11['no_invoice_entry'] == '') {
            $this->db->update('tr_sppa_quotation', ['no_invoice_entry' => $nmr_invoice], $where);
          }

          // cari detail sob
          $cari2  = $this->entry_sppa->cari_data('tr_histori_status_sob', $where)->row_array();
          $cari3  = $this->entry_sppa->cari_data('m_sob', ['id_sob' => $cari2['id_sob']])->row_array();
          $wh_sob = $cari2['nama_sob'];

            switch ($cari2['id_sob']) {
                case 2:
                  $this->db->select('nama_asuransi as nama, alamat, telp');
                  $this->db->where('id_asuransi', $wh_sob);
                  $data_sob = $this->db->get('m_asuransi')->row_array();
                  break;
                case 3:
                  $this->db->select('nama_nasabah as nama, alamat_rumah as alamat, telp');
                  $this->db->where('id_nasabah', $wh_sob);
                  $data_sob = $this->db->get('m_nasabah')->row_array();
                  break;
                case 4:
                  $this->db->select('nama, alamat, telp');
                  $this->db->where('id_agent', $wh_sob);
                  $data_sob = $this->db->get('m_agent')->row_array();
                  break;
                case 6:
                  $this->db->select('nama, alamat, telp');
                  $this->db->where('id_direct', $wh_sob);
                  $data_sob = $this->db->get('m_direct')->row_array();
                  break;
                case 5:
                  $this->db->select('nama, alamat, telp');
                  $this->db->where('id_business_partner', $wh_sob);
                  $data_sob = $this->db->get('m_business_partner')->row_array();
                  break;
                case 7:
                  $this->db->select('nama, alamat, telp');
                  $this->db->where('id_loss_adjuster', $wh_sob);
                  $data_sob = $this->db->get('m_loss_adjuster')->row_array();
                  break;
              }

          $cpremi = $this->entry_sppa->get_premi($pq)->result_array();

          $ky = "";
          foreach ($cpremi as $key => $value) {
            if ($value['status'] == 'standar') {
              $ky = $key;
            }
          }
    
          $ls_premi = $this->moveElement($cpremi, $ky, 0);

          $datai = ['tr_sppa'    => $this->entry_sppa->cari_data('tr_sppa_quotation', $where)->row_array(),
                  'premi'      => $ls_premi,
                  'premi_adt'  => $this->entry_sppa->get_premi_adt($pq)->result_array(),
                  'sob'        => $cari3['sob'],
                  'data_sob'   => $data_sob
                  ];

          $mpdf = new \Mpdf\Mpdf();
          $html = $this->load->view('entry/invoice',$datai,true);

          $mpdf->WriteHTML($html);
          $mpdf->Output("upload/entry/INV$nm.pdf",'F');

          $nm_file = "INV$nm.pdf";

          $where = ['id_sppa_quotation' => $pq];

          $this->db->update('tr_sppa_quotation', ['file_invoice' => $nm_file], $where);
        
          // termin 
          $this->db->update('tr_termin_pembayaran', ['id_sppa_quotation' => $pq], ['sppa_number' => $this->sppa_number($pq)]);
        
        

    if($this->db->trans_status() === FALSE){
      $this->db->trans_rollback();

      echo json_encode(['status' => false]);
    }else{
      $this->db->trans_commit();

      echo json_encode(['id_sppa' => "", 'id_mop' => $id_mop]);
    }
  }

  public function tes_unik()
  {
    $cari2 = $this->entry_sppa->get_field_unik(4)->result_array();

    

    // $arr = [];
    $i = 0;
    foreach ($cari2 as $c) {
      $fl = str_replace(' ', '_', strtolower($c['field_sppa']));

      $arr[$fl] = $i;

      $i++;
    }

    echo "<pre>";
    print_r($arr);
    echo "</pre>";

    // if (!empty($cari2)) {

    //   foreach ($temp4 as $key => $t) {
    //     // if ($t['jenis_asuransi'] == 'rttt2222') {
    //     //   unset($temp4[$key]);
    //     // }
          
    //       // cari di tabel mana
    //       if ($cari2['cdb'] == 't') {
    //         $cari3 = $this->entry_sppa->cari_data('pengguna_tertanggung', [$fl => $t[$fl], 'id_insured' => $crm['id_insured']])->num_rows();
    //       } else {
    //         $cari3 = $this->entry_sppa->cari_data('tr_sppa_quotation', [$fl => $t[$fl], 'id_mop' => $id_mop])->num_rows();
    //       }

    //       if ($cari3 != 0) {
    //         unset($temp4[$key]);
    //       }

        
    //   }

    //   if (count(array_values($temp4)) == 0) {
    //     echo json_encode(['status' => 'semua data sudah ada']);
    //     exit();
    //   }

    // }


  }

  // 04-06-2021
  public function simpan_semua_deklarasi()
  {
    $f_client = $this->input->post('form_client');

    $client = array();
    parse_str($f_client, $client);

    $id_sppa        = $client['id_sppa'];
    $id_mop         = $client['id_mop'];
    $id_sob         = $client['id_sob'];
    $id_cob         = $client['id_cob'];
    $id_lob         = $client['id_lob'];
    $nama_sob       = $client['nama_sob'];
    $id_relasi      = $client['id_relasi'];
    $sppa_number    = $client['sppa_number'];
    $id_entry_sppa  = $client['id_entry_sppa'];

    $crm = $this->entry_sppa->cari_data('mop', ['id_mop' => $id_mop])->row_array();

    if ($id_lob == 'pilih' || $id_lob == '') {
      $id_lob = $crm['id_lob'];
    } else {
      $id_lob = $id_lob;
    }

    $this->db->trans_begin();

    // $data = [ 'id_sob'            => ($id_sob == '') ? null : $id_sob,
    //           'id_cob'            => $id_cob,
    //           'id_lob'            => $id_lob,
    //           'id_relasi_cob_lob' => $id_relasi,
    //           'sppa_number'       => $sppa_number,
    //           'add_time'          => date("Y-m-d H:i:s", now('Asia/Jakarta')),
    //           'add_by'            => $this->session->userdata('sesi_id')
    //       ];

    //   if ($id_sppa != '') {
    //     $this->entry_sppa->ubah_data('tr_sppa_quotation', $data, ['id_sppa_quotation' => $id_sppa]);
    //     $id_sppa = $id_sppa;
    //   } else {
    //     $this->entry_sppa->input_data('tr_sppa_quotation', $data);
    //     $id_sppa = $this->db->insert_id();
    //   }

      $path = $_FILES["upload_excel"]["tmp_name"];
      $object = PHPExcel_IOFactory::load($path);

      $a = 0;
      foreach($object->getWorksheetIterator() as $worksheet)
      {
        $highestRow   = $worksheet->getHighestRow();
        $highestColumn = $worksheet->getHighestColumn();

        $rw = 2;
        // for($row1=0; $row1 <= $highestRow; $row1++) {
        //   $tt = $worksheet->getCellByColumnAndRow($row1, 1)->getValue();
        //   $hd = str_replace(' ', '_', strtolower($tt));

        //   $tem[] = $hd;

        //   $rw++;
        // }

        $row = 1;
        $lastColumn = $worksheet->getHighestColumn();
        $lastColumn++;
        for ($column = 'A'; $column != $lastColumn; $column++) {
             $cell = $worksheet->getCell($column.$row);

             $hd = str_replace(' ', '_', strtolower($cell));

            $tem[] = $hd;

            $rw++;
        }

        $te = $this->hapus_value_array($tem, "");

        for($row=2; $row<=$highestRow; $row++)
        {

          $temp3 = [];
          $temp2 = [];
          for ($i=0; $i < count($te); $i++) { 

            $field = $worksheet->getCellByColumnAndRow($i, $row)->getValue();

            $temp2 += [$te[$i] => $field];

            $temp3 = $temp2;
            
          }

          $temp4[] = $temp3;
        
        }
        
        $a++;

      }

      // cari field status field unik true
      $cari2 = $this->entry_sppa->get_field_unik($id_relasi)->result_array();

      $fl = str_replace(' ', '_', strtolower($cari2['field_sppa']));

      if (!empty($cari2)) {

        // foreach ($temp4 as $key => $t) {
        //   // if ($t['jenis_asuransi'] == 'rttt2222') {
        //   //   unset($temp4[$key]);
        //   // }

        //   // cari di tabel mana
        //   if ($cari2['cdb'] == 't') {
        //     $cari3 = $this->entry_sppa->cari_data('pengguna_tertanggung', [$fl => $t[$fl], 'id_insured' => $crm['id_insured']])->num_rows();
        //   } else {
        //     $cari3 = $this->entry_sppa->cari_data('tr_sppa_quotation', [$fl => $t[$fl], 'id_mop' => $id_mop])->num_rows();
        //   }

        //   if ($cari3 != 0) {
        //     unset($temp4[$key]);
        //   }
        // }

        // if (count(array_values($temp4)) == 0) {
        //   echo json_encode(['status' => 'semua data sudah ada']);
        //   exit();
        // }

        foreach ($temp4 as $key => $t) {

          foreach ($cari2 as $c) {
            $fl = str_replace(' ', '_', strtolower($c['field_sppa']));

            $dt = $c['data_type'];

            if ($dt == 'INT8' || $dt == 'FLOAT8') {
              $is = $t[$fl];
            } else {
              $is = (string) $t[$fl];
            }
      
            $arr[$fl]       = $is;
            $arr['id_mop']  = $id_mop;

            $arr_pt[$fl]          = $is;
            $arr_pt['id_insured'] = $crm['id_insured'];
      
          }

          if ($cari2['cdb'] == 't') {
            $cari3 = $this->entry_sppa->cari_data('pengguna_tertanggung', $arr_pt)->num_rows();
          } else {
            $cari3 = $this->entry_sppa->cari_data('tr_sppa_quotation', $arr)->num_rows();
          }

          if ($cari3 != 0) {
            unset($temp4[$key]);
          }

        }

        // print_r(array_values($temp4));
        // exit();

        if (count(array_values($temp4)) == 0) {
          echo json_encode(['status' => 'semua data sudah ada']);
          exit();
        }

      }

      $jnss = $this->input->post('jenis'); 
          
      if ($jnss == 'binding') {
        $nm_endorsment  = $this->nama_endorsment($id_mop);
        $sts_tambah     = "TAMBAH PESERTA";
      } else {
        $nm_endorsment  = "Endorsment-00000";
        $sts_tambah     = "TAMBAH SPPA";
      }

      $cr2n = 0;
      $cr3n = 0;

      for ($v=0; $v < count($tem); $v++) { 

          $cr2 = $this->entry_sppa->get_field_sppa_cari($id_relasi, $tem[$v])->num_rows();

          if ($cr2 != 0) {
            $cr2n = $cr2n + 1;
          } else {
            $cr3n = $cr3n + 1;
          }

          // echo $cr2;
          // echo "<br>";

      }

      // echo $cr2n;
      // exit();

      $cr3 = $this->entry_sppa->get_field_sppa($id_relasi)->num_rows();

      // if ($cr2n < $cr3) {

      //   echo json_encode(['status' => 'gagal']);
      //   exit();
        
      // }

      if ($cr2n != $cr3 || $cr3n != 0) {

        echo json_encode(['status' => 'gagal']);
        exit();
        
      }

      // print_r(array_values($temp4)); 
      // exit();

      // save cdb
      foreach (array_values($temp4) as $k) {

            $dt  = [];
            $dt2 = [];
            foreach ($k as $key => $value) {

              $ky = str_replace('_', ' ', $key);
              $k = ucwords($ky);

              // echo $k;
              // exit();

              $cari = $this->entry_sppa->cari_data('m_field_sppa', ['field_sppa' => $k])->row_array();

              // jika ada field yang tidak ada di field sppa
              if (empty($cari)) {

                $data1 = ['field_sppa'  => $k,
                          'data_type'   => 'VARCHAR',
                          'cdb'         => true,
                          'add_time'    => date('Y-m-d H:i:s', now('Asia/Jakarta')),
                          'add_by'      => $this->session->userdata('sesi_id')
                        ];

                $this->db->insert('m_field_sppa', $data1);

                $this->db->query("ALTER TABLE pengguna_tertanggung ADD COLUMN $key VARCHAR");

              }

              $cari2 = $this->entry_sppa->cari_data('m_field_sppa', ['field_sppa' => $k])->row_array();

              if ($value == null || $value == '') {
                $value = null;
              } else {
                if ($cari2['data_type'] == 'DATE') {
                  // $value = (is_numeric($value) == 1) ? $value : '';
                  $value = date("Y-m-d", strtotime($value));
                } elseif ($cari2['data_type'] == 'FLOAT8' || $cari2['data_type'] == 'INT8') {
                  $value = (is_numeric($value) == 1) ? $value : '0';
                  
                } else {
                  $value = $value;
                }
                
              }

              if ($cari2['cdb'] == 't') {

                $dt += [$key => $value];

              } else {

                $dt2 += [$key => $value];
              }

              
            }

            $dt += ['id_insured'  => $crm['id_insured'],
                    'add_by'      => $this->session->userdata('sesi_id'),
                    'add_time'    => date('Y-m-d H:i:s', now('Asia/Jakarta'))
                   ];

            $this->db->insert('pengguna_tertanggung', $dt);
            $pt = $this->db->insert_id();

            if (empty($dt2)) {
              $dt22 = [   'id_sob'            => ($id_sob == '' || $id_sob == 'pilih') ? null : $id_sob,
                          'id_cob'            => $id_cob,
                          'id_lob'            => $id_lob,
                          'id_relasi_cob_lob' => $id_relasi,
                          'id_mop'            => $id_mop,
                          'approval'          => true,
                          'status_aktif'      => true,
                          'add_by'            => $this->session->userdata('sesi_id'),
                          'add_time'          => date('Y-m-d H:i:s', now('Asia/Jakarta'))
                      ];

            } else {
              $dt22 = $dt2;
            }
            
            $this->db->insert('tr_sppa_quotation', $dt22);
            $pq = $this->db->insert_id();
            
            if ($pt != '') {
              $this->db->update('tr_sppa_quotation', ['id_pengguna_tertanggung' => $pt], ['id_sppa_quotation' => $pq]);
            } 

            if ($pt != '') {
              $dt3 = [  'id_sob'            => ($id_sob == '' || $id_sob == 'pilih') ? null : $id_sob,
                        'id_cob'            => $id_cob,
                        'id_lob'            => $id_lob,
                        'id_relasi_cob_lob' => $id_relasi,
                        'id_mop'            => $id_mop,
                        'approval'          => true,
                        'status_aktif'      => true,
                        'sppa_number'       => $this->sppa_number($pq),
                        'add_by'            => $this->session->userdata('sesi_id'),
                        'add_time'          => date('Y-m-d H:i:s', now('Asia/Jakarta'))
                      ];

              $this->db->update('tr_sppa_quotation', $dt3, ['id_sppa_quotation' => $pq]);
            }

            // histori status sob
            $nama = $dt['nama'];
            $telp = $dt['telp'];

            if ($dt['nama'] && $dt['telp']) {

              $arr = ['insurer', 'insured', 'agent', 'direct', 'business_partner', 'loss_adjuster'];
              
              for ($i=0; $i < count($arr); $i++) { 

                $el = $arr[$i];

                if ($el == 'insurer') {
                  $el = 'asuransi';
                }
                if ($el == 'insured') {
                  $el = 'nasabah';
                }

                if ($el == 'asuransi') {
                  $nm = 'nama_asuransi';
                } elseif ($el == 'nasabah') {
                  $nm = 'nama_nasabah';
                } else {
                  $nm = 'nama';
                }

                $this->db->where($nm, $nama);
                $this->db->where('telp', "$telp");
                $data_sob = $this->db->get("m_$el")->row_array();

                if (!empty($data_sob)) {
                  $id_detail_sobb = $data_sob["id_$el"];
                }

                // cari di sob
                $nm_el = ucwords(str_replace("_", " ", $arr[$i]));
                
                $cr_sob = $this->entry_sppa->cari_data("m_sob", ['sob' => $nm_el])->row_array();
                $id_sobb = $cr_sob["id_sob"];

              }

              if (($id_sobb != '' || $id_sobb != 'pilih') && ($id_detail_sobb != '' || $id_detail_sobb != 'pilih')) {

                $dt_h = [ 'id_sob'             => $id_sobb,
                          'nama_sob'           => $id_detail_sobb,
                          'tanggal_perubahan'  => date("Y-m-d"),
                          'id_sppa_quotation'  => $pq,
                          'add_time'           => date('Y-m-d H:i:s', now('Asia/Jakarta')),
                          'add_by'             => $this->session->userdata('sesi_id')
                        ];

                $this->db->insert('tr_histori_status_sob', $dt_h);

              } else {

                $datah = ['id_sob'            => ($id_sob == '' || $id_sob == 'pilih') ? null : $id_sob,
                          'nama_sob'          => ($nama_sob == '' || $nama_sob == 'pilih') ? null : $nama_sob,
                          'id_sppa_quotation' => $pq,
                          'tanggal_perubahan' => date("Y-m-d", now('Asia/Jakarta')),
                          'add_time'          => date("Y-m-d H:i:s", now('Asia/Jakarta')),
                          'add_by'            => $this->session->userdata('sesi_id')
                        ];

                $this->db->insert('tr_histori_status_sob', $datah);
                
              }
            
            } else {

              $datah = ['id_sob'            => ($id_sob == '' || $id_sob == 'pilih') ? null : $id_sob,
                        'nama_sob'          => ($nama_sob == '' || $nama_sob == 'pilih') ? null : $nama_sob,
                        'id_sppa_quotation' => $pq,
                        'tanggal_perubahan' => date("Y-m-d", now('Asia/Jakarta')),
                        'add_time'          => date("Y-m-d H:i:s", now('Asia/Jakarta')),
                        'add_by'            => $this->session->userdata('sesi_id')
                      ];

              $this->db->insert('tr_histori_status_sob', $datah);
              
            }
          //akhir histori status sob

          

          // tr endorsment

            $data_end = [ 'id_sppa_quotation' => $pq, 
                          'id_endorsment'     => $pq,
                          'id_mop'            => $id_mop,
                          'status'            => $sts_tambah,
                          'nama_endorsment'   => $nm_endorsment,
                          'add_time'          => date("Y-m-d H:i:s", now('Asia/Jakarta')),
                          'add_by'            => $this->session->userdata('sesi_id')
            ];

            $this->entry_sppa->input_data('tr_endorsment', $data_end);

          // akhir tr endorsmnet
          
          // if ($jnss == 'binding') {
          //   // generate binding
          //   $nm1         = str_pad($pq, 3, "0", STR_PAD_LEFT);
          //   $date1       = date("Ymd", now('Asia/Jakarta'));
          //   $random1     = strtoupper(bin2hex(random_bytes(2)));
          //   $no_binding = "BND/$date1/LGW/BIN$nm1$random1";

          //   $this->db->update('tr_sppa_quotation', ['no_binding' => $no_binding], ['id_sppa_quotation' => $pq]);

          // }

            // generate binding
            $nm1         = str_pad($pq, 3, "0", STR_PAD_LEFT);
            $date1       = date("Ymd", now('Asia/Jakarta'));
            $random1     = strtoupper(bin2hex(random_bytes(2)));
            $no_binding = "BND/$date1/LGW/BIN$nm1$random1";

            $this->db->update('tr_sppa_quotation', ['no_binding' => $no_binding, 'sppa_number' => $this->sppa_number($pq)], ['id_sppa_quotation' => $pq]);

            

          // mop
          
            $cari = $this->entry_sppa->cari_data('mop', ['id_mop' => $id_mop])->row_array();

            $data_approve = [ 'id_sppa_quotation'    => $pq, 
                              'id_asuransi'          => $cari['id_insurer'],
                              'no_otorisasi_polis'   => $this->no_polis(),
                              'tgl_otorisasi'        => date("Y-m-d H:i:s", now('Asia/Jakarta')),
                              'tgl_approve'          => date("Y-m-d H:i:s", now('Asia/Jakarta')),
                              'id_pegawai'           => 4,
                              'keterangan_tambahan'  => "",
                              'add_time'             => date("Y-m-d H:i:s", now('Asia/Jakarta')),
                              'add_by'               => $this->session->userdata('sesi_id')
                        ];

            $this->entry_sppa->input_data('tr_approve_sppa', $data_approve);

            $cari2 = $this->entry_sppa->cari_data('tr_approve_sppa', ['id_sppa_quotation' => $pq])->row_array();

            $this->db->update('tr_sppa_quotation', ['approval' => true, 'no_polis' => $cari2['no_otorisasi_polis']], ['id_sppa_quotation' => $pq]);
                
          // akhir mop
          

          // dok 
          $this->db->update('dokumen_sppa', ['id_sppa_quotation' => $pq], ['sppa_number' => $this->sppa_number($pq)]);

          

          // cari
          $c_l = $this->entry_sppa->cari_data('coverage', ['id_lob' => $id_lob])->num_rows();

          if ($c_l != 0) {

            // premi
            $tsi                = ($this->input->post('tsi') == '') ? null : $this->input->post('tsi');    
            $diskon             = ($this->input->post('diskon') == '') ? null : $this->input->post('diskon'); 
            $gross_premi        = ($this->input->post('gross_premi') == '') ? null : $this->input->post('gross_premi');    
            $total_diskon       = ($this->input->post('total_diskon') == '') ? null : $this->input->post('total_diskon');     
            $total_persen_premi = ($this->input->post('total_persen_premi') == '') ? null : $this->input->post('total_persen_premi');    
            $total_akhir_premi  = ($this->input->post('total_akhir_premi') == '') ? null : $this->input->post('total_akhir_premi');    
            $biaya_admin        = ($this->input->post('biaya_admin') == '') ? null : $this->input->post('biaya_admin');    
            $total_tagihan      = ($this->input->post('total_tagihan') == '') ? null : $this->input->post('total_tagihan');    
            $payment_method     = ($this->input->post('payment_method') == '') ? null : $this->input->post('payment_method');    
            $tahun_pay          = ($this->input->post('tahun_pay') == '') ? null : $this->input->post('tahun_pay');    
            $jumlah_cicilan     = ($this->input->post('jumlah_cicilan') == '') ? null : $this->input->post('jumlah_cicilan');    

            // array
            $lob_adt            = json_decode($this->input->post('lob_adt'), true);    
            $kalkulasi_tsi_adt  = json_decode($this->input->post('kalkulasi_tsi_adt'), true);    
            $pengali_tsi_adt    = json_decode($this->input->post('pengali_tsi_adt'), true);    
            $rate_adt           = json_decode($this->input->post('rate_adt'), true);    
            $nominal_adt        = json_decode($this->input->post('nominal_adt'), true);    
            $rate_all_premi     = json_decode($this->input->post('rate_all_premi'), true);    
            $nominal_all_premi  = json_decode($this->input->post('nominal_all_premi'), true);    
            $id_coverage        = json_decode($this->input->post('id_coverage'), true);    
            $premi_standar      = json_decode($this->input->post('premi_standar'), true);    
            $premi_perluasan    = json_decode($this->input->post('premi_perluasan'), true);    

            // print_r($lob_adt); exit();

            // simpan tr sppa
            $jml    = count($premi_standar);
            $jml_p  = count($premi_perluasan);
            
            $tt_premi_standar = 0;
            for ($i=0; $i < $jml; $i++) { 
              
              $tt_premi_standar += $premi_standar[$i];

            }

            $tt_premi_pls = 0;
            for ($k=0; $k < $jml_p; $k++) { 
              
              $tt_premi_pls += $premi_perluasan[$k];

            }

            $datatt = [ 'total_sum_insured'       => $tsi,
                        'diskon'                  => $diskon,
                        'gross_premi'             => str_replace('.','', $gross_premi),
                        'total_diskon'            => str_replace('.','', $total_diskon),
                        'total_akhir_premi'       => str_replace('.','', $total_akhir_premi),
                        'total_rate_akhir_premi'  => $total_persen_premi,
                        'total_premi_standar'     => $tt_premi_standar,
                        'total_premi_perluasan'   => $tt_premi_pls,
                        'biaya_admin'             => $biaya_admin,
                        'total_tagihan'           => $total_tagihan,
                        'payment_method'          => $payment_method,
                        'tahun_cicilan'           => ($tahun_pay) ? $tahun_pay : null,
                        'jumlah_cicilan'          => ($jumlah_cicilan) ? $jumlah_cicilan : null
                      ];

            $where = ['id_sppa_quotation' => $pq];

            $this->db->update('tr_sppa_quotation', $datatt, $where);

            // cek jika ada premi
            $cari = $this->entry_sppa->cari_data('tr_premi', $where)->num_rows();

            if ($cari != 0) {
              $this->db->delete('tr_premi', $where);
            }

            // input premi  
            $jml_c  = count($id_coverage);
            $data_c = [];

            for ($j=0; $j < $jml_c; $j++) { 
              
              $data_c[] = [ 'id_sppa_quotation' => $pq,
                            'id_coverage'       => $id_coverage[$j],
                            'rate'              => $rate_all_premi[$j],
                            'nominal'           => str_replace('.','', $nominal_all_premi[$j]),
                            'add_time'          => date("Y-m-d H:i:s", now('Asia/Jakarta')),
                            'add_by'            => $this->session->userdata('sesi_id')
                          ];

            }

            $this->db->insert_batch('tr_premi', $data_c);

            // cek jika ada premi adt
            $cari_a = $this->entry_sppa->cari_data('tr_premi_adt', $where)->num_rows();

            if ($cari_a != 0) {
              $this->db->delete('tr_premi_adt', $where);
            }

            // input premi adt 
            $jml_a  = count($lob_adt);

            if ($jml_a != 0) {

              $data_a = [];

              for ($k=0; $k < $jml_a; $k++) { 
                
                $data_a[] = [ 'id_sppa_quotation' => $pq,
                              'id_lob'            => $lob_adt[$k],
                              'pengali_tsi'       => $pengali_tsi_adt[$k],
                              'kalkulasi_tsi'     => str_replace('.','', $kalkulasi_tsi_adt[$k]),
                              'rate'              => $rate_adt[$k],
                              'nominal'           => str_replace('.','', $nominal_adt[$k]),
                              'add_time'          => date("Y-m-d H:i:s", now('Asia/Jakarta')),
                              'add_by'            => $this->session->userdata('sesi_id')
                            ];

              }

              $this->db->insert_batch('tr_premi_adt', $data_a);

            }

          }

          // generate invoice
          $nm       = str_pad($pq, 5, "0", STR_PAD_LEFT);
          $date     = date("Ymd", now('Asia/Jakarta'));
          $random   = strtoupper(bin2hex(random_bytes(4)));

          $nmr_invoice = "INV/$date/Entry/$random";

          $where = ['id_sppa_quotation' => $pq];

          $cari11 = $this->entry_sppa->cari_data('tr_sppa_quotation', $where)->row_array();

          if ($cari11['no_invoice_entry'] == '') {
            $this->db->update('tr_sppa_quotation', ['no_invoice_entry' => $nmr_invoice], $where);
          }

          // cari detail sob
          $cari2  = $this->entry_sppa->cari_data('tr_histori_status_sob', $where)->row_array();
          $cari3  = $this->entry_sppa->cari_data('m_sob', ['id_sob' => $cari2['id_sob']])->row_array();
          $wh_sob = $cari2['nama_sob'];

            switch ($cari2['id_sob']) {
                case 2:
                  $this->db->select('nama_asuransi as nama, alamat, telp');
                  $this->db->where('id_asuransi', $wh_sob);
                  $data_sob = $this->db->get('m_asuransi')->row_array();
                  break;
                case 3:
                  $this->db->select('nama_nasabah as nama, alamat_rumah as alamat, telp');
                  $this->db->where('id_nasabah', $wh_sob);
                  $data_sob = $this->db->get('m_nasabah')->row_array();
                  break;
                case 4:
                  $this->db->select('nama, alamat, telp');
                  $this->db->where('id_agent', $wh_sob);
                  $data_sob = $this->db->get('m_agent')->row_array();
                  break;
                case 6:
                  $this->db->select('nama, alamat, telp');
                  $this->db->where('id_direct', $wh_sob);
                  $data_sob = $this->db->get('m_direct')->row_array();
                  break;
                case 5:
                  $this->db->select('nama, alamat, telp');
                  $this->db->where('id_business_partner', $wh_sob);
                  $data_sob = $this->db->get('m_business_partner')->row_array();
                  break;
                case 7:
                  $this->db->select('nama, alamat, telp');
                  $this->db->where('id_loss_adjuster', $wh_sob);
                  $data_sob = $this->db->get('m_loss_adjuster')->row_array();
                  break;
              }

          $cpremi = $this->entry_sppa->get_premi($pq)->result_array();

          $ky = "";
          foreach ($cpremi as $key => $value) {
            if ($value['status'] == 'standar') {
              $ky = $key;
            }
          }

          $ls_premi = $this->moveElement($cpremi, $ky, 0);

          

          $datai = ['tr_sppa'    => $this->entry_sppa->cari_data('tr_sppa_quotation', $where)->row_array(),
                    'premi'      => $ls_premi,
                    'premi_adt'  => $this->entry_sppa->get_premi_adt($pq)->result_array(),
                    'sob'        => $cari3['sob'],
                    'data_sob'   => $data_sob,
                    'nm'         => $nm
                  ];

                  // print_r($datai);
                  // exit();  
                       
          // require_once __DIR__ . '/vendor/autoload.php';

          // $mpdf = new \mPDF\mPDF();
          // $mpdf = new Mpdf();
          $mpdf = new \Mpdf\Mpdf();
          $html = $this->load->view('entry/invoice',$datai,true);

          $mpdf->WriteHTML($html);
          $mpdf->Output("upload/entry/INV$nm.pdf",'F');

          // $this->load->library('M_pdf');

          // $html = $this->load->view('entry/invoice',$datai,true);

          // $this->m_pdf->pdf->WriteHTML($html);
          // $this->m_pdf->pdf->Output("upload/entry/INV$nm.pdf",'F');

          // $this->load->library('Pdf_dom');
          // // $html = $this->load->view('entry/invoice',$datai, true);
          // $html = $this->load->view('invoice',[], true);
          // $this->pdf_dom->createPDF($html, "INV$nm.pdf", false);

          // print_r($datai);
          // exit();  

          // $mpdf=new \Mpdf\Mpdf([
          //     'mode' => 'utf-8',
          //     'format' => [190, 236],
          //     'orientation' => 'P'
          // ]);

          

          // ob_start();

          // $html = $this->load->view('entry/invoice',$datai,true);

          // $html = ob_get_contents();
          // ob_end_clean();
          // $mpdf->WriteHTML(utf8_encode($html));

          // $mpdf->Output("upload/entry/INV$nm.pdf",'F');

          // print_r($datai);
          // exit();  

          $nm_file = "INV$nm.pdf";

          $where = ['id_sppa_quotation' => $pq];

          $this->db->update('tr_sppa_quotation', ['file_invoice' => $nm_file], $where);
        
          // termin 
          $this->db->update('tr_termin_pembayaran', ['id_sppa_quotation' => $pq], ['sppa_number' => $this->sppa_number($pq)]);
        
        
      }

    if($this->db->trans_status() === FALSE){
      $this->db->trans_rollback();

      echo json_encode(['status' => false]);
    }else{
      $this->db->trans_commit();

      echo json_encode(['id_sppa' => "", 'id_mop' => $id_mop, 'jumlah' => count($temp4)]);
    }
    
  }

  public function hapus_nama()
  {
    $hapus = $this->db->get('nama_hapus')->result_array();

    foreach ($hapus as $h) {
      
      $nama = $h['nama_hapuss'];

      $cari = $this->db->get_where('karyawan', ['nama_lengkap' => $nama])->row_array();
      
      $id_anggota = $cari['id_anggota'];

      $this->db->delete('karyawan', ['nama_lengkap' => $nama]);
      if ($id_anggota != null) {
        $this->db->delete('anggota', ['id_anggota' => $id_anggota]);
      }
      

    }
    
  }

  // 27-05-2021
  public function simpan_semua()
  {

    $f_client       = $this->input->post('form_client');
    // $f_client       = $this->input->post('form_detail');

    // $path = $_FILES["upload_excel"]['tmp_name'];

    $client = array();
    parse_str($f_client, $client);

    // print_r($client);
    // exit();

    $id_sppa        = $client['id_sppa'];
    $id_mop         = $client['id_mop'];
    $id_sob         = $client['id_sob'];
    $id_cob         = $client['id_cob'];
    $id_lob         = $client['id_lob'];
    $nama_sob       = $client['nama_sob'];
    $id_relasi      = $client['id_relasi'];
    $sppa_number    = $client['sppa_number'];
    $id_entry_sppa  = $client['id_entry_sppa'];

    $this->db->trans_begin();

      $sp_number_db   = $this->sppa_number($id_sppa);

      if ($sp_number_db == $sppa_number) {
        $sppa_number = $sppa_number;
      } else {
        $sppa_number = $sp_number_db;
      }

      $data = [ 'id_sob'            => ($id_sob == '') ? null : $id_sob,
                'id_cob'            => $id_cob,
                'id_lob'            => $id_lob,
                'id_relasi_cob_lob' => $id_relasi,
                'sppa_number'       => $sppa_number,
                'add_time'          => date("Y-m-d H:i:s", now('Asia/Jakarta')),
                'add_by'            => $this->session->userdata('sesi_id')
        ];

      if ($id_sppa != '') {
        $this->entry_sppa->ubah_data('tr_sppa_quotation', $data, ['id_sppa_quotation' => $id_sppa]);
        $id_sppa = $id_sppa;
      } else {
        $this->entry_sppa->input_data('tr_sppa_quotation', $data);
        $id_sppa = $this->db->insert_id();
      }

      if ($id_mop != '') {
        $cari = $this->entry_sppa->cari_data('mop', ['id_mop' => $id_mop])->row_array();

        $data_approve = [ 'id_sppa_quotation'    => $id_sppa, 
                          'id_asuransi'          => $cari['id_insurer'],
                          'no_otorisasi_polis'   => $this->no_polis(),
                          'tgl_otorisasi'        => date("Y-m-d H:i:s",  now('Asia/Jakarta')),
                          'tgl_approve'          => date("Y-m-d H:i:s", now('Asia/Jakarta')),
                          'id_pegawai'           => $this->session->userdata('id_karyawan'),
                          'keterangan_tambahan'  => "",
                          'add_time'             => date("Y-m-d H:i:s", now('Asia/Jakarta')),
                          'add_by'               => $this->session->userdata('sesi_id')
                    ];

        $this->entry_sppa->input_data('tr_approve_sppa', $data_approve);

        $cari2 = $this->entry_sppa->cari_data('tr_approve_sppa', ['id_sppa_quotation' => $id_sppa])->row_array();

        $this->db->update('tr_sppa_quotation', ['approval' => true, 'no_polis' => $cari2['no_otorisasi_polis']], ['id_sppa_quotation' => $id_sppa]);

      } 

      $data2 = ['id_sob'            => ($id_sob == '') ? null : $id_sob,
                'nama_sob'          => $nama_sob,
                'id_sppa_quotation' => $id_sppa,
                'tanggal_perubahan' => date("Y-m-d", now('Asia/Jakarta')),
                'add_time'          => date("Y-m-d H:i:s", now('Asia/Jakarta')),
                'add_by'            => $this->session->userdata('sesi_id')
              ];

      

      if ($client['id_sppa'] != '') {
        $this->entry_sppa->ubah_data('tr_histori_status_sob', $data2, ['id_sppa_quotation' => $id_sppa]);
      } else {
        $this->entry_sppa->input_data('tr_histori_status_sob', $data2);
      }

      // detail insured
      
        $cari = $this->entry_sppa->get_field_sppa($id_relasi);

        $c_j = $cari->num_rows();

        $c_k = $cari->result_array();

        if ($c_k != 0) {

          $f_detail = $this->input->post('form_detail');

          $detail = array();
          parse_str($f_detail, $detail);

          $data221  = [];
          $list_fil = [];

          foreach ($cari->result_array() as $c) {
              $nm_field = str_replace(" ","_", strtolower($c['field_sppa']));

              $fl = $detail[$nm_field];

              if ($fl == null || $fl == '') {
                $fl = null;
              } else {
                $fl = $fl;
              }

              if ($c['data_type'] == 'DATE') {
                  if ($fl != '' || $fl != null) {
                    $fl = date("Y-m-d", strtotime($fl));
                  } else {
                    $fl = $fl;
                  }
              }
              
              $data22 = [$nm_field => $fl];


              if ($c['cdb'] == 't') {

                $data221 += [$nm_field => $fl];

                array_push($list_fil, $data221);
              } else {
                $this->db->update('tr_sppa_quotation', $data22, ['id_sppa_quotation' => $id_sppa]);
              }
              
          }

        }


        if (!empty($list_fil)) {
          $ky = end(array_keys($list_fil));

          $data_ptg = $list_fil[$ky];

          $data_ptg2  = [ 'add_time'    => date("Y-m-d H:i:s", now('Asia/Jakarta')),
                          'add_by'      => $this->session->userdata('sesi_id')
                        ];

          $this->db->insert('pengguna_tertanggung', $data_ptg);
          $id_data_ptg = $this->db->insert_id();

          $this->db->update('pengguna_tertanggung', $data_ptg2, ['id_pengguna_tertanggung' => $id_data_ptg]);
          
          $this->db->update('tr_sppa_quotation', ['id_pengguna_tertanggung' => $id_data_ptg], ['id_sppa_quotation' => $id_sppa]);
        }

      // dokumen
        // $this->db->update('dokumen_sppa', ['id_sppa_quotation' => $id_sppa], ['sppa_number' => $sppa_number]);

        $config['upload_path']    = './uploads/dokumen/';
        $config['allowed_types']  = 'jpg|png|pdf|xls|xlsx|doc|docx';
        $config['max_size']       = 15000;
        // load library upload
        $this->load->library('upload', $config);

          $jumlah = $this->input->post('jumlah');

          if ($jumlah != 0 || $jumlah == '') {
            for ($i=0; $i < $jumlah; $i++) { 
                $nama = $_FILES['dokumen_'.$i]['name'];
                $size = $_FILES['dokumen_'.$i]['size'];
                $tmp  = $_FILES['dokumen_'.$i]['tmp_name'];

                $desc = $this->input->post('desc_'.$i);

                if ($nama != '' && $desc != '') {
                  $path = "./upload/dokumen/" . $nama;

                  move_uploaded_file($tmp, $path);

                  $data_dok[] = [ 'filename'          => $nama,
                                  'size'              => $this->formatSizeUnits($size),
                                  'description'       => $desc,
                                  'id_sppa_quotation' => $id_sppa,
                                  'add_time'          => date("Y-m-d H:i:s", now('Asia/Jakarta')),
                                  'add_by'            => $this->session->userdata('sesi_id')
                                  ];
                }
                
            }

            if (!empty($data_dok)) {
              $this->db->insert_batch('dokumen_sppa', $data_dok);
            }
            
          }

      // akhir dokumen

      // cari
      $c_l = $this->entry_sppa->cari_data('coverage', ['id_lob' => $id_lob])->num_rows();

      if ($c_l != 0) {

      // premi
      $tsi                = ($this->input->post('tsi') == '') ? null : $this->input->post('tsi');    
      $diskon             = ($this->input->post('diskon') == '') ? null : $this->input->post('diskon');    
      $gross_premi        = ($this->input->post('gross_premi') == '') ? null : $this->input->post('gross_premi');    
      $total_diskon       = ($this->input->post('total_diskon') == '') ? null : $this->input->post('total_diskon');    
      $total_persen_premi = ($this->input->post('total_persen_premi') == '') ? null : $this->input->post('total_persen_premi');    
      $total_akhir_premi  = ($this->input->post('total_akhir_premi') == '') ? null : $this->input->post('total_akhir_premi');    
      $biaya_admin        = ($this->input->post('biaya_admin') == '') ? null : $this->input->post('biaya_admin');    
      $total_tagihan      = ($this->input->post('total_tagihan') == '') ? null : $this->input->post('total_tagihan');    
      $payment_method     = ($this->input->post('payment_method') == '') ? null : $this->input->post('payment_method');    
      $tahun_pay          = ($this->input->post('tahun_pay') == '') ? null : $this->input->post('tahun_pay');    
      $jumlah_cicilan     = ($this->input->post('jumlah_cicilan') == '') ? null : $this->input->post('jumlah_cicilan');    

      // array
      $lob_adt            = json_decode($this->input->post('lob_adt'), true);    
      $kalkulasi_tsi_adt  = json_decode($this->input->post('kalkulasi_tsi_adt'), true);    
      $pengali_tsi_adt    = json_decode($this->input->post('pengali_tsi_adt'), true);    
      $rate_adt           = json_decode($this->input->post('rate_adt'), true);    
      $nominal_adt        = json_decode($this->input->post('nominal_adt'), true);    
      $rate_all_premi     = json_decode($this->input->post('rate_all_premi'), true);    
      $nominal_all_premi  = json_decode($this->input->post('nominal_all_premi'), true);    
      $id_coverage        = json_decode($this->input->post('id_coverage'), true);    
      $premi_standar      = json_decode($this->input->post('premi_standar'), true);    
      $premi_perluasan    = json_decode($this->input->post('premi_perluasan'), true);   
      
      $no_dokumen_t       = json_decode($this->input->post('no_dokumen_t'), true);  
      $tgl_bayar_t        = json_decode($this->input->post('tgl_bayar_t'), true);  
      $jumlah_t           = json_decode($this->input->post('jumlah_t'), true);  
      $cara_bayar_t       = json_decode($this->input->post('cara_bayar_t'), true);  
      $tgl_terima_t       = json_decode($this->input->post('tgl_terima_t'), true);  

      // termin permbayaran
      $jml_ter  = count($no_dokumen_t);
      $data_ter = [];

      if ($jml_ter != 0) {
        for ($t=0; $t < $jml_ter; $t++) { 
          
          $data_ter[] = [ 'id_sppa_quotation' => $id_sppa,
                          'no_dokumen'        => $no_dokumen_t[$t],
                          'tgl_bayar'         => date("Y-m-d", strtotime($tgl_bayar_t[$t])),
                          'jumlah'            => str_replace('.','', $jumlah_t[$t]),
                          'cara_bayar'        => $cara_bayar_t[$t],
                          'tgl_terima'        => date("Y-m-d", strtotime($tgl_terima_t[$t])),
                          'add_time'          => date("Y-m-d H:i:s", now('Asia/Jakarta')),
                          'add_by'            => $this->session->userdata('sesi_id')
                        ];

        }

        $this->db->insert_batch('tr_termin_pembayaran', $data_ter);
      }

      // print_r($lob_adt); exit();

      // simpan tr sppa
      $jml    = count($premi_standar);
      $jml_p  = count($premi_perluasan);
      
      $tt_premi_standar = 0;
      for ($i=0; $i < $jml; $i++) { 
        
        $tt_premi_standar += $premi_standar[$i];

      }

      $tt_premi_pls = 0;
      for ($k=0; $k < $jml_p; $k++) { 
        
        $tt_premi_pls += $premi_perluasan[$k];

      }

      $data = [ 'total_sum_insured'       => $tsi,
                'diskon'                  => $diskon,
                'gross_premi'             => str_replace('.','', $gross_premi),
                'total_diskon'            => str_replace('.','', $total_diskon),
                'total_akhir_premi'       => str_replace('.','', $total_akhir_premi),
                'total_rate_akhir_premi'  => $total_persen_premi,
                'total_premi_standar'     => $tt_premi_standar,
                'total_premi_perluasan'   => $tt_premi_pls,
                'biaya_admin'             => $biaya_admin,
                'total_tagihan'           => $total_tagihan,
                'payment_method'          => $payment_method,
                'tahun_cicilan'           => ($tahun_pay) ? $tahun_pay : null,
                'jumlah_cicilan'          => ($jumlah_cicilan) ? $jumlah_cicilan : null
              ];

      $where = ['id_sppa_quotation' => $id_sppa];

      $this->db->update('tr_sppa_quotation', $data, $where);

      // cek jika ada premi
      $cari = $this->entry_sppa->cari_data('tr_premi', $where)->num_rows();

      if ($cari != 0) {
        $this->db->delete('tr_premi', $where);
      }

      // input premi  
      $jml_c  = count($id_coverage);
      $data_c = [];

      for ($j=0; $j < $jml_c; $j++) { 
        
        $data_c[] = [ 'id_sppa_quotation' => $id_sppa,
                      'id_coverage'       => $id_coverage[$j],
                      'rate'              => $rate_all_premi[$j],
                      'nominal'           => str_replace('.','', $nominal_all_premi[$j]),
                      'add_time'          => date("Y-m-d H:i:s", now('Asia/Jakarta')),
                      'add_by'            => $this->session->userdata('sesi_id')
                    ];

      }

      $this->db->insert_batch('tr_premi', $data_c);

      // cek jika ada premi adt
      $cari_a = $this->entry_sppa->cari_data('tr_premi_adt', $where)->num_rows();

      if ($cari_a != 0) {
        $this->db->delete('tr_premi_adt', $where);
      }

      // input premi adt 
      $jml_a  = count($lob_adt);

      if ($jml_a != 0) {

        $data_a = [];

        for ($k=0; $k < $jml_a; $k++) { 
          
          $data_a[] = [ 'id_sppa_quotation' => $id_sppa,
                        'id_lob'            => $lob_adt[$k],
                        'pengali_tsi'       => $pengali_tsi_adt[$k],
                        'kalkulasi_tsi'     => str_replace('.','', $kalkulasi_tsi_adt[$k]),
                        'rate'              => $rate_adt[$k],
                        'nominal'           => str_replace('.','', $nominal_adt[$k]),
                        'add_time'          => date("Y-m-d H:i:s", now('Asia/Jakarta')),
                        'add_by'            => $this->session->userdata('sesi_id')
                      ];

        }

        $this->db->insert_batch('tr_premi_adt', $data_a);

      }

    }

        // generate invoice
        $nm       = str_pad($id_sppa, 5, "0", STR_PAD_LEFT);
        $date     = date("Ymd", now('Asia/Jakarta'));
        $random   = strtoupper(bin2hex(random_bytes(4)));

        $nmr_invoice = "INV/$date/Entry/$random";

        $where = ['id_sppa_quotation' => $id_sppa];

        $cari = $this->entry_sppa->cari_data('tr_sppa_quotation', $where)->row_array();

        if ($cari['no_invoice_entry'] == '') {
          $this->db->update('tr_sppa_quotation', ['no_invoice_entry' => $nmr_invoice], $where);
        }

        // cari detail sob
        $cari2  = $this->entry_sppa->cari_data('tr_histori_status_sob', $where)->row_array();
        $cari3  = $this->entry_sppa->cari_data('m_sob', ['id_sob' => $cari2['id_sob']])->row_array();
        $wh_sob = $cari2['nama_sob'];

          switch ($cari2['id_sob']) {
              case 2:
                $this->db->select('nama_asuransi as nama, alamat, telp');
                $this->db->where('id_asuransi', $wh_sob);
                $data_sob = $this->db->get('m_asuransi')->row_array();
                break;
              case 3:
                $this->db->select('nama_nasabah as nama, alamat_rumah as alamat, telp');
                $this->db->where('id_nasabah', $wh_sob);
                $data_sob = $this->db->get('m_nasabah')->row_array();
                break;
              case 4:
                $this->db->select('nama, alamat, telp');
                $this->db->where('id_agent', $wh_sob);
                $data_sob = $this->db->get('m_agent')->row_array();
                break;
              case 6:
                $this->db->select('nama, alamat, telp');
                $this->db->where('id_direct', $wh_sob);
                $data_sob = $this->db->get('m_direct')->row_array();
                break;
              case 5:
                $this->db->select('nama, alamat, telp');
                $this->db->where('id_business_partner', $wh_sob);
                $data_sob = $this->db->get('m_business_partner')->row_array();
                break;
              case 7:
                $this->db->select('nama, alamat, telp');
                $this->db->where('id_loss_adjuster', $wh_sob);
                $data_sob = $this->db->get('m_loss_adjuster')->row_array();
                break;
            }

        $cpremi = $this->entry_sppa->get_premi($id_sppa)->result_array();

        $ky = "";
        foreach ($cpremi as $key => $value) {
          if ($value['status'] == 'standar') {
            $ky = $key;
          }
        }
  
        $ls_premi = $this->moveElement($cpremi, $ky, 0);
      
        $data = ['tr_sppa'    => $this->entry_sppa->cari_data('tr_sppa_quotation', $where)->row_array(),
                'premi'      => $ls_premi,
                'premi_adt'  => $this->entry_sppa->get_premi_adt($id_sppa)->result_array(),
                'sob'        => $cari3['sob'],
                'data_sob'   => $data_sob
                ];

        $mpdf = new \Mpdf\Mpdf();
        $html = $this->load->view('entry/invoice',$data,true);

        $mpdf->WriteHTML($html);
        $mpdf->Output("upload/entry/INV$nm.pdf",'F');

        $nm_file = "INV$nm.pdf";

        $where = ['id_sppa_quotation' => $id_sppa];

        $this->db->update('tr_sppa_quotation', ['file_invoice' => $nm_file], $where);
      
      // termin 
      $this->db->update('tr_termin_pembayaran', ['id_sppa_quotation' => $id_sppa], ['sppa_number' => $sppa_number]);
   
    if($this->db->trans_status() === FALSE){
      $this->db->trans_rollback();

      echo json_encode(['status' => false]);
    }else{
      $this->db->trans_commit();

      echo json_encode(['id_sppa' => $id_sppa, 'sppa_number' => $this->sppa_number($id_sppa), 'id_mop' => ""]);
    }
  }

  // 27-05-2021
  public function tampil_detail_sppa($id_sppa, $jenis)
  {
      // $id_sppa = $this->input->post('id_sppa');

      $where = ['id_sppa_quotation' => $id_sppa];

      // cari detail sob
      $cari2  = $this->entry_sppa->cari_data('tr_histori_status_sob', $where)->row_array();
      $cari3  = $this->entry_sppa->cari_data('m_sob', ['id_sob' => $cari2['id_sob']])->row_array();
      $wh_sob = $cari2['nama_sob'];

      switch ($cari2['id_sob']) {
          case 2:
              $this->db->select('nama_asuransi as nama, alamat, telp');
              $this->db->where('id_asuransi', $wh_sob);
              $data_sob = $this->db->get('m_asuransi')->row_array();

              $this->db->select('id_asuransi as id, nama_asuransi as nama, alamat, telp');
              $this->db->order_by('nama', 'asc');
              $sob = $this->db->get('m_asuransi')->result_array();
              break;
          case 3:
              $this->db->select('nama_nasabah as nama, alamat_rumah as alamat, telp');
              $this->db->order_by('nama', 'asc');
              $this->db->where('id_nasabah', $wh_sob);
              $data_sob = $this->db->get('m_nasabah')->row_array();
              
              $this->db->select('id_nasabah as id, nama_nasabah as nama, alamat_rumah as alamat, telp');
              $this->db->order_by('nama', 'asc');
              $sob = $this->db->get('m_nasabah')->result_array();
              break;
          case 4:
              $this->db->select('nama, alamat, telp');
              $this->db->where('id_agent', $wh_sob);
              $data_sob = $this->db->get('m_agent')->row_array();

              $this->db->select('id_agent as id, nama, alamat, telp');
              $this->db->order_by('nama', 'asc');
              $sob = $this->db->get('m_agent')->result_array();
              break;
          case 6:
              $this->db->select('nama, alamat, telp');
              $this->db->where('id_direct', $wh_sob);
              $data_sob = $this->db->get('m_direct')->row_array();

              $this->db->select('id_direct as id, nama, alamat, telp');
              $this->db->order_by('nama', 'asc');
              $sob = $this->db->get('m_direct')->result_array();
              break;
          case 5:
              $this->db->select('nama, alamat, telp');
              $this->db->where('id_business_partner', $wh_sob);
              $data_sob = $this->db->get('m_business_partner')->row_array();

              $this->db->select('id_business_partner as id, nama, alamat, telp');
              $this->db->order_by('nama', 'asc');
              $sob = $this->db->get('m_business_partner')->result_array();
              break;
          case 7:
              $this->db->select('nama, alamat, telp');
              $this->db->where('id_loss_adjuster', $wh_sob);
              $data_sob = $this->db->get('m_loss_adjuster')->row_array();
              
              $this->db->select('id_loss_adjuster as id, nama, alamat, telp');
              $this->db->order_by('nama', 'asc');
              $sob = $this->db->get('m_loss_adjuster')->result_array();
              break;
          }

      $cari     = $this->entry_sppa->get_sppa($id_sppa)->row_array();

      $cari_lob = $this->entry_sppa->cari_data('m_lob', ['id_lob' => $cari['id_lob']])->row_array();

      $cpremi = $this->entry_sppa->get_premi($id_sppa)->result_array();

      $ky = "";
      foreach ($cpremi as $key => $value) {
        if ($value['status'] == 'standar') {
          $ky = $key;
        }
      }

      $ls_premi = $this->moveElement($cpremi, $ky, 0);

      $data = [ 'title'        => 'Detail SPPA',
                'tr_sppa'      => $cari,
                'premi'        => $ls_premi,
                'premi_adt'    => $this->entry_sppa->get_premi_adt($id_sppa)->result_array(),
                'sob'          => $cari3['sob'],
                'data_sob'     => $data_sob,
                'rs_sob'       => $sob,
                'sel_sob'      => $wh_sob,
                'detail_lob'   => $this->entry_sppa->get_field_sppa($cari['id_relasi_cob_lob'])->result_array(),
                'insurer'      => $this->binding->get_data('m_asuransi')->result_array(),
                'karyawan'     => $this->binding->get_data('m_karyawan')->result_array(),
                'list_sob'     => $this->entry_sppa->getsob(),
                'list_cob'     => $this->entry_sppa->list_cob(),
                'no_reff'      => $this->entry_sppa->get_data_order('mop', 'id_mop', 'desc')->result_array(),
                'lob'          => $this->entry_sppa->joincoblob($cari['id_cob']),
                'lob_adt'      => $this->entry_sppa->cari_lob($cari['id_lob'])->result_array(),
                'jenis'        => $jenis,
                'id_sppa'      => $id_sppa,
                'sppa_number'  => $cari['sppa_number'],
                'st_diskon'    => $cari_lob['diskon'],
                'nasabah_ptg'  => $this->entry_sppa->cari_data('pengguna_tertanggung', ['id_pengguna_tertanggung' => $cari['id_pengguna_tertanggung']])->row_array()
              ];

      // $this->load->view('entry/detail_sppa', $data);  

      $this->template->load('template/index', 'entry/detail_sppa', $data);
      
  }

  public function simpan_data_client()
  {
    $id_mop         = $this->input->post('id_mop');
    $id_sob         = $this->input->post('id_sob');
    $id_cob         = $this->input->post('id_cob');
    $id_lob         = $this->input->post('id_lob');
    $nama_sob       = $this->input->post('nama_sob');
    $id_relasi      = $this->input->post('id_relasi');
    $sppa_number    = $this->input->post('sppa_number');
    $id_entry_sppa  = $this->input->post('id_entry_sppa');

    $this->db->trans_begin();

    $data = [ 'id_sob'            => ($id_sob == '') ? null : $id_sob,
              'id_cob'            => $id_cob,
              'id_lob'            => $id_lob,
              'id_relasi_cob_lob' => $id_relasi,
              'sppa_number'       => $sppa_number,
              'add_time'          => date("Y-m-d H:i:s", now('Asia/Jakarta')),
              'add_by'            => $this->session->userdata('sesi_id')
            ];

    if ($id_entry_sppa != '') {
      $this->entry_sppa->ubah_data('tr_sppa_quotation', $data, ['id_sppa_quotation' => $id_entry_sppa]);
      $id_sppa = $id_entry_sppa;
    } else {
      $this->entry_sppa->input_data('tr_sppa_quotation', $data);
      $id_sppa = $this->db->insert_id();
    }

    if ($id_mop != '') {
      $cari = $this->entry_sppa->cari_data('mop', ['id_mop' => $id_mop])->row_array();

      $data_approve = ['id_sppa_quotation'    => $id_sppa, 
                      'id_asuransi'          => $cari['id_insurer'],
                      'no_otorisasi_polis'   => $this->no_polis(),
                      'tgl_otorisasi'        => date("Y-m-d H:i:s",  now('Asia/Jakarta')),
                      'tgl_approve'          => date("Y-m-d H:i:s", now('Asia/Jakarta')),
                      'id_pegawai'           => $this->session->userdata('id_karyawan'),
                      'keterangan_tambahan'  => "",
                      'add_time'             => date("Y-m-d H:i:s", now('Asia/Jakarta')),
                      'add_by'               => $this->session->userdata('sesi_id')
                      ];

      $this->entry_sppa->input_data('tr_approve_sppa', $data_approve);

      $cari2 = $this->entry_sppa->cari_data('tr_approve_sppa', ['id_sppa_quotation' => $id_sppa])->row_array();

      $this->db->update('tr_sppa_quotation', ['approval' => true, 'no_polis' => $cari2['no_otorisasi_polis']], ['id_sppa_quotation' => $id_sppa]);
      
    } 

    $data2 = ['id_sob'            => ($id_sob == '') ? null : $id_sob,
              'nama_sob'          => $nama_sob,
              'id_sppa_quotation' => $id_sppa,
              'tanggal_perubahan' => date("Y-m-d", now('Asia/Jakarta')),
              'add_time'          => date("Y-m-d H:i:s", now('Asia/Jakarta')),
              'add_by'            => $this->session->userdata('sesi_id')
              ];

    $this->entry_sppa->input_data('tr_histori_status_sob', $data2);

    if($this->db->trans_status() === FALSE){
      $this->db->trans_rollback();

      echo json_encode(['status' => false]);
    }else{
      $this->db->trans_commit();

      echo json_encode(['id_sppa' => $id_sppa]);
    }

   
  }

  // 15-05-2021
  public function simpan_data_detail()
  {
    $id_sppa            = $this->input->post('id_sppa');
    $id_lob             = $this->input->post('id_lob');
    $id_relasi_detail   = $this->input->post('id_relasi_detail');

    $cari = $this->entry_sppa->get_field_sppa($id_relasi_detail)->result_array();

    foreach ($cari as $c) {
      $nm_field = str_replace(" ","_", strtolower($c['field_sppa']));

      $fl = $this->input->post($nm_field);
      
      $data = [$nm_field => $fl];

      $this->db->update('tr_sppa_quotation', $data, ['id_sppa_quotation' => $id_sppa]);

    }

    echo json_encode(['status' => true]);
    
  }

  // 16-05-2021
  public function simpan_data_premi()
  {
    $id_sppa_premi      = $this->input->post('id_sppa_premi');    
    $tsi                = $this->input->post('tsi');    
    $diskon             = $this->input->post('diskon');    
    $total_persen_premi = $this->input->post('total_persen_premi');    
    $total_akhir_premi  = $this->input->post('total_akhir_premi');    
    $biaya_admin        = $this->input->post('biaya_admin');    
    $total_tagihan      = $this->input->post('total_tagihan');    
    $payment_method     = $this->input->post('payment_method');    
    $tahun_pay          = $this->input->post('tahun_pay');    
    $jumlah_cicilan     = $this->input->post('jumlah_cicilan');    

    // array
    $lob_adt            = $this->input->post('lob_adt');    
    $kalkulasi_tsi_adt  = $this->input->post('kalkulasi_tsi_adt');    
    $pengali_tsi_adt    = $this->input->post('pengali_tsi_adt');    
    $rate_adt           = $this->input->post('rate_adt');    
    $nominal_adt        = $this->input->post('nominal_adt');    
    $rate_all_premi     = $this->input->post('rate_all_premi');    
    $nominal_all_premi  = $this->input->post('nominal_all_premi');    
    $id_coverage        = $this->input->post('id_coverage');    
    $premi_standar      = $this->input->post('premi_standar');    
    $premi_perluasan    = $this->input->post('premi_perluasan');    

    $this->db->trans_begin();

    // simpan tr sppa
    $jml    = count($premi_standar);
    $jml_p  = count($premi_perluasan);
    
    $tt_premi_standar = 0;
    for ($i=0; $i < $jml; $i++) { 
      
      $tt_premi_standar += str_replace('.','', $premi_standar[$i]);

    }

    $tt_premi_pls = 0;
    for ($k=0; $k < $jml_p; $k++) { 
      
      $tt_premi_pls += str_replace('.','', $premi_perluasan[$k]);

    }

    $data = [ 'total_sum_insured'       => $tsi,
              'diskon'                  => $diskon,
              'total_akhir_premi'       => str_replace('.','', $total_akhir_premi),
              'total_rate_akhir_premi'  => $total_persen_premi,
              'total_premi_standar'     => $tt_premi_standar,
              'total_premi_perluasan'   => $tt_premi_pls,
              'biaya_admin'             => $biaya_admin,
              'total_tagihan'           => $total_tagihan,
              'payment_method'          => $payment_method,
              'tahun_cicilan'           => ($tahun_pay) ? $tahun_pay : null,
              'jumlah_cicilan'          => ($jumlah_cicilan) ? $jumlah_cicilan : null
            ];

    $where = ['id_sppa_quotation' => $id_sppa_premi];

    $this->db->update('tr_sppa_quotation', $data, $where);

    // cek jika ada premi
    $cari = $this->entry_sppa->cari_data('tr_premi', $where)->num_rows();

    if ($cari != 0) {
      $this->db->delete('tr_premi', $where);
    }

    // input premi  
    $jml_c  = count($id_coverage);
    $data_c = [];

    for ($j=0; $j < $jml_c; $j++) { 
      
      $data_c[] = [ 'id_sppa_quotation' => $id_sppa_premi,
                    'id_coverage'       => $id_coverage[$j],
                    'rate'              => $rate_all_premi[$j],
                    'nominal'           => str_replace('.','', $nominal_all_premi[$j]),
                    'add_time'          => date("Y-m-d H:i:s", now('Asia/Jakarta')),
                    'add_by'            => $this->session->userdata('sesi_id')
                  ];

    }

    $this->db->insert_batch('tr_premi', $data_c);

    // cek jika ada premi adt
    $cari_a = $this->entry_sppa->cari_data('tr_premi_adt', $where)->num_rows();

    if ($cari_a != 0) {
      $this->db->delete('tr_premi_adt', $where);
    }

    // input premi adt 
    $jml_a  = count($lob_adt);

    if ($jml_a != 0) {

      $data_a = [];

      for ($k=0; $k < $jml_a; $k++) { 
        
        $data_a[] = [ 'id_sppa_quotation' => $id_sppa_premi,
                      'id_lob'            => $lob_adt[$k],
                      'pengali_tsi'       => $pengali_tsi_adt[$k],
                      'kalkulasi_tsi'     => str_replace('.','', $kalkulasi_tsi_adt[$k]),
                      'rate'              => $rate_adt[$k],
                      'nominal'           => str_replace('.','', $nominal_adt[$k]),
                      'add_time'          => date("Y-m-d H:i:s", now('Asia/Jakarta')),
                      'add_by'            => $this->session->userdata('sesi_id')
                    ];

      }

      $this->db->insert_batch('tr_premi_adt', $data_a);

    }

      // generate invoice
      $nm       = str_pad($id_sppa_premi, 5, "0", STR_PAD_LEFT);
      $date     = date("Ymd", now('Asia/Jakarta'));
      $random   = strtoupper(bin2hex(random_bytes(4)));

      $nmr_invoice = "INV/$date/Entry/$random";

      $where = ['id_sppa_quotation' => $id_sppa_premi];

      $cari = $this->entry_sppa->cari_data('tr_sppa_quotation', $where)->row_array();

      if ($cari['no_invoice_entry'] == '') {
        $this->db->update('tr_sppa_quotation', ['no_invoice_entry' => $nmr_invoice], $where);
      }

    if($this->db->trans_status() === FALSE){
      $this->db->trans_rollback();

      echo json_encode(['status' => false]);
    }else{
      $this->db->trans_commit();

      echo json_encode(['status' => true, 'jml' => $tt_premi_pls]);
    }
    
  }

  // 16-05-2021
  public function cetak_invoice($id_sppa)
  {
    // $id_sppa = $this->input->post('id_sppa_invoice');

    $nm       = str_pad($id_sppa, 5, "0", STR_PAD_LEFT);

    $where = ['id_sppa_quotation' => $id_sppa];

    //cari detail sob
    $cari2  = $this->entry_sppa->cari_data('tr_histori_status_sob', $where)->row_array();
    $cari3  = $this->entry_sppa->cari_data('m_sob', ['id_sob' => $cari2['id_sob']])->row_array();
    $wh_sob = $cari2['nama_sob'];

      switch ($cari2['id_sob']) {
          case 2:
            $this->db->select('nama_asuransi as nama, alamat, telp');
            $this->db->where('id_asuransi', $wh_sob);
            $data_sob = $this->db->get('m_asuransi')->row_array();
            break;
          case 3:
            $this->db->select('nama_nasabah as nama, alamat_rumah as alamat, telp');
            $this->db->where('id_nasabah', $wh_sob);
            $data_sob = $this->db->get('m_nasabah')->row_array();
            break;
          case 4:
            $this->db->select('nama, alamat, telp');
            $this->db->where('id_agent', $wh_sob);
            $data_sob = $this->db->get('m_agent')->row_array();
            break;
          case 6:
            $this->db->select('nama, alamat, telp');
            $this->db->where('id_direct', $wh_sob);
            $data_sob = $this->db->get('m_direct')->row_array();
            break;
          case 5:
            $this->db->select('nama, alamat, telp');
            $this->db->where('id_business_partner', $wh_sob);
            $data_sob = $this->db->get('m_business_partner')->row_array();
            break;
          case 7:
            $this->db->select('nama, alamat, telp');
            $this->db->where('id_loss_adjuster', $wh_sob);
            $data_sob = $this->db->get('m_loss_adjuster')->row_array();
            break;
        }

    $cari   = $this->entry_sppa->cari_data('tr_sppa_quotation', $where)->row_array();
    $cari2  = $this->entry_sppa->cari_data('m_lob', ['id_lob' => $cari['id_lob']])->row_array();

    $cpremi = $this->entry_sppa->get_premi($id_sppa)->result_array();

    $ky = "";
    foreach ($cpremi as $key => $value) {
      if ($value['status'] == 'standar') {
        $ky = $key;
      }
    }

    $ls_premi = $this->moveElement($cpremi, $ky, 0);

    $data = [ 'tr_sppa'    => $cari,
              'premi'      => $ls_premi,
              'premi_adt'  => $this->entry_sppa->get_premi_adt($id_sppa)->result_array(),
              'sob'        => $cari3['sob'],
              'data_sob'   => $data_sob,
              'lob'        => $cari2['lob'],
              'nm_file'    => "INV$nm.pdf"
            ];

    $this->load->view('entry/invoice', $data);
    
    $mpdf = new \Mpdf\Mpdf();
    $html = $this->load->view('entry/invoice',$data,true);

    $nm_file = "INV$nm.pdf";

    $where = ['id_sppa_quotation' => $id_sppa];

    $this->db->update('tr_sppa_quotation', ['file_invoice' => $nm_file], $where);

    // $nm = str_pad($id_sppa, 5, "0", STR_PAD_LEFT);

    // $nm_file = "INV$nm.pdf";

    $mpdf->WriteHTML($html);
    $mpdf->Output("upload/entry/$nm_file",'F');

    $filepath = base_url("upload/entry/$nm_file");
    // Header content type
    header("Content-type: application/pdf");
    header("Content-disposition: inline;     
    filename=".basename($filepath));
    ob_end_clean();
    // Send the file to the browser.
    readfile($filepath);
    
    // $this->preview($nm_file);
    
  }

  // 16-05-2021
  public function preview($nm_file)
  {
      $filepath = base_url("upload/entry/$nm_file");
      // Header content type
      header("Content-type: application/pdf");
      header("Content-disposition: inline;     
      filename=".basename($filepath));
      ob_end_clean();
      // Send the file to the browser.
      readfile($filepath);
      
  }

  // 19-05-2021
  public function get_mop()
  {
    $id_mop = $this->input->post('id_mop');
    
    $data = $this->entry_sppa->cari_data('mop', ['id_mop' => $id_mop])->result_array();

    echo json_encode(['mop' => $data]);
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

  // list dek 
  public function list_dek($id_mop)
  {
    $data = [
      'title'   => 'Detail Deklarasi MOP',
      'id_mop'  => $id_mop
    ];

    $this->template->load('template/index', 'entry/list_dek', $data);
  }

}

?>
