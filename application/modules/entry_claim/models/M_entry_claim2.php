<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 *
 */
class M_entry_claim extends CI_Model
{
  var $kolom_order_outgoing = [null,'a.id_data_klaim', ''];
  var $kolom_cari_outgoing  = ['LOWER(a.nilai_klaim)', 'LOWER(a.kejadian)'];
  var $order_outgoing       = ['a.id_data_klaim' => 'desc'];

  public function cari_data($tabel, $where)
  {
      return $this->db->get_where($tabel, $where);
  }

  public function cari_data_karyawan($tabel)
  {
      return $this->db->get_where($tabel);
  }

  public function list_sppa()
  {
    return $this->db->get('tr_sppa_quotation')->result();
  }
  // 16-05-2021
  
  public function list_sppas()
  {
      $this->db->select('t.id_sppa_quotation, t.sppa_number, m.id_mop, c.id_cob, l.id_lob, a.nama_asuransi, n.nama_nasabah');
      $this->db->from('tr_sppa_quotation as t');
      // $this->db->join('m_cob as c', 'id_cob', 'inner');
      // $this->db->join('m_lob as l', 'id_lob', 'inner');
      // $this->db->join('mop as m', 'id_mop', 'inner');
      $this->db->join('mop as m', 'id_mop', 'left');
      $this->db->join('m_cob as c', 'c.id_cob = t.id_cob', 'left');
      $this->db->join('m_lob as l', 'l.id_lob = t.id_lob', 'left');
      // $this->db->join('tr_approve_sppa as p', 'id_sppa_quotation', 'inner');
      $this->db->join('m_asuransi as a', 'a.id_asuransi = m.id_insurer', 'left');
      $this->db->join('m_nasabah as n', 'n.id_nasabah = m.id_insured', 'left');
      $this->db->where('t.approval', true);
      $this->db->where('t.status_aktif', true);
      $this->db->order_by('t.sppa_number', ASC);

      // return $this->db->get('tr_sppa_quotation')->result();
      return $this->db->get()->result();
      
      
  }

  public function get_data_list($id){
    $this->db->join('mop', 'id_mop', 'left');
    $this->db->join('m_cob', 'm_cob.id_cob = tr_sppa_quotation.id_cob', 'left');
    $this->db->join('m_lob', 'm_lob.id_lob = tr_sppa_quotation.id_lob', 'left');
    $this->db->join('tr_approve_sppa', 'tr_approve_sppa.id_sppa_quotation = tr_sppa_quotation.id_sppa_quotation', 'left');
    $this->db->join('m_asuransi', 'm_asuransi.id_asuransi = tr_approve_sppa.id_asuransi', 'left');
    $this->db->join('m_nasabah', 'm_nasabah.id_nasabah = mop.id_insured', 'left');
    $this->db->where('tr_sppa_quotation.id_sppa_quotation', $id);
    $data = $this->db->get('tr_sppa_quotation')->row();
    return $data;
  }

  public function list_sppa2()
  {
    // $this->db->distinct();
    $this->db->select('t.id_sppa_quotation, t.sppa_number, c.cob, l.lob');
    $this->db->from('tr_sppa_quotation as t');
    $this->db->join('m_cob as c', 'c.id_cob = t.id_cob', 'left');
    $this->db->join('m_lob as l', 'l.id_lob = t.id_lob', 'left');
    // $this->db->join('mop as m', 'id_mop', 'inner');
    $this->db->join('mop as m', 'm.id_lob = l.id_lob', 'left');
    $this->db->join('tr_approve_sppa as p', 'id_sppa_quotation', 'inner');
    $this->db->join('m_asuransi as a', 'id_asuransi', 'inner');
    $this->db->join('m_nasabah as n', 'n.id_nasabah = m.id_insured', 'left');
    $this->db->group_by('t.id_mop');

    return $this->db->get()->result();
  }

     // 24-05-2021
     public function get_endors($id_sppa)
     {
         $this->db->select('t.id_endorsment, t.add_time, t.nama_endorsment, s.sppa_number, s.no_polis, p.no_otorisasi_polis, t.status, s.id_sppa_quotation as id_sppa');
         $this->db->from('tr_endorsment as t');
         $this->db->join('tr_sppa_quotation as s', 'id_sppa_quotation', 'inner');
         $this->db->join('tr_approve_sppa as p', 'id_sppa_quotation', 'inner');
         $this->db->where('t.id_sppa_quotation', $id_sppa);
         $this->db->order_by('t.nama_endorsment', 'asc');
         
         return $this->db->get();
     }
 
