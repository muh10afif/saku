<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Ahli_waris extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('M_ahli_waris');
        if($this->session->userdata('username') == "") {
        redirect(base_url(), 'refresh');
        }

        $this->aksi_crud        = get_role($this->session->userdata('id_level_otorisasi'));
        $this->id_lvl_otorisasi = $this->session->userdata('id_level_otorisasi');
        $this->sesi_id          = $this->session->userdata('sesi_id');
    }

    public function index()
    {
        $data 	= [ 'title'             => 'Ahli Waris',
                    'role'              => $this->aksi_crud,
                    'id_lvl_otorisasi'  => $this->id_lvl_otorisasi,
                    'id_user'           => $this->sesi_id
                ];

        $this->template->load('template/index','lihat', $data);
    }

    // 30-08-2021
    public function tampil_data_ahli_waris()
    {
        $read               = $this->input->post('read');
        $create             = $this->input->post('create');
        $update             = $this->input->post('update');
        $delete             = $this->input->post('delete');
        $id_user            = $this->input->post('id_user');
        $id_lvl_otorisasi   = $this->input->post('id_lvl_otorisasi');

        if ($read == 'true' || $id_lvl_otorisasi == 0) {
            $list = $this->M_ahli_waris->get_data_ahli_waris();
        } else {
            $list = [];
        } 

        $data = array();

        $no   = $this->input->post('start');

        foreach ($list as $o) {
            $no++;
            $tbody = array();

            $a0 = "<span style='cursor:pointer' class='mr-2 text-dark ttip detail' data-toggle='tooltip' data-placement='top' title='Detail' data-id='".$o['id']."'><i class='fas fa-info-circle fa-lg'></i></span>";

            if ($id_lvl_otorisasi == 0) {
                $a1 = "<span style='cursor:pointer' class='mr-2 text-primary ttip edit' data-toggle='tooltip' data-placement='top' title='Ubah' data-id='".$o['id']."'><i class='fas fa-pencil-alt fa-lg'></i></span>";
                $a2 = "<span style='cursor:pointer' class='text-danger ttip hapus' data-toggle='tooltip' data-placement='top' title='Hapus' data-id='".$o['id']."' ><i class='far fa-trash-alt fa-lg'></i></span>";
            } else {
                if ($update == 'true') {
      
                    if ($delete == 'true') {
                        $mrd = "mr-2";
                    } else {
                        $mrd = "";
                    }
      
                    $a1 = "<span style='cursor:pointer' class='$mrd text-primary ttip edit' data-toggle='tooltip' data-placement='top' title='Ubah' data-id='".$o['id']."'><i class='fas fa-pencil-alt fa-lg'></i></span>";

                } else {
                    $a1 = "";
                }
      
                if ($delete == 'true') {
                    $a2 = "<span style='cursor:pointer' class='text-danger ttip hapus' data-toggle='tooltip' data-placement='top' title='Hapus' data-id='".$o['id']."' ><i class='far fa-trash-alt fa-lg'></i></span>";
                } else {
                    $a2 = "";
                } 
            }

            if ($o['status_polis'] == 0) {
                $sts = "<span class='badge badge-warning'>Pending</span>";
            } elseif ($o['status_polis'] == 1) {
                $sts = "<span class='badge badge-primary'>Aktif</span>";
            } elseif ($o['status_polis'] == 2)  {
                $sts = "<span class='badge badge-danger'>Tidak Aktif</span>";
            }

            $tbody[]    = "<div align='center'>".$no.".</div>";
            $tbody[]    = $o['no_polis'];
            $tbody[]    = $o['nik'];
            $tbody[]    = $o['nama_nasabah'];
            $tbody[]    = $o['telp'];
            $tbody[]    = $sts;
            $tbody[]    = $a0.$a1.$a2;
            $data[]     = $tbody;
        }

        if ($read == 'true' || $id_lvl_otorisasi == 0) {
            $recordsTotal       = $this->M_ahli_waris->jumlah_semua_ahli_waris();
            $recordsFiltered    = $this->M_ahli_waris->jumlah_filter_ahli_waris();
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
        $sppa = $this->M_ahli_waris->cari_sppa($id_sppa)->row_array();
        
        $data = ['list'         => $sppa,
                 'ahli_waris'   => $this->M_ahli_waris->cari_ahli_waris($id_sppa)->result_array(),
                 'aw_dari'      => $this->M_ahli_waris->cari_ahli_waris_dari($sppa['nik'])->result_array()
                ];
        
        $this->load->view('V_detail', $data);
        
    }

    // 30-08-2021
    public function simpan_ahli_waris()
    {
        $id_ahli_waris    = $this->input->post('id_ahli_waris');        
        $aksi               = $this->input->post('aksi');        
        $ahli_waris       = $this->input->post('ahli_waris');    
        $status             = $this->input->post('status');    

        if ($aksi == 'Tambah') {

            $inputan = ['LOWER(ahli_waris)'  => strtolower($ahli_waris),
                        'LOWER(status)'        => strtolower($status)
                        ];
            
            $cek = cek_duplicate_banyak('m_ahli_waris', '', '', $inputan);

            if ($cek == 0) {

                $data = ['ahli_waris'  => $ahli_waris,
                         'status'        => $status,
                         'add_time'      => date("Y-m-d H:i:s", now('Asia/Jakarta')),
                         'add_by'        => $this->sesi_id
                        ];

                $this->M_ahli_waris->input_data('m_ahli_waris', $data); 

            } else {

                echo json_encode(['status' => 'gagal']);
                exit();

            }

        } elseif ($aksi == 'Hapus') {

            $this->M_ahli_waris->hapus_data('m_ahli_waris', ['id' => $id_ahli_waris]);

        } elseif ($aksi == 'Ubah') {
            
            $inputan = ['LOWER(ahli_waris)'  => strtolower($ahli_waris),
                        'LOWER(status)'        => strtolower($status)
                        ];
            
            $cek = cek_duplicate_banyak('m_ahli_waris', 'id', $id_ahli_waris, $inputan);

            if ($cek == 0) {

                $data = ['ahli_waris' => $ahli_waris,
                         'status'       => $status,
                         'updated_time' => date("Y-m-d H:i:s", now('Asia/Jakarta')),
                         'updated_by'   => $this->sesi_id
                       ];

                $this->M_ahli_waris->ubah_data('m_ahli_waris', $data, ['id' => $id_ahli_waris]);

            } else {

                echo json_encode(['status' => 'gagal']);
                exit();

            }
            
        }

        echo json_encode(['status' => 'sukses']);
    }

}

/* End of file Payment Tutor.php */
