<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class M_klaim extends CI_Model {

       //14-juni-2021 RFA
        var $kolom_order_klaim = ['tr_polis.id_polis'];
        var $kolom_cari_klaim  = ['LOWER(m_nasabah.nama_nasabah)', 'LOWER(m_cabang_bank.id_cabang_bank)'];
        var $order_klaim       = ['tr_polis.id_polis' => 'desc'];
    
        // Get Data Klaim
        public function get_data_klaim($value='')
        {
            $this->_get_data_klaim();
            if ($this->input->post('length') != -1) {
            $this->db->limit($this->input->post('length'), $this->input->post('start'));
            return $this->db->get()->result_array();
            }
        }
    
        public function _get_data_klaim()
        {
            $this->db->select('*');
            $this->db->from('tr_klaim');
            $this->db->join('m_tipe_klaim', 'm_tipe_klaim.id_tipe_klaim = tr_klaim.id_tipe_klaim', 'left');
            $this->db->join('tr_polis', 'tr_polis.id_polis = tr_klaim.id_polis', 'left');
            $this->db->join('m_nasabah', 'm_nasabah.id_nasabah = tr_polis.id_nasabah', 'left');
            $this->db->join('m_cabang_bank', 'm_cabang_bank.id_cabang_bank = tr_polis.id_cabang_bank', 'left');
            $this->db->where('tr_klaim.id_verifikator', null, TRUE);
            
            $req = $this->input->post();
            //add custom filter here
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
            
            // if ($this->input->post('tglmulai')){
            //     $this->db->where('tgl_mulai',date('Y-m-d',strtotime($this->input->post('tglmulai'))));
            // }
            if($this->input->post('kode_nasabah'))
            {
                $this->db->like('kode_nasabah', $this->input->post('kode_nasabah'));
            }
        
            
            $b = 0;
            $input_cari = strtolower($_POST['search']['value']);
            $kolom_cari = $this->kolom_cari_klaim;
    
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
            $kolom_order = $this->kolom_order_klaim;
            $this->db->order_by($kolom_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
            } elseif (isset($this->order_klaim)) {
            $order = $this->order_klaim;
            $this->db->order_by(key($order), $order[key($order)]);
            }
        }
    
        public function countfilterklaim()
        {
            $this->_get_data_klaim();
            return $this->db->get()->num_rows();
        }
    
        public function countallklaim()
        {
            $this->db->select('*');
            $this->db->from('tr_klaim');
            return $this->db->count_all_results();
        }
        
        public function get_data_list($id){
            $this->db->select('*');
            $this->db->from('tr_polis');
            $this->db->where('tr_polis.id_polis', $id);
            return $this->db->get()->row();
        }
        
        public function polis()
        {
            $this->db->select('*');
            $this->db->from('tr_polis');
            $this->db->where('tr_polis.id_verifikator is NOT NULL', null, FALSE);
            return $this->db->get()->result();
        }
        
        public function klaimtipe()
        {
            return $this->db->get('m_tipe_klaim')->result();
        }
        
        public function indikator()
        {
            return $this->db->get('m_indikator')->result();
        }
        
        public function klasifikasiklaim()
        {
            return $this->db->get('m_klasifikasi_klaim')->result();
        }
        
        public function jenisklaim()
        {
            return $this->db->get('m_jenis_klaim')->result();
        }

        //15-Juni-2021 RFA
        public function showdataklaim($id){
            $this->db->select('*');
            $this->db->from('tr_klaim');
            $this->db->join('m_tipe_klaim', 'm_tipe_klaim.id_tipe_klaim = tr_klaim.id_tipe_klaim', 'left');
            $this->db->join('tr_polis', 'tr_polis.id_polis = tr_klaim.id_polis', 'left');
            $this->db->join('m_nasabah', 'm_nasabah.id_nasabah = tr_polis.id_nasabah', 'left');
            $this->db->join('m_cabang_bank', 'm_cabang_bank.id_cabang_bank = tr_polis.id_cabang_bank', 'left');
            $this->db->where('id_klaim',$id);
            $data = $this->db->get()->result();
            return $data;
        }

        //15-Juni-2021 RFA
        public function showdatacetakklm($id){
            $this->db->select('*');
            $this->db->from('tr_klaim');
            $this->db->join('m_tipe_klaim', 'm_tipe_klaim.id_tipe_klaim = tr_klaim.id_tipe_klaim', 'left');
            $this->db->join('tr_polis', 'tr_polis.id_polis = tr_klaim.id_polis', 'left');
            $this->db->join('m_nasabah', 'm_nasabah.id_nasabah = tr_polis.id_nasabah', 'left');
            $this->db->join('m_cabang_bank', 'm_cabang_bank.id_cabang_bank = tr_polis.id_cabang_bank', 'left');
            $this->db->where('id_klaim',$id);
            $data = $this->db->get()->row_array();
            return $data;
        }
        
        // Get Data Klaim Enquiry
        public function get_data_klaimenquiry($value='')
        {
            $this->_get_data_klaimenquiry();
            if ($this->input->post('length') != -1) {
            $this->db->limit($this->input->post('length'), $this->input->post('start'));
            return $this->db->get()->result_array();
            }
        }
    
        public function _get_data_klaimenquiry()
        {
            $this->db->select('*');
            $this->db->from('tr_klaim');
            $this->db->join('m_tipe_klaim', 'm_tipe_klaim.id_tipe_klaim = tr_klaim.id_tipe_klaim', 'left');
            $this->db->join('tr_polis', 'tr_polis.id_polis = tr_klaim.id_polis', 'left');
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
            $kolom_cari = $this->kolom_cari_klaim;
    
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
            $kolom_order = $this->kolom_order_klaim;
            $this->db->order_by($kolom_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
            } elseif (isset($this->order_klaim)) {
            $order = $this->order_klaim;
            $this->db->order_by(key($order), $order[key($order)]);
            }
        }
    
        public function countfilterklaimenquiry()
        {
            $this->_get_data_klaimenquiry();
            return $this->db->get()->num_rows();
        }

        public function countallklaimenquiry()
        {
            $this->db->select('*');
            $this->db->from('tr_klaim');
            return $this->db->count_all_results();
        }

        //15-Juni-2021 RFA
        // Get Data Cetak Klaim
        public function get_data_cetakklm($value='')
        {
            $this->_get_data_cetakklm();
            if ($this->input->post('length') != -1) {
            $this->db->limit($this->input->post('length'), $this->input->post('start'));
            return $this->db->get()->result_array();
            }
        }
    
        public function _get_data_cetakklm()
        {
            $this->db->select('*');
            $this->db->from('tr_klaim');
            $this->db->join('m_tipe_klaim', 'm_tipe_klaim.id_tipe_klaim = tr_klaim.id_tipe_klaim', 'left');
            $this->db->join('tr_polis', 'tr_polis.id_polis = tr_klaim.id_polis', 'left');
            $this->db->join('m_nasabah', 'm_nasabah.id_nasabah = tr_polis.id_nasabah', 'left');
            $this->db->join('m_cabang_bank', 'm_cabang_bank.id_cabang_bank = tr_polis.id_cabang_bank', 'left');
            $this->db->where('tr_klaim.id_verifikator is NOT NULL', null, FALSE);
        
            
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
            $kolom_cari = $this->kolom_cari_klaim;
    
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
            $kolom_order = $this->kolom_order_klaim;
            $this->db->order_by($kolom_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
            } elseif (isset($this->order_klaim)) {
            $order = $this->order_klaim;
            $this->db->order_by(key($order), $order[key($order)]);
            }
        }
    
        public function countfiltercetakklm()
        {
            $this->_get_data_cetakklm();
            return $this->db->get()->num_rows();
        }

        public function countallcetakklm()
        {
            $this->db->select('*');
            $this->db->from('tr_klaim');
            return $this->db->count_all_results();
        }
        //end

        //15-Juni-2021 RFA
        // Get Data Posting Kliam
        public function get_data_postingklm($value='')
        {
            $this->_get_data_postingklm();
            if ($this->input->post('length') != -1) {
            $this->db->limit($this->input->post('length'), $this->input->post('start'));
            return $this->db->get()->result_array();
            }
        }
    
        public function _get_data_postingklm()
        {
            $this->db->select('*');
            $this->db->from('tr_klaim');
            $this->db->join('m_tipe_klaim', 'm_tipe_klaim.id_tipe_klaim = tr_klaim.id_tipe_klaim', 'left');
            $this->db->join('tr_polis', 'tr_polis.id_polis = tr_klaim.id_polis', 'left');
            $this->db->join('m_nasabah', 'm_nasabah.id_nasabah = tr_polis.id_nasabah', 'left');
            $this->db->join('m_cabang_bank', 'm_cabang_bank.id_cabang_bank = tr_polis.id_cabang_bank', 'left');
            $this->db->where('tr_klaim.id_verifikator is NOT NULL', null, FALSE);
        
            
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
            $kolom_cari = $this->kolom_cari_klaim;
    
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
            $kolom_order = $this->kolom_order_klaim;
            $this->db->order_by($kolom_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
            } elseif (isset($this->order_klaim)) {
            $order = $this->order_klaim;
            $this->db->order_by(key($order), $order[key($order)]);
            }
        }
    
        public function countfilterpostingklm()
        {
            $this->_get_data_postingklm();
            return $this->db->get()->num_rows();
        }

        public function countallpostingklm()
        {
            $this->db->select('*');
            $this->db->from('tr_klaim');
            return $this->db->count_all_results();
        }
        //end


        //21-Juni-2021 RFA
        // Get Data Posting Kliam
        public function get_data_tambahpostingklm($value='')
        {
            $this->_get_data_tambahpostingklm();
            if ($this->input->post('length') != -1) {
            $this->db->limit($this->input->post('length'), $this->input->post('start'));
            return $this->db->get()->result_array();
            }
        }
    
        public function _get_data_tambahpostingklm()
        {
            $this->db->select('*');
            $this->db->from('tr_klaim');
            $this->db->join('m_tipe_klaim', 'm_tipe_klaim.id_tipe_klaim = tr_klaim.id_tipe_klaim', 'left');
            $this->db->join('tr_polis', 'tr_polis.id_polis = tr_klaim.id_polis', 'left');
            $this->db->join('m_nasabah', 'm_nasabah.id_nasabah = tr_polis.id_nasabah', 'left');
            $this->db->join('m_cabang_bank', 'm_cabang_bank.id_cabang_bank = tr_polis.id_cabang_bank', 'left');
            $this->db->where('tr_klaim.id_verifikator is NOT NULL', null, FALSE);
        
            
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
            // if($this->input->post('tgl_mulai'))
            // {
            //     $this->db->like('tgl_mulai', $this->input->post('tgl_mulai'));
            // }
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
            $kolom_cari = $this->kolom_cari_klaim;
    
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
            $kolom_order = $this->kolom_order_klaim;
            $this->db->order_by($kolom_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
            } elseif (isset($this->order_klaim)) {
            $order = $this->order_klaim;
            $this->db->order_by(key($order), $order[key($order)]);
            }
        }
    
        public function countfiltertambahpostingklm()
        {
            $this->_get_data_tambahpostingklm();
            return $this->db->get()->num_rows();
        }

        public function countalltambahpostingklm()
        {
            $this->db->select('*');
            $this->db->from('tr_klaim');
            return $this->db->count_all_results();
        }
        //end

        //17-Juni-2021
        public function updateKlaim($id,$data)
        {
            $this->db->where('id_klaim',$id);
            return $this->db->update('tr_klaim',$data);
        }

}