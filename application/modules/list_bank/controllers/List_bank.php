<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 *
 */
class List_bank extends CI_controller
{
  var $validcfg;
  var $role;

  public function __construct() {
    parent::__construct();
    $this->load->model('M_list_bank', 'list_bank');
    $this->load->model('jenisbank/M_jenis_bank', 'me');
    $this->load->library('form_validation');
    $this->role = get_role($this->session->userdata('id_level_otorisasi'));
    $this->validcfg = array(
      array('field' => 'nmbank', 'label' => 'Nama Bank', 'rules' => 'required'),
      array('field' => 'idjnsbnk', 'label' => 'Jenis Bank', 'rules' => 'required'),
    );
    if($this->session->userdata('username') == "") {
      redirect(base_url(), 'refresh');
    }
  }

  public function index($value='')
  {
    $data = [
      'title' => 'List Bank',
      'list_jenis_bank' => $this->me->listjenisbank(),
      'role' => $this->role
    ];
    $this->template->load('template/index', 'index', $data);
  }

  public function bank_kode($value='')
  {
    $kode = codegenerate('m_bank','BNK','bank','K');
    echo $kode;
  }

  public function ajaxdata($action)
  {
    /*
      array rulenya
      0 = update
      1 = delete
      2 = detail atau approve atau custom
    */
    $permisi = explode('_',$action);
    $b1 = ''; $b2 = '';

    $no   = $this->input->post('start');
    $data = $this->list_bank->get_data_listbank();

    $datax = array();
    foreach ($data as $key) {
      $tbody = array();

      $no++;
      $tbody[] = "<div align='center'>".$no.".</div>";
      $tbody[] = $key['kode_bank'];
      $tbody[] = $key['nama_bank'];
      $tbody[] = $key['jenis_bank'];
      if ($permisi[0] == 'true' || $action == '_') {
        $b1 = '<span style="cursor:pointer" class="mr-2 text-primary '.(count($data) > 1?'ttip':'').'" data-toggle="tooltip" data-placement="top" title="Ubah" onclick="ubahubah('.$key['id_bank'].')"><i class="fas fa-pencil-alt fa-lg"></i></span>';
      }
      if ($permisi[1] == 'true' || $action == '_') {
        $b2 = '<span style="cursor:pointer" class="text-danger '.(count($data) > 1?'ttip':'').'" data-toggle="tooltip" data-placement="top" title="Hapus" onclick="deletedel('.$key['id_bank'].')"><i class="far fa-trash-alt fa-lg"></i></span>';
      }
      $tbody[] = $b1.$b2;
      $datax[] = $tbody;
    }

    $output = [
      "draw"            => $_POST['draw'],
      "recordsTotal"    => $this->list_bank->countalllistbank(),
      "recordsFiltered" => $this->list_bank->countfilterlistbank(),
      "data"            => $datax
    ];
    echo json_encode($output);
  }

  public function tes()
  {
    $dt_c = [ 'nama_bank !='  => 'BCA',
              'id_jenis_bank' => 3
            ];

    $cek = $this->db->get_where('m_bank', $dt_c)->result_array();

    foreach ($cek as $c) {
      # code...
    }

    $a = is_array($dt_c);
    $b = is_array('xxxxx');
    // echo "a is " . ($a) ? 'bukan' : 'array' . "<br>";

    // echo is_array($dt_c); 
    // echo "<br>";
    // echo ($b) ? 'ada' : 'tidak'; 
    // echo "<br>";
    // echo "<pre>";
    // print_r($cek);
    // echo "</pre>";
  }

  public function add()
  {
    $this->form_validation->set_rules($this->validcfg);
    if ($this->form_validation->run() == FALSE) {
      echo json_encode(['status' => 'Gagal', 'pesan' => 'Gagal Insert, Ada Form yang kosong', 'altr' =>'warning']);
    } else {
      $data['kode_bank'] = $this->input->post('kode_bank');
      $data['nama_bank'] = $this->input->post('nmbank');
      $data['id_jenis_bank'] = $this->input->post('idjnsbnk');
      $data['add_time'] = date('Y-m-d');
      $data['add_by'] = $this->session->userdata('sesi_id');

      $nm = $this->input->post('nmbank');

      // $dt_c = [ 'nama_bank !='  => $nm,
      //           'id_jenis_bank' => $this->input->post('idjnsbnk')
      //         ];


      $inputan = ['LOWER(nama_bank)' => strtolower($this->input->post('nmbank')),
                  'id_jenis_bank'    => $this->input->post('idjnsbnk')
                ];
      
      $cek = cek_duplicate_banyak('m_bank', '', '', $inputan);

      // $list = $this->db->get_where('m_bank', $dt_c)->result_array();

      // print_r($list);
      // exit();
  
      // $return = 0;
      // foreach ($list as $s) {
      //   if (trim(strtolower($s['nama_bank'])," ") == trim(strtolower($this->input->post('nmbank'))," ")) {
      //     $return = 1;
      //   }
      // }

      // print_r($return);
      // exit();
      
      if ($cek == 0) {
        $this->db->insert('m_bank', $data);
        echo json_encode(['status' => "Berhasil", 'pesan' => 'Berhasil Bank Telah di Simpan', 'altr' => 'success']);
      } else {
        echo json_encode(['status' => "Gagal", 'pesan' => 'Data Bank Tersebut Sudah Ada', 'altr' => 'error']);
      }

    }
  }

  public function show($id)
  {
    $this->db->where('id_bank',$id);
    $data = $this->db->get('m_bank')->result();
    echo json_encode($data);
  }

  public function edit($id)
  {
    $this->form_validation->set_rules($this->validcfg);
    if ($this->form_validation->run() == FALSE) {
      echo json_encode(['status' => 'Gagal', 'pesan' => 'Gagal Update, Ada Form yang kosong', 'altr' =>'warning']);
    } else {
      $data['nama_bank'] = $this->input->post('nmbank');
      $data['add_time'] = date('Y-m-d');
      $data['add_by'] = $this->session->userdata('sesi_id');

      $nm = $this->input->post('nmbank');

      $cr = $this->db->get_where('m_bank', ['id_bank' => $id])->row_array();

      $inputan = ['LOWER(nama_bank)' => strtolower($this->input->post('nmbank')),
                  'id_jenis_bank'    => $this->input->post('idjnsbnk')
                ];
      
      $cek = cek_duplicate_banyak('m_bank', 'id_bank', $id, $inputan);

      if ($cek == 0) {
        $this->db->where('id_bank', $id);
        $this->db->update('m_bank', $data);
        echo json_encode(['status' => "Berhasil", 'pesan' => 'Berhasil Bank Telah di Update', 'altr' => 'success']);
      } else {
        echo json_encode(['status' => "Gagal", 'pesan' => 'Data Bank Tersebut Sudah Ada', 'altr' => 'error']);
      }
      
      
      // if (duplicatecek('m_bank', $data) == 0) {
      // } else {
      //   echo json_encode(['status' => "Gagal", 'pesan' => 'Data Bank Tersebut Sudah Ada', 'altr' => 'error']);
      // }
    }
  }

  public function remove($id)
  {
    $this->db->where('id_bank',$id);
		$this->db->delete('m_bank');

    echo json_encode(['status' => 'sukses']);
  }
}

?>
