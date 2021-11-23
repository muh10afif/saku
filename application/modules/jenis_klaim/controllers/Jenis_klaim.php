<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 *
 */
class Jenis_klaim extends CI_controller
{

  public function __construct() {
    parent::__construct();
    $this->load->model('M_jenis_klaim', 'jenis_klaim');
    if($this->session->userdata('username') == "") {
      redirect(base_url(), 'refresh');
    }
  }

  public function index($value='')
  {
    $data = [
      'title' => 'Jenis Klaim',
      'role' => get_role($this->session->userdata('id_level_otorisasi'))
    ];
    $this->template->load('template/index', 'index', $data);
  }

  public function ajaxdata($action)
  {
    $permisi = explode('_',$action);
    $b1 = ''; $b2 = '';

    $no   = $this->input->post('start');
    $data = $this->jenis_klaim->get_data_jenis_klaim();

    $datax = array();
    foreach ($data as $key) {
      $tbody = array();

      $no++;
      $tbody[] = "<div align='center'>".$no.".</div>";
      $tbody[] = $key['jenis_klaim'];
      if ($permisi[0] == 'true' || $action == '_') {
        $b1 = '<span style="cursor:pointer" class="mr-2 text-primary '.(count($data) > 1?'ttip':'').'" data-toggle="tooltip" data-placement="top" title="Ubah" onclick="ubahubah('.$key['id_jenis_klaim'].')"><i class="fas fa-pencil-alt fa-lg"></i></span>';
      }
      if ($permisi[1] == 'true' || $action == '_') {
        $b2 = '<span style="cursor:pointer" class="text-danger '.(count($data) > 1?'ttip':'').'" data-toggle="tooltip" data-placement="top" title="Hapus" onclick="deletedel('.$key['id_jenis_klaim'].')"><i class="far fa-trash-alt fa-lg"></i></span>';
      }
      $tbody[] = $b1.$b2;
      $datax[] = $tbody;
    }

    $output = [
      "draw"            => $_POST['draw'],
      "recordsTotal"    => $this->jenis_klaim->countalljenisklaim(),
      "recordsFiltered" => $this->jenis_klaim->countfilterjenisklaim(),
      "data"            => $datax
    ];
    echo json_encode($output);
  }

  public function add()
  {
    $data['jenis_klaim'] = $this->input->post('nmjenisk');
    $data['add_time'] = date('Y-m-d');
    $data['add_by'] = $this->session->userdata('sesi_id');

    $inputan = ['LOWER(jenis_klaim)'  => strtolower($this->input->post('nmjenisk')),
              ];
          
    $cek = cek_duplicate_banyak('m_jenis_klaim', '','', $inputan);

    if ($cek == 0) {
      $this->db->insert('m_jenis_klaim', $data);
      echo json_encode(['status' => 'sukses']);
    } else {
      echo json_encode(['status' => 'gagal']);
    }
  }

  public function show($id)
  {
    $this->db->where('id_jenis_klaim',$id);
    $data = $this->db->get('m_jenis_klaim')->result();
    echo json_encode($data);
  }

  public function edit($id)
  {
    $data['jenis_klaim'] = $this->input->post('nmjenisk');
    $data['add_time'] = date('Y-m-d');
    $data['add_by'] = $this->session->userdata('sesi_id');
    

    $inputan = ['LOWER(jenis_klaim)'  => strtolower($this->input->post('nmjenisk')),
              ];
          
    $cek = cek_duplicate_banyak('m_jenis_klaim', 'id_jenis_klaim',$id, $inputan);

    if ($cek == 0) {
      $this->db->where('id_jenis_klaim', $id);
      $this->db->update('m_jenis_klaim', $data);
      echo json_encode(['status' => 'sukses']);
    } else {
      echo json_encode(['status' => 'gagal']);
    }
  }

  public function remove($id)
  {
    $this->db->where('id_jenis_klaim',$id);
		$this->db->delete('m_jenis_klaim');

    echo json_encode(['status' => 'sukses']);
  }
}

?>
