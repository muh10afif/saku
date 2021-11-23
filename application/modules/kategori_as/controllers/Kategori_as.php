<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 *
 */
class Kategori_as extends CI_controller
{

  public function __construct() {
    parent::__construct();
    $this->load->model('M_kategori_as', 'kategori_as');
    if($this->session->userdata('username') == "") {
      redirect(base_url(), 'refresh');
    }
  }

  public function index($value='')
  {
    $data = [
      'title' => 'Kategori Asuransi',
      'role' => get_role($this->session->userdata('id_level_otorisasi'))
    ];
    $this->template->load('template/index', 'index', $data);
  }

  public function ajaxdata($action)
  {
    $permisi = explode('_',$action);
    $b1 = ''; $b2 = '';

    $no   = $this->input->post('start');
    $data = $this->kategori_as->get_data_kategori_as();

    $datax = array();
    foreach ($data as $key) {
      $tbody = array();

      $no++;
      $tbody[] = "<div align='center'>".$no.".</div>";
      $tbody[] = $key['kategori_as'];
      if ($permisi[0] == 'true' || $action == '_') {
        $b1 = '<span style="cursor:pointer" class="mr-2 text-primary '.(count($data) > 1?'ttip':'').'" data-toggle="tooltip" data-placement="top" title="Ubah" onclick="ubahubah('.$key['id_kategori_as'].')"><i class="fas fa-pencil-alt fa-lg"></i></span>';
      }
      if ($permisi[1] == 'true' || $action == '_') {
        $b2 = '<span style="cursor:pointer" class="text-danger '.(count($data) > 1?'ttip':'').'" data-toggle="tooltip" data-placement="top" title="Hapus" onclick="deletedel('.$key['id_kategori_as'].')"><i class="far fa-trash-alt fa-lg"></i></span>';
      }
      $tbody[] = $b1.$b2;
      $datax[] = $tbody;
    }

    $output = [
      "draw"            => $_POST['draw'],
      "recordsTotal"    => $this->kategori_as->countallkategorias(),
      "recordsFiltered" => $this->kategori_as->countfilterkategorias(),
      "data"            => $datax
    ];
    echo json_encode($output);
  }

  public function add()
  {
    $data['kategori_as'] = $this->input->post('nmtipeks');
    $data['add_time'] = date('Y-m-d');
    $data['add_by'] = $this->session->userdata('sesi_id');
    if (cek_duplicate('m_kategori_as', 'kategori_as', '', '', $this->input->post('nmtipeks')) == 0) {
      $this->db->insert('m_kategori_as', $data);
      echo json_encode(['status' => 'sukses']);
    } else {
      echo json_encode(['status' => 'gagal']);
    }
  }

  public function show($id)
  {
    $this->db->where('id_kategori_as',$id);
    $data = $this->db->get('m_kategori_as')->result();
    echo json_encode($data);
  }

  public function edit($id)
  {
    $data['kategori_as'] = $this->input->post('nmtipeks');
    $data['add_time'] = date('Y-m-d');
    $data['add_by'] = $this->session->userdata('sesi_id');
    
    if (cek_duplicate('m_kategori_as', 'kategori_as', 'id_kategori_as', $id, $this->input->post('nmtipeks')) == 0) {
      $this->db->where('id_kategori_as', $id);
      $this->db->update('m_kategori_as', $data);
      echo json_encode(['status' => 'sukses']);
    } else {
      echo json_encode(['status' => 'gagal']);
    }
  }

  public function remove($id)
  {
    $this->db->where('id_kategori_as',$id);
		$this->db->delete('m_kategori_as');

    echo json_encode(['status' => 'sukses']);
  }
}

?>
