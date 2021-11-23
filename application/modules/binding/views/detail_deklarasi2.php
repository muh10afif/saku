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
            <div class="card">
                <div class="card-header">
                    <?php if ($tr_sppa['cancelation'] == 'f'): ?>
                        
                    
                        <button type="button" class="btn btn-primary mr-2" id="endorsment"><i class="mdi mdi-pencil-outline mr-2"></i>Endorsment</button>
                        <button type="button" class="btn btn-danger" id="cancel"><i class="mdi mdi-cancel mr-2"></i>Cancelation</button>

                    <?php endif; ?>
                    <button type="button" class="btn btn-danger" id="batal" style="display: none;"><i class="mdi mdi-close-circle mr-2"></i>Batal</button>
                    <a href="<?= base_url('binding/lihat/dekl') ?>"><button class="btn btn-primary float-right" id="kembali"><i class="mdi mdi-arrow-left-thick mr-2"></i>Kembali</button></a>
                    <button class="btn btn-primary float-right" id="simpan" style="display: none;"><i class="mdi mdi-check-bold mr-2"></i>Simpan</button>
                    
                </div>
                <div class="card-body card_awal">
                    <div class="row">
                        <div class="col-md-4 text-center">
                            <h5>No Polis Induk : <samp><mark> <?= $no_polis_induk ?> </mark></samp></h5>
                        </div>
                        <div class="col-md-4 text-center">
                            <h5>Nama MOP : <samp><mark> <?= $nama_mop ?> </mark></samp></h5>
                        </div>
                        <div class="col-md-4 text-center">
                            <h5>Nomor MOP : <samp><mark> <?= $no_mop ?> </mark></samp></h5>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-12">

                            <ul class="nav nav-tabs d-flex justify-content-center mt-2" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" data-toggle="tab" href="#t_client_data" role="tab">
                                    <span class="d-none d-md-block">Client Data</span><span class="d-block d-md-none"><i class="mdi mdi-home-variant h5"></i></span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link link_entry link_detail" data-toggle="tab" href="#t_detail" role="tab">
                                    <span class="d-none d-md-block">Detail Insured</span><span class="d-block d-md-none"><i class="mdi mdi-account h5"></i></span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link link_entry link_dok" data-toggle="tab" href="#t_dok" role="tab">
                                    <span class="d-none d-md-block">Documents</span><span class="d-block d-md-none"><i class="mdi mdi-email h5"></i></span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link link_entry link_premi" data-toggle="tab" href="#t_premi" role="tab">
                                    <span class="d-none d-md-block">Premium Calculation</span><span class="d-block d-md-none"><i class="mdi mdi-settings h5"></i></span>
                                    </a>
                                </li>
                            </ul>

                            <!-- Tab panes -->
                            <div class="tab-content">
                                <div class="tab-pane active p-3" id="t_client_data" role="tabpanel">
                                    <form action="#" id="form_client1">
                                    <input type="hidden" class="sppa_number" name="sppa_number" value="<?= $sppa_number ?>">
                                    <input type="hidden" class="id_sppa" name="id_sppa">
                                    <input type="hidden" class="nama_sob" name="nama_sob">
                                    <input type="hidden" class="id_relasi" name="id_relasi">

                                    <!-- <hr class="mt-0"> -->
                                    <div class="sel_mop" style="display: none;">
                                    
                                        <div class="d-flex justify-content-center">
                                            
                                            <div class="col-md-6  mt-2">
                                            <div class="form-group row">
                                                <label for="sobb" class="col-sm-4 col-form-label">No Reff MOP</label>
                                                <div class="col-sm-8">
                                                <select name="no_reff_mop" id="no_reff_mop" class="select2">
                                                    <option value="pilih">Pilih</option>
                                                    <?php foreach ($no_reff as $n): ?>
                                                    <option value="<?= $n['id_mop'] ?>"><?= $n['no_reff_mop'] ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                                </div>
                                            </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="non_mop">
                                    <h4>Source of Bussiness</h4><hr>
                                    <div class="d-flex justify-content-center">
                                    <div class="col-md-5">
                                        <div class="form-group row">
                                        <label for="sobb" class="col-sm-4 col-form-label text-left">Source of Business</label>
                                        <div class="col-sm-8 mt-2">
                                            <span>: <?= $sob ?></span>
                                        </div>
                                        </div>
                                    </div>
                                    <div class="col-md-5">
                                        <div class="form-group row">
                                        <label for="tocc" class="col-sm-4 col-form-label" id="lbln"><?= $sob ?></label>
                                        <div class="col-sm-8 mt-2">
                                            <span>: <?= $data_sob['nama'] ?></span>
                                        </div>
                                        </div>
                                    </div>
                                    </div>
                                    <div class="d-flex justify-content-center">
                                        <div class="col-md-5 d2_sob">
                                            <div class="form-group row">
                                            <label for="sobb" class="col-sm-4 col-form-label">Telp</label>
                                            <div class="col-sm-8 mt-2 ">
                                                <span id="d2_nama">: <?= $data_sob['telp'] ?></span>
                                            </div>
                                            </div>
                                        </div>
                                        <div class="col-md-5 d2_sob">
                                            <div class="form-group row">
                                            <label for="tocc" class="col-sm-4 col-form-label">Alamat</label>
                                            <div class="col-sm-8 mt-2 ">
                                                <span id="d2_alamat">: <?= $data_sob['alamat'] ?></span>
                                            </div>
                                            </div>
                                        </div>
                                    </div><br>
                                    <h4>Type of Business</h4><hr>
                                    <div class="d-flex justify-content-center">
                                    <div class="col-md-5">
                                        <div class="form-group row">
                                        <label for="no_klaim" class="col-sm-4 col-form-label">Class of Business</label>
                                        <div class="col-sm-8 mt-2">
                                            <span>: <?= $tr_sppa['cob'] ?></span>
                                        </div>
                                        </div>
                                    </div>
                                    <div class="col-md-5 c_lob">
                                        <div class="form-group row">
                                        <label for="no_klaim" class="col-sm-4 col-form-label">Line of Business</label>
                                        <div class="col-sm-8 mt-2">
                                            <span>: <?= $tr_sppa['lob'] ?></span>
                                        </div>
                                        </div>
                                    </div>
                                    
                                    </div>
                                    </div>
                                    </form>
                                </div>
                                <div class="tab-pane p-3" id="t_detail" role="tabpanel">
                                    <h4>Class of Business</h4><hr>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="card">
                                                <div class="card-body">
                                                    <table class="mt-3 table table-bordered table-hover dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;" id="tabel_list_tertanggung" width="100%" cellspacing="0">
                                                        <thead class="thead-light text-center">
                                                            <tr>
                                                                <th width="10%">No</th>
                                                                <?php foreach ($list_field as $f): ?>
                                                                    <th><?= $f['field_sppa'] ?></th>
                                                                <?php endforeach; ?>
                                                            </tr>
                                                        </thead>
                                                        <tbody>

                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane p-3" id="t_dok" role="tabpanel">
                                    <input type="hidden" id="id_sppa_dok" value="<?= $id_sppa ?>">
                                    <table class="mt-3 table table-bordered table-hover dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;" id="tabel_dok" width="100%" cellspacing="0">
                                        <thead class="thead-light text-center">
                                            <tr>
                                                <th width="5%">No</th>
                                                <th>Description</th>
                                                <th>Filename</th>
                                                <th>Size</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                        </tbody>
                                    </table>
                                </div>
                                <div class="tab-pane p-3" id="t_premi" role="tabpanel">
                                    <form action="" id="form_premi1">
                                        <input type="hidden" class="id_sppa" name="id_sppa" id="id_sppa_premi" >
                                        <h4>Premium and Payment</h4>
                                        <ul class="nav nav-tabs d-flex justify-content-center mt-2" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link active" data-toggle="tab" href="#total_premium" role="tab">
                                            <span class="d-none d-md-block">Total Premium</span><span class="d-block d-md-none"><i class="mdi mdi-home-variant h5"></i></span>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" data-toggle="tab" href="#termin_bayar" role="tab">
                                            <span class="d-none d-md-block">Termin Pembayaran</span><span class="d-block d-md-none"><i class="mdi mdi-account h5"></i></span>
                                            </a>
                                        </li>
                                        </ul>

                                        <div class="tab-content">
                                        <div class="tab-pane active p-3" id="total_premium" role="tabpanel">
                                            <h4>Sum Insured and Premium</h4><hr>
                                            <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label for="no_klaim" class="col-sm-4 col-form-label">Total Sum Insured</label>
                                                    
                                                    <div class="col-sm-8 text-left mt-2">
                                                        <span>: <?= number_format($tr_sppa['total_sum_insured'],0,',','.') ?></span>
                                                    </div>
                                                </div> 
                                                
                                                <div class="form-group row">
                                                    <label for="no_klaim" class="col-sm-4 col-form-label">Discount</label>
                                                    
                                                    <div class="col-sm-8 text-left mt-2">
                                                        <span>: <?= $tr_sppa['diskon'] ?>%</span>
                                                    </div>
                                                </div> 
                                                
                                            </div>
                                            <div class="col-md-6" id="show_premi">
                                                <?php foreach ($premi as $p): ?>
                                                    <div class='form-group row'>
                                                        <label for='no_klaim' class='col-sm-4 col-form-label'>Premi <?= ucwords($p['status'])." ".$p['label'] ?></label>
                                                        <div class='col-sm-4 mt-2 text-right'>
                                                            <span><?= $p['rate'] ?></span>
                                                        </div>
                                                        <div class='col-sm-4  mt-2 text-right'>
                                                            <span><?= number_format($p['nominal'],0,',','.') ?></span>
                                                        </div>
                                                    </div>
                                                <?php endforeach; ?>
                                            </div>
                                        </div><hr>
                                        
                                        <div class="mt-3">
                                            <?php foreach ($premi_adt as $pa): ?>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group row">
                                                            <label for="no_klaim" class="col-sm-4 col-form-label">LOB Lainnya</label>
                                                            <div class='col-sm-8 mt-2'>
                                                                <span>: <?= $pa['lob'] ?></span>
                                                            </div>
                                                        </div>    
                                                        <div class="form-group row">
                                                            <label for="no_klaim" class="col-sm-4 col-form-label">Kalkulasi Sum Insurance</label>
                                                            <div class='col-sm-8 mt-2'>
                                                                <span>: <?= number_format($pa['kalkulasi_tsi'],0,',','.') ?></span>
                                                            </div>
                                                        </div>    
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group row">
                                                            <label for="no_klaim" class="col-sm-4 col-form-label">Persentase Pengali TSI</label>
                                                            <div class='col-sm-8 mt-2'>
                                                                <span>: <?= $pa['pengali_tsi'] ?></span>
                                                            </div>
                                                        </div>  
                                                        <div class="form-group row">
                                                            <label for="no_klaim" class="col-sm-4 col-form-label">Premi</label>
                                                            <div class='col-sm-4 mt-2 text-right'>
                                                                <span><?= $pa['rate'] ?></span>
                                                            </div>
                                                            <div class='col-sm-4 mt-2 text-right'>
                                                                <span><?= number_format($pa['nominal'],0,',','.') ?></span>
                                                            </div>
                                                        </div> 
                                                    </div>
                                                </div>
                                            <?php endforeach; ?>
                                        </div>
                                        
                                        <h4>Total</h4><hr>
                                        <div class="row">
                                            <div class="col-md-6">
                                                
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label for="no_klaim" class="col-sm-4 col-form-label">Total Akhir Premi</label>
                                                    <div class='col-sm-4 mt-2 text-right'>
                                                        <span><?= $tr_sppa['total_rate_akhir_premi'] ?></span>
                                                    </div>
                                                    <div class="col-sm-4 mt-2 text-right">
                                                        <span><?= number_format($tr_sppa['total_akhir_premi'],0,',','.') ?></span>
                                                    </div>
                                                </div> 
                                                <div class="form-group row">
                                                    <label for="no_klaim" class="col-sm-4 col-form-label">Biaya Admin</label>
                                                    <div class="col-sm-8 mt-2 text-right">
                                                        <span><?= number_format($tr_sppa['biaya_admin'],0,',','.') ?></span>
                                                    </div>
                                                </div> <hr>
                                                <div class="form-group row">
                                                    <label for="no_klaim" class="col-sm-4 col-form-label">Total Tagihan</label>
                                                    <div class="col-sm-8 mt-2 text-right">
                                                        <span><?= number_format($tr_sppa['total_tagihan'],0,',','.') ?></span>
                                                    </div>
                                                </div>

                                            </div>
                                            
                                        </div>
                                        <h4>Payment Method</h4><hr>
                                        <div class="row">
                                            <div class="col-md-5">
                                                <div class="form-group row">
                                                    <label for="no_klaim" class="col-sm-4 col-form-label">Paymnet Method</label>
                                                    <div class="col-sm-8 mt-2 text-left">
                                                        <span>: <?= $tr_sppa['payment_method'] ?></span>
                                                    </div>
                                                </div> 
                                                
                                            </div>
                                            <div class="col-md-3 f_pay">
                                                <div class="form-group row">
                                                    <label for="no_klaim" class="col-sm-4 col-form-label">Tahun</label>
                                                    <div class="col-sm-7 mt-2 text-left">
                                                        <span>: <?= $tr_sppa['tahun_cicilan'] ?></span>
                                                    </div>
                                                </div> 
                                            </div>
                                            <div class="col-md-4 f_pay">
                                                <div class="form-group row">
                                                    <label for="no_klaim" class="col-sm-4 col-form-label">Jumlah Cicilan</label>
                                                    <div class="col-sm-7 mt-2 text-left">
                                                        <span>: <?= $tr_sppa['jumlah_cicilan'] ?></span>
                                                    </div>
                                                </div> 
                                            </div>
                                            
                                        </div>
                                        
                                        </div>
                                        <input type="hidden" id="id_sppa_termin" value="<?= $id_sppa ?>">
                                        <div class="tab-pane p-3" id="termin_bayar" role="tabpanel">
                                            <table class="table table-bordered table-hover dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;" id="tabel_termin" width="100%" cellspacing="0">
                                            <thead class="thead-light text-center">
                                                <tr>
                                                    <th width="5%">No</th>
                                                    <th>No. Dokumen</th>
                                                    <th>Tanggal Bayar</th>
                                                    <th>Jumlah</th>
                                                    <th>Cara Bayar</th>
                                                    <th>Tanggal Terima</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            </tbody>
                                            </table>
                                        </div>
                                        </div>
                                        
                                    </form>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="card-body card_endors" style="display: none;">
                    
                </div>
            </div>
        </div>
        
    </div>
