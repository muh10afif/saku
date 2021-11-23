<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 *
 */
class M_entry_sppa extends CI_Model
{

    public function __construct() {
        parent::__construct();
        
        $this->id_lvl_otorisasi = $this->session->userdata('id_level_otorisasi');
        $this->id_user          = $this->session->userdata('sesi_id');

    }

  public function getsob()
  {
    $this->db->order_by('sob', 'asc');
    return $this->db->get('m_sob')->result();
  }

  public function getsob_list()
  {
      
    $this->db->order_by('sob', 'asc');
    return $this->db->get('m_sob')->result();
  }

  public function list_cob()
  {
    $this->db->order_by('cob', 'asc');
    return $this->db->get('m_cob')->result();
  }

  public function get_data_dokumen()
  {
    return $this->db->get('dokumen_sppa');
    
  }

  public function cari_lob($id_lob)
  {
    $this->db->select('*');
    $this->db->from('m_lob');
    $this->db->where('id_lob !=', $id_lob);
    
    return $this->db->get();
  }

    public function cari_data($tabel, $where)
    {
        return $this->db->get_where($tabel, $where);
    }

    public function cari_data_order($tabel, $where, $field, $order)
    {
        $this->db->order_by($field, $order);

        return $this->db->get_where($tabel, $where);
    }

    public function get_data_order($tabel, $field, $order)
    {
        $this->db->order_by($field, $order);
        
        return $this->db->get($tabel);
    }

    public function get_data($tabel)
    {
        return $this->db->get($tabel);
    }

    public function input_data($tabel, $data)
    {
        $this->db->insert($tabel, $data);
    }

    public function ubah_data($tabel, $data, $where)
    {
        return $this->db->update($tabel, $data, $where);
    }

    public function hapus_data($tabel, $where)
    {
        $this->db->delete($tabel, $where);
    }

    // 15-05-2021
    public function get_data_sppa()
    {
        $this->_get_datatables_query_sppa();

        if ($this->input->post('length') != -1) {
            $this->db->limit($this->input->post('length'), $this->input->post('start'));
            
            return $this->db->get()->result_array();
        }
    }

    var $kolom_order_sppa = [null, 't.sppa_number', 's.sob', 'c.cob'];
    var $kolom_cari_sppa  = ['LOWER(t.sppa_number)', 'LOWER(s.sob)', 'LOWER(c.cob)'];
    var $order_sppa       = ['t.sppa_number' => 'desc'];

    public function _get_datatables_query_sppa()
    {
        $cr = $this->db->get_where('m_user', ['id_user' => $this->input->post('id_user')])->row_array();

        $this->db->select('t.id_sppa_quotation as id, t.sppa_number, c.cob, l.lob, h.id_sob, s.sob, h.nama_sob, t.add_by');
        $this->db->from('tr_sppa_quotation as t');
        $this->db->join('m_cob as c', 'id_cob', 'inner');
        $this->db->join('m_lob as l', 'id_lob', 'inner');
        $this->db->join('tr_histori_status_sob as h', 'h.id_sppa_quotation = t.id_sppa_quotation', 'inner');
        $this->db->join('m_sob as s', 's.id_sob = h.id_sob', 'left');
        $this->db->where('t.approval', false);
        $this->db->where('t.endorsment', false);
        $this->db->where('t.cancelation', false);

        if ($this->input->post('id_lvl_otorisasi') != 0) {
            
            if ($cr['id_level_user'] != 0) {

                $this->db->where('t.add_by', $this->input->post('id_user'));
                
            }   
        } 
        
        $b = 0;
        
        $input_cari = strtolower($_POST['search']['value']);
        $kolom_cari = $this->kolom_cari_sppa;

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

            $kolom_order = $this->kolom_order_sppa;
            $this->db->order_by($kolom_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
            
        } elseif (isset($this->order_sppa)) {
            
            $order = $this->order_sppa;
            $this->db->order_by(key($order), $order[key($order)]);
            
        }
        
    }

    public function jumlah_semua_sppa()
    {
        $cr = $this->db->get_where('m_user', ['id_user' => $this->input->post('id_user')])->row_array();

        $this->db->select('t.id_sppa_quotation as id, t.sppa_number, c.cob, l.lob, h.id_sob, s.sob, h.nama_sob, t.add_by');
        $this->db->from('tr_sppa_quotation as t');
        $this->db->join('m_cob as c', 'id_cob', 'inner');
        $this->db->join('m_lob as l', 'id_lob', 'inner');
        $this->db->join('tr_histori_status_sob as h', 'h.id_sppa_quotation = t.id_sppa_quotation', 'inner');
        $this->db->join('m_sob as s', 's.id_sob = h.id_sob', 'left');
        $this->db->where('t.approval', false);
        $this->db->where('t.endorsment', false);
        $this->db->where('t.cancelation', false);

        if ($this->input->post('id_lvl_otorisasi') != 0) {
            
            if ($cr['id_level_user'] != 0) {

                $this->db->where('t.add_by', $this->input->post('id_user'));
                
            }   
        }
        
      return $this->db->count_all_results();
    }

    public function jumlah_filter_sppa()
    {
        $this->_get_datatables_query_sppa();

        return $this->db->get()->num_rows();
        
    }

