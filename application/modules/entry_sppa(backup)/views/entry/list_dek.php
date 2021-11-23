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
        animation: slide-down 0.4s ease-out;
    }
    @keyframes slide-down {
        0% { opacity: 0; transform: translateY(100%); }
        100% { opacity: 1; transform: translateY(0); }
    }
</style>
<!-- Page-Title -->
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

<input type="hidden" id="status_toggle" class="status_toggle">
<div class="row">

    <div class="col-md-12 f_tambah" style="display: none;">

        <div class="card shadow">
            <div class="card-header mb-0">
                <button class="btn btn-light float-right batal_entry_sppa"><i class="mdi mdi-close mdi-18px"></i></button>
                <h5 id="judul" class="mb-0 mt-1">Detail</h5>
            </div>
            <div class="card-body table-responsive">

                <div class="row mb-2">
                    <div class="col-md-12 text-center">
                        <h5>SPPA Number : <samp><mark id="sppa_number"> </mark></samp></h5>
                    </div>
                </div>

                <div class="row f_tab_detail" style="display: none;">
        
                </div>

            </div>
        </div>
    </div>

    <div class="col-md-12">

        <div class="card shadow">
            <div class="card-header mb-0">
                <div class="row">
                    <div class="col-md-12">
                        <a href="<?= base_url() ?>entry_sppa"><button class="btn btn-primary float-right"><i class="fas fa-arrow-left mr-2"></i>Kembali</button></a>
                    </div>
                </div>
            </div>
            <div class="card-body">

                <table class="mt-3 table table-bordered table-hover dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;" id="tabel_list_dek" width="100%" cellspacing="0">
                    <thead class="thead-light text-center">
                        <tr>
                            <th width="5%">No</th>
                            <th>SPPA Number</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
                
            </div>
        </div>
        
    </div>
    
</div>

