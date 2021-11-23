<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Mop extends CI_controller
{

    public function __construct() {
        parent::__construct();
        $this->load->model('M_mop', 'mop');

        $this->aksi_crud        = get_role($this->session->userdata('id_level_otorisasi'));
        $this->id_lvl_otorisasi = $this->session->userdata('id_level_otorisasi');
        $this->sesi_id          = $this->session->userdata('sesi_id');
        
        $this->kode             = codegenerate('mop', 'MOP', 'mop', 'P');

        if($this->session->userdata('username') == "") {
            redirect(base_url(), 'refresh');
        }
    }

    public function index()
    {
        $data 	= [ 'title'             => 'Entry MOP',
                    'no_mop'            => $this->kode(),
                    'insured'           => $this->mop->get_data_order('m_nasabah', 'nama_nasabah', 'asc')->result_array(),
                    'insurer'           => $this->mop->get_data_insurer($this->sesi_id)->result_array(),
                    'cob'               => $this->mop->get_data_order('m_cob', 'cob', 'asc')->result_array(),
                    'sob'               => $this->mop->get_data_order('m_sob', 'sob', 'asc')->result_array(),
                    'negara'            => $this->mop->get_data_order('m_negara', 'negara', 'asc')->result_array(),
                    'lob'               => $this->mop->get_data_order('m_lob', 'lob', 'asc')->result_array(),
                    'role'              => $this->aksi_crud,
                    'id_lvl_otorisasi'  => $this->id_lvl_otorisasi,
                    'no_reff'           => $this->kode(),
                    'id_user'           => $this->session->userdata('sesi_id')
                ];

        $this->template->load('template/index','lihat', $data);
    }

    // 30-08-2021
    public function tampil_list_lob()
    {
        $id_insurer = $this->input->post('id_insurer');
        $lob        = $this->mop->get_data_order('m_lob', 'lob', 'asc')->result_array();
        
        $html       = "";
        $list_lob   = "";

        if ($id_insurer != '') {

            $cari = $this->mop->cari_data('tr_produk_asuransi', ['id_asuransi' => $id_insurer])->result_array();


            foreach ($lob as $d) {

                foreach ($cari as $r) {
                    if ($r['id_lob'] == $d['id_lob']) {
                        $sel = "selected";
                    } else {
                        $sel = "";
                    }
                }

                $list_lob .= "<option value=".$d['id_lob']." $sel>".$d['lob']."</option>";
               
            }

            $i = 1;
            foreach ($cari as $c) {
                
                $html .= 
                '<tr id="list_add_prod_as'.$i.'">
                        <td class="label_prod_as text-center" id="label_prod_as_'.$i.'" data-id="'.$i.'">'.$i.'.</td>
                        <td width="50%">
                            <select name="lob_'.$i.'" id="lob_'.$i.'" data-id="'.$i.'" class="form-control select2 list_lob">
                                <option value="">Pilih LOB</option>
                                '.$list_lob.'
                            </select>
                        </td>
                        <td>
                            <input type="text" class="form-control text-right numeric number_separator list_premi" name="premi_'.$i.'" id="premi_'.$i.'" data-id="'.$i.'" value="'.number_format($c['premi'],0,'.','.').'" placeholder="0">
                        </td>
                        <td align="center">
                            <span style="cursor:pointer;" class="remove text-danger" data-id="'.$i.'"><i class="mdi mdi-trash-can-outline mdi-24px"></i></span>
                        </td>
                    </tr>';
                
                $i++;
            }

        
        } else {

            $jml    = 0;

        }

        echo json_encode(['list_data' => $html, 'jumlah' => $jml]);
    }

    // 27-05-2021
    public function option_detail_sob()
    {
        $id_sob     = $this->input->post('id_sob');
        $d_sob_sel  = $this->input->post('d_sob_sel');

        if ($id_sob != '') {
            // cari
            $cari = $this->mop->cari_data('m_sob', ['id_sob' => $id_sob])->row_array();
            $nama_sob = "SOB ".$cari['sob'];
        } else {
            $nama_sob = "Detail SOB";
        }
        
        switch ($id_sob) {
        case 2:
            $this->db->select('id_asuransi as id, nama_asuransi as nama');
            $this->db->order_by('nama', 'asc');
            $d_data = $this->db->get('m_asuransi')->result_array();
            break;
        case 3:
            $this->db->select('id_nasabah as id, nama_nasabah as nama');
            $this->db->order_by('nama', 'asc');
            $d_data = $this->db->get('m_nasabah')->result_array();
            break;
        case 4:
            $this->db->select('id_agent as id, nama');
            $this->db->order_by('nama', 'asc');
            $d_data = $this->db->get('m_agent')->result_array();
            break;
        case 5:
            $this->db->select('id_business_partner as id, nama');
            $this->db->order_by('nama', 'asc');
            $d_data = $this->db->get('m_business_partner')->result_array();
            break;
        case 6:
            $this->db->select('id_direct as id, nama');
            $this->db->order_by('nama', 'asc');
            $d_data = $this->db->get('m_direct')->result_array();
            break;
        case 7:
            $this->db->select('id_loss_adjuster as id, nama');
            $this->db->order_by('nama', 'asc');
            $d_data = $this->db->get('m_loss_adjuster')->result_array();
            break;
        
        }

        $option = "<option value=''>Pilih</option>";
        foreach ($d_data as $d) {

            if ($d_sob_sel == $d['id']) {
                $sel = 'selected';
            } else {
                $sel = '';
            }

            $option .= "<option value='".$d['id']."' $sel>".$d['nama']."</option>";
            
        }

        echo json_encode(['option' => $option, 'nama_sob' => $nama_sob]);

    }

    // 27-05-2021
    public function ambil_detail_sob()
    {
        $wh_sob = $this->input->post('id_d_sob');
        $id_sob = $this->input->post('id_sob');

        switch ($id_sob) {
            case 2:
                $this->db->select('nama_asuransi as nama, alamat, telp');
                $this->db->where('id_asuransi', $wh_sob);
                $data_sob = $this->db->get('m_asuransi')->row_array();
                break;
            case 3:
                $this->db->select('nama_nasabah as nama, alamat_rumah as alamat, telp');
                $this->db->where('id_nasabah', $wh_sob);
                $data_sob = $this->db->get('m_nasabah')->row_array();
                break;
            case 4:
                $this->db->select('nama, alamat, telp');
                $this->db->where('id_agent', $wh_sob);
                $data_sob = $this->db->get('m_agent')->row_array();
                break;
            case 6:
                $this->db->select('nama, alamat, telp');
                $this->db->where('id_direct', $wh_sob);
                $data_sob = $this->db->get('m_direct')->row_array();
                break;
            case 5:
                $this->db->select('nama, alamat, telp');
                $this->db->where('id_business_partner', $wh_sob);
                $data_sob = $this->db->get('m_business_partner')->row_array();
                break;
            case 7:
                $this->db->select('nama, alamat, telp');
                $this->db->where('id_loss_adjuster', $wh_sob);
                $data_sob = $this->db->get('m_loss_adjuster')->row_array();
                break;
            }
        
        echo json_encode(['sob' => $data_sob]);
    }

    public function kode()
    {
        $this->db->order_by('id_mop', 'desc');
        $cari = $this->db->get('mop')->row_array();
        if (!empty($cari)) {
        $a = strpos($cari['no_reff_mop'], 'P');
        $b = strlen($cari['no_reff_mop']);
        $c = substr($cari['no_reff_mop'], $a + 2, $b);
        $w = (int) $c + 1;
        $kd = str_pad($w, 6, "0", STR_PAD_LEFT);
        } else {
        $kd = str_pad(1, 6, "0", STR_PAD_LEFT);
        }
        return "MOP".$kd;
    }

    // menampilkan list mop 
    public function tampil_data_mop()
    {
        $read               = $this->input->post('read');
        $create             = $this->input->post('create');
        $update             = $this->input->post('update');
        $delete             = $this->input->post('delete');
        $id_user            = $this->input->post('id_user');
        $id_lvl_otorisasi   = $this->input->post('id_lvl_otorisasi');

        if ($read == 'true' || $id_lvl_otorisasi == 0) {
            $list = $this->mop->get_data_mop();
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
                $a0 = "<span style='cursor:pointer' class='mr-3 text-dark detail ttip' data-toggle='tooltip' data-placement='top' title='Detail' data-id='".$o['id_mop']."'><i class='fas fa-info-circle fa-lg'></i></span>";

                $a1 = "<span style='cursor:pointer' class='mr-3 text-primary edit-mop ttip' data-toggle='tooltip' data-placement='top' title='Ubah' data-id='".$o['id_mop']."'><i class='fas fa-pencil-alt fa-lg'></i></span>";
                $a2 = "<span style='cursor:pointer' class='text-danger hapus-mop ttip' data-toggle='tooltip' data-placement='top' title='Hapus' data-id='".$o['id_mop']."'><i class='far fa-trash-alt fa-lg'></i></span>";
            } else {
                if ($update == 'true') {

                    if ($delete == 'true') {
                        $mrd = "mr-3";
                    } else {
                        $mrd = "";
                    }
        
                    $a1 = "<span style='cursor:pointer' class='".$mrd." text-primary edit-mop ttip' data-toggle='tooltip' data-placement='top' title='Ubah' data-id='".$o['id_mop']."'><i class='fas fa-pencil-alt fa-lg'></i></span>";
                } else {
                    $a1 = "";
                }
        
                if ($delete == 'true') {
                    $a2 = "<span style='cursor:pointer' class='text-danger hapus-mop ttip' data-toggle='tooltip' data-placement='top' title='Hapus' data-id='".$o['id_mop']."'><i class='far fa-trash-alt fa-lg'></i></span>";
                } else {
                    $a2 = "";
                } 
            }

            $tbody[]    = "<div align='center'>".$no.".</div>";
            $tbody[]    = $o['no_reff_mop'];
            $tbody[]    = $o['no_mop'];
            $tbody[]    = $o['nama_mop'];
            $tbody[]    = wordwrap($o['nama_asuransi'],25,"<br>\n");
            $tbody[]    = $a0.$a1.$a2;
            $data[]     = $tbody;
        }

        if ($read == 'true' || $id_lvl_otorisasi == 0) {
            $recordsTotal       = $this->mop->jumlah_semua_mop();
            $recordsFiltered    = $this->mop->jumlah_filter_mop();
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
    public function detail_mop($id_mop)
    {
        // $id_mop = $this->input->post('id_mop');

        $cari_data  = $this->mop->get_detail_mop($id_mop)->row_array();
        $cari_dok   = $this->mop->cari_data('dokumen_mop', ['id_mop' => $id_mop])->result_array();

        switch ($cari_data['id_sob']) {
            case 2:
                $this->db->select('nama_asuransi as nama, alamat, telp');
                $this->db->where('id_asuransi', $cari_data['id_detail_sob']);
                $data_sob = $this->db->get('m_asuransi')->row_array();

                $nama_sob = 'Insurer';
  
                break;
            case 3:
                $this->db->select('nama_nasabah as nama, alamat_rumah as alamat, telp');
                $this->db->where('id_nasabah', $cari_data['id_detail_sob']);
                $data_sob = $this->db->get('m_nasabah')->row_array();
                
                $nama_sob = 'Insured';

                break;
            case 4:
                $this->db->select('nama, alamat, telp');
                $this->db->where('id_agent', $cari_data['id_detail_sob']);
                $data_sob = $this->db->get('m_agent')->row_array();
  
                $nama_sob = 'Agent';

                break;
            case 6:
                $this->db->select('nama, alamat, telp');
                $this->db->where('id_direct', $cari_data['id_detail_sob']);
                $data_sob = $this->db->get('m_direct')->row_array();
  
                $nama_sob = 'Direct';

                break;
            case 5:
                $this->db->select('nama, alamat, telp');
                $this->db->where('id_business_partner', $cari_data['id_detail_sob']);
                $data_sob = $this->db->get('m_business_partner')->row_array();
  
                $nama_sob = 'Business Partner';

                break;
            case 7:
                $this->db->select('nama, alamat, telp');
                $this->db->where('id_loss_adjuster', $cari_data['id_detail_sob']);
                $data_sob = $this->db->get('m_loss_adjuster')->row_array();
                
                $nama_sob = 'Loss Adjuster';

                break;
            }

        $data = ['title'        => 'Detail MOP',
                 'mop'          => $cari_data,
                 'list_dok'     => $cari_dok,
                 'id_mop'       => $id_mop,
                 'nama_sob'     => $nama_sob,
                 'detail_sob'   => $data_sob['nama'],
                 'lob'          => $this->mop->get_data_order('m_lob', 'lob', 'asc')->result_array()
                ];

        // $this->load->view('detail_mop', $data);

        $this->template->load('template/index', 'detail_mop', $data);
        
    }

    // 31-08-2021
    public function tampil_produk_asuransi()
    {
        $id_mop = $this->input->post('id_mop');
        $aksi   = $this->input->post('aksi');

        if ($id_mop) {

            $list = $this->mop->get_data_produk_asuransi($id_mop)->result_array();

            $data = array();

            $no   = $this->input->post('start');

            foreach ($list as $o) {
                $no++;
                $tbody = array();
                
                $tbody[]    = "<div align='center'>".$no.".</div>";
                $tbody[]    = $o['lob'];
                $tbody[]    = "<div align='right'>".number_format($o['premi'],0,'.','.')."</div>";

                if ($aksi == '') {
                   $tbody[]    = "<button type='button' class='btn btn-outline-primary waves-effect waves-light btn-sm manfaat mr-2 btn_detail' tipe='manfaat' data-id='".$o['id_tr_produk_asuransi']."' lob='".$o['lob']."' premi='".number_format($o['premi'],0,'.','.')."'>Manfaat</button><button type='button' class='btn btn-outline-primary waves-effect waves-light btn-sm syarat mr-2 btn_detail' tipe='syarat' data-id='".$o['id_tr_produk_asuransi']."' lob='".$o['lob']."' premi='".number_format($o['premi'],0,'.','.')."'>Syarat</button><button type='button' class='btn btn-outline-primary waves-effect waves-light btn-sm pengecualian btn_detail' tipe='pengecualian' data-id='".$o['id_tr_produk_asuransi']."' lob='".$o['lob']."' premi='".number_format($o['premi'],0,'.','.')."'>Pengecualian</button>"; 
                }
                
                $tbody[]    = "
                <span style='cursor:pointer' class='mr-2 text-primary edit ttip' data-toggle='tooltip' data-placement='top' title='Ubah' data-id='".$o['id_tr_produk_asuransi']."' id_asuransi='".$o['id_asuransi']."' id_lob='".$o['id_lob']."' premi='".number_format($o['premi'],0,'.','.')."' asuransi='".$o['nama_asuransi']."'><i class='fas fa-pencil-alt fa-lg'></i></span>
                <span style='cursor:pointer' class='text-danger hapus ttip' data-toggle='tooltip' data-placement='top' title='Hapus' data-id='".$o['id_tr_produk_asuransi']."'><i class='far fa-trash-alt fa-lg'></i></span>";
                $data[]     = $tbody;
            }

            echo json_encode(['data' => $data]);
        } else {
            echo json_encode(['data' => []]);
        }
        
    }

    // 01-09-2021
    public function simpan_prod_as()
    {
        $aksi               = $this->input->post('aksi');   
        $id_produk_asuransi = $this->input->post('id_produk_asuransi');
        $id_mop             = $this->input->post('id_mop');
        $id_lob             = $this->input->post('id_lob');
        $id_asuransi        = $this->input->post('id_asuransi');
        $premi              = $this->input->post('premi');

        $this->db->trans_begin();

        $sing = $this->mop->cari_data('m_asuransi', ['id_asuransi' => $id_asuransi])->row_array();      

        if ($aksi == 'Tambah') {

            $inputan = ['id_asuransi'   => $id_asuransi,
                        'id_lob'        => $id_lob,
                        'premi'         => $premi,
                        'id_mop'        => $id_mop
                        ];
            
            $cek = cek_duplicate_banyak('tr_produk_asuransi', '', '', $inputan);

            if ($cek == 0) {

                $data = ['id_asuransi'  => $id_asuransi,
                         'id_lob'       => $id_lob,
                         'premi'        => $premi,
                         'id_mop'       => $id_mop,
                         'aktif_premi'  => 1,
                         'add_time'     => date("Y-m-d H:i:s", now('Asia/Jakarta')),
                         'add_by'       => $this->sesi_id
                        ];

                $this->mop->input_data('tr_produk_asuransi', $data); 
                $id_tr = $this->db->insert_id();

                $kode = $sing['singkatan'].$id_lob.$id_tr;

                $this->mop->ubah_data('tr_produk_asuransi', ['kode_produk_asuransi' => $kode], ['id_tr_produk_asuransi' => $id_tr]);
                

            } else {

                echo json_encode(['status' => 'gagal']);
                exit();

            }

        } elseif ($aksi == 'Hapus') {

            $this->mop->hapus_data('tr_produk_asuransi', ['id_tr_produk_asuransi' => $id_produk_asuransi]);
            $this->mop->hapus_data('m_manfaat', ['id_produk_asuransi' => $id_produk_asuransi]);
            $this->mop->hapus_data('m_syarat', ['id_produk_asuransi' => $id_produk_asuransi]);
            $this->mop->hapus_data('m_pengecualian', ['id_produk_asuransi' => $id_produk_asuransi]);

        } elseif ($aksi == 'Ubah') {

            $inputan = ['id_asuransi'   => $id_asuransi,
                        'id_lob'        => $id_lob,
                        'premi'         => $premi,
                        'id_mop'        => $id_mop
                        ];
            
            $cek = cek_duplicate_banyak('tr_produk_asuransi', 'id_tr_produk_asuransi', $id_produk_asuransi, $inputan);

            if ($cek == 0) {
                
                $data = ['id_lob'           => $id_lob,
                         'premi'            => $premi,
                         'updated_time'     => date("Y-m-d H:i:s", now('Asia/Jakarta')),
                         'updated_by'       => $this->sesi_id
                        ];

                $this->mop->ubah_data('tr_produk_asuransi', $data, ['id_tr_produk_asuransi' => $id_produk_asuransi]);

            } else {

                echo json_encode(['status' => 'gagal']);
                exit();

            }
            
        }

        if($this->db->trans_status() === FALSE){
            $this->db->trans_rollback();
    
            echo json_encode(['status' => 'gagal_simpan']);
        }else{
            $this->db->trans_commit();
    
            echo json_encode(['status' => true]);
        }

    }

    // 31-08-2021
    public function tampil_manfaat()
    {
        $id_produk_asuransi = $this->input->post('id_produk_asuransi');

        if ($id_produk_asuransi) {

            $list = $this->mop->cari_data_order('m_manfaat', ['id_produk_asuransi' => $id_produk_asuransi], 'id', 'desc')->result_array();

            $data = array();

            $no   = $this->input->post('start');

            foreach ($list as $o) {
                $no++;
                $tbody = array();
                
                $tbody[]    = "<div align='center'>".$no.".</div>";
                $tbody[]    = $o['manfaat'];
                $tbody[]    = "<div align='right'>".number_format($o['nilai'],0,'.','.')."</div>";
                $tbody[]    = wordwrap($o['keterangan'],90,"<br>\n");
                $tbody[]    = "
                <span style='cursor:pointer' class='mr-2 text-primary edit ttip' data-toggle='tooltip' data-placement='top' title='Ubah' data-id='".$o['id']."' manfaat='".$o['manfaat']."' nilai='".number_format($o['nilai'],0,'.','.')."' keterangan='".$o['keterangan']."'><i class='fas fa-pencil-alt fa-lg'></i></span>
                <span style='cursor:pointer' class='text-danger hapus ttip' data-toggle='tooltip' data-placement='top' title='Hapus' data-id='".$o['id']."'><i class='far fa-trash-alt fa-lg'></i></span>";
                $data[]     = $tbody;
            }

            echo json_encode(['data' => $data]);
        } else {
            echo json_encode(['data' => []]);
        }
        
    }

    public function coba()
    {
        $id_manfaat = 12;
        $tipe       = "manfaat";
        $id_tabel   = "id_$tipe";

        echo $$id_tabel;

    }

    public function simpan_data_detail()
    {
        $aksi               = $this->input->post('aksi');        
        $tipe               = $this->input->post('tipe');   
        $id_hapus           = $this->input->post('id_hapus');  
        $id_produk_asuransi = $this->input->post('id_produk_asuransi');  

        $id_manfaat         = $this->input->post('id_manfaat');  
        $manfaat            = $this->input->post('manfaat');   
        $nilai              = $this->input->post('nilai');   
        $keterangan         = $this->input->post('keterangan');   
        
        $id_syarat          = $this->input->post('id_syarat');        
        $syarat             = $this->input->post('syarat');     

        $id_pengecualian    = $this->input->post('id_pengecualian');        
        $pengecualian       = $this->input->post('pengecualian');    
        
        $id_tabel           = "id_$tipe";

        if ($aksi == 'Tambah') {

            if ($tipe == 'manfaat') {

                $inputan = ['LOWER(manfaat)'    => strtolower($manfaat),
                            'nilai'             => $nilai,
                            'LOWER(keterangan)' => strtolower($keterangan)
                            ];
                
                $cek = cek_duplicate_banyak('m_manfaat', '', '', $inputan);

                if ($cek == 0) {

                    $data = ['id_produk_asuransi'   => $id_produk_asuransi,
                             'manfaat'              => $manfaat,
                             'nilai'                => $nilai,
                             'keterangan'           => $keterangan,
                             'add_time'             => date("Y-m-d H:i:s", now('Asia/Jakarta')),
                             'add_by'               => $this->sesi_id
                            ];

                    $this->mop->input_data('m_manfaat', $data); 

                } else {

                    echo json_encode(['status' => 'gagal']);
                    exit();

                }
                
            } else {

                $inputan = ["LOWER($tipe)"  => strtolower($$tipe)
                            ];
                
                $cek = cek_duplicate_banyak("m_$tipe", '', '', $inputan);

                if ($cek == 0) {

                    $data = ['id_produk_asuransi'   => $id_produk_asuransi,
                             "$tipe"                => $$tipe,
                             'add_time'             => date("Y-m-d H:i:s", now('Asia/Jakarta')),
                             'add_by'               => $this->sesi_id
                            ];

                    $this->mop->input_data("m_$tipe", $data); 

                } else {

                    echo json_encode(['status' => 'gagal']);
                    exit();

                }
                
            }

        } elseif ($aksi == 'Hapus') {

            $this->mop->hapus_data("m_$tipe", ['id' => $id_hapus]);

        } elseif ($aksi == 'Ubah') {

            if ($tipe == 'manfaat') {

                $inputan = ['LOWER(manfaat)'    => strtolower($manfaat),
                            'nilai'             => $nilai,
                            'LOWER(keterangan)' => strtolower($keterangan)
                            ];
                
                $cek = cek_duplicate_banyak("m_$tipe", $tipe, $$id_tabel, $inputan);

                if ($cek == 0) {

                    $data = ['id_produk_asuransi'   => $id_produk_asuransi,
                             'manfaat'              => $manfaat,
                             'nilai'                => $nilai,
                             'keterangan'           => $keterangan,
                             'updated_time'         => date("Y-m-d H:i:s", now('Asia/Jakarta')),
                             'updated_by'           => $this->sesi_id
                            ];

                    $this->mop->ubah_data("m_$tipe", $data, ['id' => $$id_tabel]); 

                } else {

                    echo json_encode(['status' => 'gagal']);
                    exit();

                }
                
            } else {

                $inputan = ["LOWER($tipe)"     => strtolower($$tipe)
                            ];
                
                $cek = cek_duplicate_banyak("m_$tipe", 'id', $$id_tabel, $inputan);

                if ($cek == 0) {

                    $data = ['id_produk_asuransi'   => $id_produk_asuransi,
                             "$tipe"                => $$tipe,
                             'updated_time'         => date("Y-m-d H:i:s", now('Asia/Jakarta')),
                             'updated_by'           => $this->sesi_id
                            ];

                    $this->mop->ubah_data("m_$tipe", $data, ['id' => $$id_tabel]); 

                } else {

                    echo json_encode(['status' => 'gagal']);
                    exit();

                }
                
            }
            
        }

        echo json_encode(['status' => 'sukses', 'tipe' => $tipe]);
    }

    public function tampil_syarat()
    {
        $id_produk_asuransi = $this->input->post('id_produk_asuransi');

        if ($id_produk_asuransi) {

            $list = $this->mop->cari_data_order('m_syarat', ['id_produk_asuransi' => $id_produk_asuransi], 'id', 'desc')->result_array();

            $data = array();

            $no   = $this->input->post('start');

            foreach ($list as $o) {
                $no++;
                $tbody = array();
                
                $tbody[]    = "<div align='center'>".$no.".</div>";
                $tbody[]    = wordwrap($o['syarat'],90,"<br>\n");
                $tbody[]    = "
                <span style='cursor:pointer' class='mr-2 text-primary edit ttip' data-toggle='tooltip' data-placement='top' title='Ubah' data-id='".$o['id']."' syarat='".$o['syarat']."'><i class='fas fa-pencil-alt fa-lg'></i></span>
                <span style='cursor:pointer' class='text-danger hapus ttip' data-toggle='tooltip' data-placement='top' title='Hapus' data-id='".$o['id']."'><i class='far fa-trash-alt fa-lg'></i></span>";
                $data[]     = $tbody;
            }

            echo json_encode(['data' => $data]);
        } else {
            echo json_encode(['data' => []]);
        }
        
    }

    public function tampil_pengecualian()
    {
        $id_produk_asuransi = $this->input->post('id_produk_asuransi');

        if ($id_produk_asuransi) {

            $list = $this->mop->cari_data_order('m_pengecualian', ['id_produk_asuransi' => $id_produk_asuransi], 'id', 'desc')->result_array();

            $data = array();

            $no   = $this->input->post('start');

            foreach ($list as $o) {
                $no++;
                $tbody = array();
                
                $tbody[]    = "<div align='center'>".$no.".</div>";
                $tbody[]    = wordwrap($o['pengecualian'],90,"<br>\n");
                $tbody[]    = "
                <span style='cursor:pointer' class='mr-2 text-primary edit ttip' data-toggle='tooltip' data-placement='top' title='Ubah' data-id='".$o['id']."' pengecualian='".$o['pengecualian']."'><i class='fas fa-pencil-alt fa-lg'></i></span>
                <span style='cursor:pointer' class='text-danger hapus ttip' data-toggle='tooltip' data-placement='top' title='Hapus' data-id='".$o['id']."'><i class='far fa-trash-alt fa-lg'></i></span>";
                $data[]     = $tbody;
            }

            echo json_encode(['data' => $data]);
        } else {
            echo json_encode(['data' => []]);
        }
        
    }

    // 18-05-2021
    public function option_lob()
    {
        $id_cob     = $this->input->post('id_cob');
        $id_lob_sel = $this->input->post('id_lob_sel');

        $cari = $this->mop->cari_lob($id_cob)->result_array();

        $option = "<option value=''>Pilih LOB</option>";
        foreach ($cari as $c) {

            if ($id_lob_sel == $c['id_lob']) {
                $sel = "selected";
            } else {
                $sel = "";
            }

            $option .= "<option value='".$c['id_lob']."' id_relasi='".$c['id_relasi_cob_lob']."' $sel>".$c['lob']."</option>";
        }

        echo json_encode(['option' => $option]);
    }

    // 22-06-2021
    public function option_provinsi()
    {
        $id_negara   = $this->input->post('id_negara');
        // $id_provinsi = $this->input->post('id_provinsi');

        if ($id_negara == '') {
            $option = "<option value=''>Pilih Provinsi</option>";

            echo json_encode(['option' => $option, 'jumlah' => 0]);
            exit();
        }
        
        $cari = $this->mop->cari_data_order('m_provinsi', ['id_negara' => $id_negara], 'provinsi', 'asc')->result_array();

        $option = "<option value=''>Pilih Provinsi</option>";
        foreach ($cari as $c) {

            // if ($id_provinsi == $c['id_provinsi']) {
            //     $sel = "selected";
            // } else {
            //     $sel = "";
            // }

            $sel = "";

            $option .= "<option value='".$c['id_provinsi']."' $sel>".$c['provinsi']."</option>";
        }

        echo json_encode(['option' => $option]);
    }

    // 22-06-2021
    public function option_kota()
    {
        // $id_kota        = $this->input->post('id_kota');
        $id_provinsi    = $this->input->post('id_provinsi');

        if ($id_provinsi == '') {
            $option = "<option value=''>Pilih Kota / Kabupaten</option>";

            echo json_encode(['option' => $option, 'jumlah' => 0]);
            exit();
        }
        
        $cari = $this->mop->cari_data_order('m_kota', ['id_provinsi' => $id_provinsi], 'kota', 'asc')->result_array();

        $option = "<option value=''>Pilih Kota / Kabupaten</option>";
        foreach ($cari as $c) {

            // if ($id_kota == $c['id_kota']) {
            //     $sel = "selected";
            // } else {
            //     $sel = "";
            // }

            $sel = "";

            $option .= "<option value='".$c['id_kota']."' $sel>".$c['kota']."</option>";
        }

        echo json_encode(['option' => $option]);
    }

    // 22-06-2021
    public function option_kecamatan()
    {
        $id_kota        = $this->input->post('id_kota');
        // $id_kecamatan   = $this->input->post('id_kecamatan');

        if ($id_kota == '') {
            $option = "<option value=''>Pilih Kecamatan</option>";

            echo json_encode(['option' => $option, 'jumlah' => 0]);
            exit();
        }
        
        $cari = $this->mop->cari_data_order('m_kecamatan', ['id_kota' => $id_kota], 'kecamatan', 'asc')->result_array();

        $option = "<option value=''>Pilih Kecamatan</option>";
        foreach ($cari as $c) {

            // if ($id_kecamatan == $c['id_kecamatan']) {
            //     $sel = "selected";
            // } else {
            //     $sel = "";
            // }

            $sel = "";

            $option .= "<option value='".$c['id_kecamatan']."' $sel>".$c['kecamatan']."</option>";
        }

        echo json_encode(['option' => $option]);
    }

    // 22-06-2021
    public function option_desa()
    {
        // $id_desa        = $this->input->post('id_desa');
        $id_kecamatan   = $this->input->post('id_kecamatan');

        if ($id_kecamatan == '') {
            $option = "<option value=''>Pilih Desa / Kelurahan</option>";

            echo json_encode(['option' => $option, 'jumlah' => 0]);
            exit();
        }
        
        $cari = $this->mop->cari_data_order('m_desa', ['id_kecamatan' => $id_kecamatan], 'desa', 'asc')->result_array();

        $option = "<option value=''>Pilih Desa / Kelurahan</option>";
        foreach ($cari as $c) {

            // if ($id_desa == $c['id_desa']) {
            //     $sel = "selected";
            // } else {
            //     $sel = "";
            // }

            $sel = "";

            $option .= "<option value='".$c['id_desa']."' $sel>".$c['desa']."</option>";
        }

        echo json_encode(['option' => $option]);
    }

    private function moveElement(&$array, $a, $b) {
        $p1 = array_splice($array, $a, 1);
        $p2 = array_splice($array, 0, $b);
        $array = array_merge($p2,$p1,$array);
  
        return $array;
    }

    // 18-05-2021
    public function list_coverage()
    {
        $id_lob = $this->input->post('id_lob');

        $cari = $this->mop->cari_data_order('coverage', ['id_lob' => $id_lob], 'label', 'asc')->result_array();

        $ky = "";
        foreach ($cari as $key => $value) {
            if ($value['status'] == 'standar') {
            $ky = $key;
            }
        }

        $ls_premi = $this->moveElement($cari, $ky, 0);

        echo json_encode($ls_premi);
    }

    // 28-05-2021
    public function list_coverage_mop()
    {
        $id_mop = $this->input->post('id_mop');
        
        $cari = $this->mop->cari_data_order('coverage_mop', ['id_mop' => $id_mop], 'status', 'desc')->result_array();

        echo json_encode($cari);
    }

    public function tes()
    {
        $i_dok_mop = ["49","50",""];

        $a = $this->hapus_value_array($i_dok_mop, "");

        $this->db->where('id_mop', 39);
        $this->db->where_not_in('id_dokumen_mop', $a);
        $this->db->delete('dokumen_mop');

    }

    function hapus_value_array($array,$value)
    {
        foreach($array as $key=>$val)
        {
            if($val == $value)
            {
                unset($array[$key]);
            }
        }
        return $array;
    }

    // 28-04-2021
    // aksi proses simpan data mop
    public function simpan_data_mop()
    {
        
      $config['upload_path']    = './uploads/dokumen/';
      $config['allowed_types']  = 'jpg|png|pdf|xls|xlsx|doc|docx';
      $config['max_size']       = 15000;
      // load library upload
      $this->load->library('upload', $config);

        $jumlah                 = $this->input->post('jumlah');

        $aksi                   = $this->input->post('aksi');
        $id_mop                 = $this->input->post('id_mop');
        $no_reff_mop            = $this->input->post('no_reff_mop');             
        $no_mop                 = $this->input->post('no_mop');                      
        $nama_mop               = $this->input->post('nama_mop');                      
        $no_polis_induk         = $this->input->post('no_polis_induk');                      
        $id_insured             = $this->input->post('id_insured');                    
        $id_insurer             = $this->input->post('id_insurer');                    
        $id_cob                 = $this->input->post('id_cob');                    
        $id_lob                 = $this->input->post('id_lob');                    
        $id_sob                 = $this->input->post('id_sob');                    
        $id_d_sob               = $this->input->post('id_d_sob');                    
        $nilai_pertanggungan    = str_replace(",","",$this->input->post('nilai_pertanggungan')); 
        $objek_tertanggung      = $this->input->post('objek_tertanggung');
        $kondisi_pertanggungan  = $this->input->post('kondisi_pertanggungan');
        $pengecualian           = $this->input->post('pengecualian');
        $keterangan_premi       = $this->input->post('keterangan_premi');
        $resiko_sendiri         = $this->input->post('resiko_sendiri');
        $limit_minimal          = $this->input->post('limit_minimal');
        $berlaku_paling_lambat  = $this->input->post('berlaku_paling_lambat');
        $batas_wilayah          = $this->input->post('batas_wilayah');
        $penyampaian_deklarasi  = $this->input->post('penyampaian_deklarasi');
        $maksimal_pelaporan     = $this->input->post('maksimal_pelaporan');
        $label_mop              = json_decode($this->input->post('label_mop'), true);
        $rate_mop               = json_decode($this->input->post('rate_mop'), true);
        $status_mop             = json_decode($this->input->post('status_mop'), true);
        
        $list_lob               = json_decode($this->input->post('list_lob'), true);
        $list_premi             = json_decode($this->input->post('list_premi'), true);
        
        $tgl_awal_polis         = $this->input->post('tgl_awal_polis');
        $tgl_akhir_polis        = $this->input->post('tgl_akhir_polis');

        $id_negara              = $this->input->post('id_negara');
        $id_provinsi            = $this->input->post('id_provinsi');
        $id_kota                = $this->input->post('id_kota');
        $id_kecamatan           = $this->input->post('id_kecamatan');
        $id_desa                = $this->input->post('id_desa');

        $this->db->trans_begin();

        $data = [   'no_reff_mop'               => $no_reff_mop,
                    'no_mop'                    => $no_mop,
                    'nama_mop'                  => $nama_mop,
                    // 'no_polis_induk'            => $no_polis_induk,
                    // 'no_mop'                    => $no_mop,
                    'id_insured'                => ($id_insured == '') ? null : $id_insured,
                    'id_insurer'                => ($id_insurer == '') ? null : $id_insurer,
                    // 'id_cob'                    => ($id_cob == '') ? null : $id_cob,
                    // 'id_lob'                    => ($id_lob == '') ? null : $id_lob,
                    'id_sob'                    => ($id_sob == '') ? null : $id_sob,
                    'id_detail_sob'             => ($id_d_sob == '') ? null : $id_d_sob,
                    // 'nilai_pertanggungan'       => ($nilai_pertanggungan == '') ? null : $nilai_pertanggungan,
                    'objek_tertanggung'         => $objek_tertanggung,
                    'kondisi_pertanggungan'     => $kondisi_pertanggungan,
                    // 'pengecualian'              => $pengecualian,
                    'keterangan_premi'          => $keterangan_premi,
                    'resiko_sendiri'            => $resiko_sendiri,
                    'limit_minimal'             => ($limit_minimal == '') ? null : $limit_minimal,
                    'berlaku_paling_lambat'     => $berlaku_paling_lambat,
                    'batas_wilayah'             => $batas_wilayah,
                    'penyampaian_deklarasi'     => $penyampaian_deklarasi,
                    'maksimal_pelaporan'        => $maksimal_pelaporan,
                    'tgl_awal_polis'            => date("Y-m-d", strtotime($tgl_awal_polis)),
                    'tgl_akhir_polis'           => date("Y-m-d", strtotime($tgl_akhir_polis)),
                    'id_negara'                 => ($id_negara == 'null' || $id_negara == '') ? null : $id_negara, 
                    'id_provinsi'               => ($id_provinsi == 'null' || $id_provinsi == '') ? null : $id_provinsi,
                    'id_kota'                   => ($id_kota == 'null' || $id_kota == '') ? null : $id_kota,
                    'id_kecamatan'              => ($id_kecamatan == 'null' || $id_kecamatan == '') ? null : $id_kecamatan,
                    'id_desa'                   => ($id_desa == 'null' || $id_desa == '') ? null : $id_desa,
                    'add_time'                  => date("Y-m-d H:i:s", now('Asia/Jakarta')),
                    'add_by'                    => $this->session->userdata('sesi_id')
                ];

        if ($aksi == 'Tambah') {

            if (cek_duplicate('mop', 'no_mop', '', '', $no_mop != 0)) {

               echo json_encode(['status' => 'gagal']);
               exit();

            }

            $this->mop->input_data('mop', $data);
            $id_mop = $this->db->insert_id();

            // tr produk asuransi
            if (count($list_lob) != 0) {
                $data = [];
                for ($i=0; $i < count($list_lob); $i++) { 
                    
                    $data2[] = ['id_asuransi'   => $id_insurer,
                                'id_lob'        => $list_lob[$i],
                                'premi'         => $list_premi[$i],
                                'aktif_premi'   => 1,
                                'id_mop'        => $id_mop,
                                'add_time'      => date("Y-m-d H:i:s", now('Asia/Jakarta')),
                                'add_by'        => $this->session->userdata('sesi_id')
                                ];
                    
                }

                $this->db->insert_batch('tr_produk_asuransi', $data2);
            }

            // if (count($label_mop) != 0) {
            //     $data = [];
            //     for ($i=0; $i < count($label_mop); $i++) { 
                    
            //         $data2[] = ['label'    => $label_mop[$i],
            //                     'rate'     => $rate_mop[$i],
            //                     'status'   => $status_mop[$i],
            //                     'id_lob'   => $id_lob,
            //                     'id_mop'   => $id_mop,
            //                     'add_time'  => date("Y-m-d H:i:s", now('Asia/Jakarta')),
            //                     'add_by'    => $this->session->userdata('sesi_id')
            //                     ];
                    
            //     }

            //     $this->db->insert_batch('coverage_mop', $data2);
            // }

            // upload dokumen
            if ($jumlah != 0 || $jumlah == '') {
                for ($i=0; $i < $jumlah; $i++) { 
                    $nama = $_FILES['dokumen_'.$i]['name'];
                    $size = $_FILES['dokumen_'.$i]['size'];
                    $tmp  = $_FILES['dokumen_'.$i]['tmp_name'];

                    $desc = $this->input->post('desc_'.$i);

                    $path = "./upload/dokumen/" . $nama;

                    move_uploaded_file($tmp, $path);

                    $data_dok[] = [ 'filename'      => $nama,
                                    'size'          => $this->formatSizeUnits($size),
                                    'description'   => $desc,
                                    'id_mop'        => $id_mop,
                                    'add_time'      => date("Y-m-d H:i:s", now('Asia/Jakarta')),
                                    'add_by'        => $this->session->userdata('sesi_id'),
                                    'updated_time'  => date("Y-m-d H:i:s", now('Asia/Jakarta')),
                                    'updated_by'    => $this->session->userdata('sesi_id')
                                  ];
                    
                    
                }

                $this->db->insert_batch('dokumen_mop', $data_dok);
            }

        } elseif ($aksi == 'Ubah') {

            if (cek_duplicate('mop', 'no_mop', 'id_mop', $id_mop, $no_mop != 0)) {

                echo json_encode(['status' => 'gagal']);
                exit();
                
             }

            $this->mop->ubah_data('mop', $data, array('id_mop' => $id_mop));

            // $this->db->delete('tr_produk_asuransi', ['id_mop' => $id_mop]);

            // tr produk asuransi
            // if (count($list_lob) != 0) {
            //     $data = [];
            //     for ($i=0; $i < count($list_lob); $i++) { 
                    
            //         $data2[] = ['id_asuransi'   => $id_insurer,
            //                     'id_lob'        => $list_lob[$i],
            //                     'premi'         => $list_premi[$i],
            //                     'aktif_premi'   => 1,
            //                     'id_mop'        => $id_mop,
            //                     'add_time'      => date("Y-m-d H:i:s", now('Asia/Jakarta')),
            //                     'add_by'        => $this->session->userdata('sesi_id')
            //                     ];
                    
            //     }

            //     $this->db->insert_batch('tr_produk_asuransi', $data2);
            // }

            // $this->db->delete('coverage_mop', ['id_mop' => $id_mop]);

            // if (count($label_mop) != 0) {

            //     $data = [];
            //     for ($i=0; $i < count($label_mop); $i++) { 
                    
            //         $data2[] = ['label'         => $label_mop[$i],
            //                     'rate'          => $rate_mop[$i],
            //                     'status'        => $status_mop[$i],
            //                     'id_lob'        => $id_lob,
            //                     'id_mop'        => $id_mop,
            //                     'add_time'      => date("Y-m-d H:i:s", now('Asia/Jakarta')),
            //                     'add_by'        => $this->session->userdata('sesi_id')
            //                     ];
                    
            //     }

            //     $this->db->insert_batch('coverage_mop', $data2);

            // }

            if ($jumlah == 0) {
                $this->db->delete('dokumen_mop', ['id_mop' => $id_mop]);
            }

            // upload dokumen
            if ($jumlah != 0 || $jumlah == '') {

                // $this->db->delete('dokumen_mop', ['id_mop' => $id_mop]);

                $i_dok_mop = json_decode($this->input->post('i_dok_mop'), true);

                $a = $this->hapus_value_array($i_dok_mop, "");

                if (!empty($a)) {
                    $this->db->where('id_mop', $id_mop);
                    $this->db->where_not_in('id_dokumen_mop', $a);
                    $this->db->delete('dokumen_mop');
                }
                
                for ($i=0; $i < $jumlah; $i++) { 

                    $nama = $_FILES['dokumen_'.$i]['name'];
                    $size = $_FILES['dokumen_'.$i]['size'];
                    $tmp  = $_FILES['dokumen_'.$i]['tmp_name'];

                    $desc       = $this->input->post('desc_'.$i);
                    $file_edit  = $this->input->post('file_edit_'.$i);
                    $desc_edit  = $this->input->post('desc_edit_'.$i);

                    if ($_FILES['dokumen_'.$i]) { 

                        $path = "./upload/dokumen/" . $nama;

                        move_uploaded_file($tmp, $path);

                        if ($file_edit == 'baru') {

                            $data_dok   = [ 'filename'      => $nama,
                                            'size'          => $this->formatSizeUnits($size),
                                            'description'   => $desc,
                                            'id_mop'        => $id_mop,
                                            'add_time'      => date("Y-m-d H:i:s", now('Asia/Jakarta')),
                                            'add_by'        => $this->session->userdata('sesi_id'),
                                            'updated_time'  => date("Y-m-d H:i:s", now('Asia/Jakarta')),
                                            'updated_by'    => $this->session->userdata('sesi_id')
                                            ];
                            
                            $this->db->insert('dokumen_mop', $data_dok);
                            
                        } else {

                            if ($desc != $desc_edit) {

                                $data_dok   = [ 'filename'      => $nama,
                                                'size'          => $this->formatSizeUnits($size),
                                                'description'   => $desc,
                                                'id_mop'        => $id_mop,
                                                'updated_time'  => date("Y-m-d H:i:s", now('Asia/Jakarta')),
                                                'updated_by'    => $this->session->userdata('sesi_id')
                                                ];
    
                            } else {

                                if ($nama != '' || $nama != null) {
    
                                    $data_dok   = [ 'filename'      => $nama,
                                                    'size'          => $this->formatSizeUnits($size),
                                                    'description'   => $desc,
                                                    'id_mop'        => $id_mop,
                                                    'updated_time'  => date("Y-m-d H:i:s", now('Asia/Jakarta')),
                                                    'updated_by'    => $this->session->userdata('sesi_id')
                                                    ];

                                } else {
                                    
                                    $data_dok   = [ 'description'   => $desc,
                                                    'id_mop'        => $id_mop,
                                                    'updated_time'  => date("Y-m-d H:i:s", now('Asia/Jakarta')),
                                                    'updated_by'    => $this->session->userdata('sesi_id')
                                                    ];
                                    
                                }
    
                            }   
                                    
                            
                            
                            $this->db->update('dokumen_mop', $data_dok, ['id_dokumen_mop' => $i_dok_mop[$i]]);
                        }

                    } else {

                        if ($file_edit != 'null') {

                            if ($file_edit == 'baru') {

                                $data_dok   = [ 'description'   => $desc,
                                                'id_mop'        => $id_mop,
                                                'add_time'      => date("Y-m-d H:i:s", now('Asia/Jakarta')),
                                                'add_by'        => $this->session->userdata('sesi_id'),
                                                'updated_time'  => date("Y-m-d H:i:s", now('Asia/Jakarta')),
                                                'updated_by'    => $this->session->userdata('sesi_id')
                                                ];
                        
                                $this->db->insert('dokumen_mop', $data_dok);
                                
                            } else {

                                if ($desc != $desc_edit) {

                                    $data_dok   = [ 'filename'      => $file_edit,  
                                                    'description'   => $desc,
                                                    'id_mop'        => $id_mop,
                                                    'updated_time'  => date("Y-m-d H:i:s", now('Asia/Jakarta')),
                                                    'updated_by'    => $this->session->userdata('sesi_id')
                                                  ];
        
                                } else {
        
                                    $data_dok   = [ 'filename'      => $file_edit,  
                                                    'description'   => $desc,
                                                    'id_mop'        => $id_mop
                                                  ];
        
                                }

                                $this->db->update('dokumen_mop', $data_dok, ['id_dokumen_mop' => $i_dok_mop[$i]]);
                            }

                        } else {

                            if ($desc != $desc_edit) {

                                $data_dok   = [ 'description'   => $desc,
                                                'id_mop'        => $id_mop,
                                                'updated_time'  => date("Y-m-d H:i:s", now('Asia/Jakarta')),
                                                'updated_by'    => $this->session->userdata('sesi_id')
                                              ];
    
                            } else {
    
                                $data_dok   = [ 'description'   => $desc,
                                                'id_mop'        => $id_mop
                                              ];
    
                            }
                            
                            $this->db->update('dokumen_mop', $data_dok, ['id_dokumen_mop' => $i_dok_mop[$i]]);
                            
                        }
                        
                    }

                }
            }
            
        } elseif ($aksi == 'Hapus') {

            $cari_dok = $this->mop->cari_data('dokumen_mop', array('id_mop' => $id_mop))->result_array();

            foreach ($cari_dok as $cd) {

                $file = $cd['filename'];
                
                $path = "./upload/dokumen/".$file;
                unlink($path); 

            }

            $this->mop->hapus_data('dokumen_mop', array('id_mop' => $id_mop));
            // $this->mop->hapus_data('coverage_mop', array('id_mop' => $id_mop));
            $this->mop->hapus_data('tr_produk_asuransi', array('id_mop' => $id_mop));
            $this->mop->hapus_data('mop', array('id_mop' => $id_mop));

        }

        if($this->db->trans_status() === FALSE){
            $this->db->trans_rollback();
    
            echo json_encode(['status' => false]);
        }else{
            $this->db->trans_commit();
    
            echo json_encode(['no_reff_mop' => $this->kode()]);
        }

    }

    // 05-05-2021
    public function ambil_data_mop($id_mop)
    {
        $cari_data  = $this->mop->get_detail_mop($id_mop)->row_array();
        $cari_dok   = $this->mop->cari_data('dokumen_mop', ['id_mop' => $id_mop])->result_array();

        $data = ['cari_data'        => $cari_data,
                 'list_dok'         => $cari_dok,
                 'tgl_awal_polis'   => date("d-m-Y", strtotime($cari_data['tgl_awal_polis'])),
                 'tgl_akhir_polis'  => date("d-m-Y", strtotime($cari_data['tgl_akhir_polis']))
                ];

        echo json_encode($data);
    }

    // 28-05-2021
    public function get_kode()
    {
        echo json_encode(['no_reff_mop' => $this->kode()]);
    }

    public function formatSizeUnits($bytes)
    {
        if ($bytes >= 1073741824)
        {
            $bytes = number_format($bytes / 1073741824, 2) . ' GB';
        }
        elseif ($bytes >= 1048576)
        {
            $bytes = number_format($bytes / 1048576, 2) . ' MB';
        }
        elseif ($bytes >= 1024)
        {
            $bytes = number_format($bytes / 1024, 2) . ' KB';
        }
        elseif ($bytes > 1)
        {
            $bytes = $bytes . ' bytes';
        }
        elseif ($bytes == 1)
        {
            $bytes = $bytes . ' byte';
        }
        else
        {
            $bytes = '0 bytes';
        }

        return $bytes;
    }
}

?>
