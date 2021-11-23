<div class="col-md-12 f_tambah" style="display: none;">

  <div class="card shadow">
    <div class="card-header mb-0">
      <button class="btn btn-light float-right batal_binding"><i class="mdi mdi-close mdi-18px"></i></button>
      <h5 id="judul" class="mb-0 mt-1">Detail</h5>
    </div>
    <div class="card-body table-responsive list_tabel_endors">

      <div class="d-flex justify-content-center mb-2">
          <div class="col-md-6 text-center">
            <h5>SPPA Number : <samp><mark id="sppa_number"> </mark></samp></h5>
          </div>
          <div class="col-md-6 text-center">
            <h5>No Polis : <samp><mark id="no_polis"> </mark></samp></h5>
          </div>
      </div>

      <?php if ($role['update'] == 'true' || $id_lvl_otorisasi == 0) : ?>
       <div class="row b_endorsment">
        <div class="col-md-12">
          <button type="button" class="btn btn-primary" id="endorsment"><i class="fas fa-pencil-alt mr-2"></i>Endorsment</button>
        </div>
       </div>
      <?php endif; ?>

       <div class="row kembali" style="display: none;">
        <div class="col-md-12">
          <button type="button" class="btn btn-warning" id="kembali_endors">Kembali</button>
        </div>
       </div>

       <div class="row b_simpan" style="display: none;">
        <div class="col-md-6">
          <button type="button" class="btn btn-primary" id="batal"><i class="fas fa-chevron-left mr-2"></i>Batal</button>
        </div>
        <div class="col-md-6 text-right">
          <button type="button" class="btn btn-primary mr-2" id="simpan_endorsment"><i class="fas fa-check mr-2"></i>Simpan</button>
          <button type="button" class="btn btn-danger" id="cancel_sppa"><i class="fas fa-times mr-2"></i>Cancelation SPPA</button>
        </div>
       </div>

      <div class="row f_tab" style="display: none;">
        
      </div>

      <div class="f_list" style="display: none;">
          <div class="d-flex justify-content-center">
          
            <div class="col-md-10">

              <input type="hidden" class="id_sppa" id="id_sppa_list">
              <table class="mt-3 table table-bordered table-hover dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;" id="tabel_list_endors" width="100%" cellspacing="0">
                  <thead class="thead-light text-center">
                      <tr>
                          <th width="5%">No</th>
                          <th>Endorsment</th>
                          <th>Tanggal Endorsment</th>
                          <th>Status</th>
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
    <div class="card-body table-responsive list_tabel_endors_dek" style="display: none;">

      <div class="d-flex justify-content-center mb-2">
          <div class="col-md-4 text-center">
            <h5>No Polis Induk : <samp><mark id="no_polis_induk"> </mark></samp></h5>
          </div>
          <div class="col-md-4 text-center">
            <h5>Nama MOP : <samp><mark id="nama_mop"> </mark></samp></h5>
          </div>
          <div class="col-md-4 text-center">
            <h5>Nomor MOP : <samp><mark id="nomor_mop"> </mark></samp></h5>
          </div>
      </div>

      <div class="f_list" style="display: none;">
          <div class="d-flex justify-content-center">
          
            <div class="col-md-10">

              <input type="hidden" class="id_sppa" id="id_sppa_list">
              <table class="mt-3 table table-bordered table-hover dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;" id="tabel_list_endors_dek" width="100%" cellspacing="0">
                  <thead class="thead-light text-center">
                      <tr>
                          <th width="5%">No</th>
                          <th>Endorsment</th>
                          <th>Tanggal Endorsment</th>
                          <th>Status</th>
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
    <div class="card-footer">
      <div class="row">
        <div class="col-md-6">

        </div>
        <div class="col-md-6 d-flex justify-content-end">
          <button type="button" id="" class="btn btn-primary batal_binding"><i class="fas fa-times-circle mr-2"></i>Tutup</button>
        </div>
      </div>
    </div>
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

<!-- Modal -->
<div class="modal fade" id="modal_lihat" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header bg-primary text-white">
        <h5 class="modal-title mt-0" id="judul_modal">Detail</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true" class="text-white">&times;</span>
        </button>
      </div>
      <div class="modal-body isi_lihat">
          
      </div>
    </div>
  </div>
</div>



