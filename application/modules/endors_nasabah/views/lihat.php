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

<div class="row">

    <div class="col-md-12">
        <div class="card shadow ">
            <div class="card-body table-responsive">
                <table class="table table-bordered table-hover" style="border-collapse: collapse; border-spacing: 0; width: 100%;" id="tabel_endors_nasabah" width="100%" cellspacing="0">
                    <thead class="thead-light text-center">
                        <tr>
                            <th width="5%">No</th>
                            <th width="20%">Nama Nasabah</th>
                            <th width="20%">Endorsment</th>
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

</div>

<div class="modal fade" id="modal_ubah" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
        <div class="modal-header bg-primary text-white">
            <h5 class="modal-title mt-0 judul">Ubah Status</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true" class="text-white">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <div class="row p-3">
                <input type="hidden" id="id_tr_endorsment">
                <input type="hidden" id="id_endors_nasabah">
                <input type="hidden" id="id_nasabah">
                <div class="col-md-6">
                    <div class="form-group row">
                        <label for="no_reff_mop" class="col-md-4 col-form-label text-left">Endorsment</label>
                        <div class="col-md-8 mt-1">
                            <span id="t_endorsment">: </span>
                        </div>
                    </div>
                    <hr>
                </div>
                <div class="col-md-6"></div>
                <div class="col-md-6">
                    
                    <div class="form-group row">
                        <label for="no_reff_mop" class="col-md-4 col-form-label text-left">NIK</label>
                        <div class="col-md-8 mt-1">
                            <span id="t_nik">: </span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="no_reff_mop" class="col-md-4 col-form-label text-left">Nama Nasabah</label>
                        <div class="col-md-8 mt-1">
                            <span id="t_nama_nasabah">: </span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="no_reff_mop" class="col-md-4 col-form-label text-left">Tanggal Lahir</label>
                        <div class="col-md-8 mt-1">
                            <span id="t_tgl_lahir">: </span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="no_reff_mop" class="col-md-4 col-form-label text-left">Telp</label>
                        <div class="col-md-8 mt-1">
                            <span id="t_telp">: </span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="no_reff_mop" class="col-md-4 col-form-label text-left">Email</label>
                        <div class="col-md-8 mt-1">
                            <span id="t_email">: </span>
                        </div>
                    </div>

                </div>
                <div class="col-md-6">
                    
                    <div class="form-group row">
                        <label for="no_reff_mop" class="col-md-4 col-form-label text-left">Alamat Rumah</label>
                        <div class="col-md-8 mt-1">
                            <span id="t_alamat">: </span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="no_reff_mop" class="col-md-4 col-form-label text-left">Jenis Kelamin</label>
                        <div class="col-md-8 mt-1">
                            <span id="t_jenis_kelamin">: </span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="no_reff_mop" class="col-md-4 col-form-label text-left">Tempat Lahir</label>
                        <div class="col-md-8 mt-1">
                            <span id="t_tempat_lahir">: </span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="no_reff_mop" class="col-md-4 col-form-label text-left">Pekerjaan</label>
                        <div class="col-md-8 mt-1">
                            <span id="t_pekerjaan">: </span>
                        </div>
                    </div>

                </div>
                
                <div class="col-md-12"><hr></div>
                <div class="col-md-6">
                    <div class="form-group row">
                        <label for="no_reff_mop" class="col-md-4 col-form-label text-left">Status Endorsment</label>
                        <div class="col-md-8">
                            <select name="status_endors" id="status_endors" class="select2">
                                <option value="0">Pending</option>
                                <option value="1">Disetujui</option>
                                <option value="2">Ditolak</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row alasan_tolak" style="display: none;">
                        <label for="no_reff_mop" class="col-md-4 col-form-label text-left">Alasan Tolak</label>
                        <div class="col-md-8">
                            <textarea name="alasan_tolak" id="alasan_tolak" rows="5" class="form-control" placeholder="Masukkan Alasan Tolak"></textarea>
                        </div>
                    </div>
                </div>
                <div class="col-md-6"></div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-primary mr-2" id="simpan_status">Simpan</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
        </div>
    </div>
  </div>
