<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 *
 */
class Wilayah extends CI_controller
{
  var $validcfg;

  public function __construct() {
    parent::__construct();
    $this->load->model('M_wilayah', 'wilayah');
    $this->load->library('form_validation');
    $this->validcfg = array(
      array('field' => 'nmwil', 'label' => 'Nama Wilayah', 'rules' => 'required'),
      array('field' => 'lvwil', 'label' => 'Level Wilayah', 'rules' => 'required')
    );
    if($this->session->userdata('username') == "") {
      redirect(base_url(), 'refresh');
    }
  }

  public function index($value='')
  {
    $data = [
      'title' => 'Master Wilayah',
      'listparnt' => $this->categoryParentChildTree(),
      'role' => get_role($this->session->userdata('id_level_otorisasi'))
    ];
    $this->template->load('template/index', 'index', $data);
  }

  public function categoryParentChildTree($parent = 0, $spacing = '', $category_tree_array = '') {
		if (!is_array($category_tree_array)) { $category_tree_array = array(); }
    $this->db->where('parent', $parent);
    $query2 = $this->db->get('m_wilayah');
		if ($query2->num_rows() > 0) {
      foreach ($query2->result() as $row) {
        $category_tree_array[] = array("id_wilayah" => $row->id_wilayah, "parent" => $row->parent, "nama" => $spacing.$row->nama, "kode_wilayah" => $row->kode_wilayah);
        $category_tree_array = $this->categoryParentChildTree($row->id_wilayah, '&nbsp;&nbsp;&nbsp;&nbsp;'.$spacing.'-&nbsp;', $category_tree_array);
      }
    }
    return $category_tree_array;
  }

  public function listisidata()
  {
    echo json_encode($this->categoryParentChildTree());
  }

  public function ajaxdata($action)
  {
    $permisi = explode('_',$action);
    $b1 = ''; $b2 = '';

    $wilyah = $this->wilayah->get_data_allwilayah(0,'','');

    $no = 1;
    $datax = array();
    foreach ($wilyah as $key => $value) {
      $this->db->select('count(*) as jml');
      $this->db->where(['parent' => $value['id_wilayah']]);
      $hs = $this->db->get('m_wilayah')->result_array();
      $tbody = array();

      $tbody[] = "<div align='center'>".$no++.".</div>";
      $tbody[] = $value['kode_wilayah'];
      $tbody[] = $hs[0]['jml'] == 0 ?'<em style="color:#555;">'.$value['nama'].'</em>':'<strong>'.$value['nama'].'</strong>';
      if ($permisi[0] == 'true' || $action == '_') {
        $b1 = '<i style="cursor:pointer" class="fas fa-pencil-alt fa-lg text-primary mr-2 '.(count($datax) > 1?'ttip':'').'" data-toggle="tooltip" data-placement="top" title="Ubah" style="cursor: pointer;" onclick="ubahubah('.$value['id_wilayah'].')"></i>&nbsp;';
      }
      if ($permisi[1] == 'true' || $action == '_') {
        $b2 = '<i style="cursor:pointer" class="far fa-trash-alt fa-lg text-danger '.(count($datax) > 1?'ttip':'').'" data-toggle="tooltip" data-placement="top" title="Hapus" style="cursor: pointer;" onclick="deletedel('.$value['id_wilayah'].')"></i>';
      }
      $tbody[] = $b1.$b2;
      $datax[] = $tbody;
    }
    $output = [
      "draw" => $_POST['draw'],
      "recordsTotal" => count($wilyah),
      "data" => $datax
    ];
    echo json_encode($output);
  }

  public function wilayah_kode($value='')
  {
    $kode = codegenerate('m_wilayah','WIL', 'wilayah', 'L');
    echo $kode;
  }

  public function add()
  {
    $this->form_validation->set_rules($this->validcfg);
    if ($this->form_validation->run() == FALSE) {
      echo json_encode(['judul' => 'Gagal', 'pesan' => 'Gagal Insert, Ada Form yang kosong', 'altr' =>'warning']);
    } else {
      $data['kode_wilayah'] = $this->input->post('kdwil');
      $prn = ($this->input->post('subwil') == '-- Pilih --') ? 0 : $this->input->post('subwil');
      $data['parent']       = $prn;
      $data['level']        = $this->input->post('lvwil');
      $data['nama']         = $this->input->post('nmwil');
      $data['add_time']     = date('Y-m-d H:i:s');
      $data['add_by']       = $this->session->userdata('sesi_id');

      $inputan = ['parent'      => $prn,
                  'LOWER(nama)' => strtolower($this->input->post('nmwil'))
                  ];
      
      $cek = cek_duplicate_banyak('m_wilayah', '', '', $inputan);
      
      if ($cek == 0) {
        $datax = $this->db->insert('m_wilayah', $data);
        echo json_encode(['judul' => 'Berhasil', 'pesan' => 'Berhasil Menambahkan Data Wilayah', 'altr' =>'success']);
      } else {
        echo json_encode(['judul' => 'Gagal', 'pesan' => 'Data Wilayah Tersebut Sudah Ada', 'altr' =>'error']);
      }
    }
  }

  public function show($id)
  {
    $this->db->where('id_wilayah', $id);
    $data = $this->db->get('m_wilayah')->result();
    echo json_encode($data);
  }

  public function edit($id)
  {
    $this->form_validation->set_rules($this->validcfg);
    if ($this->form_validation->run() == FALSE) {
      echo json_encode(['judul' => 'Gagal', 'pesan' => 'Gagal Update, Ada Form yang kosong', 'altr' =>'warning']);
    } else {
      $prn = ($this->input->post('subwil') == '-- Pilih --') ? 0 : $this->input->post('subwil');
      $data['parent']       = $prn;
      $data['level']        = $this->input->post('lvwil');
      $data['nama']         = $this->input->post('nmwil');
      $data['add_time']     = date('Y-m-d H:i:s');
      $data['add_by']       = $this->session->userdata('sesi_id');

      $inputan = ['parent'      => $prn,
                  'LOWER(nama)' => strtolower($this->input->post('nmwil'))
                  ];
      
      $cek = cek_duplicate_banyak('m_wilayah', 'id_wilayah', $id, $inputan);
     
      if ($cek == 0) {
        $this->db->where('id_wilayah', $id);
        $this->db->update('m_wilayah', $data);
        echo json_encode(['judul' => 'Berhasil', 'pesan' => 'Berhasil Mengubah Data Wilayah', 'altr' =>'success']);
      } else {
        echo json_encode(['judul' => 'Gagal', 'pesan' => 'Data Wilayah Tersebut Sudah Ada', 'altr' =>'error']);
      }
    }
  }

  public function remove($id)
  {
    $this->db->where('id_wilayah', $id);
    $lokup = $this->db->get('m_wilayah')->result_array();
    $tochild = $lokup[0]['parent'];

    $idwil = $this->categoryParentChildTree($id,'','');
    if (count($idwil) != 0) {
      $listremove = array();
      foreach ($idwil as $key => $value) {
        $to_update = array();
        if ($value['parent'] == $id) {          
          $to_update['id_wilayah'] = $value['id_wilayah'];
          $to_update['parent'] = $tochild;
          $listremove[] = $to_update;
        }
      }
      $this->db->update_batch('m_wilayah',$listremove, 'id_wilayah');
    }

    $this->db->where('id_wilayah',$id);
		$this->db->delete('m_wilayah');

    echo json_encode(['status' => 'sukses']);
  }
}

?>
