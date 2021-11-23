<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Sertifikat Polis</title>
    <style>
        p {
            line-height: 1.8;
        }
    </style>
</head>
<body>
 
<div id="container">
    <img src="<?= base_url('assets/img/legowo icon.png') ?>" style="width: 20%; float: right;">
    <h3 style="text-align: center; margin-left: 100px;">Sertifikat Asuransi</h3>
    <h5 style="text-align: center; margin-left: -30px; padding-top: -50px;"><i>copy</i></h5>
    <hr style="height: 3px; color: black;">
    
    <table cellspacing="10">
    
    <?php //var_dump($data); die();?>
        <tr>
            <td>Nomor Sertifkat</td>
            <td>:</td>
            <td><?php echo $data['no_sertifikat'] ?></td>
        </tr>
        <tr>
            <td>Tanggal Mulai</td>
            <td>:</td>
            <td><?= $data['tgl_mulai'] ?></td>
        </tr>
        <tr>
            <td>Nama</td>
            <td>:</td>
            <td><?= $data['nama_nasabah'];?></td>
        </tr>
        <tr>
            <td>Periode</td>
            <td>:</td>
            <td><?= $data['account_period'] ?> Bulan</td>
        </tr>
        <tr>
            <td>Nilai Pertanggungan</td>
            <td>:</td>
            <td><?= number_format($data['nilai_pembiayaan'],2,",","."); ?></td>
        </tr>
        <tr>
            <td>Rate</td>
            <td>:</td>
            <td><?= $data['rate_premi']?></td>
        </tr>
        <tr>
            <td>Premi</td>
            <td>:</td>
            <td><?= number_format($data['premi'],2,",","."); ?></td>
        </tr>
    </table>

    <hr style="height: 3px; color: black;">

    <p>Pembayaran premi dapat dilakukan ke rekening BJB Cabang Utama Bandung No. Rekening XXXXXXXXX atas nama PT. LEGOWO Insurance Broker.</p>

    <p>Apabila dalam waktu 15 hari setelah penerbitan polis ini kami belum menerima pembayaran premi, maka segala resiko yang timbul tidak dapat kami cover (ganti).</p>
    <br><br>
    <p>Dibuat di JAKARTA <br>
    Tanggal : <?= date("d-M-Y", now('Asia/Jakarta')) ?> </p>
    <br>
    <br>
    <br>
    <br>
    <span>PT. Legowo Insurance Broker</span>

    <br>
    <br>
    <br>
    <br>
    <p style="text-align: center;">Sertifikat ini diterbitkan oleh sistem Komputer tidak memerlukan tanda tangan pengesahan <br> dokumen ini telah legal dan benar.</p>

</div>
 
</body>
</html>