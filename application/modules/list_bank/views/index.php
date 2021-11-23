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
                <th>Kode Bank</th>
                <th>Nama Bank</th>
                <th>Jenis Bank</th>
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
            <label>Kode Bank</label>
            <input type="text" name="kode_bank" id="kode_bank" class="form-control" placeholder="Kode Bank" readonly/>
          </div>
          <div class="form-group">
            <label>Jenis Bank<b style="color:red;">*</b></label>
            <select name="idjnsbnk" id="idjnsbnk" class="select2">
              <option value="">-- Pilih --</option>
              <?php foreach ($list_jenis_bank as $key) { ?>
                <option name="idjnsbnk" value="<?php echo $key->id_jenis_bank; ?>"><?php echo $key->jenis_bank; ?></option>
              <?php } ?>
            </select>
          </div>
          <div class="form-group">
            <label>Nama Bank<b style="color:red;">*</b></label>
            <input type="hidden" name="idbnk" id="idbnk" value="">
            <input type="text" name="nmbnk" id="nmbnk" class="form-control" required placeholder="Nama Bank"/>
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
  var tabel_bank = '';

  function getkode() {
    $.ajax({
      type:"GET",
      url:"<?php echo base_url(); ?>list_bank/bank_kode",
      success  : function (data) {
        $('#kode_bank').val(data);
      }
    });
  }

  $(document).ready(function () {
    // custom jika butuh approve maka tambahkan { .'_'.$role['approve'] }
    var act = "<?=$role['update'].'_'.$role['delete']?>";
    tabel_bank = $('#datatable').DataTable({
      "processing" : true,
      "serverSide" : true,
      "order" : [],
      "ajax" : {
        "url" : "<?php echo base_url(); ?>list_bank/ajaxdata/"+act,
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
      $('#nmbnk').val('');
      $('#idbnk').val('');
      $('#idjnsbnk').val(null).trigger('change');
    });

    $('#senddata').on('click', function () {
      var kdbn = $('#kode_bank').val();
      var nmbn = $('#nmbnk').val();
      var idjnsbnk = $('#idjnsbnk').val();
      var idbn = $('#idbnk').val();
      if (idbn == "") {
        $.ajax({
          type:"POST",
          url:"<?php echo base_url(); ?>list_bank/add",
          beforeSend : function () {
            swal({
              title  : 'Menunggu',
              html   : 'Memproses Data',
              onOpen : () => {
                swal.showLoading();
              }
            })
          },
          data: { kode_bank:kdbn, nmbank:nmbn, idjnsbnk:idjnsbnk },
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
              getkode();
              $('#clearall').trigger('click');
              tabel_bank.ajax.reload();
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
          url:"<?php echo base_url(); ?>list_bank/edit/"+idbn,
          beforeSend : function () {
            swal({
              title  : 'Menunggu',
              html   : 'Memproses Data',
              onOpen : () => {
                swal.showLoading();
              }
            })
          },
          data: { nmbank:nmbn, idjnsbnk:idjnsbnk },
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
              tabel_bank.ajax.reload();
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
      url:"<?php echo base_url(); ?>list_bank/show/"+id,
      success  : function (data) {
        var hss = JSON.parse(data);
        $('#idbnk').val(hss[0]['id_bank']);
        $('#kode_bank').val(hss[0]['kode_bank']);
        $('#idjnsbnk').val(hss[0]['id_jenis_bank']).trigger('change');
        $('#nmbnk').val(hss[0]['nama_bank']);
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
      text        : 'Yakin akan Menghapus Nama Bank',
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
          url:"<?php echo base_url(); ?>list_bank/remove/"+id,
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
              text              : "Nama Bank telah di Hapus",
              type              : 'success',
              showConfirmButton : false,
              timer             : 3000
            });
            // location.reload();
            getkode();
            tabel_bank.ajax.reload();
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
          text                : 'Anda membatalkan Hapus Nama Bank',
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
