<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 *
 */
class User extends CI_controller
{
  var $validcfg;

  public function __construct() {
    parent::__construct();
    $this->load->model('M_user','user');
    $this->load->model('karyawan/M_karyawan', 'karyawan');
    $this->load->model('level_user/M_level_user', 'level_user');
    $this->load->model('level_otorisasi/M_level_otorisasi', 'level_otorisasi');
    $this->load->model('pengguna_tertanggung/M_pengguna_tertanggung', 'pengguna_ptg');
    $this->load->helper('inputtype_helper');
    $this->load->library('form_validation');
    $this->validcfg = array(
      array('field' => 'lvotor', 'label' => 'Level Otorisasi', 'rules' => 'required'),
      array('field' => 'usernm', 'label' => 'Username', 'rules' => 'required'),
      array('field' => 'passwd', 'label' => 'Password', 'rules' => 'required')
    );
    if($this->session->userdata('username') == "") {
      redirect(base_url(), 'refresh');
    }
  }

  public function admin($value='')
  {
    // var_dump(bredcumx());

    $list1 = $this->pengguna_ptg->get_data_order('m_sob', 'sob', 'asc')->result_array();

    $option_cdb = "<option value=''>Pilih</option>";

    foreach ($list1 as $l) {

        $list2 = $this->pengguna_ptg->get_ft_tertanggung($l['id_sob'])->num_rows();

        if ($list2 == 0) {
            $hid = "hidden"; 
        } else {
            $hid = "";
        }

        $option_cdb .= "<option value='".$l['id_sob']."' $hid>".$l['sob']."</option>";
        
    }

    $data = [
      'title'           => 'User Data',
      'list_karyawan'   => $this->karyawan->allkaryawan(),
      'level_user'      => $this->level_user->alllvlusr(),
      'level_otorisasi' => $this->level_otorisasi->alllvloto(),
      'role'            => get_role($this->session->userdata('id_level_otorisasi')),
      'cdb'             => $this->user->get_data_order('m_sob', 'sob', 'asc')->result_array(),
      'option_cdb_ttg'  => $option_cdb
    ];
    $this->template->load('template/index', 'index', $data);
  }

  // 30-09-2021
  public function get_data_sob()
  {
    $id   = $this->input->post('id_sob'); 
    $isi  = $this->input->post('isi_id_pengguna_tertanggung'); 

    $nm_sob = "";

    $option = "<option value=''>Pilih</option>";

    if ($id == '') {

      echo json_encode(['option_set_cdb' => $option, 'nama_sob'  => $nm_sob]);
      exit();
      
    }
    
    $ardata = array();
    $this->db->where('id_sob', $id);
    $nme = $this->db->get('m_sob')->row_array();

    switch ($id) {
      case 1:
        $this->db->select('id_asuransi as id, nama_asuransi as nama, telp');
        $this->db->order_by('nama', 'asc');
        $ardata = $this->db->get('m_asuransi')->result_array();
        $nm_sob = "Asuransi";
        break;
      case 2:
        $this->db->select('id_nasabah as id, nama_nasabah as nama, telp');
        $this->db->order_by('nama', 'asc');
        $ardata = $this->db->get('m_nasabah')->result_array();
        $nm_sob = "Insured";
        break;
      case 3:
        $this->db->select('id_agent as id, nama, telp');
        $this->db->order_by('nama', 'asc');
        $ardata = $this->db->get('m_agent')->result_array();
        $nm_sob = "Agent";
        break;
      case 5:
        $this->db->select('id_business_partner as id, nama, telp');
        $this->db->order_by('nama', 'asc');
        $ardata = $this->db->get('m_business_partner')->result_array();
        $nm_sob = "Business Partner";
        break;
      case 4:
        $this->db->select('id_direct as id, nama, telp');
        $this->db->order_by('nama', 'asc');
        $ardata = $this->db->get('m_direct')->result_array();
        $nm_sob = "Direct";
        break;
      case 6:
        $this->db->select('id_loss_adjuster as id, nama, telp');
        $this->db->order_by('nama', 'asc');
        $ardata = $this->db->get('m_loss_adjuster')->result_array();
        $nm_sob = "Lost Adjuster";
        break;
      default:
        $ardata = [];
    }

    // $nm_sob = $nme['sob'];

    $option = "<option value=''>Pilih ".$nm_sob."</option>";

    foreach ($ardata as $d) {

      if ($d['id'] == $isi) {
        $sel = 'selected';
      } else {
        $sel = "";
      }
      
      $option .= "<option value='".$d['id']."'>".$d['nama']."</option>";
    }

    echo json_encode(['option_set_cdb' => $option, 'nama_sob'  => $nm_sob]);
  }

