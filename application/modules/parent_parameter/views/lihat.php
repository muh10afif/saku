<div class="page-title-box">
    <div class="row align-items-center">
        <div class="col-sm-6">
            <h4><?= $title ?></h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-right">
                <li class="breadcrumb-item"><a href="<?= base_url() ?>">All COB</a></li>
                <li class="breadcrumb-item">Transaction</li>
                <li class="breadcrumb-item active"><?= $title ?></li>
            </ol>
        </div>
    </div>
</div>
<input type="hidden" id="status_toggle">

<?php 

  if ($id_lvl_otorisasi == 0 || ($role['create'] == 'true')) {
    $col_kr = "col-md-7";
    $hid_kn = "";

  } else {
    
    $col_kr = "col-md-12";
    $hid_kn = "hidden";
  }
  
?>

<div class="row">

    <div class="<?= $col_kr ?>">
        <div class="card shadow">
            <div class="card-body table-responsive">
                <table class="table table-bordered table-hover dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;" id="tabel_parent_parameter" width="100%" cellspacing="0">
                    <thead class="thead-light text-center">
                        <tr>
                            <th width="5%">No</th>
                            <th width="20%">Parent Parameter</th>
                            <th width="20%">Bobot</th>
                            <th width="5%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                            
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="col-md-5" <?= $hid_kn ?>>
        <div class="card shadow">
            <form id="form_parent_parameter" autocomplete="off">
                <input type="hidden" name="id_parent_parameter" id="id_parent_parameter">
                <input type="hidden" name="aksi" id="aksi" value="Tambah">
                <div class="card-body d-flex justify-content-center">
                    <div class="col-md-12">
                        <!-- <div class="alert alert-secondary text-center" role="alert">
                            <strong>Maksimal Total Keseluruhan Bobot 100%</strong>
                        </div> -->
                        <div class="form-group">
                            <label for="parent_parameter" class="col-form-label text-left">Parent Parameter<span class="text-danger">*</span></label>
                            <div class="">
                                <input type="text" class="form-control" id="parent_parameter" name="parent_parameter" placeholder="Masukkan Parent Parameter">
                            </div>
                        </div>   
                        <div class="form-group">
                            <label for="bobot" class="col-form-label text-left">Bobot<span class="text-danger">*</span></label>
                            <div class="input-group">
                                <input type="text" class="form-control text-right numeric" id="bobot" name="bobot" placeholder="Masukkan Bobot" value="">
                                <input type="hidden" class="form-control" id="sisa" name="sisa">
                                <div class="input-group-append">
                                    <span class="input-group-text" id="basic-addon2">%</span>
                                </div>
                            </div>
                        </div>  
                        <p class="font-italic text-danger">(*) Data harus terisi.</p>
                        <p class="font-italic text-primary">Maksimal Total Keseluruhan Bobot 100%.</p>
                        <hr>
                        <div class="form-group text-center mt-1 mb-0">
                            <?php if ($role['create'] == 'true' || $id_lvl_otorisasi == 0) : ?>
                                <button type="button" class="btn btn-primary mt-1 mr-3" id="simpan_parent_parameter"><i class="fas fa-check mr-1"></i> Simpan</button>
                            <?php endif; ?>

                            <button type="button" class="btn btn-danger mt-1 batal_parent_parameter" id="batal_parent_parameter"><i class="fas fa-times mr-1"></i> Batal</button>
                        </div>   
                        
                    </div>

                </div>
            </form>
        </div>
    </div>
</div>

