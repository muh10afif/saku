<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 *
 */
class M_kota extends CI_Model
{

  function __construct() {
    parent::__construct();
  }

  var $kolom_order_kota = [null, 'provinsi'];
  var $kolom_cari_kota  = ['LOWER(kota)','LOWER(provinsi)'];
  var $order_kota       = ['id_kota' => 'desc'];

  public function get_data_kota()
  {
    $this->_get_datatables_query_kota();
    if ($this->input->post('length') != -1) {
      $this->db->limit($this->input->post('length'), $this->input->post('start'));
      return $this->db->get()->result_array();
    }
  }

  public function _get_datatables_query_kota()
  {
    $this->db->select('*');
    $this->db->from('m_kota');
    $this->db->join('m_provinsi','m_provinsi.id_provinsi = m_kota.id_provinsi');
    $this->db->join('m_negara','m_negara.id_negara = m_provinsi.id_negara');
    $b = 0;

    $input_cari = strtolower($_POST['search']['value']);
    $kolom_cari = $this->kolom_cari_kota;

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
      $kolom_order = $this->kolom_order_kota;
      $this->db->order_by($kolom_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
    } elseif (isset($this->order_kota)) {
      $order = $this->order_kota;
      $this->db->order_by(key($order), $order[key($order)]);
    }
  }

  public function jumlah_semua_kota()
  {
    $this->db->select('*');
    $this->db->from('m_kota');
    $this->db->join('m_provinsi','m_provinsi.id_provinsi = m_kota.id_provinsi');
    $this->db->join('m_negara','m_negara.id_negara = m_provinsi.id_negara');
    return $this->db->count_all_results();
  }

  public function jumlah_filter_kota()
  {
    $this->_get_datatables_query_kota();
    return $this->db->get()->num_rows();
  }
}

?>
