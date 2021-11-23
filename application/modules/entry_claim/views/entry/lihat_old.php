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
<!-- Page-Title -->
<div class="page-title-box">
	<div class="row align-items-center">
		<div class="col-sm-6">
			<h4><?= $title ?></h4>
		</div>
		<div class="col-sm-6">
			<ol class="breadcrumb float-right">
				<li class="breadcrumb-item"><a href="<?= base_url() ?>">All COB</a></li>
				<li class="breadcrumb-item">Transaction</li>
				<li class="breadcrumb-item">Outgoing</li>
				<li class="breadcrumb-item active"><?= $title ?></li>
			</ol>
		</div>
	</div>
</div>

<input type="hidden" id="status_toggle">

<div class="row">
	<div class="col-md-12 f_detail" style="display: none;">
		<?php $this->load->view('/entry/detail'); ?>
	</div>

<!-- <div class="row">
	<div class="col-md-12 f_ubah" style="display: none;">
		<?php //$this->load->view('/entry/edit'); ?>
	</div>
</div> -->

<div class="row">
  <?php if ($role['view'] == true || $role == null): ?>
	<div class="col-md-12 f_tambah" style="display: none;">

		<div class="card shadow">
			<div class="card-header mb-0">
				<button class="btn btn-light float-right batal_entry"><i class="mdi mdi-close mdi-18px"></i></button>
				<h5 id="judul" class="mb-0 mt-1"></h5>
			</div>
			<div class="card-body table-responsive formdetail">

				<div class="row d-flex justify-content-center">
					<div class="col-md-5 offset-md-2">

						<div class="form-group row">
							<label for="getkode" class="col-sm-4 col-form-label">Claim Doc Number</label>
							<div class="col-sm-4">
								<input type="text" class="form-control" name="getkode" id="getkode" readonly>
							</div>
						</div>
					</div>
					<div class="col-md-5">
						<div class="form-group row">
							<label for="klaimnodok" class="col-sm-3 col-form-label">Claim Date</label>
							<div class="col-sm-4 col-md-4 mt-2">
								<span id="tgl_klaim" class="date-part"></span>
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

									<!-- <input type="hidden" name="sppaid" id="sppaid" value=""> -->
									<input type="hidden" name="id_data_klaim" id="id_data_klaim" value="">
									<div class="col-md-8">
										<div class="form-group row">
											<label for="no_klaim" class="col-sm-3 col-form-label">Nomor SPPA<b style="color:red;">*</b></label>
											<div class="col-sm-6">
												
												<select name="sppaid" id="sppaid" class="form-control">
													<option value="">Pilih SPPA Number</option>
													<?php foreach ($list_sppa as $s){ ?>
															<option name="sppaid" id="sppaid" class="sppaidd" value="<?= $s['id_sppa_quotation'] ?>"><?= $s['sppa_number'] ?></option>
													<?php } ?>
                    		</select>

											</div>
											<div class="col-sm-3">
												<!-- <button class="btn btn-primary btn-block"  data-target="#exampleModalCenter">View Full
															Header</button> -->
												<button type="button" class="btn btn-primary" data-toggle="modal"
													data-target="#exampleModalCenter" id="buttonsppa" disabled>
													View Info SPPA
												</button>
											</div>
										</div>
										<div class="form-group row">
											<label for="no_klaim" class="col-sm-3 col-form-label">Insurer</label>
											<div class="col-sm-9">
												<input type="text" class="form-control" id="nama_asuransi" readonly>
											</div>
										</div>
										<div class="form-group row">
											<label for="no_klaim" class="col-sm-3 col-form-label">COB</label>
											<div class="col-sm-9">
												<div class="form-group row mb-0">
													<div class="col-sm-3">
														<input type="text" class="form-control" id="cob1" readonly>
													</div>
													<div class="col-sm-9">
														<input type="text" class="form-control" id="cob2" readonly>
													</div>
												</div>
											</div>
										</div>
										<div class="form-group row">
											<label for="no_klaim" class="col-sm-3 col-form-label">LOB</label>
											<div class="col-sm-9">
												<div class="form-group row mb-0">
													<!-- <div class="col-sm-3">
														<input type="text" class="form-control" id="lob" readonly>
													</div> -->
													<div class="col-sm-12">
														<input type="text" class="form-control" id="lob2" readonly>
													</div>
												</div>
											</div>
										</div>
										<div class="form-group row">
											<label for="no_klaim" class="col-sm-3 col-form-label">PIC<b style="color:red;">*</b></label>
											<div class="col-sm-9">
												<!-- <select name="pc" id="pc" class="form-control select2">
													<option value="">Pilih</option>
													<?php //foreach ($karyawan as $key) { ?>
													<option name="pc" id="pc" value="<?php //echo $key->id_karyawan; ?>">
														<?php //$key->nama_karyawan; ?></option>
													<?php //} ?>
												</select> -->
                        <select name="pc" id="pc" class="form-control">
														<option value="">Pilih Insured</option>
														<?php foreach ($karyawan as $s): ?>
																<option name="pc" id="pc" value="<?= $s['id_karyawan'] ?>"><?= $s['nama_karyawan'] ?></option>
														<?php endforeach; ?>
													</select>
												<!-- <input type="text" class="form-control" id="pc" name="pc" readonly> -->
											</div>
										</div>

                    <i class="text-center" style="color:red;">('*') Form Harus di Isi</i>
									</div>
								</div>
							</div>
							<div class="tab-pane p-3" id="dua" role="tabpanel">
								<div class="d-flex justify-content-center mt-3">
									<div class="col-md-8">
										<div class="form-group row">
											<label for="no_klaim" class="col-sm-3 col-form-label">Insured<b style="color:red;">*</b></label>
											<div class="col-sm-9">
												<div class="form-group row mb-0">
													<div class="col-sm-8">
													<select name="insuredid" id="insuredid" class="form-control">
														<option value="">Pilih Insured</option>
														<?php foreach ($list_nasabah as $s): ?>
																<option name="insuredid" id="insuredid" value="<?= $s['id_nasabah'] ?>"><?= $s['nama_nasabah'] ?></option>
														<?php endforeach; ?>
													</select>

													</div>
													<div class="col-sm-4">
														<button type="button" class="btn btn-primary" data-toggle="modal"
															data-target="#insuredmodel" id="buttoninsured" disabled>
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
												<textarea type="text" cols="5" class="form-control" name="keteranganklm"
													id="keteranganklm"></textarea>
											</div>
										</div>
										<div class="form-group row">
											<label for="no_klaim" class="col-sm-3 col-form-label">Kejadian<b style="color:red;">*</b></label>
											<div class="col-sm-9">
												<input type="text" class="form-control validasiform" name="kejdan" id="kejdan">
											</div>
										</div>
										<div class="form-group row">
											<label for="no_klaim" class="col-sm-3 col-form-label">Lokasi
												Kejadian<b style="color:red;">*</b></label>
											<div class="col-sm-9">
												<input type="text" class="form-control validasiform" name="lokasikejadian" id="lokasikejadian">
											</div>
										</div>
										<div class="form-group row">
											<label for="no_klaim" class="col-sm-3 col-form-label">Penyebab<b style="color:red;">*</b></label>
											<div class="col-sm-9">
												<input type="text" class="form-control validasiform" name="sebab" id="sebab">
											</div>
										</div>
										<div class="form-group row">
											<label for="no_klaim" class="col-sm-3 col-form-label">Nilai Klaim<b style="color:red;">*</b></label>
											<div class="col-sm-9">
												<input type="text" class="form-control validasiform ribuan1 numeric number_separator" name="nilaiklaim" id="nilaiklaim">
											</div>
										</div>
										<?php //echo form_open_multipart('outgoing/do_upload');?>
										<?php //echo $error;?>
										<!-- <div class="form-group row">
											<label for="berkas" class="col-sm-3 col-form-label">Dokumen
												Pendukung</label>
											<div class="col-sm-9">
												<input type="file" class="form-control validasiform" name="berkas[]"
													id="berkas" multiple=""><br>
												<span>* Upload Dokumen Pendukung</span>
											</div>
										</div> -->

                    <i class="text-center" style="color:red;">('*') Form Harus di Isi</i>
									</div>
								</div>
							</div>


							<div class="tab-pane p-3" id="t_dok" role="tabpanel">

              <div class="d-flex justify-content-center mb-1 mt-3">

                  <div class="col-md-5">
                    <div class="form-group row">
                      <label for="no_klaim" class="col-sm-3 col-form-label text-right">Dokumen Pendukung</label>
                      <div class="col-sm-9">
                      <input type="file" class="form-control" name="berkas[]" id="berkas" multiple="">
                      </div>
                    </div>
                  </div>
                  <div class="col-md-5">
                      <div class="form-group row">
                        <label for="no_klaim" class="col-sm-3 col-form-label text-right">Deskripsi</label>
                        <div class="col-sm-9">
                          <input type="input" id="desc" class="form-control" name="desc" placeholder="Masukkan Deskripsi">
                        </div>
                      </div>
                  </div>

								</div>
								<hr>

								<table class="mt-3 table table-bordered table-hover dt-responsive nowrap tabel_doks"
									style="border-collapse: collapse; border-spacing: 0; width: 100%;" id="tabel_doks" width="100%"
									cellspacing="0">
									<thead class="thead-light text-center">
										<tr>
											<th width="5%">No</th>
											<th>Filename</th>
											<th>Size</th>
											<th>Date</th>
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
            <?php if ($role['create'] == true || $role == null): ?>
						<button type="submit" id="senddata" class="btn btn-primary mr-2"><i class="ti-check-box mr-2"></i>Simpan</button>
						<?php endif; ?>
						<button type="button" id="clearall" class="btn btn-danger batal_entry"><i class="ti-na mr-2"></i>Batal</button>
					</div>
				</div>
			</div>
		</div>
	</div>

  <?php endif; ?>
