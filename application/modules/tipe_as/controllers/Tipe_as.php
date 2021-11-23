<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 *
 */
class Tipe_as extends CI_controller
{

  public function __construct() {
    parent::__construct();
    $this->load->model('M_tipe_as', 'tipe_as');
    if($this->session->userdata('username') == "") {
      redirect(base_url(), 'refresh');
    }
  }

  public function index($value='')
  {
    $data = [
      'title' => 'Tipe Asuransi',
      'role' => get_role($this->session->userdata('id_level_otorisasi'))
    ];
    $this->template->load('template/index', 'index', $data);
  }

  public function ajaxdata($action)
  {
    $permisi = explode('_',$action);
    $b1 = ''; $b2 = '';

    $no   = $this->input->post('start');
    $data = $this->tipe_as->get_data_tipe_as();

    $datax = array();
    foreach ($data as $key) {
      $tbody = array();

      $no++;
      $tbody[] = "<div align='center'>".$no.".</div>";
      $tbody[] = $key['tipe_as'];
      if ($permisi[0] == 'true' || $action == '_') {
        $b1 = '<span style="cursor:pointer" class="mr-2 text-primary '.(count($data) > 1?'ttip':'').'" data-toggle="tooltip" data-placement="top" title="Ubah" onclick="ubahubah('.$key['id_tipe_as'].')"><i class="fas fa-pencil-alt fa-lg"></i></span>';
      }
      if ($permisi[1] == 'true' || $action == '_') {
        $b2 = '<span style="cursor:pointer" class="text-danger '.(count($data) > 1?'ttip':'').'" data-toggle="tooltip" data-placement="top" title="Hapus" onclick="deletedel('.$key['id_tipe_as'].')"><i class="far fa-trash-alt fa-lg"></i></span>';
      }
      $tbody[] = $b1.$b2;
      $datax[] = $tbody;
    }

    $output = [
      "draw"            => $_POST['draw'],
      "recordsTotal"    => $this->tipe_as->countalltipeas(),
      "recordsFiltered" => $this->tipe_as->countfiltertipeas(),
      "data"            => $datax
    ];
    echo json_encode($output);
  }

  public function add()
  {
    $data['tipe_as'] = $this->input->post('nmtipeas');
    $data['add_time'] = date('Y-m-d');
    $data['add_by'] = $this->session->userdata('sesi_id');
    if (cek_duplicate('m_tipe_as', 'tipe_as', '', '', $this->input->post('nmtipeas')) == 0) {
      $this->db->insert('m_tipe_as', $data);
      echo json_encode(['status' => 'sukses']);
    } else {
      echo json_encode(['status' => 'gagal']);
    }
  }

  public function show($id)
  {
    $this->db->where('id_tipe_as',$id);
    $data = $this->db->get('m_tipe_as')->result();
    echo json_encode($data);
  }

  public function edit($id)
  {
    $data['tipe_as'] = $this->input->post('nmtipeas');
    $data['add_time'] = date('Y-m-d');
    $data['add_by'] = $this->session->userdata('sesi_id');

    if (cek_duplicate('m_tipe_as', 'tipe_as', 'id_tipe_as', $id, $this->input->post('nmtipeas')) == 0) {
      $this->db->where('id_tipe_as', $id);
      $this->db->update('m_tipe_as', $data);
      echo json_encode(['status' => 'sukses']);
    } else {
      echo json_encode(['status' => 'gagal']);
    }
  }

  public function remove($id)
  {
    $this->db->where('id_tipe_as',$id);
		$this->db->delete('m_tipe_as');

    echo json_encode(['status' => 'sukses']);
  }
}

?>
