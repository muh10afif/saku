<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 *
 */
class Bagian extends CI_controller
{

  public function __construct() {
    parent::__construct();
    $this->load->model('M_bagian', 'bagian');
    if($this->session->userdata('username') == "") {
      redirect(base_url(), 'refresh');
    }
  }

  public function admin($value='')
  {
    $data = [
      'title' => 'Data Bagian',
      'role' => get_role($this->session->userdata('id_level_otorisasi'))
    ];
    $this->template->load('template/index', 'index', $data);
  }

  public function bagian_kode($value='')
  {
    $kode = codegenerate('m_bagian','BAG','bagian','G');
    echo $kode;
  }

  public function ajaxdata($action)
  {
    $permisi = explode('_',$action);
    $b1 = ''; $b2 = '';

    $no   = $this->input->post('start');
    $data = $this->bagian->get_data_allbagian();

    $datax = array();
    foreach ($data as $key) {
      $tbody = array();

      $no++;
      $tbody[] = "<div align='center'>".$no.".</div>";
      $tbody[] = $key['kode_bagian'];
      $tbody[] = $key['bagian'];
      if ($permisi[0] == 'true' || $action == '_') {
        $b1 = '<span style="cursor:pointer" class="mr-2 text-primary '.(count($data) > 1?'ttip':'').'" data-toggle="tooltip" data-placement="top" title="Ubah" onclick="ubahubah('.$key['id_bagian'].')">
                <i class="fas fa-pencil-alt fa-lg"></i>
               </span>';
      }
      if ($permisi[1] == 'true' || $action == '_') {
        $b2 = '<span style="cursor:pointer" class="text-danger '.(count($data) > 1?'ttip':'').'" data-toggle="tooltip" data-placement="top" title="Hapus" onclick="deletedel('.$key['id_bagian'].')">
                <i class="far fa-trash-alt fa-lg"></i>
               </span>';
      }
      $tbody[] = $b1.$b2;
      $datax[] = $tbody;
    }

    $output = [
      "draw"            => $_POST['draw'],
      "recordsTotal"    => $this->bagian->countallbagian(),
      "recordsFiltered" => $this->bagian->countfilterbagian(),
      "data"            => $datax
    ];
    echo json_encode($output);
  }

  public function add()
  {
    $data['kode_bagian'] = $this->input->post('kode');
    $data['bagian'] = $this->input->post('bagi');
    $data['add_time'] = date('Y-m-d H:i:s');
    $data['add_by'] = $this->session->userdata('sesi_id');
    // if (duplicatecek('m_bagian', $data) == 0) {
    if (cek_duplicate('m_bagian', 'bagian', '', '', $this->input->post('bagi')) == 0) {
      $this->db->insert('m_bagian', $data);
      echo json_encode(['status' => 'sukses']);
    } else {
      echo json_encode(['status' => 'gagal']);
    }
  }

  public function show($id)
  {
    $this->db->where('id_bagian',$id);
    $data = $this->db->get('m_bagian')->result();
    echo json_encode($data);
  }

  public function edit($id)
  {
    $data['bagian'] = $this->input->post('bagi');
    $data['add_time'] = date('Y-m-d H:i:s');
    $data['add_by'] = $this->session->userdata('sesi_id');
    
    if (cek_duplicate('m_bagian', 'bagian', 'id_bagian', $id, $this->input->post('bagi')) == 0) {
      $this->db->where('id_bagian', $id);
      $this->db->update('m_bagian', $data);
      echo json_encode(['status' => 'sukses']);
    } else {
      echo json_encode(['status' => 'gagal']);
    }
  }

  public function remove($id)
  {
    $this->db->where('id_bagian',$id);
		$this->db->delete('m_bagian');

    echo json_encode(['status' => 'sukses']);
  }
}

?>
