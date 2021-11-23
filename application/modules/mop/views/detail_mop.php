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
    .table-responsive {
        display: table;
    }
</style>
<div class="page-title-box">
    <div class="row align-items-center">
        <div class="col-sm-6">
            <h4><?= $title ?></h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-right">
                <li class="breadcrumb-item"><a href="<?= base_url() ?>">All COB</a></li>
                <li class="breadcrumb-item">Incoming</li>
                <li class="breadcrumb-item"><a href="<?= base_url('mop') ?>">MOP</a></li>
                <li class="breadcrumb-item active"><?= $title ?></li>
            </ol>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="card shadow">
            <div class="card-header">
                <a href="<?= base_url() ?>mop"><button class="btn btn-primary float-right"><i class="fas fa-arrow-left mr-2"></i>Kembali</button></a>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label for="no_reff_mop" class="col-md-4 col-form-label text-left">No Reff MOP</label>
                            <div class="col-md-8 mt-1">
                                <span>: <?= $mop['no_reff_mop'] ?></span>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group row">
                            <label for="" class="col-md-4 col-form-label text-left">Nomor MOP</label>
                            <div class="col-md-8 mt-1">
                                <span>: <?= $mop['no_mop'] ?></span>
                            </div>
                        </div> 
                    </div>

                    <div class="col-md-12">
                        <hr>
                    </div>

                    <div class="col-md-6">

                        <div class="form-group row sel2">
                            <label for="id_insured" class="col-md-4 col-form-label text-left">Insured</label>
                            <div class="col-md-8 mt-1">
                                <span>: <?= $mop['nama_nasabah'] ?></span>
                            </div>
                        </div> 
                        
                        <!-- <div class="form-group row sel2">
                            <label for="id_cob" class="col-md-4 col-form-label text-left">COB</label>
                            <div class="col-md-8 mt-1">
                                <span>: <?= $mop['cob'] ?></span>
                            </div>
                        </div>  -->
                        
                    </div>

                    <div class="col-md-6">

                        <div class="form-group row sel2">
                            <label for="id_insurer" class="col-md-4 col-form-label text-left">Insurer</label>
                            <div class="col-md-8 mt-1">
                                <span>: <?= $mop['nama_asuransi'] ?></span>
                            </div>
                        </div>  

                        <!-- <div class="form-group row sel2">
                            <label for="id_lob" class="col-md-4 col-form-label text-left">LOB</label>
                            <div class="col-md-8 mt-1">
                                <span>: <?= $mop['lob'] ?></span>
                            </div>
                        </div>     -->

                        <!-- <div class="form-group row">
                            <label for="nilai_pertanggungan" class="col-md-4 col-form-label text-left">Nilai Pertanggungan</label>
                            <div class="col-md-8 mt-1">
                                <span>: Rp. <?= number_format($mop['nilai_pertanggungan'],0,'.','.') ?></span>
                            </div>
                        </div>  -->

                    </div>

                    <div class="col-md-12">
                        <hr>
                    </div>

                    <div class="col-md-6">

                        <div class="form-group row">
                            <label for="" class="col-md-4 col-form-label text-left">Tanggal Awal Polis</label>
                            <div class="col-md-8 mt-1">
                                <span>: <?= date("d-m-Y", strtotime($mop['tgl_awal_polis'])); ?></span>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="" class="col-md-4 col-form-label text-left">Tanggal Akhir Polis</label>
                            <div class="col-md-8 mt-1">
                                <span>: <?= date("d-m-Y", strtotime($mop['tgl_akhir_polis'])); ?></span>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="resiko_sendiri" class="col-md-4 col-form-label text-left">Resiko Sendiri</label>
                            <div class="col-md-8 mt-1">
                                <span>: <?= str_replace(array("<p>","</p>"), "", $mop['resiko_sendiri']) ?></span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="limit_minimal" class="col-md-4 col-form-label text-left">Limit Minimal</label>
                            <div class="col-md-8 mt-1">
                                <span>: <?= $mop['limit_minimal'] ?></span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="berlaku_paling_lambat" class="col-md-4 col-form-label text-left">Berlaku Paling Lambat</label>
                            <div class="col-md-8 mt-1">
                                <span>: <?= $mop['berlaku_paling_lambat'] ?></span>
                            </div>
                        </div> 
                        <!-- <div class="form-group row">
                            <label for="pengecualian" class="col-md-4 col-form-label text-left">Pengecualian</label>
                            <div class="col-md-8 mt-1">
                                <span>: <?= str_replace(array("<p>","</p>"), "", $mop['pengecualian']) ?></span>
                            </div>
                        </div> -->
                        <div class="form-group row">
                            <label for="keterangan_premi" class="col-md-4 col-form-label text-left">Keterangan Premi</label>
                            <div class="col-md-8 mt-1">
                                <span>: <?= str_replace(array("<p>","</p>"), "", $mop['keterangan_premi']) ?></span>
                            </div>
                        </div>
                        
                    </div>
                        
                        
                    <div class="col-md-6">

                        <div class="form-group row">
                            <label for="nama_mop" class="col-md-4 col-form-label text-left">Objek Tertanggung</label>
                            <div class="col-md-8 mt-1">
                                <span>: <?= str_replace(array("<p>","</p>"), "", $mop['objek_pertanggungan']) ?></span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="nama_mop" class="col-md-4 col-form-label text-left">Kondisi Pertanggungan</label>
                            <div class="col-md-8 mt-1">
                                <span>: <?= str_replace(array("<p>","</p>"), "", $mop['kondisi_pertanggungan']) ?></span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="penyampaian_deklarasi" class="col-md-4 col-form-label text-left">Penyampaian Deklarasi</label>
                            <div class="col-md-8 mt-1">
                                <span>: <?= str_replace(array("<p>","</p>"), "", $mop['penyampaian_deklarasi']) ?></span>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="maksimal_pelaporan" class="col-md-4 col-form-label text-left">Maksimal Pelaporan</label>
                            <div class="col-md-8 mt-1">
                                <span>: <?= $mop['maksimal_pelaporan'] ?></span>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="batas_wilayah" class="col-md-4 col-form-label text-left">Batas Wilayah</label>
                            <div class="col-md-8 mt-1">
                                <span>: <?= ($mop['desa'] != '') ? "Ds. ".$mop['desa'].", " : "" ?> <?= ($mop['kecamatan'] != '') ? "Kec. ".$mop['kecamatan'].", " : "" ?> <?= ($mop['kota'] != '') ? $mop['kota'].", " : "" ?> <?= ($mop['provinsi'] != '') ? $mop['provinsi'].", " : "" ?> <?= ($mop['negara'] != '') ? $mop['negara'] : "" ?></span>
                            </div>
                        </div>

                    </div>

                    <div class="col-md-12 table-responsive">
                        <hr>
                        <span class="font-weight-bold"> Dokumen </span><br><br>
                        <table class="table table-striped">
                            <thead class="thead-light text-center">
                                <tr>
                                    <th>No.</th>
                                    <th>File Name</th>
                                    <th>Deskripsi</th>
                                    <th>Size</th>
                                    <th>Last Update</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($list_dok)): ?>
                                    <?php $no=1; foreach ($list_dok as $d): ?>
                                        <tr>
                                            <td align="center"><?= $no++ ?>.</td>
                                            <td><?= wordwrap($d['filename'],35,"<br>\n"); ?></td>
                                            <td><?= wordwrap($d['description'],35,"<br>\n"); ?></td>
                                            <td><?= $d['size'] ?></td>
                                            <td align="center"><?= date("d-m-Y H:i:s", strtotime($d['updated_time'])) ?></td>
                                            <td align="center"><a href="<?= base_url('upload/dokumen/'.$d['filename']) ?>" class="ttip" data-toggle="tooltip" data-placement="top" title="File"><i class="mdi mdi-file-document-outline mdi-24px text-primary"></i></a></td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="6" align="center">Dokumen Kosong</td>
                                    </tr>
                                <?php endif; ?>
                                
                            </tbody>
                        </table>
                    </div>

                    <div class="col-md-12 table-responsive">
                        <hr>
                        <div class="row">
                            <div class="col-md-6">
                                <span class="font-weight-bold">Produk Asuransi</span>
                            </div>
                            <div class="col-md-6">
                                <button type="button" class="btn btn-primary float-right" id="tambah_prod_as">Tambah</button>
                            </div>
                        </div>
                        <br>
                        <table class="table table-bordered table-hover" id="tabel_prod_as" style="border-collapse: collapse; border-spacing: 0; width: 100%; ">
                            <thead class="thead-light text-center">
                                <tr>
                                    <th>No.</th>
                                    <th>LOB</th>
                                    <th>Premi</th>
                                    <th width="30%">Detail</th>
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
    </div>
