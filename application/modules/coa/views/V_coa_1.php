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
<div class="page-title-box">
    <div class="row align-items-center">
        <div class="col-sm-6">
            <h4><?= $title ?></h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-right">
                <li class="breadcrumb-item"><a href="<?= base_url() ?>">All COB</a></li>
                <li class="breadcrumb-item">Transaction</li>
                <li class="breadcrumb-item">Finance and Accounting</li>
                <li class="breadcrumb-item active"><?= $title ?></li>
            </ol>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <?php echo $this->session->flashdata('pesan'); ?>

        <ul class="nav nav-tabs d-flex justify-content-center" role="tablist">
            <li class="nav-item">
            <a class="nav-link active" href="<?php echo base_url('coa')?>">
                <span class="d-none d-md-block">NERACA</span><span class="d-block d-md-none"><i class="mdi mdi-home-variant h5"></i></span>
            </a>
            </li>
            <li class="nav-item">
            <a class="nav-link" href="<?php echo base_url('coa/coa_lr')?>">
                <span class="d-none d-md-block">LABA RUGI</span><span class="d-block d-md-none"><i class="mdi mdi-home-variant h5"></i></span>
            </a>
            </li>
        </ul>

        <div class="card shadow">

            <!-- Tab panes -->
            <div class="tab-content pt-3">
            <div class="tab-pane active p-3" id="menu1">
                <button type="button" class="btn btn-outline-dark mr-2" data-toggle="modal" data-target="#add-hc">
                <i class="fa fa-plus"></i> Tambah Head COA
                </button>
                <button type="button" class="btn btn-outline-primary mr-2" data-toggle="modal" data-target="#import_mc">
                <i class="fa fa-upload"></i> Import Main COA
                </button>
                <button type="button" class="btn btn-outline-primary mr-2" data-toggle="modal" data-target="#add-mc">
                <i class="fa fa-plus"></i> Tambah Main COA
                </button>
                <button type="button" class="btn btn-outline-primary" data-toggle="modal" data-target="#import">
                <i class="fa fa-upload"></i> Import Deskripsi COA
                </button>
                
                    <!-- Modal -->
                    <div class="modal fade" id="import" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-scrollable|modal-dialog-centered modal-sm|modal-lg|modal-xl" role="document">
                            <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLongTitle">IMPORT COA</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <ul class="nav nav-tabs">
                                <li class="nav-item">
                                    <a class="nav-link active" data-toggle="tab" href="#imp">Import Data Baru</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#imp_t">Import Semua Data</a>
                                </li>
                                </ul>
                                <!-- Tab panes -->
                                <div class="tab-content">
                                <div class="tab-pane active container" id="imp">
                                    <form method="POST" action="<?php echo base_url('Master/Head_coa/import') ?>" enctype="multipart/form-data">
                                    <div class="form-group">
                                        <label>Pilih File</label>
                                        <input type="file" class="form-control" name="file_excel">
                                    </div>
                                    <button type="submit" class="btn btn-outline-primary float-right">Import</button>
                                    </form>
                                </div>
                                <div class="tab-pane container" id="imp_t">
                                    <form method="POST" action="<?php echo base_url('Master/Head_coa/import_truncate') ?>" enctype="multipart/form-data">
                                    <div class="form-group">
                                        <label>Pilih File</label>
                                        <input type="file" class="form-control" name="file_excel">
                                    </div>
                                    <button type="submit" class="btn btn-outline-primary float-right">Import</button>
                                    </form>
                                </div>
                                </div>
                            </div>
                            
                            </div>
                        </div>
                    </div>

                    <!-- modal -->
                    <div class="modal fade" id="import_mc" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-scrollable|modal-dialog-centered modal-sm|modal-lg|modal-xl" role="document">
                            <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLongTitle">IMPORT COA</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                    <form method="POST" action="<?php echo base_url('Master/Head_coa/import_main') ?>" enctype="multipart/form-data">
                                    <div class="form-group">
                                        <label>Pilih File</label>
                                        <input type="file" class="form-control" name="file_excel">
                                    </div>
                                    <button type="submit" class="btn btn-outline-primary float-right">Import</button>
                                    </form>
                            </div>
                            </div>
                        </div>
                    </div>
                
                <?php $i=3; ?>
                <?php foreach($data_head_coa as $head){ ?>
                <div class="row mb-4">
                <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
                    <div class="card  mb-3 mt-3 bg-dark" style="height: 100%">
                    <div class="card-body">
                        <h3 class="text-center text-white"><?php echo $head->head_coa ;?></h3>
                        <p class="align-middle"></p>
                    </div>
                    </div>
                </div>
                <div class="col-xs-10 col-sm-10 col-md-10 col-lg-10">
                    <?php $j=$i; ?>
                    <?php $id_head = $head->no_coa_head ;?>
                    <?php $query = $this->db->query("SELECT * FROM main_coa WHERE no_coa_head ='".$id_head."' order by no_coa_main asc "); ?>
                    <?php foreach($query->result() as $main){ ?>
                    <div class="row mb-2">
                    <div class="col-md-4 col-lg-4">
                        <div class="card  mb-3 mt-3" style="height: 100%">
                        <div class="card-body bg-primary">
                            <h3 class="text-center text-white"><?php echo $main->main_coa ;?></h3>
                            <p class="card-text"></p>
                        </div>
                        </div>
                    </div>
                    <div class="col-md-8 col-lg-8 mt-2">
                    <button type="button" class="btn btn-primary mt-2" data-toggle="modal" data-target="#add-dc<?php echo $j ?>"><i class="fa fa-plus mr-2"></i> Tambah</button>
                        <table id="coa_ner<?php echo $j?>" class="table table-hover mt-3 mb-3" style="overflow-x:auto;" width="100%">
                        <thead class="bg-primary text-white text-center">
                            <tr>
                            <th>Deskripsi</th>
                            <th nowrap>Number Of COA</th>
                            <th>Saldo Awal</th>
                            <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $k = 1 ;?>
                            <?php $id = $main->no_coa_main; ?>
                            <?php $query = $this->db->query("SELECT * FROM des_coa WHERE no_coa_main ='".$id."' order by no_coa_des asc "); ?>
                            <?php foreach ($query->result() as $des ) {?>
                            <?php $q = $this->db->query("SELECT * FROM detail_jurnal as dj JOIN des_coa as dc ON dj.coa = dc.no_coa_des WHERE dj.coa ='".$des->no_coa_des."' ")->num_rows() ?>
                            <tr>
                            <td><?php echo $des->deskripsi_coa ?> </td>
                            <td><?php echo $des->no_coa_des ?></td>
                            <td><?php echo number_format($des->saldo_awal) ?></td>
                            <td>
                                <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modal-edit-coa<?php echo $des->id_des_coa ?>" id><i class="fas fa-pencil-alt"></i></button>
                                <a  type="button" href="<?php echo base_url()?>Master/Head_coa/hapus/<?php echo $des->id_des_coa ?>" class="btn btn-danger btn-sm hapus_coa"
                                <?php if ($q > 0) {
                                    echo "hidden";
                                } ?>
                                onclick="return confirm('Are you sure you want to delete this item?');"><i class="far fa-trash-alt"></i></a>

                            </td>
                            </tr>

                            <!-- Modal -->
                            <div class="modal fade" id="modal-edit-coa<?php echo $des->id_des_coa ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-scrollable|modal-dialog-centered modal-sm|modal-lg|modal-xl" role="document">
                                <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLongTitle">Edit COA</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form method="POST" action="<?php echo base_url()?>coa/update_coa">
                                    <input type="hidden" name="id_head_coa" value="<?php echo $head->id_head_coa ?>">
                                    <input type="hidden" name="id_main_coa" value="<?php echo $main->id_main_coa ?>">
                                    <input type="hidden" name="id_des_coa" value="<?php echo $des->id_des_coa ?>">
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="head_coa" placeholder="Head COA" value="<?php echo $head->head_coa ?>">
                                    </div>
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="main_coa" placeholder="Main COA" value="<?php echo $main->main_coa ?>">
                                    </div>
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="no_coa_des" placeholder="No Deskripsi COA" value="<?php echo $des->no_coa_des ?>">
                                    </div>
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="des_coa" placeholder="Deskripsi COA" value="<?php echo $des->deskripsi_coa ?>">
                                    </div>
                                    <div class="form-group">
                                        <input type="text" class="form-control numb" name="saldo_awal" placeholder="Saldo Awal" value="<?php echo $des->saldo_awal ?>">
                                    </div>
                                    </div>
                                    <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary">Update</button>
                                    </div>
                                </form>
                                </div>
                            </div>
                            </div>
                            <?php $k+=2;  } ?>
                        </tbody>
                        </table>
                        
                        <!-- Modal -->
                        <div class="modal fade" id="add-dc<?php echo $j ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-scrollable|modal-dialog-centered modal-sm|modal-lg|modal-xl" role="document">
                            <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLongTitle">Tambah Data Deskripsi COA</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form method="POST" action="<?php echo base_url()?>coa/simpan_dcn">
                                <div class="form-group">
                                    <input type="text" class="form-control" name="no_coa_des" placeholder="No COA Deskripsi" required="required">
                                </div>
                                <div class="form-group">
                                    <input type="hidden" name="main_coa" value="<?php echo $main->no_coa_main ?>">
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control" name="deskripsi_coa" placeholder="Deskripsi COA" required="required">
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control numb1" name="saldo_awal" placeholder="Saldo Awal" required="required">
                                </div>
                                </div>
                                <div class="modal-footer">
                                <button type="submit" class="btn btn-primary">Simpan</button>
                                </div>
                            </form>
                            </div>
                        </div>
                        </div>
                    </div>
                    </div>
                    
                    <?php $j++; } ?>
                </div>
                </div>
                
                <?php $i+=5; } ?>
                
            </div>
            </div>

        </div>
        <!-- Modal -->
        <div class="modal fade" id="add-hc" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable|modal-dialog-centered modal-sm|modal-lg|modal-xl" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Tambah Data Head COA</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="<?php echo base_url()?>coa/simpan_hcn">
                <div class="form-group">
                    <input type="text" class="form-control" name="no_coa_head" placeholder="No Head COA">
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" name="head_coa" placeholder="Head COA">
                </div>
                </div>
                <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
            </div>
        </div>
        </div>
        <!-- Modal -->
        <div class="modal fade" id="add-mc" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable|modal-dialog-centered modal-sm|modal-lg|modal-xl" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Tambah Data Main COA</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="<?php echo base_url()?>coa/simpan_mcn">
                <div class="form-group">
                    <input type="text" class="form-control" name="no_coa_main" placeholder="No Main COA">
                </div>
                <div class="form-group">
                    <select name="head_coa" id="" class="form-control" required="required">
                    <?php foreach ($data_head_coa as $var): ?>
                    <option value="<?php echo $var->no_coa_head?>"><?php echo $var->head_coa ?></option>
                    <?php endforeach ?>
                    
                    </select>
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" name="main_coa" placeholder="Main COA">
                </div>
                </div>
                <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
            </div>
        </div>
        </div>
        <div class="modal fade" id="modal-add" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="title_add"><i class="fa fa-plus"></i>Tambah Data Head COA</h5>
                <h5 class="modal-title" id="title_edit"><i class="fas fa-pencil-alt"></i>Edit Data Asuransi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                <input type="hidden" name="id_head_coa" id="id_head_coa" >
                <div class="form-group">
                    <input type="text" class="form-control" name="no_coa_head" id="no_coa_head" placeholder="No Head COA">
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" name="head_coa" id="head_coa" placeholder="Head COA">
                </div>
                <input type="hidden" name="">
                </div>
                <div class="modal-footer">
                <button class="btn btn-primary mt-2" id="btn_simpan_hc" type="submit">Simpan</button>
                <button class="btn btn-primary mt-2" id="btn_update_hc" type="submit">Update</button>
                </div>
            </form>
            </div>
        </div>
        </div>
    </div>
</div>

<?php $this->load->view('jsnya'); ?>

