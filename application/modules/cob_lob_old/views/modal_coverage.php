<div id="myModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-modal="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title mt-0" id="myModalLabel">Input Coverage</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-md-7">
            <table id="coveraged" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Label</th>
                  <th>Rate</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
              </thead>
            </table>
          </div>
          <div class="col-md-5">
            <div class="form-group">
              <label>Label</label>
              <input type="hidden" name="idcov" id="idcov">
              <input type="hidden" name="lbcov" id="lbcov">
              <input type="text" name="lacov" id="lacov" class="form-control" required placeholder="Label"/>
            </div>
            <div class="form-group">
              <label>Rate</label>
              <div class="input-group">
                <input type="number" name="racov" id="racov" class="form-control" required placeholder="Rate"/>
                <div class="input-group-append bg-custom b-0"><span class="input-group-text"><i class="mdi mdi-file-percent"></i></span></div>
              </div>
            </div>
            <div class="form-group">
              <label>Status</label>
              <select name="stcov" id="stcov" class="form-control" required>
                <option value="">-- Pilih --</option>
                <option value="standar">Standar</option>
                <option value="perluasan">Perluasan</option>
              </select>
            </div>
            <div class="form-group text-right">
              <button class="btn btn-primary waves-effect waves-light" id="sendcove">Submit</button>
              <button class="btn btn-secondary waves-effect m-l-5" id="clearcove">Clear</button>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-dark waves-effect" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
