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

    .nav-pills .nav-link.active, .nav-pills .show > .nav-link {
        color: #fff;
        background-color: #02a4af;
    }

    a {
        color: #02a4af;
    }
    
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
        <div class="col-sm-6">
            <h4><?= $title ?></h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-right">
                <li class="breadcrumb-item"><a href="<?= base_url() ?>">All COB</a></li>
                <li class="breadcrumb-item">Transaction</li>
                <li class="breadcrumb-item">Incoming</li>
                <li class="breadcrumb-item active"><?= $title ?></li>
            </ol>
        </div>
    </div>
</div>
<input type="hidden" id="status_toggle">

<div class="row">

    <div class="col-md-12">
        <input type="hidden" id="tab_status_klaim" value="0">

        <ul class="nav nav-tabs d-flex justify-content-center" role="tablist">
            <li class="nav-item">
                <a class="nav-link t_status_klaim active" status="0" data-toggle="tab" href="#pending" role="tab">
                    <span class="d-none d-md-block">DIAJUKAN</span><span class="d-block d-md-none"><i class="mdi mdi-home-variant h5"></i></span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link t_status_klaim" status="1" data-toggle="tab" href="#aktif" role="tab">
                    <span class="d-none d-md-block">DISETUJUI</span><span class="d-block d-md-none"><i class="mdi mdi-home-variant h5"></i></span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link t_status_klaim" status="2" data-toggle="tab" href="#tidak_aktif" role="tab">
                    <span class="d-none d-md-block">DICAIRKAN</span><span class="d-block d-md-none"><i class="mdi mdi-home-variant h5"></i></span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link t_status_klaim" status="3" data-toggle="tab" href="#tidak_aktif" role="tab">
                    <span class="d-none d-md-block">DITOLAK</span><span class="d-block d-md-none"><i class="mdi mdi-home-variant h5"></i></span>
                </a>
            </li>
        </ul>
    
        <div class="card shadow ">
            <div class="card-body table-responsive">
                <table class="table table-bordered table-hover" style="border-collapse: collapse; border-spacing: 0; width: 100%;" id="tabel_list_klaim" width="100%" cellspacing="0">
                    <thead class="thead-light text-center">
                        <tr>
                            <th width="5%">No</th>
                            <th width="20%">No Polis</th>
                            <th width="20%">Nama Nasabah</th>
                            <th width="20%">Manfaat</th>
                            <th width="20%">Nama Pemohon</th>
                            <th width="10%">Status Klaim</th>
                            <th width="10%">Add Time</th>
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

<div class="modal fade" id="modal_detail" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
    <div class="modal-content">
        <div class="modal-header bg-primary text-white">
            <h5 class="modal-title mt-0">Detail Transaksi</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true" class="text-white">&times;</span>
            </button>
        </div>
        <div class="modal-body isi_detail">
            
        </div>
    </div>
  </div>
</div>

