<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class M_restitusi extends CI_Model {

  var $kolom_order_restitusi = ['tr_restitusi.id_restitusi'];
  var $kolom_cari_restitusi  = ['LOWER(m_nasabah.nama_nasabah)', 'LOWER(m_cabang_bank.id_cabang_bank)'];
  var $order_restitusi       = ['tr_restitusi.id_restitusi' => 'desc'];

  public function get_data_restitusi($value='')
  {
      $this->_get_data_restitusi();
      if ($this->input->post('length') != -1) {
      $this->db->limit($this->input->post('length'), $this->input->post('start'));
      return $this->db->get()->result_array();
      }
  }

  // 08-Juni-2021 RFA
  public function _get_data_restitusi()
  {
      $this->db->select('*');
      $this->db->from('tr_restitusi');
      $this->db->from('tr_polis', 'tr_polis.id_polis = tr_restitusi.id_polis');
      $this->db->join('tr_klaim', 'tr_klaim.id_polis = tr_polis.id_polis', 'inner');
      $this->db->join('m_tipe_klaim', 'm_tipe_klaim.id_tipe_klaim = tr_klaim.id_tipe_klaim', 'left');
      $this->db->join('m_nasabah', 'm_nasabah.id_nasabah = tr_polis.id_nasabah', 'left');
      $this->db->join('m_cabang_bank', 'm_cabang_bank.id_cabang_bank = tr_polis.id_cabang_bank', 'left');

      //form filter || RFA

      if($this->input->post('no_restitusi'))
      {
          $this->db->like('no_restitusi', $this->input->post('no_restitusi'));
      }
      if($this->input->post('no_polis'))
      {
          $this->db->like('no_polis', $this->input->post('no_polis'));
      }
      if($this->input->post('nama_nasabah'))
      {
          $this->db->like('nama_nasabah', $this->input->post('nama_nasabah'));
      }
      if($this->input->post('nama_cabang_bank'))
      {
          $this->db->like('nama_cabang_bank', $this->input->post('nama_cabang_bank'));
      }
      if($this->input->post('kode_nasabah'))
      {
          $this->db->like('kode_nasabah', $this->input->post('kode_nasabah'));
      }
      
      $b = 0;
      $input_cari = strtolower($_POST['search']['value']);
      $kolom_cari = $this->kolom_cari_restitusi;

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
      $kolom_order = $this->kolom_order_restitusi;
      $this->db->order_by($kolom_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
      } elseif (isset($this->order_restitusi)) {
      $order = $this->order_restitusi;
      $this->db->order_by(key($order), $order[key($order)]);
      }
  }

  public function countallrestitusi()
  {
      $this->db->select('*');
      $this->db->from('tr_restitusi');
      return $this->db->count_all_results();
  }

  // 08-Juni-2021 RFA
  public function countfilterrestitusi()
  {
      $this->_get_data_restitusi();
      return $this->db->get()->num_rows();
  }

  public function polis()
  {
      return $this->db->get('tr_polis')->result();
  }

  public function indikator()
  {
    return $this->db->get('m_indikator')->result();
  }

}