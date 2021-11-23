<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Parameter_scoring extends CI_controller
{

    public function __construct() {
        parent::__construct();
        $this->load->model('M_param_scoring', 'param');

        $this->aksi_crud        = get_role($this->session->userdata('id_level_otorisasi'));
        $this->id_lvl_otorisasi = $this->session->userdata('id_level_otorisasi');

        if($this->session->userdata('username') == "") {
        redirect(base_url(), 'refresh');
        }
    }

    // 07-06-2021
    public function index()
    {
        $data 	= [ 'title'             => 'Parameter Scoring',
                    'parent_param'      => $this->param->get_data('m_parent_parameter')->result_array(),
                    'role'              => $this->aksi_crud,
                    'id_lvl_otorisasi'  => $this->id_lvl_otorisasi,
                    'id_user'           => $this->session->userdata('sesi_id')
                ];

        $this->template->load('template/index','lihat', $data);
    }

    public function tampil_data_parameter_scoring()
    {
        $read               = $this->input->post('read');
        $create             = $this->input->post('create');
        $update             = $this->input->post('update');
        $delete             = $this->input->post('delete');
        $id_user            = $this->input->post('id_user');
        $id_lvl_otorisasi   = $this->input->post('id_lvl_otorisasi');

        if ($read == 'true' || $id_lvl_otorisasi == 0) {
            $list = $this->param->get_data_parameter_scoring();
        } else {
            $list = [];
        } 

        $data = array();

        $no   = $this->input->post('start');

        foreach ($list as $o) {
            $no++;
            $tbody = array();

            $a0 = "<span style='cursor:pointer' class='mr-3 text-dark detail ttip' data-toggle='tooltip' data-placement='top' title='Detail' data-id='".$o['id_parameter_scoring']."'><i class='fas fa-info-circle fa-lg'></i></span>";

            if ($this->id_lvl_otorisasi == 0) {
                $a1 = "<span style='cursor:pointer' class='mr-3 text-primary edit-parameter_scoring ttip' data-toggle='tooltip' data-placement='top' title='Ubah' data-id='".$o['id_parameter_scoring']."' nama='".$o['nama_parameter']."'><i class='fas fa-pencil-alt fa-lg'></i></span>";
                $a2 = "<span style='cursor:pointer' class='text-danger hapus-parameter_scoring ttip' data-toggle='tooltip' data-placement='top' title='Hapus' data-id='".$o['id_parameter_scoring']."' id_parent='".$o['id_parent_parameter']."' nama='".$o['nama_parameter']."'><i class='far fa-trash-alt fa-lg'></i></span>";
            } else {
                if ($update == 'true') {
      
                    if ($delete == 'true') {
                        $mrd = "mr-3";
                    } else {
                        $mrd = "";
                    }
      
                    $a1 = "<span style='cursor:pointer' class='$mrd text-primary edit-parameter_scoring ttip' data-toggle='tooltip' data-placement='top' title='Ubah' data-id='".$o['id_parameter_scoring']."' nama='".$o['nama_parameter']."'><i class='fas fa-pencil-alt fa-lg'></i></span>";

                } else {
                    $a1 = "";
                }
      
                if ($delete == 'true') {
                    $a2 = "<span style='cursor:pointer' class='text-danger hapus-parameter_scoring ttip' data-toggle='tooltip' data-placement='top' title='Hapus' data-id='".$o['id_parameter_scoring']."' id_parent='".$o['id_parent_parameter']."' nama='".$o['nama_parameter']."'><i class='far fa-trash-alt fa-lg'></i></span>";
                } else {
                    $a2 = "";
                } 
            }

            $tbody[]    = "<div align='center'>".$no.".</div>";
            $tbody[]    = $o['nama_parameter'];
            $tbody[]    = $o['type'];
            $tbody[]    = $o['bobot']."%";
            $tbody[]    = number_format($o['nilai_parameter'],0,'.','.');
            $tbody[]    = $a0.$a1.$a2;
            $data[]     = $tbody;
        }

        if ($read == 'true' || $id_lvl_otorisasi == 0) {
            $recordsTotal       = $this->param->jumlah_semua_parameter_scoring();
            $recordsFiltered    = $this->param->jumlah_filter_parameter_scoring();
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

    // 14-07-2021
    public function detail_ps()
    {
        $id_param = $this->input->post('id_parameter_scoring');
        
        $cari = $this->param->cari_data('m_parameter_scoring', ['id_parameter_scoring' => $id_param])->row_array();

        echo json_encode($cari);
    }

    public function simpan_data_parameter_scoring()
    {
        $aksi                      = $this->input->post('aksi');
        $id_parameter_scoring      = $this->input->post('id_parameter_scoring');
        $id_parent_parameter       = $this->input->post('id_parent_parameter');
        $parameter_scoring         = $this->input->post('parameter_scoring');
        $type                      = $this->input->post('type');
        $bobot                     = $this->input->post('bobot');
        $keterangan                = $this->input->post('keterangan');
        $nilai_parameter           = $this->input->post('nilai_parameter');

        $data = [   'nama_parameter'        => $parameter_scoring,
                    'bobot'                 => $bobot,
                    'keterangan'            => $keterangan,
                    'type'                  => $type,
                    'id_parent_parameter'   => $id_parent_parameter,
                    'nilai_parameter'       => $nilai_parameter,
                    'add_time'              => date("Y-m-d H:i:s", now('Asia/Jakarta')),
                    'add_by'                => $this->session->userdata('sesi_id')
                ];

        if ($aksi == 'Tambah') {
            $this->param->input_data('m_parameter_scoring', $data);
        } elseif ($aksi == 'Ubah') {
            $this->param->ubah_data('m_parameter_scoring', $data, array('id_parameter_scoring' => $id_parameter_scoring));
        } elseif ($aksi == 'Hapus') {
            $this->param->hapus_data('m_parameter_scoring', array('id_parameter_scoring' => $id_parameter_scoring));
        }

        echo json_encode($aksi);
    }

    // 08-06-2021
    public function cari_data($id_parameter_scoring)
    {
        $cari = $this->param->cari_data('m_parameter_scoring', ['id_parameter_scoring' => $id_parameter_scoring])->row_array();

        echo json_encode(['sisa' => $this->sisa_bobot_2($cari['id_parent_parameter'], $cari['bobot']), 'list' => $cari]);
    }

    // 08-06-2021
    public function get_sisa_bobot($id_parent, $bobot_parent)
    {
        echo json_encode(['sisa_bobot' => $this->sisa_bobot($id_parent, $bobot_parent)]);
    }

    public function sisa_bobot($id_parent, $bobot_parent)
    {
        $cari = $this->param->total_bobot($id_parent)->row_array();

        if ($cari['total'] == '') {
            $tt = $bobot_parent;
        } else {
            $tt = $bobot_parent - $cari['total'];
        }

        return $tt;
    }

    public function sisa_bobot_2($id_parent, $bobot_parent)
    {
        $cari = $this->param->total_bobot($id_parent)->row_array();

        $cari2 = $this->param->cari_data('m_parent_parameter', ['id_parent_parameter' => $id_parent])->row_array();

        if ($cari['total'] == '') {
            $tt = $bobot_parent;
        } else {
            $a = $cari2['bobot'] - $cari['total'];

            if ($a == 0) {
                $tt = $bobot_parent;
            } else {
                $tt = ($cari2['bobot'] - $cari['total']) + $bobot_parent;
            }
            
        }

        return $tt;
    }
}

?>
