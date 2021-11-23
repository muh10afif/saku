<div class="col-md-12 f_tambah" style="display:none;">
  <div class="card shadow">
    <div class="card-header">
      <div class="row align-items-center">
        <div class="col-sm-6">
          <h5 id="changetitlenm"></h5>
        </div>
        <div class="col-sm-6">
          <button class="btn btn-light float-right batal_entry"><i class="mdi mdi-close mdi-18px"></i></button>
        </div>
      </div>
    </div>
    <div class="card-body">
      <form id="colectkry" method="post">
        <div class="row">
          <div class="col-md-6">
            <div class="form-group row">
              <label for="kode_asuransi" class="col-sm-3 col-form-label">Kode Karyawan</label>
              <div class="col-sm-9">
                <input type="text" class="form-control" id="kode_karyawan" name="kode_karyawan" value="" readonly>
              </div>
            </div>
          </div>
        </div>
        <hr>
        <div class="form-group row">
          <label for="nnik" class="col-sm-1 col-form-label">Nama<b style="color:red;">*</b></label>
          <div class="col-sm-5">
            <input type="text" name="nmkary" id="nmkary" class="form-control" required placeholder="(Nama karyawan)">
            <input type="hidden" name="idkry" id="idkry" value="">
          </div>
          <label for="nnik" class="col-sm-1 col-form-label">NIK<b style="color:red;">*</b></label>
          <div class="col-sm-5">
            <input type="text" name="nnik" id="nnik" class="form-control numeric" required placeholder="(Nomor Induk Kependudukan)">
          </div>
        </div>
        <div class="form-group row">
          <label for="bgian" class="col-sm-1 col-form-label">Bagian<b style="color:red;">*</b></label>
          <div class="col-sm-5">
            <select name="bgian" id="bgian" class="form-control select2" onchange="getjbtn(this,0)">
              <option value="">-- Pilih --</option>
              <?php foreach ($list_bagian as $key) { ?>
                <option value="<?php echo $key->id_bagian; ?>"><?php echo $key->bagian; ?></option>
              <?php } ?>
            </select>
          </div>
          <label for="jbtn" class="col-sm-1 col-form-label">Jabatan<b style="color:red;">*</b></label>
          <div class="col-sm-5">
            <select name="jbtn" id="jbtn" class="form-control select2" required>
              <option value="">-- Pilih --</option>
            </select>
          </div>
        </div>
        <div class="form-group row">
          <label for="tele" class="col-sm-1 col-form-label">Telepon<b style="color:red;">*</b></label>
          <div class="col-sm-5">
            <input type="text" name="tele" id="tele" class="form-control numeric" required placeholder="Telepon">
          </div>
          <label for="mail" class="col-sm-1 col-form-label">Email<b style="color:red;">*</b></label>
          <div class="col-sm-5">
            <input type="mail" name="mail" id="mail" class="form-control" required placeholder="Email">
          </div>
        </div>
        <hr>
        <div class="row">
          <div class="col-sm-6">
            <div class="form-group row">
              <label for="idnega" class="col-sm-2 col-form-label">Negara<b style="color:red;">*</b></label>
              <div class="col-sm-10">
                <select class="form-control select2" name="idnega" id="idnega">
                  <?php foreach ($list_negara as $key => $value): ?>
                    <option value="<?= $value->id_negara ?>" <?php echo $value->id_negara == 2 ?'selected':''; ?>><?= $value->negara ?></option>
                  <?php endforeach; ?>
                </select>
              </div>
            </div>
            <div class="form-group row">
              <label for="idprov" class="col-sm-2 col-form-label">Provinsi<b style="color:red;">*</b></label>
              <div class="col-sm-10">
                <select class="form-control select2" name="idprov" id="idprov" placeholder="-- Pilih Provinsi --">
                  <option value="">-- Pilih Provinsi --</option>
                  <?php foreach ($list_provinsi as $key => $value): ?>
                    <option value="<?php echo $value->id_provinsi ?>"><?php echo $value->provinsi ?></option>
                  <?php endforeach; ?>
                </select>
              </div>
            </div>
            <div class="form-group row">
              <label for="idkab" class="col-sm-2 col-form-label">Kota<b style="color:red;">*</b></label>
              <div class="col-sm-10">
                <select class="form-control select2" name="idkab" id="idkab"></select>
              </div>
            </div>
            <div class="form-group row">
              <label for="idkec" class="col-sm-2 col-form-label">Kecamatan<b style="color:red;">*</b></label>
              <div class="col-sm-10">
                <select class="form-control select2" name="idkec" id="idkec"></select>
              </div>
            </div>
            <div class="form-group row">
              <label for="idkel" class="col-sm-2 col-form-label">Kelurahan<b style="color:red;">*</b></label>
              <div class="col-sm-10">
                <select class="form-control select2" name="idkel" id="idkel"></select>
              </div>
            </div>
          </div>
          <div class="col-sm-6">
            <div class="form-group row">
              <label for="almt" class="col-sm-2 col-form-label">Alamat<b style="color:red;">*</b></label>
              <div class="col-sm-10">
                <textarea name="almt" id="almt" class="form-control" rows="8" cols="80"></textarea>
              </div>
            </div>
          </div>
        </div>
        <i style="color:red;">('*') Menandakan Form Harus di Isi</i>
        <div class="form-group text-right">
          <button class="btn btn-primary waves-effect waves-light mr-2" id="senddata">Submit</button>
          <button class="btn btn-secondary waves-effect batal_entry">Cancel</button>
        </div>
      </form>
    </div>
  </div>
</div>
