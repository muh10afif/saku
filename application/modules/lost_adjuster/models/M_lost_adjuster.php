<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 *
 */
class m_lost_adjuster extends CI_Model
{

  function __construct() {
    parent::__construct();
  }

  var $kolom_order_user = [null,'kode_loss_adjuster','nama','telp','alamat'];
  var $kolom_cari_user  = ['LOWER(kode_loss_adjuster)','LOWER(nama)','LOWER(telp)','LOWER(alamat)'];
  var $order_user       = ['id_loss_adjuster' => 'desc'];

  public function get_data_lostadj($value='')
  {
    $this->_get_data_lostadj($value);
    if ($this->input->post('length') != -1) {
      $this->db->limit($this->input->post('length'), $this->input->post('start'));
      return $this->db->get()->result_array();
    }
  }

  public function _get_data_lostadj($tipen)
  {
    $this->db->select('*');
    $this->db->where('status',$tipen);
    $this->db->from('m_loss_adjuster');

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

  public function countalllostadj($tipen)
  {
    $this->db->select('*');
    $this->db->where('status',$tipen);
    $this->db->from('m_loss_adjuster');
    return $this->db->count_all_results();
  }

  public function countfilterlostadj($tipen)
  {
    $this->_get_data_lostadj($tipen);
    return $this->db->get()->num_rows();
  }
}

?>
