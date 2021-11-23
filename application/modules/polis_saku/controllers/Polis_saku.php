<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Polis_saku extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('M_polis_saku');
        if($this->session->userdata('username') == "") {
        redirect(base_url(), 'refresh');
        }

        $this->aksi_crud        = get_role($this->session->userdata('id_level_otorisasi'));
        $this->id_lvl_otorisasi = $this->session->userdata('id_level_otorisasi');
        $this->sesi_id          = $this->session->userdata('sesi_id');
    }

    public function index()
    {
        $data 	= [ 'title'             => 'List Polis',
                    'role'              => $this->aksi_crud,
                    'id_lvl_otorisasi'  => $this->id_lvl_otorisasi,
                    'id_user'           => $this->sesi_id
                ];

        $this->template->load('template/index','lihat', $data);
    }

    public function tes_ttd()
    {
        $this->load->view('ttd');
        
    }

    public function upload_ttd()
    {
        $folderPath = "./uploads/";
  
        $image_parts = explode(";base64,", $_POST['signed']);
            
        $image_type_aux = explode("image/", $image_parts[0]);
          
        $image_type = $image_type_aux[1];
          
        $image_base64 = base64_decode($image_parts[1]);
          
        $file = $folderPath . uniqid() . '.'.$image_type;
          
        file_put_contents($file, $image_base64);
        // echo "Signature Uploaded Successfully.";

        echo json_encode(['status' => true]);
    }

    // 30-08-2021
    public function tampil_data_polis_saku()
    {
        $read               = $this->input->post('read');
        $create             = $this->input->post('create');
        $update             = $this->input->post('update');
        $delete             = $this->input->post('delete');
        $id_user            = $this->input->post('id_user');
        $id_lvl_otorisasi   = $this->input->post('id_lvl_otorisasi');

        if ($read == 'true' || $id_lvl_otorisasi == 0) {
            $list = $this->M_polis_saku->get_data_polis_saku();
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

            $tbody[]    = "<div align='center'>".$no.".</div>";
            $tbody[]    = $o['no_polis'];
            $tbody[]    = $o['nama_nasabah'];
            $tbody[]    = $o['tgl_awal_polis'];
            $tbody[]    = $o['tgl_akhir_polis'];
            $tbody[]    = number_format($o['premi'],0,'.','.');
            $tbody[]    = $o['nama_metode'];
            $tbody[]    = $a0.$a1.$a2;
            $data[]     = $tbody;
        }

        if ($read == 'true' || $id_lvl_otorisasi == 0) {
            $recordsTotal       = $this->M_polis_saku->jumlah_semua_polis_saku();
            $recordsFiltered    = $this->M_polis_saku->jumlah_filter_polis_saku();
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
        $data = ['list'         => $this->M_polis_saku->cari_sppa($id_sppa)->row_array(),
                 'ahli_waris'   => $this->M_polis_saku->cari_ahli_waris($id_sppa)->result_array()
                ];
        
        $this->load->view('V_detail', $data);
        
    }

    // 17-09-2021
    public function tambah_polis()
    {
        $data 	= [ 'title'     => 'Tambah Polis',
                    'list_lob'  => $this->M_polis_saku->get_data('m_lob')->result_array()
                  ];

        $this->template->load('template/index','V_tambah_polis', $data);
    }

    // 30-08-2021
    public function simpan_polis_saku()
    {
        $id_polis_saku    = $this->input->post('id_polis_saku');        
        $aksi               = $this->input->post('aksi');        
        $polis_saku       = $this->input->post('polis_saku');    
        $status             = $this->input->post('status');    

        if ($aksi == 'Tambah') {

            $inputan = ['LOWER(polis_saku)'  => strtolower($polis_saku),
                        'LOWER(status)'        => strtolower($status)
                        ];
            
            $cek = cek_duplicate_banyak('m_polis_saku', '', '', $inputan);

            if ($cek == 0) {

                $data = ['polis_saku'  => $polis_saku,
                         'status'        => $status,
                         'add_time'      => date("Y-m-d H:i:s", now('Asia/Jakarta')),
                         'add_by'        => $this->sesi_id
                        ];

                $this->M_polis_saku->input_data('m_polis_saku', $data); 

            } else {

                echo json_encode(['status' => 'gagal']);
                exit();

            }

        } elseif ($aksi == 'Hapus') {

            $this->M_polis_saku->hapus_data('m_polis_saku', ['id' => $id_polis_saku]);

        } elseif ($aksi == 'Ubah') {
            
            $inputan = ['LOWER(polis_saku)'  => strtolower($polis_saku),
                        'LOWER(status)'        => strtolower($status)
                        ];
            
            $cek = cek_duplicate_banyak('m_polis_saku', 'id', $id_polis_saku, $inputan);

            if ($cek == 0) {

                $data = ['polis_saku' => $polis_saku,
                         'status'       => $status,
                         'updated_time' => date("Y-m-d H:i:s", now('Asia/Jakarta')),
                         'updated_by'   => $this->sesi_id
                       ];

                $this->M_polis_saku->ubah_data('m_polis_saku', $data, ['id' => $id_polis_saku]);

            } else {

                echo json_encode(['status' => 'gagal']);
                exit();

            }
            
        }

        echo json_encode(['status' => 'sukses']);
    }

}

/* End of file Payment Tutor.php */
