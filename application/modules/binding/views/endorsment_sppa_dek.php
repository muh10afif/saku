<div class="row">
    <div class="col-md-4 text-center">
        <h5>No Polis Induk : <samp><mark> <?= $no_polis_induk ?> </mark></samp></h5>
    </div>
    <div class="col-md-4 text-center">
        <h5>Nama MOP : <samp><mark> <?= $nama_mop ?> </mark></samp></h5>
    </div>
    <div class="col-md-4 text-center">
        <h5>Nomor Dokumen : <samp><mark> <?= $no_mop ?> </mark></samp></h5>
    </div>
</div>
<div class="row mt-3">

    <div class="col-md-12" hidden>

        <ul class="nav nav-tabs d-flex justify-content-center mt-2" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" data-toggle="tab" href="#t_client_data2" role="tab">
                <span class="d-none d-md-block">Client Data</span><span class="d-block d-md-none"><i class="mdi mdi-home-variant h5"></i></span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link link_entry link_detail" data-toggle="tab" href="#t_detail2" role="tab">
                <span class="d-none d-md-block">Detail Insured</span><span class="d-block d-md-none"><i class="mdi mdi-account h5"></i></span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link link_entry link_dok" data-toggle="tab" href="#t_dok2" role="tab">
                <span class="d-none d-md-block">Documents</span><span class="d-block d-md-none"><i class="mdi mdi-email h5"></i></span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link link_entry link_premi" data-toggle="tab" href="#t_premi2" role="tab">
                <span class="d-none d-md-block">Premium Calculation</span><span class="d-block d-md-none"><i class="mdi mdi-settings h5"></i></span>
                </a>
            </li>
        </ul>
        <input type="hidden" class="id_lob" id="id_lob" value="<?= $tr_sppa['id_lob'] ?>">
        <!-- Tab panes -->
        <div class="tab-content">
            <div class="tab-pane active p-3" id="t_client_data2" role="tabpanel">
                <form action="#" id="form_client">
                <input type="hidden" class="sppa_number sppa_number_cd" name="sppa_number" value="<?= $tr_sppa['sppa_number'] ?>">
                <input type="hidden" class="no_polis no_polis_e" name="no_polis" value="<?= $tr_sppa['no_polis'] ?>">
                <input type="hidden" class="id_sppa" name="id_sppa" value="<?= $tr_sppa['id_sppa_quotation'] ?>">
                <input type="hidden" class="nama_sob nama_sob_e" name="nama_sob" value="<?= $sel_sob ?>">
                <input type="hidden" class="id_relasi id_relasi_e" name="id_relasi" value="<?= $tr_sppa['id_relasi_cob_lob'] ?>">
                <input type="hidden" class="no_invoice" name="no_invoice" value="<?= $tr_sppa['no_invoice_entry'] ?>">
                <input type="hidden" class="id_mop" name="id_mop" value="<?= $tr_sppa['id_mop'] ?>">
            
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
                        <select name="id_sob" id="sobb" class="select2 sobb">
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
                    <label for="tocc" class="col-sm-4 col-form-label lbln" id="lbln">SOB <?= $sob ?></label>
                    <div class="col-sm-8">
                        <select name="nama_sob" id="tocc" class="select2 tocc">
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
                        <span id="d2_nama" class="d2_telp">: <?= $data_sob['telp'] ?></span>
                    </div>
                    </div>
                </div>
                <div class="col-md-6 d2_sob">
                    <div class="form-group row">
                    <label for="tocc" class="col-sm-4 col-form-label">Alamat</label>
                    <div class="col-sm-8 mt-1">
                        <span id="d2_alamat" class="d2_alamat">: <?= $data_sob['alamat'] ?></span>
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
                        <select name="id_cob" id="cobb" class="select2 cobb">
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
                        <select name="id_lob" id="lobb" class="select2 lobb">
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
                </form>
            </div>
            <div class="tab-pane p-3" id="t_detail2" role="tabpanel">
            <form action="#" id="form_detail_edit">
                <!-- <input type="hidden" class="id_sppa" name="id_sppa" >
                <input type="hidden" class="id_lob" name="id_lob" value="2"> -->
                <h4>Class of Business</h4><hr>
                <p class="font-italic text-danger">*Form pada halaman ini sesuai pilihan COB & LOB</p>
                <div class="row">
                <div class="col-md-12">
                    <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-center">
                        <div class="col-md-8 here">
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
                <!-- <hr>
                <div class="form-group row float-right mb-0">
                    <button type="button" class="btn btn-primary mr-2" id="simpan_detail"><i class="ti-check-box mr-2"></i>Simpan & Lanjutkan</button>
                </div> -->
            </form>
            </div>
            <div class="tab-pane p-3" id="t_dok2" role="tabpanel">

                <form action="" id="form_dokumen_edit">
                <input type="hidden" class="aksi" id="aksi" name="aksi" value="Tambah">
                <input type="hidden" class="id_dokumen" id="id_dokumen" name="id_dokumen">
                <input type="hidden" class="nama_dokumen" id="nama_dokumen" name="nama_dokumen">
                <input type="hidden" class="id_sppa id_sppa_dok" name="id_sppa" id="id_sppa_dok" value="<?= $id_sppa ?>">
                <input type="hidden" class="sppa_number_dok" name="sppa_number" id="sppa_number" value="<?= $tr_sppa['sppa_number'] ?>">
                <div class="d-flex justify-content-center mb-1 mt-3">
                    <div class="col-md-5">
                    <div class="form-group row">
                        <label for="no_klaim" class="col-sm-2 col-form-label text-right">File</label>
                        <div class="col-sm-10">
                        <input type="file" id="doc" class="form-control doc" accept="application/msword, application/pdf" name="dokumen">
                        </div>
                    </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group row">
                        <label for="no_klaim" class="col-sm-3 col-form-label text-right">Deskripsi</label>
                        <div class="col-sm-9">
                            <input type="input" id="desc" class="form-control desc" name="desc" placeholder="Masukkan Deskripsi">
                        </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group row p-0">
                            <div class="col-sm-6">
                                <button type="button" class="btn btn-primary btn-block simpan_dok" id="simpan_dok">Simpan</button>
                            </div>
                            <div class="col-sm-6">
                                <button type="button" class="btn btn-secondary btn-block" id="batal_dok">Batal</button>
                            </div>
                        </div>
                        
                    </div>
                </div>
                </form>
                <hr>
                <table class="mt-3 table table-bordered table-hover dt-responsive nowrap tabel_dok" style="border-collapse: collapse; border-spacing: 0; width: 100%;" id="" width="100%" cellspacing="0">
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

                <!-- <hr>
                <div class="form-group text-right mb-0">
                    <button type="button" class="btn btn-primary mr-2 dok" id="simpan_tab_dok"><i class="ti-check-box mr-2" aksi="simpan_dokumen"></i>Simpan & Lanjutkan</button>
                </div> -->
            </div>
            <div class="tab-pane p-3" id="t_premi2" role="tabpanel">
            <form action="" id="form_premi">
                <input type="hidden" class="id_sppa id_sppa_premi" name="id_sppa" id="id_sppa_premi" value="<?= $tr_sppa['id_sppa_quotation'] ?>">
                <h4>Premium and Payment</h4>
                <ul class="nav nav-tabs d-flex justify-content-center mt-2" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" data-toggle="tab" href="#total_premium2" role="tab">
                    <span class="d-none d-md-block">Total Premium</span><span class="d-block d-md-none"><i class="mdi mdi-home-variant h5"></i></span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#termin_bayar2" role="tab">
                    <span class="d-none d-md-block">Termin Pembayaran</span><span class="d-block d-md-none"><i class="mdi mdi-account h5"></i></span>
                    </a>
                </li>
                </ul>

                <div class="tab-content">
                <div class="tab-pane active p-3" id="total_premium2" role="tabpanel">
                    <input type="hidden" id="kondisi_diskon" class="kondisi_diskon" value="<?= $st_diskon ?>">
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
                                    <input type="text" class="text-right form-control number_separator numeric tsi" id="tsi" name="tsi" placeholder="0" value="<?= number_format($tr_sppa['total_sum_insured'],0,',','.') ?>">
                                </div>
                            </div>
                        </div> 
                        
                        <div class="form-group row">
                            <label for="no_klaim" class="col-sm-4 col-form-label">Discount</label>
                            <div class="col-sm-8 input-group">
                                <input type="text" class="form-control text-right numeric diskon" id="diskon" name="diskon" placeholder="Masukkan Diskon" value="<?= $tr_sppa['diskon'] ?>">
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
                    <div class="col-md-6 show_premi" id="show_premi">
                        <?php foreach ($premi as $p):
                            $la     = ucwords(str_replace(' ','_',$p['label']));

                            $label  = ucwords(str_replace('&','dan',$la));
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
                <button type="button" class="btn btn-primary mb-2 tambah_additional" id="tambah_additional" id_lob="<?= $tr_sppa['id_lob'] ?>">Tambah Additional</button>
                <div id="show_additional" class="mt-3 show_additional">
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
                                <input type='text' class='form-control text-right persen total_persen_premi' id="total_persen_premi" value="<?= $tr_sppa['total_rate_akhir_premi'] ?>" readonly>
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
                                <input type="text" class="form-control text-right total_akhir_premi" id="total_akhir_premi" value="<?= number_format($tr_sppa['total_akhir_premi'],0,',','.') ?>" readonly>
                                <input type="hidden" class="form-control text-right total_akhir_premi_asli" id="total_akhir_premi_asli" value="<?= number_format($tr_sppa['total_akhir_premi'],0,',','.') ?>">
                            </div>
                        </div> 
                        <div class="form-group row">
                            <label for="no_klaim" class="col-sm-4 col-form-label">Biaya Admin</label>
                            <div class="col-sm-8">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1">Rp.</span>
                                    </div>
                                    <input type="text" class="text-right form-control number_separator numeric biaya_admin" name="biaya_admin" id="biaya_admin" placeholder="0" value="<?= number_format($tr_sppa['biaya_admin'],0,',','.') ?>">
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
                                    <input type="text" class="text-right form-control number_separator numeric total_tagihan" placeholder="0" id="total_tagihan" value="<?= number_format($tr_sppa['total_tagihan'],0,',','.') ?>" readonly>
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
                                <select name="payment_method" id="payment_method" class="form-control payment_method">
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
                                <input type="text" class="text-center form-control tahun numeric tahun_pay" id="tahun_pay" value="<?= $tr_sppa['tahun_cicilan'] ?>" placeholder="Tahun">
                            </div>
                        </div> 
                    </div>
                    <div class="col-md-4 f_pay">
                        <div class="form-group row">
                            <label for="no_klaim" class="col-sm-4 col-form-label">Jumlah Cicilan</label>
                            <div class="col-sm-7">
                                <input type="text" class="text-center form-control cicilan numeric jumlah_cicilan" id="jumlah_cicilan" value="<?= $tr_sppa['jumlah_cicilan'] ?>" placeholder="Cicilan">
                            </div>
                        </div> 
                    </div>
                    
                </div>
                
                </div>
                <div class="tab-pane p-3" id="termin_bayar2" role="tabpanel">
                <input type="hidden" class="sppa_number_ter" value="<?= $tr_sppa['sppa_number'] ?>">
                <input type="hidden" class="" name="" id="id_sppa_termin" value="<?= $id_sppa ?>">
                    <button type="button" class="btn btn-primary float-left ml-3 tambah_pembayaran" id="">Tambah Pembayaran</button>
                    <table class="table table-bordered table-hover dt-responsive nowrap tabel_termin_2" style="border-collapse: collapse; border-spacing: 0; width: 100%;" id="" width="100%" cellspacing="0">
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
            <div class="tab-pane p-3" id="t_released2" role="tabpanel">
                <form action="<?= base_url() ?>entry_sppa/cetak_invoice" method="POST" target="_blank">
                <input type="hidden" class="id_sppa" name="id_sppa_invoice" value="<?= $tr_sppa['id_sppa_quotation'] ?>">
                <div class="alert alert-primary mb-0 text-center" role="alert">
                    <h4 class="alert-heading mt-2 font-18">Semua Data Berhasil Disimpan.</h4>
                    <p>Silahkan tekan tombol cetak invoice bila data telah lengkap.</p>
                    <p><button type="submit" class="btn btn-warning text-dark">Cetak Invoice</button></p>
                </div>
                </form>
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
                <input type="hidden" class="id_mop" name="id_mop" id="id_mop_termin" value="<?= $id_mop ?>">
                <div class="modal-body">
                    <div class="col-md-12 p-3">
                        <div class="form-group row">
                            <label for="tgl_awal" class="col-sm-3 col-form-label">No Dokumen</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="no_dokumen" id="no_dokumen" placeholder="Masukkan No Dokumen">
                            </div>
                        </div>  
                        <div class="form-group row">
                            <label for="tgl_awal" class="col-sm-3 col-form-label">Tanggal Bayar</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control datepicker" name="tgl_bayar" id="tgl_bayar" placeholder="Masukkan Tanggal Bayar" readonly>
                            </div>
                        </div>  
                        <div class="form-group row">
                            <label for="tgl_awal" class="col-sm-3 col-form-label">Jumlah</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control numeric number_separator" name="jumlah" id="jumlah" placeholder="Masukkan Jumlah">
                            </div>
                        </div>  
                        <div class="form-group row">
                            <label for="tgl_awal" class="col-sm-3 col-form-label">Cara Bayar</label>
                            <div class="col-sm-9">
                            <select name="cara_bayar" id="cara_bayar" class="form-control">
                                <option value="">Pilih</option>
                                <option value="cash">Cash</option>
                                <option value="transfer">Transfer</option>
                            </select>
                            </div>
                        </div>  
                        <div class="form-group row">
                            <label for="tgl_akhir" class="col-sm-3 col-form-label">Tanggal Terima</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control datepicker" name="tgl_terima" id="tgl_terima" placeholder="Masukkan Tanggal Akhir" readonly>
                            </div>
                        </div> 
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id="simpan_termin"><i class="fas fa-check mr-2"></i>Simpan</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fas fa-ban mr-2"></i>Batal</button>
                </div>
            </form>
        </div>
    </div>
    </div>
    
    <div class="col-md-12">
        <hr>
        <input type="hidden" id="jenis_input" value="upload">
        <ul class="nav nav-tabs d-flex justify-content-center" role="tablist">
            <li class="nav-item">
                <a class="nav-link t_upload active tab_parent" jenis_input="upload" data-toggle="tab" href="#upload_excel" role="tab">
                    <span class="d-none d-md-block">Upload Excel</span><span class="d-block d-md-none"><i class="mdi mdi-home-variant h5"></i></span>
                </a>
            </li>
            <li class="nav-item">
            <a class="nav-link t_manual tab_parent" jenis_input="manual" data-toggle="tab" href="#tambah_manual" role="tab">
                <span class="d-none d-md-block">Tambah Manual</span><span class="d-block d-md-none"><i class="mdi mdi-home-variant h5"></i></span>
            </a>
            </li>
        </ul>

        <div class="tab-content">
            <div class="tab-pane p-3" id="tambah_manual" role="tabpanel">

                <ul class="nav nav-tabs d-flex justify-content-center mt-2" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" href="#t_client_data_3" role="tab">
                        <span class="d-none d-md-block">Client Data</span><span class="d-block d-md-none"><i class="mdi mdi-home-variant h5"></i></span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link link_entry link_detail" data-toggle="tab" href="#t_detail_3" role="tab">
                        <span class="d-none d-md-block">Detail Insured</span><span class="d-block d-md-none"><i class="mdi mdi-account h5"></i></span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link link_entry link_dok" data-toggle="tab" href="#t_dok_3" role="tab">
                        <span class="d-none d-md-block">Documents</span><span class="d-block d-md-none"><i class="mdi mdi-email h5"></i></span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link link_entry link_premi" data-toggle="tab" href="#t_premi_3" role="tab">
                        <span class="d-none d-md-block">Premium Calculation</span><span class="d-block d-md-none"><i class="mdi mdi-settings h5"></i></span>
                        </a>
                    </li>
                </ul>

                <div class="tab-content">
                    <div class="tab-pane active p-3" id="t_client_data_3" role="tabpanel">

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
                    <div class="tab-pane p-3" id="t_detail_3" role="tabpanel">
                        <form action="#" id="form_detail_endors">
                            <h4>Class of Business</h4><hr>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="d-flex justify-content-center">
                                                <div class="col-md-8 here">

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

                                                    $iss = forinput($list);

                                                    ?>
                                                    <?= $iss ?>
                                                <?php endforeach; ?>
                                                    
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="tab-pane p-3" id="t_dok_3" role="tabpanel">

                        <table class="mt-3 table table-bordered table-hover dt-responsive nowrap " style="border-collapse: collapse; border-spacing: 0; width: 100%;" id="tabel_dok_mop" width="100%" cellspacing="0">
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
                    <div class="tab-pane p-3" id="t_premi_3" role="tabpanel">

                        <form action="" id="form_premi">
                            <input type="hidden" class="id_sppa" name="id_sppa" id="id_sppa_premi2" >
                            <h4>Premium and Payment</h4>
                            <ul class="nav nav-tabs d-flex justify-content-center mt-2" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" data-toggle="tab" href="#total_premium1" role="tab">
                                    <span class="d-none d-md-block">Total Premium</span><span class="d-block d-md-none"><i class="mdi mdi-home-variant h5"></i></span>
                                    </a>
                                </li>
                                <!-- <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#termin_bayar1" role="tab">
                                    <span class="d-none d-md-block">Termin Pembayaran</span><span class="d-block d-md-none"><i class="mdi mdi-account h5"></i></span>
                                    </a>
                                </li> -->
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
                </div>
                
            </div>
            <div class="tab-pane active p-3" id="upload_excel" role="tabpanel">

                <div class="sel_deklarasi">
                    <div class="d-flex justify-content-center">
                        <div class="col-md-5 mt-2">
                        <div class="form-group row">
                            <label for="sobb" class="col-sm-3 col-form-label">Upload Excel</label>
                            <div class="col-sm-8">
                            <input type="file" class="form-control file_dok" id="excelfile" name="upload_excel" accept=".xls,.xlsx">
                            </div>
                        </div>
                        </div>
                        <div class="col-md-3 mt-2">
                            <a href="<?= base_url("entry_sppa/format_excel/$id_relasi") ?>" id="url_format"><button type="button" class="btn btn-primary mr-2 ttip" data-toggle="tooltip" data-placement="top" title="Download Format Excel"><i class="ti-download"></i></button></a>
                            <button type="button" class="btn btn-warning mr-2 ttip" onclick="preview()" data-toggle="tooltip" data-placement="top" title="Preview"><i class="ti-zoom-in"></i></button>
                            <button type="button" class="btn btn-danger mr-2 ttip" id="clear" data-toggle="tooltip" data-placement="top" title="Reset"><i class="ti-eraser"></i></button>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
        
    </div>

