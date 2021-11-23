<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 *
 */
class Cob_lob extends CI_controller
{

  public function __construct() {
    parent::__construct();
    $this->load->model('cob_lob/M_cob', 'cob');
    $this->load->model('cob_lob/M_lob', 'lob');
    $this->load->model('cob_lob/M_coblob', 'coblob');
    if($this->session->userdata('username') == "") {
      redirect(base_url(), 'refresh');
    }
  }

  public function index($value='')
  {
    $data = [
      'title' => 'Class of Business',
      'tipe_cob' => $this->cob->list_tipe_cob(),
      'list_cob' => $this->cob->list_cob(),
      'list_lob' => $this->lob->list_lob()
    ];
    $this->template->load('template/index', 'index', $data);
  }

  public function ajaxdatacob($value='')
  {
    $no   = $this->input->post('start');
    $data = $this->cob->get_data_cob();

    $datax = array();
    foreach ($data as $key) {
      $tbody = array();

      $no++;
      $tbody[] = "<div align='center'>".$no.".</div>";
      $tbody[] = $key['kode_cob'];
      $tbody[] = $key['cob'];
      $tbody[] = $key['tipe_cob'];
      $tbody[] = '<i class="icon-pencil fa-lg text-success mr-2" onclick="ubahubah('.$key['id_cob'].',1)"></i>&nbsp;
                  <i class="icon-trash-bin fa-lg text-danger mr-2" onclick="deletedel('.$key['id_cob'].',1)"></i>';
      $datax[] = $tbody;
    }

    $output = [
      "draw"            => $_POST['draw'],
      "recordsTotal"    => $this->cob->countalllistcob(),
      "recordsFiltered" => $this->cob->countfilterlistcob(),
      "data"            => $datax
    ];
    echo json_encode($output);
  }

  public function ajaxdatalob($value='')
  {
    $no   = $this->input->post('start');
    $data = $this->lob->get_data_lob();

    $datax = array();
    foreach ($data as $key) {
      $tbody = array();

      $no++;
      $tbody[] = "<div align='center'>".$no.".</div>";
      $tbody[] = $key['lob'];
      $tbody[] = $key['diskon'];
      $tbody[] = '<i class="icon-pencil fa-lg text-success mr-2" onclick="ubahubah('.$key['id_lob'].',2)"></i>&nbsp;
                  <i class="icon-paper-pencil fa-lg text-primary mr-2" data-toggle="modal" data-target="#myModal" onclick="createcoverage('.$key['id_lob'].',2)"></i>&nbsp;
                  <i class="icon-trash-bin fa-lg text-danger mr-2" onclick="deletedel('.$key['id_lob'].',2)"></i>';
      $datax[] = $tbody;
    }

    $output = [
      "draw"            => $_POST['draw'],
      "recordsTotal"    => $this->lob->countalllistlob(),
      "recordsFiltered" => $this->lob->countfilterlistlob(),
      "data"            => $datax
    ];
    echo json_encode($output);
  }

  public function ajaxdataboth($value='')
  {
    $no   = $this->input->post('start');
    $data = $this->coblob->get_data_coblob();

    $datax = array();
    foreach ($data as $key) {
      $tbody = array();

      $no++;
      $tbody[] = "<div align='center'>".$no.".</div>";
      $tbody[] = $key['cob'];
      $tbody[] = $key['tipe_cob'];
      $tbody[] = $key['lob'];
      $tbody[] = '<i class="icon-pencil fa-lg text-success mr-2" onclick="ubahubah('.$key['id_relasi_cob_lob'].',3)"></i>&nbsp;
                  <i class="icon-trash-bin fa-lg text-danger mr-2" onclick="deletedel('.$key['id_relasi_cob_lob'].',3)"></i>';
      $datax[] = $tbody;
    }

    $output = [
      "draw"            => $_POST['draw'],
      "recordsTotal"    => $this->coblob->countalllistcoblob(),
      "recordsFiltered" => $this->coblob->countfilterlistcoblob(),
      "data"            => $datax
    ];
    echo json_encode($output);
  }

  public function addcob($value='')
  {
    $data['kode_cob'] = rand();
    $data['cob'] = $this->input->post('nmcob');
    $data['id_tipe_cob'] = $this->input->post('tycob');
    $data['add_time'] = date('Y-m-d');
    $data['add_by'] = $this->session->userdata('sesi_id');
    $this->db->insert('m_cob', $data);
    $data = $this->db->insert_id();

    echo json_encode(['status' => 'sukses', 'list' => $data]);
  }

  public function addlob($value='')
  {
    $data['lob'] = $this->input->post('nmlob');
    $data['diskon'] = $this->input->post('tplob');
    $data['add_time'] = date('Y-m-d');
    $data['add_by'] = $this->session->userdata('sesi_id');
    $this->db->insert('m_lob', $data);

    echo json_encode(['status' => 'sukses', 'list' => $data]);
  }

  public function addbth($value='')
  {
    $data['id_cob'] = $this->input->post('cobrl');
    $data['id_lob'] = $this->input->post('lobrl');
    $data['add_time'] = date('Y-m-d');
    $data['add_by'] = $this->session->userdata('sesi_id');
    $this->db->insert('relasi_cob_lob', $data);

    echo json_encode(['status' => 'sukses']);
  }

  public function showcob($id)
  {
    $data = $this->cob->cobbyid($id);
    echo json_encode($data);
  }

  public function showlob($id)
  {
    $data = $this->lob->lobbyid($id);
    echo json_encode($data);
  }

  public function showbth($id)
  {
    $data = $this->coblob->coblobbyid($id);
    echo json_encode($data);
  }

  public function editcob($id)
  {
    $data['kode_cob'] = rand();
    $data['cob'] = $this->input->post('nmcob');
    $data['id_tipe_cob'] = $this->input->post('tycob');
    $data['add_time'] = date('Y-m-d');
    $data['add_by'] = $this->session->userdata('sesi_id');
    $this->db->where('id_cob', $id);
    $this->db->update('m_cob', $data);

    echo json_encode(['status' => 'sukses']);
  }

  public function editlob($id)
  {
    $data['lob'] = $this->input->post('nmlob');
    $data['diskon'] = $this->input->post('tplob');
    $data['add_time'] = date('Y-m-d');
    $data['add_by'] = $this->session->userdata('sesi_id');
    $this->db->where('id_lob', $id);
    $this->db->update('m_lob', $data);

    echo json_encode(['status' => 'sukses']);
  }

  public function editbth($id)
  {
    $data['id_cob'] = $this->input->post('cobrl');
    $data['id_lob'] = $this->input->post('lobrl');
    $data['add_time'] = date('Y-m-d');
    $data['add_by'] = $this->session->userdata('sesi_id');
    $this->db->where('id_relasi_cob_lob', $id);
    $this->db->update('relasi_cob_lob', $data);

    echo json_encode(['status' => 'sukses']);
  }

  public function removecob($id)
  {
    $this->db->where('id_cob', $id);
    $this->db->delete('m_cob');

    echo json_encode(['status' => 'sukses']);
  }

  public function removelob($id)
  {
    $this->db->where('id_lob', $id);
    $this->db->delete('m_lob');

    echo json_encode(['status' => 'sukses']);
  }

  public function removebth($id)
  {
    $this->db->where('id_relasi_cob_lob', $id);
    $this->db->delete('relasi_cob_lob');

    echo json_encode(['status' => 'sukses']);
  }
}
?>
