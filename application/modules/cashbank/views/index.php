<div class="page-title-box">
  <div class="row align-items-center">
    <div class="col-sm-6"><h4 class="page-title"><?= $title ?></h4></div>
    <div class="col-sm-6">
      <ol class="breadcrumb float-right">
        <li class="breadcrumb-item"><a href="<?= base_url() ?>">Legowo</a></li>
        <li class="breadcrumb-item active"><?= $title ?></li>
      </ol>
    </div>
  </div>
</div>

<div class="row">
  <div class="col-md-7">
    <div class="card">
      <div class="card-body">
        <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
          <thead>
            <tr>
              <th>No</th>
              <th>Kode Cash Bank</th>
              <th>Cash Bank</th>
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
        <div class="form-group">
          <label>Kode Cash Bank</label>
          <input type="text" name="kdchbank" id="kdchbank" class="form-control" placeholder="Kode Cash Bank" readonly/>
        </div>
        <div class="form-group">
          <label>Nama Cash Bank<b style="color:red;">*</b></label>
          <input type="hidden" id="idchbank" name="" value="">
          <input type="text" name="nmchbank" id="nmchbank" class="form-control" required placeholder="Cash Bank"/>
        </div>
        <i class="text-center" style="color:red;">('*') Menandakan Form Harus di Isi</i>
        <div class="form-group text-right">
          <button class="btn btn-primary waves-effect waves-light" id="senddata">Submit</button>
          <button class="btn btn-secondary waves-effect m-l-5" id="clearall">Cancel</button>
        </div>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
  var table_cashbank = '';
  $(document).ready(function () {
    table_cashbank = $('#datatable').DataTable({
      "processing" : true,
      "serverSide" : true,
      "order" : [],
      "ajax" : {
        "url" : "<?php echo base_url(); ?>cashbank/ajaxdata",
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
      $('#nmchbank').val('');
      $('#idchbank').val('');
    });

    function getkode() {
      $.ajax({
        type:"GET",
        url:"<?php echo base_url(); ?>cashbank/cashbank_kode",
        success  : function (data) {
          $('#kdchbank').val(data);
        }
      });
    }

    $('#senddata').on('click', function () {
      var kdchbnk = $('#kdchbank').val();
      var nmchbnk = $('#nmchbank').val();
      var idchbnk = $('#idchbank').val();
      if (nmchbnk != "") {
        if (idchbnk == "") { //insert
          $.ajax({
            type:"POST",
            url:"<?php echo base_url(); ?>cashbank/add",
            beforeSend : function () {
              swal({
                title  : 'Menunggu',
                html   : 'Memproses Data',
                onOpen : () => {
                  swal.showLoading();
                }
              })
            },
            data: { kdcbnk:kdchbnk, nmcashbnk:nmchbnk },
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
            }
						table_cashbank.ajax.reload();
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
            url:"<?php echo base_url(); ?>cashbank/edit/"+idchbnk,
            beforeSend : function () {
              swal({
                title  : 'Menunggu',
                html   : 'Memproses Data',
                onOpen : () => {
                  swal.showLoading();
                }
              })
            },
            data: { nmcashbnk:nmchbnk },
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
            }
						table_cashbank.ajax.reload();
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
      } else {
        swal({
          title             : "Gagal",
          text              : "Form Nama Cash Bank Tidak di Isi!",
          type              : 'error',
          showConfirmButton : false,
          timer             : 1500
        });
      }
    });
  });

  function ubahubah(id) {
    window.scrollTo(0,0);
    $.ajax({
      type:"GET",
      url:"<?php echo base_url(); ?>cashbank/show/"+id,
      success  : function (data) {
        var hss = JSON.parse(data);
        $('#kdchbank').val(hss[0]['kode_cashbank']);
        $('#nmchbank').val(hss[0]['cashbank']);
        $('#idchbank').val(hss[0]['id_cashbank']);
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
      text        : 'Yakin akan Menghapus Cash Bank',
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
          url:"<?php echo base_url(); ?>cashbank/remove/"+id,
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
              text              : "Cash Bank telah di Hapus",
              type              : 'success',
              showConfirmButton : false,
              timer             : 1000
            });
            table_cashbank.ajax.reload();
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
          text                : 'Anda membatalkan Hapus Cash Bank',
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
