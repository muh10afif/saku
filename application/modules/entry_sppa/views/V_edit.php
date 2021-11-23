<style>
    .nav-pills .nav-link.active, .nav-pills .show > .nav-link {
        color: #fff;
        background-color: #02a4af;
    }

    a {
        color: #02a4af;
    }

    .custom-control-input:checked ~ .custom-control-label::before {
        color: #fff;
        border-color: #006c45;
        background-color: #006c45;
    }

    .nav-tabs .nav-item .nav-link.active {
        color: white;
    }
    .nav-tabs .nav-item.show .nav-link, .nav-tabs .nav-link.active {
        color: #495057;
        background-color: #006c45;
        border-color: #006c45 #006c45 #006c45;
    }
    .nav-tabs .nav-link:focus, .nav-tabs .nav-link:hover {
        border-color: #006c45 #006c45 #006c45;
    }
    .tab-bordered .tab-pane {
        padding: 15px;
        border: 5px solid #006c45;
        margin-top: -1px;
        border-radius: 5px;
    }
    .nav-tabs .nav-item .nav-link {
        color: #006c45;
    }
    .nav-tabs {
        border-bottom: 3px solid #006c45;
    }
    .tab-pane.active {
        animation: slide-down 0.4s ease-out;
    }
    @keyframes slide-down {
        0% { opacity: 0; transform: translateY(100%); }
        100% { opacity: 1; transform: translateY(0); }
    }
</style>
<style>
    .sel2 .parsley-errors-list.filled {
    margin-top: 42px;
    margin-bottom: -60px;
    }

    .sel2 .parsley-errors-list:not(.filled) {
    display: none;
    }

    .sel2 .parsley-errors-list.filled + span.select2 {
    margin-bottom: 30px;
    }

    .sel2 .parsley-errors-list.filled + span.select2 span.select2-selection--single {
        background: #FAEDEC !important;
        border: 1px solid #E85445;
    }
