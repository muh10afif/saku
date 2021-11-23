<style>

    .nav-pills .nav-link.active, .nav-pills .show > .nav-link {
        color: #fff;
        background-color: #02a4af;
    }

    a {
        color: #02a4af;
    }

    .custom-control-input:checked ~ .custom-control-label::before {
        color: #fff;
        border-color: #006c45;
        background-color: #006c45;
    }

    .nav-tabs .nav-item .nav-link.active {
        color: white;
    }
    .nav-tabs .nav-item.show .nav-link, .nav-tabs .nav-link.active {
        color: #495057;
        background-color: #006c45;
        border-color: #006c45 #006c45 #006c45;
    }
    .nav-tabs .nav-link:focus, .nav-tabs .nav-link:hover {
        border-color: #006c45 #006c45 #006c45;
    }
    .tab-bordered .tab-pane {
        padding: 15px;
        border: 5px solid #006c45;
        margin-top: -1px;
        border-radius: 5px;
    }
    .nav-tabs .nav-item .nav-link {
        color: #006c45;
    }
    .nav-tabs {
        border-bottom: 3px solid #006c45;
    }
    .tab-pane.active {
        animation: slide-down 0.4s ease-out;
    }
    @keyframes slide-down {
        0% { opacity: 0; transform: translateY(100%); }
        100% { opacity: 1; transform: translateY(0); }
    }

</style>
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

<div class="row">

    <div class="col-md-12">
        <div class="card shadow">
            <div class="card-body table-responsive">
                <ul class="nav nav-tabs d-flex justify-content-center" role="tablist">

                    <?php $i=0; foreach ($parent_param as $p): ?>
                        <li class="nav-item">
                            <a class="nav-link <?= ($i == 0) ? 'active' : '' ?> tab_parent" data-toggle="tab" href="#tab<?= $p['id_parent_parameter'] ?>" role="tab" id_parent_param="<?= $p['id_parent_parameter'] ?>" bobot_parent="<?= $p['bobot'] ?>">
                                <span class="d-none d-md-block"><?= $p['parent_parameter'] ?> (<?= $p['bobot'] ?>%)</span><span class="d-block d-md-none"><?= $p['parent_parameter'] ?></span>
                            </a>
                        </li>
                    <?php $i++; endforeach; ?>

                </ul>
                <div class="tab-content">

                    <?php 

                        if ($id_lvl_otorisasi == 0 || ($role['create'] == 'true')) {

                            $col_kr = "col-md-8";
                            $hid_kn = "";

                        } else {
                        
                            $col_kr = "col-md-12";
                            $hid_kn = "hidden";

                        }

                    ?>

                    <?php $j=0; foreach ($parent_param as $p): ?>

                        <div class="tab-pane <?= ($j == 0) ? 'active' : '' ?> p-3 mt-3" id="tab<?= $p['id_parent_parameter'] ?>" role="tabpanel">
                            <div class="row">
                            <div class="<?= $col_kr ?> table-responsive">
                                <table class="table table-bordered table-hover tabel_master_parameter_scoring" style="border-collapse: collapse; border-spacing: 0; width: 100%;" width="100%" cellspacing="0">
                                    <thead class="thead-light text-center">
                                        <tr style="vertical-align: middle;">
                                            <th width="5%">No</th>
                                            <th width="">Parameter</th>
                                            <th width="">Type</th>
                                            <th width="">Bobot</th>
                                            <th width="">Nilai Seharusnya</th>
                                            <th width="15%">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                            
                                    </tbody>
                                </table>
                            </div>

                            <div class="col-md-4" <?= $hid_kn ?>>
                                <form id="form_parameter_scoring_<?= $p['id_parent_parameter'] ?>" class="form_parameter_scoring_<?= $p['id_parent_parameter'] ?>" autocomplete="off">
                                    <input type="hidden" name="id_parameter_scoring" class="id_parameter_scoring_<?= $p['id_parent_parameter'] ?>">
                                    <input type="hidden" name="aksi" class="aksi_<?= $p['id_parent_parameter'] ?>" value="Tambah">
                                    <input type="hidden" name="id_parent_parameter" class="id_parent" value="<?= $p['id_parent_parameter'] ?>">
                                    <input type="hidden" name="bobot_parent" class="bobot_parent" value="<?= $p['bobot'] ?>">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="parameter_scoring" class="col-form-label text-right">Parameter Scoring<span class="text-danger">*</span></label>
                                            <div class="">
                                                <input type="text" class="form-control parameter_scoring_<?= $p['id_parent_parameter'] ?>" name="parameter_scoring" placeholder="Masukkan Parameter Scoring">
                                            </div>
                                        </div> 
                                        <div class="form-group">
                                            <label for="nama_parameter_scoring" class="col-form-label text-right">Type<span class="text-danger">*</span></label>
                                            <div class="">
                                                <select name="type" class="select2 type_<?= $p['id_parent_parameter'] ?>">
                                                    <option value="max">MAX (Benefit)</option>
                                                    <option value="min">MIN (Cost)</option>
                                                </select>
                                            </div>
                                        </div> 
                                        <div class="form-group">
                                            <label for="bobot" class="col-form-label text-right">Bobot<span class="text-danger">*</span></label>
                                            <div class="input-group">
                                                <input type="text" class="form-control text-right numeric bobot bobot_<?= $p['id_parent_parameter'] ?>" id_parent="<?= $p['id_parent_parameter'] ?>" name="bobot" placeholder="0">
                                                <input type="hidden" class="form-control sisa sisa_<?= $p['id_parent_parameter'] ?>" name="sisa">
                                                <div class="input-group-append">
                                                    <span class="input-group-text" id="basic-addon2">%</span>
                                                </div>
                                            </div>
                                        </div> 
                                        <div class="form-group">
                                            <label class="col-form-label text-right">Nilai Seharusnya<span class="text-danger">*</span></label>
                                            <div class="">
                                                <input type="text" class="form-control numeric number_separator nilai_parameter_<?= $p['id_parent_parameter'] ?>" name="nilai_parameter" placeholder="Masukkan Nilai Seharusnya">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="keterangan" class="col-form-label text-right">Keterangan</label>
                                            <div class="">
                                                <textarea class="form-control keterangan_<?= $p['id_parent_parameter'] ?>" rows="5" name="keterangan" placeholder="Masukkan Keterangan"></textarea>
                                            </div>
                                        </div> 
                                        <p class="font-italic text-danger">(*) Data harus terisi.</p>
                                        <hr>
                                        <div class="form-group text-center mb-0">

                                            <?php if ($role['create'] == 'true' || $id_lvl_otorisasi == 0) : ?>
                                                <button type="button" class="btn btn-primary mt-1 mr-3 simpan_parameter_scoring" id_parent="<?= $p['id_parent_parameter'] ?>"><i class="fas fa-check mr-2"></i>Simpan</button>
                                            <?php endif; ?>
                                            <button type="button" class="btn btn-danger mt-1 batal_parameter_scoring" id_parent="<?= $p['id_parent_parameter'] ?>"><i class="fas fa-times mr-2"></i>Batal</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            </div>
                        </div>

                    <?php $j++; endforeach; ?>

                </div>
            </div>
        </div>
    </div>

