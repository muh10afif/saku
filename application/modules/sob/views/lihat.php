<div class="page-title-box">
  <div class="row align-items-center">
    <div class="col-sm-6"><h4><?= $title ?></h4></div>
    <div class="col-sm-6">
      <?php echo bredcumx(); ?>
    </div>
  </div>
</div>

<input type="hidden" id="status_toggle">
<?php if ($role['read'] == true || $role == null): ?>
  <div class="row">
    <div class="col-md-7">
      <div class="card shadow">
          <div class="card-body table-responsive">
            <table class="table table-bordered table-hover dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;" id="tabel_master_sob" width="100%" cellspacing="0">
              <thead class="thead-light text-center">
                <tr>
                  <th width="5%">No</th>
                  <th width="20%">Kode SOB</th>
                  <th width="20%">SOB</th>
                  <th width="20%">Deskripsi</th>
                  <th width="15%">Aksi</th>
                </tr>
              </thead>
            </table>
          </div>
        </div> 
    </div>
    <div class="col-md-5">
      <div class="card shadow">
        <form id="form_sob" autocomplete="off">
          <input type="hidden" name="id_sob" id="id_sob">
          <input type="hidden" name="aksi" id="aksi" value="Tambah">
          <div class="card-body d-flex justify-content-center">
            <div class="col-md-12">
              <div class="form-group row">
                <label for="nama_sob" class="col-md-3 col-form-label text-left">Kode SOB</label>
                <div class="col-md-9">
                  <input type="text" class="form-control" name="kode_sob" id="kode_sob" value="<?= $kode_sob ?>" readonly>
                </div>
              </div>
              <div class="form-group row">
                <label for="nama_sob" class="col-md-3 col-form-label text-left">SOB<b style="color:red;">*</b></label>
                <div class="col-md-9">
                  <input type="text" class="form-control" name="nama_sob" id="nama_sob" placeholder="Masukkan SOB">
                </div>
              </div>
              <div class="form-group row">
                <label for="nama_sob" class="col-md-3 col-form-label text-left">Description</label>
                <div class="col-md-9">
                  <textarea name="desc" id="desc" rows="3" class="form-control" placeholder="Masukkan Description"></textarea>
                </div>
              </div>
              <i style="color:red;">('*') Menandakan Form Harus di Isi</i>
            </div>
          </div>
          <div class="card-footer  d-flex justify-content-end">
            <?php if ($role['create'] == true || $role == null): ?>
              <button type="button" class="btn btn-primary mt-1 mr-3" id="simpan_sob">Simpan</button>
            <?php endif; ?>
            <button type="button" class="btn btn-secondary mt-1 batal_sob" id="batal_sob">Cancel</button>
          </div>
        </form>
      </div>
    </div>
  </div>
<?php endif; ?>

