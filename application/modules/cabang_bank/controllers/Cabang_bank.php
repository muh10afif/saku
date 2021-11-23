<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 *
 */
class Cabang_bank extends CI_controller
{
  var $validcfg;

  public function __construct() {
    parent::__construct();
    $this->load->model('M_cabang_bank', 'cabang_bank');
    $this->load->model('list_bank/M_list_bank', 'list_bank');
    $this->load->library('form_validation');
    $this->validcfg = array(
      array('field' => 'nmcbbank', 'label' => 'Nama Cabang Bank', 'rules' => 'required'),
      array('field' => 'idbank', 'label' => 'Bank', 'rules' => 'required')
    );
    if($this->session->userdata('username') == "") {
      redirect(base_url(), 'refresh');
    }
  }

  public function index($value='')
  {
    $data = [
      'title' => 'Cabang Bank',
      'dbank' => $this->list_bank->all_name_bank(),
      'role' => get_role($this->session->userdata('id_level_otorisasi'))
    ];
    $this->template->load('template/index', 'index', $data);
  }

  public function cabang_kode($value='')
  {
    $kode = codegenerate('m_cabang_bank','CBB','cabang_bank','B');
    echo $kode;
  }

  public function ajaxdata($action)
  {
    $permisi = explode('_',$action);
    $b1 = ''; $b2 = '';

    $no   = $this->input->post('start');
    $data = $this->cabang_bank->get_data_cabangbank();

    $datax = array();
    foreach ($data as $key) {
      $tbody = array();

      $no++;
      $tbody[] = "<div align='center'>".$no.".</div>";
      $tbody[] = $key['kode_cabang_bank'];
      $tbody[] = $key['nama_bank'];
      $tbody[] = $key['nama_cabang_bank'];
      if ($permisi[0] == 'true' || $action == '_') {
        $b1 = '<span style="cursor:pointer" class="mr-2 text-primary '.(count($data) > 1?'ttip':'').'" data-toggle="tooltip" data-placement="top" title="Ubah" onclick="ubahubah('.$key['id_cabang_bank'].')"><i class="fas fa-pencil-alt fa-lg"></i></span>';
      }
      if ($permisi[1] == 'true' || $action == '_') {
        $b2 = '<span style="cursor:pointer" class="text-danger '.(count($data) > 1?'ttip':'').'" data-toggle="tooltip" data-placement="top" title="Hapus" onclick="deletedel('.$key['id_cabang_bank'].')"><i class="far fa-trash-alt fa-lg"></i></span>';
      }
      $tbody[] = $b1.$b2;
      $datax[] = $tbody;
    }

    $output = [
      "draw"            => $_POST['draw'],
      "recordsTotal"    => $this->cabang_bank->countalllistcabangbank(),
      "recordsFiltered" => $this->cabang_bank->countfilterlistcabangbank(),
      "data"            => $datax
    ];
    echo json_encode($output);
  }

  public function add()
  {
    $this->form_validation->set_rules($this->validcfg);
    if ($this->form_validation->run() == FALSE) {
      echo json_encode(['status' => 'Gagal', 'pesan' => 'Ada form yang Tidak di isi', 'altr' =>'warning']);
    } else {
      $data['kode_cabang_bank'] = $this->input->post('kdcb');
      $data['nama_cabang_bank'] = $this->input->post('nmcbbank');
      $data['id_bank'] = $this->input->post('idbank');
      $data['add_time'] = date('Y-m-d H:i:s');
      $data['add_by'] = $this->session->userdata('sesi_id');

      $inputan = ['LOWER(nama_cabang_bank)' => strtolower($this->input->post('nmcbbank')),
                  'id_bank'                 => $this->input->post('idbank')
                ];
      
      $cek = cek_duplicate_banyak('m_cabang_bank', '', '', $inputan);
      
      if ($cek == 0) {
        $this->db->insert('m_cabang_bank', $data);
        echo json_encode(['status' => "Berhasil", 'pesan' => 'Berhasil Menambahkan Cabang Bank', 'altr' => 'success']);
      } else {
        echo json_encode(['status' => "Gagal", 'pesan' => 'data Cabang Bank Telah Tersedia', 'altr' => 'error']);
      }
    }
  }

  public function show($id)
  {
    $data = $this->cabang_bank->showdataby($id);
    echo json_encode($data);
  }

  public function edit($id)
  {
    $this->form_validation->set_rules($this->validcfg);
    if ($this->form_validation->run() == FALSE) {
      echo json_encode(['status' => 'Gagal', 'pesan' => 'Ada form yang Tidak di isi', 'altr' =>'warning']);
    } else {
      $data['nama_cabang_bank'] = $this->input->post('nmcbbank');
      $data['id_bank'] = $this->input->post('idbank');
      $data['add_time'] = date('Y-m-d H:i:s');
      $data['add_by'] = $this->session->userdata('sesi_id');

      $inputan = ['LOWER(nama_cabang_bank)' => strtolower($this->input->post('nmcbbank')),
                  'id_bank'                 => $this->input->post('idbank')
                ];
      
      $cek = cek_duplicate_banyak('m_cabang_bank', 'id_cabang_bank', $id, $inputan);
      
      if ($cek == 0) {
        $this->db->where('id_cabang_bank', $id);
        $this->db->update('m_cabang_bank', $data);
        echo json_encode(['status' => "Berhasil", 'pesan' => 'Berhasil Mengubah Cabang Bank', 'altr' => 'success']);
      } else {
        echo json_encode(['status' => "Gagal", 'pesan' => 'data Cabang Bank Telah Tersedia', 'altr' => 'error']);
      }
      
      
    }
  }

  public function remove($id)
  {
    $this->db->where('id_cabang_bank',$id);
		$this->db->delete('m_cabang_bank');

    echo json_encode(['status' => 'sukses']);
  }
}

?>
