<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 *
 */
class Kota extends CI_controller
{
  var $validcfg;

  public function __construct() {
    parent::__construct();
    $this->load->model('negara/M_negara', 'negara');
    $this->load->model('provinsi/M_provinsi', 'provinsi');
    $this->load->model('M_kota', 'kota');
    $this->load->library('form_validation');
    $this->validcfg = array(
      array('field' => 'nama_kota', 'label' => 'Nama Kota', 'rules' => 'required'),
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
      'title'  => 'Master Kota',
      'list_negara'   => $this->negara->allnegara(),
      'list_provinsi' => $this->provinsi->allprovinsi(),
      'role' => get_role($this->session->userdata('id_level_otorisasi'))
    ];
    $this->template->load('template/index', 'index', $data);
  }

  public function ajaxdata($action)
  {
    $permisi = explode('_',$action);
    $b1 = ''; $b2 = '';

    $list = $this->kota->get_data_kota();
    $no   = $this->input->post('start');

    $data = array();
    foreach ($list as $o) {
      $no++;
      $tbody = array();

      $tbody[]    = "<div align='center'>".$no.".</div>";
      $tbody[]    = $o['kota'];
      $tbody[]    = $o['provinsi'];
      if ($permisi[0] == 'true' || $action == '_') {
        $b1 = '<span style="cursor:pointer" class="mr-2 text-primary '.(count($list) > 1?'ttip':'').'" data-toggle="tooltip" data-placement="top" title="Ubah" onclick="ubahubah('.$o['id_kota'].')"><i class="fas fa-pencil-alt fa-lg"></i></span>';
      }
      if ($permisi[1] == 'true' || $action == '_') {
        $b2 = '<span style="cursor:pointer" class="text-danger '.(count($list) > 1?'ttip':'').'" data-toggle="tooltip" data-placement="top" title="Hapus" onclick="deletedel('.$o['id_kota'].')"><i class="far fa-trash-alt fa-lg"></i></span>';
      }
      $b3 = '<span style="cursor:pointer" class="text-dark '.(count($list) > 1?'ttip':'').'" data-toggle="tooltip" data-placement="top" title="Detail" onclick="detaild('.$o['id_kota'].')"><i class="fas fa-info-circle fa-lg"></i></span>&nbsp;&nbsp;';
      $tbody[] = $b3.$b1.$b2;
      $data[]     = $tbody;
    }

    $output = [
      "draw"            => $_POST['draw'],
      "recordsTotal"    => $this->kota->jumlah_semua_kota(),
      "recordsFiltered" => $this->kota->jumlah_filter_kota(),
      "data"            => $data
    ];
    echo json_encode($output);
  }

  public function add()
  {
    $this->form_validation->set_rules($this->validcfg);
    if ($this->form_validation->run() == FALSE) {
      echo json_encode(['status' => 'Gagal', 'pesan' => 'Form Kota Belum Lengkap', 'altr' =>'warning']);
    } else {
      $data['kota'] = $this->input->post('nama_kota');
      $data['id_provinsi'] = $this->input->post('nama_provinsi');
      $data['add_time'] = date('Y-m-d H:i:s');
      $data['add_by'] = $this->session->userdata('sesi_id');

      $inputan = ['LOWER(kota)' => strtolower($this->input->post('nama_kota')),
                  'id_provinsi' => $this->input->post('nama_provinsi')
                  ];
      
      $cek = cek_duplicate_banyak('m_kota', '', '', $inputan);

      if ($cek == 0) {
        $this->db->insert('m_kota', $data);
        echo json_encode(['status' => "Berhasil", 'pesan' => 'Berhasil Menambahkan Data Nama Kota', 'altr' => 'success']);
      } else {
        echo json_encode(['status' => "Gagal", 'pesan' => 'Nama Kota Tersebut Sudah ada', 'altr' => 'error']);
      }
    }
  }

  public function show($id)
  {
    $this->db->where('id_kota',$id);
    $this->db->join('m_provinsi','m_provinsi.id_provinsi = m_kota.id_provinsi');
    $this->db->join('m_negara','m_negara.id_negara = m_provinsi.id_negara');
    $data = $this->db->get('m_kota')->result();
    echo json_encode($data);
  }

  public function edit($id)
  {
    $this->form_validation->set_rules($this->validcfg);
    if ($this->form_validation->run() == FALSE) {
      echo json_encode(['status' => 'Gagal', 'pesan' => 'Form Kota Belum Lengkap', 'altr' =>'warning']);
    } else {
      $data['kota'] = $this->input->post('nama_kota');
      $data['id_provinsi'] = $this->input->post('nama_provinsi');
      $data['add_time'] = date('Y-m-d H:i:s');
      $data['add_by'] = $this->session->userdata('sesi_id');

      $inputan = ['LOWER(kota)' => strtolower($this->input->post('nama_kota')),
                  'id_provinsi' => $this->input->post('nama_provinsi')
                  ];
      
      $cek = cek_duplicate_banyak('m_kota', 'id_kota', $id, $inputan);

      if ($cek == 0) {
        $this->db->where('id_kota', $id);
        $this->db->update('m_kota', $data);
        echo json_encode(['status' => "Berhasil", 'pesan' => 'Berhasil Mengubah Data Nama Kota', 'altr' => 'success']);
      } else {
        echo json_encode(['status' => "Gagal", 'pesan' => 'Nama Kota Tersebut Sudah ada', 'altr' => 'error']);
      }
    }
  }

  public function remove($id)
  {
    $this->db->where('id_kota',$id);
		$this->db->delete('m_kota');

    echo json_encode(['status' => 'sukses']);
  }
}

?>
