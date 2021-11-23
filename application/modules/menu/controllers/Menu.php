<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 *
 */
class Menu extends CI_controller
{
  var $validcfg;

  public function __construct() {
    parent::__construct();
    $this->load->model('M_menu','menuu');
    $this->load->library('form_validation');
    $this->validcfg = array(
      array('field' => 'judul', 'label' => 'Judul', 'rules' => 'required'),
      array('field' => 'lnk_menu', 'label' => 'Link Menu', 'rules' => 'required'),
      array('field' => 'urt_menu', 'label' => 'Urutan Menu', 'rules' => 'required'),
      array('field' => 'its_menu', 'label' => 'Menu Active', 'rules' => 'required'),
      array('field' => 'sistem', 'label' => 'Sistem', 'rules' => 'required'),
    );
    if($this->session->userdata('username') == "") {
      redirect(base_url(), 'refresh');
    }
  }

  public function categoryParentChildTree($parent = 0, $spacing = '', $category_tree_array = '', $sistem = 'home') {
		if (!is_array($category_tree_array))
        $category_tree_array = array();
    $this->db->where('parrent',$parent);
    $this->db->where('sistem', $sistem);
    $this->db->order_by('urutan','ASC');
    $query2 = $this->db->get('ref_menu');
		if ($query2->num_rows() > 0) {
      foreach ($query2->result() as $row) {
        $category_tree_array[] = array("id_menu" => $row->id,"parrent" => $row->parrent, "nama_menu" => $spacing . $row->nama_menu);
        $category_tree_array = $this->categoryParentChildTree($row->id, '&nbsp;&nbsp;&nbsp;&nbsp;'.$spacing . '-&nbsp;', $category_tree_array,  $sistem);
      }
    }
    return $category_tree_array;
  }

  public function admin($value='') {
    $data 	= [
      'title'         => 'Menu Administration',
      'categoryList'  => $this->categoryParentChildTree(),
      'role'          => get_role($this->session->userdata('id_level_otorisasi'))
    ];
    $this->template->load('template/index', 'index', $data);
  }

  // 01-09-2021
  public function tampil_submenu($sistem = 'home')
  {

    $list = $this->categoryParentChildTree(0,'','',$sistem);

    $option = "<option value='0'>-- Pilih Menu --</option>";

    foreach ($list as $key => $s) {
      $option .= "<option value='".$s['id_menu']."'>".$s['nama_menu']."</option>";
    }

    echo json_encode(['option_submenu' => $option]);
  }

  public function listisidata()
  {
    echo json_encode($this->categoryParentChildTree());
  }

  public function ajaxdata($isi)
  {
    $action = $this->input->post('aksi');
    $permisi = explode('_',$action);
    $b1 = ''; $b2 = '';

    $nmn = $isi == 1 ? 'home':'ajk';
    $menumenu = $this->menuu->get_data_allmenu($nmn,0,'','');

    $no = 1;
    $datax = array();
    foreach ($menumenu as $key => $value) {
      $this->db->select('count(*) as jml');
      $this->db->where(['parrent' => $value['id_menu'], 'sistem' => $nmn]);
      $hs = $this->db->get('ref_menu')->result_array();
      $tbody = array();

      $tbody[] = "<div align='center'>".$no++.".</div>";
      $tbody[] = $hs[0]['jml'] == 0 ?'<em style="color:#555;">'.'<a href="'.base_url($value['link']).'">'.$value['nama_menu'].'</a>'.'</em>':'<strong>'.$value['nama_menu'].'</strong>';
      if ($permisi[0] == 'true' || $action == '_') {
        $b1 = '<span style="cursor:pointer" class="mr-2 text-primary '.(count($menumenu) > 1?'ttip':'').'" data-toggle="tooltip" data-placement="top" title="Ubah" onclick="ubahubah('.$value['id_menu'].')">
                <i class="fas fa-pencil-alt fa-lg"></i>
               </span>&nbsp;';
      }
      if ($permisi[1] == 'true' || $action == '_') {
        $b2 = '<span style="cursor:pointer" class="text-danger '.(count($menumenu) > 1?'ttip':'').'" data-toggle="tooltip" data-placement="top" title="Hapus" onclick="deletedel('.$value['id_menu'].')">
                <i class="far fa-trash-alt fa-lg"></i>
               </span>';
      }
      $tbody[] = $b1.$b2;
      $datax[] = $tbody;
    }
    $output = [
      "draw" => $_POST['draw'],
      "recordsTotal" => count($menumenu),
      "data" => $datax
    ];
    echo json_encode($output);
  }

