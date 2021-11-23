<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 *
 */
class Title_management extends CI_controller
{
  var $validcfg_title;
  var $validcfg_subtitle;
  var $validcfg_namem;

  public function __construct() {
    parent::__construct();
    $this->load->model('title_management/M_title_management','title');
    $this->load->model('title_management/M_subtitle_management','subtitle');
    $this->load->model('title_management/M_name_management','name');
    $this->load->library('form_validation');
    $this->validcfg_title = array(
      array('field' => 'timng', 'label' => 'Title Management', 'rules' => 'required'),
    );
    $this->validcfg_subtitle = array(
      array('field' => 'idtimng', 'label' => 'Title Management', 'rules' => 'required'),
      array('field' => 'subtimng', 'label' => 'Sub Title Management', 'rules' => 'required'),
    );
    $this->validcfg_namem = array(
      array('field' => 'idsbmng', 'label' => 'Sub Title Management', 'rules' => 'required'),
      array('field' => 'nmemng', 'label' => 'Nama Management', 'rules' => 'required'),
    );
    if($this->session->userdata('username') == "") {
      redirect(base_url(), 'refresh');
    }
  }

  public function admin($value='')
  {
    $data = [
      'title' => 'Title Management',
      'mn_title' => $this->title->list_title(),
      'mn_subtitle' => $this->subtitle->list_subtitle(),
      'role' => get_role($this->session->userdata('id_level_otorisasi'))
    ];
    $this->template->load('template/index', 'index', $data);
  }

  public function ajaxdatatitle($action)
  {
    $permisi = explode('_',$action);
    $b1 = ''; $b2 = '';

    $no   = $this->input->post('start');
    $data = $this->title->get_data_title();

    $datax = array();
    foreach ($data as $key) {
      $tbody = array();

      $no++;
      $tbody[] = "<div align='center'>".$no.".</div>";
      $tbody[] = $key['title_management'];
      if ($permisi[0] == 'true' || $action == '_') {
        $b1 = '<span style="cursor:pointer" class="mr-2 text-primary '.(count($data) > 1?'ttip':'').'" data-toggle="tooltip" data-placement="top" title="Ubah" onclick="ubahubah('.$key['id_title_management'].',1)"><i class="fas fa-pencil-alt fa-lg"></i></span>';
      }
      if ($permisi[1] == 'true' || $action == '_') {
        $b2 = '<span style="cursor:pointer" class="text-danger '.(count($data) > 1?'ttip':'').'" data-toggle="tooltip" data-placement="top" title="Hapus" onclick="deletedel('.$key['id_title_management'].',1)"><i class="far fa-trash-alt fa-lg"></i></span>';
      }
      $tbody[] = $b1.$b2;
      $datax[] = $tbody;
    }

    $output = [
      "draw"            => $_POST['draw'],
      "recordsTotal"    => $this->title->countalllisttitle(),
      "recordsFiltered" => $this->title->countfilterlisttitle(),
      "data"            => $datax
    ];
    echo json_encode($output);
  }

  public function ajaxdatasubtitle($action)
  {
    $permisi = explode('_',$action);
    $b1 = ''; $b2 = '';

    $no   = $this->input->post('start');
    $data = $this->subtitle->get_data_subtitle();

    $datax = array();
    foreach ($data as $key) {
      $tbody = array();

      $no++;
      $tbody[] = "<div align='center'>".$no.".</div>";
      $tbody[] = $key['title_management'];
      $tbody[] = $key['subtitle_management'];
      if ($permisi[0] == 'true' || $action == '_') {
        $b1 = '<span style="cursor:pointer" class="mr-2 text-primary '.(count($data) > 1?'ttip':'').'" data-toggle="tooltip" data-placement="top" title="Ubah" onclick="ubahubah('.$key['id_subtitle_management'].',2)"><i class="fas fa-pencil-alt fa-lg"></i></span>';
      }
      if ($permisi[1] == 'true' || $action == '_') {
        $b2 = '<span style="cursor:pointer" class="text-danger '.(count($data) > 1?'ttip':'').'" data-toggle="tooltip" data-placement="top" title="Hapus" onclick="deletedel('.$key['id_subtitle_management'].',2)"><i class="far fa-trash-alt fa-lg"></i></span>';
      }
      $tbody[] = $b1.$b2;
      $datax[] = $tbody;
    }

    $output = [
      "draw"            => $_POST['draw'],
      "recordsTotal"    => $this->subtitle->countalllistsubtitle(),
      "recordsFiltered" => $this->subtitle->countfilterlistsubtitle(),
      "data"            => $datax
    ];
    echo json_encode($output);
  }

