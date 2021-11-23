<?php  
header("Content-Type:   application/vnd.ms-excel; charset=utf-8");
header("Content-Disposition: attachment; filename=abc.xls");  //File name extension was wrong
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("Cache-Control: private",false);
echo "Some Text";
?>
<h2 class="text-primary">Detail Buku Besar</h3>

<table width="100%" id="tbl_detail_bb"  class="table table-hover" style="margin-bottom: 200px;" >
			<thead class="bg-primary">
				<tr id="">
					<th colspan="6" class="text-right">Saldo Awal :</th>
					<th id="sac"></th>
				</tr>
				<tr>
					<th style="width:30px;">No</th>
					<th>Tanggal</th>
					<th nowrap>COA</th>
					<th>Deskripsi</th>
					<th>Debit</th>
					<th>Kredit</th>
					<th>Total</th>
				</tr>
				
			</thead>
			<tbody id="data_detail_bb">
			</tbody>
			<tfoot>	
					<th></th>
					<th></th>
					<th></th>
					<th class="text-right">Total :</th>
					<th></th>
					<th></th>
					<th></th>
			</tfoot>
		</table>

		<div class="card" style="width: 100%">
		  <div class="card-body bg-primary">
		    <div class="row">
		    	<div class="col-md-9"></div>
		    	<div class="col-md-3">
		    		<b id="sak"></b>
		    	</div>										
		    </div>
		  </div>
		</div>



		