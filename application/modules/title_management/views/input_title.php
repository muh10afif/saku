<div class="card-body">
  <div class="row">
    <div class="col-md-7">
      <table id="datatable1" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
        <thead>
          <tr>
            <th>No</th>
            <th>Title Management</th>
            <th>Action</th>
          </tr>
        </thead>
      </table>
    </div>
    <div class="col-md-5">
      <div class="form-group">
        <label>Title Management<b style="color:red;">*</b></label>
        <input type="hidden" name="idtm" id="idtm" name="" value="">
        <input type="text" name="nmtm" id="nmtm" class="form-control" required placeholder="Title Management Name"/>
      </div>
      <i style="color:red;">('*') Menandakan Form Harus di Isi</i>
      <div class="form-group text-right">
        <?php if ($role['create'] == true || $role == null): ?>
          <button class="btn btn-primary waves-effect waves-light" id="sendtm">Submit</button>
        <?php endif; ?>
        <button class="btn btn-secondary waves-effect m-l-5" id="cleartm">Cancel</button>
      </div>
    </div>
  </div>
</div>
