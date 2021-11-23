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
    var $kolom_cari_polis  = ['LOWER(m_nasabah.nama_nasabah)', 'LOWER(m_cabang_bank.id_cabang_bank)', 'LOWER(m_cabang_bank.nama_cabang_bank)'];
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
        $this->db->where('tr_polis.tgl_verifikasi', null);
        $this->db->where('tr_polis.id_verifikator', null);

        $req = $this->input->post();
        if($this->input->post('nama_cabang_bank'))
        {
            $this->db->like('nama_cabang_bank', $this->input->post('nama_cabang_bank'));
        }
        if($this->input->post('id_cabang_bank'))
        {
            $this->db->like('id_cabang_bank', $this->input->post('id_cabang_bank'));
        }
        if($this->input->post('nama_nasabah'))
        {
            $this->db->like('nama_nasabah', $this->input->post('nama_nasabah'));
        }
        if($this->input->post('no_polis'))
        {
            $this->db->like('no_polis', $this->input->post('no_polis'));
        }
        if($this->input->post('start_date'))
        {
            $this->db->where('tgl_mulai >=', date('Y-m-d', strtotime($this->input->post('start_date'))));
        }
        if ($this->input->post('end_date')){
            $this->db->where('tgl_mulai <=', date('Y-m-d', strtotime($this->input->post('end_date'))));
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

    public function countfilterpolis()
    {
        $this->_get_data_polis();
        return $this->db->get()->num_rows();
    }

    public function countallpolis()
    {
        $this->db->select('*');
        $this->db->from('tr_polis');
        return $this->db->count_all_results();
    }

    // Get Data Cetak Polis
    public function get_data_cetakpolis($value='')
    {
        $this->_get_data_cetakpolis();
        if ($this->input->post('length') != -1) {
        $this->db->limit($this->input->post('length'), $this->input->post('start'));
        return $this->db->get()->result_array();
        }
    }

    public function _get_data_cetakpolis()
    {
        $this->db->select('*');
        $this->db->from('tr_polis');
        $this->db->join('m_nasabah', 'm_nasabah.id_nasabah = tr_polis.id_nasabah', 'left');
        $this->db->join('m_cabang_bank', 'm_cabang_bank.id_cabang_bank = tr_polis.id_cabang_bank', 'left');
        $this->db->where('tr_polis.id_verifikator is NOT NULL', null, FALSE);
        
        
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

    public function countfiltercetakpolis()
    {
        $this->_get_data_cetakpolis();
        return $this->db->get()->num_rows();
    }

    public function countallcetakpolis()
    {
        $this->db->select('*');
        $this->db->from('tr_polis');
        return $this->db->count_all_results();
    }

    //end

    public function get_data_postingpolis($value='')
    {
        $this->_get_data_postingpolis();
        if ($this->input->post('length') != -1) {
        $this->db->limit($this->input->post('length'), $this->input->post('start'));
        return $this->db->get()->result_array();
        }
    }

    public function _get_data_postingpolis()
    {
        $this->db->select('*');
        $this->db->from('tr_polis');
        $this->db->join('m_nasabah', 'm_nasabah.id_nasabah = tr_polis.id_nasabah', 'left');
        $this->db->join('m_cabang_bank', 'm_cabang_bank.id_cabang_bank = tr_polis.id_cabang_bank', 'left');
        $this->db->join('m_asuransi', 'm_asuransi.id_asuransi = tr_polis.id_asuransi');
        $this->db->join('coverage', 'coverage.id_coverage = tr_polis.produk');
        $this->db->where('tr_polis.id_asuransi is NOT NULL', null, FALSE);
        
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

    public function countfilterpostingpolis()
    {
        $this->_get_data_postingpolis();
        return $this->db->get()->num_rows();
    }

    public function countallpostingpolis()
    {
        $this->db->select('*');
        $this->db->from('tr_polis');
        return $this->db->count_all_results();
    }
    //end

    // 18-Juni-2021 RFA
    public function get_data_simpanposting($value='')
    {
        $this->_get_data_posting();
        if ($this->input->post('length') != -1) {
        $this->db->limit($this->input->post('length'), $this->input->post('start'));
        return $this->db->get()->result_array();
        }
    }

    public function _get_data_posting()
    {
        $this->db->select('*');
        $this->db->from('tr_polis');
        $this->db->join('m_nasabah', 'm_nasabah.id_nasabah = tr_polis.id_nasabah', 'left');
        $this->db->join('m_cabang_bank', 'm_cabang_bank.id_cabang_bank = tr_polis.id_cabang_bank', 'left');
        $this->db->where('tr_polis.id_verifikator is NOT NULL', null, FALSE);
        $this->db->where('tr_polis.id_asuransi', null, TRUE);

        $req = $this->input->post();
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
        if($this->input->post('start_date'))
        {
            $this->db->where('tgl_mulai >=',date('Y-m-d',strtotime($this->input->post('start_date'))));
        }
        if ($this->input->post('end_date')){
            $this->db->where('tgl_mulai <=',date('Y-m-d',strtotime($this->input->post('end_date'))));
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

    public function countfilterposting()
    {
        $this->_get_data_posting();
        return $this->db->get()->num_rows();
    }

    public function countallposting()
    {
        $this->db->select('*');
        $this->db->from('tr_polis');
        return $this->db->count_all_results();
    }

    public function get_data_enquirypolis($value='')
    {
        $this->_get_data_enquirypolis();
        if ($this->input->post('length') != -1) {
        $this->db->limit($this->input->post('length'), $this->input->post('start'));
        return $this->db->get()->result_array();
        }
    }

    public function _get_data_enquirypolis()
    {
        $this->db->select('*');
        $this->db->from('tr_polis');
        $this->db->join('m_nasabah', 'm_nasabah.id_nasabah = tr_polis.id_nasabah', 'left');
        $this->db->join('m_cabang_bank', 'm_cabang_bank.id_cabang_bank = tr_polis.id_cabang_bank', 'left');
        
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

    public function countfilterenquirypolis()
    {
        $this->_get_data_enquirypolis();
        return $this->db->get()->num_rows();
    }

    public function countallenquirypolis()
    {
        $this->db->select('*');
        $this->db->from('tr_polis');
        return $this->db->count_all_results();
    }

    public function updatePolis($id,$data)
    {
        $this->db->where('id_polis',$id);
        return $this->db->update('tr_polis',$data);
    }

    public function cabang_bank()
    {
        return $this->db->get('m_cabang_bank')->result();
    }

    public function asuransi()
    {
        return $this->db->get('m_asuransi')->result();
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
        $this->db->join('coverage', 'coverage.id_coverage = tr_polis.produk', 'left');
        $this->db->where('id_polis',$id);
        $data = $this->db->get()->result();
        return $data;
    }

    public function showpolis($id)
    {
        $this->db->select('*');
        $this->db->from('tr_polis');
        $this->db->join('id_polis', $id);
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