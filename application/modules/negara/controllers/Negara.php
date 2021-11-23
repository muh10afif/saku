<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 *
 */
class Negara extends CI_controller
{

  public function __construct() {
    parent::__construct();
    $this->load->model('M_negara', 'negara');
    if($this->session->userdata('username') == "") {
      redirect(base_url(), 'refresh');
    }
  }

  public function index($value='')
  {
    $data = [
      'title'  => 'Master Negara',
      'role' => get_role($this->session->userdata('id_level_otorisasi'))
    ];
    $this->template->load('template/index', 'index', $data);
  }

  public function ajaxdata($action)
  {
    $permisi = explode('_',$action);
    $b1 = ''; $b2 = '';

    $list = $this->negara->get_data_negara();
    $no   = $this->input->post('start');

    $data = array();
    foreach ($list as $o) {
      $no++;
      $tbody = array();

      $tbody[]    = "<div align='center'>".$no.".</div>";
      $tbody[]    = $o['negara'];
      if ($permisi[0] == 'true' || $action == '_') {
        $b1 = '<span style="cursor:pointer" class="mr-2 text-primary '.(count($list) > 1?'ttip':'').'" data-toggle="tooltip" data-placement="top" title="Ubah" onclick="ubahubah('.$o['id_negara'].')"><i class="fas fa-pencil-alt fa-lg"></i></span>';
      }
      if ($permisi[1] == 'true' || $action == '_') {
        $b2 = '<span style="cursor:pointer" class="text-danger '.(count($list) > 1?'ttip':'').'" data-toggle="tooltip" data-placement="top" title="Hapus" onclick="deletedel('.$o['id_negara'].')"><i class="far fa-trash-alt fa-lg"></i></span>';
      }
      $tbody[] = $b1.$b2;
      $data[]  = $tbody;
    }

    $output = [
      "draw"            => $_POST['draw'],
      "recordsTotal"    => $this->negara->jumlah_semua_negara(),
      "recordsFiltered" => $this->negara->jumlah_filter_negara(),
      "data"            => $data
    ];
    echo json_encode($output);
  }

  public function add()
  {
    $data['negara']   = $this->input->post('nama_negara');
    $data['add_time'] = date('Y-m-d H:i:s');
    $data['add_by']   = $this->session->userdata('sesi_id');
    if (cek_duplicate('m_negara', 'negara', '', '', $this->input->post('nama_negara')) == 0) {
      $this->db->insert('m_negara', $data);
      echo json_encode(['status' => 'sukses']);
    } else {
      echo json_encode(['status' => 'gagal']);
    }
  }

  public function show($id)
  {
    $this->db->where('id_negara',$id);
    $data = $this->db->get('m_negara')->result();
    echo json_encode($data);
  }

  public function edit($id)
  {
    $data['negara']   = $this->input->post('nama_negara');
    $data['add_time'] = date('Y-m-d H:i:s');
    $data['add_by']   = $this->session->userdata('sesi_id');
    // echo json_encode(['status' => 'sukses']);
    if (cek_duplicate('m_negara', 'negara', 'id_negara', $id, $this->input->post('nama_negara')) == 0) {
      $this->db->where('id_negara', $id);
      $this->db->update('m_negara', $data);

      echo json_encode(['status' => 'sukses']);
    } else {
      echo json_encode(['status' => 'gagal']);
    }
  }

  public function remove($id)
  {
    $this->db->where('id_negara',$id);
		$this->db->delete('m_negara');

    echo json_encode(['status' => 'sukses']);
  }
}

?>
