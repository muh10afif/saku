<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class M_klaim extends CI_Model {

  
  public function polis()
  {
      return $this->db->get('tr_polis')->result();
  }
  
  public function klaimtipe()
  {
      return $this->db->get('m_tipe_klaim')->result();
  }
  
  public function indikator()
  {
      return $this->db->get('m_indikator')->result();
  }
  
  public function klasifikasiklaim()
  {
      return $this->db->get('m_klasifikasi_klaim')->result();
  }
  
  public function jenisklaim()
  {
      return $this->db->get('m_jenis_klaim')->result();
  }

}