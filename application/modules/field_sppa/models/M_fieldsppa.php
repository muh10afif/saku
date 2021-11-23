<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 *
 */
class M_fieldsppa extends CI_Model
{

  function __construct() {
    parent::__construct();
  }

  var $kolom_order_user = [null,'field_sppa', 'data_type', 'cdb'];
  var $kolom_cari_user  = ['LOWER(field_sppa)', 'LOWER(data_type)'];
  var $order_user       = ['id_field_sppa' => 'desc'];

  public function get_data_fieldsppa($value='')
  {
    $this->_get_data_fieldsppa();
    if ($this->input->post('length') != -1) {
      $this->db->limit($this->input->post('length'), $this->input->post('start'));
      return $this->db->get()->result_array();
    }
  }

  public function _get_data_fieldsppa($value='')
  {
    $this->db->from('m_field_sppa');

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

  public function countalllistfieldsppa($value='')
  {
    $this->db->select('*');
    $this->db->from('m_field_sppa');
    return $this->db->count_all_results();
  }

  public function countfilterlistfieldsppa($value='')
  {
    $this->_get_data_fieldsppa();
    return $this->db->get()->num_rows();
  }

  public function showbyid($id)
  {
    $this->db->order_by("m_field_sppa", "asc");
    $this->db->where('id_field_sppa', $id);
    $data = $this->db->get('m_field_sppa')->result();
    return $data;
  }

  public function list_fild($value='')
  {
    $this->db->order_by("field_sppa", "asc");
    return $this->db->get('m_field_sppa')->result();
  }
}

?>
