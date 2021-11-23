<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 *
 */
class M_user extends CI_Model
{
  function __construct() {
    parent::__construct();
  }
  
  // 30-09-2021
  public function get_data_order($tabel, $field, $order)
  {
    $this->db->order_by($field, $order);
    return $this->db->get($tabel);
  }

  // 30-09-2021
  public function cari_data_order($tabel, $where, $field, $order)
  {
    $this->db->order_by($field, $order);
    return $this->db->get_where($tabel, $where);
  }

  public function cari_data($tabel, $where)
  {
    return $this->db->get_where($tabel, $where);
  }

  var $kolom_order_user = [null,'level_user.level_user','level_otorisasi.level_otorisasi',null,'m_user.username','m_jabatan.jabatan'];
  var $kolom_cari_user  = ['LOWER(m_user.username)', 'LOWER(m_jabatan.jabatan)', 'LOWER(m_karyawan.nama_karyawan)','LOWER(level_otorisasi.level_otorisasi)','LOWER(level_user.level_user)'];
  var $order_user       = ['m_user.id_user' => 'desc'];

  public function get_data_alluser()
  {
    $this->_get_data_alluser();
    if ($this->input->post('length') != -1) {
      $this->db->limit($this->input->post('length'), $this->input->post('start'));
    }
    return $this->db->get()->result_array();
  }

  public function _get_data_alluser()
  {
    $this->db->select('m_user.id_user, m_user.id_karyawan as idkr, m_user.id_level_user as lvus, m_user.flag_table, level_user.*, level_otorisasi.level_otorisasi, m_karyawan.nama_karyawan, m_user.username, m_jabatan.jabatan, m_karyawan.id_jabatan, m_user.id_pengguna_tertanggung');
    $this->db->from('m_user');
    $this->db->join('m_karyawan', 'm_user.id_karyawan = m_karyawan.id_karyawan', 'LEFT');
    $this->db->join('m_jabatan', 'm_jabatan.id_jabatan = m_karyawan.id_jabatan', 'LEFT');
    $this->db->join('level_otorisasi', 'level_otorisasi.id_level_otorisasi = m_user.id_level_otorisasi','LEFT');
    $this->db->join('level_user', 'level_user.id_level_user = m_user.id_level_user', 'LEFT');
    // $this->db->not_like('m_user.username','admin');
    $this->db->where('m_user.id_level_otorisasi !=', 0);  
    $this->db->where('m_user.id_level_user !=', 0);  
    

    $b = 0;
    $input_cari = strtolower($_POST['search']['value']);
    $kolom_cari = $this->kolom_cari_user;

    foreach ($kolom_cari as $cari) {
      if ($input_cari) {
        if ($b === 0) {
          $this->db->group_start();
          $this->db->like($cari, $input_cari);
        } else {
          $this->db->or_like($cari, $input_cari);
        }
        if ((count($kolom_cari) - 1) == $b ) {
          $this->db->group_end();
        }
      }
      $b++;
    }

    if ($_POST['order']) {
      $kolom_order = $this->kolom_order_user;
      $this->db->order_by($kolom_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
    } elseif (isset($this->order_user)) {
      $order = $this->order_user;
      $this->db->order_by(key($order), $order[key($order)]);
    }
  }

  public function countalluser()
  {
    $this->db->select('m_user.id_user, m_user.id_karyawan as idkr, m_user.id_level_user as lvus, m_user.flag_table, level_user.*, level_otorisasi.level_otorisasi, m_karyawan.nama_karyawan, m_user.username, m_jabatan.jabatan, m_user.id_pengguna_tertanggung');
    $this->db->from('m_user');
    $this->db->join('m_karyawan', 'm_user.id_karyawan = m_karyawan.id_karyawan', 'LEFT');
    $this->db->join('m_jabatan', 'm_jabatan.id_jabatan = m_karyawan.id_jabatan', 'LEFT');
    $this->db->join('level_otorisasi', 'level_otorisasi.id_level_otorisasi = m_user.id_level_otorisasi', 'LEFT');
    $this->db->join('level_user', 'level_user.id_level_user = m_user.id_level_user', 'LEFT');
    // $this->db->not_like('m_user.username','admin');
    $this->db->where('m_user.id_level_otorisasi !=', 0);  
    $this->db->where('m_user.id_level_user !=', 0);  
    
    return $this->db->count_all_results();
  }

  public function countfilteruser()
  {
    $this->_get_data_alluser();
    return $this->db->get()->num_rows();
  }

  public function llus($value)
  {
    $this->db->select('id_level_user');
    $this->db->where('level_user',$value);
    $data = $this->db->get('level_user')->result();
    return $data[0]->id_level_user;
  }

  public function cekusername_edit($user_asli, $usnmm)
  {
    $this->db->where('username !=', $user_asli);
    $list = $this->db->get('m_user')->result_array();

    $return = "beda";
    foreach ($list as $s) {
      if (strtolower($s['username']) == strtolower($usnmm)) {
        $return = 'sama';
      }
    }

    return $return;
  }

  public function cekusername($usnmm)
  {
    $this->db->where('LOWER(username)', strtolower($usnmm));
    return $this->db->get('m_user')->num_rows();
  }

  // 22-11-2021
  public function cari_user_pengguna_tertanggung($id_tertanggung)
  {
    $this->db->select('id_pengguna_tertanggung');
    $this->db->from('m_user');
    $sppa = $this->db->get()->result_array();

    foreach ($sppa as $s) {
        $list[] = $s['id_pengguna_tertanggung'];
    }
    
    $this->db->select('id_pengguna_tertanggung, nama');
    $this->db->from('pengguna_tertanggung');
    $this->db->where('id_insured', $id_tertanggung);
    if (!empty($list)) {
        $this->db->where_not_in('id_pengguna_tertanggung', $list);
    }

    return $this->db->get();
    
  }

}

?>
