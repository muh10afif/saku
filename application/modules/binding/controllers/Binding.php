<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Binding extends CI_Controller {

    public function __construct() {
    parent::__construct();
        $this->load->model('M_binding', 'binding');
        $this->load->model('entry_sppa/M_entry_sppa', 'entry_sppa');
        $this->load->model('cob_lob/m_cob', 'cob');
        $this->load->model('business_specifications/m_business_specifications', 'bsp');
        $this->load->helper('inputtype_helper');

        $this->aksi_crud        = get_role($this->session->userdata('id_level_otorisasi'));
        $this->id_lvl_otorisasi = $this->session->userdata('id_level_otorisasi');

        if($this->session->userdata('username') == "") {
            redirect(base_url(), 'refresh');
        }
    }

    public function index()
    {
        $this->lihat('non');
    }

    public function lihat($aksi)
    {
        $data = ['title'            => 'Binding Slip',
                 'aksi'             => $aksi,
                 'role'             => $this->aksi_crud,
                 'id_lvl_otoritasi' => $this->id_lvl_otorisasi,
                 'id_user'          => $this->session->userdata('sesi_id')
                ];

        $this->template->load('template/index','lihat', $data);
    }

    // 16-05-2021
    public function tampil_data_binding()
    {
        $read               = $this->input->post('read');
        $create             = $this->input->post('create');
        $update             = $this->input->post('update');
        $delete             = $this->input->post('delete');
        $id_user            = $this->input->post('id_user');
        $id_lvl_otorisasi   = $this->input->post('id_lvl_otorisasi');

        if ($read == 'true' || $id_lvl_otorisasi == 0) {
            $list = $this->binding->get_data_binding();
        } else {
            $list = [];
        }

        // $list = $this->binding->get_data_binding();

        $data = array();

        $no   = $this->input->post('start');

        $$status = "";

        foreach ($list as $o) {
            $no++;
            $tbody = array();

            if ($o['cancelation'] == 't') {
                $stc = "<span class='badge badge-danger text-center ml-2'>Cancelation</span>";
            } else {
                $stc = "";
            }

            // $cari = $this->binding->cari_data_order('tr_endorsment', ['id_sppa_quotation' => $o['id']], 'add_time', 'desc')->row_array();

            // if (!empty($cari)) {
            //     $status = "<span style='cursor:pointer' class='badge badge-primary text-center lihat_endors' id_sppa='".$o['id']."' data-id='".$cari['id_endorsment']."' sppa_number='".$o['sppa_number']."' no_polis='".$o['no_otorisasi_polis']."' cancel='".$o['cancelation']."'>Endorsment</span>";
            // }

            // if (!empty($cari)) {
            //     $status = "<span style='cursor:pointer' class='badge badge-primary text-center list_endors' data-id='".$o['id']."' sppa_number='".$o['sppa_number']."' no_polis='".$o['no_otorisasi_polis']."'>List Endorsment</span>";
            // } else {
            //     $status = '';
            // }
            
            switch ($o['id_sob']) {
                case 2:
                    $this->db->select('nama_asuransi as nama, alamat, telp');
                    $this->db->where('id_asuransi', $o['nama_sob']);
                    $data_sob = $this->db->get('m_asuransi')->row_array();
      
                    break;
                case 3:
                    $this->db->select('nama_nasabah as nama, alamat_rumah as alamat, telp');
                    $this->db->where('id_nasabah', $o['nama_sob']);
                    $data_sob = $this->db->get('m_nasabah')->row_array();
                    
                    break;
                case 4:
                    $this->db->select('nama, alamat, telp');
                    $this->db->where('id_agent', $o['nama_sob']);
                    $data_sob = $this->db->get('m_agent')->row_array();
      
                    break;
                case 6:
                    $this->db->select('nama, alamat, telp');
                    $this->db->where('id_direct', $o['nama_sob']);
                    $data_sob = $this->db->get('m_direct')->row_array();
      
                    break;
                case 5:
                    $this->db->select('nama, alamat, telp');
                    $this->db->where('id_business_partner', $o['nama_sob']);
                    $data_sob = $this->db->get('m_business_partner')->row_array();
      
                    break;
                case 7:
                    $this->db->select('nama, alamat, telp');
                    $this->db->where('id_loss_adjuster', $o['nama_sob']);
                    $data_sob = $this->db->get('m_loss_adjuster')->row_array();
                    
                    break;
                }

            $cre = $this->binding->cari_data('tr_endorsment', ['id_endorsment'   => $o['id']])->row_array();

            $cr = $this->binding->cari_data_order('tr_endorsment', ['id_sppa_quotation'   => $cre['id_sppa_quotation']], 'nama_endorsment', 'desc')->row_array();

            if ($o['sob'] == null) {
                $sob = "-";
            } else {
                $sob = wordwrap($o['sob']." - ".$data_sob['nama'],35,"<br>\n");
            }

            if ($update == 'true' || $id_lvl_otorisasi == 0) {
        
                $a1 = "<span style='cursor:pointer' class='mr-3 text-primary endors ttip' data-toggle='tooltip' data-placement='top' title='Endorsment' data-id='".$o['id']."' id_mop='".$o['id_mop']."' sppa_number='".$o['sppa_number']."' no_polis='".$o['no_otorisasi_polis']."' cancel='".$o['cancelation']."'><i class='fas fa-pencil-alt fa-lg'></i></span>";
                
            } else {
                $a1 = "";
            }

            $tbody[]    = "<div align='center'>".$no.".</div>";
            $tbody[]    = $o['sppa_number'];
            $tbody[]    = $sob;
            $tbody[]    = wordwrap($o['cob']." - ".$o['lob'],35,"<br>\n");
            $tbody[]    = $cr['nama_endorsment'];
            $tbody[]    = $stc;
            $tbody[]    = "
            
            <span style='cursor:pointer' class='mr-3 text-dark detail ttip' data-toggle='tooltip' data-placement='top' title='Detail' data-id='".$o['id']."' id_mop='".$o['id_mop']."' sppa_number='".$o['sppa_number']."' no_polis='".$o['no_otorisasi_polis']."' cancel='".$o['cancelation']."'><i class='fas fa-info-circle fa-lg'></i></span>
            
            $a1

            <span style='cursor:pointer' class='mr-3 text-primary list ttip' data-toggle='tooltip' data-placement='top' title='List Endorsment' data-id='".$o['id']."' id_mop='".$o['id_mop']."' sppa_number='".$o['sppa_number']."' no_polis='".$o['no_otorisasi_polis']."'><i class='fas fa-list-ul fa-lg'></i></span>
            <a href='".base_url()."binding/file_binding/".$o['id']."' target='_blank'>

            <span style='cursor:pointer' class='text-primary file ttip' data-toggle='tooltip' data-placement='top' title='File Binding' data-id='".$o['id']."' sppa_number='".$o['sppa_number']."' no_polis='".$o['no_otorisasi_polis']."'><i class='fas fa-file-alt fa-lg'></i></span></a>";
            $data[]     = $tbody;
        }

        if ($read == 'true' || $id_lvl_otorisasi == 0) {
            $recordsTotal       = $this->binding->jumlah_semua_binding();
            $recordsFiltered    = $this->binding->jumlah_filter_binding();
        } else {
            $recordsTotal       = 0;
            $recordsFiltered    = 0;
        }

        $output = [ "draw"             => $_POST['draw'],
                    "recordsTotal"     => $recordsTotal,
                    "recordsFiltered"  => $recordsFiltered,   
                    "data"             => $data
                ];

        // $output = [ "draw"             => $_POST['draw'],
        //             "recordsTotal"     => $this->binding->jumlah_semua_binding(),
        //             "recordsFiltered"  => $this->binding->jumlah_filter_binding(),   
        //             "data"             => $data
        //         ];

        echo json_encode($output);
    }

    // 19-07-2021
    public function endorsment($id_sppa)
    {
        $id_sppa        = $id_sppa;
        $id_sppa_lama   = $id_sppa;

        $where = ['id_sppa_quotation' => $id_sppa];

        // cari detail sob
        $cari2  = $this->entry_sppa->cari_data('tr_histori_status_sob', $where)->row_array();
        $cari3  = $this->entry_sppa->cari_data('m_sob', ['id_sob' => $cari2['id_sob']])->row_array();
        $wh_sob = $cari2['nama_sob'];

        switch ($cari2['id_sob']) {
            case 2:
                $this->db->select('nama_asuransi as nama, alamat, telp');
                $this->db->where('id_asuransi', $wh_sob);
                $data_sob = $this->db->get('m_asuransi')->row_array();

                $this->db->select('id_asuransi as id, nama_asuransi as nama, alamat, telp');
                $this->db->order_by('nama', 'asc');
                $sob = $this->db->get('m_asuransi')->result_array();
                break;
            case 3:
                $this->db->select('nama_nasabah as nama, alamat_rumah as alamat, telp');
                $this->db->where('id_nasabah', $wh_sob);
                $data_sob = $this->db->get('m_nasabah')->row_array();
                
                $this->db->select('id_nasabah as id, nama_nasabah as nama, alamat_rumah as alamat, telp');
                $this->db->order_by('nama', 'asc');
                $sob = $this->db->get('m_nasabah')->result_array();
                break;
            case 4:
                $this->db->select('nama, alamat, telp');
                $this->db->where('id_agent', $wh_sob);
                $data_sob = $this->db->get('m_agent')->row_array();

                $this->db->select('id_agent as id, nama, alamat, telp');
                $this->db->order_by('nama', 'asc');
                $sob = $this->db->get('m_agent')->result_array();
                break;
            case 6:
                $this->db->select('nama, alamat, telp');
                $this->db->where('id_direct', $wh_sob);
                $data_sob = $this->db->get('m_direct')->row_array();

                $this->db->select('id_direct as id, nama, alamat, telp');
                $this->db->order_by('nama', 'asc');
                $sob = $this->db->get('m_direct')->result_array();
                break;
            case 5:
                $this->db->select('nama, alamat, telp');
                $this->db->where('id_business_partner', $wh_sob);
                $data_sob = $this->db->get('m_business_partner')->row_array();

                $this->db->select('id_business_partner as id, nama, alamat, telp');
                $this->db->order_by('nama', 'asc');
                $sob = $this->db->get('m_business_partner')->result_array();
                break;
            case 7:
                $this->db->select('nama, alamat, telp');
                $this->db->where('id_loss_adjuster', $wh_sob);
                $data_sob = $this->db->get('m_loss_adjuster')->row_array();
                
                $this->db->select('id_loss_adjuster as id, nama, alamat, telp');
                $this->db->order_by('nama', 'asc');
                $sob = $this->db->get('m_loss_adjuster')->result_array();
                break;
            }

        $cari = $this->entry_sppa->get_sppa($id_sppa)->row_array();

        $cari_lob = $this->entry_sppa->cari_data('m_lob', ['id_lob' => $cari['id_lob']])->row_array();

        $carii_id_p = $this->entry_sppa->cari_data('tr_endorsment', ['id_endorsment' => $id_sppa])->row_array();

        // $aksi_endors = $this->input->post('aksi_endors');
        
        // if ($aksi_endors != '') {
        //     $carii_id_p = $this->entry_sppa->cari_data('tr_endorsment', ['id_endorsment' => $id_sppa])->row_array();

        //     $id_sppa = $carii_id_p['id_sppa_quotation'];
        // } else {
        //     $id_sppa = $id_sppa;
        // }

        // if ($id_sppa == '') {
        //     $id_sppa = $id_sppa_lama;
        // } else {
        //     $id_sppa = $id_sppa;
        // }

        $cpremi = $this->entry_sppa->get_premi($id_sppa)->result_array();

        $ky = "";
        foreach ($cpremi as $key => $value) {
            if ($value['status'] == 'standar') {
            $ky = $key;
            }
        }

        $ls_premi = $this->moveElement($cpremi, $ky, 0);
        
        $data = ['title'            => 'Endorsment',
                 'role'             => $this->aksi_crud,
                 'id_lvl_otoritasi' => $this->id_lvl_otorisasi,
                 'tr_sppa'          => $cari,
                 'premi'            => $ls_premi,
                 'premi_adt'        => $this->entry_sppa->get_premi_adt($id_sppa)->result_array(),
                 'sob'              => $cari3['sob'],
                 'data_sob'         => $data_sob,
                 'rs_sob'           => $sob,
                 'sel_sob'          => $wh_sob,
                 'detail_lob'       => $this->entry_sppa->get_field_sppa($cari['id_relasi_cob_lob'])->result_array(),
                 'insurer'          => $this->binding->get_data('m_asuransi')->result_array(),
                 'karyawan'         => $this->binding->get_data('m_karyawan')->result_array(),
                 'list_sob'         => $this->entry_sppa->getsob(),
                 'list_cob'         => $this->entry_sppa->list_cob(),
                 'no_reff'          => $this->entry_sppa->get_data_order('mop', 'id_mop', 'desc')->result_array(),
                 'lob'              => $this->entry_sppa->joincoblob($cari['id_cob']),
                 'lob_adt'          => $this->entry_sppa->cari_lob($cari['id_lob'])->result_array(),
                 'jenis'            => $this->input->post('jenis'),
                 'id_sppa'          => $id_sppa,
                 'id_sppa_lama'     => $id_sppa_lama,
                 'st_diskon'        => $cari_lob['diskon'],
                 'nasabah_ptg'      => $this->entry_sppa->cari_data('pengguna_tertanggung', ['id_pengguna_tertanggung' => $cari['id_pengguna_tertanggung']])->row_array(),
                 'endors'           => $this->entry_sppa->cari_data('tr_endorsment', ['id_endorsment' => $id_sppa])->row_array(),
                 'id_pgn_ptg'       => $cari['id_pengguna_tertanggung'],
                 'nama_endorsment'  => $this->nama_endorsment_sppa($carii_id_p['id_sppa_quotation']),
                 'id_sppa_dek'      => $carii_id_p['id_sppa_quotation'],
                 'id_mop'           => $cari['id_mop'],
                ];

        $this->template->load('template/index','endorsment', $data);
    }

    public function tampil_data_binding_detail_dek()
    {
        $aksi_crud = $this->aksi_crud;

        if ($aksi_crud['read'] == 'true' || $this->id_lvl_otorisasi == 0) {
            $list = $this->binding->get_data_binding_detail_dek();
        } else {
            $list = [];
        }

        // $list = $this->binding->get_data_binding();

        $data = array();

        $no   = $this->input->post('start');

        $$status = "";

        foreach ($list as $o) {
            $no++;
            $tbody = array();

           
            if ($o['status_aktif'] == 't') {
                if ($o['cancelation'] == 't') {
                    $status_aktif = "<span class='badge badge-danger text-center ml-2'>Cancelation</span>";
                    $hid = 'hidden';
                } else {
                    $status_aktif = "<span class='badge badge-success text-center ml-2'>Aktif</span>";
                    $hid = '';
                }
            } else {
                $status_aktif = "<span class='badge badge-danger text-center ml-2'>Tidak Aktif</span>";
                $hid = 'hidden';
            }

            // $cari = $this->binding->cari_data_order('tr_endorsment', ['id_sppa_quotation' => $o['id']], 'add_time', 'desc')->row_array();

            // if (!empty($cari)) {
            //     $status = "<span style='cursor:pointer' class='badge badge-primary text-center lihat_endors' id_sppa='".$o['id']."' data-id='".$cari['id_endorsment']."' sppa_number='".$o['sppa_number']."' no_polis='".$o['no_otorisasi_polis']."' cancel='".$o['cancelation']."'>Endorsment</span>";
            // }

            // if (!empty($cari)) {
            //     $status = "<span style='cursor:pointer' class='badge badge-primary text-center list_endors' data-id='".$o['id']."' sppa_number='".$o['sppa_number']."' no_polis='".$o['no_otorisasi_polis']."'>List Endorsment</span>";
            // } else {
            //     $status = '';
            // }
            
            switch ($o['id_sob']) {
                case 2:
                    $this->db->select('nama_asuransi as nama, alamat, telp');
                    $this->db->where('id_asuransi', $o['nama_sob']);
                    $data_sob = $this->db->get('m_asuransi')->row_array();
      
                    break;
                case 3:
                    $this->db->select('nama_nasabah as nama, alamat_rumah as alamat, telp');
                    $this->db->where('id_nasabah', $o['nama_sob']);
                    $data_sob = $this->db->get('m_nasabah')->row_array();
                    
                    break;
                case 4:
                    $this->db->select('nama, alamat, telp');
                    $this->db->where('id_agent', $o['nama_sob']);
                    $data_sob = $this->db->get('m_agent')->row_array();
      
                    break;
                case 6:
                    $this->db->select('nama, alamat, telp');
                    $this->db->where('id_direct', $o['nama_sob']);
                    $data_sob = $this->db->get('m_direct')->row_array();
      
                    break;
                case 5:
                    $this->db->select('nama, alamat, telp');
                    $this->db->where('id_business_partner', $o['nama_sob']);
                    $data_sob = $this->db->get('m_business_partner')->row_array();
      
                    break;
                case 7:
                    $this->db->select('nama, alamat, telp');
                    $this->db->where('id_loss_adjuster', $o['nama_sob']);
                    $data_sob = $this->db->get('m_loss_adjuster')->row_array();
                    
                    break;
                }

            $cre = $this->binding->cari_data('tr_endorsment', ['id_endorsment'   => $o['id']])->row_array();

            $cr = $this->binding->cari_data_order('tr_endorsment', ['id_sppa_quotation'   => $cre['id_sppa_quotation']], 'nama_endorsment', 'desc')->row_array();

            if ($o['sob'] == null) {
                $sob = "-";
            } else {
                $sob = wordwrap($o['sob']." - ".$data_sob['nama'],35,"<br>\n");
            }

            $tbody[]    = "<div align='center'>".$no.".</div>";
            $tbody[]    = $o['sppa_number'];
            $tbody[]    = $sob;
            $tbody[]    = wordwrap($o['cob']." - ".$o['lob'],35,"<br>\n");
            $tbody[]    = $status_aktif;
            // $tbody[]    = $cr['nama_endorsment'];
            // $tbody[]    = $stc;
            $tbody[]    = "
            <span style='cursor:pointer' class='mr-3 text-dark detail ttip' data-toggle='tooltip' data-placement='top' title='Detail' data-id='".$o['id']."' id_mop='".$o['id_mop']."' sppa_number='".$o['sppa_number']."' no_polis='".$o['no_otorisasi_polis']."' cancel='".$o['cancelation']."'><i class='fas fa-info-circle fa-lg'></i></span>
            
            <span style='cursor:pointer' class='mr-3 text-primary endors ttip' data-toggle='tooltip' data-placement='top' title='Endorsment' data-id='".$o['id']."' id_mop='".$o['id_mop']."' sppa_number='".$o['sppa_number']."' no_polis='".$o['no_otorisasi_polis']."' cancel='".$o['cancelation']."' $hid><i class='fas fa-pencil-alt fa-lg'></i></span>

            <span style='cursor:pointer' class='mr-3 text-primary list ttip' data-toggle='tooltip' data-placement='top' title='List Endorsment' data-id='".$o['id']."' id_mop='".$o['id_mop']."' sppa_number='".$o['sppa_number']."' no_polis='".$o['no_otorisasi_polis']."'><i class='fas fa-list-ul fa-lg'></i></span>

            <a href='".base_url()."binding/file_binding/".$o['id']."' target='_blank'>
            <span style='cursor:pointer' class='text-primary file ttip' data-toggle='tooltip' data-placement='top' title='File Binding' data-id='".$o['id']."' sppa_number='".$o['sppa_number']."' no_polis='".$o['no_otorisasi_polis']."'><i class='fas fa-file-alt fa-lg'></i></span></a>";
            $data[]     = $tbody;
        }

        if ($aksi_crud['read'] == 'true' || $this->id_lvl_otorisasi == 0) {
            $recordsTotal       = $this->binding->jumlah_semua_binding_detail_dek();
            $recordsFiltered    = $this->binding->jumlah_filter_binding_detail_dek();
        } else {
            $recordsTotal       = 0;
            $recordsFiltered    = 0;
        }

        $output = [ "draw"             => $_POST['draw'],
                    "recordsTotal"     => $recordsTotal,
                    "recordsFiltered"  => $recordsFiltered,   
                    "data"             => $data
                ];

        // $output = [ "draw"             => $_POST['draw'],
        //             "recordsTotal"     => $this->binding->jumlah_semua_binding(),
        //             "recordsFiltered"  => $this->binding->jumlah_filter_binding(),   
        //             "data"             => $data
        //         ];

        echo json_encode($output);
    }

    public function tampil_list_endorsment()
    {
        $list   = $this->binding->get_data_list_endors_dek();

        $id_mop = $this->input->post('id_mop');

        $data = array();

        $no   = $this->input->post('start');

        $$status = "";

        foreach ($list as $o) {
            $no++;
            $tbody = array();

            $jml = $this->binding->jumlah_aktif_sppa($id_mo, $o['nama_endorsment'])->num_rows();

            $tbody[]    = "<div align='center'>".$no.".</div>";
            $tbody[]    = $o['nama_endorsment'];
            $tbody[]    = $o['tgl'];
            $tbody[]    = $o['status'];
            // $tbody[]    = $jml;
            $tbody[]    = "
            <button class='btn btn-primary list' id_mop='".$id_mop."' nama_endors='".$o['nama_endorsment']."'>List SPPA</button>
            ";
            $data[]     = $tbody;
        }

        $output = [ "draw"             => $_POST['draw'],
                    "recordsTotal"     => $this->binding->jumlah_semua_list_endors_dek(),
                    "recordsFiltered"  => $this->binding->jumlah_filter_list_endors_dek(),   
                    "data"             => $data
                ];

        echo json_encode($output);
    }

    // 12-07-2021
    public function detail_list_sppa($id_mop, $nm_endors)
    {
        $cr = $this->binding->cari_data('mop', ['id_mop' => $id_mop])->row_array();

        $data = ['title'            => 'Detail '.$nm_endors,
                 'id_mop'           => $id_mop,
                 'mop'              => $cr,
                 'nm_endors'        => $nm_endors,
                 'role'             => $this->aksi_crud,
                 'id_lvl_otoritasi' => $this->id_lvl_otorisasi
                ];

        $this->template->load('template/index','list_sppa', $data);
    }

    // 08-07-2021
    public function list_endors($id_sppa)
    {
        $cari   = $this->binding->cari_data('tr_endorsment', ['id_endorsment' => $id_sppa])->row_array();
        $cari_p = $this->binding->cari_data('tr_sppa_quotation', ['id_sppa_quotation' => $id_sppa])->row_array();

        $data = ['title'        => 'List Endorsment',
                 'id_sppa'      => $id_sppa,
                 'id_sppa_awal' => $cari['id_sppa_quotation'],
                 'sppa_number'  => $cari_p['sppa_number'],
                 'id_mop'       => $cari_p['id_mop']
                ];

        $this->template->load('template/index','list_endors', $data);
    }

    // 25-06-2021
    public function tampil_list_sppa()
    {
        $aksi_crud = $this->aksi_crud;

        // if ($aksi_crud['read'] == 'true') {
        //     $list = $this->binding->get_data_list_sppa();
        // } else {
        //     $list = [];
        // }

        $list = $this->binding->get_data_list_sppa();

        $data = array();

        $no   = $this->input->post('start');

        $$status = "";

        foreach ($list as $o) {
            $no++;
            $tbody = array();

            if ($aksi_crud['delete'] == 'true') {
                $a2 = "<span style='cursor:pointer' class='text-danger hapus ttip' data-toggle='tooltip' data-placement='top' title='Hapus' data-id='".$o['id']."'><i class='far fa-trash-alt fa-lg'></i></span>";
                $del = true;
            } else {
                $a2 = "";
                $del = false;
            }
    
            if ($del == true) {
                $mr = 'mr-3';
            } else {
                $mr = "";
            }

            $detail = "<span style='cursor:pointer' class='".$mr." text-dark detail ttip' data-toggle='tooltip' data-placement='top' title='Detail' data-id='".$o['id']."'><i class='fas fa-info-circle fa-lg'></i></span>";

            $tbody[]    = "<div align='center'>".$no.".</div>";
            $tbody[]    = $o['sppa_number'];
            // $tbody[]    = $o['nama'];
            // $tbody[]    = $o['telp'];
            // $tbody[]    = wordwrap($o['alamat'],35,"<br>\n");
            $tbody[]    = $o['nama_endorsment'];
            $tbody[]    = $detail.$a2;
            $data[]     = $tbody;
        }

        // if ($aksi_crud['read'] == 'true') {
        //     $recordsTotal       = $this->binding->jumlah_semua_list_sppa();
        //     $recordsFiltered    = $this->binding->jumlah_filter_list_sppa();
        // } else {
        //     $recordsTotal       = 0;
        //     $recordsFiltered    = 0;
        // }

        // $output = [ "draw"             => $_POST['draw'],
        //             "recordsTotal"     => $recordsTotal,
        //             "recordsFiltered"  => $recordsFiltered,   
        //             "data"             => $data
        //         ];

        $output = [ "draw"             => $_POST['draw'],
                    "recordsTotal"     => $this->binding->jumlah_semua_list_sppa(),
                    "recordsFiltered"  => $this->binding->jumlah_filter_list_sppa(),   
                    "data"             => $data
                ];

        echo json_encode($output);
    }

    private function moveElement(&$array, $a, $b) {
        $p1 = array_splice($array, $a, 1);
        $p2 = array_splice($array, 0, $b);
        $array = array_merge($p2,$p1,$array);
  
        return $array;
    }

    // 25-06-2021
    public function detail_sppa($id_sppa, $jns = "")
    {
        $where = ['id_sppa_quotation' => $id_sppa];

        // cari detail sob
        $cari2  = $this->entry_sppa->cari_data('tr_histori_status_sob', $where)->row_array();
        $cari3  = $this->entry_sppa->cari_data('m_sob', ['id_sob' => $cari2['id_sob']])->row_array();
        $wh_sob = $cari2['nama_sob'];

        switch ($cari2['id_sob']) {
            case 2:
                $this->db->select('nama_asuransi as nama, alamat, telp');
                $this->db->where('id_asuransi', $wh_sob);
                $data_sob = $this->db->get('m_asuransi')->row_array();

                $this->db->select('id_asuransi as id, nama_asuransi as nama, alamat, telp');
                $this->db->order_by('nama', 'asc');
                $sob = $this->db->get('m_asuransi')->result_array();
                break;
            case 3:
                $this->db->select('nama_nasabah as nama, alamat_rumah as alamat, telp');
                $this->db->where('id_nasabah', $wh_sob);
                $data_sob = $this->db->get('m_nasabah')->row_array();
                
                $this->db->select('id_nasabah as id, nama_nasabah as nama, alamat_rumah as alamat, telp');
                $this->db->order_by('nama', 'asc');
                $sob = $this->db->get('m_nasabah')->result_array();
                break;
            case 4:
                $this->db->select('nama, alamat, telp');
                $this->db->where('id_agent', $wh_sob);
                $data_sob = $this->db->get('m_agent')->row_array();

                $this->db->select('id_agent as id, nama, alamat, telp');
                $this->db->order_by('nama', 'asc');
                $sob = $this->db->get('m_agent')->result_array();
                break;
            case 6:
                $this->db->select('nama, alamat, telp');
                $this->db->where('id_direct', $wh_sob);
                $data_sob = $this->db->get('m_direct')->row_array();

                $this->db->select('id_direct as id, nama, alamat, telp');
                $this->db->order_by('nama', 'asc');
                $sob = $this->db->get('m_direct')->result_array();
                break;
            case 5:
                $this->db->select('nama, alamat, telp');
                $this->db->where('id_business_partner', $wh_sob);
                $data_sob = $this->db->get('m_business_partner')->row_array();

                $this->db->select('id_business_partner as id, nama, alamat, telp');
                $this->db->order_by('nama', 'asc');
                $sob = $this->db->get('m_business_partner')->result_array();
                break;
            case 7:
                $this->db->select('nama, alamat, telp');
                $this->db->where('id_loss_adjuster', $wh_sob);
                $data_sob = $this->db->get('m_loss_adjuster')->row_array();
                
                $this->db->select('id_loss_adjuster as id, nama, alamat, telp');
                $this->db->order_by('nama', 'asc');
                $sob = $this->db->get('m_loss_adjuster')->result_array();
                break;
            }

        $cari       = $this->entry_sppa->get_sppa($id_sppa)->row_array();

        $cari_lob   = $this->entry_sppa->cari_data('m_lob', ['id_lob' => $cari['id_lob']])->row_array();

        $carii_id_p = $this->entry_sppa->cari_data('tr_endorsment', ['id_endorsment' => $id_sppa])->row_array();

        $cpremi = $this->entry_sppa->get_premi($id_sppa)->result_array();

        $ky = "";
        foreach ($cpremi as $key => $value) {
            if ($value['status'] == 'standar') {
            $ky = $key;
            }
        }

        $ls_premi = $this->moveElement($cpremi, $ky, 0);

        $data = ['tr_sppa'      => $cari,
                 'premi'        => $ls_premi,
                 'premi_adt'    => $this->entry_sppa->get_premi_adt($id_sppa)->result_array(),
                 'sob'          => $cari3['sob'],
                 'data_sob'     => $data_sob,
                 'rs_sob'       => $sob,
                 'sel_sob'      => $wh_sob,
                 'detail_lob'   => $this->entry_sppa->get_field_sppa($cari['id_relasi_cob_lob'])->result_array(),
                 'insurer'      => $this->binding->get_data('m_asuransi')->result_array(),
                 'karyawan'     => $this->binding->get_data('m_karyawan')->result_array(),
                 'list_sob'     => $this->entry_sppa->getsob(),
                 'list_cob'     => $this->entry_sppa->list_cob(),
                 'no_reff'      => $this->entry_sppa->get_data_order('mop', 'id_mop', 'desc')->result_array(),
                 'lob'          => $this->entry_sppa->joincoblob($cari['id_cob']),
                 'lob_adt'      => $this->entry_sppa->cari_lob($cari['id_lob'])->result_array(),
                 'jenis'            => $this->input->post('jenis'),
                 'id_sppa'          => $id_sppa,
                 'id_sppa_dek'      => $carii_id_p['id_sppa_quotation'],
                 'st_diskon'        => $cari_lob['diskon'],
                 'title'            => 'Detail SPPA',
                 'id_mop'           => $cari['id_mop'],
                 'nasabah_ptg'      => $this->entry_sppa->cari_data('pengguna_tertanggung', ['id_pengguna_tertanggung' => $cari['id_pengguna_tertanggung']])->row_array(),
                 'role'             => $this->aksi_crud,
                 'id_lvl_otoritas'  => $this->id_lvl_otorisasi,
                 'jenis'            => $jns
                ];

        $this->template->load('template/index','detail_sppa_dek', $data);
    }

    public function detail_sppa_aktif($id_sppa)
    {
        $where = ['id_sppa_quotation' => $id_sppa];

        // cari detail sob
        $cari2  = $this->entry_sppa->cari_data('tr_histori_status_sob', $where)->row_array();
        $cari3  = $this->entry_sppa->cari_data('m_sob', ['id_sob' => $cari2['id_sob']])->row_array();
        $wh_sob = $cari2['nama_sob'];

        switch ($cari2['id_sob']) {
            case 2:
                $this->db->select('nama_asuransi as nama, alamat, telp');
                $this->db->where('id_asuransi', $wh_sob);
                $data_sob = $this->db->get('m_asuransi')->row_array();

                $this->db->select('id_asuransi as id, nama_asuransi as nama, alamat, telp');
                $this->db->order_by('nama', 'asc');
                $sob = $this->db->get('m_asuransi')->result_array();
                break;
            case 3:
                $this->db->select('nama_nasabah as nama, alamat_rumah as alamat, telp');
                $this->db->where('id_nasabah', $wh_sob);
                $data_sob = $this->db->get('m_nasabah')->row_array();
                
                $this->db->select('id_nasabah as id, nama_nasabah as nama, alamat_rumah as alamat, telp');
                $this->db->order_by('nama', 'asc');
                $sob = $this->db->get('m_nasabah')->result_array();
                break;
            case 4:
                $this->db->select('nama, alamat, telp');
                $this->db->where('id_agent', $wh_sob);
                $data_sob = $this->db->get('m_agent')->row_array();

                $this->db->select('id_agent as id, nama, alamat, telp');
                $this->db->order_by('nama', 'asc');
                $sob = $this->db->get('m_agent')->result_array();
                break;
            case 6:
                $this->db->select('nama, alamat, telp');
                $this->db->where('id_direct', $wh_sob);
                $data_sob = $this->db->get('m_direct')->row_array();

                $this->db->select('id_direct as id, nama, alamat, telp');
                $this->db->order_by('nama', 'asc');
                $sob = $this->db->get('m_direct')->result_array();
                break;
            case 5:
                $this->db->select('nama, alamat, telp');
                $this->db->where('id_business_partner', $wh_sob);
                $data_sob = $this->db->get('m_business_partner')->row_array();

                $this->db->select('id_business_partner as id, nama, alamat, telp');
                $this->db->order_by('nama', 'asc');
                $sob = $this->db->get('m_business_partner')->result_array();
                break;
            case 7:
                $this->db->select('nama, alamat, telp');
                $this->db->where('id_loss_adjuster', $wh_sob);
                $data_sob = $this->db->get('m_loss_adjuster')->row_array();
                
                $this->db->select('id_loss_adjuster as id, nama, alamat, telp');
                $this->db->order_by('nama', 'asc');
                $sob = $this->db->get('m_loss_adjuster')->result_array();
                break;
            }

        $cari       = $this->entry_sppa->get_sppa($id_sppa)->row_array();

        $cari_lob   = $this->entry_sppa->cari_data('m_lob', ['id_lob' => $cari['id_lob']])->row_array();

        $carii_id_p = $this->entry_sppa->cari_data('tr_endorsment', ['id_endorsment' => $id_sppa])->row_array();

        $cpremi = $this->entry_sppa->get_premi($id_sppa)->result_array();

        $ky = "";
        foreach ($cpremi as $key => $value) {
            if ($value['status'] == 'standar') {
            $ky = $key;
            }
        }

        $ls_premi = $this->moveElement($cpremi, $ky, 0);

        $data = ['tr_sppa'      => $cari,
                 'premi'        => $ls_premi,
                 'premi_adt'    => $this->entry_sppa->get_premi_adt($id_sppa)->result_array(),
                 'sob'          => $cari3['sob'],
                 'data_sob'     => $data_sob,
                 'rs_sob'       => $sob,
                 'sel_sob'      => $wh_sob,
                 'detail_lob'   => $this->entry_sppa->get_field_sppa($cari['id_relasi_cob_lob'])->result_array(),
                 'insurer'      => $this->binding->get_data('m_asuransi')->result_array(),
                 'karyawan'     => $this->binding->get_data('m_karyawan')->result_array(),
                 'list_sob'     => $this->entry_sppa->getsob(),
                 'list_cob'     => $this->entry_sppa->list_cob(),
                 'no_reff'      => $this->entry_sppa->get_data_order('mop', 'id_mop', 'desc')->result_array(),
                 'lob'          => $this->entry_sppa->joincoblob($cari['id_cob']),
                 'lob_adt'      => $this->entry_sppa->cari_lob($cari['id_lob'])->result_array(),
                 'jenis'            => $this->input->post('jenis'),
                 'id_sppa'          => $id_sppa,
                 'id_sppa_dek'      => $carii_id_p['id_sppa_quotation'],
                 'st_diskon'        => $cari_lob['diskon'],
                 'title'            => 'Detail SPPA',
                 'id_mop'           => $cari['id_mop'],
                 'nasabah_ptg'      => $this->entry_sppa->cari_data('pengguna_tertanggung', ['id_pengguna_tertanggung' => $cari['id_pengguna_tertanggung']])->row_array(),
                 'role'             => $this->aksi_crud,
                 'id_lvl_otoritas'  => $this->id_lvl_otorisasi
                ];

        $this->template->load('template/index','detail_sppa_aktif', $data);
    }

    public function detail_sppa_list_endors($id_sppa)
    {
        $where = ['id_sppa_quotation' => $id_sppa];

        // cari detail sob
        $cari2  = $this->entry_sppa->cari_data('tr_histori_status_sob', $where)->row_array();
        $cari3  = $this->entry_sppa->cari_data('m_sob', ['id_sob' => $cari2['id_sob']])->row_array();
        $wh_sob = $cari2['nama_sob'];

        switch ($cari2['id_sob']) {
            case 2:
                $this->db->select('nama_asuransi as nama, alamat, telp');
                $this->db->where('id_asuransi', $wh_sob);
                $data_sob = $this->db->get('m_asuransi')->row_array();

                $this->db->select('id_asuransi as id, nama_asuransi as nama, alamat, telp');
                $this->db->order_by('nama', 'asc');
                $sob = $this->db->get('m_asuransi')->result_array();
                break;
            case 3:
                $this->db->select('nama_nasabah as nama, alamat_rumah as alamat, telp');
                $this->db->where('id_nasabah', $wh_sob);
                $data_sob = $this->db->get('m_nasabah')->row_array();
                
                $this->db->select('id_nasabah as id, nama_nasabah as nama, alamat_rumah as alamat, telp');
                $this->db->order_by('nama', 'asc');
                $sob = $this->db->get('m_nasabah')->result_array();
                break;
            case 4:
                $this->db->select('nama, alamat, telp');
                $this->db->where('id_agent', $wh_sob);
                $data_sob = $this->db->get('m_agent')->row_array();

                $this->db->select('id_agent as id, nama, alamat, telp');
                $this->db->order_by('nama', 'asc');
                $sob = $this->db->get('m_agent')->result_array();
                break;
            case 6:
                $this->db->select('nama, alamat, telp');
                $this->db->where('id_direct', $wh_sob);
                $data_sob = $this->db->get('m_direct')->row_array();

                $this->db->select('id_direct as id, nama, alamat, telp');
                $this->db->order_by('nama', 'asc');
                $sob = $this->db->get('m_direct')->result_array();
                break;
            case 5:
                $this->db->select('nama, alamat, telp');
                $this->db->where('id_business_partner', $wh_sob);
                $data_sob = $this->db->get('m_business_partner')->row_array();

                $this->db->select('id_business_partner as id, nama, alamat, telp');
                $this->db->order_by('nama', 'asc');
                $sob = $this->db->get('m_business_partner')->result_array();
                break;
            case 7:
                $this->db->select('nama, alamat, telp');
                $this->db->where('id_loss_adjuster', $wh_sob);
                $data_sob = $this->db->get('m_loss_adjuster')->row_array();
                
                $this->db->select('id_loss_adjuster as id, nama, alamat, telp');
                $this->db->order_by('nama', 'asc');
                $sob = $this->db->get('m_loss_adjuster')->result_array();
                break;
            }

        $cari       = $this->entry_sppa->get_sppa($id_sppa)->row_array();

        $cari_lob   = $this->entry_sppa->cari_data('m_lob', ['id_lob' => $cari['id_lob']])->row_array();

        $carii_id_p = $this->entry_sppa->cari_data('tr_endorsment', ['id_endorsment' => $id_sppa])->row_array();

        $id_sppa_en = $this->entry_sppa->cari_data('tr_sppa_quotation', ['sppa_number' => $cari['sppa_number'], 'status_aktif' => 't'])->row_array();

        $cpremi = $this->entry_sppa->get_premi($id_sppa)->result_array();

        $ky = "";
        foreach ($cpremi as $key => $value) {
            if ($value['status'] == 'standar') {
            $ky = $key;
            }
        }

        $ls_premi = $this->moveElement($cpremi, $ky, 0);


        $data = ['tr_sppa'          => $cari,
                 'premi'            => $ls_premi,
                 'premi_adt'        => $this->entry_sppa->get_premi_adt($id_sppa)->result_array(),
                 'sob'              => $cari3['sob'],
                 'data_sob'         => $data_sob,
                 'rs_sob'           => $sob,
                 'sel_sob'          => $wh_sob,
                 'detail_lob'       => $this->entry_sppa->get_field_sppa($cari['id_relasi_cob_lob'])->result_array(),
                 'insurer'          => $this->binding->get_data('m_asuransi')->result_array(),
                 'karyawan'         => $this->binding->get_data('m_karyawan')->result_array(),
                 'list_sob'         => $this->entry_sppa->getsob(),
                 'list_cob'         => $this->entry_sppa->list_cob(),
                 'no_reff'          => $this->entry_sppa->get_data_order('mop', 'id_mop', 'desc')->result_array(),
                 'lob'              => $this->entry_sppa->joincoblob($cari['id_cob']),
                 'lob_adt'          => $this->entry_sppa->cari_lob($cari['id_lob'])->result_array(),
                 'jenis'            => $this->input->post('jenis'),
                 'id_sppa'          => $id_sppa,
                 'id_sppa_dek'      => $carii_id_p['id_sppa_quotation'],
                 'st_diskon'        => $cari_lob['diskon'],
                 'title'            => 'Detail SPPA',
                 'id_mop'           => $cari['id_mop'],
                 'nasabah_ptg'      => $this->entry_sppa->cari_data('pengguna_tertanggung', ['id_pengguna_tertanggung' => $cari['id_pengguna_tertanggung']])->row_array(),
                 'role'             => $this->aksi_crud,
                 'id_lvl_otoritas'  => $this->id_lvl_otorisasi,
                 'id_sppa_en'       => $id_sppa_en['id_sppa_quotation']
                ];

        $this->template->load('template/index','detail_sppa_list_endors', $data);
    }

    // 18-06-2021
    public function tampil_data_binding_dek()
    {
        $read               = $this->input->post('read');
        $create             = $this->input->post('create');
        $update             = $this->input->post('update');
        $delete             = $this->input->post('delete');
        $id_user            = $this->input->post('id_user');
        $id_lvl_otorisasi   = $this->input->post('id_lvl_otorisasi');

        if ($read == 'true' || $id_lvl_otorisasi == 0) {
            $list = $this->binding->get_data_binding_dek();
        } else {
            $list = [];
        }

        // $list = $this->binding->get_data_binding_dek();

        $data = array();

        $no   = $this->input->post('start');

        $$status = "";

        foreach ($list as $o) {
            $no++;
            $tbody = array();

            // if ($o['cancelation'] == 't') {
            //     $stc = "<span class='badge badge-danger text-center ml-2'>Cancelation</span>";
            // } else {
            //     $stc = "";
            // }

            // <span style='cursor:pointer' class='mr-3 text-primary list ttip' data-toggle='tooltip' data-placement='top' title='List Pengguna Tertanggung' data-id='".$o['id_mop']."' no_polis_induk='".$o['no_polis_induk']."'><i class='mdi mdi-account-group mdi-24px'></i></span>

            // <a href='".base_url()."binding/file_binding/".$o['id']."' target='_blank'><span style='cursor:pointer' class='text-primary file ttip' data-toggle='tooltip' data-placement='top' title='File Binding' data-id='".$o['id_mop']."' no_polis_induk='".$o['no_polis_induk']."'><i class='mdi mdi-file-pdf-outline mdi-24px'></i></span></a>

            // $cari = $this->binding->cari_data_order('tr_endorsment', ['id_mop' => $o['id_mop']], 'add_time', 'desc')->row_array();

            // if (!empty($cari)) {
            //     $status = "<span style='cursor:pointer' class='badge badge-primary text-center list_endors' data-id='".$o['id_mop']."' no_mop='".$o['no_mop']."' nama_mop='".$o['nama_mop']."' no_polis_induk='".$o['no_polis_induk']."'>List Endorsment</span>";
            // } else {
            //     $status = '';
            // }

            $jml_endors = $this->binding->cari_jumlah_endors($o['id_mop'])->num_rows();
            $jml_aktif  = $this->binding->cari_jumlah_aktif($o['id_mop'])->num_rows();

            $tbody[]    = "<div align='center'>".$no.".</div>";
            $tbody[]    = $o['no_polis_induk'];
            $tbody[]    = $o['no_mop'];
            $tbody[]    = wordwrap($o['nama_mop'],30,"<br>\n");
            $tbody[]    = $o['nama_nasabah'];
            $tbody[]    = $jml_endors;
            $tbody[]    = $jml_aktif;
            // $tbody[]    = $status.$stc;
            $tbody[]    = "
            <span style='cursor:pointer' class='text-dark mr-2 detail ttip' data-toggle='tooltip' data-placement='top' title='Detail' data-id='".$o['id_mop']."' no_polis_induk='".$o['no_polis_induk']."'><i class='fas fa-info-circle fa-lg'></i></span>
            <span style='cursor:pointer' class='text-primary list_sppa ttip' data-toggle='tooltip' data-placement='top' title='List SPPA Aktif' data-id='".$o['id_mop']."' no_polis_induk='".$o['no_polis_induk']."'><i class='fas fa-list-ul  fa-lg'></i></span>
            ";
            $data[]     = $tbody;

        }

        if ($read == 'true' || $id_lvl_otorisasi == 0) {
            $recordsTotal       = $this->binding->jumlah_semua_binding_dek();
            $recordsFiltered    = $this->binding->jumlah_filter_binding_dek();
        } else {
            $recordsTotal       = 0;
            $recordsFiltered    = 0;
        }

        $output = [ "draw"             => $_POST['draw'],
                    "recordsTotal"     => $recordsTotal,
                    "recordsFiltered"  => $recordsFiltered,   
                    "data"             => $data
                ];

        // $output = [ "draw"             => $_POST['draw'],
        //             "recordsTotal"     => $this->binding->jumlah_semua_binding_dek(),
        //             "recordsFiltered"  => $this->binding->jumlah_filter_binding_dek(),   
        //             "data"             => $data
        //         ];

        echo json_encode($output);
    }

    // 19-07-2021
    public function list_sppa_aktif($id_mop)
    {
        $data = ['title'            => 'List SPPA Aktif',
                 'id_mop'           => $id_mop,
                 'role'             => $this->aksi_crud,
                 'id_lvl_otoritas'  => $this->id_lvl_otorisasi,
                 'mop'              => $this->entry_sppa->cari_data('mop', ['id_mop' => $id_mop])->row_array()
                ];

        $this->template->load('template/index','list_sppa_aktif', $data);
    }

    // 19-07-2021
    public function tampil_list_sppa_aktif()
    {
        $id_mop = $this->input->post('id_mop');

        if ($id_mop) {

            $list = $this->binding->get_sppa_aktif($id_mop)->result_array();

            $data = array();

            $no   = $this->input->post('start');

            $li = 1;
            foreach ($list as $o) {
                $no++;
                $tbody = array();

                switch ($o['id_sob']) {
                    case 2:
                        $this->db->select('nama_asuransi as nama, alamat, telp');
                        $this->db->where('id_asuransi', $o['nama_sob']);
                        $data_sob = $this->db->get('m_asuransi')->row_array();
          
                        break;
                    case 3:
                        $this->db->select('nama_nasabah as nama, alamat_rumah as alamat, telp');
                        $this->db->where('id_nasabah', $o['nama_sob']);
                        $data_sob = $this->db->get('m_nasabah')->row_array();
                        
                        break;
                    case 4:
                        $this->db->select('nama, alamat, telp');
                        $this->db->where('id_agent', $o['nama_sob']);
                        $data_sob = $this->db->get('m_agent')->row_array();
          
                        break;
                    case 6:
                        $this->db->select('nama, alamat, telp');
                        $this->db->where('id_direct', $o['nama_sob']);
                        $data_sob = $this->db->get('m_direct')->row_array();
          
                        break;
                    case 5:
                        $this->db->select('nama, alamat, telp');
                        $this->db->where('id_business_partner', $o['nama_sob']);
                        $data_sob = $this->db->get('m_business_partner')->row_array();
          
                        break;
                    case 7:
                        $this->db->select('nama, alamat, telp');
                        $this->db->where('id_loss_adjuster', $o['nama_sob']);
                        $data_sob = $this->db->get('m_loss_adjuster')->row_array();
                        
                        break;
                    }
    
                $cre = $this->binding->cari_data('tr_endorsment', ['id_endorsment'   => $o['id']])->row_array();
    
                $cr = $this->binding->cari_data_order('tr_endorsment', ['id_sppa_quotation'   => $cre['id_sppa_quotation']], 'nama_endorsment', 'desc')->row_array();
    
                if ($o['sob'] == null) {
                    $sob = "-";
                } else {
                    $sob = wordwrap($o['sob']." - ".$data_sob['nama'],35,"<br>\n");
                }

                $tbody[]    = "<div align='center'>".$no.".</div>";
                $tbody[]    = $o['sppa_number'];
                $tbody[]    = $sob;
                $tbody[]    = wordwrap($o['cob']." - ".$o['lob'],35,"<br>\n");
                $tbody[]    = $cr['nama_endorsment'];
                $tbody[]    = "<button class='btn btn-primary lihat' type='button' data-id='".$o['id_sppa_quotation']."' id_mop='".$o['id_mop']."'>Lihat</button>";
                $data[]     = $tbody;

                $li++;
            }

            
            echo json_encode(['data' => $data]);
        } else {
        echo json_encode(['data' => []]);
        }
    }

    // 09-07-2021
    public function detail_binding($id_mop)
    {
        $cari = $this->entry_sppa->cari_data('tr_sppa_quotation', ['id_mop' => $id_mop, 'cancelation' => false, 'status_aktif' => true])->num_rows();

        if ($cari == 0) {
            $sts_cancel = "tidak ada";
        } else {
            $sts_cancel = "ada";
        }

        $data = ['title'            => 'Detail Binding',
                 'id_mop'           => $id_mop,
                 'sts_cancel'       => $sts_cancel,
                 'role'             => $this->aksi_crud,
                 'id_lvl_otorisasi' => $this->id_lvl_otorisasi,
                 'mop'              => $this->entry_sppa->cari_data('mop', ['id_mop' => $id_mop])->row_array(),
                 'tr_sppa'          => $this->entry_sppa->cari_data('tr_sppa_quotation', ['id_mop' => $id_mop])->row_array()
                ];

        // $this->template->load('template/index', 'detail_binding_dek', $data);
        $this->template->load('template/index', 'detail_mop', $data);
    }

    // 21-06-2021
    public function detail_binding2($id_mop)
    {
        $cari_mop = $this->entry_sppa->cari_data('mop', ['id_mop' => $id_mop])->row_array(); 

        $cari_id = $this->entry_sppa->cari_data('tr_sppa_quotation', ['id_mop' => $id_mop])->row_array();
        $id_sppa = $cari_id['id_sppa_quotation'];

        $where = ['id_sppa_quotation' => $id_sppa];

        // cari detail sob
        $cari2  = $this->entry_sppa->cari_data('tr_histori_status_sob', $where)->row_array();
        $cari3  = $this->entry_sppa->cari_data('m_sob', ['id_sob' => $cari2['id_sob']])->row_array();
        $wh_sob = $cari2['nama_sob'];

        switch ($cari2['id_sob']) {
            case 2:
                $this->db->select('nama_asuransi as nama, alamat, telp');
                $this->db->where('id_asuransi', $wh_sob);
                $data_sob = $this->db->get('m_asuransi')->row_array();

                $this->db->select('id_asuransi as id, nama_asuransi as nama, alamat, telp');
                $this->db->order_by('nama', 'asc');
                $sob = $this->db->get('m_asuransi')->result_array();
                break;
            case 3:
                $this->db->select('nama_nasabah as nama, alamat_rumah as alamat, telp');
                $this->db->where('id_nasabah', $wh_sob);
                $data_sob = $this->db->get('m_nasabah')->row_array();
                
                $this->db->select('id_nasabah as id, nama_nasabah as nama, alamat_rumah as alamat, telp');
                $this->db->order_by('nama', 'asc');
                $sob = $this->db->get('m_nasabah')->result_array();
                break;
            case 4:
                $this->db->select('nama, alamat, telp');
                $this->db->where('id_agent', $wh_sob);
                $data_sob = $this->db->get('m_agent')->row_array();

                $this->db->select('id_agent as id, nama, alamat, telp');
                $this->db->order_by('nama', 'asc');
                $sob = $this->db->get('m_agent')->result_array();
                break;
            case 6:
                $this->db->select('nama, alamat, telp');
                $this->db->where('id_direct', $wh_sob);
                $data_sob = $this->db->get('m_direct')->row_array();

                $this->db->select('id_direct as id, nama, alamat, telp');
                $this->db->order_by('nama', 'asc');
                $sob = $this->db->get('m_direct')->result_array();
                break;
            case 5:
                $this->db->select('nama, alamat, telp');
                $this->db->where('id_business_partner', $wh_sob);
                $data_sob = $this->db->get('m_business_partner')->row_array();

                $this->db->select('id_business_partner as id, nama, alamat, telp');
                $this->db->order_by('nama', 'asc');
                $sob = $this->db->get('m_business_partner')->result_array();
                break;
            case 7:
                $this->db->select('nama, alamat, telp');
                $this->db->where('id_loss_adjuster', $wh_sob);
                $data_sob = $this->db->get('m_loss_adjuster')->row_array();
                
                $this->db->select('id_loss_adjuster as id, nama, alamat, telp');
                $this->db->order_by('nama', 'asc');
                $sob = $this->db->get('m_loss_adjuster')->result_array();
                break;
            }

        $cari = $this->entry_sppa->get_sppa($id_sppa)->row_array();

        $cpremi = $this->entry_sppa->get_premi($id_sppa)->result_array();

        $ky = "";
        foreach ($cpremi as $key => $value) {
            if ($value['status'] == 'standar') {
            $ky = $key;
            }
        }

        $ls_premi = $this->moveElement($cpremi, $ky, 0);

        $data = ['title'            => 'Detail Binding',
                 'tr_sppa'          => $cari,
                 'premi'            => $ls_premi,
                 'premi_adt'        => $this->entry_sppa->get_premi_adt($id_sppa)->result_array(),
                 'sob'              => $cari3['sob'],
                 'data_sob'         => $data_sob,
                 'rs_sob'           => $sob,
                 'sel_sob'          => $wh_sob,
                 'detail_lob'       => $this->entry_sppa->get_field_sppa($cari['id_relasi_cob_lob'])->result_array(),
                 'insurer'          => $this->binding->get_data('m_asuransi')->result_array(),
                 'karyawan'         => $this->binding->get_data('m_karyawan')->result_array(),
                 'list_sob'         => $this->entry_sppa->getsob(),
                 'list_cob'         => $this->entry_sppa->list_cob(),
                 'no_reff'          => $this->entry_sppa->get_data_order('mop', 'id_mop', 'desc')->result_array(),
                 'lob'              => $this->entry_sppa->joincoblob($cari['id_cob']),
                 'lob_adt'          => $this->entry_sppa->cari_lob($cari['id_lob'])->result_array(),
                 'jenis'            => $this->input->post('jenis'),
                 'id_sppa'          => $id_sppa,
                 'id_mop'           => $id_mop,
                 'no_polis_induk'   => $cari_mop['no_polis_induk'],
                 'nama_mop'         => $cari_mop['nama_mop'],
                 'no_mop'           => $cari_mop['no_mop'],
                 'id_relasi'        => $cari['id_relasi_cob_lob'],
                 'list_field'       => $this->binding->get_field($cari['id_relasi_cob_lob'])->result_array(),
                 'role'             => $this->aksi_crud,
                 'id_lvl_otorisasi' => $this->id_lvl_otorisasi
                ];

        $this->template->load('template/index','detail_deklarasi', $data);
    }

    // 21-06-2021
    public function tampil_tertanggung()
    {
        $list = $this->binding->list_tertanggung()->result_array();

        $data = array();

        $no   = $this->input->post('start');

        foreach ($list as $o) {
            $no++;
            $tbody = array();

            $tbody[]    = "<div align='center'>".$no.".</div>";

            $ir = $this->binding->get_field($this->input->post('id_relasi'))->result_array();

            foreach ($ir as $i) {
                $fi = strtolower(str_replace(" ", "_", $i['field_sppa']));
                $tbody[]    = $o[$fi];                
            }

            $tbody[]    = $o['filename'];
            $data[]     = $tbody;
        }

        
        echo json_encode(['data' => $data]);

    }

    // 21-06-2021
    public function tampil_tertanggung_detail()
    {
        $list = $this->binding->list_tertanggung_detail()->result_array();

        $data = array();

        $no   = $this->input->post('start');

        foreach ($list as $o) {
            $no++;
            $tbody = array();

            $tbody[]    = "<div align='center'>".$no.".</div>";

            // $ir = $this->binding->get_field($this->input->post('id_relasi'))->result_array();

            // foreach ($ir as $i) {
            //     $fi = strtolower(str_replace(" ", "_", $i['field_sppa']));
            //     $tbody[]    = $o[$fi];                
            // }

            // $tbody[]    = $o['filename'];
            $tbody[]    = $o['sppa_number'];
            $data[]     = $tbody;
        }

        
        echo json_encode(['data' => $data]);

    }

    // 21-06-2021
    public function tampil_dok($aksi = '')
    {
        $id_mop = $this->input->post('id_mop');

        $list = $this->entry_sppa->cari_data_order('dokumen_mop', ['id_mop' => $id_mop], 'add_time', 'desc')->result_array();

        $data = array();

        $no   = $this->input->post('start');

        foreach ($list as $o) {
            $no++;
            $tbody = array();

            if ($aksi == 'endors') {
                $ak = "<a href='".base_url()."upload/dokumen/".$o['filename']."' class='mr-3 ttip' data-toggle='tooltip' data-placement='top' title='Download'><i class='far fa-file-alt fa-lg'></i></a><span style='cursor:pointer' class='mr-3 text-primary edit ttip' data-toggle='tooltip' data-placement='top' title='Ubah' data-id='".$o['id_dokumen_mop']."' desc='".$o['description']."' filename='".$o['filename']."'><i class='fas fa-pencil-alt fa-lg'></i></span><span style='cursor:pointer' class='text-danger hapus ttip' data-toggle='tooltip' data-placement='top' title='Hapus' data-id='".$o['id_dokumen_mop']."' desc='".$o['description']."' filename='".$o['filename']."'><i class='far fa-trash-alt fa-lg'></i></span>";
            } else {
                $ak = "<a href='".base_url()."upload/dokumen/".$o['filename']."'><button class='btn btn-primary'>Download</button></a>";
            }

            $tbody[]    = "<div align='center'>".$no.".</div>";
            $tbody[]    = wordwrap($o['description'],35,"<br>\n");;
            $tbody[]    = wordwrap($o['filename'],35,"<br>\n");
            $tbody[]    = $o['size'];
            $tbody[]    = $ak;
            $data[]     = $tbody;
        }

        
        echo json_encode(['data' => $data]);
    }

    // 21-07-2021
    public function tampil_dok_mop()
    {
        $id_mop = $this->input->post('id_mop');

        $list = $this->entry_sppa->cari_data_order('dokumen_mop', ['id_mop' => $id_mop], 'add_time', 'desc')->result_array();

        $data = array();

        $no   = $this->input->post('start');

        foreach ($list as $o) {
            $no++;
            $tbody = array();

            $ak = "<a href='".base_url()."upload/dokumen/".$o['filename']."' class='ttip' data-toggle='tooltip' data-placement='top' title='Download'><i class='text-primary far fa-file-alt fa-lg
            '></i></a>";

            $tbody[]    = "<div align='center'>".$no.".</div>";
            $tbody[]    = wordwrap($o['description'],35,"<br>\n");;
            $tbody[]    = wordwrap($o['filename'],35,"<br>\n");
            $tbody[]    = $o['size'];
            $tbody[]    = date("d-m-Y H:i:s", strtotime($o['updated_time']));
            $tbody[]    = $ak;
            $data[]     = $tbody;
        }

        
        echo json_encode(['data' => $data]);
    }

    // 21-06-2021
    public function simpan_dokumen()
    {
        $aksi           = $this->input->post('aksi');
        $desc           = $this->input->post('desc');
        $id_dokumen     = $this->input->post('id_dokumen');
        $nama_dokumen   = $this->input->post('nama_dokumen');
        $id_mop         = $this->input->post('id_mop');

        $config['upload_path']    ="./upload/dokumen";
        $config['allowed_types']  ='*';
        $config['max_size']       = 20000;
        $config['encrypt_name']   = false;
        
        $this->load->library('upload',$config);

        if ($aksi == 'Hapus') {

            $path = "./upload/dokumen/".$nama_dokumen;
            unlink($path); 

            $this->db->delete('dokumen_mop', ['id_dokumen_mop' => $id_dokumen]);

            echo json_encode(['status' => true]);

        } elseif ($aksi == 'Ubah') {
        
            if ($_FILES["dokumen"]["name"] == '') {

                $data = [   'description'       => $desc,
                            'id_mop'            => $id_mop,
                            'add_by'            => $this->session->userdata('sesi_id'),
                            'add_time'          => date('Y-m-d H:i:s', now('Asia/Jakarta'))
                        ];
            
                $this->db->update('dokumen_mop', $data, ['id_dokumen_mop' => $id_dokumen]);

                echo json_encode(['status' => true]);
                
            } else {

                if($this->upload->do_upload("dokumen")){

                    $path = "./upload/dokumen/".$nama_dokumen;
                    unlink($path); 

                    $data = array('upload_data' => $this->upload->data());
                
                    $desc  = $this->input->post('desc');
                    $file  = $data['upload_data']['file_name']; 
                    $size  = $_FILES['dokumen']['size']; 
                
                    $data = [   'description'   => $desc,
                                'filename'      => $file,
                                'size'          => $this->formatSizeUnits($size),
                                'id_mop'        => $id_mop,
                                'add_by'        => $this->session->userdata('sesi_id'),
                                'add_time'      => date('Y-m-d H:i:s', now('Asia/Jakarta'))
                            ];
                    
                    $this->db->update('dokumen_mop', $data, ['id_dokumen_mop' => $id_dokumen]);
                
                    echo json_encode(['status' => true]);

                } else {

                    echo json_encode(['status' => false]);
                    
                }
            }
        
        } else {

            if($this->upload->do_upload("dokumen")){

                $data = array('upload_data' => $this->upload->data());
        
                $desc  = $this->input->post('desc');
                $file  = $data['upload_data']['file_name']; 
                $size  = $_FILES['dokumen']['size']; 
        
                $data = [   'description'   => $desc,
                            'filename'      => $file,
                            'size'          => $this->formatSizeUnits($size),
                            'id_mop'        => $id_mop,
                            'add_by'        => $this->session->userdata('sesi_id'),
                            'add_time'      => date('Y-m-d H:i:s', now('Asia/Jakarta'))
                        ];
                
                $this->db->insert('dokumen_mop', $data);
        
                echo json_encode(['status' => true]);
            } else {
                echo json_encode(['status' => false]);
            }
        
        }
        
    }

    public function tampil_data_termin_dek()
    {
        $id_mop = $this->input->post('id_mop');

        if ($id_mop) {
        
        $list = $this->entry_sppa->cari_data_order('tr_termin_pembayaran', ['id_mop' => $id_mop], 'add_time', 'desc')->result_array();

        $data = array();

        $no   = $this->input->post('start');

        foreach ($list as $o) {
            $no++;
            $tbody = array();

            $tbody[]    = "<div align='center'>".$no.".</div>";
            $tbody[]    = $o['no_dokumen'];
            $tbody[]    = date("d-M-Y", strtotime($o['tgl_bayar']));
            $tbody[]    = number_format($o['jumlah'],0,',','.');
            $tbody[]    = $o['cara_bayar'];
            $tbody[]    = date("d-M-Y", strtotime($o['tgl_terima']));
            $data[]     = $tbody;
        }

        
        echo json_encode(['data' => $data]);
        } else {
        echo json_encode(['data' => []]);
        }

    }

    function formatSizeUnits($bytes)
    {
        if ($bytes >= 1073741824)
        {
            $bytes = number_format($bytes / 1073741824, 2) . ' GB';
        }
        elseif ($bytes >= 1048576)
        {
            $bytes = number_format($bytes / 1048576, 2) . ' MB';
        }
        elseif ($bytes >= 1024)
        {
            $bytes = number_format($bytes / 1024, 2) . ' KB';
        }
        elseif ($bytes > 1)
        {
            $bytes = $bytes . ' bytes';
        }
        elseif ($bytes == 1)
        {
            $bytes = $bytes . ' byte';
        }
        else
        {
            $bytes = '0 bytes';
        }

        return $bytes;
    }

    // 21-06-2021
    public function tampil_detail_sppa_dek()
    {
        $id_mop     = $this->input->post('id_mop');
        
        $cari_mop   = $this->entry_sppa->cari_data('mop', ['id_mop' => $id_mop])->row_array(); 

        $cari_id = $this->entry_sppa->cari_data('tr_sppa_quotation', ['id_mop' => $id_mop])->row_array();
        $id_sppa = $cari_id['id_sppa_quotation'];

        $where = ['id_sppa_quotation' => $id_sppa];

        // cari detail sob
        $cari2  = $this->entry_sppa->cari_data('tr_histori_status_sob', $where)->row_array();
        $cari3  = $this->entry_sppa->cari_data('m_sob', ['id_sob' => $cari2['id_sob']])->row_array();
        $wh_sob = $cari2['nama_sob'];

        switch ($cari2['id_sob']) {
            case 2:
                $this->db->select('nama_asuransi as nama, alamat, telp');
                $this->db->where('id_asuransi', $wh_sob);
                $data_sob = $this->db->get('m_asuransi')->row_array();

                $this->db->select('id_asuransi as id, nama_asuransi as nama, alamat, telp');
                $this->db->order_by('nama', 'asc');
                $sob = $this->db->get('m_asuransi')->result_array();
                break;
            case 3:
                $this->db->select('nama_nasabah as nama, alamat_rumah as alamat, telp');
                $this->db->where('id_nasabah', $wh_sob);
                $data_sob = $this->db->get('m_nasabah')->row_array();
                
                $this->db->select('id_nasabah as id, nama_nasabah as nama, alamat_rumah as alamat, telp');
                $this->db->order_by('nama', 'asc');
                $sob = $this->db->get('m_nasabah')->result_array();
                break;
            case 4:
                $this->db->select('nama, alamat, telp');
                $this->db->where('id_agent', $wh_sob);
                $data_sob = $this->db->get('m_agent')->row_array();

                $this->db->select('id_agent as id, nama, alamat, telp');
                $this->db->order_by('nama', 'asc');
                $sob = $this->db->get('m_agent')->result_array();
                break;
            case 6:
                $this->db->select('nama, alamat, telp');
                $this->db->where('id_direct', $wh_sob);
                $data_sob = $this->db->get('m_direct')->row_array();

                $this->db->select('id_direct as id, nama, alamat, telp');
                $this->db->order_by('nama', 'asc');
                $sob = $this->db->get('m_direct')->result_array();
                break;
            case 5:
                $this->db->select('nama, alamat, telp');
                $this->db->where('id_business_partner', $wh_sob);
                $data_sob = $this->db->get('m_business_partner')->row_array();

                $this->db->select('id_business_partner as id, nama, alamat, telp');
                $this->db->order_by('nama', 'asc');
                $sob = $this->db->get('m_business_partner')->result_array();
                break;
            case 7:
                $this->db->select('nama, alamat, telp');
                $this->db->where('id_loss_adjuster', $wh_sob);
                $data_sob = $this->db->get('m_loss_adjuster')->row_array();
                
                $this->db->select('id_loss_adjuster as id, nama, alamat, telp');
                $this->db->order_by('nama', 'asc');
                $sob = $this->db->get('m_loss_adjuster')->result_array();
                break;
            }

        $cari = $this->entry_sppa->get_sppa($id_sppa)->row_array();

        $cari_lob = $this->entry_sppa->cari_data('m_lob', ['id_lob' => $cari['id_lob']])->row_array();

        $cpremi = $this->entry_sppa->get_premi($id_sppa)->result_array();

        $ky = "";
        foreach ($cpremi as $key => $value) {
            if ($value['status'] == 'standar') {
            $ky = $key;
            }
        }

        $ls_premi = $this->moveElement($cpremi, $ky, 0);

        $data = ['tr_sppa'          => $cari,
                 'premi'            => $ls_premi,
                 'premi_adt'        => $this->entry_sppa->get_premi_adt($id_sppa)->result_array(),
                 'sob'              => $cari3['sob'],
                 'data_sob'         => $data_sob,
                 'rs_sob'           => $sob,
                 'sel_sob'          => $wh_sob,
                 'detail_lob'       => $this->entry_sppa->get_field_sppa($cari['id_relasi_cob_lob'])->result_array(),
                 'insurer'          => $this->binding->get_data('m_asuransi')->result_array(),
                 'karyawan'         => $this->binding->get_data('m_karyawan')->result_array(),
                 'list_sob'         => $this->entry_sppa->getsob(),
                 'list_cob'         => $this->entry_sppa->list_cob(),
                 'no_reff'          => $this->entry_sppa->get_data_order('mop', 'id_mop', 'desc')->result_array(),
                 'lob'              => $this->entry_sppa->joincoblob($cari['id_cob']),
                 'lob_adt'          => $this->entry_sppa->cari_lob($cari['id_lob'])->result_array(),
                 'jenis'            => $this->input->post('jenis'),
                 'id_sppa'          => $id_sppa,
                 'id_mop'           => $id_mop,
                 'no_polis_induk'   => $cari_mop['no_polis_induk'],
                 'nama_mop'         => $cari_mop['nama_mop'],
                 'no_mop'           => $cari_mop['no_mop'],
                 'id_relasi'        => $cari['id_relasi_cob_lob'],
                 'list_field'       => $this->binding->get_field($cari['id_relasi_cob_lob'])->result_array(),
                 'kondisi_diskon'   => $this->entry_sppa->cari_data('m_lob', ['id_lob' => $cari['id_lob']])->row_array(),
                 'st_diskon'        => $cari_lob['diskon']
                ];

        $this->load->view('endorsment_sppa_dek', $data); 
        
    }

    // 21-06-2021
    public function tampil_data_termin_endors()
    {
        $id_mop = $this->input->post('id_mop');
        
        $list = $this->entry_sppa->cari_data_order('tr_termin_pembayaran', ['id_mop' => $id_mop], 'add_time', 'desc')->result_array();

        $data = array();

        $no   = $this->input->post('start');

        foreach ($list as $o) {
            $no++;
            $tbody = array();

            $tbody[]    = "<div align='center'>".$no.".</div>";
            $tbody[]    = $o['no_dokumen'];
            $tbody[]    = date("d-M-Y", strtotime($o['tgl_bayar']));
            $tbody[]    = number_format($o['jumlah'],0,',','.');
            $tbody[]    = $o['cara_bayar'];
            $tbody[]    = date("d-M-Y", strtotime($o['tgl_terima']));
            $tbody[]    = "<span style='cursor:pointer' class='mr-3 text-primary edit ttip' data-toggle='tooltip' data-placement='top' title='Ubah' data-id='".$o['id_termin_pembayaran']."'><i class='fas fa-pencil-alt fa-lg'></i></span><span style='cursor:pointer' class='text-danger hapus ttip' data-toggle='tooltip' data-placement='top' title='Hapus' data-id='".$o['id_termin_pembayaran']."'><i class='far fa-trash-alt fa-lg'></i></span>";

            $data[]     = $tbody;
        }

        
        echo json_encode(['data' => $data]);

    }

    public function simpan_data_termin()
    {
        $aksi           = $this->input->post('aksi');
        $id_termin      = $this->input->post('id_termin');
        $id_mop         = $this->input->post('id_mop');
        $no_dokumen     = $this->input->post('no_dokumen');
        $tgl_bayar      = $this->input->post('tgl_bayar');
        $jumlah         = $this->input->post('jumlah');
        $cara_bayar     = $this->input->post('cara_bayar');
        $tgl_terima     = $this->input->post('tgl_terima');

        $data = [   'id_mop' => $id_mop,
                    'no_dokumen'        => $no_dokumen,
                    'tgl_bayar'         => date("Y-m-d H:i:s", strtotime($tgl_bayar)),
                    'jumlah'            => $jumlah,
                    'cara_bayar'        => $cara_bayar,
                    'tgl_terima'        => date("Y-m-d H:i:s", strtotime($tgl_terima)),
                    'add_time'          => date("Y-m-d H:i:s", now('Asia/Jakarta')),
                    'add_by'            => $this->session->userdata('sesi_id')
                ];

        if ($aksi == 'Tambah') {
            $this->entry_sppa->input_data('tr_termin_pembayaran', $data);
        } elseif ($aksi == 'Ubah') {
            $this->entry_sppa->ubah_data('tr_termin_pembayaran', $data, array('id_termin_pembayaran' => $id_termin));
        } elseif ($aksi == 'Hapus') {
            $this->entry_sppa->hapus_data('tr_termin_pembayaran', array('id_termin_pembayaran' => $id_termin));
        }

        echo json_encode($aksi);
    }

    public function ambil_data_termin($id_termin)
    {
        $cari = $this->entry_sppa->cari_data('tr_termin_pembayaran', ['id_termin_pembayaran' => $id_termin])->row_array();

        echo json_encode($cari);
    }

    function hapus_value_array($array,$value)
    {
        foreach($array as $key=>$val)
        {
            if($val == $value)
            {
                unset($array[$key]);
            }
        }
        return $array;
    }

    public function sppa_number($id_sppa = '')
  {
    $cari = $this->entry_sppa->get_data_order('tr_sppa_quotation', 'id_sppa_quotation', 'desc')->row_array();

    // $thn = date('Y');

    // if (!empty($cari)) {
      
    //   $a =  strpos($cari['sppa_number'], $thn);
    //   $b =  strlen($cari['sppa_number']); 

    //   $c =  substr($cari['sppa_number'], $a + 6, $b);

    //   $a = (int) "$c" + 1;

    //   $kd = str_pad($a, 5, "0", STR_PAD_LEFT);

    // } else {
    //     $kd = str_pad(1, 5, "0", STR_PAD_LEFT);
    // }

    if ($id_sppa == '') {
      $idp = $cari['id_sppa_quotation'] + 1;
    } else {
      $idp = $id_sppa;
    }

    $kd = str_pad($idp, 5, "0", STR_PAD_LEFT);

    $thn = date('Y');

    $kode = "TMP.SPPA-$thn.A".$kd;

    return $kode;
  }

    public function no_polis()
    {
        $thn    = date('ymd', now('Asia/Jakarta'));
        $b      = random_int(1000, 10000);

        $kode   = "$thn$b";

        return $kode;
    }

    // 21-06-2021
    public function simpan_semua_deklarasi()
    {
        $f_client = $this->input->post('form_client');

        $client = array();
        parse_str($f_client, $client);

        $id_sppa        = $client['id_sppa'];
        $id_mop         = $client['id_mop'];
        $id_sob         = $client['id_sob'];
        $id_cob         = $client['id_cob'];
        $id_lob         = $client['id_lob'];
        $nama_sob       = $client['nama_sob'];
        $id_relasi      = $client['id_relasi'];
        $sppa_number    = $client['sppa_number'];
        $id_entry_sppa  = $client['id_entry_sppa'];

        $nm_endorsment  = $this->nama_endorsment($id_mop);

        $this->db->trans_begin();

        // $data = [ 'id_sob'            => ($id_sob == '') ? null : $id_sob,
        //           'id_cob'            => $id_cob,
        //           'id_lob'            => $id_lob,
        //           'id_relasi_cob_lob' => $id_relasi,
        //           'sppa_number'       => $sppa_number,
        //           'add_time'          => date("Y-m-d H:i:s", now('Asia/Jakarta')),
        //           'add_by'            => $this->session->userdata('sesi_id')
        //       ];

        //   if ($id_sppa != '') {
        //     $this->entry_sppa->ubah_data('tr_sppa_quotation', $data, ['id_sppa_quotation' => $id_sppa]);
        //     $id_sppa = $id_sppa;
        //   } else {
        //     $this->entry_sppa->input_data('tr_sppa_quotation', $data);
        //     $id_sppa = $this->db->insert_id();
        //   }

        $path = $_FILES["upload_excel"]["tmp_name"];
        $object = PHPExcel_IOFactory::load($path);

        $a = 0;
        foreach($object->getWorksheetIterator() as $worksheet)
        {
            $highestRow   = $worksheet->getHighestRow();

            $rw = 2;
            for($row1=0; $row1 <= $highestRow; $row1++) {
            $tt = $worksheet->getCellByColumnAndRow($row1, 1)->getValue();
            $hd = str_replace(' ', '_', strtolower($tt));

            $tem[] = $hd;

            $rw++;
            }

            $te = $this->hapus_value_array($tem, "");

            for($row=2; $row<=$highestRow; $row++)
            {

            $temp3 = [];
            $temp2 = [];
            for ($i=0; $i < count($te); $i++) { 

                $field = $worksheet->getCellByColumnAndRow($i, $row)->getValue();

                $temp2 += [$te[$i] => $field];

                $temp3 = $temp2;
                
            }

            $temp4[] = $temp3;
            
            }
            
            $a++;
        }

        // save cdb
        foreach ($temp4 as $k) {

            $dt  = [];
            $dt2 = [];
            foreach ($k as $key => $value) {

            $ky = str_replace('_', ' ', $key);

            $k = ucwords($ky);

            $cari = $this->entry_sppa->cari_data('m_field_sppa', ['field_sppa' => $k])->row_array();

            // jika ada field yang tidak ada di field sppa
            if (empty($cari)) {

                $data1 = ['field_sppa'  => $k,
                        'data_type'   => 'VARCHAR',
                        'cdb'         => true,
                        'add_time'    => date('Y-m-d H:i:s', now('Asia/Jakarta')),
                        'add_by'      => $this->session->userdata('sesi_id')
                        ];

                $this->db->insert('m_field_sppa', $data1);

                $this->db->query("ALTER TABLE pengguna_tertanggung ADD COLUMN $key VARCHAR");

            }

            $cari2 = $this->entry_sppa->cari_data('m_field_sppa', ['field_sppa' => $k])->row_array();

            if ($cari2['cdb'] == 't') {

                $dt += [$key => $value];

            } else {

                $dt2 += [$key => $value];
            }

            
            }

            $dt += ['add_by'  => $this->session->userdata('sesi_id')];

            $this->db->insert('pengguna_tertanggung', $dt);
            $pt = $this->db->insert_id();

            if (empty($dt2)) {
            $dt22 = [   'id_sob'            => ($id_sob == '') ? null : $id_sob,
                        'id_cob'            => $id_cob,
                        'id_lob'            => $id_lob,
                        'id_relasi_cob_lob' => $id_relasi,
                        'id_mop'            => $id_mop,
                        'approval'          => true,
                        'status_aktif'      => true
                    ];

            } else {
            $dt22 = $dt2;
            }
            
            $this->db->insert('tr_sppa_quotation', $dt22);
            $pq = $this->db->insert_id();
            
            if ($pt != '') {
            $this->db->update('tr_sppa_quotation', ['id_pengguna_tertanggung' => $pt], ['id_sppa_quotation' => $pq]);
            } 

            if ($pt != '') {
            $dt3 = [    'id_sob'            => ($id_sob == '') ? null : $id_sob,
                        'id_cob'            => $id_cob,
                        'id_lob'            => $id_lob,
                        'id_relasi_cob_lob' => $id_relasi,
                        'id_mop'            => $id_mop,
                        'approval'          => true,
                        'status_aktif'      => true,
                        'sppa_number'       => $this->sppa_number($pq)
                    ];

            $this->db->update('tr_sppa_quotation', $dt3, ['id_sppa_quotation' => $pq]);
            }

            // histori status sob
            $nama = $dt['nama'];
            $telp = $dt['telp'];

            if ($dt['nama'] && $dt['telp']) {

            $arr = ['insurer', 'insured', 'agent', 'direct', 'business_partner', 'loss_adjuster'];
            
            for ($i=0; $i < count($arr); $i++) { 

                $el = $arr[$i];

                if ($el == 'insurer') {
                $el = 'asuransi';
                }
                if ($el == 'insured') {
                $el = 'nasabah';
                }

                if ($el == 'asuransi') {
                $nm = 'nama_asuransi';
                } elseif ($el == 'nasabah') {
                $nm = 'nama_nasabah';
                } else {
                $nm = 'nama';
                }

                $this->db->where($nm, $nama);
                $this->db->where('telp', $telp);
                $data_sob = $this->db->get("m_$el")->row_array();

                if (!empty($data_sob)) {
                $id_detail_sobb = $data_sob["id_$el"];
                }

                // cari di sob
                $nm_el = ucwords(str_replace("_", " ", $arr[$i]));
                
                $cr_sob = $this->entry_sppa->cari_data("m_sob", ['sob' => $nm_el])->row_array();
                $id_sobb = $cr_sob["id_sob"];

            }

            if ($id_sobb != '' && $id_detail_sobb != '') {

                $dt_h = ['id_sob'             => $id_sobb,
                        'nama_sob'           => $id_detail_sobb,
                        'tanggal_perubahan'  => date("Y-m-d"),
                        'id_sppa_quotation'  => $pq,
                        'add_time'           => date('Y-m-d H:i:s', now('Asia/Jakarta')),
                        'add_by'             => $this->session->userdata('sesi_id')
                        ];

                $this->db->insert('tr_histori_status_sob', $dt_h);

            } else {

                $datah = ['id_sob'            => ($id_sob == '') ? null : $id_sob,
                        'nama_sob'          => $nama_sob,
                        'id_sppa_quotation' => $pq,
                        'tanggal_perubahan' => date("Y-m-d", now('Asia/Jakarta')),
                        'add_time'          => date("Y-m-d H:i:s", now('Asia/Jakarta')),
                        'add_by'            => $this->session->userdata('sesi_id')
                        ];

                $this->db->insert('tr_histori_status_sob', $datah);
                
            }
            
            } else {

            $datah = ['id_sob'            => ($id_sob == '') ? null : $id_sob,
                        'nama_sob'          => $nama_sob,
                        'id_sppa_quotation' => $pq,
                        'tanggal_perubahan' => date("Y-m-d", now('Asia/Jakarta')),
                        'add_time'          => date("Y-m-d H:i:s", now('Asia/Jakarta')),
                        'add_by'            => $this->session->userdata('sesi_id')
                    ];

            $this->db->insert('tr_histori_status_sob', $datah);
            
            }
            //akhir histori status sob

            // mop
            
                $cari = $this->entry_sppa->cari_data('mop', ['id_mop' => $id_mop])->row_array();

                $data_approve = [   'id_sppa_quotation'    => $pq, 
                                    'id_asuransi'          => $cari['id_insurer'],
                                    'no_otorisasi_polis'   => $this->no_polis(),
                                    'tgl_otorisasi'        => date("Y-m-d H:i:s",  now('Asia/Jakarta')),
                                    'tgl_approve'          => date("Y-m-d H:i:s", now('Asia/Jakarta')),
                                    'id_pegawai'           => $this->session->userdata('id_karyawan'),
                                    'keterangan_tambahan'  => "",
                                    'add_time'             => date("Y-m-d H:i:s", now('Asia/Jakarta')),
                                    'add_by'               => $this->session->userdata('sesi_id')
                                ];

                $this->entry_sppa->input_data('tr_approve_sppa', $data_approve);

                $cari2 = $this->entry_sppa->cari_data('tr_approve_sppa', ['id_sppa_quotation' => $pq])->row_array();

                $this->db->update('tr_sppa_quotation', ['approval' => true, 'no_polis' => $cari2['no_otorisasi_polis']], ['id_sppa_quotation' => $pq]);
                    
            // akhir mop

            // endorsment 

            $datal = [  'id_sppa_quotation'     => $pq, 
                        'id_endorsment'         => $pq, 
                        'id_mop'                => $id_mop,
                        'status'                => "tambah peserta",
                        'nama_endorsment'       => $nm_endorsment,
                        'add_time'              => date("Y-m-d H:i:s", now('Asia/Jakarta')),
                        'add_by'                => $this->session->userdata('sesi_id')
                    ];

            $this->entry_sppa->input_data('tr_endorsment', $datal);

            // akhir endorsment

            // dok 
            $this->db->update('dokumen_sppa', ['id_sppa_quotation' => $pq], ['sppa_number' => $this->sppa_number()]);

            // cari
            $c_l = $this->entry_sppa->cari_data('coverage', ['id_lob' => $id_lob])->num_rows();

            if ($c_l != 0) {

                // premi
                $tsi                = ($this->input->post('tsi') == '') ? null : $this->input->post('tsi');    
                $diskon             = ($this->input->post('diskon') == '') ? null : $this->input->post('diskon');    
                $total_persen_premi = ($this->input->post('total_persen_premi') == '') ? null : $this->input->post('total_persen_premi');    
                $total_akhir_premi  = ($this->input->post('total_akhir_premi') == '') ? null : $this->input->post('total_akhir_premi');    
                $biaya_admin        = ($this->input->post('biaya_admin') == '') ? null : $this->input->post('biaya_admin');    
                $total_tagihan      = ($this->input->post('total_tagihan') == '') ? null : $this->input->post('total_tagihan');    
                $payment_method     = ($this->input->post('payment_method') == '') ? null : $this->input->post('payment_method');    
                $tahun_pay          = ($this->input->post('tahun_pay') == '') ? null : $this->input->post('tahun_pay');    
                $jumlah_cicilan     = ($this->input->post('jumlah_cicilan') == '') ? null : $this->input->post('jumlah_cicilan');    

                // array
                $lob_adt            = json_decode($this->input->post('lob_adt'), true);    
                $kalkulasi_tsi_adt  = json_decode($this->input->post('kalkulasi_tsi_adt'), true);    
                $pengali_tsi_adt    = json_decode($this->input->post('pengali_tsi_adt'), true);    
                $rate_adt           = json_decode($this->input->post('rate_adt'), true);    
                $nominal_adt        = json_decode($this->input->post('nominal_adt'), true);    
                $rate_all_premi     = json_decode($this->input->post('rate_all_premi'), true);    
                $nominal_all_premi  = json_decode($this->input->post('nominal_all_premi'), true);    
                $id_coverage        = json_decode($this->input->post('id_coverage'), true);    
                $premi_standar      = json_decode($this->input->post('premi_standar'), true);    
                $premi_perluasan    = json_decode($this->input->post('premi_perluasan'), true);    

                // print_r($lob_adt); exit();

                // simpan tr sppa
                $jml    = count($premi_standar);
                $jml_p  = count($premi_perluasan);
                
                $tt_premi_standar = 0;
                for ($i=0; $i < $jml; $i++) { 
                
                $tt_premi_standar += $premi_standar[$i];

                }

                $tt_premi_pls = 0;
                for ($k=0; $k < $jml_p; $k++) { 
                
                $tt_premi_pls += $premi_perluasan[$k];

                }

                $datatt = [ 'total_sum_insured'       => $tsi,
                            'diskon'                  => $diskon,
                            'total_akhir_premi'       => str_replace('.','', $total_akhir_premi),
                            'total_rate_akhir_premi'  => $total_persen_premi,
                            'total_premi_standar'     => $tt_premi_standar,
                            'total_premi_perluasan'   => $tt_premi_pls,
                            'biaya_admin'             => $biaya_admin,
                            'total_tagihan'           => $total_tagihan,
                            'payment_method'          => $payment_method,
                            'tahun_cicilan'           => ($tahun_pay) ? $tahun_pay : null,
                            'jumlah_cicilan'          => ($jumlah_cicilan) ? $jumlah_cicilan : null,
                            'sppa_number'             => $this->sppa_number($pq)
                        ];

                $where = ['id_sppa_quotation' => $pq];

                $this->db->update('tr_sppa_quotation', $datatt, $where);

                // cek jika ada premi
                $cari = $this->entry_sppa->cari_data('tr_premi', $where)->num_rows();

                if ($cari != 0) {
                $this->db->delete('tr_premi', $where);
                }

                // input premi  
                $jml_c  = count($id_coverage);
                $data_c = [];

                for ($j=0; $j < $jml_c; $j++) { 
                
                $data_c[] = [   'id_sppa_quotation' => $pq,
                                'id_coverage'       => $id_coverage[$j],
                                'rate'              => $rate_all_premi[$j],
                                'nominal'           => str_replace('.','', $nominal_all_premi[$j]),
                                'add_time'          => date("Y-m-d H:i:s", now('Asia/Jakarta')),
                                'add_by'            => $this->session->userdata('sesi_id')
                            ];

                }

                $this->db->insert_batch('tr_premi', $data_c);

                // cek jika ada premi adt
                $cari_a = $this->entry_sppa->cari_data('tr_premi_adt', $where)->num_rows();

                if ($cari_a != 0) {
                $this->db->delete('tr_premi_adt', $where);
                }

                // input premi adt 
                $jml_a  = count($lob_adt);

                if ($jml_a != 0) {

                $data_a = [];

                for ($k=0; $k < $jml_a; $k++) { 
                    
                    $data_a[] = [   'id_sppa_quotation' => $pq,
                                    'id_lob'            => $lob_adt[$k],
                                    'pengali_tsi'       => $pengali_tsi_adt[$k],
                                    'kalkulasi_tsi'     => str_replace('.','', $kalkulasi_tsi_adt[$k]),
                                    'rate'              => $rate_adt[$k],
                                    'nominal'           => str_replace('.','', $nominal_adt[$k]),
                                    'add_time'          => date("Y-m-d H:i:s", now('Asia/Jakarta')),
                                    'add_by'            => $this->session->userdata('sesi_id')
                                ];

                }

                $this->db->insert_batch('tr_premi_adt', $data_a);

                }

            }

            // generate invoice
            $nm       = str_pad($pq, 5, "0", STR_PAD_LEFT);
            $date     = date("Ymd", now('Asia/Jakarta'));
            $random   = strtoupper(bin2hex(random_bytes(4)));

            $nmr_invoice = "INV/$date/Entry/$random";

            $where = ['id_sppa_quotation' => $pq];

            $cari11 = $this->entry_sppa->cari_data('tr_sppa_quotation', $where)->row_array();

            if ($cari11['no_invoice_entry'] == '') {
                $this->db->update('tr_sppa_quotation', ['no_invoice_entry' => $nmr_invoice], $where);
            }

            // cari detail sob
            $cari2  = $this->entry_sppa->cari_data('tr_histori_status_sob', $where)->row_array();
            $cari3  = $this->entry_sppa->cari_data('m_sob', ['id_sob' => $cari2['id_sob']])->row_array();
            $wh_sob = $cari2['nama_sob'];

                switch ($cari2['id_sob']) {
                    case 2:
                    $this->db->select('nama_asuransi as nama, alamat, telp');
                    $this->db->where('id_asuransi', $wh_sob);
                    $data_sob = $this->db->get('m_asuransi')->row_array();
                    break;
                    case 3:
                    $this->db->select('nama_nasabah as nama, alamat_rumah as alamat, telp');
                    $this->db->where('id_nasabah', $wh_sob);
                    $data_sob = $this->db->get('m_nasabah')->row_array();
                    break;
                    case 4:
                    $this->db->select('nama, alamat, telp');
                    $this->db->where('id_agent', $wh_sob);
                    $data_sob = $this->db->get('m_agent')->row_array();
                    break;
                    case 6:
                    $this->db->select('nama, alamat, telp');
                    $this->db->where('id_direct', $wh_sob);
                    $data_sob = $this->db->get('m_direct')->row_array();
                    break;
                    case 5:
                    $this->db->select('nama, alamat, telp');
                    $this->db->where('id_business_partner', $wh_sob);
                    $data_sob = $this->db->get('m_business_partner')->row_array();
                    break;
                    case 7:
                    $this->db->select('nama, alamat, telp');
                    $this->db->where('id_loss_adjuster', $wh_sob);
                    $data_sob = $this->db->get('m_loss_adjuster')->row_array();
                    break;
                }

            $cpremi = $this->entry_sppa->get_premi($pq)->result_array();

            $ky = "";
            foreach ($cpremi as $key => $value) {
                if ($value['status'] == 'standar') {
                $ky = $key;
                }
            }
        
            $ls_premi = $this->moveElement($cpremi, $ky, 0);

            $datai = [  'tr_sppa'    => $this->entry_sppa->cari_data('tr_sppa_quotation', $where)->row_array(),
                        'premi'      => $ls_premi,
                        'premi_adt'  => $this->entry_sppa->get_premi_adt($pq)->result_array(),
                        'sob'        => $cari3['sob'],
                        'data_sob'   => $data_sob
                    ];

            $mpdf = new \Mpdf\Mpdf();
            $html = $this->load->view('binding/invoice',$datai,true);

            $mpdf->WriteHTML($html);
            $mpdf->Output("upload/entry/INV$nm.pdf",'F');

            $nm_file = "INV$nm.pdf";

            $where = ['id_sppa_quotation' => $pq];

            $this->db->update('tr_sppa_quotation', ['file_invoice' => $nm_file], $where);
            
            // termin 
            $this->db->update('tr_termin_pembayaran', ['id_sppa_quotation' => $pq], ['sppa_number' => $this->sppa_number($pq)]);
            
            
        }

        if($this->db->trans_status() === FALSE){
        $this->db->trans_rollback();

        echo json_encode(['status' => false]);
        }else{
        $this->db->trans_commit();

        echo json_encode(['id_sppa' => ""]);
        }
        
    }

    // nama endorsment
    public function nama_endorsment($id_mop)
    {
        $cari = $this->entry_sppa->cari_data_order('tr_endorsment', ['id_mop' => $id_mop], 'nama_endorsment', 'desc')->row_array();

        if ($cari != "") {

            $a =  strpos($cari['nama_endorsment'], "-");
            $b =  strlen($cari['nama_endorsment']); 
      
            $c =  substr($cari['nama_endorsment'], $a + 1, $b);
      
            $a = (int) "$c" + 1;
      
            $kd = str_pad($a, 5, "0", STR_PAD_LEFT);
      
        } else {
            $kd = str_pad(1, 5, "0", STR_PAD_LEFT);
        }

        return "Endorsment-".$kd;
    }
    public function nama_endorsment_sppa($id_sppa)
    {
        $cari = $this->entry_sppa->cari_data_order('tr_endorsment', ['id_sppa_quotation' => $id_sppa], 'nama_endorsment', 'desc')->row_array();

        if ($cari != "") {

            $a =  strpos($cari['nama_endorsment'], "-");
            $b =  strlen($cari['nama_endorsment']); 
      
            $c =  substr($cari['nama_endorsment'], $a + 1, $b);
      
            $a = (int) "$c" + 1;
      
            $kd = str_pad($a, 5, "0", STR_PAD_LEFT);
      
        } else {
            $kd = str_pad(1, 5, "0", STR_PAD_LEFT);
        }

        return "Endorsment-".$kd;
    }

    public function ubah_cancelation()
    {
        $id_mop = $this->input->post('id_mop');

        $this->db->trans_begin();

        // cari sppa cancelation false
        $cari = $this->binding->cari_data('tr_sppa_quotation', ['status_aktif' => true, 'cancelation' => false, 'id_mop' => $id_mop])->result_array();

        $nm_endorsment = $this->nama_endorsment($id_mop);

        foreach ($cari as $c) {
            
            $id_sppa = $c['id_sppa_quotation'];

            // cari id_sppa_awal 
            $cari2 = $this->binding->cari_data('tr_endorsment', ['id_endorsment' => $id_sppa])->row_array();

            $datal = [  'id_sppa_quotation'     => $cari2['id_sppa_quotation'], 
                        'id_endorsment'         => $id_sppa, 
                        'status'                => "CANCELATION",
                        'id_mop'                => $id_mop,
                        'nama_endorsment'       => $nm_endorsment,
                        'add_time'              => date("Y-m-d H:i:s", now('Asia/Jakarta')),
                        'add_by'                => $this->session->userdata('sesi_id')
                    ];

            $this->entry_sppa->input_data('tr_endorsment', $datal);

        }
        
        $this->db->update('tr_sppa_quotation', ['cancelation' => true], ['id_mop' => $id_mop]);

        if($this->db->trans_status() === FALSE){
            $this->db->trans_rollback();

            echo json_encode(['status' => false]);
        }else{
            $this->db->trans_commit();

            echo json_encode(['status' => true]);
        }
    }

    public function ubah_cancelation_sppa()
    {
        $id_sppa        = $this->input->post('id_sppa');
        $id_sppa_awal   = $this->input->post('id_sppa_awal');
        $id_mop         = $this->input->post('id_mop');

        if ($id_mop != '') {
            $nm_endorsment  = $this->nama_endorsment($id_mop);
            $id_mop         = $id_mop;
        } else {
            $nm_endorsment  = $this->nama_endorsment_sppa($id_sppa_awal);
            $id_mop         = null;
        }

        $this->db->trans_begin();

            $datal = [  'id_sppa_quotation'     => $id_sppa_awal, 
                        'id_endorsment'         => $id_sppa, 
                        'status'                => "CANCELATION",
                        'id_mop'                => $id_mop,
                        'nama_endorsment'       => $nm_endorsment,
                        'add_time'              => date("Y-m-d H:i:s", now('Asia/Jakarta')),
                        'add_by'                => $this->session->userdata('sesi_id')
                    ];

            $this->entry_sppa->input_data('tr_endorsment', $datal);
        
            $this->db->update('tr_sppa_quotation', ['cancelation' => true], ['id_sppa_quotation' => $id_sppa]);

        if($this->db->trans_status() === FALSE){
            $this->db->trans_rollback();

            echo json_encode(['status' => false]);
        }else{
            $this->db->trans_commit();

            echo json_encode(['status' => true]);
        }
        
    }

    // 24-05-2021
    public function tampil_list_endors()
    {
        $id_sppa = $this->input->post('id_sppa');

        if ($id_sppa) {
            // $list = $this->entry_sppa->cari_data_order('tr_endorsment', ['id_sppa_quotation' => $id_sppa], 'add_time', 'asc')->result_array();

            $list = $this->binding->get_endors($id_sppa)->result_array();

            $data = array();

            $no   = $this->input->post('start');

            foreach ($list as $o) {
                $no++;
                $tbody = array();

                $tbody[]    = "<div align='center'>".$no.".</div>";
                $tbody[]    = $o['nama_endorsment'];
                $tbody[]    = date("d-M-Y H:i:s", strtotime($o['add_time']));
                $tbody[]    = $o['status'];
                $tbody[]    = "<button class='btn btn-primary detail' type='button' data-id='".$o['id_endorsment']."' sppa_number='".$o['sppa_number']."' id_sppa='".$o['id_sppa']."' no_polis='".$o['no_otorisasi_polis']."'>Lihat</button>";
                $data[]     = $tbody;
            }

            
            echo json_encode(['data' => $data]);
        } else {
        echo json_encode(['data' => []]);
        }

    }

    // 21-06-2021
    public function tampil_list_endors_dek()
    {
        $id_mop = $this->input->post('id_mop');

        if ($id_mop) {

            $list = $this->binding->get_endors_dek($id_mop)->result_array();

            $data = array();

            $no   = $this->input->post('start');

            $li = 1;
            foreach ($list as $o) {
                $no++;
                $tbody = array();

                $tbody[]    = "<div align='center'>".$no.".</div>";
                $tbody[]    = $o['nama_endorsment'];
                $tbody[]    = $o['tanggal'];
                $tbody[]    = $o['status'];
                $tbody[]    = "<button class='btn btn-primary lihat' type='button'  data-nama='".$o['nama_endorsment']."' id_mop='".$o['id_mop']."'>Lihat</button>";
                $data[]     = $tbody;

                $li++;
            }

            
            echo json_encode(['data' => $data]);
        } else {
        echo json_encode(['data' => []]);
        }

    }

    // 21-06-2021
    public function tampil_lihat_endors()
    {
        $id_mop         = $this->input->post('id_mop');
        $nama_endors    = $this->input->post('nama');

        $cari = $this->binding->cari_data('tr_sppa_quotation', ['id_mop' => $id_mop])->row_array();

        $data = ['list_field'           => $this->binding->get_field($cari['id_relasi_cob_lob'])->result_array(),
                 'id_mop'               => $id_mop,
                 'nama_endors'          => $nama_endors,
                 'id_relasi_cob_lob'    => $cari['id_relasi_cob_lob']
                ];

        $this->load->view('lihat_endors', $data);
        
        
    }

    // 24-05-2021
    public function file_binding($id_sppa)
    {
        $where = ['id_sppa_quotation' => $id_sppa];

        // cari detail sob
        $cari2  = $this->entry_sppa->cari_data('tr_histori_status_sob', $where)->row_array();
        $cari3  = $this->entry_sppa->cari_data('m_sob', ['id_sob' => $cari2['id_sob']])->row_array();
        $wh_sob = $cari2['nama_sob'];

            switch ($cari2['id_sob']) {
                case 2:
                $this->db->select('nama_asuransi as nama, alamat, telp');
                $this->db->where('id_asuransi', $wh_sob);
                $data_sob = $this->db->get('m_asuransi')->row_array();
                break;
                case 3:
                $this->db->select('nama_nasabah as nama, alamat_rumah as alamat, telp');
                $this->db->where('id_nasabah', $wh_sob);
                $data_sob = $this->db->get('m_nasabah')->row_array();
                break;
                case 4:
                $this->db->select('nama, alamat, telp');
                $this->db->where('id_agent', $wh_sob);
                $data_sob = $this->db->get('m_agent')->row_array();
                break;
                case 6:
                $this->db->select('nama, alamat, telp');
                $this->db->where('id_direct', $wh_sob);
                $data_sob = $this->db->get('m_direct')->row_array();
                break;
                case 5:
                $this->db->select('nama, alamat, telp');
                $this->db->where('id_business_partner', $wh_sob);
                $data_sob = $this->db->get('m_business_partner')->row_array();
                break;
                case 7:
                $this->db->select('nama, alamat, telp');
                $this->db->where('id_loss_adjuster', $wh_sob);
                $data_sob = $this->db->get('m_loss_adjuster')->row_array();
                break;
            }

        $tr = $this->entry_sppa->cari_data('tr_sppa_quotation', $where)->row_array();

        $lb = $this->entry_sppa->cari_data('m_lob', ['id_lob' => $tr['id_lob']])->row_array();

        $cpremi = $this->entry_sppa->get_premi($id_sppa)->result_array();

        $ky = "";
        foreach ($cpremi as $key => $value) {
            if ($value['status'] == 'standar') {
            $ky = $key;
            }
        }

        $ls_premi = $this->moveElement($cpremi, $ky, 0);

        $data = ['tr_sppa'      => $tr,
                 'premi'        => $ls_premi,
                 'premi_adt'    => $this->entry_sppa->get_premi_adt($id_sppa)->result_array(),
                 'sob'          => $cari3['sob'],
                 'data_sob'     => $data_sob,
                 'detail_lob'   => $this->entry_sppa->get_field_sppa($tr['id_relasi_cob_lob'])->result_array(),
                 'lob'          => $lb['lob']
                ];

        $nm         = str_pad($id_sppa, 3, "0", STR_PAD_LEFT);

        $mpdf = new \Mpdf\Mpdf([
            'default_font_size' => 9,
            // 'default_font' => 'DejaVuSans'
        ]);
        $html = $this->load->view('binding_slip',$data,true);

        $nm_file = "BIN$nm.pdf";

        $mpdf->WriteHTML($html);
        $mpdf->Output("upload/binding/$nm_file",'F');

        $filename = "./upload/binding/$nm_file";

        header("Content-type: application/pdf");
      
        header("Content-Length: " . filesize($filename));
        
        // Send the file to the browser.
        readfile($filename);

        // $filepath = base_url("upload/binding/$nm_file");
        // // Header content type
        // header("Content-type: application/pdf");
        // header("Content-disposition: inline;     
        // filename=".basename($filepath));
        // ob_end_clean();
        // // Send the file to the browser.
        // readfile($filepath);
    } 

    // 16-05-2021
    public function tampil_detail_sppa($aksi = '')
    {
        $id_sppa        = $this->input->post('id_sppa');
        $id_sppa_lama   = $this->input->post('id_sppa');

        $where = ['id_sppa_quotation' => $id_sppa];

        // cari detail sob
        $cari2  = $this->entry_sppa->cari_data('tr_histori_status_sob', $where)->row_array();
        $cari3  = $this->entry_sppa->cari_data('m_sob', ['id_sob' => $cari2['id_sob']])->row_array();
        $wh_sob = $cari2['nama_sob'];

        switch ($cari2['id_sob']) {
            case 2:
                $this->db->select('nama_asuransi as nama, alamat, telp');
                $this->db->where('id_asuransi', $wh_sob);
                $data_sob = $this->db->get('m_asuransi')->row_array();

                $this->db->select('id_asuransi as id, nama_asuransi as nama, alamat, telp');
                $this->db->order_by('nama', 'asc');
                $sob = $this->db->get('m_asuransi')->result_array();
                break;
            case 3:
                $this->db->select('nama_nasabah as nama, alamat_rumah as alamat, telp');
                $this->db->where('id_nasabah', $wh_sob);
                $data_sob = $this->db->get('m_nasabah')->row_array();
                
                $this->db->select('id_nasabah as id, nama_nasabah as nama, alamat_rumah as alamat, telp');
                $this->db->order_by('nama', 'asc');
                $sob = $this->db->get('m_nasabah')->result_array();
                break;
            case 4:
                $this->db->select('nama, alamat, telp');
                $this->db->where('id_agent', $wh_sob);
                $data_sob = $this->db->get('m_agent')->row_array();

                $this->db->select('id_agent as id, nama, alamat, telp');
                $this->db->order_by('nama', 'asc');
                $sob = $this->db->get('m_agent')->result_array();
                break;
            case 6:
                $this->db->select('nama, alamat, telp');
                $this->db->where('id_direct', $wh_sob);
                $data_sob = $this->db->get('m_direct')->row_array();

                $this->db->select('id_direct as id, nama, alamat, telp');
                $this->db->order_by('nama', 'asc');
                $sob = $this->db->get('m_direct')->result_array();
                break;
            case 5:
                $this->db->select('nama, alamat, telp');
                $this->db->where('id_business_partner', $wh_sob);
                $data_sob = $this->db->get('m_business_partner')->row_array();

                $this->db->select('id_business_partner as id, nama, alamat, telp');
                $this->db->order_by('nama', 'asc');
                $sob = $this->db->get('m_business_partner')->result_array();
                break;
            case 7:
                $this->db->select('nama, alamat, telp');
                $this->db->where('id_loss_adjuster', $wh_sob);
                $data_sob = $this->db->get('m_loss_adjuster')->row_array();
                
                $this->db->select('id_loss_adjuster as id, nama, alamat, telp');
                $this->db->order_by('nama', 'asc');
                $sob = $this->db->get('m_loss_adjuster')->result_array();
                break;
            }

        $cari = $this->entry_sppa->get_sppa($id_sppa)->row_array();

        $cari_lob = $this->entry_sppa->cari_data('m_lob', ['id_lob' => $cari['id_lob']])->row_array();

        $aksi_endors = $this->input->post('aksi_endors');
        
        if ($aksi_endors != '') {
            $carii_id_p = $this->entry_sppa->cari_data('tr_endorsment', ['id_endorsment' => $id_sppa])->row_array();

            $id_sppa = $carii_id_p['id_sppa_quotation'];
        } else {
            $id_sppa = $id_sppa;
        }

        if ($id_sppa == '') {
            $id_sppa = $id_sppa_lama;
        } else {
            $id_sppa = $id_sppa;
        }

        $cpremi = $this->entry_sppa->get_premi($id_sppa_lama)->result_array();

        $ky = "";
        foreach ($cpremi as $key => $value) {
            if ($value['status'] == 'standar') {
            $ky = $key;
            }
        }

        $ls_premi = $this->moveElement($cpremi, $ky, 0);
        
        $data = ['tr_sppa'      => $cari,
                 'premi'        => $ls_premi,
                 'premi_adt'    => $this->entry_sppa->get_premi_adt($id_sppa_lama)->result_array(),
                 'sob'          => $cari3['sob'],
                 'data_sob'     => $data_sob,
                 'rs_sob'       => $sob,
                 'sel_sob'      => $wh_sob,
                 'detail_lob'   => $this->entry_sppa->get_field_sppa($cari['id_relasi_cob_lob'])->result_array(),
                 'insurer'      => $this->binding->get_data('m_asuransi')->result_array(),
                 'karyawan'     => $this->binding->get_data('m_karyawan')->result_array(),
                 'list_sob'     => $this->entry_sppa->getsob(),
                 'list_cob'     => $this->entry_sppa->list_cob(),
                 'no_reff'      => $this->entry_sppa->get_data_order('mop', 'id_mop', 'desc')->result_array(),
                 'lob'          => $this->entry_sppa->joincoblob($cari['id_cob']),
                 'lob_adt'      => $this->entry_sppa->cari_lob($cari['id_lob'])->result_array(),
                 'jenis'        => $this->input->post('jenis'),
                 'id_sppa'      => $id_sppa,
                 'id_sppa_lama' => $id_sppa_lama,
                 'st_diskon'    => $cari_lob['diskon'],
                 'nasabah_ptg'  => $this->entry_sppa->cari_data('pengguna_tertanggung', ['id_pengguna_tertanggung' => $cari['id_pengguna_tertanggung']])->row_array(),
                 'endors'       => $this->entry_sppa->cari_data('tr_endorsment', ['id_endorsment' => $id_sppa])->row_array(),
                 'id_pgn_ptg'       => $cari['id_pengguna_tertanggung'],
                 'nama_endorsment'  => $this->nama_endorsment_sppa($id_sppa)
                ];

        if ($aksi == 'endorsment') {
            $this->load->view('endorsment_sppa', $data);  
        } else {
            $this->load->view('detail_sppa', $data);  
        }
        
    }

    public function tampil_data_dokumen()
    {
        $id_sppa = $this->input->post('id_sppa');

        if ($id_sppa) {
        $list = $this->entry_sppa->cari_data_order('dokumen_sppa', ['id_sppa_quotation' => $id_sppa], 'add_time', 'desc')->result_array();

        $data = array();

        $no   = $this->input->post('start');

        foreach ($list as $o) {
            $no++;
            $tbody = array();

            $tbody[]    = "<div align='center'>".$no.".</div>";
            $tbody[]    = $o['description'];
            $tbody[]    = $o['filename'];
            $tbody[]    = $o['size'];
            $tbody[]    = "<a href='".base_url()."upload/dokumen/".$o['filename']."'><i class='far fa-file-alt fa-lg'></i></a>";
            $data[]     = $tbody;
        }

        
        echo json_encode(['data' => $data]);
        } else {
        echo json_encode(['data' => []]);
        }

    }

    // 16-05-2021
    public function tampil_data_termin()
    {
        $id_sppa = $this->input->post('id_sppa');

        if ($id_sppa) {
        
        $list = $this->entry_sppa->cari_data_order('tr_termin_pembayaran', ['id_sppa_quotation' => $id_sppa], 'add_time', 'desc')->result_array();

        $data = array();

        $no   = $this->input->post('start');

        foreach ($list as $o) {
            $no++;
            $tbody = array();

            $tbody[]    = "<div align='center'>".$no.".</div>";
            $tbody[]    = $o['no_dokumen'];
            $tbody[]    = date("d-M-Y H:i:s", strtotime($o['tgl_bayar']));
            $tbody[]    = number_format($o['jumlah'],0,',','.');
            $tbody[]    = $o['cara_bayar'];
            $tbody[]    = date("d-M-Y H:i:s", strtotime($o['tgl_terima']));
            $data[]     = $tbody;
        }

        
        echo json_encode(['data' => $data]);
        } else {
        echo json_encode(['data' => []]);
        }

    }

    public function tt()
    {
        $this->binding->ubah_data('tr_sppa_quotation', ['status_aktif' => false], ['id_sppa_quotation' => 134]);
    }

    // 18-05-2021
    public function simpan_data_endorsment()
    {
        $id_sppa_lama1      = $this->input->post('id_sppa');
        $id_sob             = $this->input->post('id_sob');
        $id_cob             = $this->input->post('id_cob');
        $id_lob             = $this->input->post('id_lob');
        $nama_sob           = $this->input->post('nama_sob');
        $id_relasi          = $this->input->post('id_relasi');
        $sppa_number        = $this->input->post('sppa_number');
        $no_polis           = $this->input->post('no_polis');
        $no_invoice         = $this->input->post('no_invoice');
        $detail             = $this->input->post('detail');
        $id_mop             = $this->input->post('id_mop');
        $nm_endorsment      = $this->input->post('nm_endorsment');
        $id_pengguna_ptg    = $this->input->post('id_pengguna_ptg');
        $uri                = $this->input->post('uri');

        if ($uri == '1') {
            $nm_endorsment  = $this->input->post('nm_endorsment');
        } else {
            $nm_endorsment  = $this->nama_endorsment($id_mop);
        }

        $this->db->trans_begin();

        $cari       = $this->entry_sppa->cari_data('tr_sppa_quotation', ['id_sppa_quotation' => $id_sppa_lama1])->row_array();

        $caris      = $this->entry_sppa->cari_data('tr_sppa_quotation', ['sppa_number' => $cari['sppa_number'], 'status_aktif' => 't'])->row_array();

        $carii_id_p = $this->entry_sppa->cari_data_order('tr_endorsment', ['id_endorsment' => $id_sppa_lama1], 'add_time', 'asc')->row_array();

        if ($carii_id_p['id_sppa_quotation'] != '') {
            $id_sppa_lama = $carii_id_p['id_sppa_quotation'];
        } else {
            $id_sppa_lama = $id_sppa_lama1;
        }

        if ($id_sppa_lama1 != $id_sppa_lama) {
            $id_sppa_lama1 = $id_sppa_lama1;
        } else {
            $id_sppa_lama1 = $id_sppa_lama;
        }

        // echo $this->input->post('total_akhir_premi');
        // echo "<br>";
        // echo $caris['total_akhir_premi'];

        // exit();

        if ($this->input->post('total_tagihan') != $caris['total_tagihan']) {
            $status = "UBAH PREMI";
        } else {
            $status = "UBAH DATA";
        }

        $this->db->update('tr_sppa_quotation', ['status_aktif' => false], ['sppa_number' => $cari['sppa_number']]);

        $datapp = [     'id_sob'                    => $id_sob,
                        'id_cob'                    => $id_cob,
                        'id_lob'                    => $id_lob,
                        'id_relasi_cob_lob'         => $id_relasi,
                        'sppa_number'               => $sppa_number,
                        'no_polis'                  => $no_polis,
                        'id_pengguna_tertanggung'   => ($id_pengguna_ptg == '') ? null : $id_pengguna_ptg,
                        'id_mop'                    => ($id_mop == '') ? null : $id_mop,
                        'endorsment'                => true,
                        'approval'                  => true,
                        'status_aktif'              => true,
                        'no_invoice_entry'          => $no_invoice,
                        'add_time'                  => date("Y-m-d H:i:s", now('Asia/Jakarta')),
                        'add_by'                    => $this->session->userdata('sesi_id')
                    ];

        $this->entry_sppa->input_data('tr_sppa_quotation', $datapp);
        $id_sppa = $this->db->insert_id();

        // simpan tr approve
        $cari_ap    = $this->entry_sppa->cari_data('tr_approve_sppa', ['id_sppa_quotation' => $id_sppa_lama])->row_array();

        $data_ap = ['id_sppa_quotation'    => $id_sppa, 
                    'id_asuransi'          => $cari_ap['id_asuransi'],
                    'no_otorisasi_polis'   => $cari_ap['no_otorisasi_polis'],
                    'tgl_otorisasi'        => $cari_ap['tgl_otorisasi'],
                    'tgl_approve'          => $cari_ap['tgl_approve'],
                    'id_pegawai'           => $cari_ap['id_pegawai'],
                    'keterangan_tambahan'  => $cari_ap['keterangan_tambahan'],
                    'add_time'             => date("Y-m-d H:i:s", now('Asia/Jakarta')),
                    'add_by'               => $this->session->userdata('sesi_id')
                    ];

        $this->entry_sppa->input_data('tr_approve_sppa', $data_ap);

        // cari
        

        $datal = ['id_sppa_quotation'   => $id_sppa_lama,
                  'id_endorsment'       => $id_sppa,
                  'status'              => $status,
                  'id_mop'              => ($id_mop == '') ? null : $id_mop,
                  'nama_endorsment'     => $nm_endorsment,
                  'add_time'            => date("Y-m-d H:i:s", now('Asia/Jakarta')),
                  'add_by'              => $this->session->userdata('sesi_id')
                 ];

        $this->entry_sppa->input_data('tr_endorsment', $datal);

        $data2 = [  'id_sob'            => $id_sob,
                    'nama_sob'          => $nama_sob,
                    'id_sppa_quotation' => $id_sppa,
                    'tanggal_perubahan' => date("Y-m-d", now('Asia/Jakarta')),
                    'add_time'          => date("Y-m-d H:i:s", now('Asia/Jakarta')),
                    'add_by'            => $this->session->userdata('id_user')
                ];

        $this->entry_sppa->input_data('tr_histori_status_sob', $data2);

        // detail

        $carii = $this->entry_sppa->get_field_sppa($id_relasi)->result_array();

        $no = 0;
        foreach ($carii as $c) {
            $nm_field = str_replace(" ","_", strtolower($c['field_sppa']));

            $fl = $detail[$no]['value'];

            if ($fl == null || $fl == '') {
                $fl = null;
              } else {
                $fl = $fl;
              }

            if ($c['data_type'] == 'DATE') {
                if ($fl != '' || $fl != null) {
                    $fl = date("Y-m-d", strtotime($fl));
                } else {
                    $fl = $fl;
                }
            }
            
            $data22 = [$nm_field => $fl];

            if ($c['cdb'] == 't') {

                $this->db->update('pengguna_tertanggung', $data22, ['id_pengguna_tertanggung' => $cari['id_pengguna_tertanggung']]);
                
            } else {

                $this->db->update('tr_sppa_quotation', $data22, ['id_sppa_quotation' => $id_sppa]);
                
            }

            $no++;
        }
        
        // premi
        $tsi                = $this->input->post('tsi');    
        $diskon             = $this->input->post('diskon');    
        $gross_premi        = $this->input->post('gross_premi');    
        $total_diskon       = $this->input->post('total_diskon');    
        $total_persen_premi = $this->input->post('total_persen_premi');    
        $total_akhir_premi  = $this->input->post('total_akhir_premi');    
        $biaya_admin        = $this->input->post('biaya_admin');    
        $total_tagihan      = $this->input->post('total_tagihan');    
        $payment_method     = $this->input->post('payment_method');    
        $tahun_pay          = $this->input->post('tahun_pay');    
        $jumlah_cicilan     = $this->input->post('jumlah_cicilan');    

        // array
        $lob_adt            = $this->input->post('lob_adt');    
        $kalkulasi_tsi_adt  = $this->input->post('kalkulasi_tsi_adt');    
        $pengali_tsi_adt    = $this->input->post('pengali_tsi_adt');    
        $rate_adt           = $this->input->post('rate_adt');    
        $nominal_adt        = $this->input->post('nominal_adt');    
        $rate_all_premi     = $this->input->post('rate_all_premi');    
        $nominal_all_premi  = $this->input->post('nominal_all_premi');    
        $id_coverage        = $this->input->post('id_coverage');    
        $premi_standar      = $this->input->post('premi_standar');    
        $premi_perluasan    = $this->input->post('premi_perluasan');    

        // simpan tr sppa
        $jml    = count($premi_standar);
        $jml_p  = count($premi_perluasan);
        
        $tt_premi_standar = 0;
        for ($i=0; $i < $jml; $i++) { 
        
        $tt_premi_standar += str_replace('.','', $premi_standar[$i]);

        }

        $tt_premi_pls = 0;
        for ($k=0; $k < $jml_p; $k++) { 
        
        $tt_premi_pls += str_replace('.','', $premi_perluasan[$k]);

        }

        $nm         = str_pad($id_sppa, 3, "0", STR_PAD_LEFT);
        $date       = date("Ymd", now('Asia/Jakarta'));
        $random     = strtoupper(bin2hex(random_bytes(2)));
        $no_binding = "BND/$date/LGW/BIN$nm$random";

        $data11 = [ 'no_binding'              => $no_binding,
                    'total_sum_insured'       => $tsi,
                    'diskon'                  => ($diskon != '') ? $diskon : null,
                    'gross_premi'             => str_replace('.','', $gross_premi),
                    'total_diskon'            => str_replace('.','', $total_diskon),
                    'total_akhir_premi'       => str_replace('.','', $total_akhir_premi),
                    'total_rate_akhir_premi'  => $total_persen_premi,
                    'total_premi_standar'     => $tt_premi_standar,
                    'total_premi_perluasan'   => $tt_premi_pls,
                    'biaya_admin'             => $biaya_admin,
                    'total_tagihan'           => $total_tagihan,
                    'payment_method'          => $payment_method,
                    'tahun_cicilan'           => ($tahun_pay != '') ? $tahun_pay : null,
                    'jumlah_cicilan'          => ($jumlah_cicilan != '') ? $jumlah_cicilan : null
                ];

        $where = ['id_sppa_quotation' => $id_sppa];

        $this->db->update('tr_sppa_quotation', $data11, $where);

        // cek jika ada premi
        $cari = $this->entry_sppa->cari_data('tr_premi', $where)->num_rows();

        if ($cari != 0) {
        $this->db->delete('tr_premi', $where);
        }

        // input premi  
        $jml_c  = count($id_coverage);
        $data_c = [];

        for ($j=0; $j < $jml_c; $j++) { 
        
        $data_c[] = [ 'id_sppa_quotation' => $id_sppa,
                        'id_coverage'       => $id_coverage[$j],
                        'rate'              => $rate_all_premi[$j],
                        'nominal'           => str_replace('.','', $nominal_all_premi[$j]),
                        'add_time'          => date("Y-m-d H:i:s", now('Asia/Jakarta')),
                        'add_by'            => $this->session->userdata('id_user')
                    ];

        }

        $this->db->insert_batch('tr_premi', $data_c);

        // cek jika ada premi adt
        $cari_a = $this->entry_sppa->cari_data('tr_premi_adt', $where)->num_rows();

        if ($cari_a != 0) {
        $this->db->delete('tr_premi_adt', $where);
        }

        // input premi adt 
        $jml_a  = count($lob_adt);

        if ($jml_a != 0) {

        $data_a = [];

        for ($k=0; $k < $jml_a; $k++) { 

            $data_a[] = [   'id_sppa_quotation' => $id_sppa,
                            'id_lob'            => $lob_adt[$k],
                            'pengali_tsi'       => $pengali_tsi_adt[$k],
                            'kalkulasi_tsi'     => str_replace('.','', $kalkulasi_tsi_adt[$k]),
                            'rate'              => $rate_adt[$k],
                            'nominal'           => str_replace('.','', $nominal_adt[$k]),
                            'add_time'          => date("Y-m-d H:i:s", now('Asia/Jakarta')),
                            'add_by'            => $this->session->userdata('id_user')
                        ];

        }

        $this->db->insert_batch('tr_premi_adt', $data_a);

        }

        // generate invoice
        $nm       = str_pad($id_sppa, 5, "0", STR_PAD_LEFT);
        $date     = date("Ymd", now('Asia/Jakarta'));
        $random   = strtoupper(bin2hex(random_bytes(4)));

        $nmr_invoice = "INV/$date/Entry/$random";

        $where = ['id_sppa_quotation' => $id_sppa];

        $cari = $this->entry_sppa->cari_data('tr_sppa_quotation', $where)->row_array();

        if ($cari['no_invoice_entry'] == '') {
          $this->db->update('tr_sppa_quotation', ['no_invoice_entry' => $nmr_invoice], $where);
        }

        // cari detail sob
        $cari2  = $this->entry_sppa->cari_data('tr_histori_status_sob', $where)->row_array();
        $cari3  = $this->entry_sppa->cari_data('m_sob', ['id_sob' => $cari2['id_sob']])->row_array();
        $wh_sob = $cari2['nama_sob'];

          switch ($cari2['id_sob']) {
              case 2:
                $this->db->select('nama_asuransi as nama, alamat, telp');
                $this->db->where('id_asuransi', $wh_sob);
                $data_sob = $this->db->get('m_asuransi')->row_array();
                break;
              case 3:
                $this->db->select('nama_nasabah as nama, alamat_rumah as alamat, telp');
                $this->db->where('id_nasabah', $wh_sob);
                $data_sob = $this->db->get('m_nasabah')->row_array();
                break;
              case 4:
                $this->db->select('nama, alamat, telp');
                $this->db->where('id_agent', $wh_sob);
                $data_sob = $this->db->get('m_agent')->row_array();
                break;
              case 6:
                $this->db->select('nama, alamat, telp');
                $this->db->where('id_direct', $wh_sob);
                $data_sob = $this->db->get('m_direct')->row_array();
                break;
              case 5:
                $this->db->select('nama, alamat, telp');
                $this->db->where('id_business_partner', $wh_sob);
                $data_sob = $this->db->get('m_business_partner')->row_array();
                break;
              case 7:
                $this->db->select('nama, alamat, telp');
                $this->db->where('id_loss_adjuster', $wh_sob);
                $data_sob = $this->db->get('m_loss_adjuster')->row_array();
                break;
            }

        $cpremi = $this->entry_sppa->get_premi($id_sppa)->result_array();

        $ky = "";
        foreach ($cpremi as $key => $value) {
            if ($value['status'] == 'standar') {
            $ky = $key;
            }
        }
    
        $ls_premi = $this->moveElement($cpremi, $ky, 0);
      

        $data11 = [ 'tr_sppa'    => $this->entry_sppa->cari_data('tr_sppa_quotation', $where)->row_array(),
                    'premi'      => $ls_premi,
                    'premi_adt'  => $this->entry_sppa->get_premi_adt($id_sppa)->result_array(),
                    'sob'        => $cari3['sob'],
                    'data_sob'   => $data_sob
                    ];

        $mpdf = new \Mpdf\Mpdf();
        $html = $this->load->view('invoice',$data11,true);

        $mpdf->WriteHTML($html);
        $mpdf->Output("upload/entry/INV$nm.pdf",'F');

        $nm_file = "INV$nm.pdf";

        $where = ['id_sppa_quotation' => $id_sppa];

        $this->db->update('tr_sppa_quotation', ['file_invoice' => $nm_file], $where);


        if($this->db->trans_status() === FALSE){
        $this->db->trans_rollback();

        echo json_encode(['status' => false]);
        }else{
        $this->db->trans_commit();

        echo json_encode(['id_sppa' => $id_sppa]);
        }
    }

    public function simpan_cancel()
    {
        $id_sppa = $this->input->post('id_sppa');
        
        $where = ['id_sppa_quotation' => $id_sppa];

        $this->db->update('tr_sppa_quotation', ['cancelation' => true], $where);
        
        echo json_encode(['status' => true]);
    }

}

/* End of file Approval.php */
