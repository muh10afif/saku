<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 *
 */
class M_level_user extends CI_Model
{

  function __construct() {
    parent::__construct();
  }

  var $kolom_order_user = [null,'level_user'];
  var $kolom_cari_user  = ['LOWER(level_user)'];
  var $order_user       = ['id_level_user' => 'desc'];

  public function get_data_lvlusr()
  {
    $this->_get_data_lvlusr();
    if ($this->input->post('length') != -1) {
      $this->db->limit($this->input->post('length'), $this->input->post('start'));
      return $this->db->get()->result_array();
    }
  }

  public function _get_data_lvlusr()
  {
    $this->db->select('*');
    $this->db->from('level_user');

    $b = 0;
    $input_cari = strtolower($_POST['search']['value']);
    $kolom_cari = $this->kolom_cari_user;

    foreach ($kolom_cari as $cari) {
      if ($input_cari) {
        if ($b === 0) {
          $this->db->group_start();
          $this->db->like($cari, $input_cari);
        } else {
          $this->db->or_like($cari, $input_cari);
        }
        if ((count($kolom_cari) - 1) == $b ) {
          $this->db->group_end();
        }
      }
      $b++;
    }

    if ($_POST['order']) {
      $kolom_order = $this->kolom_order_user;
      $this->db->order_by($kolom_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
    } elseif (isset($this->order_user)) {
      $order = $this->order_user;
      $this->db->order_by(key($order), $order[key($order)]);
    }
  }

  public function countalllvlusr()
  {
    $this->db->select('*');
    $this->db->from('level_user');
    return $this->db->count_all_results();
  }

  public function alllvlusr()
  {
    $this->db->order_by("level_user", "asc");
    return $this->db->get('level_user')->result();
  }

  public function countfilterlvlusr()
  {
    $this->_get_data_lvlusr();
    return $this->db->get()->num_rows();
  }
}

?>
