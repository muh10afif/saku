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
                <a href="<?= base_url('ajk/restitusi') ?>"><button class="btn btn-primary float-right" id="tambah_data"><i class="ti-arrow-left mr-2"></i>Kembali</button></a>
                <h5 id="judul" class="mb-0 mt-1"><i class="ti-plus mr-2"></i>Form Tambah</h5>
            </div>
            <div class="card-body table-responsive">

                <div class="alert alert-warning" role="alert">
                    Silahkan Pilih data Enquiry Polis terlebih dahulu melalui modul Enquiry+Endors atau dengan klik <u><a href="<?= base_url() ?>">disini</a></u>, atau dengan melakukan pencarian dibawah ini:
                </div>

                <div class="d-flex justify-content-center">
                    <div class="col-md-10">

                        <div class="form-group row mt-3">
                            <label for="cari_polis" class="col-sm-3 col-form-label">No Polis</label>
                            <div class="col-sm-7">
                                <input class="form-control" type="text" id="cari_polis" class="form-control">
                            </div>
                            <div class="col-sm-2">
                                <button class="btn btn-primary btn-block">Cari</button>
                            </div>
                        </div>
                        
                        <input class="form-control" type="hidden" id="id_restitusi">

                        <div class="form-group">
                            <mark><span class="text-danger">*</span> Mandatory (Harus diisi)</mark>
                        </div>
                        <div class="form-group row">
                            <label for="no_polis" class="col-sm-3 col-form-label">No Polis<span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <select name="id_polis" id="id_polis" class="form-control">
                                <option value="">-- Pilih No Polis --</option>
                                        <?php foreach ($polis as $ps) { ?>
                                            <option value="<?php echo $ps->id_polis; ?>">
                                            <?php echo $ps->no_polis; ?></option>
                                        <?php } ?>
                                </select>
                            </div>
                        </div> 
                        <div class="form-group row">
                            <label for="keterangan" class="col-sm-3 col-form-label">Keterangan<span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <textarea class="form-control" type="text" id="keterangan" placeholder="Masukkan Nama Nasabah" cols="5"></textarea>
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
                            <label for="tgl_restitusi" class="col-sm-3 col-form-label">Tanggal Restitusi<span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <div class="input-group">
                                    <input type='text' name="tgl_restitusi" id="tgl_restitusi" class="form-control datepicker text-center" readonly placeholder="Pilih Tanggal">
                                    <div class="input-group-append">
                                        <span class="input-group-text">
                                            <span class="ti-calendar"></span>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div> 
                        <div class="form-group row">
                            <label for="tgl_pelunasan" class="col-sm-3 col-form-label">Tanggal Pelunasan<span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <div class="input-group">
                                    <input type='text' name="tgl_pelunasan" id="tgl_pelunasan" class="form-control datepicker text-center" readonly placeholder="Pilih Tanggal">
                                    <div class="input-group-append">
                                        <span class="input-group-text">
                                            <span class="ti-calendar"></span>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div> 
                        <div class="form-group row">
                            <label for="tgl_kirim_dok" class="col-sm-3 col-form-label">Tanggal Kirim Dokumen<span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <div class="input-group">
                                    <input type='text' name="tgl_kirim_dok" id="tgl_kirim_dok" class="form-control datepicker text-center" readonly placeholder="Pilih Tanggal">
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
                                <input class="form-control" type="text" id="no_rek_debitur">
                            </div>
                        </div> 
                        <div class="form-group row">
                            <label for="nilai_restitusi" class="col-sm-3 col-form-label">Nilai Restitusi<span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <input class="form-control" type="text" id="nilai_restitusi">
                            </div>
                        </div> 
                        <div class="form-group row">
                            <label for="id_indikator" class="col-sm-3 col-form-label">Indikator<span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <select name="id_indikator" id="id_indikator" class="form-control">
                                <option value="">-- Pilih Indikator --</option>
                                        <?php foreach ($indikator as $ik) { ?>
                                            <option value="<?php echo $ik->id_indikator; ?>">
                                            <?php echo $ik->nama_indikator; ?></option>
                                        <?php } ?>
                                </select>
                            </div>
                        </div> 

                    </div>
                </div>

            </div>
            <div class="card-footer">
                <div class="row">
                    <div class="col-md-12 d-flex justify-content-end">
                    <button type="button" id="senddata" class="btn btn-primary mr-2"><i class="ti-check-box mr-2"></i>Simpan</button>
                    <button type="button" id="clearall" tgl="<?= date('d-m-Y', now('Asia/Jakarta')) ?>" class="btn btn-danger"><i class="ti-na mr-2"></i>Reset</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>

