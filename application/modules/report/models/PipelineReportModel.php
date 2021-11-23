<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class PipelineReportModel extends CI_Model {

    var $kolom_order_pipeline = ['tr_sppa_quotation.id_sppa_quotation'];
    var $kolom_cari_pipeline  = ['LOWER(tr_sppa_quotation.id_sppa_qiotation)'];
    var $kolom_pipeline       = ['tr_sppa_quotation.id_sppa_quotation' => 'desc'];



        //Model Pipeline
        public function get_data_pipeline($value='')
        {
            $this->_get_data_pipeline();
            if ($this->input->post('length') != -1) {
                $this->db->limit($this->input->post('length'), $this->input->post('start'));
                return $this->db->get()->result_array();
            }
        }
    
        public function _get_data_pipeline()
        {
            $this->db->select('*');
            $this->db->from('tr_sppa_quotation');
            $this->db->join('m_sob','m_sob.id_sob = tr_sppa_quotation.id_sob');
            $this->db->join('m_lob','m_lob.id_lob = tr_sppa_quotation.id_lob');
            $this->db->join('m_cob','m_cob.id_cob = tr_sppa_quotation.id_cob');
            $this->db->join('mop', 'mop.id_cob = m_cob.id_cob', 'left');
            $this->db->join('m_asuransi', 'm_asuransi.id_asuransi = mop.id_insurer','inner');
            $this->db->join('m_nasabah', 'm_nasabah.id_nasabah = mop.id_insured', 'inner');
        
            $req = $this->input->post();
            //add custom filter here
            
            if($this->input->post('start_date'))
            {
                $this->db->where('tr_sppa_quotation.add_time >=', date('Y-m-d', strtotime($this->input->post('start_date'))));
            }
            if ($this->input->post('end_date')){
                $this->db->where('tr_sppa_quotation.add_time <=', date('Y-m-d', strtotime($this->input->post('end_date'))));
            }
            
            
            $b = 0;
            $input_cari = strtolower($_POST['search']['value']);
            $kolom_cari = $this->kolom_cari_pipeline;
        
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
                $kolom_order = $this->kolom_order_pipeline;
                $this->db->order_by($kolom_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
            } elseif (isset($this->kolom_pipeline)) {
                $order = $this->kolom_pipeline;
                $this->db->order_by(key($order), $order[key($order)]);
            }
        }
        

        public function countalllistpipeline()
        {
            $this->db->select('*');
            $this->db->from('tr_sppa_quotation');
            // $this->db->join('m_kecamatan','m_kecamatan.id_kecamatan = m_desa.id_kecamatan');
            return $this->db->count_all_results();
        }
    
        public function countfilterlistpipeline()
        {
            $this->_get_data_pipeline();
            return $this->db->get()->num_rows();
        }
    
        //End Model 

}

/* End of file M_report.php */
