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
            <button class="btn btn-light float-right batal_title_mng"><i class="mdi mdi-close mdi-18px"></i></button>
            <h5 id="judul_atas">Tambah Data</h5></div>
            <form id="form_title_mng" autocomplete="off">
                <input type="hidden" name="id_title_mng" id="id_title_mng">
                <input type="hidden" name="aksi" id="aksi" value="Tambah">
                <div class="card-body d-flex justify-content-center">
                    <div class="col-md-9">
                        <div class="form-group row">
                            <label for="nama_title_mng" class="col-sm-3 col-form-label text-left">Title Management</label>
                            <div class="col-sm-8">
                            <input type="text" class="form-control" name="nama_title_mng" id="nama_title_mng" placeholder="Masukkan Title Management">
                            </div>
                        </div>  
                    </div>
                </div>
                <div class="card-footer  d-flex justify-content-end">
                    <button type="button" class="btn btn-primary mt-1 mr-3" id="simpan_title_mng">Simpan</button>
                    <button type="button" class="btn btn-danger mt-1" id="batal_title_mng">Batal</button>
                </div>
            </form>
        </div>
    </div>

    <div class="col-md-12">
        <div class="card shadow">
            <div class="card-header">
            <button class="btn btn-primary float-right" id="tambah_title_mng">Tambah Data</button>
            <h5 id="judul" class="mb-0 mt-1">Master Data Title Management</h5>
            </div>
            <div class="card-body table-responsive">
                <table class="table table-bordered table-hover dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;" id="tabel_master_title_mng" width="100%" cellspacing="0">
                    <thead class="thead-light text-center">
                        <tr>
                            <th width="5%">No</th>
                            <th width="20%">Title Management</th>
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

        $('#tambah_title_mng').on('click', function () {

            $('.f_tambah').slideToggle('fast', function() {
                if ($(this).is(':visible')) {
                    $('#status_toggle').val(1);          
                } else {  
                    $('#status_toggle').val(0);            
                }        
            });

        })  
        
        $('.table').DataTable();

        // menampilkan list title_mng
        var tabel_list_title_mng = $('#tabel_master_title_mng1').DataTable({
            "processing"        : true,
            "serverSide"        : true,
            "order"             : [],
            "ajax"              : {
                "url"   : "tampil_data_title_mng",
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

        // aksi simpan data title_mng
        $('#simpan_title_mng').on('click', function () {

            var form_title_mng = $('#form_title_mng').serialize();
            var nama_title_mng = $('#nama_title_mng').val();

            if (nama_title_mng == '') {
                swal({
                    title               : "Peringatan",
                    text                : 'Title Management harus terisi !',
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
                            url     : "simpan_data_title_mng",
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
                            data    : form_title_mng,
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
                
                                tabel_list_title_mng.ajax.reload(null,false);        
                                
                                $('#form_title_mng').trigger("reset");

                                

                                $('.hapus-title_mng').removeAttr('hidden');
                
                                $('#aksi').val('Tambah');

                                $('.f_tambah').slideToggle('fast', function() {
                                    if ($(this).is(':visible')) {
                                        $('#status_toggle').val(1);          
                                    } else {  
                                        $('#status_toggle').val(0);            
                                    }        
                                });

                                $('#tambah_title_mng').attr('hidden', false);
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

        // aksi batal title_mng
        $('.batal_title_mng').on('click', function () {

            $('#form_title_mng').trigger("reset");
            // 

            $('#aksi').val('Tambah');
            $('.hapus-title_mng').removeAttr('hidden');

            $('.f_tambah').slideToggle('fast', function() {
                if ($(this).is(':visible')) {
                    $('#status_toggle').val(1);          
                } else {  
                    $('#status_toggle').val(0);            
                }        
            });

            $('#tambah_title_mng').attr('hidden', false);
        })

        // edit data title_mng
        $('#tabel_master_title_mng').on('click', '.edit-title_mng', function () {

            $('.hapus-title_mng').attr('hidden', true);
            $('#tambah_title_mng').attr('hidden', true);

            var sts = $('#status_toggle').val();
            
            var id_title_mng     = $(this).data('id');
            var nama_title_mng   = $(this).attr('nama');

            $('#id_title_mng').val(id_title_mng);
            $('#nama_title_mng').val(nama_title_mng);

            $('#aksi').val('Ubah');
            $('#judul_atas').val('Ubah Data');
            $('#batal_title_mng').removeAttr('hidden');

            $('#nama_title_mng').attr('autofocus', true);

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

        // hapus title_mng
            $('#tabel_master_title_mng').on('click', '.hapus-title_mng', function () {
                
                var id_title_mng = $(this).data('id');
                var sts         = $('#status_toggle').val();
                var nama        = $(this).attr('nama');

                swal({
                    title       : 'Konfirmasi',
                    text        : 'Yakin akan hapus title_mng '+nama+' ?',
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
                            url         : "simpan_data_title_mng",
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
                            data        : {aksi:'Hapus', id_title_mng:id_title_mng},
                            dataType    : "JSON",
                            success     : function (data) {

                                    tabel_list_title_mng.ajax.reload(null,false);   

                                    swal({
                                        title               : 'Hapus title_mng',
                                        text                : 'Data Berhasil Dihapus',
                                        buttonsStyling      : false,
                                        confirmButtonClass  : "btn btn-success",
                                        type                : 'success',
                                        showConfirmButton   : false,
                                        timer               : 1000
                                    }); 

                                        
                                    
                                    $('#form_title_mng').trigger("reset");

                                    $('#aksi').val('Tambah');

                                    

                                    $('.hapus-title_mng').removeAttr('hidden');

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
                                text                : 'Anda membatalkan hapus title_mng',
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