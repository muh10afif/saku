<div class="card-body">
  <h4 class="mt-0 header-title">Misi</h4>
  <div class="row">
    <div class="col-md-12">
      <div class="form-group">
        <input type="hidden" name="idmis" id="idmis" value="<?php echo $dmisi[0]->id_misi; ?>">
        <textarea name="nmisi" id="nmisi"><?php echo $dmisi[0]->misi; ?></textarea>
      </div>
      <div class="form-group text-right">
        <?php if ($role['create'] == true || $role == null): ?>
          <button class="btn btn-primary waves-effect waves-light" id="sendmis">Submit</button>
          <button class="btn btn-secondary waves-effect m-l-5" id="clearmis">Cancel</button>
        <?php endif; ?>
      </div>
    </div>
  </div>
</div>