</div>

<!-- Modal -->
<div class="modal fade" id="modal_detail" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-md" role="document">
    <div class="modal-content">
        <div class="modal-header bg-primary text-white">
            <h5 class="modal-title mt-0">Detail Paramter Scoring</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true" class="text-white">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <div class="row p-3">
                <div class="col-md-12">
                    <div class="form-group row">
                        <label class="col-md-4 col-form-label text-left">Parameter Scoring</label>
                        <div class="col-md-8 mt-2">
                            <span id="t_parameter">: </span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-4 col-form-label text-left">Type</label>
                        <div class="col-md-8 mt-2">
                            <span id="t_type">: </span>
                        </div>
                    </div> 
                    <div class="form-group row">
                        <label class="col-md-4 col-form-label text-left">Bobot</label>
                        <div class="col-md-8 mt-2">
                            <span id="t_bobot">: </span>
                        </div>
                    </div> 
                    <div class="form-group row">
                        <label class="col-md-4 col-form-label text-left">Nilai Seharusnya</label>
                        <div class="col-md-8 mt-2">
                            <span id="t_nilai">: </span>
                        </div>
                    </div> 
                    <div class="form-group row">
                        <label class="col-md-4 col-form-label text-left">Keterangan</label>
                        <div class="col-md-8 mt-2">
                            <span id="t_keterangan">: </span>
                        </div>
                    </div> 
                </div>
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fas fa-ban mr-2"></i>Tutup</button>
      </div>
    </div>
  </div>
</div>

