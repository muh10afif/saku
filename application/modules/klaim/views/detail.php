<!-- Page-Title -->
<div class="page-title-box">
    <div class="row align-items-center">
        <div class="col-sm-6">
            <h4><?= $title ?></h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-right">
                <li class="breadcrumb-item"><a href="<?= base_url() ?>">AJK</a></li>
                <li class="breadcrumb-item">Polis</li>
                <li class="breadcrumb-item active"><?= $title ?></li>
            </ol>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        
        <div class="card shadow">
            <div class="card-header">

                <?php if ($aksi == '') : ?>
                    <a href="<?= base_url('klaim') ?>"><button class="btn btn-primary float-right"><i class="ti-arrow-left mr-2"></i>Kembali</button></a>
                <?php elseif ($aksi == 'cetak') : ?>
                    <a href="<?= base_url('klaim/cetak') ?>"><button class="btn btn-primary float-right"><i class="ti-arrow-left mr-2"></i>Kembali</button></a>
                <?php endif; ?>
                
                <h5 id="judul" class="mb-0 mt-1"><i class="ti-menu-alt mr-2"></i>Form Detail</h5>
            </div>
            <div class="card-body table-responsive">

                        <div class="alert alert-primary" role="alert">
                            <div class="form-group row mb-0">
                                <label for="cabang" class="col-sm-4 col-form-label"></label>
                                <div class="col-sm-8">

                                    <?php if ($aksi == '') : ?>
                                        Klik Verifikasi untuk melakukan Verifikasi Klaim <button class="btn btn-warning ml-2 text-dark">Verifikasi</button>
                                    <?php elseif ($aksi == 'cetak') : ?>
                                        Klik Cetak untuk melakukan Cetak Nota Klaim <button class="btn btn-warning ml-2 text-dark">Cetak</button>
                                    <?php endif; ?>

                                </div>
                            </div> 
                        </div>
                <div class="d-flex justify-content-center">
                    
                    <div class="col-md-10">
                        
                        <h4>Detail Klaim</h4>
                        <hr>

                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">No Klaim</label>
                            <div class="col-sm-8 mt-1">
                                <span class="t_no_klaim">: no klaim</span>
                            </div>
                        </div> 
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">No Polis</label>
                            <div class="col-sm-8 mt-1">
                                <span class="t_no_polis">: no polis</span>
                            </div>
                        </div> 
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Tipe Klaim</label>
                            <div class="col-sm-8 mt-1">
                                <span class="t_tipe_klaim">: tipe klaim</span>
                            </div>
                        </div> 
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Jenis Klaim</label>
                            <div class="col-sm-8 mt-1">
                                <span class="t_jenis_klaim">: jenis klaims</span>
                            </div>
                        </div> 
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Keterangan</label>
                            <div class="col-sm-8 mt-1">
                                <span class="t_keterangan">: keterangan</span>
                            </div>
                        </div> 
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Tanggal Lapor</label>
                            <div class="col-sm-8 mt-1">
                                <span class="t_tgl_lapor">: 22-04-2021</span>
                            </div>
                        </div> 
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Tanggal Kejadian</label>
                            <div class="col-sm-8 mt-1">
                                <span class="t_tgl_kejadian">: 22-04-2021</span>
                            </div>
                        </div> 
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">No Rrekening Debitur</label>
                            <div class="col-sm-8 mt-1">
                                <span class="t_no_rekening">: 121213232323</span>
                            </div>
                        </div> 
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Nilai Klaim</label>
                            <div class="col-sm-8 mt-1">
                                <span class="t_nilai_klaim">: 20000000</span>
                            </div>
                        </div> 
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Klasifikasi Klaim</label>
                            <div class="col-sm-8 mt-1">
                                <span class="t_klasifikasi_klaim">: JGH</span>
                            </div>
                        </div> <br>
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Account Period</label>
                            <div class="col-sm-8 mt-1">
                                <span class="t_account_period">: 3</span>
                            </div>
                        </div> 
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">User Input</label>
                            <div class="col-sm-8 mt-1">
                                <span class="t_user_input">: user</span>
                            </div>
                        </div> 
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Tanggal Input</label>
                            <div class="col-sm-8 mt-1">
                                <span class="t_tgl_input">: 22-04-2021</span>
                            </div>
                        </div> 
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">User Verifikator</label>
                            <div class="col-sm-8 mt-1">
                                <span class="t_tgl_input">: user</span>
                            </div>
                        </div> 
                        <h4>Detail Polis</h4>
                        <hr>
                        <div class="form-group row">
                            <label for="cabang" class="col-sm-4 col-form-label">Cabang Bank</label>
                            <div class="col-sm-8 mt-1">
                                <span class="t_cabang">: cabang bank</span>
                            </div>
                        </div> 
                        <div class="form-group row">
                            <label for="nm_nasabah" class="col-sm-4 col-form-label">Nama Nasabah</label>
                            <div class="col-sm-8 mt-1">
                            <span class="t_nama_nasabah">: nama nasabah</span>
                            </div>
                        </div>  
                        <div class="form-group row">
                            <label for="tgl_lahir" class="col-sm-4 col-form-label">Tanggal Lahir</label>
                            <div class="col-sm-8 mt-1">
                                <span class="t_tgl_lahir">: dd-MM-YYYY</span>
                            </div>
                        </div> 
                        <div class="form-group row">
                            <label for="tempat_dinas" class="col-sm-4 col-form-label">Tempat Dinas</label>
                            <div class="col-sm-8 mt-1">
                                <span class="t_tempat_dinas">: tempat dinas</span>
                            </div>
                        </div> 
                        <div class="form-group row">
                            <label for="alamat_rumah" class="col-sm-4 col-form-label">Alamat Rumah</label>
                            <div class="col-sm-8 mt-1">
                                <span class="t_alamat_rumah">: alamat rumah</span>
                            </div>
                        </div> 
                        <div class="form-group row">
                            <label for="tgl_mulai" class="col-sm-4 col-form-label">Tanggal Mulai</label>
                            <div class="col-sm-8 mt-1">
                                <span class="t_tgl_lahir">: dd-MM-YYYY</span>
                            </div>
                        </div> 
                        <div class="form-group row">
                            <label for="lama_bulan" class="col-sm-4 col-form-label">Lama (Bulan)</label>
                            <div class="col-sm-8 mt-1">
                                <span class="t_lama_bulan">: 5 Bulan</span>
                            </div>
                        </div> 
                        <div class="form-group row">
                            <label for="produk" class="col-sm-4 col-form-label">Produk</label>
                            <div class="col-sm-8 mt-1">
                                <span class="t_produk">: produk</span>
                            </div>
                        </div> 
                        <div class="form-group row">
                            <label for="rate_premi" class="col-sm-4 col-form-label">Rate Premi</label>
                            <div class="col-sm-8 mt-1">
                                <span class="t_rate_premi">: rate premi</span>
                            </div>
                        </div> 
                        <div class="form-group row">
                            <label for="nilai_pembiayaan" class="col-sm-4 col-form-label">Nilai Pembiayaan</label>
                            <div class="col-sm-8 mt-1">
                                <span class="t_nilai_pembiayaan">: nilai pembiayaan</span>
                            </div>
                        </div> 
                        <div class="form-group row">
                            <label for="premi" class="col-sm-4 col-form-label">Premi</label>
                            <div class="col-sm-8 mt-1">
                                <span class="t_premi">: premi</span>
                            </div>
                        </div> 
                        <div class="form-group row">
                            <label for="premi_fax" class="col-sm-4 col-form-label">Premi Fax</label>
                            <div class="col-sm-8 mt-1">
                                <span class="t_premi_fax">: premi fax</span>
                            </div>
                        </div> 
                        <div class="form-group row">
                            <label for="premi_koran" class="col-sm-4 col-form-label">Premi Rekening Koran</label>
                            <div class="col-sm-8 mt-1">
                                <span class="t_premi_koran">: premi rekening koran</span>
                            </div>
                        </div> 
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>