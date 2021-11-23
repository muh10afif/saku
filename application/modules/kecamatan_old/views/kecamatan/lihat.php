<div class="page-title-box">
	<div class="row align-items-center">
		<div class="col-sm-6">
			<h4 class="page-title"><?= $title ?></h4>
		</div>
		<div class="col-sm-6">
			<ol class="breadcrumb float-right">
				<li class="breadcrumb-item"><a href="<?= base_url() ?>">Legowo</a></li>
				<li class="breadcrumb-item active"><?= $title ?></li>
			</ol>
		</div>
	</div>
</div>

<div class="row">
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

				<form id="collect" method="post">

					<input type="hidden" name="id_kecamatan" id="idkec" value="" required>
					<div class="form-group row">
						<label for="nama_negara" class="col-sm-3 col-form-label">Negara<b style="color:red;">*</b></label>
						<div class="col-sm-8">
							<input type="hidden" name="idkta" id="idkta" value="">
							<select class="form-control select2" name="nama_negara" id="nama_negara"
								onchange="getprovinsi(this.value,0)">
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
							<select class="form-control select2" name="nama_provinsi" id="nama_provinsi"
								onchange="getkota(this.value,0)">
								<option value="">-- Pilih Provinsi --</option>
							</select>
						</div>
					</div>

					<div class="form-group row">
						<label for="id_kota" class="col-sm-3 col-form-label">Kota<b style="color:red;">*</b></label>
						<div class="col-sm-8">
							<input type="hidden" name="idkta" id="idkta" value="">
							<select class="form-control select2" name="id_kota" id="id_kota">
								<option value="">-- Pilih Negara --</option>
							</select>
						</div>
					</div>

					<div class="form-group row">
						<label class="col-sm-3 col-form-label">Kecamatan<b style="color:red;">*</b></label>
						<div class="col-sm-8">
							<input type="text" name="kecamatan" id="kecamatan" value="" class="form-control" placeholder="Nama Kecamatan"
								required />
						</div>
					</div>

					<i class="text-center" style="color:red;">('*') Form Harus di Isi</i>
					<div class="form-group text-right">
						<button class="btn btn-primary waves-effect waves-light" id="senddata">Submit</button>
						<button class="btn btn-secondary waves-effect m-l-5" id="clearall">Cancel</button>
					</div>
			</div>
			</form>
		</div>
	</div>
	</div>

<script type="text/javascript">
	var tabel_kecamatan = '';
	$(document).ready(function () {
        
        tabel_kecamatan = $('#datatable').DataTable({
            "processing" : true,
            "serverSide" : true,
            "order" : [],
            "ajax" : {
                "url" : "<?php echo base_url(); ?>kecamatan/ajaxdatakac",
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
			$('#id_kota').val('');
			$('#idkec').val('');
		});

		$('#senddata').on('click', function (e) {
			e.preventDefault();
			// var kecamatan = $('#kecamatan').val();
			// var id_kota = $('#id_kota').val();
			var idkec = $('#idkec').val();
			if (idkec == "") { //insert
				$.ajax({
					type: "POST",
					url: "<?php echo base_url(); ?>kecamatan/add",
					beforeSend: function () {
						swal({
							title: 'Menunggu',
							html: 'Memproses Data',
							onOpen: () => {
								swal.showLoading();
							}
						})
					},
          data : $('#collect').serialize(),
					dataType: "JSON",
					success  : function (data) {
            swal({
              title             : data['status'],
              text              : data['pesan'],
              type              : data['altr'],
              showConfirmButton : false,
              timer             : 2000
            });
						if (data['altr'] != 'warning') {
              $('#clearall').trigger('click');
            }
						// $('#kecamatan').val('');
						// $('#id_kota').val('');
            tabel_kecamatan.ajax.reload();
            return true;
          },
					error: function (jqXHR, textStatus, errorThrown) {
						swal({
							title: "Peringatan",
							text: "Koneksi Tidak Terhubung",
							type: 'warning',
							showConfirmButton: false,
							timer: 2500
						});
						return false;
					}
				});
			} else { //update
				$.ajax({
					type: "POST",
					url: "<?php echo base_url(); ?>kecamatan/editkecamatan/" + idkec,
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
						kecamatan: kecamatan,
            idkec:idkec,
						id_kota: id_kota
					},
					
          data : $('#collect').serialize(),
					dataType: "JSON",
					success  : function (data) {
            swal({
              title             : data['status'],
              text              : data['pesan'],
              type              : data['altr'],
              showConfirmButton : false,
              timer             : 2000
            });
            // tabel_kecamatan.ajax.reload();
            // return false;
						if (data['altr'] != 'warning') {
              $('#clearall').trigger('click');
            }
						// $('#kecamatan').val('');
						// $('#id_kota').val('');
            tabel_kecamatan.ajax.reload();
            return true;
          
					},
					error: function (jqXHR, textStatus, errorThrown) {
						swal({
							title: "Peringatan",
							text: "Koneksi Tidak Terhubung",
							type: 'warning',
							showConfirmButton: false,
							timer: 2500
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
					timer: 2500
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
							timer: 2500
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
							timer: 2500
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
					timer: 2500
				});
			}
		});
	}

	
  function getprovinsi(isi, cek) {
    $("#nama_provinsi").empty();
    if (isi != '') {
      $.ajax({
        type:"GET",
        url:"<?php echo base_url(); ?>provinsi/provinsibynegara/"+isi,
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
          var prv = "<option value=''>-- Pilih Provinsi --</option>";
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
      $('#id_kota').append("<option value=''>-- Pilih Kota --</option>");
    }
  }
</script>
