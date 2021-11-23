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
                    <a href="<?= base_url('polis') ?>"><button class="btn btn-primary float-right"><i class="ti-arrow-left mr-2"></i>Kembali</button></a>
                <?php elseif ($aksi == 'cetak') : ?>
                    <a href="<?= base_url('polis/cetak') ?>"><button class="btn btn-primary float-right"><i class="ti-arrow-left mr-2"></i>Kembali</button></a>
                <?php endif; ?>
                
                
                <h5 id="judul" class="mb-0 mt-1"><i class="ti-menu-alt mr-2"></i>Form Detail</h5>
            </div>
            <div class="card-body table-responsive">

                <div class="d-flex justify-content-center">
                    
                    <div class="col-md-10">
                        <div class="alert alert-primary" role="alert">
                            <div class="form-group row mb-0">
                                <label for="cabang" class="col-sm-3 col-form-label"></label>
                                <div class="col-sm-9">
                                    <?php if ($aksi == '') : ?>
                                        Click Verifikasi untuk melakukan Verifikasi Aplikasi Polis <button class="btn btn-warning ml-2 text-dark">Verifikasi</button>
                                    <?php elseif ($aksi == 'cetak') : ?>
                                        Click Cetak untuk melakukan Cetak Sertifikat Aplikasi Polis <button class="btn btn-warning ml-2 text-dark">Cetak</button>
                                    <?php endif; ?>
                                
                                </div>
                            </div> 
                        </div>
                        
                        <div class="form-group row">
                            <label for="cabang" class="col-sm-3 col-form-label">Cabang Bank</label>
                            <div class="col-sm-9 mt-1">
                                <span class="t_cabang">: cabang bank</span>
                            </div>
                        </div> 
                        <div class="form-group row">
                            <label for="nm_nasabah" class="col-sm-3 col-form-label">Nama Nasabah</label>
                            <div class="col-sm-9 mt-1">
                            <span class="t_nama_nasabah">: nama nasabah</span>
                            </div>
                        </div>  
                        <div class="form-group row">
                            <label for="tgl_lahir" class="col-sm-3 col-form-label">Tanggal Lahir</label>
                            <div class="col-sm-9 mt-1">
                                <span class="t_tgl_lahir">: dd-MM-YYYY</span>
                            </div>
                        </div> 
                        <div class="form-group row">
                            <label for="tempat_dinas" class="col-sm-3 col-form-label">Tempat Dinas</label>
                            <div class="col-sm-9 mt-1">
                                <span class="t_tempat_dinas">: tempat dinas</span>
                            </div>
                        </div> 
                        <div class="form-group row">
                            <label for="alamat_rumah" class="col-sm-3 col-form-label">Alamat Rumah</label>
                            <div class="col-sm-9 mt-1">
                                <span class="t_alamat_rumah">: alamat rumah</span>
                            </div>
                        </div> 
                        <div class="form-group row">
                            <label for="tgl_mulai" class="col-sm-3 col-form-label">Tanggal Mulai</label>
                            <div class="col-sm-9 mt-1">
                                <span class="t_tgl_lahir">: dd-MM-YYYY</span>
                            </div>
                        </div> 
                        <div class="form-group row">
                            <label for="lama_bulan" class="col-sm-3 col-form-label">Lama (Bulan)</label>
                            <div class="col-sm-9 mt-1">
                                <span class="t_lama_bulan">: 5 Bulan</span>
                            </div>
                        </div> 
                        <div class="form-group row">
                            <label for="produk" class="col-sm-3 col-form-label">Produk</label>
                            <div class="col-sm-9 mt-1">
                                <span class="t_produk">: produk</span>
                            </div>
                        </div> 
                        <div class="form-group row">
                            <label for="rate_premi" class="col-sm-3 col-form-label">Rate Premi</label>
                            <div class="col-sm-9 mt-1">
                                <span class="t_rate_premi">: rate premi</span>
                            </div>
                        </div> 
                        <div class="form-group row">
                            <label for="nilai_pembiayaan" class="col-sm-3 col-form-label">Nilai Pembiayaan</label>
                            <div class="col-sm-9 mt-1">
                                <span class="t_nilai_pembiayaan">: nilai pembiayaan</span>
                            </div>
                        </div> 
                        <div class="form-group row">
                            <label for="premi" class="col-sm-3 col-form-label">Premi</label>
                            <div class="col-sm-9 mt-1">
                                <span class="t_premi">: premi</span>
                            </div>
                        </div> 
                        <div class="form-group row">
                            <label for="premi_fax" class="col-sm-3 col-form-label">Premi Fax</label>
                            <div class="col-sm-9 mt-1">
                                <span class="t_premi_fax">: premi fax</span>
                            </div>
                        </div> 
                        <div class="form-group row">
                            <label for="premi_koran" class="col-sm-3 col-form-label">Premi Rekening Koran</label>
                            <div class="col-sm-9 mt-1">
                                <span class="t_premi_koran">: premi rekening koran</span>
                            </div>
                        </div> 
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>