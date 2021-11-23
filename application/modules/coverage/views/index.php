<div class="page-title-box">
  <div class="row align-items-center">
    <div class="col-sm-6"><h4><?= $title ?></h4></div>
    <div class="col-sm-6">
      <?php echo bredcumx(); ?>
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
              <th>Label</th>
              <th>Rate</th>
              <th>LOB</th>
              <th>Status</th>
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
          <label>Label</label>
          <input type="hidden" name="idcov" id="idcov" value="">
          <input type="text" name="lacov" id="lacov" class="form-control" required placeholder="Label"/>
        </div>
        <div class="form-group">
          <label>Rate</label>
          <input type="text" name="racov" id="racov" class="form-control" required placeholder="Rate"/>
        </div>
        <div class="form-group">
          <label>LOB</label>
          <select name="lbcov" id="lbcov" class="form-control" required>
            <option value="">-- Pilih --</option>
            <?php foreach ($list_lob as $key) { ?>
              <option value="<?php echo $key->id_lob; ?>"><?php echo $key->lob; ?></option>
            <?php } ?>
          </select>
        </div>
        <div class="form-group">
          <label>Status</label>
          <select name="stcov" id="stcov" class="form-control" required>
            <option value="">-- Pilih --</option>
            <option value="standar">Standar</option>
            <option value="perluasan">Perluasan</option>
          </select>
        </div>
        <div class="form-group text-right">
          <button class="btn btn-primary waves-effect waves-light" id="senddata">Submit</button>
          <button class="btn btn-secondary waves-effect m-l-5" id="clearall">Cancel</button>
        </div>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
  var table_coverage = '';
  $(document).ready(function () {
    table_coverage = $('#datatable').DataTable({
      "processing" : true,
      "serverSide" : true,
      "order" : [],
      "ajax" : {
        "url" : "<?php echo base_url(); ?>coverage/ajaxdata",
        "type" : "POST"
      },
      "columnDefs" : [{
        "targets" : [0,5],
        "orderable" : false
      },{
        'targets' : [0,5],
        'className' : 'text-center',
      }],
      "scrollX" : true
    });

    $('#senddata').on('click', function () {
      var covla = $('#lacov').val();
      var covra = $('#racov').val();
      var covlb = $('#lbcov').val();
      var covst = $('#stcov').val();
      var covid = $('#idcov').val();
      if (covid == '') {
        $.ajax({
          type:"POST",
          url:"<?php echo base_url(); ?>coverage/add",
          beforeSend : function () {
            swal({
              title  : 'Menunggu',
              html   : 'Memproses Data',
              onOpen : () => {
                swal.showLoading();
              }
            })
          },
          data: {
            labc:covla,
            ratc:covra,
            stac:covst,
            lobc:covlb
          },
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

              $('#lacov').val('');
              $('#racov').val('');
              // $('#lbcov').val('');
              $('#stcov').val('');
              $('#idcov').val('');
              table_coverage.ajax.reload();

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
      } else {
        $.ajax({
          type:"POST",
          url:"<?php echo base_url(); ?>coverage/edit/"+covid,
          beforeSend : function () {
            swal({
              title  : 'Menunggu',
              html   : 'Memproses Data',
              onOpen : () => {
                swal.showLoading();
              }
            })
          },
          data: {
            labc:covla,
            ratc:covra,
            stac:covst,
            lobc:covlb
          },
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

              $('#lacov').val('');
              $('#racov').val('');
              // $('#lbcov').val('');
              $('#stcov').val('');
              $('#idcov').val('');
              table_coverage.ajax.reload();

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
     
    });
  });

  function ubahubah(id) {
    window.scrollTo(0,0);
    $.ajax({
      type:"GET",
      url:"<?php echo base_url(); ?>coverage/show/"+id,
      success  : function (data) {
        var hss = JSON.parse(data);
        $('#lacov').val(hss[0].label);
        $('#racov').val(hss[0].rate);
        $('#lbcov').val(hss[0].id_lob);
        $('#stcov').val(hss[0].status);
        $('#idcov').val(hss[0].id_coverage);
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
      text        : 'Yakin akan Menghapus Coverage',
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
          url:"<?php echo base_url(); ?>coverage/remove/"+id,
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
              text              : "Coverage telah di Hapus",
              type              : 'success',
              showConfirmButton : false,
              timer             : 1000
            });
            table_coverage.ajax.reload();
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
          text                : 'Anda membatalkan Hapus Data',
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