<script>


    $(document).ready(function () {
        nilai_sisa_bobot();

        // menampilkan list parent_parameter
        var tabel_list_parent_parameter = $('#tabel_parent_parameter').DataTable({
            "processing"        : true,
            "serverSide"        : true,
            "order"             : [],
            "ajax"              : {
                "url"   : "<?= base_url() ?>parent_parameter/tampil_data_parent_parameter",
                "type"  : "POST",
                "data"  : function (data) {
                    data.read               = "<?= $role['read'] ?>";
                    data.create             = "<?= $role['create'] ?>";
                    data.update             = "<?= $role['update'] ?>";
                    data.delete             = "<?= $role['delete'] ?>";
                    data.id_user            = "<?= $id_user ?>";
                    data.id_lvl_otorisasi   = "<?= $id_lvl_otorisasi ?>";
                }
            },
            "columnDefs"        : [{
                "targets"   : [0,3],
                "orderable" : false
            }, {
                'targets'   : [0,3],
                'className' : 'text-center',
            }]
        })

        function nilai_sisa_bobot() {

            $.ajax({
                url     : "<?= base_url() ?>parent_parameter/get_sisa_bobot",
                type    : "POST",
                dataType: "JSON",
                success : function (data) {

                    $('#bobot').val(data.sisa_bobot);
                    $('#sisa').val(data.sisa_bobot);

                    if (data.sisa_bobot == 0) {
                        $('#simpan_parent_parameter').attr('disabled', true);
                    } else {
                        $('#simpan_parent_parameter').attr('disabled', false);
                    }

                }
            })
    
            return false;

        }

        // keyup bobot
        $('#bobot').on('keyup', function () {

            var value = $(this).val().split('.').join('');
            var sisa  = $('#sisa').val();

            $('#bobot').val(Math.max(Math.min(value, sisa), -sisa)); 
            
            var isi = $('#bobot').val().split('.').join('');
            
        })

        // aksi simpan data parent_parameter
        $('#simpan_parent_parameter').on('click', function () {

            var form_parent_parameter = $('#form_parent_parameter').serialize();
            var parent_parameter = $('#parent_parameter').val();

            if (parent_parameter == '') {
                $('#parent_parameter').focus();

                swal({
                    title               : "Peringatan",
                    text                : 'parent parameter harus terisi !',
                    buttonsStyling      : false,
                    type                : 'warning',
                    showConfirmButton   : false,
                    timer               : 3000
                }); 

                return false;

            } else {

                swal({
                    title       : 'Konfirmasi',
                    text        : 'Yakin akan kirim data',
                    type        : 'warning',

                    buttonsStyling      : false,
                    confirmButtonClass  : "btn btn-primary",
                    cancelButtonClass   : "btn btn-danger mr-3",

                    showCancelButton    : true,
                    confirmButtonText   : 'Ya',
                    confirmButtonColor  : '#3085d6',
                    cancelButtonColor   : '#d33',
                    cancelButtonText    : 'Batal',
                    reverseButtons      : true
                }).then((result) => {
                    if (result.value) {
                        $.ajax({
                            url     : "<?= base_url() ?>parent_parameter/simpan_data_parent_parameter",
                            type    : "POST",
                            beforeSend  : function () {
                                swal({
                                    title   : 'Menunggu',
                                    html    : 'Memproses Data',
                                    onOpen  : () => {
                                        swal.showLoading();
                                    }
                                })
                            },
                            data    : form_parent_parameter,
                            dataType: "JSON",
                            success : function (data) {

                                swal({
                                    title             : data['status'],
                                    text              : data['pesan'],
                                    type              : data['altr'],
                                    showConfirmButton : false,
                                    timer             : 3000
                                });

                                if (data['altr'] == 'success') {
                                    tabel_list_parent_parameter.ajax.reload(null,false);        
                                    
                                    $('#form_parent_parameter').trigger("reset");

                                    $('#bobot').val(data.sisa_bobot);

                                    $('.hapus-parent_parameter').removeAttr('hidden');
                    
                                    $('#aksi').val('Tambah');

                                    nilai_sisa_bobot();
                                }
                                
                            }
                        })
                
                        return false;

                    } else if (result.dismiss === swal.DismissReason.cancel) {

                        swal({
                            title               : "Batal",
                            text                : 'Anda membatalkan simpan data',
                            buttonsStyling      : false,
                            confirmButtonClass  : "btn btn-primary",
                            type                : 'error',
                            showConfirmButton   : false,
                            timer               : 3000
                        }); 
                    }
                })

                return false;
            
            }
            
        })

        // aksi batal parent_parameter
        $('.batal_parent_parameter').on('click', function () {

            $('#form_parent_parameter').trigger("reset");

            nilai_sisa_bobot();

            $('#aksi').val('Tambah');
        })

        // edit data parent_parameter
        $('#tabel_parent_parameter').on('click', '.edit-parent_parameter', function () {

            var id_parent_parameter     = $(this).data('id');
            var parent_parameter        = $(this).attr('nama');
            var bobot                   = $(this).attr('bobot');

            $('#id_parent_parameter').val(id_parent_parameter);
            $('#parent_parameter').val(parent_parameter);
            $('#bobot').val(bobot);

            // var sisa  = $('#sisa').val();

            // $('#sisa').val(parseInt(sisa) + parseInt(bobot));

            $('#simpan_parent_parameter').attr('disabled', false);

            $('#aksi').val('Ubah');

            $.ajax({
                url         : "<?= base_url() ?>parent_parameter/cari_data/"+id_parent_parameter,
                method      : "GET",
                dataType    : "JSON",
                success     : function (data) {
                    
                    $('#sisa').val(data.sisa_bobot);

                },
                error       : function(xhr, status, error) {
                    
                    swal({
                        title               : 'Gagal',
                        text                : 'Gagal menampilkan data',
                        type                : 'error',
                        showConfirmButton   : false,
                        timer               : 3000
                    }); 

                    return false;
                    
                }

            })

            return false;

        })

        // hapus parent_parameter
            $('#tabel_parent_parameter').on('click', '.hapus-parent_parameter', function () {
                
                var id_parent_parameter = $(this).data('id');
                var nama                = $(this).attr('nama');

                swal({
                    title       : 'Konfirmasi',
                    text        : 'Yakin akan hapus parent parameter '+nama+' ?',
                    type        : 'warning',

                    buttonsStyling      : false,
                    confirmButtonClass  : "btn btn-danger",
                    cancelButtonClass   : "btn btn-primary mr-3",

                    showCancelButton    : true,
                    confirmButtonText   : 'Hapus',
                    confirmButtonColor  : '#d33',
                    cancelButtonColor   : '#3085d6',
                    cancelButtonText    : 'Batal',
                    reverseButtons      : true
                }).then((result) => {
                    if (result.value) {
                        $.ajax({
                            url         : "<?= base_url() ?>parent_parameter/simpan_data_parent_parameter",
                            method      : "POST",
                            beforeSend  : function () {
                                swal({
                                    title   : 'Menunggu',
                                    html    : 'Memproses Data',
                                    onOpen  : () => {
                                        swal.showLoading();
                                    }
                                })
                            },
                            data        : {aksi:'Hapus', id_parent_parameter:id_parent_parameter},
                            dataType    : "JSON",
                            success     : function (data) {

                                    tabel_list_parent_parameter.ajax.reload(null,false);   

                                    swal({
                                        title               : 'Hapus',
                                        text                : 'Data Berhasil Dihapus',
                                        buttonsStyling      : false,
                                        confirmButtonClass  : "btn btn-success",
                                        type                : 'success',
                                        showConfirmButton   : false,
                                        timer               : 3000
                                    }); 
                                    
                                    $('#form_parent_parameter').trigger("reset");

                                    $('#aksi').val('Tambah');

                                    nilai_sisa_bobot();
                            },
                            error       : function(xhr, status, error) {
                                var err = eval("(" + xhr.responseText + ")");
                                alert(err.Message);
                            }

                        })

                        return false;
                    } else if (result.dismiss === swal.DismissReason.cancel) {

                        swal({
                                title               : 'Batal',
                                text                : 'Anda membatalkan hapus parent parameter',
                                buttonsStyling      : false,
                                confirmButtonClass  : "btn btn-primary",
                                type                : 'error',
                                showConfirmButton   : false,
                                timer               : 3000
                            }); 
                    }
                })

            })
        
    })

</script>