
<div class="page-title-box">
    <div class="row align-items-center">
        <div class="col-sm-6">
            <h4><?= $title ?></h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-right">
                <li class="breadcrumb-item"><a href="<?= base_url() ?>">All COB</a></li>
                <li class="breadcrumb-item">Scoring Asuransi</li>
                <li class="breadcrumb-item active"><?= $title ?></li>
            </ol>
        </div>
    </div>
</div>
<input type="hidden" id="status_toggle">
<input type="hidden" id="status_toggle2">
<div class="row">
    <div class="col-md-12 f_nilai" style="display: none;">
        <div class="card shadow">
            <div class="card-header">
            <button class="btn btn-light float-right batal_penilaian"><i class="mdi mdi-close mdi-18px"></i></button>
            <h5 id="judul_atas">Form Penilaian</h5></div>
            <form id="form_penilaian" autocomplete="off">
                <input type="hidden" name="id_asuransi" id="id_asuransi">
                <input type="hidden" name="aksi" id="aksi" value="Tambah">
                <div class="card-body d-flex justify-content-center">
                    <table class="table table-bordered table-hover">
                        <thead class="thead-light text-dark text-center">
                            <tr>
                                <th width="40%" colspan="2">Parameter Scoring</th>
                                <th width="8%">Type</th>
                                <th width="15%">Nilai Seharusnya</th>
                                <th>Bobot</th>
                                <th width="20%">Input Nilai</th>
                                <th>Score</th>
                                <th>Keterangan</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($parent_param as $p): 
                                  
                                  $cari = $this->M_penilaian->cari_data_order('m_parameter_scoring', ['id_parent_parameter' => $p['id_parent_parameter']], 'nama_parameter', 'asc');
                            ?>
                                <tr>
                                    <td rowspan="<?= $cari->num_rows() + 1 ?>"><?= $p['parent_parameter'] ?> (<?= $p['bobot'] ?>%)</td>
                                </tr>

                                <?php foreach ($cari->result_array() as $c):
                                    if ($c['type'] == 'min') {
                                        $ty = "<i class='fas fa-minus text-danger'></i>";
                                    } else {
                                        $ty = "<i class='fas fa-plus text-primary'></i>";
                                    }
                                     ?>
                                    <tr>
                                        <td><?= $c['nama_parameter'] ?></td>
                                        <td class="text-center"><?= ucwords($c['type'])." ($ty)" ?></td>
                                        <td class="text-center"><?= number_format($c['nilai_parameter'],0,'.','.') ?></td>
                                        <td class="text-center"><?= $c['bobot'] ?></td>
                                        <td>
                                            <input type="text" class="form-control numeric number_separator text-center input_nilai input_<?= $c['id_parameter_scoring'] ?>" name="input_<?= $c['id_parameter_scoring'] ?>" id_parameter_scoring="<?= $c['id_parameter_scoring'] ?>" nilai_parameter="<?= $c['nilai_parameter'] ?>" bobot="<?= $c['bobot'] ?>" typenya="<?= $c['type'] ?>" placeholder="0"></td>
                                        <td class="text-center">
                                        <span class="hasil hasil_<?= $c['id_parameter_scoring'] ?>">0</span>
                                        <input type="hidden" class="hasil2 hasil2_<?= $c['id_parameter_scoring'] ?>">
                                        </td>
                                        <td><?= $c['keterangan'] ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php endforeach; ?>
                            
                        </tbody>
                        <tfoot>
                            <tr class="table-secondary">
                                <td class="text-right font-weight-bold" style="font-size: 15px" colspan="6">Total</td>
                                <td class="text-center font-weight-bold total" style="font-size: 15px">0</td>
                                <td></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
                <div class="card-footer">
                    <div class="form-group text-right mb-0">
                        <?php if ($role['update'] == 'true' || $id_lvl_otorisasi == 0) : ?>
                            <button type="button" class="btn btn-primary mt-1 mr-2" id="simpan_penilaian"><i class="fas fa-check mr-2"></i>Simpan</button>
                        <?php endif; ?>
                        
                        <button type="button" class="btn btn-secondary mt-1 batal_penilaian" id="batal_asuransi"><i class="fas fa-times mr-2"></i>Batal</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="col-md-12 f_grafik" style="display: none;">
        <div class="card shadow">
            <div class="card-header">
            <button class="btn btn-light float-right batal_grafik"><i class="mdi mdi-close mdi-18px"></i></button>
            <h5 id="judul_atas">Grafik</h5></div>
            <div class="card-body isi_grafik">
            
            </div>
        </div>
    </div>

    <div class="col-md-12">
        <div class="card shadow">
            <div class="card-header">
                <button type="button" class="btn btn-primary grafik"><i class="fas fa-chart-bar mr-1"></i> Grafik</button>
            </div>
            <div class="card-body table-responsive">
                <table class="table table-bordered table-hover dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;" id="tabel_master_asuransi" width="100%" cellspacing="0">
                    <thead class="thead-light text-center">
                        <tr>
                            <th width="5%">No</th>
                            <th width="20%">Asuransi</th>
                            <th width="20%">Telepon</th>
                            <th width="20%">PIC</th>
                            <th width="20%">Score</th>
                            <th width="15%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                            
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    
</div>

<?php $this->load->view('js'); ?>