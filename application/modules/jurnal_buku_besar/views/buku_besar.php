	<div class="card mb-3">
		  <div class="card-header bg-primary"><i class="fa fa-filter"></i> Filter</div>
		  <div class="card-body">
		  	<div class="row">
		  		<div class="col-md-3 col-lg-3">
		  		<select name="" id="fil_coa" class="form-control" required="required">
		   		</select>
		  		</div>
		  		<div class="col-md-3 col-lg-3">
		  			<form>
					<div class="input-group">
						<input class="form-control datepickers" type="text" name="" id="fil_periode" value="" aria-describedby="basic-addon2" placeholder="Pilih Periode" autocomplete="off">
						<div class="input-group-append">
							<button type="button" class="btn btn-primary" id="btn-filter-periode"><i class="fa fa-arrow-circle-right"></i></button>
						</div>
					</div>
		  			<!-- <div class="form-inline">
		   			<input class="form-control datepickers" type="text" name="" id="fil_periode" value="">
		   			<button type="button" class="btn btn-outline-primary ml-2" id="btn-filter-periode">Tampilkan</button>
		   			</div> -->
		  			</form>
		  		</div>
		  	</div>
		   
		   	<form>
		   				
		   	</form>
		  </div>
		</div>	

	<table width="100%" id="tbl_buku_besar"  class="table table-hover" style="margin-bottom: 200px;" >
			<thead class="bg-primary">
				<tr>
					<th style="width:30px;">No</th>
					<th nowrap>COA</th>
					<th>Deskripsi</th>
					<th>Periode</th>
					<th>Saldo Awal</th>
					<th>Debit</th>
					<th>Kredit</th>
					<th>Saldo Akhir</th>
					<th>Aksi</th>
				</tr>
			</thead>
			<tbody id="show_bukbes">
			</tbody>
			<tfoot>	
					<th></th>
					<th></th>
					<th></th>
					<th></th>
					<th></th>
					<th></th>
					<th style="text-align:right">Total:</th>
					<th width="250px;"></th>
					<th></th>
			</tfoot>
			
			
		</table>