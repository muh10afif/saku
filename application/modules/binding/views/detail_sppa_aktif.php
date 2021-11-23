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
                   
                    <button type="button" class="btn btn-danger" id="batal" style="display: none;"><i class="mdi mdi-close-circle mr-2"></i>Batal</button>

                    <a href="<?= base_url('binding/list_sppa_aktif/'.$id_mop) ?>"><button class="btn btn-primary float-right" id="kembali"><i class="fas fa-arrow-left mr-2"></i>Kembali</button></a>
                </div>
                <div class="card-body card_awal">

                    <div class="row mb-2">
                        <div class="col-md-12 text-center">
                            <h5>SPPA Number : <samp><mark id="sppa_number"> <?= $tr_sppa['sppa_number'] ?> </mark></samp></h5>
                        </div>
                    </div>
                        
                    <div class="row">
                        
                        <div class="col-md-12">

                            <ul class="nav nav-tabs d-flex justify-content-center mt-2" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="tab" href="#t_client_data1" role="tab">
                                <span class="d-none d-md-block">Client Data</span><span class="d-block d-md-none"><i class="mdi mdi-home-variant h5"></i></span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link link_entry link_detail" data-toggle="tab" href="#t_detail1" role="tab">
                                <span class="d-none d-md-block">Detail Insured</span><span class="d-block d-md-none"><i class="mdi mdi-account h5"></i></span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link link_entry link_dok" data-toggle="tab" href="#t_dok1" role="tab">
                                <span class="d-none d-md-block">Documents</span><span class="d-block d-md-none"><i class="mdi mdi-email h5"></i></span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link link_entry link_premi" data-toggle="tab" href="#t_premi1" role="tab">
                                <span class="d-none d-md-block">Premium Calculation</span><span class="d-block d-md-none"><i class="mdi mdi-settings h5"></i></span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link link_entry link_released" data-toggle="tab" href="#t_invoice1" role="tab">
                                <span class="d-none d-md-block">Debit Note</span><span class="d-block d-md-none"><i class="mdi mdi-settings h5"></i></span>
                                </a>
                            </li>
                        </ul>

                        <!-- Tab panes -->
                        <div class="tab-content">
                            <div class="tab-pane active p-3" id="t_client_data1" role="tabpanel">
                                <form action="#" id="form_client">
                                <input type="hidden" class="sppa_number_d" name="sppa_number" value="<?= $tr_sppa['sppa_number'] ?>">
                                <input type="hidden" class="id_sppa" name="id_sppa">
                                <input type="hidden" class="nama_sob" name="nama_sob">

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
                                        <label for="sobb" class="col-sm-4 col-form-label">Nama</label>
                                        <div class="col-sm-8 mt-2 ">
                                            <span id="d2_nama">: <?= $data_sob['nama'] ?></span>
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
                            <div class="tab-pane p-3" id="t_detail1" role="tabpanel">
                                <form action="#" id="form_detaill">
                                    <input type="hidden" class="id_sppa" name="id_sppa" >
                                    <input type="hidden" class="id_lob" name="id_lob" value="2">
                                    <h4>Class of Business</h4><hr>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="card">
                                            <div class="card-body">
                                                <div class="d-flex justify-content-center">
                                                    <div class="col-md-8">
                                                        <?php foreach ($detail_lob as $d): $name = str_replace(" ","_", strtolower($d['field_sppa'])); 

                                                                if ($d['cdb'] == 't') {

                                                                    if ($d['input_type'] == 'C') {
                                                                        $is = date("d-m-Y", strtotime($nasabah_ptg[$name]));
                                                                    } elseif ($d['input_type'] == 'N' && $d['sparator_number'] == 'Y') {
                                                                        $is = number_format($nasabah_ptg[$name],0,'.','.');
                                                                    } else {
                                                                    $is = $nasabah_ptg[$name]; 
                                                                    }
                                                                    
                                                                } else {

                                                                    if ($d['input_type'] == 'C') {
                                                                        $is = date("d-m-Y", strtotime($tr_sppa[$name]));
                                                                    } elseif ($d['input_type'] == 'N' && $d['sparator_number'] == 'Y') {
                                                                        $is = number_format($tr_sppa[$name],0,'.','.');
                                                                    } else {
                                                                    $is = $tr_sppa[$name]; 
                                                                    }
                                                                    
                                                                }
                                                        
                                                        ?>
                                                            <div class="form-group row">
                                                                <label for="no_klaim" class="col-sm-4 col-form-label"><?= ucwords($d['field_sppa']) ?></label>
                                                                <div class="col-sm-8 mt-2">
                                                                    <span>: <?= str_replace(array("<p>","</p>"), "", $is) ?></span>
                                                                </div>
                                                            </div>
                                                        <?php endforeach; ?>
                                                    </div>
                                                </div>
                                            </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="tab-pane p-3" id="t_dok1" role="tabpanel">
                                
                                <table class="mt-3 table table-bordered table-hover dt-responsive nowrap tabel_dok display" style="border-collapse: collapse; border-spacing: 0; width: 100% !important;" id="" width="100%" cellspacing="0">
                                    <thead class="thead-light text-center">
                                        <tr>
                                            <th width="5%">No</th>
                                            <th>Description</th>
                                            <th>Filename</th>
                                            <th>Size</th>
                                            <th>Last Updated</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                </table>
                            </div>
                            <div class="tab-pane p-3" id="t_premi1" role="tabpanel">
                                <form action="" id="form_premi">
                                    <input type="hidden" class="id_sppa" name="id_sppa" id="id_sppa_premi2" >
                                    <h4>Premium and Payment</h4>
                                    <ul class="nav nav-tabs d-flex justify-content-center mt-2" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" data-toggle="tab" href="#total_premium1" role="tab">
                                        <span class="d-none d-md-block">Total Premium</span><span class="d-block d-md-none"><i class="mdi mdi-home-variant h5"></i></span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-toggle="tab" href="#termin_bayar1" role="tab">
                                        <span class="d-none d-md-block">Termin Pembayaran</span><span class="d-block d-md-none"><i class="mdi mdi-account h5"></i></span>
                                        </a>
                                    </li>
                                    </ul>

                                    <div class="tab-content">
                                    <div class="tab-pane active p-3" id="total_premium1" role="tabpanel">
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
                                                    <span>: <?= ($tr_sppa['diskon'] == '') ? '0' : $tr_sppa['diskon'] ?>%</span>
                                                </div>
                                            </div> 

                                            <div class="form-group row">
                                                <div class="col-md-4"></div>
                                                <div class="col-md-8">
                                                    <p class="font-italic text-danger label_tipe_diskon">*Diskon terhadap <?= $st_diskon ?></p>
                                                </div>
                                            </div>
                                            
                                        </div>
                                        <div class="col-md-6">
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
                                                <label for="gross_premi" class="col-sm-4 col-form-label">Gross Premi</label>
                                                <div class='col-sm-4 mt-2 text-right'>
                                                    <span><?= $tr_sppa['total_rate_akhir_premi'] ?></span>
                                                </div>
                                                <div class="col-sm-4 mt-2 text-right">
                                                    <span><?= number_format($tr_sppa['gross_premi'],0,',','.') ?></span>
                                                </div>
                                            </div> 
                                            <div class="form-group row">
                                                <label for="total_diskon" class="col-sm-4 col-form-label">Total Diskon</label>
                                                <div class="col-sm-8 mb-3 mt-2 text-right">
                                                    <span><?= number_format($tr_sppa['total_diskon'],0,',','.') ?></span>
                                                </div>
                                            </div> 
                                            <hr>
                                            <div class="form-group row">
                                                <label for="no_klaim" class="col-sm-4 col-form-label">Total Akhir Premi</label>
                                                
                                                <div class="col-sm-8 mt-2 text-right">
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
                                    <input type="hidden" id="id_sppa_termin2" value="<?= ($id_sppa_dek == null) ? $id_sppa : $id_sppa_dek; ?>">
                                    <div class="tab-pane p-3" id="termin_bayar1" role="tabpanel">
                                        <!-- <button type="button" class="btn btn-primary float-left ml-3" id="tambah_pembayaran">Tambah Pembayaran</button> -->
                                        <table class="table table-bordered table-hover dt-responsive nowrap tabel_termin" style="border-collapse: collapse; border-spacing: 0; width: 100%;" id="" width="100%" cellspacing="0">
                                        <thead class="thead-light text-center">
                                            <tr>
                                                <th width="5%">No</th>
                                                <th>No. Dokumen</th>
                                                <th>Tanggal Bayar</th>
                                                <th>Jumlah</th>
                                                <th>Cara Bayar</th>
                                                <th>Tanggal Terima</th>
                                                <!-- <th>Aksi</th> -->
                                            </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                        </table>
                                    </div>
                                    </div>
                                    
                                </form>
                            </div>
                            <div class="tab-pane p-3" id="t_invoice1" role="tabpanel">
                                <input type="hidden" class="id_sppa" name="id_sppa_invoice" value="<?= $id_sppa ?>">
                                <div class="alert alert-primary mb-0 text-center" role="alert">
                                    <h4 class="alert-heading mt-2 font-18">Semua Data Berhasil Disimpan.</h4>
                                    <p>Silahkan tekan tombol cetak invoice.</p>
                                    <p>
                                        <a href="<?= base_url("entry_sppa/cetak_invoice/$id_sppa") ?>" target="_blank"><button type="submit" class="btn btn-warning text-dark">Cetak Invoice</button></a>
                                    </p>
                                </div>
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

<input type="hidden" id="aksi_endors" value="endors_dek">

<script>

    $(document).ready(function () {

        // menampilkan tabel dok
        var tabel_dok = $('.tabel_dok').DataTable({
            "processing"        : true,
            "order"             : [],
            "ajax"              : {
                "url"   : "<?= base_url() ?>entry_sppa/tampil_data_dokumen",
                "type"  : "POST",
                "data"  : function (data) {
                    data.id_sppa    = $('#id_sppa_dok2').val();
                    data.aksi       = '';
                },
            },
            "columnDefs"        : [{
                "targets"   : [0,5],
                "orderable" : false
            }, {
                'targets'   : [0,4,5],
                'className' : 'text-center',
            }],
            "bDestroy" : true,
            "bAutoWidth": false
        })

        // 16-05-2021
        var tabel_termin = $('.tabel_termin').DataTable({
            "processing"        : true,
            "order"             : [],
            "ajax"              : {
                "url"   : "<?= base_url() ?>entry_sppa/tampil_data_termin",
                "type"  : "POST",
                "data"  : function (data) {
                    data.id_sppa    = $('#id_sppa_termin2').val();
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
        
    })
    
</script>