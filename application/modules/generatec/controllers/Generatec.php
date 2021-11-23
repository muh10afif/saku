<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 *
 */
class Generatec extends CI_controller
{

  public function __construct() {
    parent::__construct();
    if($this->session->userdata('username') == "") {
      redirect(base_url(), 'refresh');
    }
  }

  public function setcode($value='')
  { // setcode?tabl=m_jabatan&sngkt=JBT&fcod=kode_jabatan
    $table = $this->input->get('tabl');
    $code = $this->input->get('sngkt');
    $fildc = $this->input->get('fcod');

    $this->db->order_by('id_'.substr($table,2,strlen($table)), 'asc');
    $list = $this->db->get($table);
    $digit = "000000"; $colectkd = array();
    for ($i=0; $i < $list->num_rows(); $i++) {
      $data = $list->result_array();
      $c = substr($digit, strlen(($i+1)));
      $kode['id_'.substr($table,2,strlen($table))] = $data[$i]['id_'.substr($table,2,strlen($table))];
      $kode[$fildc] = $code.$c.($i+1);
      echo ($i+1).". - ".$code.$c.($i+1)."</br>";
      $colectkd[] = $kode;
    }
    $this->db->update_batch($table, $colectkd, 'id_'.substr($table,2,strlen($table)));
  }
}

?>