</div>

<style>
  th {
    text-align: center;
  }
</style>
<!-- Modal -->
<div class="modal fade" id="modal_preview" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header bg-primary text-white">
        <h5 class="modal-title mt-0" id="judul_modal">Preview</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true" class="text-white">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <div class="col-md-12 p-3 table-responsive">
            <table id="exceltable" class="table table-bordered table-striped">  
            </table> 
          </div>
      </div>
      <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fas fa-ban mr-2"></i>Tutup</button>
      </div>
    </div>
  </div>
</div>

<input type="hidden" id="id_mop_endors" value="<?= $id_mop ?>">
<input type="hidden" id="id_relasi_endors" value="<?= $id_relasi ?>">
<input type="hidden" id="id_sppa_endors" value="<?= $id_sppa ?>">

<script type="text/javascript">

    function preview() {  
      $('#exceltable').html('');  
      var regex = /^([a-zA-Z0-9\s_\\.\-:])+(.xlsx|.xls)$/;  
      /*Checks whether the file is a valid excel file*/  
      if (regex.test($("#excelfile").val().toLowerCase())) {  
          var xlsxflag = false; /*Flag for checking whether excel is .xls format or .xlsx format*/  
          if ($("#excelfile").val().toLowerCase().indexOf(".xlsx") > 0) {  
              xlsxflag = true;  
          }  
          /*Checks whether the browser supports HTML5*/  
          if (typeof (FileReader) != "undefined") {  
              var reader = new FileReader();  
              reader.onload = function (e) {  
                  var data = e.target.result;  
                  /*Converts the excel data in to object*/  
                  if (xlsxflag) {  
                      var workbook = XLSX.read(data, { type: 'binary' });  
                  }  
                  else {  
                      var workbook = XLS.read(data, { type: 'binary' });  
                  }  
                  /*Gets all the sheetnames of excel in to a variable*/  
                  var sheet_name_list = workbook.SheetNames;  
    
                  var cnt = 0; /*This is used for restricting the script to consider only first sheet of excel*/  
                  sheet_name_list.forEach(function (y) { /*Iterate through all sheets*/  
                      /*Convert the cell value to Json*/  
                      if (xlsxflag) {  
                          var exceljson = XLSX.utils.sheet_to_json(workbook.Sheets[y]);  
                      }  
                      else {  
                          var exceljson = XLS.utils.sheet_to_row_object_array(workbook.Sheets[y]);  
                      }  
                      if (exceljson.length > 0 && cnt == 0) {  
                          BindTable(exceljson, '#exceltable');  
                          cnt++;  
                      }  
                  });  
                  
                  $('#exceltable').show();  
                  $('#modal_preview').modal('show');
              }  
              if (xlsxflag) {/*If excel file is .xlsx extension than creates a Array Buffer from excel*/  
                  reader.readAsArrayBuffer($("#excelfile")[0].files[0]);  
              }  
              else {  
                  reader.readAsBinaryString($("#excelfile")[0].files[0]);  
              }  
          }  
          else {  

              swal({
                  title               : "Peringatan",
                  text                : 'Browser, tidak support HTML5',
                  type                : 'warning',
                  showConfirmButton   : false,
                  timer               : 3000,
                                allowOutsideClick   : false
              }); 

              return false;
          }  
      }  
      else {  

          swal({
              title               : "Peringatan",
              text                : 'Harap Upload file terlebih dahulu!',
              type                : 'warning',
              showConfirmButton   : false,
              timer               : 3000,
                                allowOutsideClick   : false
          }); 

          return false;
      }  
    }  

    function BindTable(jsondata, tableid) {/*Function used to convert the JSON array to Html Table*/  
        var columns = BindTableHeader(jsondata, tableid); /*Gets all the column headings of Excel*/  
        for (var i = 0; i < jsondata.length; i++) {  
            var row$ = $('<tr/>');  
            for (var colIndex = 0; colIndex < columns.length; colIndex++) {  
                var cellValue = jsondata[i][columns[colIndex]];  
                if (cellValue == null)  
                    cellValue = "";  
                row$.append($('<td/>').html(cellValue));  
            }  
            $(tableid).append(row$);  
        }  
    }  

    function BindTableHeader(jsondata, tableid) {/*Function used to get all column names from JSON and bind the html table header*/  
        var columnSet = [];  
        var headerTr$ = $('<tr/>');  
        for (var i = 0; i < jsondata.length; i++) {  
            var rowHash = jsondata[i];  
            for (var key in rowHash) {  
                if (rowHash.hasOwnProperty(key)) {  
                    if ($.inArray(key, columnSet) == -1) {/*Adding each unique column names to a variable array*/  
                        columnSet.push(key);  
                        headerTr$.append($('<th/>').html(key));  
                    }  
                }  
            }  
        }  
        $(tableid).append(headerTr$);  
        return columnSet;  
    } 
    
