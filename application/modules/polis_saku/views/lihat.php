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
    <input type="hidden" id="status_polis" value="0">
    <div class="col-md-12">

        <!-- <a href="<?= base_url('polis_saku/tambah_polis') ?>"><button type="button" class="btn btn-primary"><i class="fas fa-plus mr-2"></i>Tambah Data</button></a> -->

        <ul class="nav nav-tabs d-flex justify-content-center" role="tablist">
            <li class="nav-item">
            <a class="nav-link t_status_polis t_pending active" status="0" data-toggle="tab" href="#pending" role="tab">
                <span class="d-none d-md-block">PENDING</span><span class="d-block d-md-none"><i class="mdi mdi-home-variant h5"></i></span>
            </a>
            </li>
            <li class="nav-item">
            <a class="nav-link t_status_polis t_aktif" status="1" data-toggle="tab" href="#aktif" role="tab">
                <span class="d-none d-md-block">AKTIF</span><span class="d-block d-md-none"><i class="mdi mdi-home-variant h5"></i></span>
            </a>
            </li>
            <li class="nav-item">
            <a class="nav-link t_status_polis t_tidak_aktif" status="2" data-toggle="tab" href="#tidak_aktif" role="tab">
                <span class="d-none d-md-block">TIDAK AKTIF</span><span class="d-block d-md-none"><i class="mdi mdi-home-variant h5"></i></span>
            </a>
            </li>
        </ul>
    
        <div class="card shadow p-2">
            <div class="card-body table-responsive">
                <table class="table table-bordered table-hover" style="border-collapse: collapse; border-spacing: 0; width: 100%;" id="tabel_polis_saku" width="100%" cellspacing="0">
                    <thead class="thead-light text-center">
                        <tr>
                            <th width="5%">No</th>
                            <th width="20%">No Polis</th>
                            <th width="20%">Nasabah</th>
                            <th width="20%">Tanggal Awal Polis</th>
                            <th width="20%">Tanggal Akhir Polis</th>
                            <th width="20%">Premi</th>
                            <th width="10%">Metode</th>
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

<script>

    $(document).ready(function () {

        // menampilkan list polis_saku
        var tabel_list_polis_saku = $('#tabel_polis_saku').DataTable({
            "processing"        : true,
            "serverSide"        : true,
            "order"             : [],
            "ajax"              : {
                "url"   : "<?= base_url() ?>polis_saku/tampil_data_polis_saku",
                "type"  : "POST",
                "data"  : function (data) {
                    data.read               = "<?= $role['read'] ?>";
                    data.create             = "<?= $role['create'] ?>";
                    data.update             = "<?= $role['update'] ?>";
                    data.delete             = "<?= $role['delete'] ?>";
                    data.id_user            = "<?= $id_user ?>";
                    data.id_lvl_otorisasi   = "<?= $id_lvl_otorisasi ?>";
                    data.status_polis       = $('#status_polis').val();
                }
            },
            "columnDefs"        : [{
                "targets"   : [0,7],
                "orderable" : false
            }, {
                'targets'   : [0,1,3,4,5,6,7],
                'className' : 'text-center',
            },
            { 
                "width": "20%", "targets": [1]
            },
            { 
                "width": "14%", "targets": [3,4]
            },
            { 
                "width": "10%", "targets": [5,6]
            },
            { 
                "width": "10%", "targets": [7]
            },
            ],
            "autoWidth"     : false
            
        })

        $('.t_status_polis').on('click', function () {

            var status = $(this).attr('status');

            $('#status_polis').val(status);
            
            tabel_list_polis_saku.ajax.reload(null, false);
        })

        // 10-09-2021
        $('#tabel_polis_saku').on('click', '.detail', function () {
            
            var id_sppa = $(this).data('id');

            $.ajax({
                type    :"GET",
                url     :"<?php echo base_url(); ?>list_transaksi/detail/"+id_sppa,
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
                dataType : "HTML",
                success  : function (data) {

                    swal.close();
                    $('.isi_detail').html(data);
                    $('#modal_detail').modal('show');

                }
            });

            return false;
            
        })


        function reset_form() {
            $('#aksi').val('Tambah');
            $('#form_polis_saku').trigger("reset");
            $('#form_polis_saku').parsley().reset();
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

        $('#form_polis_saku').on('submit', function () {

            var form_polis_saku = $('#form_polis_saku').serialize();

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
                            url     : "<?= base_url() ?>list_transaksi/simpan_polis_saku",
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
                            data    : form_polis_saku,
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
                
                                tabel_list_polis_saku.ajax.reload(null,false);        
                                
                            }
                        })
                
                        return false;

                    } else if (result.dismiss === swal.DismissReason.cancel) {
                        swal.close();
                    }
                })

                return false;
            
        })

        $('#tabel_polis_saku').on('click', '.edit', function () {

            var id_polis_saku   = $(this).data('id');
            var polis_saku      = $(this).attr('polis_saku');
            var status            = $(this).attr('status');

            $('#aksi').val('Ubah');
            $('.judul').text('Ubah Data');
            $('#id_polis_saku').val(id_polis_saku);
            $('#polis_saku').val(polis_saku);      
            
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

        $('#tabel_polis_saku').on('click', '.hapus', function () {

            var id_polis_saku = $(this).data('id');

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
                            url         : "<?= base_url() ?>list_transaksi/simpan_polis_saku",
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
                            data        : {aksi:'Hapus', id_polis_saku:id_polis_saku},
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
                
                                tabel_list_polis_saku.ajax.reload(null,false);
                                
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