<div class="col-md-12 f_ubah" style="display: none;">

	<div class="card shadow">
		<div class="card-header mb-0">
			<button class="btn btn-light float-right batal_entry"><i class="mdi mdi-close mdi-18px"></i></button>
			<h5 id="judul" class="mb-0 mt-1">Form Ubah Data</h5>
		</div>
		<div class="card-body table-responsive formdetail">

			<div class="row d-flex justify-content-center">
				<div class="col-md-5 offset-md-2">

					<div class="form-group row">
						<label for="klaimnodok" class="col-sm-4 col-form-label">Claim Doc Number</label>
						<div class="col-sm-4">
							<input type="text" class="form-control" name="klaim_nomor_dok" id="klaimnodok"
								value="<?php echo rand() ?>" readonly>
						</div>
					</div>
				</div>
				<div class="col-md-5">
					<div class="form-group row">
						<label for="klaimnodok" class="col-sm-4 col-form-label">Claim Date</label>
						<div class="col-sm-4 col-md-4 mt-2">
							<span class="date-part"></span>
						</div>
					</div>
				</div>
			</div>

			<div class="row">
				<div class="col-md-12">

					<ul class="nav nav-tabs d-flex justify-content-center mt-2" role="tablist">
						<li class="nav-item">
							<a class="nav-link active" data-toggle="tab" href="#ubahsatu" role="tab">
								<span class="d-none d-md-block">Master SPPA Data</span><span
									class="d-block d-md-none"><i class="mdi mdi-home-variant h5"></i></span>
							</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" data-toggle="tab" href="#ubahdua" role="tab">
								<span class="d-none d-md-block">Detail Claim</span><span class="d-block d-md-none"><i
										class="mdi mdi-account h5"></i></span>
							</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" data-toggle="tab" href="#t_doks" role="tab">
								<span class="d-none d-md-block">Detail Dokumen</span><span class="d-block d-md-none"><i
										class="mdi mdi-account h5"></i></span>
							</a>
						</li>
					</ul>

					<!-- Tab panes -->
					<div class="tab-content">
						<div class="tab-pane active p-3" id="ubahsatu" role="tabpanel">
							<div class="d-flex justify-content-center mt-3">

								<input type="hidden" name="id_data_klaim" id="id_data_klaim" value="">
								<div class="col-md-8">
									<div class="form-group row">
										<label for="no_klaim" class="col-sm-3 col-form-label">Nomor SPPA</label>
										<div class="col-sm-6">
											<select name="idsppa" id="idsppa" class="form-control select2">
												<option value="">-- Pilih --</option>
												<?php foreach ($list_sppa as $key) { ?>
												<option value="<?php echo $key->id_sppa_quotation; ?>">
													<?php echo $key->sppa_number; ?></option>
												<?php } ?>
											</select>
										</div>
										<div class="col-sm-3">
											<!-- <button class="btn btn-primary btn-block"  data-target="#exampleModalCenter">View Full
															Header</button> -->
											<button type="button" class="btn btn-primary" data-toggle="modal"
												data-target="#exampleModalCenter" id="buttonsppa2" disabled>
												View Info SPPA
											</button>
										</div>
									</div>
									<div class="form-group row">
										<label for="no_klaim" class="col-sm-3 col-form-label">Insurer</label>
										<div class="col-sm-9">
											<input type="text" class="form-control" id="asuransi" readonly>
										</div>
									</div>
									<div class="form-group row">
										<label for="no_klaim" class="col-sm-3 col-form-label">COB</label>
										<div class="col-sm-9">
											<div class="form-group row mb-0">
												<div class="col-sm-3">
													<input type="text" class="form-control" id="kodecob" readonly>
												</div>
												<div class="col-sm-9">
													<input type="text" class="form-control" id="cob" readonly>
												</div>
											</div>
										</div>
									</div>
									<div class="form-group row">
										<label for="no_klaim" class="col-sm-3 col-form-label">LOB</label>
										<div class="col-sm-9">
											<div class="form-group row mb-0">
												<div class="col-sm-3">
													<input type="text" class="form-control" id="kodelob" readonly>
												</div>
												<div class="col-sm-9">
													<input type="text" class="form-control" id="lob" readonly>
												</div>
											</div>
										</div>
									</div>
									<div class="form-group row">
										<label for="no_klaim" class="col-sm-3 col-form-label">PIC</label>
										<div class="col-sm-9">
											<select name="pc" id="pc" class="form-control">
												<option value="">Pilih</option>
												<?php foreach ($karyawan as $key) { ?>
												<option name="pc" id="pc" value="<?php echo $key->nama_karyawan; ?>">
													<?php echo $key->nama_karyawan; ?></option>
												<?php } ?>
											</select>
										</div>
									</div>

								</div>
							</div>
						</div>
						<div class="tab-pane p-3" id="ubahdua" role="tabpanel">
							<div class="d-flex justify-content-center mt-3">
								<div class="col-md-8">
									<div class="form-group row">
										<label for="no_klaim" class="col-sm-3 col-form-label">Insured</label>
										<div class="col-sm-9">
											<div class="form-group row mb-0">
												<div class="col-sm-8">
													<select name="idinsured" id="idinsured" class="form-control">
														<option value="">Pilih</option>
														<?php foreach ($list_nasabah as $key) { ?>
														<option name="idinsured" id="idinsured"
															value="<?php echo $key->id_nasabah; ?>">
															<?php echo $key->nama_nasabah; ?></option>
														<?php } ?>
													</select>
												</div>
												<div class="col-sm-4">
													<button type="button" class="btn btn-primary" data-toggle="modal"
														data-target="#insuredmodel" id="buttoninsured2" disabled>
														View Detail Insured
													</button>
												</div>
											</div>
										</div>
									</div>

									<div class="form-group row">
										<label for="no_klaim" class="col-sm-3 col-form-label">Keterangan
											Klaim</label>
										<div class="col-sm-9">
											<textarea type="text" cols="5" class="form-control validasiform"
												name="keteranganklm" id="keteranganklm"></textarea>
										</div>
									</div>
									<div class="form-group row">
										<label for="no_klaim" class="col-sm-3 col-form-label">Kejadian</label>
										<div class="col-sm-9">
											<input type="text" class="form-control validasiform" name="kejdan"
												id="kejdan">
										</div>
									</div>
									<div class="form-group row">
										<label for="no_klaim" class="col-sm-3 col-form-label">Lokasi
											Kejadian</label>
										<div class="col-sm-9">
											<input type="text" class="form-control validasiform" name="lokasikejadian"
												id="lokasikejadian">
										</div>
									</div>
									<div class="form-group row">
										<label for="no_klaim" class="col-sm-3 col-form-label">Penyebab</label>
										<div class="col-sm-9">
											<input type="text" class="form-control validasiform" name="sebab"
												id="sebab">
										</div>
									</div>
									<div class="form-group row">
										<label for="no_klaim" class="col-sm-3 col-form-label">Nilai Klaim</label>
										<div class="col-sm-9">
											<input type="text" class="form-control validasiform" name="nilaiklaim"
												id="nilaiklaim">
										</div>
									</div>
									<?php //echo form_open_multipart('outgoing/do_upload');?>
									<?php //echo $error;?>


								</div>
							</div>
						</div>

						<div class="tab-pane p-3" id="t_doks" role="tabpanel">
                        <div class="form-group row">
											<label for="berkas" class="col-sm-3 col-form-label">Dokumen
												Pendukung</label>
											<div class="col-sm-5">
												<input type="file" class="form-control validasiform" name="berkas[]"
													id="berkas" multiple=""><br>
												<span>* Upload Dokumen Pendukung</span>
											</div>
										</div>
							<hr>

							<table class="mt-3 table table-bordered table-hover dt-responsive nowrap"
								style="border-collapse: collapse; border-spacing: 0; width: 100%;" id="tabel_doks"
								width="100%" cellspacing="0">
								<thead class="thead-light text-center">
									<tr>
										<th width="5%">No</th>
										<th>Filename</th>
										<th>Size</th>
										<th>Aksi</th>
									</tr>
								</thead>
								<tbody>

								</tbody>
							</table>

							<hr>
						</div>
					</div>

				</div>
			</div>

		</div>
		<div class="card-footer">
			<div class="row">
				<div class="col-md-6">

				</div>
				<div class="col-md-6 d-flex justify-content-end">
					<button type="submit" id="senddata2" class="btn btn-primary mr-2"><i
							class="ti-check-box mr-2"></i>Simpan</button>
					<button type="button" id="clearall" class="btn btn-danger batal_entry"><i
							class="ti-na mr-2"></i>Batal</button>
				</div>
			</div>
		</div>
	</div>
