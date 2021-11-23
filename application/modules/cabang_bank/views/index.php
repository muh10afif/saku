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
                <th>Kode Cabang</th>
                <th>Nama Bank</th>
                <th>Nama Cabang Bank</th>
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
            <label>Kode Cabang Bank</label>
            <input type="text" name="kode_cabang" id="kode_cabang" class="form-control" placeholder="Kode Cabang Bank" readonly/>
          </div>
          <div class="form-group">
            <label>Nama Bank<b style="color:red;">*</b></label>
            <input type="hidden" name="idcbbnk" id="idcbbnk" value="">
            <select name="nmbnk" id="nmbnk" class="form-control select2">
              <option value="">-- Pilih --</option>
              <?php foreach ($dbank as $key) { ?>
                <option value="<?php echo $key->id_bank; ?>"><?php echo $key->nama_bank; ?></option>
              <?php } ?>
            </select>
          </div>
          <div class="form-group">
            <label>Nama Cabang Bank<b style="color:red;">*</b></label>
            <input type="text" name="nmcbbank" id="nmcbbank" class="form-control" required placeholder="Nama Cabang Bank"/>
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
  var tabel_cabang = '';

  function getkode() {
    $.ajax({
      type:"GET",
      url:"<?php echo base_url(); ?>cabang_bank/cabang_kode",
      success  : function (data) {
        $('#kode_cabang').val(data);
      }
    });
  }

  $(document).ready(function () {
    var act = "<?=$role['update'].'_'.$role['delete']?>";
    tabel_cabang = $('#datatable').DataTable({
      "processing" : true,
      "serverSide" : true,
      "order" : [],
      "ajax" : {
        "url" : "<?php echo base_url(); ?>cabang_bank/ajaxdata/"+act,
        "type" : "POST"
      },
      "columnDefs" : [{
        "targets" : [0,4],
        "orderable" : false
      },{
        'targets' : [0,4],
        'className' : 'text-center',
      }],
      "scrollX" : true
    });

    getkode();

    $('#clearall').on('click', function () {
      getkode();
      $('#nmcbbank').val('');
      $('#idcbbnk').val('');
      $('#nmbnk').val(null).trigger('change');
    });

    $('#senddata').on('click', function () {
      var kdcbbnk = $('#kode_cabang').val();
      var nmcbbnk = $('#nmcbbank').val();
      var idbnk = $('#nmbnk').val();
      var idbg = $('#idcbbnk').val();
      if (idbg == "") { //insert
        $.ajax({
          type:"POST",
          url:"<?php echo base_url(); ?>cabang_bank/add",
          beforeSend : function () {
            swal({
              title  : 'Menunggu',
              html   : 'Memproses Data',
              onOpen : () => {
                swal.showLoading();
              }
            })
          },
          data: { kdcb:kdcbbnk, nmcbbank:nmcbbnk, idbank:idbnk },
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
              $('#nmcbbank').val('');
              $('#idcbbnk').val('');
              $('#nmbnk').val(null).trigger('change');
            }
            getkode();
            tabel_cabang.ajax.reload();
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
          url:"<?php echo base_url(); ?>cabang_bank/edit/"+idbg,
          beforeSend : function () {
            swal({
              title  : 'Menunggu',
              html   : 'Memproses Data',
              onOpen : () => {
                swal.showLoading();
              }
            })
          },
          data: { nmcbbank:nmcbbnk, idbank:idbnk },
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
              $('#nmcbbank').val('');
              $('#idcbbnk').val('');
              $('#nmbnk').val(null).trigger('change');
              getkode();
            }
            tabel_cabang.ajax.reload();
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
      url:"<?php echo base_url(); ?>cabang_bank/show/"+id,
      success  : function (data) {
        var hss = JSON.parse(data);
        $('#idcbbnk').val(hss[0]['id_cabang_bank']);
        $('#kode_cabang').val(hss[0]['kode_cabang_bank']);
        $('#nmcbbank').val(hss[0]['nama_cabang_bank']);
        $('#nmbnk').val(hss[0]['id_bank']).trigger('change');
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
      text        : 'Yakin akan Menghapus Cabang Bank',
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
          url:"<?php echo base_url(); ?>cabang_bank/remove/"+id,
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
              text              : "Cabang Bank telah di Hapus",
              type              : 'success',
              showConfirmButton : false,
              timer             : 3000
            });
            // location.reload();
            getkode();
            tabel_cabang.ajax.reload();
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
          text                : 'Anda membatalkan Hapus Cabang Bank',
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
