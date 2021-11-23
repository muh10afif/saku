<div class="page-title-box">
  <div class="row align-items-center">
    <div class="col-sm-6"><h4 class="page-title"><?= $title ?></h4></div>
    <div class="col-sm-6">
      <ol class="breadcrumb float-right">
        <li class="breadcrumb-item"><a href="<?= base_url() ?>">Legowo</a></li>
        <li class="breadcrumb-item active"><?= $title ?></li>
      </ol>
    </div>
  </div>
</div>

<div class="col-md-12">
  <ul class="nav nav-tabs" role="tablist">
    <li class="nav-item">
      <a class="nav-link active" data-toggle="tab" href="#cob" role="tab">
        <span class="d-none d-md-block">Class of Business</span><span class="d-block d-md-none"><i class="mdi mdi-home-variant h5"></i></span>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link" data-toggle="tab" href="#lob" role="tab">
        <span class="d-none d-md-block">Line of Business</span><span class="d-block d-md-none"><i class="mdi mdi-home-variant h5"></i></span>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link" data-toggle="tab" href="#colob" role="tab">
        <span class="d-none d-md-block">Master business and it's sub (COB-LOB)</span><span class="d-block d-md-none"><i class="mdi mdi-home-variant h5"></i></span>
      </a>
    </li>
  </ul>

  <div class="card">
    <div class="tab-content">
      <div class="tab-pane active p-3" id="cob" role="tabpanel">
        <?php $this->load->view('input_cob'); ?>
      </div>
      <div class="tab-pane p-3" id="lob" role="tabpanel">
        <?php $this->load->view('input_lob'); ?>
      </div>
      <div class="tab-pane p-3" id="colob" role="tabpanel">
        <?php $this->load->view('input_coblob'); ?>
      </div>
    </div>
  </div>
</div>

<?php $this->load->view('modal_coverage'); ?>

<?php $this->load->view('process'); ?>