</div>
	<!-- </form> -->


	<!-- Modal SPPA-->
	<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog"
		aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered-lg" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLongTitle">Detail SPPA</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<div class="col-md-8">
						<div class="form-group row">
							<label for="klaimnodok" class="col-sm-4 col-form-label">SPPA Number</label>
							<div class="col-sm-8 col-md-8 mt-2">
								<span> : <span id="sppanumberr"></span></span>
							</div>
						</div>
					</div>
					<div class="col-md-8">
						<div class="form-group row">
							<label for="klaimnodok" class="col-sm-4 col-form-label">Total Premi</label>
							<div class="col-sm-8 col-md-8 mt-2">
								<span> : <span id="total_tagihan"></span></span>
							</div>
						</div>
					</div>
					
					<div class="col-md-8">
						<div class="form-group row">
							<label for="klaimnodok" class="col-sm-4 col-form-label">Tipe Pembayaran</label>
							<div class="col-sm-8 col-md-8 mt-2">
								<span> : <span id="payment_method"></span></span>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- Modal SPPA-->
	<div class="modal fade" id="insuredmodel" tabindex="-1" role="dialog"
		aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered-lg" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLongTitle">Detail Insured</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<div class="col-md-8">
						<div class="form-group row">
							<label for="klaimnodok" class="col-sm-4 col-form-label">Kode Insured</label>
							<div class="col-sm-8 col-md-8 mt-2">
								<span> : <span id="kode_nasabah"></span></span>
							</div>
						</div>
					</div>
					<div class="col-md-8">
						<div class="form-group row">
							<label for="klaimnodok" class="col-sm-4 col-form-label">Nama Nasabah</label>
							<div class="col-sm-8 col-md-8 mt-2">
								<span> : <span id="namanasabah"></span></span>
							</div>
						</div>
					</div>
					<div class="col-md-8">
						<div class="form-group row">
							<label for="klaimnodok" class="col-sm-4 col-form-label">Tanggal Lahir</label>
							<div class="col-sm-8 col-md-8 mt-2">
								<span> : <span id="tgl_lahir"></span></span>
							</div>
						</div>
					</div>
					<div class="col-md-8">
						<div class="form-group row">
							<label for="klaimnodok" class="col-sm-4 col-form-label">Alamat Rumah</label>
							<div class="col-sm-8 col-md-8 mt-2">
								<span> : <span id="alamat_rumah"></span></span>
							</div>
						</div>
					</div>
					<div class="col-md-8">
						<div class="form-group row">
							<label for="klaimnodok" class="col-sm-4 col-form-label">Nomor Telp</label>
							<div class="col-sm-8 col-md-8 mt-2">
								<span> : <span id="telp"></span></span>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>