</script>

<script>

    $(document).ready(function () {

        // 21-07-2021
        $('.tab_parent').on('click', function () {

            var jenis = $(this).attr('jenis_input');
            $('#jenis_input').val(jenis);

        })  

        if( typeof window.tinymce != 'undefined' && $(window.tinymce.editors).length > 0 ){
            $(window.tinymce.editors).each(function(idx) {
                try {
                tinymce.remove(idx);
                } catch (e) {}
            });
        }

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

        // 21-06-2021
        // menampilkan tabel_dok
        var tabel_dok_mop = $('#tabel_dok_mop').DataTable({
            "processing"        : true,
            "order"             : [],
            "ajax"              : {
                "url"   : "<?= base_url() ?>binding/tampil_dok_mop",
                "type"  : "POST",
                "data"  : function (data) {
                    data.id_mop     = "<?= $id_mop ?>";
                },
            },
            "columnDefs"        : [{
                "targets"   : [0,5],
                "orderable" : false
            }, {
                'targets'   : [0,5],
                'className' : 'text-center',
            }]
        })

        // 21-06-2021
        $('#clear').on('click', function () {

            $('#exceltable').html('');  
            $('#excelfile').val('');

        })

        // 21-06-2021
        // menampilkan tabel_list_tertanggung
        var tabel_list_tertanggung = $('.tabel_list_tertanggung').DataTable({
            "processing"        : true,
            "order"             : [],
            "ajax"              : {
                "url"   : "<?= base_url() ?>binding/tampil_tertanggung",
                "type"  : "POST",
                "data"  : function (data) {
                    data.id_mop     = $('#id_mop_endors').val();
                    data.id_relasi  = $('#id_relasi_endors').val();
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

        // 21-06-2021
        $('#simpan_dok').on('click', function () {

            var form_data = new FormData($('#form_dokumen')[0]);

            swal({
                title       : 'Konfirmasi',
                text        : 'Yakin akan simpan dokumen ?',
                type        : 'warning',

                buttonsStyling      : false,
                confirmButtonClass  : "btn btn-primary",
                cancelButtonClass   : "btn btn-danger mr-3",

                showCancelButton    : true,
                confirmButtonText   : 'Ya, simpan',
                confirmButtonColor  : '#d33',
                cancelButtonColor   : '#3085d6',
                cancelButtonText    : 'Batal',
                reverseButtons      : true
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        url         : '<?= base_url("binding/simpan_dokumen") ?>',
                        dataType    : 'json',
                        cache       : false,
                        contentType : false,
                        processData : false,
                        data        : form_data,
                        type        : 'post',
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

                    return false;
                } else if (result.dismiss === swal.DismissReason.cancel) {

                    swal({
                            title               : 'Batal',
                            text                : 'Anda membatalkan simpan dokumen',
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


        $('#tabel_dok_endors').on('click', '.edit', function () {

            var id_dokumen  = $(this).data('id');
            var desc        = $(this).attr('desc');
            var filename    = $(this).attr('filename');

            $('#id_dokumen').val(id_dokumen);
            $('#nama_dokumen').val(filename);
            $('#desc').val(desc);

            $('#aksi').val('Ubah');

        })

        // hapus dokumen
        $('#tabel_dok_endors').on('click', '.hapus', function () {
            
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
                        url         : "<?= base_url() ?>binding/simpan_dokumen",
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

        // tambah additional

        function total2() {

            var isi     = $('#diskon').val().split('.').join('');
            var kondisi = $('#kondisi_diskon').val();

            var total_krg = 0;

            if (kondisi == 'premi standar') {

                if ($('.premi_asli_standar').val() == '') {
                    var isi_premi = 0;
                } else {
                    var isi_premi = $('.premi_asli_standar').val().split('.').join('');
                }

                var total   = 0;
                var ttl_tt  = 0;

                if (isi == '' || isi == 0) {
                    total   =  isi_premi;
                    ttl_tt  = 0;
                } else {
                    ttl_tt  = parseInt(isi_premi) * (isi / 100);
                    total   = parseInt(isi_premi) - parseInt(ttl_tt);
                }
                
                // $('.premi_standar').val(number_format(total,0,',','.')); 
            
            } else {

                var isi_premi_tt = $('#total_akhir_premi_asli').val().split('.').join('');

                var total_tt    = 0;
                var ttl_tt      = 0;

                if (isi == '' || isi == 0) {
                    total_tt  =  isi_premi_tt;
                    total_krg = 0
                } else {
                    ttl_tt    = (parseInt(isi_premi_tt) / 100) * isi;
                    total_tt  = parseInt(isi_premi_tt) - parseInt(ttl_tt);
                    total_krg = ttl_tt;
                }
                
                $('#total_akhir_premi').val(number_format(total_tt,0,',','.'));

            }

            var total_persen        = 0;
            var total_persen_lain   = 0;
            var total_nilai         = 0;
            var total_nilai_lain    = 0;
            $('.total_premi').each(function () {
                    
                var persen    = $(this).val();
                
                total_persen  += parseFloat(persen);

            })

            $('.premi_lain').each(function () {
                    
                var persen1    = $(this).val();
                
                total_persen_lain  += parseFloat(persen1);

            })

            $('.total_premi_rp').each(function () {
                    
                var nilai    = $(this).val().split('.').join('');
                
                total_nilai  += parseInt(nilai);

            })

            $('.premi_rp_lain').each(function () {
                    
            var nilai1    = $(this).val().split('.').join('');
                
            total_nilai_lain  += parseInt(nilai1);

            })

            var tt_persen = total_persen + total_persen_lain;

            var tap = (parseInt(total_nilai) + parseInt(total_nilai_lain) - (parseInt(total_krg))) - parseInt(ttl_tt);

            $('#total_persen_premi').val(parseFloat(tt_persen));
            $('#total_akhir_premi').val(number_format(tap,0,',','.'));
            $('#total_akhir_premi_asli').val(number_format(parseInt(total_nilai) + parseInt(total_nilai_lain),0,',','.'));
            $('#gross_premi').val(number_format(parseInt(total_nilai) + parseInt(total_nilai_lain),0,',','.'));
            $('#total_diskon').val(number_format(ttl_tt,0,',','.'));

            // var tt_ap    = $('#total_akhir_premi').val().split('.').join('');

            // $('#total_akhir_premi').val(number_format(parseInt(tt_ap) - parseInt(total)));

            // jika ada dikson pada total premi
            // var isi_premi_tt = $('#total_akhir_premi_asli').val().split('.').join('');

            // var total_tt    = 0;
            // var ttl_tt      = 0;
            // var isi         = $('#diskon').val().split('.').join('');

            // if (isi == '' || isi == 0) {
            //   total_tt =  isi_premi_tt;
            // } else {
            //   ttl_tt   = (parseInt(isi_premi_tt) / 100) * isi;
            //   total_tt = parseInt(isi_premi_tt) - parseInt(ttl_tt);
            // }
            
            // $('#total_akhir_premi').val(number_format(total_tt,0,',','.'));

            var biaya_admin = $('#biaya_admin').val().split('.').join('');
            var total_premi = $('#total_akhir_premi').val().split('.').join('');

            var tt_tagihan  = parseInt(biaya_admin) + parseInt(total_premi);

            if (biaya_admin == '') {
            tt_tagihan = total_premi;
            }

            $('#total_tagihan').val(number_format(tt_tagihan,0,',','.'));

            return true;

        }

        var a = 7777;
        // 21-06-2021
        $('#tambah_additional').on('click', function () {

            var id = $(this).attr('id_lob');

            list = 
                `
                <div class="row" id="list_add`+a+`">
                    <div class="col-md-12">
                        <div class="form-group row p-0">
                            <div class="col-sm-12">
                                <button type="button" data-toggle="tooltip" data-placement="top" title="Hapus" class="btn btn-danger remove" data-id="`+a+`"><i class="fa fa-times"></i></button>
                            </div>
                        </div>
                        
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label for="no_klaim" class="col-sm-4 col-form-label">Pilih LOB Lainnya</label>
                            <div class='col-sm-8'>
                            <select name="lob_lain" class="select2 lob_lain lob_adt">
                                <option value=""></option>
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
                                <input type="text" class="text-right form-control kalkulasi_tsi_adt" id="kalkulasi`+a+`" placeholder="0" readonly>
                            </div>
                            </div>
                        </div>    
                    </div>
                    <div class="col-md-6">
                    <div class="form-group row">
                            <label for="no_klaim" class="col-sm-4 col-form-label">Persentase Pengali TSI</label>
                            <div class='col-sm-8'>
                            <div class='input-group'>
                                <input type='text' class='form-control text-right persen pengali pengali_tsi_adt' data-id="`+a+`" placeholder="0">
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
                                <input type='text' class='form-control text-right persen premi_lain rate_adt rate_`+a+`' data-id="`+a+`" placeholder="0">
                                <div class='input-group-append'>
                                    <span class='input-group-text' id='basic-addon2'>%</span>
                                </div>
                            </div>
                            </div>
                            <div class="col-sm-4">
                                <input type="text" class="form-control text-right premi_rp_lain nominal_adt"  id="t_premi_lain`+a+`" value="0" readonly>
                            </div>
                        </div> 
                    </div>
                </div>
                `;    

            $('#show_additional').append(list);
            $('#list_add'+a).hide().slideDown();

            $('.select2').select2({
                theme       : 'bootstrap4',
                width       : 'style',
                placeholder : $(this).attr('placeholder'),
                allowClear  : false
            });

            $('.persen').keyup(function(){
                var val = $(this).val();
                if(isNaN(val)){
                    val = val.replace(/[^0-9\.]/g,'');
                    if(val.split('.').length>2) 
                        val =val.replace(/\.+$/,"");
                }
                $(this).val(val); 
            });

            $.ajax({
                type:"GET",
                url:"<?php echo base_url(); ?>entry_sppa/show_premi/"+id,
                dataType : "JSON",
                success  : function (data) {
                    
                    $('.lob_lain').html(data.option_lob);

                },
                error: function (jqXHR, textStatus, errorThrown)
                {
                    swal({
                        title               : "Gagal",
                        text                : 'Gagal menampilkan data',
                        type                : 'error',
                        showConfirmButton   : false,
                        timer               : 3000,
                                allowOutsideClick   : false
                    }); 

                    return false;
                }
            });

            a++;

        })

        $('#show_additional').on('click', '.remove', function() {

            var id = $(this).data('id');

            $('#list_add'+id).slideUp(function(){ 
            $(this).remove();

            total2();

            });

            });

            $('#show_additional').on('keyup', '.pengali', function () {

            var id    = $(this).data('id');
            var value = $(this).val();
            var tsi   = $('#tsi').val().split('.').join('');

            var total = tsi * (value / 100);

            $('#kalkulasi'+id).val(number_format(total,0,',','.'));

            var rate_lain = $('.rate_'+id).val();
            var kalkulasi = $('#kalkulasi'+id).val().split('.').join('');

            var totall = kalkulasi * (rate_lain / 100);

            $('#t_premi_lain'+id).val(number_format(totall,0,',','.'));

            total2();

        })

        $('#show_additional').on('keyup', '.premi_lain', function () {

            var id    = $(this).data('id');
            var value = $(this).val();
            var si    = $('#kalkulasi'+id).val().split('.').join('');

            var total = si * (value / 100);

            $('#t_premi_lain'+id).val(number_format(total,0,',','.'));

            total2();

        })

        // premi dan termin
        $('.persen').keyup(function(){
            var val = $(this).val();
            if(isNaN(val)){
                val = val.replace(/[^0-9\.]/g,'');
                if(val.split('.').length>2) 
                    val =val.replace(/\.+$/,"");
            }
            $(this).val(val); 
        });

        // 21-06-2021
        $('#diskon').on('keyup', function () {

            var value  = $(this).val().split('.').join('');

            $('#diskon').val(Math.max(Math.min(value, 100), -100)); 

            total2();

        })

        function number_format (number, decimals, dec_point, thousands_sep) {
            number = (number + '').replace(/[^0-9+\-Ee.]/g, '');

            var n = !isFinite(+number) ? 0 : +number,
            prec  = !isFinite(+decimals) ? 0 : Math.abs(decimals),
            sep   = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
            dec   = (typeof dec_point === 'undefined') ? '.' : dec_point,
            s = '',
            toFixedFix = function (n, prec) {
                var k = Math.pow(10, prec);
                return '' + Math.round(n * k) / k;
            };
            s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
            if (s[0].length > 3) {
                s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
            }
            if ((s[1] || '').length < prec) {
                s[1] = s[1] || '';
                s[1] += new Array(prec - s[1].length + 1).join('0');
            }
            return s.join(dec);

        }

        $('#tsi').on('keyup', function () {

            var value         = $(this).val().split('.').join('');

            $('.total_premi').each(function () {
                        
                var aksi      = $(this).attr('label');
                var persen    = $(this).val();

                var total     = value * (persen / 100);


                $('.p_total_'+aksi).val(number_format(total,0,',','.'));
                $('.p_total_asli_'+aksi).val(number_format(total,0,',','.'));
                

            })

            total2();
        
        })

        $('#show_premi').on('keyup', '.total_premi', function () {
        
            var aksi      = $(this).attr('label');
            var persen    = $(this).val();
            var value     = $('#tsi').val().split('.').join('');

            var total     = value * (persen / 100);

            $('.p_total_'+aksi).val(number_format(total,0,',','.'));

            total2();

        })

        $('#biaya_admin').on('keyup', function () {

            var biaya_admin = $('#biaya_admin').val().split('.').join('');
            var total_premi = $('#total_akhir_premi').val().split('.').join('');

            var tt_tagihan  = parseInt(biaya_admin) + parseInt(total_premi);

            if (biaya_admin == '') {
                tt_tagihan = total_premi;
            }

            $('#total_tagihan').val(number_format(tt_tagihan,0,',','.'));
        
        })
    
        $('#payment_method').on('change', function () {

            var value = $(this).val();

            if (value == '') {
                $('.f_pay').fadeOut();
            } else {
                $('.f_pay').fadeIn();
            }
        
        })

        // 11-05-2021
        var tabel_termin = $('#tabel_termin_endors').DataTable({
            "processing"        : true,
            "order"             : [],
            "ajax"              : {
                "url"   : "<?= base_url() ?>binding/tampil_data_termin_endors",
                "type"  : "POST",
                "data"  : function (data) {
                    data.id_mop    = $('#id_mop_termin').val();
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
            "bInfo"         : false,
            "bDestroy"      : true
        })

        $('#tambah_pembayaran').on('click', function () {

            $('#modal_termin').modal('show');

            $('#form_termin_m').trigger("reset");

            $('#aksi_termin').val('Tambah');
        
        })

        // aksi simpan data termin
        $('#simpan_termin').on('click', function () {

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
                            url     : "<?= base_url() ?>binding/simpan_data_termin",
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
                            },
                            error: function (jqXHR, textStatus, errorThrown)
                            {
                                swal({
                                    title               : "Gagal",
                                    text                : 'Gagal menampilkan data',
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

            }

        })

        // edit data termin
        $('#tabel_termin_endors').on('click', '.edit', function () {

            var id_termin  = $(this).data('id');

            $.ajax({
                url         : "<?= base_url() ?>binding/ambil_data_termin/"+id_termin,
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
                        timer               : 3000,
                                allowOutsideClick   : false
                    }); 

                    return false;
                }
            })

            return false;

        })

        // hapus termin
        $('#tabel_termin_endors').on('click', '.hapus', function () {
            
            var id_termin   = $(this).data('id');
            
            swal({
                title       : 'Konfirmasi',
                text        : 'Yakin akan hapus termin ?',
                type        : 'warning',

                buttonsStyling      : false,
                confirmButtonClass  : "btn btn-danger",
                cancelButtonClass   : "btn btn-primary mr-3",

                showCancelButton    : true,
                confirmButtonText   : 'Ya, hapus',
                confirmButtonColor  : '#d33',
                cancelButtonColor   : '#3085d6',
                cancelButtonText    : 'Batal',
                reverseButtons      : true
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        url         : "<?= base_url() ?>binding/simpan_data_termin",
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
                        error: function (jqXHR, textStatus, errorThrown)
                        {
                            swal({
                                title               : "Gagal",
                                text                : 'Gagal menampilkan data',
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

</div>