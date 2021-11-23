<!-- Page-Title -->
<!-- <div class="page-title-box">
    <div class="row align-items-center">
        <div class="col-sm-6">
            <h4><?php //echo $title ?></h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-right">
                <li class="breadcrumb-item"><a href="<?php //echo base_url() ?>">AJK</a></li>
                <li class="breadcrumb-item">Polis</li>
                <li class="breadcrumb-item active">Detail <?php //echo $title ?></li>
            </ol>
        </div>
    </div>
</div> -->


<div class="row">
    <div class="col-md-12">
        
        <div class="card shadow f_detail">
            <div class="card-header">
                <?php //if ($aksi == ''){ ?>
                    <!-- <a href="<?= base_url('ajk/polis') ?>"><button class="btn btn-primary float-right"><i class="ti-arrow-left mr-2"></i>Kembali</button></a> -->
                <?php //}else{ ?>
                    <a href=""><button class="btn btn-primary float-right" onClick="refresh"><i class="ti-arrow-left mr-2"></i>Kembali</button></a>
                <?php //} ?>
                
                
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
                                        Click Verifikasi untuk melakukan Verifikasi Aplikasi Polis <button class="btn btn-warning ml-2 text-dark" id="singleverifikasi">Verifikasi</button>
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
                            <label for="alamatrumah" class="col-sm-3 col-form-label">Alamat</label>
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
                            <label for="label" class="col-sm-3 col-form-label">Produk</label>
                            <div class="col-sm-9 mt-1">
                                <span>: <span class="label"></span></span>
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
                        <div class="form-group row">
                            <label for="alokasi" class="col-sm-3 col-form-label">Alokasi Asuransi</label>
                            <div class="col-sm-9 mt-1">
                                <span>: <span class="alokasi"></span></span>
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
    
    // function singleverifikasi(id) {
        $('#singleverifikasi').click(function(){
            var data_verifikasi = [];
			var id_polis        = $('#id_polis').val();
            $('.check').each(function(k,obj){
                if (obj.checked){
                    data_verifikasi.push(obj.value);
                }
            });

            $.ajax({
                type:"POST",
                url:"<?php echo base_url(); ?>ajk/polis/singleverifikasi/" + id,
                dataType:"json",
                data:{
                    ver:data_verifikasi
                },
                success  : function (data) {
                swal({
                title             : "Berhasil",
                text              : "Data Telah Di Verifikasi",
                type              : 'success',
                showConfirmButton : false,
                timer             : 1000
                });
                table_jenis.ajax.reload();
                return true;
            },
            error: function (jqXHR, textStatus, errorThrown) {
                swal({
                title             : "Peringatan",
                text              : "Koneksi Tidak Terhubung",
                type              : 'warning',
                showConfirmButton : false,
                timer             : 1000
                });
                return false;
            },
            });
        });
    // }
});
</script>