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
                <li class="breadcrumb-item">Binding Slip</li>
                <li class="breadcrumb-item active"><?= $title ?></li>
            </ol>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="card shadow">
            <div class="card-header">
                <?php if ($role['update'] == 'true' || $id_lvl_otorisasi == 0) : ?>
                    <?php if ($sts_cancel == 'ada'): ?>
                        <button type="button" class="btn btn-primary mr-2" id="endorsment"><i class="fas fa-pencil-alt mr-2"></i>Endorsment</button>
                        <button type="button" class="btn btn-danger" id="cancel"><i class="fas fa-times mr-2"></i>Cancelation</button>
                    <?php endif; ?>
                <?php endif; ?>

                <button type="button" class="btn btn-danger" id="batal" style="display: none;"><i class="fas fa-undo mr-2"></i>Batal</button>
                <a href="<?= base_url('binding/lihat/dekl') ?>"><button class="btn btn-primary float-right" id="kembali"><i class="fas fa-arrow-left mr-2"></i>Kembali</button></a>
                <button class="btn btn-primary float-right" id="simpan" style="display: none;"><i class="fas fa-check mr-2"></i>Simpan</button>
            </div>
            <div class="card-body card_awal">

                <div class="row">
                    <div class="col-md-4 text-center">
                        <h5>No Polis Induk : <samp><mark> <?= $mop['no_polis_induk'] ?> </mark></samp></h5>
                    </div>
                    <div class="col-md-4 text-center">
                        <h5>Nama MOP : <samp><mark> <?= $mop['nama_mop'] ?> </mark></samp></h5>
                    </div>
                    <div class="col-md-4 text-center">
                        <h5>Nomor Dokumen : <samp><mark> <?= $mop['no_mop'] ?> </mark></samp></h5>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-12 table-responsive mt-3">

                        <table class="table table-bordered table-hover dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;" id="tabel_list_endors" width="100%" cellspacing="0">
                            <thead class="thead-light text-center">
                                <tr>
                                    <th width="5%">No</th>
                                    <th>Nama Endorsment</th>
                                    <th>Tanggal Endorsment</th>
                                    <th>Status</th>
                                    <!-- <th>SPPA Aktif</th> -->
                                    <th width="20%">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>

                    </div>
                </div>

            </div>
            <div class="card-body card_endors" style="display: none;">
            </div>
        </div>
        
    </div>
</div>