  // 30-09-2021
  public function get_data_pengguna_ptg()
  {
    $id_tertanggung = $this->input->post('id_tertanggung');

    $option = "<option value=''>Pilih</option>";
    
    if ($id_tertanggung != '') {
      // $list = $this->user->cari_data_order('pengguna_tertanggung', ['id_insured' => $id_tertanggung], 'nama', 'asc')->result_array();
      $list = $this->user->cari_user_pengguna_tertanggung($id_tertanggung)->result_array();

      foreach ($list as $l) {
        $option .= "<option value='".$l['id_pengguna_tertanggung']."'>".$l['nama']."</option>";
      }
    }

    echo json_encode(['option' => $option]);
  }

  // 1-11-2021
  public function get_induk_kumpulan()
  {
    $tertanggung    = $this->input->post('tertanggung');    
    $ft_tertanggung = $this->input->post('ft_tertanggung');

    $option = "<option>Pilih</option>";

    if ($tertanggung == '') {
    
      echo json_encode(['list_ik' => $option]);
      exit();
    }
    
    $list = $this->user->cari_data_order('relasi_induk_kumpulan', ['tertanggung' => $tertanggung, 'ft_tertanggung' => $ft_tertanggung], 'ft_tertanggung', 'asc')->result_array();

    foreach ($list as $l) {

      $option .= "<option value='".$l['id']."'>".substr(getdbtable($l['ft_tertanggung']),2,strlen(getdbtable($l['ft_tertanggung'])))."-".$this->penamaan2($l['induk_kumpulan'], $l['ft_induk_kumpulan'])."</option>";
      
    }
    
    echo json_encode(['list_ik' => $option]);
    
  }

  public function penamaan2($idn, $flg)
  {
    $has = getdbtable($flg);
    $inid = 'id_'.substr($has,2,strlen($has));
    $this->db->where('table_name', $has);
    $data = $this->db->get('information_schema.columns')->result();
    $fnme = array();
    foreach ($data as $key => $value) {
      if ($value->column_name == 'nama_'.substr($has,2,strlen($has)) || $value->column_name == 'nama') {
        $dat['nmny'] = $value->column_name;
        $fnme[] = $dat;
      }
    }
    $this->db->select($fnme[0]['nmny'].' as nama');
    $this->db->where($inid, $idn);
    $dat = $this->db->get($has)->result_array();
    $hsl = $dat[0]['nama'];

    return $hsl;
  }

  public function ajaxdata($action)
  {
    $permisi = explode('_',$action);
    $b1 = ''; $b2 = '';

    $no   = $this->input->post('start');
    $data = $this->user->get_data_alluser();

    $datax = array();
    foreach ($data as $key) {
      $tbody = array();

      if ($key['id_pengguna_tertanggung'] != '') {
        $id_pgn = $key['id_pengguna_tertanggung'];
      } elseif ($key['id_induk_kumpulan'] != '') {
        $id_pgn = $key['induk_kumpulan'];
      } else {
        $id_pgn = $key['idkr'];
      }

      if ($key['ft_induk_kumpulan'] != '') {
        $fg_tb = $key['ft_induk_kumpulan'];
      } else {
        $fg_tb = $key['flag_table'];
      } 

      $no++;
      $tbody[] = "<div align='center'>".$no.".</div>";
      $tbody[] = $key['level_user'];
      $tbody[] = $key['level_otorisasi'];
      $tbody[] = $this->penamaan($id_pgn, $key['lvus'], $fg_tb);
      $tbody[] = $key['username'];
      $tbody[] = $key['level_user'] == "Broker"?$key['jabatan']:'-';
      if ($permisi[0] == 'true' || $action == '_') {
        $b1 = '<span style="cursor:pointer" class="mr-2 text-primary '.(count($data) > 1?'ttip':'').'" data-toggle="tooltip" data-placement="top" title="Ubah" onclick="ubahubah('.$key['id_user'].')"><i class="fas fa-pencil-alt fa-lg"></i></span>';
      }
      if ($permisi[1] == 'true' || $action == '_') {
        $b2 = '<span style="cursor:pointer" class="text-danger '.(count($data) > 1?'ttip':'').'" data-toggle="tooltip" data-placement="top" title="Hapus" onclick="deletedel('.$key['id_user'].')"><i class="far fa-trash-alt fa-lg"></i></span>';
      }
      $tbody[] = $b1.$b2;
      $datax[] = $tbody;
    }

    $output = [
      "draw"            => $_POST['draw'],
      "recordsTotal"    => $this->user->countalluser(),
      "recordsFiltered" => $this->user->countfilteruser(), 
      "data"            => $datax
    ];
    echo json_encode($output);
  }

