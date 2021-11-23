<div class="page-title-box">
  <div class="row align-items-center">
    <div class="col-sm-6"><h4 class="page-title"><?= $title ?></h4></div>
    <div class="col-sm-6">
      <ol class="breadcrumb float-right">
        <li class="breadcrumb-item"><a href="<?= base_url() ?>">Legowo</a></li>
        <li class="breadcrumb-item active"><?= $title ?></li>
      </ol>
    </div>
  </div>
</div>

<div class="row">
  <div class="col-md-12">
    <div class="card">
      <div class="card-body">
        <div class="row">
          <div class="col-md-6">
            <div class="form-group row">
              <label for="nama" class="col-sm-2 col-form-label">Nama</label>
              <div class="col-sm-8">
                <input class="form-control" type="text" value="" id="nama" name="nama" placeholder="Nama">
              </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group row">
              <label for="singkat" class="col-sm-2 col-form-label">Singkatan</label>
              <div class="col-sm-8">
                <input class="form-control" type="text" value="" id="singkat" name="singkat" placeholder="Singkatan">
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-4">
            <div class="form-group row">
              <label for="type" class="col-sm-3 col-form-label">Type</label>
              <div class="col-sm-8">
                <select class="form-control" id="singkat" name="singkat">
                  <option value=""> - </option>
                </select>
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group row">
              <label for="ktgri" class="col-sm-3 col-form-label">Kategori</label>
              <div class="col-sm-8">
                <select class="form-control" id="ktgri" name="ktgri">
                  <option value=""> - </option>
                </select>
              </div>
            </div>
          </div>
          <div class="col-md-3">
            <div class="form-group row">
              <label for="intt" class="col-sm-3 col-form-label"><i>Int</i></label>
              <div class="col-sm-9">
                <input class="form-control" type="number" value="" id="intt" name="intt">
              </div>
            </div>
          </div>
        </div>
        <div class="form-group row">
          <label for="alamat" class="col-sm-1 col-form-label"><i>Alamat</i></label>
          <div class="col-sm-10">
            <textarea class="form-control" value="" id="alamat" name="alamat" rows="6" cols="80"></textarea>
          </div>
        </div>
        <div class="row">
          <div class="col-md-6">
            <div class="form-group row">
              <label for="kota" class="col-sm-2 col-form-label"><i>Kota</i></label>
              <div class="col-sm-7">
                <input class="form-control" type="text" value="" id="kota" name="kota" placeholder="Kota">
              </div>
            </div>
            <div class="form-group row">
              <label for="telpon" class="col-sm-2 col-form-label"><i>Telepon</i></label>
              <div class="col-sm-7">
                <input class="form-control" type="text" value="" id="telpon" name="telpon" placeholder="Telepon">
              </div>
            </div>
            <div class="form-group row">
              <label for="webst" class="col-sm-2 col-form-label"><i>Website</i></label>
              <div class="col-sm-7">
                <input class="form-control" type="text" value="" id="webst" name="webst" placeholder="Website">
              </div>
            </div>
          </div>
          <div class="col-md-5">
            <div class="form-group row">
              <label for="kdpss" class="col-sm-3 col-form-label"><i>Kode Pos</i></label>
              <div class="col-sm-5">
                <input class="form-control" type="number" value="" id="kdpss" name="kdpss" placeholder="Kode Pos">
              </div>
            </div>
            <div class="form-group row">
              <label for="faxmle" class="col-sm-3 col-form-label"><i>Faximile</i></label>
              <div class="col-sm-7">
                <input class="form-control" type="text" value="" id="faxmle" name="faxmle" placeholder="Faximile">
              </div>
            </div>
            <div class="form-group row">
              <label for="email" class="col-sm-3 col-form-label"><i>Email</i></label>
              <div class="col-sm-7">
                <input class="form-control" type="mail" value="" id="email" name="email" placeholder="Email">
              </div>
            </div>
          </div>
        </div>
        <div class="form-group row">
          <label for="nmpc" class="col-sm-1 col-form-label"><i>Nama Pic</i></label>
          <div class="col-sm-10">
            <input class="form-control" type="text" value="" id="nmpc" name="nmpc" placeholder="Nama Pic">
          </div>
        </div>
        <div class="form-group row">
          <label for="almtpc" class="col-sm-1 col-form-label"><i>Alamat Pic</i></label>
          <div class="col-sm-10">
            <textarea class="form-control" value="" id="almtpc" name="almtpc" rows="5" cols="80"></textarea>
          </div>
        </div>
        <div class="row">
          <div class="col-md-6">
            <div class="form-group row">
              <label for="telpc" class="col-sm-2 col-form-label"><i>Telepon Pic</i></label>
              <div class="col-sm-7">
                <input class="form-control" type="text" value="" id="telpc" name="telpc" placeholder="Telepon Pic">
              </div>
            </div>
          </div>
          <div class="col-md-5">
            <div class="form-group row">
              <label for="mailpc" class="col-sm-3 col-form-label"><i>Email Pic</i></label>
              <div class="col-sm-7">
                <input class="form-control" type="mail" value="" id="mailpc" name="mailpc" placeholder="Email Pic">
              </div>
            </div>
          </div>
        </div>
        <div class="form-group row">
          <label for="laridr" class="col-sm-2 col-form-label">Link A/R IDR</label>
          <div class="col-sm-9">
            <select class="form-control" name="laridr" id="laridr">
              <option value="">-- Pilih --</option>
            </select>
          </div>
        </div>
        <div class="form-group row">
          <label for="larusd" class="col-sm-2 col-form-label">Link A/R USD</label>
          <div class="col-sm-9">
            <select class="form-control" name="larusd" id="larusd">
              <option value="">-- Pilih --</option>
            </select>
          </div>
        </div>
        <div class="form-group row">
          <label for="larsgd" class="col-sm-2 col-form-label">Link A/R SGD</label>
          <div class="col-sm-9">
            <select class="form-control" name="laridr" id="laridr">
              <option value="">-- Pilih --</option>
            </select>
          </div>
        </div>
        <div class="form-group row">
          <label for="larjpy" class="col-sm-2 col-form-label">Link A/R JPY</label>
          <div class="col-sm-9">
            <select class="form-control" name="larjpy" id="larjpy">
              <option value="">-- Pilih --</option>
            </select>
          </div>
        </div>
        <div class="form-group row">
          <label for="lareur" class="col-sm-2 col-form-label">Link A/R EUR</label>
          <div class="col-sm-9">
            <select class="form-control" name="lareur" id="lareur">
              <option value="">-- Pilih --</option>
            </select>
          </div>
        </div>
        <div class="form-group row">
          <label for="largbp" class="col-sm-2 col-form-label">Link A/R GBP</label>
          <div class="col-sm-9">
            <select class="form-control" name="largbp" id="largbp">
              <option value="">-- Pilih --</option>
            </select>
          </div>
        </div>
        <div style="padding-top: 10px;" class="row">
          <div class="col-md-7"></div>
          <div class="col-md-4 text-right">
            <button type="submit" class="btn btn-primary waves-effect waves-light">Submit</button>
            <button type="reset" class="btn btn-secondary waves-effect m-l-5">Cancel</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
