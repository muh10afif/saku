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

<input type="hidden" id="status_toggle">
<div class="row">
    <?php $this->load->view('input'); ?>
    <div class="col-md-12">
        <!-- <div class="card shadow"> -->
            <!-- <div class="card-header">
                <button class="btn btn-primary float-right" id="tambah_approval"><i class="ti-plus mr-2"></i> Tambah Data</button>
                <h5 id="judul" class="mb-0 mt-1"></h5>
            </div> -->
                <ul class="nav nav-tabs d-flex justify-content-center" role="tablist">
                  <li class="nav-item">
                    <a class="nav-link t_non_dek <?= ($aksi == 'non') ? 'active' : '' ?>" data-toggle="tab" href="#non_dek" role="tab">
                      <span class="d-none d-md-block">NON DEKLARASI</span><span class="d-block d-md-none"><i class="mdi mdi-home-variant h5"></i></span>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link t_dek <?= ($aksi == 'dekl') ? 'active' : '' ?>" data-toggle="tab" href="#dek" role="tab">
                      <span class="d-none d-md-block">DEKLARASI</span><span class="d-block d-md-none"><i class="mdi mdi-home-variant h5"></i></span>
                    </a>
                  </li>
                </ul>

                <!-- <div class="card-body"> -->

                <div class="card shadow">

                    <div class="tab-content">
                        <div class="tab-pane <?= ($aksi == 'non') ? 'active' : '' ?> p-4" id="non_dek" role="tabpanel">

                            <table class="table table-bordered table-hover dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;" id="tabel_binding" width="100%" cellspacing="0">
                                <thead class="thead-light text-center">
                                    <tr>
                                        <th width="5%">No</th>
                                        <th>No SPPA</th>
                                        <th>Client [SOB - CDB]</th>
                                        <th>COB - LOB</th>
                                        <th>Endorsment</th>
                                        <th>Status</th>
                                        <th width="10%">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
                            
                        </div>
                        <div class="tab-pane <?= ($aksi == 'dekl') ? 'active' : '' ?> p-3" id="dek" role="tabpanel">

                            <table class="table table-bordered table-hover dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;" id="tabel_binding_dek" width="100%" cellspacing="0">
                                <thead class="thead-light text-center">
                                    <tr>
                                        <th width="5%">No</th>
                                        <th>No Polis Induk</th>
                                        <th>Nomor MOP</th>
                                        <th>Nama MOP</th>
                                        <th>Insured</th>
                                        <th>Jumlah Endors</th>
                                        <th>Jumlah SPPA Aktif</th>
                                        <th width="10%">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
                            
                        </div>
                    </div>
                    
                </div>
            <!-- </div> -->
        <!-- </div> -->
    </div>
</div>

<input type="hidden" class="id_sppa" id="id_sppa">
<input type="hidden" id="id_mop_list">

