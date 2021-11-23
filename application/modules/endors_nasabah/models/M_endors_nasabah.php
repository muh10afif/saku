<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class M_endors_nasabah extends CI_Model {

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

    // 24-08-2021
    // Menampilkan list endors_nasabah
    public function get_data_endors_nasabah()
    {
        $this->_get_datatables_query_endors_nasabah();

        if ($this->input->post('length') != -1) {
            $this->db->limit($this->input->post('length'), $this->input->post('start'));
            
            return $this->db->get()->result_array();
        }
    }

    var $kolom_order_endors_nasabah = [null, 'LOWER(n.nama)'];
    var $kolom_cari_endors_nasabah  = ['LOWER(n.nama)'];
    var $order_endors_nasabah       = ['mn.nama' => 'asc'];

    public function _get_datatables_query_endors_nasabah()
    {
        $this->db->select("mn.nama, te.id_nasabah, (select e.nama_endorsment from tr_endorsment e where e.id_nasabah = te.id_nasabah order by nama_endorsment desc limit 1), (select e1.status from tr_endorsment e1 where e1.id_nasabah = te.id_nasabah order by nama_endorsment desc limit 1)");
        $this->db->from('tr_endorsment te');
        $this->db->join('pengguna_tertanggung mn', 'mn.id_pengguna_tertanggung = te.id_nasabah', 'inner');
        $this->db->group_by('mn.nama');
        $this->db->group_by('te.id_nasabah');
        
        $b = 0;
        
        $input_cari = strtolower($_POST['search']['value']);
        $kolom_cari = $this->kolom_cari_endors_nasabah;

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

            $kolom_order = $this->kolom_order_endors_nasabah;
            $this->db->order_by($kolom_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
            
        } elseif (isset($this->order_endors_nasabah)) {
            
            $order = $this->order_endors_nasabah;
            $this->db->order_by(key($order), $order[key($order)]);
            
        }
        
    }

    public function jumlah_semua_endors_nasabah()
    {
        $this->db->select("mn.nama, te.id_nasabah, (select e.nama_endorsment from tr_endorsment e where e.id_nasabah = te.id_nasabah order by nama_endorsment desc limit 1), (select e1.status from tr_endorsment e1 where e1.id_nasabah = te.id_nasabah order by nama_endorsment desc limit 1)");
        $this->db->from('tr_endorsment te');
        $this->db->join('pengguna_tertanggung mn', 'mn.id_pengguna_tertanggung = te.id_nasabah', 'inner');
        $this->db->group_by('mn.nama');
        $this->db->group_by('te.id_nasabah');

        return $this->db->count_all_results();
    }

    public function jumlah_filter_endors_nasabah()
    {
        $this->_get_datatables_query_endors_nasabah();

        return $this->db->get()->num_rows();
        
    }

}

/* End of file M_endors_nasabah.php */
