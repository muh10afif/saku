<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 *
 */
class M_wilayah extends CI_Model
{

  function __construct() {
    parent::__construct();
  }

  public function get_data_allwilayah($parent = 0, $spacing = '', $category_tree_array = '')
  {
    if (!is_array($category_tree_array)) { $category_tree_array = array(); }
    $this->_get_data_wilayah($parent);
    $query2 = $this->db->get();
    if ($query2->num_rows() > 0) {
      foreach ($query2->result() as $row) {
        $category_tree_array[] = array("id_wilayah" => $row->id_wilayah,"parent" => $row->parent, "kode_wilayah" => $row->kode_wilayah,"nama" => $spacing . $row->nama);
        $category_tree_array = $this->get_data_allwilayah($row->id_wilayah, '&nbsp;&nbsp;&nbsp;&nbsp;'.$spacing . '-&nbsp;', $category_tree_array);
      }
    }
    return $category_tree_array;
  }

  public function _get_data_wilayah($parent)
  {
    $this->db->select('*');
    $this->db->where(['parent' => $parent]);
    $this->db->from('m_wilayah');
    $this->db->order_by('level','ASC');
  }
}

?>
