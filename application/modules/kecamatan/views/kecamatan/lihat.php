<div class="page-title-box">
  <div class="row align-items-center">
    <div class="col-sm-6"><h4 class="page-title"><?= $title ?></h4></div>
    <div class="col-sm-6">
      <?php echo bredcumx(); ?>
    </div>
  </div>
</div>

<div class="row">
  <?php if ($role['view'] == true || $role == null): ?>
	<div class="col-md-7">
		<div class="card">
			<div class="card-body">
				<table id="datatable" class="table table-bordered dt-responsive nowrap"
					style="border-collapse: collapse; border-spacing: 0; width: 100%;">
					<thead>
						<tr>
                <th width="5%">No</th>
                <th width="20%">Kota</th>
                <th width="20%">Kecamatan</th>
                <th width="5%">Aksi</th>
						</tr>
					</thead>
				</table>
			</div>
		</div>
	</div>
	<div class="col-md-5">
		<div class="card">
			<div class="card-body">

			<form id="collectz" method="post">

			<input type="hidden"  name="id_kecamatan" id="idkec" value="" required>
				<div class="form-group row">
					<label for="nama_negara" class="col-sm-3 col-form-label">Negara<b style="color:red;">*</b></label>
					<div class="col-sm-8">
						<input type="hidden" name="idkta" id="idkta" value="">
						<select class="form-control select2" name="nama_negara" id="nama_negara" onchange="getprovinsi(this.value,0)">
							<option value="">-- Pilih Negara --</option>
							<?php foreach ($list_negara as $key => $value): ?>
							<option value="<?= $value->id_negara ?>"><?= $value->negara ?></option>
							<?php endforeach; ?>
						</select>
					</div>
				</div>

				<div class="form-group row">
					<label for="nama_provinsi" class="col-sm-3 col-form-label">Provinsi<b style="color:red;">*</b></label>
					<div class="col-sm-8">
						<select class="form-control select2" name="nama_provinsi" id="nama_provinsi" onchange="getkota(this.value,0)">
							<option value="">-- Pilih Provinsi --</option>
						</select>
					</div>
				</div>

				<div class="form-group row">
						<label for="id_kota" class="col-sm-3 col-form-label">Kota<b style="color:red;">*</b></label>
						<div class="col-sm-8">
							<select class="form-control select2" name="id_kota" id="id_kota">
								<option value="">-- Pilih Kab/ Kota --</option>
							</select>
						</div>
					</div>

				<div class="form-group row">
					<label for="id_kecamatan" class="col-sm-3 col-form-label">Kecamatan<b style="color:red;">*</b></label>
					<div class="col-sm-8">
						<input type="text" name="kecamatan" id="kecamatan" class="form-control" placeholder="Kecamatan" required/>
					</div>
				</div>

				
        <i class="text-center" style="color:red;">('*') Form Harus di Isi</i>
				<div class="form-group text-right">
            <?php if ($role['create'] == true || $role == null): ?>
					<button class="btn btn-primary waves-effect waves-light" id="senddata">Submit</button>
            <?php endif; ?>
					<button class="btn btn-secondary waves-effect m-l-5" id="clearall">Cancel</button>
				</div>
			</div>
			</form>
		</div>
	</div>
  <?php endif; ?>
</div>



	<!-- Modal SPPA-->
	<div class="modal fade f_modal" id="exampleModal" tabindex="-1" role="dialog"
		aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered-lg" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLongTitle">Detail Kecamatan</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<div class="col-md-8">
						<div class="form-group row">
							<label for="klaimnodok" class="col-sm-4 col-form-label">Negara</label>
							<div class="col-sm-8 col-md-8 mt-2">
								<span> : <span id="namanegara"></span></span>
							</div>
						</div>
					</div>
					<div class="col-md-8">
						<div class="form-group row">
							<label for="klaimnodok" class="col-sm-4 col-form-label">Provinsi</label>
							<div class="col-sm-8 col-md-8 mt-2">
								<span> : <span id="prvinsi"></span></span>
							</div>
						</div>
					</div>
					
					<div class="col-md-8">
						<div class="form-group row">
							<label for="klaimnodok" class="col-sm-4 col-form-label">Kota</label>
							<div class="col-sm-8 col-md-8 mt-2">
								<span> : <span id="kota"></span></span>
							</div>
						</div>
					</div>
					
					<div class="col-md-8">
						<div class="form-group row">
							<label for="klaimnodok" class="col-sm-4 col-form-label">Kecamatan</label>
							<div class="col-sm-8 col-md-8 mt-2">
								<span> : <span id="kecam"></span></span>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>