<script>

    $(document).ready(function () {

        // 28-06-2021
        $('.t_non_dek').on('click', function () {

            var sts         = $('#status_toggle').val();

            $('html, body').animate({
                scrollTop: $('body').offset().top
            }, 800);

            if (sts == 1) {
                $('.f_tambah').slideToggle('fast', function() {
                    if ($(this).is(':visible')) {
                        $('#status_toggle').val(1);          
                    } else {  
                        $('#status_toggle').val(0);            
                    }        
                });  
            }
        })
        $('.t_dek').on('click', function () {

            var sts         = $('#status_toggle').val();

             $('html, body').animate({
                scrollTop: $('body').offset().top
            }, 800);

            if (sts == 1) {
                $('.f_tambah').slideToggle('fast', function() {
                    if ($(this).is(':visible')) {
                        $('#status_toggle').val(1);          
                    } else {  
                        $('#status_toggle').val(0);            
                    }        
                });  
            }
        })

        $('#tambah_approval').on('click', function () {

            $('.f_tambah').slideToggle('fast', function() {
                if ($(this).is(':visible')) {
                    $('#status_toggle').val(1);          
                } else {  
                    $('#status_toggle').val(0);            
                }        
            });

        })  

        // aksi batal approval
        $('.batal_binding').on('click', function () {

            $('#form_approval').trigger("reset");

            $('#aksi').val('Tambah');
            $('.hapus-approval').removeAttr('hidden');

            $('.f_tambah').slideToggle('fast', function() {
                if ($(this).is(':visible')) {
                    $('#status_toggle').val(1);          
                } else {  
                    $('#status_toggle').val(0);            
                }        
            });

            $('#tambah_approval').attr('hidden', false);
        })

        // 16-05-2021
        var tabel_binding = $('#tabel_binding').DataTable({
            "processing"        : true,
            "serverSide"        : true,
            "order"             : [],
            "ajax"              : {
                "url"   : "<?= base_url() ?>binding/tampil_data_binding",
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
                "targets"   : [0,4,5,6],
                "orderable" : false
            }, {
                'targets'   : [0,4,5,6],
                'className' : 'text-center',
            }]
        })

        // 16-05-2021
        var tabel_binding_dek = $('#tabel_binding_dek').DataTable({
            "processing"        : true,
            "serverSide"        : true,
            "order"             : [],
            "ajax"              : {
                "url"   : "<?= base_url() ?>binding/tampil_data_binding_dek",
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
                "targets"   : [0,5,6,7],
                "orderable" : false
            }, {
                'targets'   : [0,5,6,7],
                'className' : 'text-center',
            }]
        })

        // 19-07-2021
        $('#tabel_binding').on('click', '.endors', function () {

            var id_sppa = $(this).data('id');

            location.href   = "<?= base_url('binding/endorsment/') ?>"+id_sppa+"/1";
            
        })

        // 16-05-2021
        $('#sppa_number').on('change', function () {
            
            var value = $(this).val();

            if (value == '') {
                $('.f_tab').slideUp();
            } else {

                $('.f_tab').slideUp();

                $.ajax({
                    url     : "<?= base_url('approval/tampil_detail_sppa') ?>",
                    method  : "POST",
                    data    : {id_sppa:value},
                    success : function (data) {
                        
                        $('.f_tab').html(data);
                        $('.f_tab').slideDown();

                        $('.id_sppa').val(value);

                    }
                })

                
                
            }

        })

        // 16-05-2021
        $('.f_tab').on('click', '#simpan_approval', function () {

            var form_approval   = $('#form_approval').serialize();
            var id_asuransi     = $('#id_insurer').val();

            if (id_asuransi == '') {

                swal({
                    title               : "Peringatan",
                    text                : 'Nama Asuransi harus terisi!',
                    type                : 'warning',
                    showConfirmButton   : false,
                    timer               : 3000,
                                allowOutsideClick   : false
                });
                
                return false;

            } else {

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
                    reverseButtons      : true
                }).then((result) => {
                    if (result.value) {
                        $.ajax({
                            url     : "<?= base_url() ?>approval/simpan_approval",
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
                            data    : form_approval,
                            dataType: "JSON",
                            success : function (data) {

                                swal({
                                    title               : "Berhasil",
                                    text                : 'Data berhasil di approve',
                                    type                : 'success',
                                    showConfirmButton   : false,
                                    timer               : 3000,
                                allowOutsideClick   : false
                                });

                                $('.f_tab').slideUp();

                                $('#sppa_number').html(data.option);

                                $('#form_approval').trigger("reset");
                
                                $('#aksi').val('Tambah');

                                $('.f_tambah').slideToggle('fast', function() {
                                    if ($(this).is(':visible')) {
                                        $('#status_toggle').val(1);          
                                    } else {  
                                        $('#status_toggle').val(0);            
                                    }        
                                });

                                tabel_approval.ajax.reload(null, false)
                                
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
                            timer               : 3000,
                                allowOutsideClick   : false
                        }); 
                    }
                })

                return false;
                
            }

        })

        // 17-05-2021
        $('#tabel_binding').on('click', '.detail', function () {

            var value       = $(this).data('id');
            var sppa_number = $(this).attr('sppa_number');
            var no_polis    = $(this).attr('no_polis');
            var cancel      = $(this).attr('cancel');

            location.href = "<?= base_url('binding/detail_sppa/') ?>"+value+"/1";

            // var sts         = $('#status_toggle').val();

            // if (cancel == 't') {
            //     $('.b_endorsment').fadeOut();
            // } else {
            //     $('.b_endorsment').fadeIn();
            // }

            // $('.f_tab').slideUp();

            // $('.f_list').slideUp();
            // $('.b_simpan').slideUp();
            // $('.kembali').slideUp();

            // $.ajax({
            //     url     : "<?= base_url('binding/tampil_detail_sppa') ?>",
            //     method  : "POST",
            //     data    : {id_sppa:value, jenis:'binding'},
            //     success : function (data) {
                    
            //         $('.f_tab').html(data);
            //         $('.f_tab').fadeIn(30);

            //         $('.id_sppa').val(value);
            //         $('#sppa_number').text(sppa_number);
            //         $('#no_polis').text(no_polis);

            //         $('html, body').animate({
            //             scrollTop: $('body').offset().top
            //         }, 800);

            //         if (sts == 0) {
            //             $('.f_tambah').slideToggle('fast', function() {
            //                 if ($(this).is(':visible')) {
            //                     $('#status_toggle').val(1);          
            //                 } else {  
            //                     $('#status_toggle').val(0);            
            //                 }        
            //             });  
            //         }
            //     }
            // })
            
        })

        // 08-07-2021
        $('#tabel_binding').on('click', '.list', function () {

            var value       = $(this).data('id');

            location.href   = "<?= base_url('binding/list_endors/') ?>"+value+"/1";

        })

        // 19-07-2021
        $('#tabel_binding_dek').on('click', '.list_sppa', function () {

            var id_mop      = $(this).data('id');

            location.href   = "<?= base_url('binding/list_sppa_aktif/') ?>"+id_mop;

        })

        // 17-05-2021
        $('#tabel_list_endors').on('click', '.lihat', function () {

            var value       = $(this).data('id');
            var sppa_number = $(this).attr('sppa_number');
            var no_polis    = $(this).attr('no_polis');
            var cancel      = $(this).attr('cancel');

            $('.b_endorsment').fadeOut();
            $('.kembali').fadeIn();
            $('#kembali_endors').fadeIn();

            $('.f_tab').slideUp();
            $('.f_list').slideUp();

            $.ajax({
                url     : "<?= base_url('binding/tampil_detail_sppa') ?>",
                method  : "POST",
                data    : {id_sppa:value, jenis:'detail_endors'},
                success : function (data) {

                    var sts         = $('#status_toggle').val();

                    $('html, body').animate({
                        scrollTop: $('body').offset().top
                    }, 800);

                    if (sts == 0) {
                        $('.f_tambah').slideToggle('fast', function() {
                            if ($(this).is(':visible')) {
                                $('#status_toggle').val(1);          
                            } else {  
                                $('#status_toggle').val(0);            
                            }        
                        });  
                    }
                    
                    $('.f_tab').html(data);
                    $('.f_tab').fadeIn(30);

                    // $('.id_sppa').val(value);
                    $('#sppa_number').text(sppa_number);
                    $('#no_polis').text(no_polis);

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

        $('#kembali_endors').on('click', function () {

            $('#kembali_endors').fadeOut();

            tabel_list_endors.ajax.reload(null, false); 
            
            $('.b_endorsment').fadeOut();
            $('.f_tab').fadeOut();
            $('.f_list').fadeIn(30);
            
        })

        // 24-05-2021
        var tabel_list_endors = $('#tabel_list_endors').DataTable({
            "processing"        : true,
            "order"             : [],
            "ajax"              : {
                "url"   : "<?= base_url() ?>binding/tampil_list_endors",
                "type"  : "POST",
                "data"  : function (data) {
                    data.id_sppa    = $('#id_sppa_list').val();
                },

            },
            "columnDefs"        : [{
                "targets"   : [0,4],
                "orderable" : false
            }, {
                'targets'   : [0,2,3,4],
                'className' : 'text-center',
            }],
            "bPaginate"     : true,
            "bLengthChange" : false,
            "bFilter"       : true,
            "bInfo"         : true
        })

        // 24-05-2021
        $('#tabel_binding').on('click', '.list_endors', function () {

            var value       = $(this).data('id');
            var sppa_number = $(this).attr('sppa_number');
            var no_polis    = $(this).attr('no_polis');

            var sts         = $('#status_toggle').val();

            $('#id_sppa_list').val(value);

            tabel_list_endors.ajax.reload(null, false); 
            
            $('.f_tab').fadeOut();
            $('.b_endorsment').fadeOut();
            $('.kembali').fadeOut();
            $('.b_simpan').fadeOut();

            $('.f_list').fadeIn(30);

            $('.list_tabel_endors').slideDown();
            $('.list_tabel_endors_dek').slideUp();
            
            $('#sppa_number').text(sppa_number);
            $('#no_polis').text(no_polis);

            $('html, body').animate({
                scrollTop: $('body').offset().top
            }, 800);

            if (sts == 0) {
                $('.f_tambah').slideToggle('fast', function() {
                    if ($(this).is(':visible')) {
                        $('#status_toggle').val(1);          
                    } else {  
                        $('#status_toggle').val(0);            
                    }        
                });  
            }
            
        })


        // 19-05-2021
        $('#tabel_binding').on('click', '.hapus', function () {

            var value       = $(this).data('id');
            var sppa_number = $(this).attr('sppa_number');
            var no_polis    = $(this).attr('no_polis');

            $('.f_tab').slideUp();

            $.ajax({
                url     : "<?= base_url('binding/tampil_detail_sppa') ?>",
                method  : "POST",
                data    : {id_sppa:value, jenis:'binding'},
                success : function (data) {

                    var sts         = $('#status_toggle').val();

                    $('html, body').animate({
                        scrollTop: $('body').offset().top
                    }, 800);

                    if (sts == 0) {
                        $('.f_tambah').slideToggle('fast', function() {
                            if ($(this).is(':visible')) {
                                $('#status_toggle').val(1);          
                            } else {  
                                $('#status_toggle').val(0);            
                            }        
                        });  
                    }
                    
                    $('.f_tab').html(data);
                    $('.f_tab').fadeIn(30);

                    $('.id_sppa').val(value);
                    $('#sppa_number').text(sppa_number);
                    $('#no_polis').text(no_polis);

                }
            })

        })

        // 18-05-2021
        $('#endorsment').on('click', function () {

            var id_sppa = $('.id_sppa').val();

            // $('.f_tab').slideUp();

            $.ajax({
                url     : "<?= base_url('binding/tampil_detail_sppa/endorsment') ?>",
                method  : "POST",
                data    : {id_sppa:id_sppa},
                success : function (data) {

                    $('.f_tab').html(data);
                    $('.f_tab').fadeIn(30);

                    $('.b_endorsment').fadeOut(30);
                    $('.b_simpan').fadeIn(30);

                    $('.id_sppa').val(id_sppa);

                }
            })

        })

        // 18-05-2021
        $('#batal').on('click', function () {

            var id_sppa = $('.id_sppa').val();

            // $('.f_tab').slideUp();

            $.ajax({
                url     : "<?= base_url('binding/tampil_detail_sppa') ?>",
                method  : "POST",
                data    : {id_sppa:id_sppa},
                success : function (data) {

                    $('.b_endorsment').fadeIn(30);
                    $('.b_simpan').fadeOut(30);
                    
                    $('.f_tab').html(data);
                    $('.f_tab').fadeIn(30);

                    $('.id_sppa').val(id_sppa);
                }
            })

        })

        // 18-05-2021
        $('#simpan_endorsment').on('click', function () {

            var lob_adt           = [];
            var kalkulasi_tsi_adt = [];
            var pengali_tsi_adt   = [];
            var rate_adt          = [];
            var nominal_adt       = [];
            var rate_all_premi    = [];
            var nominal_all_premi = [];
            var id_coverage       = [];
            var premi_standar     = [];
            var premi_perluasan   = [];

            $('.lob_adt').each(function() { 
                lob_adt.push($(this).val()); 
            });
            $('.kalkulasi_tsi_adt').each(function() { 
                kalkulasi_tsi_adt.push($(this).val()); 
            });
            $('.pengali_tsi_adt').each(function() { 
                pengali_tsi_adt.push($(this).val()); 
            });
            $('.rate_adt').each(function() { 
                rate_adt.push($(this).val()); 
            });
            $('.nominal_adt').each(function() { 
                nominal_adt.push($(this).val()); 
            });
            $('.rate_all_premi').each(function() { 
                rate_all_premi.push($(this).val()); 
            });
            $('.nominal_all_premi').each(function() { 
                nominal_all_premi.push($(this).val()); 
                id_coverage.push($(this).attr('id_coverage')); 
            });
            $('.premi_standar').each(function() { 
                premi_standar.push($(this).val()); 
            });
            $('.premi_perluasan').each(function() { 
                premi_perluasan.push($(this).val()); 
            });

            var id_sppa_premi       = $('#id_sppa_premi').val();
            var tsi                 = $('#tsi').val();
            var diskon              = $('#diskon').val();
            var gross_premi         = $('#gross_premi').val();
            var total_diskon        = $('#total_diskon').val();
            var total_persen_premi  = $('#total_persen_premi').val();
            var total_akhir_premi   = $('#total_akhir_premi').val();
            var biaya_admin         = $('#biaya_admin').val();
            var total_tagihan       = $('#total_tagihan').val();
            var payment_method      = $('#payment_method').val();
            var tahun_pay           = $('#tahun_pay').val();
            var jumlah_cicilan      = $('#jumlah_cicilan').val();

            var id_sob              = $('#sobb').val();
            var id_cob              = $('#cobb').val();
            var id_lob              = $('#lobb').val();
            var nama_sob            = $('#tocc').val();
            var id_relasi           = $('.id_relasi').val();
            var sppa_number         = $('.sppa_number').val();
            var no_polis            = $('.no_polis').val();
            var no_invoice          = $('.no_invoice').val();

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
                        url     : "<?= base_url() ?>binding/simpan_data_endorsment",
                        type    : "POST",
                        data    : {
                            id_sppa             : id_sppa_premi,
                            tsi                 : tsi,
                            diskon              : diskon,
                            gross_premi         : gross_premi,
                            total_diskon        : total_diskon,
                            total_persen_premi  : total_persen_premi,
                            total_akhir_premi   : total_akhir_premi,
                            biaya_admin         : biaya_admin,
                            total_tagihan       : total_tagihan, 
                            payment_method      : payment_method,
                            tahun_pay           : tahun_pay,
                            jumlah_cicilan      : jumlah_cicilan,
                            lob_adt             : lob_adt, 
                            kalkulasi_tsi_adt   : kalkulasi_tsi_adt,
                            pengali_tsi_adt     : pengali_tsi_adt,
                            rate_adt            : rate_adt,
                            nominal_adt         : nominal_adt, 
                            rate_all_premi      : rate_all_premi,
                            nominal_all_premi   : nominal_all_premi,
                            id_coverage         : id_coverage,
                            premi_standar       : premi_standar,
                            premi_perluasan     : premi_perluasan,
                            id_sob              : id_sob,              
                            id_cob              : id_cob,              
                            id_lob              : id_lob,              
                            nama_sob            : nama_sob,            
                            id_relasi           : id_relasi,           
                            sppa_number         : sppa_number,         
                            no_polis            : no_polis,    
                            no_invoice          : no_invoice,    
                            detail              : $('#form_detail').serializeArray()     
                        },
                        dataType: "JSON",
                        success : function (data) {

                            location.reload();
                            
                        },
                        error: function (jqXHR, textStatus, errorThrown)
                        {
                            swal({
                                title               : "Gagal",
                                text                : 'Gagal Disimpan',
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
                        title               : "Batal",
                        text                : 'Anda membatalkan simpan data',
                        buttonsStyling      : false,
                        confirmButtonClass  : "btn btn-primary",
                        type                : 'error',
                        showConfirmButton   : false,
                        timer               : 3000,
                                allowOutsideClick   : false
                    }); 
                }
            })

            return false;

        })

        // 18-05-2021
        $('#cancel_sppa').on('click', function () {

            var id_sppa = $('.id_sppa').val();

            $.ajax({
                url     : "<?= base_url('binding/simpan_cancel') ?>",
                method  : "POST",
                data    : {id_sppa:id_sppa},
                success : function (data) {

                    location.reload();

                },
                error: function (jqXHR, textStatus, errorThrown)
                {
                    swal({
                        title               : "Gagal",
                        text                : 'Gagal Disimpan',
                        type                : 'error',
                        showConfirmButton   : false,
                        timer               : 3000,
                                allowOutsideClick   : false
                    }); 

                    return false;
                }
            })

        })

        // 21-06-2021
        $('#tabel_binding_dek').on('click', '.detail', function () {

            var id_mop  = $(this).data('id');
            var url     = "<?= base_url() ?>binding/detail_binding/"+id_mop;

            location.href = url;
            
        })

        // 21-06-2021
        var tabel_list_endors_dek = $('#tabel_list_endors_dek').DataTable({
            "processing"        : true,
            "order"             : [],
            "ajax"              : {
                "url"   : "<?= base_url() ?>binding/tampil_list_endors_dek",
                "type"  : "POST",
                "data"  : function (data) {
                    data.id_mop    = $('#id_mop_list').val();
                },

            },
            "columnDefs"        : [{
                "targets"   : [0,3,4],
                "orderable" : false
            }, {
                'targets'   : [0,2,3,4],
                'className' : 'text-center',
            }],
            "bPaginate"     : true,
            "bLengthChange" : false,
            "bFilter"       : true,
            "bInfo"         : true
        })

        // 21-06-2021
        $('#tabel_binding_dek').on('click', '.list_endors', function () {

            var value           = $(this).data('id');
            var no_mop          = $(this).attr('no_mop');
            var nama_mop        = $(this).attr('nama_mop');
            var no_polis_induk  = $(this).attr('no_polis_induk');

            var sts         = $('#status_toggle').val();

            $('#id_mop_list').val(value);

            $('#no_polis_induk').text(no_polis_induk);
            $('#nama_mop').text(nama_mop);
            $('#nomor_mop').text(no_mop);

            tabel_list_endors_dek.ajax.reload(null, false); 
            
            $('.f_tab').fadeOut();
            $('.b_endorsment').fadeOut();
            $('.kembali').fadeOut();
            $('.b_simpan').fadeOut();

            $('.f_list').fadeIn(30);

            $('.list_tabel_endors').slideUp();
            $('.list_tabel_endors_dek').slideDown();
            
            $('html, body').animate({
                scrollTop: $('body').offset().top
            }, 800);

            if (sts == 0) {
                $('.f_tambah').slideToggle('fast', function() {
                    if ($(this).is(':visible')) {
                        $('#status_toggle').val(1);          
                    } else {  
                        $('#status_toggle').val(0);            
                    }        
                });  
            }
            
        })

        // 21-06-2021
        $('#tabel_list_endors_dek').on('click', '.lihat', function () {

            var id_mop  = $(this).attr('id_mop');
            var nama    = $(this).data('nama');

            $.ajax({
                url     : "<?= base_url('binding/tampil_lihat_endors') ?>",
                method  : "POST",
                data    : {id_mop:id_mop, nama:nama},
                success : function (data) {

                    $('.isi_lihat').html(data);
                    $('#modal_lihat').modal('show');


                },
                error: function (jqXHR, textStatus, errorThrown)
                {
                    swal({
                        title               : "Gagal",
                        text                : 'Gagal Menampilkan',
                        type                : 'error',
                        showConfirmButton   : false,
                        timer               : 3000,
                                allowOutsideClick   : false
                    }); 

                    return false;
                }
            })

            
        })
        
    })
    
</script>