  public function ajaxdataname($action)
  {
    $permisi = explode('_',$action);
    $b1 = ''; $b2 = '';

    $no   = $this->input->post('start');
    $data = $this->name->get_data_name();

    $datax = array();
    foreach ($data as $key) {
      $tbody = array();

      $no++;
      $tbody[] = "<div align='center'>".$no.".</div>";
      $tbody[] = $key['title_management'];
      $tbody[] = $key['subtitle_management'];
      $tbody[] = $key['name_management'];
      if ($permisi[0] == 'true' || $action == '_') {
        $b1 = '<span style="cursor:pointer" class="mr-2 text-primary '.(count($data) > 1?'ttip':'').'" data-toggle="tooltip" data-placement="top" title="Ubah" onclick="ubahubah('.$key['id_name_management'].',3)"><i class="fas fa-pencil-alt fa-lg"></i></span>';
      }
      if ($permisi[1] == 'true' || $action == '_') {
        $b2 = '<span style="cursor:pointer" class="text-danger '.(count($data) > 1?'ttip':'').'" data-toggle="tooltip" data-placement="top" title="Hapus" onclick="deletedel('.$key['id_name_management'].',3)"><i class="far fa-trash-alt fa-lg"></i></span>';
      }
      $tbody[] = $b1.$b2;
      $datax[] = $tbody;
    }

    $output = [
      "draw"            => $_POST['draw'],
      "recordsTotal"    => $this->name->countalllistname(),
      "recordsFiltered" => $this->name->countfilterlistname(),
      "data"            => $datax
    ];
    echo json_encode($output);
  }

  public function add_title()
  {
    $this->form_validation->set_rules($this->validcfg_title);
    if ($this->form_validation->run() == FALSE) {
      echo json_encode(['status' => 'Gagal', 'pesan' => 'Form Tidak di isi', 'altr' =>'warning', 'list' => '']);
    } else {
      $data['title_management'] = $this->input->post('timng');
      $data['add_time'] = date('Y-m-d');
      $data['add_by'] = $this->session->userdata('sesi_id');
      if (cek_duplicate('m_title_management', 'title_management', '', '', $this->input->post('timng')) == 0) {
        $this->db->insert('m_title_management', $data);
        $data = $this->db->insert_id();
        echo json_encode(['status' => "Berhasil", 'pesan' => 'Berhasil Menambahkan Title Management', 'altr' => 'success', 'list' => $data]);
      } else {
        echo json_encode(['status' => "Gagal", 'pesan' => 'Title Management Tersebut sudah Ada', 'altr' => 'error', 'list' => '']);
      }
    }
  }

  public function add_subtitle()
  {
    $this->form_validation->set_rules($this->validcfg_subtitle);
    if ($this->form_validation->run() == FALSE) {
      echo json_encode(['status' => 'Gagal', 'pesan' => 'Ada form yang Tidak di isi', 'altr' =>'warning', 'list' => '']);
    } else {
      $data['id_title_management'] = $this->input->post('idtimng');
      $data['subtitle_management'] = $this->input->post('subtimng');
      $data['add_time'] = date('Y-m-d');
      $data['add_by'] = $this->session->userdata('sesi_id');

      $inputan = ['LOWER(subtitle_management)'  => strtolower($this->input->post('subtimng')),
                  'id_title_management'         => $this->input->post('idtimng')
                  ];
      
      $cek = cek_duplicate_banyak('m_subtitle_management', '', '', $inputan);

      if ($cek == 0) {
        $this->db->insert('m_subtitle_management', $data);
        $data = $this->db->insert_id();
        echo json_encode(['status' => "Berhasil", 'pesan' => 'Berhasil Menambahkan Subtitle Management', 'altr' => 'success', 'list' => $data]);
      } else {
        echo json_encode(['status' => "Gagal", 'pesan' => 'Subtitle Management Tersebut sudah Ada', 'altr' => 'error', 'list' => '']);
      }
    }
  }

  public function add_name()
  {
    $this->form_validation->set_rules($this->validcfg_namem);
    if ($this->form_validation->run() == FALSE) {
      echo json_encode(['status' => 'Gagal', 'pesan' => 'Ada form yang Tidak di isi', 'altr' =>'warning', 'list' => '']);
    } else {
      $data['id_subtitle_management'] = $this->input->post('idsbmng');
      $data['name_management'] = $this->input->post('nmemng');
      $data['add_time'] = date('Y-m-d');
      $data['add_by'] = $this->session->userdata('sesi_id');

      $inputan = ['LOWER(name_management)'  => strtolower($this->input->post('nmemng')),
                  'id_subtitle_management'  => $this->input->post('idsbmng')
                  ];
      
      $cek = cek_duplicate_banyak('m_name_management', '', '', $inputan);

      if ($cek == 0) {
        $this->db->insert('m_name_management', $data);
        $data = $this->db->insert_id();
        echo json_encode(['status' => "Berhasil", 'pesan' => 'Berhasil Menambahkan Name Management', 'altr' => 'success', 'list' => $data]);
      } else {
        echo json_encode(['status' => "Gagal", 'pesan' => 'Name Management Tersebut sudah Ada', 'altr' => 'error', 'list' => '']);
      }
    }
  }

