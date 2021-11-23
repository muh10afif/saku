<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Nota Restitusi</title>
    <style>
        p {
            line-height: 1.5;
        }
    </style>
</head>
<body>
 
<div id="container">
    <img src="<?= base_url('assets/img/legowo icon.png') ?>" style="width: 20%; float: right;">
    <h3 style="text-align: center; margin-left: 100px;">Nota Restitusi Asuransi</h3>
    <h5 style="text-align: center; margin-left: -30px; padding-top: -50px;"><i>copy</i></h5>
    <hr style="height: 3px; color: black;">
    
    <table cellspacing="5">
        <tr>
            <td>Nomor Restitusi</td>
            <td>:</td>
            <td><?php echo $data['no_restitusi'] ?></td>
        </tr>
        <tr>
            <td>Nomor Sertifkat</td>
            <td>:</td>
            <td><?php echo $data['no_sertifikat_restitusi'] ?></td>
        </tr>
        <tr>
            <td>Pemegang Polis</td>
            <td>:</td>
            <td><?php echo $data['no_sertifikat'] ?></td>
        </tr>
        <tr>
            <td>Tanggal Realisasi</td>
            <td>:</td>
            <td><?php echo $data['no_sertifikat'] ?></td>
        </tr>
        <tr>
            <td>Nilai Pertanggungan</td>
            <td>:</td>
            <td><?php echo $data['no_sertifikat'] ?></td>
        </tr>
        <tr>
            <td>Premi</td>
            <td>:</td>
            <td><?php echo $data['premi'] ?></td>
        </tr>
        <tr>
            <td>Jangka Waktu</td>
            <td>:</td>
            <td><?php echo $data['lama_bulan'] ?> Bulan</td>
        </tr>
        <tr>
            <td>Tanggal Restitusi</td>
            <td>:</td>
            <td><?php echo $data['tgl_mulai'] ?></td>
        </tr>
        <tr>
            <td>Nama</td>
            <td>:</td>
            <td><?php echo $data['nama_nasabah'] ?></td>
        </tr>
        <tr>
            <td>Tanggal Lahir</td>
            <td>:</td>
            <td><?php echo $data['tgl_lahir'] ?></td>
        </tr>
        <tr>
            <td>Nilai Restitusi</td>
            <td>:</td>
            <td><?php echo $data['nilai_restitusi'] ?></td>
        </tr>
        <tr>
            <td>Askrida 28%</td>
            <td>:</td>
            <td>21.919</td>
        </tr>
    </table>

    <hr style="height: 3px; color: black;">

    <p>Dokumen Persyaratan</p>

    <table border="1" cellpadding="4" style="width: 100%; border-collapse: collapse;">
        <thead style="text-align: center;">
            <tr>
                <th>No</th>
                <th>Status</th>
                <th>Dokumen</th>
                <th>Kode</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td align="center">1.</td>
                <td align="center">v</td>
                <td>Surat Pengajuan Klaim</td>
                <td align="center">10110</td>
            </tr>
            <tr>
                <td align="center">2.</td>
                <td align="center">v</td>
                <td>Salinan KTP atau identitas diri lainnya</td>
                <td align="center">10120</td>
            </tr>
            <tr>
                <td align="center">3.</td>
                <td align="center">v</td>
                <td>Salinan Kartu Keluarga</td>
                <td align="center">10130</td>
            </tr>
            <tr>
                <td align="center">4.</td>
                <td align="center">v</td>
                <td>Salinan Mutasi Rekening Koran Kredit</td>
                <td align="center">10140</td>
            </tr>
            <tr>
                <td align="center">5.</td>
                <td align="center">v</td>
                <td>Asli Surat Keterangan kematian dari Keluarga (pihak yang berwenang) atau salinan yang telah dilegalisir</td>
                <td align="center">10150</td>
            </tr>
            <tr>
                <td align="center">6.</td>
                <td align="center">v</td>
                <td>Surat Perjanjian Kredit (P/K) (Asli/Legalisir)</td>
                <td align="center">101120</td>
            </tr>
        </tbody>
    </table>
    <h6 style="text-align: right;">Status v = Ada</h6>
    
    <p>Dibuat di JAKARTA <br>
    Tanggal :  <?= date("d-M-Y", now('Asia/Jakarta')) ?></p>
    <br>
    <br>
    Konsorsium Asuransi <br>
    <span>PT. Legowo Insurance Broker</span>

    <br>
    <br>
    <p style="text-align: center;">Sertifikat ini diterbitkan oleh sistem Komputer tidak memerlukan tanda tangan pengesahan <br> dokumen ini telah legal dan benar.</p>

</div>
 
</body>
</html>