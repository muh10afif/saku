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
<style>
     .btn-toggle {
        margin: 0 4rem;
        padding: 0;
        position: relative;
        border: none;
        height: 1.5rem;
        width: 3rem;
        border-radius: 1.5rem;
        color: #354558;
        background: #006c45;
    }
    .btn-toggle:focus, .btn-toggle:focus.active, .btn-toggle.focus, .btn-toggle.focus.active {
        outline: none;
        
    }
    .btn-toggle:before, .btn-toggle:after {
        line-height: 1.5rem;
        width: 6rem;
        text-align: center;
        font-weight: 600;
        font-size: .75rem;
        text-transform: uppercase;
        letter-spacing: 2px;
        position: absolute;
        bottom: 0;
        transition: opacity .25s;
    }
    .btn-toggle:before {
        content: 'KK';
        left: -5rem;
    }
    .btn-toggle:after {
        content: 'NON KK';
        right: -7rem;
        opacity: .5;
    }
    .btn-toggle > .handle {
        position: absolute;
        top: 0.1875rem;
        left: 0.1875rem;
        width: 1.125rem;
        height: 1.125rem;
        border-radius: 1.125rem;
        background: #fff;
        transition: left .25s;
    }
    .btn-toggle.active {
        transition: background-color .25s;
    }
    .btn-toggle.active {
        background-color: #fc5454;
    }
    .btn-toggle.active > .handle {
        left: 1.6875rem;
        transition: left .25s;
    }
    .btn-toggle.active:before {
        opacity: .5;
    }
    .btn-toggle.active:after {
        opacity: 1;
    }
</style>
<div class="page-title-box">
    <div class="row align-items-center">
        <div class="col-sm-6">
            <h4><?= $title ?></h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-right">
                <li class="breadcrumb-item"><a href="<?= base_url() ?>">All COB</a></li>
                <li class="breadcrumb-item">Master Data</li>
                <li class="breadcrumb-item active"><?= $title ?></li>
            </ol>
        </div>
    </div>
</div>
<input type="hidden" id="status_toggle">

<div class="row">

    <div class="col-md-7">
        <div class="card shadow ">
            <div class="card-body table-responsive">
                <table class="table table-bordered table-hover" style="border-collapse: collapse; border-spacing: 0; width: 100%;" id="tabel_hubungan_klg" width="100%" cellspacing="0">
                    <thead class="thead-light text-center">
                        <tr>
                            <th width="5%">No</th>
                            <th width="20%">Hubungan Keluarga</th>
                            <th width="20%">Status</th>
                            <th width="10%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                            
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="col-md-5">
        <div class="card shadow">
            <div class="card-header">
                <h5 class="mb-0 judul">Tambah Data</h5>
            </div>
            <form id="form_hubungan_klg" autocomplete="off">
                <input type="hidden" name="id_hubungan_klg" id="id_hubungan_klg">
                <input type="hidden" name="aksi" id="aksi" value="Tambah">
                <div class="card-body d-flex justify-content-center">
                    <div class="col-md-12">
                        
                        <div class="form-group">
                            <label for="nama" class="col-form-label text-left">Hubungan Keluarga<span class="text-danger">*</span></label>
                            <div class="">
                                <input type="text" class="form-control" id="hubungan_klg" name="hubungan_klg" placeholder="Masukkan Nama" required data-parsley-required-message="Hubungan keluarga harus terisi.">
                            </div>
                        </div>  
                        <div class="form-group">

                            <button type="button" class="btn btn-toggle st_status mt-3" data-toggle="button" aria-pressed="false" autocomplete="off" value="kk">
                            <div class="handle"></div>
                            </button>

                        </div>

                        <input type="hidden" id="val_status" name="status" value="kk">
                        <p class="font-italic text-danger mt-3">(*) Data harus terisi.</p>
                        <hr>
                        <div class="form-group text-center mt-1 mb-0">
                            <?php if ($role['create'] == 'true' || $id_lvl_otorisasi == 0) : ?>
                                <button type="submit" class="btn btn-primary mt-1 mr-3"><i class="fas fa-check mr-1"></i> Simpan</button>
                            <?php endif; ?>

                            <button type="button" class="btn btn-danger mt-1 batal_hubungan_klg" id="batal_hubungan_klg"><i class="fas fa-times mr-1"></i> Batal</button>
                        </div>   
                        
                    </div>

                </div>
            </form>
        </div>
    </div>
</div>

