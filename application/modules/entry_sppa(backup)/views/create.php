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

<div class="col-md-12">
  <ul class="nav nav-tabs" role="tablist">
    <li class="nav-item">
      <a class="nav-link active" data-toggle="tab" href="#clidat" role="tab">
        <span class="d-none d-md-block">Client Data</span><span class="d-block d-md-none"><i class="mdi mdi-home-variant h5"></i></span>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link" data-toggle="tab" href="#detinsu" role="tab">
        <span class="d-none d-md-block">Detail Insured</span><span class="d-block d-md-none"><i class="mdi mdi-home-variant h5"></i></span>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link" data-toggle="tab" href="#documn" role="tab">
        <span class="d-none d-md-block">Documents</span><span class="d-block d-md-none"><i class="mdi mdi-home-variant h5"></i></span>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link" data-toggle="tab" href="#premcacl" role="tab">
        <span class="d-none d-md-block">Premium Calculation</span><span class="d-block d-md-none"><i class="mdi mdi-home-variant h5"></i></span>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link" data-toggle="tab" href="#relsed" role="tab">
        <span class="d-none d-md-block">Released</span><span class="d-block d-md-none"><i class="mdi mdi-home-variant h5"></i></span>
      </a>
    </li>
  </ul>

  <div class="card">
    <div class="tab-content">
      <div class="tab-pane active p-3" id="clidat" role="tabpanel">
        <div class="card-body">
          <button type="button" class="btn btn-success waves-effect waves-light">New Data</button>
          <button type="button" class="btn btn-success waves-effect waves-light">Renewal</button>
          <button type="button" class="btn btn-success waves-effect waves-light">Endorsment</button>
          <button type="button" class="btn btn-success waves-effect waves-light">Slip Endorsment</button>
          <p>
          <h6>Source of Business</h6><hr>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group row">
                <label for="sob" class="col-sm-2 col-form-label">Source of Business</label>
                <div class="col-sm-10">
                  <select class="form-control" value="" id="sob" name="sob">
                    <option value="">-- Pilih --</option>
                  </select>
                </div>
              </div>
              <div class="form-group row">
                <label for="noi" class="col-sm-2 col-form-label">Name of Intermediation</label>
                <div class="col-sm-10">
                  <input class="form-control" type="text" value="" id="noi" name="noi" placeholder="Name of Intermediation">
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group row">
                <label for="toc" class="col-sm-2 col-form-label">Type of Content</label>
                <div class="col-sm-10">
                  <select class="form-control" value="" id="toc" name="toc">
                    <option value="">Regular</option>
                  </select>
                </div>
              </div>
              <div class="form-group row">
                <label for="cbg" class="col-sm-2 col-form-label">Cabang</label>
                <div class="col-sm-10">
                  <input class="form-control" type="text" value="" id="cbg" name="cbg" placeholder="Cabang">
                </div>
              </div>
            </div>
          </div>
          <h6>Type of Insurance</h6><hr>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group row">
                <label for="cobb" class="col-sm-2 col-form-label">Class of Business</label>
                <div class="col-sm-10">
                  <select class="form-control" value="" id="cobb" name="cobb">
                    <option value="">-- Pilih --</option>
                  </select>
                </div>
              </div>
              <div class="form-group row">
                <label for="cucc" class="col-sm-2 col-form-label">Currency Code</label>
                <div class="col-sm-10">
                  <select class="form-control" value="" id="cobb" name="cobb">
                    <option value="">-- Pilih --</option>
                  </select>
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group row">
                <label for="lobb" class="col-sm-2 col-form-label">Line of Business</label>
                <div class="col-sm-10">
                  <select class="form-control" value="" id="lobb" name="lobb">
                    <option value="">-- Pilih --</option>
                  </select>
                </div>
              </div>
            </div>
          </div>
          <h6>Insured and Intrest Insured</h6><hr>
          <div class="form-group row">
            <label for="insme" class="col-sm-2 col-form-label">Insured Name</label>
            <div class="col-sm-10">
              <input class="form-control" type="text" value="" id="insme" name="insme" placeholder="Insured Nama">
            </div>
          </div>
        </div>
      </div>
      <div class="tab-pane p-3" id="detinsu" role="tabpanel">
        <div class="card-body">
          Content Here
        </div>
      </div>
      <div class="tab-pane p-3" id="documn" role="tabpanel">
        <div class="card-body">
          Content Here
        </div>
      </div>
      <div class="tab-pane p-3" id="premcacl" role="tabpanel">
        <div class="card-body">
          <h6>Premium and Payment</h6>
          <ul class="nav nav-tabs" role="tablist">
            <li class="nav-item">
              <a class="nav-link active" data-toggle="tab" href="#totprem" role="tab">
                <span class="d-none d-md-block">Total Premium</span><span class="d-block d-md-none"><i class="mdi mdi-home-variant h5"></i></span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" data-toggle="tab" href="#terpem" role="tab">
                <span class="d-none d-md-block">Termin Pembayaran</span><span class="d-block d-md-none"><i class="mdi mdi-home-variant h5"></i></span>
              </a>
            </li>
          </ul>
          <div class="card">
            <div class="tab-content">
              <div class="tab-pane active p-3" id="totprem" role="tabpanel">
                <div class="card-body">
                  Content Here
                </div>
              </div>
              <div class="tab-pane p-3" id="terpem" role="tabpanel">
                <div class="card-body">
                  Content Here
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="tab-pane p-3" id="relsed" role="tabpanel">
        <div class="card-body">
          Content Here
        </div>
      </div>
    </div>
  </div>
