<div class="card-body">
  <div class="row">
    <div class="col-md-7">
      <table id="datatable1" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
        <thead class="thead-light text-center">
          <tr>
            <th>No</th>
            <th>Kode</th>
            <th>Nama COB</th>
            <th>Type COB</th>
            <th>Action</th>
          </tr>
        </thead>
      </table>
    </div>
    <div class="col-md-5">
      <div class="form-group">
        <label>Nama</label>
        <input type="hidden" name="idcob" id="idcob" name="" value="">
        <input type="text" name="cobnme" id="cobnme" class="form-control" required placeholder="Name"/>
      </div>
      <div class="form-group">
        <label>Type</label>
        <select class="form-control" name="cobtyp" id="cobtyp">
          <option value="">-- Pilih --</option>
          <?php foreach ($tipe_cob as $key ) { ?>
            <option value="<?php echo $key->id_tipe_cob; ?>"><?php echo $key->tipe_cob; ?></option>
          <?php } ?>
        </select>
      </div>
      <div class="form-group text-right">
        <button class="btn btn-primary waves-effect waves-light" id="sendcob">Submit</button>
        <button class="btn btn-secondary waves-effect m-l-5" id="clearcob">Cancel</button>
      </div>
    </div>
  </div>
</div>
