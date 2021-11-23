<div id="myModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-modal="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title mt-0" id="myModalLabel">Field Properties</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <form id="colectnsbh" method="post">
        <div class="modal-body">
          <div class="form-group row mb-0">
            <label class="col-sm-2 col-form-label" style="margin-top: -18px;">Status Keanggotaan<b style="color:red;">*</b></label>
            <div class="col-sm-4">
              <div class="custom-control custom-radio">
                <input type="radio" class="custom-control-input" id="stat1" value="t" name="stat">
                <label class="custom-control-label" for="stat1">Perorangan</label>
              </div>
            </div>
            <div class="col-sm-4">
              <div class="custom-control custom-radio">
                <input type="radio" class="custom-control-input" id="stat2" value="f" name="stat">
                <label class="custom-control-label" for="stat2">Perusahaan</label>
              </div>
            </div>
          </div>
          <hr class="mt-0">
          <div class="form-group row">
            <label for="nnik" class="col-sm-2 col-form-label">Kode Nasabah</label>
            <div class="col-sm-10">
              <input class="form-control" type="text" id="kdnsb" name="kdnsb" placeholder="Kode Nasabah" readonly>
            </div>
          </div>
          <hr>
          <div class="form-group row">
            <label for="nnik" class="col-sm-2 col-form-label">NIK</label>
            <div class="col-sm-10">
              <input class="form-control numeric" type="text" id="nnik" name="nnik" placeholder="Nomor Induk Kependudukan">
              <input type="hidden" id="idnsb" name="idnsb">
            </div>
          </div>
          <div class="form-group row">
            <label for="nmnsbh" class="col-sm-2 col-form-label">Nama<b style="color:red;">*</b></label>
            <div class="col-sm-10">
              <input class="form-control" type="text" id="nmnsbh" name="nmnsbh" placeholder="Nama Nasabah">
            </div>
          </div>
          <div class="form-group row">
            <label for="tglhr" class="col-sm-2 col-form-label">Tanggal Lahir</label>
            <div class="col-sm-4">
              <input class="form-control" type="text" id="tglhr" name="tglhr" placeholder="Tanggal Lahir">
            </div>
            <div class="col-sm-6">
              <div class="row">
                <div class="col-sm-6">
                  <div class="custom-control custom-radio" style="margin-top: 5px;">
                    <input type="radio" class="custom-control-input" id="jenkl1" value="t" name="jenkl">
                    <label class="custom-control-label" for="jenkl1">Laki-laki</label>
                  </div>
                </div>
                <div class="col-sm-6">
                  <div class="custom-control custom-radio" style="margin-top: 5px;">
                    <input type="radio" class="custom-control-input" id="jenkl2" value="f" name="jenkl">
                    <label class="custom-control-label" for="jenkl2">Perempuan</label>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="form-group row">
            <label for="telp" class="col-sm-2 col-form-label">Telepon<b style="color:red;">*</b></label>
            <div class="col-sm-10">
              <input class="form-control numeric" type="text" id="telp" name="telp" placeholder="Telepon Nasabah">
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group row">
                <label for="idnega" class="col-sm-4 col-form-label">Negara<b style="color:red;">*</b></label>
                <div class="col-sm-8">
                  <select class="form-control select2" name="idnega" id="idnega" placeholder="-- Pilih Negara --">
                    <?php foreach ($list_negara as $key => $value): ?>
                      <option value="<?= $value->id_negara ?>" <?php echo $value->id_negara == 2 ?'selected':''; ?>><?= $value->negara ?></option>
                    <?php endforeach; ?>
                  </select>
                </div>
              </div>
              <div class="form-group row">
                <label for="idprov" class="col-sm-4 col-form-label">Provinsi<b style="color:red;">*</b></label>
                <div class="col-sm-8">
                  <select class="form-control select2" name="idprov" id="idprov">
                    <option value="">-- Pilih Provinsi --</option>
                    <?php foreach ($isprovinsi as $key => $value): ?>
                      <option value="<?php echo $value->id_provinsi; ?>"><?php echo $value->provinsi; ?></option>
                    <?php endforeach; ?>
                  </select>
                </div>
              </div>
              <div class="form-group row">
                <label for="idkab" class="col-sm-4 col-form-label">Kota/Kabupaten<b style="color:red;">*</b></label>
                <div class="col-sm-8">
                  <select class="form-control select2" name="idkab" id="idkab">
                    <option value="">-- Pilih Kota/Kabupaten --</option>
                  </select>
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group row">
                <label for="idkec" class="col-sm-4 col-form-label">Kecamatan<b style="color:red;">*</b></label>
                <div class="col-sm-8">
                  <select class="form-control select2" name="idkec" id="idkec">
                    <option value="">-- Pilih Kecamatan --</option>
                  </select>
                </div>
              </div>
              <div class="form-group row">
                <label for="idkel" class="col-sm-4 col-form-label">Desa/Kelurahan<b style="color:red;">*</b></label>
                <div class="col-sm-8">
                  <select class="form-control select2" name="idkel" id="idkel">
                    <option value="">-- Pilih Desa/Kelurahan --</option>
                  </select>
                </div>
              </div>
            </div>
          </div>
          <div class="form-group row">
            <label for="almtrm" class="col-sm-2 col-form-label">Alamat<b style="color:red;">*</b></label>
            <div class="col-sm-10">
              <textarea class="form-control" id="almtrm" name="almtrm" placeholder="Alamat Rumah" rows="5" cols="80"></textarea>
            </div>
          </div>
          <div class="form-group row">
            <label for="tmpdns" class="col-sm-2 col-form-label">Tempat Dinas</label>
            <div class="col-sm-10">
              <input class="form-control" type="text" id="tmpdns" name="tmpdns" placeholder="Tempat Dinas">
            </div>
          </div>
          <i style="color:red;">('*') Menandakan Form Harus di Isi</i>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary waves-effect waves-light" id="savenasabah">Submit</button>
          <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">Cancel</button>
        </div>
      </form>
    </div>
  </div>
</div>
