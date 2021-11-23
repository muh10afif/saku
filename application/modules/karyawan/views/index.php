<style type="text/css">
  .col-form-label { font-size: 12px; }
  .swal-wide { width:920px !important; }
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
    <?php $this->load->view('input'); ?>
    <div class="col-md-12">
      <div class="card shadow">
        <div class="card-header">
          <div class="row align-items-center">
            <div class="col-sm-6">
              <div class="text-left">
                <h5>List <?= $title ?></h5>
              </div>
            </div>
            <?php if ($role['create'] == true || $role == null): ?>
              <div class="col-sm-6">
                <div class="text-right">
                  <button class="btn btn-primary waves-effect waves-light mr-2" id="sendkry">Add Karyawan</button>
                </div>
              </div>
            <?php endif; ?>
          </div>
        </div>
        <div class="card-body">
          <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
            <thead>
              <tr>
                <th>No</th>
                <th>Kode karyawan</th>
                <th>Nik</th>
                <th>Nama</th>
                <th>Bagian/Jabatan</th>
                <th>Aksi</th>
              </tr>
            </thead>
          </table>
        </div>
      </div>
    </div>
  </div>
<?php endif; ?>

<div class="modal fade" id="modal_detail_karyawan" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
    <div class="modal-content">
        <div class="modal-header bg-primary text-white">
            <h5 class="modal-title mt-0">Detail Karyawan</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true" class="text-white">&times;</span>
            </button>
        </div>
        <div class="modal-body detail_karyawan">
            
        </div>
        <!-- <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fas fa-ban mr-2"></i>Tutup</button>
      </div> -->
    </div>
  </div>
</div>

