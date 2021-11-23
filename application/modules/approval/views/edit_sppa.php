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
                                <a class="nav-link link_entry link_t_detail" data-toggle="tab" href="#t_detail" role="tab">
                                <span class="d-none d-md-block">Detail Insured</span><span class="d-block d-md-none"><i class="mdi mdi-account h5"></i></span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link link_entry link_t_dok" data-toggle="tab" href="#t_dok" role="tab">
                                <span class="d-none d-md-block">Documents</span><span class="d-block d-md-none"><i class="mdi mdi-email h5"></i></span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link link_entry link_t_premi" data-toggle="tab" href="#t_premi" role="tab">
                                <span class="d-none d-md-block">Premium Calculation</span><span class="d-block d-md-none"><i class="mdi mdi-settings h5"></i></span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link link_entry link_t_approval" data-toggle="tab" href="#t_approval" role="tab">
                                <span class="d-none d-md-block">Approval</span><span class="d-block d-md-none"><i class="mdi mdi-settings h5"></i></span>
                                </a>
                            </li>
                        </ul>
                        <input type="hidden" class="id_lob" id="id_lob" value="<?= $tr_sppa['id_lob'] ?>">
                        <!-- Tab panes -->
                        <div class="tab-content">
                        <div class="tab-pane active p-3" id="t_client_data" role="tabpanel">
                            <form action="#" id="form_client">
                            <input type="hidden" class="sppa_number" name="sppa_number" value="<?= $tr_sppa['sppa_number'] ?>">
                            <input type="hidden" class="no_polis" name="no_polis" value="<?= $tr_sppa['no_polis'] ?>">
                            <input type="hidden" class="id_sppa" name="id_sppa" value="<?= $id_sppa ?>">
                            <input type="hidden" class="nama_sob" name="nama_sob" value="<?= $sel_sob ?>">
                            <input type="hidden" class="id_relasi" name="id_relasi" value="<?= $tr_sppa['id_relasi_cob_lob'] ?>">
                            <input type="hidden" class="no_invoice" name="no_invoice" value="<?= $tr_sppa['no_invoice_entry'] ?>">
                            <input type="hidden" name="aksi_simpan" id="aksi_simpan" value="<?= $aksi ?>">
                        
                            <!-- <div class="row mb-3">
                            <div class="col-md-6">
                            <h4>MOP</h4>
                            </div>
                            <div class="col-md-6 text-right mt-3">
                                <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input" id="acc_mop">
                                <label class="custom-control-label" for="acc_mop">Aktifkan MOP</label>
                                </div>
                            </div>
                            </div> -->
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
                            <div class="col-md-6">
                                <div class="form-group row">
                                <label for="sobb" class="col-sm-4 col-form-label text-left">Source of Business</label>
                                <div class="col-sm-8">
                                    <select name="id_sob" id="sobb" class="select2">
                                    <option value="pilih">Pilih</option>
                                    <?php foreach ($list_sob as $key) { ?>
                                        <option value="<?php echo $key->id_sob; ?>" <?= ($key->id_sob == $tr_sppa['id_sob']) ? 'selected' : '' ?>><?php echo $key->sob; ?></option>
                                    <?php } ?>
                                    </select>
                                </div>
                                </div>
                            </div>
                            <div class="col-md-6 d_sob">
                                <div class="form-group row">
                                <label for="tocc" class="col-sm-4 col-form-label" id="lbln"><?= $sob ?></label>
                                <div class="col-sm-8">
                                    <select name="nama_sob" id="tocc" class="select2">
                                    <option value="pilih">Pilih</option>
                                    <?php foreach ($rs_sob as $r): ?>
                                        <option value="<?= $r['id'] ?>" <?= ($r['id'] == $sel_sob) ? 'selected' : '' ?>><?= $r['nama'] ?></option>
                                    <?php endforeach; ?>
                                    </select>
                                </div>
                                </div>
                            </div>
                            </div>
                            <div class="d-flex justify-content-center">
                            <div class="col-md-6 d2_sob">
                                <div class="form-group row">
                                <label for="sobb" class="col-sm-4 col-form-label">Telp</label>
                                <div class="col-sm-8 mt-1">
                                    <span id="d2_telp">: <?= $data_sob['telp'] ?></span>
                                </div>
                                </div>
                            </div>
                            <div class="col-md-6 d2_sob">
                                <div class="form-group row">
                                <label for="tocc" class="col-sm-4 col-form-label">Alamat</label>
                                <div class="col-sm-8 mt-1">
                                    <span id="d2_alamat">: <?= $data_sob['alamat'] ?></span>
                                </div>
                                </div>
                            </div>
                            </div><br>
                            <h4>Type of Business</h4><hr>
                            <div class="row">
                            <div class="col-md-6">
                                <div class="form-group row">
                                <label for="no_klaim" class="col-sm-4 col-form-label">Class of Business</label>
                                <div class="col-sm-8">
                                    <select name="id_cob" id="cobb" class="select2">
                                    <option value="pilih">Pilih</option>
                                    <?php foreach ($list_cob as $key) { ?>
                                        <option value="<?php echo $key->id_cob; ?>" <?= ($key->id_cob == $tr_sppa['id_cob']) ? 'selected' : '' ?>><?php echo $key->cob; ?></option>
                                    <?php } ?>
                                    </select>
                                </div>
                                </div>
                            </div>
                            <div class="col-md-6 c_lob">
                                <div class="form-group row">
                                <label for="no_klaim" class="col-sm-4 col-form-label">Line of Business</label>
                                <div class="col-sm-8">
                                    <select name="id_lob" id="lobb" class="select2">
                                    <option value="pilih">Pilih</option>
                                    <?php foreach ($lob as $l) { ?>
                                        <option value="<?php echo $l->id_lob; ?>" id_relasi="<?= $l->id_relasi_cob_lob ?>" <?= ($l->id_lob == $tr_sppa['id_lob']) ? 'selected' : '' ?>><?php echo $l->lob; ?></option>
                                    <?php } ?>
                                    </select>
                                    
                                </div>
                                
                                </div>
                            </div>
                            <div class="col-md-12 mt-2">
                                <p class="font-italic text-danger">*Perubahan Line of Business (LOB) memperngaruhi Form Detail Insured dan Coverage</p>
                            </div>
                            
                            </div>
                            </div>
                            <!-- <hr>
                            <div class="form-group row float-right mb-0 btn_simpan">
                                <button type="button" class="btn btn-primary mr-2" id="simpan_client" disabled><i class="ti-check-box mr-2"></i>Simpan & Lanjutkan</button>
                            </div> -->
                            <hr>
                            <div class="form-group row float-right mb-0">
                                <!-- <button type="button" aksi="t_detail" class="btn btn-warning mr-2 text-dark lanjutkan"><i class="fas fa-chevron-right mr-2"></i>Lanjutkan</button> -->
                                <button type="button" class="btn btn-primary mr-2 simpan_semua"><i class="fas fa-check mr-2"></i>Simpan</button>
                            </div>
                            </form>
                        </div>
                        <div class="tab-pane p-3" id="t_detail" role="tabpanel">
                        <form action="#" id="form_detail">
                            <!-- <input type="hidden" class="id_sppa" name="id_sppa" >
                            <input type="hidden" class="id_lob" name="id_lob" value="2"> -->
                            <h4>Class of Business</h4><hr>
                            <p class="font-italic text-danger">*Form pada halaman ini sesuai pilihan COB & LOB</p>
                            <div class="row">
                            <div class="col-md-12">
                                <div class="card">
                                <div class="card-body">
                                    <div class="d-flex justify-content-center">
                                    <div class="col-md-8" id="here">
                                            <?php foreach ($detail_lob as $d):

                                                $name = str_replace(" ","_", strtolower($d['field_sppa']));
                                                if ($d['cdb'] == 't') {

                                                    $is = $nasabah_ptg[$name];
                                                    
                                                } else {

                                                    $is = $tr_sppa[$name];
                                                    
                                                }

                                                $list['id_lob']               = $d['id_lob'];
                                                $list['fieldnm']              = $d['field_sppa'];
                                                $list['name_id']              = $name;
                                                $list['sparator_num']         = $d['sparator_number'];
                                                $list['input_type']           = $d['input_type'];
                                                $list['key_to_param']         = $d['key_to_param'];
                                                $list['isi']                  = $is;
                                                $list['option_flag']          = $d['option_flag'];
                                                $list['if_input_type_select'] = json_decode($d['if_input_type_select'], true);
                                                $list['input_length']         = json_decode($d['input_length'], true);

                                                $iss = forinput_isi($list);
                                            
                                            ?>
                                            <?= $iss ?>
                                        <?php endforeach; ?>
                                    </div>
                                    </div>
                                </div>
                                </div>
                            </div>
                            </div>
                            <hr>
                            <div class="form-group row float-right mb-0">
                                <!-- <button type="button" aksi="t_dok" class="btn btn-warning mr-2 text-dark lanjutkan"><i class="fas fa-chevron-right mr-2"></i>Lanjutkan</button> -->
                                <button type="button" class="btn btn-primary mr-2 simpan_semua"><i class="fas fa-check mr-2"></i>Simpan</button>
                            </div>
                        </form>
                        </div>
                        <div class="tab-pane p-3" id="t_dok" role="tabpanel">

                            <form action="" id="form_dokumen">
                            <input type="hidden" id="aksi" name="aksi" value="Tambah">
                            <input type="hidden" id="id_dokumen" name="id_dokumen">
                            <input type="hidden" id="nama_dokumen" name="nama_dokumen">
                            <input type="hidden" name="id_sppa" id="id_sppa_dok" value="<?= $id_sppa ?>">
                            <input type="hidden" class="sppa_number_dok" name="sppa_number" value="<?= $tr_sppa['sppa_number'] ?>">
                            <div class="d-flex justify-content-center mb-1 mt-3">
                                <div class="col-md-5">
                                <div class="form-group row">
                                    <label for="no_klaim" class="col-sm-2 col-form-label text-right">File</label>
                                    <div class="col-sm-10">
                                    <input type="file" id="doc" class="form-control" accept="application/msword, application/pdf" name="dokumen">
                                    </div>
                                </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group row">
                                    <label for="no_klaim" class="col-sm-3 col-form-label text-right">Deskripsi</label>
                                    <div class="col-sm-9">
                                        <input type="input" id="desc" class="form-control" name="desc" placeholder="Masukkan Deskripsi">
                                    </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group row p-0">
                                        <div class="col-sm-6">
                                            <button type="button" class="btn btn-primary btn-block" id="simpan_dok">Simpan</button>
                                        </div>
                                        <div class="col-sm-6">
                                            <button type="button" class="btn btn-secondary btn-block" id="batal_dok">Batal</button>
                                        </div>
                                    </div>
                                    
                                    
                                </div>
                            </div>
                            </form>
                            <hr>
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

                        <!-- <form action="#" id="form_dokumen">
                            <div class="d-flex justify-content-center mb-1 mt-3">
                                <div class="col-md-3 text-right mt-1">
                                    <label class="control-label">Dokumen</label>
                                </div>
                                <div class="col-md-4">
                                    <input type="file" id="doc" class="form-control" accept="application/msword, application/pdf" name="dokumen[]">
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group row p-0">
                                        <div class="col-sm-12">
                                            <button type="button" class="btn btn-warning" id="tambah_dok"><i class="ti-plus" data-toggle="tooltip" data-placement="top" title="Tambah Dokumen"></i></button>
                                        </div>
                                    </div>
                                    
                                </div>
                            </div>

                            <div class="list_baru_dok">

                            </div>
                        
                            <hr>
                            <div class="form-group text-right mb-0">
                                <button type="button" class="btn btn-primary mr-2 dok" id="simpan_dok"><i class="ti-check-box mr-2" aksi="simpan_dokumen"></i>Simpan & Lanjutkan</button>
                                <button type="button" id="" class="btn btn-danger batal_entry"><i class="ti-na mr-2"></i>Batal</button>
                            </div>
                            </form> -->

                            <hr>
                            <div class="form-group row float-right mb-0">
                                <!-- <button type="button" aksi="t_premi" class="btn btn-warning mr-2 text-dark lanjutkan"><i class="fas fa-chevron-right mr-2"></i>Lanjutkan</button> -->
                                <button type="button" class="btn btn-primary mr-2 simpan_semua"><i class="fas fa-check mr-2"></i>Simpan</button>
                            </div>
                        </div>
                        <div class="tab-pane p-3" id="t_premi" role="tabpanel">
                        <form action="" id="form_premi">
                            <input type="hidden" class="id_sppa" name="id_sppa" id="id_sppa_premi" value="<?= $tr_sppa['id_sppa_quotation'] ?>">
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
                                <input type="hidden" id="kondisi_diskon" value="<?= $st_diskon ?>">
                                <h4>Sum Insured and Premium</h4><hr>
                                <p class="font-italic text-danger">*Form Input Coverage (Premi Standar dan Perluasan) sesuai pilihan COB & LOB</p> <br>
                                <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label for="no_klaim" class="col-sm-4 col-form-label">Total Sum Insured</label>
                                        <div class="col-sm-8">
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                <span class="input-group-text" id="basic-addon1">Rp.</span>
                                                </div>
                                                <input type="text" class="text-right form-control number_separator numeric" id="tsi" name="tsi" placeholder="0" value="<?= number_format($tr_sppa['total_sum_insured'],0,',','.') ?>">
                                            </div>
                                        </div>
                                    </div> 
                                    
                                    <div class="form-group row">
                                        <label for="no_klaim" class="col-sm-4 col-form-label">Discount</label>
                                        <div class="col-sm-8 input-group">
                                            <input type="text" class="form-control text-right numeric" id="diskon" name="diskon" placeholder="Masukkan Diskon" value="<?= $tr_sppa['diskon'] ?>">
                                            <div class="input-group-append">
                                                <span class="input-group-text" id="basic-addon2">%</span>
                                            </div>
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
                                    <?php foreach ($premi as $p):
                                        $la = str_replace(' ','_',$p['label']);

                                        $label = ucwords(str_replace('&','dan',$la));
                                    ?>
                                        <div class='form-group row'>
                                            <label for='no_klaim' class='col-sm-4 col-form-label'>Premi <?= ucwords($p['status'])." ".$p['label'] ?></label>
                                            <div class='col-sm-4'>
                                            <div class='input-group'>
                                                <input type='text' class='form-control text-right rate_all_premi persen total_premi p_persen_<?= $label ?>' value='<?= $p['rate'] ?>' label='<?= $label ?>'>
                                                <div class='input-group-append'>
                                                    <span class='input-group-text' id='basic-addon2'>%</span>
                                                </div>
                                            </div>
                                            </div>
                                            <div class='col-sm-4'>
                                                <input type='text' class='form-control text-right nominal_all_premi premi_<?= $p['status'] ?> total_premi_rp p_total_<?= $label ?>' name='<?= $label ?>' aksi='<?= $p['status'] ?>' value='<?= number_format($p['nominal'],0,',','.') ?>' label='<?= $label ?>' id_coverage='<?= $p['id_coverage'] ?>' readonly>
                                                <input type='hidden' class='p_total_asli_<?= $label ?> premi_asli_<?= $p['status'] ?>' value='<?= number_format($p['nominal'],0,',','.') ?>'>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            </div><hr>
                            <button type="button" class="btn btn-primary mb-2" id="tambah_additional" id_lob="<?= $tr_sppa['id_lob'] ?>">Tambah Additional</button>
                            <div id="show_additional" class="mt-3">
                                <?php $a = 0; foreach ($premi_adt as $pa): ?>
                                    <div class="row" id="list_add<?= $a ?>">
                                        <div class="col-md-12">
                                            <div class="form-group row p-0">
                                                <div class="col-sm-12">
                                                    <button type="button" data-toggle="tooltip" data-placement="top" title="Hapus" class="btn btn-danger remove" data-id="<?= $a ?>"><i class="fa fa-times"></i></button>
                                                </div>
                                            </div>
                                            
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label for="no_klaim" class="col-sm-4 col-form-label">Pilih LOB Lainnya</label>
                                                <div class='col-sm-8'>
                                                    <select name="lob_lain" class="select2 lob_lain lob_adt">
                                                    <option value=""></option>
                                                        <?php foreach ($lob_adt as $n): ?>
                                                            <option value="<?= $n['id_lob'] ?>" <?= ($n['id_lob'] == $pa['id_lob']) ? 'selected' : '' ?>><?= $n['lob'] ?></option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                </div>
                                            </div>    
                                            <div class="form-group row">
                                                <label for="no_klaim" class="col-sm-4 col-form-label">Kalkulasi Sum Insurance</label>
                                                <div class='col-sm-8'>
                                                    <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text" id="basic-addon1">Rp.</span>
                                                    </div>
                                                    <input type="text" class="text-right form-control kalkulasi_tsi_adt" id="kalkulasi<?= $a ?>" placeholder="0" value="<?= number_format($pa['kalkulasi_tsi'],0,',','.') ?>" readonly>
                                                    </div>
                                                </div>
                                            </div>    
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label for="no_klaim" class="col-sm-4 col-form-label">Persentase Pengali TSI</label>
                                                <div class='col-sm-8'>
                                                    <div class='input-group'>
                                                    <input type='text' class='form-control text-right persen pengali pengali_tsi_adt' data-id="<?= $a ?>" value="<?= $pa['pengali_tsi'] ?>" placeholder="0">
                                                    <div class='input-group-append'>
                                                        <span class='input-group-text' id='basic-addon2'>%</span>
                                                    </div>
                                                    </div>
                                                </div>
                                            </div>  
                                            <div class="form-group row">
                                                <label for="no_klaim" class="col-sm-4 col-form-label">Premi</label>
                                                <div class='col-sm-4'>
                                                    <div class='input-group'>
                                                    <input type='text' class='form-control text-right persen premi_lain rate_adt rate_<?= $a ?>' data-id="<?= $a ?>" placeholder="0" value="<?= $pa['rate'] ?>">
                                                    <div class='input-group-append'>
                                                        <span class='input-group-text' id='basic-addon2'>%</span>
                                                    </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <input type="text" class="form-control text-right premi_rp_lain nominal_adt"  id="t_premi_lain<?= $a ?>" value="<?= number_format($pa['nominal'],0,',','.') ?>" readonly>
                                                </div>
                                            </div> 
                                        </div>
                                        </div>
                                        
                                <?php $a++; endforeach; ?>
                            </div>
                            
                            <h4>Total</h4><hr>
                            <div class="row">
                                <div class="col-md-6">
                                    
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label for="gross_premi" class="col-sm-4 col-form-label">Gross Premi</label>
                                        <div class='col-sm-4'>
                                            <div class='input-group'>
                                            <input type='text' class='form-control text-right persen' id="total_persen_premi" value="<?= $tr_sppa['total_rate_akhir_premi'] ?>" readonly>
                                            <div class='input-group-append'>
                                                <span class='input-group-text' id='basic-addon2'>%</span>
                                            </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <input type="text" class="form-control text-right" id="gross_premi" value="<?= number_format($tr_sppa['gross_premi'],0,',','.') ?>" readonly>
                                        </div>
                                    </div> 
                                    <div class="form-group row">
                                        <label for="total_diskon" class="col-sm-4 col-form-label">Total Diskon</label>
                                        <div class="col-sm-8 mb-3">
                                            <input type="text" class="form-control text-right" id="total_diskon" value="<?= number_format($tr_sppa['total_diskon'],0,',','.') ?>" readonly>
                                        </div>
                                    </div> 
                                    <hr>
                                    <div class="form-group row">
                                        <label for="no_klaim" class="col-sm-4 col-form-label">Total Akhir Premi</label>
                                        
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control text-right" id="total_akhir_premi" value="<?= number_format($tr_sppa['total_akhir_premi'],0,',','.') ?>" readonly>
                                            <input type="hidden" class="form-control text-right" id="total_akhir_premi_asli" value="<?= number_format($tr_sppa['total_akhir_premi'],0,',','.') ?>">
                                        </div>
                                    </div> 
                                    <div class="form-group row">
                                        <label for="no_klaim" class="col-sm-4 col-form-label">Biaya Admin</label>
                                        <div class="col-sm-8">
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                <span class="input-group-text" id="basic-addon1">Rp.</span>
                                                </div>
                                                <input type="text" class="text-right form-control number_separator numeric" name="biaya_admin" id="biaya_admin" placeholder="0" value="<?= number_format($tr_sppa['biaya_admin'],0,',','.') ?>">
                                            </div>
                                        </div>
                                    </div> <hr>
                                    <div class="form-group row">
                                        <label for="no_klaim" class="col-sm-4 col-form-label">Total Tagihan</label>
                                        <div class="col-sm-8">
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                <span class="input-group-text" id="basic-addon1">Rp.</span>
                                                </div>
                                                <input type="text" class="text-right form-control number_separator numeric" placeholder="0" id="total_tagihan" value="<?= number_format($tr_sppa['total_tagihan'],0,',','.') ?>" readonly>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                
                            </div>
                            <h4>Payment Method</h4><hr>
                            <div class="row">
                                <div class="col-md-5">
                                    <div class="form-group row">
                                        <label for="no_klaim" class="col-sm-4 col-form-label">Paymnet Method</label>
                                        <div class="col-sm-8">
                                            <select name="payment_method" id="payment_method" class="form-control">
                                                <option value="">Pilih</option>
                                                <option value="cash" <?= ($tr_sppa['payment_method'] == 'cash') ? 'selected' : '' ?>>Cash</option>
                                                <option value="transfer" <?= ($tr_sppa['payment_method'] == 'transfer') ? 'selected' : '' ?>>Transfer</option>
                                            </select>
                                        </div>
                                    </div> 
                                    
                                </div>
                                <div class="col-md-3 f_pay">
                                    <div class="form-group row">
                                        <label for="no_klaim" class="col-sm-4 col-form-label">Tahun</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="text-center form-control tahun numeric" id="tahun_pay" value="<?= $tr_sppa['tahun_cicilan'] ?>" placeholder="Tahun">
                                        </div>
                                    </div> 
                                </div>
                                <div class="col-md-4 f_pay">
                                    <div class="form-group row">
                                        <label for="no_klaim" class="col-sm-4 col-form-label">Jumlah Cicilan</label>
                                        <div class="col-sm-7">
                                            <input type="text" class="text-center form-control cicilan numeric" id="jumlah_cicilan" value="<?= $tr_sppa['jumlah_cicilan'] ?>" placeholder="Cicilan">
                                        </div>
                                    </div> 
                                </div>
                                
                            </div>
                            
                            </div>
                            <div class="tab-pane p-3" id="termin_bayar" role="tabpanel">
                                <button type="button" class="btn btn-primary float-left ml-3" id="tambah_pembayaran">Tambah Pembayaran</button>
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
                            <hr>
                            <div class="form-group row float-right mb-0">
                                    <!-- <button type="button" aksi="t_approval" class="btn btn-warning mr-2 text-dark lanjutkan"><i class="fas fa-chevron-right mr-2"></i>Lanjutkan</button> -->
                                    <button type="button" class="btn btn-primary mr-2 simpan_semua"><i class="fas fa-check mr-2"></i>Simpan</button>
                            </div>
                        </form>
                        </div>
                        <div class="tab-pane p-3" id="t_approval" role="tabpanel">
                            <h4>Otorisasi</h4><hr>
                            <form action="" id="form_approval_edit">
                                <input type="hidden" name="id_approve_sppa" value="<?= $dt_approve['id_approve_sppa'] ?>">
                                <input type="hidden" class="aksi" name="aksi" value="<?= $aksi ?>">
                                <input type="hidden" class="id_sppa_termin" name="id_sppa" id="id_sppa_termin" value="<?= $id_sppa ?>">
                            <div class="d-flex justify-content-center">
                                <div class="col-md-10">
                                    <div class="form-group row">
                                        <label for="no_klaim" class="col-sm-4 col-form-label">Insurance Company<span class="text-danger">*</span></label>
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
                                        <label for="no_klaim" class="col-sm-4 col-form-label">Nomor Otorisasi/Polis<span class="text-danger">*</span></label>
                                        <div class="col-sm-8 input-group">
                                            <input type="text" class="form-control" name="no_otorisasi_polis" id="no_otorisasi_polis_edit" value="<?= $no_polis ?>" readonly>
                                        </div>
                                    </div> 
                                    <div class="form-group row">
                                        <label for="no_klaim" class="col-sm-4 col-form-label">Tanggal Otorisasi/Polis<span class="text-danger">*</span></label>
                                        <div class="col-sm-8 input-group">
                                            <input type="text" class="form-control datepicker" id="tgl_otorisasi" name="tgl_otorisasi" placeholder="Pilih Tanggal" value="<?= $tgl_polis ?>" readonly>
                                        </div>
                                    </div> 
                                    <div class="form-group row">
                                        <label for="no_klaim" class="col-sm-4 col-form-label">Disetujui Oleh<span class="text-danger">*</span></label>
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
                            <p class="font-italic text-danger">*Data Harus Terisi</p>
                            <hr>
                            <div class="form-group row float-right mb-0">
                                <button type="button" class="btn btn-primary mr-2 simpan_semua"><i class="fas fa-check mr-2"></i>Selesai</button>
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
        <form id="form_termin_m" autocomplete="off" class="form-control-line">
            <input type="hidden" name="id_termin" id="id_termin">
            <input type="hidden" name="aksi" id="aksi_termin" value="Tambah">
            <input type="hidden" class="sppa_number_termin" name="sppa_number" value="<?= $tr_sppa['sppa_number'] ?>">
            <input type="hidden" class="id_sppa" name="id_sppa" value="<?= $id_sppa ?>">
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

