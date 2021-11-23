<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 *
 */
class M_coverage extends CI_Model
{

  function __construct() {
    parent::__construct();
  }

  var $kolom_order_user = ['coverage.label'];
  var $kolom_cari_user  = ['LOWER(coverage.label)','LOWER(coverage.rate)','LOWER(coverage.status)','LOWER(m_lob.lob)'];
  var $order_user       = ['id_coverage' => 'desc'];

  public function get_data_coverage($value='')
  {
    $this->_get_data_coverage($value);
    if ($this->input->post('length') != -1) {
      $this->db->limit($this->input->post('length'), $this->input->post('start'));
      return $this->db->get()->result_array();
    }
  }

  public function _get_data_coverage($id_lob)
  {
    $this->db->select('*');
    $this->db->from('coverage');
    $this->db->join('m_lob','coverage.id_lob = m_lob.id_lob');
    if ($id_lob != '') {
      $this->db->where('coverage.id_lob', $id_lob);
    }

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

  public function countallcoverage($id_lob = '')
  {
    $this->db->select('*');
    $this->db->from('coverage');
    $this->db->join('m_lob','coverage.id_lob = m_lob.id_lob');
    if ($id_lob != '') {
      $this->db->where('coverage.id_lob', $id_lob);
    }
    return $this->db->count_all_results();
  }

  public function countfiltercoverage($id_lob = '')
  {
    $this->_get_data_coverage($id_lob);
    return $this->db->get()->num_rows();
  }
}

?>
