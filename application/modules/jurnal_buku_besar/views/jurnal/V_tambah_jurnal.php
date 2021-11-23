<style>
    input[type=checkbox] {
        transform: scale(1.3);
    }
</style>
<div class="page-title-box">
    <div class="row align-items-center">
        <div class="col-sm-4">
            <h4><?= $title ?></h4>
        </div>
        <div class="col-sm-8">
            <ol class="breadcrumb float-right">
                <li class="breadcrumb-item"><a href="<?= base_url() ?>">All COB</a></li>
                <li class="breadcrumb-item">Transaction</li>
                <li class="breadcrumb-item">Finance and Accounting</li>
                <li class="breadcrumb-item">Jurnal dan Buku Besar</li>
                <li class="breadcrumb-item active"><?= $title ?></li>
            </ol>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="card shadow">
            <div class="card-header">
                <a href="<?= base_url('Jurnal_buku_besar') ?>"><button class="btn btn-primary float-right"><i class="fas fa-arrow-left mr-1"></i> Kembali</button></a>
            </div>
            <div class="card-body">
                <div class="d-flex justify-content-center">
                    <div class="col-md-8">
                        <div class="form-group row">
                            <label class="col-md-4 col-form-label mt-1" style="font-size: 15px;">Buat Transaksi Baru</label>
                            <div class="col-md-8 mt-1">
                                <input type="text" name="nama_transaksi" class="form-control" id="nama_transaksi" placeholder="Nama Transaksi">
                                <!-- <input type="checkbox" class="" id="histori"> Hist -->
                                <div class="mt-2 check_histori">
                                    <input type="checkbox" class="mr-1" id="check_histori">
                                    <label class="col-form-label" for="check_histori"><span class="mt-3">History Transaksi</span></label>
                                </div>
                                <div class="sel_histori mt-2" style="display: none;">
                                    <select name="" id="history_trans" class="form-control select2">
                                        <option value="">Pilih History Transaksi</option>
                                        <?php foreach ($data_jurnal as $var) : ?>
                                            <option value="<?php echo $var->id_jurnal ?>"><?php echo $var->nama_transaksi ?></option>
                                        <?php endforeach ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <hr>
                <input type="hidden" id="status_buat_jurnal" value="0">
                <button type="button" class="btn btn-primary float-right" id="buat_jurnal"><i class="fas fa-check mr-2"></i>Buat Jurnal</button>
            </div>
        </div>

        <div class="card shadow form_jurnal" style="display: none;">
            
            <div class="card-body table-responsive">

                <button type="button" class="btn btn-outline-primary float-right mb-3" id="tambah_baris_baru"><i class="fas fa-angle-double-down mr-1"></i>Tambah Baris Baru</button>
                

                <table id="tbl_list_form_jurnal" class="table table-bordered table-hover mt-3" style="border-collapse: collapse; border-spacing: 0; width: 100%;" width="100%" >
                    <thead class="bg-primary text-white text-center">
                        <tr>
                            <th width="5%">No</th>
                            <th width="20%">COA</th>
                            <th width="20%">Pelaksana</th>
                            <th width="20%">Tanggal</th>
                            <th width="20%">Debit</th>
                            <th width="20%">Kredit</th>
                            <th width="5%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="baris_jurnal">

                        <tr id="list_add1">
                            <td align="center" class="label_jurnal" id="label_jurnal_1" data-id="1">1.</td>
                            <td align="center">
                                <select name="coa_1" id="coa_1" class="form-control select2 list_coa" data-id="1">
                                    <option value="">Pilih</option>
                                    <?php foreach ($coa as $c) :?>
                                    <option value="<?php echo $c['no_coa_des'] ?>"><?= $c['no_coa_des']." - ".$c['deskripsi_coa'] ?></option>
                                    <?php endforeach ?>
                                </select>
                            </td>
                            <td align="center">
                                <select name="pelaksana_1" id="pelaksana_1" class="form-control select2 list_pelaksana" data-id="1">
                                    <option value="">Pilih</option>
                                    <?php foreach ($pelaksana as $pel) {?>
                                    <option value="<?php echo $pel->id_karyawan ?>"><?php echo $pel->nama_karyawan ?></option>
                                    <?php } ?>
                                </select>
                            </td>
                            <td align="center">
                                <input type="text" id="tgl_1" data-id="1" class="list_tgl form-control datepicker text-center" placeholder="Pilih Tanggal">
                            </td>
                            <td align="center">
                                <input type="text" id="debit_1" data-id="1" class="list_debit form-control text-center number_separator numeric" placeholder="0">
                            </td>
                            <td align="center">
                                <input type="text" id="kredit_1" data-id="1" class="list_kredit form-control text-center number_separator numeric" placeholder="0">
                            </td>
                            <td align="center">
                                <span style="cursor: pointer;" data-toggle="tooltip" data-placement="top" title="Hapus" class='ttip remove text-danger' data-id="1"><i class="far fa-trash-alt fa-lg"></i></span>
                            </td>
                        </tr>

                        <tr id="list_add2">
                            <td align="center" class="label_jurnal" id="label_jurnal_2" data-id="2">2.</td>
                            <td align="center">
                                <select name="coa_2" id="coa_2" class="form-control select2 list_coa" data-id="2">
                                    <option value="">Pilih</option>
                                    <?php foreach ($coa as $c) :?>
                                    <option value="<?php echo $c['no_coa_des'] ?>"><?= $c['no_coa_des']." - ".$c['deskripsi_coa'] ?></option>
                                    <?php endforeach ?>
                                </select>
                            </td>
                            <td align="center">
                                <select name="pelaksana_2" id="pelaksana_2" class="form-control select2 list_pelaksana" data-id="2">
                                    <option value="">Pilih</option>
                                    <?php foreach ($pelaksana as $pel) {?>
                                    <option value="<?php echo $pel->id_karyawan ?>"><?php echo $pel->nama_karyawan ?></option>
                                    <?php } ?>
                                </select>
                            </td>
                            <td align="center">
                                <input type="text" id="tgl_2" data-id="2" class="list_tgl form-control datepicker text-center" placeholder="Pilih Tanggal">
                            </td>
                            <td align="center">
                                <input type="text" id="debit_2" data-id="2" class="list_debit form-control text-center number_separator numeric" placeholder="0">
                            </td>
                            <td align="center">
                                <input type="text" id="kredit_2" data-id="2" class="list_kredit form-control text-center number_separator numeric" placeholder="0">
                            </td>
                            <td align="center">
                                <span style="cursor: pointer;" data-toggle="tooltip" data-placement="top" title="Hapus" class='ttip remove text-danger' data-id="2"><i class="far fa-trash-alt fa-lg"></i></span>
                            </td>
                        </tr>

                    </tbody>

                </table>
                
            </div>
            <div class="card-footer">
                <mark><span class="font-italic text-danger font-weight-bold ket_balance">*DATA TIDAK BALANCE</span></mark>
                <button type="button" class="btn btn-primary float-right" id="btn_simpan" disabled><i class="fas fa-check mr-1"></i> Simpan</button>
            </div>
        </div>
    </div>
</div>

<input type="hidden" id="total_debit">
<input type="hidden" id="total_kredit">
<input type="hidden" id="status_jurnal" value="tambah">

<select name="" class="form-control list_coa_asli" hidden>
    <option value="">Pilih</option>
    <?php foreach ($coa as $c) :?>
    <option value="<?php echo $c['no_coa_des'] ?>"><?= $c['no_coa_des']." - ".$c['deskripsi_coa'] ?></option>
    <?php endforeach ?>
</select>

<select name="" class="form-control list_pelaksana_asli" hidden>
    <option value="">Pilih</option>
    <?php foreach ($pelaksana as $pel) {?>
    <option value="<?php echo $pel->id_karyawan ?>"><?php echo $pel->nama_karyawan ?></option>
    <?php } ?>
</select>

<?php $this->load->view('jurnal/jsnya'); ?>

