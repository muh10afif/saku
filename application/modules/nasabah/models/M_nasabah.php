<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 *
 */
class M_nasabah extends CI_Model
{

  function __construct() {
    parent::__construct();
  }

  var $kolom_order_user = [null,'kode_nasabah','nik','nama_nasabah','telp','tgl_lahir','jenis_kelamin'];
  var $kolom_cari_user  = ['LOWER(kode_nasabah)','nik','LOWER(nama_nasabah)','telp','LOWER(alamat_rumah)'];
  var $order_user       = ['id_nasabah' => 'desc'];

  public function get_data_nasabah($value = '')
  {
    $this->_get_data_nasabah($value);
    if ($this->input->post('length') != -1) {
      $this->db->limit($this->input->post('length'), $this->input->post('start'));
      return $this->db->get()->result_array();
    }
  }

  public function _get_data_nasabah($tipen)
  {
    $this->db->select('*');
    $this->db->where('status',$tipen);
    $this->db->from('m_nasabah');

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

  public function countallnasabah($tipen)
  {
    $this->db->select('*');
    $this->db->where('status',$tipen);
    $this->db->from('m_nasabah');
    return $this->db->count_all_results();
  }

  public function allnasabah()
  {
    $this->db->order_by("nama_nasabah", "asc");
    return $this->db->get('m_nasabah')->result();
  }

  public function countfilternasabah($tipen)
  {
    $this->_get_data_nasabah($tipen);
    return $this->db->get()->num_rows();
  }
}

?>
