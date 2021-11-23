<!DOCTYPE html>
<html>
<head>
	<title>Export Data Report Pipeline</title>
</head>
<body>
	<style type="text/css">
	body{
		font-family: sans-serif;
	}
	table{
		margin: 20px auto;
		border-collapse: collapse;
	}

	</style>

<?php
	header("Content-type: application/vnd-ms-excel");
	header("Content-Disposition: attachment; filename=Data Report Pipeline.xlsx");
?>

<div class="card mt-2 shadow f_tutup">
            <div class="card-body">
                <table id="datatable" class="table table-bordered table-hover dt-responsive nowrap tab" style="border-collapse: collapse; border-spacing: 0; width: 100%;" width="100%" cellspacing="0">
                <thead class="thead-light text-center">
                    <tr>    
                        <th rowspan="2">No</th> 

                        <th colspan="2">Name Of Insurance</th> 
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
                        <th>Form</th>
                        <th>TO</th> 

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
        tabel_pipeline = $('#datatable').DataTable({
            "processing" : true,
            "serverSide" : true,
            "order" : [],
            "ajax" : {
                "url" : "<?php echo base_url(); ?>report/pipelinereport/ajaxdatapipeline/"+act,
                "type" : "POST"
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