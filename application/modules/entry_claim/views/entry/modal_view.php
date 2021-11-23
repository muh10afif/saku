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
          <div class="form-group row">
            <label for="nnik" class="col-sm-2 col-form-label">NIK</label>
            <div class="col-sm-10">
              <input class="form-control" type="text" id="nnik" name="nnik" placeholder="Nomor Induk Kepegawaian">
              <input type="hidden" id="idnsb" name="idnsb">
            </div>
          </div>
          <div class="form-group row">
            <label for="nmnsbh" class="col-sm-2 col-form-label">Nama</label>
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
            <label for="telp" class="col-sm-2 col-form-label">Telepon</label>
            <div class="col-sm-10">
              <input class="form-control" type="text" id="telp" name="telp" placeholder="Telepon Nasabah">
            </div>
          </div>
          <div class="form-group row">
            <label for="almtrm" class="col-sm-2 col-form-label">Alamat Rumah</label>
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
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary waves-effect waves-light" id="savenasabah">Save changes</button>
        </div>
      </form>
    </div>
  </div>
</div>



