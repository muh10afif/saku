<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 *
 */
class M_business_specifications extends CI_Model
{

  function __construct() {
    parent::__construct();
  }

  public function joincoblob($id)
  {
    $this->db->select('relasi_cob_lob.id_relasi_cob_lob,m_lob.id_lob,m_lob.lob');
    $this->db->join('m_cob', 'relasi_cob_lob.id_cob = m_cob.id_cob');
    $this->db->join('m_lob', 'relasi_cob_lob.id_lob = m_lob.id_lob');
    $this->db->where('m_cob.id_cob', $id);
    return $this->db->get('relasi_cob_lob')->result();
  }

  public function ceksb($id)
  {
    $this->db->where('id_lob', $id);
    return $this->db->get('m_sppa_field_spec')->num_rows();
  }

  public function showprop($arr)
  {
    $this->db->select('relasi_cob_lob.*, m_cob.cob, m_lob.lob, m_sppa_field_spec.type_field, m_field_sppa_prop.*, m_field_sppa.data_type');
    $this->db->join('m_cob','m_cob.id_cob = relasi_cob_lob.id_cob');
    $this->db->join('m_lob','m_lob.id_lob = relasi_cob_lob.id_lob');
    $this->db->join('m_sppa_field_spec','relasi_cob_lob.id_relasi_cob_lob = m_sppa_field_spec.id_relasi_cob_lob');
    $this->db->join('m_field_sppa','m_field_sppa.id_field_sppa = m_sppa_field_spec.type_field');
    $this->db->join('m_field_sppa_prop','m_field_sppa_prop.id_sppa_field_spec = m_sppa_field_spec.id_sppa_field_spec');
    $this->db->where($arr);
    return $this->db->get('relasi_cob_lob')->result();
  }
}

?>
