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
        <div class="col-sm-4">
            <h4><?= $title ?></h4>
        </div>
        <div class="col-sm-8">
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

        <ul class="nav nav-tabs d-flex justify-content-center" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" data-toggle="tab" href="#home">
                    <span class="d-none d-md-block">Jurnal</span><span class="d-block d-md-none"><i class="mdi mdi-home-variant h5"></i></span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#buku_besar">
                    <span class="d-none d-md-block">Buku Besar</span><span class="d-block d-md-none"><i class="mdi mdi-home-variant h5"></i></span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#form_jurnal" hidden>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#detail_jurnal" hidden>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#form_jurnal_history" hidden>
                    <span class="d-none d-md-block">History</span><span class="d-block d-md-none"><i class="mdi mdi-home-variant h5"></i></span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#pembukuan" id="pembukuan_btn">
                    <span class="d-none d-md-block">Pembukuan</span><span class="d-block d-md-none"><i class="mdi mdi-home-variant h5"></i></span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#detail_bb" hidden>
                </a>
            </li>
        </ul>

        <div class="card shadow">

            <div class="tab-content pt-3">
                <div class="tab-pane active p-3" id="home">
                    <div class="row mb-2">
                        <div class="col-md-2">
                            <button type="button" class="btn btn-primary mb-2" id="btn-add-jurnal" data-toggle="modal" data-target="#add-name-jurnal" ><i class="fa fa-plus"></i> Tambah Jurnal</button>
                        </div>
                        <div class="col-md-4 float-right">
                            <input type="text" class="form-control datepicker_bulan text-center" name="" id="fil_jur_bulan" placeholder="Pilih Bulan" autocomplete="off">
                        </div>
                    </div>
                    <table id="tbl_jurnal" class="table table-hover mt-3" width="100%" >
                        <thead class="bg-primary text-white text-center">
                            <tr>
                                <th style="width:30px;">No</th>
                                <th>Kode Transaksi</th>
                                <th>Nama Transaksi</th>
                                <th>Tanggal</th>
                                <th>Total Debit</th>
                                <th>Total Kredit</th>
                                <th>Status</th>
                                <th>Detail</th>
                            </tr>
                        </thead>
                        <tbody id="show_jurnal">
                        </tbody>
                    </table>
                </div>
                <div class="tab-pane " id="form_jurnal" style="margin-bottom: 100px;">
                <!--========================================
                =            form tambah jurnal            =
                =========================================-->
                <div class="row ">
                    <div class="col-md-6" >
                        <div class="card text-white ">
                                    <div class="card-header bg-primary">
                                <h6 class="card-title">Tambah Jurnal Debit</h6>
                            <!-- <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-widget="collapse">
                                <i class="fa fa-minus"></i>
                            </button>
                            <button type="button" class="btn btn-tool" data-widget="remove">
                                <i class="fa fa-times"></i>
                            </button>
                            </div> -->
                            </div>
                            <div class="card-body">
                                <form>
                                    <input type="hidden" name="id_jurnal" id="id_jurnal">
                                    <div class="form-group">
                                        <select style="width:100%!important;" name="" id="group" class="form-control sel2g " required="required">
                                            <option></option>
                                            <?php foreach ($group as $g) {?>
                                            <option value="<?php echo $g->id_group ?>"><?php echo $g->group ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <select style="width:100%!important;" name="" id="head_coa" class="form-control sel2 " required="required">
                                            <option></option>
                                            <?php foreach ($head_coa as $head) {?>
                                            <option value="<?php echo $head->no_coa_head ?>"><?php echo $head->head_coa ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <select style="width:100%!important;" name="" id="main_coa" class="form-control sel2m" required="required">
                                            <option></option>
                                            <?php foreach ($main_coa as $main) {?>
                                            <option value="<?php echo $main->no_coa_main?>" data-chained="<?php echo $main->no_coa_head ?>"><?php echo $main->main_coa ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <select style="width:100%!important;" name="des_coa" id="des_coa" class="form-control sel2d" required="required">
                                            <option></option>
                                            <?php foreach ($description_coa as $des) {?>
                                            <option value="<?php echo $des->no_coa_des ?>" data-chained="<?php echo $des->no_coa_main ?>"><?php echo $des->deskripsi_coa ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <input type="text" name="tgl_transaksi" id="tgl_transaksi" class="form-control datepicker" required="required" title="" value="<?php echo date('d-M-Y')?>">
                                    </div>
                                    <div class="form-group">
                                        <input type="text" name="nominal" id="nominal" class="form-control divide" required="required" title="" >
                                    </div>
                                    <div class="form-group">
                                        <select style="width:100%!important;" name="pelaksana" id="pelaksana" class="form-control sel2p" required="required">
                                            <option value=""></option>
                                            <?php foreach ($pelaksana as $pel) {?>
                                            <option value="<?php echo $pel->id_anggota ?>"><?php echo $pel->nama_lengkap ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <textarea name="keterangan" id="keterangan" class="form-control" rows="3" required="required"></textarea>
                                    </div>
                                    <button type="button" class="btn btn-primary float-right" id="btn-save-jd">Simpan</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6" >
                        <div class="card text-white ">
                            <div class="card-header bg-primary">
                                <h6 class="card-title">Tambah Jurnal Kredit</h6>

                                <!-- <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-widget="collapse">
                                    <i class="fa fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-tool" data-widget="remove">
                                    <i class="fa fa-times"></i>
                                </button>
                                </div> -->
                            </div>
                            <div class="card-body">
                                <form>
                                    <input type="hidden" name="id_jurnalk" id="id_jurnalk">
                                    <div class="form-group">
                                        <select style="width:100%!important;" name="" id="groupk" class="form-control sel2g " required="required">
                                            <option></option>
                                            <?php foreach ($group as $g) {?>
                                            <option value="<?php echo $g->id_group ?>"><?php echo $g->group ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <select style="width:100%!important;" name="" id="head_coak" class="form-control sel2 " required="required">
                                            <option></option>
                                            <?php foreach ($head_coa as $head) {?>
                                            <option value="<?php echo $head->no_coa_head ?>"><?php echo $head->head_coa ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <select style="width:100%!important;"  name="" id="main_coak" class="form-control sel2m" required="required">
                                            <option></option>
                                            <?php foreach ($main_coa as $main) {?>
                                            <option value="<?php echo $main->no_coa_main ?>" data-chained="<?php echo $main->no_coa_head ?>"><?php echo $main->main_coa ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <select style="width:100%!important;"  name="des_coak" id="des_coak" class="form-control sel2d" required="required">
                                            <option></option>
                                            <?php foreach ($description_coa as $des) {?>
                                            <option value="<?php echo $des->no_coa_des ?>" data-chained="<?php echo $des->no_coa_main ?>"><?php echo $des->deskripsi_coa ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <input type="text" name="tgl_transaksik" id="tgl_transaksik" class="form-control datepicker" required="required" value="<?php echo date('d-M-Y')?>">
                                    </div>
                                    <div class="form-group">
                                        <input type="text" name="nominalk" id="nominalk" class="form-control divide" required="required" title="" >
                                    </div>
                                    <div class="form-group">
                                        <select style="width:100%!important;" name="pelaksanak" id="pelaksanak" class="form-control sel2p" required="required">
                                            <option value=""></option>
                                            <?php foreach ($pelaksana as $pel) {?>
                                            <option value="<?php echo $pel->id_anggota ?>"><?php echo $pel->nama_lengkap ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <textarea name="keterangank" id="keterangank" class="form-control" rows="3" required="required"></textarea>
                                    </div>
                                    <button type="button" class="btn btn-primary float-right" id="btn-save-jk">Simpan</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>


                <!--====  End of form tambah jurnal  ====-->



                    <table id="tbl_list_form_jurnal" class="table table-hover" width="100%" >
                        <thead class="bg-primary">
                            <tr>
                                <th style="width:30px;">No</th>
                                <th nowrap>COA</th>
                                <th>Deskripsi</th>
                                <th>Tanggal</th>
                                <th>Debit</th>
                                <th>Kredit</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="show_list_form_jurnal">
                        </tbody>

                    </table>
                        <button type="button" class="btn btn-primary mb-3 mt-2 float-right" id="b_jurnal">SIMPAN</button>
                        <button type="button" class="btn btn-primary mb-3 mt-2 float-right" id="b_jurnal_p">SIMPAN</button>
                </div>
                <div class="tab-pane " id="detail_jurnal">
                    <div class=" mb-3">
                        <button class="btn btn-outline-primary float-right" id="post_jurnal" style="margin-top:-20px;margin-right:-15px;"
                        <?php if ($userdata->id_posisi == "11") {
                            echo "hidden";
                        } ?>><i class="fa fa-plus"></i> POSTING JURNAL</button>
                        <button class="btn btn-outline-primary float-right" data-toggle="modal" id="btn_modal_j_err" data-target="#modal_err_data" style="margin-top:-20px;margin-right:10px;" <?php if ($userdata->id_posisi == "11") {
                            echo "hidden";
                                                                                                                                                                                            } ?>><i class="fa fa-arrow-circle-left"></i> KEMBALIKAN DATA</button>
                    </div>
                    <br>
                    <table id="tbl_detail_jurnal" class="table table-hover " width="100%" style="margin-bottom: 200px;">
                        <thead class="bg-primary">
                            <tr class="text-center">
                                <th style="width:30px;">No</th>
                                <th><i class="fa fa-check-square"></i> Approval</th>
                                <th nowrap>COA</th>
                                <th>Deskripsi</th>
                                <th>Tanggal</th>
                                <th>Debit</th>
                                <th>Kredit</th>
                            </tr>
                        </thead>
                        <tbody id="show_detail_jurnal">
                        </tbody>
                    </table>

                </div>
                <div class="tab-pane " id="buku_besar">
                <?php include 'buku_besar.php'; ?>
                </div>
                <!-- form jurnal history -->
                <div class="tab-pane " id="form_jurnal_history" style="margin-bottom:100px;">
                <div class="row" >
                <div class="col-md-6 col-lg-6" id="show_history">
                </div>
                <div class="col-md-6 col-lg-6" id="show_historyk">
                </div>
                </div>
                <div class="row">
                <div class="col-md-6 col-lg-6">
                    <div class="card text-white ">
                                    <div class="card-header bg-primary">
                                <h6 class="card-title">Tambah Jurnal Debit</h6>
                            <!-- <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-widget="collapse">
                                <i class="fa fa-minus"></i>
                            </button>
                            <button type="button" class="btn btn-tool" data-widget="remove">
                                <i class="fa fa-times"></i>
                            </button>
                            </div> -->
                            </div>
                            <div class="card-body">
                                <form>
                                    <input type="hidden" name="id_jurnal" id="id_jurnal">
                                    <div class="form-group">
                                        <select style="width:100%!important;" name="" id="grouph" class="form-control sel2g " required="required">
                                            <option></option>
                                            <?php foreach ($group as $g) {?>
                                            <option value="<?php echo $g->id_group ?>"><?php echo $g->group ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <select style="width:100%!important;" name="" id="head_coaph" class="form-control sel2 " required="required">
                                            <option></option>
                                            <?php foreach ($head_coa as $head) {?>
                                            <option value="<?php echo $head->no_coa_head ?>"><?php echo $head->head_coa ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <select style="width:100%!important;" name="" id="main_coaph" class="form-control sel2m" required="required">
                                            <option></option>
                                            <?php foreach ($main_coa as $main) {?>
                                            <option value="<?php echo $main->no_coa_main ?>" data-chained="<?php echo $main->no_coa_head ?>"><?php echo $main->main_coa ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <select style="width:100%!important;" name="des_coa" id="des_coaph" class="form-control sel2d" required="required">
                                            <option></option>
                                            <?php foreach ($description_coa as $des) {?>
                                            <option value="<?php echo $des->no_coa_des ?>" data-chained="<?php echo $des->no_coa_main ?>"><?php echo $des->deskripsi_coa ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <input type="text" name="tgl_transaksi" id="tgl_transaksiph" class="form-control datepicker" required="required" title="" value="<?php echo date('d-M-Y')?>">
                                    </div>
                                    <div class="form-group">
                                        <input type="text" name="nominal" id="nominalph" class="form-control divide" required="required" placeholder="Nominal">
                                    </div>
                                    <div class="form-group">
                                        <select style="width:100%!important;" name="pelaksana" id="pelaksanaph" class="form-control sel2ph" required="required">
                                            <option ></option>
                                            <?php foreach ($pelaksana as $pel) {?>
                                            <option value="<?php echo $pel->id_anggota ?>"><?php echo $pel->nama_lengkap ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <textarea name="keterangan" id="keteranganph" class="form-control" rows="3" required="required"></textarea>
                                    </div>
                                    <button type="button" class="btn btn-primary float-right" id="btn-save-jdh">Simpan</button>
                                </form>
                            </div>
                        </div>
                </div>
                <div class="col-md-6" >
                        <div class="card text-white ">
                                    <div class="card-header bg-primary">
                                <h6 class="card-title">Tambah Jurnal Kredit</h6>

                            <!-- <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-widget="collapse">
                                <i class="fa fa-minus"></i>
                            </button>
                            <button type="button" class="btn btn-tool" data-widget="remove">
                                <i class="fa fa-times"></i>
                            </button>
                            </div> -->
                            </div>
                            <div class="card-body">
                                <form>
                                    <input type="hidden" name="id_jurnalk" id="id_jurnalk">
                                    <div class="form-group">
                                        <select style="width:100%!important;" name="" id="groupkh" class="form-control sel2g " required="required">
                                            <option></option>
                                            <?php foreach ($group as $g) {?>
                                            <option value="<?php echo $g->id_group ?>"><?php echo $g->group ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <select style="width:100%!important;" name="" id="head_coakh" class="form-control sel2 " required="required">
                                            <option></option>
                                            <?php foreach ($head_coa as $head) {?>
                                            <option value="<?php echo $head->no_coa_head ?>"><?php echo $head->head_coa ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <select style="width:100%!important;"  name="" id="main_coakh" class="form-control sel2m" required="required">
                                            <option></option>
                                            <?php foreach ($main_coa as $main) {?>
                                            <option value="<?php echo $main->no_coa_main ?>" data-chained="<?php echo $main->no_coa_head ?>"><?php echo $main->main_coa ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <select style="width:100%!important;"  name="des_coak" id="des_coakh" class="form-control sel2d" required="required">
                                            <option></option>
                                            <?php foreach ($description_coa as $des) {?>
                                            <option value="<?php echo $des->no_coa_des ?>" data-chained="<?php echo $des->no_coa_main ?>"><?php echo $des->deskripsi_coa ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <input type="text" name="tgl_transaksik" id="tgl_transaksikh" class="form-control datepicker" required="required" value="<?php echo date('d-M-Y')?>">
                                    </div>
                                    <div class="form-group">
                                        <input type="text" name="nominalk" id="nominalkh" class="form-control divide" required="required" title="" >
                                    </div>
                                    <div class="form-group">
                                        <select style="width:100%!important;" name="pelaksanakh" id="pelaksanakh" class="form-control sel2ph" required="required">
                                            <option></option>
                                            <?php foreach ($pelaksana as $pel) {?>
                                            <option value="<?php echo $pel->id_anggota ?>"><?php echo $pel->nama_lengkap ?></option>
                                            <?php }; ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <textarea name="keterangank" id="keterangankh" class="form-control" rows="3" required="required"></textarea>
                                    </div>
                                    <button type="button" class="btn btn-primary float-right" id="btn-save-jkh">Simpan</button>
                                </form>
                            </div>
                        </div>
                    </div>
            </div>
            <div class="">
                    <table id="tbl_list_form_jurnalh" class="table table-hover" width="100%" >
                        <thead class="bg-primary">
                            <tr>
                                <th style="width:30px;">No</th>
                                <th nowrap>COA</th>
                                <th>Deskripsi</th>
                                <th>Tanggal</th>
                                <th>Debit</th>
                                <th>Kredit</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="show_list_form_jurnalh">
                        </tbody>

                    </table>
                        <button type="button" class="btn btn-primary mb-3 mt-2 float-right" id="b_jurnalh">SIMPAN</button>
                    </div>
                </div>
                <div class="tab-pane " id="pembukuan">
                    <?php include 'pembukuan.php'; ?>
                </div>
                <div class="tab-pane " id="detail_bb">
                    <?php include 'detail_bb.php'; ?>
                </div>
            </div>

            </div>
            <!-- Modal -->
            <div class="modal fade" id="add-name-jurnal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-scrollable|modal-dialog-centered modal-sm|modal-lg|modal-xl" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle"><i class="fa fa-plus"></i> Tambah Jurnal</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form>
                                <div class="form-group">
                                    <h5>Buat Transaksi Baru</h5>
                                    <input type="text" name="nama_transaksi" class="form-control" id="nama_transaksi" placeholder="Nama Transaksi">
                                </div>
                                <button type="button" class="btn btn-primary float-right " id="btn-add-name-tr">Buat Jurnal</button><br>
                            </form>
                            <h5 class="mt-4">History Transaksi</h5>
                            <form>
                                <div class="form-group">
                                <input type="text" name="" id="nama_transaksi2" class="form-control" value="" required="required" >
                            </div>
                            <div class="form-group">
                                <select name="" id="history_trans" class="form-control" required="required">
                                <?php foreach ($data_jurnal as $var) : ?>
                                <option value="<?php echo $var->id_jurnal ?>"><?php echo $var->nama_transaksi ?></option>
                                <?php endforeach ?>
                            </select>
                            </div>
                            <button type="button" class="btn btn-primary float-right " id="btn-add-name-tr2">Buat Jurnal</button><br>
                            </form>



                        </div>
                        <!-- <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary">Save changes</button>
                        </div> -->
                    </div>
                </div>
            </div>

            <!-- Modal primary Jurnal -->
            <!-- Button trigger modal -->
            <!-- Modal -->
            <div class="modal fade" id="primary" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable|modal-dialog-centered modal-sm|modal-lg|modal-xl" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Catatan Perbaikan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="card">
                    <div class="card-body">
                        <p id="primary-text"></p>
                    </div>
                    </div>
                </div>
                <!--  <div class="modal-footer">
                    <button type="button" class="btn btn-primary">btn-save-jkh</button>
                </div> -->
                </div>
            </div>
            </div>

            <!-- Modal -->
            <div class="modal fade" id="modal_err_data" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
            <div class="modal-dialog  modal-sm|modal-lg|modal-xl" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Data Tidak di Approve</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form>
                        <input type="hidden" id="id_jurnal_err">
                        <div class="form-group">
                            <textarea class="form-control" rows="4" cols="50" id="catatan" placeholder="Catatan Perbaikan"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" id="btn_s_jurnal_err">Simpan</button>
                    </div>
                </form>
                </div>
            </div>
            </div>

            <!-- Modal -->
            <div class="modal fade" id="edit-list" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
        
        </div>

    </div>
</div>

<?php $this->load->view('jsnya'); ?>