<script type="text/javascript">
	var tabel_kecamatan = '';
	$(document).ready(function () {
        
    // custom jika butuh approve maka tambahkan { .'_'.$role['approve'] }
    var act = "<?=$role['update'].'_'.$role['delete']?>";
        tabel_kecamatan = $('#datatable').DataTable({
            "processing" : true,
            "serverSide" : true,
            "order" : [],
            "ajax" : {
                "url" : "<?php echo base_url(); ?>kecamatan/ajaxdatakec/"+act,
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

		$('#clearall').on('click', function (e) {
			e.preventDefault();
			$('#kecamatan').val('');
			$('#id_kecamatan').val(null).trigger('change');
			$('#id_kota').val(null).trigger('change');
			$('#nama_negara').val(null).trigger('change');
			$('#nama_provinsi').val(null).trigger('change');
			$('#desa').val('');
			$('#id_desa').val('');
			$('#idkec').val('');
		});

		$('#senddata').on('click', function (e) {
			e.preventDefault();
			// var id_kecamatan = $('#id_kecamatan').val();
			// var desa = $('#desa').val();
			var idkec = $('#idkec').val();
			if (idkec == "") { //insert
				$.ajax({
					type: "POST",
					url: "<?php echo base_url(); ?>kecamatan/addkec",
					beforeSend: function () {
						swal({
							title: 'Menunggu',
							html: 'Memproses Data',
							onOpen: () => {
								swal.showLoading();
							}
						})
					},
					// data: {
					// 	id_kecamatan: id_kecamatan,
					// 	desa: desa,
					// },
					
          data : $('#collectz').serialize(),
					dataType: "JSON",
					success  : function (data) {
            swal({
              title             : data['status'],
              text              : data['pesan'],
              type              : data['altr'],
              showConfirmButton : false,
              timer             : 3000
            });
						if (data['altr'] != 'warning') {
              $('#clearall').trigger('click');
            }
						tabel_kecamatan.ajax.reload();
						return true;
					},
					error: function (jqXHR, textStatus, errorThrown) {
						swal({
							title: "Peringatan",
							text: "Koneksi Tidak Terhubung",
							type: 'warning',
							showConfirmButton: false,
							timer: 3000
						});
						return false;
					}
				});
			} else { //update
				$.ajax({
					type: "POST",
					url: "<?php echo base_url(); ?>kecamatan/editkec/" + idkec,
					beforeSend: function () {
						swal({
							title: 'Menunggu',
							html: 'Memproses Data',
							onOpen: () => {
								swal.showLoading();
							}
						})
					},
					data: $('#collectz').serialize(),
					dataType: "JSON",
					success  : function (data) {
            swal({
              title             : data['status'],
              text              : data['pesan'],
              type              : data['altr'],
              showConfirmButton : false,
              timer             : 3000
            });
						if (data['altr'] != 'warning') {
              $('#clearall').trigger('click');
            }
						// $('#desa').val('');
						// $('#id_kecamatan').val('');
						// $('#id_desa').val('');
						tabel_kecamatan.ajax.reload();
						return true;
					},
					error: function (jqXHR, textStatus, errorThrown) {
						swal({
							title: "Peringatan",
							text: "Koneksi Tidak Terhubung",
							type: 'warning',
							showConfirmButton: false,
							timer: 3000
						});
						return false;
					}
				});
			}
		});
	});

	
	function ubahubah(id) {
		window.scrollTo(0, 0);
		$.ajax({
			type: "GET",
			url: "<?php echo base_url(); ?>kecamatan/showkec/" + id,
			success: function (data) {
				var hss = JSON.parse(data);
				console.log(hss);
				$('#idkec').val(hss[0]['id_kecamatan']);
				$('#kecamatan').val(hss[0]['kecamatan']);
				$('#id_kota').val(hss[0]['id_kota']);
				$('#nama_negara').val(hss[0]['id_negara']).trigger('change');
				getprovinsi(hss[0].id_negara,hss[0].id_provinsi);
				getkota(hss[0].id_provinsi,hss[0].id_kota);
			},
			error: function (jqXHR, textStatus, errorThrown) {
				swal({
					title: "Peringatan",
					text: "Koneksi Tidak Terhubung",
					type: 'warning',
					showConfirmButton: false,
					timer: 3000
				});
				return false;
			}
		});
	}

	function deletedel(id) {
		swal({
			title: 'Konfirmasi',
			text: 'Yakin akan Menghapus Kecamatan',
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
					url: "<?php echo base_url(); ?>kecamatan/removekec/" + id,
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
							text: "Kecamatan telah di Hapus",
							type: 'success',
							showConfirmButton: false,
							timer: 3000
						});
						// location.reload();
						tabel_kecamatan.ajax.reload();
						return true;
					},
					error: function (jqXHR, textStatus, errorThrown) {
						swal({
							title: "Peringatan",
							text: "Koneksi Tidak Terhubung",
							type: 'warning',
							showConfirmButton: false,
							timer: 3000
						});
						return false;
					}
				});
			} else if (result.dismiss === swal.DismissReason.cancel) {
				swal({
					title: "Batal",
					text: 'Anda membatalkan Hapus Kecamatan',
					buttonsStyling: false,
					confirmButtonClass: "btn btn-primary",
					type: 'error',
					showConfirmButton: false,
					timer: 3000
				});
			}
		});
	}

	
  function getprovinsi(isi, cek) {
    $("#nama_provinsi").empty();
    if (isi != '') {
      $.ajax({
        type:"GET",
        url:"<?php echo base_url(); ?>kecamatan/provinsibynegara/"+isi,
        dataType : "JSON",
        success  : function (data) {
          var prv = "<option value=''>-- Pilih Provinsi --</option>";
          for (var i = 0; i < data.length; i++) {
            if (cek == 0) {
              prv = prv+"<option value='"+data[i].id_provinsi+"'>"+data[i].provinsi+"</option>";
            } else {
              if (cek == data[i].id_provinsi) {
                prv = prv+"<option value='"+data[i].id_provinsi+"' selected>"+data[i].provinsi+"</option>";
              } else {
                prv = prv+"<option value='"+data[i].id_provinsi+"'>"+data[i].provinsi+"</option>";
              }
            }
          }
          $('#nama_provinsi').append(prv);
        }
      });
    } else {
      $('#nama_provinsi').append("<option value=''>-- Pilih Provinsi --</option>");
    }
  }
	
  function getkota(isi, cek) {
    $("#id_kota").empty();
    if (isi != '') {
      $.ajax({
        type:"GET",
        url:"<?php echo base_url(); ?>kecamatan/kotabyprovinsi/"+isi,
        dataType : "JSON",
        success  : function (data) {
          var prv = "<option value=''>-- Pilih Kab/ Kota --</option>";
          for (var i = 0; i < data.length; i++) {
            if (cek == 0) {
              prv = prv+"<option value='"+data[i].id_kota+"'>"+data[i].kota+"</option>";
            } else {
              if (cek == data[i].id_kota) {
                prv = prv+"<option value='"+data[i].id_kota+"' selected>"+data[i].kota+"</option>";
              } else {
                prv = prv+"<option value='"+data[i].id_kota+"'>"+data[i].kota+"</option>";
              }
            }
          }
          $('#id_kota').append(prv);
        }
      });
    } else {
      $('#id_kota').append("<option value=''>-- Pilih Kab/ Kota --</option>");
    }
  }


	function detail2(id) {
		window.scrollTo(0, 0);
		$.ajax({
			type: "GET",
			url: "<?php echo base_url(); ?>kecamatan/showkec/" + id,
			success: function (data) {
				var hss = JSON.parse(data);
				console.log(hss);
				$('.f_modal').modal();
				$('#kecam').html(hss[0]['kecamatan']);
				$('#kota').html(hss[0]['kota']);
				$('#prvinsi').html(hss[0]['provinsi']);
				$('#namanegara').html(hss[0]['negara']);
			},
			error: function (jqXHR, textStatus, errorThrown) {
				swal({
					title: "Peringatan",
					text: "Koneksi Tidak Terhubung",
					type: 'warning',
					showConfirmButton: false,
					timer: 3000
				});
				return false;
			}
		});
	}
</script>
