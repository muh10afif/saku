<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class List_klaim extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('M_list_klaim');
        if($this->session->userdata('username') == "") {
        redirect(base_url(), 'refresh');
        }

        $this->aksi_crud        = get_role($this->session->userdata('id_level_otorisasi'));
        $this->id_lvl_otorisasi = $this->session->userdata('id_level_otorisasi');
        $this->sesi_id          = $this->session->userdata('sesi_id');

        $url = $this->db->get('m_setting')->row_array();

        $this->url_up   = $url['url_uploads'];
        $this->url_img  = $url['url_images'];
    }

    public function index()
    {
        $data 	= [ 'title'             => 'List Klaim',
                    'role'              => $this->aksi_crud,
                    'id_lvl_otorisasi'  => $this->id_lvl_otorisasi,
                    'id_user'           => $this->sesi_id,
                    'url_img'           => $this->url_img
                ];

        $this->template->load('template/index','lihat', $data);
    }

    // 30-08-2021
    public function tampil_data_list_klaim()
    {
        $read               = $this->input->post('read');
        $create             = $this->input->post('create');
        $update             = $this->input->post('update');
        $delete             = $this->input->post('delete');
        $id_user            = $this->input->post('id_user');
        $id_lvl_otorisasi   = $this->input->post('id_lvl_otorisasi');

        if ($read == 'true' || $id_lvl_otorisasi == 0) {
            $list = $this->M_list_klaim->get_data_list_klaim();
        } else {
            $list = [];
        } 

        $data = array();

        $no   = $this->input->post('start');

        foreach ($list as $o) {
            $no++;
            $tbody = array();

            $a2 = "";

            $a0 = "<span style='cursor:pointer' class='mr-3 text-dark ttip detail' data-toggle='tooltip' data-placement='top' title='Detail' data-id='".$o['id']."'><i class='fas fa-info-circle fa-lg'></i></span>";

            if ($id_lvl_otorisasi == 0) {
                $a1 = "<span style='cursor:pointer' class='text-primary ttip edit' data-toggle='tooltip' data-placement='top' title='Ubah Status Klaim' data-id='".$o['id']."' id_data_klaim='".$o['id_data_klaim']."' nama_nasabah='".$o['nama']."' no_polis='".$o['no_polis']."' status_klaim='".$o['status_klaim']."' alasan_tolak='".$o['alasan_tolak']."' nilai_ptg='".$o['nilai']."'><i class='fas fa-pencil-alt fa-lg'></i></span>";
                // $a2 = "<span style='cursor:pointer' class='text-danger ttip hapus' data-toggle='tooltip' data-placement='top' title='Hapus' data-id='".$o['id']."' ><i class='far fa-trash-alt fa-lg'></i></span>";
            } else {
                if ($update == 'true') {
      
                    if ($delete == 'true') {
                        $mrd = "mr-3";
                    } else {
                        $mrd = "";
                    }
      
                    $a1 = "<span style='cursor:pointer' class='$mrd text-primary ttip edit' data-toggle='tooltip' data-placement='top' title='Ubah' data-id='".$o['id']."' id_data_klaim='".$o['id_data_klaim']."' nama_nasabah='".$o['nama']."' no_polis='".$o['no_polis']."' status_klaim='".$o['status_klaim']."' alasan_tolak='".$o['alasan_tolak']."' nilai_ptg='".$o['nilai']."'><i class='fas fa-pencil-alt fa-lg'></i></span>";

                } else {
                    $a1 = "";
                }
      
                // if ($delete == 'true') {
                //     $a2 = "<span style='cursor:pointer' class='text-danger ttip hapus' data-toggle='tooltip' data-placement='top' title='Hapus' data-id='".$o['id']."' ><i class='far fa-trash-alt fa-lg'></i></span>";
                // } else {
                //     $a2 = "";
                // } 
            }

            if ($o['status_klaim'] == 0) {
                $sts = "<span class='badge badge-warning'>Diajukan</span>";
            } elseif ($o['status_klaim'] == 1) {
                $sts = "<span class='badge badge-primary'>Disetujui</span>";
            } elseif ($o['status_klaim'] == 2)  {
                $sts = "<span class='badge badge-dark'>Dicairkan</span>";
            } elseif ($o['status_klaim'] == 3)  {
                $sts = "<span class='badge badge-danger'>Ditolak</span>";
            }

            $tbody[]    = "<div align='center'>".$no.".</div>";
            $tbody[]    = $o['no_polis'];
            $tbody[]    = $o['nama'];
            $tbody[]    = $o['manfaat'];
            $tbody[]    = $o['nama_pemohon'];
            $tbody[]    = $sts;
            $tbody[]    = date("d-m-Y H:i:s", strtotime($o['add_time']));
            $tbody[]    = $a0.$a1.$a2;
            $data[]     = $tbody;
        }

        if ($read == 'true' || $id_lvl_otorisasi == 0) {
            $recordsTotal       = $this->M_list_klaim->jumlah_semua_list_klaim();
            $recordsFiltered    = $this->M_list_klaim->jumlah_filter_list_klaim();
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

    // 10-09-2021
    public function detail($id_sppa)
    {
        $list = $this->M_list_klaim->cari_sppa($id_sppa)->row_array();

        $id_user = $this->M_list_klaim->cari_data('m_user', ['id_pengguna_tertanggung' => $list['id_pengguna_tertanggung']])->row_array();

        $data = ['title'        => 'Detail Klaim',
                 'id_user'      => $id_user['id_user'],
                 'list'         => $list,
                 'ahli_waris'   => $this->M_list_klaim->cari_ahli_waris($id_sppa)->result_array(),
                 'dok_klaim'    => $this->M_list_klaim->cari_dok_klaim($list['id_data_klaim'])->result_array(),
                 'url_img'      => $this->url_img
                ];
        
        $this->template->load('template/index', 'V_detail', $data);
        
    }

    public function ubah_status_klaim()
    {
        $id_data_klaim  = $this->input->post('id_data_klaim');        
        $status_klaim   = $this->input->post('status_klaim');        
        $alasan_tolak   = $this->input->post('alasan_tolak');  
        $nilai_ptg      = $this->input->post('nilai_ptg');  

        if ($status_klaim == 2) {

            $data_p = ['tgl_bayar'      => date("Y-m-d", now('Asia/Jakarta')),
                       'nilai_bayar'    => $nilai_ptg
                    ];
            
            $this->M_list_klaim->ubah_data('tr_pembayaran_klaim', $data_p, ['id_data_klaim' => $id_data_klaim]);
        }      

        $data = ['status_klaim' => $status_klaim,
                 'alasan_tolak' => $alasan_tolak
                ];
        $this->M_list_klaim->ubah_data('tr_data_klaim', $data, ['id_data_klaim' => $id_data_klaim]);

        echo json_encode(['status' => true]);
    }

    public function tes()
    {
        if (strpos('Meninggal Dunia akibat sakit', 'sakit') !== false) {
            echo 'true';
        }
    }

    // 30-08-2021
    public function simpan_list_klaim()
    {
        $id_list_klaim    = $this->input->post('id_list_klaim');        
        $aksi               = $this->input->post('aksi');        
        $list_klaim       = $this->input->post('list_klaim');    
        $status             = $this->input->post('status');    

        if ($aksi == 'Tambah') {

            $inputan = ['LOWER(list_klaim)'  => strtolower($list_klaim),
                        'LOWER(status)'        => strtolower($status)
                        ];
            
            $cek = cek_duplicate_banyak('m_list_klaim', '', '', $inputan);

            if ($cek == 0) {

                $data = ['list_klaim'  => $list_klaim,
                         'status'        => $status,
                         'add_time'      => date("Y-m-d H:i:s", now('Asia/Jakarta')),
                         'add_by'        => $this->sesi_id
                        ];

                $this->M_list_klaim->input_data('m_list_klaim', $data); 

            } else {

                echo json_encode(['status' => 'gagal']);
                exit();

            }

        } elseif ($aksi == 'Hapus') {

            $this->M_list_klaim->hapus_data('m_list_klaim', ['id' => $id_list_klaim]);

        } elseif ($aksi == 'Ubah') {
            
            $inputan = ['LOWER(list_klaim)'  => strtolower($list_klaim),
                        'LOWER(status)'        => strtolower($status)
                        ];
            
            $cek = cek_duplicate_banyak('m_list_klaim', 'id', $id_list_klaim, $inputan);

            if ($cek == 0) {

                $data = ['list_klaim' => $list_klaim,
                         'status'       => $status,
                         'updated_time' => date("Y-m-d H:i:s", now('Asia/Jakarta')),
                         'updated_by'   => $this->sesi_id
                       ];

                $this->M_list_klaim->ubah_data('m_list_klaim', $data, ['id' => $id_list_klaim]);

            } else {

                echo json_encode(['status' => 'gagal']);
                exit();

            }
            
        }

        echo json_encode(['status' => 'sukses']);
    }

}

/* End of file Payment Tutor.php */
