<div class="card-body">
  <div class="row">
    <div class="col-md-7">
      <table id="datatable3" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
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
    <div class="col-md-5">
      <div class="form-group">
        <label>COB</label>
        <input type="hidden" name="idrel" id="idrel" name="" value="">
        <select class="form-control" name="cobty" id="cobty">
          <option value="">-- Pilih --</option>
          <?php foreach ($list_cob as $key) { ?>
            <option value="<?php echo $key->id_cob; ?>"><?php echo $key->cob; ?></option>
          <?php } ?>
        </select>
      </div>
      <div class="form-group">
        <label>LOB</label>
        <select class="form-control" name="lobty" id="lobty">
          <option value="">-- Pilih --</option>
          <?php foreach ($list_lob as $key) { ?>
            <option value="<?php echo $key->id_lob; ?>"><?php echo $key->lob; ?></option>
          <?php } ?>
        </select>
      </div>
      <div class="form-group text-right">
        <button class="btn btn-primary waves-effect waves-light" id="sendall">Submit</button>
        <button class="btn btn-secondary waves-effect m-l-5" id="clearall">Cancel</button>
      </div>
    </div>
  </div>
</div>
