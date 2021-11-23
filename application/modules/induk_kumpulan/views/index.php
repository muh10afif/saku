<style>
    .sel2 .parsley-errors-list.filled {
    margin-top: 42px;
    margin-bottom: -60px;
    }

    .sel2 .parsley-errors-list:not(.filled) {
    display: none;
    }

    .sel2 .parsley-errors-list.filled + span.select2 {
    margin-bottom: 30px;
    }

    .sel2 .parsley-errors-list.filled + span.select2 span.select2-selection--single {
        background: #FAEDEC !important;
        border: 1px solid #E85445;
    }
    .table-responsive {
        display: table;
    }
</style>
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
    <div class="col-md-8">
      <div class="card shadow">
        <div class="card-body">
          <table id="tb_induk_kumpulan" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
            <thead class="thead-light text-center">
              <tr>
                <th>No</th>
                <th>Jenis CDB Tertanggung</th>
                <th>Tertanggung</th>
                <th>Jenis CDB Induk Kumpulan</th>
                <th>Induk Kumpulan</th>
                <th>Action</th>
              </tr>
            </thead>
          </table>
        </div>
      </div>
    </div>
    <div class="col-md-4">
      <div class="card shadow">
        <form id="form_induk_kumpulan">
          <input type="hidden" name="aksi" id="aksi" value="tambah">
          <input type="hidden" name="id_relasi" id="id_relasi">
          <div class="card-body">
            <div class="form-group sel2">
              <label>Pilih Jenis Client Tertanggung<b style="color:red;">*</b></label>
              <select class="form-control select2" name="jenis_client_ttg" id="jenis_client_ttg" onchange="setupclient_ttg(this.value)" required data-parsley-required-message="Jenis Client Tertanggung Harus Terisi.">
                <option value="">Pilih</option>
                <?php foreach ($sob as $s): ?>
                  <option value="<?= $s['id_sob'] ?>"><?= $s['sob'] ?></option>
                <?php endforeach; ?>
                <!-- <option value="3">Agent</option>
                <option value="5">Business Partner</option>
                <option value="4">Direct</option>
                <option value="1">Insurer</option>
                <option value="2">Insured</option>
                <option value="6">Loss Adjuster</option> -->
              </select>
            </div>
            <div class="form-group sel2">
              <label>Pilih Tertanggung<b style="color:red;">*</b></label>
              <select name="pil_tertanggung" id="pil_tertanggung" class="form-control select2" required data-parsley-required-message="Tertanggung Harus Terisi.">
              <option value="">Pilih</option>
              </select>
            </div>
            <hr>
            <div class="form-group sel2">
              <label>Pilih Jenis Client Induk Kumpulan<b style="color:red;">*</b></label>
              <select class="form-control select2" name="jenis_client_ik" id="jenis_client_ik" onchange="setupclient_ik(this.value)" required data-parsley-required-message="Jenis Induk Kumpulan Harus Terisi.">
                <option value="">Pilih</option>
                <?php foreach ($sob as $s): ?>
                  <option value="<?= $s['id_sob'] ?>"><?= $s['sob'] ?></option>
                <?php endforeach; ?>
                <!-- <option value="3">Agent</option>
                <option value="5">Business Partner</option>
                <option value="4">Direct</option>
                <option value="1">Insurer</option>
                <option value="2">Insured</option>
                <option value="6">Loss Adjuster</option> -->
              </select>
            </div>
            <div class="form-group sel2">
              <label>Pilih Induk Kumpulan<b style="color:red;">*</b></label>
              <select name="pil_induk_kumpulan" id="pil_induk_kumpulan" class="form-control select2" required data-parsley-required-message="Jenis Client Induk Kumpulan Harus Terisi.">
              <option value="">Pilih</option>
              </select>
            </div>
            
            <hr>
            <i style="color:red;">('*') Menandakan Form Harus di Isi</i>
            <div class="form-group text-center mt-2 mb-0">
              <?php if ($role['create'] == true || $role == null): ?>
                <button type="submit" class="btn btn-primary waves-effect waves-light mr-2" id="">Submit</button>
              <?php endif; ?>
              <button type="button" class="btn btn-secondary waves-effect" id="clearall">Cancel</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
