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
    
        <div class="card shadow p-2">
            <div class="card-body table-responsive">
                <table class="table table-bordered table-hover" style="border-collapse: collapse; border-spacing: 0; width: 100%;" id="tabel_ahli_waris" width="100%" cellspacing="0">
                    <thead class="thead-light text-center">
                        <tr>
                            <th width="5%">No</th>
                            <th width="20%">No Polis</th>
                            <th width="20%">NIK</th>
                            <th width="20%">Nasabah</th>
                            <th width="20%">Telp</th>
                            <th width="20%">Status Polis</th>
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

        // menampilkan list ahli_waris
        var tabel_list_ahli_waris = $('#tabel_ahli_waris').DataTable({
            "processing"        : true,
            "serverSide"        : true,
            "order"             : [],
            "ajax"              : {
                "url"   : "<?= base_url() ?>ahli_waris/tampil_data_ahli_waris",
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
                "targets"   : [0,6],
                "orderable" : false
            }, {
                'targets'   : [0,5,6],
                'className' : 'text-center',
            },
            { 
                "width": "10%", "targets": [2,3,4,5]
            },
            { 
                "width": "8%", "targets": [6]
            }
            ],
            "autoWidth"     : false
            
        })

        $('.t_status_polis').on('click', function () {

            var status = $(this).attr('status');

            $('#status_polis').val(status);
            
            tabel_list_ahli_waris.ajax.reload(null, false);
        })

        // 10-09-2021
        $('#tabel_ahli_waris').on('click', '.detail', function () {
            
            var id_sppa = $(this).data('id');

            $.ajax({
                type    :"GET",
                url     :"<?php echo base_url(); ?>ahli_waris/detail/"+id_sppa,
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
            $('#form_ahli_waris').trigger("reset");
            $('#form_ahli_waris').parsley().reset();
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

        $('#form_ahli_waris').on('submit', function () {

            var form_ahli_waris = $('#form_ahli_waris').serialize();

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
                            url     : "<?= base_url() ?>List_transaksi/simpan_ahli_waris",
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
                            data    : form_ahli_waris,
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
                
                                tabel_list_ahli_waris.ajax.reload(null,false);        
                                
                            }
                        })
                
                        return false;

                    } else if (result.dismiss === swal.DismissReason.cancel) {
                        swal.close();
                    }
                })

                return false;
            
        })

        $('#tabel_ahli_waris').on('click', '.edit', function () {

            var id_ahli_waris   = $(this).data('id');
            var ahli_waris      = $(this).attr('ahli_waris');
            var status            = $(this).attr('status');

            $('#aksi').val('Ubah');
            $('.judul').text('Ubah Data');
            $('#id_ahli_waris').val(id_ahli_waris);
            $('#ahli_waris').val(ahli_waris);      
            
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

        $('#tabel_ahli_waris').on('click', '.hapus', function () {

            var id_ahli_waris = $(this).data('id');

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
                            url         : "<?= base_url() ?>List_transaksi/simpan_ahli_waris",
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
                            data        : {aksi:'Hapus', id_ahli_waris:id_ahli_waris},
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
                
                                tabel_list_ahli_waris.ajax.reload(null,false);
                                
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