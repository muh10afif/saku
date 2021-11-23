<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Parent_parameter extends CI_controller
{

    public function __construct() {
        parent::__construct();
        $this->load->model('M_parent', 'parent');

        $this->aksi_crud        = get_role($this->session->userdata('id_level_otorisasi'));
        $this->id_lvl_otorisasi = $this->session->userdata('id_level_otorisasi');

        if($this->session->userdata('username') == "") {
        redirect(base_url(), 'refresh');
        }
    }

    // 07-06-2021
    public function index()
    {
        $data 	= [ 'title'             => 'Parent Parameter',
                    'role'              => $this->aksi_crud,
                    'id_lvl_otorisasi'  => $this->id_lvl_otorisasi,
                    'id_user'           => $this->session->userdata('sesi_id')
                ];

        $this->template->load('template/index','lihat', $data);
    }

    // 07-06-2021
    public function get_sisa_bobot()
    {
        echo json_encode(['sisa_bobot' => $this->sisa_bobot()]);
    }

    public function sisa_bobot()
    {
        $cari = $this->parent->total_bobot()->row_array();

        if ($cari['total'] == '') {
            $tt = 100;
        } else {
            $tt = 100 - $cari['total'];
        }

        return $tt;
    }

    // 07-06-2021
    public function tampil_data_parent_parameter()
    {
        $read               = $this->input->post('read');
        $create             = $this->input->post('create');
        $update             = $this->input->post('update');
        $delete             = $this->input->post('delete');
        $id_user            = $this->input->post('id_user');
        $id_lvl_otorisasi   = $this->input->post('id_lvl_otorisasi');

        if ($read == 'true' || $id_lvl_otorisasi == 0) {
            $list = $this->parent->get_data_parent_parameter();
        } else {
            $list = [];
        } 

        $data = array();

        $no   = $this->input->post('start');

        foreach ($list as $o) {
            $no++;
            $tbody = array();

            if ($id_lvl_otorisasi == 0) {
                $a1 = "<span style='cursor:pointer' class='mr-3 text-primary ttip edit-parent_parameter' data-toggle='tooltip' data-placement='top' title='Ubah' data-id='".$o['id_parent_parameter']."' nama='".$o['parent_parameter']."' bobot='".$o['bobot']."'><i class='fas fa-pencil-alt fa-lg'></i></span>";
                $a2 = "<span style='cursor:pointer' class='text-danger ttip hapus-parent_parameter' data-toggle='tooltip' data-placement='top' title='Hapus' data-id='".$o['id_parent_parameter']."' nama='".$o['parent_parameter']."'><i class='far fa-trash-alt fa-lg'></i></span>";
            } else {
                if ($update == 'true') {
      
                    if ($delete == 'true') {
                        $mrd = "mr-3";
                    } else {
                        $mrd = "";
                    }
      
                    $a1 = "<span style='cursor:pointer' class='$mrd text-primary ttip edit-parent_parameter' data-toggle='tooltip' data-placement='top' title='Ubah' data-id='".$o['id_parent_parameter']."' nama='".$o['parent_parameter']."' bobot='".$o['bobot']."'><i class='fas fa-pencil-alt fa-lg'></i></span>";

                } else {
                    $a1 = "";
                }
      
                if ($delete == 'true') {
                    $a2 = "<span style='cursor:pointer' class='text-danger ttip hapus-parent_parameter' data-toggle='tooltip' data-placement='top' title='Hapus' data-id='".$o['id_parent_parameter']."' nama='".$o['parent_parameter']."'><i class='far fa-trash-alt fa-lg'></i></span>";
                } else {
                    $a2 = "";
                } 
            }

            $tbody[]    = "<div align='center'>".$no.".</div>";
            $tbody[]    = $o['parent_parameter'];
            $tbody[]    = $o['bobot']."%";
            $tbody[]    = $a1.$a2;
            $data[]     = $tbody;
        }

        if ($read == 'true' || $id_lvl_otorisasi == 0) {
            $recordsTotal       = $this->parent->jumlah_semua_parent_parameter();
            $recordsFiltered    = $this->parent->jumlah_filter_parent_parameter();
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

    // 05-05-2021
    public function simpan_data_parent_parameter()
    {
        $aksi                   = $this->input->post('aksi');
        $id_parent_parameter    = $this->input->post('id_parent_parameter');
        $parent_parameter       = $this->input->post('parent_parameter');
        $bobot                  = $this->input->post('bobot');

        $data = [   'parent_parameter'  => $parent_parameter,
                    'bobot'             => $bobot,
                    'add_time'          => date("Y-m-d H:i:s", now('Asia/Jakarta')),
                    'add_by'            => $this->session->userdata('sesi_id')
                ];

        if ($aksi == 'Tambah') {
            $inputan = ['LOWER(parent_parameter)'  => strtolower($parent_parameter)
                        ];
                
            $cek = cek_duplicate_banyak('m_parent_parameter', '', '', $inputan);

            if ($cek == 0) {
                $this->parent->input_data('m_parent_parameter', $data);
                echo json_encode(['status' => "Berhasil", 'pesan' => 'Berhasil menyimpan data', 'altr' => 'success']);
            } else {
                echo json_encode(['status' => 'Gagal', 'pesan' => 'Parent Parameter tersebut Sudah Ada!', 'altr' =>'warning']);
            }
            
        } elseif ($aksi == 'Ubah') {

            $inputan = ['LOWER(parent_parameter)'  => strtolower($parent_parameter)
                        ];
                
            $cek = cek_duplicate_banyak('m_parent_parameter', 'id_parent_parameter', $id_parent_parameter, $inputan);

            if ($cek == 0) {
                $this->parent->ubah_data('m_parent_parameter', $data, array('id_parent_parameter' => $id_parent_parameter));
                echo json_encode(['status' => "Berhasil", 'pesan' => 'Berhasil mengubah data', 'altr' => 'success']);
            } else {
                echo json_encode(['status' => 'Gagal', 'pesan' => 'Parent Parameter tersebut Sudah Ada!', 'altr' =>'warning']);
            }

        } elseif ($aksi == 'Hapus') {
            $this->parent->hapus_data('m_parent_parameter', array('id_parent_parameter' => $id_parent_parameter));

            echo json_encode(['status' => "Berhasil", 'pesan' => 'Berhasil mengubah data', 'altr' => 'success']);
        }

    }

    // 08-06-2021
    public function cari_data($id_parent_parameter)
    {
        echo json_encode(['sisa_bobot' => $this->sisa_bobot_2($id_parent_parameter)]);
    }

    public function sisa_bobot_2($id_parent_parameter)
    {
        $cari = $this->parent->total_bobot()->row_array();

        $cari2 = $this->parent->cari_data('m_parent_parameter', ['id_parent_parameter' => $id_parent_parameter])->row_array();

        if ($cari['total'] == '') {
            $tt = 100;
        } else {
            
            $a = 100 - $cari['total'];

            if ($a == 0) {
                $tt = $cari2['bobot'];
            } else {
                $tt = (100 - $cari['total']) + $cari2['bobot'];
            }

        }

        return $tt;
    }
}

?>
