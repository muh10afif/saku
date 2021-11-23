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
    .rmv {
        cursor: pointer;
        color: #fff;
        border-radius: 10px;
        border: 1px solid #fff;
        /* display: inline-block; */
        background: rgba(255, 0, 0, 1);
        margin-top: -25px;
    }
</style>
<div class="page-title-box">
    <div class="row align-items-center">
        <div class="col-sm-4"><h4 class="page-title"><?= $title ?></h4></div>
        <div class="col-sm-8">
            <ol class="breadcrumb float-right">
                <li class="breadcrumb-item"><a href="<?= base_url() ?>">SAKU</a></li>
                <li class="breadcrumb-item">Transaction</li>
                <li class="breadcrumb-item">Outgoing</li>
                <li class="breadcrumb-item">Entry Claim</li>
                <li class="breadcrumb-item active"><?= $title ?></li>
            </ol>
        </div>
    </div>
</div>

<div class="row">
	<div class="col-md-12">

		<div class="card shadow">
            <div class="card-header">
                    <a href="<?= base_url('entry_claim') ?>"><button class="btn btn-primary float-right" id="tambah_entry1"><i class="fas fa-arrow-left mr-1"></i> Kembali</button></a>
            </div>
			<form id="form_klaim" autocomplete="off">
				<div class="card-body table-responsive formdetail">

					<div class="row d-flex justify-content-center">
						
						<div class="col-md-5 offset-md-2">

							<div class="form-group row">
								<label for="getkode" class="col-sm-4 col-form-label">Claim Doc Number</label>
								<div class="col-sm-6 mt-2">
									<span>: <?= $klaim_nomor_dok ?></span>
									<input type="hidden" name="klaim_nomor_dok" value="<?= $klaim_nomor_dok ?>">
								</div>
							</div>
						</div>
						<div class="col-md-5">
							<div class="form-group row">
								<label for="klaimnodok" class="col-sm-3 col-form-label">Claim Date</label>
								<div class="col-sm-6 mt-2">
									<span>: <?= $tanggal_klaim ?></span>
								</div>
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-md-12">

							<ul class="nav nav-tabs d-flex justify-content-center mt-2" role="tablist">
								<li class="nav-item">
									<a class="nav-link active" data-toggle="tab" href="#satu" role="tab">
										<span class="d-none d-md-block">Master SPPA Data</span><span class="d-block d-md-none"><i
												class="mdi mdi-home-variant h5"></i></span>
									</a>
								</li>
								<li class="nav-item">
									<a class="nav-link tab_detail_claim" data-toggle="tab" href="#dua" role="tab">
										<span class="d-none d-md-block">Detail Claim</span><span class="d-block d-md-none"><i
												class="mdi mdi-account h5"></i></span>
									</a>
								</li>
								<li class="nav-item">
									<a class="nav-link" data-toggle="tab" href="#t_dok" role="tab">
										<span class="d-none d-md-block">Dokumen Pendukung</span><span class="d-block d-md-none"><i
												class="mdi mdi-account h5"></i></span>
									</a>
								</li>
							</ul>
							
							<!-- Tab panes -->
							<div class="tab-content">
								<div class="tab-pane active p-3" id="satu" role="tabpanel">
								
									<div class="d-flex justify-content-center mt-3">

										<input type="hidden" name="id_data_klaim" id="id_data_klaim" value="">
										<input type="hidden" name="id_pengguna_tertanggung" id="id_pengguna_tertanggung">
										<div class="col-md-8">

											
											<div class="form-group row">
												<label for="nomor_polis" class="col-sm-3 col-form-label">Nomor Polis<b style="color:red;">*</b></label>
												<div class="col-sm-6 sel2">
													
													<select name="nomor_polis" id="nomor_polis" class="select2" required data-parsley-required-message="Nomor Polis harus terisi.">
														<option value="">Pilih Polis</option>
														<?php foreach ($list_polis as $p): ?>
															<option value="<?= $p['id_sppa_quotation'] ?>"><?= $p['no_polis'] ?></option>
														<?php endforeach; ?>
													</select>
													
												</div>
												<div class="col-sm-3">
													<button type="button" class="btn btn-primary btn-block" id="detail_polis" disabled>
														View Info Polis
													</button>
												</div>
											</div>
											
											<div class="form-group row">
												<label for="nama_asuransi" class="col-sm-3 col-form-label">Insurer</label>
												<div class="col-sm-9">
													<input type="text" class="form-control" id="nama_asuransi" readonly>
													
												</div>
											</div>
											<div class="form-group row">
												<label for="no_klaim" class="col-sm-3 col-form-label">COB</label>
												<div class="col-sm-9">
													<div class="form-group row mb-0">
														<div class="col-sm-4">
															<input type="text" class="form-control" id="kode_cob" readonly>
														</div>
														<div class="col-sm-8">
															<input type="text" class="form-control" id="cob" readonly>
														</div>
													</div>
												</div>
											</div>
											<div class="form-group row">
												<label for="no_klaim" class="col-sm-3 col-form-label">LOB</label>
												<div class="col-sm-9">
													<div class="form-group row mb-0">
														<div class="col-sm-4">
															<input type="text" class="form-control" id="kode_lob" readonly>
														</div>
														<div class="col-sm-8">
															<input type="text" class="form-control" id="lob" readonly>
														</div>
													</div>
												</div>
											</div>
											<div class="form-group row">
												<label for="id_manfaat" class="col-sm-3 col-form-label">Tipe Klaim<b style="color:red;">*</b></label>
												<div class="col-sm-9 sel2">
													<select name="id_manfaat" id="id_manfaat" class="select2" required data-parsley-required-message="Manfaat harus terisi.">
														<option value="">Pilih Tipe Klaim</option>
														
													</select>
													
												</div>
											</div>

											
										</div>

									</div>
								</div>
								<div class="tab-pane p-3" id="dua" role="tabpanel">
									<div class="d-flex justify-content-center mt-3">
										<div class="col-md-8">
											
											<div class="form-group row">
												<label for="no_klaim" class="col-sm-4 col-form-label">Insured<b style="color:red;">*</b></label>
												<div class="col-sm-8">
													<div class="form-group row mb-0">
														<div class="col-sm-8 mt-2">
															<span class="t_tertanggung">: -</span>
														</div>
														<div class="col-sm-4">
															<button type="button" class="btn btn-primary btn-block" id="detail_insured" disabled>
																View Detail Insured
															</button>
														</div>
													</div>
												</div>
											</div>

											<div class="form-group row">
												<label for="nama_pemohon" class="col-sm-4 col-form-label">Nama Pemohon<b style="color:red;">*</b></label>
												<div class="col-sm-8">
													<input type="text" class="form-control" name="nama_pemohon" id="nama_pemohon" placeholder="Masukkan Nama pemohon" required data-parsley-required-message="Nama pemohon harus terisi.">
												</div>
											</div>
											<div class="form-group row">
												<label for="alamat_pemohon" class="col-sm-4 col-form-label">Alamat Pemohon<b style="color:red;">*</b></label>
												<div class="col-sm-8">
													<textarea class="form-control" name="alamat_pemohon" id="alamat_pemohon" placeholder="Masukkan Alamat pemohon" required data-parsley-required-message="Alamat pemohon harus terisi." rows="5"></textarea>
												</div>
											</div>
											<div class="form-group row">
												<label for="tgl_waktu_kejadian" class="col-sm-4 col-form-label">Tanggal dan Waktu Kejadian<b style="color:red;">*</b></label>
												<div class="col-sm-8">
													<input type="datetime-local" class="form-control" name="tgl_waktu_kejadian" id="tgl_waktu_kejadian" required data-parsley-required-message="Tanggal dan Waktu kejadian harus terisi.">
												</div>
											</div>
											<div class="form-group row">
												<label for="lokasi_kejadian" class="col-sm-4 col-form-label">Lokasi Kejadian<b style="color:red;">*</b></label>
												<div class="col-sm-8">
													<textarea class="form-control" name="lokasi_kejadian" id="lokasi_kejadian" rows="5" placeholder="Masukkan lokasi kejadian" required data-parsley-required-message="Lokasi kejadiaan harus terisi."></textarea>
												</div>
											</div>
											<div class="form-group row">
												<label for="penyebab_kejadian" class="col-sm-4 col-form-label">Penyebab Kejadian<b style="color:red;">*</b></label>
												<div class="col-sm-8">
													<textarea class="form-control" name="penyebab_kejadian" id="penyebab_kejadian" rows="5" placeholder="Masukkan penyebab kejadian" required data-parsley-required-message="Penyebab kejadian harus terisi."></textarea>
												</div>
											</div>
											<div class="form-group row">
												<label for="penyebab_kejadian" class="col-sm-4 col-form-label">TTD<b style="color:red;">*</b></label>
												<div class="col-sm-8">
													<div class="row">
														<div class="col-md-12">
															<!-- <form novalidate="novalidate"> -->
																<div class="form-group">
																	<!-- js signature widget -->
																	<div class='js-signature'></div>
																	<textarea id="signature64" name="signed" style="display: none" ></textarea>

																	<!-- action button to clear the signature -->
																	<p><button type="button" id="clearBtn" class="btn btn-sm btn-primary">Clear TTD</button></p>
																	
																	<!-- populate the base64 encoded image in the textarea -->
																	
																</div>
															<!-- </form> -->
															<!-- <button type="button" class="btn btn-primary" id="simpan_form">Simpan</button> -->
														</div>
													</div>
												</div>
												
											</div>

											<h5>Data Rekening Pemohon</h5>
											<hr>
											
											<div class="form-group row">
												<label for="no_rekening" class="col-sm-4 col-form-label">Nomor Rekening<b style="color:red;">*</b></label>
												<div class="col-sm-8">
													<input type="text" class="form-control numeric" name="no_rekening" id="no_rekening" placeholder="Masukkan Nomor Rekening" required data-parsley-required-message="Nomor Rekening harus terisi.">
												</div>
											</div>
											<div class="form-group row">
												<label for="nama_pemilik_rekening" class="col-sm-4 col-form-label">Nama Pemilik Rekening<b style="color:red;">*</b></label>
												<div class="col-sm-8">
													<input type="text" class="form-control" name="nama_pemilik_rekening" id="nama_pemilik_rekening" placeholder="Masukkan Nama pemilik rekening" required data-parsley-required-message="Nama pemilik harus terisi.">
												</div>
											</div>
											<div class="form-group row">
												<label for="bank" class="col-sm-4 col-form-label">Bank Tujuan<b style="color:red;">*</b></label>
												<div class="col-sm-8 sel2">
													<select name="bank" id="bank" class="select2" required data-parsley-required-message="Bank tujuan harus terisi.">
														<option value="">Pilih Bank</option>
														<?php foreach ($bank as $b): ?>
															<option value="<?= $b['id_bank'] ?>"><?= $b['nama_bank'] ?></option>
														<?php endforeach; ?>
													</select>
												</div>
											</div>
											
											
										</div>
									</div>
								</div>


								<div class="tab-pane p-3" id="t_dok" role="tabpanel">

									<div class="d-flex justify-content-center mb-1 mt-3">

										<div class="col-md-8">

												<?php $i=1; foreach ($list_dokumen as $d): 

													$id_dokumen = $d['id'];

													if ($d['kematian_akibat_sakit'] == 1) {
														$sts = 'sakit';
													} else {
														$sts = 'sakit kecelakaan';
													}
											
												?>

												<div class="form-group card-img-sblm<?= $i ?>" style="display: none;">
													<label for="asuransi" class="col-form-label text-left">Image Sebelumnya</label>
													<div class="card mb-0">
														<img class="card-img-top img-fluid" id="img_sblm<?= $i ?>" src="" height="200px">
													</div>
												</div>
												<div class="form-group row input_dokumen" jenis="<?= $sts ?>" count="<?= $i ?>" style="display: none;">
													<label for="image" class="col-md-4 col-form-label text-left judul_img<?= $i ?>"><?= $i ?>. <?= $d['dokumen'] ?><span class="text-danger">*</span></label>
													<div class="col-md-8">
														<input type="file" name="image<?= $id_dokumen ?>" id="image<?= $i ?>" class="form-control" accept="image/png, image/jpeg" required data-parsley-required-message="<?= $d['dokumen'] ?> harus diisi.">
													</div>
												</div>  
												<p class="text-danger txt_image<?= $i ?>" style="display: none;">Pilih image bila ingin mengubah dengan yang baru!</p>

												<div class="form-group card-img<?= $i ?>" style="display: none;">
													<div class="card mb-0">
														<img class="card-img-top img-fluid" id="ImgPreview<?= $i ?>" src="" class="preview1" height="200px">
														<div class="card-body">
															<button class="btn-block btn-danger btn-rmv1" id="removeImage<?= $i ?>">Hapus</button>
														</div>
													</div>
												</div>

											<?php $i++; endforeach; ?>
											
											
										</div>
										
									</div>
								</div>
							</div>

						</div>
					</div>

				</div>
				<div class="card-footer">
					<div class="row">
						<div class="col-md-6">
							<i class="text-center" style="color:red;">('*') Menandakan Form Harus diisi</i>
						</div>
						<div class="col-md-6 d-flex justify-content-end">
							<button type="submit" id="senddata" class="btn btn-primary mr-2"><i class="fas fa-check mr-2"></i>Simpan</button>
							<a href="<?= base_url('entry_claim') ?>">
                            <button type="button" id="clearall" class="btn btn-secondary batal_entry"><i class="fas fa-undo-alt mr-2"></i>Batal</button></a>
						</div>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>

