<div class="page-title-box">
  <div class="row align-items-center">
    <div class="col-sm-6"><h4><?= $title ?></h4></div>
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
          <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
            <thead>
              <tr>
                <th>No</th>
                <th>Status Klaim</th>
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
            <label>Status Klaim<b style="color:red;">*</b></label>
            <input type="hidden" name="idsk" id="idsk" value="">
            <input type="text" name="nmsk" id="nmsk" class="form-control" required placeholder="Status Klaim"/>
          </div>
          <i class="text-center" style="color:red;">('*') Menandakan Form Harus di Isi</i>
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
  var table_status = '';
  $(document).ready(function () {
    var act = "<?=$role['update'].'_'.$role['delete']?>";
    table_status = $('#datatable').DataTable({
      "processing" : true,
      "serverSide" : true,
      "order" : [],
      "ajax" : {
        "url" : "<?php echo base_url(); ?>status_klaim/ajaxdata/"+act,
        "type" : "POST"
      },
      "columnDefs" : [{
        "targets" : [0,2],
        "orderable" : false
      },{
        'targets' : [0,2],
        'className' : 'text-center',
      }],
      "scrollX" : true
    });

    $('#clearall').on('click', function () {
      $('#nmsk').val('');
      $('#idsk').val('');
    });

    $('#senddata').on('click', function () {
      var nmsk = $('#nmsk').val();
      var idsk = $('#idsk').val();
      if (nmsk == "") {
        swal({
          title             : "Gagal",
          text              : "Form Status Klaim Belum di Isi",
          type              : 'warning',
          showConfirmButton : false,
          timer             : 3000
        });
        return false;
      } else {
        if (idsk == '') {
          $.ajax({
            type:"POST",
            url:"<?php echo base_url(); ?>status_klaim/add",
            beforeSend : function () {
              swal({
                title  : 'Menunggu',
                html   : 'Memproses Data',
                onOpen : () => {
                  swal.showLoading();
                }
              })
            },
            data: { nmstatusk:nmsk },
            dataType : "JSON",
            success  : function (data) {
              if (data['status'] == 'sukses') {
                swal({
                  title             : "Berhasil",
                  text              : "Status Klaim telah di Tambahkan",
                  type              : 'success',
                  showConfirmButton : false,
                  timer             : 3000
                });
                $('#nmsk').val('');
                $('#idsk').val('');
                table_status.ajax.reload();
              } else {
                swal({
                  title             : "Gagal",
                  text              : "data Status Klaim tersebut sudah ada",
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
          $.ajax({
            type:"POST",
            url:"<?php echo base_url(); ?>status_klaim/edit/"+idsk,
            beforeSend : function () {
              swal({
                title  : 'Menunggu',
                html   : 'Memproses Data',
                onOpen : () => {
                  swal.showLoading();
                }
              })
            },
            data: { nmstatusk:nmsk },
            dataType : "JSON",
            success  : function (data) {
              if (data['status'] == 'sukses') {
                swal({
                  title             : "Berhasil",
                  text              : "Status Klaim telah di Update",
                  type              : 'success',
                  showConfirmButton : false,
                  timer             : 3000
                });
                $('#nmsk').val('');
                $('#idsk').val('');
                table_status.ajax.reload();
              } else {
                swal({
                  title             : "Gagal",
                  text              : "data Status Klaim tersebut sudah ada",
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
      }
    });
  });

  function ubahubah(id) {
    window.scrollTo(0,0);
    $.ajax({
      type:"GET",
      url:"<?php echo base_url(); ?>status_klaim/show/"+id,
      success  : function (data) {
        var hss = JSON.parse(data);
        $('#nmsk').val(hss[0]['status_klaim']);
        $('#idsk').val(hss[0]['id_status_klaim']);
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
      text        : 'Yakin akan Menghapus Status Klaim',
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
          url:"<?php echo base_url(); ?>status_klaim/remove/"+id,
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
              text              : "Status Klaim telah di Hapus",
              type              : 'success',
              showConfirmButton : false,
              timer             : 3000
            });
            table_status.ajax.reload();
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
          text                : 'Anda membatalkan Hapus Status Klaim',
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