<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 *
 */
class Type_cob extends CI_controller
{

  var $validcfg;
  public function __construct() {
    parent::__construct();
    $this->load->model('M_tipecob', 'tipecob');
    $this->load->library('form_validation');
    $this->validcfg = array(
      array('field' => 'tcob', 'label' => 'Tipe COB', 'rules' => 'required')
    );
    if($this->session->userdata('username') == "") {
      redirect(base_url(), 'refresh');
    }
  }

  public function index($value='')
  {
    $data = [
      'title' => 'Type Of COB',
      'role' => get_role($this->session->userdata('id_level_otorisasi'))
    ];
    $this->template->load('template/index', 'index', $data);
  }

  public function ajaxdata($action)
  {
    $permisi = explode('_',$action);
    $b1 = ''; $b2 = '';

    $no   = $this->input->post('start');
    $data = $this->tipecob->get_data_tipecob();

    $datax = array();
    foreach ($data as $key) {
      $tbody = array();

      $no++;
      $tbody[] = "<div align='center'>".$no.".</div>";
      $tbody[] = $key['tipe_cob'];
      if ($permisi[0] == 'true' || $action == '_') {
        $b1 = '<span style="cursor:pointer" class="mr-2 text-primary" data-toggle="tooltip" data-placement="top" title="Ubah" onclick="ubahubah('.$key['id_tipe_cob'].')"><i class="fas fa-pencil-alt fa-lg"></i></span>';
      }
      if ($permisi[1] == 'true' || $action == '_') {
        $b2 = '<span style="cursor:pointer" class="text-danger" data-toggle="tooltip" data-placement="top" title="Hapus" onclick="deletedel('.$key['id_tipe_cob'].')"><i class="far fa-trash-alt fa-lg"></i></span>';
      }
      $tbody[] = $b1.$b2;
      $datax[] = $tbody;
    }

    $output = [
      "draw"            => $_POST['draw'],
      "recordsTotal"    => $this->tipecob->countalllisttipecob(),
      "recordsFiltered" => $this->tipecob->countfilterlisttipecob(),
      "data"            => $datax
    ];
    echo json_encode($output);
  }



  public function add()
  {

          $this->form_validation->set_rules($this->validcfg);
          if ($this->form_validation->run() == FALSE) {
          echo json_encode(['status' => 'Gagal', 'pesan' => 'Gagal Insert, Ada Form yg kosong', 'altr' =>'warning', 'hasil' => validation_errors()]);
          } else {
          

            $data['tipe_cob'] = $this->input->post('tcob');
            $data['add_time'] = date('Y-m-d');
            $data['add_by'] = $this->session->userdata('sesi_id');

            $inputan = ['LOWER(tipe_cob)'  => strtolower($this->input->post('tcob'))
                      ];
                  
            $cek = cek_duplicate_banyak('m_tipe_cob', '', '', $inputan);

              if ($cek == 0) {
                  $this->db->insert('m_tipe_cob', $data);
                  echo json_encode(['status' => 'Berhasil', 'pesan' => 'Data Tipe COB telah di Tambahkan', 'altr' =>'success', 'hasil' => '']);
              } else {
                  echo json_encode(['status' => 'Gagal', 'pesan' => 'Data Tipe COB tersebut Sudah Ada', 'altr' =>'warning', 'hasil' => '']);
              }
      
          }
  }


  public function edit($id)
    {
            $this->form_validation->set_rules($this->validcfg);
            if ($this->form_validation->run() == FALSE) {
            echo json_encode(['status' => 'Gagal', 'pesan' => 'Gagal Update, Ada Form yg kosong', 'altr' =>'warning', 'hasil' => validation_errors()]);
            } else {

              $data['tipe_cob'] = $this->input->post('tcob');
              $data['add_time'] = date('Y-m-d');
              $data['add_by'] = $this->session->userdata('sesi_id');

              $inputan = ['LOWER(tipe_cob)'  => strtolower($this->input->post('tcob'))
                        ];
                  
              $cek = cek_duplicate_banyak('m_tipe_cob', 'id_tipe_cob', $id, $inputan);
              
              if ($cek == 0) {
                $this->db->where('id_tipe_cob', $id);
                $this->db->update('m_tipe_cob', $data);
                echo json_encode(['status' => 'Sukses', 'pesan' => 'Data Tipe COB telah di Update', 'altr' =>'success', 'hasil' => '']);
              } else {
                  echo json_encode(['status' => 'Gagal', 'pesan' => 'Data Tipe COB tersebut Sudah Ada', 'altr' =>'warning', 'hasil' => '']);
              }
            }
    }


  public function show($id)
  {
    $this->db->where('id_tipe_cob', $id);
    $data = $this->db->get('m_tipe_cob')->result();
    echo json_encode($data);
  }


  public function remove($id)
  {
    $this->db->where('id_tipe_cob', $id);
    $this->db->delete('m_tipe_cob');

    echo json_encode(['status' => 'sukses']);
  }
}

?>
