<div class="page-title-box">
  <div class="row align-items-center">
    <div class="col-sm-6"><h4 class="page-title"><?= $title ?></h4></div>
    <div class="col-sm-6">
      <?php echo bredcumx(); ?>
    </div>
  </div>
</div>
<!-- form input -->
<?php if ($role['read'] == true || $role == null): ?>
  <div class="row">
    <div class="col-md-7">
      <div class="card shadow">
        <div class="card-body">
          <table id="datatable" class="table table-bordered table-hover dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
            <thead>
              <tr>
                <th>No</th>
                <th>Level Otoritas</th>
                <th>Level User</th>
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
            <label>Nama Level Otoritas<b style="color:red;">*</b></label>
            <input type="hidden" name="idoto" id="idoto" value="">
            <input type="text" name="nmoto" id="nmoto" class="form-control" required placeholder="Level Otoritas"/>
          </div>
          <div class="form-group">
            <label>Level User<b style="color:red;">*</b></label>
            <select name="idlvus" id="idlvus" class="form-control select2" required>
              <option value="">-- Pilih --</option>
              <?php foreach ($lvuser as $key) { ?>
                <option value="<?php echo $key->id_level_user; ?>"><?php echo $key->level_user; ?></option>
              <?php } ?>
            </select>
          </div>
          <i style="color:red;">('*') Menandakan Form Harus di Isi</i>
          <div class="form-group text-right">
            <?php if ($role['create'] == true || $role == null): ?>
              <button class="btn btn-primary waves-effect waves-light" id="senddata">Submit</button>
            <?php endif; ?>
            <button class="btn btn-secondary waves-effect m-l-5" id="clearall">Cancel</button>
          </div>
        </div>
      </div>
    </div>
  </div>
<?php endif; ?>

<script type="text/javascript">
  var table_oto = '';
  $(document).ready(function () {
    var act = "<?=$role['update'].'_'.$role['delete'].'_'.$role['approve']?>";
    table_oto = $('#datatable').DataTable({
      "processing" : true,
      "serverSide" : true,
      "order" : [],
      "ajax" : {
        "url" : "<?php echo base_url(); ?>level_otorisasi/ajaxdata/"+act,
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

    $('#clearall').on('click', function () {
      $('#idoto').val('');
      $('#nmoto').val('');
      $('#idlvus').val(null).trigger('change');
    });

    $('#senddata').on('click', function () {
      var nmot = $('#nmoto').val();
      var idot = $('#idoto').val();
      var idlu = $('#idlvus').val();
      if (idot == "") { //insert
        $.ajax({
          type:"POST",
          url:"<?php echo base_url(); ?>level_otorisasi/add",
          beforeSend : function () {
            swal({
              title  : 'Menunggu',
              html   : 'Memproses Data',
              onOpen : () => {
                swal.showLoading();
              }
            })
          },
          data: { lvloto:nmot, lvlusr:idlu },
          dataType : "JSON",
          success  : function (data) {
            swal({
              title             : data['judul'],
              text              : data['status'],
              type              : data['tipe'],
              showConfirmButton : false,
              timer             : 3000
            });
            if (data['tipe'] == 'success') {
              $('#clearall').trigger('click');
            }
            table_oto.ajax.reload();
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
          url:"<?php echo base_url(); ?>level_otorisasi/edit/"+idot,
          beforeSend : function () {
            swal({
              title  : 'Menunggu',
              html   : 'Memproses Data',
              onOpen : () => {
                swal.showLoading();
              }
            })
          },
          data: { lvloto:nmot, lvlusr:idlu },
          dataType : "JSON",
          success  : function (data) {
            swal({
              title             : data['judul'],
              text              : data['status'],
              type              : data['tipe'],
              showConfirmButton : false,
              timer             : 3000
            });
            if (data['tipe'] == 'success') {
              $('#clearall').trigger('click');
            }
            table_oto.ajax.reload();
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
      url:"<?php echo base_url(); ?>level_otorisasi/show/"+id,
      success  : function (data) {
        var hss = JSON.parse(data);
        $('#nmoto').val(hss[0]['level_otorisasi']);
        $('#idoto').val(hss[0]['id_level_otorisasi']);
        $('#idlvus').val(hss[0]['id_level_user']).trigger('change');
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
      text        : 'Yakin akan Menghapus Level Otoritas',
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
          url:"<?php echo base_url(); ?>level_otorisasi/remove/"+id,
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
              text              : "Level Otoritas telah di Hapus",
              type              : 'success',
              showConfirmButton : false,
              timer             : 3000
            });
            location.reload();
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
          text                : 'Anda membatalkan Hapus Level Otoritas',
          buttonsStyling      : false,
          confirmButtonClass  : "btn btn-primary",
          type                : 'error',
          showConfirmButton   : false,
          timer               : 3000
        });
      }
    });
  }

  function todetail(id) {
    window.location.href = "<?= base_url('role/admin/') ?>"+id;
  }
</script>