  public function otorisasibroker($idj)
  {
    $this->db->join('level_otorisasi', 'level_otorisasi.id_level_otorisasi = role.id_level_otorisasi');
    $this->db->where('role.id_jabatan', $idj);
    $data = $this->db->get('role')->result();
    return $data[0]->level_otorisasi;
  }

  public function penamaan($idn, $lvl, $flg)
  {
    $hsl = '';
    if ($flg != null && $flg != '') {

      if ($idn == null) {
        $this->db->where('id_level_user', $lvl);
        $dtlv = $this->db->get('level_user')->result_array();
        switch ($dtlv[0]['level_user']) {
          case 'Broker':
            $this->db->where('id_karyawan', $idn);
            $dat = $this->db->get('m_karyawan')->result_array();
            $hsl = $dat[0]['nama_karyawan'];
          break;
          case 'Asuransi':
            $this->db->where('id_asuransi', $idn);
            $dat = $this->db->get('m_asuransi')->result_array();
            $hsl = $dat[0]['nama_asuransi'];
          break;
          case 'Pengguna Tertanggung':
            $this->db->where('id_pengguna_tertanggung', $idn);
            $dat = $this->db->get('pengguna_tertanggung')->result_array();
            // $this->db->where('id_nasabah', $idn);
            // $dat = $this->db->get('m_nasabah')->result_array();
            // $hsl = $dat[0]['nama_nasabah'];
            $hsl = $dat[0]['nama'];
          break;
        }
        
      } else {
        $has = getdbtable($flg);
        $inid = 'id_'.substr($has,2,strlen($has));
        $this->db->where('table_name', $has);
        $data = $this->db->get('information_schema.columns')->result();
        $fnme = array();
        foreach ($data as $key => $value) {
          if ($value->column_name == 'nama_'.substr($has,2,strlen($has)) || $value->column_name == 'nama') {
            $dat['nmny'] = $value->column_name;
            $fnme[] = $dat;
          }
        }
        $this->db->select($fnme[0]['nmny'].' as nama');
        $this->db->where($inid, $idn);
        $dat = $this->db->get($has)->result_array();
        $hsl = $dat[0]['nama'];
      }
      
      
    } else {
      if ($idn != null) {
        $this->db->where('id_level_user', $lvl);
        $dtlv = $this->db->get('level_user')->result_array();
        switch ($dtlv[0]['level_user']) {
          case 'Broker':
            $this->db->where('id_karyawan', $idn);
            $dat = $this->db->get('m_karyawan')->result_array();
            $hsl = $dat[0]['nama_karyawan'];
          break;
          case 'Asuransi':
            $this->db->where('id_asuransi', $idn);
            $dat = $this->db->get('m_asuransi')->result_array();
            $hsl = $dat[0]['nama_asuransi'];
          break;
          case 'Pengguna Tertanggung':
            $this->db->where('id_pengguna_tertanggung', $idn);
            $dat = $this->db->get('pengguna_tertanggung')->result_array();
            // $this->db->where('id_nasabah', $idn);
            // $dat = $this->db->get('m_nasabah')->result_array();
            // $hsl = $dat[0]['nama_nasabah'];
            $hsl = $dat[0]['nama'];
          break;
        }
      }
    }
    return $hsl;
  }

  public function getfromdb($dbdb)
  {
    $has = getdbtable($dbdb);
    $inid = 'id_'.substr($has,2,strlen($has));
    $this->db->where('table_name', $has);
    $data = $this->db->get('information_schema.columns')->result();
    $fnme = array();
    foreach ($data as $key => $value) {
      if ($value->column_name == 'nama_'.substr($has,2,strlen($has)) || $value->column_name == 'nama') {
        $dat['nmny'] = $value->column_name;
        $fnme[] = $dat;
      }
    }
    $this->db->select($inid.' as id, '.$fnme[0]['nmny'].' as nama');
    $this->db->order_by($fnme[0]['nmny'], 'asc');
    $data = $this->db->get($has)->result();
    echo json_encode($data);
  }

