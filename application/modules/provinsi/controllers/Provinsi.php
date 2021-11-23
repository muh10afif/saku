<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 *
 */
class Provinsi extends CI_controller
{
  var $validcfg;

  public function __construct() {
    parent::__construct();
    $this->load->model('negara/M_negara', 'negara');
    $this->load->model('M_provinsi', 'provinsi');
    $this->load->library('form_validation');
    $this->validcfg = array(
      array('field' => 'nama_provinsi', 'label' => 'Nama Provinsi', 'rules' => 'required'),
      array('field' => 'nama_negara', 'label' => 'Nama Negara', 'rules' => 'required'),
    );
    if($this->session->userdata('username') == "") {
      redirect(base_url(), 'refresh');
    }
  }

  public function index($value='')
  {
    $data = [
      'title'  => 'Master Provinsi',
      'list_negara' => $this->negara->allnegara(),
      'role' => get_role($this->session->userdata('id_level_otorisasi'))
    ];
    $this->template->load('template/index', 'index', $data);
  }

  public function ajaxdata($action)
  {
    $permisi = explode('_',$action);
    $b1 = ''; $b2 = '';

    $list = $this->provinsi->get_data_provinsi();
    $no   = $this->input->post('start');

    $data = array();
    foreach ($list as $o) {
      $no++;
      $tbody = array();

      $tbody[]    = "<div align='center'>".$no.".</div>";
      $tbody[]    = $o['provinsi'];
      $tbody[]    = $o['negara'];
      if ($permisi[0] == 'true' || $action == '_') {
        $b1 = '<span style="cursor:pointer" class="mr-2 text-primary '.(count($list) > 1?'ttip':'').'" data-toggle="tooltip" data-placement="top" title="Ubah" onclick="ubahubah('.$o['id_provinsi'].')"><i class="fas fa-pencil-alt fa-lg"></i></span>';
      }
      if ($permisi[1] == 'true' || $action == '_') {
        $b2 = '<span style="cursor:pointer" class="text-danger '.(count($list) > 1?'ttip':'').'" data-toggle="tooltip" data-placement="top" title="Hapus" onclick="deletedel('.$o['id_provinsi'].')"><i class="far fa-trash-alt fa-lg"></i></span>';
      }
      $tbody[] = $b1.$b2;
      $data[]  = $tbody;
    }

    $output = [
      "draw"            => $_POST['draw'],
      "recordsTotal"    => $this->provinsi->jumlah_semua_provinsi(),
      "recordsFiltered" => $this->provinsi->jumlah_filter_provinsi(),
      "data"            => $data
    ];
    echo json_encode($output);
  }

  public function add()
  {
    $this->form_validation->set_rules($this->validcfg);
    if ($this->form_validation->run() == FALSE) {
      echo json_encode(['status' => 'Gagal', 'pesan' => 'Form Provinsi Belum Lengkap', 'altr' =>'warning']);
    } else {
      $data['provinsi'] = $this->input->post('nama_provinsi');
      $data['id_negara'] = $this->input->post('nama_negara');
      $data['add_time'] = date('Y-m-d H:i:s');
      $data['add_by'] = $this->session->userdata('sesi_id');

      $inputan = ['LOWER(provinsi)' => strtolower($this->input->post('nama_provinsi')),
                  'id_negara'       => $this->input->post('nama_negara')
                  ];
      
      $cek = cek_duplicate_banyak('m_provinsi', '', '', $inputan);

      if ($cek == 0) {
        $this->db->insert('m_provinsi', $data);
        echo json_encode(['status' => "Berhasil", 'pesan' => 'Berhasil Menambahkan Data Nama Provinsi', 'altr' => 'success']);
      } else {
        echo json_encode(['status' => "Gagal", 'pesan' => 'Nama Provinsi Tersebut Sudah ada', 'altr' => 'error']);
      }
    }
  }

  public function show($id)
  {
    $this->db->where('id_provinsi',$id);
    $this->db->join('m_negara','m_negara.id_negara = m_provinsi.id_negara');
    $data = $this->db->get('m_provinsi')->result();
    echo json_encode($data);
  }

  public function provinsibynegara($id)
  {
    $this->db->where('id_negara',$id);
    $this->db->order_by("provinsi", "asc");
    $data = $this->db->get('m_provinsi')->result();
    echo json_encode($data);
  }

  public function edit($id)
  {
    $this->form_validation->set_rules($this->validcfg);
    if ($this->form_validation->run() == FALSE) {
      echo json_encode(['status' => 'Gagal', 'pesan' => 'Form Provinsi Belum Lengkap', 'altr' =>'warning']);
    } else {
      $data['provinsi'] = $this->input->post('nama_provinsi');
      $data['id_negara'] = $this->input->post('nama_negara');
      $data['add_time'] = date('Y-m-d H:i:s');
      $data['add_by'] = $this->session->userdata('sesi_id');

      $inputan = ['LOWER(provinsi)' => strtolower($this->input->post('nama_provinsi')),
                  'id_negara'       => $this->input->post('nama_negara')
                  ];
      
      $cek = cek_duplicate_banyak('m_provinsi', 'id_provinsi', $id, $inputan);

      if ($cek == 0) {
        $this->db->where('id_provinsi', $id);
        $this->db->update('m_provinsi', $data);
        echo json_encode(['status' => "Berhasil", 'pesan' => 'Berhasil Mengubah Data Nama Provinsi', 'altr' => 'success']);
      } else {
        echo json_encode(['status' => "Gagal", 'pesan' => 'Nama Provinsi Tersebut Sudah ada', 'altr' => 'error']);
      }
    }
  }

  public function remove($id)
  {
    $this->db->where('id_provinsi',$id);
		$this->db->delete('m_provinsi');

    echo json_encode(['status' => 'sukses']);
  }
}

?>
