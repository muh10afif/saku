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

    // 09-11-2021
    public function get_insured_mop()
    {
        $this->db->select('n.id_nasabah, n.nama_nasabah');
        $this->db->from('mop m');
        $this->db->join('m_nasabah n', 'n.id_nasabah = m.id_insured', 'INNER');
        $this->db->group_by('n.id_nasabah');
        $this->db->group_by('n.nama_nasabah');
        
        return $this->db->get();
    }

    // 10-11-2021
    public function cari_mop($id_insured)
    {
        $this->db->select('m.no_reff_mop, m.nama_mop, m.id_insurer, m.id_mop');
        $this->db->from('mop m');
        $this->db->where('m.id_insured', $id_insured);

        return $this->db->get();
    }

    // 10-11-2021
    public function cari_detil_mop($id_mop)
    {
        $this->db->select('m.no_mop, a.nama_asuransi, c.cob, l.lob');
        $this->db->from('mop m');
        $this->db->join('m_asuransi a', 'a.id_asuransi = m.id_insurer', 'left');
        $this->db->join('relasi_cob_lob r', 'r.id_relasi_cob_lob = m.id_relasi_cob_lob', 'left');
        $this->db->join('m_cob c', 'c.id_cob = r.id_cob', 'left');
        $this->db->join('m_lob l', 'l.id_lob = r.id_lob', 'left');
        
        $this->db->where('m.id_mop', $id_mop);

        return $this->db->get();        
    }

    // 22-09-2021
    public function get_data_sppa()
    {
        $this->_get_datatables_query_sppa();

        if ($this->input->post('length') != -1) {
            $this->db->limit($this->input->post('length'), $this->input->post('start'));
            
            return $this->db->get()->result_array();
        }
    }

    var $kolom_order_sppa = [null, 'LOWER(tsq.no_polis)', 'LOWER(ma.nama_asuransi)', 'LOWER(ml.lob)', 'LOWER(s.nama_nasabah)', 'LOWER(mn.nama)'];
    var $kolom_cari_sppa  = ['LOWER(tsq.no_polis)', 'LOWER(ma.nama_asuransi)', 'LOWER(ml.lob)', 'LOWER(s.nama_nasabah)', 'LOWER(mn.nama)'];
    var $order_sppa       = ['tsq.id_sppa_quotation' => 'desc'];

    public function _get_datatables_query_sppa()
    {
        $cr = $this->db->get_where('m_user', ['id_user' => $this->input->post('id_user')])->row_array();

        $this->db->select('tsq.id_sppa_quotation, tsq.no_polis, mn.nama as pengguna_tertanggung, s.nama_nasabah as tertanggung, ma.nama_asuransi, ml.lob');
        $this->db->from('tr_sppa_quotation tsq');
        $this->db->join('pengguna_tertanggung mn', 'mn.id_pengguna_tertanggung = tsq.id_pengguna_tertanggung', 'INNER');
        $this->db->join('mop m', 'm.id_mop = tsq.id_mop', 'INNER');
        $this->db->join('m_nasabah s', 's.id_nasabah = m.id_insured', 'INNER');
        $this->db->join('tr_produk_asuransi tpa', 'tpa.id_tr_produk_asuransi = tsq.id_produk_asuransi', 'INNER');
        $this->db->join('m_lob ml', 'ml.id_lob = tpa.id_lob', 'INNER');
        $this->db->join('m_asuransi ma', 'ma.id_asuransi = tpa.id_asuransi', 'inner');
        
        // if ($this->input->post('id_lvl_otorisasi') != 0) {
            
        //     if ($cr['id_level_user'] != 0) {

        //         $this->db->where('t.add_by', $this->input->post('id_user'));
                
        //     }   
        // } 
        
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

        $this->db->select('tsq.id_sppa_quotation, tsq.no_polis, mn.nama as pengguna_tertanggung, s.nama_nasabah as tertanggung, ma.nama_asuransi, ml.lob');
        $this->db->from('tr_sppa_quotation tsq');
        $this->db->join('pengguna_tertanggung mn', 'mn.id_pengguna_tertanggung = tsq.id_pengguna_tertanggung', 'INNER');
        $this->db->join('mop m', 'm.id_mop = tsq.id_mop', 'INNER');
        $this->db->join('m_nasabah s', 's.id_nasabah = m.id_insured', 'INNER');
        $this->db->join('tr_produk_asuransi tpa', 'tpa.id_tr_produk_asuransi = tsq.id_produk_asuransi', 'INNER');
        $this->db->join('m_lob ml', 'ml.id_lob = tpa.id_lob', 'INNER');
        $this->db->join('m_asuransi ma', 'ma.id_asuransi = tpa.id_asuransi', 'inner');

        // if ($this->input->post('id_lvl_otorisasi') != 0) {
            
        //     if ($cr['id_level_user'] != 0) {

        //         $this->db->where('t.add_by', $this->input->post('id_user'));
                
        //     }   
        // }
        
        return $this->db->count_all_results();
    }

    public function jumlah_filter_sppa()
    {
        $this->_get_datatables_query_sppa();

        return $this->db->get()->num_rows();
        
    }

    // 22-09-2021
    public function cari_asuransi()
    {
        $this->db->distinct();
        $this->db->select('ma.nama_asuransi, ma.id_asuransi');
        $this->db->from('m_asuransi ma');
        $this->db->join('tr_produk_asuransi tpa', 'tpa.id_asuransi = ma.id_asuransi', 'inner');
        
        return $this->db->get();
    }

    public function get_method()
    {
        $this->db->distinct();
        $this->db->select('mm.method, mm.id');
        $this->db->from('m_payment_method mpm');
        $this->db->join('m_method mm', 'mm.id = mpm.id_method', 'inner');
        $this->db->where('mpm.aktif', 1);
        
        return $this->db->get();
    }

    public function cari_produk_asuransi($id_asuransi)
    {
        $this->db->distinct();
        $this->db->select('l.lob, l.id_lob');
        $this->db->from('tr_produk_asuransi tpa');
        $this->db->join('m_lob l', 'l.id_lob = tpa.id_lob', 'inner');
        $this->db->where('tpa.id_asuransi', $id_asuransi);
        
        return $this->db->get();
    }
    
    public function cari_produk_asuransi_premi($id_asuransi, $id_lob)
    {
        $this->db->select('id_tr_produk_asuransi, premi');
        $this->db->from('tr_produk_asuransi ');
        $this->db->where('id_asuransi', $id_asuransi);
        $this->db->where('id_lob', $id_lob);
        
        return $this->db->get();
    }

    public function cari_pengguna_ttg($id_pengguna_ttg)
    {
        $this->db->select('n.*, p.pekerjaan');
        $this->db->from('pengguna_tertanggung n');
        $this->db->join('m_pekerjaan as p', 'p.id_pekerjaan = n.id_pekerjaan', 'left');
        $this->db->where('n.id_pengguna_tertanggung', $id_pengguna_ttg);
        
        return $this->db->get();
        
    }

    // 24-09-2021
    public function cari_sppa($id_sppa)
    {
        $this->db->select('ma.nama_asuransi, ml.lob, tpa.premi, pt.*, pm.nama as payment_method, p.pekerjaan, mm.method, ml.punya_ahli_waris, ta.no_polis, ta.tgl_awal_polis, ta.tgl_akhir_polis, ta.id_produk_asuransi');
        $this->db->from('tr_sppa_quotation as ta');
        $this->db->join('pengguna_tertanggung as pt', 'pt.id_pengguna_tertanggung = ta.id_pengguna_tertanggung', 'inner');
        $this->db->join('m_pekerjaan as p', 'p.id_pekerjaan = pt.id_pekerjaan', 'inner');
        $this->db->join('tr_pembayaran_polis as pp', 'pp.id_sppa_quotation = ta.id_sppa_quotation', 'inner');
        $this->db->join('m_payment_method as pm', 'pm.id = pp.id_payment_method', 'inner');
        $this->db->join('m_method as mm', 'mm.id = pm.id_method', 'inner');
        $this->db->join('tr_produk_asuransi tpa', 'tpa.id_tr_produk_asuransi = ta.id_produk_asuransi', 'INNER');
        $this->db->join('m_lob ml', 'ml.id_lob = tpa.id_lob', 'INNER');
        $this->db->join('m_asuransi ma', 'ma.id_asuransi = tpa.id_asuransi', 'inner');
        $this->db->where('ta.id_sppa_quotation', $id_sppa);
        
        return $this->db->get();
    }

    public function cari_ahli_waris($id_sppa)
    {
        $this->db->select('wa.*, h.hubungan_klg, h.status');
        $this->db->from('m_ahli_waris wa');
        $this->db->join('m_hubungan_klg h', 'h.id = wa.hubungan', 'inner');
        $this->db->where('wa.id_tr_sppa_quotation', $id_sppa);
        $this->db->order_by('wa.ahli_waris_ke', 'asc');
        
        return $this->db->get();
    }

    // 27-10-2021
    public function get_list_ptg()
    {
        $this->db->select('pt.id_pengguna_tertanggung, pt.nama, u.username');
        $this->db->from('m_user u');
        $this->db->join('pengguna_tertanggung pt', 'pt.id_pengguna_tertanggung = u.id_pengguna_tertanggung', 'inner');
        $this->db->order_by('pt.nama', 'asc');
        
        return $this->db->get();
    }

}

?>
