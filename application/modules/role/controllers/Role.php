<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 *
 */
class Role extends CI_controller
{

  public function __construct() {
    parent::__construct();
    $this->load->model('M_role','role');
    if($this->session->userdata('username') == "") {
      redirect(base_url(), 'refresh');
    }
  }

  public function admin($value='')
  {
    $data = [
      'title'        => 'Role Otorisasi',
      'categoryList' => $this->categoryParentChildTree(),
      'menuuser'     => $this->role->menubyjabatan(array('id_level_otorisasi'=>$value)),
      'iddjabatan'   => $this->role->datagrup(array('id_level_otorisasi'=>$value)),
      'role' => get_role($this->session->userdata('id_level_otorisasi'))
    ];
    $this->template->load('template/index', 'index', $data);
  }

  public function categoryParentChildTree($parent = 0, $spacing = '', $category_tree_array = '') {
		if (!is_array($category_tree_array)) { $category_tree_array = array(); }
    $this->db->where('parrent',$parent);
    $this->db->order_by('urutan','ASC');
    $query2 = $this->db->get('ref_menu');
		if ($query2->num_rows() > 0) {
      foreach ($query2->result() as $row) {
        $category_tree_array[] = array("id_menu" => $row->id,"parrent" => $row->parrent, "sistem" => $row->sistem, "nama_menu" => $spacing . $row->nama_menu);
        $category_tree_array = $this->categoryParentChildTree($row->id, '&nbsp;&nbsp;&nbsp;&nbsp;'.$spacing . '-&nbsp;', $category_tree_array);
      }
    }
    return $category_tree_array;
  }

  public function update($value='')
  {
    try {
      $id = $this->input->post('idjbtn');
			$role = $this->input->post('role');
      $this->db->where('id_level_otorisasi', $id);
			$q=$this->db->delete('privilage');
      if ($q) {
        $datax = array();
        foreach ($this->input->post('cb_pv') as $symb) {
          $act_role="";
          if(isset($role[$symb]) && $role[$symb]!='' && $role[$symb]!=null){
						foreach ($role[$symb] as $key => $value) {
							$act_role .= $value;
						}
					}
          $datax[] = array('id_menu' => $symb,'id_level_otorisasi' => $id,'action' => $act_role);
        }
        $this->db->insert_batch('privilage', $datax);
        echo json_encode(['status'=>'sukses']);
      }
    } catch(Exception $err) {
			log_message("error",$err->getMessage());
			return show_error($err->getMessage());
    }
  }
}

?>
