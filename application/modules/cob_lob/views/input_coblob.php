<div class="card-body">
  <div class="row">
    <div class="col-md-8">
      <!--  dt-responsive nowrap -->
      <table id="datatable3" class="table table-bordered" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
        <thead class="thead-light text-center">
          <tr>
            <th>No</th>
            <th>COB</th>
            <th>Type COB</th>
            <th>LOB</th>
            <th>Action</th>
          </tr>
        </thead>
      </table>
    </div>
    <div class="col-md-4">
      <div class="form-group">
        <label>COB<b style="color:red;">*</b></label>
        <input type="hidden" name="idrel" id="idrel" name="" value="">
        <select class="form-control select2" name="cobty" id="cobty">
          <option value="">-- Pilih --</option>
          <?php foreach ($list_cob as $key) { ?>
            <option value="<?php echo $key->id_cob; ?>"><?php echo $key->cob; ?></option>
          <?php } ?>
        </select>
      </div>
      <div class="form-group">
        <label>LOB<b style="color:red;">*</b></label>
        <select class="form-control select2" name="lobty" id="lobty">
          <option value="">-- Pilih --</option>
          <?php foreach ($list_lob as $key) { ?>
            <?php if ($key->id_lob != $key->idlob): ?>
              <option value="<?php echo $key->id_lob; ?>"><?php echo $key->lob; ?></option>
            <?php endif; ?>
          <?php } ?>
        </select>
      </div>
      <i class="text-center" style="color:red;">('*') Menandakan Form Harus di Isi</i>
      <div class="form-group text-right">
        <?php if ($role['create'] == true || $role == null): ?>
          <button class="btn btn-primary waves-effect waves-light" id="sendall">Submit</button>
        <?php endif; ?>
        <button class="btn btn-secondary waves-effect m-l-5" id="clearall">Cancel</button>
      </div>
    </div>
  </div>
</div>
