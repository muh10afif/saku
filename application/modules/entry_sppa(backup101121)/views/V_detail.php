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
<style>
    #bg_img{
        background-image: url('../../assets/img/e_polis.png');
        background-repeat: no-repeat;
        background-size:500px;
        width: 700px;
        height: 750px;
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
                <li class="breadcrumb-item">Incoming</li>
                <li class="breadcrumb-item">Entry SPPA</li>
                <li class="breadcrumb-item active"><?= $title ?></li>
            </ol>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="card shadow">
            <div class="card-header mb-0">
                <a href="<?= base_url('entry_sppa') ?>"><button class="btn btn-primary float-right"><i class="fas fa-arrow-left mr-2"></i>Kembali</button></a>
            </div>
            <div class="card-body">
                <form id="form_entry" autocomplete="off">

                <ul class="nav nav-tabs d-flex justify-content-center mt-2" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" href="#t_client_data" role="tab">
                        <span class="d-none d-md-block">Client Data</span><span class="d-block d-md-none"><i class="mdi mdi-database h5"></i></span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#t_detail" role="tab">
                        <span class="d-none d-md-block">Detail Insured</span><span class="d-block d-md-none"><i class="mdi mdi-shield-account h5"></i></span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#t_premi" role="tab">
                        <span class="d-none d-md-block">Premium Calculation</span><span class="d-block d-md-none"><i class="mdi mdi-cash-multiple h5"></i></span>
                        </a>
                    </li>
                    <li class="nav-item" <?= ($sppa['no_polis'] == '') ? 'hidden' : '' ?>>
                        <a class="nav-link" data-toggle="tab" href="#t_e_polis" role="tab">
                        <span class="d-none d-md-block">E-polis</span><span class="d-block d-md-none"><i class="mdi mdi-file-document-outline h5"></i></span>
                        </a>
                    </li>
                </ul>

                <div class="tab-content">
                    <div class="tab-pane active p-3" id="t_client_data" role="tabpanel">

                        <div class="mt-2">
                            <!-- <h4>Insurer</h4><hr> -->
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group row sel2">
                                    <label for="id_insurer" class="col-sm-4 col-form-label text-left">Insurer</label>
                                    <div class="col-sm-8 mt-2">
                                        <span>: <?= $sppa['nama_asuransi'] ?></span>
                                    </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    
                                </div>
                            </div>
                            <h4>Type of Business</h4><hr>
                            <div class="row">
                            
                                <div class="col-md-6">
                                    <div class="form-group row sel2">
                                        <label for="no_klaim" class="col-sm-4 col-form-label">Produk</label>
                                        <div class="col-sm-8 mt-2">
                                            <span>: <?= $sppa['lob'] ?></span>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group row sel2">
                                        <label for="no_klaim" class="col-sm-4 col-form-label">Premi</label>
                                        <div class="col-sm-8 mt-2">
                                            <span>: Rp. <?=  number_format($sppa['premi'],0,'.','.') ?></span>
                                        </div>
                                    </div>
                                </div>
                            
                            </div>
                        </div>
                        
                    </div>
                    <div class="tab-pane p-3" id="t_detail" role="tabpanel">
                        <h4>Insured</h4><hr>
                        <div class="row detail_pengguna_ttg">
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label for="nik" class="col-sm-4 col-form-label text-left">NIK</label>
                                    <div class="col-sm-8 mt-2">
                                        <span id="t_nik">: <?= $sppa['nik'] ?></span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="nama" class="col-sm-4 col-form-label text-left">Nama</label>
                                    <div class="col-sm-8 mt-2">
                                        <span id="t_nama">: <?= $sppa['nama'] ?></span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="tempat_lahir" class="col-sm-4 col-form-label text-left">Tempat Lahir</label>
                                    <div class="col-sm-8 mt-2">
                                        <span id="t_tempat_lahir">: <?= $sppa['tempat_lahir'] ?></span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="tgl_lahir" class="col-sm-4 col-form-label text-left">Tanggal Lahir</label>
                                    <div class="col-sm-8 mt-2">
                                        <span id="t_tgl_lahir">: <?= date("d-M-Y", strtotime($sppa['tgl_lahir'])) ?></span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="tgl_lahir" class="col-sm-4 col-form-label text-left">Jenis Kelamin</label>
                                    <div class="col-sm-8 mt-2">
                                        <span id="t_jenis_kelamin">: <?= ($sppa['jenis_kelamin'] == 't') ? 'Laki-laki' : 'Perempuan' ?></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label for="tgl_lahir" class="col-sm-4 col-form-label text-left">Alamat</label>
                                    <div class="col-sm-8 mt-2">
                                        <span id="t_alamat">: <?= $sppa['alamat'] ?></span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="tgl_lahir" class="col-sm-4 col-form-label text-left">No Telepon</label>
                                    <div class="col-sm-8 mt-2">
                                        <span id="t_telp">: <?= $sppa['hp'] ?></span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="tgl_lahir" class="col-sm-4 col-form-label text-left">Pekerjaan</label>
                                    <div class="col-sm-8 mt-2">
                                        <span id="t_pekerjaan">: <?= $sppa['pekerjaan'] ?></span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="tgl_lahir" class="col-sm-4 col-form-label text-left">Email</label>
                                    <div class="col-sm-8 mt-2">
                                        <span id="t_email">: <?= $sppa['email'] ?></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php if ($sppa['punya_ahli_waris']): ?>
                            <div class="f_ahli_waris">

                                <?php $i=1; foreach ($ahli_waris as $w) : ?>
                                    <h4>Ahli Waris <?= $w['ahli_waris_ke'] ?></h4><hr>
                                    <div class="row">
                                        <div class="col-md-6">
                                            
                                            <div class="form-group row">
                                                <label for="nik_aw_<?= $i ?>" class="col-sm-4 col-form-label text-left">NIK</label>
                                                <div class="col-sm-8 mt-2">
                                                    <span>: <?= $w['nik'] ?></span>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="nama_aw_<?= $i ?>" class="col-sm-4 col-form-label text-left">Nama</label>
                                                <div class="col-sm-8 mt-2">
                                                    <span>: <?= $w['nama'] ?></span>
                                                </div>
                                            </div>
                                            <?php if ($status == 'non kk'): ?>
                                            
                                                <div class="form-group row" id="alamat_<?= $i ?>" style="display: none;">
                                                    <label for="no_hp_aw_<?= $i ?>" class="col-sm-4 col-form-label text-left">Alamat</label>
                                                    <div class="col-sm-8 mt-2">
                                                        <span>: <?= $w['alamat'] ?></span>
                                                    </div>
                                                </div>

                                            <?php endif; ?>

                                        </div>
                                        <div class="col-md-6">
                                            
                                            <div class="form-group row">
                                                <label for="no_hp_aw_<?= $i ?>" class="col-sm-4 col-form-label text-left">No HP</label>
                                                <div class="col-sm-8 mt-2">
                                                    <span>: <?= $w['hp'] ?></span>
                                                </div>
                                            </div>
                                            <div class="form-group row sel2">
                                                <label for="id_hubungan_klg_aw_<?= $i ?>" class="col-sm-4 col-form-label text-left">Hubungan</label>
                                                <div class="col-sm-8 mt-2">
                                                    <span>: <?= $w['hubungan_klg'] ?></span>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                <?php $i++; endforeach ?>

                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="tab-pane p-3" id="t_premi" role="tabpanel">

                        <h4>Premium and Payment</h4><hr>
                        <div class="d-flex justify-content-center">
                            <div class="col-md-8">

                                <table class="table mb-2">
                                    <thead class="text-center thead-default">
                                        <tr>
                                            <th>Produk</th>
                                            <th colspan="2">Biaya</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td id="txt_produk"><?= $sppa['lob'] ?></td>
                                            <td>Rp.</td>
                                            <td id="txt_premi" align="right"><?= number_format($sppa['premi'],0,'.','.') ?></td>
                                        </tr>
                                        <tr>
                                            <td>Biaya Admin</td>
                                            <td>Rp.</td>
                                            <td id="txt_biaya_admin" align="right">0</td>
                                        </tr>
                                    </tbody>
                                    <tfoot class="thead-default">
                                        <tr>
                                            <th>Total Tagihan</th>
                                            <th>Rp.</td>
                                            <th id="txt_total" class="text-right"><?= number_format($sppa['premi'],0,'.','.') ?></th>
                                        </tr>
                                    </tfoot>
                                </table>

                            </div>
                        </div>
                        <h4>Payment Method</h4><hr>
                        <label><?= $sppa['method'] ?></label><br>
                        - <label><?= $sppa['payment_method'] ?></label>
                    </div>
                    <div class="tab-pane p-3" id="t_e_polis" role="tabpanel">
                        <div class="card">
                        <div class="card-body">
                        <div class="row" id="bg_polis">
                            <div class="" id="bg_img">
                                <?= br(4) ?>
                                <h4 align="" style="font-weight: bold; margin-left: 20%;">Syariah Asuransiku</h4>
                                <h5 align="" style="font-weight: bold; margin-left: 27%;">Data Peserta</h5>
                                <?= br() ?>
                                <table style="width: 100%; margin-left: 10px;">
                                    <tbody>
                                        <tr>
                                            <td width= "30%">Nomor Polis</td>
                                            <td style="font-weight: bold;">: <?= $sppa['no_polis'] ?></td>
                                        </tr>
                                        <tr>
                                            <td width= "30%">Nama Tertanggung</td>
                                            <td style="font-weight: bold;">: <?= $sppa['nama'] ?></td>
                                        </tr>
                                        <tr>
                                            <td width= "30%">Alamat</td>
                                            <td style="font-weight: bold;">: <?= wordwrap($sppa['alamat'],35,"<br>\n") ?></td>
                                        </tr>
                                        <tr>
                                            <td width= "30%">Tanggal Lahir</td>
                                            <td style="font-weight: bold;">: <?= date("d-m-Y", strtotime($sppa['tgl_lahir'])) ?></td>
                                        </tr>
                                        <tr>
                                            <td width= "30%">Jenis Pertanggungan</td>
                                            <td style="font-weight: bold;">: <?= $sppa['lob'] ?>/Premi Rp. <?= number_format($sppa['premi'],0,'.','.') ?></td>
                                        </tr>
                                        <tr>
                                            <td width= "30%">Tanggal Mulai Pertanggungan</td>
                                            <td style="font-weight: bold;">: <?= date("d-m-Y", strtotime($sppa['tgl_awal_polis'])) ?></td>
                                        </tr>
                                        <tr>
                                            <td width= "30%">Tanggal Akhir Pertanggungan</td>
                                            <td style="font-weight: bold;">: <?= date("d-m-Y", strtotime($sppa['tgl_akhir_polis'])) ?></td>
                                        </tr>
                                        <tr>
                                            <td width= "30%">Masa Pertanggungan Polis</td>
                                            <td style="font-weight: bold;">: <?= $masa_polis ?> Tahun</td>
                                        </tr>
                                        <tr>
                                            <td width= "30%" style="vertical-align: top;">Manfaat Pertanggungan</td>
                                            <td style="font-weight: bold;">: 
                                                <?php foreach ($manfaat as $m): ?>
                                                
                                                        <?= $m['manfaat'] ?>
                                                        <br>
                                                        Rp. <?= number_format($m['nilai'],0,'.','.') ?><br>
                                                    
                                                <?php endforeach; ?>
                                            </td>
                                        </tr>

                                        <?php foreach ($ahli_waris as $r): ?>
                                            <tr>
                                                <td width= "30%">Ahli Waris <?= $r['ahli_waris_ke'] ?></td>
                                                <td style="font-weight: bold;">: <?= $r['nama'] ?></td>
                                            </tr>
                                            <tr>
                                                <td width= "30%">Hubungan Ahli Waris <?= $r['ahli_waris_ke'] ?></td>
                                                <td style="font-weight: bold;">: <?= $r['hubungan_klg'] ?></td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                            
                        </div>
                        </div>
                        <div id="previewImage"></div> 
                        <div class="card-footer text-center">
                            <a href="#" id="download_epolis"><button type="button" class="btn btn-primary">Download E-polis</button></a>
                        </div>
                        </div>
                    </div>
                </div>
                
            </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {

        document.getElementById("download_epolis").addEventListener("click", function() {
            html2canvas(document.getElementById("bg_polis")).then(function (canvas) {			var anchorTag = document.createElement("a");
                    document.body.appendChild(anchorTag);
                    anchorTag.download = "e_polis.jpg";
                    anchorTag.href = canvas.toDataURL();
                    anchorTag.target = '_blank';
                    anchorTag.click();
                });
        });

        // $("#download_epolis").on('click', function () {
        //     html2canvas(document.getElementById("bg_img"),		{
        //         allowTaint: true,
        //         useCORS: true
        //     }).then(function (canvas) {
        //         var anchorTag = document.createElement("a");
        //         document.body.appendChild(anchorTag);
        //         // document.getElementById("previewImg").appendChild(canvas);
        //         anchorTag.download = "e_polis.jpg";
        //         anchorTag.href = canvas.toDataURL();
        //         anchorTag.target = '_blank';
        //         anchorTag.click();
        //     });
        // });

        // Global variable 
        // var element = $("#bg_img");  

        // var getCanvas;  

        // $("#download_epolis").on('click', function() { 

        //     html2canvas(element, { 
        //         onrendered: function(canvas) { 
        //             $("#previewImage").append(canvas); 
        //             getCanvas = canvas; 
        //         } 
        //     }); 

        //     var imgageData = getCanvas.toDataURL("image/png",1); 
            
        //     // Now browser starts downloading  
        //     // it instead of just showing it 
        //     var newData = imgageData.replace(/^data:image\/png/, "data:application/octet-stream"); 
            
        //     $("#download_epolis").attr("download", "e_polis.png").attr("href", newData); 
        // }); 
        
    })
</script>