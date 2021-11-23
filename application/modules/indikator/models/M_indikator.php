<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 *
 */
class M_indikator extends CI_Model
{

  function __construct() {
    parent::__construct();
  }

  var $kolom_order_user = [null,'nama_indikator'];
  var $kolom_cari_user  = ['LOWER(nama_indikator)'];
  var $order_user       = ['id_indikator' => 'desc'];

  public function get_data_indikator($value='')
  {
    $this->_get_data_indikator();
    if ($this->input->post('length') != -1) {
      $this->db->limit($this->input->post('length'), $this->input->post('start'));
      return $this->db->get()->result_array();
    }
  }

  public function _get_data_indikator()
  {
    $this->db->select('*');
    $this->db->from('m_indikator');

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

  public function countallindikator()
  {
    $this->db->select('*');
    $this->db->from('m_indikator');
    return $this->db->count_all_results();
  }

  public function countfilterindikator()
  {
    $this->_get_data_indikator();
    return $this->db->get()->num_rows();
  }
}

?>
