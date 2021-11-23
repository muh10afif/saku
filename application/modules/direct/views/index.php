<style type="text/css">
  .swal-wide { width:680px !important; }
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
          <a class="nav-link active" data-toggle="tab" href="#pro" role="tab">
            <span class="d-none d-md-block">Perorangan</span><span class="d-block d-md-none"><i class="mdi mdi-home-variant h5"></i></span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" data-toggle="tab" href="#pru" role="tab">
            <span class="d-none d-md-block">Perusahaan</span><span class="d-block d-md-none"><i class="mdi mdi-home-variant h5"></i></span>
          </a>
        </li>
      </ul>
      <div class="card shadow">
        <div class="tab-content">
          <div class="tab-pane active p-3" id="pro" role="tabpanel">
            <div class="card-body">
              <table id="datatable_ro" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Kode Direct</th>
                    <th>Nama</th>
                    <th>Telepon</th>
                    <th>Alamat</th>
                    <th>Action</th>
                  </tr>
                </thead>
              </table>
            </div>
          </div>
          <div class="tab-pane p-3" id="pru" role="tabpanel">
            <div class="card-body">
              <table id="datatable_ru" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Kode Direct</th>
                    <th>Nama</th>
                    <th>Telepon</th>
                    <th>Alamat</th>
                    <th>Action</th>
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
        <form id="colectdrct" method="post">
          <div class="card-body">
            <div class="form-group">
              <label>Status Keanggotaan<b style="color:red;">*</b></label>
              <div class="row mt-2 mr-2">
                <div class="col-sm-6">
                  <div class="custom-control custom-radio">
                    <input type="radio" class="custom-control-input" id="stat1" value="t" name="stat">
                    <label class="custom-control-label" for="stat1">Perorangan</label>
                  </div>
                </div>
                <div class="col-sm-6">
                  <div class="custom-control custom-radio">
                    <input type="radio" class="custom-control-input" id="stat2" value="f" name="stat">
                    <label class="custom-control-label" for="stat2">Perusahaan</label>
                  </div>
                </div>
              </div>
            </div>
            <div class="form-group">
              <label>Kode Direct</label>
              <input type="text" name="kddi" id="kddi" class="form-control" required placeholder="Kode Direct" readonly/>
            </div>
            <div class="form-group">
              <label>Nama<b style="color:red;">*</b></label>
              <input type="hidden" name="iddi" id="iddi" value="">
              <input type="text" name="nmdi" id="nmdi" class="form-control" required placeholder="Nama"/>
            </div>
            <div class="form-group">
              <label>No. Telepon<b style="color:red;">*</b></label>
              <input type="text" name="tldi" id="tldi" class="form-control numeric" required placeholder="Telepon"/>
            </div>
            <div class="form-group row">
              <div class="col-md-6">
                <label>Negara<b style="color:red;">*</b></label>
                <select class="form-control select2" name="idnega" id="idnega">
                  <?php foreach ($list_negara as $key => $value): ?>
                    <option value="<?= $value->id_negara ?>" <?php echo $value->id_negara == 2 ?'selected':''; ?>><?= $value->negara ?></option>
                  <?php endforeach; ?>
                </select>
              </div>
              <div class="col-md-6">
                <label>Provinsi<b style="color:red;">*</b></label>
                <select class="form-control select2" name="idprov" id="idprov">
                  <option value="">-- Pilih Provinsi --</option>
                  <?php foreach ($isprovinsi as $key => $value): ?>
                    <option value="<?php echo $value->id_provinsi; ?>"><?php echo $value->provinsi; ?></option>
                  <?php endforeach; ?>
                </select>
              </div>
            </div>
            <div class="form-group row">
              <div class="col-md-6">
                <label>Kabupaten/Kota<b style="color:red;">*</b></label>
                <select class="form-control select2" name="idkab" id="idkab">
                  <option value="">-- Pilih Kota/Kabupaten --</option>
                </select>
              </div>
              <div class="col-md-6">
                <label>Kecamatan<b style="color:red;">*</b></label>
                <select class="form-control select2" name="idkec" id="idkec">
                  <option value="">-- Pilih Kecamatan --</option>
                </select>
              </div>
            </div>
            <div class="form-group row">
              <div class="col-md-6">
                <label>Kelurahan<b style="color:red;">*</b></label>
                <select class="form-control select2" name="idkel" id="idkel">
                  <option value="">-- Pilih Desa/Kelurahan --</option>
                </select>
              </div>
            </div>
            <div class="form-group">
              <label>Alamat<b style="color:red;">*</b></label>
              <textarea name="aldi" id="aldi" class="form-control" required placeholder="Alamat" rows="8" cols="80"></textarea>
            </div>
            <i style="color:red;">('*') Menandakan Form Harus di Isi</i>
            <div class="form-group text-right">
              <?php if ($role['create'] == true || $role == null): ?>
                <button class="btn btn-primary waves-effect waves-light" id="senddata">Submit</button>
              <?php endif; ?>
              <button class="btn btn-secondary waves-effect m-l-5" id="clearall">Cancel</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
