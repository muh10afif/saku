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
                <th>Kode Wilayah</th>
                <th>Wilayah</th>
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
          <form id="colectwly" method="post">
            <div class="form-group">
              <label>Kode Wilayah</label>
              <input type="text" name="kdwil" id="kdwil" class="form-control" placeholder="Kode Wilayah" readonly/>
            </div>
            <div class="form-group">
              <label>Nama Wilayah<b style="color:red;">*</b></label>
              <input type="hidden" name="idwil" id="idwil" value="">
              <input type="text" name="nmwil" id="nmwil" class="form-control" required placeholder="Input Nama Wilayah"/>
            </div>
            <div class="form-group">
              <label>Parent Wilayah</label>
              <select class="form-control select2" name="subwil" id="subwil" required>
                <option value="0">-- Pilih --</option>
                <?php foreach ($listparnt as $key => $value): ?>
                  <option value="<?= $value['id_wilayah'] ?>"><?= $value['nama'] ?></option>
                <?php endforeach; ?>
              </select>
            </div>
            <div class="form-group">
              <label>Level<b style="color:red;">*</b></label>
              <input type="number" name="lvwil" id="lvwil" class="form-control" required placeholder="Input Level Wilayah"/>
            </div>
            <i style="color:red;">('*') Menandakan Form Harus di Isi</i>
            <div class="form-group text-right">
              <?php if ($role['create'] == true || $role == null): ?>
                <button class="btn btn-primary waves-effect waves-light" id="senddata">Submit</button>
              <?php endif; ?>
              <button class="btn btn-secondary waves-effect m-l-5" id="clearall">Cancel</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
<?php endif; ?>

<script type="text/javascript">
  var tabel_wilayah = '';

  function getkode() {
    $.ajax({
      type:"GET",
      url:"<?php echo base_url(); ?>wilayah/wilayah_kode",
      success  : function (data) {
        $('#kdwil').val(data);
      }
    });
  }

  function resda() {
    $('#subwil').empty();
    $.ajax({
      type:"GET",
      url:"<?php echo base_url(); ?>wilayah/listisidata",
      dataType : "JSON",
      success  : function (data) {
        var isi = '<option value="0">-- Pilih --</option>';
        for (var i = 0; i < data.length; i++) {
          isi = isi+'<option value='+data[i].id_wilayah+'>'+data[i].nama+'</option>';
        }
        $('#subwil').html(isi);
      }
    });
  }

  $(document).ready(function () {
    var act = "<?=$role['update'].'_'.$role['delete']?>";
    tabel_wilayah = $('#datatable').DataTable({
      "ajax" : {
        "url" : "<?php echo base_url(); ?>wilayah/ajaxdata/"+act,
        "type" : "POST"
      },
      "columnDefs" : [{
        "targets" : [0,3],
        "orderable" : false
      },{
        'targets' : [0,3],
        'className' : 'text-center',
      }]
    });

    getkode();

    $('#clearall').on('click', function (e) {
      e.preventDefault();
      getkode();
      $('#idwil').val('');
      $('#nmwil').val('');
      $('#lvwil').val('');
      $('#subwil').val(0).trigger('change');
    });

    $('#senddata').on('click', function (e) {
      e.preventDefault();
      var idw = $('#idwil').val();
      if (idw == "") {
        $.ajax({
          type:"POST",
          url:"<?php echo base_url(); ?>wilayah/add",
          beforeSend : function () {
            swal({
              title  : 'Menunggu',
              html   : 'Memproses Data',
              onOpen : () => {
                swal.showLoading();
              }
            })
          },
          data: $('#colectwly').serialize(),
          dataType : "JSON",
          success  : function (data) {
            swal({
              title             : data['judul'],
              text              : data['pesan'],
              type              : data['altr'],
              showConfirmButton : false,
              timer             : 1000
            });
            if (data['altr'] == 'success') {
            resda();
            getkode();
              $('#clearall').trigger('click');
            }
            tabel_wilayah.ajax.reload();
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
      } else {
        $.ajax({
          type:"POST",
          url:"<?php echo base_url(); ?>wilayah/edit/"+idw,
          beforeSend : function () {
            swal({
              title  : 'Menunggu',
              html   : 'Memproses Data',
              onOpen : () => {
                swal.showLoading();
              }
            })
          },
          data: $('#colectwly').serialize(),
          dataType : "JSON",
          success  : function (data) {
            swal({
              title             : data['judul'],
              text              : data['pesan'],
              type              : data['altr'],
              showConfirmButton : false,
              timer             : 1000
            });
            if (data['altr'] == 'success') {
              $('#clearall').trigger('click');
              resda();
            }
            tabel_wilayah.ajax.reload();
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
    });
  });

  function ubahubah(id) {
    $.ajax({
      type:'GET',
      url:'<?php echo base_url(); ?>wilayah/show/'+id,
      dataType : "JSON",
      success  : function (data) {
        $('#idwil').val(data[0].id_wilayah);
        $('#kdwil').val(data[0].kode_wilayah);
        $('#nmwil').val(data[0].nama);
        $('#lvwil').val(data[0].level);
        $('#subwil').val(data[0].parent).trigger('change');
      }
    });
  }

  function deletedel(id) {
    swal({
      title       : 'Konfirmasi',
      text        : 'Yakin akan Menghapus data',
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
          url:"<?php echo base_url(); ?>wilayah/remove/"+id,
          beforeSend : function () {
            swal({
              title  : 'Menunggu',
              html   : 'Memproses Data',
              onOpen : () => {
                swal.showLoading();
              }
            })
          },
          dataType : "JSON",
          success  : function (data) {
            swal({
              title             : "Berhasil",
              text              : "Wilayah telah di Hapus",
              type              : 'success',
              showConfirmButton : false,
              timer             : 1000
            });
            getkode();
            resda();
            tabel_wilayah.ajax.reload();
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
          text                : 'Anda membatalkan Hapus Wilayah',
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
