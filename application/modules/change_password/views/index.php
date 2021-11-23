<style>
    .field-icon {
        float: right;
        margin-left: -25px;
        margin-right: 10px;
        margin-top: -24px;
        position: relative;
        z-index: 2;
    }
</style>
<div class="page-title-box">
  <div class="row align-items-center">
    <div class="col-sm-6"><h4><?= $title ?></h4></div>
    <div class="col-sm-6">
      <?php echo bredcumx(); ?>
    </div>
  </div>
</div>

<div class="row">
  <div class="col-md-12">
    <div class="card shadow">
      <div class="card-body">
        <form id="colectcek" method="post">
          <div class="d-flex justify-content-center">
            <div class="col-md-10"><br>
              <div class="form-group row">
                <label for="example-text-input" class="col-sm-3 col-form-label">Enter Old Password<b style="color:red;">*</b></label>
                <div class="col-sm-9">
                  <input class="form-control" type="password" value="" id="oldpasp" name="oldpasp" placeholder="Old Password">
                  <i toggle="#oldpasp" class="fa fa-smile-beam fa-lg field-icon toggle-password"></i>
                </div>
              </div>
              <div class="form-group row">
                <label for="example-text-input" class="col-sm-3 col-form-label">Enter New Password<b style="color:red;">*</b></label>
                <div class="col-sm-9">
                  <input class="form-control" type="password" value="" id="password" name="password" placeholder="New Password">
                  <i toggle="#password" class="fa fa-smile-beam fa-lg field-icon toggle-password"></i>
                </div>
              </div>
              <div class="form-group row">
                <label for="example-text-input" class="col-sm-3 col-form-label">Confirm New Password<b style="color:red;">*</b></label>
                <div class="col-sm-9">
                  <input class="form-control" type="password" value="" id="pass_con" name="pass_con" placeholder="Confirm New Password">
                  <i toggle="#pass_con" class="fa fa-smile-beam fa-lg field-icon toggle-password"></i>
                </div>
              </div><br>
              <i style="color:red;">('*') Menandakan Form Harus di Isi</i><hr>
              <div class="form-group text-center">
                <button type="submit" id="senddata" class="btn btn-primary waves-effect waves-light mr-2">Submit</button>
                <button type="reset" id="cleardata" class="btn btn-secondary waves-effect" onclick="window.history.back()">Cancel</button>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<script>

  $(document).ready(function () {
    $(".toggle-password").click(function() {
      $(this).toggleClass("fa-smile-beam fa-meh-rolling-eyes");
      var input = $($(this).attr("toggle"));
      if (input.attr("type") == "password") {
        input.attr("type", "text");
      } else {
        input.attr("type", "password");
      }
    });
    $(".toggle-password-con").click(function() {
      $(this).toggleClass("fa-smile-beam fa-meh-rolling-eyes");
      var input = $($(this).attr("toggle"));
      if (input.attr("type") == "password") {
        input.attr("type", "text");
      } else {
        input.attr("type", "password");
      }
    });

    $('#senddata').on('click', function (e) {
      e.preventDefault();
      swal({
        title       : 'Konfirmasi',
        text        : 'Yakin Akan Mengubah Password ?',
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
          if ($('#password').val() == $('#pass_con').val()) {
            $.ajax({
              type:"POST",
              url:"<?php echo base_url(); ?>change_password/update/<?= $idusn ?>",
              beforeSend : function () {
                swal({
                  title  : 'Menunggu',
                  html   : 'Memproses Data',
                  onOpen : () => {
                    swal.showLoading();
                  }
                })
              },
              data : $('#colectcek').serialize(),
              dataType : "JSON",
              success  : function (data) {
                swal({
                  title             : data['judul'],
                  text              : data['status'],
                  type              : data['tipe'],
                  showConfirmButton : false,
                  timer             : 1500
                });
                if (data['tipe'] != 'warning') {
                  $('#oldpasp').val('');
                  $('#password').val('');
                  $('#pass_con').val('');
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
          } else {
            swal({
              title             : "Berhasil",
              text              : "Confirm Password Tidak sama dengan Password",
              type              : 'warning',
              showConfirmButton : false,
              timer             : 1000
            });
          }
        } else if (result.dismiss === swal.DismissReason.cancel) {
          swal({
            title               : "Batal",
            text                : 'Anda membatalkan Megubah Password',
            buttonsStyling      : false,
            confirmButtonClass  : "btn btn-primary",
            type                : 'error',
            showConfirmButton   : false,
            timer               : 1000
          });
        }
      });
    });
  });

</script>