</style>
<!-- Page-Title -->
<div class="page-title-box">
    <div class="row align-items-center">
        <div class="col-sm-4">
            <h4><?= $title ?></h4>
        </div>
        <div class="col-sm-8">
            <ol class="breadcrumb float-right">
                <li class="breadcrumb-item"><a href="<?= base_url() ?>">SAKU</a></li>
                <li class="breadcrumb-item">Transaction</li>
                <li class="breadcrumb-item">Incoming</li>
                <li class="breadcrumb-item">Entry SPPA</li>
                <li class="breadcrumb-item active"><?= $title ?></li>
            </ol>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-5">
        <div class="card shadow">
            <?php if ($role['create'] == 'true' || $id_lvl_otorisasi == 0): ?>
                <!-- <div class="card-header">
                        <a href="<?= base_url() ?>entry_sppa/tambah_entry"><button class="btn btn-primary float-right" id="tambah_entry1"><i class="fas fa-plus mr-1"></i> Tambah Data</button></a>
                </div> -->
            <?php endif;  ?>
            <div class="card-body">
                <table class="table table-bordered table-hover wrap" style="border-collapse: collapse; border-spacing: 0; width: 100%; " id="tabel_entry" width="100%" cellspacing="0">
                <thead class="thead-light text-center">
                    <tr>
                    <th width="5%" style="vertical-align: middle;">No</th>
                    <th style="vertical-align: middle;">No Polis</th>
                    <th style="vertical-align: middle;">Insurer</th>
                    <th style="vertical-align: middle;">LOB</th>
                    <th style="vertical-align: middle;">Insured</th>
                    <th style="vertical-align: middle;">Pengguna Tertanggung</th>
                    <th style="vertical-align: middle;">Total Akhir Premi</th>
                    <th style="vertical-align: middle;">Total Tagihan</th>
                    <th style="vertical-align: middle;" width="15%">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                
                </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="col-md-7">
        <div class="card shadow">
            <div class="card-header mb-0">
                <a href="<?= base_url('entry_sppa') ?>"><button class="btn btn-primary float-right"><i class="fas fa-arrow-left mr-2"></i>Kembali</button></a>
            </div>
            <div class="card-body">

                <div class="row mb-2">
                    <div class="col-md-12 text-center">
                        <h5>Nomor Polis : <samp><mark> <?= $list['no_polis'] ?> </mark></samp></h5>
                    </div>
                </div>

                <form id="form_entry" autocomplete="off">

                <input type="hidden" name="aksi_simpan" id="aksi_simpan" value="edit">
                <input type="hidden" name="no_polis" id="no_polis" value="<?= $list['no_polis'] ?>">
                <input type="hidden" name="id_sppa_quotation" id="id_sppa_quotation" value="<?= $list['id_sppa_quotation'] ?>">
                <input type="hidden" name="result_type" id="result-type" value="">
                <input type="hidden" name="result_data" id="result-data" value="">

                <ul class="nav nav-tabs d-flex justify-content-center mt-3" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" href="#t_client_data" role="tab">
                        <span class="d-none d-md-block">Client Data</span><span class="d-block d-md-none"><i class="mdi mdi-database h5"></i></span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#t_detail" role="tab">
                        <span class="d-none d-md-block">Detail Insured</span><span class="d-block d-md-none"><i class="mdi mdi-shield-account h5"></i></span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#t_dokumen" role="tab">
                        <span class="d-none d-md-block">Documents</span><span class="d-block d-md-none"><i class="mdi mdi-cash-multiple h5"></i></span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#t_premi" role="tab">
                        <span class="d-none d-md-block">Premium Calculation</span><span class="d-block d-md-none"><i class="mdi mdi-cash-multiple h5"></i></span>
                        </a>
                    </li>
                    <li class="nav-item" hidden>
                        <a class="nav-link" data-toggle="tab" href="#t_e_polis" role="tab">
                        <span class="d-none d-md-block">E-polis</span><span class="d-block d-md-none"><i class="mdi mdi-file-document-outline h5"></i></span>
                        </a>
                    </li>
                </ul>

                <div class="tab-content">
                    <div class="tab-pane active p-3" id="t_client_data" role="tabpanel">

                        <div class="mt-2">
                            <!-- <h4>Insurer</h4><hr> -->
                            <!-- <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group row sel2">
                                    <label for="id_insurer" class="col-sm-4 col-form-label text-left">Insurer</label>
                                    <div class="col-sm-8">
                                        <select name="id_insurer" id="id_insurer" class="select2" required data-parsley-required-message="Insurer harus terisi.">
                                            <option value="">Pilih</option>
                                            <?php foreach ($asuransi as $s): ?>
                                                <option value="<?= $s['id_asuransi'] ?>"><?= $s['nama_asuransi'] ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    
                                </div>
                            </div> -->
                            <h4>MOP</h4><hr>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group row sel2">
                                        <label for="id_insurer" class="col-sm-4 col-form-label text-left">Insured</label>
                                        <div class="col-sm-8">
                                            <select name="id_insured" id="id_insured" class="select2" required data-parsley-required-message="Insured harus terisi." onchange="set_no_reff(this.value)">
                                                <option value="">Pilih</option>
                                                <?php foreach ($insured as $n): ?>
                                                    <option value="<?= $n['id_nasabah'] ?>" <?= ($n['id_nasabah'] == $list['id_insured']) ? 'selected' : '' ?>><?= $n['nama_nasabah'] ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group row sel2">
                                        <label for="id_insurer" class="col-sm-4 col-form-label text-left">No Reff MOP</label>
                                        <div class="col-sm-8">
                                            <input type="hidden" id="edit_id_mop" value="<?= $list['id_mop'] ?>">
                                            <select name="id_mop" id="no_reff_mop" class="select2" required data-parsley-required-message="No Reff MOP harus terisi." onchange="get_detail_mop(this.value)">
                                                <option value="">Pilih</option>
                                                
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row det_mop" style="display: none;">
                                <div class="col-md-6">
                                    <div class="form-group row sel2">
                                        <label for="id_insurer" class="col-sm-4 col-form-label text-left">Nomor MOP</label>
                                        <div class="col-sm-8 mt-2">
                                            <span id="t_no_mop">: -</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group row sel2">
                                        <label for="id_insurer" class="col-sm-4 col-form-label text-left">Asuransi</label>
                                        <div class="col-sm-8 mt-2">
                                            <span id="t_asuransi">: -</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <h4>Type of Business</h4><hr>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group row sel2">
                                        <label for="id_insurer" class="col-sm-4 col-form-label text-left">COB</label>
                                        <div class="col-sm-8 mt-2">
                                            <span id="t_cob">: -</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group row sel2">
                                        <label for="id_insurer" class="col-sm-4 col-form-label text-left">LOB</label>
                                        <div class="col-sm-8 mt-2">
                                            <span id="t_lob">: -</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        <h4>Insured</h4><hr>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group row sel2">
                                    <label for="id_pengguna_tertanggung" class="col-sm-4 col-form-label text-left">Nama Tertanggung</label>
                                    <div class="col-sm-8">
                                        <input type="hidden" id="aksi_ptg" name="aksi_ptg">
                                        <select name="id_pengguna_tertanggung" id="id_pengguna_tertanggung" class="select2" required data-parsley-required-message="Nama tertanggung harus terisi." onchange="detail_pengguna_ttg(this.value)">
                                            <option value="">Pilih</option>
                                            <?php foreach ($pengguna_ttg as $n): ?>
                                                <option value="<?= $n['id_pengguna_tertanggung'] ?>" <?= ($list['id_pengguna_tertanggung'] == $n['id_pengguna_tertanggung']) ? 'selected' : '' ?>><?= $n['nama'] ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row detail_pengguna_ttg" style="display: none;">
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label for="nik" class="col-sm-4 col-form-label text-left">NIK</label>
                                    <div class="col-sm-8 mt-2 detail_ptg_det">
                                        <input type="hidden" id="nik">
                                        <span id="t_nik">: </span>
                                    </div>
                                    <div class="col-sm-8 detail_ptg" style="display: none;">
                                        <input type="text" class="form-control isi_detail_ptg" name="nik_ptg" required data-parsley-required-message="NIK harus terisi." placeholder="Masukkan NIK">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="nama" class="col-sm-4 col-form-label text-left">Nama</label>
                                    <div class="col-sm-8 mt-2 detail_ptg_det">
                                        <span id="t_nama">: </span>
                                    </div>
                                    <div class="col-sm-8 detail_ptg" style="display: none;">
                                        <input type="text" class="form-control isi_detail_ptg" name="nama_ptg" required data-parsley-required-message="Nama harus terisi.">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="tempat_lahir" class="col-sm-4 col-form-label text-left">Tempat Lahir</label>
                                    <div class="col-sm-8 mt-2 detail_ptg_det">
                                        <span id="t_tempat_lahir">: </span>
                                    </div>
                                    <div class="col-sm-8 detail_ptg" style="display: none;">
                                        <input type="text" class="form-control isi_detail_ptg" name="tempat_lahir_ptg" required data-parsley-required-message="Tempat lahir harus terisi." placeholder="Masukkan tempat lahir">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="tgl_lahir" class="col-sm-4 col-form-label text-left">Tanggal Lahir</label>
                                    <div class="col-sm-8 mt-2 detail_ptg_det">
                                        <span id="t_tgl_lahir">: </span>
                                    </div>
                                    <div class="col-sm-8 detail_ptg" style="display: none;">
                                        <input type="text" class="form-control datepicker isi_detail_ptg" name="tgl_lahir_ptg" required data-parsley-required-message="Tanggal lahir harus terisi." placeholder="Masukkan tanggal lahir">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="tgl_lahir" class="col-sm-4 col-form-label text-left">Jenis Kelamin</label>
                                    <div class="col-sm-8 mt-2 detail_ptg_det">
                                        <span id="t_jenis_kelamin">: </span>
                                    </div>
                                    <div class="col-sm-8 detail_ptg" style="display: none;">

                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input class="custom-control-input" type="radio" name="jenis_klm_ptg" id="jenis_klm_ptg_1" value="1" checked>
                                            <label class="custom-control-label" for="jenis_klm_ptg_1">Laki-laki</label>
                                        </div>
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input class="custom-control-input" type="radio" name="jenis_klm_ptg" id="jenis_klm_ptg_2" value="0">
                                            <label class="custom-control-label" for="jenis_klm_ptg_2">Perempuan</label>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label for="tgl_lahir" class="col-sm-4 col-form-label text-left">Alamat</label>
                                    <div class="col-sm-8 mt-2 detail_ptg_det">
                                        <span id="t_alamat">: </span>
                                    </div>
                                    <div class="col-sm-8 detail_ptg" style="display: none;">
                                        <textarea name="alamat_ptg" id="alamat_ptg" rows="5" class="form-control isi_detail_ptg" required data-parsley-required-message="Alamat harus terisi." placeholder="Masukkan alamat"></textarea>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="tgl_lahir" class="col-sm-4 col-form-label text-left">No Telepon</label>
                                    <div class="col-sm-8 mt-2 detail_ptg_det">
                                        <span id="t_telp">: </span>
                                    </div>
                                    <div class="col-sm-8 detail_ptg" style="display: none;">
                                        <input type="text" class="form-control numeric isi_detail_ptg" name="telp_ptg" required data-parsley-required-message="No Telp harus terisi.">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="tgl_lahir" class="col-sm-4 col-form-label text-left">Pekerjaan</label>
                                    <div class="col-sm-8 mt-2 detail_ptg_det">
                                        <span id="t_pekerjaan">: </span>
                                    </div>
                                    <div class="col-sm-8 sel2 detail_ptg" style="display: none;">
                                        <select name="pekerjaan_ptg" id="pekerjaan_ptg" class="select2 isi_detail_ptg" required data-parsley-required-message="Pekerjaan harus terisi.">
                                            <option value="">Pilih</option>
                                            <?php foreach ($pekerjaan as $pk): ?>
                                                <option value="<?= $pk['id_pekerjaan'] ?>"><?= $pk['pekerjaan'] ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="tgl_lahir" class="col-sm-4 col-form-label text-left">Email</label>
                                    <div class="col-sm-8 mt-2 detail_ptg_det">
                                        <span id="t_email">: </span>
                                    </div>
                                    <div class="col-sm-8 detail_ptg" style="display: none;">
                                        <input type="text" class="form-control isi_detail_ptg" name="email_ptg" required data-parsley-required-message="Email harus terisi.">
                                    </div>
                                </div>
                            </div>
                        </div>
                            
                            <!-- <h4>Type of Business</h4><hr>
                            <div class="row">
                            
                                <div class="col-md-6">
                                    <div class="form-group row sel2">
                                        <label for="no_klaim" class="col-sm-4 col-form-label">Produk</label>
                                        <div class="col-sm-8">
                                            <select name="id_lob" id="id_lob" class="select2" disabled required data-parsley-required-message="Produk harus terisi.">
                                            <option value="">Pilih Produk</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group row sel2">
                                        <label for="no_klaim" class="col-sm-4 col-form-label">Premi</label>
                                        <div class="col-sm-8">
                                            <select name="premi" id="premi" class="select2" disabled required data-parsley-required-message="Premi harus terisi.">
                                            <option value="">Pilih Premi</option>
                                            
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            
                            </div> -->
                        </div>
                        
                    </div>
                    <div class="tab-pane p-3" id="t_detail" role="tabpanel">
                        
                        <div class="f_ahli_waris" style="display: none;">

                            <?php foreach ($ahli_waris as $h): 
                                
                                $i = $h['ahli_waris_ke'];
                                
                                ?>

                                <h4>Ahli Waris <?= $i ?></h4><hr>
                                <div class="row">
                                    <div class="col-md-12">
                                        
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input class="custom-control-input status_kk" status_kk="<?= $i ?>" type="radio" name="status_kk_<?= $i ?>" id="status_kk_1<?= $i ?>" value="1" <?= ($h['status'] == 'kk') ? 'checked' : '' ?> >
                                            <label class="custom-control-label" for="status_kk_1<?= $i ?>">KK</label>
                                        </div>
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input class="custom-control-input status_kk" status_kk="<?= $i ?>" type="radio" name="status_kk_<?= $i ?>" id="status_kk_2<?= $i ?>" value="0" <?= ($h['status'] == 'non kk') ? 'checked' : '' ?>>
                                            <label class="custom-control-label" for="status_kk_2<?= $i ?>">Non KK</label>
                                        </div>

                                    </div>
                                    <div class="col-md-6">
                                        
                                        <div class="form-group row">
                                            <label for="nik_aw_<?= $i ?>" class="col-sm-4 col-form-label text-left">NIK</label>
                                            <div class="col-sm-8">
                                                <input type="text" id="nik_aw_<?= $i ?>" name="nik_aw_<?= $i ?>" class="form-control numeric nik_aw" placeholder="Masukkan NIK" required data-parsley-required-message="NIK harus terisi." value="<?= $h['nik'] ?>">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="nama_aw_<?= $i ?>" class="col-sm-4 col-form-label text-left">Nama</label>
                                            <div class="col-sm-8">
                                                <input type="text" id="nama_aw_<?= $i ?>" name="nama_aw_<?= $i ?>" class="form-control" placeholder="Masukkan Nama" required data-parsley-required-message="Nama harus terisi." value="<?= $h['nama'] ?>">
                                            </div>
                                        </div>

                                        <?php if ($h['status'] == 'non kk') : ?>
                                            <div class="form-group row" id="alamat_<?= $i ?>">
                                                <label for="no_hp_aw_<?= $i ?>" class="col-sm-4 col-form-label text-left">Alamat</label>
                                                <div class="col-sm-8">
                                                    <textarea id="alamat_aw_<?= $i ?>" name="alamat_aw_<?= $i ?>" rows="5" class="form-control" placeholder="Masukkan Alamat" data-parsley-required-message="Alamat harus terisi." value="<?= $h['alamat'] ?>"></textarea>
                                                </div>
                                            </div>
                                        <?php endif; ?>

                                    </div>
                                    <div class="col-md-6">
                                        
                                        <div class="form-group row">
                                            <label for="no_hp_aw_<?= $i ?>" class="col-sm-4 col-form-label text-left">No HP</label>
                                            <div class="col-sm-8">
                                                <input type="text" id="no_hp_aw_<?= $i ?>" name="no_hp_aw_<?= $i ?>" class="form-control numeric" placeholder="Masukkan No HP" required data-parsley-required-message="No HP harus terisi." value="<?= $h['hp'] ?>">
                                            </div>
                                        </div>
                                        <div class="form-group row sel2">
                                            <label for="id_hubungan_klg_aw_<?= $i ?>" class="col-sm-4 col-form-label text-left">Hubungan</label>
                                            <div class="col-sm-8">
                                                <select name="id_hubungan_klg_aw_<?= $i ?>" id="id_hubungan_klg_aw_<?= $i ?>" class="select2 id_hubungan_klg_aw" required data-parsley-required-message="Hubungan Keluarga harus terisi.">
                                                    <option value="">Pilih</option>
                                                    <?php foreach ($hubungan_klg as $k): ?>
                                                        <option value="<?= $k['id'] ?>" <?= ($h['hubungan'] == $k['id']) ? 'selected' : '' ?> ><?= $k['hubungan_klg'] ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            <?php endforeach; ?>

                        </div>
                    </div>

                    <div class="tab-pane p-3" id="t_dokumen" role="tabpanel">
                            
                        <!-- <form id="form_dokumen"> -->
                            <input type="hidden" id="aksi_dok" name="aksi_dok" value="edit">
                            <input type="hidden" class="aksi" id="aksi" name="aksi" value="Tambah">
                            <input type="hidden" class="id_dokumen" id="id_dokumen" name="id_dokumen">
                            <input type="hidden" class="nama_dokumen" id="nama_dokumen" name="nama_dokumen">
                            <input type="hidden" class="id_sppa id_sppa_dok" name="id_sppa" id="id_sppa_dok" value="<?= $id_sppa ?>">
                            <div class="d-flex justify-content-center mb-1 mt-3">
                                <div class="col-md-5">
                                <div class="form-group row">
                                    <label for="no_klaim" class="col-sm-2 col-form-label text-right">File</label>
                                    <div class="col-sm-10">
                                    <input type="file" id="doc" class="form-control doc" accept="application/msword, application/pdf" name="dokumen">
                                    </div>
                                </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group row">
                                    <label for="no_klaim" class="col-sm-3 col-form-label text-right">Deskripsi</label>
                                    <div class="col-sm-9">
                                        <input type="input" id="desc" class="form-control desc" name="desc" placeholder="Masukkan Deskripsi">
                                    </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group row p-0">
                                        <div class="col-sm-6">
                                            <button type="button" class="btn btn-primary btn-block simpan_dok" id="simpan_dok">Simpan</button>
                                        </div>
                                        <div class="col-sm-6">
                                            <button type="button" class="btn btn-secondary btn-block" id="batal_dok">Batal</button>
                                        </div>
                                    </div>
                                    
                                </div>
                            </div>
                            <!-- </form> -->
                            <hr>
                            <table class="mt-3 table table-bordered table-hover dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;" id="tabel_dok" width="100%" cellspacing="0">
                                <thead class="thead-light text-center">
                                    <tr>
                                        <th width="5%">No</th>
                                        <th>Description</th>
                                        <th>Filename</th>
                                        <th>Size</th>
                                        <th>Last Updated</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
                        
                    </div>

                    <div class="tab-pane p-3" id="t_premi" role="tabpanel">

                        <div class="tab-pane p-3" id="t_premi1" role="tabpanel">
                            <!-- <form action="" id="form_premi"> -->
                                <input type="hidden" class="id_sppa" name="id_sppa" id="id_sppa_premi" >
                                <h4>Premium and Payment</h4>
                                <ul class="nav nav-tabs d-flex justify-content-center mt-2" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" data-toggle="tab" href="#total_premium1" role="tab">
                                    <span class="d-none d-md-block">Total Premium</span><span class="d-block d-md-none"><i class="mdi mdi-home-variant h5"></i></span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#termin_bayar1" role="tab">
                                    <span class="d-none d-md-block">Termin Pembayaran</span><span class="d-block d-md-none"><i class="mdi mdi-account h5"></i></span>
                                    </a>
                                </li>
                                </ul>

                                <div class="tab-content">
                                    <div class="tab-pane active p-3" id="total_premium1" role="tabpanel">
                                        <input type="hidden" id="kondisi_diskon">
                                        <h4>Sum Insured and Premium</h4><hr>
                                        <!-- <p class="font-italic text-danger">*Form Input Rate (Premi Standar dan Perluasan) sesuai pilihan COB & LOB</p> <br> -->
                                        <div class="row">
                                            <!-- <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label for="no_klaim" class="col-sm-4 col-form-label">Total Sum Insured</label>
                                                    <div class="col-sm-8">
                                                        <div class="input-group mb-3">
                                                            <div class="input-group-prepend">
                                                            <span class="input-group-text" id="basic-addon1">Rp.</span>
                                                            </div>
                                                            <input type="text" class="text-right form-control number_separator numeric" id="tsi" name="tsi" placeholder="0">
                                                        </div>
                                                    </div>
                                                </div> 
                                                
                                                <div class="form-group row">
                                                    <label for="no_klaim" class="col-sm-4 col-form-label">Discount</label>
                                                    <div class="col-sm-8 input-group">
                                                        <input type="text" class="form-control text-right numeric" id="diskon" name="diskon" placeholder="Masukkan Diskon" value="0">
                                                        <div class="input-group-append">
                                                            <span class="input-group-text" id="basic-addon2">%</span>
                                                        </div>
                                                    </div>
                                                </div> 
                                                <div class="form-group row">
                                                    <div class="col-md-4"></div>
                                                    <div class="col-md-8">
                                                        <p class="font-italic text-danger label_tipe_diskon">*Diskon terhadap ...</p>
                                                    </div>
                                                </div>
                                                
                                            </div> -->
                                            <div class="col-md-6"></div>
                                            <div class="col-md-6 sel2">

                                                <div class="form-group row">
                                                    <label class="col-sm-4 col-form-label">Pilih Premi</label>
                                                    <div class="col-sm-8">
                                                        <select class="select2" name="id_tr_produksi_asuransi" id="pilih_premi" onchange="hitung_total()" required data-parsley-required-message="Premi harus terisi.">
                                                            <option value="">Pilih</option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <!-- <div class="form-group row">
                                                    <label class="col-sm-4 col-form-label">Nilai Pertanggungan Sakit</label>
                                                    <div class="col-sm-8 mt-2">
                                                        <span id=""></span>    
                                                    </div>
                                                </div> -->
                                                
                                            </div>

                                            <!-- <div class='form-group row'>
                                                <label for='no_klaim' class='col-sm-4 col-form-label'>Premi ".ucwords($c['status'])." ".$c['label']."</label>
                                                <div class='col-sm-4'>
                                                <div class='input-group'>
                                                    <input type='text' class='form-control text-right rate_all_premi persen total_premi p_persen_".$label."' value='".$c['rate']."' label='".$label."'>
                                                    <div class='input-group-append'>
                                                        <span class='input-group-text' id='basic-addon2'>%</span>
                                                    </div>
                                                </div>
                                                </div>
                                                <div class='col-sm-4'>
                                                    <input type='text' class='form-control text-right nominal_all_premi premi_".$c['status']." total_premi_rp p_total_".$label."' name='".$c['label']."' aksi='".$c['status']."' value='0' label='".$label."' id_coverage='".$c['id_coverage']."' readonly>
                                                    <input type='hidden' class='p_total_asli_".$label." premi_asli_".$c['status']."'>
                                                </div>
                                            </div> -->
                                            
                                            <div class="col-md-6" id="show_premi">

                                            </div>
                                        </div><hr>
                                        <!-- <button type="button" class="btn btn-primary mb-2" id="tambah_additional">Tambah Additional</button>
                                        <div id="show_additional" class="mt-3">
                                        
                                        </div> -->
                                        
                                        <h4>Total</h4><hr>
                                        <div class="row">
                                            <div class="col-md-6">
                                                
                                            </div>
                                            <div class="col-md-6">
                                                <!-- <div class="form-group row">
                                                    <label for="gross_premi" class="col-sm-4 col-form-label">Gross Premi</label>
                                                    <div class="col-sm-8">
                                                        <input type="text" class="form-control text-right" id="gross_premi" value="0" readonly>
                                                    </div>
                                                </div> 
                                                <div class="form-group row">
                                                    <label for="total_diskon" class="col-sm-4 col-form-label">Total Diskon</label>
                                                    <div class="col-sm-8 mb-3">
                                                        <input type="text" class="form-control text-right" id="total_diskon" value="0" readonly>
                                                    </div>
                                                </div> 
                                                <hr> -->
                                                <div class="form-group row">
                                                    <label for="no_klaim" class="col-sm-4 col-form-label">Total Akhir Premi</label>
                                                    <!-- <div class='col-sm-4'>
                                                        <div class='input-group'>
                                                        <input type='text' class='form-control text-right persen' id="total_persen_premi" value="0" readonly>
                                                        <div class='input-group-append'>
                                                            <span class='input-group-text' id='basic-addon2'>%</span>
                                                        </div>
                                                        </div>
                                                    </div> -->
                                                    <div class="col-sm-8">
                                                        <input type="text" class="form-control text-right" name="total_akhir_premi" id="total_akhir_premi" value="<?= number_format($list['total_akhir_premi'],"0",'.','.') ?>" readonly>
                                                        <input type="hidden" class="form-control text-right" id="total_akhir_premi_asli" value="0">
                                                    </div>
                                                </div> 
                                                <div class="form-group row">
                                                    <label for="no_klaim" class="col-sm-4 col-form-label">Biaya Admin</label>
                                                    <div class="col-sm-8">
                                                        <div class="input-group mb-3">
                                                            <div class="input-group-prepend">
                                                            <span class="input-group-text" id="basic-addon1">Rp.</span>
                                                            </div>
                                                            <input type="text" class="text-right form-control number_separator numeric" name="biaya_admin" id="biaya_admin" placeholder="0" value="<?= number_format($list['biaya_admin'],"0",'.','.') ?>" onkeyup="hitung_total()">
                                                        </div>
                                                    </div>
                                                </div> <hr>
                                                <div class="form-group row">
                                                    <label for="no_klaim" class="col-sm-4 col-form-label">Total Tagihan</label>
                                                    <div class="col-sm-8">
                                                        <div class="input-group mb-3">
                                                            <div class="input-group-prepend">
                                                            <span class="input-group-text" id="basic-addon1">Rp.</span>
                                                            </div>
                                                            <input type="text" name="total_tagihan" class="text-right form-control number_separator numeric" placeholder="0" id="total_tagihan" value="<?= number_format($list['total_tagihan'],"0",'.','.') ?>" readonly>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                            
                                        </div>
                                        <h4>Payment Method</h4><hr>
                                        <div class="row">
                                            <div class="col-md-5">
                                                <div class="form-group row">
                                                    <label for="no_klaim" class="col-sm-4 col-form-label">Method</label>
                                                    <div class="col-sm-8 sel2">
                                                        <select name="method" id="method" class="form-control select2" onchange="set_payment_method(this.value)" required data-parsley-required-message="Method harus terisi.">
                                                            <option value="">Pilih</option>
                                                            <?php foreach ($method as $m): ?>
                                                                <option value="<?= $m['id'] ?>" <?= ($m['id'] == $list['id_method']) ? 'selected' : '' ?>><?= $m['method'] ?></option>
                                                            <?php endforeach; ?>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-5 f_payment_method">
                                                <div class="form-group row">
                                                    <label for="no_klaim" class="col-sm-4 col-form-label">Payment Method</label>
                                                    <div class="col-sm-8 sel2">
                                                        <select name="payment_method" id="payment_method" class="form-control select2" required data-parsley-required-message="Payment Method harus terisi.">
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-5 f_bank" style="display: none;">
                                                <div class="form-group row">
                                                    <label for="no_klaim" class="col-sm-4 col-form-label">Bank</label>
                                                    <div class="col-sm-8 sel2">
                                                        <select name="bank" id="bank" class="form-control select2" data-parsley-required-message="Bank harus terisi.">
                                                            <option value="">Pilih</option>
                                                            <?php foreach ($bank as $b): ?>
                                                                <option value="<?= $b['id_bank'] ?>"><?= $b['nama_bank'] ?></option>
                                                            <?php endforeach; ?>
                                                        </select>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-3 f_pay" style="display: none;">
                                                <div class="form-group row">
                                                    <label for="no_klaim" class="col-sm-4 col-form-label">Tahun</label>
                                                    <div class="col-sm-8">
                                                        <input type="text" class="text-center form-control tahun numeric" id="tahun_pay" placeholder="Tahun">
                                                    </div>
                                                </div> 
                                            </div>
                                            <div class="col-md-4 f_pay" style="display: none;">
                                                <div class="form-group row">
                                                    <label for="no_klaim" class="col-sm-4 col-form-label">Jumlah Cicilan</label>
                                                    <div class="col-sm-7">
                                                        <input type="text" class="text-center form-control cicilan numeric" id="jumlah_cicilan" placeholder="Cicilan">
                                                    </div>
                                                </div> 
                                            </div>
                                            
                                    </div>
                                
                                    </div>
                                    <div class="tab-pane p-3" id="termin_bayar1" role="tabpanel">
                                        <input type="hidden" id="number_termin" value="1">
                                        <button type="button" class="btn btn-primary float-left ml-3 mb-3" id="tambah_pembayaran">Tambah Pembayaran</button>
                                        <table class="table table-bordered table-hover dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%; display: none;" id="tabel_termin_en" width="100%" cellspacing="0">
                                            <thead class="thead-light text-center">
                                                <tr>
                                                <th width="5%">No</th>
                                                <th>No. Dokumen</th>
                                                <th>Tanggal Bayar</th>
                                                <th>Jumlah</th>
                                                <th>Cara Bayar</th>
                                                <th>Tanggal Terima</th>
                                                <th>Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody id="show_termin">
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <!-- <hr>
                                <div class="form-group row float-right mb-0">
                                    <button type="button" class="btn btn-primary mr-2" id="simpan_premi"><i class="ti-check-box mr-2"></i>Simpan & Lanjutkan</button>
                                </div> -->
                                <br>
                                <hr>
                                <div class="form-group row float-right mb-0">
                                    <!-- <div class="row">
                                        <div class="col-md-6">

                                        </div>
                                        <div class="col-md-6 d-flex justify-content-end">
                                        <button type="button" class="btn btn-primary simpan_semua" aksi="t_released1"><i class="fas fa-check mr-2"></i>Selesai</button>
                                        </div>
                                    </div> -->
                                    <!-- <button type="button" class="btn btn-primary simpan_semua" aksi="t_released1"><i class="fas fa-check mr-2"></i>Selesai</button> -->
                                </div>
                            <!-- </form> -->
                        </div>

                        <!-- <h4>Premium and Payment</h4><hr>
                        <div class="d-flex justify-content-center">
                            <div class="col-md-8">

                                

                            </div>
                        </div>
                        <h4>Payment Method</h4><hr>
                        <?php foreach ($method as $m): 
                            $payment = $this->entry_sppa->cari_data_order('m_payment_method', ['id_method' => $m['id']], 'id', 'asc')->result_array();
                            ?>
                            <h5><?= $m['method'] ?></h5>
                            <div class="sel2">
                                <?php foreach ($payment as $p): ?>
                                    
                                    <div class="custom-control custom-radio custom-control-inline mt-3">
                                        <input class="custom-control-input" type="radio" name="pilihan_payment" id="pilihan<?= $p['id'] ?>" value="<?= $p['id'] ?>" required data-parsley-required-message="Payment Method harus terisi.">
                                        <label class="custom-control-label" for="pilihan<?= $p['id'] ?>"><?= $p['nama'] ?></label>
                                    </div>

                                <?php endforeach; ?>
                            </div>

                        <?php endforeach; ?> -->
                    </div>
                </div>
                
            </div>
            <div class="card-footer"> 
                <!-- <button type="button" id="reset_entry" class="btn btn-secondary float-right"><i class="fas fa-undo-alt mr-2"></i>Reset</button> -->
                <button type="submit" id="simpan_entry" class="btn btn-primary float-right mr-2"><i class="fas fa-check mr-2"></i>Simpan</button>
            </form>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript" src="https://app.midtrans.com/snap/snap.js" data-client-key="Mid-client-oG_YyT5S1GuJahMf"></script>

<?php $this->load->view('js'); ?>