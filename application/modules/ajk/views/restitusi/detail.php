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
                <li class="breadcrumb-item active">Detail <?= $title ?></li>
            </ol>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        
        <div class="card shadow">
            <div class="card-header">

                <?php if ($aksi == '') : ?>
                    <a href="<?= base_url('ajk/restitusi') ?>"><button class="btn btn-primary float-right"><i class="ti-arrow-left mr-2"></i>Kembali</button></a>
                <?php elseif ($aksi == 'cetak') : ?>
                    <a href="<?= base_url('ajk/restitusi/cetak') ?>"><button class="btn btn-primary float-right"><i class="ti-arrow-left mr-2"></i>Kembali</button></a>
                <?php endif; ?>
                
                <h5 id="judul" class="mb-0 mt-1"><i class="ti-menu-alt mr-2"></i>Form Detail</h5>
            </div>
            <div class="card-body table-responsive">

                        <div class="alert alert-primary" role="alert">
                            <div class="form-group row mb-0">
                                <label for="cabang" class="col-sm-4 col-form-label"></label>
                                <div class="col-sm-8">

                                    <?php if ($aksi == '') : ?>
                                        Klik Verifikasi untuk melakukan Verifikasi Restitusi <button class="btn btn-warning ml-2 text-dark">Verifikasi</button>
                                    <?php elseif ($aksi == 'cetak') : ?>
                                        Klik Cetak untuk melakukan Cetak Nota Restitusi <button class="btn btn-warning ml-2 text-dark">Cetak</button>
                                    <?php endif; ?>
                                </div>
                            </div> 
                        </div>
                <div class="d-flex justify-content-center">
                    
                    <div class="col-md-10">
                        
                        <h4>Detail Data Restitusi</h4>
                        <hr>

                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">No Restitusi</label>
                            <div class="col-sm-8 mt-1">
                                <span>: <span class="norestitusi"></span></span>
                            </div>
                        </div> 
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">No Polis</label>
                            <div class="col-sm-8 mt-1">
                                <span>: <span class="nopolis"></span></span>
                            </div>
                        </div> 
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Keterangan</label>
                            <div class="col-sm-8 mt-1">
                                <span>: <span class="keterangan"></span></span>
                            </div>
                        </div> 
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Tanggal Lapor</label>
                            <div class="col-sm-8 mt-1">
                                <span>: <span class="tgl_lapor"></span></span>
                            </div>
                        </div> 
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Tanggal Restitusi</label>
                            <div class="col-sm-8 mt-1">
                                <span>: <span class="tgl_restitusi"></span></span>
                            </div>
                        </div> 
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Tanggal Pelunasan</label>
                            <div class="col-sm-8 mt-1">
                                <span>: <span class="tgl_pelunasan"></span></span>
                            </div>
                        </div> 
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Tanggal Kirim Dokumen</label>
                            <div class="col-sm-8 mt-1">
                                <span>: <span class="tgl_kirim_dok"></span></span>
                            </div>
                        </div> 
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">No Rrekening Debitur</label>
                            <div class="col-sm-8 mt-1">
                                <span>: <span class="no_rek_debitur"></span></span>
                            </div>
                        </div> 
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Nilai Restitusi</label>
                            <div class="col-sm-8 mt-1">
                                <span>: <span class="nilai_restitusi"></span></span>
                            </div>
                        </div>  <br>
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Account Period</label>
                            <div class="col-sm-8 mt-1">
                                <span>: <span class="account_period"></span></span>
                            </div>
                        </div> 
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">User Input</label>
                            <div class="col-sm-8 mt-1">
                                <span>: <span class="t_user_input"></span></span>
                            </div>
                        </div> 
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Tanggal Input</label>
                            <div class="col-sm-8 mt-1">
                                <span>: <span class="tgl_input"></span></span>
                            </div>
                        </div> 
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">User Verifikator</label>
                            <div class="col-sm-8 mt-1">
                                <span>: <span class="tgl_input"></span></span>
                            </div>
                        </div> 
                        <h4>Detail Data Polis</h4>
                        <hr>
                        <div class="form-group row">
                            <label for="cabang" class="col-sm-4 col-form-label">Cabang Bank</label>
                            <div class="col-sm-8 mt-1">
                                <span>: <span class="namacabangbank"></span></span>
                            </div>
                        </div> 
                        <div class="form-group row">
                            <label for="namanasabah" class="col-sm-4 col-form-label">Nama Nasabah</label>
                            <div class="col-sm-8 mt-1">
                                <span>: <span class="namanasabah"></span></span>
                            </div>
                        </div>  
                        <div class="form-group row">
                            <label for="tgllahir" class="col-sm-4 col-form-label">Tanggal Lahir</label>
                            <div class="col-sm-8 mt-1">
                                <span>: <span class="tgllahir"></span></span>
                            </div>
                        </div> 
                        <div class="form-group row">
                            <label for="tempatdinas" class="col-sm-4 col-form-label">Tempat Dinas</label>
                            <div class="col-sm-8 mt-1">
                                <span>: <span class="tempatdinas"></span></span>
                            </div>
                        </div> 
                        <div class="form-group row">
                            <label for="alamatrumah" class="col-sm-4 col-form-label">Alamat Rumah</label>
                            <div class="col-sm-8 mt-1">
                                <span>: <span class="alamatrumah"></span></span>
                            </div>
                        </div> 
                        <div class="form-group row">
                            <label for="tglmulai" class="col-sm-4 col-form-label">Tanggal Mulai</label>
                            <div class="col-sm-8 mt-1">
                                <span>: <span class="tglmulai"></span></span>
                            </div>
                        </div> 
                        <div class="form-group row">
                            <label for="lama_bulan" class="col-sm-4 col-form-label">Lama (Bulan)</label>
                            <div class="col-sm-8 mt-1">
                                <span>: <span class="lamabulan"></span></span>
                            </div>
                        </div> 
                        <div class="form-group row">
                            <label for="produk" class="col-sm-4 col-form-label">Produk</label>
                            <div class="col-sm-8 mt-1">
                                <span>: <span class="produk"></span></span>
                            </div>
                        </div> 
                        <div class="form-group row">
                            <label for="rate_premi" class="col-sm-4 col-form-label">Rate Premi</label>
                            <div class="col-sm-8 mt-1">
                                <span>: <span class="ratepremi"></span></span>
                            </div>
                        </div> 
                        <div class="form-group row">
                            <label for="nilaipembiayaan" class="col-sm-4 col-form-label">Nilai Pembiayaan</label>
                            <div class="col-sm-8 mt-1">
                                <span>: <span class="nilaipembiayaan"></span></span>
                            </div>
                        </div> 
                        <div class="form-group row">
                            <label for="premis" class="col-sm-4 col-form-label">Premi</label>
                            <div class="col-sm-8 mt-1">
                                <span>: <span class="premis"></span></span>
                            </div>
                        </div> 
                        <div class="form-group row">
                            <label for="premifax" class="col-sm-4 col-form-label">Premi Fax</label>
                            <div class="col-sm-8 mt-1">
                                <span>: <span class="premifax"></span></span>
                            </div>
                        </div> 
                        <div class="form-group row">
                            <label for="no_rekening_koran" class="col-sm-4 col-form-label">Premi Rekening Koran</label>
                            <div class="col-sm-8 mt-1">
                                <span>: <span class="no_rekening_koran"></span></span>
                            </div>
                        </div> 
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>