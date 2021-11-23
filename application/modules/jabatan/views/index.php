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
          <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
            <thead>
              <tr>
                <th>No</th>
                <th>Kode Jabatan</th>
                <th>Jabatan</th>
                <th>Bagian</th>
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
            <label>Kode Jabatan</label>
            <input type="text" name="kdjab" id="kdjab" class="form-control" placeholder="Kode Jabatan" readonly/>
          </div>
          <div class="form-group">
            <label>Nama Jabatan<b style="color:red;">*</b></label>
            <input type="hidden" name="idjab" id="idjab" value="">
            <input type="text" name="nmjab" id="nmjab" class="form-control" required placeholder="Jabatan"/>
          </div>
          <div class="form-group">
            <label>Atasan</label>
            <select class="form-control select2" name="subjab" id="subjab" required>
              <option value="0">-- Pilih --</option>
              <?php foreach ($datajabatan as $key => $value) {
                echo "<option value='".$value['id_jabatan']."'>".$value['jabatan']."</option>";
              } ?>
            </select>
          </div>
          <div class="form-group">
            <label>Bagian<b style="color:red;">*</b></label>
            <select name="idbag" id="idbag" class="form-control select2" required>
              <option value="">-- Pilih --</option>
              <?php foreach ($bagian as $key) { ?>
                <option value="<?php echo $key->id_bagian; ?>"><?php echo $key->bagian; ?></option>
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
  var tabel_jabatan = '';

  function getkode() {
    $.ajax({
      type:"GET",
      url:"<?php echo base_url(); ?>jabatan/jabatan_kode",
      success  : function (data) {
        $('#kdjab').val(data);
      }
    });
  }

  function resda() {
    // $('#subjab').empty();
    // $.ajax({
    //   type:"GET",
    //   url:"<?php echo base_url(); ?>jabatan/listisidata",
    //   dataType : "JSON",
    //   success  : function (data) {
    //     var isi = '<option value="0">-- Pilih --</option>';
    //     for (var i = 0; i < data.length; i++) {
    //       isi = isi+'<option value='+data[i].id_jabatan+'>'+data[i].jabatan+'</option>';
    //     }
    //     $('#subjab').html(isi);
    //   }
    // });
  }

  $(document).ready(function () {
    var act = "<?=$role['update'].'_'.$role['delete']?>";
    tabel_jabatan = $('#datatable').DataTable({
      "ajax" : {
        "url" : "<?php echo base_url(); ?>jabatan/ajaxdata/"+act,
        "type" : "POST"
      },
      "columnDefs" : [{
        "targets" : [0,4],
        "orderable" : false
      },{
        'targets' : [0,4],
        'className' : 'text-center',
      }]
    });

    getkode();
    resda();

    $('#clearall').on('click', function () {
      getkode();
      $('#nmjab').val('');
      $('#idjab').val('');
      $('#idbag').val(null).trigger('change');
      $('#subjab').val(null).trigger('change');
    });

    $('#subjab').on('change', function () {
      $.ajax({
        type:"GET",
        url:"<?php echo base_url(); ?>jabatan/getbagian/"+$(this).val(),
        dataType : "JSON",
        success  : function (data) {
          $('#idbag').val(data[0].id_bagian).trigger('change');
        }
      });
    });

    $('#senddata').on('click', function () {
      var kdjb = $('#kdjab').val();
      var nmjb = $('#nmjab').val();
      var idbg = $('#idbag').val();
      var idjb = $('#idjab').val();
      var suja = $('#subjab').val();
      
      if (suja == "" || idbg == "" || nmjb == "") {
        swal({
          title             : "Gagal",
          text              : "Form ada yang Tidak di isi.",
          type              : 'warning',
          showConfirmButton : false,
          timer             : 1500
        });
      } else {
        if (idjb == "") { //insert
          $.ajax({
            type:"POST",
            url:"<?php echo base_url(); ?>jabatan/add",
            beforeSend : function () {
              swal({
                title  : 'Menunggu',
                html   : 'Memproses Data',
                onOpen : () => {
                  swal.showLoading();
                }
              })
            },
            data: { kdjabat:kdjb, jabat:nmjb, bagia:idbg, subja:suja },
            dataType : "JSON",
            success  : function (data) {
              if (data['status'] == 'sukses') {
                swal({
                  title             : "Berhasil",
                  text              : "Jabatan telah di Tambahkan",
                  type              : 'success',
                  showConfirmButton : false,
                  timer             : 1000
                });
                resda();
                $('#clearall').trigger('click');
                tabel_jabatan.ajax.reload();
              } else {
                swal({
                  title             : "Gagal",
                  text              : "Jabatan Tersebut telah Ada",
                  type              : 'error',
                  showConfirmButton : false,
                  timer             : 1000
                });
              }
              getkode();
              $('#idbag').attr('disabled', false);
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
        } else { //update
          $.ajax({
            type:"POST",
            url:"<?php echo base_url(); ?>jabatan/edit/"+idjb,
            beforeSend : function () {
              swal({
                title  : 'Menunggu',
                html   : 'Memproses Data',
                onOpen : () => {
                  swal.showLoading();
                }
              })
            },
            data: { jabat:nmjb, bagia:idbg, subja:suja },
            dataType : "JSON",
            success  : function (data) {
              if (data['status'] == 'sukses') {
                swal({
                  title             : "Berhasil",
                  text              : "Jabatan telah di Update",
                  type              : 'success',
                  showConfirmButton : false,
                  timer             : 1000
                });
                resda();
                $('#clearall').trigger('click');
                tabel_jabatan.ajax.reload();

                $('#idbag').attr('disabled', false);
              } else {
                swal({
                  title             : "Gagal",
                  text              : "Jabatan Tersebut telah Ada",
                  type              : 'error',
                  showConfirmButton : false,
                  timer             : 1000
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
                timer             : 1000
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
      url:"<?php echo base_url(); ?>jabatan/show/"+id,
      success  : function (data) {
        var hss = JSON.parse(data);
        $('#idjab').val(hss[0]['id_jabatan']);
        $('#kdjab').val(hss[0]['kode_jabatan']);
        $('#nmjab').val(hss[0]['jabatan']);
        $('#subjab').val(hss[0]['parent']).trigger('change');
        $('#idbag').val(hss[0]['id_bagian']).trigger('change');

        $.ajax({
          type:"GET",
          url:"<?php echo base_url(); ?>jabatan/getbagian/"+hss[0]['parent'],
          dataType : "JSON",
          success  : function (data) {
            $('#idbag').val(hss[0]['id_bagian']).trigger('change');
          }
        });

        if (hss[0]['parent'] != 0) {
          $('#idbag').attr('disabled', true);
        } else {
          $('#idbag').attr('disabled', false);
        }
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
  }

  function deletedel(id) {
    swal({
      title       : 'Konfirmasi',
      text        : 'Yakin akan Menghapus Jabatan',
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
          url:"<?php echo base_url(); ?>jabatan/remove/"+id,
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
              text              : "Jabatan telah di Hapus",
              type              : 'success',
              showConfirmButton : false,
              timer             : 1000
            });
            getkode();
            resda();
            tabel_jabatan.ajax.reload();
            // location.reload();
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
          text                : 'Anda membatalkan Hapus Jabatan',
          buttonsStyling      : false,
          confirmButtonClass  : "btn btn-primary",
          type                : 'error',
          showConfirmButton   : false,
          timer               : 1000
        });
      }
    });
  }
</script>
