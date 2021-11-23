<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Invoice</title>
    <style>
        p {
            line-height: 1.8;
        }
    </style>
</head>
<body>
 
<div id="container">
    <img src="<?php echo $_SERVER['DOCUMENT_ROOT'] ?>/assets/img/logo.png" border="0" width="200" style="margin-top: -10px;">
    <br>
    <table cellspacing="5">
        <tr>
            <td>Debit Note</td>
            <td>:</td>
            <td><?= $tr_sppa['sppa_number'] ?></td>
        </tr>
        <tr>
            <td>Date</td>
            <td>:</td>
            <td><?= date("d-M-Y", now('Asia/Jakarta')) ?></td>
        </tr>
        <tr>
            <td>Policy No</td>
            <td>:</td>
            <td><?= $tr_sppa['no_polis'] ?></td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td>TO</td>
            <td>:</td>
            <td></td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td>Type Of Insurance</td>
            <td>:</td>
            <td></td>
        </tr>
        <tr>
            <td>Insured</td>
            <td>:</td>
            <td></td>
        </tr>
        <tr>
            <td>Insurance Period</td>
            <td>:</td>
            <td></td>
        </tr>
        <tr>
            <td>Tptal Sum Insured</td>
            <td>:</td>
            <td>IDR <?= number_format($tr_sppa['total_sum_insured'],0,'.','.') ?></td>
        </tr>
    </table>

    <p>Calculation of Insurance Premium</p>

    <table border="1" cellpadding="3" style="width: 70%; border-collapse: collapse;">
        <thead style="text-align: center;">
            <tr>
                <th>Premium Calculation</th>
                <th>Premium Due To Us</th>
        </thead>
        <tbody>
            <tr>
                <td>Premium</td>
                <td align="right"><?= number_format($tr_sppa['total_akhir_premi'],0,',','.') ?></td>
            </tr>
            <tr>
                <td>Admin Cost</td>
                <td align="right"><?= number_format($tr_sppa['biaya_admin'],0,',','.') ?></td>
            </tr>
            <tr>
                <td>Total Premium</td>
                <td align="right"><?= number_format($tr_sppa['total_tagihan'],0,',','.') ?></td>
            </tr>
        </tbody>
    </table>
    
    <br>
    <br>
    <br>

    <table cellspacing="3" style="margin-left: 400px;">
        <tr>
            <td>For and on behalf of</td>
        </tr>
        <tr>
            <td> PT. Legowo Insurance Broker</td>
        </tr>
        <tr>
            <td></td>
        </tr>
        <tr>
            <td></td>
        </tr>
        <tr>
            <td></td>
        </tr>
        <tr>
            <td></td>
        </tr>
        <tr>
            <td></td>
        </tr>
        </tr>
        <tr>
            <td></td>
        </tr>
        <tr>
            <td></td>
        </tr>
        <tr>
            <td><hr><br> Authorized Signature</td>
        </tr>
    </table>
    <br><br><br>

    <strong><u><i>PLEASE TRANSFERRED PREMIUM TO ACCOUNT NO </i></u></strong>
    <br>
    <br>
    <strong><i>PT LEGOWO <br>
    BANK BRI  CAB PONDOK INDAH (IDR) <br>
    NO. REK   036201001493309</i></strong>


</div>
 
</body>
</html>