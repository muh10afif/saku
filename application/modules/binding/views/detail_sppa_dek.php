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
        <div class="col-sm-4">
            <h4><?= $title ?></h4>
        </div>
        <div class="col-sm-8">
            <ol class="breadcrumb float-right">
                <li class="breadcrumb-item"><a href="<?= base_url() ?>">All COB</a></li>
                <li class="breadcrumb-item">Transaction</li>
                <li class="breadcrumb-item">Incoming</li>
                <?php if ($this->uri->segment(4) == 1): ?>
                    <li class="breadcrumb-item"><a href="<?= base_url('binding') ?>">Binding Slip</a></li>
                    <li class="breadcrumb-item active"><?= $title ?></li>
                <?php else: ?>
                    <li class="breadcrumb-item"><a href="<?= base_url('binding/lihat/dekl') ?>">Binding Slip</a></li>
                    <li class="breadcrumb-item active"><a href="<?= base_url('detail_binding/'.$id_mop) ?>">Detail Binding</a></li>
                    <li class="breadcrumb-item active"><a href="<?= base_url('binding/detail_list_sppa/'.$id_mop.'/'.$this->uri->segment(4)) ?>"><?= "Detail ".$this->uri->segment(4) ?></a></li>
                    <li class="breadcrumb-item active"><?= $title ?></li>
                <?php endif; ?>
                
            </ol>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="card shadow">
            <div class="card">
                <div class="card-header">
                    <!-- <?php if ($role['update'] == 'true' || $id_lvl_otorisasi == 0) : ?>
                        <?php if ($tr_sppa['cancelation'] == 'f' && $tr_sppa['status_aktif'] == 't'): ?>
                            
                                <button type="button" class="btn btn-primary mr-2" id="endorsment"><i class="mdi mdi-pencil-outline mr-2"></i>Endorsment</button>
                                <button type="button" class="btn btn-danger" id="cancel" id_sppa="<?= $id_sppa ?>" id_sppa_awal="<?= ($id_sppa_dek == null) ? $id_sppa : $id_sppa_dek; ?>" id_mop="<?= $id_mop ?>"><i class="mdi mdi-cancel mr-2"></i>Cancelation</button>

                        <?php endif; ?>
                    <?php endif; ?>
                    <button type="button" class="btn btn-danger" id="batal" style="display: none;"><i class="mdi mdi-close-circle mr-2"></i>Batal</button> -->

                    <?php if ($this->uri->segment(4) == 1): ?>
                        <a href="<?= base_url('binding') ?>"><button class="btn btn-primary float-right" id="kembali"><i class="fas fa-arrow-left mr-2"></i>Kembali</button></a>
                    <?php else: ?>
                        <a href="<?= base_url('binding/detail_list_sppa/'.$id_mop.'/'.$this->uri->segment(4)) ?>"><button class="btn btn-primary float-right" id="kembali"><i class="fas fa-arrow-left mr-2"></i>Kembali</button></a>
                    <?php endif; ?>

                    <button class="btn btn-primary float-right" id="simpan" style="display: none;"><i class="mdi mdi-check-bold mr-2"></i>Simpan</button>
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
                                
                                <form action="" id="form_dokumen" class="form_dokumen">
                                    <input type="hidden" id="aksi" name="aksi" value="Tambah">
                                    <input type="hidden" id="id_dokumen" name="id_dokumen">
                                    <input type="hidden" id="nama_dokumen" name="nama_dokumen">
                                    <input type="hidden" id="id_sppa_dok2" name="id_sppa" value="<?= ($id_sppa_dek == null) ? $id_sppa : $id_sppa_dek; ?>">
                                    <input type="hidden" class="sppa_number_dok" name="sppa_number_dok" id="sppa_number_dok" value="<?= $tr_sppa['sppa_number'] ?>">
                                    <div class="d-flex justify-content-center mb-1 mt-3">
                                        <div class="col-md-5">
                                        <div class="form-group row">
                                            <label for="no_klaim" class="col-sm-2 col-form-label text-left">File</label>
                                            <div class="col-sm-10">
                                            <input type="file" id="doc" class="form-control" accept="application/msword, application/pdf" name="dokumen">
                                            </div>
                                        </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group row">
                                            <label for="no_klaim" class="col-sm-3 col-form-label text-left">Deskripsi</label>
                                            <div class="col-sm-9">
                                                <input type="input" id="desc" class="form-control" name="desc" placeholder="Masukkan Deskripsi">
                                            </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group row p-0">
                                                <div class="col-sm-6">
                                                    <button type="button" class="btn btn-primary btn-block simpan_dok mr-2" id="">Simpan</button>
                                                </div>
                                                <div class="col-sm-6">
                                                    <button type="button" class="btn btn-secondary btn-block batal_dok">Batal</button>
                                                </div>
                                            </div>
                                            
                                        </div>
                                    </div>
                                </form>
                                <hr>
                                    
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
        <form id="form_termin_m" autocomplete="off" class="form-control-line">
            <input type="hidden" name="id_termin" id="id_termin">
            <input type="hidden" name="aksi" id="aksi_termin" value="Tambah">
            <input type="hidden" class="id_sppa" name="id_sppa" value="<?= ($id_sppa_dek == null) ? $id_sppa : $id_sppa_dek; ?>">
            <input type="hidden" id="sppa_number_termin" name="sppa_number_termin" value="<?= $tr_sppa['sppa_number'] ?>">
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

