<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 *
 */
class ProductionReportModel extends CI_Model
{

  function __construct() {
    parent::__construct();
  }

  var $kolom_order_report = [null,'ms.sob','mc.cob','ml.lob','mn.nama_nasabah','mtc.tipe_cob'];
  var $kolom_cari_report  = ['LOWER(ms.sob)','LOWER(mc.cob)','LOWER(ml.lob)','LOWER(mn.nama_nasabah)','LOWER(mtc.tipe_cob)'];
  var $order_report       = ['tsq.id_sppa_quotation' => 'asc'];

  public function get_report_production($value = '')
  {
    $this->_get_report_production($value);
    if ($this->input->post('length') != -1) {
      $this->db->limit($this->input->post('length'), $this->input->post('start'));
    }
    return $this->db->get()->result_array();
  }

  public function load_query()
  {
    $this->db->select('tsq.id_sppa_quotation,
                       mn.nama_nasabah,
                       ms.sob,
                       mc.cob,
                       ml.lob,
                       mtc.tipe_cob,
                       tsq.total_sum_insured,
                       tsq.total_premi_standar,
                       tsq.total_premi_perluasan,
                       tsq.diskon,
                       tsq.total_akhir_premi,
                       tsq.gross_premi,
                       tsq.add_time');
    $this->db->join('m_sob ms','tsq.id_sob = ms.id_sob', 'LEFT');
    $this->db->join('m_cob mc','tsq.id_cob = mc.id_cob', 'LEFT');
    $this->db->join('m_lob ml','tsq.id_lob = ml.id_lob', 'LEFT');
    $this->db->join('m_tipe_cob mtc','mc.id_tipe_cob = mtc.id_tipe_cob', 'LEFT');
    $this->db->join('pengguna_tertanggung pt','tsq.id_pengguna_tertanggung = pt.id_pengguna_tertanggung', 'LEFT');
    $this->db->join('m_nasabah mn','pt.id_insured = mn.id_nasabah', 'LEFT');
    $this->db->from('tr_sppa_quotation tsq');
  }

  public function _get_report_production($value = '')
  {
    $this->load_query();
    if ($value['mulai'] != '' && $value['smpai'] != '') {
      $this->db->where('tsq.add_time >=', $value['mulai']);
      $this->db->where('tsq.add_time <=', $value['smpai']);
    }

    $b = 0;
    $input_cari = strtolower($_POST['search']['value']);
    $kolom_cari = $this->kolom_cari_report;

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
      $kolom_order = $this->kolom_order_report;
      $this->db->order_by($kolom_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
    } elseif (isset($this->order_report)) {
      $order = $this->order_report;
      $this->db->order_by(key($order), $order[key($order)]);
    }
  }

  public function countallprodukreport($value = '')
  {
    $this->load_query();
    if ($value['mulai'] != '' && $value['smpai'] != '') {
      $this->db->where('tsq.add_time >=', $value['mulai']);
      $this->db->where('tsq.add_time <=', $value['smpai']);
    }
    return $this->db->count_all_results();
  }

  public function countfilterprodukreport($value = '')
  {
    $this->_get_report_production($value);
    return $this->db->get()->num_rows();
  }
}

?>
