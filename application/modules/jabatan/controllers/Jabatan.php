<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 *
 */
class Jabatan extends CI_controller
{

  public function __construct() {
    parent::__construct();
    $this->load->model('M_jabatan', 'jabatan');
    $this->load->model('bagian/M_bagian', 'bagian');
    if($this->session->userdata('username') == "") {
      redirect(base_url(), 'refresh');
    }
  }

  public function admin($value='')
  {
    $data = [
      'title' => 'Data Jabatan',
      'bagian' => $this->bagian->allbagian(),
      'datajabatan' => $this->categoryParentChildTree(),
      'role' => get_role($this->session->userdata('id_level_otorisasi'))
    ];
    $this->template->load('template/index', 'index', $data);
  }

  public function jabatan_kode($value='')
  {
    $kode = codegenerate('m_jabatan','JBT', 'jabatan', 'T');
    echo $kode;
  }

  public function categoryParentChildTree($parent = 0, $spacing = '', $category_tree_array = '') {
		if (!is_array($category_tree_array))
        $category_tree_array = array();
    $this->db->join('m_bagian','m_bagian.id_bagian = m_jabatan.id_bagian');
    $this->db->where('m_jabatan.parent', $parent);
    $query2 = $this->db->get('m_jabatan');
		if ($query2->num_rows() > 0) {
      foreach ($query2->result() as $row) {
        $category_tree_array[] = array("id_jabatan" => $row->id_jabatan,"parent" => $row->parent, "jabatan" => $spacing . $row->jabatan, "bagian" => $row->bagian, "kode_jabatan" => $row->kode_jabatan);
        $category_tree_array = $this->categoryParentChildTree($row->id_jabatan, '&nbsp;&nbsp;&nbsp;&nbsp;'.$spacing . '-&nbsp;', $category_tree_array);
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

    $hasil = $this->jabatan->get_data_alljabatan(0,'','');
    $datax = array();
    $no = 1;
    foreach ($hasil as $key => $value) {
      $this->db->select('count(*) as jml');
      $this->db->where('parent', $value['id_jabatan']);
      $hs = $this->db->get('m_jabatan')->result_array();
      $tbody = array();

      $tbody[] = "<div align='center'>".$no++.".</div>";
      $tbody[] = $value['kode_jabatan'];
      $tbody[] = $hs[0]['jml'] == 0 ?'<em style="color:#555;">'.$value['jabatan'].'</em>':'<strong>'.$value['jabatan'].'</strong>';
      $tbody[] = $value['bagian'];
      if ($permisi[0] == 'true' || $action == '_') {
        $b1 = '<span style="cursor:pointer" class="mr-2 text-primary '.(count($hasil) > 1?'ttip':'').'" data-toggle="tooltip" data-placement="top" title="Ubah" onclick="ubahubah('.$value['id_jabatan'].')">
                <i class="fas fa-pencil-alt fa-lg"></i>
               </span>';
      }
      if ($permisi[1] == 'true' || $action == '_') {
        $b2 = '<span style="cursor:pointer" class="text-danger '.(count($hasil) > 1?'ttip':'').'" data-toggle="tooltip" data-placement="top" title="Hapus" onclick="deletedel('.$value['id_jabatan'].')">
                <i class="far fa-trash-alt fa-lg"></i>
              </span>';
      }
      $tbody[] = $b1.$b2;
      $datax[] = $tbody;
    }
    $output = [
      "draw" => $_POST['draw'],
      "recordsFiltered" => $this->jabatan->countfilterjabatan(),
      "recordsTotal" => count($hasil),
      "data" => $datax
    ];
    echo json_encode($output);
  }

  public function add()
  {
    $data['kode_jabatan'] = $this->input->post('kdjabat');
    $data['jabatan'] = $this->input->post('jabat');
    $data['id_bagian'] = $this->input->post('bagia');
    $data['parent'] = $this->input->post('subja');
    $data['add_time'] = date('Y-m-d H:i:s');
    $data['add_by'] = $this->session->userdata('sesi_id');

    if (cek_duplicate('m_jabatan', 'jabatan', '', '', $this->input->post('jabat')) == 0) {
      $this->db->insert('m_jabatan', $data);
      echo json_encode(['status' => 'sukses']);
    } else {
      echo json_encode(['status' => 'gagal']);
    }

  }

  public function show($id)
  {
    $this->db->where('id_jabatan',$id);
    $data = $this->db->get('m_jabatan')->result();
    echo json_encode($data);
  }

  public function bybagian($id)
  {
    $this->db->where('id_bagian',$id);
    $this->db->order_by("jabatan", "asc");
    $data = $this->db->get('m_jabatan')->result();
    echo json_encode($data);
  }

  public function getbagian($id)
  {
    $this->db->join('m_bagian','m_jabatan.id_bagian = m_bagian.id_bagian');
    $this->db->where('m_jabatan.id_jabatan',$id);
    $this->db->order_by("m_bagian.bagian", "asc");
    $data = $this->db->get('m_jabatan')->result();
    echo json_encode($data);
  }

  public function edit($id)
  {
    $data['jabatan'] = $this->input->post('jabat');
    $data['id_bagian'] = $this->input->post('bagia');
    $data['parent'] = $this->input->post('subja');
    $data['add_time'] = date('Y-m-d H:i:s');
    $data['add_by'] = $this->session->userdata('sesi_id');

    if (cek_duplicate('m_jabatan', 'jabatan', 'id_jabatan', $id, $this->input->post('jabat')) == 0) {
      $this->db->where('id_jabatan', $id);
      $this->db->update('m_jabatan', $data);
      echo json_encode(['status' => 'sukses']);
    } else {
      echo json_encode(['status' => 'gagal']);
    }
  }

  public function remove($id)
  {
    $this->db->where('id_jabatan', $id);
    $lokup = $this->db->get('m_jabatan')->result_array();
    $tochild = $lokup[0]['parent'];

    $idjab = $this->categoryParentChildTree($id,'','');
    if (count($idjab) != 0) {
      $listremove = array();
      foreach ($idjab as $key => $value) {
        $to_update = array();
        if ($value['parent'] == $id) {
          $to_update['id_jabatan'] = $value['id_jabatan'];
          $to_update['parent'] = $tochild;
          $listremove[] = $to_update;
        }
      }
      $this->db->update_batch('m_jabatan',$listremove, 'id_jabatan');
    }

    $this->db->where('id_jabatan',$id);
    $this->db->delete('m_jabatan');

    echo json_encode(['status' => 'sukses']);
  }
}

?>
