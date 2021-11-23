<div class="row">
	<?php foreach ($detail_jurnal as $var): ?>
		<div class="col-md-6 col-lg-6">
		<div class="card text-white ">
						<div class="card-header bg-info">
					<h5 class="card-title"><?php echo $var->deskripsi_coa ?></h5>
				<div class="card-tools">
                  <button type="button" class="btn btn-tool" data-widget="collapse">
                    <i class="fa fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-widget="remove">
                    <i class="fa fa-times"></i>
                  </button>
                </div>
                </div>
				<div class="card-body">
					<form>
						<input type="hidden" name="id_jurnal" id="id_jurnal" value="<?php echo $var->id_jurnal ?>">
						<div class="form-group">
							<select style="width:100%!important;" name="" id="groupk" class="form-control sel2g " required="required">
									
								<?php foreach ($group as $g) {?>
								<option value="<?php echo $g->id_group ?>"
									<?php if ($g->id_group == $var->id_group) {
										echo "selected='selected'";
									} ?>><?php echo $g->group ?></option>
							<?php } ?>
							</select>
						</div>
						
						<div class="form-group">
							<input type="text" name="tgl_transaksi" id="tgl_transaksi" class="form-control datepicker" required="required" title="" value="<?php echo date('d-M-Y')?>">
						</div>
						<div class="form-group">
							<input type="text" name="nominal" id="nominal" class="form-control numb" required="required" placeholder="Nominal">
						</div>
						<div class="form-group">
							<select style="width:100%!important;" name="pelaksana" id="pelaksana" class="form-control sel2p" required="required">
								<option value=""></option>
								<?php foreach ($pelaksana as $pel) {?>
								<option value="<?php echo $pel->id_anggota ?>"><?php echo $pel->nama_lengkap ?></option>
							<?php } ?>
							</select>
						</div>
						<div class="form-group">
							<textarea name="keterangan" id="keterangan" class="form-control" rows="3" required="required"></textarea>
						</div>
						<button type="button" class="btn btn-info float-right" id="btn-save-jd">Simpan</button>
					</form>
				</div>
			</div>
	</div>
	<?php endforeach ?>
	
	<div class="col-md-6 col-lg-6">
		<div class="card text-white ">
						<div class="card-header bg-info">
					<h5 class="card-title">Tambah Jurnal Debit</h5>
				<div class="card-tools">
                  <button type="button" class="btn btn-tool" data-widget="collapse">
                    <i class="fa fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-widget="remove">
                    <i class="fa fa-times"></i>
                  </button>
                </div>
                </div>
				<div class="card-body">
					<form>
						<input type="hidden" name="id_jurnal" id="id_jurnal">
						<div class="form-group">
							<select style="width:100%!important;" name="" id="group" class="form-control sel2g " required="required">
								<option></option>
								<?php foreach ($group as $g) {?>
								<option value="<?php echo $g->id_group ?>"><?php echo $g->group ?></option>
							<?php } ?>
							</select>
						</div>
						<div class="form-group">
							<select style="width:100%!important;" name="" id="head_coa" class="form-control sel2 " required="required">
								<option></option>
								<?php foreach ($head_coa as $head) {?>
								<option value="<?php echo $head->id_head_coa ?>"><?php echo $head->head_coa ?></option>
							<?php } ?>
							</select>
						</div>
						<div class="form-group">
							<select style="width:100%!important;" name="" id="main_coa" class="form-control sel2m" required="required">
								<option></option>
								<?php foreach ($main_coa as $main) {?>
								<option value="<?php echo $main->id_main_coa ?>" data-chained="<?php echo $main->id_head_coa ?>"><?php echo $main->main_coa ?></option>
							<?php } ?>
							</select>
						</div>
						<div class="form-group">
							<select style="width:100%!important;" name="des_coa" id="des_coa" class="form-control sel2d" required="required">
								<option></option>
								<?php foreach ($description_coa as $des) {?>
								<option value="<?php echo $des->no_coa_des ?>" data-chained="<?php echo $des->id_main_coa ?>"><?php echo $des->deskripsi_coa ?></option>
							<?php } ?>
							</select>
						</div>
						<div class="form-group">
							<input type="text" name="tgl_transaksi" id="tgl_transaksi" class="form-control datepicker" required="required" title="" value="<?php echo date('d-M-Y')?>">
						</div>
						<div class="form-group">
							<input type="text" name="nominal" id="nominal" class="form-control numb" required="required" placeholder="Nominal">
						</div>
						<div class="form-group">
							<select style="width:100%!important;" name="pelaksana" id="pelaksana" class="form-control sel2p" required="required">
								<option value=""></option>
								<?php foreach ($pelaksana as $pel) {?>
								<option value="<?php echo $pel->id_anggota ?>"><?php echo $pel->nama_lengkap ?></option>
							<?php } ?>
							</select>
						</div>
						<div class="form-group">
							<textarea name="keterangan" id="keterangan" class="form-control" rows="3" required="required"></textarea>
						</div>
						<button type="button" class="btn btn-info float-right" id="btn-save-jd">Simpan</button>
					</form>
				</div>
			</div>
	</div>
	<div class="col-md-6" >
			<div class="card text-white ">
						<div class="card-header bg-info">
					<h5 class="card-title">Tambah Jurnal Kredit</h5>
				
				<div class="card-tools">
                  <button type="button" class="btn btn-tool" data-widget="collapse">
                    <i class="fa fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-widget="remove">
                    <i class="fa fa-times"></i>
                  </button>
                </div>
                </div>
				<div class="card-body">
					<form>
						<input type="hidden" name="id_jurnalk" id="id_jurnalk">
						<div class="form-group">
							<select style="width:100%!important;" name="" id="groupk" class="form-control sel2g " required="required">
								<option></option>
								<?php foreach ($group as $g) {?>
								<option value="<?php echo $g->id_group ?>"><?php echo $g->group ?></option>
							<?php } ?>
							</select>
						</div>
						<div class="form-group">
							<select style="width:100%!important;" name="" id="head_coak" class="form-control sel2 " required="required">
								<option></option>
								<?php foreach ($head_coa as $head) {?>
								<option value="<?php echo $head->id_head_coa ?>"><?php echo $head->head_coa ?></option>
							<?php } ?>
							</select>
						</div>
						<div class="form-group">
							<select style="width:100%!important;"  name="" id="main_coak" class="form-control sel2m" required="required">
								<option></option>
								<?php foreach ($main_coa as $main) {?>
								<option value="<?php echo $main->id_main_coa ?>" data-chained="<?php echo $main->id_head_coa ?>"><?php echo $main->main_coa ?></option>
							<?php } ?>
							</select>
						</div>
						<div class="form-group">
							<select style="width:100%!important;"  name="des_coak" id="des_coak" class="form-control sel2d" required="required">
								<option></option>
								<?php foreach ($description_coa as $des) {?>
								<option value="<?php echo $des->no_coa_des ?>" data-chained="<?php echo $des->id_main_coa ?>"><?php echo $des->deskripsi_coa ?></option>
							<?php } ?>
							</select>
						</div>
						<div class="form-group">
							<input type="text" name="tgl_transaksik" id="tgl_transaksik" class="form-control datepicker" required="required" value="<?php echo date('d-M-Y')?>">
						</div>
						<div class="form-group">
							<input type="text" name="nominalk" id="nominalk" class="form-control numb1" required="required" title="" >
						</div>
						<div class="form-group">
							<select style="width:100%!important;" name="pelaksanak" id="pelaksanak" class="form-control sel2p" required="required">
								<option value=""></option>
								<?php foreach ($pelaksana as $pel) {?>
								<option value="<?php echo $pel->id_anggota ?>"><?php echo $pel->nama_lengkap ?></option>
							<?php } ?>
							</select>
						</div>
						<div class="form-group">
							<textarea name="keterangank" id="keterangank" class="form-control" rows="3" required="required"></textarea>
						</div>
						<button type="button" class="btn btn-info float-right" id="btn-save-jk">Simpan</button>
					</form>
				</div>
			</div>
		</div>
</div>
<div class="container-fluid">
			<table id="tbl_list_form_jurnal" class="table table-hover" width="100%" >
			<thead class="bg-info">
				<tr>
					<th style="width:30px;">No</th>
					<th nowrap>COA</th>
					<th>Tanggal</th>
					<th>Debit</th>
					<th>Kredit</th>
					<th>Aksi</th>
				</tr>
			</thead>
			<tbody id="show_list_form_jurnal">
			</tbody>
			
		</table>
			<button type="button" class="btn btn-info mb-3 mt-2 float-right" id="post_jurnal">Posting Jurnal</button>
		</div>		