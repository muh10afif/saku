<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Pengguna_tertanggung extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('M_pengguna_tertanggung', 'pengguna_ptg');

        $this->aksi_crud        = get_role($this->session->userdata('id_level_otorisasi'));
        $this->id_lvl_otorisasi = $this->session->userdata('id_level_otorisasi');
        $this->sesi_id          = $this->session->userdata('sesi_id');

        $this->load->helper('inputtype_helper');

        if($this->session->userdata('username') == "") {
            redirect(base_url(), 'refresh');
        }
    }

    public function index()
    {
        // tabel relasi induk kumpulan
        // list flag table tertanggung

        $list1 = $this->pengguna_ptg->get_data_order('m_sob', 'sob', 'asc')->result_array();

        $option_cdb = "<option value=''>Pilih</option>";

        foreach ($list1 as $l) {

            $list2 = $this->pengguna_ptg->get_ft_tertanggung($l['id_sob'])->num_rows();

            if ($list2 == 0) {
                $hid = "hidden"; 
            } else {
                $hid = "";
            }

            $option_cdb .= "<option value='".$l['id_sob']."' $hid>".$l['sob']."</option>";
            
        }
         
        $data = ['title'                => 'Pengguna Tertanggung',
                 'role'                 => $this->aksi_crud,
                 'id_lvl_otorisasi'     => $this->id_lvl_otorisasi,
                 'id_user'              => $this->session->userdata('sesi_id'),
                 'pekerjaan'            => $this->pengguna_ptg->get_data_order('m_pekerjaan', 'id_pekerjaan', 'asc')->result_array(),
                 'option_cdb_ttg'       => $option_cdb
                ];

        $this->template->load('template/index', 'lihat', $data);
    }

    // 03-11-2021
    public function tampil_data()
    {
        $read               = $this->input->post('read');
        $create             = $this->input->post('create');
        $update             = $this->input->post('update');
        $delete             = $this->input->post('delete');
        $id_user            = $this->input->post('id_user');
        $id_lvl_otorisasi   = $this->input->post('id_lvl_otorisasi');

        if ($read == 'true' || $id_lvl_otorisasi == 0) {
            $list = $this->pengguna_ptg->get_data_pengguna_ptg();
        } else {
            $list = [];
        }  

        $data = array();

        $no   = $this->input->post('start');

        foreach ($list as $o) {
            $no++;
            $tbody = array();

            $a0 = "";

            if ($id_lvl_otorisasi == 0) {
                $a0 = "<span style='cursor:pointer' class='mr-3 text-dark detail ttip' data-toggle='tooltip' data-placement='top' title='Detail' data-id='".$o['id_pengguna_ptg']."'><i class='fas fa-info-circle fa-lg'></i></span>";

                $a1 = "<span style='cursor:pointer' class='mr-3 text-primary edit ttip' data-toggle='tooltip' data-placement='top' title='Ubah' data-id='".$o['id_pengguna_ptg']."'><i class='fas fa-pencil-alt fa-lg'></i></span>";
                $a2 = "<span style='cursor:pointer' class='text-danger hapus ttip' data-toggle='tooltip' data-placement='top' title='Hapus' data-id='".$o['id_pengguna_ptg']."'><i class='far fa-trash-alt fa-lg'></i></span>";
            } else {
                if ($update == 'true') {

                    if ($delete == 'true') {
                        $mrd = "mr-3";
                    } else {
                        $mrd = "";
                    }
        
                    $a1 = "<span style='cursor:pointer' class='".$mrd." text-primary edit ttip' data-toggle='tooltip' data-placement='top' title='Ubah' data-id='".$o['id_pengguna_ptg']."'><i class='fas fa-pencil-alt fa-lg'></i></span>";
                } else {
                    $a1 = "";
                }
        
                if ($delete == 'true') {
                    $a2 = "<span style='cursor:pointer' class='text-danger hapus ttip' data-toggle='tooltip' data-placement='top' title='Hapus' data-id='".$o['id_pengguna_ptg']."'><i class='far fa-trash-alt fa-lg'></i></span>";
                } else {
                    $a2 = "";
                } 
            }

            if ($o['induk_kumpulan'] != '' || $o['ft_induk_kumpulan'] != '') {
                $ik = $this->penamaan($o['induk_kumpulan'], $o['ft_induk_kumpulan']);
            } else {
                $ik = "";
            }

            $tbody[]    = "<div align='center'>".$no.".</div>";
            $tbody[]    = $o['nik'];
            $tbody[]    = $o['nama'];
            $tbody[]    = $o['telp'];
            $tbody[]    = wordwrap($o['alamat'],28,"<br>\n");
            $tbody[]    = $ik;
            $tbody[]    = $a0.$a1.$a2;
            $data[]     = $tbody;
        }

        if ($read == 'true' || $id_lvl_otorisasi == 0) {
            $recordsTotal       = $this->pengguna_ptg->jumlah_semua_pengguna_ptg();
            $recordsFiltered    = $this->pengguna_ptg->jumlah_filter_pengguna_ptg();
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

    public function penamaan($idn, $flg)
    {
        $cari1 = $this->pengguna_ptg->cari_data('m_sob', ["id_sob" => $flg])->row_array();

        // $has = getdbtable($flg);
        $has = $cari1['nama_tabel'];
        $inid = 'id_'.substr($has,2,strlen($has));
        $this->db->where('table_name', $has);
        $data = $this->db->get('information_schema.columns')->result();
        $fnme = array();
        foreach ($data as $key => $value) {
        if ($value->column_name == 'nama_'.substr($has,2,strlen($has)) || $value->column_name == 'nama') {
            $dat['nmny'] = $value->column_name;
            $fnme[] = $dat;
        }
        }
        $this->db->select($fnme[0]['nmny'].' as nama');
        $this->db->where($inid, $idn);
        $dat = $this->db->get($has)->result_array();
        $hsl = $dat[0]['nama'];

        return $hsl;
    }

    // 04-11-2021
    public function get_list_tertanggung()
    {
        $ft_tertanggung = $this->input->post('ft_tertanggung');        
        // $id_tertanggung = $this->input->post('id_tertanggung');        

        $cari1 = $this->pengguna_ptg->cari_data('m_sob', ["id_sob" => $ft_tertanggung])->row_array();

        $inid = 'id_'.substr($cari1['nama_tabel'],2,strlen($cari1['nama_tabel']));
        $this->db->where('table_name', $cari1['nama_tabel']);
        $data = $this->db->get('information_schema.columns')->result();
        $fnme = array();
        foreach ($data as $key => $value) {
        if ($value->column_name == 'nama_'.substr($cari1['nama_tabel'],2,strlen($cari1['nama_tabel'])) || $value->column_name == 'nama') {
            $dat['nmny'] = $value->column_name;
            $fnme[] = $dat;
        }
        }
        $this->db->select($inid.' as id, '.$fnme[0]['nmny'].' as nama');
        $this->db->order_by($fnme[0]['nmny'], 'asc');
        $list = $this->db->get($cari1['nama_tabel'])->result_array();
        
        $sel = "";
        $option_ttg = "<option value=''>Pilih</option>";
        foreach ($list as $l) {

            $cari2 = $this->pengguna_ptg->cari_data('relasi_induk_kumpulan', ['tertanggung' => $l['id']]);
            $cari3 = $cari2->row_array();
            
            if ($cari2->num_rows() == 0) {
                $hid = "hidden"; 
            } else {
                $hid = "";
            }

            // if ($id_tertanggung != '') {
            //     if ($id_tertanggung == $l['id']) {
            //         $sel = "selected";
            //     } else {
            //         $sel = "";
            //     }
            // }

            $option_ttg .= "<option value='".$l['id']."' $hid $sel>".$l['nama']."</option>";

        }

        echo json_encode(['option_ttg' => $option_ttg]);

    }

    // 04-11-2021
    public function get_list_client_ik()
    {
        $ft_tertanggung = $this->input->post('ft_tertanggung');        
        $tertanggung    = $this->input->post('tertanggung');        
        // $id_jenis_client_ik = $this->input->post('id_jenis_client_ik');       
        
        $list1 = $this->pengguna_ptg->get_data_order('m_sob', 'sob', 'asc')->result_array();

        $option_cdb_ik = "<option value=''>Pilih</option>";

        $sel = "";
        $hid = "";
        foreach ($list1 as $l) {

            $list2 = $this->pengguna_ptg->get_ft_induk_kumpulan($l['id_sob'], $ft_tertanggung, $tertanggung);
            $list3 = $list2->row_array();

            if ($list2->num_rows() == 0) {
                $hid = "hidden"; 
            } else {
                $hid = "";
            }

            // if ($id_jenis_client_ik != '') {
            //     if ($id_jenis_client_ik == $l['id_sob']) {
            //         $sel = "selected";
            //     } else {
            //         $sel = "";
            //     }
            // }

            $option_cdb_ik .= "<option value='".$l['id_sob']."' $hid $sel>".$l['sob']."</option>";
            
        }

        echo json_encode(['option_cdb_ik' => $option_cdb_ik]);
    }

    // 04-11-2021
    public function get_list_tertanggung_ik()
    {
        // $id_tertanggung_ik  = $this->input->post('id_tertanggung');        
        
        $ft_tertanggung     = $this->input->post('ft_tertanggung');        
        $tertanggung        = $this->input->post('tertanggung');         
        $ft_induk_kumpulan  = $this->input->post('ft_induk_kumpulan');        

        $cari1 = $this->pengguna_ptg->cari_data('m_sob', ["id_sob" => $ft_induk_kumpulan])->row_array();

        $inid = 'id_'.substr($cari1['nama_tabel'],2,strlen($cari1['nama_tabel']));
        $this->db->where('table_name', $cari1['nama_tabel']);
        $data = $this->db->get('information_schema.columns')->result();
        $fnme = array();
        foreach ($data as $key => $value) {
        if ($value->column_name == 'nama_'.substr($cari1['nama_tabel'],2,strlen($cari1['nama_tabel'])) || $value->column_name == 'nama') {
            $dat['nmny'] = $value->column_name;
            $fnme[] = $dat;
        }
        }
        $this->db->select($inid.' as id, '.$fnme[0]['nmny'].' as nama');
        $this->db->order_by($fnme[0]['nmny'], 'asc');
        $list = $this->db->get($cari1['nama_tabel'])->result_array();
        
        $sel = "";
        $option_ttg_ik = "<option value=''>Pilih</option>";
        foreach ($list as $l) {

            $cari2 = $this->pengguna_ptg->get_induk_kumpulan($l['id'], $ft_induk_kumpulan, $ft_tertanggung, $tertanggung);
            $list2 = $cari2->row_array();
            
            if ($cari2->num_rows() == 0) {
                $hid = "hidden"; 
            } else {
                $hid = "";
            }

            // if ($id_tertanggung_ik != '') {
            //     if ($id_tertanggung_ik == $list2['induk_kumpulan']) {
            //         $sel = "selected";
            //     } else {
            //         $sel = "";
            //     }
            // }

            $option_ttg_ik .= "<option value='".$l['id']."' induk_kumpulan='".$list2['id']."' $hid $sel>".$l['nama']."</option>";

        }

        echo json_encode(['option_ttg_ik' => $option_ttg_ik]);

    }

    // 03-11-2021
    public function simpan_data()
    {
        $id_pengguna_tertanggung    = $this->input->post('id_pengguna_tertanggung');        
        $aksi                       = $this->input->post('aksi');        

        $nik                        = $this->input->post('nik');        
        $nama                       = $this->input->post('nama');        
        $tempat_lahir               = $this->input->post('tempat_lahir');        
        $tgl_lahir                  = $this->input->post('tgl_lahir');        
        $jenis_kelamin              = $this->input->post('jenis_kelamin');        
        $telp                       = $this->input->post('telp');        
        $alamat                     = $this->input->post('alamat');        
        $pekerjaan                  = $this->input->post('pekerjaan');  
        $email                      = $this->input->post('email');  

        $id_induk_kumpulan          = $this->input->post('id_induk_kumpulan');  
        

        if ($aksi == 'tambah') {

            $cek = cek_duplicate('pengguna_tertanggung', 'nik', '', '', $nik);

            if ($cek == 0) {

                $data = [   'nik'              => $nik,
                            'nama'             => $nama,
                            'tempat_lahir'     => $tempat_lahir,
                            'tgl_lahir'        => date("Y-m-d", strtotime($tgl_lahir)),
                            'jenis_kelamin'    => ($jenis_kelamin == '1') ? 't' : 'f',
                            'telp'             => $telp,
                            'alamat'           => $alamat,
                            'id_pekerjaan'     => $pekerjaan,
                            'email'            => $email,
                            'id_induk_kumpulan'=> $id_induk_kumpulan,
                            'status'           => true,
                            'add_time'         => date('Y-m-d H:i:s', now('Asia/Jakarta')),
                            'add_by'           => $this->session->userdata('sesi_id')
                        ];

                $this->pengguna_ptg->input_data('pengguna_tertanggung', $data);

            } else {

                echo json_encode(['status' => 'gagal']);
                exit();

            }
        
        } elseif ($aksi == 'ubah') {

            $cek = cek_duplicate('pengguna_tertanggung', 'nik', 'id_pengguna_tertanggung', $id_pengguna_tertanggung, $nik);

            if ($cek == 0) {

                $data = [   'nik'              => $nik,
                            'nama'             => $nama,
                            'tempat_lahir'     => $tempat_lahir,
                            'tgl_lahir'        => date("Y-m-d", strtotime($tgl_lahir)),
                            'jenis_kelamin'    => ($jenis_kelamin == '1') ? 't' : 'f',
                            'telp'             => $telp,
                            'alamat'           => $alamat,
                            'id_pekerjaan'     => $pekerjaan,
                            'email'            => $email,
                            'id_induk_kumpulan'=> $id_induk_kumpulan,
                            'status'           => true,
                            'updated_time'     => date('Y-m-d H:i:s', now('Asia/Jakarta')),
                            'updated_by'       => $this->session->userdata('sesi_id')
                        ];

                $this->pengguna_ptg->ubah_data('pengguna_tertanggung', $data, ['id_pengguna_tertanggung' => $id_pengguna_tertanggung]);

            } else {

                echo json_encode(['status' => 'gagal']);
                exit();

            }
            
        } elseif ($aksi == 'hapus') {

            $this->pengguna_ptg->hapus_data('pengguna_tertanggung', ['id_pengguna_tertanggung' => $id_pengguna_tertanggung]);
            
        }

        echo json_encode(['status' => true]);
        
    }

    // 04-11-2021
    public function get_data_pengguna_ptg()
    {
        $id_pengguna_ptg = $this->input->post('id_pengguna_ptg');
        
        $list = $this->pengguna_ptg->cari_data_pengguna($id_pengguna_ptg)->row_array();

        if ($list['tgl_lahir'] == '') {
            $tgl_lahir = "";
        } else {
            $tgl_lahir = date("d-m-Y", strtotime($list['tgl_lahir']));
        }

        $induk_kumpulan = $this->penamaan($list['induk_kumpulan'], $list['ft_induk_kumpulan']);
        $tertanggung    = $this->penamaan($list['tertanggung'], $list['ft_tertanggung']);

        $cari1 = $this->pengguna_ptg->cari_data('m_sob', ["id_sob" =>  $list['ft_tertanggung']])->row_array();
        $cari2 = $this->pengguna_ptg->cari_data('m_sob', ["id_sob" =>  $list['ft_induk_kumpulan']])->row_array();

        $ft_tertanggung     = substr($cari1['nama_tabel'],2,strlen($cari1['nama_tabel']));
        $ft_induk_kumpulan  = substr($cari2['nama_tabel'],2,strlen($cari2['nama_tabel']));

        echo json_encode(['list' => $list, 'tgl_lahir' => $tgl_lahir, 'ft_tertanggung' => $ft_tertanggung, 'tertanggung' => $tertanggung, 'ft_induk_kumpulan' => $ft_induk_kumpulan, 'induk_kumpulan' => $induk_kumpulan ]);
    }

}

/* End of file Pengguna_tertanggung.php */
