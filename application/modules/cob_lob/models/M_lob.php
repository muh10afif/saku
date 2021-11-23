<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 *
 */
class M_lob extends CI_Model
{

  function __construct() {
    parent::__construct();
  }

  var $kolom_order_user = [null,'lob','diskon'];
  var $kolom_cari_user  = ['LOWER(lob)'];
  var $order_user       = ['id_lob' => 'desc'];

  public function get_data_lob($value='')
  {
    $this->_get_data_lob();
    if ($this->input->post('length') != -1) {
      $this->db->limit($this->input->post('length'), $this->input->post('start'));
      return $this->db->get()->result_array();
    }
  }

  public function _get_data_lob($value='')
  {
    $this->db->select('*');
    $this->db->from('m_lob');

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

  public function countalllistlob($value='')
  {
    $this->db->select('*');
    $this->db->from('m_lob');
    return $this->db->count_all_results();
  }

  public function countfilterlistlob($value='')
  {
    $this->_get_data_lob();
    return $this->db->get()->num_rows();
  }

  public function list_lob()
  {
    $this->db->select('m_lob.*, relasi_cob_lob.id_lob as idlob');
    $this->db->join('relasi_cob_lob','m_lob.id_lob = relasi_cob_lob.id_lob', 'LEFT');
    $this->db->order_by("m_lob.lob", "asc");
    return $this->db->get('m_lob')->result();
  }

  public function lobbyid($id)
  {
    $this->db->where('id_lob', $id);
    $data = $this->db->get('m_lob')->result();
    return $data;
  }
}

?>
