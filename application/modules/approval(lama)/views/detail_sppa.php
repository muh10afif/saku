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

<div class="row">

    <div class="col-md-12">

        <div class="card shadow">
            
            <div class="card-header mb-0">
                <div class="row">
                    <div class="col-md-4 mt-3">
                        
                    </div>
                    <div class="col-md-8">
                        <a href="<?= base_url() ?>approval"><button class="btn btn-primary float-right"><i class="fas fa-arrow-left mr-2"></i>Kembali</button></a>
                    </div>
                </div>
            </div>

            <div class="card-body table-responsive">

                <div class="row mb-2">
                    <div class="col-md-12 text-center">
                        <h5>SPPA Number : <samp><mark id="sppa_number"> <?= $sppa_number ?> </mark></samp></h5>
                    </div>
                </div>

                <div class="row">

                    <div class="col-md-12">

                        <ul class="nav nav-tabs d-flex justify-content-center mt-2" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" href="#t_client_data" role="tab">
                            <span class="d-none d-md-block">Client Data</span><span class="d-block d-md-none"><i class="mdi mdi-home-variant h5"></i></span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link link_approval link_detail" data-toggle="tab" href="#t_detail" role="tab">
                            <span class="d-none d-md-block">Detail Insured</span><span class="d-block d-md-none"><i class="mdi mdi-account h5"></i></span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link link_approval link_dok" data-toggle="tab" href="#t_dok" role="tab">
                            <span class="d-none d-md-block">Documents</span><span class="d-block d-md-none"><i class="mdi mdi-email h5"></i></span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link link_approval link_premi" data-toggle="tab" href="#t_premi" role="tab">
                            <span class="d-none d-md-block">Premium Calculation</span><span class="d-block d-md-none"><i class="mdi mdi-settings h5"></i></span>
                            </a>
                        </li>

                            <?php
                            if ($aksi == 'tambah') {
                                $href = '#t_released';
                            } elseif ($aksi == 'detail') {
                                $href = '#t_detail_2';
                            } else {
                                $href = '#t_edit';
                            }
                            ?>
                        
                            <li class="nav-item">
                                <a class="nav-link link_approval link_released" data-toggle="tab" href="<?= $href ?>" role="tab">
                                <span class="d-none d-md-block">Approval</span><span class="d-block d-md-none"><i class="mdi mdi-settings h5"></i></span>
                                </a>
                            </li>

                        </ul>
                        
                        <!-- Tab panes -->
                        <div class="tab-content">
                        <div class="tab-pane active p-3" id="t_client_data" role="tabpanel">
                            <form action="#" id="form_client">
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
                                        <span id="d2_telp">: <?= $data_sob['telp'] ?></span>
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
                            <form action="#" id="form_detail">
                                <input type="hidden" class="id_sppa" name="id_sppa" >
                                <input type="hidden" class="id_lob" name="id_lob" value="2">
                                <h4>Class of Business</h4><hr>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="card">
                                        <div class="card-body">
                                            <div class="d-flex justify-content-center">
                                                <div class="col-md-8" id="here">
                                                    <?php foreach ($detail_lob as $d):  $name = str_replace(" ","_", strtolower($d['field_sppa'])); 
                                                    
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
                        <div class="tab-pane p-3" id="t_dok" role="tabpanel">
                            
                            <table class="mt-3 table table-bordered table-hover dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;" id="tabel_dok" width="100%" cellspacing="0">
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
                        <div class="tab-pane p-3" id="t_premi" role="tabpanel">
                            <form action="" id="form_premi">
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
                                    <input type="hidden" id="kondisi_diskon">
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
                                
                                <div id="show_additional" class="mt-3">
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
                                <div class="tab-pane p-3" id="termin_bayar" role="tabpanel">
                                    <?php if ($aksi == 'detail') : ?>
                                        <button type="button" class="btn btn-primary float-left ml-3" id="tambah_pembayaran">Tambah Pembayaran</button>
                                    <?php endif; ?>
                                    <table class="table table-bordered table-hover dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;" id="tabel_termin" width="100%" cellspacing="0">
                                    <thead class="thead-light text-center">
                                        <tr>
                                            <th width="5%">No</th>
                                            <th>No. Dokumen</th>
                                            <th>Tanggal Bayar</th>
                                            <th>Jumlah</th>
                                            <th>Cara Bayar</th>
                                            <th>Tanggal Terima</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                    </table>
                                </div>
                                </div>
                                
                            </form>
                        </div>
                        <div class="tab-pane p-3" id="t_released" role="tabpanel">
                            <h4>Otorisasi</h4><hr>
                            <form action="" id="form_approval">
                                <input type="hidden" class="id_sppa" name="id_sppa">
                                <input type="hidden" class="aksi" name="aksi" value="Tambah">
                            <div class="d-flex justify-content-center">
                                <div class="col-md-10">
                                    <div class="form-group row">
                                        <label for="no_klaim" class="col-sm-4 col-form-label">Insurance Company</label>
                                        <div class="col-sm-8">
                                            <select name="id_insurer" id="id_insurer" class="select2">
                                                <option value="">Pilih</option>
                                                <?php foreach ($insurer as $r): ?>
                                                    <option value="<?= $r['id_asuransi'] ?>"><?= $r['nama_asuransi'] ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div> 
                                    <div class="form-group row">
                                        <label for="no_klaim" class="col-sm-4 col-form-label">Nomor Otorisasi/Polis</label>
                                        <div class="col-sm-8 input-group">
                                            <input type="text" class="form-control" name="no_otorisasi_polis" id="no_otorisasi_polis" value="<?= $no_polis ?>" readonly>
                                        </div>
                                    </div> 
                                    <div class="form-group row">
                                        <label for="no_klaim" class="col-sm-4 col-form-label">Tanggal Otorisasi/Polis</label>
                                        <div class="col-sm-8 input-group">
                                            <input type="text" class="form-control datepicker" name="tgl_otorisasi" placeholder="Pilih Tanggal" readonly>
                                        </div>
                                    </div> 
                                    <div class="form-group row">
                                        <label for="no_klaim" class="col-sm-4 col-form-label">Disetujui Oleh</label>
                                        <div class="col-sm-8 input-group">
                                            <select name="id_karyawan" id="id_karyawan" class="select2">
                                                <option value="">Pilih</option>
                                                <?php foreach ($karyawan as $k): ?>
                                                    <option value="<?= $k['id_karyawan'] ?>"><?= $k['nama_karyawan'] ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div> 
                                    <div class="form-group row">
                                        <label for="no_klaim" class="col-sm-4 col-form-label">Keterangan Tambahan</label>
                                        <div class="col-sm-8 input-group">
                                            <textarea cols="5" class="form-control" name="keterangan_tambahan" placeholder="Keterangan Tambahan"></textarea>
                                        </div>
                                    </div> 
                                    
                                </div>
                            </div>
                            <hr>
                            <div class="form-group row float-right mb-0">
                                <button type="button" class="btn btn-primary mr-2" id="simpan_approval"><i class="ti-check-box mr-2"></i>Simpan</button>
                            </div>
                            </form>
                        </div>
                        <div class="tab-pane p-3" id="t_edit" role="tabpanel">
                            <h4>Otorisasi</h4><hr>
                            <form action="" id="form_approval_edit">
                                <input type="hidden" name="id_approve_sppa" value="<?= $dt_approve['id_approve_sppa'] ?>">
                                <input type="hidden" class="aksi" name="aksi" value="Ubah">
                                <input type="hidden" class="id_sppa" name="id_sppa"">
                            <div class="d-flex justify-content-center">
                                <div class="col-md-10">
                                    <div class="form-group row">
                                        <label for="no_klaim" class="col-sm-4 col-form-label">Insurance Company</label>
                                        <div class="col-sm-8">
                                            <select name="id_insurer" id="id_insurer_edit" class="select2">
                                                <option value="">Pilih</option>
                                                <?php foreach ($insurer as $r): ?>
                                                    <option value="<?= $r['id_asuransi'] ?>" <?= ($r['id_asuransi'] == $dt_approve['id_asuransi']) ? 'selected' : '' ?>><?= $r['nama_asuransi'] ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div> 
                                    <div class="form-group row">
                                        <label for="no_klaim" class="col-sm-4 col-form-label">Nomor Otorisasi/Polis</label>
                                        <div class="col-sm-8 input-group">
                                            <input type="text" class="form-control" name="no_otorisasi_polis" id="no_otorisasi_polis_edit" value="<?= $dt_approve['no_otorisasi_polis'] ?>" readonly>
                                        </div>
                                    </div> 
                                    <div class="form-group row">
                                        <label for="no_klaim" class="col-sm-4 col-form-label">Tanggal Otorisasi/Polis</label>
                                        <div class="col-sm-8 input-group">
                                            <input type="text" class="form-control datepicker" name="tgl_otorisasi" placeholder="Pilih Tanggal" value="<?= date("d-m-Y", strtotime($dt_approve['tgl_otorisasi'])) ?>" readonly>
                                        </div>
                                    </div> 
                                    <div class="form-group row">
                                        <label for="no_klaim" class="col-sm-4 col-form-label">Disetujui Oleh</label>
                                        <div class="col-sm-8 input-group">
                                            <select name="id_karyawan" id="id_karyawan_edit" class="select2">
                                                <option value="">Pilih</option>
                                                <?php foreach ($karyawan as $k): ?>
                                                    <option value="<?= $k['id_karyawan'] ?>" <?= ($k['id_karyawan'] == $dt_approve['id_pegawai']) ? 'selected' : '' ?>><?= $k['nama_karyawan'] ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div> 
                                    <div class="form-group row">
                                        <label for="no_klaim" class="col-sm-4 col-form-label">Keterangan Tambahan</label>
                                        <div class="col-sm-8 input-group">
                                            <textarea cols="5" class="form-control" name="keterangan_tambahan" placeholder="Keterangan Tambahan"><?= $dt_approve['keterangan_tambahan'] ?></textarea>
                                        </div>
                                    </div> 
                                    
                                </div>
                            </div>
                            <hr>
                            <div class="form-group row float-right mb-0">
                                <button type="button" class="btn btn-primary mr-2" id="simpan_approval_edit"><i class="ti-check-box mr-2"></i>Simpan</button>
                            </div>
                            </form>
                        </div>
                        <div class="tab-pane p-3" id="t_detail_2" role="tabpanel">
                            <h4>Otorisasi</h4><hr>
                            <form action="" id="">
                                <input type="hidden" class="id_sppa" name="id_sppa" value="<?= $id_sppa ?>">
                                <input type="hidden" class="aksi" name="aksi" value="Edit">
                            <div class="d-flex justify-content-center">
                                <div class="col-md-10">
                                    <div class="form-group row">
                                        <label for="no_klaim" class="col-sm-4 col-form-label">Insurance Company</label>
                                        <div class="col-sm-8 mt-2">
                                            : <?= $dt_approve['nama_asuransi'] ?>
                                        </div>
                                    </div> 
                                    <div class="form-group row">
                                        <label for="no_klaim" class="col-sm-4 col-form-label">Nomor Otorisasi/Polis</label>
                                        <div class="col-sm-8 mt-2">
                                            : <?= $dt_approve['no_otorisasi_polis'] ?>
                                        </div>
                                    </div> 
                                    <div class="form-group row">
                                        <label for="no_klaim" class="col-sm-4 col-form-label">Tanggal Otorisasi/Polis</label>
                                        <div class="col-sm-8 mt-2">
                                            : <?= date("d-m-Y", strtotime($dt_approve['tgl_otorisasi'])) ?>
                                        </div>
                                    </div> 
                                    <div class="form-group row">
                                        <label for="no_klaim" class="col-sm-4 col-form-label">Disetujui Oleh</label>
                                        <div class="col-sm-8 mt-2">
                                            : <?= $dt_approve['nama_karyawan'] ?>
                                        </div>
                                    </div> 
                                    <div class="form-group row">
                                        <label for="no_klaim" class="col-sm-4 col-form-label">Keterangan Tambahan</label>
                                        <div class="col-sm-8 mt-2">
                                            : <?= $dt_approve['keterangan_tambahan'] ?>
                                        </div>
                                    </div> 
                                    
                                </div>
                            </div>
                            </form>
                        </div>
                        </div>

                    </div>

                </div>
                        
            </div>
        </div>

    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="modal_termin" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header bg-primary text-white">
        <h5 class="modal-title mt-0" id="judul_modal">Tambah Data</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true" class="text-white">&times;</span>
        </button>
      </div>
        <form id="form_termin_m1" autocomplete="off" class="form-control-line">
            <input type="hidden" name="id_termin" id="id_termin">
            <input type="hidden" name="aksi" id="aksi_termin" value="Tambah">
            <input type="hidden" class="id_sppa" name="id_sppa" value="<?= $id_sppa ?>">  
            <input type="hidden" class="sppa_number" name="sppa_number" value="<?= $tr_sppa['sppa_number'] ?>">  
            <div class="modal-body">
            <div class="col-md-12 p-3">
                    <div class="form-group row">
                        <label for="tgl_awal" class="col-sm-3 col-form-label">No Dokumen<span class="text-danger">*</span></label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="no_dokumen" id="no_dokumen" placeholder="Masukkan No Dokumen" required data-parsley-required-message="No Dokumen harus terisi.">
                        </div>
                    </div>  
                    <div class="form-group row">
                        <label for="tgl_awal" class="col-sm-3 col-form-label">Tanggal Bayar<span class="text-danger">*</span></label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control datepicker" name="tgl_bayar" id="tgl_bayar" placeholder="Masukkan Tanggal Bayar" readonly required data-parsley-required-message="Tanggal Bayar harus terisi.">
                        </div>
                    </div>  
                    <div class="form-group row">
                        <label for="tgl_awal" class="col-sm-3 col-form-label">Jumlah<span class="text-danger">*</span></label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control numeric number_separator" name="jumlah" id="jumlah" placeholder="Masukkan Jumlah" required data-parsley-required-message="Jumlah harus terisi.">
                        </div>
                    </div>  
                    <div class="form-group row">
                        <label for="tgl_awal" class="col-sm-3 col-form-label">Cara Bayar<span class="text-danger">*</span></label>
                        <div class="col-sm-9">
                            <select name="cara_bayar" id="cara_bayar" class="form-control" required data-parsley-required-message="Cara Bayar harus terisi.">
                            <option value="">Pilih</option>
                            <option value="cash">Cash</option>
                            <option value="transfer">Transfer</option>
                            </select>
                        </div>
                    </div>  
                    <div class="form-group row">
                        <label for="tgl_akhir" class="col-sm-3 col-form-label">Tanggal Terima<span class="text-danger">*</span></label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control datepicker" name="tgl_terima" id="tgl_terima" placeholder="Masukkan Tanggal Akhir" readonly required data-parsley-required-message="Tanggal Terima harus terisi.">
                        </div>
                    </div> 
                    
                    <span class="font-italic text-danger">*Data harus terisi.</span>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary" id="simpan_termin"><i class="fas fa-check mr-2"></i>Simpan</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fas fa-ban mr-2"></i>Batal</button>
            </div>
        </form>
    </div>
  </div>