  public function dpcek($db, $data)
  {
    $this->db->select('column_name');
    $this->db->where('table_name',$db);
    $colm = $this->db->get('information_schema.columns')->result();
    $xy = array();
    foreach ($colm as $key) {
      if ($key->column_name != 'created_at' && $key->column_name != 'id') {
        $xy[$key->column_name] = $data[$key->column_name];
      }
    }
    $this->db->where($xy);
    return $this->db->get($db)->num_rows();
  }

  public function add()
  {
    $this->form_validation->set_rules($this->validcfg);
    if ($this->form_validation->run() == FALSE) {
      echo json_encode(['status' => 'Gagal', 'pesan' => 'Gagal Insert, Ada Form yang kosong', 'altr' =>'warning']);
    } else {
      $data['nama_menu']    = $this->input->post('judul');
      $data['parrent']      = $this->input->post('sub_menu');
      $data['link']         = $this->input->post('lnk_menu');
      $data['urutan']       = $this->input->post('urt_menu');
      $data['class_active'] = $this->input->post('its_menu');
      $data['icon']         = $this->input->post('icon');
      $data['sistem']       = $this->input->post('sistem');
      $data['created_at']   = date('Y-m-d');
      if ($this->dpcek('ref_menu', $data) == 0) {
        $this->db->insert('ref_menu', $data);
        echo json_encode(['status' => "Berhasil", 'pesan' => 'Berhasil Menambahkan Menu', 'altr' => 'success']);
      } else {
        echo json_encode(['status' => "Gagal", 'pesan' => 'Menu Tersebut Sudah Ada', 'altr' => 'error']);
      }
    }
  }

  public function show($id)
  {
    $this->db->where('id',$id);
    $data = $this->db->get('ref_menu')->result();
    echo json_encode($data);
  }

  public function edit($id)
  {
    $this->form_validation->set_rules($this->validcfg);
    if ($this->form_validation->run() == FALSE) {
      echo json_encode(['status' => 'Gagal', 'pesan' => 'Gagal Edit, Ada Form yg kosong', 'altr' =>'warning']);
    } else {
      $data['nama_menu']    = $this->input->post('judul');
      $data['parrent']      = $this->input->post('sub_menu');
      $data['link']         = $this->input->post('lnk_menu');
      $data['urutan']       = $this->input->post('urt_menu');
      $data['class_active'] = $this->input->post('its_menu');
      $data['icon']         = $this->input->post('icon');
      $data['sistem']       = $this->input->post('sistem');
      $data['created_at']   = date('Y-m-d');
      $this->db->where('id', $id);
      $this->db->update('ref_menu', $data);
      echo json_encode(['status' => "Berhasil", 'pesan' => 'Berhasil Mengupdate Menu', 'altr' => 'success']);
      // if ($this->dpcek('ref_menu', $data) == 0) {
      // } else {
      //   echo json_encode(['status' => "Gagal", 'pesan' => 'Menu Tersebut Sudah Ada', 'altr' => 'error']);
      // }
    }
  }

  public function remove($id)
  {
    $this->db->where('id', $id);
    $lokup = $this->db->get('ref_menu')->result_array();
    $tochild = $lokup[0]['parrent'];

    $idmnu = $this->categoryParentChildTree($id,'','');
    if (count($idmnu) != 0) {
      $listremove = array();
      foreach ($idmnu as $key => $value) {
        $to_update = array();
        if ($value['parrent'] == $id) {
          $to_update['id'] = $value['id_menu'];
          $to_update['parrent'] = $tochild;
          $listremove[] = $to_update;
        }
      }
      $this->db->update_batch('ref_menu',$listremove, 'id');
    }

    $this->db->where('id',$id);
    $this->db->delete('ref_menu');

    echo json_encode(['status' => "okk"]);
  }
}

?>