  public function showtitle($id)
  {
    $data = $this->title->titlebyid($id);
    echo json_encode($data);
  }

  public function showsubtitle($id)
  {
    $data = $this->subtitle->subtitlebyid($id);
    echo json_encode($data);
  }

  public function subtitlebyidtitle($id)
  {
    $this->db->where('id_title_management', $id);
    $this->db->order_by("subtitle_management", "asc");
    $data = $this->db->get('m_subtitle_management')->result();
    echo json_encode($data);
  }

  public function showname($id)
  {
    $data = $this->name->namebyid($id);
    echo json_encode($data);
  }

  public function edit_title($id)
  {
    $this->form_validation->set_rules($this->validcfg_title);
    if ($this->form_validation->run() == FALSE) {
      echo json_encode(['status' => 'Gagal', 'pesan' => 'Form Tidak di isi', 'altr' =>'warning']);
    } else {
      $data['title_management'] = $this->input->post('timng');
      $data['add_time'] = date('Y-m-d');
      $data['add_by'] = $this->session->userdata('sesi_id');
      if (cek_duplicate('m_title_management', 'title_management', 'id_title_management', $id, $this->input->post('timng')) == 0) {
        $this->db->where('id_title_management', $id);
        $this->db->update('m_title_management', $data);
        echo json_encode(['status' => "Berhasil", 'pesan' => 'Berhasil Mengubah Title Management', 'altr' => 'success']);
      } else {
        echo json_encode(['status' => "Gagal", 'pesan' => 'Title Management Tersebut sudah Ada', 'altr' => 'error']);
      }
    }
  }

  public function edit_subtitle($id)
  {
    $this->form_validation->set_rules($this->validcfg_subtitle);
    if ($this->form_validation->run() == FALSE) {
      echo json_encode(['status' => 'Gagal', 'pesan' => 'Ada form yang Tidak di isi', 'altr' =>'warning']);
    } else {
      $data['id_title_management'] = $this->input->post('idtimng');
      $data['subtitle_management'] = $this->input->post('subtimng');
      $data['add_time'] = date('Y-m-d');
      $data['add_by'] = $this->session->userdata('sesi_id');

      $inputan = ['LOWER(subtitle_management)'  => strtolower($this->input->post('subtimng')),
                  'id_title_management'         => $this->input->post('idtimng')
                  ];
      
      $cek = cek_duplicate_banyak('m_subtitle_management', 'id_subtitle_management', $id, $inputan);
      
      if ($cek == 0) {
        $this->db->where('id_subtitle_management', $id);
        $this->db->update('m_subtitle_management', $data);
        echo json_encode(['status' => "Berhasil", 'pesan' => 'Berhasil Mengubah Subtitle Management', 'altr' => 'success']);

      } else {
        echo json_encode(['status' => "Gagal", 'pesan' => 'Subtitle Management Tersebut sudah Ada', 'altr' => 'error']);
      }
    }
  }

  public function edit_name($id)
  {
    $this->form_validation->set_rules($this->validcfg_namem);
    if ($this->form_validation->run() == FALSE) {
      echo json_encode(['status' => 'Gagal', 'pesan' => 'Ada form yang Tidak di isi', 'altr' =>'warning']);
    } else {
      $data['id_subtitle_management'] = $this->input->post('idsbmng');
      $data['name_management'] = $this->input->post('nmemng');
      $data['add_time'] = date('Y-m-d');
      $data['add_by'] = $this->session->userdata('sesi_id');

      $inputan = ['LOWER(name_management)'  => strtolower($this->input->post('nmemng')),
                  'id_subtitle_management'  => $this->input->post('idsbmng')
                  ];
      
      $cek = cek_duplicate_banyak('m_name_management', 'id_name_management', $id, $inputan);

      if ($cek == 0) {
        $this->db->where('id_name_management', $id);
        $this->db->update('m_name_management', $data);
        echo json_encode(['status' => "Berhasil", 'pesan' => 'Berhasil Mengubah Name Management', 'altr' => 'success']);
      } else {
        echo json_encode(['status' => "Gagal", 'pesan' => 'Name Management Tersebut sudah Ada', 'altr' => 'error']);
      }
    }
  }

  public function remove_title($id)
  {
    $this->db->where('id_title_management', $id);
    $this->db->delete('m_title_management');

    echo json_encode(['status' => 'sukses']);
  }

  public function remove_subtitle($id)
  {
    $this->db->where('id_subtitle_management', $id);
    $this->db->delete('m_subtitle_management');

    echo json_encode(['status' => 'sukses']);
  }

  public function remove_name($id)
  {
    $this->db->where('id_name_management', $id);
    $this->db->delete('m_name_management');

    echo json_encode(['status' => 'sukses']);
  }
}

?>
