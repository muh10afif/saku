<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 *
 */
class Nasabah extends CI_controller
{
  var $validcfg;

  public function __construct() {
    parent::__construct();
    $this->load->model('negara/M_negara', 'negara');
    $this->load->model('provinsi/M_provinsi', 'provinsi');
    $this->load->model('M_nasabah', 'nasabah');
    $this->load->library('form_validation');
    $this->validcfg = array(
      array('field' => 'nmnsbh', 'label' => 'Nama Nasabah', 'rules' => 'required'),
      // array('field' => 'tmpdns', 'label' => 'Tempat Dinas', 'rules' => 'required'),
      array('field' => 'almtrm', 'label' => 'Alamat Rumah', 'rules' => 'required'),
      array('field' => 'telp', 'label' => 'Telepon', 'rules' => 'required'),
      array('field' => 'stat', 'label' => 'Status Keanggotaan', 'rules' => 'required'),
      array('field' => 'idnega', 'label' => 'Negara', 'rules' => 'required'),
      array('field' => 'idprov', 'label' => 'Provinsi', 'rules' => 'required'),
      array('field' => 'idkab', 'label' => 'Kabupaten/Kota', 'rules' => 'required'),
      array('field' => 'idkec', 'label' => 'Kecamatan', 'rules' => 'required'),
      array('field' => 'idkel', 'label' => 'Desa/Kelurahan', 'rules' => 'required'),
      array('field' => 'stat', 'label' => 'Status Keanggotaan', 'rules' => 'required'),
    );
    if($this->session->userdata('username') == "") {
      redirect(base_url(), 'refresh');
    }
  }

  public function index()
  {
    $data = [
      'title'       => 'Data Tertanggung/Insured',
      'list_negara' => $this->negara->allnegara(),
      'isprovinsi'  => $this->provinsi->allprovinsi(),
      'role' => get_role($this->session->userdata('id_level_otorisasi'))
    ];
    $this->template->load('template/index', 'index', $data);
  }

  public function nasabah_kode($value='')
  {
    $kode = codegenerate('m_nasabah','NSB','nasabah','B');
    echo $kode;
  }

