<div class="page-title-box">
  <div class="row align-items-center">
    <div class="col-sm-6"><h4 class="page-title"><?= $title ?></h4></div>
    <div class="col-sm-6">
      <?php echo bredcumx(); ?>
    </div>
  </div>
</div>

<?php if ($role['read'] == true || $role == null): ?>
  <div class="row">
    <div class="col-md-7">
      <div class="card shadow">
        <div class="card-body table-responsive">
          <table id="datatable" class="table table-bordered table-hover dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
            <thead>
              <tr>
                <th>No</th>
                <th>Provinsi</th>
                <th>Negara</th>
                <th>Action</th>
              </tr>
            </thead>
          </table>
        </div>
      </div>
    </div>
    <div class="col-md-5">
      <div class="card shadow">
        <div class="card-body">
          <form id="colectprv" method="post">
            <div class="form-group row">
              <label for="nama_negara" class="col-sm-3 col-form-label">Negara<b style="color:red;">*</b></label>
              <div class="col-sm-8">
                <input type="hidden" name="idprov" id="idprov" value="">
                <select class="form-control select2" name="nama_negara" id="nama_negara">
                  <option value="">-- Pilih Negara --</option>
                  <?php foreach ($list_negara as $key => $value): ?>
                    <option value="<?= $value->id_negara ?>"><?= $value->negara ?></option>
                  <?php endforeach; ?>
                </select>
              </div>
            </div>
            <div class="form-group row">
              <label for="nama_negara" class="col-sm-3 col-form-label">Provinsi<b style="color:red;">*</b></label>
              <div class="col-sm-8">
                <input type="text" class="form-control" name="nama_provinsi" id="nama_provinsi" placeholder="Masukkan Nama Provinsi">
              </div>
            </div>
            <i class="text-center" style="color:red;">('*') Menandakan Form Harus di Isi</i>
            <div class="form-group text-right">
              <?php if ($role['create'] == true || $role == null): ?>
                <button type="button" class="btn btn-primary waves-effect waves-light" id="senddata">Submit</button>
              <?php endif; ?>
              <button type="button" class="btn btn-secondary waves-effect m-l-5" id="clearall">Cancel</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
<?php endif; ?>

<script type="text/javascript">
  var tabel_provinsi = '';
  $(document).ready(function () {
    var act = "<?=$role['update'].'_'.$role['delete']?>";
    tabel_provinsi = $('#datatable').DataTable({
      "processing" : true,
      "serverSide" : true,
      "order" : [],
      "ajax" : {
        "url" : "<?php echo base_url(); ?>provinsi/ajaxdata/"+act,
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
      $('#idprov').val('');
      $('#nama_provinsi').val('');
      $('#nama_negara').val(null).trigger('change');
    });

    $('#senddata').on('click', function (e) {
      e.preventDefault();
      var idprv = $('#idprov').val();
      if (idprv == "") { //insert
        $.ajax({
          type:"POST",
          url:"<?php echo base_url(); ?>provinsi/add",
          beforeSend : function () {
            swal({
              title  : 'Menunggu',
              html   : 'Memproses Data',
              onOpen : () => {
                swal.showLoading();
              }
            })
          },
          data : $('#colectprv').serialize(),
          dataType : "JSON",
          success  : function (data) {
            swal({
              title             : data['status'],
              text              : data['pesan'],
              type              : data['altr'],
              showConfirmButton : false,
              timer             : 3000
            });
            if (data['altr'] == 'success') {
              $('#clearall').trigger('click');
            }
            tabel_provinsi.ajax.reload();
            return true;
          },
          error: function (jqXHR, textStatus, errorThrown) {
            swal({
              title             : "Peringatan",
              text              : "Koneksi Tidak Terhubung",
              type              : 'warning',
              showConfirmButton : false,
              timer             : 3000
            });
            return false;
          }
        });
      } else { //update
        $.ajax({
          type:"POST",
          url:"<?php echo base_url(); ?>provinsi/edit/"+idprv,
          beforeSend : function () {
            swal({
              title  : 'Menunggu',
              html   : 'Memproses Data',
              onOpen : () => {
                swal.showLoading();
              }
            })
          },
          data : $('#colectprv').serialize(),
          dataType : "JSON",
          success  : function (data) {
            swal({
              title             : data['status'],
              text              : data['pesan'],
              type              : data['altr'],
              showConfirmButton : false,
              timer             : 3000
            });
            if (data['altr'] == 'success') {
              $('#clearall').trigger('click');
            }
            tabel_provinsi.ajax.reload();
            return true;
          },
          error: function (jqXHR, textStatus, errorThrown) {
            swal({
              title             : "Peringatan",
              text              : "Koneksi Tidak Terhubung",
              type              : 'warning',
              showConfirmButton : false,
              timer             : 3000
            });
            return false;
          }
        });
      }
    });
  });

  function ubahubah(id) {
    window.scrollTo(0,0);
    $.ajax({
      type:"GET",
      url:"<?php echo base_url(); ?>provinsi/show/"+id,
      success  : function (data) {
        var hss = JSON.parse(data);
        $('#idprov').val(hss[0].id_provinsi);
        $('#nama_negara').val(hss[0].id_negara).trigger('change');
        $('#nama_provinsi').val(hss[0].provinsi);
      },
      error: function (jqXHR, textStatus, errorThrown) {
        swal({
          title             : "Peringatan",
          text              : "Koneksi Tidak Terhubung",
          type              : 'warning',
          showConfirmButton : false,
          timer             : 3000
        });
        return false;
      }
    });
  }

  function deletedel(id) {
    swal({
      title       : 'Konfirmasi',
      text        : 'Yakin akan Menghapus Nama Provinsi',
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
          url:"<?php echo base_url(); ?>provinsi/remove/"+id,
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
              text              : "Nama Provinsi telah di Hapus",
              type              : 'success',
              showConfirmButton : false,
              timer             : 3000
            });
            tabel_provinsi.ajax.reload();
            return true;
          },
          error: function (jqXHR, textStatus, errorThrown) {
            swal({
              title             : "Peringatan",
              text              : "Koneksi Tidak Terhubung",
              type              : 'warning',
              showConfirmButton : false,
              timer             : 3000
            });
            return false;
          }
        });
      } else if (result.dismiss === swal.DismissReason.cancel) {
        swal({
          title               : "Batal",
          text                : 'Anda membatalkan Hapus Nama Provinsi',
          buttonsStyling      : false,
          confirmButtonClass  : "btn btn-primary",
          type                : 'error',
          showConfirmButton   : false,
          timer               : 3000
        });
      }
    });
  }
</script>
