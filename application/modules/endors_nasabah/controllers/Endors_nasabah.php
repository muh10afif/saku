<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Endors_nasabah extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('M_endors_nasabah');
        if($this->session->userdata('username') == "") {
        redirect(base_url(), 'refresh');
        }

        $this->aksi_crud        = get_role($this->session->userdata('id_level_otorisasi'));
        $this->id_lvl_otorisasi = $this->session->userdata('id_level_otorisasi');
        $this->sesi_id          = $this->session->userdata('sesi_id');
    }

    public function index()
    {
        $data 	= [ 'title'             => 'Endorsment',
                    'role'              => $this->aksi_crud,
                    'id_lvl_otorisasi'  => $this->id_lvl_otorisasi,
                    'id_user'           => $this->sesi_id
                ];

        $this->template->load('template/index','lihat', $data);
    }

    // 30-08-2021
    public function tampil_data_endors_nasabah()
    {
        $read               = $this->input->post('read');
        $create             = $this->input->post('create');
        $update             = $this->input->post('update');
        $delete             = $this->input->post('delete');
        $id_user            = $this->input->post('id_user');
        $id_lvl_otorisasi   = $this->input->post('id_lvl_otorisasi');

        if ($read == 'true' || $id_lvl_otorisasi == 0) {
            $list = $this->M_endors_nasabah->get_data_endors_nasabah();
        } else {
            $list = [];
        } 

        $data = array();

        $no   = $this->input->post('start');

        foreach ($list as $o) {
            $no++;
            $tbody = array();

            $hid = "";

            if ($o['status'] == 0) {
                $sts = "<span class='badge badge-warning'>Pending</span>"; 
            } else if ($o['status'] == 1) {
                $sts = "<span class='badge badge-primary'>Disetujui</span>";
                $hid = "hidden";
            } else if ($o['status'] == 2) {
                $sts = "<span class='badge badge-danger'>Ditolak</span>";
            }

            $cari = $this->M_endors_nasabah->cari_data('tr_endorsment', ['id_nasabah' => $o['id_nasabah'], 'nama_endorsment' => $o['nama_endorsment']])->row_array();

            if ($id_lvl_otorisasi == 0) {
                $a1 = "<span style='cursor:pointer' class='mr-2 text-primary ttip ubah' data-toggle='tooltip' data-placement='top' title='Ubah Status Endorsment' data-id='".$o['id_nasabah']."' nama_endorsment='".$o['nama_endorsment']."' id_endors_nasabah='".$cari['id_endors_nasabah']."' status='".$o['status']."' id_tr_endorsment='".$cari['id_tr_endorsment']."' $hid><i class='fas fa-pencil-alt fa-lg'></i></span>
                <span style='cursor:pointer' class='text-dark ttip lihat' data-toggle='tooltip' data-placement='top' title='List Endorsment' data-id='".$o['id_nasabah']."'><i class='fas fa-list-ul fa-lg'></i></span>
                ";
                // $a2 = "<span style='cursor:pointer' class='text-danger ttip hapus' data-toggle='tooltip' data-placement='top' title='Hapus' data-id='".$o['id_tr_endorsment']."' ><i class='far fa-trash-alt fa-lg'></i></span>";
            } else {
                if ($update == 'true') {
      
                    if ($delete == 'true') {
                        $mrd = "mr-2";
                    } else {
                        $mrd = "";
                    }
      
                    $a1 = "<span style='cursor:pointer' class='$mrd text-primary ttip ubah' data-toggle='tooltip' data-placement='top' title='Ubah' data-id='".$o['id_nasabah']."' nama_endorsment='".$o['nama_endorsment']."' id_endors_nasabah='".$cari['id_endors_nasabah']."' status='".$o['status']."' id_tr_endorsment='".$cari['id_tr_endorsment']."' $hid><i class='fas fa-pencil-alt fa-lg'></i></span>
                    <span style='cursor:pointer' class='text-dark ttip lihat' data-toggle='tooltip' data-placement='top' title='List Endorsment' data-id='".$o['id_nasabah']."'><i class='fas fa-list-ul fa-lg'></i></span>
                    ";

                } else {
                    $a1 = "";
                }
      
                // if ($delete == 'true') {
                //     $a2 = "<span style='cursor:pointer' class='text-danger ttip hapus' data-toggle='tooltip' data-placement='top' title='Hapus' data-id='".$o['id_tr_endorsment']."' ><i class='far fa-trash-alt fa-lg'></i></span>";
                // } else {
                //     $a2 = "";
                // } 
            }

            $tbody[]    = "<div align='center'>".$no.".</div>";
            $tbody[]    = $o['nama'];
            $tbody[]    = $o['nama_endorsment'];
            $tbody[]    = $sts;
            $tbody[]    = $a1;
            $data[]     = $tbody;
        }

        if ($read == 'true' || $id_lvl_otorisasi == 0) {
            $recordsTotal       = $this->M_endors_nasabah->jumlah_semua_endors_nasabah();
            $recordsFiltered    = $this->M_endors_nasabah->jumlah_filter_endors_nasabah();
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

    // 14-09-2021
    public function list_endors($id_nasabah)
    {
        $cari = $this->M_endors_nasabah->cari_data('pengguna_tertanggung', ['id_pengguna_tertanggung' => $id_nasabah])->row_array();

        $data 	= [ 'title'             => 'List Endorsment '.$cari['nama'],
                    'id_nasabah'        => $id_nasabah,
                    'nama_nasabah'      => $cari['nama'],
                    'role'              => $this->aksi_crud,
                    'id_lvl_otorisasi'  => $this->id_lvl_otorisasi,
                    'id_user'           => $this->sesi_id
                  ];

        $this->template->load('template/index','V_detail', $data);
    }

    public function tampil_list_endors()
    {
        $id_nasabah = $this->input->post('id_nasabah');
        
        $list = $this->M_endors_nasabah->cari_data_order('tr_endorsment', ['id_nasabah' => $id_nasabah], 'nama_endorsment', 'asc')->result_array();

        $data = array();
        $no   = $this->input->post('start');

        foreach ($list as $o) {

            $no++;
            $tbody = array();

            if ($o['status'] == 0) {
                $sts = "<span class='badge badge-warning'>Pending</span>"; 
            } else if ($o['status'] == 1) {
                $sts = "<span class='badge badge-primary'>Disetujui</span>";
            } else if ($o['status'] == 2) {
                $sts = "<span class='badge badge-danger'>Ditolak</span>";
            }

            if ($o['updated_time'] == '') {
                $tgl = $o['add_time'];
            } else {
                $tgl = $o['updated_time'];
            }

            $tbody[]    = "<div align='center'>".$no.".</div>";
            $tbody[]    = $o['nama_endorsment'];
            $tbody[]    = date("d-m-Y H:i:s", strtotime($o['add_time']));
            $tbody[]    = $sts;
            $tbody[]    = "<span style='cursor:pointer' class='text-dark ttip detail' data-toggle='tooltip' data-placement='top' title='Detail Endorsment' data-id='".$o['id_tr_endorsment']."' id_endors_nasabah='".$o['id_endors_nasabah']."' nama_endorsment='".$o['nama_endorsment']."'><i class='fas fa-info-circle fa-lg'></i></span>";
            $data[]     = $tbody;
            
        }

        echo json_encode(['data' => $data]);

    }

    public function get_endors_nasabah()
    {
        $id_endors_nasabah  = $this->input->post('id_endors_nasabah');
        $id_tr_endorsment   = $this->input->post('id_tr_endorsment');
        
        $cari   = $this->M_endors_nasabah->cari_data('m_endors_nasabah', ['id' => $id_endors_nasabah])->row_array();
        $cari_2 = $this->M_endors_nasabah->cari_data('tr_endorsment', ['id_tr_endorsment' => $id_tr_endorsment])->row_array();

        if ($cari['id_pekerjaan'] != '') {
            $pk     = $this->M_endors_nasabah->cari_data('m_pekerjaan', ['id_pekerjaan' => $cari['id_pekerjaan']])->row_array();
            $nm_pkj = $pk['pekerjaan'];
        } else {
            $nm_pkj = "";
        }

        echo json_encode(['list' => $cari, 'tgl_lahir' => date("d-m-Y", strtotime($cari['tgl_lahir'])), 'endors' => $cari_2, 'pekerjaan' => $nm_pkj]);
    }

    // 14-09-2021
    public function ubah_status_endors()
    {
        $id_tr_endorsment   = $this->input->post('id_tr_endorsment');        
        $id_endors_nasabah  = $this->input->post('id_endors_nasabah');        
        $id_nasabah         = $this->input->post('id_nasabah');        
        $status_endors      = $this->input->post('status_endors');        
        $alasan_tolak       = $this->input->post('alasan_tolak');        

        $data = ['status'       => $status_endors,
                 'alasan_tolak' => $alasan_tolak,
                 'updated_time' => date("Y-m-d H:i:s", now('Asia/Jakarta'))
                ];

        $cari = $this->M_endors_nasabah->cari_data('m_endors_nasabah', ['id' => $id_endors_nasabah])->row_array();

        $dt_endors = ['nik'             => $cari['nik'],
                      'nama'            => $cari['nama_nasabah'],
                      'tgl_lahir'       => $cari['tgl_lahir'],
                      'telp'            => $cari['telp'],
                      'email'           => $cari['email'],
                      'alamat'          => $cari['alamat_rumah'],
                      'jenis_kelamin'   => $cari['jenis_kelamin'],
                      'tempat_lahir'    => $cari['tempat_lahir'],
                      'id_pekerjaan'    => $cari['id_pekerjaan']
                     ]; 

        $this->db->trans_begin();

        $this->M_endors_nasabah->ubah_data('tr_endorsment', $data, ['id_tr_endorsment' => $id_tr_endorsment]);

        if ($status_endors == 1) {
            $this->M_endors_nasabah->ubah_data('pengguna_tertanggung', $dt_endors, ['id_pengguna_tertanggung' => $id_nasabah]);
        }

        if($this->db->trans_status() === FALSE){

            $this->db->trans_rollback();
            echo json_encode(['status' => false]);

        }else{

            $this->db->trans_commit();
            echo json_encode(['status' => true]);

        }
    }

    // 30-08-2021
    public function simpan_endors_nasabah()
    {
        $id_endors_nasabah    = $this->input->post('id_endors_nasabah');        
        $aksi               = $this->input->post('aksi');        
        $endors_nasabah       = $this->input->post('endors_nasabah');    
        $status             = $this->input->post('status');    

        if ($aksi == 'Tambah') {

            $inputan = ['LOWER(endors_nasabah)'  => strtolower($endors_nasabah),
                        'LOWER(status)'        => strtolower($status)
                        ];
            
            $cek = cek_duplicate_banyak('m_endors_nasabah', '', '', $inputan);

            if ($cek == 0) {

                $data = ['endors_nasabah'  => $endors_nasabah,
                         'status'        => $status,
                         'add_time'      => date("Y-m-d H:i:s", now('Asia/Jakarta')),
                         'add_by'        => $this->sesi_id
                        ];

                $this->M_endors_nasabah->input_data('m_endors_nasabah', $data); 

            } else {

                echo json_encode(['status' => 'gagal']);
                exit();

            }

        } elseif ($aksi == 'Hapus') {

            $this->M_endors_nasabah->hapus_data('m_endors_nasabah', ['id' => $id_endors_nasabah]);

        } elseif ($aksi == 'Ubah') {
            
            $inputan = ['LOWER(endors_nasabah)'  => strtolower($endors_nasabah),
                        'LOWER(status)'        => strtolower($status)
                        ];
            
            $cek = cek_duplicate_banyak('m_endors_nasabah', 'id', $id_endors_nasabah, $inputan);

            if ($cek == 0) {

                $data = ['endors_nasabah' => $endors_nasabah,
                         'status'       => $status,
                         'updated_time' => date("Y-m-d H:i:s", now('Asia/Jakarta')),
                         'updated_by'   => $this->sesi_id
                       ];

                $this->M_endors_nasabah->ubah_data('m_endors_nasabah', $data, ['id' => $id_endors_nasabah]);

            } else {

                echo json_encode(['status' => 'gagal']);
                exit();

            }
            
        }

        echo json_encode(['status' => 'sukses']);
    }

}

/* End of file Payment Tutor.php */
