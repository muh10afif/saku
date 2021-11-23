<h5 class="text-primary">Detail Buku Besar</h5>
<h6 class="text-primary" id="h_dbb"></h6>
	<form  action="<?php echo base_url('Keuangan/L_keuangan/excel') ?>" method="post">
		<input type="hidden"  id="coa_ex" name="coa_ex">
		<input type="hidden"  id="des_coa_ex" name="des_coa_ex">
		<input type="hidden"  id="tgl_trans_ex" name="tgl_trans_ex">
		<div class="form-inline">
			<select class="form-control mt-2" id="fil_group" name="group" style="width:18rem">
				<option value="" data="">-- Pilih Group --</option>
				<?php foreach ($group as $g): ?>
						<option value="<?php echo $g->group ?>" data="<?php echo $g->group ?>"><?php echo $g->group ?></option>
				<?php endforeach; ?>
			</select>
			<button type="submit" class="btn btn-primary mt-2 ml-2  text-white"><i class="fa fa-file-excel-o"></i> Export</button>
		</div>
	</form>
<div class="mt-1">
</div>
<table width="100%" id="tbl_detail_bb"  class="table table-hover" style="margin-bottom:200px;" >
			<thead class="bg-primary">
				<tr id="">
					<th colspan="6" class="text-right">Saldo Awal :</th>
					<th id="sac"></th>
				</tr>
				<tr>
					<th style="width:30px;">No</th>
					<th>Tanggal</th>
					<th>Group</th>
					<th>Uraian</th>
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