<input type="hidden" id="aksi_endors" value="endors_dek">

<script>

    $(document).ready(function () {

        $('#form_termin_m').parsley({
            triggerAfterFailure: 'input change'
        });

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

        // 28-06-2021
        $('#endorsment').on('click', function () {

            var id_sppa         = "<?= $id_sppa ?>";
            var aksi_endors     = $('#aksi_endors').val();

            $.ajax({
                url     : "<?= base_url('binding/tampil_detail_sppa/endorsment') ?>",
                method  : "POST",
                data    : {id_sppa:id_sppa, aksi_endors:aksi_endors},
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

        // 28-06-2021
        $('#batal').on('click', function () {

            $('.card_endors').html('');
            $('.card_endors').fadeOut(10);

            $('.card_awal').fadeIn(10);

            $('#endorsment').fadeIn(10);
            $('#cancel').fadeIn(10);
            $('#batal').fadeOut(10);
            $('#kembali').fadeIn(10);
            $('#simpan').fadeOut(10);

            tabel_dok.ajax.reload(null, false);
            tabel_termin.ajax.reload(null, false);

        })

        // 28-06-2021
        $('#simpan').on('click', function () {

            tinymce.triggerSave();

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

            var id_mop_en           = $('#id_mop_en').val();
            var nm_endorsment_en    = $('#nm_endorsment_en').val();
            var id_pengguna_ptg     = $('#id_pengguna_ptg').val();
            var id_sppa_premi       = $('#id_sppa_premi').val();
            var tsi                 = $('#tsi').val().split('.').join('');
            var diskon              = $('#diskon').val();
            var gross_premi         = $('#gross_premi').val().split('.').join('');
            var total_diskon        = $('#total_diskon').val();
            var total_persen_premi  = $('#total_persen_premi').val();
            var total_akhir_premi   = $('#total_akhir_premi').val().split('.').join('');
            var biaya_admin         = $('#biaya_admin').val().split('.').join('');
            var total_tagihan       = $('#total_tagihan').val().split('.').join('');
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

            var det                 = $('#form_detail').serializeArray();

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
                        url     : "<?= base_url() ?>binding/simpan_data_endorsment",
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
                            detail              : $('#form_detail').serializeArray(),
                            id_mop              : id_mop_en,
                            nm_endorsment       : nm_endorsment_en,
                            id_pengguna_ptg     : id_pengguna_ptg,
                            uri                 : "<?= $this->uri->segment(4) ?>"
                        },
                        dataType: "JSON",
                        success : function (data) {

                            // return false;

                            var uri = "<?= $this->uri->segment(4) ?>";

                            var url = "";
                            if (uri != '1') {
                                url = "<?= base_url('binding/detail_binding/'.$id_mop) ?>";
                            } else {
                                url = "<?= base_url('binding') ?>";
                            }

                            swal({
                                title               : "Berhasil",
                                text                : 'Data Berhasil Disimpan',
                                type                : 'success',
                                showConfirmButton   : false,
                                timer               : 2000,
                                allowOutsideClick   : false
                            }).then(function() {
                                location.href = url;
                            });
                            
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

        // 28-06-2021
        $('#cancel').on('click', function () {

            var id_sppa         = $(this).attr('id_sppa');
            var id_sppa_awal    = $(this).attr('id_sppa_awal');
            var id_mop          = $(this).attr('id_mop');

            console.log(id_mop);

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
                        url     : "<?= base_url('binding/ubah_cancelation_sppa') ?>",
                        method  : "POST",
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
                        data    : {id_sppa:id_sppa,id_sppa_awal:id_sppa_awal, id_mop:id_mop},
                        dataType: "JSON",
                        success : function (data) {

                            var uri = "<?= $this->uri->segment(4) ?>";

                            var url = "";
                            if (uri == '1') {
                                url = "<?= base_url('binding') ?>";
                            } else {
                                url = "<?= base_url('binding/detail_binding/'.$id_mop) ?>";
                            }

                            swal({
                                title               : "Berhasil",
                                text                : 'Data berhasil di simpan',
                                type                : 'success',
                                showConfirmButton   : false,
                                timer               : 2000,
                                allowOutsideClick   : false
                            }).then(function() {
                                location.href = url;
                            });

                            // location.href = "<?= base_url('binding/detail_binding/') ?>"+id_mop;


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

        // 28-06-2021
        // 10-05-2021

        $('.batal_dok').on('click', function () {

            $('#doc').val('');
            $('#desc').val('');
            $('.simpan_dok').text('Simpan');
            $('#aksi').val('Tambah');

        })
        $('.simpan_dok').on('click', function () {

            var form_data = new FormData($('.form_dokumen')[0]);

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
                $('.simpan_dok').text('Simpan');
                
                }
            });

        })


        $('.tabel_dok').on('click', '.edit', function () {

            var id_dokumen  = $(this).data('id');
            var desc        = $(this).attr('desc');
            var filename    = $(this).attr('filename');

            $('#id_dokumen').val(id_dokumen);
            $('#nama_dokumen').val(filename);
            $('#desc').val(desc);

            $('.simpan_dok').text('Ubah Dokumen');
            $('#aksi').val('Ubah');

        })

        // hapus dokumen
        $('.tabel_dok').on('click', '.hapus', function () {
            
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
                        error       : function(xhr, status, error) {
                            var err = eval("(" + xhr.responseText + ")");
                            alert(err.Message);
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

        // 28-06-2021
        $('#tambah_pembayaran').on('click', function () {

            $('#modal_termin').modal('show');

            $('#form_termin_m').trigger("reset");

            $('#aksi_termin').val('Tambah');

        })

        // aksi simpan data termin
        $('#form_termin_m').on('submit', function () {

            var form_termin = $('#form_termin_m').serialize();
            var nama_termin = $('#nama_termin').val();

            if (nama_termin == '') {
                swal({
                    title               : "Peringatan",
                    text                : 'termin harus terisi !',
                    buttonsStyling      : false,
                    type                : 'warning',
                    showConfirmButton   : false,
                    timer               : 3000,
                                allowOutsideClick   : false
                }); 

                return false;
            } else {

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
                                    timer               : 3000,
                                allowOutsideClick   : false
                                });    
                
                                tabel_termin.ajax.reload(null,false);        
                                
                                $('#form_termin').trigger("reset");
                
                                $('#aksi_termin').val('Tambah');
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

        // edit data termin
        $('.tabel_termin').on('click', '.edit', function () {

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
                    alert('Error get data from ajax');
                }
            })

            return false;

        })

        // hapus termin
        $('.tabel_termin').on('click', '.hapus', function () {
            
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
                                    timer               : 3000,
                                allowOutsideClick   : false
                                }); 

                                    
                                
                                $('#form_termin').trigger("reset");

                                $('#aksi_termin').val('Tambah');
                            
                        },
                        error       : function(xhr, status, error) {
                            var err = eval("(" + xhr.responseText + ")");
                            alert(err.Message);
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
                            timer               : 3000,
                                allowOutsideClick   : false
                        }); 
                }
            })

        })
        
    })
    
</script>