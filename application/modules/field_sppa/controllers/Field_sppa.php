<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 *
 */
class Field_sppa extends CI_controller
{

  public function __construct() {
    parent::__construct();
    $this->load->model('M_fieldsppa', 'fieldsppa');
    if($this->session->userdata('username') == "") {
      redirect(base_url(), 'refresh');
    }
  }

  public function index($value='')
  {
    $data = [
      'title' => 'Field SPPA',
      'role' => get_role($this->session->userdata('id_level_otorisasi'))
    ];
    $this->template->load('template/index', 'index', $data);
  }

  public function ajaxdata($action)
  {
    $permisi = explode('_',$action);
    $b1 = ''; $b2 = '';

    $no   = $this->input->post('start');
    $data = $this->fieldsppa->get_data_fieldsppa();

    $datax = array();
    foreach ($data as $key) {
      $tbody = array();

      if ($key['cdb'] == null || $key['cdb'] == 'f') {
        $cdb = "";
      } else {
        $cdb = "<span class='text-success'><i class='ti-check font-weight-bold'></i></span>";
      }

      $no++;
      $tbody[] = "<div align='center'>".$no.".</div>";
      $tbody[] = $key['field_sppa'];
      $tbody[] = $key['data_type'];
      $tbody[] = $cdb;
      if ($permisi[0] == 'true' || $action == '_') {
        $b1 = '<i style="cursor:pointer" class="fas fa-pencil-alt fa-lg text-primary mr-1 ttip" onclick="ubahubah('.$key['id_field_sppa'].')" data-toggle="tooltip" data-placement="top" title="Ubah"></i>&nbsp;';
      }
      if ($permisi[1] == 'true' || $action == '_') {
        $b2 = '<i style="cursor:pointer" class="far fa-trash-alt fa-lg text-danger ttip" onclick="deletedel('.$key['id_field_sppa'].')" data-toggle="tooltip" data-placement="top" title="Hapus"></i>';
      }
      $tbody[] = $b1.$b2;
      $datax[] = $tbody;
    }

    $output = [
      "draw"            => $_POST['draw'],
      "recordsTotal"    => $this->fieldsppa->countalllistfieldsppa(),
      "recordsFiltered" => $this->fieldsppa->countfilterlistfieldsppa(),
      "data"            => $datax
    ];
    echo json_encode($output);
  }

  public function add($value='')
  {
    $nama       = str_replace(' ','_', strtolower($this->input->post('nmfield')));
    $data_type  = $this->input->post('data_type');
    $cdb        = $this->input->post('cdb');

    $a = $this->db->field_exists($nama, 'tr_sppa_quotation');

    if (!$a) {
      $this->db->query("ALTER TABLE tr_sppa_quotation ADD COLUMN $nama $data_type");
    }

    $data['field_sppa'] = $this->input->post('nmfield');
    $data['data_type']  = $data_type;
    $data['cdb']        = $cdb;
    $data['add_time']   = date('Y-m-d');
    $data['add_by']     = $this->session->userdata('sesi_id');
    // $this->db->where([
    //   'LOWER(field_sppa)' => strtolower($this->input->post('nmfield')),
    //   'LOWER(data_type)'  => strtolower($data_type)
    // ]);
    // $cek = $this->db->get('m_field_sppa')->num_rows();

    $inputan = ['LOWER(field_sppa)' => strtolower($this->input->post('nmfield')),
                'data_type'         => $data_type
                ];
      
      $cek = cek_duplicate_banyak('m_field_sppa', '', '', $inputan);

    if ($cek == 0) {
      $this->db->insert('m_field_sppa', $data);
      echo json_encode(['status' => 'sukses']);
    } else {
      echo json_encode(['status' => 'gagal']);
    }
  }

  public function show($id)
  {
    $data = $this->fieldsppa->showbyid($id);
    echo json_encode($data);
  }

  public function edit($id)
  {
    $nama       = str_replace(' ','_', strtolower($this->input->post('nmfield')));
    $data_type  = $this->input->post('data_type');
    $cdb        = $this->input->post('cdb');

    $a = $this->db->field_exists($nama, 'tr_sppa_quotation');

    if (!$a) {
      $this->db->query("ALTER TABLE tr_sppa_quotation ADD COLUMN $nama $data_type");
    }

    $data['field_sppa']   = $this->input->post('nmfield');
    $data['data_type']    = $this->input->post('data_type');
    $data['cdb']          = $cdb;
    $data['add_time']     = date('Y-m-d');
    $data['add_by']       = $this->session->userdata('sesi_id');

    $inputan = ['LOWER(field_sppa)' => strtolower($this->input->post('nmfield')),
                'data_type'         => $data_type
                ];
      
    $cek = cek_duplicate_banyak('m_field_sppa', 'id_field_sppa', $id, $inputan);
    
    // $this->db->where([
    //   'LOWER(field_sppa)' => strtolower($this->input->post('nmfield')),
    //   'LOWER(data_type)'  => strtolower($data_type)
    // ]);
    // $cek = $this->db->get('m_field_sppa')->num_rows();
    if ($cek == 0) {
      $this->db->where('id_field_sppa', $id);
      $this->db->update('m_field_sppa', $data);

      echo json_encode(['status' => 'sukses']);
    } else {
      echo json_encode(['status' => 'gagal']);
    }
  }

  public function listfield()
  {
    $data = $this->fieldsppa->list_fild();
    echo json_encode($data);
  }

  public function remove($id)
  {
    $this->db->where('id_field_sppa', $id);
    $this->db->delete('m_field_sppa');

    echo json_encode(['status' => 'sukses']);
  }
}

?>