<script>

    $(document).ready(function () {

        nilai_sisa_bobot();

        $('.tab_parent').on('click', function () {

            var id_parent = $(this).attr('id_parent_param');
            $('.id_parent').val(id_parent);
            var bobot_parent = $(this).attr('bobot_parent');
            $('.bobot_parent').val(bobot_parent);

            // $('.tabel_master_parameter_scoring').dataTable().fnClearTable();

            console.log(id_parent);

            tabel_list_parameter_scoring.ajax.reload(null, false);
            nilai_sisa_bobot();

        })    

        // menampilkan list parameter_scoring
        var tabel_list_parameter_scoring = $('.tabel_master_parameter_scoring').DataTable({
            "processing"        : true,
            "serverSide"        : true,
            "order"             : [],
            "ajax"              : {
                "url"   : "<?= base_url() ?>parameter_scoring/tampil_data_parameter_scoring",
                "type"  : "POST",
                "data"  : function (data) {
                    data.id_parent_param    = $('.id_parent').val();
                    data.read               = "<?= $role['read'] ?>";
                    data.create             = "<?= $role['create'] ?>";
                    data.update             = "<?= $role['update'] ?>";
                    data.delete             = "<?= $role['delete'] ?>";
                    data.id_user            = "<?= $id_user ?>";
                    data.id_lvl_otorisasi   = "<?= $id_lvl_otorisasi ?>";
                }
            },
            "columnDefs"        : [{
                "targets"   : [0,5],
                "orderable" : false
            }, {
                'targets'   : [0,3,4,5],
                'className' : 'text-center',
            }],
            "bAutoWidth": false, 
            "aoColumns" : [
                { sWidth: '' },
                { sWidth: '' },
                { sWidth: '' },
                { sWidth: '' },
                { sWidth: '' },
                { sWidth: '15%' }
            ]
        })

        function number_format (number, decimals, dec_point, thousands_sep) {
            number = (number + '').replace(/[^0-9+\-Ee.]/g, '');

            var n = !isFinite(+number) ? 0 : +number,
            prec  = !isFinite(+decimals) ? 0 : Math.abs(decimals),
            sep   = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
            dec   = (typeof dec_point === 'undefined') ? '.' : dec_point,
            s = '',
            toFixedFix = function (n, prec) {
                var k = Math.pow(10, prec);
                return '' + Math.round(n * k) / k;
            };
            s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
            if (s[0].length > 3) {
                s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
            }
            if ((s[1] || '').length < prec) {
                s[1] = s[1] || '';
                s[1] += new Array(prec - s[1].length + 1).join('0');
            }
            return s.join(dec);

        }

        // 14-07-2021
        $('.tabel_master_parameter_scoring').on('click', '.detail', function () {

            var id_parameter_scoring = $(this).data('id');

            $.ajax({
                url     : "<?= base_url('parameter_scoring/detail_ps') ?>",
                method  : "POST",
                beforeSend  : function () {
                    swal({
                        title   : 'Menunggu',
                        html    : 'Memproses Halaman',
                        onOpen  : () => {
                            swal.showLoading();
                        },
                        allowOutsideClick   : false
                    })
                },
                data    : {id_parameter_scoring:id_parameter_scoring},
                dataType: "JSON",
                success : function (data) {

                    swal.close();

                    $('#modal_detail').modal('show');
                    $('#t_parameter').text(': '+data.nama_parameter);
                    $('#t_type').text(': '+data.type);
                    $('#t_bobot').text(': '+data.bobot+"%");
                    $('#t_nilai').text(': '+number_format(data.nilai_parameter ,0,',','.'));
                    $('#t_keterangan').text(': '+data.keterangan);

                },
                error: function (jqXHR, textStatus, errorThrown)
                {
                    swal({
                        title               : "Gagal",
                        text                : 'Gagal menampilkan data',
                        type                : 'error',
                        showConfirmButton   : false,
                        timer               : 3000,
                        allowOutsideClick   : false
                    }); 

                    return false;
                }
            })

            return false;

        })

        function nilai_sisa_bobot() {

            var id_parent       = $('.id_parent').val()
            var bobot_parent    = $('.bobot_parent').val()

            $.ajax({
                url     : "<?= base_url() ?>parameter_scoring/get_sisa_bobot/"+id_parent+"/"+bobot_parent,
                type    : "GET",
                dataType: "JSON",
                success : function (data) {

                    $('.bobot').val(data.sisa_bobot);
                    $('.sisa').val(data.sisa_bobot);

                    if (data.sisa_bobot == 0) {
                        $('.simpan_parameter_scoring').attr('disabled', true);
                    } else {
                        $('.simpan_parameter_scoring').attr('disabled', false);
                    }

                }
            })

            return false;

        }

        // keyup bobot
        $('.bobot').on('keyup', function () {

            var id_parent = $(this).attr('id_parent');

            var value = $(this).val().split('.').join('');
            var sisa  = $('.sisa_'+id_parent).val();

            $('.bobot_'+id_parent).val(Math.max(Math.min(value, sisa), -sisa)); 

            var isi = $('.bobot_'+id_parent).val().split('.').join('');

        })

        // aksi simpan data parameter_scoring
        $('.simpan_parameter_scoring').on('click', function () {

            var id_parent = $(this).attr('id_parent');

            var form_parameter_scoring  = $('#form_parameter_scoring_'+id_parent).serialize();
            var parameter_scoring       = $('.parameter_scoring_'+id_parent).val();
            var nilai_parameter         = $('.nilai_parameter_'+id_parent).val();

            if (parameter_scoring == '') {

                $('.parameter_scoring').focus();

                swal({
                    title               : "Peringatan",
                    text                : 'Parameter Scoring harus terisi !',
                    buttonsStyling      : false,
                    type                : 'warning',
                    showConfirmButton   : false,
                    timer               : 3000
                }); 

                return false;
            } else if (nilai_parameter == '') {

                $('.nilai_parameter').focus();
                
                swal({
                    title               : "Peringatan",
                    text                : 'Nilai Parameter harus terisi !',
                    buttonsStyling      : false,
                    type                : 'warning',
                    showConfirmButton   : false,
                    timer               : 3000
                }); 

                return false;
            } else {

                swal({
                    title       : 'Konfirmasi',
                    text        : 'Yakin akan kirim data',
                    type        : 'warning',

                    buttonsStyling      : false,
                    confirmButtonClass  : "btn btn-primary",
                    cancelButtonClass   : "btn btn-danger mr-3",

                    showCancelButton    : true,
                    confirmButtonText   : 'Ya, simpan',
                    confirmButtonColor  : '#3085d6',
                    cancelButtonColor   : '#d33',
                    cancelButtonText    : 'Batal',
                    reverseButtons      : true
                }).then((result) => {
                    if (result.value) {
                        $.ajax({
                            url     : "<?= base_url() ?>parameter_scoring/simpan_data_parameter_scoring",
                            type    : "POST",
                            beforeSend  : function () {
                                swal({
                                    title   : 'Menunggu',
                                    html    : 'Memproses Data',
                                    onOpen  : () => {
                                        swal.showLoading();
                                    }
                                })
                            },
                            data    : form_parameter_scoring,
                            dataType: "JSON",
                            success : function (data) {

                                $('.id_parent').val(id_parent);

                                swal({
                                    title               : "Berhasil",
                                    text                : 'Data berhasil disimpan',
                                    buttonsStyling      : false,
                                    confirmButtonClass  : "btn btn-success",
                                    type                : 'success',
                                    showConfirmButton   : false,
                                    timer               : 3000
                                });    
                
                                nilai_sisa_bobot();

                                // var tabel_list_parameter_scoring = $('.tabel_master_parameter_scoring').DataTable({
                                //     "processing"        : true,
                                //     "serverSide"        : true,
                                //     "order"             : [],
                                //     "ajax"              : {
                                //         "url"   : "<?= base_url() ?>parameter_scoring/tampil_data_parameter_scoring",
                                //         "type"  : "POST",
                                //         "data"  : function (data) {
                                //             data.id_parent_param    = id_parent;
                                //         }
                                //     },
                                //     "columnDefs"        : [{
                                //         "targets"   : [0,5],
                                //         "orderable" : false
                                //     }, {
                                //         'targets'   : [0,3,4,5],
                                //         'className' : 'text-center',
                                //     }],
                                //     "bAutoWidth": false, 
                                //     "aoColumns" : [
                                //         { sWidth: '' },
                                //         { sWidth: '' },
                                //         { sWidth: '' },
                                //         { sWidth: '' },
                                //         { sWidth: '' },
                                //         { sWidth: '15%' }
                                //     ],
                                //     // "bDestroy"  : true
                                // })

                                tabel_list_parameter_scoring.ajax.reload(null,false); 
                                
                                $('#form_parameter_scoring_'+id_parent).trigger("reset");

                                $('.nilai_parameter_'+id_parent).val('');

                                $('.aksi_'+id_parent).val('Tambah');
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
                            timer               : 3000
                        }); 
                    }
                })

                return false;
            
            }
            
        })

        // aksi batal parameter_scoring
        $('.batal_parameter_scoring').on('click', function () {

            var id_parent = $(this).attr('id_parent');

            $('#form_parameter_scoring_'+id_parent).trigger("reset");
            $('.aksi_'+id_parent).val('Tambah');

            $('html, body').animate({
                scrollTop: $('body').offset().top
            }, 800);

            nilai_sisa_bobot();
        })

        // edit data parameter_scoring
        $('.tabel_master_parameter_scoring').on('click', '.edit-parameter_scoring', function () {
            
            var id_parameter_scoring     = $(this).data('id');
            var nama_parameter_scoring   = $(this).attr('nama');

            $('html, body').animate({
                scrollTop: $('body').offset().top
            }, 800);

            $.ajax({
                url         : "<?= base_url() ?>parameter_scoring/cari_data/"+id_parameter_scoring,
                method      : "GET",
                dataType    : "JSON",
                success     : function (data) {

                    $('.aksi_'+data.list.id_parent_parameter).val('Ubah');

                    $('.sisa_'+data.list.id_parent_parameter).val(data.sisa);

                    $('.id_parameter_scoring_'+data.list.id_parent_parameter).val(data.list.id_parameter_scoring);
                    $('.parameter_scoring_'+data.list.id_parent_parameter).val(data.list.nama_parameter);
                    $('.bobot_'+data.list.id_parent_parameter).val(data.list.bobot);

                    $('.type_'+data.list.id_parent_parameter).val(data.list.type).trigger('change');                    
                    $('.nilai_parameter_'+data.list.id_parent_parameter).val(data.list.nilai_parameter);;                    
                    $('.keterangan_'+data.list.id_parent_parameter).val(data.list.keterangan);    
                    
                    $('.simpan_parameter_scoring').attr('disabled', false);
                },
                error       : function(xhr, status, error) {
                    
                    swal({
                        title               : 'Gagal',
                        text                : 'Gagal menampilkan data',
                        type                : 'error',
                        showConfirmButton   : false,
                        timer               : 3000
                    }); 

                    return false;
                    
                }

            })

            return false;

        })

        // hapus parameter_scoring
        $('.tabel_master_parameter_scoring').on('click', '.hapus-parameter_scoring', function () {
            
            var id_parameter_scoring    = $(this).data('id');
            var id_parent               = $(this).attr('id_parent');
            var nama                    = $(this).attr('nama');

            swal({
                title       : 'Konfirmasi',
                text        : 'Yakin akan hapus parameter scoring '+nama+' ?',
                type        : 'warning',

                buttonsStyling      : false,
                confirmButtonClass  : "btn btn-danger",
                cancelButtonClass   : "btn btn-primary mr-3",

                showCancelButton    : true,
                confirmButtonText   : 'Hapus',
                confirmButtonColor  : '#d33',
                cancelButtonColor   : '#3085d6',
                cancelButtonText    : 'Batal',
                reverseButtons      : true
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        url         : "<?= base_url() ?>parameter_scoring/simpan_data_parameter_scoring",
                        method      : "POST",
                        beforeSend  : function () {
                            swal({
                                title   : 'Menunggu',
                                html    : 'Memproses Data',
                                onOpen  : () => {
                                    swal.showLoading();
                                }
                            })
                        },
                        data        : {aksi:'Hapus', id_parameter_scoring:id_parameter_scoring},
                        dataType    : "JSON",
                        success     : function (data) {

                                swal({
                                    title               : 'Hapus parameter scoring',
                                    text                : 'Data Berhasil Dihapus',
                                    buttonsStyling      : false,
                                    confirmButtonClass  : "btn btn-success",
                                    type                : 'success',
                                    showConfirmButton   : false,
                                    timer               : 3000
                                }); 

                                nilai_sisa_bobot();

                                tabel_list_parameter_scoring.ajax.reload(null,false);        
                                
                                $('#form_parameter_scoring_'+id_parent).trigger("reset");

                                $('.aksi_'+id_parent).val('Tambah');

                            
                        },
                        error       : function(xhr, status, error) {
                            var err = eval("(" + xhr.responseText + ")");
                            alert(err.Message);
                        }

                    })

                    return false;
                } else if (result.dismiss === swal.DismissReason.cancel) {

                    swal({
                            title               : 'Batal',
                            text                : 'Anda membatalkan hapus parameter scoring',
                            buttonsStyling      : false,
                            confirmButtonClass  : "btn btn-primary",
                            type                : 'error',
                            showConfirmButton   : false,
                            timer               : 3000
                        }); 
                }
            })

        })
        
    })

</script>