<script type="text/javascript">
  var table_karyawan = '';
  $(document).ready(function () {
    var act = "<?=$role['update'].'_'.$role['delete']?>";
    table_karyawan = $('#datatable').DataTable({
      "processing" : true,
      "serverSide" : true,
      "order" : [],
      "ajax" : {
        "url" : "<?php echo base_url(); ?>karyawan/ajaxdata/"+act,
        "type" : "POST"
      },
      "columnDefs" : [{
        "targets" : [0,4,5],
        "orderable" : false
      },{
        'targets' : [0,5],
        'className' : 'text-center',
      }],
      "scrollX" : true
    });

    $('#sendkry').on('click', function () {
      $('.f_tambah').slideToggle('fast', function() {
        $('#changetitlenm').html('Input <?= $title ?>');
        if ($(this).is(':visible')) {
          $('#status_toggle').val(1);
        } else {
          $('#status_toggle').val(0);
        }
        getkode();
      });
    });

    $('.batal_entry').on('click', function (e) {
      e.preventDefault();
      $('.f_tambah').slideToggle('fast', function() {
        if ($(this).is(':visible')) {
          $('#status_toggle').val(1);
        } else {
          $('#status_toggle').val(0);
        }
        $('.hapus-karyawan').removeAttr('hidden');
        $('#sendkry').attr('hidden', false);
        $('#nmkary').val('');
        $('#almt').val('');
        $('#mail').val('');
        $('#tele').val('');
        $('#nnik').val('');
        $('#jbtn').val(null).trigger('change');
        getjbtn(document.getElementById('bgian'),0);
        $('#bgian').val('').trigger('change');
        $('#idprov').val(null).trigger('change');
        $('#idkab').empty();
        $('#idkec').empty();
        $('#idkel').empty();
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

    $('#senddata').on('click', function (x) {
      x.preventDefault();
      var idkr = $('#idkry').val();
      if (idkr == "") {
        $.ajax({
          type:"POST",
          url:"<?php echo base_url(); ?>karyawan/add",
          beforeSend : function () {
            swal({
              title  : 'Menunggu',
              html   : 'Memproses Data',
              onOpen : () => {
                swal.showLoading();
              }
            })
          },
          data: $('#colectkry').serialize(),
          dataType : "JSON",
          success  : function (data) {
            var isck = '';
            $(data['hasil']).each(function () {
              if ($(this)[0].innerHTML != undefined) {
                isck = isck+$(this)[0].innerHTML;
              }
            });
            if (isck == "Format Email Tidak Sesuai") {
              swal({
                title             : data['status'],
                html              : data['hasil'],
                type              : data['altr'],
                showConfirmButton : false,
                timer               : 3000
              });
            } else {
              swal({
                title             : data['status'],
                text              : data['pesan'],
                type              : data['altr'],
                showConfirmButton : false,
                timer               : 3000
              });
            }
            if (data['altr'] == 'success') {
              $('#sendkry').attr('hidden', false);
              $('#nmkary').val('');
              $('#almt').val('');
              $('#mail').val('');
              $('#tele').val('');
              $('#nnik').val('');
              $('#jbtn').val(null).trigger('change');
              getjbtn(document.getElementById('bgian'),0);
              $('#bgian').val('').trigger('change');
              $('#idprov').val(null).trigger('change');
              $('#idkab').empty();
              $('#idkec').empty();
              $('#idkel').empty();
              $('.hapus-karyawan').removeAttr('hidden');
              // $('.batal_entry').trigger('click');
              $('.f_tambah').slideToggle('fast', function() {
                if ($(this).is(':visible')) {
                  $('#status_toggle').val(1);
                } else {
                  $('#status_toggle').val(0);
                }
              });
            }
            table_karyawan.ajax.reload();
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
          url:"<?php echo base_url(); ?>karyawan/edit/"+idkr,
          beforeSend : function () {
            swal({
              title  : 'Menunggu',
              html   : 'Memproses Data',
              onOpen : () => {
                swal.showLoading();
              }
            })
          },
          data: $('#colectkry').serialize(),
          dataType : "JSON",
          success  : function (data) {
            var isck = '';
            $(data['hasil']).each(function () {
              if ($(this)[0].innerHTML != undefined) {
                isck = isck+$(this)[0].innerHTML;
              }
            });
            if (isck == "Format Email Tidak Sesuai") {
              swal({
                title             : data['status'],
                html              : data['hasil'],
                type              : data['altr'],
                showConfirmButton : false,
                timer               : 3000
              });
            } else {
              swal({
                title             : data['status'],
                text              : data['pesan'],
                type              : data['altr'],
                showConfirmButton : false,
                timer               : 3000
              });
            }
            if (data['altr'] == 'success') {
              $('#idkry').val('');
              $('#sendkry').attr('hidden', false);
              $('#nmkary').val('');
              $('#almt').val('');
              $('#mail').val('');
              $('#tele').val('');
              $('#nnik').val('');
              $('#jbtn').val(null).trigger('change');
              getjbtn(document.getElementById('bgian'),0);
              $('#bgian').val('').trigger('change');
              $('#idprov').val(null).trigger('change');
              $('#idkab').empty();
              $('#idkec').empty();
              $('#idkel').empty();
              $('.hapus-karyawan').removeAttr('hidden');
              // $('.batal_entry').trigger('click');
              $('.f_tambah').slideToggle('fast', function() {
                if ($(this).is(':visible')) {
                  $('#status_toggle').val(1);
                } else {
                  $('#status_toggle').val(0);
                }
              });
            }
            table_karyawan.ajax.reload();
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
    });

    function getkode() {
      $.ajax({
        type:"GET",
        url:"<?php echo base_url(); ?>karyawan/karyawan_kode",
        success  : function (data) {
          $('#kode_karyawan').val(data);
        }
      });
    }

  });

  function getjbtn(idz,cnd) {
    if (idz.value != '') {
      $.ajax({
        type:"GET",
        url:"<?php echo base_url(); ?>jabatan/bybagian/"+idz.value,
        success  : function (data) {
          var hss = JSON.parse(data); var opp = '<option value="">-- Pilih --</option>';
          for (var i = 0; i < hss.length; i++) {
            if (cnd == hss[i].id_jabatan) {
              opp = opp+'<option value="'+hss[i].id_jabatan+'" selected>'+hss[i].jabatan+'</option>';
            } else {
              opp = opp+'<option value="'+hss[i].id_jabatan+'">'+hss[i].jabatan+'</option>';
            }
          }
          $('#jbtn').html(opp);
        }
      });
    }
  }

  function ubahubah(id) {
    $('#changetitlenm').html('Edit <?= $title ?>');
    $('.hapus-karyawan').attr('hidden', true);
    $('html, body').animate({
      scrollTop: $('body').offset().top
    }, 800);
    $.ajax({
      type:"GET",
      url:"<?php echo base_url(); ?>karyawan/show/"+id,
      success  : function (data) {
        var hss = JSON.parse(data);
        $('#kode_karyawan'). val(hss[0]['kode_karyawan']);
        $('#idkry'). val(hss[0]['id_karyawan']);
        $('#nmkary').val(hss[0]['nama_karyawan']);
        $('#almt').val(hss[0]['alamat_karyawan']);
        $('#mail').val(hss[0]['email']);
        $('#tele').val(hss[0]['telp']);
        $('#nnik').val(hss[0]['nik']);
        $('#bgian').val(hss[0]['id_bagian']).trigger('change');
        getjbtn(document.getElementById('bgian'), hss[0]['id_jabatan']);
        $('#idprov').val(hss[0].id_provinsi).trigger('change');
        setkab(hss[0].id_provinsi,hss[0].id_kota);
        setkec(hss[0].id_kota,hss[0].id_kecamatan);
        setkel(hss[0].id_kecamatan,hss[0].id_desa);
        if ($('#status_toggle').val() == 0) {
          $('.f_tambah').slideToggle('fast', function() {
            if ($(this).is(':visible')) {
              $('#status_toggle').val(1);
            } else {
              $('#status_toggle').val(0);
            }
          });
        }
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
      url:"<?php echo base_url(); ?>karyawan/detail/"+id,
      beforeSend : function () {
        swal({
          title  : 'Menunggu',
          html   : 'Memproses Data',
          onOpen : () => {
            swal.showLoading();
          },
          allowOutsideClick   : false
        })
      },
      success  : function (data) {

        swal.close();
        $('.detail_karyawan').html(data);
        $('#modal_detail_karyawan').modal('show');

        // var hss = JSON.parse(data);
        // var lsd = "<div class='row'>"+
        //             "<div class='col-md-6'>"+
        //               "<table style='width:100%; text-align: left;'>"+
        //                 "<tr>"+
        //                   "<td style='width:37%;'><b>NIK</b></td><td>:</td><td>"+hss[0].nik+"</td>"+
        //                 "</tr>"+
        //                 "<tr>"+
        //                   "<td style='width:37%;'><b>Nama</b></td><td>:</td><td>"+hss[0].nama_karyawan+"</td>"+
        //                 "</tr>"+
        //                 "<tr>"+
        //                   "<td style='width:37%;'><b>Bagian</b></td><td>:</td><td>"+hss[0].bagian+"</td>"+
        //                 "</tr>"+
        //                 "<tr>"+
        //                   "<td style='width:37%;'><b>Jabatan</b></td><td>:</td><td>"+hss[0].jabatan+"</td>"+
        //                 "</tr>"+
        //               "</table>"+
        //             "</div>"+
        //             "<div class='col-md-6'>"+
        //               "<table style='width:100%; text-align: left;'>"+
        //                 "<tr>"+
        //                   "<td style='width:18%;'><b>Telepon</b></td><td>:</td><td>"+hss[0].telp+"</td>"+
        //                 "</tr>"+
        //                 "<tr>"+
        //                   "<td style='width:18%;'><b>Email</b></td><td>:</td><td>"+hss[0].email+"</td>"+
        //                 "</tr>"+
        //               "</table>"+
        //             "</div>"+
        //           "</div>"+
        //           "<hr>"+
        //           "<div class='row'>"+
        //             "<div class='col-md-6'>"+
        //               "<table style='width:100%; text-align: left;'>"+
        //                 "<tr>"+
        //                   "<td style='width:37%;'><b>Negara</b></td><td>:</td><td>"+(hss[0].negara == null?'-':hss[0].negara)+"</td>"+
        //                 "</tr>"+
        //                 "<tr>"+
        //                   "<td style='width:37%;'><b>Provinsi</b></td><td>:</td><td>"+(hss[0].provinsi == null?'-':hss[0].provinsi)+"</td>"+
        //                 "</tr>"+
        //                 "<tr>"+
        //                   "<td style='width:37%;'><b>kabupaten/Kota</b></td><td>:</td><td>"+(hss[0].kota == null?'-':hss[0].kota)+"</td>"+
        //                 "</tr>"+
        //                 "<tr>"+
        //                   "<td style='width:37%;'><b>Kecamatan</b></td><td>:</td><td>"+(hss[0].kecamatan == null?'-':hss[0].kecamatan)+"</td>"+
        //                 "</tr>"+
        //                 "<tr>"+
        //                   "<td style='width:37%;'><b>Kelurahan/Desa</b></td><td>:</td><td>"+(hss[0].desa == null?'-':hss[0].desa)+"</td>"+
        //                 "</tr>"+
        //               "</table>"+
        //             "</div>"+
        //             "<div class='col-md-6'>"+
        //               "<table style='width:100%; text-align: left;'>"+
        //                 "<tr>"+
        //                   "<td style='width:18%; vertical-align:top;'><b>Alamat</b></td><td style='vertical-align:top;'>:</td><td>"+hss[0].alamat_karyawan+"</td>"+
        //                 "</tr>"+
        //               "</table>"+
        //             "</div>"+
        //           "</div>";
        // swal({
        //   title             : "Detail karyawan",
        //   html              : lsd,
        //   customClass       : 'swal-wide',
        //   showConfirmButton : true,
        // });
      }
    });
  }

  function setkab(idpr, idkb) {
    if (idpr != null) {
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
  }

  function setkec(idkb, idkc) {
    if (idkb != null) {
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
  }

  function setkel(idkc, idkl) {
    if (idkc != null) {
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
  }

  function deletedel(id) {
    swal({
      title       : 'Konfirmasi',
      text        : 'Yakin akan Menghapus Karyawan',
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
          url:"<?php echo base_url(); ?>karyawan/remove/"+id,
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
              text              : "Karyawan telah di Hapus",
              type              : 'success',
              showConfirmButton : false,
              timer               : 3000
            });
            table_karyawan.ajax.reload();
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
          text                : 'Anda membatalkan Hapus karyawan',
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
