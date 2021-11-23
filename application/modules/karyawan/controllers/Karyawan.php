<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 *
 */
class Karyawan extends CI_controller
{
  var $validcfg;

  public function __construct() {
    parent::__construct();
    $this->load->model('M_karyawan', 'karyawan');
    $this->load->model('negara/M_negara', 'negara');
    $this->load->model('provinsi/M_provinsi', 'provinsi');
    $this->load->model('jabatan/M_jabatan', 'jabatan');
    $this->load->model('bagian/M_bagian', 'bagian');
    $this->load->library('form_validation');
    $this->validcfg = array(
      array('field' => 'kode_karyawan', 'label' => 'Kode Karyawan', 'rules' => 'required'),
      array('field' => 'nnik', 'label' => 'Nik Karyawan', 'rules' => 'required'),
      array('field' => 'nmkary', 'label' => 'Nama Karyawan', 'rules' => 'required'),
      array('field' => 'jbtn', 'label' => 'Jabatan Karyawan', 'rules' => 'required'),
      array('field' => 'tele', 'label' => 'Telepon Karyawan', 'rules' => 'required'),
      array('field' => 'mail', 'label' => 'Email', 'rules' => 'required|valid_email', 'errors' => array('valid_email' => 'Format Email Tidak Sesuai')),
      array('field' => 'almt', 'label' => 'Alamat Karyawan', 'rules' => 'required'),
      array('field' => 'idnega', 'label' => 'Negara', 'rules' => 'required'),
      array('field' => 'idprov', 'label' => 'Provinsi', 'rules' => 'required'),
      array('field' => 'idkab', 'label' => 'Kabupaten/kota', 'rules' => 'required'),
      array('field' => 'idkec', 'label' => 'Kecamatan', 'rules' => 'required'),
      array('field' => 'idkel', 'label' => 'Kelurahan/Desa', 'rules' => 'required'),
    );
    if($this->session->userdata('username') == "") {
      redirect(base_url(), 'refresh');
    }
  }

  public function index($value='')
  {
    $data = [
      'title'         => 'Data Karyawan',
      'sub_title'     => 'Input Data Karyawan',
      'list_bagian'   => $this->bagian->allbagian(),
      'list_negara'   => $this->negara->allnegara(),
      'list_provinsi' => $this->provinsi->allprovinsi(),
      'role' => get_role($this->session->userdata('id_level_otorisasi'))
    ];
    $this->template->load('template/index', 'index', $data);
  }

  public function karyawan_kode($value='')
  {
    $kode = codegenerate('m_karyawan','KRY','karyawan','Y');
    echo $kode;
  }

