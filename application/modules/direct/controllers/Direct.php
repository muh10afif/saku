<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 *
 */
class Direct extends CI_controller
{
  var $validcfg;

  public function __construct() {
    parent::__construct();
    $this->load->model('M_direct', 'direct');
    $this->load->model('negara/M_negara', 'negara');
    $this->load->model('provinsi/M_provinsi', 'provinsi');
    $this->load->library('form_validation');
    $this->validcfg = array(
      array('field' => 'nmdi', 'label' => 'Nama Direct', 'rules' => 'required'),
      array('field' => 'tldi', 'label' => 'Telepon', 'rules' => 'required'),
      array('field' => 'aldi', 'label' => 'Alamat Direct', 'rules' => 'required'),
      array('field' => 'stat', 'label' => 'Status Keanggotaan', 'rules' => 'required'),
      array('field' => 'idnega', 'label' => 'Negara', 'rules' => 'required'),
      array('field' => 'idprov', 'label' => 'Provinsi', 'rules' => 'required'),
      array('field' => 'idkab', 'label' => 'Kabupaten/Kota', 'rules' => 'required'),
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
      'title' => 'Direct Data',
      'list_negara' => $this->negara->allnegara(),
      'isprovinsi'  => $this->provinsi->allprovinsi(),
      'role' => get_role($this->session->userdata('id_level_otorisasi'))
    ];
    $this->template->load('template/index', 'index', $data);
  }

  public function direct_kode($value='')
  {
    $kode = codegenerate('m_direct','DRC','direct','C');
    echo $kode;
  }

  public function ajaxdata($action)
  {
    $permisi = explode('_',$action);
    $b1 = ''; $b2 = '';

    $no   = $this->input->post('start');
    $data = $this->direct->get_data_direct($this->input->post('tipen'));

    $datax = array();
    foreach ($data as $key) {
      $tbody = array();

      $no++;
      $tbody[] = "<div align='center'>".$no.".</div>";
      $tbody[] = $key['kode_direct'];
      $tbody[] = $key['nama'];
      $tbody[] = $key['telp'];
      $tbody[] = $key['alamat'];
      if ($permisi[0] == 'true' || $action == '_') {
        $b1 = '<span style="cursor:pointer" class="mr-2 text-primary '.(count($data) > 1?'ttip':'').'" data-toggle="tooltip" data-placement="top" title="Ubah" onclick="ubahubah('.$key['id_direct'].')"><i class="fas fa-pencil-alt fa-lg"></i></span>';
      }
      if ($permisi[1] == 'true' || $action == '_') {
        $b2 = '<span style="cursor:pointer" class="text-danger '.(count($data) > 1?'ttip':'').'" data-toggle="tooltip" data-placement="top" title="Hapus" onclick="deletedel('.$key['id_direct'].')"><i class="far fa-trash-alt fa-lg"></i></span>';
      }
      $b3 = '<span style="cursor:pointer" class="text-dark '.(count($data) > 1?'ttip':'').'" data-toggle="tooltip" data-placement="top" title="Detail" onclick="detaild('.$key['id_direct'].')"><i class="fas fa-info-circle fa-lg"></i></span>&nbsp;&nbsp;';
      $tbody[] = $b3.$b1.$b2;
      $datax[] = $tbody;
    }

    $output = [
      "draw"            => $_POST['draw'],
      "recordsTotal"    => $this->direct->countalldirect($this->input->post('tipen')),
      "recordsFiltered" => $this->direct->countfilterdirect($this->input->post('tipen')),
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
      $data['kode_direct'] = $this->input->post('kddi');
      $data['nama'] = $this->input->post('nmdi');
      $data['telp'] = $this->input->post('tldi');
      $data['alamat'] = $this->input->post('aldi');
      $data['status'] = $this->input->post('stat');
      $data['id_negara']    = $this->input->post('idnega');
      $data['id_provinsi']  = $this->input->post('idprov');
      $data['id_kota']      = $this->input->post('idkab');
      $data['id_kecamatan'] = $this->input->post('idkec');
      $data['id_desa']      = $this->input->post('idkel');
      $data['add_time'] = date('Y-m-d H:i:s');
      $data['add_by'] = $this->session->userdata('sesi_id');

      $inputan = ['LOWER(nama)' => strtolower($this->input->post('nmdi')),
                  'status'      => $this->input->post('stat')
                ];
            
      $cek = cek_duplicate_banyak('m_direct', '', '', $inputan);

      if ($cek == 0) {
        $this->db->insert('m_direct', $data);
        echo json_encode(['status' => "Berhasil", 'pesan' => 'Berhasil Menambahkan Data Direct', 'altr' => 'success']);
      } else {
        echo json_encode(['status' => 'Gagal', 'pesan' => 'Data Direct tersebut Sudah Ada', 'altr' =>'error', 'hasil' => '']);
      }
    }
  }

