<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 *
 */
class M_name_management extends CI_Model
{

  function __construct() {
    parent::__construct();
  }

  var $kolom_order_user = [null,'m_title_management.title_management','m_subtitle_management.subtitle_management','m_name_management.name_management'];
  var $kolom_cari_user  = ['LOWER(m_name_management.name_management)','LOWER(m_subtitle_management.subtitle_management)','LOWER(m_title_management.title_management)'];
  var $order_user       = ['m_name_management.id_name_management' => 'desc'];

  public function get_data_name($value='')
  {
    $this->_get_data_name();
    if ($this->input->post('length') != -1) {
      $this->db->limit($this->input->post('length'), $this->input->post('start'));
    }
    return $this->db->get()->result_array();
  }

  public function _get_data_name()
  {
    $this->db->select('*');
    $this->db->from('m_name_management');
    $this->db->join('m_subtitle_management','m_subtitle_management.id_subtitle_management = m_name_management.id_subtitle_management');
    $this->db->join('m_title_management','m_title_management.id_title_management = m_subtitle_management.id_title_management');

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

  public function countalllistname($value='')
  {
    $this->db->select('*');
    $this->db->from('m_name_management');
    $this->db->join('m_subtitle_management','m_subtitle_management.id_subtitle_management = m_name_management.id_subtitle_management');
    $this->db->join('m_title_management','m_title_management.id_title_management = m_subtitle_management.id_title_management');
    return $this->db->count_all_results();
  }

  public function countfilterlistname($value='')
  {
    $this->_get_data_name();
    return $this->db->get()->num_rows();
  }

  public function list_name()
  {
    $this->db->order_by("name_management", "asc");
    return $this->db->get('m_name_management')->result();
  }

  public function namebyid($id)
  {
    $this->db->join('m_subtitle_management','m_subtitle_management.id_subtitle_management = m_name_management.id_subtitle_management');
    $this->db->join('m_title_management','m_title_management.id_title_management = m_subtitle_management.id_title_management');
    $this->db->where('id_name_management', $id);
    return $this->db->get('m_name_management')->result();
  }
}

?>