<div class="row">
<div class="col-md-12">
	<div class="card shadow">
		<div class="card-header">
			<button class="btn btn-primary float-right" id="tambah_entry"><i class="ti-plus mr-2"></i> Tambah
				Data</button>
			<h5 id="judul" class="mb-0 mt-1">Claim Register</h5>
		</div>
		<div class="card-body">
			<table class="table table-bordered table-hover dt-responsive nowrap"
				style="border-collapse: collapse; border-spacing: 0; width: 100%;" id="datatable" width="100%"
				cellspacing="0">
				<thead class="thead-light text-center">
					<tr>
						<th width="5%">No</th>
						<th>Claim Date</th>
						<th>No Binding</th>
						<th>Claim Type</th>
						<th>Claim Value</th>
						<th>Status</th>
						<th width="15%">Aksi</th>
					</tr>
				</thead>
				<!-- <tbody>
                        <tr>
                            <td>1.</td>
                            <td>CVBBBB</td>
                            <td>23-04-2021</td>
                            <td>BIN09837</td>
                            <td>KLKK</td>
                            <td>MMO</td>
                            <td>Aktif</td>
                            <td align="center"><button type="button" class="btn btn-success mr-2"><i class="ti-pencil"></i></button><button type="button" class="btn btn-danger mr-2"><i class="ti-close"></i></button><button type="button" class="btn btn-info"><i class="ti-info"></i></button></td>
                        </tr>
                    </tbody> -->
			</table>
		</div>
	</div>