</div>

<input type="hidden" id="id_mop" value="<?= $id_mop ?>">
<input type="hidden" id="id_relasi" value="<?= $id_relasi ?>">
<input type="hidden" id="id_sppa" value="<?= $id_sppa ?>">

<script>
    $(document).ready(function () {

        // menampilkan tabel_list_tertanggung
        var tabel_list_tertanggung = $('#tabel_list_tertanggung').DataTable({
            "processing"        : true,
            "order"             : [],
            "ajax"              : {
                "url"   : "<?= base_url() ?>binding/tampil_tertanggung",
                "type"  : "POST",
                "data"  : function (data) {
                    data.id_mop     = $('#id_mop').val();
                    data.id_relasi  = $('#id_relasi').val();
                },
            },
            "columnDefs"        : [{
                "targets"   : [0],
                "orderable" : false
            }, {
                'targets'   : [0],
                'className' : 'text-center',
            }]
        })

        // menampilkan tabel_dok
        var tabel_dok = $('#tabel_dok').DataTable({
            "processing"        : true,
            "order"             : [],
            "ajax"              : {
                "url"   : "<?= base_url() ?>binding/tampil_dok",
                "type"  : "POST",
                "data"  : function (data) {
                    data.id_mop     = $('#id_mop').val();
                },
            },
            "columnDefs"        : [{
                "targets"   : [0,4],
                "orderable" : false
            }, {
                'targets'   : [0,3,4],
                'className' : 'text-center',
            }]
        })

        var tabel_termin = $('#tabel_termin').DataTable({
            "processing"        : true,
            "order"             : [],
            "ajax"              : {
                "url"   : "<?= base_url() ?>binding/tampil_data_termin_dek",
                "type"  : "POST",
                "data"  : function (data) {
                    data.id_mop     = $('#id_mop').val();
                },
            },
            "columnDefs"        : [{
                "targets"   : [0],
                "orderable" : false
            }, {
                'targets'   : [0],
                'className' : 'text-center',
            }],
            "bPaginate"     : false,
            "bLengthChange" : false,
            "bFilter"       : true,
            "bInfo"         : false,
            "bDestroy"      : true
        })

        // 21-06-2021
        $('#endorsment').on('click', function () {

            var id_mop = $('#id_mop').val();

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

            var form_client     = $('#form_client').serialize();

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
            formData.append('upload_excel', excelfile);

            var url;
            if (excelfile) {
                url = "<?= base_url() ?>binding/simpan_semua_deklarasi";
            } else {
                url = "<?= base_url() ?>binding/simpan_semua";
            }

            swal({
                title       : 'Konfirmasi',
                text        : 'Yakin akan simpan data',
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
                        url     : url,
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
                        data            : formData,
                        contentType     : false,
                        cache           : false,
                        processData     : false,
                        dataType        : "JSON",
                        success : function (data) {

                            swal({
                                title               : "Berhasil",
                                text                : 'Data berhasil di simpan',
                                type                : 'success',
                                showConfirmButton   : false,
                                timer               : 3000,
                                allowOutsideClick   : false
                            });

                            location.href = "<?= base_url('binding/lihat/dekl') ?>";
                            
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

        // 22-06-2021
        $('#cancel').on('click', function () {

            var id_mop  = $('#id_mop').val();

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
                reverseButtons      : true
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
                                }
                            })
                        },
                        data    : {id_mop:id_mop},
                        dataType: "JSON",
                        success : function (data) {

                            swal({
                                title               : "Berhasil",
                                text                : 'Data berhasil di simpan',
                                type                : 'success',
                                showConfirmButton   : false,
                                timer               : 3000,
                                allowOutsideClick   : false
                            });

                            location.href = "<?= base_url('binding/lihat/dekl') ?>";


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
        
    });
</script>