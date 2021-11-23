<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 *
 */
class M_role_user extends CI_Model
{

  function __construct() {
    parent::__construct();
  }

  var $kolom_order_user = [null,'level_otorisasi.level_otorisasi','m_jabatan.jabatan'];
  var $kolom_cari_user  = ['LOWER(level_otorisasi.level_otorisasi)','LOWER(m_jabatan.jabatan)'];
  var $order_user       = ['role.id_role' => 'desc'];

  public function get_data_allrole()
  {
    $this->_get_data_allrole();
    if ($this->input->post('length') != -1) {
      $this->db->limit($this->input->post('length'), $this->input->post('start'));
      return $this->db->get()->result_array();
    }
  }

  public function _get_data_allrole()
  {
    $this->db->select('*');
    $this->db->join('level_otorisasi','role.id_level_otorisasi = level_otorisasi.id_level_otorisasi');
    $this->db->join('m_jabatan','role.id_jabatan = m_jabatan.id_jabatan');
    $this->db->from('role');

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

  public function countallrole()
  {
    $this->db->select('*');
    $this->db->join('level_otorisasi','role.id_level_otorisasi = level_otorisasi.id_level_otorisasi');
    $this->db->join('m_jabatan','role.id_jabatan = m_jabatan.id_jabatan');
    $this->db->from('role');
    return $this->db->count_all_results();
  }

  public function allrolee()
  {
    return $this->db->get('role')->result();
  }

  public function cekadaga($oto,$jbt)
  {
    $this->db->where(['id_level_otorisasi' => $oto, 'id_jabatan' => $jbt]);
    return $this->db->get('role')->num_rows();
  }

  public function countfilterrole()
  {
    $this->_get_data_allrole();
    return $this->db->get()->num_rows();
  }
}

?>
