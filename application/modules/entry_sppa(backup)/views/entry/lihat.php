<style>
    .nav-pills .nav-link.active, .nav-pills .show > .nav-link {
        color: #fff;
        background-color: #02a4af;
    }

    a {
        color: #02a4af;
    }

    .custom-control-input:checked ~ .custom-control-label::before {
        color: #fff;
        border-color: #006c45;
        background-color: #006c45;
    }

    .nav-tabs .nav-item .nav-link.active {
        color: white;
    }
    .nav-tabs .nav-item.show .nav-link, .nav-tabs .nav-link.active {
        color: #495057;
        background-color: #006c45;
        border-color: #006c45 #006c45 #006c45;
    }
    .nav-tabs .nav-link:focus, .nav-tabs .nav-link:hover {
        border-color: #006c45 #006c45 #006c45;
    }
    .tab-bordered .tab-pane {
        padding: 15px;
        border: 5px solid #006c45;
        margin-top: -1px;
        border-radius: 5px;
    }
    .nav-tabs .nav-item .nav-link {
        color: #006c45;
    }
    .nav-tabs {
        border-bottom: 3px solid #006c45;
    }
    .tab-pane.active {
        animation: slide-down 0.4s ease-out;
    }
    @keyframes slide-down {
        0% { opacity: 0; transform: translateY(100%); }
        100% { opacity: 1; transform: translateY(0); }
    }
</style>
<!-- Page-Title -->
<div class="page-title-box">
    <div class="row align-items-center">
        <div class="col-sm-6">
            <h4><?= $title ?></h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-right">
                <li class="breadcrumb-item"><a href="<?= base_url() ?>">All COB</a></li>
                <li class="breadcrumb-item">Transaction</li>
                <li class="breadcrumb-item">Incoming</li>
                <li class="breadcrumb-item active"><?= $title ?></li>
            </ol>
        </div>
    </div>
</div>

<input type="hidden" id="status_toggle" class="status_toggle">
<div class="row">
    <!-- <div class="col-md-12 t_input">
    </div> -->
    <?php $this->load->view('entry/input'); ?>
  
  <div class="col-md-12">
    <div class="card shadow">
        <?php if ($role['create'] == 'true' || $id_lvl_otorisasi == 0): ?>
            <div class="card-header">
                    <a href="<?= base_url() ?>entry_sppa/tambah_entry"><button class="btn btn-primary float-right" id="tambah_entry1"><i class="fas fa-plus mr-1"></i> Tambah Data</button></a>
                <!-- <h5 id="judul" class="mb-0 mt-1">SPPA Quatitations</h5> -->
            </div>
        <?php endif;  ?>
      <div class="card-body">
        <table class="table table-bordered table-hover dt-responsive nowrap tabel_entry" style="border-collapse: collapse; border-spacing: 0; width: 100%; " id="tabel_entry" width="100%" cellspacing="0">
          <thead class="thead-light text-center">
            <tr>
              <th width="5%">No</th>
              <th>No SPPA</th>
              <th>Client [SOB - CDB]</th>
              <th>COB - LOB</th>
              <th width="15%">Aksi</th>
            </tr>
          </thead>
          <tbody>
           
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<?php $this->load->view('jsnya'); ?>

