<style>
    input[type=checkbox] {
        transform: scale(1.3);
    }
</style>
<div class="page-title-box">
    <div class="row align-items-center">
        <div class="col-sm-6"><h4 class="page-title"><?= $title ?></h4></div>
        <div class="col-sm-6">
            <?php echo bredcumx(); ?>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12 f_detail" style="display: none;">
    <?php $this->load->view('ajk/polis/detail'); ?>
    </div>
</div>

<div class="row">
    <div class="col-md-12 f_tutup">
        
        <div class="card shadow">
            <div class="card-header">
                <h5 id="judul" class="mb-0 mt-1"><i class="mdi mdi-filter mr-1"></i> Filter</h5>
            </div>
            <div class="card-body table-responsive">

                <div class="d-flex justify-content-center">
                    <div class="col-md-8">
                        <div class="form-group row">
                            <label for="no_polis" class="col-sm-3 col-form-label">No Peserta</label>
                            <div class="col-sm-9">
                                <input class="form-control" type="text" id="no_polis">
                            </div>
                        </div>   
                        <div class="form-group row">
                            <label for="nm_nasabah" class="col-sm-3 col-form-label">Nama Nasabah</label>
                            <div class="col-sm-9">
                                <input class="form-control" type="text" id="nm_nasabah">
                            </div>
                        </div>   
                        <div class="form-group row">
                            <label for="cabang" class="col-sm-3 col-form-label">Cabang Bank</label>
                            <div class="col-sm-9">
                            <select name="nama_cabang_bank" id="nama_cabang_bank" class="select2" require>
                                    <option value="">-- Pilih Cabang --</option>
                                    <?php foreach ($list_bank as $bank) { ?>
										<option value="<?php echo $bank->id_cabang_bank; ?>">
										<?php echo $bank->nama_cabang_bank; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div> 
                        <div class="form-group row">
                            <label for="produk" class="col-sm-3 col-form-label">Produk</label>
                            <div class="col-sm-9">
                                <select name="cabang" id="produk" class="form-control">
                                    <option value="">Pilih Produk</option>
                                </select>
                            </div>
                        </div> 
                        <div class="form-group row">
                            <label for="produk" class="col-sm-3 col-form-label">Status Verifikasi</label>
                            <div class="col-sm-9">
                                <select name="cabang" id="produk" class="form-control">
                                    <option value="">Pilih Status</option>
                                </select>
                            </div>
                        </div> 
                        <div class="form-group row">
                            <label for="nm_nasabah" class="col-sm-3 col-form-label">Range Tanggal</label>
                            <div class="col-sm-9">
                                <div class="input-daterange input-group" id="date-range">
                                    <input type="text" class="form-control" name="start" placeholder="Start Date" />
                                    <input type="text" class="form-control" name="end" placeholder="End Date" />
                                </div>
                            </div>
                        </div>  
                        <div class="form-group row">
                            <label for="nm_nasabah" class="col-sm-3 col-form-label">Spesifik Tanggal</label>
                            <div class="col-sm-9">
                                <div class="input-group">
                                    <input type='text' name="tanggal" id="tanggal" class="form-control datepicker text-center"value="<?= date("d-m-Y", now('Asia/Jakarta')) ?>" readonly>
                                    <div class="input-group-append">
                                        <span class="input-group-text">
                                            <span class="ti-calendar"></span>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="card-footer">
                <div class="row">
                    <div class="col-md-6">
                    
                    </div>
                    <div class="col-md-6 d-flex justify-content-end">
                    <button type="button" id="btn-filter" class="btn btn-primary mr-2"><i class="ti-check-box mr-2"></i>Tampilkan</button>
                    <button type="button" id="btn-reset" tgl="<?= date('d-m-Y', now('Asia/Jakarta')) ?>" class="btn btn-danger"><i class="ti-na mr-2"></i>Reset</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="card mt-2 shadow">
            <div class="card-body">
                
                <table class="table table-bordered table-hover dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;" id="tabel_enquiry" width="100%" cellspacing="0">
                    <thead class="thead-light text-center">
                        <tr>
                            <th width="5%">No</th>
                            <th>No Polis</th>
                            <th>Nama Nasabah</th>
                            <th>Tanggal Mulai</th>
                            <th>Lama (Bulan)</th>
                            <th>Pembiayaan</th>
                            <th>Rate</th>
                            <th>Premi</th>
                            <th>Premi Fax</th>
                            <th>Verifikasi</th>
                            <th>Sertifikat</th>
                            <th width="15%">Aksi</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
$(document).ready(function(){
    tabel_enquiry = $('#tabel_enquiry').DataTable({
        "processing" : true,
        "serverSide" : true,
        "order" : [],
        "ajax" : {
            "url" : "<?php echo base_url(); ?>ajk/polis/ajaxdataenquiry",
            "type" : "POST",
            "data" : function(data){
                data.id_cabang_bank = $('#nama_cabang_bank').val();
			    data.nama_nasabah = $('#nama_nasabah').val();
			    data.no_polis = $('#no_polis').val();
			    data.tgl_mulai = $('#tgl_mulai').val();
            }
        },
        "columnDefs" : [{
            "targets" : [0,3],
            "orderable" : false
        },{
            'targets' : [0,3],
            'className' : 'text-center',
        }],
        "scrollX" : true
        });
        

        $('#btn-filter').click(function(){ 
            tabel_polis.ajax.reload();  
        });
        $('#btn-reset').click(function(){ 
            $('#form-filter')[0].reset();
            tabel_polis.ajax.reload();
        });

})


function detail(id) {
    
            $.ajax({
                type: "GET",
                url: "<?php echo base_url(); ?>ajk/polis/tampil_detail/" + id,
                success: function (data) {
                    
                    $('.f_ubah').slideUp();
                    $(".f_tutup").slideUp();
                    $('.f_detail').slideDown();
                    var hss = JSON.parse(data);
    
                    $('.idpls').html(hss[0]['id_polis']);
                    $('.idcabngbank').html(hss[0]['id_cabang_bank']).trigger('change');
                    $('.idnasabah').html(hss[0]['id_nasabah']).trigger('change');
                    $('.lamabulan').html(hss[0]['lama_bulan']).trigger('change');
                    $('.label').html(hss[0]['label']).trigger('change');
                    $('.ratepremi').html(hss[0]['rate_premi']);
                    $('.nilaibiaya').html(hss[0]['nilai_pembiayaan']);
                    $('.alamatrumah').html(hss[0]['alamat_rumah']);
                    $('.nilaipembiayaan').html(hss[0]['nilai_pembiayaan']);
                    $('.alokasi').html(hss[0]['nama_asuransi']);
                    $('.tglmulai').html(hss[0]['tgl_mulai']);
                    $('.premis').html(hss[0]['premi']);
                    $('.premifax').html(hss[0]['premi_fax']);
                    $('.premirekkoran').html(hss[0]['premi_rek_koran']);
                    $('.namanasabah').html(hss[0]['nama_nasabah']);
                    $('.tgllahir').html(hss[0]['tgl_lahir']);
                    $('.tempatdinas').html(hss[0]['tempat_dinas']);
                    $('.namacabangbank').html(hss[0]['nama_cabang_bank']);
    
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    swal({
                        title: "Peringatan",
                        text: "Koneksi Tidak Terhubung",
                        type: 'warning',
                        showConfirmButton: false,
                        timer: 1000
                    });
                    
                    return false;
                }
            });
        }
</script>