<div class="modal fade" id="modal_status" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
        <div class="modal-header bg-primary text-white">
            <h5 class="modal-title mt-0">Ubah Status Klaim</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true" class="text-white">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <div class="row p-3">
                <input type="hidden" id="id_data_klaim">
                <input type="hidden" id="nilai_ptg">
                <div class="col-md-12">
                    <div class="form-group row">
                        <label for="no_reff_mop" class="col-md-4 col-form-label text-left">No Polis</label>
                        <div class="col-md-8 mt-1">
                            <span id="t_no_polis">: </span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="no_reff_mop" class="col-md-4 col-form-label text-left">Nama Nasabah</label>
                        <div class="col-md-8 mt-1">
                            <span id="t_nama_nasabah">: </span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="no_reff_mop" class="col-md-4 col-form-label text-left">Status Klaim</label>
                        <div class="col-md-8">
                            <select name="status_klaim" id="status_klaim" class="select2">
                                <option value="0">Diajukan</option>
                                <option value="1">Disetujui</option>
                                <option value="2">Dicairkan</option>
                                <option value="3">Ditolak</option>
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

        // menampilkan list list_klaim
        var tabel_list_klaim = $('#tabel_list_klaim').DataTable({
            "processing"        : true,
            "serverSide"        : true,
            "order"             : [],
            "ajax"              : {
                "url"   : "<?= base_url() ?>list_klaim/tampil_data_list_klaim",
                "type"  : "POST",
                "data"  : function (data) {
                    data.read               = "<?= $role['read'] ?>";
                    data.create             = "<?= $role['create'] ?>";
                    data.update             = "<?= $role['update'] ?>";
                    data.delete             = "<?= $role['delete'] ?>";
                    data.id_user            = "<?= $id_user ?>";
                    data.id_lvl_otorisasi   = "<?= $id_lvl_otorisasi ?>";
                    data.status_klaim       = $('#tab_status_klaim').val();
                }
            },
            "columnDefs"        : [{
                "targets"   : [0,7],
                "orderable" : false
            }, {
                'targets'   : [0,5,6,7],
                'className' : 'text-center',
            },
            { 
                "width": "5%", "targets": 1
            },
            { 
                "width": "10%", "targets": [2,3,4,5,6,7]
            },
            ],
            "autoWidth"     : false
            
        })

        $('.t_status_klaim').on('click', function () {

            var status = $(this).attr('status');

            $('#tab_status_klaim').val(status);

            tabel_list_klaim.ajax.reload(null, false);
        })

        // 10-09-2021
        $('#tabel_list_klaim').on('click', '.detail', function () {
            
            var id_sppa = $(this).data('id');

            window.location.href = "<?= base_url('list_klaim/detail/') ?>"+id_sppa;

            // $.ajax({
            //     type    :"GET",
            //     url     :"<?php echo base_url(); ?>list_klaim/detail/"+id_sppa,
            //     beforeSend : function () {
            //         swal({
            //         title  : 'Menunggu',
            //         html   : 'Memproses Data',
            //         onOpen : () => {
            //             swal.showLoading();
            //         },
            //         allowOutsideClick   : false
            //         })
            //     },
            //     dataType : "HTML",
            //     success  : function (data) {

            //         swal.close();
            //         $('.isi_detail').html(data);
            //         $('#modal_detail').modal('show');

            //     }
            // });

            // return false;
            
        })


        function reset_form() {
            $('#aksi').val('Tambah');
            $('#form_list_klaim').trigger("reset");
            $('#form_list_klaim').parsley().reset();
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

        $('#form_list_klaim').on('submit', function () {

            var form_list_klaim = $('#form_list_klaim').serialize();

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
                            url     : "<?= base_url() ?>list_klaim/simpan_list_klaim",
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
                            data    : form_list_klaim,
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
                
                                tabel_list_klaim.ajax.reload(null,false);        
                                
                            }
                        })
                
                        return false;

                    } else if (result.dismiss === swal.DismissReason.cancel) {
                        swal.close();
                    }
                })

                return false;
            
        })

        $('#status_klaim').on('change', function () {

            var status_klaim = $(this).val();
            
            if (status_klaim == 3) {
                $('.alasan_tolak').slideDown('fast');
                $('#alasan_tolak').val('');
            } else {
                $('.alasan_tolak').slideUp('fast');
                $('#alasan_tolak').val('');
            }
            
        })

        $('#simpan_status').on('click', function () {

            var id_data_klaim   = $('#id_data_klaim').val();
            var status_klaim    = $('#status_klaim').val();
            var alasan_tolak    = $('#alasan_tolak').val();
            var nilai_ptg       = $('#nilai_ptg').val();

            if (status_klaim == 3) {
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
                    text        : 'Yakin akan ubah status klaim?',
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

                            url         : "<?= base_url() ?>list_klaim/ubah_status_klaim",
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
                                status_klaim    : status_klaim, 
                                id_data_klaim   : id_data_klaim,
                                alasan_tolak    : alasan_tolak,
                                nilai_ptg       : nilai_ptg
                            
                            },
                            dataType    : "JSON",
                            success     : function (data) {

                                $('#modal_status').modal('hide');

                                swal({
                                    title               : "Berhasil",
                                    text                : 'Status klaim berhasil diubah',
                                    buttonsStyling      : false,
                                    confirmButtonClass  : "btn btn-success",
                                    type                : 'success',
                                    showConfirmButton   : false,
                                    timer               : 3000,
                                    allowOutsideClick   : false
                                });    

                
                                tabel_list_klaim.ajax.reload(null,false);
                                
                            },
                            error       : function(xhr, status, error) {

                                swal({
                                    title               : 'Gagal',
                                    text                : 'Ubah status klaim tidak berhasil',
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

        $('#tabel_list_klaim').on('click', '.edit', function () {

            var id_data_klaim   = $(this).attr('id_data_klaim');
            var no_polis        = $(this).attr('no_polis');
            var nama_nasabah    = $(this).attr('nama_nasabah');
            var status_klaim    = $(this).attr('status_klaim');
            var alasan_tolak    = $(this).attr('alasan_tolak');
            var nilai_ptg       = $(this).attr('nilai_ptg');

            // $('#aksi').val('Ubah');
            // $('.judul').text('Ubah Data');
            // $('#id_list_klaim').val(id_list_klaim);
            // $('#list_klaim').val(list_klaim);      

            $('#id_data_klaim').val(id_data_klaim);
            $('#nilai_ptg').val(nilai_ptg);
            $('#t_no_polis').text(": "+no_polis);
            $('#t_nama_nasabah').text(": "+nama_nasabah);
            $('#status_klaim').val(status_klaim).trigger('change');
           
            if (status_klaim == 3) {
                $('.alasan_tolak').fadeIn();
                $('#alasan_tolak').val(alasan_tolak);
            } else {
                $('.alasan_tolak').fadeOut();
                $('#alasan_tolak').val('');
            }

            $('#modal_status').modal('show');
        
            
        })

        $('#tabel_list_klaim').on('click', '.hapus', function () {

            var id_list_klaim = $(this).data('id');

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
                            url         : "<?= base_url() ?>list_klaim/simpan_list_klaim",
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
                            data        : {aksi:'Hapus', id_list_klaim:id_list_klaim},
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
                
                                tabel_list_klaim.ajax.reload(null,false);
                                
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