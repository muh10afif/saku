<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Master extends CI_Controller {

    public function __construct()
	{
		parent::__construct();
		if($this->session->userdata('username') == "")
        {
            redirect(base_url(), 'refresh');
        }
        $this->load->model(array('M_master')); 
        
	}

    public function index()
    {
        $this->misi();
    }

    // 23-04-2021
    public function misi()
    {
        $data 	= ['title'  => 'Master Misi'
                  ];

        $this->template->load('template/index','master/misi/lihat', $data);
    }

    // 23-04-2021
    // menampilkan list misi 
    public function tampil_data_misi()
    {
        $list = $this->M_master->get_data_misi();

        $data = array();

        $no   = $this->input->post('start');

        foreach ($list as $o) {
            $no++;
            $tbody = array();

            $tbody[]    = "<div align='center'>".$no.".</div>";
            $tbody[]    = $o['misi'];
            $tbody[]    = "<span style='cursor:pointer' class='mr-2 text-primary edit-misi' data-toggle='tooltip' data-placement='top' title='Ubah' data-id='".$o['id_misi']."' nama='".$o['misi']."'><i class='fas fa-pencil-alt fa-lg'></i></span><span style='cursor:pointer' class='text-danger hapus-misi' data-toggle='tooltip' data-placement='top' title='Hapus' data-id='".$o['id_misi']."' nama='".$o['misi']."'><i class='far fa-trash-alt fa-lg'></i></span>";
            $data[]     = $tbody;
        }

        $output = [ "draw"             => $_POST['draw'],
                    "recordsTotal"     => $this->M_master->jumlah_semua_misi(),
                    "recordsFiltered"  => $this->M_master->jumlah_filter_misi(),   
                    "data"             => $data
                ];

        echo json_encode($output);
    }

    // 23-04-2021
    // aksi proses simpan data misi
    public function simpan_data_misi()
    {
        $aksi       = $this->input->post('aksi');
        $id_misi    = $this->input->post('id_misi');
        $misi       = $this->input->post('nama_misi');

        $data = ['misi'         => $misi,
                 'add_time'     => date("Y-m-d H:i:s", now('Asia/Jakarta')),
                 'add_by'       => $this->session->userdata('id_user')
                ];

        if ($aksi == 'Tambah') {
            $this->M_master->input_data('m_misi', $data);
        } elseif ($aksi == 'Ubah') {
            $this->M_master->ubah_data('m_misi', $data, array('id_misi' => $id_misi));
        } elseif ($aksi == 'Hapus') {
            $this->M_master->hapus_data('m_misi', array('id_misi' => $id_misi));
        }

        echo json_encode($aksi);
    }

    // 24-04-2021
    public function asuransi()
    {
        $cari = $this->M_master->get_data_order('m_asuransi', 'add_time', 'desc')->row_array();

        if (!empty($cari)) {
        $a =  strpos($cari['kode_asuransi'],"N");
        $b =  strlen($cari['kode_asuransi']); 

        $c =  substr($cari['kode_asuransi'], $a + 1, $b);

        $a = (int) "$c" + 1;

            $kd = str_pad($a, 4, "0", STR_PAD_LEFT);
        } else {
            $kd = str_pad(1, 4, "0", STR_PAD_LEFT);
        }

        $data 	= [ 'title'         => 'Master Insurer',
                    'kode'          => "ASN$kd",
                    'tipe_as'       => $this->M_master->get_data_order('m_tipe_as', 'tipe_as', 'asc')->result_array(),
                    'kategori_as'   => $this->M_master->get_data_order('m_kategori_as', 'kategori_as', 'asc')->result_array(),
                    'kota'          => $this->M_master->get_data_order('m_kota', 'kota', 'asc')->result_array()
                ];

        $this->template->load('template/index','asuransi/lihat', $data);
    }

    // menampilkan list asuransi 
    public function tampil_data_asuransi()
    {
        $list = $this->M_master->get_data_asuransi();

        $data = array();

        $no   = $this->input->post('start');

        foreach ($list as $o) {
            $no++;
            $tbody = array();

            $tbody[]    = "<div align='center'>".$no.".</div>";
            $tbody[]    = $o['kode_asuransi'];
            $tbody[]    = $o['nama_asuransi'];
            $tbody[]    = $o['telp'];
            $tbody[]    = $o['pic'];
            $tbody[]    = $o['kategori_as'];
            $tbody[]    = $o['tipe_as'];
            $tbody[]    = "<span style='cursor:pointer' class='mr-2 text-primary edit-asuransi' data-toggle='tooltip' data-placement='top' title='Ubah' data-id='".$o['id_asuransi']."' nama='".$o['asuransi']."'><i class='fas fa-pencil-alt fa-lg'></i></span><span style='cursor:pointer' class='text-danger hapus-asuransi' data-toggle='tooltip' data-placement='top' title='Hapus' data-id='".$o['id_asuransi']."' nama='".$o['asuransi']."'><i class='far fa-trash-alt fa-lg'></i></span>";
            $data[]     = $tbody;
        }

        $output = [ "draw"             => $_POST['draw'],
                    "recordsTotal"     => $this->M_master->jumlah_semua_asuransi(),
                    "recordsFiltered"  => $this->M_master->jumlah_filter_asuransi(),   
                    "data"             => $data
                ];

        echo json_encode($output);
    }

    // 28-04-2021
    // aksi proses simpan data asuransi
    public function simpan_data_asuransi()
    {
        $aksi           = $this->input->post('aksi');
        $id_asuransi    = $this->input->post('id_asuransi');
        $nama_asuransi  = $this->input->post('nama_asuransi');
        $kode_asuransi  = $this->input->post('kode_asuransi');
        $singkatan      = $this->input->post('singkatan');
        $id_tipe_as     = $this->input->post('id_tipe_as');
        $id_kategori_as = $this->input->post('id_kategori_as');
        $alamat         = $this->input->post('alamat');
        $id_kota        = $this->input->post('id_kota');
        $kode_pos       = $this->input->post('kode_pos');
        $telp           = $this->input->post('telp');
        $fax            = $this->input->post('fax');
        $website        = $this->input->post('website');
        $email          = $this->input->post('email');
        $pic            = $this->input->post('pic');
        $alamat_pic     = $this->input->post('alamat_pic');
        $telp_pic       = $this->input->post('telp_pic');
        $email_pic      = $this->input->post('email_pic');

        $data = [   'nama_asuransi'     => $nama_asuransi,
                    'kode_asuransi'     => $kode_asuransi,
                    'singkatan'         => $singkatan,
                    'id_tipe_as'        => ($id_tipe_as == '') ? null : $id_tipe_as,
                    'id_kategori_as'    => ($id_kategori_as == '') ? null : $id_kategori_as,
                    'alamat'            => $alamat,
                    'id_kota'           => ($id_kota == '') ? null : $id_kota,
                    'kode_pos'          => $kode_pos,
                    'telp'              => $telp,
                    'fax'               => $fax,
                    'website'           => $website,
                    'email'             => $email,
                    'pic'               => $pic,
                    'alamat_pic'        => $alamat_pic,
                    'telp_pic'          => $telp_pic,
                    'email_pic'         => $email_pic,
                    'add_time'          => date("Y-m-d H:i:s", now('Asia/Jakarta')),
                    'add_by'            => $this->session->userdata('id_user')
                ];

        if ($aksi == 'Tambah') {
            $this->M_master->input_data('m_asuransi', $data);
        } elseif ($aksi == 'Ubah') {
            $this->M_master->ubah_data('m_asuransi', $data, array('id_asuransi' => $id_asuransi));
        } elseif ($aksi == 'Hapus') {
            $this->M_master->hapus_data('m_asuransi', array('id_asuransi' => $id_asuransi));
        }

        $cari = $this->M_master->get_data_order('m_asuransi', 'add_time', 'desc')->row_array();

        if (!empty($cari)) {
        $a =  strpos($cari['kode_asuransi'],"N");
        $b =  strlen($cari['kode_asuransi']); 

        $c =  substr($cari['kode_asuransi'], $a + 1, $b);

        $a = (int) "$c" + 1;

            $kd = str_pad($a, 4, "0", STR_PAD_LEFT);
        } else {
            $kd = str_pad(1, 4, "0", STR_PAD_LEFT);
        }

        echo json_encode(['kode_asuransi' => "ASN$kd"]);
    }

    // 05-05-2021
    public function ambil_data_asuransi($id_asuransi)
    {
        $cari = $this->M_master->cari_data('m_asuransi', ['id_asuransi' => $id_asuransi])->row_array();

        echo json_encode($cari);
    }

    // 24-04-2021
    public function bagian()
    {
        $data 	= ['title'  => 'Master Bagian'
                ];

        $this->template->load('template/index','master/bagian/lihat', $data);
    }
    // 24-04-2021
    public function bank()
    {
        $data 	= ['title'  => 'Master Bank'
                ];

        $this->template->load('template/index','master/bank/lihat', $data);
    }
    // 24-04-2021
    public function cabang_bank()
    {
        $data 	= ['title'  => 'Master Cabang Bank'
                ];

        $this->template->load('template/index','master/cabang_bank/lihat', $data);
    }
    // 24-04-2021
    public function cob()
    {
        $data 	= ['title'  => 'Master COB'
                ];

        $this->template->load('template/index','master/cob/lihat', $data);
    }
    // 24-04-2021
    public function field_sppa()
    {
        $data 	= ['title'  => 'Master Field SPPA'
                ];

        $this->template->load('template/index','master/field_sppa/lihat', $data);
    }

    // 27-04-2021
    public function tampil_data_field_sppa()
    {
        $list = $this->M_master->get_data_field_sppa();

        $data = array();

        $no   = $this->input->post('start');

        foreach ($list as $o) {
            $no++;
            $tbody = array();

            $tbody[]    = "<div align='center'>".$no.".</div>";
            $tbody[]    = $o['field_sppa'];
            $tbody[]    = "<span style='cursor:pointer' class='mr-2 text-primary edit-field_sppa' data-toggle='tooltip' data-placement='top' title='Ubah' data-id='".$o['id_field_sppa']."' nama='".$o['field_sppa']."'><i class='fas fa-pencil-alt fa-lg'></i></span><span style='cursor:pointer' class='text-danger hapus-field_sppa' data-toggle='tooltip' data-placement='top' title='Hapus' data-id='".$o['id_field_sppa']."' nama='".$o['field_sppa']."'><i class='far fa-trash-alt fa-lg'></i></span>";
            $data[]     = $tbody;
        }

        $output = [ "draw"             => $_POST['draw'],
                    "recordsTotal"     => $this->M_master->jumlah_semua_field_sppa(),
                    "recordsFiltered"  => $this->M_master->jumlah_filter_field_sppa(),   
                    "data"             => $data
                ];

        echo json_encode($output);
    }

    // 27-04-2021
    // aksi proses simpan data field_sppa
    public function simpan_data_field_sppa()
    {
        $aksi             = $this->input->post('aksi');
        $id_field_sppa    = $this->input->post('id_field_sppa');
        $field_sppa       = $this->input->post('field_sppa');

        $data = [   'field_sppa'   => $field_sppa,
                    'add_time'     => date("Y-m-d H:i:s", now('Asia/Jakarta')),
                    'add_by'       => $this->session->userdata('id_user')
                ];

        if ($aksi == 'Tambah') {
            $this->M_master->input_data('m_field_sppa', $data);
        } elseif ($aksi == 'Ubah') {
            $this->M_master->ubah_data('m_field_sppa', $data, array('id_field_sppa' => $id_field_sppa));
        } elseif ($aksi == 'Hapus') {
            $this->M_master->hapus_data('m_field_sppa', array('id_field_sppa' => $id_field_sppa));
        }

        echo json_encode($aksi);
    }

    // 24-04-2021
    public function indikator()
    {
        $data 	= ['title'  => 'Master Indikator'
                ];

        $this->template->load('template/index','master/indikator/lihat', $data);
    }
    // 24-04-2021
    public function introduction()
    {
        $data 	= ['title'  => 'Master Introduction'
                ];

        $this->template->load('template/index','master/introduction/lihat', $data);
    }

    public function tampil_data_introduction()
    {
        $list = $this->M_master->get_data_introduction();

        $data = array();

        $no   = $this->input->post('start');

        foreach ($list as $o) {
            $no++;
            $tbody = array();

            $tbody[]    = "<div align='center'>".$no.".</div>";
            $tbody[]    = $o['introduction'];
            $tbody[]    = "<span style='cursor:pointer' class='mr-2 text-primary edit-introduction' data-toggle='tooltip' data-placement='top' title='Ubah' data-id='".$o['id_introduction']."' nama='".$o['introduction']."'><i class='fas fa-pencil-alt fa-lg'></i></span><span style='cursor:pointer' class='text-danger hapus-introduction' data-toggle='tooltip' data-placement='top' title='Hapus' data-id='".$o['id_introduction']."' nama='".$o['introduction']."'><i class='far fa-trash-alt fa-lg'></i></span>";
            $data[]     = $tbody;
        }

        $output = [ "draw"             => $_POST['draw'],
                    "recordsTotal"     => $this->M_master->jumlah_semua_introduction(),
                    "recordsFiltered"  => $this->M_master->jumlah_filter_introduction(),   
                    "data"             => $data
                ];

        echo json_encode($output);
    }

    // 27-04-2021
    public function simpan_data_introduction()
    {
        $aksi               = $this->input->post('aksi');
        $id_introduction    = $this->input->post('id_introduction');
        $introduction       = $this->input->post('introduction');

        $data = [   'introduction'  => $introduction,
                    'add_time'      => date("Y-m-d H:i:s", now('Asia/Jakarta')),
                    'add_by'        => $this->session->userdata('id_user')
                ];

        if ($aksi == 'Tambah') {
            $this->M_master->input_data('m_introduction', $data);
        } elseif ($aksi == 'Ubah') {
            $this->M_master->ubah_data('m_introduction', $data, array('id_introduction' => $id_introduction));
        } elseif ($aksi == 'Hapus') {
            $this->M_master->hapus_data('m_introduction', array('id_introduction' => $id_introduction));
        }

        echo json_encode($aksi);
    }

    // 24-04-2021
    public function jabatan()
    {
        $data 	= ['title'  => 'Master Jabatan'
                ];

        $this->template->load('template/index','master/jabatan/lihat', $data);
    }
    // 24-04-2021
    public function jenis_klaim()
    {
        $data 	= ['title'  => 'Master Jenis Klaim'
                ];

        $this->template->load('template/index','master/jenis_klaim/lihat', $data);
    }
    // 24-04-2021
    public function karyawan()
    {
        $data 	= ['title'  => 'Master Karyawan'
                ];

        $this->template->load('template/index','master/karyawan/lihat', $data);
    }
    // 24-04-2021
    public function kategori_as()
    {
        $data 	= ['title'  => 'Master Kategori Asuransi'
                ];

        $this->template->load('template/index','master/kategori_as/lihat', $data);
    }

    public function tampil_data_kategori_as()
    {
        $list = $this->M_master->get_data_kategori_as();

        $data = array();

        $no   = $this->input->post('start');

        foreach ($list as $o) {
            $no++;
            $tbody = array();

            $tbody[]    = "<div align='center'>".$no.".</div>";
            $tbody[]    = $o['kategori_as'];
            $tbody[]    = "<span style='cursor:pointer' class='mr-2 text-primary edit-kategori_as' data-toggle='tooltip' data-placement='top' title='Ubah' data-id='".$o['id_kategori_as']."' nama='".$o['kategori_as']."'><i class='fas fa-pencil-alt fa-lg'></i></span><span style='cursor:pointer' class='text-danger hapus-kategori_as' data-toggle='tooltip' data-placement='top' title='Hapus' data-id='".$o['id_kategori_as']."' nama='".$o['kategori_as']."'><i class='far fa-trash-alt fa-lg'></i></span>";
            $data[]     = $tbody;
        }

        $output = [ "draw"             => $_POST['draw'],
                    "recordsTotal"     => $this->M_master->jumlah_semua_kategori_as(),
                    "recordsFiltered"  => $this->M_master->jumlah_filter_kategori_as(),   
                    "data"             => $data
                ];

        echo json_encode($output);
    }

    // 27-04-2021
    public function simpan_data_kategori_as()
    {
        $aksi              = $this->input->post('aksi');
        $id_kategori_as    = $this->input->post('id_kategori_as');
        $kategori_as       = $this->input->post('nama_kategori_as');

        $data = [   'kategori_as'   => $kategori_as,
                    'add_time'      => date("Y-m-d H:i:s", now('Asia/Jakarta')),
                    'add_by'        => $this->session->userdata('id_user')
                ];

        if ($aksi == 'Tambah') {
            $this->M_master->input_data('m_kategori_as', $data);
        } elseif ($aksi == 'Ubah') {
            $this->M_master->ubah_data('m_kategori_as', $data, array('id_kategori_as' => $id_kategori_as));
        } elseif ($aksi == 'Hapus') {
            $this->M_master->hapus_data('m_kategori_as', array('id_kategori_as' => $id_kategori_as));
        }

        echo json_encode($aksi);
    }

    // 24-04-2021
    public function klasifikasi_klaim()
    {
        $data 	= ['title'  => 'Master Klasifikasi Klaim'
                ];

        $this->template->load('template/index','master/klasifikasi_klaim/lihat', $data);
    }
    // 24-04-2021
    public function kota()
    {
        $data 	= ['title'      => 'Master Kota',
                   'provinsi'   => $this->M_master->get_data_order('m_provinsi', 'provinsi', 'asc')->result_array()
                ];

        $this->template->load('template/index','master/kota/lihat', $data);
    }

    // 05-05-2021
    public function tampil_data_kota()
    {
        $list = $this->M_master->get_data_kota();

        $data = array();

        $no   = $this->input->post('start');

        foreach ($list as $o) {
            $no++;
            $tbody = array();

            $tbody[]    = "<div align='center'>".$no.".</div>";
            $tbody[]    = $o['kota'];
            $tbody[]    = $o['provinsi'];
            $tbody[]    = "<span style='cursor:pointer' class='mr-2 text-primary edit-kota' data-toggle='tooltip' data-placement='top' title='Ubah' data-id='".$o['id_kota']."' nama='".$o['kota']."'><i class='fas fa-pencil-alt fa-lg'></i></span><span style='cursor:pointer' class='text-danger hapus-kota' data-toggle='tooltip' data-placement='top' title='Hapus' data-id='".$o['id_kota']."' nama='".$o['kota']."'><i class='far fa-trash-alt fa-lg'></i></span>";
            $data[]     = $tbody;
        }

        $output = [ "draw"             => $_POST['draw'],
                    "recordsTotal"     => $this->M_master->jumlah_semua_kota(),
                    "recordsFiltered"  => $this->M_master->jumlah_filter_kota(),   
                    "data"             => $data
                ];

        echo json_encode($output);
    }

    // 05-05-2021
    public function simpan_data_kota()
    {
        $aksi           = $this->input->post('aksi');
        $id_kota        = $this->input->post('id_kota');
        $id_provinsi    = $this->input->post('provinsi');
        $kota           = $this->input->post('nama_kota');

        $data = [   'kota'          => $kota,
                    'id_provinsi'   => $id_provinsi,
                    'add_time'      => date("Y-m-d H:i:s", now('Asia/Jakarta')),
                    'add_by'        => $this->session->userdata('id_user')
                ];

        if ($aksi == 'Tambah') {
            $this->M_master->input_data('m_kota', $data);
        } elseif ($aksi == 'Ubah') {
            $this->M_master->ubah_data('m_kota', $data, array('id_kota' => $id_kota));
        } elseif ($aksi == 'Hapus') {
            $this->M_master->hapus_data('m_kota', array('id_kota' => $id_kota));
        }

        echo json_encode($aksi);
    }

    
    // 24-04-2021
    public function lob()
    {
        $data 	= ['title'  => 'Master LOB'
                ];

        $this->template->load('template/index','master/lob/lihat', $data);
    }
    // 23-04-2021
    public function nasabah()
    {
        $data 	= ['title'  => 'Master Nasabah'
                ];

        $this->template->load('template/index','master/nasabah/lihat', $data);
    }
    // 23-04-2021
    public function negara()
    {
        $data 	= ['title'  => 'Master Negara'
                ];

        $this->template->load('template/index','master/negara/lihat', $data);
    }

    // 05-05-2021
    public function tampil_data_negara()
    {
        $list = $this->M_master->get_data_negara();

        $data = array();

        $no   = $this->input->post('start');

        foreach ($list as $o) {
            $no++;
            $tbody = array();

            $tbody[]    = "<div align='center'>".$no.".</div>";
            $tbody[]    = $o['negara'];
            $tbody[]    = "<span style='cursor:pointer' class='mr-2 text-primary edit-negara' data-toggle='tooltip' data-placement='top' title='Ubah' data-id='".$o['id_negara']."' nama='".$o['negara']."'><i class='fas fa-pencil-alt fa-lg'></i></span><span style='cursor:pointer' class='text-danger hapus-negara' data-toggle='tooltip' data-placement='top' title='Hapus' data-id='".$o['id_negara']."' nama='".$o['negara']."'><i class='far fa-trash-alt fa-lg'></i></span>";
            $data[]     = $tbody;
        }

        $output = [ "draw"             => $_POST['draw'],
                    "recordsTotal"     => $this->M_master->jumlah_semua_negara(),
                    "recordsFiltered"  => $this->M_master->jumlah_filter_negara(),   
                    "data"             => $data
                ];

        echo json_encode($output);
    }

    // 05-05-2021
    public function simpan_data_negara()
    {
        $aksi           = $this->input->post('aksi');
        $id_negara      = $this->input->post('id_negara');
        $negara         = $this->input->post('nama_negara');

        $data = [   'negara'        => $negara,
                    'add_time'      => date("Y-m-d H:i:s", now('Asia/Jakarta')),
                    'add_by'        => $this->session->userdata('id_user')
                ];

        if ($aksi == 'Tambah') {
            $this->M_master->input_data('m_negara', $data);
        } elseif ($aksi == 'Ubah') {
            $this->M_master->ubah_data('m_negara', $data, array('id_negara' => $id_negara));
        } elseif ($aksi == 'Hapus') {
            $this->M_master->hapus_data('m_negara', array('id_negara' => $id_negara));
        }

        echo json_encode($aksi);
    }

    // 23-04-2021
    public function parameter_scoring()
    {
        $data 	= ['title'  => 'Master Parameter Scoring'
                ];

        $this->template->load('template/index','master/parameter_scoring/lihat', $data);
    }

    // 05-05-2021
    public function tampil_data_parameter_scoring()
    {
        $list = $this->M_master->get_data_parameter_scoring();

        $data = array();

        $no   = $this->input->post('start');

        foreach ($list as $o) {
            $no++;
            $tbody = array();

            $tbody[]    = "<div align='center'>".$no.".</div>";
            $tbody[]    = $o['nama_parameter'];
            $tbody[]    = "<span style='cursor:pointer' class='mr-2 text-primary edit-parameter_scoring' data-toggle='tooltip' data-placement='top' title='Ubah' data-id='".$o['id_parameter_scoring']."' nama='".$o['nama_parameter']."'><i class='fas fa-pencil-alt fa-lg'></i></span><span style='cursor:pointer' class='text-danger hapus-parameter_scoring' data-toggle='tooltip' data-placement='top' title='Hapus' data-id='".$o['id_parameter_scoring']."' nama='".$o['nama_parameter']."'><i class='far fa-trash-alt fa-lg'></i></span>";
            $data[]     = $tbody;
        }

        $output = [ "draw"             => $_POST['draw'],
                    "recordsTotal"     => $this->M_master->jumlah_semua_parameter_scoring(),
                    "recordsFiltered"  => $this->M_master->jumlah_filter_parameter_scoring(),   
                    "data"             => $data
                ];

        echo json_encode($output);
    }

    // 05-05-2021
    public function simpan_data_parameter_scoring()
    {
        $aksi                      = $this->input->post('aksi');
        $id_parameter_scoring      = $this->input->post('id_parameter_scoring');
        $parameter_scoring         = $this->input->post('nama_parameter_scoring');

        $data = [   'nama_parameter'    => $parameter_scoring,
                    'add_time'          => date("Y-m-d H:i:s", now('Asia/Jakarta')),
                    'add_by'            => $this->session->userdata('id_user')
                ];

        if ($aksi == 'Tambah') {
            $this->M_master->input_data('m_parameter_scoring', $data);
        } elseif ($aksi == 'Ubah') {
            $this->M_master->ubah_data('m_parameter_scoring', $data, array('id_parameter_scoring' => $id_parameter_scoring));
        } elseif ($aksi == 'Hapus') {
            $this->M_master->hapus_data('m_parameter_scoring', array('id_parameter_scoring' => $id_parameter_scoring));
        }

        echo json_encode($aksi);
    }

    // 23-04-2021
    public function produk()
    {
        $data 	= ['title'  => 'Master Produk'
                ];

        $this->template->load('template/index','master/produk/lihat', $data);
    }
    // 23-04-2021
    public function produk_title()
    {
        $data 	= ['title'  => 'Master Produk Title'
                ];

        $this->template->load('template/index','master/produk_title/lihat', $data);
    }
    // 23-04-2021
    public function provinsi()
    {
        $data 	= [ 'title'     => 'Master Provinsi',
                    'negara'    => $this->M_master->get_data_order('m_negara', 'negara', 'asc')->result_array()
                ];

        $this->template->load('template/index','master/provinsi/lihat', $data);
    } 

    // 05-05-2021
    public function tampil_data_provinsi()
    {
        $list = $this->M_master->get_data_provinsi();

        $data = array();

        $no   = $this->input->post('start');

        foreach ($list as $o) {
            $no++;
            $tbody = array();

            $tbody[]    = "<div align='center'>".$no.".</div>";
            $tbody[]    = $o['provinsi'];
            $tbody[]    = $o['negara'];
            $tbody[]    = "<span style='cursor:pointer' class='mr-2 text-primary edit-provinsi' data-toggle='tooltip' data-placement='top' title='Ubah' data-id='".$o['id_provinsi']."' nama='".$o['provinsi']."'><i class='fas fa-pencil-alt fa-lg'></i></span><span style='cursor:pointer' class='text-danger hapus-provinsi' data-toggle='tooltip' data-placement='top' title='Hapus' data-id='".$o['id_provinsi']."' nama='".$o['provinsi']."'><i class='far fa-trash-alt fa-lg'></i></span>";
            $data[]     = $tbody;
        }

        $output = [ "draw"             => $_POST['draw'],
                    "recordsTotal"     => $this->M_master->jumlah_semua_provinsi(),
                    "recordsFiltered"  => $this->M_master->jumlah_filter_provinsi(),   
                    "data"             => $data
                ];

        echo json_encode($output);
    }

    // 05-05-2021
    public function simpan_data_provinsi()
    {
        $aksi           = $this->input->post('aksi');
        $id_provinsi    = $this->input->post('id_provinsi');
        $negara         = $this->input->post('negara');
        $provinsi       = $this->input->post('nama_provinsi');

        $data = [   'provinsi'      => $provinsi,
                    'id_negara'     => $negara,
                    'add_time'      => date("Y-m-d H:i:s", now('Asia/Jakarta')),
                    'add_by'        => $this->session->userdata('id_user')
                ];

        if ($aksi == 'Tambah') {
            $this->M_master->input_data('m_provinsi', $data);
        } elseif ($aksi == 'Ubah') {
            $this->M_master->ubah_data('m_provinsi', $data, array('id_provinsi' => $id_provinsi));
        } elseif ($aksi == 'Hapus') {
            $this->M_master->hapus_data('m_provinsi', array('id_provinsi' => $id_provinsi));
        }

        echo json_encode($aksi);
    }

    // 23-04-2021
    public function sob()
    {
        $data 	= ['title'  => 'Master SOB'
                ];

        $this->template->load('template/index','master/sob/lihat', $data);
    }
    // 23-04-2021
    public function status_klaim()
    {
        $data 	= ['title'  => 'Master Status Klaim'
                ];

        $this->template->load('template/index','master/status_klaim/lihat', $data);
    }
    // 23-04-2021
    public function subtitle()
    {
        $data 	= ['title'  => 'Master Subtitle'
                ];

        $this->template->load('template/index','master/subtitle/lihat', $data);
    }
    // 23-04-2021
    public function tipe_as()
    {
        $data 	= ['title'  => 'Master Tipe Asuransi'
                ];

        $this->template->load('template/index','master/tipe_as/lihat', $data);
    }

    public function tampil_data_tipe_as()
    {
        $list = $this->M_master->get_data_tipe_as();

        $data = array();

        $no   = $this->input->post('start');

        foreach ($list as $o) {
            $no++;
            $tbody = array();

            $tbody[]    = "<div align='center'>".$no.".</div>";
            $tbody[]    = $o['tipe_as'];
            $tbody[]    = "<span style='cursor:pointer' class='mr-2 text-primary edit-tipe_as' data-toggle='tooltip' data-placement='top' title='Ubah' data-id='".$o['id_tipe_as']."' nama='".$o['tipe_as']."'><i class='fas fa-pencil-alt fa-lg'></i></span><span style='cursor:pointer' class='text-danger hapus-tipe_as' data-toggle='tooltip' data-placement='top' title='Hapus' data-id='".$o['id_tipe_as']."' nama='".$o['tipe_as']."'><i class='far fa-trash-alt fa-lg'></i></span>";
            $data[]     = $tbody;
        }

        $output = [ "draw"             => $_POST['draw'],
                    "recordsTotal"     => $this->M_master->jumlah_semua_tipe_as(),
                    "recordsFiltered"  => $this->M_master->jumlah_filter_tipe_as(),   
                    "data"             => $data
                ];

        echo json_encode($output);
    }

    // 27-04-2021
    public function simpan_data_tipe_as()
    {
        $aksi          = $this->input->post('aksi');
        $id_tipe_as    = $this->input->post('id_tipe_as');
        $tipe_as       = $this->input->post('nama_tipe_as');

        $data = [   'tipe_as'   => $tipe_as,
                    'add_time'  => date("Y-m-d H:i:s", now('Asia/Jakarta')),
                    'add_by'    => $this->session->userdata('id_user')
                ];

        if ($aksi == 'Tambah') {
            $this->M_master->input_data('m_tipe_as', $data);
        } elseif ($aksi == 'Ubah') {
            $this->M_master->ubah_data('m_tipe_as', $data, array('id_tipe_as' => $id_tipe_as));
        } elseif ($aksi == 'Hapus') {
            $this->M_master->hapus_data('m_tipe_as', array('id_tipe_as' => $id_tipe_as));
        }

        echo json_encode($aksi);
    }

    // 23-04-2021
    public function tipe_cob()
    {
        $data 	= ['title'  => 'Master Tipe COB'
                ];

        $this->template->load('template/index','master/tipe_cob/lihat', $data);
    }
    // 23-04-2021
    public function tipe_klaim()
    {
        $data 	= ['title'  => 'Master Tipe Klaim'
                ];

        $this->template->load('template/index','master/tipe_klaim/lihat', $data);
    }
    // 23-04-2021
    public function title_management()
    {
        $data 	= ['title'  => 'Master Title Management'
                ];

        $this->template->load('template/index','master/title_management/lihat', $data);
    }
    // 23-04-2021
    public function user()
    {
        $data 	= ['title'  => 'Master User'
                ];

        $this->template->load('template/index','master/user/lihat', $data);
    }
    // 23-04-2021
    public function value()
    {
        $data 	= ['title'  => 'Master Value'
                ];

        $this->template->load('template/index','master/value/lihat', $data);
    }
    
    public function tampil_data_value()
    {
        $list = $this->M_master->get_data_value();

        $data = array();

        $no   = $this->input->post('start');

        foreach ($list as $o) {
            $no++;
            $tbody = array();

            $tbody[]    = "<div align='center'>".$no.".</div>";
            $tbody[]    = $o['value'];
            $tbody[]    = "<span style='cursor:pointer' class='mr-2 text-primary edit-value' data-toggle='tooltip' data-placement='top' title='Ubah' data-id='".$o['id_value']."' nama='".$o['value']."'><i class='fas fa-pencil-alt fa-lg'></i></span><span style='cursor:pointer' class='text-danger hapus-value' data-toggle='tooltip' data-placement='top' title='Hapus' data-id='".$o['id_value']."' nama='".$o['value']."'><i class='far fa-trash-alt fa-lg'></i></span>";
            $data[]     = $tbody;
        }

        $output = [ "draw"             => $_POST['draw'],
                    "recordsTotal"     => $this->M_master->jumlah_semua_value(),
                    "recordsFiltered"  => $this->M_master->jumlah_filter_value(),   
                    "data"             => $data
                ];

        echo json_encode($output);
    }

    // 27-04-2021
    public function simpan_data_value()
    {
        $aksi        = $this->input->post('aksi');
        $id_value    = $this->input->post('id_value');
        $value       = $this->input->post('nama_value');

        $data = [   'value'         => $value,
                    'add_time'      => date("Y-m-d H:i:s", now('Asia/Jakarta')),
                    'add_by'        => $this->session->userdata('id_user')
                ];

        if ($aksi == 'Tambah') {
            $this->M_master->input_data('m_value', $data);
        } elseif ($aksi == 'Ubah') {
            $this->M_master->ubah_data('m_value', $data, array('id_value' => $id_value));
        } elseif ($aksi == 'Hapus') {
            $this->M_master->hapus_data('m_value', array('id_value' => $id_value));
        }

        echo json_encode($aksi);
    }

    // 24-04-2021
    public function visi()
    {
        $data 	= ['title'  => 'Master Visi'
                ];

        $this->template->load('template/index','master/visi/lihat', $data);
    }

    // 27-04-2021
    public function tampil_data_visi()
    {
        $list = $this->M_master->get_data_visi();

        $data = array();

        $no   = $this->input->post('start');

        foreach ($list as $o) {
            $no++;
            $tbody = array();

            $tbody[]    = "<div align='center'>".$no.".</div>";
            $tbody[]    = $o['visi'];
            $tbody[]    = "<span style='cursor:pointer' class='mr-2 text-primary edit-visi' data-toggle='tooltip' data-placement='top' title='Ubah' data-id='".$o['id_visi']."' nama='".$o['visi']."'><i class='fas fa-pencil-alt fa-lg'></i></span><span style='cursor:pointer' class='text-danger hapus-visi' data-toggle='tooltip' data-placement='top' title='Hapus' data-id='".$o['id_visi']."' nama='".$o['visi']."'><i class='far fa-trash-alt fa-lg'></i></span>";
            $data[]     = $tbody;
        }

        $output = [ "draw"             => $_POST['draw'],
                    "recordsTotal"     => $this->M_master->jumlah_semua_visi(),
                    "recordsFiltered"  => $this->M_master->jumlah_filter_visi(),   
                    "data"             => $data
                ];

        echo json_encode($output);
    }

    // 27-04-2021
    public function simpan_data_visi()
    {
        $aksi               = $this->input->post('aksi');
        $id_visi    = $this->input->post('id_visi');
        $visi       = $this->input->post('visi');

        $data = [   'visi'  => $visi,
                    'add_time'      => date("Y-m-d H:i:s", now('Asia/Jakarta')),
                    'add_by'        => $this->session->userdata('id_user')
                ];

        if ($aksi == 'Tambah') {
            $this->M_master->input_data('m_visi', $data);
        } elseif ($aksi == 'Ubah') {
            $this->M_master->ubah_data('m_visi', $data, array('id_visi' => $id_visi));
        } elseif ($aksi == 'Hapus') {
            $this->M_master->hapus_data('m_visi', array('id_visi' => $id_visi));
        }

        echo json_encode($aksi);
    }


}

/* End of file Master.php */
