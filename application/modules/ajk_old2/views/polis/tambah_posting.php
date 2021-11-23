<!-- Page-Title -->
<div class="page-title-box">
    <div class="row align-items-center">
        <div class="col-sm-6">
            <h4><?= $title ?></h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-right">
                <li class="breadcrumb-item"><a href="<?= base_url() ?>">AJK</a></li>
                <li class="breadcrumb-item">Polis</li>
                <li class="breadcrumb-item active"><?= $title ?></li>
            </ol>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        
        <div class="card shadow">
            <div class="card-header">
                <a href="<?= base_url('ajk/polis/posting') ?>"><button class="btn btn-primary float-right" id="tambah_data"><i class="ti-arrow-left mr-2"></i>Kembali</button></a>
                <h5 id="judul" class="mb-0 mt-1"><i class="ti-plus mr-2"></i>Form Tambah</h5>
            </div>
            <div class="card-body table-responsive">

                <div class="d-flex justify-content-center">
                    
                    <div class="col-md-10">
                        <div class="form-group">
                            <mark><span class="text-danger">*</span> Mandatory (Harus diisi)</mark>
                        </div>
                        <div class="form-group row">
                            <label for="nm_nasabah" class="col-sm-3 col-form-label">Range Tanggal <span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <div class="input-daterange input-group" id="date-range">
                                    <input type="text" class="form-control" name="start" placeholder="Start Date" />
                                    <input type="text" class="form-control" name="end" placeholder="End Date" />
                                </div>
                            </div>
                        </div>  
                        <div class="form-group row">
                            <label for="nm_nasabah" class="col-sm-3 col-form-label">Spesifik Tanggal <span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <div class="input-group">
                                    <input type='text' name="tanggal" id="tanggal" class="form-control datepicker text-center"value="<?= date("d-m-Y", now('Asia/Jakarta')) ?>" readonly>
                                    <div class="input-group-append">
                                        <span class="input-group-text">
                                            <span class="ti-calendar"></span>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="card-footer">
                <div class="row">
                    <div class="col-md-12 d-flex justify-content-end">
                    <button type="button" id="btn-filter" class="btn btn-primary mr-2"><i class="ti-check-box mr-2"></i>Simpan</button>
                    <button type="button" id="btn-reset" tgl="<?= date('d-m-Y', now('Asia/Jakarta')) ?>" class="btn btn-danger"><i class="ti-na mr-2"></i>Reset</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="card shadow">
            <div class="card-body">
                <div class="alert alert-light text-dark" role="alert">
                    <strong>Mulai Range Tanggal 22-04-2021 s/d 24-04-2021. (Tanggal Awal Periode Polis)</strong>
                </div>
                <div class="alert alert-warning" role="alert">
                    <strong>Daftar Data Pre-Posting (Alokasi premi 1 Debitur 1 Asuransi)</strong><br>
                    <em>Silahkan Anda ubah "Alokasi Asuransi"-nya jika diperlukan <br> 
                    selanjutnya click tombol "POSTING" (dibawah daftar berikit ini), untuk melakukan proses posting data.</em>
                </div>
                <br>
                <table class="table table-bordered table-hover dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;" id="tabel_hari_besar" width="100%" cellspacing="0">
                    <thead class="thead-light text-center">
                        <tr>
                            <th width="5%">No</th>
                            <th>No Polis</th>
                            <th>Nama Nasabah</th>
                            <th>Cabang</th>
                            <th>Produk</th>
                            <th>Premi</th>
                            <th>Alokasi Asuransi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1.</td>
                            <td>PLS1292</td>
                            <td>Ahmad</td>
                            <td>Cabang</td>
                            <td>Produk</td>
                            <td>500.000</td>
                            <td>
                            <select name="alokasi" id="alokasi" class="form-control">
                                <option value="">Askrida</option>
                            </select>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="card-footer">
                <div class="row">
                    <div class="col-md-12 d-flex justify-content-end">
                    <button type="button" id="btn-filter" class="btn btn-primary mr-2"><i class="ti-flag mr-2"></i>Posting</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>