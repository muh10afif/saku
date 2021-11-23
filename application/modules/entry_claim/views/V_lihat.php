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
        animation: slide-down 0.2s ease-out;
    }
    @keyframes slide-down {
        0% { opacity: 0; transform: translateY(100%); }
        100% { opacity: 1; transform: translateY(0); }
    }

</style>
<!-- Page-Title -->
<div class="page-title-box">
    <div class="row align-items-center">
        <div class="col-sm-4">
            <h4><?= $title ?></h4>
        </div>
        <div class="col-sm-8">
            <ol class="breadcrumb float-right">
                <li class="breadcrumb-item"><a href="<?= base_url() ?>">SAKU</a></li>
                <li class="breadcrumb-item">Transaction</li>
                <li class="breadcrumb-item">Outgoing</li>
                <li class="breadcrumb-item active"><?= $title ?></li>
            </ol>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="card shadow">
            <?php if ($role['create'] == 'true' || $id_lvl_otorisasi == 0): ?>
                <div class="card-header">
                    <a href="<?= base_url('entry_claim/tambah_claim') ?>"><button type="button" class="btn btn-primary float-right" id="tambah_entry"><i class="fas fa-plus mr-2"></i> Tambah Data</button></a>
                </div>
            <?php endif; ?>
            <div class="card-body">
                <input type="hidden" id="tab_status_klaim" value="0">

                <ul class="nav nav-tabs d-flex justify-content-center" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link t_status_klaim active" status="0" data-toggle="tab" href="#pending" role="tab">
                            <span class="d-none d-md-block">DIAJUKAN</span><span class="d-block d-md-none"><i class="mdi mdi-home-variant h5"></i></span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link t_status_klaim" status="1" data-toggle="tab" href="#aktif" role="tab">
                            <span class="d-none d-md-block">DISETUJUI</span><span class="d-block d-md-none"><i class="mdi mdi-home-variant h5"></i></span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link t_status_klaim" status="2" data-toggle="tab" href="#tidak_aktif" role="tab">
                            <span class="d-none d-md-block">DICAIRKAN</span><span class="d-block d-md-none"><i class="mdi mdi-home-variant h5"></i></span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link t_status_klaim" status="3" data-toggle="tab" href="#tidak_aktif" role="tab">
                            <span class="d-none d-md-block">DITOLAK</span><span class="d-block d-md-none"><i class="mdi mdi-home-variant h5"></i></span>
                        </a>
                    </li>
                </ul>
                <br>
                <table class="table table-bordered table-hover dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;" id="tabel_klaim" width="100%" cellspacing="0">
                    <thead class="thead-light text-center">
                        <tr>
                            <th width="5%">No</th>
                            <th>Claim Date</th>
                            <th>No Polis</th>
                            <th>No Klaim</th>
                            <th>Claim Type</th>
                            <th>Status</th>
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

<div class="modal fade" id="modal_status" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
        <div class="modal-header bg-primary text-white">
            <h5 class="modal-title mt-0">Ubah Status Klaim</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true" class="text-white">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <div class="row p-3">
                <input type="hidden" id="id_data_klaim">
                <input type="hidden" id="nilai_ptg">
                <div class="col-md-12">
                    <div class="form-group row">
                        <label for="no_reff_mop" class="col-md-4 col-form-label text-left">No Polis</label>
                        <div class="col-md-8 mt-1">
                            <span id="t_no_polis">: </span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="no_reff_mop" class="col-md-4 col-form-label text-left">Nama Nasabah</label>
                        <div class="col-md-8 mt-1">
                            <span id="t_nama_nasabah">: </span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="no_reff_mop" class="col-md-4 col-form-label text-left">Status Klaim</label>
                        <div class="col-md-8">
                            <select name="status_klaim" id="status_klaim" class="select2">
                                <option value="0">Diajukan</option>
                                <option value="1">Disetujui</option>
                                <option value="2">Dicairkan</option>
                                <option value="3">Ditolak</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row alasan_tolak" style="display: none;">
                        <label for="no_reff_mop" class="col-md-4 col-form-label text-left">Alasan Tolak</label>
                        <div class="col-md-8">
                            <textarea name="alasan_tolak" id="alasan_tolak" rows="5" class="form-control" placeholder="Masukkan Alasan Tolak"></textarea>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-primary mr-2" id="simpan_status">Simpan</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
        </div>
    </div>
  </div>
</div>

<?php $this->load->view('js'); ?>