  public function ajaxdata($action)
  {
    $permisi = explode('_',$action);
    $b1 = ''; $b2 = '';

    $no   = $this->input->post('start');
    $data = $this->nasabah->get_data_nasabah($this->input->post('tipen'));

    $datax = array();
    foreach ($data as $key) {
      $tbody = array();

      $no++;
      $tbody[] = "<div align='center'>".$no.".</div>";
      $tbody[] = $key['kode_nasabah'];
      $tbody[] = $key['nik'];
      $tbody[] = $key['nama_nasabah'];
      $tbody[] = $key['telp'];
      if ($key['tgl_lahir'] != "") {
        $tgl = explode('-',$key['tgl_lahir']);
        $tbody[] = $tgl[2].'-'.$tgl[1].'-'.$tgl[0];
      } else {
        $tbody[] = "";
      }
      if ($key['status'] == true) {
        if (isset($key['jenis_kelamin'])) {
          $tbody[] = ($key['jenis_kelamin'] == true) ? 'Laki-laki':'Perempuan';   //conditioanl here
        } else {
          $tbody[] = "";
        }
      } else {
        $tbody[] = "";
      }
      if ($permisi[0] == 'true' || $action == '_') {
        $b1 = '<span style="cursor:pointer" class="mr-2 text-primary '.(count($data) > 1?'ttip':'').'" data-toggle="tooltip" data-placement="top" title="Ubah" onclick="ubahubah('.$key['id_nasabah'].')"><i class="fas fa-pencil-alt fa-lg"></i></span>';
      }
      if ($permisi[1] == 'true' || $action == '_') {
        $b2 = '<span style="cursor:pointer" class="text-danger '.(count($data) > 1?'ttip':'').'" data-toggle="tooltip" data-placement="top" title="Hapus" onclick="deletedel('.$key['id_nasabah'].')"><i class="far fa-trash-alt fa-lg"></i></span>';
      }
      $b3 = '<span style="cursor:pointer" class="text-dark '.(count($data) > 1?'ttip':'').'" data-toggle="tooltip" data-placement="top" title="Detail" onclick="detaild('.$key['id_nasabah'].')"><i class="fas fa-info-circle fa-lg"></i></span>&nbsp;&nbsp;';
      $tbody[] = $b3.$b1.$b2;
      $datax[] = $tbody;
    }

    $output = [
      "draw"            => $_POST['draw'],
      "recordsTotal"    => $this->nasabah->countallnasabah($this->input->post('tipen')),
      "recordsFiltered" => $this->nasabah->countfilternasabah($this->input->post('tipen')),
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

      if ($this->input->post('stat') == 't') {

        $inputan = ['nik'     => $this->input->post('nnik'),
                    'status'  => $this->input->post('stat')
                  ];
              
        $cek_data = cek_duplicate_banyak('m_nasabah', '', '', $inputan);

        $field = "NIK";
        
      } else {

        $inputan = ['LOWER(nama_nasabah)'   => strtolower($this->input->post('nmnsbh')),
                    'status'                => $this->input->post('stat')
                  ];
              
        $cek_data = cek_duplicate_banyak('m_nasabah', '', '', $inputan);

        $field = "Nama Nasabah";
      }

      if ($cek_data == 0) {

        $sinik = "";
        if ($this->input->post('nnik') == "") {
          $sinik = "";
        } else {
          $this->db->where('nik',$this->input->post('nnik'));
          $sinik = $this->db->get('m_nasabah')->num_rows();
        }

          $data['kode_nasabah']  = $this->input->post('kdnsb');
          $data['nama_nasabah']  = $this->input->post('nmnsbh');
          if ($this->input->post('tglhr') != "") {
            $data['tgl_lahir']     = $this->input->post('tglhr');
          }
          $data['tempat_dinas']  = $this->input->post('tmpdns');
          $data['alamat_rumah']  = $this->input->post('almtrm');
          $data['telp']          = $this->input->post('telp');
          if ($this->input->post('nnik') != "") {
            $data['nik']           = $this->input->post('nnik');
          }
          if ($this->input->post('jenkl')) {
            $data['jenis_kelamin'] = $this->input->post('jenkl');
          }
          $data['status']       = $this->input->post('stat');
          $data['id_negara']    = $this->input->post('idnega');
          $data['id_provinsi']  = $this->input->post('idprov');
          $data['id_kota']      = $this->input->post('idkab');
          $data['id_kecamatan'] = $this->input->post('idkec');
          $data['id_desa']      = $this->input->post('idkel');
          $data['add_time']     = date('Y-m-d H:i:s');
          $data['add_by']       = $this->session->userdata('sesi_id');

          $this->db->insert('m_nasabah', $data);
          echo json_encode(['status' => "Berhasil", 'pesan' => 'Berhasil Menambahkan Nasabah', 'altr' => 'success']);
      
      } else {

        echo json_encode(['status' => 'Gagal', 'pesan' => "$field tersebut Sudah Ada", 'altr' =>'error', 'hasil' => '']);
        
      }
     
    }
  }

  public function show($id)
  {
    $this->db->where('id_nasabah', $id);
    $data = $this->db->get('m_nasabah')->result();
    echo json_encode($data);
  }

  public function detail($id)
  {
    $this->db->join('m_negara','m_negara.id_negara = m_nasabah.id_negara','LEFT');
    $this->db->join('m_provinsi ','m_provinsi.id_provinsi = m_nasabah.id_provinsi','LEFT');
    $this->db->join('m_kota','m_kota.id_kota = m_nasabah.id_kota','LEFT');
    $this->db->join('m_kecamatan','m_kecamatan.id_kecamatan = m_nasabah.id_kecamatan','LEFT');
    $this->db->join('m_desa','m_desa.id_desa = m_nasabah.id_desa','LEFT');
    $this->db->where('id_nasabah', $id);
    $data = $this->db->get('m_nasabah')->result();
    echo json_encode($data);
  }

