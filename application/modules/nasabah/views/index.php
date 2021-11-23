<style type="text/css">
  .swal-wide { width:900px !important; }
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
  <input type="hidden" id="status_toggle">
  <div class="row">
    <div class="col-md-12">
      <div class="card shadow">
        <div class="card-header">
          <?php if ($role['create'] == true || $role == null): ?>
          <div class="text-right">
            <button class="btn btn-primary waves-effect waves-light mr-2" id="senddata" data-toggle="modal" data-target="#myModal">Create Insured</button>
          </div>
          <?php endif; ?>
        </div>
        <div class="card-body">
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
          <br>
          <div class="tab-content">
            <div class="tab-pane active p-3" id="pro" role="tabpanel">
              <table id="datatable_ro" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Kode Insured</th>
                    <th>NIK</th>
                    <th>Nama Insured</th>
                    <th>Telepon</th>
                    <th>Tanggal Lahir</th>
                    <th>Jenis Kelamin</th>
                    <th>Aksi</th>
                  </tr>
                </thead>
              </table>
            </div>
            <div class="tab-pane p-3" id="pru" role="tabpanel">
              <table id="datatable_ru" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Kode Insured</th>
                    <th>NIK</th>
                    <th>Nama Insured</th>
                    <th>Telepon</th>
                    <th>Tanggal Lahir</th>
                    <th>Jenis Kelamin</th>
                    <th>Aksi</th>
                  </tr>
                </thead>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
<?php endif; ?>

<?php $this->load->view('modal_view'); ?>

