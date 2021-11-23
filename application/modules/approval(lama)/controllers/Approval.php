<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Approval extends CI_Controller {

    public function __construct() {
    parent::__construct();
        $this->load->model('M_approval', 'apv');
        $this->load->model('entry_sppa/M_entry_sppa', 'entry_sppa');
        $this->load->model('binding/M_binding', 'binding');
        $this->load->model('cob_lob/m_cob', 'cob');
        $this->load->model('business_specifications/M_business_specifications', 'bsp');

        $this->aksi_crud        = get_role($this->session->userdata('id_level_otorisasi'));
        $this->id_lvl_otorisasi = $this->session->userdata('id_level_otorisasi');
        $this->sesi_id          = $this->session->userdata('sesi_id');

        $this->load->helper('inputtype_helper');

        if($this->session->userdata('username') == "") {
            redirect(base_url(), 'refresh');
        }
    }

    public function index()
    {
        $data = ['title'            => 'Approval SPPA',
                //  'sppa_number'      => $this->apv->cari_data_order('tr_sppa_quotation', ['approval' => false, 'sppa_number !=' => null], 'sppa_number', 'asc')->result_array(),
                 'sppa_number'      => $this->apv->cari_data_sppa($this->session->userdata('sesi_id'))->result_array(),
                 'role'             => $this->aksi_crud,
                 'id_lvl_otorisasi' => $this->id_lvl_otorisasi,
                 'id_user'          => $this->session->userdata('sesi_id')
                ];

        $this->template->load('template/index','lihat', $data);
    }

    // 16-05-2021
    public function tampil_data_approval()
    {
        $read               = $this->input->post('read');
        $create             = $this->input->post('create');
        $update             = $this->input->post('update');
        $delete             = $this->input->post('delete');
        $id_user            = $this->input->post('id_user');
        $id_lvl_otorisasi   = $this->input->post('id_lvl_otorisasi');

        if ($read == 'true' || $id_lvl_otorisasi == 0) {
            $list = $this->apv->get_data_approval();
        } else {
            $list = [];
        }

        $data = array();

        $no   = $this->input->post('start');

        foreach ($list as $o) {
            $no++;
            $tbody = array();

            if ($o['id_mop'] != '') {
                $hidden = 'hidden';
            } else {
                $hidden = '';
            }

            if ($id_lvl_otorisasi == 0) {
                $detail = "<span style='cursor:pointer' class='mr-3 text-dark detail ttip' data-toggle='tooltip' data-placement='top' title='Detail' data-id='".$o['id']."' sppa_number='".$o['sppa_number']."'><i class='fas fa-info-circle fa-lg'></i></span>";
                $a1 = "<span style='cursor:pointer' class='mr-3 text-primary edit ttip' data-toggle='tooltip' data-placement='top' title='Ubah' data-id='".$o['id']."' sppa_number='".$o['sppa_number']."' $hidden><i class='fas fa-pencil-alt fa-lg'></i></span>";
                $a2 = "<span style='cursor:pointer' class='text-danger hapus ttip' data-toggle='tooltip' data-placement='top' title='Hapus' data-id='".$o['id']."'><i class='far fa-trash-alt fa-lg'></i></span>";
            } else {
                if ($update == 'true') {

                    if ($delete == 'true') {
                        $mrd = "mr-3";
                    } else {
                        $mrd = "";
                    }
            
                    $a1 = "<span style='cursor:pointer' class='".$mrd." text-primary edit ttip' data-toggle='tooltip' data-placement='top' title='Ubah' data-id='".$o['id']."' sppa_number='".$o['sppa_number']."' $hidden><i class='fas fa-pencil-alt fa-lg'></i></span>";
                    $up = true;
                } else {
                    $a1 = "";
                    $up = false;
                }
                
                if ($delete == 'true') {
                    $a2 = "<span style='cursor:pointer' class='text-danger hapus ttip' data-toggle='tooltip' data-placement='top' title='Hapus' data-id='".$o['id']."'><i class='far fa-trash-alt fa-lg'></i></span>";
                    $del = true;
                } else {
                    $a2 = "";
                    $del = false;
                }
        
                if ($up == true || $del == true) {
                    $mr = 'mr-3';
                } else {
                    $mr = "";
                }
        
                $detail = "<span style='cursor:pointer' class='".$mr." text-dark detail ttip' data-toggle='tooltip' data-placement='top' title='Detail' data-id='".$o['id']."' sppa_number='".$o['sppa_number']."'><i class='fas fa-info-circle fa-lg'></i></span>";
            }

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

            if ($o['sob'] == null) {
                $sob = "-";
            } else {
                $sob = wordwrap($o['sob']." - ".$data_sob['nama'],35,"<br>\n");
            }
 
            $tbody[]    = "<div align='center'>".$no.".</div>";
            $tbody[]    = $o['sppa_number'];
            $tbody[]    = $sob;
            $tbody[]    = wordwrap($o['cob']." - ".$o['lob'],35,"<br>\n");
            $tbody[]    = wordwrap($o['nama_asuransi'],30,"<br>\n");
            $tbody[]    = $detail.$a1.$a2;
            $data[]     = $tbody;
        }

        if ($read == 'true' || $id_lvl_otorisasi == 0) {
            $recordsTotal       = $this->apv->jumlah_semua_approval();
            $recordsFiltered    = $this->apv->jumlah_filter_approval();
        } else {
            $recordsTotal       = 0;
            $recordsFiltered    = 0;
        }

        $output = [ "draw"             => $_POST['draw'],
                    "recordsTotal"     => $recordsTotal,
                    "recordsFiltered"  => $recordsFiltered,   
                    "data"             => $data
                ];

        echo json_encode($output);
    }

    // 16-05-2021
    public function tampil_detail_sppa($id_sppa, $aksi)
    {
        // $id_sppa    = $this->input->post('id_sppa');
        // $aksi       = $this->input->post('aksi');

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

        $data = ['title'        => 'Detail SPPA',
                 'tr_sppa'      => $cari,
                 'premi'        => $ls_premi,
                 'premi_adt'    => $this->entry_sppa->get_premi_adt($id_sppa)->result_array(),
                 'sob'          => $cari3['sob'],
                 'data_sob'     => $data_sob,
                 'detail_lob'   => $this->entry_sppa->get_field_sppa($cari['id_relasi_cob_lob'])->result_array(),
                 'insurer'      => $this->apv->get_data('m_asuransi')->result_array(),
                 'karyawan'     => $this->apv->get_data('m_karyawan')->result_array(),
                 'no_polis'     => $this->no_polis(),
                 'aksi'         => $aksi,
                 'dt_approve'   => $this->apv->data_approve($id_sppa)->row_array(),
                 'id_sppa'      => $id_sppa,
                 'sppa_number'  => $cari['sppa_number'],
                 'st_diskon'    => $cari_lob['diskon'],
                 'nasabah_ptg'  => $this->entry_sppa->cari_data('pengguna_tertanggung', ['id_pengguna_tertanggung' => $cari['id_pengguna_tertanggung']])->row_array()
                ];

        // $this->load->view('detail_sppa', $data);  

        $this->template->load('template/index', 'detail_sppa', $data);
        
    }

    public function tampil_edit_sppa($id_sppa, $aksi)
    {
        // $id_sppa    = $this->input->post('id_sppa');
        // $aksi       = $this->input->post('aksi');

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

        $cari   = $this->entry_sppa->get_sppa($id_sppa)->row_array();

        $cari_lob = $this->entry_sppa->cari_data('m_lob', ['id_lob' => $cari['id_lob']])->row_array();

        $cr_app = $this->apv->data_approve($id_sppa)->row_array();

        if ($aksi == 'tambah') {
            $no_polis   = $this->no_polis();
            $tgl_polis  = "";
        } else {
            $no_polis = $cr_app['no_otorisasi_polis'];
            $tgl_polis  = date("d-m-Y", strtotime($cr_app['tgl_otorisasi']));
        }

        $cpremi = $this->entry_sppa->get_premi($id_sppa)->result_array();

        $ky = "";
        foreach ($cpremi as $key => $value) {
            if ($value['status'] == 'standar') {
            $ky = $key;
            }
        }

        $ls_premi = $this->moveElement($cpremi, $ky, 0);

        $data = [   'title'        => 'Edit SPPA',
                    'tr_sppa'      => $cari,
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
                    'jenis'        => $this->input->post('jenis'),
                    'dt_approve'   => $cr_app,
                    'id_sppa'      => $id_sppa,
                    'sppa_number'  => $cari['sppa_number'],
                    'no_polis'     => $no_polis,
                    'tgl_polis'    => $tgl_polis,
                    'aksi'         => $aksi,
                    'st_diskon'    => $cari_lob['diskon'],
                    'nasabah_ptg'  => $this->entry_sppa->cari_data('pengguna_tertanggung', ['id_pengguna_tertanggung' => $cari['id_pengguna_tertanggung']])->row_array()
                ];

        // $this->load->view('edit_sppa', $data);  

        $this->template->load('template/index', 'edit_sppa', $data);
        
    }

    private function moveElement(&$array, $a, $b) {
        $p1 = array_splice($array, $a, 1);
        $p2 = array_splice($array, 0, $b);
        $array = array_merge($p2,$p1,$array);
  
        return $array;
    }

    public function tampil_edit_sppa_tambah()
    {
        $id_sppa    = $this->input->post('id_sppa');
        $aksi       = $this->input->post('aksi');

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

        $cari   = $this->entry_sppa->get_sppa($id_sppa)->row_array();

        $cari_lob = $this->entry_sppa->cari_data('m_lob', ['id_lob' => $cari['id_lob']])->row_array();

        $cr_app = $this->apv->data_approve($id_sppa)->row_array();

        if ($aksi == 'tambah') {
            $no_polis   = $this->no_polis();
            $tgl_polis  = "";
        } else {
            $no_polis = $cr_app['no_otorisasi_polis'];
            $tgl_polis  = date("d-m-Y", strtotime($cr_app['tgl_otorisasi']));
        }

        $cpremi = $this->entry_sppa->get_premi($id_sppa)->result_array();

        $ky = "";
        foreach ($cpremi as $key => $value) {
            if ($value['status'] == 'standar') {
            $ky = $key;
            }
        }

        $ls_premi = $this->moveElement($cpremi, $ky, 0);

        $data = [   'title'        => 'Edit SPPA',
                    'tr_sppa'      => $cari,
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
                    'jenis'        => $this->input->post('jenis'),
                    'dt_approve'   => $cr_app,
                    'id_sppa'      => $id_sppa,
                    'sppa_number'  => $cari['sppa_number'],
                    'no_polis'     => $no_polis,
                    'tgl_polis'    => $tgl_polis,
                    'aksi'         => $aksi,
                    'st_diskon'    => $cari_lob['diskon'],
                    'nasabah_ptg'  => $this->entry_sppa->cari_data('pengguna_tertanggung', ['id_pengguna_tertanggung' => $cari['id_pengguna_tertanggung']])->row_array()
                ];

        $this->load->view('edit_sppa_tambah', $data);  
        
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

            if ($o['updated_time']) {
                $dt = date("d-M-Y H:i:s", strtotime($o['updated_time']));
            } else {
                $dt = "-";
            }

            $tbody[]    = "<div align='center'>".$no.".</div>";
            $tbody[]    = $o['description'];
            $tbody[]    = $o['filename'];
            $tbody[]    = $o['size'];
            $tbody[]    = $dt;
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
            $tbody[]    = date("d-M-Y", strtotime($o['tgl_bayar']));
            $tbody[]    = number_format($o['jumlah'],0,',','.');
            $tbody[]    = $o['cara_bayar'];
            $tbody[]    = date("d-M-Y", strtotime($o['tgl_terima']));
            $tbody[]    = "<span style='cursor:pointer' class='mr-3 text-primary edit ttip' data-toggle='tooltip' data-placement='top' title='Ubah' data-id='".$o['id_termin_pembayaran']."'><i class='fas fa-pencil-alt fa-lg'></i></span><span style='cursor:pointer' class='text-danger hapus ttip' data-toggle='tooltip' data-placement='top' title='Hapus' data-id='".$o['id_termin_pembayaran']."'><i class='far fa-trash-alt fa-lg'></i></span>";
            $data[]     = $tbody;
        }

        
        echo json_encode(['data' => $data]);
        } else {
        echo json_encode(['data' => []]);
        }

    }

    // 16-05-2021
    public function simpan_approval()
    {
        $aksi                   = $this->input->post('aksi');
        $id_sppa                = $this->input->post('id_sppa');
        $id_approve_sppa        = $this->input->post('id_approve_sppa');
        $id_insurer             = $this->input->post('id_insurer');
        $no_otorisasi_polis     = $this->input->post('no_otorisasi_polis');        
        $tgl_otorisasi          = $this->input->post('tgl_otorisasi');        
        $id_karyawan            = $this->input->post('id_karyawan');        
        $keterangan_tambahan    = $this->input->post('keterangan_tambahan');  

        // $det    = $this->input->post('detail');
        
        // echo "<pre>";
        
        // $params = array();
        // parse_str($det, $params);
        // print_r($params['keterangan_tambahan']);

        // echo "</pre>";

        // exit();

        // generate binding
        $nm         = str_pad($id_sppa, 3, "0", STR_PAD_LEFT);
        $date       = date("Ymd", now('Asia/Jakarta'));
        $random     = strtoupper(bin2hex(random_bytes(2)));
        $no_binding = "BND/$date/LGW/BIN$nm$random";
        
        $data = ['id_sppa_quotation'    => $id_sppa, 
                 'id_asuransi'          => $id_insurer,
                 'no_otorisasi_polis'   => $no_otorisasi_polis,
                 'tgl_otorisasi'        => date("Y-m-d H:i:s", strtotime($tgl_otorisasi)),
                 'tgl_approve'          => date("Y-m-d H:i:s", now('Asia/Jakarta')),
                 'id_pegawai'           => $id_karyawan,
                 'keterangan_tambahan'  => $keterangan_tambahan,
                 'add_time'             => date("Y-m-d H:i:s", now('Asia/Jakarta')),
                 'add_by'               => $this->session->userdata('id_user')
                ];

        
        if ($aksi == 'Tambah') {
            $where = ['id_sppa_quotation' => $id_sppa];

            $this->db->update('tr_sppa_quotation', ['approval' => true, 'no_polis' => $no_otorisasi_polis, 'no_binding' => $no_binding], $where);

            $this->apv->input_data('tr_approve_sppa', $data);
        } elseif ($aksi == 'Ubah') {
            $this->apv->ubah_data('tr_approve_sppa', $data, array('id_approve_sppa' => $id_approve_sppa));
        } elseif ($aksi == 'Hapus') {
            $this->apv->ubah_data('tr_sppa_quotation',['approval' => false], array('id_approve_sppa' => $id_approve_sppa));
            $this->apv->hapus_data('tr_approve_sppa', array('id_approve_sppa' => $id_approve_sppa));
        }
        
        $cari = $this->apv->get_approval()->result_array();

        $option = "<option value=''>Pilih SPPA Number</option>";

        foreach ($cari as $c) {
            $option .= "<option value='".$c['id_sppa_quotation']."'>".$c['sppa_number']."</option>";
        }
        
        echo json_encode(['status' => true, 'option' => $option, 'no_polis'   => $this->no_polis()]);
    }

    // 25-05-2021
    public function simpan_semua()
    {
        $aksi_simpan    = $this->input->post('aksi_simpan');

        $f_client       = $this->input->post('form_client');
        $f_detail       = $this->input->post('form_detail');
        $f_approval     = $this->input->post('form_approval');

        
        $client = array();
        parse_str($f_client, $client);
        $detail = array();
        parse_str($f_detail, $detail);
        $approval = array();
        parse_str($f_approval, $approval);

        $id_sppa        = $client['id_sppa'];
        $id_sob         = $client['id_sob'];
        $id_cob         = $client['id_cob'];
        $id_lob         = $client['id_lob'];
        $nama_sob       = $client['nama_sob'];
        $id_relasi      = $client['id_relasi'];
        $sppa_number    = $client['sppa_number'];
        $no_polis       = $client['no_polis'];
        $no_invoice     = $client['no_invoice'];

        // $detail         = $this->input->post('detail');

        $this->db->trans_begin();

        $where = ['id_sppa_quotation' => $id_sppa];

        $data = [   'id_sob'            => $id_sob,
                    'id_cob'            => $id_cob,
                    'id_lob'            => $id_lob,
                    'id_relasi_cob_lob' => $id_relasi,
                    'sppa_number'       => $sppa_number,
                    'no_polis'          => $no_polis,
                    'no_invoice_entry'  => $no_invoice,
                    'approval'          => true,
                    'tgl_approval'      => date("Y-m-d H:i:s", now('Asia/Jakarta')),
                    'add_time'          => date("Y-m-d H:i:s", now('Asia/Jakarta')),
                    'add_by'            => $this->session->userdata('id_user')
                ];

        $this->entry_sppa->ubah_data('tr_sppa_quotation', $data, $where);

        $data2 = [  'id_sob'            => $id_sob,
                    'nama_sob'          => $nama_sob,
                    'id_sppa_quotation' => $id_sppa,
                    'tanggal_perubahan' => date("Y-m-d", now('Asia/Jakarta')),
                    'add_time'          => date("Y-m-d H:i:s", now('Asia/Jakarta')),
                    'add_by'            => $this->session->userdata('id_user')
                ];

        $this->entry_sppa->ubah_data('tr_histori_status_sob', $data2, $where);

        if ($aksi_simpan != 'ubah') {
            // endorsment 0000
            $datal = [  'id_sppa_quotation'     => $id_sppa, 
                        'id_endorsment'         => $id_sppa, 
                        'status'                => "TAMBAH SPPA",
                        'nama_endorsment'       => "Endorsment-00000",
                        'add_time'              => date("Y-m-d H:i:s", now('Asia/Jakarta')),
                        'add_by'                => $this->session->userdata('sesi_id')
                    ];

            $this->entry_sppa->input_data('tr_endorsment', $datal);
        }

        

        // detail
        $cari = $this->entry_sppa->get_field_sppa($id_relasi)->result_array();

        foreach ($cari as $c) {
            $nm_field = str_replace(" ","_", strtolower($c['field_sppa']));

            $fl = $detail[$nm_field];

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

            $this->db->update('tr_sppa_quotation', $data22, ['id_sppa_quotation' => $id_sppa]);
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

        $tt_rate = str_replace('.','', $total_akhir_premi);

        $data11 = [ 'total_sum_insured'       => ($tsi == '0') ? null : $tsi,
                    'diskon'                  => ($diskon != '') ? $diskon : null,
                    'gross_premi'             => ($gross_premi != '') ? str_replace('.','', $gross_premi) : null,
                    'total_diskon'            => ($total_diskon != '') ? str_replace('.','', $total_diskon) : null,
                    'total_akhir_premi'       => ($total_akhir_premi != '') ? $tt_rate : null,
                    'total_rate_akhir_premi'  => ($total_persen_premi != '') ? $total_persen_premi : null,
                    'total_premi_standar'     => $tt_premi_standar,
                    'total_premi_perluasan'   => $tt_premi_pls,
                    'biaya_admin'             => ($biaya_admin == '0') ? null : $biaya_admin,
                    'total_tagihan'           => ($total_tagihan == '0') ? null : $total_tagihan,
                    'payment_method'          => $payment_method,
                    'tahun_cicilan'           => ($tahun_pay != '') ? $tahun_pay : null,
                    'jumlah_cicilan'          => ($jumlah_cicilan != '') ? $jumlah_cicilan : null
                ];

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

        $aksi                   = $approval['aksi'];
        $id_sppa                = $approval['id_sppa'];
        $id_approve_sppa        = $approval['id_approve_sppa'];
        $id_insurer             = $approval['id_insurer'];
        $no_otorisasi_polis     = $approval['no_otorisasi_polis'];        
        $tgl_otorisasi          = $approval['tgl_otorisasi'];        
        $id_karyawan            = $approval['id_karyawan'];        
        $keterangan_tambahan    = $approval['keterangan_tambahan'];  

        // generate binding
        $nm         = str_pad($id_sppa, 3, "0", STR_PAD_LEFT);
        $date       = date("Ymd", now('Asia/Jakarta'));
        $random     = strtoupper(bin2hex(random_bytes(2)));
        $no_binding = "BND/$date/LGW/BIN$nm$random";

        if ($tgl_otorisasi == '') {
            $tgl_otorisasi = null;
        } else {
            $tgl_otorisasi = date("Y-m-d H:i:s", strtotime($tgl_otorisasi));
        }
        
        $data = ['id_sppa_quotation'    => $id_sppa, 
                 'id_asuransi'          => ($id_insurer != '') ? $id_insurer : null,
                 'no_otorisasi_polis'   => $no_otorisasi_polis,
                 'tgl_otorisasi'        => $tgl_otorisasi,
                 'tgl_approve'          => date("Y-m-d H:i:s", now('Asia/Jakarta')),
                 'id_pegawai'           => ($id_karyawan != '') ? $id_karyawan : null,
                 'keterangan_tambahan'  => $keterangan_tambahan,
                 'add_time'             => date("Y-m-d H:i:s", now('Asia/Jakarta')),
                 'add_by'               => $this->session->userdata('id_user')
                ];
        
        if ($aksi == 'tambah') {
            $where = ['id_sppa_quotation' => $id_sppa];

            if ($id_insurer != '' && $id_karyawan != '' && $tgl_otorisasi != '') {
                $this->db->update('tr_sppa_quotation', ['approval' => true, 'no_polis' => $no_otorisasi_polis, 'no_binding' => $no_binding], $where);

                $this->apv->input_data('tr_approve_sppa', $data);
            }

        } elseif ($aksi == 'ubah') {
            if ($id_insurer != '' && $id_karyawan != '' && $tgl_otorisasi != '') {
                $this->apv->ubah_data('tr_approve_sppa', $data, array('id_approve_sppa' => $id_approve_sppa));
            }
        } elseif ($aksi == 'hapus') {
            $this->apv->hapus_data('tr_approve_sppa', array('id_approve_sppa' => $id_approve_sppa));
        }
        
        $cari = $this->apv->get_approval()->result_array();

        $option = "<option value=''>Pilih SPPA Number</option>";

        foreach ($cari as $c) {
            $option .= "<option value='".$c['id']."'>".$c['sppa_number']."</option>";
        }

        if($this->db->trans_status() === FALSE){
        $this->db->trans_rollback();

        echo json_encode(['status' => false]);
        }else{
        $this->db->trans_commit();

        echo json_encode(['id_sppa' => $id_sppa, 'option' => $option, 'no_polis'   => $this->no_polis()]);
        }

        // print_r($params['keterangan_tambahan']);
    }

    public function no_polis()
    {
        $thn    = date('ymd', now('Asia/Jakarta'));
        $b      = random_int(1000, 10000);

        $kode   = "$thn$b";

        return $kode;
    }

    // 19-07-2021
    public function hapus_entry($id_sppa)
    {
        $this->db->trans_begin();

        $where = ['id_sppa_quotation' => $id_sppa];

        $cari2 = $this->entry_sppa->cari_data('tr_sppa_quotation', $where)->row_array();

        if ($cari2['id_pengguna_tertanggung'] != null) {
            $this->entry_sppa->hapus_data('pengguna_tertanggung', ['id_pengguna_tertanggung' => $cari2['id_pengguna_tertanggung']]);
        }

        $this->entry_sppa->hapus_data('tr_sppa_quotation', $where);
        $this->entry_sppa->hapus_data('tr_premi', $where);
        $this->entry_sppa->hapus_data('tr_premi_adt', $where);
        $this->entry_sppa->hapus_data('tr_histori_status_sob', $where);

        $cari = $this->entry_sppa->cari_data('dokumen_sppa', $where)->result_array();

        foreach ($cari as $c) {

            $file = $c['filename'];
            
            $path = "./upload/dokumen/".$file;
            unlink($path); 

        }

        $this->entry_sppa->hapus_data('dokumen_sppa', $where);

        if($this->db->trans_status() === FALSE){
        $this->db->trans_rollback();

            return false;
        }else{
        $this->db->trans_commit();

            return true;
        }
    }

    // 19-05-2021
    public function hapus_approval()
    {
        $id_sppa = $this->input->post('id_sppa');

        $this->db->trans_begin();

        $where = ['id_sppa_quotation' => $id_sppa];

        $cr = $this->apv->cari_data('tr_sppa_quotation', $where)->row_array();

        if ($cr['id_mop'] != '') {

            $st = 'id_mop';

            $this->hapus_entry($id_sppa);

        } else {

            $st = 'bukan id_mop';
            
            $this->apv->ubah_data('tr_sppa_quotation', ['approval' => false], $where);
            $this->apv->hapus_data('tr_approve_sppa', $where);

        }

        $cari = $this->apv->cari_data_order('tr_sppa_quotation', ['approval' => false, 'sppa_number !=' => null], 'sppa_number', 'asc')->result_array();

        $option = "<option value=''>Pilih SPPA Number</pilih>";
        foreach ($cari as $c) {
            $id_sppa        = $c['id_sppa_quotation'];
            $sppa_number    = $c['sppa_number'];

            $option .= "<option value='".$id_sppa."'>".$sppa_number."</option>";

        }

        if($this->db->trans_status() === FALSE){
            $this->db->trans_rollback();
    
            echo json_encode(['status' => $st, 'option' => '']);
        }else{
            $this->db->trans_commit();
    
            echo json_encode(['status' => $st, 'option' => $option]);
        }
        
    }
}

/* End of file Approval.php */