</div>

<script>

    $(document).ready(function () {

        // menampilkan list endors_nasabah
        var tabel_list_endors_nasabah = $('#tabel_endors_nasabah').DataTable({
            "processing"        : true,
            "serverSide"        : true,
            "order"             : [],
            "ajax"              : {
                "url"   : "<?= base_url() ?>endors_nasabah/tampil_data_endors_nasabah",
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
                "targets"   : [0,4],
                "orderable" : false
            }, {
                'targets'   : [0,2,3,4],
                'className' : 'text-center',
            }]
        })

        // 14-09-2021
        $('#tabel_endors_nasabah').on('click', '.lihat', function () {

            var id_nasabah = $(this).data('id');

            window.location.href = "<?= base_url('endors_nasabah/list_endors/') ?>"+id_nasabah
            
        })

        $('#tabel_endors_nasabah').on('click', '.ubah', function () {

            var id_nasabah          = $(this).data('id');
            var nama_endorsment     = $(this).attr('nama_endorsment');
            var id_endors_nasabah   = $(this).attr('id_endors_nasabah');
            var status              = $(this).attr('status');
            var id_tr_endorsment    = $(this).attr('id_tr_endorsment');

            $.ajax({
                url     : "<?= base_url('endors_nasabah/get_endors_nasabah/') ?>",
                type    : "POST",
                data    : {id_endors_nasabah:id_endors_nasabah, id_tr_endorsment:id_tr_endorsment},
                dataType: "JSON",
                success : function (data) {

                    $('#id_tr_endorsment').val(id_tr_endorsment);
                    $('#id_endors_nasabah').val(id_endors_nasabah);
                    $('#id_nasabah').val(id_nasabah);
                    
                    $('#t_endorsment').text(": "+nama_endorsment);
                    $('#t_nik').text(": "+data.list.nik);
                    $('#t_nama_nasabah').text(": "+data.list.nama_nasabah);
                    $('#t_tgl_lahir').text(": "+data.tgl_lahir);
                    $('#t_telp').text(": "+data.list.telp);
                    $('#t_email').text(": "+data.list.email);

                    var jk = "";
                    if (data.list.jenis_kelamin == 't') {
                        jk = 'Laki-laki';
                    } else {
                        jk = 'Perempuan';
                    }

                    $('#t_alamat').text(": "+data.list.alamat_rumah);
                    $('#t_jenis_kelamin').text(": "+jk);
                    $('#t_tempat_lahir').text(": "+data.list.tempat_lahir);
                    $('#t_pekerjaan').text(": "+data.pekerjaan);

                    $('#status_endors').val(status).trigger('change');

                    if (status == 2) {
                        $('.alasan_tolak').fadeIn();
                        $('#alasan_tolak').val(data.endors.alasan_tolak);
                    } else {
                        $('.alasan_tolak').fadeOut();
                        $('#alasan_tolak').val('');
                    }

                    $('#modal_ubah').modal('show');
                    
                },
                error       : function(xhr, status, error) {

                    swal({
                        title               : 'Gagal',
                        text                : 'Gagal menampilkan data!',
                        buttonsStyling      : false,
                        confirmButtonClass  : "btn btn-success",
                        type                : 'error',
                        showConfirmButton   : false,
                        timer               : 3000
                    }); 

                    return false;

                }
            })
            
        })

        $('#status_endors').on('change', function () {

            var status_endors = $(this).val();

            if (status_endors == 2) {
                $('.alasan_tolak').slideDown('fast');
                $('#alasan_tolak').val('');
            } else {
                $('.alasan_tolak').slideUp('fast');
                $('#alasan_tolak').val('');
            }

        })

        $('#simpan_status').on('click', function () {

            var id_tr_endorsment    = $('#id_tr_endorsment').val();
            var id_endors_nasabah   = $('#id_endors_nasabah').val();
            var id_nasabah          = $('#id_nasabah').val();
            var status_endors       = $('#status_endors').val();
            var alasan_tolak        = $('#alasan_tolak').val();

            if (status_endors == 2) {
                if (alasan_tolak == '') {

                    swal({
                        title               : "Peringatan",
                        text                : 'Alasan Ditolak harus diisi!',
                        buttonsStyling      : false,
                        confirmButtonClass  : "btn btn-warning",
                        type                : 'warning',
                        showConfirmButton   : true,
                        allowOutsideClick   : false
                    });  
                    
                    return false;
                }
            }

            swal({
                title       : 'Konfirmasi',
                text        : 'Yakin akan ubah status endors?',
                type        : 'warning',

                buttonsStyling      : false,
                confirmButtonClass  : "btn btn-primary",
                cancelButtonClass   : "btn btn-secondary mr-3",

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

                        url         : "<?= base_url() ?>endors_nasabah/ubah_status_endors",
                        type        : "POST",
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
                        data        : {

                            id_tr_endorsment    : id_tr_endorsment, 
                            status_endors       : status_endors,
                            alasan_tolak        : alasan_tolak,
                            id_endors_nasabah   : id_endors_nasabah,
                            id_nasabah          : id_nasabah
                        
                        },
                        dataType    : "JSON",
                        success     : function (data) {

                            $('#modal_ubah').modal('hide');

                            swal({
                                title               : "Berhasil",
                                text                : 'Status endors berhasil diubah',
                                buttonsStyling      : false,
                                confirmButtonClass  : "btn btn-success",
                                type                : 'success',
                                showConfirmButton   : false,
                                timer               : 3000,
                                allowOutsideClick   : false
                            });    

            
                            tabel_list_endors_nasabah.ajax.reload(null,false);
                            
                        },
                        error       : function(xhr, status, error) {

                            swal({
                                title               : 'Gagal',
                                text                : 'Ubah status endors tidak berhasil',
                                buttonsStyling      : false,
                                confirmButtonClass  : "btn btn-success",
                                type                : 'error',
                                showConfirmButton   : false,
                                timer               : 3000
                            }); 
                            
                            return false;
                        }

                    })
                } else if (result.dismiss === swal.DismissReason.cancel) {

                    swal.close();

                }
                
            })

        })

        $('#batal_endors_nasabah').on('click', function () {
            reset_form();
        })

        function reset_form() {
            $('#aksi').val('Tambah');
            $('#form_endors_nasabah').trigger("reset");
            $('#form_endors_nasabah').parsley().reset();
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

        $('#form_endors_nasabah').on('submit', function () {

            var form_endors_nasabah = $('#form_endors_nasabah').serialize();

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
                            url     : "<?= base_url() ?>endors_nasabah/simpan_endors_nasabah",
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
                            data    : form_endors_nasabah,
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
                
                                tabel_list_endors_nasabah.ajax.reload(null,false);        
                                
                            }
                        })
                
                        return false;

                    } else if (result.dismiss === swal.DismissReason.cancel) {
                        swal.close();
                    }
                })

                return false;
            
        })

        $('#tabel_endors_nasabah').on('click', '.edit', function () {

            var id_endors_nasabah   = $(this).data('id');
            var endors_nasabah      = $(this).attr('endors_nasabah');
            var status            = $(this).attr('status');

            $('#aksi').val('Ubah');
            $('.judul').text('Ubah Data');
            $('#id_endors_nasabah').val(id_endors_nasabah);
            $('#endors_nasabah').val(endors_nasabah);      
            
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

        $('#tabel_endors_nasabah').on('click', '.hapus', function () {

            var id_endors_nasabah = $(this).data('id');

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
                            url         : "<?= base_url() ?>endors_nasabah/simpan_endors_nasabah",
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
                            data        : {aksi:'Hapus', id_endors_nasabah:id_endors_nasabah},
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
                
                                tabel_list_endors_nasabah.ajax.reload(null,false);
                                
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