$(document).ready(function(){

$('#clearall').on('click', function () {
    $('#id_polis').val('');
	$('#keterangan').val('');
	$('#tgl_lapor').val('');
	$('#no_rek_debitur').val('');
	$('#tgl_kirim_dok').val('');
	$('#nilai_restitusi').val('');
	$('#id_indikator').val('');
});
    // 08-Juni-2021 RFA

$('#senddata').on('click', function () {
			var id_polis                = $('#id_polis').val();
			var keterangan              = $('#keterangan').val();
			var tgl_lapor               = $('#tgl_lapor').val();
			var no_rek_debitur          = $('#no_rek_debitur').val();
			var tgl_kirim_dok           = $('#tgl_kirim_dok').val();
			var nilai_restitusi         = $('#nilai_restitusi').val();
			var id_restitusi            = $('#id_restitusi').val();
			if (id_restitusi == "") { //insert
				$.ajax({
					type: "POST",
					url: "<?php echo base_url(); ?>ajk/restitusi/simpan_tambah_restitusi",
					beforeSend: function () {
						swal({
							title: 'Menunggu',
							html: 'Memproses Data',
							onOpen: () => {
								swal.showLoading();
							}
						})
					},
					data: {
						id_polis: id_polis,
						keterangan: keterangan,
						tgl_lapor: tgl_lapor,
						no_rek_debitur: no_rek_debitur,
						tgl_kirim_dok: tgl_kirim_dok,
						nilai_restitusi: nilai_restitusi,
						id_restitusi: id_restitusi,
					},
					dataType: "JSON",
					success: function (data) {
						swal({
							title: "Berhasil",
							text: "Data Restitusi telah di Tambahkan",
							type: 'success',
							showConfirmButton: false,
							timer: 1000
						});
                        $('#id_polis').val('');
                        $('#keterangan').val('');
                        $('#tgl_lapor').val('');
                        $('#no_rek_debitur').val('');
                        $('#tgl_kirim_dok').val('');
                        $('#nilai_restitusi').val('');
                        $('#id_indikator').val('');
						tabel_restitusi.ajax.reload();
						return true;
					},
					error: function (jqXHR, textStatus, errorThrown) {
						swal({
							title: "Peringatan",
							text: "Koneksi Tidak Terhubung",
							type: 'warning',
							showConfirmButton: false,
							timer: 1000
						});
						return false;
					}
				});
			} else { //update
				$.ajax({
					type: "POST",
					url: "<?php echo base_url(); ?>ajk/klaim/editklaim/" + id_polis,
					beforeSend: function () {
						swal({
							title: 'Menunggu',
							html: 'Memproses Data',
							onOpen: () => {
								swal.showLoading();
							}
						})
					},
					data: {
						id_polis: id_polis,
						keterangan: keterangan,
						tgl_lapor: tgl_lapor,
						no_rek_debitur: no_rek_debitur,
						tgl_kirim_dok: tgl_kirim_dok,
						nilai_restitusi: nilai_restitusi,
						id_restitusi: id_restitusi,
					},
					dataType: "JSON",
					success: function (data) {
						swal({
							title: "Berhasil",
							text: "Data telah di Update",
							type: 'success',
							showConfirmButton: false,
							timer: 1000
						});
						
                        $('#id_polis').val('');
                        $('#keterangan').val('');
                        $('#tgl_lapor').val('');
                        $('#no_rek_debitur').val('');
                        $('#tgl_kirim_dok').val('');
                        $('#nilai_restitusi').val('');
                        $('#id_indikator').val('');
						tabel_restitusi.ajax.reload();
						tabel_restitusi.ajax.reload();
						return true;
					},
					error: function (jqXHR, textStatus, errorThrown) {
						swal({
							title: "Peringatan",
							text: "Koneksi Tidak Terhubung",
							type: 'warning',
							showConfirmButton: false,
							timer: 1000
						});
						return false;
					}
				});
			}
		});

})
</script>