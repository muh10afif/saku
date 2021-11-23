<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 *
 */
class Source_business extends CI_controller
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
      'title' => 'Source of Business'
    ];
    $this->template->load('template/index', 'index', $data);
  }
}

?>
