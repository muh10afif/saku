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
                <a href="<?= base_url('restitusi/form_tambah_data') ?>"><button class="btn btn-primary float-right" id="tambah_restitusi"><i class="ti-plus mr-2"></i>Tambah Data</button></a>
                <h5 id="judul" class="mb-0 mt-1"><i class="mdi mdi-filter mr-1"></i> Filter</h5>
            </div>
            <div class="card-body table-responsive">

                <div class="d-flex justify-content-center">
                    <div class="col-md-8">
                        <div class="form-group row">
                            <label for="no_restitusi" class="col-sm-3 col-form-label">No Restitusi</label>
                            <div class="col-sm-9">
                                <input class="form-control" type="text" id="no_restitusi">
                            </div>
                        </div>   
                        <div class="form-group row">
                            <label for="no_polis" class="col-sm-3 col-form-label">No Polis</label>
                            <div class="col-sm-9">
                                <input class="form-control" type="text" id="no_polis">
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
                            <label for="co_as" class="col-sm-3 col-form-label">Status Pembayaran</label>
                            <div class="col-sm-9">
                                <select name="co_as" id="co_as" class="form-control">
                                    <option value="">Belum</option>
                                </select>
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
                            <th>Proses</th>
                            <th>Tanggal Bayar</th>
                            <th>Nilai Bauar</th>
                            <th>No Restitusi</th>
                            <th>No Polis</th>
                            <th>Nilai</th>
                            <th>K_suratbjb_dt</th>
                            <th>Nama Nasabah</th>
                            <th>Premi</th>
                            <th>Cabang</th>
                            <th>Alamat</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1.</td>
                            <td align="center" width="10%"><select name="" id="" class="form-control"><option value="">Proses</option></select></td>
                            <td align="center"><input type="text" class="form-control datepicker text-center"></td>
                            <td align="center"><input type="text" class="form-control"></td>
                            <td>4.2323.445.22</td>
                            <td>2.100.232.2344</td>
                            <td>2.000.000</td>
                            <td>0000-00-00</td>
                            <td>Ahmad</td>
                            <td>200.000</td>
                            <td>Soreang</td>
                            <td>bandung</td>
                        </tr>
                    </tbody>
                    <tfoot>
                        <tr >
                            <td colspan="13"><span class="mb-2"><button class="btn btn-primary">Simpan Data</button></td>
                        </tr>
                    </tfoot>
                </table>

                <span>Ket. <i class="fas fa-square-full text-danger"></i> - Polis Lama</span>
            </div>
        </div>
    </div>
</div>