     // 21-06-2021
     public function get_endors_dek($id_mop)
     {
         $this->db->select("t.nama_endorsment, TO_CHAR(t.add_time :: DATE, 'dd/mm/yyyy') as tanggal, t.status, t.id_mop");
         $this->db->from('tr_endorsment as t');
         $this->db->where('t.id_mop', $id_mop);
         $this->db->group_by('t.status');
         $this->db->group_by('t.id_mop');
         $this->db->group_by('t.nama_endorsment');
         $this->db->group_by("TO_CHAR(t.add_time :: DATE, 'dd/mm/yyyy')");
         
         return $this->db->get();
     }

  public function list_nasabah(){
    return $this->db->get('m_nasabah')->result_array();
  }

  public function showdatakaryawan(){
    return $this->db->get('m_karyawan')->result();
  }

  public function get_data_outgoing($value=''){
    $this->_get_data_outgoing();
    if ($this->input->post('length') != -1) {
      $this->db->limit($this->input->post('length'), $this->input->post('start'));
      return $this->db->get()->result_array();
    }
  }

  public function _get_data_outgoing()
  {

    $this->db->select('a.*, b.*, c.*, d.*');
    $this->db->from('tr_data_klaim as a');
    $this->db->join('tr_sppa_quotation as b', 'b.id_sppa_quotation = a.id_sppa');
    $this->db->join('m_tipe_klaim as c', 'c.id_tipe_klaim = a.id_tipe_klaim', 'left');
    $this->db->join('m_status_klaim as d', 'd.id_status_klaim = a.id_status_klaim', 'left');
    // $this->db->join('dp_klaim_cob as e', 'e.id_data_klaim = a.id_data_klaim', 'left');


    $b = 0;
    $input_cari = strtolower($_POST['search']['value']);
    $kolom_cari = $this->kolom_cari_outgoing;

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
    $kolom_order = $this->kolom_order_outgoing;
    $this->db->order_by($kolom_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
    } elseif (isset($this->order_outgoing)) {
    $order = $this->order_outgoing;
    $this->db->order_by(key($order), $order[key($order)]);
    }
  }

    // if (isset($_POST['order'])) {
    //   $kolom_order = $this->kolom_order_outgoing;
    //   $this->db->order_by($kolom_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
    // } elseif (isset($this->$order_outgoing)) {
    //   $order = $this->$order_outgoing;
    //   $this->db->order_by(key($order), $order[key($order)]);
    // }


  public function countalllistout(){
    $this->db->select('*');
    $this->db->from('tr_sppa_quotation');
    return $this->db->count_all_results();
  }

  public function countfilterlistout(){
    $this->_get_data_outgoing();
    return $this->db->get()->num_rows();
  }

  function simpan_upload($name_file){
		$data = array(
          'name_file' => $name_file,
	        // 'size_file' => $size_file,
    );  
      $result= $this->db->insert('dokumen_klaim',$data);
    return $result;
	}

  public function showdatabyout($id){
      $this->db->select('*');
      $this->db->from('tr_data_klaim');
      $this->db->join('m_nasabah','m_nasabah.id_nasabah = tr_data_klaim.id_insured');
      $this->db->join('m_karyawan','m_karyawan.id_karyawan = tr_data_klaim.pic');
      $this->db->join('tr_sppa_quotation', 'tr_sppa_quotation.id_sppa_quotation = tr_data_klaim.id_sppa');
      $this->db->join('tr_approve_sppa', 'tr_approve_sppa.id_sppa_quotation = tr_sppa_quotation.id_sppa_quotation', 'left');
      $this->db->join('m_asuransi', 'm_asuransi.id_asuransi = tr_approve_sppa.id_asuransi', 'left');
      $this->db->join('m_cob', 'm_cob.id_cob = tr_sppa_quotation.id_cob', 'left');
      $this->db->join('m_lob', 'm_lob.id_lob = tr_sppa_quotation.id_lob', 'left');
      $this->db->where('id_data_klaim',$id);
      $data = $this->db->get()->result();
      return $data;
    }

  public function showdatadokumenout($id){
      $this->db->select('*');
      $this->db->from('tr_data_klaim');
      $this->db->join('dokumen_klaim','dokumen_klaim.id_data_klaim = tr_data_klaim.id_data_klaim');
      $this->db->join('tr_sppa_quotation', 'tr_sppa_quotation.id_sppa_quotation = tr_data_klaim.id_sppa');
      $this->db->where('id_data_klaim',$id);
      $data = $this->db->get()->result();
      return $data;
    }

    public function showdatainsured($id){
      $this->db->select('a.*');
      $this->db->from('m_nasabah as a');
      $this->db->where('a.id_nasabah', $id);
      $data = $this->db->get('m_nasabah')->row();
      return $data;
    }

    
    public function cari_data_order($tabel, $where, $field, $order)
    {
        $this->db->order_by($field, $order);

        return $this->db->get_where($tabel, $where);
    }
}

?>