<script type="text/javascript">
  // $('#myModalLabel').html('Tambah Insured');
  var table_nasabah_ru = '';
  var table_nasabah_ro = '';

  function getkode() {
    $.ajax({
      type:"GET",
      url:"<?php echo base_url(); ?>nasabah/nasabah_kode",
      success  : function (data) {
        $('#kdnsb').val(data);
      }
    });
  }

  $(document).ready(function () {
    $('#tglhr').datepicker({
      autoclose: true,
      todayHighlight: false,
      format: "yyyy-mm-dd",
      clearBtn: true,
      orientation: 'bottom'
    });
    var act = "<?=$role['update'].'_'.$role['delete']?>";

    $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
         .columns.adjust()
         .responsive.recalc();
    });

    table_nasabah_ro = $('#datatable_ro').DataTable({
      "responsive": true,
      "processing" : true,
      "serverSide" : true,
      "order" : [],
      "ajax" : {
        "url" : "<?php echo base_url(); ?>nasabah/ajaxdata/"+act,
        "type" : "POST",
        "data" : { "tipen":'t' }
      },
      "columnDefs" : [{
        "targets" : [0,7],
        "orderable" : false
      },{
        'targets' : [0,7],
        'className' : 'text-center',
      }]
    });

    table_nasabah_ru = $('#datatable_ru').DataTable({
      "responsive": true,
      "processing" : true,
      "serverSide" : true,
      "order" : [],
      "ajax" : {
        "url" : "<?php echo base_url(); ?>nasabah/ajaxdata/"+act,
        "type" : "POST",
        "data" : { "tipen":'f' }
      },
      "columnDefs" : [{
        "targets" : [0,7],
        "orderable" : false
      },{
        'targets' : [0,7],
        'className' : 'text-center',
      }]
    });

    getkode();

    $('#savenasabah').on('click', function (e) {
      e.preventDefault();
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
          if ($('#idnsb').val() == "") {
            $.ajax({
              type:"POST",
              url:"<?php echo base_url(); ?>nasabah/add",
              beforeSend : function () {
                swal({
                  title  : 'Menunggu',
                  html   : 'Memproses Data',
                  onOpen : () => {
                    swal.showLoading();
                  }
                })
              },
              data : $('#colectnsbh').serialize(),
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
                  $('#myModal').modal('hide');
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
              url:"<?php echo base_url(); ?>nasabah/edit/"+$('#idnsb').val(),
              beforeSend : function () {
                swal({
                  title  : 'Menunggu',
                  html   : 'Memproses Data',
                  onOpen : () => {
                    swal.showLoading();
                  }
                })
              },
              data : $('#colectnsbh').serialize(),
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
                  $('#myModal').modal('hide');
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
          table_nasabah_ro.ajax.reload();
          table_nasabah_ru.ajax.reload();
          table_nasabah_ro.columns.adjust().draw();
          table_nasabah_ru.columns.adjust().draw();
        } else if (result.dismiss === swal.DismissReason.cancel) {
          swal({
            title               : "Batal",
            text                : 'Anda membatalkan Penginputan Data Nasabah',
            buttonsStyling      : false,
            confirmButtonClass  : "btn btn-primary",
            type                : 'error',
            showConfirmButton   : false,
            timer               : 3000
          });
        }
      });
    });

    $('#senddata').on('click', function () {
      getkode();
      $('#myModalLabel').html('Tambah Insured');
      $('#nnik').val('');
      $('#idnsb').val('');
      $('#nmnsbh').val('');
      $('#tglhr').val('');
      $('#jenkl1').prop('checked', false);
      $('#jenkl2').prop('checked', false);
      $('#telp').val('');
      $('#almtrm').val('');
      $('#tmpdns').val('');
      $('[name="stat"]').each(function () {
        if (this.checked)
          this.checked = false;
      });
      $('#idprov').val(null).trigger('change');
      $('#idkab').empty();
      $('#idkec').empty();
      $('#idkel').empty();
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
    $('#myModalLabel').html('Edit Insured');
    $('#myModal').modal('show');
    $.ajax({
      type:"GET",
      url:"<?php echo base_url(); ?>nasabah/show/"+id,
      success  : function (data) {
        var hss = JSON.parse(data);
        $('#kdnsb').val(hss[0].kode_nasabah);
        $('#nnik').val(hss[0].nik);
        $('#idnsb').val(hss[0].id_nasabah);
        $('#nmnsbh').val(hss[0].nama_nasabah);
        $('#tglhr').val(hss[0].tgl_lahir);
        var jkl = ''; var cek = '';
        // ----------------------
        if (typeof hss[0].jenis_kelamin == 'boolean') { jkl = hss[0].jenis_kelamin == true ? 't':'f'; }
        else { jkl = hss[0].jenis_kelamin; }
        // --- space
        if (typeof hss[0].status == 'boolean') { cek = hss[0].status == true ? 't':'f'; }
        else { cek = hss[0].status; }
        // ---------------
        $('[name="jenkl"]').each(function () {
          if (cek == 't' && hss[0].jenis_kelamin != null) {
            if (this.value == jkl) { this.checked = true; }
          } else {
            this.checked = false;
          }
        });
        $('#telp').val(hss[0].telp);
        $('#almtrm').val(hss[0].alamat_rumah);
        $('#tmpdns').val(hss[0].tempat_dinas);
        $('[name="stat"]').each(function () {
          if (this.value == cek) { this.checked = true; }
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
      url:"<?php echo base_url(); ?>nasabah/detail/"+id,
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
        var jnskl = '';
        if (hss[0].jenis_kelamin != null) {
          if (hss[0].jenis_kelamin == true) {  //true     // conditional here
            jnskl = 'Laki-laki';
          } else {
            jnskl = 'Perempuan';
          }
        } else {
          jnskl = '-';
        }
        var lsd = "<div class='row'>"+
                    "<div class='col-md-6'>"+
                      "<table style='width:100%; text-align: left;'>"+
                        "<tr>"+
                          "<td style='width:35%;'><b>Kode Nasabah</b></td><td>:</td><td>"+hss[0].kode_nasabah+"</td>"+
                        "</tr>"+
                        "<tr>"+
                          "<td style='width:35%;'><b>NIK</b></td><td>:</td><td>"+(hss[0].nik == null?'-':(hss[0].nik == ""?'-':hss[0].nik))+"</td>"+
                        "</tr>"+
                        "<tr>"+
                          "<td style='width:35%;'><b>Nama</b></td><td>:</td><td>"+hss[0].nama_nasabah+"</td>"+
                        "</tr>"+
                        "<tr>"+
                          "<td style='width:35%;'><b>Tanggal Lahir</b></td><td>:</td><td>"+(hss[0].tgl_lahir == null?'-':hss[0].tgl_lahir)+"</td>"+
                        "</tr>"+
                        "<tr>"+
                          "<td style='width:35%;'><b>Jenis kelamin</b></td><td>:</td><td>"+jnskl+"</td>"+
                        "</tr>"+
                        "<tr>"+
                          "<td style='width:35%;'><b>Telepon</b></td><td>:</td><td>"+hss[0].telp+"</td>"+
                        "</tr>"+
                      "</table>"+
                    "</div>"+
                    "<div class='col-md-6'>"+
                      "<table style='width:100%; text-align: left;'>"+
                        "<tr>"+
                          "<td style='width:37%;'><b>Negara</b></td><td>:</td><td>"+(hss[0].negara == null?'-':hss[0].negara)+"</td>"+
                        "</tr>"+
                        "<tr>"+
                          "<td style='width:37%;'><b>Provinsi</b></td><td>:</td><td>"+(hss[0].provinsi == null?'-':hss[0].provinsi)+"</td>"+
                        "</tr>"+
                        "<tr>"+
                          "<td style='width:37%;'><b>kabupaten/Kota</b></td><td>:</td><td>"+(hss[0].kota == null?'-':hss[0].kota)+"</td>"+
                        "</tr>"+
                        "<tr>"+
                          "<td style='width:37%;'><b>Kecamatan</b></td><td>:</td><td>"+(hss[0].kecamatan == null?'-':hss[0].kecamatan)+"</td>"+
                        "</tr>"+
                        "<tr>"+
                          "<td style='width:37%;'><b>Kelurahan/Desa</b></td><td>:</td><td>"+(hss[0].desa == null?'-':hss[0].desa)+"</td>"+
                        "</tr>"+
                        "<tr>"+
                          "<td style='width:37%; vertical-align:top;'><b>Alamat Lengkap<b></td><td style='vertical-align:top;'>:</td><td>"+(hss[0].alamat_rumah == null?'-':hss[0].alamat_rumah)+"</td>"+
                        "</tr>"+
                      "</table>"+
                    "</div>"+
                  "</div>";
        swal({
          title             : "Detail Nasabah",
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
      text        : 'Yakin akan Menghapus Nasabah',
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
          url:"<?php echo base_url(); ?>nasabah/remove/"+id,
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
              text              : "Nasabah telah di Hapus",
              type              : 'success',
              showConfirmButton : false,
              timer               : 3000
            });
            table_nasabah_ro.ajax.reload();
            table_nasabah_ru.ajax.reload();
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
      } else if (result.dismiss === swal.DismissReason.cancel) {
        swal({
          title               : "Batal",
          text                : 'Anda membatalkan Hapus Nasabah',
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