<?php endif; ?>

<script type="text/javascript">
  var table_direct_ru = '';
  var table_direct_ro = '';

  function getkode() {
    $.ajax({
      type:"GET",
      url:"<?php echo base_url(); ?>direct/direct_kode",
      success  : function (data) {
        $('#kddi').val(data);
      }
    });
  }

  $(document).ready(function () {
    var act = "<?=$role['update'].'_'.$role['delete']?>";

    $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
         .columns.adjust()
         .responsive.recalc();
    });

    table_direct_ro = $('#datatable_ro').DataTable({
      "responsive": true,
      "processing" : true,
      "serverSide" : true,
      "order" : [],
      "ajax" : {
        "url" : "<?php echo base_url(); ?>direct/ajaxdata/"+act,
        "type" : "POST",
        "data" : { "tipen":'t' }
      },
      "columnDefs" : [{
        "targets" : [0,5],
        "orderable" : false
      },{
        'targets' : [0,5],
        'className' : 'text-center',
      }],
      // "scrollX" : true
    });

    table_direct_ru = $('#datatable_ru').DataTable({
      "responsive": true,
      "processing" : true,
      "serverSide" : true,
      "order" : [],
      "ajax" : {
        "url" : "<?php echo base_url(); ?>direct/ajaxdata/"+act,
        "type" : "POST",
        "data" : { "tipen":'f' }
      },
      "columnDefs" : [{
        "targets" : [0,5],
        "orderable" : false
      },{
        'targets' : [0,5],
        'className' : 'text-center',
      }],
      // "scrollX" : true
    });

    getkode();

    $('#clearall').on('click', function (e) {
      e.preventDefault();
      getkode();
      $('#nmdi').val('');
      $('#tldi').val('');
      $('#aldi').val('');
      $('#iddi').val('');
      $('[name="stat"]').each(function () {
        if (this.checked)
          this.checked = false;
      });
      $('#idprov').val(null).trigger('change');
      $('#idkab').empty();
      $('#idkec').empty();
      $('#idkel').empty();
    });

    $('#senddata').on('click', function (e) {
      e.preventDefault();
      var diid = $('#iddi').val();
      swal({
        title       : 'Konfirmasi',
        text        : 'Yakin data yang di input Sudah Benar ?',
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
          if (diid == '') {
            $.ajax({
              type:"POST",
              url:"<?php echo base_url(); ?>direct/add",
              beforeSend : function () {
                swal({
                  title  : 'Menunggu',
                  html   : 'Memproses Data',
                  onOpen : () => {
                    swal.showLoading();
                  }
                })
              },
              data : $('#colectdrct').serialize(),
              dataType : "JSON",
              success  : function (data) {
                swal({
                  title             : data['status'],
                  text              : data['pesan'],
                  type              : data['altr'],
                  showConfirmButton : false,
                  timer               : 3000
                });
                if (data['altr'] == 'success') {
                  $('#clearall').trigger('click');
                }
                getkode();
                return true;
              },
              error: function (jqXHR, textStatus, errorThrown) {
                swal({
                  title             : "Peringatan",
                  text              : "Koneksi Tidak Terhubung",
                  type              : 'warning',
                  showConfirmButton : false,
                  timer               : 3000
                });
                return false;
              }
            });
          } else {
            $.ajax({
              type:"POST",
              url:"<?php echo base_url(); ?>direct/edit/"+diid,
              beforeSend : function () {
                swal({
                  title  : 'Menunggu',
                  html   : 'Memproses Data',
                  onOpen : () => {
                    swal.showLoading();
                  }
                })
              },
              data : $('#colectdrct').serialize(),
              dataType : "JSON",
              success  : function (data) {
                swal({
                  title             : data['status'],
                  text              : data['pesan'],
                  type              : data['altr'],
                  showConfirmButton : false,
                  timer               : 3000
                });
                if (data['altr'] == 'success') {
                  $('#clearall').trigger('click');
                }
                return true;
              },
              error: function (jqXHR, textStatus, errorThrown) {
                swal({
                  title             : "Peringatan",
                  text              : "Koneksi Tidak Terhubung",
                  type              : 'warning',
                  showConfirmButton : false,
                  timer               : 3000
                });
                return false;
              }
            });
          }
          table_direct_ro.ajax.reload();
          table_direct_ru.ajax.reload();
          table_direct_ro.columns.adjust().draw();
          table_direct_ru.columns.adjust().draw();
        } else if (result.dismiss === swal.DismissReason.cancel) {
          swal({
            title               : "Batal",
            text                : 'Anda membatalkan Penginputan Data Direct',
            buttonsStyling      : false,
            confirmButtonClass  : "btn btn-primary",
            type                : 'error',
            showConfirmButton   : false,
            timer               : 3000
          });
        }
      });
    });

    $('#idnega').on('change', function () {
      $("#idprov").empty();
      if ($(this).val() != '') {
        $.ajax({
          type:"GET",
          url:"<?php echo base_url(); ?>nasabah/getprov/"+$(this).val(),
          success  : function (data) {
            var prov = JSON.parse(data); var provv = "<option value=''>-- Pilih Provinsi --</option>";
            for (var i = 0; i < prov.length; i++) {
              provv = provv+"<option value='"+prov[i].id_provinsi+"'>"+prov[i].provinsi+"</option>";
            }
            $('#idprov').append(provv);
          }
        });
      }
    });

    $('#idprov').on('change', function () {
      $("#idkab").empty();
      if ($(this).val() != '') {
        $.ajax({
          type:"GET",
          url:"<?php echo base_url(); ?>nasabah/getkab/"+$(this).val(),
          success  : function (data) {
            var kab = JSON.parse(data); var kabkab = "<option value=''>-- Pilih Kota/Kabupaten --</option>";
            for (var i = 0; i < kab.length; i++) {
              kabkab = kabkab+"<option value='"+kab[i].id_kota+"'>"+kab[i].kota+"</option>";
            }
            $('#idkab').append(kabkab);
          }
        });
      }
    });

    $('#idkab').on('change', function () {
      $("#idkec").empty();
      if ($(this).val() != '') {
        $.ajax({
          type:"GET",
          url:"<?php echo base_url(); ?>nasabah/getkec/"+$(this).val(),
          success  : function (data) {
            var kec = JSON.parse(data); var keckec = "<option value=''>-- Pilih Kecamatan --</option>";
            for (var i = 0; i < kec.length; i++) {
              keckec = keckec+"<option value='"+kec[i].id_kecamatan+"'>"+kec[i].kecamatan+"</option>";
            }
            $('#idkec').append(keckec);
          }
        });
      }
    });

    $('#idkec').on('change', function () {
      $("#idkel").empty();
      if ($(this).val() != '') {
        $.ajax({
          type:"GET",
          url:"<?php echo base_url(); ?>nasabah/getkel/"+$(this).val(),
          success  : function (data) {
            var kel = JSON.parse(data); var kelkel = "<option value=''>-- Pilih Desa/Kelurahan --</option>";
            for (var i = 0; i < kel.length; i++) {
              kelkel = kelkel+"<option value='"+kel[i].id_desa+"'>"+kel[i].desa+"</option>";
            }
            $("#idkel").append(kelkel);
          }
        });
      }
    });

  });

  function ubahubah(id) {
    window.scrollTo(0,0);
    $.ajax({
      type:"GET",
      url:"<?php echo base_url(); ?>direct/show/"+id,
      success  : function (data) {
        var hss = JSON.parse(data);
        $('#kddi').val(hss[0].kode_direct);
        $('#nmdi').val(hss[0].nama);
        $('#tldi').val(hss[0].telp);
        $('#aldi').val(hss[0].alamat);
        $('#iddi').val(hss[0].id_direct);
        var cek = '';
        if (typeof hss[0].status == 'boolean') {
          cek = hss[0].status == true ? 't':'f';
        } else {
          cek = hss[0].status;
        }
        $('[name="stat"]').each(function () {
          if (cek == this.value)
            this.checked = true;
        });
        $('#idprov').val(hss[0].id_provinsi).trigger('change');
        setkab(hss[0].id_provinsi,hss[0].id_kota);
        setkec(hss[0].id_kota,hss[0].id_kecamatan);
        setkel(hss[0].id_kecamatan,hss[0].id_desa);
      },
      error: function (jqXHR, textStatus, errorThrown) {
        swal({
          title             : "Peringatan",
          text              : "Koneksi Tidak Terhubung",
          type              : 'warning',
          showConfirmButton : false,
          timer               : 3000
        });
        return false;
      }
    });
  }

  function detaild(id) {
    window.scrollTo(0,0);
    $.ajax({
      type:"GET",
      url:"<?php echo base_url(); ?>direct/detail/"+id,
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
        var hss = JSON.parse(data);
        var lsd = "<table style='width:100%; text-align: left;'>"+
                    "<tr>"+
                      "<td style='width:25%;'><b>Kode Direct</b></td><td>:</td><td>"+hss[0].kode_direct+"</td>"+
                    "</tr>"+
                    "<tr>"+
                      "<td style='width:25%;'><b>Nama Direct</b></td><td>:</td><td>"+hss[0].nama+"</td>"+
                    "</tr>"+
                    "<tr>"+
                      "<td style='width:25%;'><b>Telpon</b></td><td>:</td><td>"+hss[0].telp+"</td>"+
                    "</tr>"+
                    "<tr>"+
                      "<td style='width:25%;'><b>Negara</b></td><td>:</td><td>"+(hss[0].negara == null?'-':hss[0].negara)+"</td>"+
                    "</tr>"+
                    "<tr>"+
                      "<td style='width:25%;'><b>Provinsi</b></td><td>:</td><td>"+(hss[0].provinsi == null?'-':hss[0].provinsi)+"</td>"+
                    "</tr>"+
                    "<tr>"+
                      "<td style='width:25%;'><b>kabupaten/Kota</b></td><td>:</td><td>"+(hss[0].kota == null?'-':hss[0].kota)+"</td>"+
                    "</tr>"+
                    "<tr>"+
                      "<td style='width:25%;'><b>Kecamatan</b></td><td>:</td><td>"+(hss[0].kecamatan == null?'-':hss[0].kecamatan)+"</td>"+
                    "</tr>"+
                    "<tr>"+
                      "<td style='width:25%;'><b>Kelurahan/Desa</b></td><td>:</td><td>"+(hss[0].desa == null?'-':hss[0].desa)+"</td>"+
                    "</tr>"+
                    "<tr>"+
                      "<td style='width:25%;'><b>Alamat Lengkap<b></td><td>:</td><td>"+(hss[0].alamat == null?'-':hss[0].alamat)+"</td>"+
                    "</tr>"+
                  "</table>";
        swal({
          title             : "Detail Direct",
          html              : lsd,
          customClass       : 'swal-wide',
          showConfirmButton : true,
        });
      }
    });
  }

  function setkab(idpr, idkb) {
    $("#idkab").empty();
    $.ajax({
      type:"GET",
      url:"<?php echo base_url(); ?>nasabah/getkab/"+idpr,
      success  : function (data) {
        var kab = JSON.parse(data); var kabkab = "<option value=''>-- Pilih Kota/Kabupaten --</option>";
        for (var i = 0; i < kab.length; i++) {
          if (kab[i].id_kota == idkb) {
            kabkab = kabkab+"<option value='"+kab[i].id_kota+"' selected>"+kab[i].kota+"</option>";
          } else {
            kabkab = kabkab+"<option value='"+kab[i].id_kota+"'>"+kab[i].kota+"</option>";
          }
        }
        $('#idkab').append(kabkab);
      }
    });
  }

  function setkec(idkb, idkc) {
    $("#idkec").empty();
    $.ajax({
      type:"GET",
      url:"<?php echo base_url(); ?>nasabah/getkec/"+idkb,
      success  : function (data) {
        var kec = JSON.parse(data); var keckec = "<option value=''>-- Pilih Kecamatan --</option>";
        for (var i = 0; i < kec.length; i++) {
          if (kec[i].id_kecamatan == idkc) {
            keckec = keckec+"<option value='"+kec[i].id_kecamatan+"' selected>"+kec[i].kecamatan+"</option>";
          } else {
            keckec = keckec+"<option value='"+kec[i].id_kecamatan+"'>"+kec[i].kecamatan+"</option>";
          }
        }
        $('#idkec').append(keckec);
      }
    });
  }

  function setkel(idkc, idkl) {
    $("#idkel").empty();
    $.ajax({
      type:"GET",
      url:"<?php echo base_url(); ?>nasabah/getkel/"+idkc,
      success  : function (data) {
        var kel = JSON.parse(data); var kelkel = "<option value=''>-- Pilih Kelurahan --</option>";
        for (var i = 0; i < kel.length; i++) {
          if (kel[i].id_desa == idkl) {
            kelkel = kelkel+"<option value='"+kel[i].id_desa+"' selected>"+kel[i].desa+"</option>";
          } else {
            kelkel = kelkel+"<option value='"+kel[i].id_desa+"'>"+kel[i].desa+"</option>";
          }
        }
        $('#idkel').append(kelkel);
      }
    });
  }

  function deletedel(id) {
    swal({
      title       : 'Konfirmasi',
      text        : 'Yakin akan Menghapus Data Direct',
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
          url:"<?php echo base_url(); ?>direct/remove/"+id,
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
              text              : "Data Direct telah di Hapus",
              type              : 'success',
              showConfirmButton : false,
              timer               : 3000
            });
            getkode();
            table_direct_ro.ajax.reload();
            table_direct_ru.ajax.reload();
            return true;
          },
          error: function (jqXHR, textStatus, errorThrown) {
            swal({
              title             : "Peringatan",
              text              : "Koneksi Tidak Terhubung",
              type              : 'warning',
              showConfirmButton : false,
              timer               : 3000
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
          timer               : 3000
        });
      }
    });
  }
</script>
