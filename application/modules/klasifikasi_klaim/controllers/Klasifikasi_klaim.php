<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 *
 */
class Klasifikasi_klaim extends CI_controller
{
  var $validcfg;

  public function __construct() {
    parent::__construct();
    $this->load->model('M_klasifikasi_klaim', 'klasifikasi_klaim');
    $this->load->library('form_validation');
    $this->validcfg = array(
      array('field' => 'nmklasik', 'label' => 'Klasifikasi Klaim', 'rules' => 'required'),
  );
    if($this->session->userdata('username') == "") {
      redirect(base_url(), 'refresh');
    }
  }

  public function index($value='')
  {
    $data = [
      'title' => 'Klasifikasi Klaim',
      'role' => get_role($this->session->userdata('id_level_otorisasi'))
    ];
    $this->template->load('template/index', 'index', $data);
  }

  public function ajaxdata($action)
  {
    $permisi = explode('_',$action);
    $b1 = ''; $b2 = '';

    $no   = $this->input->post('start');
    $data = $this->klasifikasi_klaim->get_data_klasifikasi_klaim();

    $datax = array();
    foreach ($data as $key) {
      $tbody = array();

      $no++;
      $tbody[] = "<div align='center'>".$no.".</div>";
      $tbody[] = $key['klasifikasi_klaim'];
      if ($permisi[0] == 'true' || $action == '_') {
        $b1 = '<span style="cursor:pointer" class="mr-2 text-primary '.(count($data) > 1?'ttip':'').'" data-toggle="tooltip" data-placement="top" title="Ubah" onclick="ubahubah('.$key['id_klasifikasi_klaim'].')"><i class="fas fa-pencil-alt fa-lg"></i></span>';
      }
      if ($permisi[1] == 'true' || $action == '_') {
        $b2 = '<span style="cursor:pointer" class="text-danger '.(count($data) > 1?'ttip':'').'" data-toggle="tooltip" data-placement="top" title="Hapus" onclick="deletedel('.$key['id_klasifikasi_klaim'].')"><i class="far fa-trash-alt fa-lg"></i></span>';
      }
      $tbody[] = $b1.$b2;
      $datax[] = $tbody;
    }

    $output = [
      "draw"            => $_POST['draw'],
      "recordsTotal"    => $this->klasifikasi_klaim->countallklasiklaim(),
      "recordsFiltered" => $this->klasifikasi_klaim->countfilterklasiklaim(),
      "data"            => $datax
    ];
    echo json_encode($output);
  }


  public function add()
  {
          $this->form_validation->set_rules($this->validcfg);
          if ($this->form_validation->run() == FALSE) {
          echo json_encode(['status' => 'Gagal', 'pesan' => 'Gagal Insert, Form Klasifikasi Klaim Kosong', 'altr' =>'warning', 'hasil' => validation_errors()]);
          } else {

            $data['klasifikasi_klaim'] = $this->input->post('nmklasik');
            $data['add_time'] = date('Y-m-d');
            $data['add_by'] = $this->session->userdata('sesi_id');

            $inputan = ['LOWER(klasifikasi_klaim)'  => strtolower($this->input->post('nmklasik'))
                      ];
                  
            $cek = cek_duplicate_banyak('m_klasifikasi_klaim', '', '', $inputan);

            if ($cek == 0) {
                $this->db->insert('m_klasifikasi_klaim', $data);
                echo json_encode(['status' => 'Berhasil', 'pesan' => 'Data Klasifikasi Klaim telah di Tambahkan', 'altr' =>'success', 'hasil' => '']);
            } else {
                echo json_encode(['status' => 'Gagal', 'pesan' => 'Data Klasifikasi Klaim tersebut Sudah Ada', 'altr' =>'warning', 'hasil' => '']);
            }
          }
          
  }


  public function edit($id)
    {
            $this->form_validation->set_rules($this->validcfg);
            if ($this->form_validation->run() == FALSE) {
            echo json_encode(['status' => 'Gagal', 'pesan' => 'Gagal Update, Form Klasifikasi Klaim Kosong', 'altr' =>'warning', 'hasil' => validation_errors()]);
            } else {
              $data['klasifikasi_klaim'] = $this->input->post('nmklasik');
              $data['add_time'] = date('Y-m-d');
              $data['add_by'] = $this->session->userdata('sesi_id');

              $inputan = ['LOWER(klasifikasi_klaim)'  => strtolower($this->input->post('nmklasik'))
                          ];
                      
              $cek = cek_duplicate_banyak('m_klasifikasi_klaim', 'id_klasifikasi_klaim', $id, $inputan);

                if ($cek == 0) {
                    $this->db->where('id_klasifikasi_klaim', $id);
                    $this->db->update('m_klasifikasi_klaim', $data);
                    echo json_encode(['status' => 'Sukses', 'pesan' => 'Data Klasifikasi Klaim telah di Update', 'altr' =>'success', 'hasil' => '']);
                } else {
                    echo json_encode(['status' => 'Gagal', 'pesan' => 'Data Klasifikasi Klaim tersebut Sudah Ada', 'altr' =>'warning', 'hasil' => '']);
                }
            }
    }

  public function show($id)
  {
    $this->db->where('id_klasifikasi_klaim',$id);
    $data = $this->db->get('m_klasifikasi_klaim')->result();
    echo json_encode($data);
  }

  public function remove($id)
  {
    $this->db->where('id_klasifikasi_klaim',$id);
		$this->db->delete('m_klasifikasi_klaim');

    echo json_encode(['status' => 'sukses']);
  }
}

?>
