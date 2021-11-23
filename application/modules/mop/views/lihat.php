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
                <li class="breadcrumb-item active"><?= $title ?></li>
            </ol>
        </div>
    </div>
</div>
<input type="hidden" id="status_toggle">
<div class="row">
    <div class="col-md-12 f_tambah" style="display: none;">
        <div class="card shadow">
           
            <div class="card-header">
            <button class="btn btn-light float-right batal_mop"><i class="mdi mdi-close mdi-18px"></i></button>
            <h5 id="judul_atas">Tambah Data</h5>
            </div>
            <form id="form_mop" autocomplete="off">
                <input type="hidden" name="id_mop" id="id_mop">
                <input type="hidden" name="aksi" id="aksi" value="Tambah">
                <div class="card-body row">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label for="no_reff_mop" class="col-md-3 col-form-label text-left">No Reff MOP</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" name="no_reff_mop" id="no_reff_mop" value="<?= $no_reff ?>" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="no_mop" class="col-md-3 col-form-label text-left">Nomor MOP<span class="text-danger">*</span></label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" id="no_mop" name="no_mop" placeholder="Masukkan Nomor Dokumen" required>
                            </div>
                        </div> 
                        <div class="form-group row">
                            <label for="nm_mop" class="col-md-3 col-form-label text-left">Nama MOP <span class="text-danger">*</span></label>
                            <div class="col-md-9">
                                <input type="text" required class="form-control" id="nama_mop" name="nama_mop" placeholder="Masukkan Nama MOP">
                            </div>
                        </div> 
                        <!-- <div class="form-group row">
                            <label for="no_polis" class="col-md-3 col-form-label text-left">No Polis Induk / MOP <span class="text-danger">*</span></label>
                            <div class="col-md-9">
                                <input type="text" required class="form-control" id="no_polis_induk" name="no_polis_induk" placeholder="Masukkan Nomor Polis Induk / MOP">
                            </div>
                        </div>  -->
                        <div class="form-group row">
                            <label for="id_insured" class="col-md-3 col-form-label text-left">SOB </label>
                            <div class="col-md-9">
                                <input type="hidden" id="id_sob_sel">
                                <select name="id_sob" id="id_sob" class="select2">
                                    <option value="">Pilih SOB</option>
                                    <?php foreach ($sob as $s): ?>
                                        <option value="<?= $s['id_sob'] ?>"><?= $s['sob'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>   
                        <div class="form-group row">
                            <label for="id_insured" class="col-md-3 col-form-label text-left" id="l_detail">Detail SOB</label>
                            <div class="col-md-9">
                                <div class="row">
                                    <div class="col-md-8">
                                        <input type="hidden" id="d_sob_sel">
                                        <select name="d_sob" id="d_sob" class="select2" disabled>
                                            <option value="">Pilih Detail SOB</option>
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <button type="button" class="btn btn-primary btn-block mt-1" id="detail_sob" >Detail</button>
                                    </div>
                                </div>
                            </div>
                        </div>  
                        <div class="form-group row sel2">
                            <label for="id_insured" class="col-md-3 col-form-label text-left">Insured <span class="text-danger">*</span></label>
                            <div class="col-md-9">
                                <select name="id_insured" required data-parsley-required-message="Insured is required." id="id_insured" class="select2">
                                    <option value="">Pilih Insured</option>
                                    <?php foreach ($insured as $e): ?>
                                        <option value="<?= $e['id_nasabah'] ?>"><?= $e['nama_nasabah'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div> 
                        <div class="form-group row sel2">
                            <label for="id_insurer" class="col-md-3 col-form-label text-left">Insurer <span class="text-danger">*</span></label>
                            <div class="col-md-9">
                                <select name="id_insurer" required data-parsley-required-message="Insurer is required." id="id_insurer" class="select2" style="height: 100%;">
                                <option value="">Pilih Insurer</option>
                                <?php foreach ($insurer as $r): ?>
                                    <option value="<?= $r['id_asuransi'] ?>"><?= $r['nama_asuransi'] ?></option>
                                <?php endforeach; ?>
                                </select>
                            </div>
                        </div>    
                        <div class="form-group row">
                            <label for="id_insurer" class="col-md-3 col-form-label text-left">Produk Asuransi</label>
                            <div class="col-md-9">
                               <button class="btn btn-primary" type="button" id="tambah_prod_as" disabled hidden>Tambah Produk Asuransi</button> 
                               <button class="btn btn-primary" type="button" id="tambah_produk_asuransi" disabled>Tambah Produk Asuransi</button> 
                            </div>
                        </div>   
                        <div class="form-group row">
                            <div class="col-md-12 table-responsive">
                                <table class="table table-light mb-0 table-bordered table-hover" id="tabel_prod_as" style="border-collapse: collapse; border-spacing: 0; width: 100%; ">
                                    <thead class="thead-light text-center">
                                        <tr>
                                            <th>No.</th>
                                            <th>LOB</th>
                                            <th>Premi</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody id="show_prod_as">
                                    </tbody>
                                </table>
                            </div>
                        </div>   
                        
                        <div class="form-group row">
                            <label for="tgl_awal_polis" class="col-md-3 col-form-label text-left">Tanggal Awal Polis<span class="text-danger">*</span></label>
                            <div class="col-md-9">
                                <input type="text"  class="form-control datepicker" id="tgl_awal_polis" name="tgl_awal_polis" placeholder="Tanggal Awal Polis" required data-parsley-required-message="Tanggal awal polis harus terisi.">
                            </div>
                        </div> 

                        <div class="form-group row">
                            <label for="tgl_akhir_polis" class="col-md-3 col-form-label text-left">Tanggal Akhir Polis<span class="text-danger">*</span></label>
                            <div class="col-md-9">
                                <input type="text"  class="form-control datepicker" id="tgl_akhir_polis" name="tgl_akhir_polis" placeholder="Tanggal Akhir Polis" required data-parsley-required-message="Tanggal akhir polis harus terisi.">
                            </div>
                        </div> 

                        <div class="form-group row">
                            <label for="resiko_sendiri" class="col-md-3 col-form-label text-left">Resiko Sendiri</label>
                            <div class="col-md-9">
                                <textarea name="resiko_sendiri" class="tiny" id="resiko_sendiri" cols="30" rows="10"></textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="limit_minimal" class="col-md-3 col-form-label text-left">Limit Minimal</label>
                            <div class="col-md-9">
                                <input type="text" id="limit_minimal" name="limit_minimal" class="form-control numeric number_separator" placeholder="Masukkan Limit Minimal">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="berlaku_paling_lambat" class="col-md-3 col-form-label text-left">Berlaku Paling Lambat</label>
                            <div class="col-md-9">
                                <input type="text" id="berlaku_paling_lambat" name="berlaku_paling_lambat" class="form-control" placeholder="Masukkan Berlaku Paling Lambat">
                            </div>
                        </div> 
                        <div class="form-group row">
                            <label for="pengecualian" class="col-md-3 col-form-label text-left">Pengecualian</label>
                            <div class="col-md-9">
                                <textarea name="pengecualian" class="tiny" id="pengecualian" cols="30" rows="10"></textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="keterangan_premi" class="col-md-3 col-form-label text-left">Keterangan Premi</label>
                            <div class="col-md-9">
                                <textarea name="keterangan_premi" class="tiny" id="keterangan_premi" cols="30" rows="10"></textarea>
                            </div>
                        </div>
                        
                    </div>
                    <div class="col-md-6">
                        
                        <div class="form-group row">
                            <label for="nama_mop" class="col-md-3 col-form-label text-left">Objek Tertanggung</label>
                            <div class="col-md-9">
                                <textarea name="objek_tertanggung" class="tiny" id="objek_tertanggung" cols="30" rows="10"></textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="nama_mop" class="col-md-3 col-form-label text-left">Kondisi Pertanggungan</label>
                            <div class="col-md-9">
                                <textarea name="kondisi_pertanggungan" class="tiny" id="kondisi_pertanggungan" cols="30" rows="10"></textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="penyampaian_deklarasi" class="col-md-3 col-form-label text-left">Penyampaian Deklarasi</label>
                            <div class="col-md-9">
                                <textarea name="penyampaian_deklarasi" class="tiny" id="penyampaian_deklarasi" cols="30" rows="10" required></textarea>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="maksimal_pelaporan" class="col-md-3 col-form-label text-left">Maksimal Pelaporan</label>
                            <div class="col-md-9">
                                <input type="text" id="maksimal_pelaporan" name="maksimal_pelaporan" class="form-control" placeholder="Masukkan Maksimal Pelaporan">
                            </div>
                        </div>

                        <h5>Batas Wilayah</h5><hr>
                        <div class="form-group row">
                            <label for="id_negara" class="col-md-3 col-form-label text-left">Negara</label>
                            <div class="col-md-9">
                                <input type="hidden" id="id_negara_sel">
                                <select name="id_negara" id="id_negara" class="select2">
                                    <option value="">Pilih Negara</option>
                                    <?php foreach ($negara as $n): ?>
                                        <option value="<?= $n['id_negara'] ?>"><?= $n['negara'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="id_provinsi" class="col-md-3 col-form-label text-left">Provinsi</label>
                            <div class="col-md-9">
                                <input type="hidden" id="id_provinsi_sel">
                                <select name="id_provinsi" id="id_provinsi" class="select2">
                                    <option value="">Pilih Provinsi</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="id_kota" class="col-md-3 col-form-label text-left">Kota / Kabupaten</label>
                            <div class="col-md-9">
                                <input type="hidden" id="id_kota_sel">
                                <select name="id_kota" id="id_kota" class="select2">
                                    <option value="">Pilih Kota / Kabupaten</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="id_kecamatan" class="col-md-3 col-form-label text-left">Kecamatan</label>
                            <div class="col-md-9">
                                <input type="hidden" id="id_kecamatan_sel">
                                <select name="id_kecamatan" id="id_kecamatan" class="select2">
                                    <option value="">Pilih Kecamatan</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="id_desa" class="col-md-3 col-form-label text-left">Desa / Kelurahan</label>
                            <div class="col-md-9">
                                <input type="hidden" id="id_desa_sel">
                                <select name="id_desa" id="id_desa" class="select2">
                                    <option value="">Pilih Desa / Kelurahan</option>
                                </select>
                            </div>
                        </div>

                        <br>
                        <h5>Dokumen</h5>
                        <hr>
                        <div class="form-group d-flex justify-content-end">
                            <button type="button" class="btn btn-primary mb-2" id="tambah_dokumen"><i class="mdi mdi-arrow-down-thick"></i> Tambah Dokumen</button>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-striped tb_dok" style="display: none;">
                                <thead class="text-center">
                                    <tr>
                                        <th>No.</th>
                                        <th>Upload Dokumen</th>
                                        <th>Deskripsi</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody id="show_dokumen">
                                    
                                </tbody>
                            </table>
                        </div>
                         <!-- <br>               
                        <h4>Pengguna Tertanggung</h4>
                        <hr>
                        <div class="row">
                            <div class="col-md-8 mt-2">
                                <div class="form-group row">
                                <label for="sobb" class="col-sm-4 col-form-label">Upload Excel</label>
                                <div class="col-sm-8">
                                    <input type="file" class="form-control file_dok" id="excelfile" name="upload_excel" accept=".xls,.xlsx">
                                </div>
                                </div>
                            </div>
                            <div class="col-md-4 mt-2 text-center">
                                <a href="javascript:void(0)" id="url_format"><button type="button" class="btn btn-primary mr-2 ttip" data-toggle="tooltip" data-placement="top" title="Download Format Excel" id="download" disabled><i class="ti-download"></i></button></a>
                                <button type="button" class="btn btn-warning mr-2 ttip" data-toggle="tooltip" data-placement="top" title="Preview" id="preview" disabled><i class="ti-zoom-in"></i></button>
                                <button type="button" class="btn btn-danger mr-2 ttip" id="clear" data-toggle="tooltip" data-placement="top" title="Reset" disabled><i class="ti-eraser"></i></button>
                            </div>
                        </div> -->

                        <!-- <div class="form-group row">
                            <label for="maksimal_pelaporan" class="col-md-3 col-form-label text-left">Upload Dokumen</label>
                            <div class="col-md-9">
                                <input type="file" id="dokumen1" name="dokumen1" class="form-control">
                            </div>
                        </div> -->
                    </div>
                    <div class="col-md-12">
                        <p class="font-italic text-danger">(*) Data harus terisi.</p>
                    </div>
                    
                </div>
                <div class="card-footer">
                    <div class="form-group text-right mb-0">
                        <button type="submit" class="btn btn-primary mt-1 mr-2" id="simpan_mop"><i class="mr-2 fas fa-check"></i>Simpan</button>
                        <button type="button" class="btn btn-secondary mt-1 batal_mop" id="batal_mop"><i class="mr-2 fas fa-times "></i>Batal</button>
                    </div>
                </div>
            </form>
            
        </div>
    </div>
    <div class="col-12">
        <div class="card shadow">

            <?php if ($id_lvl_otorisasi == 0 || ($role['create'] == 'true')): ?>
                <div class="card-header">
                    <button class="btn btn-primary float-right" id="tambah_mop"><i class="fas fa-plus mr-2"></i>Tambah Data</button>
                    <!-- <h5 id="judul" class="mb-0 mt-1">Master Data Bagian</h5> -->
                </div>
            <?php endif; ?>
            <div class="card-body">
                <table class="table table-bordered table-hover dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;" id="tabel_master_mop" cellspacing="0">
                    <thead class="thead-light text-center">
                        <tr>
                            <th width="5%">No</th>
                            <th width="12%">No Reff MOP</th>
                            <th width="12%">Nomor MOP</th>
                            <th width="20%">Nama MOP</th>
                            <th width="15%">Insurer</th>
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

<div hidden>
<select name="list_lob" id="list_lob" class="form-control">
    <option value="">Pilih LOB</option>
    <?php foreach ($lob as $b): ?>
        <option value="<?= $b['id_lob'] ?>"><?= $b['lob'] ?></option>
    <?php endforeach; ?>
</select>
</div>

<!-- Modal -->
<div class="modal fade" id="modal_detail" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header bg-primary text-white">
        <h5 class="modal-title mt-0" id="judul_modal">Detail Data</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true" class="text-white">&times;</span>
        </button>
      </div>
        <form id="form_termin_m" autocomplete="off" class="form-control-line">
            <div class="modal-body">
                <div class="col-md-12 p-3">
                    <div class="form-group row">
                        <label for="tgl_awal" class="col-sm-3 col-form-label">Nama</label>
                        <div class="col-sm-9">
                            <span id="t_nama">: </span>
                        </div>
                    </div>  
                    <div class="form-group row">
                        <label for="tgl_awal" class="col-sm-3 col-form-label">Telp</label>
                        <div class="col-sm-9">
                            <span id="t_telp">: </span>
                        </div>
                    </div>  
                    <div class="form-group row">
                        <label for="tgl_awal" class="col-sm-3 col-form-label">Alamat</label>
                        <div class="col-sm-9">
                            <span id="t_alamat">: </span>
                        </div>
                    </div>  
                </div>
            </div>
        </form>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="modal_detail_mop" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
    <div class="modal-content">
        <div class="modal-header bg-primary text-white">
            <h5 class="modal-title mt-0">Detail MOP</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true" class="text-white">&times;</span>
            </button>
        </div>
        <div class="modal-body isi_detail">
            
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fas fa-ban mr-2"></i>Tutup</button>
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
            <table id="exceltable" class="table">  
            </table> 
          </div>
      </div>
      <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fas fa-ban mr-2"></i>Tutup</button>
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
            <input type="hidden" name="id_asuransi" id="id_asuransi_prod_as">
            <input type="hidden" name="id_mop" id="id_mop_prod_as">
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

<?php $this->load->view('js'); ?>