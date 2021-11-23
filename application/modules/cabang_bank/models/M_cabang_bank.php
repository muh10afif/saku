<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 *
 */
class M_cabang_bank extends CI_Model
{

  function __construct() {
    parent::__construct();
  }

  var $kolom_order_user = [null,'m_cabang_bank.kode_cabang_bank','m_bank.nama_bank','m_cabang_bank.nama_cabang_bank'];
  var $kolom_cari_user  = ['LOWER(m_cabang_bank.kode_cabang_bank)','LOWER(m_cabang_bank.nama_cabang_bank)','LOWER(m_bank.nama_bank)'];
  var $order_user       = ['m_cabang_bank.id_cabang_bank' => 'desc'];

  public function get_data_cabangbank($value='')
  {
    $this->_get_data_cabangbank();
    if ($this->input->post('length') != -1) {
      $this->db->limit($this->input->post('length'), $this->input->post('start'));
      return $this->db->get()->result_array();
    }
  }

  public function _get_data_cabangbank()
  {
    $this->db->select('*');
    $this->db->from('m_cabang_bank');
    $this->db->join('m_bank','m_cabang_bank.id_bank = m_bank.id_bank');

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

  public function countalllistcabangbank()
  {
    $this->db->select('*');
    $this->db->from('m_cabang_bank');
    $this->db->join('m_bank','m_cabang_bank.id_bank = m_bank.id_bank');
    return $this->db->count_all_results();
  }

  public function countfilterlistcabangbank()
  {
    $this->_get_data_cabangbank();
    return $this->db->get()->num_rows();
  }

  public function showdataby($id)
  {
    $this->db->select('*');
    $this->db->join('m_bank','m_cabang_bank.id_bank = m_bank.id_bank');
    $this->db->where('id_cabang_bank',$id);
    $data = $this->db->get('m_cabang_bank')->result();
    return $data;
  }
}

?>
