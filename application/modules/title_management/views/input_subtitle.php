<div class="card-body">
  <div class="row">
    <div class="col-md-7">
      <table id="datatable2" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
        <thead>
          <tr>
            <th>No</th>
            <th>Title Management</th>
            <th>Subitle Management</th>
            <th>Action</th>
          </tr>
        </thead>
      </table>
    </div>
    <div class="col-md-5">
      <div class="form-group">
        <label>Title Management<b style="color:red;">*</b></label>
        <input type="hidden" name="idsm" id="idsm" name="" value="">
        <select class="form-control select2" name="idtmt" id="idtmt" required>
          <option value="">-- Pilih --</option>
          <?php foreach ($mn_title as $key) { ?>
            <option value="<?php echo $key->id_title_management; ?>"><?php echo $key->title_management; ?></option>
          <?php } ?>
        </select>
      </div>
      <div class="form-group">
        <label>Subitle Management<b style="color:red;">*</b></label>
        <input type="text" name="nmsm" id="nmsm" class="form-control" required placeholder="Subitle Management Name"/>
      </div>
      <i style="color:red;">('*') Menandakan Form Harus di Isi</i>
      <div class="form-group text-right">
        <?php if ($role['create'] == true || $role == null): ?>
          <button class="btn btn-primary waves-effect waves-light" id="sendsm">Submit</button>
        <?php endif; ?>
        <button class="btn btn-secondary waves-effect m-l-5" id="clearsm">Cancel</button>
      </div>
    </div>
  </div>
</div>
