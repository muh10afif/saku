<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 *
 */
class Table_wilayah extends CI_controller
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
      'title' => 'Data Wilayah'
    ];
    $this->template->load('template/index', 'index', $data);
  }
}

?>
