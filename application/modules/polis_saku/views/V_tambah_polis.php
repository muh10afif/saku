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
                <li class="breadcrumb-item">List Polis</li>
                <li class="breadcrumb-item active"><?= $title ?></li>
            </ol>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="card shadow">
            <div class="card-header">
                <a href="<?= base_url('Polis_saku') ?>"><button class="btn btn-primary float-right"><i class="fas fa-arrow-left mr-2"></i>Kembali</button></a>
            </div>
            <div class="card-body">

                <form id="form_sppa">

                    <div class="p-2">

                        <h4>Produk</h4><hr>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group row sel2">
                                <label for="sobb" class="col-md-3 col-form-label text-left">Asuransi</label>
                                <div class="col-md-9">
                                    <select name="id_asuransi" id="id_asuransi" class="select2" required>
                                    <option value="pilih">Pilih</option>
                                        
                                    </select>
                                </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group row sel2">
                                <label for="sobb" class="col-md-3 col-form-label text-left">Produk</label>
                                <div class="col-md-9">
                                    <select name="id_lob" id="id_lob" class="select2" required>
                                    <option value="pilih">Pilih</option>
                                    
                                    </select>
                                </div>
                                </div>
                            </div>
                            <div class="col-md-4 d_sob">
                                <div class="form-group row">
                                <label for="tocc" class="col-md-3 col-form-label" id="lbln">Premi</label>
                                <div class="col-md-9">
                                    <input type="hidden" id="id_detail_sob">
                                    <select name="premi" id="premi" class="select2">
                                        <option value="pilih">Pilih</option>
                                    </select>
                                </div>
                                </div>
                            </div>
                        </div>
                        <h4>Nasabah</h4><hr>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group row sel2">
                                <label for="sobb" class="col-md-3 col-form-label text-left">Nasabah</label>
                                <div class="col-md-9">
                                    <select name="id_nasabah" id="id_nasabah" class="select2" required>
                                    <option value="pilih">Pilih</option>
                                        
                                    </select>
                                </div>
                                </div>
                            </div>
                        </div>
                        <h4>Ahli Waris</h4><hr>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="card">
                                    <span class="text-center">Ahli Waris 1</span>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group row sel2">
                                                <label for="nik" class="col-md-3 col-form-label text-left">NIK</label>
                                                <div class="col-md-9">
                                                    <input type="text" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card">
                                    <span class="text-center">Ahli Waris 2</span>
                                </div>
                            </div>
                        </div>

                    </div>

                </form>
                
            </div>
        </div>
    </div>
</div>