    // 15-05-2021
    public function get_field_sppa($id_relasi_detail)
    {
      $this->db->select('p.*, t.type_field, o.*');
      $this->db->from('m_sppa_field_spec as t');
      $this->db->join('m_field_sppa_prop as o', 'id_sppa_field_spec', 'inner');
      $this->db->join('m_field_sppa as p', 'p.id_field_sppa = t.type_field', 'inner');
      $this->db->where('t.id_relasi_cob_lob', $id_relasi_detail);
      
      return $this->db->get();  
    }

    // 13-07-2021
    public function get_field_sppa_cari($id_relasi_detail, $field)
    {
        $a = str_replace("_", " ", $field);

        $b = ucwords($a);

        $this->db->select('p.*, t.type_field, o.*');
        $this->db->from('m_sppa_field_spec as t');
        $this->db->join('m_field_sppa_prop as o', 'id_sppa_field_spec', 'inner');
        $this->db->join('m_field_sppa as p', 'p.id_field_sppa = t.type_field', 'inner');
        $this->db->where('t.id_relasi_cob_lob', $id_relasi_detail);
        $this->db->where('p.field_sppa', "$b");
        
        return $this->db->get();  
    }

    // 16-05-2021
    public function get_premi($id_sppa)
    {
      $this->db->select('t.*, g.label, g.status');
      $this->db->from('tr_premi as t');
      $this->db->join('coverage as g', 'id_coverage', 'inner');
      $this->db->where('t.id_sppa_quotation', $id_sppa);
      $this->db->order_by('g.label', 'asc');
      
      return $this->db->get();       
    }

    public function get_premi_adt($id_sppa)
    {
      $this->db->select('t.*, l.lob');
      $this->db->from('tr_premi_adt as t');
      $this->db->join('m_lob as l', 'id_lob', 'inner');
      $this->db->where('t.id_sppa_quotation', $id_sppa);
      
      return $this->db->get();       
    }

    public function get_sppa($id_sppa)
    {
        $this->db->select('t.*, c.cob, l.lob');
        $this->db->from('tr_sppa_quotation as t');
        $this->db->join('m_cob as c', 'id_cob', 'inner');
        $this->db->join('m_lob as l', 'id_lob', 'inner');
        $this->db->where('t.id_sppa_quotation', $id_sppa);
        
        return $this->db->get();
    }

    public function joincoblob($id)
    {
        $this->db->select('m_lob.id_lob,m_lob.lob, relasi_cob_lob.id_relasi_cob_lob');
        $this->db->join('m_cob', 'relasi_cob_lob.id_cob = m_cob.id_cob');
        $this->db->join('m_lob', 'relasi_cob_lob.id_lob = m_lob.id_lob');
        $this->db->where('m_cob.id_cob', $id);
        $this->db->order_by('m_lob.lob', 'asc');
        return $this->db->get('relasi_cob_lob')->result();
    }

    // 02-06-2021
    public function get_insured_mop()
    {
        $this->db->select('n.id_nasabah, n.nama_nasabah');
        $this->db->from('mop as m');
        $this->db->join('m_nasabah as n', 'n.id_nasabah = m.id_insured', 'inner');
        $this->db->group_by('n.id_nasabah');
        $this->db->order_by('n.nama_nasabah', 'asc');
        
        return $this->db->get();
    }

    // 25-06-2021
    public function cari_list_mop($id_insured)
    {
        $this->db->select('id_mop');
        $this->db->from('tr_sppa_quotation');
        $this->db->where('id_mop !=', null);
        $this->db->group_by('id_mop');
        
        $a = $this->db->get()->result_array();

        $ay = array();
        foreach ($a as $b) {
            $ay[] = $b['id_mop'];
        }

        $im     = implode(',',$ay);
        $id_mop = explode(',',$im);
        
        $this->db->select('m.*');
        $this->db->from('mop as m');
        $this->db->where('m.id_insured', $id_insured);

        if ($id_mop[0] != "") {
            $this->db->where_not_in('m.id_mop', $id_mop);
        }

        $this->db->order_by('m.nama_mop', 'asc');
        
        return $this->db->get();
    }

    // 25-06-2021
    public function cari_data_list_dek($id_mop)
    {
        $this->db->select('t.id_sppa_quotation as id, t.sppa_number, p.*, t.*');
        $this->db->from('tr_sppa_quotation as t');
        $this->db->join('pengguna_tertanggung as p', 'id_pengguna_tertanggung', 'inner');
        
        $this->db->where('t.id_mop', $id_mop);
        
        return $this->db->get();
        
    }

    // 23-07-2021
    public function get_field_unik($id_relasi)
    {
        $this->db->select('p.*, t.type_field, o.*');
        $this->db->from('m_sppa_field_spec as t');
        $this->db->join('m_field_sppa_prop as o', 'o.id_sppa_field_spec = t.id_sppa_field_spec', 'inner');
        $this->db->join('m_field_sppa as p', 'p.id_field_sppa = t.type_field', 'inner');
        $this->db->where('t.id_relasi_cob_lob', $id_relasi);
        $this->db->where('o.field_unique', 't');

        return $this->db->get();
    }

}

?>