  public function add()
  {
    $this->form_validation->set_rules($this->validcfg);
    if ($this->form_validation->run() == FALSE) {
      echo json_encode([
        'judul' => 'Gagal',
        'status' => 'Data User Gagal di Tambahkan, Ada Form yang kosong',
        'tipe' => 'warning'
      ]);
    } else {
      // $pil_tertanggung  = $this->input->post('pil_tertanggung');
      $uscek            = $this->user->cekusername($this->input->post('usernm'));

      if ($uscek == 0) {
        $id_level = $this->user->llus($this->input->post('lvlusr'));
        if ($this->input->post('fltabl') == "") {
          if ($this->input->post('lvlusr') == "Induk Kumpulan") {
            $this->db->where(['id_induk_kumpulan' => $this->input->post('id_induk_kumpulan'), 'id_level_user' => $id_level, 'id_level_otorisasi' => $this->input->post('lvotor')]);
          } elseif ($this->input->post('lvlusr') == "Pengguna Tertanggung") {
            $this->db->where(['id_pengguna_tertanggung' => $this->input->post('pil_pgn_tertanggung'), 'id_level_user' => $id_level, 'id_level_otorisasi' => $this->input->post('lvotor')]);
          } else {
            $this->db->where(['id_karyawan' => $this->input->post('idkywn'), 'id_level_user' => $id_level, 'id_level_otorisasi' => $this->input->post('lvotor')]);
          }
        } else {
          $this->db->where(['id_karyawan' => $this->input->post('idkywn'), 'flag_table' => $this->input->post('fltabl'), 'id_level_otorisasi' => $this->input->post('lvotor')]);
        }
        $cekk = $this->db->get('m_user')->num_rows();
        if ($cekk == 0) {
          $data['kode_user']            = codegenerate('m_user','USR', 'user', 'R');

          // if ($pil_tertanggung != '') {
          //   $data['id_pengguna_tertanggung']  = $this->input->post('idkywn');
          // } else {
          //   $data['id_karyawan']              = $this->input->post('idkywn');
          // }

          if ($this->input->post('idkywn') != "") {
            $data['id_karyawan']  = $this->input->post('idkywn');
          }

          $data['id_level_user']        = $id_level;
          if ($this->input->post('fltabl') != "") {
            $data['flag_table']         = $this->input->post('fltabl');
          }
          if ($this->input->post('lvlusr') == "Induk Kumpulan") {
            $data['id_induk_kumpulan']         = $this->input->post('id_induk_kumpulan');
          }
          if ($this->input->post('lvlusr') == "Pengguna Tertanggung") {
            $data['id_pengguna_tertanggung'] = $this->input->post('pil_pgn_tertanggung');
          }
          $data['username']             = $this->input->post('usernm');
          $data['password']             = password_hash($this->input->post('passwd'), PASSWORD_DEFAULT);
          $data['id_level_otorisasi']   = $this->input->post('lvotor');
          $data['add_time']             = date('Y-m-d H:i:s', now('Asia/Jakarta'));
          $data['add_by']               = $this->session->userdata('sesi_id');
          if (duplicatecek('m_user', $data) == 0) {
            $this->db->insert('m_user', $data);
            echo json_encode([
              'judul' => 'Berhasil',
              'status' => 'Data User Berhasil di Tambahkan',
              'tipe' => 'success'
            ]);
          } else {
            echo json_encode([
              'judul' => 'Gagal',
              'status' => 'Data User Tersebut Sudah Ada',
              'tipe' => 'error'
            ]);
          }
        } else {
          echo json_encode([
            'judul' => 'Gagal',
            'status' => 'Data User Gagal di Tambahkan, dikarenakan pengguna tersebut sudah Memiliki data User',
            'tipe' => 'warning'
          ]);
        }
      } else {
        echo json_encode([
          'judul' => 'Gagal',
          'status' => 'Username sudah ada, harap ganti!',
          'tipe' => 'warning'
        ]);
      }
    }
  }

