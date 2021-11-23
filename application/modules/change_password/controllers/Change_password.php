<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 *
 */
class Change_password extends CI_controller
{
  var $validcfg;

  public function __construct() {
    parent::__construct();
    $this->load->library('form_validation');
    $this->validcfg = array(
      array('field' => 'oldpasp', 'label' => 'Password Lama', 'rules' => 'required'),
      array('field' => 'password', 'label' => 'Password Baru', 'rules' => 'required'),
      array('field' => 'pass_con', 'label' => 'Password Confirmation', 'rules' => 'required')
    );
    if($this->session->userdata('username') == "") {
      redirect(base_url(), 'refresh');
    }
  }

  public function index($value='')
  {
    $data = [
      'title' => 'Change Password',
      'idusn' => $this->session->userdata('sesi_id'),
      'role' => get_role($this->session->userdata('id_level_otorisasi'))
    ];
    $this->template->load('template/index', 'index', $data);
  }

  public function getusn($idn)
  {
    $this->db->where('id_user', $idn);
    return $this->db->get('m_user')->result();
  }

  public function update($id)
  {
    $this->form_validation->set_rules($this->validcfg);
    if ($this->form_validation->run() == FALSE) {
      echo json_encode([
        'judul' => 'Gagal',
        'status' => 'Password Gagal di Update',
        'tipe' => 'warning'
      ]);
    } else {
      $opass = $this->getusn($id);
      if (password_verify($this->input->post('oldpasp'), $opass[0]->password)) {
        $data['password'] = password_hash($this->input->post('password'), PASSWORD_DEFAULT);
        $this->db->where('id_user', $id);
        $this->db->update('m_user', $data);

        echo json_encode([
          'judul' => 'Berhasil',
          'status' => 'Password Berhasil di Update',
          'tipe' => 'success'
        ]);
      } else {
        echo json_encode([
          'judul' => 'Gagal',
          'status' => 'Password Lama tidak Sama',
          'tipe' => 'warning'
        ]);
      }
    }
  }
}

?>
