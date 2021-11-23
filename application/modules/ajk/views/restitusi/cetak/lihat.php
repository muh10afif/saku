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
                            <label for="no_peserta" class="col-sm-3 col-form-label">No Polis</label>
                            <div class="col-sm-9">
                                <input class="form-control" type="text" id="no_peserta">
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
                            <label for="cetak" class="col-sm-3 col-form-label">Cetak Nota</label>
                            <div class="col-sm-9 mt-2">
                                <input type="checkbox" id="cetak">
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
                
                <table class="table table-bordered table-hover dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;" id="tabel_lihat_cetakres" width="100%" cellspacing="0">
                    <thead class="thead-light text-center">
                        <tr>
                            <th width="5%">No</th>
                            <th>No Restitusi</th>
                            <th>No Polis</th>
                            <th>Nilai</th>
                            <th>K_suratbjb_dt</th>
                            <th>Cabang</th>
                            <th>Debitur</th>
                            <th>Tempat Dinas</th>
                            <th>Alamat</th>
                            <th width="10%">Aksi</th>
                        </tr>
                    </thead>
                    <!-- <tbody>
                        <tr>
                            <td align="center">1.</td>
                            <td>1.20292992.192.0</td>
                            <td>1.98.192.0</td>
                            <td>920.000.000</td>
                            <td>2.000.000</td>
                            <td>Soreang</td>
                            <td>Ahmad</td>
                            <td>bandung</td>
                            <td>Cimahi</td>
                            <td align="center"><a href="<?= base_url('ajk/restitusi/cetak_nota') ?>" target="_blank"><button type="button" class="btn btn-success mr-2"><i class="ti-printer "></i></button></a><a href="<?= base_url('ajk/restitusi/detail/1/cetak') ?>"><button type="button" class="btn btn-info"><i class="ti-info"></i></button></a></td>
                        </tr>
                    </tbody> -->
                </table>
            </div>
        </div>
    </div>
</div>

<script>
$(document).ready(function(){
    tabel_lihat_cetakres = $('#tabel_lihat_cetakres').DataTable({
        "processing" : true,
        "serverSide" : true,
        "order" : [],
        "ajax" : {
            "url" : "<?php echo base_url(); ?>ajk/restitusi/ajaxdatacetakres",
            "type" : "POST",
            "data" : function(data){
                data.id_cabang_bank = $('#nama_cabang_bank').val();
			    data.nama_nasabah = $('#nama_nasabah').val();
			    data.no_polis = $('#no_polis').val();
			    data.tgl_mulai = $('#tgl_mulai').val();
			    data.kode_nasabah = $('#kode_nasabah').val();
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

        $('#clearall').on('click', function () {
            $('#idcabangbank').val('');
            $('#id_nasabah').val('');
            $('#tgl_mulai').val('');
            $('#lama_bulan').val('');
            $('#produk').val('');
            $('#rate_premi').val('');
            $('#nilai_pembiayaan').val('');
            $('#premi').val('');
            $('#premi_fax').val('');
            $('#premi_rek_koran').val('');
        });
})

        //16-Juni-2021 RFA
        function detailcetak(id) {
            // window.scrollTo(0, 0);
            $.ajax({
                type: "GET",
                url: "<?php echo base_url(); ?>ajk/polis/tampil_detail/" + id,
                success: function (data) {
                    
                    $('.f_detail').slideDown();
                    $('.f_ubah').slideUp();
                    $(".f_tutup").slideUp();
                    // $('#judul').text('Form Ubah Data');
                    var hss = JSON.parse(data);
    
                    $('.id_polis').val(hss[0]['id_polis']);
                    $('.idpls').html(hss[0]['id_polis']);
                    $('.idcabngbank').html(hss[0]['id_cabang_bank']).trigger('change');
                    $('.idnasabah').html(hss[0]['id_nasabah']).trigger('change');
                    $('.lamabulan').html(hss[0]['lama_bulan']).trigger('change');
                    $('.produk').html(hss[0]['produk']).trigger('change');
                    $('.ratepremi').html(hss[0]['rate_premi']);
                    $('.nilaibiaya').html(hss[0]['nilai_pembiayaan']);
                    $('.alamatrumah').html(hss[0]['alamat_rumah']);
                    $('.nilaipembiayaan').html(hss[0]['nilai_pembiayaan']);
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