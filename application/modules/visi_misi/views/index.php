<div class="page-title-box">
  <div class="row align-items-center">
    <div class="col-sm-6"><h4 class="page-title"><?= $title ?></h4></div>
    <div class="col-sm-6">
      <?php echo bredcumx(); ?>
    </div>
  </div>
</div>

<?php if ($role['read'] == true || $role == null): ?>
  <div class="col-md-12">
    <ul class="nav nav-tabs" role="tablist">
      <li class="nav-item">
        <a class="nav-link active" data-toggle="tab" href="#vsi" role="tab">
          <span class="d-none d-md-block">Visi</span><span class="d-block d-md-none"><i class="mdi mdi-home-variant h5"></i></span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-toggle="tab" href="#msi" role="tab">
          <span class="d-none d-md-block">Misi</span><span class="d-block d-md-none"><i class="mdi mdi-home-variant h5"></i></span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-toggle="tab" href="#val" role="tab">
          <span class="d-none d-md-block">Value</span><span class="d-block d-md-none"><i class="mdi mdi-home-variant h5"></i></span>
        </a>
      </li>
    </ul>

    <div class="card">
      <div class="tab-content">
        <div class="tab-pane active p-3" id="vsi" role="tabpanel">
          <?php $this->load->view('v_visi'); ?>
        </div>
        <div class="tab-pane p-3" id="msi" role="tabpanel">
          <?php $this->load->view('v_misi'); ?>
        </div>
        <div class="tab-pane p-3" id="val" role="tabpanel">
          <?php $this->load->view('v_value'); ?>
        </div>
      </div>
    </div>
  </div>
<?php endif; ?>

<?php $this->load->view('proces'); ?>
