<div class="card shadow">
	<div class="card-header mb-0">
		<button class="btn btn-light float-right" id="batalin"><i class="mdi mdi-close mdi-18px"></i></button>
		<h5 class="mb-0 mt-1">Detail Entry Claim</h5>
	</div>
	<div class="card-body table-responsive formdetail">

		<div class="row d-flex justify-content-center">
			<div class="col-md-5 offset-md-2">
				<div class="form-group row">
					<label for="no_klaim" class="col-sm-4 col-form-label">Claim Doc Number</label>
					<div class="col-sm-4 col-md-4 mt-2">
						<span> : <span id="klaim_nomor_dok"></span> </span>
					</div>
				</div>
			</div>
			<div class="col-md-5">
				<div class="form-group row">
					<label for="klaimnodok" class="col-sm-4 col-form-label">Claim Date</label>
					<div class="col-sm-4 col-md-4 mt-2">
						<span> : <span id="tgl_klaim"></span></span>
					</div>
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-md-12">

				<ul class="nav nav-tabs d-flex justify-content-center mt-2" role="tablist">
					<li class="nav-item">
						<a class="nav-link active" data-toggle="tab" href="#home" role="tab">
							<span class="d-none d-md-block">Master SPPA Data</span><span class="d-block d-md-none"><i
									class="mdi mdi-home-variant h5"></i></span>
						</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" data-toggle="tab" href="#profile" role="tab">
							<span class="d-none d-md-block">Detail Claim</span><span class="d-block d-md-none"><i
									class="mdi mdi-account h5"></i></span>
						</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" data-toggle="tab" href="#tdoks" role="tab">
							<span class="d-none d-md-block">Detail Dokumen</span><span class="d-block d-md-none"><i
									class="mdi mdi-account h5"></i></span>
						</a>
					</li>
				</ul>

				<!-- Tab panes -->
				<div class="tab-content">
					<div class="tab-pane active p-3" id="home" role="tabpanel">
						<div class="d-flex justify-content-center mt-3">

							<input type="hidden" name="idtrklaimcob" id="idtrklaimcob" value="">
							<div class="col-md-8">
								<div class="form-group row">
									<label for="no_klaim" class="col-sm-3 col-form-label">Nomor SPPA</label>
									<div class="col-sm-9">
										<span> : <span id="sppa_number"></span> </span>
									</div>
								</div>
								<div class="form-group row">
									<label for="no_klaim" class="col-sm-3 col-form-label">Insurer</label>
									<div class="col-sm-9">
										<!-- <input type="text" class="form-control" id="asuransi" readonly> -->
										<span> : <span id="asuransi"></span> </span>
									</div>
								</div>
								<div class="form-group row">
									<label for="no_klaim" class="col-sm-3 col-form-label">COB</label>
									<div class="col-sm-9">
										<div class="form-group row mb-0">
											<div class="col-sm-12">
												<span> : <span id="kode_cob"></span> - <span id="cob"></span></span>
											</div>
										</div>
									</div>
								</div>
								<div class="form-group row">
									<label for="no_klaim" class="col-sm-3 col-form-label">LOB</label>
									<div class="col-sm-9">
										<div class="form-group row mb-0">
											<div class="col-sm-12">
												<span> : <span id="lob"></span> </span>
											</div>
										</div>
									</div>
								</div>
								<div class="form-group row">
									<label for="no_klaim" class="col-sm-3 col-form-label">PIC</label>
									<div class="col-sm-9">
										<div class="form-group row mb-0">
											<div class="col-sm-8">
												<span> : <span id="pic"></span></span>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="tab-pane p-3" id="profile" role="tabpanel">
						<div class="d-flex justify-content-center mt-3">
							<div class="col-md-8">
								<div class="form-group row">
									<label for="no_klaim" class="col-sm-3 col-form-label">Insured</label>
									<div class="col-sm-9">
										<div class="form-group row mb-0">
											<div class="col-sm-8">
												<span> : <span id="nama_nasabah"></span></span>
											</div>
										</div>
									</div>
								</div>

								<div class="form-group row">
									<label for="no_klaim" class="col-sm-3 col-form-label">Keterangan Klaim</label>
									<div class="col-sm-9">
										<span> : <span id="keterangan_klaim"></span></span>
									</div>
								</div>
								<div class="form-group row">
									<label for="no_klaim" class="col-sm-3 col-form-label">Kejadian</label>
									<div class="col-sm-9">
										<span> : <span id="kejadian"></span></span>
									</div>
								</div>
								<div class="form-group row">
									<label for="no_klaim" class="col-sm-3 col-form-label">Lokasi Kejadian</label>
									<div class="col-sm-9">
										<span> : <span id="lokasi_kejadian"></span></span>
									</div>
								</div>
								<div class="form-group row">
									<label for="no_klaim" class="col-sm-3 col-form-label">Penyebab</label>
									<div class="col-sm-9">
										<span> : <span id="penyebab"></span></span>
									</div>
								</div>
								<div class="form-group row">
									<label for="no_klaim" class="col-sm-3 col-form-label">Nilai Klaim</label>
									<div class="col-sm-9">
										<span> : <span id="nilai_klaim"></span></span>
									</div>
								</div>


							</div>
						</div>
					</div>


					<div class="tab-pane p-3" id="tdoks" role="tabpanel">

						<hr>

						<table class="mt-3 table table-bordered table-hover dt-responsive nowrap tabel_dok"
							style="border-collapse: collapse; border-spacing: 0; width: 100%;" id="tabel_dok" width="100%"
							cellspacing="0">
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
</div>
</div>