  public function show($id)
  {
    $this->db->where('id_direct',$id);
    $data = $this->db->get('m_direct')->result();
    echo json_encode($data);
  }

  public function detail($id)
  {
    $this->db->join('m_negara','m_negara.id_negara = m_direct.id_negara','LEFT');
    $this->db->join('m_provinsi ','m_provinsi.id_provinsi = m_direct.id_provinsi','LEFT');
    $this->db->join('m_kota','m_kota.id_kota = m_direct.id_kota','LEFT');
    $this->db->join('m_kecamatan','m_kecamatan.id_kecamatan = m_direct.id_kecamatan','LEFT');
    $this->db->join('m_desa','m_desa.id_desa = m_direct.id_desa','LEFT');
    $this->db->where('id_direct',$id);
    $data = $this->db->get('m_direct')->result();
    echo json_encode($data);
  }

  public function edit($id)
  {
    $this->form_validation->set_rules($this->validcfg);
    if ($this->form_validation->run() == FALSE) {
      echo json_encode(['status' => 'Gagal', 'pesan' => 'Gagal Update, Ada Form yang kosong', 'altr' =>'warning']);
    } else {
      
        $data['nama'] = $this->input->post('nmdi');
        $data['telp'] = $this->input->post('tldi');
        $data['alamat'] = $this->input->post('aldi');
        $data['status'] = $this->input->post('stat');
        $data['id_negara']    = $this->input->post('idnega');
        $data['id_provinsi']  = $this->input->post('idprov');
        $data['id_kota']      = $this->input->post('idkab');
        $data['id_kecamatan'] = $this->input->post('idkec');
        $data['id_desa']      = $this->input->post('idkel');
        $data['add_time'] = date('Y-m-d H:i:s');
        $data['add_by'] = $this->session->userdata('sesi_id');

        $inputan = ['LOWER(nama)' => strtolower($this->input->post('nmdi')),
                    'status'      => $this->input->post('stat')
                  ];
              
        $cek = cek_duplicate_banyak('m_direct', 'id_direct', $id, $inputan);

      if ($cek == 0) {
        
        $this->db->where('id_direct', $id);
        $this->db->update('m_direct', $data);
        echo json_encode(['status' => "Berhasil", 'pesan' => 'Berhasil Mengubah Data Direct', 'altr' => 'success']);
      } else {
        echo json_encode(['status' => 'Gagal', 'pesan' => 'Data Direct tersebut Sudah Ada', 'altr' =>'error', 'hasil' => '']);
      }
    }
  }
  public function remove($id)

  {
    $this->db->where(['id_karyawan' => $id]);
    $cek_usn = $this->db->get('m_user');
    if ($cek_usn->num_rows() > 0) {
      $hsl = $cek_usn->result();
      foreach ($hsl as $key) {
        if ($key->id_level_user == 5) {
          $this->db->where(['id_user' => $key->id_user, 'flag_table' => 4]);
          $this->db->delete('m_user');
        }
      }
    }

    $this->db->where('id_direct',$id);
		$this->db->delete('m_direct');

    echo json_encode(['status' => 'sukses']);
  }
}

?>
