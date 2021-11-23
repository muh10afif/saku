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
<input type="hidden" id="status_toggle">
<div class="row">
    <?php $this->load->view('input'); ?>
    <div class="col-md-12">
        <div class="card shadow">
            <?php if ($role['create'] == 'true' || $id_lvl_otorisasi == 0): ?>
                <div class="card-header">
                    <button class="btn btn-primary float-right" id="tambah_approval"><i class="fas fa-plus mr-1"></i> Tambah Data</button>
                    <h5 id="judul" class="mb-0 mt-1"></h5>
                </div>
            <?php endif;  ?>
            <div class="card-body">
                <table class="table table-bordered table-hover dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;" id="tabel_approval" width="100%" cellspacing="0">
                    <thead class="thead-light text-center">
                        <tr>
                            <th width="5%">No</th>
                            <th>No SPPA</th>
                            <th>Client [SOB - CDB]</th>
                            <th>COB - LOB</th>
                            <th>Insurer</th>
                            <th width="15%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<input type="hidden" class="id_sppa" id="id_sppa">

<script>

    $(document).ready(function () {

        $('#tambah_approval').on('click', function () {

            $('#judul').text('');
            $('#sppa_number').val('').trigger('change');

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

            // $('#judul').text('Approve SPPA');

            $('.f_tab').slideUp();
            $('.sel_sppa').fadeIn();
            $('.sppa_num').fadeOut(10);

        })  

        // aksi batal approval
        $('.batal_approval').on('click', function () {

            $('#form_approval').trigger("reset");
            // 

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

        // aksi batal approval
        $('.f_tab').on('click', '.batal_approval', function () {

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
        var tabel_approval = $('#tabel_approval').DataTable({
            "processing"        : true,
            "serverSide"        : true,
            "order"             : [],
            "ajax"              : {
                "url"   : "<?= base_url() ?>approval/tampil_data_approval",
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
                "targets"   : [0,5],
                "orderable" : false
            }, {
                'targets'   : [0,5],
                'className' : 'text-center',
            }]
        })

        // 16-05-2021
        $('#sppa_number').on('change', function () {
            
            var value = $(this).val();

            if (value == '') {
                $('.f_tab').slideUp();
            } else {

                $('.f_tab').slideUp();

                $.ajax({
                    url     : "<?= base_url('approval/tampil_edit_sppa_tambah') ?>",
                    method  : "POST",
                    data    : {id_sppa:value, aksi:'tambah'},
                    success : function (data) {
                        
                        $('.f_simpan').slideDown();

                        $('.f_tab').html(data);
                        $('.f_tab').slideDown();

                        // $('.link_entry').addClass('disabled');

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
                                    title               : 'Menunggu',
                                    html                : 'Memproses Data',
                                    onOpen              : () => {
                                        swal.showLoading();
                                    },
                                    allowOutsideClick   : false
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
                                $('#no_otorisasi_polis').val(data.no_polis);

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

        // 19-05-2021
        $('.f_tab').on('click', '#simpan_approval_edit', function () {

            var form_approval   = $('#form_approval_edit').serialize();
            var id_asuransi     = $('#id_insurer_edit').val();

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
                            data    : { detail: form_approval},
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
                                $('#no_otorisasi_polis').val(data.no_polis);

                                $('#form_approval').trigger("reset");

                                $('.sel_sppa').fadeIn();
                
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

        // 25-05-2021
        $('.f_tab').on('click', '.simpan_semua', function () {

            tinymce.triggerSave();

            var form_client     = $('#form_client').serialize();
            var form_detail     = $('#form_detail').serialize();
            var form_approval   = $('#form_approval_edit').serialize();

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

            var aksi_simpan         = $('#aksi_simpan').val();

            var id_insurer          = $('#id_insurer_edit').val();
            var tgl_otorisasi       = $('#tgl_otorisasi').val(); 
            var id_karyawan         = $('#id_karyawan_edit').val();

            var txt = "";
            if (id_insurer != '' && tgl_otorisasi != '' && id_karyawan != '') {

                if (aksi_simpan == 'ubah') {
                    txt = "SPPA berhasil disimpan.";
                } else {
                    txt = "SPPA berhasil diapprove.";
                }
                
            } else {
                swal({
                        title               : "Peringatan",
                        text                : 'Harap Lengkapi semua form data Approval!',
                        buttonsStyling      : false,
                        confirmButtonClass  : "btn btn-primary",
                        type                : 'warning',
                        showConfirmButton   : true,
                        confirmButtonText   : '   O K   ',
                        allowOutsideClick   : false
                    }); 

                return false;
            }

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
                        url     : "<?= base_url() ?>approval/simpan_semua",
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
                        data    : {

                            id_sppa_premi       : id_sppa_premi,
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
                            form_client         : form_client,
                            form_detail         : form_detail,
                            form_approval       : form_approval,
                            aksi_simpan         : aksi_simpan

                        },
                        dataType: "JSON",
                        success : function (data) {

                            swal({
                                title               : "Berhasil",
                                text                : txt,
                                type                : 'success',
                                showConfirmButton   : false,
                                timer               : 3000,
                                allowOutsideClick   : false
                            });

                            $('.f_tab').slideUp();

                            $('#sppa_number').html(data.option);
                            $('#no_otorisasi_polis').val(data.no_polis);

                            $('#form_approval').trigger("reset");

                            $('.sel_sppa').fadeIn();
            
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
            
        })

        // 25-05-2021
        $('.f_tab').on('click', '.lanjutkan', function () {

            var aksi_next = $(this).attr('aksi');

            $('html, body').animate({
                scrollTop: $('body').offset().top
            }, 800);

            $('.link_'+aksi_next).removeClass('disabled');
            activaTab(aksi_next);  
            
        })

        function activaTab(tab){
            $('.nav-tabs a[href="#' + tab + '"]').tab('show');
        };

        // 25-05-2021
        $('.f_tab').on('click', '#simpan_semua', function () {

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
            var total_persen_premi  = $('#total_persen_premi').val();
            var total_akhir_premi   = $('#total_akhir_premi').val();
            var biaya_admin         = $('#biaya_admin').val();
            var total_tagihan       = $('#total_tagihan').val();
            var payment_method      = $('#payment_method').val();
            var tahun_pay           = $('#tahun_pay').val();
            var jumlah_cicilan      = $('#jumlah_cicilan').val();

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
                        url     : "<?= base_url() ?>entry_sppa/simpan_data_premi",
                        type    : "POST",
                        data    : {
                        id_sppa_premi       : id_sppa_premi,
                        tsi                 : tsi,
                        diskon              : diskon,
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
                        premi_perluasan     : premi_perluasan
                        },
                        dataType: "JSON",
                        success : function (data) {

                        $('.link_released').removeClass('disabled');
                        activaTab('t_released');  
                            
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
        
        // 19-05-2021
        $('#tabel_approval').on('click', '.hapus', function () {

            var id_sppa = $(this).data('id');

            swal({
                title       : 'Konfirmasi',
                text        : 'Yakin akan hapus data?',
                type        : 'warning',

                buttonsStyling      : false,
                confirmButtonClass  : "btn btn-danger",
                cancelButtonClass   : "btn btn-primary mr-3",

                showCancelButton    : true,
                confirmButtonText   : 'Ya, hapus',
                confirmButtonColor  : '#3085d6',
                cancelButtonColor   : '#d33',
                cancelButtonText    : 'Batal',
                reverseButtons      : true,

                allowOutsideClick   : false
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        url     : "<?= base_url() ?>approval/hapus_approval",
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
                        data    : {id_sppa:id_sppa},
                        dataType: "JSON",
                        success : function (data) {

                            $('#sppa_number').html(data.option);

                            swal({
                                title               : "Berhasil",
                                text                : 'Data Berhasil dihapus',
                                type                : 'success',
                                showConfirmButton   : false,
                                timer               : 3000,
                                allowOutsideClick   : false
                            }); 

                            // $('.f_tambah').slideToggle('fast', function() {
                            //     if ($(this).is(':visible')) {
                            //         $('#status_toggle').val(1);          
                            //     } else {  
                            //         $('#status_toggle').val(0);            
                            //     }        
                            // });

                            tabel_approval.ajax.reload(null,false);  
                            
                        },
                        error: function (jqXHR, textStatus, errorThrown)
                        {
                            swal({
                                title               : "Gagal",
                                text                : 'Gagal Proses Data',
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
                        text                : 'Anda membatalkan hapus data',
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

        // 19-05-2021
        $('#tabel_approval').on('click', '.detail', function () {
            
            var value       = $(this).data('id');
            var sppa_number = $(this).attr('sppa_number');

            location.href = "<?= base_url() ?>approval/tampil_detail_sppa/"+value+"/detail";

            return false;

            $('#judul').text('Detail SPPA');
            $('#sppa_number_apv').text(sppa_number);

            $('.sel_sppa').fadeOut();
            $('.sppa_num').fadeIn();

            if (value == '') {
                $('.f_tab').slideUp();
            } else {

                $('.f_tab').slideUp();
                $('.link_entry').removeClass('disabled');

                $.ajax({
                    url     : "<?= base_url('approval/tampil_detail_sppa') ?>",
                    method  : "POST",
                    data    : {id_sppa:value, aksi:'detail'},
                    success : function (data) {
                        
                        $('.f_tab').html(data);
                        $('.f_tab').slideDown();

                        $('.id_sppa').val(value);

                        $('.f_simpan').slideUp();
                        
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

                    }
                })

                
                
            }

        })

        // 19-05-2021
        $('#tabel_approval').on('click', '.edit', function () {
            
            var value       = $(this).data('id');
            var sppa_number = $(this).attr('sppa_number');

            location.href = "<?= base_url() ?>approval/tampil_edit_sppa/"+value+"/ubah";

            return false;

            $('#judul').text('Edit SPPA');

            $('#sppa_number_apv').text(sppa_number);

            $('.sel_sppa').fadeOut();
            $('.sppa_num').fadeIn();

            if (value == '') {
                $('.f_tab').slideUp();
            } else {

                $('.f_tab').slideUp();

                $.ajax({
                    url     : "<?= base_url('approval/tampil_edit_sppa') ?>",
                    method  : "POST",
                    data    : {id_sppa:value, aksi:'ubah'},
                    success : function (data) {
                        
                        $('.f_tab').html(data);
                        $('.f_tab').slideDown();

                        $('.id_sppa').val(value);

                        $('.f_simpan').slideDown();

                        // $('.link_entry').addClass('disabled');

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

                    }
                })

                
                
            }

        })
        
    })
    
</script>