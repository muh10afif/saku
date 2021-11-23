<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class M_polis extends CI_Model {

    
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
    //10-juni-2021
    var $kolom_order_polis = ['tr_polis.id_polis'];
    var $kolom_cari_polis  = ['LOWER(m_nasabah.nama_nasabah)', 'LOWER(m_cabang_bank.id_cabang_bank)'];
    var $order_polis       = ['tr_polis.id_polis' => 'desc'];

    public function get_data_polis($value='')
    {
        $this->_get_data_polis();
        if ($this->input->post('length') != -1) {
        $this->db->limit($this->input->post('length'), $this->input->post('start'));
        return $this->db->get()->result_array();
        }
    }

    public function _get_data_polis()
    {
        $this->db->select('*');
        $this->db->from('tr_polis');
        $this->db->join('m_nasabah', 'm_nasabah.id_nasabah = tr_polis.id_nasabah', 'left');
        $this->db->join('m_cabang_bank', 'm_cabang_bank.id_cabang_bank = tr_polis.id_cabang_bank', 'left');

        
        //add custom filter here
        if($this->input->post('nama_cabang_bank'))
        {
            $this->db->like('nama_cabang_bank', $this->input->post('nama_cabang_bank'));
        }
        if($this->input->post('nama_nasabah'))
        {
            $this->db->like('nama_nasabah', $this->input->post('nama_nasabah'));
        }
        if($this->input->post('no_polis'))
        {
            $this->db->like('no_polis', $this->input->post('no_polis'));
        }
        if($this->input->post('tgl_mulai'))
        {
            $this->db->like('tgl_mulai', $this->input->post('tgl_mulai'));
        }
        if($this->input->post('kode_nasabah'))
        {
            $this->db->like('kode_nasabah', $this->input->post('kode_nasabah'));
        }
        
        $b = 0;
        $input_cari = strtolower($_POST['search']['value']);
        $kolom_cari = $this->kolom_cari_polis;

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
        $kolom_order = $this->kolom_order_polis;
        $this->db->order_by($kolom_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } elseif (isset($this->order_polis)) {
        $order = $this->order_polis;
        $this->db->order_by(key($order), $order[key($order)]);
        }
    }

    public function countallpolis()
    {
        $this->db->select('*');
        $this->db->from('tr_polis');
        return $this->db->count_all_results();
    }

    public function countfilterpolis()
    {
        $this->_get_data_polis();
        return $this->db->get()->num_rows();
    }

    public function cabang_bank()
    {
        return $this->db->get('m_cabang_bank')->result();
    }

    public function nasabah()
    {
        return $this->db->get('m_nasabah')->result();
    }

    public function coverage()
    {
        return $this->db->get('coverage')->result();
    }

    public function getdatanasabah($id){
        $this->db->select('a.*');
        $this->db->from('m_nasabah as a');
        $this->db->where('a.id_nasabah', $id);
        $data = $this->db->get('m_nasabah')->row();
        return $data;
    }

    public function getdatacoverage($id){
        $this->db->select('a.*');
        $this->db->from('coverage as a');
        $this->db->where('a.id_coverage', $id);
        $data = $this->db->get('coverage')->row();
        return $data;
    }

    
    public function showdatapolis($id){
        $this->db->select('*');
        $this->db->from('tr_polis');
        $this->db->join('m_nasabah','m_nasabah.id_nasabah = tr_polis.id_nasabah', 'left');
        $this->db->join('m_cabang_bank', 'm_cabang_bank.id_cabang_bank = tr_polis.id_cabang_bank', 'left');
        $this->db->where('id_polis',$id);
        $data = $this->db->get()->result();
        return $data;
    }
    
    public function insert($data){
        $insert = $this->db->insert_batch('tr_polis', $data);
        if($insert){
            return true;
        }
    }

    //10-juni-2021 RFA
    public function showdatacetak($id){
        $this->db->select('*');
        $this->db->from('tr_polis');
        $this->db->join('m_nasabah','m_nasabah.id_nasabah = tr_polis.id_nasabah', 'left');
        $this->db->join('m_cabang_bank', 'm_cabang_bank.id_cabang_bank = tr_polis.id_cabang_bank', 'left');
        $this->db->where('id_polis',$id);
        $data = $this->db->get()->row_array();
        return $data;
    }

}