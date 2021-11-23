<div class="col-md-12 f_tambah" style="display: none;">

  <div class="card shadow">
    <div class="card-header mb-0">
      <button class="btn btn-light float-right batal_approval"><i class="mdi mdi-close mdi-18px"></i></button>
      <h5 id="judul" class="mb-0 mt-1"></h5>
    </div>
    <div class="card-body table-responsive">

      <div class="d-flex justify-content-center mb-2">
          <div class="col-md-6 sel_sppa">
            <div class="form-group row">
                <label for="sobb" class="col-sm-3 col-form-label text-right">SPPA Number</label>
                <div class="col-sm-8 text-center">
                    <select name="sppa_number" id="sppa_number" class="select2">
                        <option value="">Pilih SPPA Number</option>
                        <?php foreach ($sppa_number as $s): ?>
                            <option value="<?= $s['id_sppa_quotation'] ?>"><?= $s['sppa_number'] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
          </div>

          <div class="col-md-12 sppa_num" style="display: none;">
            <div class="form-group d-flex justify-content-center">
                <div class="col-md-12 text-center">
                    <h5>SPPA Number : <samp><mark id="sppa_number_apv"> </mark></samp></h5>
                </div>
            </div>
          </div>
      </div>

        <!-- <div class="f_gif" style="display: none;">
            <div class="d-flex justify-content-center">
                <div class="col-md-6 text-center offset-md-1">
                    <img src="<?= base_url('assets/img/loading1.gif') ?>" width="10%">
                </div>
            </div>
        </div> -->

      <div class="row f_tab" style="display: none;">
        
      </div>

    </div>
    <!-- <div class="card-footer f_simpan" style="display: none;">
      <div class="row">
        <div class="col-md-6">

        </div>
        <div class="col-md-6 d-flex justify-content-end">
          <button type="button" id="simpan" aksi="detail_insured" class="btn btn-warning mr-2"><i class="ti-arrow-right mr-2"></i>Lanjutkan</button>
          <button type="button" id="simpan_semua" aksi="" class="btn btn-primary mr-2"><i class="ti-check-box mr-2"></i>Simpan</button>
          <button type="button" id="" class="btn btn-danger batal_approval"><i class="ti-close mr-2"></i>Batal</button>
        </div>
      </div>
    </div> -->
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
            <input type="hidden" class="id_sppa" name="id_sppa" >
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


