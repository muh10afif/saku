<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * create by : me
 */
class Level_otorisasi extends CI_controller
{
  var $validcfg;

  public function __construct() {
    parent::__construct();
    $this->load->model('M_level_otorisasi', 'level_otorisasi');
    $this->load->model('level_user/M_level_user', 'level_user');
    $this->load->library('form_validation');
    $this->validcfg = array(
      array('field' => 'lvloto', 'label' => 'Nama Level Otorisasi', 'rules' => 'required'),
      array('field' => 'lvlusr', 'label' => 'Level User', 'rules' => 'required'),
    );
    if($this->session->userdata('username') == "") {
      redirect(base_url(), 'refresh');
    }
  }

  public function admin()
  {
    $data = [
      'title' => 'Data Level Otorisasi',
      'lvuser' => $this->level_user->alllvlusr(),
      'role' => get_role($this->session->userdata('id_level_otorisasi'))
    ];
    $this->template->load('template/index', 'index', $data);
  }

  public function ajaxdata($action)
  {
    $permisi = explode('_',$action);
    $b1 = ''; $b2 = ''; $b3 = '';

    $no   = $this->input->post('start');
    $data = $this->level_otorisasi->get_data_alllvloto();

    $datax = array();
    foreach ($data as $key) {
      $tbody = array();

      $no++;
      $tbody[] = "<div align='center'>".$no.".</div>";
      $tbody[] = $key['level_otorisasi'];
      $tbody[] = $key['level_user'];
      if ($permisi[2] == 'true' || $action == '__') {
        $b3 = '<span style="cursor:pointer" class="text-success '.(count($data) > 1?'ttip':'').'" data-toggle="tooltip" data-placement="top" title="Privilage" onclick="todetail('.$key['id_level_otorisasi'].')">
                <i class="fas fa-clipboard-list fa-lg"></i>
               </span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
      }
      if ($permisi[0] == 'true' || $action == '__') {
        $b1 = '<span style="cursor:pointer" class="mr-2 text-primary '.(count($data) > 1?'ttip':'').'" data-toggle="tooltip" data-placement="top" title="Ubah" onclick="ubahubah('.$key['id_level_otorisasi'].')">
                <i class="fas fa-pencil-alt fa-lg"></i>
               </span>&nbsp;';
      }
      if ($permisi[1] == 'true' || $action == '__') {
        $b2 = '<span style="cursor:pointer" class="text-danger '.(count($data) > 1?'ttip':'').'" data-toggle="tooltip" data-placement="top" title="Hapus" onclick="deletedel('.$key['id_level_otorisasi'].')">
                <i class="far fa-trash-alt fa-lg"></i>
               </span>';
      }
      $tbody[] = $b3.$b1.$b2;
      $datax[] = $tbody;
    }

    $output = [
      "draw"            => $_POST['draw'],
      "recordsTotal"    => $this->level_otorisasi->countalllvloto(),
      "recordsFiltered" => $this->level_otorisasi->countfilterlvloto(),
      "data"            => $datax
    ];
    echo json_encode($output);
  }

  public function add()
  {
    $this->form_validation->set_rules($this->validcfg);
    if ($this->form_validation->run() == FALSE) {
      echo json_encode([
        'judul' => 'Gagal',
        'status' => 'Data Level Otorisasi Gagal di Tambahkan, Ada Form yang kosong',
        'tipe' => 'warning'
      ]);
    } else {
      $data['level_otorisasi'] = $this->input->post('lvloto');
      $data['id_level_user'] = $this->input->post('lvlusr');
      $data['add_time'] = date('Y-m-d');
      $data['add_by'] = $this->session->userdata('sesi_id');

      $inputan = ['LOWER(level_otorisasi)'  => strtolower($this->input->post('lvloto')),
                  // 'id_level_user'           => $this->input->post('lvlusr')
                  ];
      
      $cek = cek_duplicate_banyak('level_otorisasi', '', '', $inputan);

      if ($cek == 0) {
        $this->db->insert('level_otorisasi', $data);
        echo json_encode([
          'judul' => 'Berhasil',
          'status' => 'Data Level Otorisasi Berhasil di Tambahkan',
          'tipe' => 'success'
        ]);
      } else {
        echo json_encode([
          'judul' => 'Gagal',
          'status' => 'Data Level Otorisasi Tersebut Sudah Ada',
          'tipe' => 'error'
        ]);
      }
    }
  }

  public function show($id)
  {
    $this->db->where('id_level_otorisasi',$id);
    $data = $this->db->get('level_otorisasi')->result();
    echo json_encode($data);
  }

  public function edit($id)
  {
    $this->form_validation->set_rules($this->validcfg);
    if ($this->form_validation->run() == FALSE) {
      echo json_encode([
        'judul' => 'Gagal',
        'status' => 'Data Level Otorisasi Gagal di Update, Ada Form yang kosong',
        'tipe' => 'warning'
      ]);
    } else {
      $data['level_otorisasi'] = $this->input->post('lvloto');
      $data['id_level_user'] = $this->input->post('lvlusr');
      $data['add_time'] = date('Y-m-d');
      $data['add_by'] = $this->session->userdata('sesi_id');

      $inputan = ['LOWER(level_otorisasi)'  => strtolower($this->input->post('lvloto')),
                  // 'id_level_user'           => $this->input->post('lvlusr')
                  ];
      
      $cek = cek_duplicate_banyak('level_otorisasi', 'id_level_otorisasi', $id, $inputan);

      if ($cek == 0) {
        $this->db->where('id_level_otorisasi', $id);
        $this->db->update('level_otorisasi', $data);

        echo json_encode([
          'judul' => 'Berhasil',
          'status' => 'Data Level Otorisasi Berhasil di Update',
          'tipe' => 'success'
        ]);
        
      } else {
        
        echo json_encode([
              'judul' => 'Gagal',
              'status' => 'Data Level Otorisasi Tersebut Sudah Ada',
              'tipe' => 'error'
            ]);
        
      }
    }
  }

  public function remove($id)
  {
    $this->db->where('id_level_otorisasi',$id);
		$this->db->delete('level_otorisasi');

    $this->db->where('id_level_otorisasi',$id);
    $this->db->delete('privilage');

    echo json_encode(['status' => 'sukses']);
  }
}

?>
