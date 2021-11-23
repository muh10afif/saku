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
                    <div class="col-md-12">
                        <div class="row p-2">
                            <div class="col-md-4">
                                <div class="form-group row">
                                    <label class="col-md-4 col-form-label text-left">Kode Transaksi</label>
                                    <div class="col-md-8 mt-1">
                                        <span>: <?= $list_jurnal['kode_transaksi'] ?></span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-4 col-form-label text-left">Total Debit</label>
                                    <div class="col-md-8 mt-1">
                                        <span>: <?= number_format($list_jurnal['total_debit'],0,'.','.') ?></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group row">
                                    <label class="col-md-4 col-form-label text-left">Nama Transaksi</label>
                                    <div class="col-md-8 mt-1">
                                        <span>: <?= $list_jurnal['nama_transaksi'] ?></span>
                                    </div>
                                </div> 
                                <div class="form-group row">
                                    <label class="col-md-4 col-form-label text-left">Total Kredit</label>
                                    <div class="col-md-8 mt-1">
                                        <span>: <?= number_format($list_jurnal['total_kredit'],0,'.','.') ?></span>
                                    </div>
                                </div> 
                            </div>
                            <div class="col-md-4">
                                <div class="form-group row">
                                    <label class="col-md-4 col-form-label text-left">Tanggal</label>
                                    <div class="col-md-8 mt-1">
                                        <span>: <?= date("d-M-Y", strtotime($list_jurnal['tgl_buat'])) ?></span>
                                    </div>
                                </div> 
                                <?php 

                                    if ($list_jurnal['status'] == 1 ){
                                        $status = "<span class='badge badge-success' style='font-size: 13px'>Terposting</span>";
                                    } elseif($list_jurnal['status'] == 0){
                                        $status = "<span class='badge badge-danger' style='font-size: 13px'>Belum Posting</span>";
                                    } elseif($list_jurnal['status'] == 3){
                                        $status = "<span class='badge badge-primary' style='font-size: 13px'>Telah Diperbaiki</span>";
                                    } elseif($list_jurnal['status'] == 2){
                                        $status = "<span class='badge badge-dark' style='font-size: 13px'>Butuh Perbaikan</span>";
                                    } 
                                
                                ?>
                                <div class="form-group row">
                                    <label class="col-md-4 col-form-label text-left">Status</label>
                                    <div class="col-md-8 mt-1">
                                        <span>: <?= $status ?></span>
                                    </div>
                                </div> 
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
        <div class="card shadow">
            <?php if ($list_jurnal['status'] != 1) : ?>
                <div class="card-header">
                    <button class="btn btn-outline-primary float-right" id="post_jurnal" data="<?= $id_jurnal ?>"><i class="fas fa-plus mr-1"></i> POSTING JURNAL</button>
                    <button class="btn btn-outline-primary float-right mr-2" data-toggle="modal" id="btn_modal_j_err" data-target="#modal_err_data"><i class="fas fa-undo mr-1"></i> KEMBALIKAN DATA</button>
                </div>
            <?php endif; ?>
            <div class="card-body">
                <?php 

                    if (count($jml_detail_jurnal) == count($detail_jurnal_aktif)) {
                        $checked = 'checked disabled';
                    } else {
                        $checked = '';
                    }
                
                ?>
                <div class="table-responsive">

                    <table id="tbl_detail_jurnal" class="table table-bordered table-hover mt-3" style="border-collapse: collapse; border-spacing: 0; width: 100%;" width="100%" >
                        <thead class="bg-primary text-white text-center">
                            <tr>
                                <th style="width:30px;">No</th>
                                <th><input type='checkbox' class='approval_all mr-2' id="app_all" <?= $checked ?>><label for="app_all"><span >Approval</span></label></th>
                                <th>COA</th>
                                <th>Deskripsi</th>
                                <th>Tanggal</th>
                                <th>Debit</th>
                                <th>Kredit</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal_err_data" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog modal-sm|modal-lg|modal-xl" role="document">
    <div class="modal-content">
      
      <div class="modal-header bg-primary text-white">
        <h5 class="modal-title mt-0">Data Tidak di Approve</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true" class="text-white">&times;</span>
        </button>
    </div>
      <div class="modal-body">
        <form>
            <input type="hidden" id="id_jurnal_err" value="<?= $id_jurnal ?>">
            <div class="form-group">
                <label class="col-form-label text-left">Catatan Perbaikan</label>
                <textarea class="form-control" rows="4" cols="50" id="catatan" placeholder="Masukkan Catatan Perbaikan"></textarea>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-primary" id="btn_s_jurnal_err">Simpan</button>
          </div>
      </form>
    </div>
  </div>
