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
        <table class="table table-light table-bordered" id="tabel_ahli_waris">
            <thead class="thead-light text-center">
                <tr>
                    <th>No.</th>
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
                    </tr>
                <?php $no++; endforeach; ?>
                
            </tbody>
        </table>
    </div>
</div>