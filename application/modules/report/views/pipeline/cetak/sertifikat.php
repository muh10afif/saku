<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Sertifikat Polis</title>
    <style>
        p {
            line-height: 1.8;
        }
        
        td, th {
        border: 1px solid #ddd;
        padding: 8px;
        }

    </style>
</head>
<body>
 
<div id="container">
    <img src="<?= base_url('assets/img/legowo icon.png') ?>" style="width: 20%; float: right;">
    <h3 style="text-align: center; margin-left: 100px;">Report Pipeline</h3>
    <h5 style="text-align: center; margin-left: -30px; padding-top: -50px;"><i>-</i></h5>
    <hr style="height: 3px; color: black;">
    
    <div class="card-body">
                <table id="datatable2" class="table table-bordered table-hover dt-responsive nowrap tab datatable2" style="border-collapse: collapse; border-spacing: 0; width: 100%;" width="100%" cellspacing="0">
                <thead class="thead-light text-center">
                    <tr>
                        <th rowspan="2">No</th> 
                        <th colspan="2">Periode</th> 
                        <th rowspan="2">Name Of Insured</th> 
                        <th colspan="7">Share And Amount Brokerage</th> 
                        <th rowspan="2">LOB</th> 
                        <th rowspan="2">Insurance</th>
                        <th rowspan="2">Remaks</th>
                        <th rowspan="2">Total Premium</th> 
                        <th rowspan="2">Curent Status</th>
                        <th rowspan="2">Total Brokage</th> 
                        <th rowspan="2">Status Premi</th> 
                        <th rowspan="2">Acount Hendler</th> 
                    </tr>
                    <tr>
                        <!-- Periode -->
                        <th>Form</th>
                        <th>TO</th> 
                        <!-- Share And Amount Brokerage -->
                        <th>Name SOB</th>
                        <th>Discoun (%)</th> 
                        <th>Amount</th> 
                        <th>SOB Share (%)</th> 
                        <th>Amount</th> 
                        <th>OUR Share (%)</th> 
                        <th>Amount</th> 
                    </tr>
                    </thead>
                    
                </table>
            </div>

</div>
 

<script type="text/javascript" src="https://cdn.datatables.net/v/dt/jq-2.2.4/jszip-2.5.0/pdfmake-0.1.18/dt-1.10.13/b-1.2.4/b-colvis-1.2.4/b-flash-1.2.4/b-html5-1.2.4/cr-1.3.2/fh-3.1.2/r-2.1.0/sc-1.4.2/se-1.2.0/datatables.min.js"></script>
<script>
    var tabel_pipeline = '';
	$(document).ready(function () {
	
        var act = "<?=$role['update'].'_'.$role['delete']?>";
        $('.datatable2').DataTable({
            "processing" : true,
            "serverSide" : true,
            "order" : [],
            "ajax" : {
                "url" : "<?php echo base_url(); ?>report/pipeline/ajaxdatapipeline/"+act,
                "type" : "POST",
                
            },
            "columnDefs" : [{
                "targets" : [0,18],
                "orderable" : true
            },{
                'targets' : [0],
                'className' : 'text-center',
            }],
            "scrollX" : true
        });
    })
</script>


</body>
</html>