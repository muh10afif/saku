<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 *
 */
class Cashbank extends CI_controller
{
  var $validcfg;
  public function __construct() {
    parent::__construct();
    $this->load->model('M_cashbank', 'cashbank');
    $this->load->model('jenisbank/M_jenis_bank', 'me');
    $this->load->library('form_validation');
    $this->validcfg = array(
        array('field' => 'nmcashbnk', 'label' => 'Cash Bank', 'rules' => 'required'),
    );
    if($this->session->userdata('username') == "") {
      redirect(base_url(), 'refresh');
    }
  }

  public function index($value='')
  {
    $data = [
      'title' => 'Cash Bank',
      'list_jenis_bank' => $this->me->listjenisbank()
    ];
    $this->template->load('template/index', 'index', $data);
  }

  public function cashbank_kode($value='')
  {
    $kode = codegenerate('m_cashbank','CSB','cashbank','B');
    echo $kode;
  }

  public function ajaxdata($value='')
  {
    $no   = $this->input->post('start');
    $data = $this->cashbank->get_data_cashbank();

    $datax = array();
    foreach ($data as $key) {
      $tbody = array();

      $no++;
      $tbody[] = "<div align='center'>".$no.".</div>";
      $tbody[] = $key['kode_cashbank'];
      $tbody[] = $key['cashbank'];
      $tbody[] = '<i style="cursor:pointer" data-toggle="tooltip" data-placement="top" title="Ubah" class="ttip fas fa-pencil-alt fa-lg text-primary mr-2" onclick="ubahubah('.$key['id_cashbank'].')"></i>&nbsp;
                  <i style="cursor:pointer" data-toggle="tooltip" data-placement="top" title="Hapus" class="ttip far fa-trash-alt fa-lg text-danger" onclick="deletedel('.$key['id_cashbank'].')"></i>';
      $datax[] = $tbody;
    }

    $output = [
      "draw"            => $_POST['draw'],
      "recordsTotal"    => $this->cashbank->countalllistcashbank(),
      "recordsFiltered" => $this->cashbank->countfilterlistcashbank(),
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

              // $this->db->where([
              //     'LOWER(cashbank)' => strtolower($this->input->post('nmcashbnk'))
              // ]);
              $cek = cek_duplicate('m_cashbank', 'cashbank', '', '', $this->input->post('nmcashbnk'));

              if ($cek == 0) {

                $data['kode_cashbank'] = $this->input->post('kdcbnk');
                $data['cashbank'] = $this->input->post('nmcashbnk');
                $data['add_time'] = date('Y-m-d');
                $data['add_by'] = $this->session->userdata('sesi_id');

                $this->db->insert('m_cashbank', $data);
                echo json_encode(['status' => 'Berhasil', 'pesan' => 'Data Cash Bank telah di Tambahkan', 'altr' =>'success', 'hasil' => '']);
                
              } else {
                echo json_encode(['status' => 'Gagal', 'pesan' => 'Data Cash Bank tersebut Sudah Ada', 'altr' =>'warning', 'hasil' => '']);
              }
              
            }
    }


    public function edit($id)
    {
            $this->form_validation->set_rules($this->validcfg);
            if ($this->form_validation->run() == FALSE) {
            echo json_encode(['status' => 'Gagal', 'pesan' => 'Gagal Update, Ada Form yg kosong', 'altr' =>'warning', 'hasil' => validation_errors()]);
            } else {
                
                $cek = cek_duplicate('m_cashbank', 'cashbank', 'id_cashbank', $id, $this->input->post('nmcashbnk'));

                if ($cek == 0) {
                  $data['cashbank'] = $this->input->post('nmcashbnk');
                  $data['add_time'] = date('Y-m-d');
                  $data['add_by'] = $this->session->userdata('sesi_id');
                  
                  $this->db->where('id_cashbank', $id);
                  $this->db->update('m_cashbank', $data);
                  echo json_encode(['status' => 'Sukses', 'pesan' => 'Data Cash Bank telah di Update', 'altr' =>'success', 'hasil' => '']);
                  
                } else {
                  echo json_encode(['status' => 'Gagal', 'pesan' => 'Data Cash Bank tersebut Sudah Ada', 'altr' =>'warning', 'hasil' => '']);
                }
            }
    }

  public function show($id)
  {
    $this->db->where('id_cashbank', $id);
    $data = $this->db->get('m_cashbank')->result();
    echo json_encode($data);
  }

  public function remove($id)
  {
    $this->db->where('id_cashbank', $id);
    $this->db->delete('m_cashbank');

    echo json_encode(['status' => 'sukses']);
  }
}

?>
