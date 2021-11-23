<div class="page-title-box">
    <div class="row align-items-center">
        <div class="col-sm-6">
            <h4><?= $title ?></h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-right">
                <li class="breadcrumb-item"><a href="<?= base_url() ?>">All COB</a></li>
                <li class="breadcrumb-item">Master</li>
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
            <button class="btn btn-light float-right batal_cabang_bank"><i class="mdi mdi-close mdi-18px"></i></button>
            <h5 id="judul_atas">Tambah Data</h5></div>
            <form id="form_cabang_bank" autocomplete="off">
                <input type="hidden" name="id_cabang_bank" id="id_cabang_bank">
                <input type="hidden" name="aksi" id="aksi" cabang_bank="Tambah">
                <div class="card-body d-flex justify-content-center">
                    <div class="col-md-9">
                        <div class="form-group row">
                            <label for="nama_bagian" class="col-sm-3 col-form-label text-left">Kode</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control">
                            </div>
                        </div>   
                        <div class="form-group row">
                            <label for="nama_bagian" class="col-sm-3 col-form-label text-left">Bank</label>
                            <div class="col-sm-8">
                                <select name="" id="" class="form-control">
                                <option value="">Pilih</option>
                                </select>
                            </div>
                        </div>    
                        <div class="form-group row">
                            <label for="nama_bagian" class="col-sm-3 col-form-label text-left">Cabang Bank</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control">
                            </div>
                        </div>    
                    </div>
                </div>
                <div class="card-footer  d-flex justify-content-end">
                    <button type="button" class="btn btn-primary mt-1 mr-3" id="simpan_cabang_bank">Simpan</button>
                    <button type="button" class="btn btn-danger mt-1 batal_cabang_bank" id="batal_cabang_bank">Batal</button>
                </div>
            </form>
        </div>
    </div>

    <div class="col-md-12">
        <div class="card shadow">
            <div class="card-header">
            <button class="btn btn-primary float-right" id="tambah_cabang_bank">Tambah Data</button>
            <h5 id="judul" class="mb-0 mt-1">Master Data Cabang Bank</h5>
            </div>
            <div class="card-body table-responsive">
                <table class="table table-bordered table-hover dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;" id="tabel_master_cabang_bank" width="100%" cellspacing="0">
                    <thead class="thead-light text-center">
                        <tr>
                            <th width="5%">No</th>
                            <th width="20%">Kode Cabang</th>
                            <th width="20%">Cabang Bank</th>
                            <th width="20%">Bank</th>
                            <th width="5%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                            
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script>

    $(document).ready(function () {

        $('#tambah_cabang_bank').on('click', function () {

            $('.f_tambah').slideToggle('fast', function() {
                if ($(this).is(':visible')) {
                    $('#status_toggle').val(1);          
                } else {  
                    $('#status_toggle').val(0);            
                }        
            });

        })    

        $('.table').DataTable();

        // menampilkan list cabang_bank
        var tabel_list_cabang_bank = $('#tabel_master_cabang_bank1').DataTable({
            "processing"        : true,
            "serverSide"        : true,
            "order"             : [],
            "ajax"              : {
                "url"   : "tampil_data_cabang_bank",
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

        // aksi simpan data cabang_bank
        $('#simpan_cabang_bank').on('click', function () {

            var form_cabang_bank = $('#form_cabang_bank').serialize();
            var nama_cabang_bank = $('#nama_cabang_bank').val();

            if (nama_cabang_bank == '') {
                swal({
                    title               : "Peringatan",
                    text                : 'Cabang Bank harus terisi !',
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
                    if (result.cabang_bank) {
                        $.ajax({
                            url     : "simpan_data_cabang_bank",
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
                            data    : form_cabang_bank,
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
                
                                tabel_list_cabang_bank.ajax.reload(null,false);        
                                
                                $('#form_cabang_bank').trigger("reset");

                                

                                $('.hapus-cabang_bank').removeAttr('hidden');
                
                                $('#aksi').val('Tambah');

                                $('.f_tambah').slideToggle('fast', function() {
                                    if ($(this).is(':visible')) {
                                        $('#status_toggle').val(1);          
                                    } else {  
                                        $('#status_toggle').val(0);            
                                    }        
                                });

                                $('#tambah_cabang_bank').attr('hidden', false);
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

        // aksi batal cabang_bank
        $('.batal_cabang_bank').on('click', function () {

            $('#form_cabang_bank').trigger("reset");
            // 

            $('#aksi').val('Tambah');
            $('.hapus-cabang_bank').removeAttr('hidden');

            $('.f_tambah').slideToggle('fast', function() {
                if ($(this).is(':visible')) {
                    $('#status_toggle').val(1);          
                } else {  
                    $('#status_toggle').val(0);            
                }        
            });

            $('#tambah_cabang_bank').attr('hidden', false);
        })

        // edit data cabang_bank
        $('#tabel_master_cabang_bank').on('click', '.edit-cabang_bank', function () {

            $('.hapus-cabang_bank').attr('hidden', true);
            $('#tambah_cabang_bank').attr('hidden', true);

            var sts = $('#status_toggle').val();
            
            var id_cabang_bank     = $(this).data('id');
            var nama_cabang_bank   = $(this).attr('nama');

            $('#id_cabang_bank').val(id_cabang_bank);
            $('#nama_cabang_bank').val(nama_cabang_bank);

            $('#aksi').val('Ubah');
            $('#judul_atas').val('Ubah Data');
            $('#batal_cabang_bank').removeAttr('hidden');

            $('#nama_cabang_bank').attr('autofocus', true);

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

        // hapus cabang_bank
            $('#tabel_master_cabang_bank').on('click', '.hapus-cabang_bank', function () {
                
                var id_cabang_bank = $(this).data('id');
                var sts         = $('#status_toggle').val();
                var nama        = $(this).attr('nama');

                swal({
                    title       : 'Konfirmasi',
                    text        : 'Yakin akan hapus cabang_bank '+nama+' ?',
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
                    if (result.cabang_bank) {
                        $.ajax({
                            url         : "simpan_data_cabang_bank",
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
                            data        : {aksi:'Hapus', id_cabang_bank:id_cabang_bank},
                            dataType    : "JSON",
                            success     : function (data) {

                                    tabel_list_cabang_bank.ajax.reload(null,false);   

                                    swal({
                                        title               : 'Hapus cabang_bank',
                                        text                : 'Data Berhasil Dihapus',
                                        buttonsStyling      : false,
                                        confirmButtonClass  : "btn btn-success",
                                        type                : 'success',
                                        showConfirmButton   : false,
                                        timer               : 1000
                                    }); 

                                        
                                    
                                    $('#form_cabang_bank').trigger("reset");

                                    $('#aksi').val('Tambah');

                                    

                                    $('.hapus-cabang_bank').removeAttr('hidden');

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
                                text                : 'Anda membatalkan hapus cabang_bank',
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