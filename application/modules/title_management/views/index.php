<div class="page-title-box">
  <div class="row align-items-center">
    <div class="col-sm-6"><h4><?= $title ?></h4></div>
    <div class="col-sm-6">
      <?php echo bredcumx(); ?>
    </div>
  </div>
</div>

<?php if ($role['read'] == true || $role == null): ?>
  <div class="row">
    <div class="col-md-12">
      <ul class="nav nav-tabs d-flex justify-content-center" role="tablist">
        <li class="nav-item">
          <a class="nav-link active" data-toggle="tab" href="#ntm" role="tab">
            <span class="d-none d-md-block">Title Management</span><span class="d-block d-md-none"><i class="mdi mdi-home-variant h5"></i></span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" data-toggle="tab" href="#stm" role="tab">
            <span class="d-none d-md-block">Subitle Management</span><span class="d-block d-md-none"><i class="mdi mdi-home-variant h5"></i></span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" data-toggle="tab" href="#nmt" role="tab">
            <span class="d-none d-md-block">Name Management</span><span class="d-block d-md-none"><i class="mdi mdi-home-variant h5"></i></span>
          </a>
        </li>
      </ul>

      <div class="card">
        <div class="tab-content">
          <div class="tab-pane active p-3" id="ntm" role="tabpanel">
            <?php $this->load->view('input_title'); ?>
          </div>
          <div class="tab-pane p-3" id="stm" role="tabpanel">
            <?php $this->load->view('input_subtitle'); ?>
          </div>
          <div class="tab-pane p-3" id="nmt" role="tabpanel">
            <?php $this->load->view('input_name'); ?>
          </div>
        </div>
      </div>
    </div>
  </div>
<?php endif; ?>

<?php $this->load->view('process'); ?>