</div>

<input type="hidden" id="jml_detail">

<script>
    $(document).ready(function () {

        var tbl_detail_jurnal = $('#tbl_detail_jurnal').DataTable({
            "processing"        : true,
            "order"             : [],
            "ajax"              : {
                "url"   : "<?= base_url() ?>Jurnal_buku_besar/tampil_detail_jurnal",
                "type"  : "POST",
                "data"  : function (data) {
                    data.id_jurnal = "<?= $id_jurnal ?>";
                },
                "dataSrc": function (json) {
                    $("#jml_detail").val(json.jumlah);
                    return json.data;
                }
            },
            "columnDefs"        : [{
                "targets"   : [0],
                "orderable" : false
            }, {
                'targets'   : [0],
                'className' : 'text-center',
            }],
            "bPaginate"     : false,
            "bLengthChange" : false,
            "bFilter"       : true,
            "bInfo"         : false
        })

        // 12-08-2021
        $('#btn_s_jurnal_err').on('click',function(){

            var catatan = $('#catatan').val();
            var id      = $('#id_jurnal_err').val();

            if (catatan == '') {

                swal({
                    title               : "Peringatan",
                    text                : "Harap isi catatan dahulu!",
                    type                : 'warning',
                    showConfirmButton   : true,
                    buttonsStyling      : false,
                    confirmButtonClass  : "btn btn-primary",
                    confirmButtonText   : 'OK',
                    allowOutsideClick   : false
                });

                return false;

            }

            swal({
                title       : 'Konfirmasi',
                text        : 'Yakin akan simpan data?',
                type        : 'warning',

                buttonsStyling      : false,
                confirmButtonClass  : "btn btn-primary",
                cancelButtonClass   : "btn btn-danger mr-3",

                showCancelButton    : true,
                confirmButtonText   : 'Ya',
                confirmButtonColor  : '#3085d6',
                cancelButtonColor   : '#d33',
                cancelButtonText    : 'Batal',
                reverseButtons      : true,
                allowOutsideClick   : false
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        url     : "<?= base_url() ?>Jurnal_buku_besar/s_jurnal_err",
                        type    : "POST",
                        beforeSend  : function () {
                            swal({
                                title   : 'Menunggu',
                                html    : 'Memproses Data',
                                onOpen  : () => {
                                    swal.showLoading();
                                },
                                allowOutsideClick   : false
                            })
                        },
                        data    : {
                            catatan     : catatan,
                            id_jurnal   : id,
                        },
                        dataType: "JSON",
                        success : function (data) {
                            
                            swal({
                                title               : "Berhasil",
                                text                : "Data berhasil disimpan",
                                type                : 'success',
                                showConfirmButton   : false,
                                timer               : 2000,
                                allowOutsideClick   : false
                            }).then(function() {
                                location.href = "<?= base_url('Jurnal_buku_besar') ?>";
                            });
                            
                        }
                    })
            
                    return false;

                } else if (result.dismiss === swal.DismissReason.cancel) {

                    swal({
                        title               : "Batal",
                        text                : 'Anda membatalkan simpan data',
                        buttonsStyling      : false,
                        confirmButtonClass  : "btn btn-primary",
                        type                : 'error',
                        showConfirmButton   : false,
                        timer               : 1500
                    }); 
                }
            })

            return false;

        })

        // 13-08-2021
        $('.approval_all').on('change', function () {

            var value = $(this).is(':checked');

            if (value) {
                $('.check_approval').prop('checked', true);
            } else {
                $('.check_approval').prop('checked', false);
            }
            
        })

        // 13-08-2021
        $('#tbl_detail_jurnal').on('change', '.check_approval', function () {

            if (hitung_jml_approval()['status'] == 'sama') {
                $('.approval_all').prop('checked', true);
            } else {
                $('.approval_all').prop('checked', false);
            }
            
        })

        function hitung_jml_approval() {
            var jml_detail  = $("#jml_detail").val();

            var total_d         = 0;
            var total_k         = 0;
            var check_approval  = [];
            var id_det_jurnal   = [];
            $('.check_approval').each(function() { 

                var value        = $(this).is(':checked');
                var idd_jurnal   = $(this).data('id');

                if (value) {
                    check_approval.push($(this).val()); 
                    id_det_jurnal.push(idd_jurnal); 

                    var debit   = $('#debit_'+idd_jurnal).text().split('.').join('');
                    var kredit  = $('#kredit_'+idd_jurnal).text().split('.').join('');

                    total_d += parseInt(debit);
                    total_k += parseInt(kredit);
                }
                
            });

            var st = "";
            if (check_approval.length == jml_detail) {
                st = 'sama';
            } else {
                st = 'beda';
            }

            var sts_balance = "";

            if (total_d == total_k) {
                if (check_approval.length == 0) {
                    sts_balance = false;
                } else {
                    sts_balance = true; 
                }
            } else {
                sts_balance = false;
            }

            var arr = [];
            arr['status']           = st;
            arr['jumlah']           = check_approval.length;
            arr['id_det_jurnal']    = id_det_jurnal;
            arr['tot_debit']        = total_d;
            arr['tot_kredit']       = total_k;
            arr['sts_balance']      = sts_balance;

            return arr;
        }

        // 13-08-2021
        $('#post_jurnal').on('click',function () {

            var id_jurnal   = $(this).attr('data');
            var approval    = hitung_jml_approval();

            if (approval['jumlah'] == 0) {

                swal({
                    title               : "Peringatan",
                    text                : 'Harap pilih approval dahulu!',
                    buttonsStyling      : false,
                    confirmButtonClass  : "btn btn-primary",
                    type                : 'warning',
                    showConfirmButton   : true,
                    allowOutsideClick   : false
                });  
                
                return false;
                
            }

            if (approval['sts_balance'] == false) {

                swal({
                    title               : "Peringatan",
                    text                : 'Data Tidak Balance!',
                    buttonsStyling      : false,
                    confirmButtonClass  : "btn btn-primary",
                    type                : 'warning',
                    showConfirmButton   : true,
                    allowOutsideClick   : false
                });  
                
                return false;
                
            }

            swal({
                title       : 'Konfirmasi',
                text        : 'Yakin akan simpan data?',
                type        : 'warning',

                buttonsStyling      : false,
                confirmButtonClass  : "btn btn-primary",
                cancelButtonClass   : "btn btn-danger mr-3",

                showCancelButton    : true,
                confirmButtonText   : 'Ya',
                confirmButtonColor  : '#3085d6',
                cancelButtonColor   : '#d33',
                cancelButtonText    : 'Batal',
                reverseButtons      : true,
                allowOutsideClick   : false
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        url     : "<?= base_url() ?>Jurnal_buku_besar/simpan_approval_jurnal",
                        type    : "POST",
                        beforeSend  : function () {
                            swal({
                                title   : 'Menunggu',
                                html    : 'Memproses Data',
                                onOpen  : () => {
                                    swal.showLoading();
                                },
                                allowOutsideClick   : false
                            })
                        },
                        data    : {
                            id_jurnal       : id_jurnal,
                            id_det_jurnal   : approval['id_det_jurnal']
                        },
                        dataType: "JSON",
                        success : function (data) {
                            
                            swal({
                                title               : "Berhasil",
                                text                : "Data berhasil disimpan",
                                type                : 'success',
                                showConfirmButton   : false,
                                timer               : 1500,
                                allowOutsideClick   : false
                            }).then(function() {
                                location.href = "<?= base_url('Jurnal_buku_besar') ?>";
                            });
                            
                        }
                    })
            
                    return false;

                } else if (result.dismiss === swal.DismissReason.cancel) {

                    swal({
                        title               : "Batal",
                        text                : 'Anda membatalkan simpan data',
                        buttonsStyling      : false,
                        confirmButtonClass  : "btn btn-primary",
                        type                : 'error',
                        showConfirmButton   : false,
                        timer               : 1500
                    }); 
                }
            })

            return false;

            // var jml_detail  = $("#jml_detail").val();

            // var label_jurnal = [];
            // $('.check_approval').each(function() { 

            //     var value = $(this).is(':checked');

            //     if (value) {
            //         label_jurnal.push($(this).val()); 
            //     }
                
            // });

            // if (label_jurnal.length == jml_detail) {
            //     console.log('sama');
            // } else {
            //     console.log('beda');
            // }

            // console.log(label_jurnal);

            // $.ajax({
            //     type  : 'POST',
            //     url   : 'L_keuangan/cek_balance',
            //     async : false,
            //     data  : {id:id},
            //     dataType : 'json',
            //     success : function(data){
            //         if (data == true) {
            //             post_jurnal(id);
            //         }
            //         else if(data == 'blank'){
            //             Swal.fire('Masih Ada Data Yang Belum Diapprove!','','warning');
            //         }
            //         else
            //         {
            //             Swal.fire('Data Tidak Balance!','','warning');
            //         }

            //     }

            // });
        })
        
    })
</script>