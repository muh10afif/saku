<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 *
 */
class Level_user extends CI_controller
{

  public function __construct() {
    parent::__construct();
    $this->load->model('M_level_user', 'level_user');
    if($this->session->userdata('username') == "") {
      redirect(base_url(), 'refresh');
    }
  }

  public function admin($value='')
  {
    $data = [
      'title' => 'Data Level User',
      'role' => get_role($this->session->userdata('id_level_otorisasi'))
    ];
    $this->template->load('template/index', 'index', $data);
  }

  public function ajaxdata($action)
  {
    $permisi = explode('_',$action);
    $b1 = ''; $b2 = '';

    $no   = $this->input->post('start');
    $data = $this->level_user->get_data_lvlusr();

    $datax = array();
    foreach ($data as $key) {
      $tbody = array();

      $no++;
      $tbody[] = "<div align='center'>".$no.".</div>";
      $tbody[] = $key['level_user'];
      if ($permisi[0] == 'true' || $action == '_') {
        $b1 = '<span style="cursor:pointer" class="mr-2 text-primary '.(count($data) > 1?'ttip':'').'" data-toggle="tooltip" data-placement="top" title="Ubah" onclick="ubahubah('.$key['id_level_user'].')"><i class="fas fa-pencil-alt fa-lg"></i></span>';
      }
      if ($permisi[1] == 'true' || $action == '_') {
        $b2 = '<span style="cursor:pointer" class="text-danger '.(count($data) > 1?'ttip':'').'" data-toggle="tooltip" data-placement="top" title="Hapus" onclick="deletedel('.$key['id_level_user'].')"><i class="far fa-trash-alt fa-lg"></i></span>';
      }
      $tbody[] = $b1.$b2;
      $datax[] = $tbody;
    }

    $output = [
      "draw"            => $_POST['draw'],
      "recordsTotal"    => $this->level_user->countalllvlusr(),
      "recordsFiltered" => $this->level_user->countfilterlvlusr(),
      "data"            => $datax
    ];
    echo json_encode($output);
  }

  public function add()
  {
    $data['level_user'] = $this->input->post('lvlusr');
    $data['add_time'] = date('Y-m-d');
    $data['add_by'] = $this->session->userdata('sesi_id');

    if (cek_duplicate('level_user', 'level_user', '', '', $this->input->post('lvlusr')) == 0) {
      $this->db->insert('level_user', $data);
      echo json_encode(['status' => 'sukses']);
    } else {
      echo json_encode(['status' => 'gagal']);
    }
  }

  public function show($id)
  {
    $this->db->where('id_level_user',$id);
    $data = $this->db->get('level_user')->result();
    echo json_encode($data);
  }

  public function edit($id)
  {
    $data['level_user'] = $this->input->post('lvlusr');
    $data['add_time'] = date('Y-m-d');
    $data['add_by'] = $this->session->userdata('sesi_id');

    if (cek_duplicate('level_user', 'level_user', 'id_level_user', $id, $this->input->post('lvlusr')) == 0) {
      $this->db->where('id_level_user', $id);
      $this->db->update('level_user', $data);
      echo json_encode(['status' => 'sukses']);
    } else {
      echo json_encode(['status' => 'gagal']);
    }
  }

  public function remove($id)
  {
    $this->db->where('id_level_user',$id);
		$this->db->delete('level_user');

    echo json_encode(['status' => 'sukses']);
  }
}

?>