  // 04-09-2021
  public function set_pengguna_ptg()
  {
    $flag_table = $this->input->post('flag_table');    
    $id_pgn_ttg = $this->input->post('id_pgn_ttg');    
    $id_insured = $this->input->post('id_insured');    

    switch ($flag_table) {
      case 1:
        $this->db->select('id_asuransi as id, nama_asuransi as nama, telp');
        $this->db->order_by('nama', 'asc');
        $ardata = $this->db->get('m_asuransi')->result_array();
        $nm_sob = "Asuransi";
        break;
      case 2:
        $this->db->select('id_nasabah as id, nama_nasabah as nama, telp');
        $this->db->order_by('nama', 'asc');
        $ardata = $this->db->get('m_nasabah')->result_array();
        $nm_sob = "Insured";
        break;
      case 3:
        $this->db->select('id_agent as id, nama, telp');
        $this->db->order_by('nama', 'asc');
        $ardata = $this->db->get('m_agent')->result_array();
        $nm_sob = "Agent";
        break;
      case 5:
        $this->db->select('id_business_partner as id, nama, telp');
        $this->db->order_by('nama', 'asc');
        $ardata = $this->db->get('m_business_partner')->result_array();
        $nm_sob = "Business Partner";
        break;
      case 4:
        $this->db->select('id_direct as id, nama, telp');
        $this->db->order_by('nama', 'asc');
        $ardata = $this->db->get('m_direct')->result_array();
        $nm_sob = "Direct";
        break;
      case 6:
        $this->db->select('id_loss_adjuster as id, nama, telp');
        $this->db->order_by('nama', 'asc');
        $ardata = $this->db->get('m_loss_adjuster')->result_array();
        $nm_sob = "Lost Adjuster";
        break;
      default:
        $ardata = [];
    }

    // $nm_sob = $nme['sob'];

    $list_det_cdb = "<option value=''>Pilih ".$nm_sob."</option>";

    foreach ($ardata as $d) {

      if ($id_pgn_ttg == $d['id']) {
        $sel = 'selected';
      } else {
        $sel = "";
      }
      
      $list_det_cdb .= "<option value='".$d['id']."' $sel>".$d['nama']."</option>";
    }

    echo json_encode(['list_det_cdb' => $list_det_cdb]);
  }

  // 08-11-2021
  public function get_pgn_tertanggung()
  {
    $id_induk_kumpulan = $this->input->post('id_induk_kumpulan');
    
    $list = $this->user->cari_data_order('pengguna_tertanggung', ['id_induk_kumpulan' => $id_induk_kumpulan], 'nama', 'asc')->result_array();

    echo json_encode($list);
  }

  public function show($id)
  {
    $cari = $this->user->cari_data('m_user', ['id_user' => $id])->row_array();

    $id_insured = "";

    if ($cari['id_pengguna_tertanggung'] != '') {

      // $pgn = $this->user->cari_data('pengguna_tertanggung', ['id_pengguna_tertanggung' => $cari['id_pengguna_tertanggung']])->row_array();
      // $id_insured = $pgn['id_insured'];

      $this->db->join('pengguna_tertanggung p', 'p.id_pengguna_tertanggung = m_user.id_pengguna_tertanggung', 'inner'); 
      $this->db->join('relasi_induk_kumpulan r', 'r.id = p.id_induk_kumpulan', 'inner');   
      
    }

    if ($cari['id_induk_kumpulan'] != '') {
      $this->db->join('relasi_induk_kumpulan r', 'r.id = m_user.id_induk_kumpulan', 'inner');     
    }
    
    $this->db->join('level_user','level_user.id_level_user = m_user.id_level_user');
    $this->db->where('id_user', $id);
    $data = $this->db->get('m_user')->row_array();

    echo json_encode(['list' => $data, 'id_insured' => $id_insured]);
  }

  public function getlistnya($dbdb)
  {
    $ddb = ''; $order = '';
    switch ($dbdb) {
      case 0:
        $order = 'nama_karyawan';
        $ddb = 'm_karyawan';
        break;
      case 1:
        $order = 'nama_asuransi';
        $ddb = 'm_asuransi';
        break;
      case 3:
        $order = 'nama';
        $ddb = 'pengguna_tertanggung';
        // $order = 'nama_nasabah';
        // $ddb = 'm_nasabah';
        break;
    }

    if ($dbdb == 3) {
      $this->db->order_by($order, 'asc');

      $this->db->join('m_nasabah as t', "t.id_nasabah = $ddb.id_insured", 'inner');
      // $this->db->where("$ddb.nama !=", "dsds");
    
      $data = $this->db->get('pengguna_tertanggung')->result();
      echo json_encode($data);
    } else {
      $this->db->order_by($order, 'asc');
      $data = $this->db->get($ddb)->result();
      echo json_encode($data);
    }
    
  }

