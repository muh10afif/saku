<style>
    input[type=checkbox] {
        transform: scale(1.3);
    }
</style>
<!-- Page-Title -->
<div class="page-title-box">
    <div class="row align-items-center">
        <div class="col-sm-6">
            <h4><?= $title ?></h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-right">
                <li class="breadcrumb-item"><a href="<?= base_url() ?>">AJK</a></li>
                <li class="breadcrumb-item active"><?= $title ?></li>
            </ol>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        
        <div class="card shadow">
            <div class="card-header">
                <a href="<?= base_url('ajk/restitusi/form_tambah_data') ?>"><button class="btn btn-primary float-right" id="tambah_restitusi"><i class="ti-plus mr-2"></i>Tambah Data</button></a>
                <h5 id="judul" class="mb-0 mt-1"><i class="mdi mdi-filter mr-1"></i> Filter</h5>
            </div>
            <div class="card-body table-responsive">

                <div class="d-flex justify-content-center">
                    <div class="col-md-8">
                        <div class="form-group row">
                            <label for="no_restitusi" class="col-sm-3 col-form-label">No Restitusi</label>
                            <div class="col-sm-9">
                                <input class="form-control" type="text" id="no_restitusi">
                            </div>
                        </div>   
                        <div class="form-group row">
                            <label for="no_polis" class="col-sm-3 col-form-label">No Polis</label>
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
                                <select name="cabang" id="cabang" class="form-control">
                                    <option value="">Pilih Cabang</option>
                                </select>
                            </div>
                        </div> 
                        <div class="form-group row">
                            <label for="co_as" class="col-sm-3 col-form-label">Status Pembayaran</label>
                            <div class="col-sm-9">
                                <select name="co_as" id="co_as" class="form-control">
                                    <option value="">Belum</option>
                                </select>
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
                
                <table class="table table-bordered table-hover dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;" id="tabel_bayar" width="100%" cellspacing="0">
                    <thead class="thead-light text-center">
                        <tr>
                            <th width="5%">No</th>
                            <th>Proses</th>
                            <th>Tanggal Bayar</th>
                            <th>Nilai Bayar</th>
                            <th>No Restitusi</th>
                            <th>No Polis</th>
                            <th>Nilai</th>
                            <th>K_suratbjb_dt</th>
                            <th>Nama Nasabah</th>
                            <th>Premi</th>
                            <th>Cabang</th>
                            <th>Alamat</th>
                        </tr>
                    </thead>
                    <!-- <tbody>
                        <tr>
                            <td>1.</td>
                            <td align="center" width="10%"><select name="" id="" class="form-control"><option value="">Proses</option></select></td>
                            <td align="center"><input type="text" class="form-control datepicker text-center"></td>
                            <td align="center"><input type="text" class="form-control"></td>
                            <td>4.2323.445.22</td>
                            <td>2.100.232.2344</td>
                            <td>2.000.000</td>
                            <td>0000-00-00</td>
                            <td>Ahmad</td>
                            <td>200.000</td>
                            <td>Soreang</td>
                            <td>bandung</td>
                        </tr>
                    </tbody> -->
                    <div class="card-footer">
                    <div class="row">
                        <div class="col-md-12 d-flex justify-content-end">
                        <button type="button" id="btn-bayar" class="btn btn-primary mr-2"><i class="ti-flag mr-2"></i>Simpan Data</button>
                        </div>
                    </div>
                </div>
                </table>

                <span>Ket. <i class="fas fa-square-full text-danger"></i> - Polis Lama</span>
            </div>
        </div>
    </div>
</div>



<script>

var tabel_bayar;
$(document).ready(function(){

        tabel_bayar = $('#tabel_bayar').DataTable({
            "processing" : true,
            "serverSide" : true,
            "order" : [],
            "ajax" : {
                "url" : "<?php echo base_url(); ?>ajk/restitusi/ajaxdatabayar",
                "type" : "POST",
                "data" : function(data){
                    data.id_cabang_bank = $('#nama_cabang_bank').val();
                    data.nama_nasabah   = $('#nama_nasabah').val();
                    data.no_polis       = $('#no_polis').val();
                    data.tgl_mulai      = $('#tgl_mulai').val();
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

        $('#btn-bayar').click(function(){
            var list_id_k = [];
            var list_tgl_pembayaran = [];
            var list_nilai_pembayaran = [];
            $(window.document).find('[name="id_k[]"]').each(function(key,obj){
                list_id_k.push(obj.value);
            });

            $(window.document).find('[name="tgl_pembayaran[]"]').each(function(key,obj){
                list_tgl_pembayaran.push(obj.value);
            });    

            $(window.document).find('[name="nilai_pembayaran[]"]').each(function(key,obj){
                list_nilai_pembayaran.push(obj.value);
            });    

            $.ajax({
                url : '<?php echo base_url()?>/ajk/klaim/editbayarklaim',
                dataType : 'json',
                type : 'POST',
                data : {
                    id_klaim          : list_id_k,
                    tgl_pembayaran    : list_tgl_pembayaran,
                    nilai_pembayaran  : list_nilai_pembayaran
                },
                success  : function (data) {
                    swal({
                    title             : "Berhasil",
                    text              : "Pembayaran Klaim Berhasil",
                    type              : 'success',
                    showConfirmButton : false,
                    timer             : 1000
                    });
                    tabel_bayar.ajax.reload();
                    return true;
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    swal({
                    title             : "Peringatan",
                    text              : "Koneksi Tidak Terhubung",
                    type              : 'warning',
                    showConfirmButton : false,
                    timer             : 1000
                    });
                    tabel_bayar.ajax.reload();
                    return false;
                }
            });
        });
        

        $('#btn-filter').click(function(){ //button filter event click
            tabel_bayar.ajax.reload();  //just reload table
        });

});
</script>