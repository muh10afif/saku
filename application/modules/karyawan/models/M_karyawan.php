<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 *
 */
class M_karyawan extends CI_Model
{

  function __construct() {
    parent::__construct();
  }

  var $kolom_order_user = [null,'m_karyawan.kode_karyawan','m_karyawan.nik','m_karyawan.nama_karyawan','m_bagian.bagian','m_jabatan.jabatan'];
  var $kolom_cari_user  = ['LOWER(m_karyawan.nik)', 'LOWER(m_karyawan.nama_karyawan)', 'LOWER(m_jabatan.jabatan)', 'LOWER(m_bagian.bagian)'];
  var $order_user       = ['m_bagian.bagian' => 'asc'];

  public function get_data_karyawan($value='')
  {
    $this->_get_data_karyawan();
    if ($this->input->post('length') != -1) {
      $this->db->limit($this->input->post('length'), $this->input->post('start'));
      return $this->db->get()->result_array();
    }
  }

  public function _get_data_karyawan()
  {
    $this->db->select('*');
    $this->db->from('m_karyawan');
    $this->db->join('m_jabatan', 'm_jabatan.id_jabatan = m_karyawan.id_jabatan');
    $this->db->join('m_bagian', 'm_bagian.id_bagian = m_jabatan.id_bagian');

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

    if (isset($_POST['order'])) {
      $kolom_order = $this->kolom_order_user;
      $this->db->order_by($kolom_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
    } elseif (isset($this->order_user)) {
      $order = $this->order_user;
      $this->db->order_by(key($order), $order[key($order)]);
    }
  }

  public function countallkaryawan()
  {
    $this->db->select('*');
    $this->db->from('m_karyawan');
    $this->db->join('m_jabatan', 'm_jabatan.id_jabatan = m_karyawan.id_jabatan');
    $this->db->join('m_bagian', 'm_bagian.id_bagian = m_jabatan.id_bagian');
    return $this->db->count_all_results();
  }

  public function allkaryawan()
  {
    $this->db->select('*');
    $this->db->join('m_jabatan', 'm_jabatan.id_jabatan = m_karyawan.id_jabatan');
    $this->db->join('m_bagian', 'm_bagian.id_bagian = m_jabatan.id_bagian');
    $this->db->order_by("m_karyawan.nama_karyawan", "asc");
    return $this->db->get('m_karyawan')->result();
  }

  public function countfilterkaryawan()
  {
    $this->_get_data_karyawan();
    return $this->db->get()->num_rows();
  }

  public function cek_nik_edit($nik_asli, $nik_input)
  {
    $this->db->where('nik !=', $nik_asli);
    $list = $this->db->get('m_karyawan')->result_array();

    $return = "beda";
    foreach ($list as $s) {
      if ($s['nik'] == $nik_input) {
        $return = 'sama';
      }
    }

    return $return;
  }
}

?>
