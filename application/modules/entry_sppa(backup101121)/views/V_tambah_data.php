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
    <div class="col-md-12">
        <div class="card shadow">
            <div class="card-header mb-0">
                <a href="<?= base_url('entry_sppa') ?>"><button class="btn btn-primary float-right"><i class="fas fa-arrow-left mr-2"></i>Kembali</button></a>
            </div>
            <div class="card-body">
                <form id="form_entry" autocomplete="off">

                <input type="hidden" name="result_type" id="result-type" value="">
                <input type="hidden" name="result_data" id="result-data" value="">

                <ul class="nav nav-tabs d-flex justify-content-center mt-2" role="tablist">
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
                                                    <option value="<?= $n['id_nasabah'] ?>"><?= $n['nama_nasabah'] ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group row sel2">
                                        <label for="id_insurer" class="col-sm-4 col-form-label text-left">No Reff MOP</label>
                                        <div class="col-sm-8">
                                            <select name="no_reff_mop" id="no_reff_mop" class="select2" required data-parsley-required-message="No Reff MOP harus terisi." onchange="get_detail_mop(this.value)">
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
                                        <select name="id_pengguna_tertanggung" id="id_pengguna_tertanggung" class="select2" required data-parsley-required-message="Nama tertanggung harus terisi.">
                                            <option value="">Pilih</option>
                                            <?php foreach ($pengguna_ttg as $n): ?>
                                                <option value="<?= $n['id_pengguna_tertanggung'] ?>"><?= $n['nama'] ?></option>
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
                                        <input type="text" class="form-control" name="nik_ptg" required data-parsley-required-message="NIK harus terisi." placeholder="Masukkan NIK">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="nama" class="col-sm-4 col-form-label text-left">Nama</label>
                                    <div class="col-sm-8 mt-2 detail_ptg_det">
                                        <span id="t_nama">: </span>
                                    </div>
                                    <div class="col-sm-8 detail_ptg" style="display: none;">
                                        <input type="text" class="form-control" name="nama_ptg" required data-parsley-required-message="Nama harus terisi.">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="tempat_lahir" class="col-sm-4 col-form-label text-left">Tempat Lahir</label>
                                    <div class="col-sm-8 mt-2 detail_ptg_det">
                                        <span id="t_tempat_lahir">: </span>
                                    </div>
                                    <div class="col-sm-8 detail_ptg" style="display: none;">
                                        <input type="text" class="form-control" name="tempat_lahir_ptg" required data-parsley-required-message="Tempat lahir harus terisi." placeholder="Masukkan tempat lahir">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="tgl_lahir" class="col-sm-4 col-form-label text-left">Tanggal Lahir</label>
                                    <div class="col-sm-8 mt-2 detail_ptg_det">
                                        <span id="t_tgl_lahir">: </span>
                                    </div>
                                    <div class="col-sm-8 detail_ptg" style="display: none;">
                                        <input type="text" class="form-control datepicker" name="tgl_lahir_ptg" required data-parsley-required-message="Tanggal lahir harus terisi." placeholder="Masukkan tanggal lahir">
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
                                        <textarea name="alamat_ptg" id="alamat_ptg" rows="5" class="form-control" required data-parsley-required-message="Alamat harus terisi." placeholder="Masukkan alamat"></textarea>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="tgl_lahir" class="col-sm-4 col-form-label text-left">No Telepon</label>
                                    <div class="col-sm-8 mt-2 detail_ptg_det">
                                        <span id="t_telp">: </span>
                                    </div>
                                    <div class="col-sm-8 detail_ptg" style="display: none;">
                                        <input type="text" class="form-control numeric" name="telp_ptg" required data-parsley-required-message="No Telp harus terisi.">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="tgl_lahir" class="col-sm-4 col-form-label text-left">Pekerjaan</label>
                                    <div class="col-sm-8 mt-2 detail_ptg_det">
                                        <span id="t_pekerjaan">: </span>
                                    </div>
                                    <div class="col-sm-8 detail_ptg" style="display: none;">
                                        <select name="pekerjaan_ptg" id="pekerjaan_ptg" class="select2">
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
                                        <input type="text" class="form-control" name="email_ptg" required data-parsley-required-message="Email harus terisi.">
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

                            <?php for ($i=1; $i <= 2; $i++) : ?>
                                <h4>Ahli Waris <?= $i ?></h4><hr>
                                <div class="row">
                                    <div class="col-md-12">
                                        
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input class="custom-control-input status_kk" status_kk="<?= $i ?>" type="radio" name="status_kk_<?= $i ?>" id="status_kk_1<?= $i ?>" value="1" checked>
                                            <label class="custom-control-label" for="status_kk_1<?= $i ?>">KK</label>
                                        </div>
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input class="custom-control-input status_kk" status_kk="<?= $i ?>" type="radio" name="status_kk_<?= $i ?>" id="status_kk_2<?= $i ?>" value="0">
                                            <label class="custom-control-label" for="status_kk_2<?= $i ?>">Non KK</label>
                                        </div>

                                    </div>
                                    <div class="col-md-6">
                                        
                                        <div class="form-group row">
                                            <label for="nik_aw_<?= $i ?>" class="col-sm-4 col-form-label text-left">NIK</label>
                                            <div class="col-sm-8">
                                                <input type="text" id="nik_aw_<?= $i ?>" name="nik_aw_<?= $i ?>" class="form-control numeric nik_aw" placeholder="Masukkan NIK" required data-parsley-required-message="NIK harus terisi.">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="nama_aw_<?= $i ?>" class="col-sm-4 col-form-label text-left">Nama</label>
                                            <div class="col-sm-8">
                                                <input type="text" id="nama_aw_<?= $i ?>" name="nama_aw_<?= $i ?>" class="form-control" placeholder="Masukkan Nama" required data-parsley-required-message="Nama harus terisi.">
                                            </div>
                                        </div>
                                        <div class="form-group row" id="alamat_<?= $i ?>" style="display: none;">
                                            <label for="no_hp_aw_<?= $i ?>" class="col-sm-4 col-form-label text-left">Alamat</label>
                                            <div class="col-sm-8">
                                                <textarea id="alamat_aw_<?= $i ?>" name="alamat_aw_<?= $i ?>" rows="5" class="form-control" placeholder="Masukkan Alamat" data-parsley-required-message="Alamat harus terisi."></textarea>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="col-md-6">
                                        
                                        <div class="form-group row">
                                            <label for="no_hp_aw_<?= $i ?>" class="col-sm-4 col-form-label text-left">No HP</label>
                                            <div class="col-sm-8">
                                                <input type="text" id="no_hp_aw_<?= $i ?>" name="no_hp_aw_<?= $i ?>" class="form-control numeric" placeholder="Masukkan No HP" required data-parsley-required-message="No HP harus terisi.">
                                            </div>
                                        </div>
                                        <div class="form-group row sel2">
                                            <label for="id_hubungan_klg_aw_<?= $i ?>" class="col-sm-4 col-form-label text-left">Hubungan</label>
                                            <div class="col-sm-8">
                                                <select name="id_hubungan_klg_aw_<?= $i ?>" id="id_hubungan_klg_aw_<?= $i ?>" class="select2 id_hubungan_klg_aw" required data-parsley-required-message="Hubungan Keluarga harus terisi.">
                                                    <option value="">Pilih</option>
                                                    <?php foreach ($hubungan_klg as $h): ?>
                                                        <option value="<?= $h['id'] ?>"><?= $h['hubungan_klg'] ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            <?php endfor ?>

                        </div>
                    </div>
                    <div class="tab-pane p-3" id="t_premi" role="tabpanel">

                        <h4>Premium and Payment</h4><hr>
                        <div class="d-flex justify-content-center">
                            <div class="col-md-8">

                                <table class="table mb-2">
                                    <thead class="text-center thead-default">
                                        <tr>
                                            <th>Produk</th>
                                            <th colspan="2">Biaya</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td id="txt_produk">Asuransi</td>
                                            <td>Rp.</td>
                                            <td id="txt_premi" align="right"></td>
                                        </tr>
                                        <tr>
                                            <td>Biaya Admin</td>
                                            <td>Rp.</td>
                                            <td id="txt_biaya_admin" align="right">0</td>
                                        </tr>
                                    </tbody>
                                    <tfoot class="thead-default">
                                        <tr>
                                            <th>Total Tagihan</th>
                                            <th>Rp.</td>
                                            <th id="txt_total" class="text-right"></th>
                                        </tr>
                                    </tfoot>
                                </table>

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

                        <?php endforeach; ?>
                    </div>
                </div>
                
            </div>
            <div class="card-footer">
                <button type="button" id="reset_entry" class="btn btn-secondary float-right"><i class="fas fa-undo-alt mr-2"></i>Reset</button>
                <button type="submit" id="simpan_entry" class="btn btn-primary float-right mr-2"><i class="fas fa-check mr-2"></i>Simpan</button>
            </form>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript" src="https://app.midtrans.com/snap/snap.js" data-client-key="Mid-client-oG_YyT5S1GuJahMf"></script>

<?php $this->load->view('js'); ?>