  public function ajaxdata($action)
  {
    $permisi = explode('_',$action);
    $b1 = ''; $b2 = '';

    $no   = $this->input->post('start');
    $data = $this->karyawan->get_data_karyawan();

    $datax = array();
    foreach ($data as $key) {
      $tbody = array();

      $no++;
      $tbody[] = "<div align='center'>".$no.".</div>";
      $tbody[] = $key['kode_karyawan'];
      $tbody[] = $key['nik'];
      $tbody[] = $key['nama_karyawan'];
      $tbody[] = $key['bagian'].'/'.$key['jabatan'];
      if ($permisi[0] == 'true' || $action == '_') {
        $b1 = '<span style="cursor:pointer" class="mr-2 text-primary ubah-karyawan '.(count($data) > 1?'ttip':'').'" data-toggle="tooltip" data-placement="top" title="Ubah" onclick="ubahubah('.$key['id_karyawan'].')"><i class="fas fa-pencil-alt fa-lg"></i></span>';
      }
      if ($permisi[1] == 'true' || $action == '_') {
        $b2 = '<span style="cursor:pointer" class="text-danger hapus-karyawan '.(count($data) > 1?'ttip':'').'" data-toggle="tooltip" data-placement="top" title="Hapus" onclick="deletedel('.$key['id_karyawan'].')"><i class="far fa-trash-alt fa-lg"></i></span>';
      }
      $b3 = '<span style="cursor:pointer" class="text-dark '.(count($data) > 1?'ttip':'').'" data-toggle="tooltip" data-placement="top" title="Detail" onclick="detaild('.$key['id_karyawan'].')"><i class="fas fa-info-circle fa-lg"></i></span>&nbsp;&nbsp;';
      $tbody[] = $b3.$b1.$b2;
      $datax[] = $tbody;
    }

    $output = [
      "draw"            => $_POST['draw'],
      "recordsTotal"    => $this->karyawan->countallkaryawan(),
      "recordsFiltered" => $this->karyawan->countfilterkaryawan(),
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

      if (cek_duplicate('m_karyawan', 'nik', '', '', $this->input->post('nnik')) == 1) {
        echo json_encode(['status' => 'Gagal', 'pesan' => 'Data dengan Nik tersebut Sudah Tersedia', 'altr' =>'error', 'hasil' => '']);

        exit();
      }

      $data['kode_karyawan']   = $this->input->post('kode_karyawan');
      $data['nama_karyawan']   = $this->input->post('nmkary');
      $data['alamat_karyawan'] = $this->input->post('almt');
      $data['email']           = $this->input->post('mail');
      $data['telp']            = $this->input->post('tele');
      $data['nik']             = $this->input->post('nnik');
      $data['id_jabatan']      = $this->input->post('jbtn');
      $data['id_negara']       = $this->input->post('idnega');
      $data['id_provinsi']     = $this->input->post('idprov');
      $data['id_kota']         = $this->input->post('idkab');
      $data['id_kecamatan']    = $this->input->post('idkec');
      $data['id_desa']         = $this->input->post('idkel');
      $data['add_time'] = date('Y-m-d H:i:s');
      $data['add_by'] = $this->session->userdata('sesi_id');
      
      $this->db->insert('m_karyawan', $data);
      echo json_encode(['status' => 'Sukses', 'pesan' => 'Data Karyawan telah di Tambahkan', 'altr' =>'success', 'hasil' => '']);


      // 'LOWER(nama_karyawan)' => strtolower($this->input->post('nmkary'))
      // $this->db->where('nik',$this->input->post('nnik'));
      // $cek = $this->db->get('m_karyawan')->num_rows();
      // if ($cek == 0) {
      //   $this->db->where('LOWER(nama_karyawan)',strtolower($this->input->post('nmkary')));
      //   $cekk = $this->db->get('m_karyawan')->num_rows();
      //   if ($cekk == 0) {
      //     $data['kode_karyawan']   = $this->input->post('kode_karyawan');
      //     $data['nama_karyawan']   = $this->input->post('nmkary');
      //     $data['alamat_karyawan'] = $this->input->post('almt');
      //     $data['email']           = $this->input->post('mail');
      //     $data['telp']            = $this->input->post('tele');
      //     $data['nik']             = $this->input->post('nnik');
      //     $data['id_jabatan']      = $this->input->post('jbtn');
      //     $data['id_negara']       = $this->input->post('idnega');
      //     $data['id_provinsi']     = $this->input->post('idprov');
      //     $data['id_kota']         = $this->input->post('idkab');
      //     $data['id_kecamatan']    = $this->input->post('idkec');
      //     $data['id_desa']         = $this->input->post('idkel');
      //     $data['add_time'] = date('Y-m-d H:i:s');
      //     $data['add_by'] = $this->session->userdata('sesi_id');
      //     if (duplicatecek('m_karyawan', $data) == 0) {
      //       $this->db->insert('m_karyawan', $data);
      //       echo json_encode(['status' => 'Sukses', 'pesan' => 'Data Karyawan telah di Tambahkan', 'altr' =>'success', 'hasil' => '']);
      //     } else {
      //       echo json_encode(['status' => 'Gagal', 'pesan' => 'Data Karyawan tersebut Sudah Ada', 'altr' =>'error', 'hasil' => '']);
      //     }
      //   } else {
      //     echo json_encode(['status' => 'Gagal', 'pesan' => 'Data dengan Nama tersebut Sudah Tersedia', 'altr' =>'error', 'hasil' => '']);
      //   }
      // } else {
      //   echo json_encode(['status' => 'Gagal', 'pesan' => 'Data dengan Nik tersebut Sudah Tersedia', 'altr' =>'error', 'hasil' => '']);
      // }

    }
  }

  public function show($id)
  {
    $this->db->join('m_jabatan','m_jabatan.id_jabatan = m_karyawan.id_jabatan');
    $this->db->join('m_bagian','m_bagian.id_bagian = m_jabatan.id_bagian');
    $this->db->where('id_karyawan',$id);
    $data = $this->db->get('m_karyawan')->result();
    echo json_encode($data);
  }

