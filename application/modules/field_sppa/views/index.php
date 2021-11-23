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
        <div class="card-body">
          <table id="datafild" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
            <thead class="thead-light text-center">
              <tr>
                <th>No</th>
                <th>Field SPPA</th>
                <th>Data Type</th>
                <th>Status CDB</th>
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
          <div class="form-group">
            <label>Nama Field SPPA<b style="color:red;">*</b></label>
            <input type="hidden" id="idfisp" name="idfisp" value="">
            <input type="text" name="nmfisp" id="nmfisp" class="form-control" required placeholder="Field SPPA"/>
          </div>
          <div class="form-group">
            <label>Data Type<b style="color:red;">*</b></label>
            <select name="data_type" id="data_type" class="select2">
              <option value="">Pilih</option>
              <option value="INT8">Angka (INT)</option>
              <option value="FLOAT8">Angka Decimal (FLOAT)</option>
              <option value="VARCHAR">Huruf Angka (VARCHAR)</option>
              <option value="DATE">Tanggal (DATE)</option>
              <option value="TIMESTAMP">Tanggal dan Waktu (TIMESTAMP)</option>
              <option value="TEXT">Text (TEXT)</option>
            </select>
          </div>
          <div class="form-group mt-2">
            <div class="custom-control custom-switch">
              <input type="checkbox" name="cdb" class="custom-control-input" id="cdb">
              <label class="custom-control-label" for="cdb">Aktifkan Status CDB (Client Database)</label>
            </div>
          </div>
          <hr>
          <i style="color:red;">('*') Menandakan Form Harus di Isi</i>
          <div class="form-group text-center mt-2 mb-0">
            <?php if ($role['create'] == true || $role == null): ?>
              <button type="button" class="btn btn-primary waves-effect waves-light mr-2" id="senddata">Submit</button>
            <?php endif; ?>
            <button type="button" class="btn btn-secondary waves-effect" id="clearall">Cancel</button>
          </div>
        </div>
      </div>
    </div>
  </div>
<?php endif; ?>

<script type="text/javascript">
  var table_field = '';
  $(document).ready(function () {
    var act = "<?=$role['update'].'_'.$role['delete']?>";
    table_field = $('#datafild').DataTable({
      "processing" : true,
      "serverSide" : true,
      "order" : [],
      "ajax" : {
        "url" : "<?php echo base_url(); ?>field_sppa/ajaxdata/"+act,
        "type" : "POST"
      },
      "columnDefs" : [{
        "targets" : [0,4],
        "orderable" : false
      },{
        'targets' : [0,3,4],
        'className' : 'text-center',
      }]
    });

    $('#clearall').on('click', function () {
      $('#nmfisp').val('');
      $('#idfisp').val('');
      $('#data_type').val('').trigger('change');
      $('#cdb').prop('checked', false);
    });

    $('#senddata').on('click', function () {
      var nmfi      = $('#nmfisp').val();
      var idfi      = $('#idfisp').val();
      var data_type = $('#data_type').val();
      var cdb       = $('#cdb').prop('checked');

      if (idfi == "") {

        if (nmfi == '' || data_type == '') {

          swal({
            title             : "Peringatan",
            text              : "Harap lengkapi data",
            type              : 'warning',
            showConfirmButton : false,
            timer             : 3000
          });

          return false;

        }

        $.ajax({
          type:"POST",
          url:"<?php echo base_url(); ?>field_sppa/add",
          beforeSend : function () {
            swal({
              title  : 'Menunggu',
              html   : 'Memproses Data',
              onOpen : () => {
                swal.showLoading();
              }
            })
          },
          data: { nmfield:nmfi, data_type:data_type, cdb:cdb },
          dataType : "JSON",
          success  : function (data) {
            if (data['status'] == 'sukses') {
              swal({
                title             : "Berhasil",
                text              : "Field SPPA telah di Tambahkan",
                type              : 'success',
                showConfirmButton : false,
                timer             : 3000
              });
              $('#nmfisp').val('');
              $('#idfisp').val('');
              $('#data_type').val('').trigger('change');
              $('#cdb').prop('checked', false);
              table_field.ajax.reload();
            } else {
              swal({
                title             : "Gagal",
                text              : "Field SPPA Tersebut telah Ada",
                type              : 'error',
                showConfirmButton : false,
                timer             : 3000
              });
            }
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
      } else {

        if (nmfi == '' || data_type == '') {

          swal({
            title             : "Peringatan",
            text              : "Harap lengkapi data",
            type              : 'warning',
            showConfirmButton : false,
            timer             : 3000
          });

          return false;

        }

        $.ajax({
          type:"POST",
          url:"<?php echo base_url(); ?>field_sppa/edit/"+idfi,
          beforeSend : function () {
            swal({
              title  : 'Menunggu',
              html   : 'Memproses Data',
              onOpen : () => {
                swal.showLoading();
              }
            })
          },
          data: { nmfield:nmfi, data_type:data_type, cdb:cdb },
          dataType : "JSON",
          success  : function (data) {
            if (data['status'] == 'sukses') {
              swal({
                title             : "Berhasil",
                text              : "Field SPPA telah di Update",
                type              : 'success',
                showConfirmButton : false,
                timer             : 3000
              });
              $('#nmfisp').val('');
              $('#idfisp').val('');
              $('#data_type').val('').trigger('change');
              $('#cdb').prop('checked', false);
              table_field.ajax.reload();
            } else {
              swal({
                title             : "Gagal",
                text              : "Field SPPA Tersebut telah Ada",
                type              : 'error',
                showConfirmButton : false,
                timer             : 3000
              });
            }
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
      url:"<?php echo base_url(); ?>field_sppa/show/"+id,
      success  : function (data) {
        var hss = JSON.parse(data);

        var cdb;
        if (hss[0]['cdb'] == 't') {
          cdb = true;
        } else {
          cdb = false;
        }

        $('#nmfisp').val(hss[0]['field_sppa']);
        $('#idfisp').val(hss[0]['id_field_sppa']);
        $('#data_type').val(hss[0]['data_type']).trigger('change');
        $('#cdb').prop('checked', cdb);

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
      text        : 'Yakin akan Menghapus Field',
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
          url:"<?php echo base_url(); ?>field_sppa/remove/"+id,
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
              text              : "Field SPPA telah di Hapus",
              type              : 'success',
              showConfirmButton : false,
              timer             : 3000
            });
            table_field.ajax.reload();
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
          text                : 'Anda membatalkan Hapus Field',
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