</div>


<script>

    $(document).ready(function () {

        // menampilkan tabel dok
        var tabel_dok = $('#tabel_dok').DataTable({
            "processing"        : true,
            "order"             : [],
            "ajax"              : {
                "url"   : "<?= base_url() ?>approval/tampil_data_dokumen",
                "type"  : "POST",
                "data"  : function (data) {
                    data.id_sppa    = "<?= $id_sppa ?>";
                },
            },
            "columnDefs"        : [{
                "targets"   : [0,5],
                "orderable" : false
            }, {
                'targets'   : [0,4,5],
                'className' : 'text-center',
            }]
        })

        // 16-05-2021
        var tabel_termin = $('#tabel_termin').DataTable({
            "processing"        : true,
            "order"             : [],
            "ajax"              : {
                "url"   : "<?= base_url() ?>approval/tampil_data_termin",
                "type"  : "POST",
                "data"  : function (data) {
                    data.id_sppa    = "<?= $id_sppa ?>";
                },
            },
            "columnDefs"        : [{
                "targets"   : [0,6],
                "orderable" : false
            }, {
                'targets'   : [0,6],
                'className' : 'text-center',
            }],
            "bPaginate"     : false,
            "bLengthChange" : false,
            "bFilter"       : true,
            "bInfo"         : false
        })

        $('.datepicker').datepicker({
            autoclose: true,
            todayHighlight: false,
            format: "dd-mm-yyyy",
            clearBtn: true,
            orientation: 'bottom'
        });

        $('.select2').select2({
            theme       : 'bootstrap4',
            width       : 'style',
            placeholder : $(this).attr('placeholder'),
            allowClear  : false
        });

        $('.numeric').numericOnly();

        $('.number_separator').divide({
            delimiter:'.',
            divideThousand: true, // 1,000..9,999
            delimiterRegExp: /[\.\,\s]/g
        });

        $('#tambah_pembayaran').on('click', function () {

            $('#modal_termin').modal('show');

            $('#form_termin_m1').trigger("reset");

            $("#form_termin_m1").parsley().reset();

            $('#aksi_termin').val('Tambah');

        })

        $('#form_termin_m1').parsley({
            triggerAfterFailure: 'input change'
        });

        // aksi simpan data termin
        $('#form_termin_m1').on('submit', function () {

            var form_termin = $('#form_termin_m1').serialize();
           
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
                        url     : "<?= base_url() ?>entry_sppa/simpan_data_termin",
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
                        data    : form_termin,
                        dataType: "JSON",
                        success : function (data) {

                            $('#modal_termin').modal('hide');
                            
                            swal({
                                title               : "Berhasil",
                                text                : 'Data berhasil disimpan',
                                buttonsStyling      : false,
                                confirmButtonClass  : "btn btn-success",
                                type                : 'success',
                                showConfirmButton   : false,
                                timer               : 1000
                            });    
            
                            tabel_termin.ajax.reload(null,false);        
                            
                            $('#form_termin1').trigger("reset");
            
                            $('#aksi_termin').val('Tambah');
                        },
                        error: function (jqXHR, textStatus, errorThrown)
                        {
                            swal({
                                title               : "Gagal",
                                text                : 'Gagal menampilkan data',
                                type                : 'error',
                                showConfirmButton   : false,
                                timer               : 1000
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
                        timer               : 1000
                    }); 
                }
            })

            return false;

        })

        // edit data termin
    $('#tabel_termin').on('click', '.edit', function () {

        var id_termin  = $(this).data('id');

        $.ajax({
            url         : "<?= base_url() ?>entry_sppa/ambil_data_termin/"+id_termin,
            type        : "GET",
            beforeSend  : function () {
                swal({
                    title   : 'Menunggu',
                    html    : 'Memproses Data',
                    onOpen  : () => {
                        swal.showLoading();
                    }
                })
            },
            dataType    : "JSON",
            success     : function(data)
            {
                swal.close();

                $('#modal_termin').modal('show');
                
                $('#id_termin').val(data.id_termin_pembayaran);

                // $("#tgl_bayar").datepicker("setDate", data.tgl_bayar);
                // $("#tgl_terima").datepicker("setDate", data.tgl_terima);

                
                var myDateVal = moment(data.tgl_bayar).format('DD-MM-YYYY');
                $('#tgl_bayar').datepicker('setDate', myDateVal);    
                var myDateVal2 = moment(data.tgl_terima).format('DD-MM-YYYY');
                $('#tgl_terima').datepicker('setDate', myDateVal2);    
                                    
                $('#no_dokumen').val(data.no_dokumen);
                $('#cara_bayar').val(data.cara_bayar);
                $('#jumlah').val(data.jumlah);

                $('#aksi_termin').val('Ubah');

                return false;

            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                swal({
                    title               : "Gagal",
                    text                : 'Gagal menampilkan data',
                    type                : 'error',
                    showConfirmButton   : false,
                    timer               : 1000
                }); 

                return false;
            }
        })

        return false;

    })

    // hapus termin
    $('#tabel_termin').on('click', '.hapus', function () {
        
        var id_termin   = $(this).data('id');
        swal({
            title       : 'Konfirmasi',
            text        : 'Yakin akan hapus termin ?',
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
                    url         : "<?= base_url() ?>entry_sppa/simpan_data_termin",
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
                    data        : {aksi:'Hapus', id_termin:id_termin},
                    dataType    : "JSON",
                    success     : function (data) {

                            tabel_termin.ajax.reload(null,false);   

                            swal({
                                title               : 'Hapus termin',
                                text                : 'Data Berhasil Dihapus',
                                buttonsStyling      : false,
                                confirmButtonClass  : "btn btn-success",
                                type                : 'success',
                                showConfirmButton   : false,
                                timer               : 1000
                            }); 

                                
                            
                            $('#form_termin').trigger("reset");

                            $('#aksi_termin').val('Tambah');
                        
                    },
                    error: function (jqXHR, textStatus, errorThrown)
                    {
                        swal({
                            title               : "Gagal",
                            text                : 'Gagal menampilkan data',
                            type                : 'error',
                            showConfirmButton   : false,
                            timer               : 1000
                        }); 

                        return false;
                    }

                })

                return false;
            } else if (result.dismiss === swal.DismissReason.cancel) {

                swal({
                        title               : 'Batal',
                        text                : 'Anda membatalkan hapus termin',
                        buttonsStyling      : false,
                        confirmButtonClass  : "btn btn-primary",
                        type                : 'error',
                        showConfirmButton   : false,
                        timer               : 1000
                    }); 
            }
        })

    })
        
})
    
</script>