  public function detail($id)
  {
    $this->db->join('m_negara','m_negara.id_negara = m_karyawan.id_negara','LEFT');
    $this->db->join('m_provinsi ','m_provinsi.id_provinsi = m_karyawan.id_provinsi','LEFT');
    $this->db->join('m_kota','m_kota.id_kota = m_karyawan.id_kota','LEFT');
    $this->db->join('m_kecamatan','m_kecamatan.id_kecamatan = m_karyawan.id_kecamatan','LEFT');
    $this->db->join('m_desa','m_desa.id_desa = m_karyawan.id_desa','LEFT');
    $this->db->join('m_jabatan','m_jabatan.id_jabatan = m_karyawan.id_jabatan');
    $this->db->join('m_bagian','m_bagian.id_bagian = m_jabatan.id_bagian');
    $this->db->where('id_karyawan',$id);
    $data = ['karyawan' => $this->db->get('m_karyawan')->row_array() ];
    // echo json_encode($data);

    $this->load->view('detail_karyawan', $data);
    
  }

  public function edit($id)
  {

    $this->form_validation->set_rules($this->validcfg);
    if ($this->form_validation->run() == FALSE) {
      echo json_encode(['status' => 'Gagal', 'pesan' => 'Gagal Update, Ada Form yg kosong', 'altr' =>'warning', 'hasil' => validation_errors()]);
    } else {

      if (cek_duplicate('m_karyawan', 'nik', 'id_karyawan', $id, $this->input->post('nnik')) == 1) {
        echo json_encode(['status' => 'Gagal', 'pesan' => 'Data dengan Nik tersebut Sudah Tersedia', 'altr' =>'error', 'hasil' => '']);

        exit();
      }

      // 'LOWER(nama_karyawan)' => strtolower($this->input->post('nmkary'))
      $data['nama_karyawan']   = $this->input->post('nmkary');
      $data['alamat_karyawan'] = $this->input->post('almt');
      $data['email']           = $this->input->post('mail');
      $data['telp']            = $this->input->post('tele');
      $data['nik']             = $this->input->post('nnik');
      $data['id_jabatan']      = $this->input->post('jbtn');
      $data['id_negara']       = $this->input->post('idnega');
      $data['id_provinsi']     = $this->input->post('idprov');
      $data['id_kota']         = $this->input->post('idkab');
      $data['id_kecamatan']    = $this->input->post('idkec');
      $data['id_desa']         = $this->input->post('idkel');
      $data['add_time'] = date('Y-m-d H:i:s');
      $data['add_by'] = $this->session->userdata('sesi_id');
      $this->db->where('id_karyawan', $id);
      $this->db->update('m_karyawan', $data);
      echo json_encode(['status' => 'Sukses', 'pesan' => 'Data Karyawan telah di Update', 'altr' =>'success', 'hasil' => '']);
      // $this->db->where('nik',$this->input->post('nnik'));
      // $cek = $this->db->get('m_karyawan')->num_rows();
      // if ($cek == 0) {
      //   $this->db->where('LOWER(nama_karyawan)',strtolower($this->input->post('nmkary')));
      //   $cekk = $this->db->get('m_karyawan')->num_rows();
        // if ($cekk == 0) {
          // if (duplicatecek('m_karyawan', $data) == 0) {
          // } else {
          //   echo json_encode(['status' => 'Gagal', 'pesan' => 'Data Karyawan tersebut Sudah Ada', 'altr' =>'error', 'hasil' => '']);
          // }
        // } else {
        //   echo json_encode(['status' => 'Gagal', 'pesan' => 'Data dengan Nama tersebut Sudah Tersedia', 'altr' =>'error', 'hasil' => '']);
        // }
      // } else {
      //   echo json_encode(['status' => 'Gagal', 'pesan' => 'Data dengan Nik tersebut Sudah Tersedia', 'altr' =>'error', 'hasil' => '']);
      // }
    }
  }

  public function remove($id)
  {
    $this->db->where(['id_karyawan' => $id, 'id_level_user' => 2]);
    $cek_usn = $this->db->get('m_user')->num_rows();
    if ($cek_usn > 0) {
      $this->db->where(['id_karyawan' => $id, 'id_level_user' => 2]);
      $this->db->delete('m_user');
    }

    $this->db->where('id_karyawan', $id);
    $this->db->delete('m_karyawan');

    echo json_encode(['status' => 'sukses']);
  }
}

?>
