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
<div class="row p-3">
    <div class="col-md-6">
        <div class="form-group row">
            <label for="no_reff_mop" class="col-md-4 col-form-label text-left">ID</label>
            <div class="col-md-8 mt-1">
                <span>: <?= $list['id_sppa_quotation'] ?></span>
            </div>
        </div>
        <div class="form-group row">
            <label for="no_mop" class="col-md-4 col-form-label text-left">Nasabah</label>
            <div class="col-md-8 mt-1">
                <span>: <?= $list['nama'] ?></span>
            </div>
        </div> 
        <div class="form-group row">
            <label for="nm_mop" class="col-md-4 col-form-label text-left">Produk</label>
            <div class="col-md-8 mt-1">
                <span>: <?= $list['lob'] ?></span>
            </div>
        </div> 
        
    </div>

    <div class="col-md-6">
        <div class="form-group row">
            <label for="id_insured" class="col-md-4 col-form-label text-left" id="l_detail">Asuransi</label>
            <div class="col-md-8 mt-1">
                <span>: <?= $list['nama_asuransi'] ?></span>
            </div>
        </div>
        <div class="form-group row">
            <label for="no_polis" class="col-md-4 col-form-label text-left">Premi</label>
            <div class="col-md-8 mt-1">
                <span>: Rp. <?= number_format($list['premi'],0,'.','.') ?></span>
            </div>
        </div> 
        <div class="form-group row">
            <label for="id_insured" class="col-md-4 col-form-label text-left">Add Time</label>
            <div class="col-md-8 mt-1">
                <span>: <?= date("d-m-Y H:i:s", strtotime($list['add_time'])) ?></span>
            </div>
        </div>  
    </div>
</div>
<div class="row p-3">
    <div class="col-md-12">
        <h5 class="mt-0">POLIS</h5>
    </div>
    <div class="col-md-6">
        <div class="form-group row">
            <label for="id_insured" class="col-md-4 col-form-label text-left" id="l_detail">Status Polis</label>
            <div class="col-md-8 mt-1">
                <?php 

                    if ($list['status_polis'] == 0) {
                        $sts = "<span class='badge badge-warning'>Pending</span>";
                    } elseif ($list['status_polis'] == 1) {
                        $sts = "<span class='badge badge-primary'>Aktif</span>";
                    } elseif ($list['status_polis'] == 2)  {
                        $sts = "<span class='badge badge-danger'>Tidak Aktif</span>";
                    }
                
                ?>
                <span>: <?= $sts ?></span>
            </div>
        </div>
        <div class="form-group row">
            <label for="no_polis" class="col-md-4 col-form-label text-left">No Polis</label>
            <div class="col-md-8 mt-1">
                <span>: <?= ($list['no_polis']) ? $list['no_polis'] : '-'  ?></span>
            </div>
        </div> 
          
    </div>
    <div class="col-md-6">
        <div class="form-group row">
            <label for="id_insured" class="col-md-4 col-form-label text-left" id="l_detail">Tanggal Awal Polis</label>
            <div class="col-md-8 mt-1">
                <?php 

                    if ($list['tgl_awal_polis']) {
                        $dw = date("d-m-Y", strtotime($list['tgl_awal_polis']));
                    } else {
                        $dw = '-';
                    }
                
                ?>
                <span>: <?= $dw ?></span>
            </div>
        </div>
        <div class="form-group row">
            <label for="no_polis" class="col-md-4 col-form-label text-left">Tanggal Akhir Polis</label>
            <div class="col-md-8 mt-1">
                <?php 

                    if ($list['tgl_akhir_polis']) {
                        $da = date("d-m-Y", strtotime($list['tgl_akhir_polis']));
                    } else {
                        $da = '-';
                    }

                ?>
                <span>: <?= $da ?></span>
            </div>
        </div>   
          
    </div>