  public function edit($id)
  {
    $this->form_validation->set_rules($this->validcfg);
    if ($this->form_validation->run() == FALSE) {
      echo json_encode(['status' => 'Gagal', 'pesan' => 'Gagal Update, Ada Form yang kosong', 'altr' =>'warning']);
    } else {

      if ($this->input->post('stat') == 't') {

        $inputan = ['nik'     => $this->input->post('nnik'),
                    'status'  => $this->input->post('stat')
                  ];
              
        $cek_data = cek_duplicate_banyak('m_nasabah', 'id_nasabah', $id, $inputan);

        $field = "NIK";
        
      } else {

        $inputan = ['LOWER(nama_nasabah)'   => strtolower($this->input->post('nmnsbh')),
                    'status'                => $this->input->post('stat')
                  ];
              
        $cek_data = cek_duplicate_banyak('m_nasabah', 'id_nasabah', $id, $inputan);

        $field = "Nama Nasabah";
      }

      if ($cek_data == 0) {

        $data['nama_nasabah']  = $this->input->post('nmnsbh');
        if ($this->input->post('tglhr') != "") {
          $data['tgl_lahir']     = $this->input->post('tglhr');
        }
        $data['tempat_dinas']  = $this->input->post('tmpdns');
        $data['alamat_rumah']  = $this->input->post('almtrm');
        $data['telp']          = $this->input->post('telp');
        if ($this->input->post('nnik')) {
          $data['nik']           = $this->input->post('nnik');
        }
        if ($this->input->post('jenkl')) {
          $data['jenis_kelamin'] = $this->input->post('jenkl');
        }
        $data['status']       = $this->input->post('stat');
        $data['id_negara']    = $this->input->post('idnega');
        $data['id_provinsi']  = $this->input->post('idprov');
        $data['id_kota']      = $this->input->post('idkab');
        $data['id_kecamatan'] = $this->input->post('idkec');
        $data['id_desa']      = $this->input->post('idkel');
        $data['add_time']     = date('Y-m-d H:i:s');
        $data['add_by']       = $this->session->userdata('sesi_id');
        $this->db->where('id_nasabah', $id);
        $this->db->update('m_nasabah', $data);
        echo json_encode(['status' => "Berhasil", 'pesan' => 'Berhasil Mengubah Nasabah', 'altr' => 'success']);

      } else {
        echo json_encode(['status' => 'Gagal', 'pesan' => "$field tersebut Sudah Ada", 'altr' =>'error', 'hasil' => '']);
      }
      
    }
  }

  public function getprov($id)
  {
    $xid = $this->security->xss_clean($id);
    $this->db->order_by("provinsi", "asc");
    $this->db->where('id_negara',$xid);
    $data = $this->db->get('m_provinsi')->result();
    echo json_encode($data);
  }

  public function getkab($id)
  {
    $xid = $this->security->xss_clean($id);
    $this->db->order_by("kota", "asc");
    $this->db->where('id_provinsi',$xid);
    $data = $this->db->get('m_kota')->result();
    echo json_encode($data);
  }

  public function getkec($id)
  {
    $xid = $this->security->xss_clean($id);
    $this->db->order_by("kecamatan", "asc");
    $this->db->where('id_kota',$xid);
    $data = $this->db->get('m_kecamatan')->result();
    echo json_encode($data);
  }

  public function getkel($id)
  {
    $xid = $this->security->xss_clean($id);
    $this->db->order_by("desa", "asc");
    $this->db->where('id_kecamatan',$xid);
    $data = $this->db->get('m_desa')->result();
    echo json_encode($data);
  }

  public function remove($id)
  {
    $this->db->where(['id_karyawan' => $id]);
    $cek_usn = $this->db->get('m_user');
    if ($cek_usn->num_rows() > 0) {
      $hsl = $cek_usn->result();
      foreach ($hsl as $key) {
        if ($key->id_level_user == 5) {
          $this->db->where(['id_user' => $key->id_user, 'flag_table' => 2]);
          $this->db->delete('m_user');
        }
      }
    }

    $this->db->where('id_nasabah', $id);
    $this->db->delete('m_nasabah');

    echo json_encode(['status' => 'sukses']);
  }
}

?>
