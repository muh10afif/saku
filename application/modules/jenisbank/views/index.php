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
                <th>Kode Jenis Bank</th>
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
            <label>Koda Jenis Bank</label>
            <input type="text" name="kode_jenis_bank" id="kode_jenis_bank" class="form-control" placeholder="Kode Jenis Bank" readonly/>
          </div>
          <div class="form-group">
            <label>Nama Jenis Bank<b style="color:red;">*</b></label>
            <input type="hidden" id="id_jenis_bank" name="" value="">
            <input type="text" name="jenis_bank" id="jenis_bank" class="form-control" placeholder="Jenis Bank" required/>
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
  var tabel_jnsbnk = '';

  function getkode() {
    $.ajax({
      type:"GET",
      url:"<?php echo base_url(); ?>jenisbank/jenisbank_kode",
      success  : function (data) {
        $('#kode_jenis_bank').val(data);
      }
    });
  }

  $(document).ready(function () {
    var act = "<?=$role['update'].'_'.$role['delete']?>";
    tabel_jnsbnk = $('#datatable').DataTable({
      "processing" : true,
      "serverSide" : true,
      "order" : [],
      "ajax" : {
        "url" : "<?php echo base_url(); ?>jenisbank/ajaxdata/"+act,
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

    getkode();

    $('#clearall').on('click', function () {
      getkode();
      $('#jenis_bank').val('');
      $('#id_jenis_bank').val('');
    });

    $('#senddata').on('click', function () {
      var kode_jbank = $('#kode_jenis_bank').val();
      var jenis_bank = $('#jenis_bank').val();
      var id_jenis_bank = $('#id_jenis_bank').val();
      if (id_jenis_bank == "") { //insert
        $.ajax({
          type:"POST",
          url:"<?php echo base_url(); ?>jenisbank/add",
          beforeSend : function () {
            swal({
              title  : 'Menunggu',
              html   : 'Memproses Data',
              onOpen : () => {
                swal.showLoading();
              }
            })
          },
          data: { kdjns_bank:kode_jbank, jenis_bank:jenis_bank },
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
              tabel_jnsbnk.ajax.reload();
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
      } else { //updates
        $.ajax({
          type:"POST",
          url:"<?php echo base_url(); ?>jenisbank/edit/"+id_jenis_bank,
          beforeSend : function () {
            swal({
              title  : 'Menunggu',
              html   : 'Memproses Data',
              onOpen : () => {
                swal.showLoading();
              }
            })
          },
          data: { jenis_bank:jenis_bank },
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
              tabel_jnsbnk.ajax.reload();
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
      url:"<?php echo base_url(); ?>jenisbank/show/"+id,
      success  : function (data) {
        var hss = JSON.parse(data);
        $('#kode_jenis_bank').val(hss[0]['kode_jenis_bank']);
        $('#jenis_bank').val(hss[0]['jenis_bank']);
				$('#id_jenis_bank').val(hss[0]['id_jenis_bank']).trigger('change');
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
      text        : 'Yakin akan Menghapus Jenis Bank',
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
          url:"<?php echo base_url(); ?>jenisbank/remove/"+id,
          beforeSend : function () {
            swal({
              title  : 'Menunggu',
              html   : 'Memproses Data',
              onOpen : () => {
                swal.showLoading();
                tabel_jnsbnk.ajax.reload();
                return true;
              }
            })
          },
          success  : function (data) {
            swal({
              title             : "Berhasil",
              text              : "Jenis Bank telah di Hapus",
              type              : 'success',
              showConfirmButton : false,
              timer             : 3000
            });
            // location.reload();
            getkode();
            tabel_jnsbank.ajax.reload();
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
          text                : 'Anda membatalkan Hapus Cash Bank',
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
