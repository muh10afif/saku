<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class M_pengguna_tertanggung extends CI_Model {

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

    // 03-11-2021
    // Menampilkan list pengguna_ptg
    public function get_data_pengguna_ptg()
    {
        $this->_get_datatables_query_pengguna_ptg();

        if ($this->input->post('length') != -1) {
            $this->db->limit($this->input->post('length'), $this->input->post('start'));
            
            return $this->db->get()->result_array();
        }
    }

    var $kolom_order_pengguna_ptg = [null, 'pt.nik',  'pt.nama', 'pt.telp', 'pt.alamat'];
    var $kolom_cari_pengguna_ptg  = ['LOWER(pt.nik)', 'LOWER(pt.nama)', 'LOWER(pt.telp)', 'LOWER(pt.alamat)'];
    var $order_pengguna_ptg       = ['pt.id_pengguna_tertanggung' => 'desc'];

    public function _get_datatables_query_pengguna_ptg()
    {
        // $a = $this->db->get_where('m_user', ['id_user' => $this->input->post('id_user')])->row_array();

        $this->db->select('pt.*, pt.id_pengguna_tertanggung as id_pengguna_ptg, p.pekerjaan, ik.*');
        $this->db->from('pengguna_tertanggung as pt');
        $this->db->join('m_pekerjaan as p', 'p.id_pekerjaan = pt.id_pekerjaan', 'left');
        $this->db->join('relasi_induk_kumpulan as ik', 'ik.id = pt.id_induk_kumpulan', 'left');

        // if ($a['id_level_user'] == 3) {
        //     $this->db->where('a.id_asuransi', $a['id_karyawan']);
        // } 
        
        $b = 0;
        
        $input_cari = strtolower($_POST['search']['value']);
        $kolom_cari = $this->kolom_cari_pengguna_ptg;

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

            $kolom_order = $this->kolom_order_pengguna_ptg;
            $this->db->order_by($kolom_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
            
        } elseif (isset($this->order_pengguna_ptg)) {
            
            $order = $this->order_pengguna_ptg;
            $this->db->order_by(key($order), $order[key($order)]);
            
        }
        
    }

    public function jumlah_semua_pengguna_ptg()
    {
        // $a = $this->db->get_where('m_user', ['id_user' => $this->input->post('id_user')])->row_array();

        $this->db->select('pt.*, pt.id_pengguna_tertanggung as id_pengguna_ptg, p.pekerjaan, ik.*');
        $this->db->from('pengguna_tertanggung as pt');
        $this->db->join('m_pekerjaan as p', 'p.id_pekerjaan = pt.id_pekerjaan', 'left');
        $this->db->join('relasi_induk_kumpulan as ik', 'ik.id = pt.id_induk_kumpulan', 'left');

        // if ($a['id_level_user'] == 3) {
        //     $this->db->where('a.id_asuransi', $a['id_karyawan']);
        // } 

        return $this->db->count_all_results();
    }

    public function jumlah_filter_pengguna_ptg()
    {
        $this->_get_datatables_query_pengguna_ptg();

        return $this->db->get()->num_rows();
        
    }

    public function get_ft_tertanggung($id_sob)
    {
        $this->db->from('relasi_induk_kumpulan');
        $this->db->where('ft_tertanggung', $id_sob);
        
        return $this->db->get();
    }

    // 04-11-2021
    public function get_ft_induk_kumpulan($id_sob, $ft_ttg, $ttg)
    {
        $this->db->from('relasi_induk_kumpulan');
        $this->db->where('ft_tertanggung', $ft_ttg);
        $this->db->where('tertanggung', $ttg);
        $this->db->where('ft_induk_kumpulan', $id_sob);

        return $this->db->get();
    }

    // 04-11-2021
    public function get_induk_kumpulan($id_induk_kumpulan, $ft_induk_kumpulan, $ft_tertanggung, $tertanggung)
    {
        $this->db->from('relasi_induk_kumpulan');
        $this->db->where('ft_tertanggung', $ft_tertanggung);
        $this->db->where('tertanggung', $tertanggung);
        $this->db->where('ft_induk_kumpulan', $ft_induk_kumpulan);
        $this->db->where('induk_kumpulan', $id_induk_kumpulan);

        return $this->db->get();
    }

    // 04-11-2021
    public function cari_data_pengguna($id_pengguna_ptg)
    {
        $this->db->select('pt.*, pt.id_pengguna_tertanggung as id_pengguna_ptg, p.pekerjaan, ik.*');
        $this->db->from('pengguna_tertanggung as pt');
        $this->db->join('m_pekerjaan as p', 'p.id_pekerjaan = pt.id_pekerjaan', 'left');
        $this->db->join('relasi_induk_kumpulan as ik', 'ik.id = pt.id_induk_kumpulan', 'left');
        $this->db->where('pt.id_pengguna_tertanggung', $id_pengguna_ptg);
        
        return $this->db->get();
    }

}

/* End of file M_pengguna_tertanggung.php */
