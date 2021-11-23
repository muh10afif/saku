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
    <li class="nav-item">
        <a class="nav-link link_entry link_released" data-toggle="tab" href="#t_invoice" role="tab">
        <span class="d-none d-md-block">Debit Note</span><span class="d-block d-md-none"><i class="mdi mdi-settings h5"></i></span>
        </a>
    </li>
    </ul>
    
    <!-- Tab panes -->
    <div class="tab-content">
    <div class="tab-pane active p-3" id="t_client_data" role="tabpanel">
        <form action="#" id="form_client">
        <input type="hidden" class="sppa_number_d" name="sppa_number" value="<?= $tr_sppa['sppa_number'] ?>">
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
                                <?php foreach ($detail_lob as $d): $name = str_replace(" ","_", strtolower($d['field_sppa']));
                                
                                if ($d['cdb'] == 't') {

                                    $is = $nasabah_ptg[$name];
                                    
                                } else {

                                    $is = $tr_sppa[$name];
                                    
                                }
                                
                                ?>
                                    <div class="form-group row">
                                        <label for="no_klaim" class="col-sm-4 col-form-label"><?= ucwords($d['field_sppa']) ?></label>
                                        <div class="col-sm-8 mt-2">
                                            <span>: <?= $is ?></span>
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
        <form action="" id="form_dokumen">
            <input type="hidden" class="aksi" id="aksi" name="aksi" value="Tambah">
            <input type="hidden" class="id_dokumen" id="id_dokumen" name="id_dokumen">
            <input type="hidden" class="nama_dokumen" id="nama_dokumen" name="nama_dokumen">
            <input type="hidden" class="id_sppa id_sppa_dok" name="id_sppa" id="id_sppa_dok" value="<?= $id_sppa ?>">
            <input type="hidden" class="sppa_number_dok" name="sppa_number" id="sppa_number" value="<?= $tr_sppa['sppa_number'] ?>">
            <div class="d-flex justify-content-center mb-1 mt-3">
                <div class="col-md-5">
                <div class="form-group row">
                    <label for="no_klaim" class="col-sm-3 col-form-label text-right">File</label>
                    <div class="col-sm-9">
                    <input type="file" id="doc" class="form-control doc" accept="application/msword, application/pdf" name="dokumen">
                    </div>
                </div>
                </div>
                <div class="col-md-5">
                    <div class="form-group row">
                    <label for="no_klaim" class="col-sm-3 col-form-label text-right">Deskripsi</label>
                    <div class="col-sm-9">
                        <input type="input" id="desc" class="form-control desc" name="desc" placeholder="Masukkan Deskripsi">
                    </div>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group row p-0">
                        <div class="col-sm-12">
                            <button type="button" class="btn btn-primary btn-block simpan_dok" id="simpan_dok">Simpan</button>
                        </div>
                    </div>
                    
                </div>
            </div>
        </form>
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
                        <div class="col-sm-8 mt-2 text-right">
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
            <div class="tab-pane p-3" id="termin_bayar" role="tabpanel">
                <div class="row">
                    <div class="col-md-12">
                        <input type="hidden" id="id_sppa_termin" value="<?= $id_sppa ?>">
                        <button type="button" class="btn btn-primary float-left" id="tambah_pembayaran">Tambah Pembayaran</button>
                        <table class="table table-bordered table-hover" style="border-collapse: collapse; border-spacing: 0; width: 100%;" id="tabel_termin" cellspacing="0">
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
                
            </div>
            </div>
            
        </form>
    </div>
    <div class="tab-pane p-3" id="t_invoice" role="tabpanel">
        
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

<!-- Modal -->
<div class="modal fade modal_termin" id="modal_termin" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header bg-primary text-white">
        <h5 class="modal-title mt-0" id="judul_modal">Tambah Data</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true" class="text-white">&times;</span>
        </button>
      </div>
        <form id="form_termin_m" autocomplete="off" class="form-control-line form_termin_m">
            <input type="hidden" class="id_termin" name="id_termin" id="id_termin">
            <input type="hidden" class="aksi aksi_termin" name="aksi" id="aksi_termin" value="Tambah">
            <input type="hidden" class="id_sppa" name="id_sppa" value="<?= $id_sppa ?>">
            <input type="hidden" class="" name="sppa_number" value="<?= $tr_sppa['sppa_number'] ?>">
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
                <button type="submit" class="btn btn-primary simpan_termin" id="simpan_termin"><i class="fas fa-check mr-2"></i>Simpan</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fas fa-ban mr-2"></i>Batal</button>
            </div>
        </form>
    </div>
  </div>
</div>

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
                    data.id_sppa    = $('#id_sppa_dok').val();
                    data.aksi       = 'entry';
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

        // 16-05-2021
        var tabel_termin = $('#tabel_termin').DataTable({
            "processing"        : true,
            "order"             : [],
            "ajax"              : {
                "url"   : "<?= base_url() ?>entry_sppa/tampil_data_termin",
                "type"  : "POST",
                "data"  : function (data) {
                    data.id_sppa    = $('#id_sppa_termin').val();
                },
            },
            "columnDefs"        : [{
                "targets"   : [0, 6],
                "orderable" : false
            }, {
                'targets'   : [0, 6],
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
        
        $('.numeric').numericOnly();

        $('.number_separator').divide({
            delimiter:'.',
            divideThousand: true, // 1,000..9,999
            delimiterRegExp: /[\.\,\s]/g
        });

        // 01-07-2021
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

        $('.tabel_dok').on('click', '.edit', function () {

            var id_dokumen  = $(this).data('id');
            var desc        = $(this).attr('desc');
            var filename    = $(this).attr('filename');

            $('#id_dokumen').val(id_dokumen);
            $('#nama_dokumen').val(filename);
            $('#desc').val(desc);

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
        
        $('#tambah_pembayaran').on('click', function () {

            $('#modal_termin').modal('show');

            $('#form_termin_m').trigger("reset");

            $('#aksi_termin').val('Tambah');

        })

        $('#form_termin_m').parsley({
            triggerAfterFailure: 'input change'
        });

        // aksi simpan data termin
        $('#form_termin_m').on('submit', function () {

            var form_termin = $('#form_termin_m').serialize();

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
                        timer               : 3000,
                                allowOutsideClick   : false
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