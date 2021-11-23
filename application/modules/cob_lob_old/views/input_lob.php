<div class="card-body">
  <div class="row">
    <div class="col-md-7">
      <table id="datatable2" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
        <thead class="thead-light text-center">
          <tr>
            <th>No</th>
            <th>Nama LOB</th>
            <th>Tipe Diskon</th>
            <th>Action</th>
          </tr>
        </thead>
      </table>
    </div>
    <div class="col-md-5">
      <div class="form-group">
        <label>Nama LOB</label>
        <input type="hidden" name="idlob" id="idlob" name="" value="">
        <input type="text" name="lobnme" id="lobnme" class="form-control" required placeholder="LOB"/>
      </div>
      <div class="form-group">
        <label>Tipe Diskon</label>
        <select class="form-control" name="tdisk" id="tdisk" required>
          <option value="">-- Pilih --</option>
          <option value="premi standar">Premi Standar</option>
          <option value="total perluasan">Total Perluasan</option>
        </select>
      </div>
      <div class="form-group text-right">
        <button class="btn btn-primary waves-effect waves-light" id="sendlob">Submit</button>
        <button class="btn btn-secondary waves-effect m-l-5" id="clearlob">Cancel</button>
      </div>
    </div>
  </div>
</div>
