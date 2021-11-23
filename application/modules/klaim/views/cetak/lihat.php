<style>
    input[type=checkbox] {
        transform: scale(1.3);
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
                <li class="breadcrumb-item"><a href="<?= base_url() ?>">AJK</a></li>
                <li class="breadcrumb-item active"><?= $title ?></li>
            </ol>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        
        <div class="card shadow">
            <div class="card-header">
                <h5 id="judul" class="mb-0 mt-1"><i class="mdi mdi-filter mr-1"></i> Filter</h5>
            </div>
            <div class="card-body table-responsive">

                <div class="d-flex justify-content-center">
                    <div class="col-md-8">
                        <div class="form-group row">
                            <label for="no_peserta" class="col-sm-3 col-form-label">No Klaim</label>
                            <div class="col-sm-9">
                                <input class="form-control" type="text" id="no_peserta">
                            </div>
                        </div>   
                        <div class="form-group row">
                            <label for="no_peserta" class="col-sm-3 col-form-label">No Polis</label>
                            <div class="col-sm-9">
                                <input class="form-control" type="text" id="no_peserta">
                            </div>
                        </div>   
                        <div class="form-group row">
                            <label for="nm_nasabah" class="col-sm-3 col-form-label">Nama Nasabah</label>
                            <div class="col-sm-9">
                                <input class="form-control" type="text" id="nm_nasabah">
                            </div>
                        </div>   
                        <div class="form-group row">
                            <label for="cabang" class="col-sm-3 col-form-label">Cabang Bank</label>
                            <div class="col-sm-9">
                                <select name="cabang" id="cabang" class="form-control">
                                    <option value="">Pilih Cabang</option>
                                </select>
                            </div>
                        </div> 
                        <div class="form-group row">
                            <label for="cetak" class="col-sm-3 col-form-label">Cetak Nota</label>
                            <div class="col-sm-9 mt-2">
                                <input type="checkbox" id="cetak">
                            </div>
                        </div> 
                        <div class="form-group row">
                            <label for="cetak" class="col-sm-3 col-form-label">Klaim 100 %</label>
                            <div class="col-sm-9 mt-2">
                                <input type="text" id="cetak" class="form-control">
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
                    <button type="button" id="btn-filter" class="btn btn-primary mr-2"><i class="ti-check-box mr-2"></i>Tampilkan</button>
                    <button type="button" id="btn-reset" tgl="<?= date('d-m-Y', now('Asia/Jakarta')) ?>" class="btn btn-danger"><i class="ti-na mr-2"></i>Reset</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="card mt-2 shadow">
            <div class="card-body">
                
                <table class="table table-bordered table-hover dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;" id="tabel_hari_besar" width="100%" cellspacing="0">
                    <thead class="thead-light text-center">
                        <tr>
                            <th width="5%">No</th>
                            <th>No Klaim</th>
                            <th>No Polis</th>
                            <th>Jenis Klaim</th>
                            <th>Tanggal Lapor</th>
                            <th>Tanggal Kejadian</th>
                            <th>Klaim 100%</th>
                            <th>K_suratbjb_dt</th>
                            <th>Cabang</th>
                            <th>Debitur</th>
                            <th>Alamat</th>
                            <th width="10%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td align="center">1.</td>
                            <td>1.20292992.192.0</td>
                            <td>1.98.192.0</td>
                            <td>KJDK</td>
                            <td>21 April 2021</td>
                            <td>21 April 2021</td>
                            <td>920.000.000</td>
                            <td>2.000.000</td>
                            <td>Soreang</td>
                            <td>Ahmad</td>
                            <td>Cimahi</td>
                            <td align="center"><button type="button" class="btn btn-success mr-2"><i class="ti-printer "></i></button><a href="<?= base_url('polis/detail/1/cetak') ?>"><button type="button" class="btn btn-info"><i class="ti-info"></i></button></a></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>