</div>

<script>



$(document).ready(function () {
 $('#senddata2').on('click', function () {
        var id_data_klaim = $('#id_data_klaim').val();
        var sppaid = $('#sppaid').val();
        var pc = $('#pc').val();
        var insuredid = $('#insuredid').val();
        var nama_file = $('#nama_file').val();
        var keteranganklm = $('#keteranganklm').val();
        var kejdan = $('#kejdan').val();
        var lokasikejadian = $('#lokasikejadian').val();
        var nilaiklaim = $('#nilaiklaim').val();
        var sebab = $('#sebab').val();
        var berkas = $('#berkas').val();

        // var validasi = [];
        // $('.validasiform').each(function (key , obj) {
        //     if (obj.value == null || obj.value == ''){
        //         validasi.push(false);
        //     }else{
        //         validasi.push(true);
        //     }
        // });

        // if(!validasi.includes(false)){
            if (id_data_klaim == "") {
                $.ajax({
                type:"POST",
                url:"<?php echo base_url(); ?>outgoing/add",
                beforeSend : function () {
                    swal({
                    title  : 'Menunggu',
                    html   : 'Memproses Data',
                    onOpen : () => {
                        swal.showLoading();
                    }
                    })
                },
                data: { pc:pc, 
                        keteranganklm:keteranganklm,
                        sppaid:sppaid,
                        kejdan:kejdan,
                        lokasikejadian:lokasikejadian,
                        sebab:sebab,
                        insuredid:insuredid,
                        nama_file:nama_file,
                        berkas:berkas,
                        nilaiklaim:nilaiklaim,
                        upload:gambar
                    },
                dataType : "JSON",
                success  : function (data) {
                    swal({
                    title             : "Berhasil",
                    text              : "Klaim telah di Tambahkan",
                    type              : 'success',
                    showConfirmButton : false,
                    timer             : 1000
                    });
                    $('#id_data_klaim').val('');
                    $('#sppaid').val('');
                    $('#pc').val('');
                    $('#insuredid').val('');
                    $('#keteranganklm').val('');
                    $('#kejdan').val('');
                    $('#lokasikejadian').val('');
                    $('#nama_file').val('');
                    $('#nilaiklaim').val('');
                    $('#berkas').val('');
                    $('#sebab').val('');
                    $('#upload').val('');
                    tabel_outgoing.ajax.reload();
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
                }
                });
            } else {
                $.ajax({
                type:"POST", //edit
                url:"<?php echo base_url(); ?>outgoing/edit/"+id_data_klaim,
                beforeSend : function () {
                    swal({
                    title  : 'Menunggu',
                    html   : 'Memproses Data',
                    onOpen : () => {
                        swal.showLoading();
                    }
                    })
                },
                data: { pc:pc, 
                        keteranganklm:keteranganklm,
                        sppaid:sppaid,
                        kejdan:kejdan,
                        lokasikejadian:lokasikejadian,
                        sebab:sebab,
                        insuredid:insuredid,
                        nama_file:nama_file,
                        berkas:berkas,
                        nilaiklaim:nilaiklaim },
                dataType : "JSON",
                success  : function (data) {
                    swal({
                    title             : "Berhasil",
                    text              : "Outgoing telah di Update",
                    type              : 'success',
                    showConfirmButton : false,
                    timer             : 1000
                    });
                    $('#id_data_klaim').val('');
                    $('#sppaid').val('');
                    $('#pc').val('');
                    $('#insuredid').val('');
                    $('#keteranganklm').val('');
                    $('#kejdan').val('');
                    $('#lokasikejadian').val('');
                    $('#nama_file').val('');
                    $('#nilaiklaim').val('');
                    $('#berkas').val('');
                    $('#sebab').val('');
                    $('#upload').val('');
                    tabel_outgoing.ajax.reload();
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
                }
                });
            }
        // } else {
        //     swal({
        //             title             : "Peringatan",
        //             text              : "Mohon Diperiksa Kembali Data Form",
        //             type              : 'warning',
        //             showConfirmButton : false,
        //             timer             : 1000
        //             });
        // }

        
        });

});
</script>