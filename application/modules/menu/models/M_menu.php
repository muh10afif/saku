<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 *
 */
class M_menu extends CI_Model
{
  function __construct() {
    parent::__construct();
  }

  public function get_data_allmenu($isinm,$parent = 0, $spacing = '', $category_tree_array = '')
  {
    if (!is_array($category_tree_array)) { $category_tree_array = array(); }
    $this->_get_data_menu($parent,$isinm);
    $query2 = $this->db->get();
    if ($query2->num_rows() > 0) {
      foreach ($query2->result() as $row) {
        $category_tree_array[] = array("id_menu" => $row->id,"parrent" => $row->parrent, "link" => $row->link, "sistem" => $row->sistem, "nama_menu" => $spacing . $row->nama_menu);
        $category_tree_array = $this->get_data_allmenu($isinm,$row->id, '&nbsp;&nbsp;&nbsp;&nbsp;'.$spacing . '-&nbsp;', $category_tree_array);
      }
    }
    return $category_tree_array;
  }

  public function _get_data_menu($parent,$isinya)
  {
    $this->db->select('*');
    $this->db->where(['parrent' => $parent, 'sistem' => $isinya]);
    $this->db->from('ref_menu');
    $this->db->order_by('urutan','ASC');
  }
}

?>