<script>
  $(document).ready(function () {
    $('#tambah_sob').on('click', function () {
      $('.f_tambah').slideToggle('fast', function() {
        if ($(this).is(':visible')) {
          $('#status_toggle').val(1);
        } else {
          $('#status_toggle').val(0);
        }
      });
    });

    var act = "<?=$role['update'].'_'.$role['delete']?>";
    var tabel_list_sob = $('#tabel_master_sob').DataTable({
      "processing" : true,
      "serverSide" : true,
      "order"      : [],
      "ajax"       : {
        "url"   : "<?= base_url('sob/tampil_data_sob') ?>/"+act,
        "type"  : "POST"
      },
      "columnDefs"        : [{
        "targets"   : [0,4],
        "orderable" : false
      }, {
        'targets'   : [0,4],
        'className' : 'text-center',
      }]
    });

    getkode();

    function getkode() {
      $.ajax({
        type:"GET",
        url:"<?php echo base_url(); ?>sob/sob_kode",
        success  : function (data) {
          $('#kode_sob').val(data);
        }
      });
    }

    $('#simpan_sob').on('click', function () {
      var form_sob = $('#form_sob').serialize();
      var aksi     = $('#aksi').val();
      var id_sob   = $('#id_sob').val();
      var nama_sob = $('#nama_sob').val();
      var kode_sob = $('#kode_sob').val();
      var desc     = $('#desc').val();

      if (nama_sob == '') {
        swal({
          title              : "Peringatan",
          text               : 'SOB harus terisi !',
          buttonsStyling     : false,
          type               : 'warning',
          showConfirmButton  : false,
          timer             : 3000
        });
        return false;
      } else {
        swal({
          title              : 'Konfirmasi',
          text               : 'Yakin akan kirim data',
          type               : 'warning',
          buttonsStyling     : false,
          confirmButtonClass : "btn btn-primary",
          cancelButtonClass  : "btn btn-danger mr-3",
          showCancelButton   : true,
          confirmButtonText  : 'Ya',
          confirmButtonColor : '#3085d6',
          cancelButtonColor  : '#d33',
          cancelButtonText   : 'Batal',
          reverseButtons     : true
        }).then((result) => {
          if (result.value) {
            $.ajax({
              url  : "<?= base_url() ?>sob/simpan_data_sob",
              type : "POST",
              beforeSend : function () {
                swal({
                  title  : 'Menunggu',
                  html   : 'Memproses Data',
                  onOpen : () => {
                    swal.showLoading();
                  }
                });
              },
              data : {aksi:aksi, nama_sob:nama_sob, kode_sob:kode_sob, desc:desc,id_sob:id_sob},
              dataType : "JSON",
              success : function (data) {
                if (data['status'] == 'berhasil') {
                  swal({
                    title              : "Berhasil",
                    text               : 'Data berhasil disimpan',
                    buttonsStyling     : false,
                    confirmButtonClass : "btn btn-success",
                    type               : 'success',
                    showConfirmButton  : false,
                    timer             : 3000
                  });
                  tabel_list_sob.ajax.reload(null,false);
                  $('#form_sob').trigger("reset");
                  $('.hapus-sob').removeAttr('hidden');
                  $('#aksi').val('Tambah');
                  $('.f_tambah').slideToggle('fast', function() {
                    if ($(this).is(':visible')) {
                      $('#status_toggle').val(1);
                    } else {
                      $('#status_toggle').val(0);
                    }
                  });
                  $('#tambah_sob').attr('hidden', false);
                } else {
                  swal({
                    title              : "gagal",
                    text               : 'Data tersebut Sudah Ada',
                    buttonsStyling     : false,
                    confirmButtonClass : "btn btn-danger",
                    type               : 'error',
                    showConfirmButton  : false,
                    timer             : 3000
                  });
                }
                getkode();
              },
              error: function (jqXHR, textStatus, errorThrown) {
                swal({
                  title               : "Gagal",
                  text                : 'Data Gagal Disimpan',
                  type                : 'error',
                  showConfirmButton   : false,
                  timer             : 3000
                });
                return false;
              }
            });
            return false;
          } else if (result.dismiss === swal.DismissReason.cancel) {
            swal({
              title               : "Batal",
              text                : 'Anda membatalkan simpan data',
              buttonsStyling      : false,
              confirmButtonClass  : "btn btn-primary",
              type                : 'error',
              showConfirmButton   : false,
              timer             : 3000
            });
          }
        });
        return false;
      }
    });

    $('.batal_sob').on('click', function () {
      $('#form_sob').trigger("reset");
      $('#aksi').val('Tambah');
      $('.hapus-sob').removeAttr('hidden');
      $('.f_tambah').slideToggle('fast', function() {
        if ($(this).is(':visible')) {
          $('#status_toggle').val(1);
        } else {
          $('#status_toggle').val(0);
        }
      });
      getkode();
      $('#tambah_sob').attr('hidden', false);
    });

    $('#tabel_master_sob').on('click', '.edit-sob', function () {
      // $('.hapus-sob').attr('hidden', true);
      $('#tambah_sob').attr('hidden', true);

      var sts      = $('#status_toggle').val();
      var id_sob   = $(this).data('id');
      var kode_sob = $(this).attr('kode_sob');
      var nama_sob = $(this).attr('nama');
      var desc     = $(this).attr('desc');

      $('#kode_sob').val(kode_sob);
      $('#id_sob').val(id_sob);
      $('#nama_sob').val(nama_sob);
      $('#desc').val(desc);

      $('#aksi').val('Ubah');
      $('#judul_atas').val('Ubah Data');
      $('#batal_sob').removeAttr('hidden');

      $('html, body').animate({
        scrollTop: $('body').offset().top
      }, 800);

      if (sts == 0) {
        $('.f_tambah').slideToggle('fast', function() {
          if ($(this).is(':visible')) {
            $('#status_toggle').val(1);
          } else {
            $('#status_toggle').val(0);
          }
        });
      }
    });

    $('#tabel_master_sob').on('click', '.hapus-sob', function () {
      var id_sob = $(this).data('id');
      var sts    = $('#status_toggle').val();
      var nama   = $(this).attr('nama');

      swal({
        title              : 'Konfirmasi',
        text               : 'Yakin akan hapus sob '+nama+' ?',
        type               : 'warning',
        buttonsStyling     : false,
        confirmButtonClass : "btn btn-danger",
        cancelButtonClass  : "btn btn-primary mr-3",
        showCancelButton   : true,
        confirmButtonText  : 'Hapus',
        confirmButtonColor : '#d33',
        cancelButtonColor  : '#3085d6',
        cancelButtonText   : 'Batal',
        reverseButtons     : true
      }).then((result) => {
        if (result.value) {
          $.ajax({
            url    : "<?= base_url() ?>sob/simpan_data_sob",
            method : "POST",
            beforeSend : function () {
              swal({
                title  : 'Menunggu',
                html   : 'Memproses Data',
                onOpen : () => {
                  swal.showLoading();
                }
              });
            },
            data     : {aksi:'Hapus', id_sob:id_sob},
            dataType : "JSON",
            success  : function (data) {
              tabel_list_sob.ajax.reload(null,false);
              swal({
                title               : 'Hapus sob',
                text                : 'Data Berhasil Dihapus',
                buttonsStyling      : false,
                confirmButtonClass  : "btn btn-success",
                type                : 'success',
                showConfirmButton   : false,
                timer             : 3000
              });
              $('#form_sob').trigger("reset");
              $('#aksi').val('Tambah');
              $('.hapus-sob').removeAttr('hidden');
              $('#kode_sob').val(data.kode_sob);

              if (sts == 1) {
                $('.f_tambah').slideToggle('fast', function() {
                  if ($(this).is(':visible')) {
                    $('#status_toggle').val(1);
                  } else {
                    $('#status_toggle').val(0);
                  }
                });
              }
            },
            error: function (jqXHR, textStatus, errorThrown) {
              swal({
                title               : "Gagal",
                text                : 'Data Gagal Dihapus',
                type                : 'error',
                showConfirmButton   : false,
                timer             : 3000
              });
              return false;
            }
          });
        } else if (result.dismiss === swal.DismissReason.cancel) {
          swal({
            title               : 'Batal',
            text                : 'Anda membatalkan hapus sob',
            buttonsStyling      : false,
            confirmButtonClass  : "btn btn-primary",
            type                : 'error',
            showConfirmButton   : false,
            timer             : 3000
          });
        }
      });
    });

    $('#tabel_master_sob').on('click', '.detail-sob', function () {
      var id_sob = $(this).data('id');
    });
  });

</script>
