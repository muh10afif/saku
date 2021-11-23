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
                <a href="<?= base_url('ajk/klaim') ?>"><button class="btn btn-primary float-right" id="tambah_data"><i class="ti-arrow-left mr-2"></i>Kembali</button></a>
                <h5 id="judul" class="mb-0 mt-1"><i class="ti-plus mr-2"></i>Form Tambah</h5>
            </div>
            <div class="card-body table-responsive">

                <div class="d-flex justify-content-center">
                    <div class="col-md-10">

                    <input class="form-control" type="hidden" id="id_klaim" class="form-control">

                        <div class="form-group row mt-3">
                            <label for="cari_polis" class="col-sm-3 col-form-label">No Polis</label>
                            <div class="col-sm-7">
                                <input class="form-control" type="text" id="cari_polis" class="form-control">
                            </div>
                            <div class="col-sm-2">
                                <button class="btn btn-primary btn-block">Cari</button>
                            </div>
                        </div>

                        <div class="form-group">
                            <mark><span class="text-danger">*</span> Mandatory (Harus diisi)</mark>
                        </div>
                        <div class="form-group row">
                            <label for="id_polis" class="col-sm-3 col-form-label">No Polis<span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <!-- <input class="form-control" type="text" id="no_polis"> -->
                                <select name="id_polis" id="id_polis" class="form-control select2">
                                <option value="">-- Pilih No Polis --</option>
                                        <?php foreach ($polis as $ps2) { ?>
                                            <option value="<?php echo $ps2->id_polis; ?>">
                                            <?php echo $ps2->no_polis; ?></option>
                                        <?php } ?>
                                </select>
                            </div>
                        </div> 
                        <div class="form-group row">
                            <label for="id_tipe_klaim" class="col-sm-3 col-form-label">Tipe Klaim <span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <select name="id_tipe_klaim" id="id_tipe_klaim" class="form-control select2">
                                    <option value="">-- Pilih Tipe Klaim --</option>
                                    <?php foreach ($klaimtipe as $tk2) { ?>
                                        <option value="<?php echo $tk2->id_tipe_klaim; ?>">
                                        <?php echo $tk2->tipe_klaim; ?> </option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div> 
                        <div class="form-group row">
                            <label for="jenis_klaim" class="col-sm-3 col-form-label">Jenis Klaim <span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <select name="cabang" id="jenis_klaim" class="form-control select2">
                                        <option value="">-- Pilih Jenis Klaim --</option>
                                        <?php foreach ($jenisklaim as $jk) { ?>
                                            <option value="<?php echo $jk->id_jenis_klaim; ?>">
                                            <?php echo $jk->jenis_klaim; ?> </option>
                                        <?php } ?>
                                </select>
                            </div>
                        </div> 
                        <div class="form-group row">
                            <label for="keterangan" class="col-sm-3 col-form-label">Keterangan<span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <input class="form-control" type="text" id="keterangan" placeholder="Masukkan Keterangan">
                            </div>
                        </div>  
                        <div class="form-group row">
                            <label for="tgl_lapor" class="col-sm-3 col-form-label">Tanggal Lapor<span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <div class="input-group">
                                    <input type='text' name="tgl_lapor" id="tgl_lapor" class="form-control datepicker text-center" readonly placeholder="Pilih Tanggal">
                                    <div class="input-group-append">
                                        <span class="input-group-text">
                                            <span class="ti-calendar"></span>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div> 
                        <div class="form-group row">
                            <label for="tgl_kejadian" class="col-sm-3 col-form-label">Tanggal Kejadian<span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <div class="input-group">
                                    <input type='text' name="tgl_kejadian" id="tgl_kejadian" class="form-control datepicker text-center" readonly placeholder="Pilih Tanggal">
                                    <div class="input-group-append">
                                        <span class="input-group-text">
                                            <span class="ti-calendar"></span>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div> 
                        <div class="form-group row">
                            <label for="no_rek_debitur" class="col-sm-3 col-form-label">No Rekening Debitur<span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <input class="form-control" type="text" id="no_rek_debitur" placeholder="Masukkan No Rekening Debitur">
                            </div>
                        </div> 
                        <div class="form-group row">
                            <label for="nilai_klaim" class="col-sm-3 col-form-label">Nilai Klaim<span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <input class="form-control ribuan1 numeric number_separator" type="text" id="nilai_klaim" placeholder="Masukkan Nilai Klaim">
                            </div>
                        </div> 
                        <div class="form-group row">
                            <label for="id_klasifikasi_klaim" class="col-sm-3 col-form-label">Klasifikasi Klaim<span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <select name="id_klasifikasi_klaim" id="id_klasifikasi_klaim" class="form-control select2">
                                        <option value="">-- Pilih Klasifikasi Klaim --</option>
                                        <?php foreach ($klasifikasiklaim as $kk2) { ?>
                                            <option value="<?php echo $kk2->id_klasifikasi_klaim; ?>">
                                            <?php echo $kk2->klasifikasi_klaim; ?> </option>
                                        <?php } ?>
                                </select>
                            </div>
                        </div> 
                        <div class="form-group row">
                            <label for="id_indikator" class="col-sm-3 col-form-label">Indikator<span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <select name="id_indikator" id="id_indikator" class="form-control select2">
                                    <option value="">-- Pilih Indikator --</option>
                                        <?php foreach ($indikator as $ik2) { ?>
                                            <option value="<?php echo $ik2->id_indikator; ?>">
                                            <?php echo $ik2->nama_indikator; ?> </option>
                                        <?php } ?>
                                </select>
                            </div>
                        </div> 
                        <h6>Dokumen Persyaratan</h6>
                        <div class="form-group row">
                            <label for="doc_1" class="col-sm-3 col-form-label">Surat Pengajuan Klaim</label>
                            <div class="col-sm-9">
                                <input type="file" class="form-control validasiform" name="berkas[]" id="berkas" multiple="">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="doc_2" class="col-sm-3 col-form-label">Salinan KTP atau data diri lainnya</label>
                            <div class="col-sm-9">	
                                <input type="file" class="form-control validasiform" name="berkas[]" id="berkas" multiple="">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="doc_3" class="col-sm-3 col-form-label">Salinan Kartu Keluarga</label>
                            <div class="col-sm-9">
                            <input type="file" class="form-control validasiform" name="berkas[]" id="berkas" multiple="">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="doc_4" class="col-sm-3 col-form-label">Salinan Mutasi Rekening Koran Kredit</label>
                            <div class="col-sm-9">
                            <input type="file" class="form-control validasiform" name="berkas[]" id="berkas" multiple="">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="doc_5" class="col-sm-3 col-form-label">Asli surat keterangan kematian dari Kelurahan (pihak yang berwenang) atau salinan yang telah dilegalisir</label>
                            <div class="col-sm-9">
                                <input type="file" class="form-control validasiform" name="berkas[]" id="berkas" multiple="">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="doc_6" class="col-sm-3 col-form-label">Surat Perjanjian Kredit (P/K) (Asli/Legalisir)</label>
                            <div class="col-sm-9">
                                	<input type="file" class="form-control validasiform" name="berkas[]" id="berkas" multiple="">
                            </div>
                        </div>

                    </div>
                </div>

            </div>
            <div class="card-footer">
                <div class="row">
                    <div class="col-md-12 d-flex justify-content-end">
                    <button type="button" id="senddata" class="btn btn-primary mr-2"><i class="ti-check-box mr-2"></i>Simpan</button>
                    <button type="button" id="claarall" tgl="<?= date('d-m-Y', now('Asia/Jakarta')) ?>" class="btn btn-danger"><i class="ti-na mr-2"></i>Reset</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<script>

$(document).ready(function(){

})
</script>