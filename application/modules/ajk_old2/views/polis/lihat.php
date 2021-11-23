<style>
    input[type=checkbox] {
        transform: scale(1.3);
    }
</style>
<!-- Page-Title -->
<div class="page-title-box f_tutup">
    <div class="row align-items-center">
        <div class="col-sm-6">
            <h4><?= $title ?></h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-right">
                <li class="breadcrumb-item"><a href="<?= base_url() ?>">AJK</a></li>
                <li class="breadcrumb-item active">Polis</li>
            </ol>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12 f_ubah" style="display: none;">
    <?php $this->load->view('ajk/polis/edit'); ?>
    </div>
</div>

<div class="row">
    <div class="col-md-12 f_detail" style="display: none;">
    <?php $this->load->view('ajk/polis/detail'); ?>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        
        <div class="card shadow f_tutup">
            <div class="card-header">
                <a href="<?= base_url('ajk/polis/form_tambah_data') ?>"><button class="btn btn-primary float-right" id="tambah_data"><i class="ti-plus mr-2"></i>Tambah Data</button></a>
                <button class="btn btn-primary float-right mr-3" id="upload_data" data-toggle="modal" data-target=".add_excel"><i class="ti-import mr-2"></i>Upload Excel</button>
                <h5 id="judul" class="mb-0 mt-1"><i class="mdi mdi-filter mr-1"></i> Filter</h5>
            </div>
            <div class="card-body table-responsive">

                <div class="d-flex justify-content-center">
                    <div class="col-md-8">
                        <div class="form-group row">
                            <label for="no_polis" class="col-sm-3 col-form-label">No Polis</label>
                            <div class="col-sm-9">
                                <input class="form-control" type="text" id="no_polis">
                            </div>
                        </div>   
                        <div class="form-group row">
                            <label for="nama_nasabah" class="col-sm-3 col-form-label">Nama Nasabah</label>
                            <div class="col-sm-9">
                                <input class="form-control" type="text" id="nama_nasabah">
                            </div>
                        </div>   
                        <div class="form-group row">
                            <label for="cabang" class="col-sm-3 col-form-label">Cabang Bank</label>
                            <div class="col-sm-9">
                                <select name="nama_cabang_bank" id="nama_cabang_bank" class="select2" require>
                                    <option value="">-- Pilih Cabang --</option>
                                    <?php foreach ($list_bank as $bank) { ?>
										<option value="<?php echo $bank->id_cabang_bank; ?>">
										<?php echo $bank->nama_cabang_bank; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div> 
                        <div class="form-group row">
                            <label for="nm_nasabah" class="col-sm-3 col-form-label">Range Tanggal</label>
                            <div class="col-sm-9">
                                <div class="input-daterange input-group" id="date-range">
                                    <input type="text" class="form-control" name="start" placeholder="Start Date" />
                                    <input type="text" class="form-control" name="end" placeholder="End Date" />
                                </div>
                            </div>
                        </div>  
                        <div class="form-group row">
                            <label for="nm_nasabah" class="col-sm-3 col-form-label">Spesifik Tanggal</label>
                            <div class="col-sm-9">
                                <div class="input-group">
                                    <input type='text' name="tgl_mulai" id="tgl_mulai" class="form-control datepicker text-center"value="<?= date("d-m-Y", now('Asia/Jakarta')) ?>" readonly>
                                    <div class="input-group-append">
                                        <span class="input-group-text">
                                            <span class="ti-calendar"></span>
                                        </span>
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
                    
                    </div>
                    <div class="col-md-6 d-flex justify-content-end">
                    <button type="button" id="btn-filter" class="btn btn-primary mr-2"><i class="ti-check-box mr-2"></i>Tampilkan</button>
                    <button type="button" id="btn-reset" tgl="<?= date('d-m-Y', now('Asia/Jakarta')) ?>" class="btn btn-danger"><i class="ti-na mr-2"></i>Reset</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="card mt-2 shadow f_tutup">
            <div class="card-body">
                
                <table class="table table-bordered table-hover dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;" id="tabel_polis" width="100%" cellspacing="0">
                    <thead class="thead-light text-center">
                        <tr>
                            <th><input type="checkbox"></th>
                            <th width="5%">No</th>
                            <th>No Polis</th>
                            <th>Nama Nasabah</th>
                            <th>Tanggal Mulai</th>
                            <th>Lama (Bulan)</th>
                            <th>Pembiayaan</th>
                            <th>Rate</th>
                            <th>Premi</th>
                            <th>Premi Fax</th>
                            <th width="15%">Aksi</th>
                        </tr>
                    </thead>
                    <!-- <tbody>
                        <tr>
                            <td align="center"><input type="checkbox"></td>
                            <td>1.</td>
                            <td>PLS1292</td>
                            <td>Ahmad</td>
                            <td>21 April 2021</td>
                            <td>5 Bulan</td>
                            <td>2.000.000</td>
                            <td>15</td>
                            <td>500.000</td>
                            <td>200.000</td>
                            <td align="center"><button type="button" class="btn btn-success mr-2"><i class="ti-pencil"></i></button><button type="button" class="btn btn-danger mr-2"><i class="ti-close"></i></button><a href="<?= base_url('ajk/polis/detail/1') ?>"><button type="button" class="btn btn-info"><i class="ti-info"></i></button></a></td>
                        </tr>
                    </tbody> -->
                </table>

                <span class="mb-2">Multiple Check : <button class="btn btn-warning ml-2 text-white">Verifikasi</button></span> 
            </div>
        </div>
    </div>
</div>

<div class="modal fade add_excel" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0">Tambah Data via Excel</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="d-flex justify-content-center">
                    <div class="col-md-8">
                    <form action="<?= base_url('ajk/polis/import_excel'); ?>" method="post" enctype="multipart/form-data">
                        <div class="form-group row">
                            <label for="upload_excel" class="col-sm-4 col-form-label">Upload Excel</label>
                            <div class="col-sm-8">
                                <input class="form-control" type="file" id="upload_excel" name="fileExcel">
                            </div>
                        </div>   
                        <a href="<?= base_url('ajk/polis.xls') ?>" id="url_format" download><button type="button" class="btn btn-primary mr-2 ttip" data-toggle="tooltip" data-placement="top" title="Download Format Excel"><i class="ti-download"></i></button></a>
                        <button type="button" class="btn btn-warning mr-2 ttip" onclick="preview()" data-toggle="tooltip" data-placement="top" title="Preview"><i class="ti-zoom-in"></i></button>
                        <button type="button" class="btn btn-danger mr-2 ttip" id="clear" data-toggle="tooltip" data-placement="top" title="Reset"><i class="ti-eraser"></i></button>
                    
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary waves-effect waves-light">Simpan</button>
            </div>
            </form>
        </div>
    </div>
</div>

<script>
var tabel_polis;
$(document).ready(function(){
    
    $('#clearall').on('click', function () {
            $('#idcabangbank').val('');
            $('#id_nasabah').val('');
            $('#tgl_mulai').val('');
            $('#lama_bulan').val('');
            $('#produk').val('');
            $('#rate_premi').val('');
            $('#nilai_pembiayaan').val('');
            $('#premi').val('');
            $('#premi_fax').val('');
            $('#premi_rek_koran').val('');
        });

		$('#senddataedit').on('click', function () {
			var idcabangbank = $('#kecamatan').val();
			var id_nasabah = $('#id_nasabah').val();
			var tgl_mulai = $('#tgl_mulai').val();
			var lama_bulan = $('#lama_bulan').val();
			var produk = $('#produk').val();
			var rate_premi = $('#rate_premi').val();
			var nilai_pembiayaan = $('#nilai_pembiayaan').val();
			var premi = $('#premi').val();
			var premi_fax = $('#premi_fax').val();
			var premi_rek_koran = $('#premi_rek_koran').val();
			var id_polis = $('#id_polis').val();
			if (id_polis == "") { //insert
				$.ajax({
					type: "POST",
					url: "<?php echo base_url(); ?>ajk/polis/simpan_tambah_polis",
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
						idcabangbank: idcabangbank,
						id_nasabah: id_nasabah,
						tgl_mulai: tgl_mulai,
						lama_bulan: lama_bulan,
						produk: produk,
						rate_premi: rate_premi,
						nilai_pembiayaan: nilai_pembiayaan,
						premi: premi,
						premi_fax: premi_fax,
						premi_rek_koran: premi_rek_koran,
					},
					dataType: "JSON",
					success: function (data) {
						swal({
							title: "Berhasil",
							text: "Data Polis telah di Tambahkan",
							type: 'success',
							showConfirmButton: false,
							timer: 1000
						});
						$('#idcabangbank').val('');
						$('#id_nasabah').val('');
						$('#tgl_mulai').val('');
						$('#lama_bulan').val('');
						$('#produk').val('');
						$('#rate_premi').val('');
						$('#nilai_pembiayaan').val('');
						$('#premi').val('');
						$('#premi_fax').val('');
						$('#premi_rek_koran').val('');
						tabel_polis.ajax.reload();
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
					url: "<?php echo base_url(); ?>ajk/polis/editpolis/" + id_polis,
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
						idcabangbank: idcabangbank,
						id_nasabah: id_nasabah,
						tgl_mulai: tgl_mulai,
						lama_bulan: lama_bulan,
						produk: produk,
						rate_premi: rate_premi,
						nilai_pembiayaan: nilai_pembiayaan,
						premi: premi,
						premi_fax: premi_fax,
						premi_rek_koran: premi_rek_koran,
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
						$('#idcabangbank').val('');
						$('#id_nasabah').val('');
						$('#tgl_mulai').val('');
						$('#lama_bulan').val('');
						$('#produk').val('');
						$('#rate_premi').val('');
						$('#nilai_pembiayaan').val('');
						$('#premi').val('');
						$('#premi_fax').val('');
						$('#premi_rek_koran').val('');
						tabel_polis.ajax.reload();
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

    tabel_polis = $('#tabel_polis').DataTable({
        "processing" : true,
        "serverSide" : true,
        "order" : [],
        "ajax" : {
            "url" : "<?php echo base_url(); ?>ajk/polis/ajaxdata",
            "type" : "POST",
            "data" : function(data){
                data.id_cabang_bank = $('#nama_cabang_bank').val();
			    data.nama_nasabah = $('#nama_nasabah').val();
			    data.no_polis = $('#no_polis').val();
			    data.tgl_mulai = $('#tgl_mulai').val();
            }
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
        

        $('#btn-filter').click(function(){ //button filter event click
            tabel_polis.ajax.reload();  //just reload table
        });
        $('#btn-reset').click(function(){ //button reset event click
            $('#form-filter')[0].reset();
            tabel_polis.ajax.reload();  //just reload table
        });

        $('#clearall').on('click', function () {
            $('#idcabangbank').val('');
            $('#id_nasabah').val('');
            $('#tgl_mulai').val('');
            $('#lama_bulan').val('');
            $('#produk').val('');
            $('#rate_premi').val('');
            $('#nilai_pembiayaan').val('');
            $('#premi').val('');
            $('#premi_fax').val('');
            $('#premi_rek_koran').val('');
        });
})

    // 07-Juni-2021 RFA
    function deletepolis(id) {
        swal({
        title       : 'Konfirmasi',
        text        : 'Yakin akan Menghapus Data Polis ?',
        type        : 'warning',
        buttonsStyling      : false,
        confirmButtonClass  : "btn btn-primary",
        cancelButtonClass   : "btn btn-warning mr-3",
        showCancelButton    : true,
        confirmButtonText   : 'Ya',
        confirmButtonColor  : '#3085d6',
        cancelButtonColor   : '#d33',
        cancelButtonText    : 'Batal',
        reverseButtons      : true
        }).then((result) => {
        if (result.value) {
            $.ajax({
            type:"GET",
            url:"<?php echo base_url(); ?>ajk/polis/removepolis/"+id,
            beforeSend : function () {
                swal({
                title  : 'Menunggu',
                html   : 'Memproses Data',
                onOpen : () => {
                    swal.showLoading();
                }
                })
            },
            success  : function (data) {
                swal({
                title             : "Berhasil",
                text              : "Data Polis telah di Hapus",
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
            }
            });
        } else if (result.dismiss === swal.DismissReason.cancel) {
            swal({
            title               : "Batal",
            text                : 'Anda membatalkan Hapus Data Polis',
            buttonsStyling      : false,
            confirmButtonClass  : "btn btn-primary",
            type                : 'error',
            showConfirmButton   : false,
            timer               : 1000
            });
        }
        });
    }

    // 07-Juni-2021 RFA
    function ubahpolis(id) {
            // window.scrollTo(0, 0);
            $.ajax({
                type: "GET",
                url: "<?php echo base_url(); ?>ajk/polis/tampil_detail/" + id,
                success: function (data) {
                    
                    $('.f_ubah').slideDown();
                    $('.f_detail').slideUp();
                    $(".f_tutup").slideUp();
                    // $('#judul').text('Form Ubah Data');
                    var hss = JSON.parse(data);
    
                    $('#id_polis').val(hss[0]['id_polis']);
                    $('#idcabangbank').val(hss[0]['id_cabang_bank']).trigger('change');
                    $('#id_nasabah').val(hss[0]['id_nasabah']).trigger('change');
                    $('#lama_bulan').val(hss[0]['lama_bulan']).trigger('change');
                    $('#produk').val(hss[0]['produk']).trigger('change');
                    $('#rate_premi').val(hss[0]['rate_premi']);
                    $('#nilai_pembiayaan').val(hss[0]['nilai_pembiayaan']);
                    $('#premi').val(hss[0]['premi']);
                    $('#premi_fax').val(hss[0]['premi_fax']);
                    $('#premi_rek_koran').val(hss[0]['premi_rek_koran']);
    
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

    function detail(id) {
            // window.scrollTo(0, 0);
            $.ajax({
                type: "GET",
                url: "<?php echo base_url(); ?>ajk/polis/tampil_detail/" + id,
                success: function (data) {
                    
                    $('.f_detail').slideDown();
                    $('.f_ubah').slideUp();
                    $(".f_tutup").slideUp();
                    // $('#judul').text('Form Ubah Data');
                    var hss = JSON.parse(data);
    
                    $('.idpls').html(hss[0]['id_polis']);
                    $('.idcabngbank').html(hss[0]['id_cabang_bank']).trigger('change');
                    $('.idnasabah').html(hss[0]['id_nasabah']).trigger('change');
                    $('.lamabulan').html(hss[0]['lama_bulan']).trigger('change');
                    $('.produk').html(hss[0]['produk']).trigger('change');
                    $('.ratepremi').html(hss[0]['rate_premi']);
                    $('.nilaibiaya').html(hss[0]['nilai_pembiayaan']);
                    $('.alamatrumah').html(hss[0]['alamat_rumah']);
                    $('.nilaipembiayaan').html(hss[0]['nilai_pembiayaan']);
                    $('.tglmulai').html(hss[0]['tgl_mulai']);
                    $('.premis').html(hss[0]['premi']);
                    $('.premifax').html(hss[0]['premi_fax']);
                    $('.premirekkoran').html(hss[0]['premi_rek_koran']);
                    $('.namanasabah').html(hss[0]['nama_nasabah']);
                    $('.tgllahir').html(hss[0]['tgl_lahir']);
                    $('.tempatdinas').html(hss[0]['tempat_dinas']);
                    $('.namacabangbank').html(hss[0]['nama_cabang_bank']);
    
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
</script>