<script>

    $(document).ready(function () {
        
        // 01-07-2021 
        var tabel_list_dek = $('#tabel_list_dek').DataTable({
            "processing"        : true,
            "order"             : [],
            "ajax"              : {
                "url"   : "<?= base_url() ?>entry_sppa/tampil_list_dek",
                "type"  : "POST",
                "data"  : function (data) {
                    data.id_mop  = "<?= $id_mop ?>";
                },
            },
            "columnDefs"        : [{
                "targets"   : [0,2],
                "orderable" : false
            }, {
                'targets'   : [0,2],
                'className' : 'text-center',
            }]
        })

        // 19-05-2021
        $('#tabel_list_dek').on('click', '.detail', function () {

            var id_sppa     = $(this).data('id');
            var sppa_number = $(this).attr('sppa_number');

            $('.f_tab').slideUp();

            $.ajax({
                url     : "<?= base_url('entry_sppa/tampil_detail_sppa_dek') ?>",
                method  : "POST",
                data    : {id_sppa:id_sppa, jenis:'entry'},
                success : function (data) {

                    var sts = $('#status_toggle').val();

                    $('html, body').animate({
                        scrollTop: $('body').offset().top
                    }, 800);

                    // if (sts == 0) {
                    //     $('.f_tambah').slideToggle('fast', function() {
                    //         if ($(this).is(':visible')) {
                    //             $('#status_toggle').val(1);          
                    //         } else {  
                    //             $('#status_toggle').val(0);            
                    //         }        
                    //     });  
                    // }

                    $('.f_tambah').slideDown();
                    $('.f_tab_detail').html(data);
                    $('.f_tab_detail').slideDown();

                    $('#sppa_number').text(sppa_number);

                    $('#judul').text('Detail SPPA');

                },
                error: function (jqXHR, textStatus, errorThrown)
                {
                    swal({
                        title               : "Gagal",
                        text                : 'Gagal Menampilkan Data',
                        type                : 'error',
                        showConfirmButton   : false,
                        timer               : 3000,
                                allowOutsideClick   : false
                    }); 

                    return false;
                }
            })

        })

        // 01-07-2021
        $('.batal_entry_sppa').on('click', function () {

            $('.f_tambah').slideUp();
            $('.f_tab_detail').html('');
            $('.f_tab_detail').slideUp();

        })

        // 01-07-2021
        // 10-05-2021
    $('#simpan_dok').on('click', function () {

        var form_data = new FormData($('#form_dokumen')[0]);

        $.ajax({
            url: '<?= base_url("entry_sppa/simpan_dokumen") ?>',
            dataType: 'json',
            cache: false,
            contentType: false,
            processData: false,
            data: form_data,
            type: 'post',
            success: function(data){
              tabel_dok.ajax.reload(null, false);

              $('#doc').val('');
              $('#desc').val('');
              
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                swal({
                    title               : "Gagal",
                    text                : 'Gagal simpan data',
                    type                : 'error',
                    showConfirmButton   : false,
                    timer               : 3000,
                                allowOutsideClick   : false
                }); 

                return false;
            }
        });

    })

    // menampilkan tabel dok
    var tabel_dok = $('#tabel_dok').DataTable({
        "processing"        : true,
        "order"             : [],
        "ajax"              : {
            "url"   : "<?= base_url() ?>entry_sppa/tampil_data_dokumen",
            "type"  : "POST",
            "data"  : function (data) {
                data.sppa_number    = $('.sppa_number').val();
            },
        },
        "columnDefs"        : [{
            "targets"   : [0,5],
            "orderable" : false
        }, {
            'targets'   : [0,4,5],
            'className' : 'text-center',
        }],
        "bDestroy" : true
    })

    $('#tabel_dok').on('click', '.edit', function () {

      var id_dokumen  = $(this).data('id');
      var desc        = $(this).attr('desc');
      var filename    = $(this).attr('filename');

      $('#id_dokumen').val(id_dokumen);
      $('#nama_dokumen').val(filename);
      $('#desc').val(desc);

      $('#aksi').val('Ubah');

    })

      // hapus dokumen
    $('#tabel_dok').on('click', '.hapus', function () {
          
        var id_dokumen  = $(this).data('id');
        var filename    = $(this).attr('filename');

        swal({
            title       : 'Konfirmasi',
            text        : 'Yakin akan hapus dokumen ?',
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
                    url         : "<?= base_url() ?>entry_sppa/simpan_dokumen",
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
                    data        : {aksi:'Hapus', id_dokumen:id_dokumen, nama_dokumen:filename},
                    dataType    : "JSON",
                    success     : function (data) {

                          tabel_dok.ajax.reload(null,false);   

                            swal({
                                title               : 'Hapus dokumen',
                                text                : 'Data Berhasil Dihapus',
                                buttonsStyling      : false,
                                confirmButtonClass  : "btn btn-success",
                                type                : 'success',
                                showConfirmButton   : false,
                                timer               : 3000,
                                allowOutsideClick   : false
                            }); 
                            
                            $('#form_dokumen').trigger("reset");

                            $('#aksi').val('Tambah');
                        
                    },
                    error: function (jqXHR, textStatus, errorThrown)
                    {
                        swal({
                            title               : "Gagal",
                            text                : 'Gagal proses data',
                            type                : 'error',
                            showConfirmButton   : false,
                            timer               : 3000,
                                allowOutsideClick   : false
                        }); 

                        return false;
                    }

                })

                return false;
            } else if (result.dismiss === swal.DismissReason.cancel) {

                swal({
                        title               : 'Batal',
                        text                : 'Anda membatalkan hapus dokumen',
                        buttonsStyling      : false,
                        confirmButtonClass  : "btn btn-primary",
                        type                : 'error',
                        showConfirmButton   : false,
                        timer               : 3000,
                                allowOutsideClick   : false
                    }); 
            }
        })

    })
        
    })
    
</script>