<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 *
 */
class M_jabatan extends CI_Model
{

  function __construct() {
    parent::__construct();
  }

  public function get_data_alljabatan($parent = 0, $spacing = '', $category_tree_array = '')
  {
    if (!is_array($category_tree_array)) { $category_tree_array = array(); }
    $this->_get_data_alljabatan($parent);
    $query2 = $this->db->get();
    if ($this->input->post('length') != -1) {
      $this->db->limit($this->input->post('length'), $this->input->post('start'));
      if ($query2->num_rows() > 0) {
        foreach ($query2->result() as $row) {
          $category_tree_array[] = array("id_jabatan" => $row->id_jabatan,"parent" => $row->parent, "jabatan" => $spacing . $row->jabatan, "bagian" => $row->bagian, "kode_jabatan" => $row->kode_jabatan);
          $category_tree_array = $this->get_data_alljabatan($row->id_jabatan, '&nbsp;&nbsp;&nbsp;&nbsp;'.$spacing . '-&nbsp;', $category_tree_array);
        }
      }
      
      return $category_tree_array;
    }
  }

  public function _get_data_alljabatan($parn)
  {
    $this->db->select('*');
    $this->db->join('m_bagian','m_bagian.id_bagian = m_jabatan.id_bagian');
    $this->db->where('parent', $parn);
    $this->db->from('m_jabatan');

    $this->db->order_by('kode_jabatan', 'asc');
  }

  public function countalljabatan()
  {
    $this->db->select('*');
    $this->db->from('m_jabatan');
    $this->db->join('m_bagian','m_bagian.id_bagian = m_jabatan.id_bagian');
    return $this->db->count_all_results();
  }

  public function alljabatann()
  {
    $this->db->order_by("kode_jabatan", "asc");
    return $this->db->get('m_jabatan')->result();
  }

  public function countfilterjabatan()
  {
    $this->_get_data_alljabatan(0);
    return $this->db->get()->num_rows();
  }
}

?>