<?php $this->load->view('js_endorsment'); ?>

<script>

    $(document).ready(function () {

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

        tinymce.init({
            selector: "textarea.tiny",
            theme: "modern",
            height:300,
            plugins: [
                "advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker",
                "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
                "save table contextmenu directionality emoticons template paste textcolor"
            ],
            toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | l      ink image | print preview media fullpage | forecolor backcolor emoticons",
            style_formats: [
                {title: 'Bold text', inline: 'b'},
                {title: 'Red text', inline: 'span', styles: {color: '#ff0000'}},
                {title: 'Red header', block: 'h1', styles: {color: '#ff0000'}},
                {title: 'Example 1', inline: 'span', classes: 'example1'},
                {title: 'Example 2', inline: 'span', classes: 'example2'},
                {title: 'Table styles'},
                {title: 'Table row 1', selector: 'tr', classes: 'tablerow1'}
            ]
        });

        $('.simpan_semua').on('click', function () {

            tinymce.triggerSave();

            var form_client     = $('#form_client').serialize();
            var form_detail     = $('#form_detail').serialize();
            var form_approval   = $('#form_approval_edit').serialize();

            console.log(form_client);

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

            console.log(id_sppa_premi);

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
                            }).then(function() {
                                location.href = "<?= base_url('approval') ?>";
                            });

                            // $('.f_tab').slideUp();

                            // $('#sppa_number').html(data.option);
                            // $('#no_otorisasi_polis').val(data.no_polis);

                            // $('#form_approval').trigger("reset");

                            // $('.sel_sppa').fadeIn();

                            // $('#aksi').val('Tambah');

                            // $('.f_tambah').slideToggle('fast', function() {
                            //     if ($(this).is(':visible')) {
                            //         $('#status_toggle').val(1);          
                            //     } else {  
                            //         $('#status_toggle').val(0);            
                            //     }        
                            // });

                            // tabel_approval.ajax.reload(null, false)
                            
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