</div>
</div>
</div>
</div>

<input type="hidden" name="file_baru" id="imageupload" value="">

<script>
var tabel_outgoing = '';
var tabel_doks = '';

    $(document).ready(function () {

        var gambar = [];

            function readFile(unggah) {
            var jumlahimage = unggah.files.length;
            for (var i=0; i < jumlahimage ; i++){
            if (unggah.files && unggah.files[i]) {
                
                var FR= new FileReader();
                
                FR.addEventListener("load", function(e) {
                    // return e.target.result;
                    gambar.push(e.target.result);
                }); 
                
                FR.readAsDataURL( unggah.files[i] );
            }}
            
            
        }
        console.log(gambar);

        const img = document.querySelector('#berkas');
            img.addEventListener('change', function (event) {
            const dataUrl = readFile(this);
        });
        
				// custom jika butuh approve maka tambahkan { .'_'.$role['approve'] }
				var act = "<?=$role['update'].'_'.$role['delete']?>";
				
        tabel_outgoing = $('#datatable').DataTable({
            "processing" : true,
            "serverSide" : true,
            "order" : [],
            "ajax" : {
                "url" : "<?php echo base_url(); ?>outgoing/ajaxdata/"+act,
                "type" : "POST"
            },
            "columnDefs" : [{
                "targets" : [0,3],
                "orderable" : false
            },{
                'targets' : [0,3],
                'className' : 'text-center',
            }],
            "scrollX" : true
        });
				getnomor();

        $('#tambah_entry').on('click', function () {
            $('.f_tambah').slideToggle('fast', function() {
                if ($(this).is(':visible')) {
                    $('#status_toggle').val(1);          
                } else {  
                    $('#status_toggle').val(0);            
                }

                $('#judul').text('Form Tambah Data');
								
                // $('.f_tambah').slideDown();
                // $(".f_detail").slideUp();
                // $(".f_ubah").slideUp();
            });
        })  
        

			function getnomor() {
				$.ajax({
        url     : "<?= base_url('outgoing/get_kode') ?>",
        method  : "POST",
        dataType: "JSON",
        success : function (data) {
					console.log(data);
					$('#getkode').val(data.klaim_nomor_dok);
          
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            swal({
                title               : "Gagal",
                text                : 'Gagal proses data',
                type                : 'error',
                showConfirmButton   : false,
                timer               : 1000
            }); 

            return false;
        }
      })
			}

				
        // aksi batal entry
        $('.batal_entry').on('click', function () {
            $('#form_entry').trigger("reset");
            // 
            $('#aksi').val('Tambah');
            $('.hapus-entry').removeAttr('hidden');
            $('.f_tambah').slideToggle('fast', function() {
                if ($(this).is(':visible')) {
                    $('#status_toggle').val(1);          
                } else {  
                    $('#status_toggle').val(0);            
                }        
            });
            $('#tambah_entry').attr('hidden', false);
						
						location.reload();
        })

        // aksi detail x
        $('#batalin').on('click', function () {
            
						// $('.f_tambah').slideUp();
            $(".f_detail").slideUp();
						$(".f_ubah").slideDown();
						
        })


        // tampil data
        $('#tabel_entry').on('click', '.detail', function () {

        var id_sppa     = $(this).data('id');
        var sppa_number = $(this).attr('sppa_number');

        $('.f_tab').slideUp();

        $.ajax({
            url     : "<?= base_url('outgoing/tampil_detail_sppa') ?>",
            method  : "POST",
            data    : {id_sppa:id_sppa, jenis:'entry'},
            success : function (data) {

                $('.f_tambah').slideToggle('fast', function() {
                    if ($(this).is(':visible')) {
                        $('#status_toggle').val(1);          
                    } else {  
                        $('#status_toggle').val(0);            
                    }        
                });
                
                $('.f_tab').html(data);
                $('.f_tab').fadeIn(30);

                $('#sppa_number').text(sppa_number);

                $('#judul').text('Detail SPPA');

                $('.footer_input').slideUp();

            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                swal({
                    title               : "Gagal",
                    text                : 'Gagal Menampilkan Data',
                    type                : 'error',
                    showConfirmButton   : false,
                    timer               : 1000
                }); 

                return false;
            }
        })

        })
        
        $('#senddata').on('click', function () {
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
        var file_baru = $('#berkas').val();
				var berkas = file_baru.replace("C:\\fakepath\\","");
        var desc = $('#desc').val();
        var getkode = $('#getkode').val();

        var validasi = [];
        $('.validasiform').each(function (key , obj) {
            if (obj.value == null || obj.value == ''){
                validasi.push(false);
            }else{
                validasi.push(true);
            }
        });

        if(!validasi.includes(false)){
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
                data: { 
												pc:pc, 
                        keteranganklm:keteranganklm,
                        sppaid:sppaid,
                        kejdan:kejdan,
                        lokasikejadian:lokasikejadian,
                        sebab:sebab,
                        insuredid:insuredid,
                        nama_file:nama_file,
                        berkas:berkas,
                        desc:desc,
                        nilaiklaim:nilaiklaim,
                        upload:gambar,
                        getkode:getkode,
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
										console.log(data);
										$('.f_tambah').slideToggle('fast', function() {
												if ($(this).is(':visible')) {
														$('#status_toggle').val(1);          
												} else {  
														$('#status_toggle').val(0);            
												}
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
												$('#desc').val('');
												$('#sebab').val('');
												$('#upload').val('');
												$('#getkode').val('');

												$('#judul').text('Form Tambah Data');
												
										});
                    
										getnomor();
										location.reload();
                    tabel_outgoing.ajax.reload();
                    return true;
                },
                error: function (jqXHR, textStatus, errorThrown) {
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
                    $('#desc').val('');
                    $('#sebab').val('');
                    $('#upload').val('');
						tabel_outgoing.ajax.reload();
						return true;
                }
                });
            } else {
							swal({
								title: 'Konfirmasi',
								text: 'Yakin akan Mengupdate Data ?',
								type: 'warning',
								buttonsStyling: false,
								confirmButtonClass: "btn btn-primary",
								cancelButtonClass: "btn btn-warning mr-3",
								showCancelButton: true,
								confirmButtonText: 'Ya',
								confirmButtonColor: '#3085d6',
								cancelButtonColor: '#d33',
								cancelButtonText: 'Batal',
								reverseButtons: true
							}).then((result) => {
			if (result.value) {
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
                data: { 
												pc:pc, 
												id_data_klaim:id_data_klaim, 
                        keteranganklm:keteranganklm,
                        sppaid:sppaid,
                        kejdan:kejdan,
                        lokasikejadian:lokasikejadian,
                        sebab:sebab,
                        insuredid:insuredid,
                        nama_file:nama_file,
                        berkas:berkas,
                        desc:desc,
                        nilaiklaim:nilaiklaim,
                        upload:gambar },
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
                    $('#desc').val('');
                    $('#sebab').val('');
                    $('#upload').val('');
										location.reload();
                    tabel_outgoing.ajax.reload();
                    return true;
                    
                },
                error: function (jqXHR, textStatus, errorThrown) {
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
                    $('#desc').val('');
                    $('#sebab').val('');
                    $('#upload').val('');
										location.reload();
                    tabel_outgoing.ajax.reload();
                    return true;

                    // return false;
                }
                });
							} else if (result.dismiss === swal.DismissReason.cancel) {
				swal({
					title: "Batal",
					text: 'Anda membatalkan Update Data',
					buttonsStyling: false,
					confirmButtonClass: "btn btn-primary",
					type: 'error',
					showConfirmButton: false,
					timer: 1000
				});
			}
		});
            }//end els
        } else {
            swal({
                    title             : "Peringatan",
                    text              : "Gagal Simpan Data, Form Entry Claim kosong",
                    type              : 'warning',
                    showConfirmButton : false,
                    timer             : 1000
                    });
        }

        
        });

        $('#sppaid').on("change",function(){
            var sppaid = $(this).val();
            $.ajax({
                url:"<?php echo base_url(); ?>outgoing/getdata?sppa_id="+sppaid,
                type:"get",
                dataType : "JSON",
                success : function(hasil){
                    // $('#insurer').val(hasil.insurer);
                    $('#cob1').val(hasil.kode_cob);
                    $('#cob2').val(hasil.cob);
                    $('#lob').val(hasil.kode_lob);
                    $('#lob2').val(hasil.lob);
                    $('#nama_asuransi').val(hasil.nama_asuransi);
                }
            });
            $.ajax({
                url:"<?php echo base_url(); ?>outgoing/getdatasppa?sppa_id="+sppaid,
                type:"get",
                dataType : "JSON",
                success : function(hasil){
                    // $('#insurer').val(hasil.insurer);
                    $('#sppanumberr').html(hasil.sppa_number);
                    $('#kode_cob').html(hasil.kode_cob);
                    $('#cob').html(hasil.cob);
                    $('#kode_lob').html(hasil.kode_lob);
                    $('#lob').html(hasil.lob);
                    $('#payment_method').html(hasil.payment_method);
                    $('#nama_asuransi').html(hasil.nama_asuransi);
                    $('#jumlah_cicilan').html(hasil.jumlah_cicilan);
                    $('#tahun_cicilan').html(hasil.tahun_cicilan);
                    $('#total_tagihan').html(hasil.total_tagihan);
                    $('#no_invoice_entry').html(hasil.no_invoice_entry);
                }
            });

            if(sppaid == null || sppaid == ''){
                $('#buttonsppa').addClass('sppabutton');
                $('#buttonsppa').attr('disabled',true);
            } else{
                $('#buttonsppa').removeClass('sppabutton');
                $('#buttonsppa').removeAttr('disabled');
            }

            if(sppaid == null || sppaid == ''){
                $('#buttonsppa2').addClass('sppabutton');
                $('#buttonsppa2').attr('disabled',true);
            } else{
                $('#buttonsppa2').removeClass('sppabutton');
                $('#buttonsppa2').removeAttr('disabled');
            }

        })

        $('.sppabutton').on('click', function(){
            return false;
        })

        $('#insuredid').on("change",function(){
            var insuredid = $(this).val();
            $.ajax({
                url:"<?php echo base_url(); ?>outgoing/getdatainsured?id_nasabah="+insuredid,
                type:"get",
                dataType : "JSON",
                success : function(hasil){
                    $('#kode_nasabah').html(hasil.kode_nasabah);
                    $('#namanasabah').html(hasil.nama_nasabah);
                    $('#tgl_lahir').html(hasil.tgl_lahir);
                    $('#tempat_dinas').html(hasil.tempat_dinas);
                    $('#alamat_rumah').html(hasil.alamat_rumah);
                    $('#telp').html(hasil.telp);
                    $('#nik').html(hasil.nik);
                    $('#jenis_kelamin').html(hasil.jenis_kelamin);
                }
            })

            if(insuredid == null || insuredid == ''){
                $('#buttoninsured').addClass('insuredbutton');
                $('#buttoninsured').attr('disabled',true);
            } else{
                $('#buttoninsured').removeClass('insuredbutton');
                $('#buttoninsured').removeAttr('disabled');
            }

            if(insuredid == null || insuredid == ''){
                $('#buttoninsured2').addClass('insuredbutton');
                $('#buttoninsured2').attr('disabled',true);
            } else{
                $('#buttoninsured2').removeClass('insuredbutton');
                $('#buttoninsured2').removeAttr('disabled');
            }
        })

        $('.insuredbutton').on('click', function(){
            return false;
        })


				var interval = setInterval(function() {
        var momentNow = moment();
            $('.date-part').html(momentNow.format('dddd')
                                .toUpperCase() + ', ' +
                                momentNow.format('DD MMMM YYYY')
                                );
            $('.tgl-part').html(momentNow.format('dddd')
                                .toUpperCase() + '<br>' +
                                momentNow.format('DD MMMM YYYY')
                                );
            $('.time-part').html(momentNow.format('HH:mm:ss'));
        }, 100);
    }); // End document ready

    
	function ubahubah(id) {
		window.scrollTo(0, 0);
		$.ajax({
			type: "GET",
			url: "<?php echo base_url(); ?>outgoing/showout/" + id,
			success: function (data) {
                $('.f_tambah').slideDown();
                $(".f_detail").slideUp();
                $('#judul').text('Form Ubah Data');

								
								var hss = JSON.parse(data);

                $('#id_data_klaim').val(hss[0]['id_data_klaim']);
                $('#sppaid').val(hss[0]['id_sppa']);
                $('#pc').val(hss[0]['id_karyawan']).trigger('change');
								$('#sppaid').val(hss[0]['id_sppa']).trigger('change');
                $('#insuredid').val(hss[0]['id_insured']).trigger('change');
                $('#keteranganklm').val(hss[0]['keterangan_klaim']);
                $('#kejdan').val(hss[0]['kejadian']);
                $('#lokasikejadian').val(hss[0]['lokasi_kejadian']);
                $('#nilaiklaim').val(hss[0]['nilai_klaim']);
                $('#nama_file').val(hss[0]['nama_file']);
                $('#berkas').val(hss[0]['berkas']);
                $('#desc').val(hss[0]['desc']);
                $('#kodecob').val(hss[0]['kode_cob']);
                $('#cob').val(hss[0]['cob']);
                $('#kodelob').val(hss[0]['kode_lob']);
                $('#lob').val(hss[0]['lob']);
                $('#getkode').val(hss[0]['klaim_nomor_dok']);
                $('#sebab').val(hss[0]['penyebab']);

								
                $('#sppaid').attr('disabled',true);
								// if($('#sppaid') == null || $('#sppaid') == ''){
                // $('.sppas').addClass('sppaid');
                // $('.sppas').attr('disabled',true);
								// } else{
								// 		$('.sppas').removeClass('sppaid');
								// 		$('.sppas').removeAttr('disabled');
								// }
								
                  // menampilkan tabel dok
                var tabel_doks = $('.tabel_doks').DataTable({
                    "processing"        : true,
                    "order"             : [],
                    "ajax"              : {
                        "url"   : "<?= base_url() ?>outgoing/tampil_data_dokumen2",
                        "type"  : "POST",
                        "data"  : function (data) {
                            data.id_data_klaim    = $('#id_data_klaim').val();
                        },
                    },
                    "columnDefs"        : [{
                        "targets"   : [0,3],
                        "orderable" : false
                    }, {
                        'targets'   : [0,3],
                        'className' : 'text-center',
                    }],
                    'bDestroy': true
                })
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

	function number_format (number, decimals, dec_point, thousands_sep) {
        number = (number + '').replace(/[^0-9+\-Ee.]/g, '');

        var n = !isFinite(+number) ? 0 : +number,
        prec  = !isFinite(+decimals) ? 0 : Math.abs(decimals),
        sep   = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
        dec   = (typeof dec_point === 'undefined') ? '.' : dec_point,
        s = '',
        toFixedFix = function (n, prec) {
            var k = Math.pow(10, prec);
            return '' + Math.round(n * k) / k;
        };
        s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
        if (s[0].length > 3) {
            s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
        }
        if ((s[1] || '').length < prec) {
            s[1] = s[1] || '';
            s[1] += new Array(prec - s[1].length + 1).join('0');
        }
        return s.join(dec);

    }

	function lihatdetail(id) {
		window.scrollTo(0, 0);
		$.ajax({
			type: "GET",
			url: "<?php echo base_url(); ?>outgoing/tampil_detail/" + id,
			success: function (data) {
				$('.f_tambah').slideUp();
                // $(".f_detail").html(data);
                $(".f_detail").slideDown();
                var hss = JSON.parse(data);
                console.log(hss[0]['id_data_klaim']);
                $('#idtrklaimcob').val(hss[0]['id_data_klaim']);
                $('#id_sppa').html(hss[0]['id_sppa']);
                $('#pic').html(hss[0]['nama_karyawan']);
                $('#klaim_nomor_dok').html(hss[0]['klaim_nomor_dok']);
								$('#nama_nasabah').html(hss[0]['nama_nasabah']).trigger('change');
                $('#id_insured').html(hss[0]['id_insured']);
                $('#sppa_number').html(hss[0]['sppa_number']);
                $('#lob').html(hss[0]['lob']);
                $('#cob').html(hss[0]['cob']);
                $('#kode_cob').html(hss[0]['kode_cob']);
                $('#kode_lob').html(hss[0]['kode_lob']);
                $('#keterangan_klaim').html(hss[0]['keterangan_klaim']);
                $('#tgl_klaim').html( hss[0]['tgl_klaim']);
                $('#asuransi').html( hss[0]['nama_asuransi']);
								
                $('#kejadian').html(hss[0]['kejadian']);
                $('#lokasi_kejadian').html(hss[0]['lokasi_kejadian']);
                $('#nilai_klaim').html(number_format(hss[0]['nilai_klaim']),0,',','.');
                $('#nama_file').html(hss[0]['nama_file']);
                $('#berkas').html(hss[0]['berkas']);
                $('#penyebab').html(hss[0]['penyebab']);

                 // menampilkan tabel dok
                var tabel_dok = $('.tabel_dok').DataTable({
                    "processing"        : true,
                    "order"             : [],
                    "ajax"              : {
                        "url"   : "<?= base_url() ?>outgoing/tampil_data_dokumen",
                        "type"  : "POST",
                        "data"  : function (data) {
                            data.id_data_klaim    = $('#idtrklaimcob').val();
                        },
                    },
                    "columnDefs"        : [{
                        "targets"   : [0,3],
                        "orderable" : false
                    }, {
                        'targets'   : [0,3],
                        'className' : 'text-center',
                    }],
                    'bDestroy': true
                })

                $('.footer_input').slideUp();

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

    

	function deletedel(id) {
		swal({
			title: 'Konfirmasi',
			text: 'Yakin akan Menghapus Data ?',
			type: 'warning',
			buttonsStyling: false,
			confirmButtonClass: "btn btn-primary",
			cancelButtonClass: "btn btn-warning mr-3",
			showCancelButton: true,
			confirmButtonText: 'Ya',
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			cancelButtonText: 'Batal',
			reverseButtons: true
		}).then((result) => {
			if (result.value) {
				$.ajax({
					type: "GET",
					url: "<?php echo base_url(); ?>outgoing/remove/" + id,
					beforeSend: function () {
						swal({
							title: 'Menunggu',
							html: 'Memproses Data',
							onOpen: () => {
								swal.showLoading();
							}
						})
					},
					success: function (data) {
						swal({
							title: "Berhasil",
							text: "Data telah di Hapus",
							type: 'success',
							showConfirmButton: false,
							timer: 1000
						});
						// location.reload();
						tabel_outgoing.ajax.reload();
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
			} else if (result.dismiss === swal.DismissReason.cancel) {
				swal({
					title: "Batal",
					text: 'Anda membatalkan Hapus Data',
					buttonsStyling: false,
					confirmButtonClass: "btn btn-primary",
					type: 'error',
					showConfirmButton: false,
					timer: 1000
				});
			}
		});
	}

	function deletedok(id) {
		swal({
			title: 'Konfirmasi',
			text: 'Yakin akan Menghapus Data ?',
			type: 'warning',
			buttonsStyling: false,
			confirmButtonClass: "btn btn-primary",
			cancelButtonClass: "btn btn-warning mr-3",
			showCancelButton: true,
			confirmButtonText: 'Ya',
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			cancelButtonText: 'Batal',
			reverseButtons: true
		}).then((result) => {
			if (result.value) {
				$.ajax({
					type: "GET",
					url: "<?php echo base_url(); ?>outgoing/removedok/" + id,
					beforeSend: function () {
						swal({
							title: 'Menunggu',
							html: 'Memproses Data',
							onOpen: () => {
								swal.showLoading();
							}
						})
					},
					success: function (data) {
						swal({
							title: "Berhasil",
							text: "Data telah di Hapus",
							type: 'success',
							showConfirmButton: false,
							timer: 1000
						});
						// location.reload();
						$('#tabel_doks').ajax.reload();
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
			} else if (result.dismiss === swal.DismissReason.cancel) {
				swal({
					title: "Batal",
					text: 'Anda membatalkan Hapus Data',
					buttonsStyling: false,
					confirmButtonClass: "btn btn-primary",
					type: 'error',
					showConfirmButton: false,
					timer: 1000
				});
			}
		});
	}


    
</script>