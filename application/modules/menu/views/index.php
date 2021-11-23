<style>

    .nav-pills .nav-link.active, .nav-pills .show > .nav-link {
        color: #fff;
        background-color: #02a4af;
    }

    /* a {
        color: #02a4af;
    } */
    
    .custom-control-input:checked ~ .custom-control-label::before {
        color: #fff;
        border-color: #006c45;
        background-color: #006c45;
    }

    .nav-tabs .nav-item .nav-link.active {
        color: white;
    }
    .nav-tabs .nav-item.show .nav-link, .nav-tabs .nav-link.active {
        color: #495057;
        background-color: #006c45;
        border-color: #006c45 #006c45 #006c45;
    }
    .nav-tabs .nav-link:focus, .nav-tabs .nav-link:hover {
        border-color: #006c45 #006c45 #006c45;
    }
    .tab-bordered .tab-pane {
        padding: 15px;
        border: 5px solid #006c45;
        margin-top: -1px;
        border-radius: 5px;
    }
    .nav-tabs .nav-item .nav-link {
        color: #006c45;
    }
    .nav-tabs {
        border-bottom: 3px solid #006c45;
    }
    .tab-pane.active {
        animation: slide-down 0.2s ease-out;
    }
    @keyframes slide-down {
        0% { opacity: 0; transform: translateY(100%); }
        100% { opacity: 1; transform: translateY(0); }
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
<?php if ($role['read'] == true || $role == null): ?>
  <div class="row">
    <div class="col-md-7">
      <ul class="nav nav-tabs d-flex justify-content-center" role="tablist">
        <li class="nav-item">
          <a class="nav-link active nav_menu" sistem="home" data-toggle="tab" href="#hme" role="tab">
            <span class="d-none d-md-block">Home</span><span class="d-block d-md-none"><i class="mdi mdi-home-variant h5"></i></span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link nav_menu" sistem="ajk" data-toggle="tab" href="#ajk" role="tab">
            <span class="d-none d-md-block">AJK</span><span class="d-block d-md-none"><i class="mdi mdi-home-variant h5"></i></span>
          </a>
        </li>
      </ul>
      
      <div class="card shadow">
        <div class="tab-content">
          <div class="tab-pane active p-3" id="hme" role="tabpanel">
            <div class="card-body table-responsive">
              <table id="datatablehme" class="table table-bordered table-hover dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                <thead class="thead-light text-center">
                  <tr>
                    <th>No</th>
                    <th>Nama Menu</th>
                    <th>Aksi</th>
                  </tr>
                </thead>
              </table>
            </div>
          </div>
          <div class="tab-pane p-3" id="ajk" role="tabpanel">
            <div class="card-body">
              <table id="datatableajk" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                <thead class="thead-light text-center">
                  <tr>
                    <th>No</th>
                    <th>Nama Menu</th>
                    <th>Aksi</th>
                  </tr>
                </thead>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-md-5">
      <div class="card shadow">
        <div class="card-header">
          <h5 class="mb-0 judul">Tambah Data</h5>
        </div>
        <div class="card-body">
          <div class="form-group">
            <label>Judul Menu<b style="color:red;">*</b></label>
            <input type="hidden" name="idmnu" id="idmnu" value="">
            <input type="text" name="jdlmnu" id="jdlmnu" class="form-control" required placeholder="Judul Menu"/>
          </div>
          <div class="form-group">
            <label>Sub Menu dari</label>
            <select name="submnu" id="submnu" class="form-control select2">
              <option value="0">-- Pilih Menu --</option>
              <?php foreach($categoryList as $key => $value) {
    						echo "<option value='".$value['id_menu']."'>".$value['nama_menu']."</option>";
    					} ?>
            </select>
          </div>
          <div class="form-group">
            <label>Link<b style="color:red;">*</b></label>
            <input type="text" name="lnkmnu" id="lnkmnu" class="form-control" required placeholder="Contoh: /link/.."/>
          </div>
          <div class="form-group">
            <label>No Urut<b style="color:red;">*</b></label>
            <input type="number" name="urutmn" id="urutmn" class="form-control" required placeholder="Contoh: 1"/>
          </div>
          <div class="form-group">
            <label>Kondisi<b style="color:red;">*</b></label>
            <select name="simenu" id="simenu" class="form-control">
              <option value="1">Aktif</option>
              <option value="0">Non-Aktif</option>
            </select>
          </div>
          <div class="form-group">
            <label>Sistem<b style="color:red;">*</b></label>
            <select name="sistem" id="sistem" class="form-control">
            <option value="home">Home</option>
              <!-- <option value="">-- Pilih --</option>
              <option value="home">Home</option>
              <option value="ajk">Ajk</option> -->
            </select>
          </div>
          <div class="form-group">
            <label>Icon</label>
            <input type="text" name="icon" id="icon" class="form-control" required placeholder="Contoh: icon-home"/>
          </div>
          <i style="color:red;">('*') Menandakan Form Harus di Isi</i><hr>
          <div class="form-group text-center mb-0">
            <?php if ($role['create'] == true || $role == null): ?>
              <button type="button" class="btn btn-primary waves-effect waves-light mr-2" id="senddata">Simpan</button>
            <?php endif; ?>
            <button type="button" class="btn btn-secondary waves-effect m-l-5" id="clearall">Batal</button>
          </div>
        </div>
      </div>
    </div>
  </div>
<?php endif; ?>

<script type="text/javascript">
  var tabhme = ""; var tabajk = "";

  function resda() {
    // $('#submnu').empty();
    // $.ajax({
    //   type:"GET",
    //   url:"<?php echo base_url(); ?>menu/listisidata",
    //   dataType : "JSON",
    //   success  : function (data) {
    //     var isi = '<option value="0">-- Pilih Sub Menu --</option>';
    //     for (var i = 0; i < data.length; i++) {
    //       isi = isi+'<option value='+data[i].id_menu+'>'+data[i].nama_menu+'</option>';
    //     }
    //     $('#submnu').html(isi);
    //   }
    // });
  }

  $(document).ready(function () {
    var act = "<?=$role['update'].'_'.$role['delete']?>";
    tabhme = $('#datatablehme').DataTable({
      "ajax" : {
        "type" : "POST",
        "url" : "<?php echo base_url(); ?>menu/ajaxdata/1",
        "data" : { aksi:act }
      },
      "columnDefs" : [{
        "targets" : [0,2],
        "orderable" : false
      },{
        'targets' : [0,2],
        'className' : 'text-center',
      }]
    });
    tabajk = $('#datatableajk').DataTable({
      "ajax" : {
        "type" : "POST",
        "url" : "<?php echo base_url(); ?>menu/ajaxdata/0",
        "data" : { aksi:act }
      },
      "columnDefs" : [{
        "targets" : [0,2],
        "orderable" : false
      },{
        'targets' : [0,2],
        'className' : 'text-center',
      }]
    });

    // 01-09-2021
    $('.nav_menu').on('click', function () {

      var sistem = $(this).attr('sistem');

      $('#sistem').html("<option value='"+sistem+"'>"+sistem.toUpperCase()+"</option>");
            

      $.ajax({
          type      :"GET",
          url       :"<?php echo base_url(); ?>menu/tampil_submenu/"+sistem,
          dataType  : "JSON",
          success   : function (data) {

            console.log(data.option_submenu);
  
            $('#submnu').html(data.option_submenu);
            
          },
          error: function (jqXHR, textStatus, errorThrown) {
            // swal({
            //   title             : "Peringatan",
            //   text              : "Gagal",
            //   type              : 'warning',
            //   showConfirmButton : false,
            //   timer             : 1000
            // });
            // return false;
          }
        });
      
    })

    resda();

    $('#clearall').on('click', function (e) {
      e.preventDefault();
      $('.judul').text('Tambah Data');
      $('#jdlmnu').val('');
      $('#submnu').val(0).trigger('change');
      $('#lnkmnu').val('');
      $('#urutmn').val('');
      // $('#simenu').val('');
      // $('#sistem').val('');
      $('#icon').val('');
      $('#idmnu').val('');
    });

    $('#senddata').on('click', function () {
      var judul = $('#jdlmnu').val();
      var sbmnu = $('#submnu').val();
      var lnkmn = $('#lnkmnu').val();
      var urtmn = $('#urutmn').val();
      var isact = $('#simenu').val();
      var sistem  = $('#sistem').val();
      var icon    = $('#icon').val();
      let idmn = $('#idmnu').val();
      if (idmn == "") { //insert
        $.ajax({
          type:"POST",
          url:"<?php echo base_url(); ?>menu/add",
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
            judul:judul,
            sub_menu:sbmnu,
            lnk_menu:lnkmn,
            urt_menu:urtmn,
            its_menu:isact,
            sistem:sistem,
            icon:icon
          },
          dataType : "JSON",
          success  : function (data) {
            
            swal({
              title             : data['status'],
              text              : data['pesan'],
              type              : data['altr'],
              showConfirmButton : false,
              timer             : 1000
            });

            location.reload();

            tabhme.ajax.reload();
            tabajk.ajax.reload();
            if (data['altr'] == 'success') {
              $('#clearall').trigger('click');
              resda();
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
      } else { //update
        $.ajax({
          type:"POST",
          url:"<?php echo base_url(); ?>menu/edit/"+idmn,
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
            judul:judul,
            sub_menu:sbmnu,
            lnk_menu:lnkmn,
            urt_menu:urtmn,
            its_menu:isact,
            sistem:sistem,
            icon:icon
          },
          dataType : "JSON",
          success  : function (data) {
            swal({
              title             : data['status'],
              text              : data['pesan'],
              type              : data['altr'],
              showConfirmButton : false,
              timer             : 1000
            });

            location.reload();
            tabhme.ajax.reload();
            tabajk.ajax.reload();
            if (data['altr'] == 'success') {
              $('#clearall').trigger('click');
              resda();
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
    });
  });

  function ubahubah(id) {

    $('.judul').text('Ubah Data');

    window.scrollTo(0,0);
    $.ajax({
      type:"GET",
      url:"<?php echo base_url(); ?>menu/show/"+id,
      success  : function (data) {
        var hss = JSON.parse(data);
        $('#idmnu').val(hss[0]['id']);
        $('#jdlmnu').val(hss[0]['nama_menu']);
        $('#submnu').val(hss[0]['parrent']).trigger('change');
        $('#lnkmnu').val(hss[0]['link']);
        $('#urutmn').val(hss[0]['urutan']);
        $('#simenu').val(hss[0]['class_active']);
        $('#sistem').val(hss[0]['sistem']);
        $('#icon').val(hss[0]['icon']);
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
          url:"<?php echo base_url(); ?>menu/remove/"+id,
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
              text              : "Menu telah di Hapus",
              type              : 'success',
              showConfirmButton : false,
              timer             : 1000
            });

            location.reload();
            resda();
            tabhme.ajax.reload();
            tabajk.ajax.reload();
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
          text                : 'Anda membatalkan Hapus Menu',
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
