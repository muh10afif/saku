<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class M_master extends CI_Model {

    // 23-04-2021
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

    // 23-04-2021
    // Master Misi
    // Menampilkan list misi
    public function get_data_misi()
    {
        $this->_get_datatables_query_misi();

        if ($this->input->post('length') != -1) {
            $this->db->limit($this->input->post('length'), $this->input->post('start'));
            
            return $this->db->get()->result_array();
        }
    }

    var $kolom_order_misi = [null, 'misi'];
    var $kolom_cari_misi  = ['LOWER(misi)'];
    var $order_misi       = ['id_misi' => 'desc'];

    public function _get_datatables_query_misi()
    {
        $this->db->from('m_misi');
        
        $b = 0;
        
        $input_cari = strtolower($_POST['search']['value']);
        $kolom_cari = $this->kolom_cari_misi;

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

            $kolom_order = $this->kolom_order_misi;
            $this->db->order_by($kolom_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
            
        } elseif (isset($this->order_misi)) {
            
            $order = $this->order_misi;
            $this->db->order_by(key($order), $order[key($order)]);
            
        }
        
    }

    public function jumlah_semua_misi()
    {
        $this->db->from('m_misi');

        return $this->db->count_all_results();
    }

    public function jumlah_filter_misi()
    {
        $this->_get_datatables_query_misi();

        return $this->db->get()->num_rows();
        
    }

    // 27-04-2021
    // Menampilkan list field_sppa
    public function get_data_field_sppa()
    {
        $this->_get_datatables_query_field_sppa();

        if ($this->input->post('length') != -1) {
            $this->db->limit($this->input->post('length'), $this->input->post('start'));
            
            return $this->db->get()->result_array();
        }
    }

    var $kolom_order_field_sppa = [null, 'field_sppa'];
    var $kolom_cari_field_sppa  = ['LOWER(field_sppa)'];
    var $order_field_sppa       = ['id_field_sppa' => 'desc'];

    public function _get_datatables_query_field_sppa()
    {
        $this->db->from('m_field_sppa');
        
        $b = 0;
        
        $input_cari = strtolower($_POST['search']['value']);
        $kolom_cari = $this->kolom_cari_field_sppa;

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

            $kolom_order = $this->kolom_order_field_sppa;
            $this->db->order_by($kolom_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
            
        } elseif (isset($this->order_field_sppa)) {
            
            $order = $this->order_field_sppa;
            $this->db->order_by(key($order), $order[key($order)]);
            
        }
        
    }

    public function jumlah_semua_field_sppa()
    {
        $this->db->from('m_field_sppa');

        return $this->db->count_all_results();
    }

    public function jumlah_filter_field_sppa()
    {
        $this->_get_datatables_query_field_sppa();

        return $this->db->get()->num_rows();
        
    }

    // 27-04-2021
    // Menampilkan list introduction
    public function get_data_introduction()
    {
        $this->_get_datatables_query_introduction();

        if ($this->input->post('length') != -1) {
            $this->db->limit($this->input->post('length'), $this->input->post('start'));
            
            return $this->db->get()->result_array();
        }
    }

    var $kolom_order_introduction = [null, 'introduction'];
    var $kolom_cari_introduction  = ['LOWER(introduction)'];
    var $order_introduction       = ['id_introduction' => 'desc'];

    public function _get_datatables_query_introduction()
    {
        $this->db->from('m_introduction');
        
        $b = 0;
        
        $input_cari = strtolower($_POST['search']['value']);
        $kolom_cari = $this->kolom_cari_introduction;

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

            $kolom_order = $this->kolom_order_introduction;
            $this->db->order_by($kolom_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
            
        } elseif (isset($this->order_introduction)) {
            
            $order = $this->order_introduction;
            $this->db->order_by(key($order), $order[key($order)]);
            
        }
        
    }

    public function jumlah_semua_introduction()
    {
        $this->db->from('m_introduction');

        return $this->db->count_all_results();
    }

    public function jumlah_filter_introduction()
    {
        $this->_get_datatables_query_introduction();

        return $this->db->get()->num_rows();
        
    }

    // 27-04-2021
    // 27-04-2021
    // Menampilkan list visi
    public function get_data_visi()
    {
        $this->_get_datatables_query_visi();

        if ($this->input->post('length') != -1) {
            $this->db->limit($this->input->post('length'), $this->input->post('start'));
            
            return $this->db->get()->result_array();
        }
    }

    var $kolom_order_visi = [null, 'visi'];
    var $kolom_cari_visi  = ['LOWER(visi)'];
    var $order_visi       = ['id_visi' => 'desc'];

    public function _get_datatables_query_visi()
    {
        $this->db->from('m_visi');
        
        $b = 0;
        
        $input_cari = strtolower($_POST['search']['value']);
        $kolom_cari = $this->kolom_cari_visi;

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

            $kolom_order = $this->kolom_order_visi;
            $this->db->order_by($kolom_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
            
        } elseif (isset($this->order_visi)) {
            
            $order = $this->order_visi;
            $this->db->order_by(key($order), $order[key($order)]);
            
        }
        
    }

    public function jumlah_semua_visi()
    {
        $this->db->from('m_visi');

        return $this->db->count_all_results();
    }

    public function jumlah_filter_visi()
    {
        $this->_get_datatables_query_visi();

        return $this->db->get()->num_rows();
        
    }

    // 27-04-2021
    // Menampilkan list tipe_as
    public function get_data_tipe_as()
    {
        $this->_get_datatables_query_tipe_as();

        if ($this->input->post('length') != -1) {
            $this->db->limit($this->input->post('length'), $this->input->post('start'));
            
            return $this->db->get()->result_array();
        }
    }

    var $kolom_order_tipe_as = [null, 'tipe_as'];
    var $kolom_cari_tipe_as  = ['LOWER(tipe_as)'];
    var $order_tipe_as       = ['id_tipe_as' => 'desc'];

    public function _get_datatables_query_tipe_as()
    {
        $this->db->from('m_tipe_as');
        
        $b = 0;
        
        $input_cari = strtolower($_POST['search']['value']);
        $kolom_cari = $this->kolom_cari_tipe_as;

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

            $kolom_order = $this->kolom_order_tipe_as;
            $this->db->order_by($kolom_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
            
        } elseif (isset($this->order_tipe_as)) {
            
            $order = $this->order_tipe_as;
            $this->db->order_by(key($order), $order[key($order)]);
            
        }
        
    }

    public function jumlah_semua_tipe_as()
    {
        $this->db->from('m_tipe_as');

        return $this->db->count_all_results();
    }

    public function jumlah_filter_tipe_as()
    {
        $this->_get_datatables_query_tipe_as();

        return $this->db->get()->num_rows();
        
    }

    // Menampilkan list kategori_as
    public function get_data_kategori_as()
    {
        $this->_get_datatables_query_kategori_as();

        if ($this->input->post('length') != -1) {
            $this->db->limit($this->input->post('length'), $this->input->post('start'));
            
            return $this->db->get()->result_array();
        }
    }

    var $kolom_order_kategori_as = [null, 'kategori_as'];
    var $kolom_cari_kategori_as  = ['LOWER(kategori_as)'];
    var $order_kategori_as       = ['id_kategori_as' => 'desc'];

    public function _get_datatables_query_kategori_as()
    {
        $this->db->from('m_kategori_as');
        
        $b = 0;
        
        $input_cari = strtolower($_POST['search']['value']);
        $kolom_cari = $this->kolom_cari_kategori_as;

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

            $kolom_order = $this->kolom_order_kategori_as;
            $this->db->order_by($kolom_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
            
        } elseif (isset($this->order_kategori_as)) {
            
            $order = $this->order_kategori_as;
            $this->db->order_by(key($order), $order[key($order)]);
            
        }
        
    }

    public function jumlah_semua_kategori_as()
    {
        $this->db->from('m_kategori_as');

        return $this->db->count_all_results();
    }

    public function jumlah_filter_kategori_as()
    {
        $this->_get_datatables_query_kategori_as();

        return $this->db->get()->num_rows();
        
    }

    // Menampilkan list value
    public function get_data_value()
    {
        $this->_get_datatables_query_value();

        if ($this->input->post('length') != -1) {
            $this->db->limit($this->input->post('length'), $this->input->post('start'));
            
            return $this->db->get()->result_array();
        }
    }

    var $kolom_order_value = [null, 'value'];
    var $kolom_cari_value  = ['LOWER(value)'];
    var $order_value       = ['id_value' => 'desc'];

    public function _get_datatables_query_value()
    {
        $this->db->from('m_value');
        
        $b = 0;
        
        $input_cari = strtolower($_POST['search']['value']);
        $kolom_cari = $this->kolom_cari_value;

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

            $kolom_order = $this->kolom_order_value;
            $this->db->order_by($kolom_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
            
        } elseif (isset($this->order_value)) {
            
            $order = $this->order_value;
            $this->db->order_by(key($order), $order[key($order)]);
            
        }
        
    }

    public function jumlah_semua_value()
    {
        $this->db->from('m_value');

        return $this->db->count_all_results();
    }

    public function jumlah_filter_value()
    {
        $this->_get_datatables_query_value();

        return $this->db->get()->num_rows();
        
    }

    // 05052021
    // Menampilkan list asuransi
    public function get_data_asuransi()
    {
        $this->_get_datatables_query_asuransi();

        if ($this->input->post('length') != -1) {
            $this->db->limit($this->input->post('length'), $this->input->post('start'));
            
            return $this->db->get()->result_array();
        }
    }

    var $kolom_order_asuransi = [null, 'kode', 'asuransi', 'telp'];
    var $kolom_cari_asuransi  = ['kode','LOWER(asuransi)', 'telp'];
    var $order_asuransi       = ['id_asuransi' => 'desc'];

    public function _get_datatables_query_asuransi()
    {
        $this->db->from('m_asuransi');
        $this->db->join('m_kategori_as', 'id_kategori_as', 'left');
        $this->db->join('m_tipe_as', 'id_tipe_as', 'left');
        
        $b = 0;
        
        $input_cari = strtolower($_POST['search']['asuransi']);
        $kolom_cari = $this->kolom_cari_asuransi;

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

            $kolom_order = $this->kolom_order_asuransi;
            $this->db->order_by($kolom_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
            
        } elseif (isset($this->order_asuransi)) {
            
            $order = $this->order_asuransi;
            $this->db->order_by(key($order), $order[key($order)]);
            
        }
        
    }

    public function jumlah_semua_asuransi()
    {
        $this->db->from('m_asuransi');
        $this->db->join('m_kategori_as', 'id_kategori_as', 'left');
        $this->db->join('m_tipe_as', 'id_tipe_as', 'left');

        return $this->db->count_all_results();
    }

    public function jumlah_filter_asuransi()
    {
        $this->_get_datatables_query_asuransi();

        return $this->db->get()->num_rows();
        
    }

    // 05052021
    // Menampilkan list kota
    public function get_data_kota()
    {
        $this->_get_datatables_query_kota();

        if ($this->input->post('length') != -1) {
            $this->db->limit($this->input->post('length'), $this->input->post('start'));
            
            return $this->db->get()->result_array();
        }
    }

    var $kolom_order_kota = [null, 'k.kota', 'p.provinsi'];
    var $kolom_cari_kota  = ['LOWER(k.kode)','LOWER(p.provinsi)'];
    var $order_kota       = ['k.id_kota' => 'desc'];

    public function _get_datatables_query_kota()
    {
        $this->db->from('m_kota as k');
        $this->db->join('m_provinsi as p', 'p.id_provinsi = k.id_provinsi', 'inner');
    
        $b = 0;
        
        $input_cari = strtolower($_POST['search']['kota']);
        $kolom_cari = $this->kolom_cari_kota;

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

            $kolom_order = $this->kolom_order_kota;
            $this->db->order_by($kolom_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
            
        } elseif (isset($this->order_kota)) {
            
            $order = $this->order_kota;
            $this->db->order_by(key($order), $order[key($order)]);
            
        }
        
    }

    public function jumlah_semua_kota()
    {
        $this->db->from('m_kota as k');
        $this->db->join('m_provinsi as p', 'p.id_provinsi = k.id_provinsi', 'inner');

        return $this->db->count_all_results();
    }

    public function jumlah_filter_kota()
    {
        $this->_get_datatables_query_kota();

        return $this->db->get()->num_rows();
        
    }

    // 05052021
    // Menampilkan list provinsi
    public function get_data_provinsi()
    {
        $this->_get_datatables_query_provinsi();

        if ($this->input->post('length') != -1) {
            $this->db->limit($this->input->post('length'), $this->input->post('start'));
            
            return $this->db->get()->result_array();
        }
    }

    var $kolom_order_provinsi = [null, 'p.provinsi', 'n.negara'];
    var $kolom_cari_provinsi  = ['p.provinsi','LOWER(n.negara)'];
    var $order_provinsi       = ['p.id_provinsi' => 'desc'];

    public function _get_datatables_query_provinsi()
    {
        $this->db->from('m_provinsi as p');
        $this->db->join('m_negara as n', 'n.id_negara = p.id_negara', 'inner');
        
        $b = 0;
        
        $input_cari = strtolower($_POST['search']['provinsi']);
        $kolom_cari = $this->kolom_cari_provinsi;

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

            $kolom_order = $this->kolom_order_provinsi;
            $this->db->order_by($kolom_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
            
        } elseif (isset($this->order_provinsi)) {
            
            $order = $this->order_provinsi;
            $this->db->order_by(key($order), $order[key($order)]);
            
        }
        
    }

    public function jumlah_semua_provinsi()
    {
        $this->db->from('m_provinsi as p');
        $this->db->join('m_negara as n', 'n.id_negara = p.id_negara', 'inner');

        return $this->db->count_all_results();
    }

    public function jumlah_filter_provinsi()
    {
        $this->_get_datatables_query_provinsi();

        return $this->db->get()->num_rows();
        
    }

    // 05052021
    // Menampilkan list negara
    public function get_data_negara()
    {
        $this->_get_datatables_query_negara();

        if ($this->input->post('length') != -1) {
            $this->db->limit($this->input->post('length'), $this->input->post('start'));
            
            return $this->db->get()->result_array();
        }
    }

    var $kolom_order_negara = [null, 'negara'];
    var $kolom_cari_negara  = ['negara'];
    var $order_negara       = ['id_negara' => 'desc'];

    public function _get_datatables_query_negara()
    {
        $this->db->from('m_negara');
        
        $b = 0;
        
        $input_cari = strtolower($_POST['search']['negara']);
        $kolom_cari = $this->kolom_cari_negara;

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

            $kolom_order = $this->kolom_order_negara;
            $this->db->order_by($kolom_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
            
        } elseif (isset($this->order_negara)) {
            
            $order = $this->order_negara;
            $this->db->order_by(key($order), $order[key($order)]);
            
        }
        
    }

    public function jumlah_semua_negara()
    {
        $this->db->from('m_negara');

        return $this->db->count_all_results();
    }

    public function jumlah_filter_negara()
    {
        $this->_get_datatables_query_negara();

        return $this->db->get()->num_rows();
        
    }

    // 05052021
    // Menampilkan list parameter_scoring
    public function get_data_parameter_scoring()
    {
        $this->_get_datatables_query_parameter_scoring();

        if ($this->input->post('length') != -1) {
            $this->db->limit($this->input->post('length'), $this->input->post('start'));
            
            return $this->db->get()->result_array();
        }
    }

    var $kolom_order_parameter_scoring = [null, 'parameter_scoring'];
    var $kolom_cari_parameter_scoring  = ['parameter_scoring'];
    var $order_parameter_scoring       = ['id_parameter_scoring' => 'desc'];

    public function _get_datatables_query_parameter_scoring()
    {
        $this->db->from('m_parameter_scoring');
        
        $b = 0;
        
        $input_cari = strtolower($_POST['search']['parameter_scoring']);
        $kolom_cari = $this->kolom_cari_parameter_scoring;

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

            $kolom_order = $this->kolom_order_parameter_scoring;
            $this->db->order_by($kolom_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
            
        } elseif (isset($this->order_parameter_scoring)) {
            
            $order = $this->order_parameter_scoring;
            $this->db->order_by(key($order), $order[key($order)]);
            
        }
        
    }

    public function jumlah_semua_parameter_scoring()
    {
        $this->db->from('m_parameter_scoring');

        return $this->db->count_all_results();
    }

    public function jumlah_filter_parameter_scoring()
    {
        $this->_get_datatables_query_parameter_scoring();

        return $this->db->get()->num_rows();
        
    }
}

/* End of file M_master.php */
