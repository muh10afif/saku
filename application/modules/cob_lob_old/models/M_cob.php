<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 *
 */
class M_cob extends CI_Model
{

  function __construct() {
    parent::__construct();
  }

  var $kolom_order_user = ['cob'];
  var $kolom_cari_user  = ['LOWER(cob)', 'LOWER(tipe_cob)'];
  var $order_user       = ['id_cob' => 'desc'];

  public function get_data_cob($value='')
  {
    $this->_get_data_cob();
    if ($this->input->post('length') != -1) {
      $this->db->limit($this->input->post('length'), $this->input->post('start'));
      return $this->db->get()->result_array();
    }
  }

  public function _get_data_cob($value='')
  {
    $this->db->select('*');
    $this->db->from('m_cob');
    $this->db->join('m_tipe_cob', 'm_cob.id_tipe_cob = m_tipe_cob.id_tipe_cob');

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

  public function countalllistcob($value='')
  {
    $this->db->select('*');
    $this->db->from('m_cob');
    $this->db->join('m_tipe_cob', 'm_cob.id_tipe_cob = m_tipe_cob.id_tipe_cob');
    return $this->db->count_all_results();
  }

  public function countfilterlistcob($value='')
  {
    $this->_get_data_cob();
    return $this->db->get()->num_rows();
  }

  public function list_tipe_cob()
  {
    return $this->db->get('m_tipe_cob')->result();
  }

  public function list_cob()
  {
    return $this->db->get('m_cob')->result();
  }

  public function cobbyid($id)
  {
    $this->db->join('m_tipe_cob', 'm_cob.id_tipe_cob = m_tipe_cob.id_tipe_cob');
    $this->db->where('m_cob.id_cob', $id);
    $data = $this->db->get('m_cob')->result();
    return $data;
  }
}

?>
