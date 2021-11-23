<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 *
 */
class M_coblob extends CI_Model
{

  function __construct() {
    parent::__construct();
  }

  var $kolom_order_user = ['cob', 'lob'];
  var $kolom_cari_user  = ['LOWER(cob)', 'LOWER(lob)'];
  var $order_user       = ['id_relasi_cob_lob' => 'desc'];

  public function get_data_coblob($value='')
  {
    $this->_get_data_coblob();
    if ($this->input->post('length') != -1) {
      $this->db->limit($this->input->post('length'), $this->input->post('start'));
      return $this->db->get()->result_array();
    }
  }
  public function _get_data_coblob($value='')
  {
    $this->db->select('*');
    $this->db->from('relasi_cob_lob');
    $this->db->join('m_cob', 'm_cob.id_cob = relasi_cob_lob.id_cob');
    $this->db->join('m_lob', 'm_lob.id_lob = relasi_cob_lob.id_lob');
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

  public function countalllistcoblob($value='')
  {
    $this->db->select('*');
    $this->db->from('relasi_cob_lob');
    $this->db->join('m_cob', 'm_cob.id_cob = relasi_cob_lob.id_cob');
    $this->db->join('m_lob', 'm_lob.id_lob = relasi_cob_lob.id_lob');
    $this->db->join('m_tipe_cob', 'm_cob.id_tipe_cob = m_tipe_cob.id_tipe_cob');
    return $this->db->count_all_results();
  }

  public function countfilterlistcoblob($value='')
  {
    $this->_get_data_coblob();
    return $this->db->get()->num_rows();
  }

  public function coblobbyid($id)
  {
    $this->db->join('m_cob', 'm_cob.id_cob = relasi_cob_lob.id_cob');
    $this->db->join('m_lob', 'm_lob.id_lob = relasi_cob_lob.id_lob');
    $this->db->join('m_tipe_cob', 'm_cob.id_tipe_cob = m_tipe_cob.id_tipe_cob');
    $this->db->where('relasi_cob_lob.id_relasi_cob_lob', $id);
    $data = $this->db->get('relasi_cob_lob')->result();
    return $data;
  }
}

?>
