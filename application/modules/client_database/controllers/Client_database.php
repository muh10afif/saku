<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 *
 */
class Client_database extends CI_controller
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
      'title' => 'Client Database'
    ];
    $this->template->load('template/index', 'index', $data);
  }

  public function create($value='')
  {
    $data = [
      'title' => 'Create Client Database'
    ];

    $this->template->load('template/index','create', $data);
  }
}

?>
