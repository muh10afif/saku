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
<div class="page-title-box">
    <div class="row align-items-center">
        <div class="col-sm-4">
            <h4><?= $title ?></h4>
        </div>
        <div class="col-sm-8">
            <ol class="breadcrumb float-right">
                <li class="breadcrumb-item"><a href="<?= base_url() ?>">All COB</a></li>
                <li class="breadcrumb-item">Transaction</li>
                <li class="breadcrumb-item">Finance and Accounting</li>
                <li class="breadcrumb-item active"><?= $title ?></li>
            </ol>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">

        <ul class="nav nav-tabs d-flex justify-content-center" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" data-toggle="tab" href="#home">
                    <span class="d-none d-md-block">Jurnal</span><span class="d-block d-md-none"><i class="mdi mdi-home-variant h5"></i></span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#buku_besar">
                    <span class="d-none d-md-block">Buku Besar</span><span class="d-block d-md-none"><i class="mdi mdi-home-variant h5"></i></span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#form_jurnal" hidden>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#detail_jurnal" hidden>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#form_jurnal_history" hidden>
                    <span class="d-none d-md-block">History</span><span class="d-block d-md-none"><i class="mdi mdi-home-variant h5"></i></span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#pembukuan2" id="pembukuan_btn2">
                    <span class="d-none d-md-block">Pembukuan</span><span class="d-block d-md-none"><i class="mdi mdi-home-variant h5"></i></span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#detail_bb" hidden>
                </a>
            </li>
        </ul>

        <div class="card shadow">
            <div class="tab-content pt-3">
                <div class="tab-pane active p-3" id="home">

                    <div class="row mb-2">
                        <div class="col-md-2">
                            <!-- <button type="button" class="btn btn-primary mb-2" id="btn-add-jurnal" data-toggle="modal" data-target="#add-name-jurnal" ><i class="fa fa-plus mr-2"></i> Tambah Jurnal</button> -->
                            <a href="<?= base_url('Jurnal_buku_besar/tambah_jurnal') ?>"><button type="button" class="btn btn-primary mb-2"><i class="fa fa-plus mr-2"></i> Tambah Jurnal</button></a>
                        </div>
                        <div class="col-md-4 float-right">
                            <input type="text" class="form-control datepicker_bulan text-center" name="" id="fil_jur_bulan" placeholder="Pilih Bulan" autocomplete="off">
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table id="tabel_jurnal" class="table table-bordered table-hover mt-3" style="border-collapse: collapse; border-spacing: 0; width: 100%;" width="100%" >
                            <thead class="bg-primary text-white text-center">
                                <tr>
                                    <th style="width:30px;">No</th>
                                    <th>Kode Transaksi</th>
                                    <th>Nama Transaksi</th>
                                    <th>Tanggal</th>
                                    <th>Total Debit</th>
                                    <th>Total Kredit</th>
                                    <th>Status</th>
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
        

    </div>
</div>

<div class="modal fade" id="add-name-jurnal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <!-- <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle"><i class="fa fa-plus"></i> Tambah Jurnal</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div> -->
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title mt-0">Tambah Jurnal</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true" class="text-white">&times;</span>
                </button>
            </div>
            <div class="modal-body p-3">

                <ul class="nav nav-tabs d-flex justify-content-center" role="tablist">
                  <li class="nav-item">
                    <a class="nav-link active" data-toggle="tab" href="#non_dek" role="tab">
                      <span class="d-none d-md-block">Buat Transaksi Baru</span><span class="d-block d-md-none"><i class="mdi mdi-home-variant h5"></i></span>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#dek" role="tab">
                      <span class="d-none d-md-block">History Transaksi</span><span class="d-block d-md-none"><i class="mdi mdi-home-variant h5"></i></span>
                    </a>
                  </li>
                </ul>

                <div class="tab-content">
                    <div class="tab-pane active p-4" id="non_dek" role="tabpanel">

                        <form method="POST" action="<?= base_url('Jurnal_buku_besar/hal_tambah_jurnal') ?>">
                            <div class="form-group row">
                                <label class="col-md-4 col-form-label mt-1" style="font-size: 15px;">Buat Transaksi Baru</label>
                                <div class="col-md-8 mt-1">
                                    <input type="text" name="nama_transaksi" class="form-control" id="nama_transaksi" placeholder="Nama Transaksi" required="required">
                                </div>
                            </div>
                            <hr>
                            <button type="submit" class="btn btn-primary float-right" id="btn-add-name-tr_tes">Buat Jurnal</button>
                        </form>
                        
                    </div>
                    <div class="tab-pane p-3" id="dek" role="tabpanel">

                        <form method="POST" action="<?= base_url('Jurnal_buku_besar/simpan_jurnal_history') ?>">

                            <div class="form-group row">
                                <label class="col-md-4 col-form-label mt-1" style="font-size: 15px;">History Transaksi</label>
                                <div class="col-md-8 mt-1">
                                    <input type="text" name="" id="nama_transaksi2" class="form-control" value="" placeholder="Nama Transaksi" required="required">
                                    <div class="form-group mt-3">
                                        <select name="" id="history_trans" class="form-control select2" required="required">
                                            <option value="">Pilih Histori Transaksi</option>
                                            <?php foreach ($data_jurnal as $var) : ?>
                                                <option value="<?php echo $var->id_jurnal ?>"><?php echo $var->nama_transaksi ?></option>
                                            <?php endforeach ?>
                                        </select>
                                    </div>
                                </div>
                                
                            </div>
                            <hr>
                            <button type="submit" class="btn btn-primary float-right " id="btn-add-name-tr2_tes">Buat Jurnal</button>
                        </form>
                        
                    </div>
                </div>
            </div>
            <!-- <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div> -->
        </div>
    </div>
</div>

<div class="modal fade" id="info" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-sm|modal-lg|modal-xl" role="document">
    <div class="modal-content">
        <div class="modal-header bg-primary text-white">
            <h5 class="modal-title mt-0">Catatan Perbaikan</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true" class="text-white">&times;</span>
            </button>
        </div>
        
        <div class="modal-body">
            <div class="card shadow">
            <div class="card-body">
                <p id="info-text"></p>
            </div>
            </div>
        </div>
    </div>
  </div>
</div>

<?php $this->load->view('jsnya'); ?>