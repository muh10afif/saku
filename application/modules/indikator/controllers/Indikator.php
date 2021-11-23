<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 *
 */
class Indikator extends CI_controller
{

  var $validcfg;
  public function __construct() {
    parent::__construct();
    $this->load->model('M_indikator', 'indikator');
    $this->load->library('form_validation');
    $this->role = get_role($this->session->userdata('id_level_otorisasi'));
    $this->validcfg = array(
            array('field' => 'nmindi', 'label' => 'Indikator', 'rules' => 'required')
    );
    if($this->session->userdata('username') == "") {
      redirect(base_url(), 'refresh');
    }
  }

  public function index($value='')
  {
    $data = [
      'title' => 'Indikator',
      'role' => get_role($this->session->userdata('id_level_otorisasi'))
    ];
    $this->template->load('template/index', 'index', $data);
  }

  public function ajaxdata($action)
  {
    $permisi = explode('_',$action);
    $b1 = ''; $b2 = '';

    $no   = $this->input->post('start');
    $data = $this->indikator->get_data_indikator();

    $datax = array();
    foreach ($data as $key) {
      $tbody = array();

      $no++;
      $tbody[] = "<div align='center'>".$no.".</div>";
      $tbody[] = $key['nama_indikator'];
      if ($permisi[0] == 'true' || $action == '_') {
        $b1 = '<span style="cursor:pointer" class="mr-2 text-primary '.(count($data) > 1?'ttip':'').'" data-toggle="tooltip" data-placement="top" title="Ubah" onclick="ubahubah('.$key['id_indikator'].')"><i class="fas fa-pencil-alt fa-lg"></i></span>';
      }
      if ($permisi[1] == 'true' || $action == '_') {
        $b2 = '<span style="cursor:pointer" class="text-danger '.(count($data) > 1?'ttip':'').'" data-toggle="tooltip" data-placement="top" title="Hapus" onclick="deletedel('.$key['id_indikator'].')"><i class="far fa-trash-alt fa-lg"></i></span>';
      }
      $tbody[] = $b1.$b2;
      $datax[] = $tbody;
    }

    $output = [
      "draw"            => $_POST['draw'],
      "recordsTotal"    => $this->indikator->countallindikator(),
      "recordsFiltered" => $this->indikator->countfilterindikator(),
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

            $data['nama_indikator'] = $this->input->post('nmindi');
            $data['add_time'] = date('Y-m-d');
            $data['add_by'] = $this->session->userdata('sesi_id');

            $inputan = ['LOWER(nama_indikator)'  => strtolower($this->input->post('nmindi'))
                      ];
                  
            $cek = cek_duplicate_banyak('m_indikator', '', '', $inputan);

            if ($cek == 0) {
                $this->db->insert('m_indikator', $data);
                echo json_encode(['status' => 'Berhasil', 'pesan' => 'Data Indikator telah di Tambahkan', 'altr' =>'success', 'hasil' => '']);
            } else {
                echo json_encode(['status' => 'Gagal', 'pesan' => 'Data Indikator tersebut Sudah Ada', 'altr' =>'warning', 'hasil' => '']);
            }
      
          }
  }

  public function show($id)
  {
    $this->db->where('id_indikator',$id);
    $data = $this->db->get('m_indikator')->result();
    echo json_encode($data);
  }


  public function edit($id)
    {
            $this->form_validation->set_rules($this->validcfg);
            if ($this->form_validation->run() == FALSE) {
            echo json_encode(['status' => 'Gagal', 'pesan' => 'Gagal Update, Ada Form yg kosong', 'altr' =>'warning', 'hasil' => validation_errors()]);
            } else {
              $data['nama_indikator'] = $this->input->post('nmindi');
              $data['add_time'] = date('Y-m-d');
              $data['add_by'] = $this->session->userdata('sesi_id');

              $inputan = ['LOWER(nama_indikator)'  => strtolower($this->input->post('nmindi'))
                          ];
                      
              $cek = cek_duplicate_banyak('m_indikator', 'id_indikator', $id, $inputan);
                
            if ($cek == 0) {
                $this->db->where('id_indikator', $id);
                $this->db->update('m_indikator', $data);
                echo json_encode(['status' => 'Sukses', 'pesan' => 'Data Indikator telah di Update', 'altr' =>'success', 'hasil' => '']);
                } else {
                    echo json_encode(['status' => 'Gagal', 'pesan' => 'Data Indikator tersebut Sudah Ada', 'altr' =>'warning', 'hasil' => '']);
                }
            }
    }

  public function remove($id)
  {
    $this->db->where('id_indikator',$id);
		$this->db->delete('m_indikator');

    echo json_encode(['status' => 'sukses']);
  }
}

?>
