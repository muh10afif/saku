<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Penilaian extends CI_controller
{

    public function __construct() {
        parent::__construct();
        $this->load->model('M_penilaian');
        if($this->session->userdata('username') == "") {
        redirect(base_url(), 'refresh');
        }

        $this->aksi_crud        = get_role($this->session->userdata('id_level_otorisasi'));
        $this->id_lvl_otorisasi = $this->session->userdata('id_level_otorisasi');
        $this->sesi_id          = $this->session->userdata('sesi_id');
    }

    // 07-06-2021
    public function index()
    {
        $this->hitung_score_asuransi();

        // Array ( [update] => true [create] => true [delete] => true [view] => false [approve] => true [read] => true )

        // $aksi_crud = $this->aksi_crud;

        // echo $aksi_crud['read'];

        // exit();

        $data 	= [ 'title'             => 'Penilaian',
                    'parent_param'      => $this->M_penilaian->get_data_order('m_parent_parameter', 'parent_parameter', 'asc')->result_array(),
                    'role'              => $this->aksi_crud,
                    'id_lvl_otorisasi'  => $this->id_lvl_otorisasi,
                    'id_user'           => $this->sesi_id
                ];

        $this->template->load('template/index','lihat', $data);
    }

    public function tes()
    {
        $id_param       = $this->M_penilaian->get_param_scoring();
        $id_param_as    = $this->M_penilaian->get_scoring_asuransi(11);

        print_r($id_param);
        echo "<br>";
        print_r($id_param_as);
        echo "<br>";

        // mencari value berbeda
        $result=array_values(array_diff($id_param,$id_param_as));
        print_r($result);

    }

    // 23-07-2021
    public function hitung_score_asuransi()
    {
        $nama       = $this->M_penilaian->get_asuransi()->result_array();
        $id_param   = $this->M_penilaian->get_param_scoring();

        foreach ($nama as $n) {

            
            $cari   = $this->M_penilaian->get_scoring_asuransi($n['id_asuransi']);

            $result = array_values(array_diff($id_param,$cari));

            // echo $n['nama_asuransi']."<br>";

            foreach ($result as $c) {

                // echo $c."<br>";

                $data = ['id_asuransi'          => $n['id_asuransi'],
                         'id_parameter_scoring' => $c,
                         'input'                => 0,
                         'hasil'                => 0,
                         'add_time'             => date("Y-m-d H:i:s", now('Asia/Jakarta')),
                         'add_by'               => $this->session->userdata('sesi_id')
                        ];

                $this->M_penilaian->input_data('scoring_asuransi', $data);
                
            }

            $cari1  = $this->M_penilaian->data_scoring_asuransi($n['id_asuransi'])->result_array();

            $total = 0;
            foreach ($cari1 as $c1) {

                $tot = $this->hitung_ulang_hasil($c1['id_asuransi'], $c1['id_parameter_scoring'], $c1['input']);

                $total = $total + $tot;
            }

            $this->M_penilaian->ubah_data('m_asuransi', ['score' => round($total, 2)], ['id_asuransi' => $n['id_asuransi']]);
            
        }

        // echo "<pre>";
        // print_r($nama);
        // echo "</pre>";
    }

    // 21-07-2021
    public function hitung_ulang_hasil($id_asuransi, $id_param_scor, $value)
    {
        $cari = $this->M_penilaian->cari_data('m_parameter_scoring', ['id_parameter_scoring' => $id_param_scor])->row_array();

        $nilai_parameter    = $cari['nilai_parameter']; 
        $bobot              = $cari['bobot'];
        $type               = $cari['type'];

        if ($value == '') {
            $value = 0;
        } else {
            $value = $value;
        }

        $tot = 0;

        if ($type == 'max') {

            $tot = ($value / $nilai_parameter) * $bobot;
            
            if ($value > $nilai_parameter) {
                $tot = $bobot;
            } else {
                $tot = ($value / $nilai_parameter) * $bobot;
            }
        } else {

            $tot = ($nilai_parameter / $value) * $bobot;

            if ($value < $nilai_parameter) { 
                $tot = $bobot;
            } else {
                $tot = ($nilai_parameter / $value) * $bobot;
            }

        }

        $this->M_penilaian->ubah_data('scoring_asuransi', ['hasil' => $tot], ['id_asuransi' => $id_asuransi, 'id_parameter_scoring' => $id_param_scor]);

        return $tot;

    }

    public function tampil_data_penilaian()
    {
        // $aksi_crud = get_role($this->session->userdata('id_level_otorisasi'));

        // if ($aksi_crud['read'] == 'true') {
        //     $list = $this->M_penilaian->get_data_asuransi();
        // } else {
        //     $list = [];
        // }  

        $read               = $this->input->post('read');
        $create             = $this->input->post('create');
        $update             = $this->input->post('update');
        $delete             = $this->input->post('delete');
        $id_user            = $this->input->post('id_user');
        $id_lvl_otorisasi   = $this->input->post('id_lvl_otorisasi');

        if ($read == 'true' || $id_lvl_otorisasi == 0) {
            $list = $this->M_penilaian->get_data_asuransi();
        } else {
            $list = [];
        }  

        $data = array();

        $no   = $this->input->post('start');

        foreach ($list as $o) {
            $no++;
            $tbody = array();

            $tbody[]    = "<div align='center'>".$no.".</div>";
            $tbody[]    = $o['nama_asuransi'];
            $tbody[]    = $o['telp'];
            $tbody[]    = $o['pic'];
            $tbody[]    = "<span class='font-weight-bold' style='font-size: 16px;'>".number_format($o['score'],2,'.','.')."</span>";
            $tbody[]    = "<button class='btn btn-primary nilai' data-id='".$o['id_asuransi']."' nama='".$o['nama_asuransi']."'><i class='fas fa-pencil-alt mr-2'></i></span>Nilai</button>";
            $data[]     = $tbody;
        }

        $output = [ "draw"             => $_POST['draw'],
                    "recordsTotal"     => $this->M_penilaian->jumlah_semua_asuransi(),
                    "recordsFiltered"  => $this->M_penilaian->jumlah_filter_asuransi(),   
                    "data"             => $data
                ];

        echo json_encode($output);
    }

    public function simpan_data_penilaian()
    {
        $id_asuransi    = $this->input->post('id_asuransi');
        $total          = $this->input->post('total');
        $nilai_input    = $this->input->post('nilai_input');
        $id_param_scor  = $this->input->post('id_param_scor');
        $hasil          = $this->input->post('hasil');

        $this->db->trans_begin();
        
            $jml = count($nilai_input);

            $this->db->delete('scoring_asuransi', ['id_asuransi' => $id_asuransi]);

            for ($i=0; $i < $jml; $i++) { 

                $data[] = [ 'id_asuransi'           => $id_asuransi,
                            'id_parameter_scoring'  => $id_param_scor[$i],
                            'input'                 => ($nilai_input[$i] == '') ? null : $nilai_input[$i],
                            'hasil'                 => $hasil[$i],
                            'add_time'              => date("Y-m-d H:i:s", now('Asia/Jakarta')),
                            'add_by'                => $this->session->userdata('sesi_id')
                        ];
                
            }

            $this->db->insert_batch('scoring_asuransi', $data);
            
            // update scoring in table asuransi
            $this->db->update('m_asuransi', ['score' => ($total == '') ? null : $total], ['id_asuransi' => $id_asuransi]);

        if($this->db->trans_status() === FALSE){
            $this->db->trans_rollback();
    
            echo json_encode(['status' => false]);
        }else{
            $this->db->trans_commit();
    
            echo json_encode(['status' => true]);
        }
    }

    // 08-06-2021
    public function get_edit_nilai()
    {
        $id_asuransi = $this->input->post('id_asuransi');

        // $cari   = $this->M_penilaian->cari_data('scoring_asuransi', ['id_asuransi' => $id_asuransi])->result_array();
        $cari   = $this->M_penilaian->cari_data_scoring($id_asuransi)->result_array();
        $cari2  = $this->M_penilaian->cari_data('m_asuransi', ['id_asuransi' => $id_asuransi])->row_array();

        echo json_encode(['list' => $cari, 'score' => $cari2['score']]);
    }

    // 08-06-2021
    public function get_halaman_grafik()
    {
        $data = ['list_asuransi'    => $this->M_penilaian->get_score_grafik()->result_array()];

        $this->load->view('grafik', $data);
        
    }

}

?>
