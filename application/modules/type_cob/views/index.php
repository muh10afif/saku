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
      <div class="card">
        <div class="card-body">
          <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
            <thead>
              <tr>
                <th>No</th>
                <th>Type COB</th>
                <th>Action</th>
              </tr>
            </thead>
          </table>
        </div>
      </div>
    </div>
    <div class="col-md-5">
      <div class="card">
        <div class="card-body">
          <div class="card-body">
            <div class="form-group">
              <label>Type COB<b style="color:red;">*</b></label>
              <input type="hidden" id="idcob" name="" value="">
              <input type="text" name="nmcob" id="nmcob" class="form-control" required placeholder="Type COB"/>
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
  </div>
<?php endif; ?>

<script type="text/javascript">
  var table_cob = '';
  $(document).ready(function () {
    var act = "<?=$role['update'].'_'.$role['delete']?>";
    table_cob = $('#datatable').DataTable({
      "processing" : true,
      "serverSide" : true,
      "order" : [],
      "ajax" : {
        "url" : "<?php echo base_url(); ?>type_cob/ajaxdata/"+act,
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
      $('#nmcob').val('');
      $('#idcob').val('');
    });

    $('#senddata').on('click', function () {
      var nmcob = $('#nmcob').val();
      var idcob = $('#idcob').val();
      if (nmcob == "" || nmcob == " ") {
        swal({
          title             : "Gagal",
          text              : "Form Tipe COB Belum di Isi",
          type              : 'warning',
          showConfirmButton : false,
          timer             : 3000
        });
      } else {
        if (idcob == "") { //insert
          $.ajax({
            type:"POST",
            url:"<?php echo base_url(); ?>type_cob/add",
            beforeSend : function () {
              swal({
                title  : 'Menunggu',
                html   : 'Memproses Data',
                onOpen : () => {
                  swal.showLoading();
                }
              })
            },
            data: { tcob:nmcob },
            dataType : "JSON",
            success  : function (data) {
            swal({
              title             : data['status'],
              text              : data['pesan'],
              type              : data['altr'],
              showConfirmButton : false,
              timer             : 1000
            });
            if (data['altr'] == 'success') {
              $('#clearall').trigger('click');
            }
            table_cob.ajax.reload();
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
            url:"<?php echo base_url(); ?>type_cob/edit/"+idcob,
            beforeSend : function () {
              swal({
                title  : 'Menunggu',
                html   : 'Memproses Data',
                onOpen : () => {
                  swal.showLoading();
                }
              })
            },
            data: { tcob:nmcob },
            dataType : "JSON",
            success  : function (data) {
            swal({
              title             : data['status'],
              text              : data['pesan'],
              type              : data['altr'],
              showConfirmButton : false,
              timer             : 1000
            });
            if (data['altr'] == 'success') {
              $('#clearall').trigger('click');
            }
            table_cob.ajax.reload();
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
      url:"<?php echo base_url(); ?>type_cob/show/"+id,
      success  : function (data) {
        var hss = JSON.parse(data);
        $('#nmcob').val(hss[0]['tipe_cob']);
        $('#idcob').val(hss[0]['id_tipe_cob']);
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
      text        : 'Yakin akan Menghapus Type COB',
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
          url:"<?php echo base_url(); ?>type_cob/remove/"+id,
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
              text              : "Type COB telah di Hapus",
              type              : 'success',
              showConfirmButton : false,
              timer             : 3000
            });
            // location.reload();
            table_cob.ajax.reload();
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
          text                : 'Anda membatalkan Hapus Type COB',
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