</div>
<div class="row p-3 mt-0">
    <div class="col-md-12">
        <h5 class="mt-0">PEMBAYARAN</h5>
    </div>
    <div class="col-md-6">
        <div class="form-group row">
            <label for="id_insured" class="col-md-4 col-form-label text-left" id="l_detail">Status Bayar</label>
            <div class="col-md-8 mt-1">
                <?php 

                    if ($list['status_bayar']) {
                        if ($list['status_bayar'] == 0) {
                            $sts_b = "<span class='badge badge-warning'>Pending</span>";
                        } elseif ($list['status_bayar'] == 1) {
                            $sts_b = "<span class='badge badge-primary'>Terbayar</span>";
                        } elseif ($list['status_bayar'] == 2)  {
                            $sts_b = "<span class='badge badge-danger'>Cancel</span>";
                        }
                    } else {
                        $sts_b = "-";
                    }

                ?>
                <span>: <?= $sts_b ?></span>
            </div>
        </div>
        <div class="form-group row">
            <label for="no_polis" class="col-md-4 col-form-label text-left">Metode Pembayaran</label>
            <div class="col-md-8 mt-1">
                <span>: <?= ($list['nama_metode']) ? $list['nama_metode'] : '-' ?></span>
            </div>
        </div> 
          
    </div>
    <div class="col-md-6">
        <div class="form-group row">
            <label for="id_insured" class="col-md-4 col-form-label text-left" id="l_detail">No Transaksi</label>
            <div class="col-md-8 mt-1">
                <span>: <?= ($list['no_transaksi']) ? $list['no_transaksi'] : '-' ?></span>
            </div>
        </div>
        <div class="form-group row">
            <label for="no_polis" class="col-md-4 col-form-label text-left">Bayar</label>
            <div class="col-md-8 mt-1">
                <?php 

                    if ($list['bayar']) {
                        $by = "Rp. ".number_format($list['bayar'],0,'.','.');
                    } else {
                        $by = "-";
                    }
                
                ?>
                <span>: <?= $by ?></span>
            </div>
        </div>   
          
    </div>

</div>


<div class="row p-3 mt-0">
    <div class="col-md-12">
        <h5 class="mt-0">AHLI WARIS</h5>
    </div>
    <div class="col-md-12">

        <ul class="nav nav-tabs d-flex justify-content-center" role="tablist">
            <li class="nav-item">
                <a class="nav-link t_status_polis t_aktif active" status="1" data-toggle="tab" href="#saya" role="tab">
                    <span class="d-none d-md-block">Ahli Waris Saya</span><span class="d-block d-md-none"><i class="mdi mdi-home-variant h5"></i></span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link t_status_polis t_pending" status="0" data-toggle="tab" href="#dari" role="tab">
                    <span class="d-none d-md-block">Ahli Waris Dari</span><span class="d-block d-md-none"><i class="mdi mdi-home-variant h5"></i></span>
                </a>
            </li>
        </ul>
        
        <div class="tab-content">
            <div class="tab-pane p-3 table-responsive" id="dari" role="tabpanel">
                <table class="table table-light table-bordered">
                    <thead class="thead-light text-center">
                        <tr>
                            <th>No.</th>
                            <th>No Polis</th>
                            <th>Nama Nasabah</th>
                            <th>Telp</th>
                            <th>Alamat</th>
                            <th>Tanggal Awal Polis</th>
                            <th>Tanggal Akhir Polis</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php if (count($aw_dari) == 0): ?>
                            <tr>
                                <td colspan="7" class="text-center">Data Ahli Waris Tidak Ada</td>
                            </tr>
                        <?php else: ?>
                            <?php $n=1; foreach ($aw_dari as $d): ?>
                                <tr>
                                    <td align="center"><?= $n; ?>.</td>
                                    <td><?= $d['no_polis']; ?></td>
                                    <td><?= $d['nama']; ?></td>
                                    <td><?= $d['telp']; ?></td>
                                    <td><?= $d['alamat_rumah']; ?></td>
                                    <td align="center"><?= date("d-m-Y", strtotime($d['tgl_awal_polis'])) ?></td>
                                    <td align="center"><?= date("d-m-Y", strtotime($d['tgl_akhir_polis'])) ?></td>
                                </tr>
                            <?php $n++; endforeach; ?>

                        <?php endif; ?>
                        
                    </tbody>
                </table>
            </div>
            <div class="tab-pane p-3 show active table-responsive" id="saya" role="tabpanel">
                <table class="table table-light table-bordered">
                    <thead class="thead-light text-center">
                        <tr>
                            <th>No.</th>
                            <th>NIK</th>
                            <th>Nama</th>
                            <th>Telp</th>
                            <th>Hubungan</th>
                            <th>Alamat</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php $no=1; foreach ($ahli_waris as $w): ?>
                            <tr>
                                <td align="center"><?= $no; ?>.</td>
                                <td><?= $w['nik']; ?></td>
                                <td><?= $w['nama']; ?></td>
                                <td><?= $w['hp']; ?></td>
                                <td><?= $w['hubungan_klg']; ?></td>
                                <td><?= $w['alamat']; ?></td>
                            </tr>
                        <?php $no++; endforeach; ?>
                        
                    </tbody>
                </table>
            </div>
        </div>
        
    </div>
</div>