<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 *
 */
class Jenisbank extends CI_controller
{
  var $validcfg;

  public function __construct() {
    parent::__construct();
    $this->load->model('M_jenis_bank', 'jenisbank');
    $this->load->library('form_validation');
    $this->validcfg = array(
      array('field' => 'jenis_bank', 'label' => 'Jenis Bank', 'rules' => 'required'),
    );
    if($this->session->userdata('username') == "") {
      redirect(base_url(), 'refresh');
    }
  }

  public function index($value='')
  {
    $data = [
      'title' => 'Jenis Bank',
      'role' => get_role($this->session->userdata('id_level_otorisasi'))
    ];
    $this->template->load('template/index', 'index', $data);
  }

  public function jenisbank_kode($value='')
  {
    $kode = codegenerate('m_jenis_bank','JBN','jenis_bank','N');
    echo $kode;
  }

  public function ajaxdata($action)
  {
    $permisi = explode('_',$action);
    $b1 = ''; $b2 = '';

    $no   = $this->input->post('start');
    $data = $this->jenisbank->get_data_jenisbank();

    $datax = array();
    foreach ($data as $key) {
      $tbody = array();

      $no++;
      $tbody[] = "<div align='center'>".$no.".</div>";
      $tbody[] = $key['kode_jenis_bank'];
      $tbody[] = $key['jenis_bank'];
      if ($permisi[0] == 'true' || $action == '_') {
        $b1 = '<span style="cursor:pointer" class="mr-2 text-primary '.(count($data) > 1?'ttip':'').'" data-toggle="tooltip" data-placement="top" title="Ubah" onclick="ubahubah('.$key['id_jenis_bank'].')"><i class="fas fa-pencil-alt fa-lg"></i></span>';
      }
      if ($permisi[1] == 'true' || $action == '_') {
        $b2 = '<span style="cursor:pointer" class="text-danger '.(count($data) > 1?'ttip':'').'" data-toggle="tooltip" data-placement="top" title="Hapus" onclick="deletedel('.$key['id_jenis_bank'].')"><i class="far fa-trash-alt fa-lg"></i></span>';
      }
      $tbody[] = $b1.$b2;
      $datax[] = $tbody;
    }

    $output = [
      "draw"            => $_POST['draw'],
      "recordsTotal"    => $this->jenisbank->countalllistcashbank(),
      "recordsFiltered" => $this->jenisbank->countfilterlistcashbank(),
      "data"            => $datax
    ];
    echo json_encode($output);
  }

  public function add()
  {
    $this->form_validation->set_rules($this->validcfg);
    if ($this->form_validation->run() == FALSE) {
      echo json_encode(['status' => 'Gagal', 'pesan' => 'Gagal Insert, Form jenis bank kosong', 'altr' =>'warning']);
    }else{
      $data['kode_jenis_bank'] = $this->input->post('kdjns_bank');
      $data['jenis_bank'] = $this->input->post('jenis_bank');
      $data['add_time'] = date('Y-m-d');
      $data['add_by'] = $this->session->userdata('sesi_id');

      if (cek_duplicate('m_jenis_bank', 'jenis_bank', '', '', $this->input->post('jenis_bank')) == 0) {
        $this->db->insert('m_jenis_bank', $data);
        echo json_encode(['status' => "Berhasil", 'pesan' => 'Berhasil Jenis Bank Telah di Simpan', 'altr' => 'success']);
      } else {
        echo json_encode(['status' => "Gagal", 'pesan' => 'Jenis Bank Tersebut Sudah Ada', 'altr' => 'error']);
      }

    }
  }

  function check_jenis_bank($jenis_bank) {
    if($this->input->post('id_jenis_bank'))
        $id = $this->input->post('id_jenis_bank');
    else
        $id = '';
    $result = $this->jenisbank->check_unique_jenis_bank($id, $jenis_bank);

    if($result == 0)
        $response = true;
    else {
        $this->form_validation->set_message('check_jenis_bank', 'Jenis Bank already exist');
        $response = false;
    }
    return $response;
  }

  public function show($id)
  {
    $this->db->where('id_jenis_bank', $id);
    $data = $this->db->get('m_jenis_bank')->result();
    echo json_encode($data);
  }

  public function edit($id)
  {
    $this->form_validation->set_rules($this->validcfg);
    if ($this->form_validation->run() == FALSE) {
      echo json_encode(['status' => 'Gagal', 'pesan' => 'Gagal Update, Form Jenis bank kosong', 'altr' =>'warning']);
    }else{
      $data['jenis_bank'] = $this->input->post('jenis_bank');
      $data['add_time'] = date('Y-m-d');
      $data['add_by'] = $this->session->userdata('sesi_id');

      if (cek_duplicate('m_jenis_bank', 'jenis_bank', 'id_jenis_bank', $id, $this->input->post('jenis_bank')) == 0) {
        $this->db->where('id_jenis_bank', $id);
        $this->db->update('m_jenis_bank', $data);
        echo json_encode(['status' => "Berhasil", 'pesan' => 'Berhasil Jenis Bank Telah di Update', 'altr' => 'success']);
      } else {
        echo json_encode(['status' => "Gagal", 'pesan' => 'Jenis Bank Tersebut Sudah Ada', 'altr' => 'error']);
      }
      
      
    }
  }

  public function remove($id)
  {
    $this->db->where('id_jenis_bank', $id);
    $this->db->delete('m_jenis_bank');

    echo json_encode(['status' => 'sukses']);
  }
}

?>