</div>

<div class="row mt-3 row_detail" style="display: none;">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-6">
                        <h5 class="mt-0" id="judul"></h5> 
                    </div>
                    <div class="col-md-6">
                        <button type="button" class="close" style="color: black;">
                            <span ><i class="fa fa-times fa-md"></i></span>
                        </button>
                    </div>
                </div>
                
               
            </div>
            <div class="card-body card_detail row_manfaat" style="display: none;">
                
                <form id="form_manfaat" autocomplete="off">
                    <input type="hidden" name="id_produk_asuransi" class="id_produk_asuransi">
                    <input type="hidden" name="aksi" class="aksi" value="Tambah">
                    <input type="hidden" name="id_manfaat" id="id_manfaat">
                    <input type="hidden" name="tipe" class="tipe" value="manfaat">

                    <div class="row mb-0">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label for="maksimal_pelaporan" class="col-md-3 col-form-label text-left">Produk</label>
                                <div class="col-md-9 mt-1">
                                    <span class="t_produk">:</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label for="maksimal_pelaporan" class="col-md-3 col-form-label text-left">Premi</label>
                                <div class="col-md-9 mt-1">
                                    <span class="t_premi">:</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label for="maksimal_pelaporan" class="col-md-3 col-form-label text-left">Manfaat</label>
                                <div class="col-md-9">
                                    <textarea id="manfaat" name="manfaat" class="form-control" rows="5" placeholder="Masukkan Manfaat" required data-parsley-required-message="Manfaat harus terisi."></textarea>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="nilai" class="col-md-3 col-form-label text-left">Nilai Pertanggungan</label>
                                <div class="col-md-9">
                                    <input id="nilai" name="nilai" class="form-control numeric number_separator" placeholder="Masukkan Nilai Pertanggungan" required data-parsley-required-message="Nilai Pertanggungan harus terisi.">
                                </div>
                            </div>
                            
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label for="keterangan" class="col-md-3 col-form-label text-left">Keterangan</label>
                                <div class="col-md-9">
                                    <textarea id="keterangan" name="keterangan" class="form-control" rows="8" placeholder="Masukkan Keterangan" required data-parsley-required-message="Keterangan harus terisi."></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <button type="button" class="btn btn-danger float-right batal">Batal</button>
                            <button type="submit" class="btn btn-primary float-right mr-2">Simpan</button>
                        </div>
                        
                    </div>
                </form>
                <br>
                <div class="row mt-3">
                    <div class="col-md-12">
                        <table class="table table-bordered table-hover" id="tabel_manfaat" style="border-collapse: collapse; border-spacing: 0; width: 100%; ">
                            <thead class="thead-light text-center">
                                <tr>
                                    <th>No.</th>
                                    <th>Manfaat</th>
                                    <th>Nilai Pertanggungan</th>
                                    <th>Keterangan</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>   
                </div>
                
            </div>
            <div class="card-body card_detail row_syarat" style="display: none;">
                
                    <div class="row mb-0">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label for="maksimal_pelaporan" class="col-md-3 col-form-label text-left">Produk</label>
                                <div class="col-md-9 mt-1">
                                    <span class="t_produk">:</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label for="maksimal_pelaporan" class="col-md-3 col-form-label text-left">Premi</label>
                                <div class="col-md-9 mt-1">
                                    <span class="t_premi">:</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row">

                        <div class="col-md-7">
                            <table class="table table-bordered table-hover" id="tabel_syarat" style="border-collapse: collapse; border-spacing: 0; width: 100%; ">
                                <thead class="thead-light text-center">
                                    <tr>
                                        <th>No.</th>
                                        <th>Syarat</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
                        </div>
                        <div class="col-md-5">
                            <form id="form_syarat" autocomplete="off">
                                <input type="hidden" name="id_produk_asuransi" class="id_produk_asuransi">
                                <input type="hidden" name="aksi" class="aksi" value="Tambah">
                                <input type="hidden" name="id_syarat" id="id_syarat">
                                <input type="hidden" name="tipe" class="tipe" value="syarat">

                                <div class="form-group">
                                    <label for="maksimal_pelaporan" class="col-form-label text-left">Syarat</label>
                                    <div class="">
                                        <textarea id="syarat" name="syarat" class="form-control" rows="7" placeholder="Masukkan Syarat" required data-parsley-required-message="Syarat harus terisi."></textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <button type="button" class="btn btn-danger float-right batal">Batal</button>
                                    <button type="submit" class="btn btn-primary float-right mr-2">Simpan</button>
                                </div>
                            </form>
                        </div>
                        
                    </div>
            </div>
            <div class="card-body card_detail row_pengecualian" style="display: none;">
                <div class="row mb-0">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label for="maksimal_pelaporan" class="col-md-3 col-form-label text-left">Produk</label>
                            <div class="col-md-9 mt-1">
                                <span class="t_produk">:</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label for="maksimal_pelaporan" class="col-md-3 col-form-label text-left">Premi</label>
                            <div class="col-md-9 mt-1">
                                <span class="t_premi">:</span>
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="row">

                    <div class="col-md-7">
                        <table class="table table-bordered table-hover" id="tabel_pengecualian" style="border-collapse: collapse; border-spacing: 0; width: 100%; ">
                            <thead class="thead-light text-center">
                                <tr>
                                    <th>No.</th>
                                    <th>Pengecualian</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-5">
                        <form id="form_pengecualian" autocomplete="off">
                            <input type="hidden" name="id_produk_asuransi" class="id_produk_asuransi">
                            <input type="hidden" name="aksi" class="aksi" value="Tambah">
                            <input type="hidden" name="id_pengecualian" id="id_pengecualian">
                            <input type="hidden" name="tipe" class="tipe" value="pengecualian">

                            <div class="form-group">
                                <label for="maksimal_pelaporan" class="col-form-label text-left">Pengecualian</label>
                                <div class="">
                                    <textarea id="pengecualian" name="pengecualian" class="form-control" rows="7" placeholder="Masukkan Pengecualian" required data-parsley-required-message="Pengecualian harus terisi."></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <button type="button" class="btn btn-danger float-right batal">Batal</button>
                                <button type="submit" class="btn btn-primary float-right mr-2">Simpan</button>
                            </div>
                        </form>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="modal_prod_as" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header bg-primary text-white">
        <h5 class="modal-title mt-0">Tambah Produk Asuransi</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true" class="text-white">&times;</span>
        </button>
      </div>
        <form id="form_prod_as" autocomplete="off">
            <input type="hidden" name="aksi" id="aksi_prod_as" value="Tambah">
            <input type="hidden" name="id_produk_asuransi" id="id_prod_as">
            <input type="hidden" name="id_asuransi" value="<?= $mop['id_insurer'] ?>">
            <input type="hidden" name="id_mop" value="<?= $id_mop ?>">
            <div class="modal-body">
                <div class="col-md-12 p-3">
                    <div class="form-group row sel2">
                        <label for="" class="col-sm-3 col-form-label">LOB</label>
                        <div class="col-sm-9">
                            <select name="id_lob" id="id_lob" class="select2" required data-parsley-required-message="LOB harus terisi.">
                                <option value="">Pilih LOB</option>
                                <?php foreach ($lob as $l): ?>
                                    <option value="<?= $l['id_lob'] ?>"><?= $l['lob'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>  
                    <div class="form-group row">
                        <label for="tgl_awal" class="col-sm-3 col-form-label">Premi</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control text-right numeric number_separator" id="premi" name="premi" placeholder="0" required data-parsley-required-message="Premi harus terisi.">
                        </div>
                    </div>  
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Simpan</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
            </div>
        </form>
    </div>
  </div>
</div>

<?php $this->load->view('js_detail_mop'); ?>
