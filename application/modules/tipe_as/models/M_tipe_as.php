<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 *
 */
class M_tipe_as extends CI_Model
{

  function __construct() {
    parent::__construct();
  }

  var $kolom_order_user = [null,'tipe_as'];
  var $kolom_cari_user  = ['LOWER(tipe_as)'];
  var $order_user       = ['id_tipe_as' => 'desc'];

  public function get_data_tipe_as($value='')
  {
    $this->_get_data_tipe_as();
    if ($this->input->post('length') != -1) {
      $this->db->limit($this->input->post('length'), $this->input->post('start'));
      return $this->db->get()->result_array();
    }
  }

  public function _get_data_tipe_as()
  {
    $this->db->select('*');
    $this->db->from('m_tipe_as');

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

    if (isset($_POST['order'])) {
      $kolom_order = $this->kolom_order_user;
      $this->db->order_by($kolom_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
    } elseif (isset($this->order_user)) {
      $order = $this->order_user;
      $this->db->order_by(key($order), $order[key($order)]);
    }
  }

  public function countalltipeas()
  {
    $this->db->select('*');
    $this->db->from('m_tipe_as');
    return $this->db->count_all_results();
  }

  public function alltipeas($value='')
  {
    $this->db->order_by("tipe_as", "asc");
    return $this->db->get("m_tipe_as")->result();
  }

  public function countfiltertipeas()
  {
    $this->_get_data_tipe_as();
    return $this->db->get()->num_rows();
  }
}

?>
