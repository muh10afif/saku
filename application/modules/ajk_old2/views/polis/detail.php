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
        
        <div class="card shadow f_detail">
            <div class="card-header">
                <?php if ($aksi == '') : ?>
                    <a href="<?= base_url('ajk/polis') ?>"><button class="btn btn-primary float-right"><i class="ti-arrow-left mr-2"></i>Kembali</button></a>
                <?php elseif ($aksi == 'cetak') : ?>
                    <a href="<?= base_url('ajk/polis/cetak') ?>"><button class="btn btn-primary float-right"><i class="ti-arrow-left mr-2"></i>Kembali</button></a>
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
                        
					<input type="hidden" name="idpolis" id="idpolis" value="">
                        
                        <div class="form-group row">
                            <label for="namacabangbank" class="col-sm-3 col-form-label">Cabang Bank</label>
                            <div class="col-sm-9 mt-1">
                                <span>: <span class="namacabangbank"></span></span>
                            </div>
                        </div> 
                        <div class="form-group row">
                            <label for="namanasabah" class="col-sm-3 col-form-label">Nama Nasabah</label>
                            <div class="col-sm-9 mt-1">
                                <span>: <span class="namanasabah"></span></span>
                            </div>
                        </div>  
                        <div class="form-group row">
                            <label for="tgllahir" class="col-sm-3 col-form-label">Tanggal Lahir</label>
                            <div class="col-sm-9 mt-1">
                                <span>: <span class="tgllahir"></span></span>
                            </div>
                        </div> 
                        <div class="form-group row">
                            <label for="tempatdinas" class="col-sm-3 col-form-label">Tempat Dinas</label>
                            <div class="col-sm-9 mt-1">
                                <span>: <span class="tempatdinas"></span></span>
                            </div>
                        </div> 
                        <div class="form-group row">
                            <label for="alamatrumah" class="col-sm-3 col-form-label">Alamat Rumah</label>
                            <div class="col-sm-9 mt-1">
                                <span>: <span class="alamatrumah"></span></span>
                            </div>
                        </div> 
                        <div class="form-group row">
                            <label for="tglmulai" class="col-sm-3 col-form-label">Tanggal Mulai</label>
                            <div class="col-sm-9 mt-1">
                                <span>: <span class="tglmulai"></span></span>
                            </div>
                        </div> 
                        <div class="form-group row">
                            <label for="lamabulan" class="col-sm-3 col-form-label">Lama (Bulan)</label>
                            <div class="col-sm-9 mt-1">
                                <span>: <span class="lamabulan"></span> Bulan</span>
                            </div>
                        </div> 
                        <div class="form-group row">
                            <label for="produk" class="col-sm-3 col-form-label">Produk</label>
                            <div class="col-sm-9 mt-1">
                                <span>: <span class="produk"></span></span>
                            </div>
                        </div> 
                        <div class="form-group row">
                            <label for="ratepremi" class="col-sm-3 col-form-label">Rate Premi</label>
                            <div class="col-sm-9 mt-1">
                                <span>: <span class="ratepremi"></span></span>
                            </div>
                        </div> 
                        <div class="form-group row">
                            <label for="nilaibiaya" class="col-sm-3 col-form-label">Nilai Pembiayaan</label>
                            <div class="col-sm-9 mt-1">
                                <span>: <span class="nilaibiaya"></span></span>
                            </div>
                        </div> 
                        <div class="form-group row">
                            <label for="premis" class="col-sm-3 col-form-label">Premi</label>
                            <div class="col-sm-9 mt-1">
                                <span>: <span class="premis"></span></span>
                            </div>
                        </div> 
                        <div class="form-group row">
                            <label for="premifax" class="col-sm-3 col-form-label">Premi Fax</label>
                            <div class="col-sm-9 mt-1">
                                <span>: <span class="premifax"></span></span>
                            </div>
                        </div> 
                        <div class="form-group row">
                            <label for="premirekkoran" class="col-sm-3 col-form-label">Premi Rekening Koran</label>
                            <div class="col-sm-9 mt-1">
                                <span>: <span class="premirekkoran"></span></span>
                            </div>
                        </div> 
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<script>
$(document).ready(function(){ 
    
});
</script>