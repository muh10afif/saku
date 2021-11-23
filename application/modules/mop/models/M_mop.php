<?php defined('BASEPATH') OR exit('No direct script access allowed');

class M_mop extends CI_Model
{
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

    // 30-08-2021
    public function cari_lob_prod_as($id_insurer)
    {
        $this->db->select('t.*');
        $this->db->from('tr_produk_asuransi as t');
        $this->db->join('m_lob as l', 'l.id_lob = t.id_lob', 'inner');
        $this->db->where('t.id_asuransi', $id_insurer);
        
        return $this->db->get();
    }

    // Menampilkan list mop
    public function get_data_mop()
    {
        $this->_get_datatables_query_mop();

        if ($this->input->post('length') != -1) {
            $this->db->limit($this->input->post('length'), $this->input->post('start'));
            
            return $this->db->get()->result_array();
        }
    }

    var $kolom_order_mop = [null, 'm.no_reff_mop',  'm.nama_mop', 'a.nama_asuransi'];
    var $kolom_cari_mop  = ['LOWER(m.no_reff_mop)', 'LOWER(m.no_mop)', 'LOWER(m.nama_mop)', 'LOWER(a.nama_asuransi)'];
    var $order_mop       = ['m.no_reff_mop' => 'desc'];

    public function _get_datatables_query_mop()
    {
        $a = $this->db->get_where('m_user', ['id_user' => $this->input->post('id_user')])->row_array();

        $this->db->select('m.*, a.nama_asuransi');
        $this->db->from('mop as m');
        $this->db->join('m_asuransi as a', 'a.id_asuransi = m.id_insurer', 'inner');

            
        if ($a['id_level_user'] == 3) {
            $this->db->where('a.id_asuransi', $a['id_karyawan']);
        } 
        
        $b = 0;
        
        $input_cari = strtolower($_POST['search']['value']);
        $kolom_cari = $this->kolom_cari_mop;

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

            $kolom_order = $this->kolom_order_mop;
            $this->db->order_by($kolom_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
            
        } elseif (isset($this->order_mop)) {
            
            $order = $this->order_mop;
            $this->db->order_by(key($order), $order[key($order)]);
            
        }
        
    }

    public function jumlah_semua_mop()
    {
        $a = $this->db->get_where('m_user', ['id_user' => $this->input->post('id_user')])->row_array();

        $this->db->select('m.*, a.nama_asuransi');
        $this->db->from('mop as m');
        $this->db->join('m_asuransi as a', 'a.id_asuransi = m.id_insurer', 'inner');

        if ($a['id_level_user'] == 3) {
            $this->db->where('a.id_asuransi', $a['id_karyawan']);
        } 

        return $this->db->count_all_results();
    }

    public function jumlah_filter_mop()
    {
        $this->_get_datatables_query_mop();

        return $this->db->get()->num_rows();
        
    }

    // 05-08-2021
    public function get_data_insurer($id_user)
    {
        $a = $this->db->get_where('m_user', ['id_user' => $id_user])->row_array();
            
        if ($a['id_level_user'] == 3) {
            $this->db->from('m_asuransi');
            $this->db->where('id_asuransi', $a['id_karyawan']);
        } else {
            $this->db->from('m_asuransi');
        }

        return $this->db->get();
        
    }

    public function cari_lob($id_cob)
    {
        $this->db->select('l.id_lob, l.lob, r.id_relasi_cob_lob');
        $this->db->from('relasi_cob_lob as r');
        $this->db->join('m_cob as c', 'id_cob', 'inner');
        $this->db->join('m_lob as l', 'id_lob', 'inner');
        $this->db->where('r.id_cob', $id_cob);
        $this->db->order_by('l.lob', 'asc');
        
        return $this->db->get();
    }

    // 18-05-2021
    public function get_detail_mop($id_mop)
    {
        $this->db->select('m.*, a.nama_asuransi, n.nama_nasabah, ne.negara, pr.provinsi, k.kota, ke.kecamatan, d.desa');
        $this->db->from('mop as m');
        // $this->db->join('m_cob as c', 'id_cob', 'inner');
        // $this->db->join('m_lob as l', 'id_lob', 'inner');
        $this->db->join('m_negara as ne', 'id_negara', 'left');
        $this->db->join('m_provinsi as pr', 'id_provinsi', 'left');
        $this->db->join('m_kota as k', 'id_kota', 'left');
        $this->db->join('m_kecamatan as ke', 'id_kecamatan', 'left');
        $this->db->join('m_desa as d', 'id_desa', 'left');
        $this->db->join('m_asuransi as a', 'a.id_asuransi = m.id_insurer', 'inner');
        $this->db->join('m_nasabah as n', 'n.id_nasabah = m.id_insured', 'inner');
        $this->db->where('m.id_mop', $id_mop);
        
        return $this->db->get();
        
    }

    // 31-08-2021
    public function get_data_produk_asuransi($id_mop)
    {
        $this->db->select('t.*, s.nama_asuransi, l.lob');
        $this->db->from('tr_produk_asuransi as t');
        $this->db->join('m_asuransi as s', 's.id_asuransi = t.id_asuransi', 'inner');
        $this->db->join('m_lob as l', 'l.id_lob = t.id_lob', 'inner');
        $this->db->where('t.id_mop', $id_mop);
        
        return $this->db->get();
    }
}

?>
