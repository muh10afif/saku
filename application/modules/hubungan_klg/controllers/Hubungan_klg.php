<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Hubungan_klg extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('M_hubungan_klg');
        if($this->session->userdata('username') == "") {
        redirect(base_url(), 'refresh');
        }

        $this->aksi_crud        = get_role($this->session->userdata('id_level_otorisasi'));
        $this->id_lvl_otorisasi = $this->session->userdata('id_level_otorisasi');
        $this->sesi_id          = $this->session->userdata('sesi_id');
    }

    public function index()
    {
        $data 	= [ 'title'             => 'Hubungan Keluarga',
                    'role'              => $this->aksi_crud,
                    'id_lvl_otorisasi'  => $this->id_lvl_otorisasi,
                    'id_user'           => $this->sesi_id
                ];

        $this->template->load('template/index','lihat', $data);
    }

    // 30-08-2021
    public function tampil_data_hubungan_klg()
    {
        $read               = $this->input->post('read');
        $create             = $this->input->post('create');
        $update             = $this->input->post('update');
        $delete             = $this->input->post('delete');
        $id_user            = $this->input->post('id_user');
        $id_lvl_otorisasi   = $this->input->post('id_lvl_otorisasi');

        if ($read == 'true' || $id_lvl_otorisasi == 0) {
            $list = $this->M_hubungan_klg->get_data_hubungan_klg();
        } else {
            $list = [];
        } 

        $data = array();

        $no   = $this->input->post('start');

        foreach ($list as $o) {
            $no++;
            $tbody = array();

            if ($id_lvl_otorisasi == 0) {
                $a1 = "<span style='cursor:pointer' class='mr-2 text-primary ttip edit' data-toggle='tooltip' data-placement='top' title='Ubah' data-id='".$o['id']."' hubungan_klg='".$o['hubungan_klg']."' status='".$o['status']."'><i class='fas fa-pencil-alt fa-lg'></i></span>";
                $a2 = "<span style='cursor:pointer' class='text-danger ttip hapus' data-toggle='tooltip' data-placement='top' title='Hapus' data-id='".$o['id']."' ><i class='far fa-trash-alt fa-lg'></i></span>";
            } else {
                if ($update == 'true') {
      
                    if ($delete == 'true') {
                        $mrd = "mr-2";
                    } else {
                        $mrd = "";
                    }
      
                    $a1 = "<span style='cursor:pointer' class='$mrd text-primary ttip edit' data-toggle='tooltip' data-placement='top' title='Ubah' data-id='".$o['id']."' hubungan_klg='".$o['hubungan_klg']."' status='".$o['status']."'><i class='fas fa-pencil-alt fa-lg'></i></span>";

                } else {
                    $a1 = "";
                }
      
                if ($delete == 'true') {
                    $a2 = "<span style='cursor:pointer' class='text-danger ttip hapus' data-toggle='tooltip' data-placement='top' title='Hapus' data-id='".$o['id']."' ><i class='far fa-trash-alt fa-lg'></i></span>";
                } else {
                    $a2 = "";
                } 
            }

            if ($o['status'] == 'kk') {
                $sts = "<span class='badge badge-primary'>KK</span>";
            } else {
                $sts = "<span class='badge badge-danger'>NON KK</span>";
            }

            $tbody[]    = "<div align='center'>".$no.".</div>";
            $tbody[]    = $o['hubungan_klg'];
            $tbody[]    = $sts;
            $tbody[]    = $a1.$a2;
            $data[]     = $tbody;
        }

        if ($read == 'true' || $id_lvl_otorisasi == 0) {
            $recordsTotal       = $this->M_hubungan_klg->jumlah_semua_hubungan_klg();
            $recordsFiltered    = $this->M_hubungan_klg->jumlah_filter_hubungan_klg();
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

    // 30-08-2021
    public function simpan_hubungan_klg()
    {
        $id_hubungan_klg    = $this->input->post('id_hubungan_klg');        
        $aksi               = $this->input->post('aksi');        
        $hubungan_klg       = $this->input->post('hubungan_klg');    
        $status             = $this->input->post('status');    

        if ($aksi == 'Tambah') {

            $inputan = ['LOWER(hubungan_klg)'  => strtolower($hubungan_klg),
                        'LOWER(status)'        => strtolower($status)
                        ];
            
            $cek = cek_duplicate_banyak('m_hubungan_klg', '', '', $inputan);

            if ($cek == 0) {

                $data = ['hubungan_klg'  => $hubungan_klg,
                         'status'        => $status,
                         'add_time'      => date("Y-m-d H:i:s", now('Asia/Jakarta')),
                         'add_by'        => $this->sesi_id
                        ];

                $this->M_hubungan_klg->input_data('m_hubungan_klg', $data); 

            } else {

                echo json_encode(['status' => 'gagal']);
                exit();

            }

        } elseif ($aksi == 'Hapus') {

            $this->M_hubungan_klg->hapus_data('m_hubungan_klg', ['id' => $id_hubungan_klg]);

        } elseif ($aksi == 'Ubah') {
            
            $inputan = ['LOWER(hubungan_klg)'  => strtolower($hubungan_klg),
                        'LOWER(status)'        => strtolower($status)
                        ];
            
            $cek = cek_duplicate_banyak('m_hubungan_klg', 'id', $id_hubungan_klg, $inputan);

            if ($cek == 0) {

                $data = ['hubungan_klg' => $hubungan_klg,
                         'status'       => $status,
                         'updated_time' => date("Y-m-d H:i:s", now('Asia/Jakarta')),
                         'updated_by'   => $this->sesi_id
                       ];

                $this->M_hubungan_klg->ubah_data('m_hubungan_klg', $data, ['id' => $id_hubungan_klg]);

            } else {

                echo json_encode(['status' => 'gagal']);
                exit();

            }
            
        }

        echo json_encode(['status' => 'sukses']);
    }

}

/* End of file Payment Tutor.php */
