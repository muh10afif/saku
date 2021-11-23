<style>
    input[type=checkbox] {
        transform: scale(1.3);
    }
</style>
<!-- Page-Title -->
<div class="page-title-box f_tutup">
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
    <div class="col-md-12 f_detail" style="display: none;">
    <?php $this->load->view('ajk/restitusi/detail'); ?>
    </div>
</div>

<div class="row">
    <div class="col-md-12 f_tutup">
        
        <div class="card shadow">
            <div class="card-header">
                <a href="<?= base_url('ajk/restitusi/form_tambah_data') ?>"><button class="btn btn-primary float-right" id="tambah_klaim"><i class="ti-plus mr-2"></i>Tambah Data</button></a>
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
                            <label for="nama_nasabah" class="col-sm-3 col-form-label">Nama Nasabah</label>
                            <div class="col-sm-9">
                                <input class="form-control" type="text" id="nama_nasabah">
                            </div>
                        </div>   
                        <div class="form-group row">
                            <label for="nama_cabang_bank" class="col-sm-3 col-form-label">Cabang Bank</label>
                            <div class="col-sm-9">
                                <select name="nama_cabang_bank" id="nama_cabang_bank" class="form-control">
                                    <option value="">Pilih Cabang</option>
                                </select>
                            </div>
                        </div> 
                        <div class="form-group row">
                            <label for="co_as" class="col-sm-3 col-form-label">Co Asuransi Polis Lama</label>
                            <div class="col-sm-9">
                                <select name="co_as" id="co_as" class="form-control">
                                    <option value="">Pilih Co Asuransi</option>
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
                
                <table class="table table-bordered table-hover dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;" id="tabel_restitusi" width="100%" cellspacing="0">
                    <thead class="thead-light text-center">
                        <tr>
                            <th><input type="checkbox" id="verif"></th>
                            <th width="5%">No</th>
                            <th>No Restitusi</th>
                            <th>No Polis</th>
                            <th>Tipe Klaim</th>
                            <th>Jenis Klaim</th>
                            <th>Nilai</th>
                            <th>K_suratbjb_dt</th>
                            <th>Nama Nasabah</th>
                            <th>Premi</th>
                            <th>Cabang</th>
                            <th>Alamat</th>
                            <th width="15%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- <tr>
                            <td align="center"><input type="checkbox"></td>
                            <td>1.</td>
                            <td>4.2323.445.22</td>
                            <td>2.100.232.2344</td>
                            <td>JKG</td>
                            <td>601</td>
                            <td>2.000.000</td>
                            <td>0000-00-00</td>
                            <td>Ahmad</td>
                            <td>200.000</td>
                            <td>Soreang</td>
                            <td>bandung</td>
                            <td align="center"><button type="button" class="btn btn-success mr-2"><i class="ti-pencil"></i></button><button type="button" class="btn btn-danger mr-2"><i class="ti-close"></i></button><a href="<?= base_url('ajk/restitusi/detail/1') ?>"><button type="button" class="btn btn-info"><i class="ti-info"></i></button></a></td>
                        </tr> -->
                    </tbody>
                    
                </table>
                <span class="mb-2">Multiple Check : <button class="btn btn-warning ml-2 text-white" id="verifikasi">Verifikasi</button></span> <br>

                <span>Ket. <i class="fas fa-square-full text-danger"></i> - Polis Lama</span>
            </div>
        </div>
    </div>
</div>

