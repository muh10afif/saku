<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Pekerjaan extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('M_pekerjaan');
        if($this->session->userdata('username') == "") {
        redirect(base_url(), 'refresh');
        }

        $this->aksi_crud        = get_role($this->session->userdata('id_level_otorisasi'));
        $this->id_lvl_otorisasi = $this->session->userdata('id_level_otorisasi');
        $this->sesi_id          = $this->session->userdata('sesi_id');
    }

    public function index()
    {
        $data 	= [ 'title'             => 'Pekerjaan',
                    'role'              => $this->aksi_crud,
                    'id_lvl_otorisasi'  => $this->id_lvl_otorisasi,
                    'id_user'           => $this->sesi_id
                ];

        $this->template->load('template/index','lihat', $data);
    }

    // 30-08-2021
    public function tampil_data_pekerjaan()
    {
        $read               = $this->input->post('read');
        $create             = $this->input->post('create');
        $update             = $this->input->post('update');
        $delete             = $this->input->post('delete');
        $id_user            = $this->input->post('id_user');
        $id_lvl_otorisasi   = $this->input->post('id_lvl_otorisasi');

        if ($read == 'true' || $id_lvl_otorisasi == 0) {
            $list = $this->M_pekerjaan->get_data_pekerjaan();
        } else {
            $list = [];
        } 

        $data = array();

        $no   = $this->input->post('start');

        foreach ($list as $o) {
            $no++;
            $tbody = array();

            if ($id_lvl_otorisasi == 0) {
                $a1 = "<span style='cursor:pointer' class='mr-2 text-primary ttip edit' data-toggle='tooltip' data-placement='top' title='Ubah' data-id='".$o['id_pekerjaan']."' pekerjaan='".$o['pekerjaan']."'><i class='fas fa-pencil-alt fa-lg'></i></span>";
                $a2 = "<span style='cursor:pointer' class='text-danger ttip hapus' data-toggle='tooltip' data-placement='top' title='Hapus' data-id='".$o['id_pekerjaan']."' ><i class='far fa-trash-alt fa-lg'></i></span>";
            } else {
                if ($update == 'true') {
      
                    if ($delete == 'true') {
                        $mrd = "mr-2";
                    } else {
                        $mrd = "";
                    }
      
                    $a1 = "<span style='cursor:pointer' class='$mrd text-primary ttip edit' data-toggle='tooltip' data-placement='top' title='Ubah' data-id='".$o['id_pekerjaan']."' pekerjaan='".$o['pekerjaan']."'><i class='fas fa-pencil-alt fa-lg'></i></span>";

                } else {
                    $a1 = "";
                }
      
                if ($delete == 'true') {
                    $a2 = "<span style='cursor:pointer' class='text-danger ttip hapus' data-toggle='tooltip' data-placement='top' title='Hapus' data-id='".$o['id_pekerjaan']."' ><i class='far fa-trash-alt fa-lg'></i></span>";
                } else {
                    $a2 = "";
                } 
            }


            $tbody[]    = "<div align='center'>".$no.".</div>";
            $tbody[]    = $o['pekerjaan'];
            $tbody[]    = $a1.$a2;
            $data[]     = $tbody;
        }

        if ($read == 'true' || $id_lvl_otorisasi == 0) {
            $recordsTotal       = $this->M_pekerjaan->jumlah_semua_pekerjaan();
            $recordsFiltered    = $this->M_pekerjaan->jumlah_filter_pekerjaan();
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
    public function simpan_pekerjaan()
    {
        $id_pekerjaan   = $this->input->post('id_pekerjaan');        
        $aksi           = $this->input->post('aksi');        
        $pekerjaan      = $this->input->post('pekerjaan');    

        if ($aksi == 'Tambah') {
            
            $cek = cek_duplicate('m_pekerjaan', 'pekerjaan', '', '', $pekerjaan);

            if ($cek == 0) {

                $data = ['pekerjaan'    => $pekerjaan,
                         'add_time'     => date("Y-m-d H:i:s", now('Asia/Jakarta')),
                         'add_by'       => $this->sesi_id
                        ];

                $this->M_pekerjaan->input_data('m_pekerjaan', $data); 

            } else {

                echo json_encode(['status' => 'gagal']);
                exit();

            }

        } elseif ($aksi == 'Hapus') {

            $this->M_pekerjaan->hapus_data('m_pekerjaan', ['id_pekerjaan' => $id_pekerjaan]);

        } elseif ($aksi == 'Ubah') {
            
            $cek = cek_duplicate('m_pekerjaan', 'pekerjaan', 'id_pekerjaan', $id_pekerjaan, $pekerjaan);

            if ($cek == 0) {

                $data = ['pekerjaan'    => $pekerjaan,
                         'updated_time' => date("Y-m-d H:i:s", now('Asia/Jakarta')),
                         'updated_by'   => $this->sesi_id
                       ];

                $this->M_pekerjaan->ubah_data('m_pekerjaan', $data, ['id_pekerjaan' => $id_pekerjaan]);

            } else {

                echo json_encode(['status' => 'gagal']);
                exit();

            }
            
        }

        echo json_encode(['status' => 'sukses']);
    }

}

/* End of file Payment Tutor.php */
