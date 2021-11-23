<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 *
 */
class Sob extends CI_Controller
{

  public function __construct() {
    parent::__construct();
    $this->load->model('M_sob', 'sob');
    if($this->session->userdata('username') == "") {
      redirect(base_url(), 'refresh');
    }
  }

  public function index()
  {
    $data = [
      'title'    => 'Master SOB',
      'role' => get_role($this->session->userdata('id_level_otorisasi'))
    ];
    $this->template->load('template/index','lihat', $data);
  }

  public function sob_kode($value='')
  {
    $kode = codegenerate('m_sob','SOB', 'sob', 'B');
    echo $kode;
  }

  public function tampil_data_sob($action)
  {
    $permisi = explode('_',$action);
    $b1 = ''; $b2 = '';

    $list = $this->sob->get_data_sob();
    $no   = $this->input->post('start');

    $data = array();
    foreach ($list as $o) {
      $no++;
      $tbody = array();

      $tbody[] = "<div align='center'>".$no.".</div>";
      $tbody[] = $o['kode_sob'];
      $tbody[] = $o['sob'];
      $tbody[] = $o['description'];
      if ($permisi[0] == 'true' || $action == '_') {
        $b1 = "<span style='cursor:pointer' class='mr-3 text-primary edit-sob ttip' data-toggle='tooltip' data-placement='top' title='Ubah' data-id='".$o['id_sob']."' nama='".$o['sob']."' desc='".$o['description']."' kode_sob='".$o['kode_sob']."'>
                <i class='fas fa-pencil-alt fa-lg'></i>
               </span>";
      }
      if ($permisi[1] == 'true' || $action == '_') {
        $b2 = "<span style='cursor:pointer' class='text-danger hapus-sob ttip' data-toggle='tooltip' data-placement='top' title='Hapus' data-id='".$o['id_sob']."' nama='".$o['sob']."'>
                <i class='far fa-trash-alt fa-lg'></i>
               </span>";
      }
      $tbody[] = $b1.$b2;
      $data[] = $tbody;
    }

    $output = [
      "draw"            => $_POST['draw'],
      "recordsTotal"    => $this->sob->jumlah_semua_sob(),
      "recordsFiltered" => $this->sob->jumlah_filter_sob(),
      "data"            => $data
    ];
    echo json_encode($output);
  }

  public function simpan_data_sob()
  {
    $aksi     = $this->input->post('aksi');
    $id_sob   = $this->input->post('id_sob');
    $nama_sob = $this->input->post('nama_sob');
    $kode_sob = $this->input->post('kode_sob');
    $desc     = $this->input->post('desc');

    $data = [
      'sob'         => $nama_sob,
      'kode_sob'    => $kode_sob,
      'description' => $desc,
      'add_time'    => date("Y-m-d H:i:s", now('Asia/Jakarta')),
      'add_by'      => $this->session->userdata('sesi_id')
    ];

    $this->db->where('LOWER(sob)',strtolower($nama_sob));
    $cek = $this->db->get('m_sob')->num_rows();


    if ($aksi == 'Tambah') {

        if (cek_duplicate('m_sob', 'sob', '', '', $nama_sob) == 0) {
          $this->sob->input_data('m_sob', $data);
          echo json_encode(['status' => 'berhasil', 'kode_sob' => codegenerate('m_sob','SOB', 'sob', 'B')]);
        } else {
          echo json_encode(['status' => 'gagal']);
        }
 
    } elseif ($aksi == 'Ubah') {

      if (cek_duplicate('m_sob', 'sob', 'id_sob', $id_sob, $nama_sob) == 0) {
        $this->sob->ubah_data('m_sob', $data, array('id_sob' => $id_sob));
        echo json_encode(['status' => 'berhasil', 'kode_sob' => codegenerate('m_sob','SOB', 'sob', 'B')]);
      } else {
        echo json_encode(['status' => 'gagal']);
      }

      // if ($cek == 0) {
      // } else {
      //   echo json_encode(['kode_sob' => codegenerate('m_sob','SOB', 'sob', 'B'), 'status' => 'gagal']);
      // }
    } elseif ($aksi == 'Hapus') {
      $this->sob->hapus_data('m_sob', array('id_sob' => $id_sob));
      echo json_encode(['kode_sob' => codegenerate('m_sob','SOB', 'sob', 'B'), 'status' => 'berhasil']);
    }
  }
}

?>