  public function getlistoto()
  {
    $dbb = "";
    if ($this->input->post('lvl') == 'Broker') {
      $this->db->select('level_otorisasi.*');
      $this->db->join('m_jabatan','m_karyawan.id_jabatan = m_jabatan.id_jabatan');
      $this->db->join('role','m_jabatan.id_jabatan = role.id_jabatan');
      $this->db->join('level_otorisasi','role.id_level_otorisasi = level_otorisasi.id_level_otorisasi');
      $this->db->where('m_karyawan.id_karyawan', $this->input->post('idp'));
      $this->db->order_by("level_otorisasi.level_otorisasi", "asc");
      $ckz = $this->db->get('m_karyawan')->result();

      // $dbb = $ckz;
      if (count($ckz) != 0) {
        $dbb = $ckz;
      } else {
        $this->db->select('level_otorisasi.*');
        $this->db->join('level_user','level_otorisasi.id_level_user = level_user.id_level_user');
        $this->db->where('level_user.level_user',$this->input->post('lvl'));
        $this->db->order_by("level_otorisasi.level_otorisasi", "asc");
        $dbb = $this->db->get('level_otorisasi')->result();
      }
    } else {
      $this->db->select('level_otorisasi.*');
      $this->db->join('level_user','level_otorisasi.id_level_user = level_user.id_level_user');
      $this->db->where('level_user.level_user',$this->input->post('lvl'));
      $this->db->order_by("level_otorisasi.level_otorisasi", "asc");
      $dbb = $this->db->get('level_otorisasi')->result();
    }
    echo json_encode($dbb);
  }

  public function edit($id)
  {
    $list_edit = $this->db->get_where('m_user', ['id_user' => $id])->row_array();
    
    $this->form_validation->set_rules($this->validcfg);
    if ($this->form_validation->run() == FALSE) {
      echo json_encode([
        'judul' => 'Gagal',
        'status' => 'Ada Form yang Kosong',
        'tipe' => 'warning'
      ]);

      exit();
    } else {
    }
    
    $uscek = $this->user->cekusername_edit($list_edit['username'],$this->input->post('usernm'));

    if ($uscek == 'sama') {

      echo json_encode([
        'judul' => 'Gagal',
        'status' => 'Username sudah ada, harap ganti!',
        'tipe' => 'warning'
      ]);

      exit();

    } else {
      
    }

    if ($this->input->post('passwd') != "") {

      if ($this->input->post('lvlusr') == "Induk Kumpulan") {
        $data['id_induk_kumpulan']         = $this->input->post('id_induk_kumpulan');
      }
      if ($this->input->post('lvlusr') == "Pengguna Tertanggung") {
        $data['id_pengguna_tertanggung'] = $this->input->post('pil_pgn_tertanggung');
      }
      
      if ($this->input->post('fltabl') != "") {
        $data['flag_table']   = $this->input->post('fltabl');
      }
      if ($this->input->post('idkywn') != '') {
        $data['id_karyawan']    = $this->input->post('idkywn');
      }
      // $data['id_level_user']  = $this->user->llus($this->input->post('lvlusr'));
      $data['username']       = $this->input->post('usernm');
      $this->db->where('id_user', $id);
      $get_pas = $this->db->get('m_user')->result();
      if ($this->input->post('passwd') == $get_pas[0]->password) {
        $data['password']     = $this->input->post('passwd');
      } else {
        $data['password']     = password_hash($this->input->post('passwd'), PASSWORD_DEFAULT);
      }
      $data['id_level_otorisasi'] = $this->input->post('lvotor');
      $data['add_time']       = date('Y-m-d');
      $data['add_by']         = $this->session->userdata('sesi_id');
      $this->db->where('id_user', $id);
      $this->db->update('m_user', $data);
      echo json_encode([
        'judul' => 'Berhasil',
        'status' => 'Data berhasil Diubah',
        'tipe' => 'success'
      ]);
    } else {
      echo json_encode([
        'judul' => 'Gagal',
        'status' => 'Password Harus diisi',
        'tipe' => 'warning'
      ]);
    }
  }

  public function remove($id)
  {
    $this->db->where('id_user', $id);
    $this->db->delete('m_user');

    echo json_encode(['status' => 'sukses']);
  }
}

?>
