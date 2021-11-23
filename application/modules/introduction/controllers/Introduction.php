<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 *
 */
class introduction extends CI_controller
{

  public function __construct() {
    parent::__construct();
    if($this->session->userdata('username') == "") {
      redirect(base_url(), 'refresh');
    }
  }

  public function index($value='')
  {
    $data = [
      'title' => 'Introduction',
      'intro' => $this->db->get('m_introduction')->result(),
      'role' => get_role($this->session->userdata('id_level_otorisasi'))
    ];
    $this->template->load('template/index', 'index', $data);
  }

  public function insupintro($val)
  {
    $data['introduction'] = $this->input->post('isi');
    $data['add_time'] = date('Y-m-d');
    $data['add_by'] = $this->session->userdata('sesi_id');
    if ($val == 0) {
      $this->db->insert('m_introduction', $data);
    } else {
      $this->db->where('id_introduction', $val);
      $this->db->update('m_introduction', $data);
    }
    echo json_encode(['status' => 'sukses']);
  }
}

?>
