<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 *
 */
class Visi_misi extends CI_controller
{

  public function __construct() {
    parent::__construct();
    $this->load->model('visi_misi/M_visi', 'visi');
    $this->load->model('visi_misi/M_misi', 'misi');
    $this->load->model('visi_misi/M_value', 'value');
    if($this->session->userdata('username') == "") {
      redirect(base_url(), 'refresh');
    }
  }

  public function index($value='')
  {
    $data = [
      'title' => 'Visi, Misi dan Values',
      'dvisi' => $this->visi->allvisi(),
      'dmisi' => $this->misi->allmisi(),
      'dvalu' => $this->value->allvalue(),
      'role' => get_role($this->session->userdata('id_level_otorisasi'))
    ];
    $this->template->load('template/index', 'index', $data);
  }

  public function insupvisi($val)
  {
    $data['visi'] = $this->input->post('isi');
    $data['add_time'] = date('Y-m-d');
    $data['add_by'] = $this->session->userdata('sesi_id');
    if ($val == 0) {
      $this->db->insert('m_visi', $data);
    } else {
      $this->db->where('id_visi', $val);
      $this->db->update('m_visi', $data);
    }
    echo json_encode(['status' => 'sukses']);
  }

  public function insupmisi($val)
  {
    $data['misi'] = $this->input->post('isi');
    $data['add_time'] = date('Y-m-d');
    $data['add_by'] = $this->session->userdata('sesi_id');
    if ($val == 0) {
      $this->db->insert('m_misi', $data);
    } else {
      $this->db->where('id_misi', $val);
      $this->db->update('m_misi', $data);
    }
    echo json_encode(['status' => 'sukses']);
  }

  public function insupvale($val)
  {
    $data['value'] = $this->input->post('isi');
    $data['add_time'] = date('Y-m-d');
    $data['add_by'] = $this->session->userdata('sesi_id');
    if ($val == 0) {
      $this->db->insert('m_value', $data);
    } else {
      $this->db->where('id_value', $val);
      $this->db->update('m_value', $data);
    }
    echo json_encode(['status' => 'sukses']);
  }
}

?>