<script>

    $(document).ready(function () {

        // menampilkan list hubungan_klg
        var tabel_list_hubungan_klg = $('#tabel_hubungan_klg').DataTable({
            "processing"        : true,
            "serverSide"        : true,
            "order"             : [],
            "ajax"              : {
                "url"   : "<?= base_url() ?>Hubungan_klg/tampil_data_hubungan_klg",
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
                'targets'   : [0,2,3],
                'className' : 'text-center',
            }]
        })
        
        // 30-08-2021
        $('#form_hubungan_klg').parsley({
            errorsContainer: function(el) {
                return el.$element.closest('.form2');
            }
        });

        $('.st_status').on('click', function () {

            if($(this).attr('value') == "non kk") {
                $(this).attr('value', "kk");
                $('#val_status').val("kk");
            } else if ($(this).attr('value') == "kk") {
                $(this).attr('value', "non kk");
                $('#val_status').val("non kk");
            }

        })

        $('#batal_hubungan_klg').on('click', function () {
            reset_form();
        })

        function reset_form() {
            $('#aksi').val('Tambah');
            $('#form_hubungan_klg').trigger("reset");
            $('#form_hubungan_klg').parsley().reset();
            $('.judul').text('Tambah Data');

            $('.st_status').attr('aria-pressed', 'false');
            $('.st_status').attr('value', 'kk');
            $('.st_status').removeClass('active');

            animasi_keatas();
        }

        function animasi_keatas() {
            $('html, body').animate({
                scrollTop: $('body').offset().top
            }, 800);
        }

        $('#form_hubungan_klg').on('submit', function () {

            var form_hubungan_klg = $('#form_hubungan_klg').serialize();

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
                    reverseButtons      : true,

                    allowOutsideClick   : false
                }).then((result) => {
                    if (result.value) {
                        $.ajax({
                            url     : "<?= base_url() ?>Hubungan_klg/simpan_hubungan_klg",
                            type    : "POST",
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
                            data    : form_hubungan_klg,
                            dataType: "JSON",
                            success : function (data) {

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

                                reset_form();
                
                                tabel_list_hubungan_klg.ajax.reload(null,false);        
                                
                            }
                        })
                
                        return false;

                    } else if (result.dismiss === swal.DismissReason.cancel) {
                        swal.close();
                    }
                })

                return false;
            
        })

        $('#tabel_hubungan_klg').on('click', '.edit', function () {

            var id_hubungan_klg   = $(this).data('id');
            var hubungan_klg      = $(this).attr('hubungan_klg');
            var status            = $(this).attr('status');

            $('#aksi').val('Ubah');
            $('.judul').text('Ubah Data');
            $('#id_hubungan_klg').val(id_hubungan_klg);
            $('#hubungan_klg').val(hubungan_klg);      
            
            if (status == 'kk') {
                $('.st_status').attr('aria-pressed', 'false');
                $('.st_status').attr('value', 'kk');
                $('.st_status').removeClass('active');
            } else {
                $('.st_status').attr('aria-pressed', 'true');
                $('.st_status').attr('value', 'non kk');
                $('.st_status').addClass('active');
            }

            animasi_keatas();
            
        })

        $('#tabel_hubungan_klg').on('click', '.hapus', function () {

            var id_hubungan_klg = $(this).data('id');

            swal({
                    title       : 'Konfirmasi',
                    text        : 'Yakin akan hapus data?',
                    type        : 'warning',

                    buttonsStyling      : false,
                    confirmButtonClass  : "btn btn-danger",
                    cancelButtonClass   : "btn btn-primary mr-3",

                    showCancelButton    : true,
                    confirmButtonText   : 'Hapus',
                    confirmButtonColor  : '#d33',
                    cancelButtonColor   : '#3085d6',
                    cancelButtonText    : 'Batal',
                    reverseButtons      : true,

                    allowOutsideClick   : false
                }).then((result) => {
                    if (result.value) {
                        $.ajax({
                            url         : "<?= base_url() ?>Hubungan_klg/simpan_hubungan_klg",
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
                            data        : {aksi:'Hapus', id_hubungan_klg:id_hubungan_klg},
                            dataType    : "JSON",
                            success     : function (data) {

                                swal({
                                    title               : "Berhasil",
                                    text                : 'Data berhasil dihapus',
                                    buttonsStyling      : false,
                                    confirmButtonClass  : "btn btn-success",
                                    type                : 'success',
                                    showConfirmButton   : false,
                                    timer               : 3000,
                                    allowOutsideClick   : false
                                });    

                                reset_form();
                
                                tabel_list_hubungan_klg.ajax.reload(null,false);
                                
                            },
                            error       : function(xhr, status, error) {

                                swal({
                                    title               : 'Gagal',
                                    text                : 'Hapus data tidak berhasil',
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
            
        })

    })
    
</script>