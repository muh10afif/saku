<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 *
 */
class Lost_adjuster extends CI_controller
{
  var $validcfg;

  public function __construct() {
    parent::__construct();
    $this->load->model('M_lost_adjuster', 'lost_adjuster');
    $this->load->model('negara/M_negara', 'negara');
    $this->load->model('provinsi/M_provinsi', 'provinsi');
    $this->load->library('form_validation');
    $this->validcfg = array(
      array('field' => 'nmla', 'label' => 'Nama Loss Adjuster', 'rules' => 'required'),
      array('field' => 'tlla', 'label' => 'Telepon', 'rules' => 'required'),
      array('field' => 'alla', 'label' => 'Alamat Loss Adjuster', 'rules' => 'required'),
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
      'title' => 'Loss Adjuster Data',
      'list_negara' => $this->negara->allnegara(),
      'isprovinsi'  => $this->provinsi->allprovinsi(),
      'role' => get_role($this->session->userdata('id_level_otorisasi'))
    ];
    $this->template->load('template/index', 'index', $data);
  }

  public function loss_kode($value='')
  {
    $kode = codegenerate('m_loss_adjuster','LSA','loss_adjuster','A');
    echo $kode;
  }

  public function ajaxdata($action)
  {
    $permisi = explode('_',$action);
    $b1 = ''; $b2 = '';

    $no   = $this->input->post('start');
    $data = $this->lost_adjuster->get_data_lostadj($this->input->post('tipen'));

    $datax = array();
    foreach ($data as $key) {
      $tbody = array();

      $no++;
      $tbody[] = "<div align='center'>".$no.".</div>";
      $tbody[] = $key['kode_loss_adjuster'];
      $tbody[] = $key['nama'];
      $tbody[] = $key['telp'];
      $tbody[] = $key['alamat'];
      if ($permisi[0] == 'true' || $action == '_') {
        $b1 = '<span style="cursor:pointer" class="mr-2 text-primary '.(count($data) > 1?'ttip':'').'" data-toggle="tooltip" data-placement="top" title="Ubah" onclick="ubahubah('.$key['id_loss_adjuster'].')"><i class="fas fa-pencil-alt fa-lg"></i></span>';
      }
      if ($permisi[1] == 'true' || $action == '_') {
        $b2 = '<span style="cursor:pointer" class="text-danger '.(count($data) > 1?'ttip':'').'" data-toggle="tooltip" data-placement="top" title="Hapus" onclick="deletedel('.$key['id_loss_adjuster'].')"><i class="far fa-trash-alt fa-lg"></i></span>';
      }
      $b3 = '<span style="cursor:pointer" class="text-dark '.(count($data) > 1?'ttip':'').'" data-toggle="tooltip" data-placement="top" title="Detail" onclick="detaild('.$key['id_loss_adjuster'].')"><i class="fas fa-info-circle fa-lg"></i></span>&nbsp;&nbsp;';
      $tbody[] = $b3.$b1.$b2;
      $datax[] = $tbody;
    }

    $output = [
      "draw"            => $_POST['draw'],
      "recordsTotal"    => $this->lost_adjuster->countalllostadj($this->input->post('tipen')),
      "recordsFiltered" => $this->lost_adjuster->countfilterlostadj($this->input->post('tipen')),
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
      $data['kode_loss_adjuster'] = $this->input->post('kdls');
      $data['nama'] = $this->input->post('nmla');
      $data['telp'] = $this->input->post('tlla');
      $data['alamat'] = $this->input->post('alla');
      $data['status'] = $this->input->post('stat');
      $data['id_negara']    = $this->input->post('idnega');
      $data['id_provinsi']  = $this->input->post('idprov');
      $data['id_kota']      = $this->input->post('idkab');
      $data['id_kecamatan'] = $this->input->post('idkec');
      $data['id_desa']      = $this->input->post('idkel');
      $data['add_time'] = date('Y-m-d H:i:s');
      $data['add_by'] = $this->session->userdata('sesi_id');

      $inputan = ['LOWER(nama)' => strtolower($this->input->post('nmla')),
                  'status'      => $this->input->post('stat')
                ];
            
      $cek = cek_duplicate_banyak('m_loss_adjuster', '', '', $inputan);

      if ($cek == 0) {
        $this->db->insert('m_loss_adjuster', $data);
        echo json_encode(['status' => "Berhasil", 'pesan' => 'Berhasil Menambahkan Data Loss Adjuster', 'altr' => 'success']);
      } else {
        echo json_encode(['status' => 'Gagal', 'pesan' => 'Data Loss Adjuster tersebut Sudah Ada', 'altr' =>'error', 'hasil' => '']);
      }
    }
  }

  public function show($id)
  {
    $this->db->where('id_loss_adjuster',$id);
    $data = $this->db->get('m_loss_adjuster')->result();
    echo json_encode($data);
  }

  public function detail($id)
  {
    $this->db->join('m_negara','m_negara.id_negara = m_loss_adjuster.id_negara','LEFT');
    $this->db->join('m_provinsi ','m_provinsi.id_provinsi = m_loss_adjuster.id_provinsi','LEFT');
    $this->db->join('m_kota','m_kota.id_kota = m_loss_adjuster.id_kota','LEFT');
    $this->db->join('m_kecamatan','m_kecamatan.id_kecamatan = m_loss_adjuster.id_kecamatan','LEFT');
    $this->db->join('m_desa','m_desa.id_desa = m_loss_adjuster.id_desa','LEFT');
    $this->db->where('id_loss_adjuster',$id);
    $data = $this->db->get('m_loss_adjuster')->result();
    echo json_encode($data);
  }

  public function edit($id)
  {
    $this->form_validation->set_rules($this->validcfg);
    if ($this->form_validation->run() == FALSE) {
      echo json_encode(['status' => 'Gagal', 'pesan' => 'Gagal Update, Ada Form yang kosong', 'altr' =>'warning']);
    } else {
      $data['nama'] = $this->input->post('nmla');
      $data['telp'] = $this->input->post('tlla');
      $data['alamat'] = $this->input->post('alla');
      $data['status'] = $this->input->post('stat');
      $data['id_negara']    = $this->input->post('idnega');
      $data['id_provinsi']  = $this->input->post('idprov');
      $data['id_kota']      = $this->input->post('idkab');
      $data['id_kecamatan'] = $this->input->post('idkec');
      $data['id_desa']      = $this->input->post('idkel');
      $data['add_time'] = date('Y-m-d H:i:s');
      $data['add_by'] = $this->session->userdata('sesi_id');

      $inputan = ['LOWER(nama)' => strtolower($this->input->post('nmla')),
                  'status'      => $this->input->post('stat')
                ];
            
      $cek = cek_duplicate_banyak('m_loss_adjuster', 'id_loss_adjuster', $id, $inputan);

      if ($cek == 0) {
        $this->db->where('id_loss_adjuster', $id);
        $this->db->update('m_loss_adjuster', $data);
        echo json_encode(['status' => "Berhasil", 'pesan' => 'Berhasil Mengubah Data Loss Adjuster', 'altr' => 'success']);
      } else {
        echo json_encode(['status' => 'Gagal', 'pesan' => 'Data Loss Adjuster tersebut Sudah Ada', 'altr' =>'error', 'hasil' => '']);
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
          $this->db->where(['id_user' => $key->id_user, 'flag_table' => 6]);
          $this->db->delete('m_user');
        }
      }
    }

    $this->db->where('id_loss_adjuster',$id);
		$this->db->delete('m_loss_adjuster');

    echo json_encode(['status' => 'sukses']);
  }
}

?>
