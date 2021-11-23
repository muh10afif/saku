<div id="myModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-modal="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title mt-0" id="myModalLabel">Field Properties</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <form id="colectprop" method="post">
        <div class="modal-body">
          <div class="form-group row">
            <label for="dtty" class="col-sm-3 col-form-label">Label</label>
            <div class="col-sm-9">
              <input class="form-control" type="text" placeholder="Data Type" name="dtty" id="dtty" readonly>
            </div>
          </div>
          <div class="form-group row">
            <!-- <b style="color:red;">*</b> -->
            <label for="inty" class="col-sm-3 col-form-label">Input Type</label>
            <div class="col-sm-9">
              <select class="form-control" name="inty" id="inty" onchange="changetypen(this)" required>
                <option value="">-- Pilih --</option>
                <option value="T">Text</option>
                <option value="N">Number</option>
                <option value="A">Text Area</option>
                <option value="S">Select Option</option>
                <option value="C">Calender</option>
              </select>
            </div>
          </div>
          <div class="form-group row">
            <label for="field_u" class="col-sm-3 col-form-label">Unique Field</label>
            <div class="row col-sm-9">
              <div class="col-sm-3">
                <div class="custom-control custom-radio">
                  <input type="radio" class="custom-control-input" id="stat1" value="t" name="stat">
                  <label class="custom-control-label" for="stat1">Yes</label>
                </div>
              </div>
              <div class="col-sm-3">
                <div class="custom-control custom-radio">
                  <input type="radio" class="custom-control-input" id="stat2" value="f" name="stat">
                  <label class="custom-control-label" for="stat2">No</label>
                </div>
              </div>
            </div>
          </div>
          <hr>
          <div class="row" id="conditional">
            <div class="col-sm-3">
              <div class="form-group">
                <!-- <b style="color:red;">*</b> -->
                <label>Option Data</label>
                <div class="custom-control custom-radio">
                  <input type="radio" class="custom-control-input" id="optisi1" name="mnu" value="0">
                  <label class="custom-control-label" for="optisi1">Manual</label>
                </div>
                <div class="custom-control custom-radio">
                  <input type="radio" class="custom-control-input" id="optisi2" name="mnu" value="1">
                  <label class="custom-control-label" for="optisi2">Database</label>
                </div>
              </div>
            </div>
            <div class="col-sm-9" id="caseone">
              <table>
                <tbody id="istable">
                  <tr>
                    <td><input type="text" name="foval[]" id="foval" class="form-control" placeholder="Values" value=""></td>
                    <td><input type="text" name="fonme[]" id="fonme" class="form-control" placeholder="Name Option" value=""></td>
                    <td><a class="btn btn-success waves-effect waves-light" onclick="addopt()"><i class="icon-plus"></i></a></td>
                  </tr>
                </tbody>
              </table>
            </div>
            <div class="col-sm-9" id="casetwo">
              <select class="form-control" name="frdbs" id="frdbs"></select>
              <!-- <br>
              <div class="row">
                <div class="col-sm-6">
                  <select class="form-control" name="valnm" id="valnm">
                    <option value="">-- Value --</option>
                  </select>
                </div>
                <div class="col-sm-6">
                  <select class="form-control" name="lblnm" id="lblnm">
                    <option value="">-- Label --</option>
                  </select>
                </div>
              </div> -->
            </div>
          </div>
          <div class="form-group row" id="spartor">
            <label for="sprtr" class="col-sm-3 col-form-label">Sparator Number</label>
            <div class="col-sm-8">
              <div class="custom-control custom-radio">
                <input type="radio" class="custom-control-input" id="opsp1" name="sprt" value="1">
                <label class="custom-control-label" for="opsp1">Ya</label>
              </div>
              <div class="custom-control custom-radio">
                <input type="radio" class="custom-control-input" id="opsp2" name="sprt" value="0">
                <label class="custom-control-label" for="opsp2">Tidak</label>
              </div>
            </div>
          </div>
          <div class="form-group row" id="condlength">
            <!-- <b style="color:red;">*</b> -->
            <label for="lng" class="col-sm-3 col-form-label">Length</label>
            <div class="col-sm-4">
              <input class="form-control" type="text" placeholder="Min.length" name="lng_min" id="lng_min">
            </div>
            <div class="col-sm-1 text-center"><h5>|</h5></div>
            <div class="col-sm-4">
              <input class="form-control" type="text" placeholder="Max.length" name="lng_max" id="lng_max">
            </div>
          </div>
          <!-- <i class="text-center" style="color:red;">('*') Menandakan Form Harus di Isi</i> -->
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary waves-effect waves-light" id="saveprop">Save changes</button>
        </div>
      </form>
    </div>
  </div>
</div>
