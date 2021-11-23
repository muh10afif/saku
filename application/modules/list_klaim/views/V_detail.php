<div class="page-title-box">
    <div class="row align-items-center">
        <div class="col-sm-6">
            <h4><?= $title ?></h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-right">
                <li class="breadcrumb-item"><a href="<?= base_url() ?>">All COB</a></li>
                <li class="breadcrumb-item">Transaction</li>
                <li class="breadcrumb-item">Outgoing</li>
                <li class="breadcrumb-item"><a href="<?= base_url('List_klaim') ?>">List Klaim</a></li>
                <li class="breadcrumb-item active"><?= $title ?></li>
            </ol>
        </div>
    </div>
</div>


<div class="row">

    <div class="col-md-12">
        <div class="card shadow ">
            <div class="card-header">
                <a href="<?= base_url('list_klaim') ?>"><button class="btn btn-primary float-right"><i class="fas fa-arrow-left mr-2"></i>Kembali</button></a>
            </div>
            <div class="card-body table-responsive">

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
                <div class="row p-3">
                    <div class="col-md-12">
                        <h5 class="mt-0">FORM KLAIM</h5>
                    </div>
                    <div class="col-md-6">

                        <div class="form-group row">
                            <label for="id_insured" class="col-md-4 col-form-label text-left" id="l_detail">Status Klaim</label>
                            <div class="col-md-8 mt-1">
                                <?php 

                                    if ($list['status_klaim'] == 0) {
                                        $sts_k = "<span class='badge badge-warning'>Diajukan</span>";
                                    } elseif ($list['status_klaim'] == 1) {
                                        $sts_k = "<span class='badge badge-primary'>Disetujui</span>";
                                    } elseif ($list['status_klaim'] == 2)  {
                                        $sts_k = "<span class='badge badge-primary'>Dicairkan</span>";
                                    } elseif ($list['status_klaim'] == 3)  {
                                        $sts_k = "<span class='badge badge-danger'>Ditolak</span>";
                                    }
                                    
                                ?>
                                <span>: <?= $sts_k ?></span>
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label for="no_polis" class="col-md-4 col-form-label text-left">Jenis Klaim</label>
                            <div class="col-md-8 mt-1">
                                <span>: <?= ($list['manfaat']) ? $list['manfaat'] : '-' ?></span>
                            </div>
                        </div> 
                        <div class="form-group row">
                            <label for="no_polis" class="col-md-4 col-form-label text-left">Nama Pemohon</label>
                            <div class="col-md-8 mt-1">
                                <span>: <?= ($list['nama_pemohon']) ? $list['nama_pemohon'] : '-' ?></span>
                            </div>
                        </div> 
                        <div class="form-group row">
                            <label for="no_polis" class="col-md-4 col-form-label text-left">Alamat Pemohon</label>
                            <div class="col-md-8 mt-1">
                                <span>: <?= ($list['alamat_pemohon']) ? $list['alamat_pemohon'] : '-' ?></span>
                            </div>
                        </div> 
                        <div class="form-group row">
                            <label for="id_insured" class="col-md-4 col-form-label text-left" id="l_detail">Tanggal Kejadian</label>
                            <div class="col-md-8 mt-1">
                                <?php 

                                    if ($list['tgl_kejadian']) {
                                        $tgl_kj = date('d-M-Y H:i:s', strtotime($list['tgl_kejadian']));
                                    } else {
                                        $tgl_kj = "-";
                                    }

                                ?>
                                <span>: <?= $tgl_kj ?></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        
                        <div class="form-group row">
                            <label for="no_polis" class="col-md-4 col-form-label text-left">Lokasi Kejadian</label>
                            <div class="col-md-8 mt-1">
                                <span>: <?= ($list['lokasi_kejadian']) ? $list['lokasi_kejadian'] : '-' ?></span>
                            </div>
                        </div> 
                        <div class="form-group row">
                            <label for="no_polis" class="col-md-4 col-form-label text-left">Penyebab</label>
                            <div class="col-md-8 mt-1">
                                <span>: <?= ($list['penyebab']) ? $list['penyebab'] : '-' ?></span>
                            </div>
                        </div> 
                        <div class="form-group row">
                            <label for="no_polis" class="col-md-4 col-form-label text-left">TTD</label>
                            <div class="col-md-8 mt-1">
                                <?php 

                                    if ($list['ttd'] != '') {
                                        $ttd = "<a class='image-popup-no-margins' href='".$url_img.'dokumen_klaim/user_'.$list['id_nasabah_klaim'].'/'.$list['ttd']."'> <img src='".$url_img.'dokumen_klaim/user_'.$list['id_nasabah_klaim'].'/'.$list['ttd']."' width='100px'></a>";
                                    } else {
                                        $ttd = "-";
                                    }
                                
                                ?>
                                <span>: <?= $ttd ?></span>
                            </div>
                        </div>
                        <?php if ($list['status_klaim'] == 3): ?>
                            <div class="form-group row">
                                <label for="no_polis" class="col-md-4 col-form-label text-left">Alasan Ditolak</label>
                                <div class="col-md-8 mt-1">
                                    <span>: <?= ($list['alasan_tolak']) ? $list['alasan_tolak'] : '-' ?></span>
                                </div>
                            </div> 
                        <?php endif; ?>
                        
                    </div>

                </div>
                <div class="row p-3">
                    <div class="col-md-12">
                        <h5 class="mt-0">Pembayaran Klaim</h5>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label for="no_polis" class="col-md-4 col-form-label text-left">No Rekening</label>
                            <div class="col-md-8 mt-1">
                                <span>: <?= ($list['no_rekening']) ? $list['no_rekening'] : '-' ?></span>
                            </div>
                        </div> 
                        <div class="form-group row">
                            <label for="no_polis" class="col-md-4 col-form-label text-left">Nama Pemilik Rekening</label>
                            <div class="col-md-8 mt-1">
                                <span>: <?= ($list['nama_pemilik_rekening']) ? $list['nama_pemilik_rekening'] : '-' ?></span>
                            </div>
                        </div> 
                        <div class="form-group row">
                            <label for="no_polis" class="col-md-4 col-form-label text-left">Bank</label>
                            <div class="col-md-8 mt-1">
                                <span>: <?= ($list['nama_bank']) ? $list['nama_bank'] : '-' ?></span>
                            </div>
                        </div> 
                        
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label for="no_polis" class="col-md-4 col-form-label text-left">Tanggal Bayar</label>
                            <div class="col-md-8 mt-1">
                                <?php 

                                if ($list['tgl_bayar']) {
                                    $da = date("d-m-Y", strtotime($list['tgl_akhir_polis']));
                                } else {
                                    $da = '-';
                                }

                                ?>
                                <span>: <?= $da ?></span>
                            </div>
                        </div> 
                        <div class="form-group row">
                            <label for="no_polis" class="col-md-4 col-form-label text-left">Nilai Bayar</label>
                            <div class="col-md-8 mt-1">
                                <?php 

                                    if ($list['nilai_bayar'] != '') {
                                        $nb = "Rp. ".number_format($list['nilai_bayar'],0,'.','.');
                                    } else {
                                        $nb = "-";
                                    }
                                
                                ?>
                                <span>: <?= $nb ?>
                            </div>
                        </div> 
                    </div>
                </div>
                <div class="row p-3">
                    <div class="col-md-12">
                        <h5 class="mt-0">Dokumen Klaim</h5>
                    </div>
                    <div class="col-md-12">
                    <div class="d-flex justify-content-start">
                        <div class="col-md-6">
                        <table class="table table-light">
                            <!-- <thead class="thead-light text-center">
                                <tr>
                                    <th>No</th>
                                    <th>Dokumen</th>
                                    <th>Image</th>
                                </tr>
                            </thead> -->
                            <tbody class="zoom-gallery">
                                <?php $no=1; foreach ($dok_klaim as $d): ?>
                                    <tr>
                                        <td><?= $no ?>.</td>
                                        <td>
                                            <label class="col-form-label text-left"><?= $d['dokumen'] ?></label>
                                        </td>
                                        <td>
                                            <a href="<?= $url_img.'dokumen_klaim/user_'.$list['id_nasabah_klaim'].'/'.$d['nama_file'] ?>" title="<?= $d['dokumen'] ?>">
                                            <img class="m-2" src="<?= $url_img.'dokumen_klaim/user_'.$list['id_nasabah_klaim'].'/'.$d['nama_file'] ?>" width='100px'>  </a>
                                        </td>
                                        
                                    </tr>
                                <?php $no++; endforeach; ?>
                            </tbody>
                        </table>
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

        $('.image-popup-no-margins').magnificPopup({
            type: 'image',
            closeOnContentClick: true,
            closeBtnInside: false,
            fixedContentPos: true,
            mainClass: 'mfp-no-margins mfp-with-zoom', // class to remove default margin from left and right side
            image: {
                verticalFit: true
            },
            zoom: {
                enabled: true,
                duration: 200 // don't foget to change the duration also in CSS
            }
        });

        $('.zoom-gallery').magnificPopup({
            delegate: 'a',
            type: 'image',
            closeOnContentClick: false,
            closeBtnInside: false,
            mainClass: 'mfp-with-zoom mfp-img-mobile',
            image: {
                verticalFit: true,
                titleSrc: function(item) {
                    return item.el.attr('title') + ' &middot; <a href="'+item.el.attr('data-source')+'" target="_blank">image source</a>';
                }
            },
            gallery: {
                enabled: true
            },
            zoom: {
                enabled: true,
                duration: 300, // don't foget to change the duration also in CSS
                opener: function(element) {
                    return element.find('img');
                }
            }
        });
        
    })
</script>