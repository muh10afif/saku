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
    <div class="col-md-12 f_tambah" style="display: none;">
        
        <div class="card shadow">
            <div class="card-header mb-0">
                <button class="btn btn-light float-right batal_approval"><i class="mdi mdi-close mdi-18px"></i></button>
                <h5 id="judul" class="mb-0 mt-1">Form Tambah Data</h5>
            </div>
            <div class="card-body table-responsive">

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label for="no_klaim" class="col-sm-3 col-form-label">SPPA</label>
                            <div class="col-sm-9">
                                <input class="form-control" type="text" id="no_klaim">
                            </div>
                        </div>  
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label for="no_klaim" class="col-sm-3 col-form-label">Polis</label>
                            <div class="col-sm-9">
                                <input class="form-control" type="text" id="no_klaim">
                            </div>
                        </div>  
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">

                        <ul class="nav nav-tabs d-flex justify-content-center mt-2" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="tab" href="#home" role="tab">
                                    <span class="d-none d-md-block">Client Data</span><span class="d-block d-md-none"><i class="mdi mdi-home-variant h5"></i></span> 
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#profile" role="tab">
                                    <span class="d-none d-md-block">Detail Insured</span><span class="d-block d-md-none"><i class="mdi mdi-account h5"></i></span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#messages" role="tab">
                                    <span class="d-none d-md-block">Documents</span><span class="d-block d-md-none"><i class="mdi mdi-email h5"></i></span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#settings" role="tab">
                                    <span class="d-none d-md-block">Premium Calculation</span><span class="d-block d-md-none"><i class="mdi mdi-settings h5"></i></span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#released" role="tab">
                                    <span class="d-none d-md-block">Approval</span><span class="d-block d-md-none"><i class="mdi mdi-settings h5"></i></span>
                                </a>
                            </li>
                        </ul>

                        <!-- Tab panes -->
                        <div class="tab-content">
                            <div class="tab-pane active p-3" id="home" role="tabpanel">
                                <h4>Source of Bussiness</h4><hr>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label for="no_klaim" class="col-sm-3 col-form-label">Source of Business</label>
                                            <div class="col-sm-9">
                                                <select name="soc" id="soc" class="form-control">
                                                    <option value="">Pilih</option>
                                                </select>
                                            </div>
                                        </div> 
                                        <div class="form-group row">
                                            <label for="no_klaim" class="col-sm-3 col-form-label">Name of Intermediation</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control">
                                            </div>
                                        </div> 
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label for="no_klaim" class="col-sm-3 col-form-label">Type of Contract</label>
                                            <div class="col-sm-9">
                                                <select name="soc" id="soc" class="form-control">
                                                    <option value="">Pilih</option>
                                                </select>
                                            </div>
                                        </div> 
                                        <div class="form-group row">
                                            <label for="no_klaim" class="col-sm-3 col-form-label">Cabang</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control">
                                            </div>
                                        </div> 
                                    </div>
                                </div>
                                <h4>Type of Business</h4><hr>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label for="no_klaim" class="col-sm-3 col-form-label">Class of Business</label>
                                            <div class="col-sm-9">
                                                <select name="soc" id="soc" class="form-control">
                                                    <option value="">Pilih</option>
                                                </select>
                                            </div>
                                        </div> 
                                        <div class="form-group row">
                                            <label for="no_klaim" class="col-sm-3 col-form-label">Currency Code</label>
                                            <div class="col-sm-9">
                                                <select name="soc" id="soc" class="form-control">
                                                    <option value="">Pilih</option>
                                                </select>
                                            </div>
                                        </div> 
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label for="no_klaim" class="col-sm-3 col-form-label">Line of Business</label>
                                            <div class="col-sm-9">
                                                <select name="soc" id="soc" class="form-control">
                                                    <option value="">Pilih</option>
                                                </select>
                                            </div>
                                        </div> 
                                    </div>
                                </div>
                                <h4>Insured and Interest Insured</h4><hr>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label for="no_klaim" class="col-sm-3 col-form-label">Insured Name</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control">
                                            </div>
                                        </div> 
                                        <div class="form-group row">
                                            <label for="no_klaim" class="col-sm-3 col-form-label">Remark</label>
                                            <div class="col-sm-9">
                                                <textarea name="remark" id="remark" cols="5" class="form-control"></textarea>
                                            </div>
                                        </div> 
                                        
                                        <div class="form-group row">
                                            <label for="no_klaim" class="col-sm-3 col-form-label">Type Of Business</label>
                                            <div class="col-sm-9">
                                                <select name="soc" id="soc" class="form-control">
                                                    <option value="">Pilih</option>
                                                </select>
                                            </div>
                                        </div> 
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label for="no_klaim" class="col-sm-3 col-form-label">Insured Address</label>
                                            <div class="col-sm-9">
                                                <textarea name="remark" id="remark" cols="5" class="form-control"></textarea>
                                            </div>
                                        </div> 
                                        <div class="form-group row">
                                            <label for="no_klaim" class="col-sm-3 col-form-label">City</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control">
                                            </div>
                                        </div> 
                                        <div class="form-group row">
                                            <label for="no_klaim" class="col-sm-3 col-form-label">Postal Code</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    
                                </div>
                            </div>
                            <div class="tab-pane p-3" id="profile" role="tabpanel">
                                <h4>Class of Business</h4><hr>
                            </div>
                            <div class="tab-pane p-3" id="messages" role="tabpanel">
                                <button class="btn btn-warning text-dark mb-3" id="tambah_dok"><i class="ti-plus mr-2"></i> Tambah Dokumen</button>
                                <table class="table table-bordered table-hover dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;" id="tabel_doc" width="100%" cellspacing="0">
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
                                        <tr>
                                            <td align="center">1.</td>
                                            <td>Dokumen 1</td>
                                            <td>surat.doc</td>
                                            <td>200 kb</td>
                                            <td align="center" width="15%"><button type="button" class="btn btn-success mr-2"><i class="ti-pencil"></i></button><button type="button" class="btn btn-danger mr-2"><i class="ti-close"></i></button><button type="button" class="btn btn-info"><i class="ti-info"></i></button></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="tab-pane p-3" id="settings" role="tabpanel">
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
                                                    <div class="col-sm-8">
                                                        <input type="text" class="form-control">
                                                    </div>
                                                </div> 
                                                <div class="form-group row">
                                                    <label for="no_klaim" class="col-sm-4 col-form-label">Discount</label>
                                                    <div class="col-sm-8 input-group">
                                                        <input type="text" class="form-control">
                                                        <div class="input-group-append">
                                                            <span class="input-group-text" id="basic-addon2">%</span>
                                                        </div>
                                                    </div>
                                                </div> 
                                                
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label for="no_klaim" class="col-sm-4 col-form-label">Total Premi Standar</label>
                                                    <div class="col-sm-8">
                                                        <input type="text" class="form-control">
                                                    </div>
                                                </div> 
                                                <div class="form-group row">
                                                    <label for="no_klaim" class="col-sm-4 col-form-label">Total Premi Perluasan</label>
                                                    <div class="col-sm-8">
                                                        <input type="text" class="form-control">
                                                    </div>
                                                </div> 
                                                <div class="form-group row">
                                                    <label for="no_klaim" class="col-sm-4 col-form-label"></label>
                                                    <div class="col-sm-8">
                                                        <input type="text" class="form-control">
                                                    </div>
                                                </div> 
                                            </div>
                                        </div>
                                        <h4>Total</h4><hr>
                                        <div class="row">
                                            <div class="col-md-6">
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label for="no_klaim" class="col-sm-4 col-form-label">Total Akhir Premi</label>
                                                    <div class="col-sm-8">
                                                        <input type="text" class="form-control">
                                                    </div>
                                                </div> 
                                            </div>
                                        </div>
                                        <h4>Internal</h4><hr>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label for="brokerage" class="col-sm-4 col-form-label">Brokerage</label>
                                                    <div class="col-sm-8 input-group">
                                                        <input type="text" class="form-control">
                                                        <div class="input-group-append">
                                                            <span class="input-group-text" id="basic-addon2">%</span>
                                                        </div>
                                                    </div>
                                                </div> 
                                                <div class="form-group row">
                                                    <label for="brokerage" class="col-sm-4 col-form-label">Ovveriding Comission</label>
                                                    <div class="col-sm-8 input-group">
                                                        <input type="text" class="form-control">
                                                        <div class="input-group-append">
                                                            <span class="input-group-text" id="basic-addon2">%</span>
                                                        </div>
                                                    </div>
                                                </div> 
                                                <div class="form-group row">
                                                    <label for="brokerage" class="col-sm-4 col-form-label">Additional Premium</label>
                                                    <div class="col-sm-8 input-group">
                                                        <input type="text" class="form-control">
                                                        <div class="input-group-append">
                                                            <span class="input-group-text" id="basic-addon2">%</span>
                                                        </div>
                                                    </div>
                                                </div> 
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label for="brokerage" class="col-sm-4 col-form-label"></label>
                                                    <div class="col-sm-8 input-group">
                                                        <input type="text" class="form-control">
                                                    </div>
                                                </div>  
                                                <div class="form-group row">
                                                    <label for="brokerage" class="col-sm-4 col-form-label"></label>
                                                    <div class="col-sm-8 input-group">
                                                        <input type="text" class="form-control">
                                                    </div>
                                                </div>  
                                                <div class="form-group row">
                                                    <label for="brokerage" class="col-sm-4 col-form-label"></label>
                                                    <div class="col-sm-8 input-group">
                                                        <input type="text" class="form-control">
                                                    </div>
                                                </div>  
                                            </div>
                                        </div>
                                        <h4>Payment Method</h4><hr>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label for="no_klaim" class="col-sm-4 col-form-label">Paymnet Method</label>
                                                    <div class="col-sm-8">
                                                        <select name="soc" id="soc" class="form-control">
                                                            <option value="">Pilih</option>
                                                        </select>
                                                    </div>
                                                </div> 
                                            </div>
                                        </div>
                                    </div>
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
                                                <tr>
                                                    <td align="center">1.</td>
                                                    <td>009/DFK/039</td>
                                                    <td>23-04-2021</td>
                                                    <td>10.000.000</td>
                                                    <td>Cash</td>
                                                    <td>23-04-2021</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane p-3" id="released" role="tabpanel">
                                <h4>Otorisasi</h4><hr>
                                <div class="d-flex justify-content-center">
                                    <div class="col-md-10">
                                        <div class="form-group row">
                                            <label for="no_klaim" class="col-sm-4 col-form-label">Insurance Company</label>
                                            <div class="col-sm-8">
                                                <select name="" id="" class="form-control">
                                                    <option value="">Pilih</option>
                                                </select>
                                            </div>
                                        </div> 
                                        <div class="form-group row">
                                            <label for="no_klaim" class="col-sm-4 col-form-label">Nomor Otorisasi/Polis</label>
                                            <div class="col-sm-8 input-group">
                                                <input type="text" class="form-control">
                                            </div>
                                        </div> 
                                        <div class="form-group row">
                                            <label for="no_klaim" class="col-sm-4 col-form-label">Tanggal Otorisasi/Polis</label>
                                            <div class="col-sm-8 input-group">
                                                <input type="text" class="form-control datepicker">
                                            </div>
                                        </div> 
                                        <div class="form-group row">
                                            <label for="no_klaim" class="col-sm-4 col-form-label">Disetujui Oleh</label>
                                            <div class="col-sm-8 input-group">
                                                <input type="text" class="form-control">
                                            </div>
                                        </div> 
                                        <div class="form-group row">
                                            <label for="no_klaim" class="col-sm-4 col-form-label">Keterangan Tambahan</label>
                                            <div class="col-sm-8 input-group">
                                                <textarea name="" id="" cols="5" class="form-control"></textarea>
                                            </div>
                                        </div> 
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                </div>

            </div>
            <div class="card-footer">
                <div class="row">
                    <div class="col-md-6">
                    
                    </div>
                    <div class="col-md-6 d-flex justify-content-end">
                    <button type="button" id="btn-filter" class="btn btn-primary mr-2"><i class="ti-check-box mr-2"></i>Approve</button>
                    <button type="button" id="" class="btn btn-danger batal_approval"><i class="ti-na mr-2"></i>Batal</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-12">
        <div class="card shadow">
            <div class="card-header">
                <button class="btn btn-primary float-right" id="tambah_approval"><i class="ti-plus mr-2"></i> Tambah Data</button>
                <h5 id="judul" class="mb-0 mt-1">SPPA Approval</h5>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-hover dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;" id="tabel_approval" width="100%" cellspacing="0">
                    <thead class="thead-light text-center">
                        <tr>
                            <th width="5%">No</th>
                            <th>No SPPA</th>
                            <th>Client [Insurer - Insured]</th>
                            <th>COB - LOB</th>
                            <th width="15%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1.</td>
                            <td>TMP.SPPA-2015.A00004.000003</td>
                            <td>PT. Asuransi Astra Buana</td>
                            <td>PROPERTY - PROPERTY ALL RISK</td>
                            <td align="center"><button type="button" class="btn btn-success mr-2"><i class="ti-pencil"></i></button><button type="button" class="btn btn-danger mr-2"><i class="ti-close"></i></button><button type="button" class="btn btn-info"><i class="ti-info"></i></button></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script>

    $(document).ready(function () {

        $('.table').DataTable();

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
        
    })
    
</script>