<!-- Modal -->
<div class="modal fade" id="modal_detail_polis" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header bg-primary text-white">
        <h5 class="modal-title mt-0" id="judul_modal">Detail Polis</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true" class="text-white">&times;</span>
        </button>
      </div>
        <form id="form_termin_m" autocomplete="off" class="form-control-line">
            <div class="modal-body">
                <div class="col-md-12 p-3">
                    <div class="form-group row">
                        <label for="tgl_awal" class="col-sm-4 col-form-label">Nomor Polis</label>
                        <div class="col-sm-8 mt-2">
                            <span id="t_no_polis">: </span>
                        </div>
                    </div>  
                    <div class="form-group row">
                        <label for="tgl_awal" class="col-sm-4 col-form-label">Tanggal Awal Polis</label>
                        <div class="col-sm-8 mt-2">
                            <span id="t_tgl_awal_polis">: </span>
                        </div>
                    </div>  
                    <div class="form-group row">
                        <label for="tgl_awal" class="col-sm-4 col-form-label">Tanggal Akhir Polis</label>
                        <div class="col-sm-8 mt-2">
                            <span id="t_tgl_akhir_polis">: </span>
                        </div>
                    </div>  
                    <div class="form-group row">
                        <label for="tgl_awal" class="col-sm-4 col-form-label">Tertanggung</label>
                        <div class="col-sm-8 mt-2">
                            <span class="t_tertanggung">: </span>
                        </div>
                    </div>  
                    <div class="form-group row">
                        <label for="tgl_awal" class="col-sm-4 col-form-label">Total Premi</label>
                        <div class="col-sm-8 mt-2">
                            <span id="t_premi">: </span>
                        </div>
                    </div>  
                </div>
            </div>
        </form>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="modal_detail_ptg" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header bg-primary text-white">
        <h5 class="modal-title mt-0" id="judul_modal">Detail Pengguna Tertanggung</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true" class="text-white">&times;</span>
        </button>
      </div>
        <form id="form_termin_m" autocomplete="off" class="form-control-line">
            <div class="modal-body">
                <div class="col-md-12 p-3">
                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label">NIK</label>
                        <div class="col-sm-8 mt-2">
                            <span id="t_nik">: </span>
                        </div>
                    </div>  
                    <div class="form-group row">
                        <label for="tgl_awal" class="col-sm-4 col-form-label">Nama</label>
                        <div class="col-sm-8 mt-2">
                            <span id="t_nama">: </span>
                        </div>
                    </div>  
                    <div class="form-group row">
                        <label for="tgl_awal" class="col-sm-4 col-form-label">Tempat Lahir</label>
                        <div class="col-sm-8 mt-2">
                            <span id="t_tempat_lahir">: </span>
                        </div>
                    </div>  
                    <div class="form-group row">
                        <label for="tgl_awal" class="col-sm-4 col-form-label">Tanggal Lahir</label>
                        <div class="col-sm-8 mt-2">
                            <span id="t_tgl_lahir">: </span>
                        </div>
                    </div>  
                    <div class="form-group row">
                        <label for="tgl_awal" class="col-sm-4 col-form-label">Jenis Kelamin</label>
                        <div class="col-sm-8 mt-2">
                            <span id="t_jenis_kelamin">: </span>
                        </div>
                    </div>  
                    <div class="form-group row">
                        <label for="tgl_awal" class="col-sm-4 col-form-label">Alamat</label>
                        <div class="col-sm-8 mt-2">
                            <span id="t_alamat">: </span>
                        </div>
                    </div>  
                    <div class="form-group row">
                        <label for="tgl_awal" class="col-sm-4 col-form-label">No Telepon</label>
                        <div class="col-sm-8 mt-2">
                            <span id="t_hp">: </span>
                        </div>
                    </div>  
                    <div class="form-group row">
                        <label for="tgl_awal" class="col-sm-4 col-form-label">Pekerjaan</label>
                        <div class="col-sm-8 mt-2">
                            <span id="t_pekerjaan">: </span>
                        </div>
                    </div>  
                    <div class="form-group row">
                        <label for="tgl_awal" class="col-sm-4 col-form-label">Email</label>
                        <div class="col-sm-8 mt-2">
                            <span id="t_email">: </span>
                        </div>
                    </div>  
                </div>
            </div>
        </form>
    </div>
  </div>
</div>



<?php $this->load->view('js'); ?>