<?php endif; ?>

<script type="text/javascript">
  var tb_induk_kumpulan = '';
  $(document).ready(function () {
    var act = "<?=$role['update'].'_'.$role['delete']?>";
    tb_induk_kumpulan = $('#tb_induk_kumpulan').DataTable({
      "processing" : true,
      "serverSide" : false,
      "order" : [],
      "ajax" : {
        "url" : "<?php echo base_url(); ?>induk_kumpulan/ajaxdata/"+act,
        "type" : "POST"
      },
      "columnDefs" : [{
        "targets" : [0,5],
        "orderable" : false
      },{
        'targets' : [0],
        'className' : 'text-center',
      }]
    });

    $('#form_induk_kumpulan').parsley();

    $("#jenis_client_ttg").change(function() {
        $(this).trigger('input')
    });
    $("#pil_tertanggung").change(function() {
        $(this).trigger('input')
    });
    $("#jenis_client_ik").change(function() {
        $(this).trigger('input')
    });
    $("#pil_induk_kumpulan").change(function() {
        $(this).trigger('input')
    });

    $('#clearall').on('click', function () {

      $('#jenis_client_ttg').val('').trigger('change');
      $('#pil_tertanggung').val('').trigger('change');
      $('#jenis_client_ik').val('').trigger('change');
      $('#pil_induk_kumpulan').val('').trigger('change');

      $('#aksi').val('tambah');
      $('#id_relasi').val('');
      $("#form_induk_kumpulan").parsley().reset();

    });

    $('#form_induk_kumpulan').on('submit', function () {

      var form = $('#form_induk_kumpulan').serialize();

      swal({
          title       : 'Konfirmasi',
          text        : 'Yakin akan simpan data?',
          type        : 'warning',

          buttonsStyling      : false,
          confirmButtonClass  : "btn btn-primary",
          cancelButtonClass   : "btn btn-danger mr-3",

          showCancelButton    : true,
          confirmButtonText   : 'Ya',
          confirmButtonColor  : '#3085d6',
          cancelButtonColor   : '#d33',
          cancelButtonText    : 'Batal',
          reverseButtons      : true,

          allowOutsideClick   : false
      }).then((result) => {
          if (result.value) {
              
              $.ajax({
                  url         : "<?= base_url() ?>induk_kumpulan/simpan_data",
                  type      : "POST",
                  beforeSend  : function () {
                      swal({
                          title   : 'Menunggu',
                          html    : 'Memproses Data',
                          onOpen  : () => {
                              swal.showLoading();
                          },
                          allowOutsideClick   : false
                      })
                  },
                  data        : form,
                  dataType    : "JSON",
                  success     : function (data) {

                    if (data.status == 'gagal') {

                      swal({
                          title               : "Peringatan",
                          text                : 'Data yang diinput sudah ada, harap ganti!',
                          buttonsStyling      : false,
                          confirmButtonClass  : "btn btn-primary",
                          type                : 'warning',
                          showConfirmButton   : true,
                          allowOutsideClick   : false
                      });

                      return false;
                      
                    }

                    swal({
                        title               : "Berhasil",
                        text                : 'Data berhasil disimpan',
                        buttonsStyling      : false,
                        confirmButtonClass  : "btn btn-success",
                        type                : 'success',
                        showConfirmButton   : false,
                        timer               : 3000,
                        allowOutsideClick   : false
                    });    

                    $('#clearall').trigger('click');

                    tb_induk_kumpulan.ajax.reload(null,false);   
                      
                  },
                  error       : function(xhr, status, error) {

                      swal({
                          title               : 'Gagal',
                          text                : 'Simpan data tidak berhasil',
                          buttonsStyling      : false,
                          confirmButtonClass  : "btn btn-success",
                          type                : 'error',
                          showConfirmButton   : false,
                          timer               : 3000
                      }); 
                      
                      return false;
                  }

              })

              return false;

          } else if (result.dismiss === swal.DismissReason.cancel) {
              swal.close();
          }
      })

      return false;

    });

  });

  function ubahubah(id, data) {
    window.scrollTo(0,0);
    
    $.ajax({
      type:"GET",
      url:"<?php echo base_url(); ?>induk_kumpulan/get_induk_kumpulan/"+id,
      dataType : "JSON",
      success  : function (data) {

        $('#aksi').val('ubah');
        $('#id_relasi').val(data.id);
        $('#jenis_client_ttg').val(data.ft_tertanggung).trigger('change');
        setupclient_ttg(data.ft_tertanggung, data.tertanggung);
        
        $('#jenis_client_ik').val(data.ft_induk_kumpulan).trigger('change');
        setupclient_ik(data.ft_induk_kumpulan, data.induk_kumpulan)

      },
      error: function (jqXHR, textStatus, errorThrown) {
        swal({
          title             : "Peringatan",
          text              : "Gagal proses data!",
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
      text        : 'Yakin akan menghapus data ini?',
      type        : 'warning',
      buttonsStyling      : false,
      confirmButtonClass  : "btn btn-danger",
      cancelButtonClass   : "btn btn-primary mr-3",
      showCancelButton    : true,
      confirmButtonText   : 'Ya',
      confirmButtonColor  : '#3085d6',
      cancelButtonColor   : '#d33',
      cancelButtonText    : 'Batal',
      reverseButtons      : true
    }).then((result) => {
      if (result.value) {
        $.ajax({
          type:"POST",
          url:"<?php echo base_url(); ?>induk_kumpulan/simpan_data/",
          data : {id_relasi:id, aksi:'hapus'},
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
              text              : "Data berhasil dihapus",
              type              : 'success',
              showConfirmButton : false,
              timer             : 3000
            });

            $('#clearall').trigger('click');
            tb_induk_kumpulan.ajax.reload();
            
          },
          error: function (jqXHR, textStatus, errorThrown) {
            swal({
              title             : "Peringatan",
              text              : "Gagal proses data!",
              type              : 'warning',
              showConfirmButton : false,
              timer             : 3000
            });
            return false;
          }
        });
      } else if (result.dismiss === swal.DismissReason.cancel) {
        swal.close();
      }
    });
  }

  //jika Tertanggung
  function setupclient_ttg(isinya, idk) {
    $('#pil_tertanggung').empty();

    if (isinya != '') {
      $.ajax({
        type:"GET",
        url:"<?php echo base_url(); ?>user/getfromdb/"+isinya,
        success  : function (data) {
          $('#pilkarya').empty();
          var hss = JSON.parse(data); var newOption = '<option value="">Pilih</option>';
          for (var i = 0; i < hss.length; i++) {
            if (hss[i].id == idk) {
              newOption = newOption+"<option value='"+hss[i].id+"' selected>"+hss[i].nama+"</option>";
            } else {
              newOption = newOption+"<option value='"+hss[i].id+"'>"+hss[i].nama+"</option>";
            }
          }
          $('#pil_tertanggung').html(newOption);
        }
      });
    } else {
      $('#pil_tertanggung').append("<option value=''>Pilih</option>").trigger('change');
    }
  }

  //jika Induk Kumpulan
  function setupclient_ik(isinya, idk) {
    $('#pil_induk_kumpulan').empty();
    
    if (isinya != '') {
      $.ajax({
        type:"GET",
        url:"<?php echo base_url(); ?>user/getfromdb/"+isinya,
        success  : function (data) {
          $('#pilkarya').empty();
          var hss = JSON.parse(data); var newOption = '<option value="">Pilih</option>';
          for (var i = 0; i < hss.length; i++) {
            if (hss[i].id == idk) {
              newOption = newOption+"<option value='"+hss[i].id+"' selected>"+hss[i].nama+"</option>";
            } else {
              newOption = newOption+"<option value='"+hss[i].id+"'>"+hss[i].nama+"</option>";
            }
          }
          $('#pil_induk_kumpulan').html(newOption);
        }
      });
    } else {
      $('#pil_induk_kumpulan').append("<option value=''>Pilih</option>").trigger('change');
    }
  }
</script>
