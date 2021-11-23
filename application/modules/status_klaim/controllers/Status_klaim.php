<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 *
 */
class Status_klaim extends CI_controller
{

  public function __construct() {
    parent::__construct();
    $this->load->model('M_status_klaim', 'status_klaim');
    if($this->session->userdata('username') == "") {
      redirect(base_url(), 'refresh');
    }
  }

  public function index($value='')
  {
    $data = [
      'title' => 'Status Klaim',
      'role' => get_role($this->session->userdata('id_level_otorisasi'))
    ];
    $this->template->load('template/index', 'index', $data);
  }

  public function ajaxdata($action)
  {
    $permisi = explode('_',$action);
    $b1 = ''; $b2 = '';

    $no   = $this->input->post('start');
    $data = $this->status_klaim->get_data_status_klaim();

    $datax = array();
    foreach ($data as $key) {
      $tbody = array();

      $no++;
      $tbody[] = "<div align='center'>".$no.".</div>";
      $tbody[] = $key['status_klaim'];
      if ($permisi[0] == 'true' || $action == '_') {
        $b1 = '<span style="cursor:pointer" class="mr-2 text-primary '.(count($data) > 1?'ttip':'').'" data-toggle="tooltip" data-placement="top" title="Ubah" onclick="ubahubah('.$key['id_status_klaim'].')"><i class="fas fa-pencil-alt fa-lg"></i></span>';
      }
      if ($permisi[1] == 'true' || $action == '_') {
        $b2 = '<span style="cursor:pointer" class="text-danger '.(count($data) > 1?'ttip':'').'" data-toggle="tooltip" data-placement="top" title="Hapus" onclick="deletedel('.$key['id_status_klaim'].')"><i class="far fa-trash-alt fa-lg"></i></span>';
      }
      $tbody[] = $b1.$b2;
      $datax[] = $tbody;
    }

    $output = [
      "draw"            => $_POST['draw'],
      "recordsTotal"    => $this->status_klaim->countallstatusklaim(),
      "recordsFiltered" => $this->status_klaim->countfilterstatusklaim(),
      "data"            => $datax
    ];
    echo json_encode($output);
  }

  public function add()
  {
    $data['status_klaim'] = $this->input->post('nmstatusk');
    $data['add_time'] = date('Y-m-d');
    $data['add_by'] = $this->session->userdata('sesi_id');

    if (cek_duplicate('m_status_klaim', 'status_klaim', '', '', $this->input->post('nmstatusk')) == 0) {
      $this->db->insert('m_status_klaim', $data);
      echo json_encode(['status' => 'sukses']);
    } else {
      echo json_encode(['status' => 'gagal']);
    }
    
    // if (duplicatecek('m_status_klaim', $data) == 0) {
    //   $this->db->insert('m_status_klaim', $data);
    //   echo json_encode(['status' => 'sukses']);
    // } else {
    //   echo json_encode(['status' => 'gagal']);
    // }
  }

  public function show($id)
  {
    $this->db->where('id_status_klaim',$id);
    $data = $this->db->get('m_status_klaim')->result();
    echo json_encode($data);
  }

  public function edit($id)
  {
    $data['status_klaim'] = $this->input->post('nmstatusk');
    $data['add_time'] = date('Y-m-d');

    if (cek_duplicate('m_status_klaim', 'status_klaim', 'id_status_klaim', $id, $this->input->post('nmstatusk')) == 0) {
      $this->db->where('id_status_klaim', $id);
      $this->db->update('m_status_klaim', $data);
      echo json_encode(['status' => 'sukses']);
    } else {
      echo json_encode(['status' => 'gagal']);
    }
    
    // $data['add_by'] = $this->session->userdata('sesi_id');
    // $this->db->where('id_status_klaim', $id);
    // $this->db->update('m_status_klaim', $data);
    // echo json_encode(['status' => 'sukses']);
    // if (duplicatecek('m_status_klaim', $data) == 0) {
    // } else {
    //   echo json_encode(['status' => 'gagal']);
    // }
  }

  public function remove($id)
  {
    $this->db->where('id_status_klaim',$id);
		$this->db->delete('m_status_klaim');

    echo json_encode(['status' => 'sukses']);
  }
}

?>
