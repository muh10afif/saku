<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * created by : me
 */
class M_level_otorisasi extends CI_Model
{

  function __construct() {
    parent::__construct();
  }

  var $kolom_order_user = [null,'level_otorisasi.level_otorisasi','level_user.level_user'];
  var $kolom_cari_user  = ['LOWER(level_otorisasi.level_otorisasi)','LOWER(level_user.level_user)'];
  var $order_user       = ['level_otorisasi.id_level_otorisasi' => 'desc'];

  public function get_data_alllvloto()
  {
    $this->_get_data_alllvloto();
    if ($this->input->post('length') != -1) {
      $this->db->limit($this->input->post('length'), $this->input->post('start'));
      return $this->db->get()->result_array();
    }
  }

  public function _get_data_alllvloto()
  {
    $this->db->select('*');
    $this->db->from('level_otorisasi');
    $this->db->join('level_user','level_user.id_level_user = level_otorisasi.id_level_user');

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

  public function countalllvloto()
  {
    $this->db->select('*');
    $this->db->from('level_otorisasi');
    $this->db->join('level_user','level_user.id_level_user = level_otorisasi.id_level_user');
    return $this->db->count_all_results();
  }

  public function alllvloto()
  {
    $this->db->order_by("level_otorisasi", "asc");
    return $this->db->get('level_otorisasi')->result();
  }

  public function countfilterlvloto()
  {
    $this->_get_data_alllvloto();
    return $this->db->get()->num_rows();
  }
}

?>
