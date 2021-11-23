<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 *
 */
class Role_user extends CI_controller
{
  var $validcfg;

  public function __construct() {
    parent::__construct();
    $this->load->model('M_role_user', 'role_user');
    $this->load->model('jabatan/M_jabatan', 'jabatan');
    $this->load->model('level_otorisasi/M_level_otorisasi', 'otorisasi');
    $this->load->library('form_validation');
    $this->validcfg = array(
      array('field' => 'lvlot', 'label' => 'Level Otorisasi', 'rules' => 'required'),
      array('field' => 'idjbt', 'label' => 'Jabatan', 'rules' => 'required'),
    );
    if($this->session->userdata('username') == "") {
      redirect(base_url(), 'refresh');
    }
  }

  public function admin($value='')
  {
    $data = [
      'title' => 'User Role',
      'jabatan' => $this->jabatan->alljabatann(),
      'otorisa' => $this->otorisasi->alllvloto(),
      'role' => get_role($this->session->userdata('id_level_otorisasi'))
    ];
    $this->template->load('template/index', 'index', $data);
  }

  public function ajaxdata($action)
  {
    $permisi = explode('_',$action);
    $b1 = ''; $b2 = '';

    $no   = $this->input->post('start');
    $data = $this->role_user->get_data_allrole();

    $datax = array();
    foreach ($data as $key) {
      $tbody = array();

      $no++;
      $tbody[] = "<div align='center'>".$no.".</div>";
      $tbody[] = $key['level_otorisasi'];
      $tbody[] = $key['jabatan'];
      if ($permisi[0] == 'true' || $action == '_') {
        $b1 = '<span style="cursor:pointer" class="mr-2 text-primary '.(count($data) > 1?'ttip':'').'" data-toggle="tooltip" data-placement="top" title="Ubah" onclick="ubahubah('.$key['id_role'].')"><i class="fas fa-pencil-alt fa-lg"></i></span>';
      }
      if ($permisi[1] == 'true' || $action == '_') {
        $b2 = '<span style="cursor:pointer" class="text-danger '.(count($data) > 1?'ttip':'').'" data-toggle="tooltip" data-placement="top" title="Hapus" onclick="deletedel('.$key['id_role'].')"><i class="far fa-trash-alt fa-lg"></i></span>';
      }
      $tbody[] = $b1.$b2;
      $datax[] = $tbody;
    }

    $output = [
      "draw"            => $_POST['draw'],
      "recordsTotal"    => $this->role_user->countallrole(),
      "recordsFiltered" => $this->role_user->countfilterrole(),
      "data"            => $datax
    ];
    echo json_encode($output);
  }

  
  public function add()
  {
    $this->form_validation->set_rules($this->validcfg);
    if ($this->form_validation->run() == FALSE) {
      echo json_encode(['status' => 'Gagal', 'pesan' => 'Gagal Insert, Ada Form yang kosong', 'altr' =>'warning']);
    } else {
      $data['id_level_otorisasi'] = $this->input->post('lvlot');
      $data['id_jabatan'] = $this->input->post('idjbt');
      $data['add_time'] = date('Y-m-d');
      $data['add_by'] = $this->session->userdata('sesi_id');

      $nm = $this->input->post('idjbt');

      $inputan = [  'id_level_otorisasi' => $this->input->post('lvlot'),
                    'id_jabatan' => $this->input->post('idjbt')
                ];

      $return = cek_duplicate_banyak('role', '', '', $inputan);

      if ($return == 0) {
        $this->db->insert('role', $data);
        echo json_encode(['status' => "Berhasil", 'pesan' => 'Berhasil User Role Telah di Simpan', 'altr' => 'success']);
      } else {
        echo json_encode(['status' => "Gagal", 'pesan' => 'Data User Role Tersebut Sudah Ada', 'altr' => 'error']);
      }

    }
  }


  public function edit($id)
  {
    $this->form_validation->set_rules($this->validcfg);
    if ($this->form_validation->run() == FALSE) {
      echo json_encode(['status' => 'Gagal', 'pesan' => 'Gagal Update, Ada Form yang kosong', 'altr' =>'warning']);
    } else {
      $data['id_level_otorisasi'] = $this->input->post('lvlot');
      $data['id_jabatan'] = $this->input->post('idjbt');
      $data['add_time'] = date('Y-m-d');
      $data['add_by'] = $this->session->userdata('sesi_id');

      $nm = $this->input->post('idjbt');

      $cr = $this->db->get_where('role', ['id_role' => $id])->row_array();

      $inputan = [  'id_jabatan'          => $this->input->post('idjbt'),
                    'id_level_otorisasi'  => $this->input->post('lvlot')
                  ];

      // $return = cek_duplicate('role', 'id_role', $dt_c, $dt_u, '');
      $return = cek_duplicate_banyak('role', 'id_role', $id, $inputan);

      if ($return == 0) {
        $this->db->where('id_role', $id);
        $this->db->update('role', $data);
        echo json_encode(['status' => "Berhasil", 'pesan' => 'Berhasil User Role Telah di Update', 'altr' => 'success']);
      } else {
        echo json_encode(['status' => "Gagal", 'pesan' => 'Data User Role Tersebut Sudah Ada', 'altr' => 'error']);
      }
      
    }
  }

  public function show($id)
  {
    $this->db->where('id_role',$id);
    $data = $this->db->get('role')->result();
    echo json_encode($data);
  }

  
  public function remove($id)
  {
    $this->db->where('id_role',$id);
		$this->db->delete('role');

    echo json_encode(['status' => 'sukses']);
  }
}

?>
