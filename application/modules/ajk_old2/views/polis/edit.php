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
                <li class="breadcrumb-item active">Edit <?= $title ?></li>
            </ol>
        </div>
    </div>
</div>

<div class="card shadow">
            <div class="card-header">
                <a href="<?= base_url('ajk/polis') ?>"><button class="btn btn-primary float-right" id="tambah_data"><i class="ti-arrow-left mr-2"></i>Kembali</button></a>
                <h5 id="judul" class="mb-0 mt-1"><i class="ti-plus mr-2"></i>Form Edit Polis</h5>
            </div>
            <div class="card-body table-responsive">

                <div class="d-flex justify-content-center">
                    
                    <div class="col-md-10">
                        <div class="form-group">
                            <mark><span class="text-danger">*</span> Mandatory (Harus diisi)</mark>
                        </div>
                        
					<input type="hidden" name="id_polis" id="id_polis" value="">
                        <div class="form-group row">
                            <label for="idcabangbank" class="col-sm-3 col-form-label">Cabang Bank <span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <select name="idcabangbank" id="idcabangbank" class="select2" require>
                                    <option value="">-- Pilih Cabang --</option>
                                    <?php foreach ($list_bank as $bank) { ?>
										<option value="<?php echo $bank->id_cabang_bank; ?>">
										<?php echo $bank->nama_cabang_bank; ?></option>
								    <?php } ?>
                                </select>
                            </div>
                        </div> 
                        <div class="form-group row">
                            <label for="id_nasabah" class="col-sm-3 col-form-label">Nama Nasabah <span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <!-- <input class="form-control" type="text" id="id_nasabah" placeholder="Masukkan Nama Nasabah"> -->
                                <select name="id_nasabah" id="id_nasabah" class="select2" require>
                                    <option value="">-- Pilih Nasabah --</option>
                                    <?php foreach ($nasabah as $nb) { ?>
										<option value="<?php echo $nb->id_nasabah; ?>">
										<?php echo $nb->nama_nasabah; ?></option>
								    <?php } ?>
                                </select>
                            </div>
                        </div>  
                        <div class="form-group row">
                            <label for="tgl_lahir" class="col-sm-3 col-form-label">Tanggal Lahir <span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <div class="input-group">
                                    <input type='text' name="tgl_lahir" id="tgl_lahir" class="form-control datepicker text-center" readonly placeholder="Pilih Tanggal" readonly>
                                    <div class="input-group-append">
                                        <span class="input-group-text">
                                            <span class="ti-calendar"></span>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div> 
                        <div class="form-group row">
                            <label for="tempat_dinas" class="col-sm-3 col-form-label">Tempat Dinas</label>
                            <div class="col-sm-9">
                                <textarea name="tempat_dinas" id="tempat_dinas" class="form-control" rows="2" placeholder="Masukkan Tempat Dinas" readonly></textarea>
                            </div>
                        </div> 
                        <div class="form-group row">
                            <label for="alamat_rumah" class="col-sm-3 col-form-label">Alamat Rumah</label>
                            <div class="col-sm-9">
                                <textarea name="alamat_rumah" id="alamat_rumah" class="form-control" rows="2" placeholder="Masukkan Alamat Rumah" readonly></textarea>
                            </div>
                        </div> 
                        <div class="form-group row">
                            <label for="tgl_mulai" class="col-sm-3 col-form-label">Tanggal Mulai <span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <div class="input-group">
                                    <input type='text' name="tgl_mulai" id="tgl_mulai" class="form-control datepicker text-center" readonly placeholder="Pilih Tanggal">
                                    <div class="input-group-append">
                                        <span class="input-group-text">
                                            <span class="ti-calendar"></span>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div> 
                        <div class="form-group row">
                            <label for="lama_bulan" class="col-sm-3 col-form-label">Lama (Bulan) <span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <input class="form-control" type="text" id="lama_bulan" placeholder="Masukkan Lama Bulan">
                            </div>
                        </div> 
                        <div class="form-group row">
                            <label for="produk" class="col-sm-3 col-form-label">Produk <span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                    <select name="produk" id="produk" class="select2" require>
                                        <option value="">-- Pilih Produk --</option>
                                        <?php foreach ($coverage as $pd) { ?>
                                            <option value="<?php echo $pd->id_coverage; ?>">
                                            <?php echo $pd->label; ?></option>
                                        <?php } ?>
                                    </select>
                            </div>
                        </div> 
                        <div class="form-group row">
                            <label for="rate_premi" class="col-sm-3 col-form-label">Rate Premi<span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <input class="form-control" type="text" id="rate_premi" placeholder="Masukkan Rate Premi" value="">
                            </div>
                        </div> 
                        <div class="form-group row">
                            <label for="nilai_pembiayaan" class="col-sm-3 col-form-label">Nilai Pembiayaan<span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <input class="form-control" type="text" id="nilai_pembiayaan" placeholder="Masukkan Nilai Pembiayaan">
                            </div>
                        </div> 
                        <div class="form-group row">
                            <label for="premi" class="col-sm-3 col-form-label">Premi</label>
                            <div class="col-sm-9">
                                <input class="form-control" type="text" id="premi" value="0" readonly>
                            </div>
                        </div> 
                        <div class="form-group row">
                            <label for="premi_fax" class="col-sm-3 col-form-label">Premi Fax<span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <input class="form-control" type="text" id="premi_fax" placeholder="Masukkan Premi Fax">
                            </div>
                        </div> 
                        <div class="form-group row">
                            <label for="premi_rek_koran" class="col-sm-3 col-form-label">Premi Rekening Koran</label>
                            <div class="col-sm-9">
                                <input class="form-control" type="text" id="premi_rek_koran" placeholder="Masukkan Premi Rekening Koran">
                            </div>
                        </div> 
                    </div>
                </div>

            </div>
            <div class="card-footer">
                <div class="row">
                    <div class="col-md-12 d-flex justify-content-end">
                    <button type="button" id="senddataedit" class="btn btn-primary mr-2"><i class="ti-check-box mr-2"></i>Simpan</button>
                    <button type="button" id="btn-reset" tgl="<?= date('d-m-Y', now('Asia/Jakarta')) ?>" class="btn btn-danger"><i class="ti-na mr-2"></i>Reset</button>
                    </div>
                </div>
            </div>
        </div>

<script>        
$(document).ready(function(){
        $('#id_nasabah').on("change",function(){
            var nasabahid = $(this).val();
            $.ajax({
                url:"<?php echo base_url(); ?>ajk/polis/getnasabah?nasabahid="+nasabahid,
                type:"get",
                dataType : "JSON",
                success : function(hasil){
                    $('#tgl_lahir').val(hasil.tgl_lahir);
                    $('#tempat_dinas').val(hasil.tempat_dinas);
                    $('#alamat_rumah').val(hasil.alamat_rumah);
                }
            });

        });
})
</script>