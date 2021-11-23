<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 *
 */
class M_negara extends CI_Model
{

  function __construct() {
    parent::__construct();
  }

  var $kolom_order_negara = [null, 'negara'];
  var $kolom_cari_negara  = ['LOWER(negara)'];
  var $order_negara       = ['id_negara' => 'desc'];

  public function get_data_negara()
  {
    $this->_get_datatables_query_negara();
    if ($this->input->post('length') != -1) {
      $this->db->limit($this->input->post('length'), $this->input->post('start'));
      return $this->db->get()->result_array();
    }
  }

  public function _get_datatables_query_negara()
  {
    $this->db->from('m_negara');
    $b = 0;

    $input_cari = strtolower($_POST['search']['value']);
    $kolom_cari = $this->kolom_cari_negara;

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
      $kolom_order = $this->kolom_order_negara;
      $this->db->order_by($kolom_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
    } elseif (isset($this->order_negara)) {
      $order = $this->order_negara;
      $this->db->order_by(key($order), $order[key($order)]);
    }
  }

  public function jumlah_semua_negara()
  {
    $this->db->from('m_negara');
    return $this->db->count_all_results();
  }

  public function allnegara($value='')
  {
    $this->db->order_by("negara", "asc");
    return $this->db->get('m_negara')->result();
  }

  public function jumlah_filter_negara()
  {
    $this->_get_datatables_query_negara();
    return $this->db->get()->num_rows();

  }
}

?>
