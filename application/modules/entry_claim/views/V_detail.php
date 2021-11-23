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
	.card-img-top {
		width: 100%;
		height: 20vw;
		object-fit: cover;
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
			<div class="card-body table-responsive formdetail">

				<div class="row d-flex justify-content-center">

					<?php if ($list['status_klaim'] == 3) : ?>
						<div class="col-md-12">
							
							<div class="alert alert-danger" role="alert">
								<strong>Alasan Ditolak: </strong> <?= $list['alasan_tolak'] ?>
							</div>

						</div>
					<?php endif ?>
					
					<div class="col-md-5 offset-md-2">

						<div class="form-group row">
							<label for="getkode" class="col-sm-4 col-form-label">Claim Doc Number</label>
							<div class="col-sm-6 mt-2">
                                <span>: <?= $list['klaim_nomor_dok'] ?></span>
							</div>
						</div>
					</div>
					<div class="col-md-5">
						<div class="form-group row">
							<label for="klaimnodok" class="col-sm-3 col-form-label">Claim Date</label>
							<div class="col-sm-6 mt-2">
								<span>: <?= date("d F Y", strtotime($list['tgl_klaim'])) ?></span>
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
								<a class="nav-link" data-toggle="tab" href="#dua" role="tab">
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
									<input type="hidden" name="id_pengguna_tertanggung" id="id_pengguna_tertanggung" value="<?= $list['id_pengguna_tertanggung'] ?>">
									<div class="col-md-8">
										<div class="form-group row">
											<label for="nomor_polis" class="col-sm-3 col-form-label">Nomor Polis</label>
											<div class="col-sm-6 mt-2">
												: <?= $list['no_polis'] ?>
											</div>
											<div class="col-sm-3">
												<button type="button" class="btn btn-primary btn-block" id="detail_polis">
													View Info Polis
												</button>
											</div>
										</div>
										
										<div class="form-group row">
											<label for="nama_asuransi" class="col-sm-3 col-form-label">Insurer</label>
											<div class="col-sm-9 mt-2">
												: <?= $list['nama_asuransi'] ?>
											</div>
										</div>
										<div class="form-group row">
											<label for="no_klaim" class="col-sm-3 col-form-label">COB</label>
											<div class="col-sm-9 mt-2">
												: <?= $list['kode_cob'] ?> - <?= $list['cob'] ?>
											</div>
										</div>
										<div class="form-group row">
											<label for="no_klaim" class="col-sm-3 col-form-label">LOB</label>
											<div class="col-sm-9 mt-2">
												: <?= $list['kode_lob'] ?> - <?= $list['lob'] ?>
											</div>
										</div>
										<div class="form-group row">
											<label for="id_manfaat" class="col-sm-3 col-form-label">Manfaat</label>
											<div class="col-sm-9 mt-2">
												: <?= $list['manfaat'] ?>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="tab-pane p-3" id="dua" role="tabpanel">
								<div class="d-flex justify-content-center mt-3">
									<div class="col-md-8">
										<div class="form-group row">
											<label for="no_klaim" class="col-sm-4 col-form-label">Insured</label>
											<div class="col-sm-8">
												<div class="form-group row mb-0">
													<div class="col-sm-8 mt-2">
                                                        <span class="t_tertanggung">: <?= $list['nama'] ?></span>
													</div>
													<div class="col-sm-4">
														<button type="button" class="btn btn-primary btn-block" id="detail_insured">
															View Detail Insured
														</button>
													</div>
												</div>
											</div>
										</div>

										<div class="form-group row">
											<label for="nama_pemohon" class="col-sm-4 col-form-label">Nama Pemohon</label>
											<div class="col-sm-8 mt-2">
												: <?= $list['nama_pemohon'] ?>
											</div>
										</div>
										<div class="form-group row">
											<label for="alamat_pemohon" class="col-sm-4 col-form-label">Alamat Pemohon</label>
											<div class="col-sm-8 mt-2">
												: <?= $list['alamat_pemohon'] ?>
											</div>
										</div>
										<div class="form-group row">
											<label for="tgl_waktu_kejadian" class="col-sm-4 col-form-label">Tanggal dan Waktu Kejadian</label>
											<div class="col-sm-8 mt-2">
												: <?= date("d F Y H:i:s", strtotime($list['tgl_kejadian'])) ?>
											</div>
										</div>
										<div class="form-group row">
											<label for="lokasi_kejadian" class="col-sm-4 col-form-label">Lokasi Kejadian</label>
											<div class="col-sm-8 mt-2">
												: <?= $list['lokasi_kejadian'] ?>
											</div>
										</div>
										<div class="form-group row">
											<label for="penyebab_kejadian" class="col-sm-4 col-form-label">Penyebab Kejadian</label>
											<div class="col-sm-8 mt-2">
												: <?= $list['penyebab'] ?>
											</div>
										</div>
										<div class="form-group row">
											<label for="penyebab_kejadian" class="col-sm-4 col-form-label">TTD</label>
											<div class="col-sm-8 mt-2">
												<?php 

												if ($list['ttd'] != '') {
													$ttd = "<a class='image-popup-no-margins' href='".$url_img.'dokumen_klaim/user_'.$list['id_nasabah_klaim'].'/'.$list['ttd']."'> <img src='".$url_img.'dokumen_klaim/user_'.$list['id_nasabah_klaim'].'/'.$list['ttd']."' width='100px'></a>";
												} else {
													$ttd = "-";
												}

												?>
												<span>: <?= $ttd ?></span>
											</div>
										</div>
										<br>
										<h5>Data Rekening Pemohon</h5>
										<hr>
										
										<div class="form-group row">
											<label for="no_rekening" class="col-sm-4 col-form-label">Nomor Rekening</label>
											<div class="col-sm-8 mt-2">
												: <?= $list['no_rekening'] ?>
											</div>
										</div>
										<div class="form-group row">
											<label for="nama_pemilik_rekening" class="col-sm-4 col-form-label">Nama Pemilik Rekening</label>
											<div class="col-sm-8 mt-2">
												: <?= $list['nama_pemilik_rekening'] ?>
											</div>
										</div>
										<div class="form-group row">
											<label for="bank" class="col-sm-4 col-form-label">Bank Tujuan</label>
											<div class="col-sm-8 mt-2">
												: <?= $list['nama_bank'] ?>
											</div>
										</div>
									</div>
								</div>
							</div>


							<div class="tab-pane p-3" id="t_dok" role="tabpanel">

								<div class="row mt-3 zoom-gallery">
									<?php $no=1; foreach ($dok_klaim as $d): ?>
										<div class="col-md-4">
											<!-- <div class="card shadow" style="width: 25rem; "> -->
											<div class="card shadow">
												<a href="<?= $url_img.'dokumen_klaim/user_'.$list['id_nasabah_klaim'].'/'.$d['nama_file'] ?>" title="<?= $d['dokumen'] ?>">
													<img class="card-img-top" src="<?= $url_img.'dokumen_klaim/user_'.$list['id_nasabah_klaim'].'/'.$d['nama_file'] ?>" alt="<?= $d['dokumen'] ?>">
												</a>
												<div class="card-body">
													<p class="card-text font-weight-bold"><?= $no.". ".$d['dokumen'] ?></p>
												</div>
											</div>
										</div>
									<?php $no++; endforeach ?>
								</div>

							</div>
						</div>

					</div>
				</div>

			</div>
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
                            <span id="t_no_polis">: <?= $list['no_polis'] ?></span>
                        </div>
                    </div>  
                    <div class="form-group row">
                        <label for="tgl_awal" class="col-sm-4 col-form-label">Tanggal Awal Polis</label>
                        <div class="col-sm-8 mt-2">
                            <span id="t_tgl_awal_polis">: <?= date("d F Y", strtotime($list['tgl_awal_polis'])) ?></span>
                        </div>
                    </div>  
                    <div class="form-group row">
                        <label for="tgl_awal" class="col-sm-4 col-form-label">Tanggal Akhir Polis</label>
                        <div class="col-sm-8 mt-2">
                            <span id="t_tgl_akhir_polis">: <?= date("d F Y", strtotime($list['tgl_akhir_polis'])) ?></span>
                        </div>
                    </div>  
                    <div class="form-group row">
                        <label for="tgl_awal" class="col-sm-4 col-form-label">Tertanggung</label>
                        <div class="col-sm-8 mt-2">
                            <span class="t_tertanggung">: <?= $list['nama'] ?></span>
                        </div>
                    </div>  
                    <div class="form-group row">
                        <label for="tgl_awal" class="col-sm-4 col-form-label">Total Premi</label>
                        <div class="col-sm-8 mt-2">
                            <span id="t_premi">: Rp. <?= number_format($list['premi'],0,'.','.') ?></span>
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