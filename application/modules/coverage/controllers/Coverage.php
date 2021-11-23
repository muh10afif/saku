<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 *
 */
class Coverage extends CI_controller
{
  var $validcfg;

  public function __construct() {
    parent::__construct();
    $this->load->model('M_coverage', 'coverage');
    $this->load->model('cob_lob/M_lob', 'lob');
    $this->load->library('form_validation');
    $this->validcfg = array(
      array('field' => 'labc', 'label' => 'Label Coverage', 'rules' => 'required'),
      array('field' => 'ratc', 'label' => 'Rate Coverage',  'rules' => 'required'),
      array('field' => 'stac', 'label' => 'Status Coverage', 'rules' => 'required')
    );
    if($this->session->userdata('username') == "") {
      redirect(base_url(), 'refresh');
    }
  }

  public function index($value='')
  {
    $data = [
      'title' => 'Coverage',
      'list_lob' => $this->lob->list_lob(),
      'role' => get_role($this->session->userdata('id_level_otorisasi'))
    ];
    $this->template->load('template/index', 'index', $data);
  }

  public function ajaxdata($action)
  {
    $permisi = explode('_',$action);
    $b1 = ''; $b2 = '';

    $id   = $this->input->post('id_lob') != ''?$this->input->post('id_lob'):'';
    $no   = $this->input->post('start');
    $data = $this->coverage->get_data_coverage($id);

    $datax = array();
    foreach ($data as $key) {
      $tbody = array();

      $no++;
      $tbody[] = "<div align='center'>".$no.".</div>";
      $tbody[] = $key['label'];
      $tbody[] = $key['rate'];
      $tbody[] = $key['status'];
      if ($permisi[0] == 'true' || $action == '_') {
        $b1 = '<span style="cursor:pointer" class="mr-2 text-primary '.(count($data) > 1?'ttip':'').'" data-toggle="tooltip" data-placement="top" title="Ubah" onclick="ubahlob('.$key['id_coverage'].')"><i class="fas fa-pencil-alt fa-lg"></i></span>';
      }
      if ($permisi[1] == 'true' || $action == '_') {
        $b2 = '<span style="cursor:pointer" class="text-danger '.(count($data) > 1?'ttip':'').'" data-toggle="tooltip" data-placement="top" title="Hapus" onclick="deletelob('.$key['id_coverage'].')"><i class="far fa-trash-alt fa-lg"></i></span>';
      }
      $tbody[]    = $b1.$b2;
      $datax[] = $tbody;
    }

    $output = [
      "draw"            => $_POST['draw'],
      "recordsTotal"    => $this->coverage->countallcoverage($id),
      "recordsFiltered" => $this->coverage->countfiltercoverage($id),
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
      $data['label'] = $this->input->post('labc');
      $data['rate'] = $this->input->post('ratc');
      $data['status'] = $this->input->post('stac');
      $data['id_lob'] = $this->input->post('lobc');
      $data['add_time'] = date('Y-m-d');
      $data['add_by'] = $this->session->userdata('sesi_id');

      $inputan = ['LOWER(label)'  => strtolower($this->input->post('labc'))
                ];
            
      $cek = cek_duplicate_banyak('coverage', '', '', $inputan);

      if ($cek == 0) {
        $this->db->insert('coverage', $data);
        echo json_encode(['status' => 'Berhasil', 'pesan' => 'Coverage Berhasil di Buat', 'altr' =>'success']);
      } else {
        echo json_encode(['status' => 'Gagal', 'pesan' => 'Coverage Tersebut Telah Ada', 'altr' =>'error']);
      }
    }
  }

  public function show($id)
  {
    $this->db->where('id_coverage',$id);
    $data = $this->db->get('coverage')->result();
    echo json_encode($data);
  }

  public function edit($id)
  {
    $this->form_validation->set_rules($this->validcfg);
    if ($this->form_validation->run() == FALSE) {
      echo json_encode(['status' => 'Gagal', 'pesan' => 'Ada form yang Tidak di isi', 'altr' =>'warning']);
    } else {
      $data['label'] = $this->input->post('labc');
      $data['rate'] = $this->input->post('ratc');
      $data['status'] = $this->input->post('stac');
      $data['id_lob'] = $this->input->post('lobc');
      $data['add_time'] = date('Y-m-d');
      $data['add_by'] = $this->session->userdata('sesi_id');

      $inputan = ['LOWER(label)'  => strtolower($this->input->post('labc'))
                ];
            
      $cek = cek_duplicate_banyak('coverage', 'id_coverage', $id, $inputan);

      if ($cek == 0) {
        $this->db->where('id_coverage', $id);
        $this->db->update('coverage', $data);
        echo json_encode(['status' => 'Berhasil', 'pesan' => 'Coverage Berhasil di Ubah', 'altr' =>'success']);
      } else {
        echo json_encode(['status' => 'Gagal', 'pesan' => 'Coverage Tersebut Telah Ada', 'altr' =>'error']);
      }
    }
  }

  public function remove($id)
  {
    $this->db->where('id_coverage',$id);
		$this->db->delete('coverage');

    echo json_encode(['status' => 'sukses']);
  }
}

?>
