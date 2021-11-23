<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Binding Slip</title>
    <style>
        p {
            line-height: 1.8;
        }
    </style>
</head>
<body>
 
<div id="container">
    <img src="<?php echo $_SERVER['DOCUMENT_ROOT'] ?>/assets/img/legowo icon.png" style="width: 20%; float: right; margin-top: -5px;">
    <h3 style="text-align: center; margin-left: 100px;">BINDING SLIP</h3>
    <h5 style="text-align: center; margin-left: -30px; padding-top: -50px;"><?= $tr_sppa['no_binding'] ?></h5>
    <hr style="height: 3px; color: black;">
    
    <table cellspacing="10">
        <tr>
            <td>Type Of Insurance</td>
            <td>:</td>
            <td><?= $lob ?></td>
        </tr>
        <?php foreach ($detail_lob as $d): $name = str_replace(" ","_", strtolower($d['field_sppa'])); ?>

        <tr>
            <td><?= ucwords($d['field_sppa']) ?></td>
            <td>:</td>
            <td><?= $tr_sppa[$name] ?></td>
        </tr>
        <?php endforeach; ?>
        <tr>
            <td>Total Sum Insured</td>
            <td>:</td>
            <td>Rp. <?= number_format($tr_sppa['total_sum_insured'],0,',','.') ?></td>
        </tr>
        <tr>
            <td style="vertical-align: none;">Annual Premium Rate</td>
            <td style="vertical-align: none;">:</td>
            <td>
                <table cellspacing="1">
                    <?php foreach ($premi as $p): ?>
                        <tr>
                            <td width="50%"><?= $p['label'] ?></td>
                            <td>:</td>
                            <td align="right"><?= nbs(4) ?> <?= $p['rate'] ?>%</td>
                        </tr>
                    <?php endforeach; ?>
                    <?php foreach ($premi_adt as $pa): ?>
                        <tr>
                            <td width="50%"><?= $pa['lob'] ?></td>
                            <td>:</td>
                            <td align="right"> <?= $pa['rate'] ?>%</td>
                        </tr>
                    <?php endforeach; ?>
                    <tr>
                        <td width="50%">Total</td>
                        <td>:</td>
                        <td align="right"><?= $tr_sppa['total_rate_akhir_premi'] ?>%</td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td>Premium Due</td>
            <td>:</td>
            <td> Rp. <?= number_format($tr_sppa['total_akhir_premi'],0,',','.') ?></td>
        </tr>
    </table>

    <hr style="height: 3px; color: black;">
    
    <br>
    <p>Dibuat di JAKARTA <br>
    Tanggal : <?= date("d-m-Y") ?> </p>
    <br>
    <br>
    <br>
    <span>PT. Legowo Insurance Broker</span>

    <br>
    <br>
    <br>

    <p>Acceptence</p>
    <table cellspacing="10">
        <tr>
            <td width="10%" align="center">Date</td>
            <td width="10%" align="center">Company</td>
            <td width="10%" align="center">Name & Positon</td>
            <td width="10%" align="center">Sign</td>
        </tr>
    </table>
    <?= br(5) ?>
    <hr style="height: 2px; color: black;">

</div>
 
</body>
</html>