<div class="modal fade tambah_klaim" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0">Tambah Data Klaim</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="d-flex justify-content-center">
                    <div class="col-md-10">

                        <div class="alert alert-warning" role="alert">
                            Silahkan Pilih data Enquiry Polis terlebih dahulu melalui modul Enquiry+Endors atau dengan klik disini, atau dengan melakukan pencarian dibawah ini:
                        </div>

                        <div class="form-group row mt-3">
                            <label for="cari_polis" class="col-sm-4 col-form-label">No Polis</label>
                            <div class="col-sm-6">
                                <input class="form-control" type="text" id="cari_polis" class="form-control">
                            </div>
                            <div class="col-sm-2">
                                <button class="btn btn-primary">Cari</button>
                            </div>
                        </div>   
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<script>
var tabel_restitusi;
$(document).ready(function(){

    tabel_restitusi = $('#tabel_restitusi').DataTable({
        "processing" : true,
        "serverSide" : true,
        "order" : [],
        "ajax" : {
            "url" : "<?php echo base_url(); ?>ajk/restitusi/ajaxdata",
            "type" : "POST",
            "data" : function(data){
                data.no_restitusi       = $('#no_restitusi').val();
                data.no_polis           = $('#no_polis').val();
                data.nama_nasabah       = $('#nama_nasabah').val();
                data.nama_cabang_bank   = $('#nama_cabang_bank').val();
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
        // 08-Juni-2021 RFA
        $('#btn-filter').click(function(){ // filter event click
            tabel_restitusi.ajax.reload();  // reload table
        });
        $('#btn-reset').click(function(){ // reset event click
            $('#form-filter')[0].reset();
            tabel_restitusi.ajax.reload();  // reload table
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

        $('#verif').click(function(){
            if ($(this).is(':checked')){
                $('.check').attr('checked',true);
            } else {
                $('.check').attr('checked',false);
            }
        });

        //17-Juni-2021
        $('#verifikasi').click(function(){
            var data_verifikasi = [];
            $('.check').each(function(k,obj){
                if (obj.checked){
                    data_verifikasi.push(obj.value);
                }
            });

            $.ajax({
                type:"POST",
                url:"<?php echo base_url(); ?>ajk/restitusi/verifikasi",
                dataType:"json",
                data:{
                    ver:data_verifikasi
                },
                success  : function (data) {
                swal({
                title             : "Berhasil",
                text              : "Data Telah Di Verifikasi",
                type              : 'success',
                showConfirmButton : false,
                timer             : 1000
                });
                tabel_restitusi.ajax.reload();
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
                return false;
            },
            });
        });

        

});

    function deleterestitusi(id) {
        swal({
        title               : 'Konfirmasi',
        text                : 'Yakin akan Menghapus Data Restitusi ?',
        type                : 'warning',
        buttonsStyling      : false,
        confirmButtonClass  : "btn btn-primary",
        cancelButtonClass   : "btn btn-warning mr-3",
        showCancelButton    : true,
        confirmButtonText   : 'Ya',
        confirmButtonColor  : '#3085d6',
        cancelButtonColor   : '#d33',
        cancelButtonText    : 'Batal',
        reverseButtons      : true
        }).then((result) => {
            if (result.value) {
                $.ajax({
                type:"GET",
                url:"<?php echo base_url(); ?>ajk/restitusi/removerestitusi/"+id,
                beforeSend : function () {
                    swal({
                    title  : 'Menunggu',
                    html   : 'Memproses Data',
                    onOpen : () => {
                        swal.showLoading();
                    }
                    })
                },
                success  : function (data) {
                    swal({
                    title             : "Berhasil",
                    text              : "Data Restitusi telah di Hapus",
                    type              : 'success',
                    showConfirmButton : false,
                    timer             : 1000
                    });
                    tabel_restitusi.ajax.reload();
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
                    return false;
                }
                });
            } else if (result.dismiss === swal.DismissReason.cancel) {
                swal({
                title               : "Batal",
                text                : 'Anda membatalkan Hapus Data Restitusi',
                buttonsStyling      : false,
                confirmButtonClass  : "btn btn-primary",
                type                : 'error',
                showConfirmButton   : false,
                timer               : 1000
                });
            }
        });
    }

    //16-Juni-2021 RFA
    function detail(id) {
            // window.scrollTo(0, 0);
            $.ajax({
                type: "GET",
                url: "<?php echo base_url(); ?>ajk/restitusi/tampil_detail/" + id,
                success: function (data) {
                    
                    $('.f_detail').slideDown();
                    $('.f_ubah').slideUp();
                    $(".f_tutup").slideUp();
                    // $('#judul').text('Form Ubah Data');
                    var hss = JSON.parse(data);
    
                    $('.id_polis').val(hss[0]['id_polis']);
                    $('.idpls').html(hss[0]['id_polis']);
                    $('.lamabulan').html(hss[0]['lama_bulan']).trigger('change');
                    $('.produk').html(hss[0]['produk']).trigger('change');
                    $('.ratepremi').html(hss[0]['rate_premi']);
                    $('.keterangan').html(hss[0]['keterangan']);
                    $('.no_klaim').html(hss[0]['no_klaim']);
                    $('.no_polis').html(hss[0]['no_polis']);
                    $('.tipe_klaim').html(hss[0]['tipe_klaim']);
                    // $('.jenis_klaim').html(hss[0]['jenis_klaim']);
                    $('.tgl_lapor').html(hss[0]['tgl_lapor']);
                    $('.tgl_kejadian').html(hss[0]['tgl_kejadian']);
                    $('.no_rekening_koran').html(hss[0]['premi_rek_koran']);
                    $('.nilai_klaim').html(hss[0]['nilai_klaim']);
                    $('.user_input').html(hss[0]['user_input']);
                    $('.tgl_input').html(hss[0]['add_time']);
                    $('.cabang_bank').html(hss[0]['cabang_bank']);
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
                    $('.no_restitusi').html(hss[0]['no_restitusi']);
                    $('.tgl_kirim_dok').html(hss[0]['tgl_kirim_dok']);
                    $('.no_rek_debitur').html(hss[0]['no_rek_debitur']);
                    $('.nilai_restitusi').html(hss[0]['nilai_restitusi']);
    
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