<script>

    $(document).ready(function () {

        var tabel_list_endors = $('#tabel_list_endors').DataTable({
            "processing"        : true,
            "serverSide"        : true,
            "order"             : [],
            "ajax"              : {
                "url"   : "<?= base_url() ?>binding/tampil_list_endorsment",
                "type"  : "POST",
                "data"  : function (data) {
                    data.id_mop     = "<?= $id_mop ?>";
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

        // 12-07-2021
        $('#tabel_list_endors').on('click', '.list', function () {

            var id_mop      = $(this).attr('id_mop');
            var nama_endors = $(this).attr('nama_endors');

            location.href = "<?= base_url('binding/detail_list_sppa/') ?>"+id_mop+"/"+nama_endors;
            
        })

        $('#endorsment').on('click', function () {

            var id_mop = "<?= $id_mop ?>";

            $.ajax({
                url     : "<?= base_url('binding/tampil_detail_sppa_dek') ?>",
                method  : "POST",
                data    : {id_mop:id_mop},
                success : function (data) {

                    $('.card_endors').html(data);
                    $('.card_endors').fadeIn(10);

                    $('.card_awal').fadeOut(10);

                    $('#endorsment').fadeOut(10);
                    $('#cancel').fadeOut(10);
                    $('#batal').fadeIn(10);
                    $('#kembali').fadeOut(10);
                    $('#simpan').fadeIn(10);

                }
            })

            })

            // 21-06-2021
            $('#batal').on('click', function () {

            $('.card_endors').html('');
            $('.card_endors').fadeOut(10);

            $('.card_awal').fadeIn(10);

            $('#endorsment').fadeIn(10);
            $('#cancel').fadeIn(10);
            $('#batal').fadeOut(10);
            $('#kembali').fadeIn(10);
            $('#simpan').fadeOut(10);

        })

        // 21-06-2021
        $('#simpan').on('click', function () {

            tinymce.triggerSave();

            var jenis_input         = $('#jenis_input').val();

            var form_client         = $('#form_client').serialize();
            var form_detail_endors  = $('#form_detail_endors').serialize();

            console.log(form_detail_endors);

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
                premi_standar.push($(this).val().split('.').join('')); 
            });
            $('.premi_perluasan').each(function() { 
                premi_perluasan.push($(this).val().split('.').join('')); 
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

            let formData  = new FormData()
            var excelfile = document.getElementById('excelfile').files[0];

            formData.append('id_sppa_premi', id_sppa_premi);
            formData.append('tsi', tsi);
            formData.append('diskon', diskon);
            formData.append('gross_premi', gross_premi);
            formData.append('total_diskon', total_diskon);
            formData.append('total_persen_premi', total_persen_premi);
            formData.append('total_akhir_premi', total_akhir_premi);
            formData.append('biaya_admin', biaya_admin);
            formData.append('total_tagihan', total_tagihan);
            formData.append('payment_method', payment_method);
            formData.append('tahun_pay', tahun_pay);
            formData.append('jumlah_cicilan', jumlah_cicilan);
            formData.append('lob_adt', JSON.stringify(lob_adt));
            formData.append('kalkulasi_tsi_adt', JSON.stringify(kalkulasi_tsi_adt));
            formData.append('pengali_tsi_adt', JSON.stringify(pengali_tsi_adt));
            formData.append('rate_adt', JSON.stringify(rate_adt));
            formData.append('nominal_adt', JSON.stringify(nominal_adt));
            formData.append('rate_all_premi', JSON.stringify(rate_all_premi));
            formData.append('nominal_all_premi', JSON.stringify(nominal_all_premi));
            formData.append('id_coverage', JSON.stringify(id_coverage));
            formData.append('premi_standar', JSON.stringify(premi_standar));
            formData.append('premi_perluasan', JSON.stringify(premi_perluasan));
            formData.append('form_client', form_client);
            formData.append('form_detail', form_detail_endors);
            formData.append('upload_excel', excelfile);
            formData.append('jenis', "binding");

            if (jenis_input == 'upload') {
                var url;
                if (excelfile) {
                    url = "<?= base_url() ?>entry_sppa/simpan_semua_deklarasi";
                } else {
                    swal({
                        title               : "Perhatian",
                        text                : 'File Kosong Harap isi dahulu!',
                        type                : 'warning',
                        showConfirmButton   : false,
                        timer               : 3000,
                        allowOutsideClick   : false
                    })

                    return false;
                }  
            } else {
                url = "<?= base_url() ?>entry_sppa/simpan_semua_deklarasi_manual";
            }

            swal({
                title       : 'Konfirmasi',
                text        : 'Yakin akan kirim data?',
                type        : 'warning',

                buttonsStyling      : false,
                confirmButtonClass  : "btn btn-primary",
                cancelButtonClass   : "btn btn-danger mr-3",

                showCancelButton    : true,
                confirmButtonText   : 'Ya, kirim',
                confirmButtonColor  : '#3085d6',
                cancelButtonColor   : '#d33',
                cancelButtonText    : 'Batal',
                reverseButtons      : true,

                allowOutsideClick   : false
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        url     : url,
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
                        data            : formData,
                        contentType     : false,
                        cache           : false,
                        processData     : false,
                        dataType        : "JSON",
                        success : function (data) {

                            // return false;

                            if (data.status == 'gagal') {

                                swal({
                                    title               : "Peringatan",
                                    text                : 'Format Header Excel tidak sesuai, harap samakan dengan download format excel yg tersedia!',
                                    type                : 'warning',
                                    allowOutsideClick   : false,
                                    buttonsStyling      : false,
                                    confirmButtonClass  : "btn btn-primary",
                                    showCancelButton    : false,
                                    confirmButtonText   : 'OK',
                                });

                                return false;
                                
                            } else if (data.status == 'semua data sudah ada') {

                                swal({
                                    title               : "Peringatan",
                                    text                : 'Semua data excel sudah ada!',
                                    type                : 'warning',
                                    allowOutsideClick   : false,
                                    buttonsStyling      : false,
                                    confirmButtonClass  : "btn btn-primary",
                                    showCancelButton    : false,
                                    confirmButtonText   : 'OK',
                                });

                                return false;
                                
                            } else {
                                swal({
                                    title               : "Berhasil",
                                    text                : data.jumlah+' data berhasil di simpan',
                                    type                : 'success',
                                    showConfirmButton   : false,
                                    timer               : 3000,
                                    allowOutsideClick   : false
                                }).then(function() {
                                    location.reload();
                                }); 
                            }

                            

                            // location.href = "<?= base_url('binding/lihat/dekl') ?>";

                            
                            
                        }
                    })

                    return false;

                } else if (result.dismiss === swal.DismissReason.cancel) {

                    swal({
                        title               : "Batal",
                        text                : 'Anda membatalkan kirim data',
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

        // 22-06-2021
        $('#cancel').on('click', function () {

            var id_mop  = "<?= $id_mop; ?>";

            swal({
                title       : 'Konfirmasi',
                text        : 'Yakin akan cancelation data?',
                type        : 'warning',

                buttonsStyling      : false,
                confirmButtonClass  : "btn btn-danger",
                cancelButtonClass   : "btn btn-primary mr-3",

                showCancelButton    : true,
                confirmButtonText   : 'Ya, cancelation',
                confirmButtonColor  : '#3085d6',
                cancelButtonColor   : '#d33',
                cancelButtonText    : 'Batal',
                reverseButtons      : true,
                allowOutsideClick   : false
            }).then((result) => {
                if (result.value) {

                    $.ajax({
                        url     : "<?= base_url('binding/ubah_cancelation') ?>",
                        method  : "POST",
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
                        data    : {id_mop:id_mop},
                        dataType: "JSON",
                        success : function (data) {

                            swal({
                                title               : "Berhasil",
                                text                : 'Data berhasil dicancelation',
                                type                : 'success',
                                showConfirmButton   : false,
                                timer               : 3000,
                                allowOutsideClick   : false
                            }).then(function() {
                                location.reload();
                            });

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
        
    })
    
</script>