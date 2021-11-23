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
                    <div class="col-md-5">
                        <div class="form-group row">
                            <label class="col-md-4 col-form-label mt-1" style="font-size: 15px;">Kode Transaksi</label>
                            <div class="col-md-8 mt-2">
                                : <span><?= $data_jurnal['kode_transaksi'] ?></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="form-group row">
                            <label class="col-md-4 col-form-label mt-1" style="font-size: 15px;">Nama Transaksi</label>
                            <div class="col-md-8 mt-1">
                                <input type="text" name="nama_transaksi" class="form-control" id="nama_transaksi" value="<?= $data_jurnal['nama_transaksi'] ?>">
                            </div>
                        </div>
                    </div>
                    <!-- <div class="col-md-4">
                        <div class="form-group row">
                            <label class="col-md-4 col-form-label mt-1" style="font-size: 15px;">Tanggal Buat</label>
                            <div class="col-md-8 mt-2">
                                : <span><?= date("d-m-Y", strtotime($data_jurnal['tgl_buat'])) ?></span>
                            </div>
                        </div>
                    </div> -->
                </div>
            </div>
        </div>

        <div class="card shadow">
            
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

                        <?php $i = 1; foreach ($detail_jurnal as $j) : ?>

                            <tr id="list_add<?= $i ?>">
                                <td align="center" class="label_jurnal" id="label_jurnal_<?= $i ?>" data-id="<?= $i ?>"><?= $i ?>.</td>
                                <td align="center">
                                    <select name="coa_<?= $i ?>" id="coa_<?= $i ?>" class="form-control select2 list_coa" data-id="<?= $i ?>">
                                        <option value="">Pilih</option>
                                        <?php foreach ($coa as $c) :?>
                                        <option value="<?php echo $c['no_coa_des'] ?>" <?= ($c['no_coa_des'] == $j['coa']) ? 'selected' : '' ?>><?= $c['no_coa_des']." - ".$c['deskripsi_coa'] ?></option>
                                        <?php endforeach ?>
                                    </select>
                                </td>
                                <td align="center">
                                    <select name="pelaksana_<?= $i ?>" id="pelaksana_<?= $i ?>" class="form-control select2 list_pelaksana" data-id="<?= $i ?>">
                                        <option value="">Pilih</option>
                                        <?php foreach ($pelaksana as $pel) {?>
                                        <option value="<?php echo $pel->id_karyawan ?>" <?= ($pel->id_karyawan == $j['pelaksana']) ? 'selected' : '' ?>><?php echo $pel->nama_karyawan ?></option>
                                        <?php } ?>
                                    </select>
                                </td>
                                <td align="center">
                                    <input type="text" id="tgl_<?= $i ?>" data-id="<?= $i ?>" class="list_tgl form-control datepicker text-center" value="<?= date("d-m-Y", strtotime($j['tgl_transaksi'])) ?>">
                                </td>
                                <td align="center">
                                    <input type="text" id="debit_<?= $i ?>" data-id="<?= $i ?>" class="list_debit form-control text-center number_separator numeric" value="<?= $j['debit'] ?>" <?= ($j['debit'] == 0) ? 'disabled' : '' ?>>
                                </td>
                                <td align="center">
                                    <input type="text" id="kredit_<?= $i ?>" data-id="<?= $i ?>" class="list_kredit form-control text-center number_separator numeric" value="<?= $j['kredit'] ?>" <?= ($j['kredit'] == 0) ? 'disabled' : '' ?>>
                                </td>
                                <td align="center">
                                    <span style="cursor: pointer;" data-toggle="tooltip" data-placement="top" title="Hapus" class='ttip remove text-danger' data-id="<?= $i ?>"><i class="far fa-trash-alt fa-lg"></i></span>
                                </td>
                            </tr>
                            
                        <?php $i++; endforeach; ?>

                    </tbody>

                </table>
                
            </div>
            <div class="card-footer">
                <mark><span class="font-italic text-primary font-weight-bold ket_balance">*DATA BALANCE</span></mark>
                <button type="button" class="btn btn-primary float-right" id="btn_simpan"><i class="fas fa-check mr-1"></i> Simpan</button>
            </div>
        </div>
    </div>
</div>

<input type="hidden" id="total_debit" value="<?= $data_jurnal['total_debit'] ?>">
<input type="hidden" id="total_kredit" value="<?= $data_jurnal['total_kredit'] ?>">
<input type="hidden" id="status_jurnal" value="edit">
<input type="hidden" id="id_jurnal_edit" value="<?= $id_jurnal ?>">

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

