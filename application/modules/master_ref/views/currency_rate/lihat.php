<div class="page-title-box">
    <div class="row align-items-center">
        <div class="col-sm-6">
            <h4><?= $title ?></h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-right">
                <li class="breadcrumb-item"><a href="<?= base_url() ?>">All COB</a></li>
                <li class="breadcrumb-item">Master References</li>
                <li class="breadcrumb-item active"><?= $title ?></li>
            </ol>
        </div>
    </div>
</div>
<input type="hidden" id="status_toggle">
<div class="row">
    <div class="col-md-12 f_tambah" style="display: none;">
        <div class="card shadow">
            <div class="card-header">
                <button class="btn btn-light float-right batal_currency_rate"><i class="mdi mdi-close mdi-18px"></i></button>
                <h5 id="judul_atas">Tambah Data</h5></div>
            <form id="form_currency_rate" autocomplete="off">
                <input type="hidden" name="id_currency_rate" id="id_currency_rate">
                <input type="hidden" name="aksi" id="aksi" value="Tambah">
                <div class="card-body d-flex justify-content-center">
                    <div class="col-md-8">
                        <div class="form-group row">
                            <label for="nama_currency_rate" class="col-sm-3 col-form-label">Tahun</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control">
                            </div>
                        </div>  
                        <div class="form-group row">
                            <label for="nama_currency_rate" class="col-sm-3 col-form-label">Bulan</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control">
                            </div>
                        </div>  
                        <div class="form-group row">
                            <label for="nama_currency_rate" class="col-sm-3 col-form-label">Kode Mata Uang</label>
                            <div class="col-sm-8">
                                <select name="soc" id="soc" class="form-control">
                                    <option value="">Pilih</option>
                                </select>
                            </div>
                        </div>  <div class="form-group row">
                            <label for="nama_currency_rate" class="col-sm-3 col-form-label">Rate</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer  d-flex justify-content-end">
                    <button type="button" class="btn btn-primary mt-1 mr-3" id="simpan_currency_rate">Simpan</button>
                    <button type="button" class="btn btn-danger mt-1 batal_currency_rate" id="">Batal</button>
                </div>
            </form>
        </div>
    </div>

    <div class="col-md-12">
        <div class="card shadow">
            <div class="card-header">
            <button class="btn btn-primary float-right" id="tambah_currency_rate">Tambah Data</button>
            <h5 id="judul" class="mb-0 mt-1">Data Currency Forecast</h5>
            </div>
            <div class="card-body table-responsive">
                <table class="table table-bordered table-hover dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;" id="tabel_master_currency_rate" width="100%" cellspacing="0">
                    <thead class="thead-light text-center">
                        <tr>
                            <th width="5%">No</th>
                            <th width="20%">Tahun</th>
                            <th width="20%">Bulan</th>
                            <th width="20%">Kode Mata Uang</th>
                            <th width="20%">Value</th>
                            <th width="5%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                         <tr>
                             <td align="center">1.</td>
                             <td>2021</td>
                             <td>April</td>
                             <td>EUR</td>
                             <td align="right">14.900</td>
                             <td align="center"><button type="button" class="btn btn-success mr-2"><i class="ti-pencil"></i></button><button type="button" class="btn btn-danger mr-2"><i class="ti-close"></i></button><a href="<?= base_url('klaim/detail/1') ?>"><button type="button" class="btn btn-info"><i class="ti-info"></i></button></a></td>
                         </tr>   
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script>

    $(document).ready(function () {

        $('#tambah_currency_rate').on('click', function () {

            $('.f_tambah').slideToggle('fast', function() {
                if ($(this).is(':visible')) {
                    $('#status_toggle').val(1);          
                } else {  
                    $('#status_toggle').val(0);            
                }        
            });

        })    

        $('.table').DataTable();

        // menampilkan list currency_rate
        var tabel_list_currency_rate = $('#tabel_master_currency_rate2').DataTable({
            "processing"        : true,
            "serverSide"        : true,
            "order"             : [],
            "ajax"              : {
                "url"   : "tampil_data_currency_rate",
                "type"  : "POST"
            },
            "columnDefs"        : [{
                "targets"   : [0,2],
                "orderable" : false
            }, {
                'targets'   : [0,2],
                'className' : 'text-center',
            }]
        })

        // aksi simpan data currency_rate
        $('#simpan_currency_rate').on('click', function () {

            var form_currency_rate = $('#form_currency_rate').serialize();
            var nama_currency_rate = $('#nama_currency_rate').val();

            if (nama_currency_rate == '') {
                swal({
                    title               : "Peringatan",
                    text                : 'Currency Forecast harus terisi !',
                    buttonsStyling      : false,
                    type                : 'warning',
                    showConfirmButton   : false,
                    timer               : 1000
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
                    confirmButtonText   : 'Ya',
                    confirmButtonColor  : '#3085d6',
                    cancelButtonColor   : '#d33',
                    cancelButtonText    : 'Batal',
                    reverseButtons      : true
                }).then((result) => {
                    if (result.value) {
                        $.ajax({
                            url     : "simpan_data_currency_rate",
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
                            data    : form_currency_rate,
                            dataType: "JSON",
                            success : function (data) {
                                
                                swal({
                                    title               : "Berhasil",
                                    text                : 'Data berhasil disimpan',
                                    buttonsStyling      : false,
                                    confirmButtonClass  : "btn btn-success",
                                    type                : 'success',
                                    showConfirmButton   : false,
                                    timer               : 1000
                                });    
                
                                tabel_list_currency_rate.ajax.reload(null,false);        
                                
                                $('#form_currency_rate').trigger("reset");

                                

                                $('.hapus-currency_rate').removeAttr('hidden');
                
                                $('#aksi').val('Tambah');

                                $('.f_tambah').slideToggle('fast', function() {
                                    if ($(this).is(':visible')) {
                                        $('#status_toggle').val(1);          
                                    } else {  
                                        $('#status_toggle').val(0);            
                                    }        
                                });

                                $('#tambah_currency_rate').attr('hidden', false);
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
                            timer               : 1000
                        }); 
                    }
                })

                return false;
            
            }
            
        })

        // aksi batal currency_rate
        $('.batal_currency_rate').on('click', function () {

            $('#form_currency_rate').trigger("reset");
            // 

            $('#aksi').val('Tambah');
            $('.hapus-currency_rate').removeAttr('hidden');

            $('.f_tambah').slideToggle('fast', function() {
                if ($(this).is(':visible')) {
                    $('#status_toggle').val(1);          
                } else {  
                    $('#status_toggle').val(0);            
                }        
            });

            $('#tambah_currency_rate').attr('hidden', false);
        })

        // edit data currency_rate
        $('#tabel_master_currency_rate').on('click', '.edit-currency_rate', function () {

            $('.hapus-currency_rate').attr('hidden', true);
            $('#tambah_currency_rate').attr('hidden', true);

            var sts = $('#status_toggle').val();
            
            var id_currency_rate     = $(this).data('id');
            var nama_currency_rate   = $(this).attr('nama');

            $('#id_currency_rate').val(id_currency_rate);
            $('#nama_currency_rate').val(nama_currency_rate);

            $('#aksi').val('Ubah');
            $('#judul_atas').val('Ubah Data');
            $('#batal_currency_rate').removeAttr('hidden');

            $('#nama_currency_rate').attr('autofocus', true);

            $('html, body').animate({
                scrollTop: $('body').offset().top
            }, 800);

            if (sts == 0) {
                $('.f_tambah').slideToggle('fast', function() {
                    if ($(this).is(':visible')) {
                        $('#status_toggle').val(1);          
                    } else {  
                        $('#status_toggle').val(0);            
                    }        
                });  
            }

        })

        // hapus currency_rate
            $('#tabel_master_currency_rate').on('click', '.hapus-currency_rate', function () {
                
                var id_currency_rate = $(this).data('id');
                var sts         = $('#status_toggle').val();
                var nama        = $(this).attr('nama');

                swal({
                    title       : 'Konfirmasi',
                    text        : 'Yakin akan hapus currency_rate '+nama+' ?',
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
                            url         : "simpan_data_currency_rate",
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
                            data        : {aksi:'Hapus', id_currency_rate:id_currency_rate},
                            dataType    : "JSON",
                            success     : function (data) {

                                    tabel_list_currency_rate.ajax.reload(null,false);   

                                    swal({
                                        title               : 'Hapus currency_rate',
                                        text                : 'Data Berhasil Dihapus',
                                        buttonsStyling      : false,
                                        confirmButtonClass  : "btn btn-success",
                                        type                : 'success',
                                        showConfirmButton   : false,
                                        timer               : 1000
                                    }); 

                                        
                                    
                                    $('#form_currency_rate').trigger("reset");

                                    $('#aksi').val('Tambah');

                                    

                                    $('.hapus-currency_rate').removeAttr('hidden');

                                    if (sts == 1) {
                                        $('.f_tambah').slideToggle('fast', function() {
                                            if ($(this).is(':visible')) {
                                                $('#status_toggle').val(1);          
                                            } else {  
                                                $('#status_toggle').val(0);            
                                            }        
                                        });  
                                    }
                                
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
                                text                : 'Anda membatalkan hapus currency_rate',
                                buttonsStyling      : false,
                                confirmButtonClass  : "btn btn-primary",
                                type                : 'error',
                                showConfirmButton   : false,
                                timer               : 1000
                            }); 
                    }
                })

            })
        
    })

</script>