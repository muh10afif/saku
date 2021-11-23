<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Jurnal_buku_besar extends CI_controller
{

    public function __construct() {
        parent::__construct();
        $this->load->model('M_jurnal_bb');

        $this->aksi_crud        = get_role($this->session->userdata('id_level_otorisasi'));
        $this->id_lvl_otorisasi = $this->session->userdata('id_level_otorisasi');

        if($this->session->userdata('username') == "") {
        redirect(base_url(), 'refresh');
        }
    }

    public function index()
    {
        $data 	= [ 'title'             => 'Jurnal Dan Buku Besar',
                    'role'              => $this->aksi_crud,
                    'id_lvl_otorisasi'  => $this->id_lvl_otorisasi,
                    'id_user'           => $this->session->userdata('sesi_id'),
                    'group'             => $this->M_jurnal_bb->get_group(),
                    'head_coa'          => $this->M_jurnal_bb->get_head_coa(),
                    'main_coa'          => $this->M_jurnal_bb->get_main_coa(),
                    'description_coa'   => $this->M_jurnal_bb->get_description_coa(),
                    'pelaksana'         => $this->M_jurnal_bb->get_pelaksana(),
                    'data_jurnal'       => $this->M_jurnal_bb->get_jurnal(),
                    // 'group'             => $this->M_jurnal_bb->delete_blank_jurnal()
                ];

        $this->template->load('template/index','jurnal/V_lihat', $data);
    }
    
    // 10-08-2021
    public function tampil_data_jurnal()
    {
        $read               = $this->input->post('read');
        $create             = $this->input->post('create');
        $update             = $this->input->post('update');
        $delete             = $this->input->post('delete');
        $id_user            = $this->input->post('id_user');
        $id_lvl_otorisasi   = $this->input->post('id_lvl_otorisasi');

        if ($read == 'true' || $id_lvl_otorisasi == 0) {
            $list = $this->M_jurnal_bb->get_data_jurnal_bb();
        } else {
            $list = [];
        } 

        $data = array();

        $no   = $this->input->post('start');

        foreach ($list as $o) {
            $no++;
            $tbody = array();

            $hidec = "";
            $hideb = "";

            if ($o['status'] == 1 ){
                $status = "<span class='badge badge-success'>Terposting</span>";
                $hide   ="hidden";
                $mr3    = "";
                $hides  ="hidden";
                $hidec  = "hidden";
            } elseif($o['status'] == 0){
                $status = "<span class='badge badge-danger'>Belum Posting</span>";
                $hide   = "hidden";
                $mr3    = "mr-3";
                $hides  = "";
                $hidec  = "hidden";
            } elseif($o['status'] == 3){
                $status = "<span class='badge badge-primary'>Telah Diperbaiki</span>";
                $hide   = "hidden";
                $mr3    = "mr-3";
                $hides  = "";
            } elseif($o['status'] == 2){
                $status = "<span class='badge badge-dark'>Butuh Perbaikan</span>";
                $hide   = "";
                $mr3    = "mr-3";
                $hides  = "";
                $hideb  = "hidden";
            } 
            
            // elseif(data['userdata'] != "Kepala Departemen Keuangan")
            //     { var status ="<span class='badge badge-warning'>Butuh Perbaikan</span>";
            // var hide =""
            // var hides ="";
            //         }

            // '<button  class="btn btn-warning btn-xs j_edit" data="'+data['data_jurnal'][i].id_jurnal+'" '+hide+' data-toggle="tooltip" data-placement="left" title="edit"><i class="fa fa-edit"></i></button>'+' '+
            // '<button  class="btn btn-info btn-xs j_detail" data="'+data['data_jurnal'][i].id_jurnal+'" data-toggle="tooltip" data-placement="left" title="detail"><i class="fa fa-file"></i></button>'+' '+
            // '<button  class="btn btn-danger btn-xs j_hapus" data="'+data['data_jurnal'][i].id_jurnal+'" '+hides+' data-toggle="tooltip" data-placement="left" title="hapus"><i class="fa fa-trash"></i></button>'+' '+
            // '<button  class="btn btn-success btn-xs j_info" data="'+data['data_jurnal'][i].id_jurnal+'" '+hides+' data-toggle="tooltip" data-placement="left" title="info"><i class="fa fa-info-circle"></i></button>'+' '+

            // <span style='cursor:pointer' class='mr-3 text-primary ttip edit-parent_parameter' data-toggle='tooltip' data-placement='top' title='Ubah' data-id='".$o['id_parent_parameter']."' nama='".$o['parent_parameter']."' bobot='".$o['bobot']."'><i class='fas fa-pencil-alt fa-lg'></i></span>

            $a0 = "<span style='cursor:pointer' class='$mr3 ttip text-primary btn-xs j_detail' data='".$o['id_jurnal']."' $hideb data-toggle='tooltip' data-placement='top' title='Detail'><i class='far fa-file-alt fa-lg'></i></span>
            <span style='cursor:pointer' class='mr-3 ttip text-dark btn-xs j_info' data='".$o['id_jurnal']."' $hidec data-toggle='tooltip' data-placement='top' title='Catatan Perbaikan'><i class='fa fa-info-circle fa-lg'></i></span>";

            if ($id_lvl_otorisasi == 0) {
                
                $a1 = "<span style='cursor:pointer' class='mr-3 ttip text-primary btn-xs j_edit' data='".$o['id_jurnal']."' $hide data-toggle='tooltip' data-placement='top' title='Edit'><i class='fas fa-pencil-alt fa-lg'></i></span>";
                $a2 = "<span style='cursor:pointer' class='ttip text-danger btn-xs j_hapus' data='".$o['id_jurnal']."' $hides data-toggle='tooltip' data-placement='top' title='Hapus'><i class='far fa-trash-alt fa-lg'></i></span>";
            } else {
                if ($update == 'true') {
      
                    if ($delete == 'true') {
                        $mrd = "mr-3";
                    } else {
                        $mrd = "";
                    }
      
                    $a1 = "<span style='cursor:pointer' class='$mrd ttip text-warning btn-xs j_edit' data='".$o['id_jurnal']."' $hide data-toggle='tooltip' data-placement='top' title='Edit'><i class='fas fa-pencil-alt fa-lg'></i></span>";

                } else {
                    $a1 = "<span style='cursor:pointer' class='ttip text-danger btn-xs j_hapus' data='".$o['id_jurnal']."' $hides data-toggle='tooltip' data-placement='top' title='Hapus'><i class='far fa-trash-alt fa-lg'></i></span>";
                }
      
                if ($delete == 'true') {
                    $a2 = "";
                } else {
                    $a2 = "";
                } 
            }


            $tbody[]    = "<div align='center'>".$no.".</div>";
            $tbody[]    = $o['kode_transaksi'];
            $tbody[]    = $o['nama_transaksi'];
            $tbody[]    = date("d-M-Y", strtotime($o['tgl_buat']));
            $tbody[]    = "<div class='text-right'>".number_format($o['total_debit'],0,'.','.')."</div>";
            $tbody[]    = "<div class='text-right'>".number_format($o['total_kredit'],0,'.','.')."</div>";
            $tbody[]    = $status;
            $tbody[]    = $a0.$a1.$a2;
            $data[]     = $tbody;
        }

        if ($read == 'true' || $id_lvl_otorisasi == 0) {
            $recordsTotal       = $this->M_jurnal_bb->jumlah_semua_jurnal_bb();
            $recordsFiltered    = $this->M_jurnal_bb->jumlah_filter_jurnal_bb();
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

    // 12-08-2021
    public function tambah_jurnal()
    {
        $data 	= [ 'title'             => 'Tambah Jurnal',
                    'role'              => $this->aksi_crud,
                    'id_lvl_otorisasi'  => $this->id_lvl_otorisasi,
                    'id_user'           => $this->session->userdata('sesi_id'),
                    'data_jurnal'       => $this->M_jurnal_bb->get_jurnal(),
                    'pelaksana'         => $this->M_jurnal_bb->get_data_order('m_karyawan', 'nama_karyawan', 'asc')->result(),
                    'coa'               => $this->M_jurnal_bb->get_data_order('des_coa', 'deskripsi_coa', 'asc')->result_array()
                ];

        $this->template->load('template/index','jurnal/V_tambah_jurnal', $data);
    }

    // 12-08-2021
    public function simpan_jurnal()
    {
        $nama_tr        = $this->input->post('nama_tr');
        $list_coa       = $this->input->post('list_coa');
        $list_pelaksana = $this->input->post('list_pelaksana');
        $list_tgl       = $this->input->post('list_tgl');
        $list_debit     = $this->input->post('list_debit');
        $list_kredit    = $this->input->post('list_kredit');
        $total_debit    = $this->input->post('total_debit');
        $total_kredit   = $this->input->post('total_kredit');
        $status_jurnal  = $this->input->post('status_jurnal');
        $id_jurnal_edit = $this->input->post('id_jurnal_edit');

        $this->db->trans_begin();

            if ($status_jurnal == 'tambah') {

                $get_last_code = $this->db->query('SELECT kode_transaksi from jurnal ORDER BY kode_transaksi DESC limit 1')->row_array();
                $d = date('dmY');

                if (!empty($get_last_code)) {
                    $last_kode = $get_last_code['kode_transaksi'];
                    $ck = str_replace('SP0', '', $last_kode);

                    $kd = "SP0".$ck+=1;
                        
                } else {
                    $kd = 'SP0'.$d.'01';
                }

                $arr = array(
                    'kode_transaksi'    => $kd,
                    'nama_transaksi'    => $nama_tr,
                    'tgl_buat'          => date('Y-m-d'),
                    'total_debit'       => $total_debit,
                    'total_kredit'      => $total_kredit,
                    'status'            => 0
                );

                $this->M_jurnal_bb->input_data('jurnal', $arr);
                $id_jurnal = $this->db->insert_id();
                
                for ($i=0; $i < count($list_coa); $i++) { 

                    $list_det[] = [ 'id_jurnal'     => $id_jurnal,
                                    'coa'           => $list_coa[$i],
                                    'tgl_transaksi' => date("Y-m-d", strtotime($list_tgl[$i])),
                                    'debit'         => $list_debit[$i],
                                    'kredit'        => $list_kredit[$i],
                                    'pelaksana'     => $list_pelaksana[$i]
                                ];   
                }

                $this->db->insert_batch('detail_jurnal', $list_det);

            } else {

                $arr = array(
                    'nama_transaksi'    => $nama_tr,
                    'tgl_buat'          => date('Y-m-d'),
                    'total_debit'       => $total_debit,
                    'total_kredit'      => $total_kredit,
                    'status'            => 3
                );

                $this->M_jurnal_bb->ubah_data('jurnal', $arr, ['id_jurnal' => $id_jurnal_edit]);

                $this->M_jurnal_bb->hapus_data('detail_jurnal', ['id_jurnal' => $id_jurnal_edit]);

                for ($i=0; $i < count($list_coa); $i++) { 

                    $list_det[] = [ 'id_jurnal'     => $id_jurnal_edit,
                                    'coa'           => $list_coa[$i],
                                    'tgl_transaksi' => date("Y-m-d", strtotime($list_tgl[$i])),
                                    'debit'         => $list_debit[$i],
                                    'kredit'        => $list_kredit[$i],
                                    'pelaksana'     => $list_pelaksana[$i]
                                ];   
                }

                $this->db->insert_batch('detail_jurnal', $list_det);

            }

        if($this->db->trans_status() === FALSE){
            $this->db->trans_rollback();
    
            echo json_encode(['status' => false]);
        }else{
            $this->db->trans_commit();
    
            echo json_encode(['status' => true]);
        }
        
    }

    // 10-08-2021
    public function hal_detail_jurnal($id_jurnal)
    {
        $data 	= [ 'title'                 => 'Detail Jurnal',
                    'role'                  => $this->aksi_crud,
                    'id_lvl_otorisasi'      => $this->id_lvl_otorisasi,
                    'id_user'               => $this->session->userdata('sesi_id'),
                    'id_jurnal'             => $id_jurnal,
                    'list_jurnal'           => $this->M_jurnal_bb->cari_data('jurnal', ['id_jurnal' => $id_jurnal])->row_array(),
                    'jml_detail_jurnal'     => $this->M_jurnal_bb->cari_data('detail_jurnal', ['id_jurnal' => $id_jurnal])->result_array(),
                    'detail_jurnal_aktif'   => $this->M_jurnal_bb->cari_data('detail_jurnal', ['id_jurnal' => $id_jurnal, 'status' => 1])->result_array()
                ];

        $this->template->load('template/index','jurnal/V_detail_jurnal', $data);
    }

    // 10-08-2021
    public function tampil_detail_jurnal()
    {
        $id_jurnal = $this->input->post('id_jurnal');

        if ($id_jurnal) {
        
            $list = $this->M_jurnal_bb->get_detail_jurnal($id_jurnal)->result_array();

            $data = array();

            $no   = $this->input->post('start');

            foreach ($list as $o) {
                $no++;
                $tbody = array();

                $s  = $o['status'];
                $sj = $o['status_jurnal'];

                if ($sj == 1) {
                    $st = "disabled";
                }
                else {
                    $st = "";
                }

                if ($s == 1) {
                    $status = "checked";
                } else {
                    $status = "";
                }

                $tbody[]    = "<div align='center'>".$no.".</div>";
                $tbody[]    = "<div class='text-center'><input type='checkbox' class='check_approval' id='check_".$o['id_detail_jurnal']."' $status data-id='".$o['id_detail_jurnal']."' $st></div>";
                $tbody[]    = $o['coa'];
                $tbody[]    = $o['deskripsi_coa'];
                $tbody[]    = date("d-m-Y", strtotime($o['tgl_transaksi']));
                $tbody[]    = "<div class='text-right list_debit' id='debit_".$o['id_detail_jurnal']."'>".number_format($o['debit'],0,'.','.')."</div>";
                $tbody[]    = "<div class='text-right list_kredit' id='kredit_".$o['id_detail_jurnal']."'>".number_format($o['kredit'],0,'.','.')."</div>";
                $data[]     = $tbody;
            }

            
            echo json_encode(['data' => $data, 'jumlah' => count($list)]);
        } else {
            echo json_encode(['data' => [], 'jumlah' => 0]);
        }
    }

    // 10-08-2021
    public function hal_tambah_jurnal()
    {
        $nama_tr = $this->input->post('nama_transaksi');

        $data 	= [ 'title'             => 'Tambah Jurnal',
                    'role'              => $this->aksi_crud,
                    'id_lvl_otorisasi'  => $this->id_lvl_otorisasi,
                    'id_user'           => $this->session->userdata('sesi_id'),
                    'nama_tr'           => $nama_tr
                ];

        $this->template->load('template/index','jurnal/V_tambah_jurnal', $data);
    }

    // 13-08-2021
    public function hal_edit_jurnal($id_jurnal)
    {
        $data 	= [ 'title'             => 'Edit Jurnal',
                    'role'              => $this->aksi_crud,
                    'id_lvl_otorisasi'  => $this->id_lvl_otorisasi,
                    'id_user'           => $this->session->userdata('sesi_id'),
                    'id_jurnal'         => $id_jurnal,
                    'data_jurnal'       => $this->M_jurnal_bb->cari_data('jurnal', ['id_jurnal' => $id_jurnal])->row_array(),
                    'detail_jurnal'     => $this->M_jurnal_bb->cari_data('detail_jurnal', ['id_jurnal' => $id_jurnal])->result_array(),
                    'pelaksana'         => $this->M_jurnal_bb->get_data_order('m_karyawan', 'nama_karyawan', 'asc')->result(),
                    'coa'               => $this->M_jurnal_bb->get_data_order('des_coa', 'deskripsi_coa', 'asc')->result_array()
                ];

        $this->template->load('template/index','jurnal/V_edit_jurnal', $data);
    }

    // 13-08-2021
    public function simpan_approval_jurnal()
    { 
        $id_jurnal      = $this->input->post('id_jurnal');
        $id_det_jurnal  = $this->input->post('id_det_jurnal');
        
        foreach ($id_det_jurnal as $d) {
            $this->M_jurnal_bb->ubah_data('detail_jurnal', ['status' => 1], ['id_detail_jurnal' => $d]);
        }

        $query = $this->db->query("select sum(debit) as debtot,sum(kredit) as kretot,coa,tgl_transaksi,dc.saldo_awal from detail_jurnal as dj join des_coa as dc ON dj.coa = dc.no_coa_des  where id_jurnal = '".$id_jurnal."' GROUP BY coa,dc.saldo_awal,tgl_transaksi")->result();

        $this->M_jurnal_bb->add_buku_besar($id_jurnal, $query);
        $this->M_jurnal_bb->post_jurnal($id_jurnal);

        echo json_encode(['status' => TRUE]);
    }
    
    public function form_history($id)
    {
        // $id = $this->uri->segment(4);
        $data['title'] = "Jurnal Dan Buku Besar";
        $data['Page'] = "Jurnal Dan Buku Besar";
        $data['userdata'] = $this->userdata;
        $data['detail_jurnal'] = $this->M_jurnal_bb->detail_jurnal($id);
        $data['group'] = $this->M_jurnal_bb->get_group();
        $data['pelaksana'] = $this->M_jurnal_bb->get_pelaksana();
        $this->template->views('keuangan/V_form_history', $data);
    }

    public function get_jurnal()
    {
        // $data['userdata'] = $this->userdata;
        $data['userdata'] = "Kepala Departemen Keuangan4";
        $data['data_jurnal'] = $this->M_jurnal_bb->get_jurnal();
        echo json_encode($data);
    }

    public function get_jurnal_fil()
    {
        $fil = $this->input->post('val_bulan');
        $data['userdata'] = $this->userdata;
        $data['data_jurnal'] = $this->M_jurnal_bb->get_jurnal_fil($fil);
        echo json_encode($data);
    }
    public function add_jurnal()
    {
        $get_last_code = $this->db->query('SELECT kode_transaksi from jurnal ORDER BY kode_transaksi DESC limit 1')->result();

        if ($this->db->affected_rows()>0) {
            foreach ($get_last_code as $key) {
                $last_kode = $key->kode_transaksi;
                $ck = str_replace('SP0', '', $last_kode);
                $arr = array(
                'kode_transaksi' =>"SP0".$ck+=1,
                'nama_transaksi' => $this->input->post('nama_tr'),
                'tgl_buat' => date('Y-m-d'),
                'status' => '4'
                );
            }
        } else {
            $d = date('dmY');
            $arr = array(
            'kode_transaksi' =>'SP0'.$d.'01',
            'nama_transaksi' => $this->input->post('nama_tr'),
            'tgl_buat' => date('Y-m-d'),
            'status' => '4'
            );
        }

        $this->M_jurnal_bb->save_jurnal($arr);

        $data = $this->M_jurnal_bb->get_id_jurnal();
        echo json_encode($data);
    }

    public function get_group()
    {
        $data= $this->M_jurnal_bb->get_group();
        echo json_encode($data);
    }

    public function get_pelaksana()
    {
        $data= $this->M_jurnal_bb->get_pelaksana();
        echo json_encode($data);
    }

    public function get_history()
    {
        $id = $this->input->get('id');
        $data = $this->M_jurnal_bb->get_history_jurnal($id);
        echo json_encode($data);
    }

    public function get_historyk()
    {
        $id = $this->input->get('id');
        $data = $this->M_jurnal_bb->get_history_jurnalk($id);
        echo json_encode($data);
    }

    public function get_list_form_jurnal()
    {
        $id = $this->input->get('id');
        $data = $this->M_jurnal_bb->get_list_form_jurnal($id);
        echo json_encode($data);
    }

    public function save_jd()
    {
        $arr = array(
            'id_jurnal' => $this->input->post('id'),
            'coa' => $this->input->post('des_coa'),
            'tgl_transaksi' => $this->input->post('tgl_transaksi'),
            'debit' => str_replace(',', '', $this->input->post('debit')),
            'kredit' => '0',
            'keterangan' => $this->input->post('keterangan'),
            'pelaksana'  => $this->input->post('pelaksana'),
            'id_group'       => $this->input->post('group')
        );
        $data = $this->M_jurnal_bb->save_jd($arr);
        echo json_encode($data);
    }

    public function save_jk()
    {
        $arr = array(
            'id_jurnal' => $this->input->post('id'),
            'coa' => $this->input->post('des_coa'),
            'tgl_transaksi' => $this->input->post('tgl_transaksi'),
            'kredit' => str_replace(',', '', $this->input->post('kredit')),
            'debit' => '0',
            'keterangan' => $this->input->post('keterangan'),
            'pelaksana'  => $this->input->post('pelaksana'),
            'id_group'       => $this->input->post('groupk')
        );
        $data = $this->M_jurnal_bb->save_jd($arr);
        echo json_encode($data);
    }

    public function post_jurnal()
    {
        $id = $this->input->post('id');
        $query = $this->db->query("select sum(debit) as debtot,sum(kredit) as kretot,coa,tgl_transaksi,dc.saldo_awal from detail_jurnal as dj join des_coa as dc ON dj.coa = dc.no_coa_des  where id_jurnal = '".$id."' GROUP BY coa,dc.saldo_awal,tgl_transaksi")->result();
        $this->M_jurnal_bb->add_buku_besar($id, $query);
        $data = $this->M_jurnal_bb->post_jurnal($id);
        echo json_encode($data);
    }

    public function cek_balance()
    {
        $id = $this->input->post('id');
        $data = $this->M_jurnal_bb->cek_balance($id);
        echo json_encode($data);
    }

    public function cek_balance_det()
    {
        $id = $this->input->post('id');
        $data = $this->M_jurnal_bb->cek_balance_det($id);
        echo json_encode($data);
    }


    public function detail_jurnal()
    {
        $id = $this->input->get('id');
        $data = $this->M_jurnal_bb->detail_jurnal($id);
        echo json_encode($data);
    }

    public function buku_besar()
    {
        if ($this->input->post('periode') != null) {
            $period = $this->input->post('periode');
            $periode = date('n', strtotime($period));
            $data['bb'] = $this->M_jurnal_bb->buku_besar($periode);
                $data['saw'] = $this->M_jurnal_bb->get_saw_bb();
        } else {
            $data = $this->M_jurnal_bb->buku_besar();
        }

        echo json_encode($data);
    }

    public function hapus_list_det()
    {
        $id = $this->input->post('id');
        $data = $this->M_jurnal_bb->hapus_list_det($id);
        echo json_encode($data);
    }

    public function edit_list_det()
    {
        $id = $this->input->get('id');
        $data = $this->M_jurnal_bb->edit_list_det($id);
        echo json_encode($data);
    }

    public function update_jd()
    {
        $id = $this->input->post('id');
        $arr = array(
            'tgl_transaksi' => $this->input->post('tgl_transaksi'),
            'debit' => str_replace(',', '', $this->input->post('debit')),
            'keterangan' => $this->input->post('keterangan'),
            'pelaksana' => $this->input->post('pelaksana'),
            'coa' =>$this->input->post('des_coa'),
            'id_group' => $this->input->post('group')
        );

        $data = $this->M_jurnal_bb->update_j($id, $arr);
        echo json_encode($data);
    }

    public function update_jk()
    {
        $id = $this->input->post('id');
        $arr = array(
           'tgl_transaksi' => $this->input->post('tgl_transaksi'),
           'kredit' => str_replace(',', '', $this->input->post('kredit')),
           'keterangan' => $this->input->post('keterangan'),
           'pelaksana' => $this->input->post('pelaksana'),
           'coa' =>$this->input->post('des_coa'),
           'id_group' => $this->input->post('group')
        );

        $data = $this->M_jurnal_bb->update_j($id, $arr);
        echo json_encode($data);
    }

    public function get_aktiva_lancar()
    {
        $data = $this->M_jurnal_bb->get_aktiva_lancar();
        echo json_encode($data);
    }

    public function total_aktiva_lancar()
    {
        $data = $this->M_jurnal_bb->aktiva_lancar_total();
        echo json_encode($data);
    }

    public function get_aktiva_tetap()
    {
        $data = $this->M_jurnal_bb->get_aktiva_tetap();
        echo json_encode($data);
    }

    public function total_aktiva_tetap()
    {
        $data = $this->M_jurnal_bb->aktiva_tetap_total();
        echo json_encode($data);
    }

    public function get_pendapatan()
    {
        $data = $this->M_jurnal_bb->get_pendapatan();
        echo json_encode($data);
    }

    public function total_pendapatan()
    {
        $data = $this->M_jurnal_bb->pendapatan_total();
        echo json_encode($data);
    }

    public function get_pendapatan_lain()
    {
        $data = $this->M_jurnal_bb->get_pendapatan_lain();
        echo json_encode($data);
    }

    public function total_pendapatan_lain()
    {
        $data = $this->M_jurnal_bb->pendapatan_lain_total();
        echo json_encode($data);
    }

    public function get_biaya()
    {
        $data = $this->M_jurnal_bb->get_biaya();
        echo json_encode($data);
    }

    public function total_biaya()
    {
        $data = $this->M_jurnal_bb->biaya_total();
        echo json_encode($data);
    }


    public function get_hutang()
    {
        $data = $this->M_jurnal_bb->get_hutang();
        echo json_encode($data);
    }

    public function total_hutang()
    {
        $data = $this->M_jurnal_bb->hutang_total();
        echo json_encode($data);
    }

    public function get_modal()
    {
        $data = $this->M_jurnal_bb->get_modal();
        echo json_encode($data);
    }

    public function total_modal()
    {
        $data = $this->M_jurnal_bb->modal_total();
        echo json_encode($data);
    }

    public function hapus_jurnal()
    {
        $id = $this->input->post('id');
        $data = $this->M_jurnal_bb->hapus_jurnal($id);
        echo json_encode($data);
    }

    public function uc_status_dj()
    {
        $id = $this->input->post('id');
        $data = $this->M_jurnal_bb->uc_status($id);
        echo json_encode($data);
    }

    public function c_status_dj()
    {
        $id = $this->input->post('id');
        $data = $this->M_jurnal_bb->c_status($id);
        echo json_encode($data);
    }

    public function total_pendapatan_all()
    {
        $data['pdpt'] = $this->M_jurnal_bb->pendapatan_total();
        $data['pdpt_lain'] = $this->M_jurnal_bb->pendapatan_lain_total();
        echo json_encode($data);
    }

    public function laba_usaha()
    {
        $data['pdpt'] = $this->M_jurnal_bb->pendapatan_total();
        $data['pdpt_lain'] = $this->M_jurnal_bb->pendapatan_lain_total();
        $data['biaya'] = $this->M_jurnal_bb->biaya_total();

        echo json_encode($data);
    }

    public function total_hm()
    {
        $data['hutang'] = $this->M_jurnal_bb->hutang_total();
        $data['modal'] = $this->M_jurnal_bb->modal_total();

        echo json_encode($data);
    }

    public function neraca()
    {
        $akt= $this->M_jurnal_bb->aktiva_lancar_total()[0]->saldo_akhir;
        $hut= $this->M_jurnal_bb->hutang_total()[0]->saldo_akhir;
        $mod= $this->M_jurnal_bb->modal_total()[0]->saldo_akhir;
        $data = $akt - ($hut + $mod);
        echo json_encode($data);
    }

    // public function jurnal_err_name()
    // {
    //  $id = $this->input->get('id');
    //  $data = $this->M_jurnal_bb->get_jurnal_err_name($id);
    //  echo json_encode($data);
    // }

    public function s_jurnal_err()
    {
        $id = $this->input->post('id_jurnal');
        $arr = array(
            'keterangan' => $this->input->post('catatan'),
            'status'     => "2"
        );
        $data = $this->M_jurnal_bb->s_jurnal_err($id, $arr);
        echo json_encode($data);
    }

    public function u_j_perbaikan()
    {
        $id = $this->input->post('id');
        $arr = array(
            'status'=>"3",
            'total_debit'=>"0",
            'total_kredit'=> "0"
        );
        $data = $this->M_jurnal_bb->u_j_perbaikan($id, $arr);
        echo json_encode($data);
    }

    public function detail_bb()
    {
        $id = $this->input->post('id');
        $coa = $this->input->post('coa');
        $data['det']= $this->M_jurnal_bb->get_detail_bb($coa);
        $data['sa'] = $this->M_jurnal_bb->get_saldo_awal($coa);
        $data['sak'] = $this->M_jurnal_bb->get_saldo_akhir($coa);
        echo json_encode($data);
    }

    public function excel()
    {
            $coa_ex = $this->input->post('coa_ex');
            $des_coa_ex = $this->input->post('des_coa_ex');
            $tgl_trans_ex = $this->input->post('tgl_trans_ex');
            $tgl_trans = date("F", strtotime($tgl_trans_ex));
            $group = $this->input->post('group');
            $det= $this->M_jurnal_bb->get_detail_bb_ex($coa_ex, $group);
            $saldo_awal = $this->M_jurnal_bb->get_saldo_awal($coa_ex);
            $saldo_akhir = $this->M_jurnal_bb->get_saldo_akhir($coa_ex);
            include_once'application/libraries/PHPExcel/Classes/PHPExcel.php';
            $excel = new PHPExcel();
    // Settingan awal fil excel
        $excel->getProperties()->setCreator('My Notes Code')
                 ->setLastModifiedBy('My Notes Code')
                 ->setTitle("Data Siswa")
                 ->setSubject("Siswa")
                 ->setDescription("Laporan Semua Data Siswa")
                 ->setKeywords("Data Siswa");
    // Buat sebuah variabel untuk menampung pengaturan style dari header tabel
        $style_col = array(
        'font' => array('bold' => true), // Set font nya jadi bold
        'alignment' => array(
        'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER, // Set text jadi ditengah secara horizontal (center)
        'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
        ),
        'borders' => array(
        'top' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border top dengan garis tipis
        'right' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),  // Set border right dengan garis tipis
        'bottom' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border bottom dengan garis tipis
        'left' => array('style'  => PHPExcel_Style_Border::BORDER_THIN) // Set border left dengan garis tipis
        )
        );
    // Buat sebuah variabel untuk menampung pengaturan style dari isi tabel
        $style_row = array(
        'alignment' => array(
        'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
        ),
        'borders' => array(
        'top' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border top dengan garis tipis
        'right' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),  // Set border right dengan garis tipis
        'bottom' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border bottom dengan garis tipis
        'left' => array('style'  => PHPExcel_Style_Border::BORDER_THIN) // Set border left dengan garis tipis
        )
        );
        $excel->setActiveSheetIndex(0)->setCellValue('A1', "LAPORAN BUKU BESAR");
        $excel->getActiveSheet()->mergeCells('A1:G1');
        $excel->setActiveSheetIndex(0)->setCellValue('A2', "GROUP ".strtoupper($group));
        $excel->getActiveSheet()->mergeCells('A2:G2');
        $excel->setActiveSheetIndex(0)->setCellValue('A3', "COA ".$coa_ex." - ".$des_coa_ex);
        $excel->getActiveSheet()->mergeCells('A3:G3');
        $excel->setActiveSheetIndex(0)->setCellValue('A4', "PERIODE BULAN ".strtoupper($tgl_trans));
        $excel->getActiveSheet()->mergeCells('A4:G4');
        $excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
        $excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(15);
        $excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $excel->getActiveSheet()->getStyle('A2')->getFont()->setBold(true);
        $excel->getActiveSheet()->getStyle('A2')->getFont()->setSize(12);
        $excel->getActiveSheet()->getStyle('A2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $excel->getActiveSheet()->getStyle('A3')->getFont()->setBold(true);
        $excel->getActiveSheet()->getStyle('A3')->getFont()->setSize(12);
        $excel->getActiveSheet()->getStyle('A3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $excel->getActiveSheet()->getStyle('A4')->getFont()->setBold(true);
        $excel->getActiveSheet()->getStyle('A4')->getFont()->setSize(12);
        $excel->getActiveSheet()->getStyle('A4')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $excel->getActiveSheet()->getStyle('E7')->getFont()->setBold(true);
        $excel->getActiveSheet()->getStyle('F7')->getFont()->setBold(true);
        $excel->getActiveSheet()->getStyle('E7')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);

    // Buat header tabel nya pada baris ke 3
        $excel->setActiveSheetIndex(0)->setCellValue('A6', "No");
        $excel->setActiveSheetIndex(0)->setCellValue('B6', "Tanggal");
        $excel->setActiveSheetIndex(0)->setCellValue('C6', "Uraian");
        $excel->setActiveSheetIndex(0)->setCellValue('D6', "Debit");
        $excel->setActiveSheetIndex(0)->setCellValue('E6', "Kredit");
        $excel->setActiveSheetIndex(0)->setCellValue('F6', "Total");
    // Apply style header yang telah kita buat tadi ke masing-masing kolom header
        $excel->getActiveSheet()->getStyle('A6')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('B6')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('C6')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('D6')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('E6')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('F6')->applyFromArray($style_col);
    // Panggil function view yang ada di SiswaModel untuk menampilkan semua data
        $excel->setActiveSheetIndex(0)->setCellValue('E7', "Saldo Awal :");
        $excel->setActiveSheetIndex(0)->setCellValue('F7', $saldo_awal);
        $no = 1; // Untuk penomoran tabel, di awal set dengan 1
        $numrow = 8; // Set baris pertama untuk isi tabel adalah baris ke 4
        foreach ($det as $var) {
            $excel->setActiveSheetIndex(0)->setCellValue('A'.$numrow, $no);
            $excel->setActiveSheetIndex(0)->setCellValue('B'.$numrow, $var->tgl_transaksi);
            $excel->setActiveSheetIndex(0)->setCellValue('C'.$numrow, $var->keterangan);
            $excel->setActiveSheetIndex(0)->setCellValue('D'.$numrow, $var->debit);
            $excel->setActiveSheetIndex(0)->setCellValue('E'.$numrow, -$var->kredit);
            $excel->setActiveSheetIndex(0)->setCellValue('F'.$numrow, $var->debit - $var->kredit);

      // Apply style row yang telah kita buat tadi ke masing-masing baris (isi tabel)
            $excel->getActiveSheet()->getStyle('A'.$numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('B'.$numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('C'.$numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('D'.$numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('E'.$numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('F'.$numrow)->applyFromArray($style_row);
            $no++;
            $numrow++;
        }
            $n = 8+count($det);

            $excel->setActiveSheetIndex(0)->setCellValue('E'.$n, "Saldo Akhir :");
            $excel->setActiveSheetIndex(0)->setCellValue('F'.$n, $saldo_akhir);
            $excel->getActiveSheet()->getStyle('E'.$n)->getFont()->setBold(true);
            $excel->getActiveSheet()->getStyle('F'.$n)->getFont()->setBold(true);
            $excel->getActiveSheet()->getStyle('E'.$n)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
            $excel->getActiveSheet()->getStyle('A7')->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('B7')->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('C7')->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('D7')->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('E7')->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('F7')->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('A'.$n)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('B'.$n)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('C'.$n)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('D'.$n)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('E'.$n)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('F'.$n)->applyFromArray($style_row);

    // Set width kolom
        $excel->getActiveSheet()->getColumnDimension('A')->setWidth(5);
        $excel->getActiveSheet()->getColumnDimension('B')->setWidth(15);
        $excel->getActiveSheet()->getColumnDimension('C')->setWidth(25);
        $excel->getActiveSheet()->getColumnDimension('D')->setWidth(20);
        $excel->getActiveSheet()->getColumnDimension('E')->setWidth(30);
        $excel->getActiveSheet()->getColumnDimension('F')->setWidth(30);

    // Set height semua kolom menjadi auto (mengikuti height isi dari kolommnya, jadi otomatis)
        $excel->getActiveSheet()->getDefaultRowDimension()->setRowHeight(-1);
    // Set orientasi kertas jadi LANDSCAPE
        $excel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);
    // Set judul file excel nya
        $excel->getActiveSheet(0)->setTitle("Buku Besar ".$coa_ex."_".date('dmy'));
        $excel->setActiveSheetIndex(0);
    // Proses file excel
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="Buku_Besar.xlsx"'); // Set nama file excel nya
        header('Cache-Control: max-age=0');
        $write = PHPExcel_IOFactory::createWriter($excel, 'Excel2007');
        $write->save('php://output');
    }

    public function get_des_coa()
    {
        $coa = $this->input->post('coa');
        $data = $this->M_jurnal_bb->get_des_coa($coa);
        echo json_encode($data);
    }

    public function get_info()
    {
        $id = $this->input->post('id');
        $data = $this->db->get_where('jurnal', array('id_jurnal'=>$id))->row();
        echo json_encode($data);
    }

    public function update_total()
    {
        $id = $this->input->post('id');
        $data = $this->M_jurnal_bb->u_total($id);
        echo json_encode($data);
    }

}

?>
