<div class="card-body">
  <h4 class="mt-0 header-title">Visi</h4>
  <div class="row">
    <div class="col-md-12">
      <div class="form-group">
        <input type="hidden" name="idvis" id="idvis" value="<?php echo $dvisi[0]->id_visi; ?>">
        <textarea name="nvisi" id="nvisi"><?php echo $dvisi[0]->visi; ?></textarea>
      </div>
      <div class="form-group text-right">
        <?php if ($role['create'] == true || $role == null): ?>
          <button class="btn btn-primary waves-effect waves-light" id="sendvis">Submit</button>
          <button class="btn btn-secondary waves-effect m-l-5" id="clearvis">Cancel</button>
        <?php endif; ?>
      </div>
    </div>
  </div>
</div>
