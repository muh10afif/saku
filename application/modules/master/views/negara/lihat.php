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

    <div class="col-md-7">
        <div class="card shadow">
            <div class="card-body table-responsive">
                <table class="table table-bordered table-hover dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;" id="tabel_master_negara" width="100%" cellspacing="0">
                    <thead class="thead-light text-center">
                        <tr>
                            <th width="5%">No</th>
                            <th width="20%">Negara</th>
                            <th width="5%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                            
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="col-md-5">
        <div class="card shadow">
            <form id="form_negara" autocomplete="off">
                <input type="hidden" name="id_negara" id="id_negara">
                <input type="hidden" name="aksi" id="aksi" value="Tambah">
                <div class="card-body d-flex justify-content-center">
                    <div class="col-md-12">
                        <div class="form-group row">
                            <label for="nama_negara" class="col-sm-3 col-form-label text-right">Negara</label>
                            <div class="col-sm-8">
                            <input type="text" class="form-control" name="nama_negara" id="nama_negara" placeholder="Masukkan Negara">
                            </div>
                        </div><hr>
                        <div class="form-group text-center mb-0">
                            <button type="button" class="btn btn-primary mt-1 mr-3" id="simpan_negara">Simpan</button>
                            <button type="button" class="btn btn-danger mt-1 batal_negara" id="batal_negara">Batal</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script>

    $(document).ready(function () {

        $('#tambah_negara').on('click', function () {

            $('.f_tambah').slideToggle('fast', function() {
                if ($(this).is(':visible')) {
                    $('#status_toggle').val(1);          
                } else {  
                    $('#status_toggle').val(0);            
                }        
            });

        })    

        // menampilkan list negara
        var tabel_list_negara = $('#tabel_master_negara').DataTable({
            "processing"        : true,
            "serverSide"        : true,
            "order"             : [],
            "ajax"              : {
                "url"   : "tampil_data_negara",
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

        // aksi simpan data negara
        $('#simpan_negara').on('click', function () {

            var form_negara = $('#form_negara').serialize();
            var nama_negara = $('#nama_negara').val();

            if (nama_negara == '') {
                swal({
                    title               : "Peringatan",
                    text                : 'Negara harus terisi !',
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
                            url     : "simpan_data_negara",
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
                            data    : form_negara,
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
                
                                tabel_list_negara.ajax.reload(null,false);        
                                
                                $('#form_negara').trigger("reset");

                                

                                $('.hapus-negara').removeAttr('hidden');
                
                                $('#aksi').val('Tambah');

                                $('.f_tambah').slideToggle('fast', function() {
                                    if ($(this).is(':visible')) {
                                        $('#status_toggle').val(1);          
                                    } else {  
                                        $('#status_toggle').val(0);            
                                    }        
                                });

                                $('#tambah_negara').attr('hidden', false);
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

        // aksi batal negara
        $('.batal_negara').on('click', function () {

            $('#form_negara').trigger("reset");
            // 

            $('#aksi').val('Tambah');
            $('.hapus-negara').removeAttr('hidden');

            $('.f_tambah').slideToggle('fast', function() {
                if ($(this).is(':visible')) {
                    $('#status_toggle').val(1);          
                } else {  
                    $('#status_toggle').val(0);            
                }        
            });

            $('#tambah_negara').attr('hidden', false);
        })

        // edit data negara
        $('#tabel_master_negara').on('click', '.edit-negara', function () {

            $('.hapus-negara').attr('hidden', true);
            $('#tambah_negara').attr('hidden', true);

            var sts = $('#status_toggle').val();
            
            var id_negara     = $(this).data('id');
            var nama_negara   = $(this).attr('nama');

            $('#id_negara').val(id_negara);
            $('#nama_negara').val(nama_negara);

            $('#aksi').val('Ubah');
            $('#judul_atas').val('Ubah Data');
            $('#batal_negara').removeAttr('hidden');

            $('#nama_negara').attr('autofocus', true);

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

        // hapus negara
            $('#tabel_master_negara').on('click', '.hapus-negara', function () {
                
                var id_negara = $(this).data('id');
                var sts         = $('#status_toggle').val();
                var nama        = $(this).attr('nama');

                swal({
                    title       : 'Konfirmasi',
                    text        : 'Yakin akan hapus negara '+nama+' ?',
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
                            url         : "simpan_data_negara",
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
                            data        : {aksi:'Hapus', id_negara:id_negara},
                            dataType    : "JSON",
                            success     : function (data) {

                                    tabel_list_negara.ajax.reload(null,false);   

                                    swal({
                                        title               : 'Hapus negara',
                                        text                : 'Data Berhasil Dihapus',
                                        buttonsStyling      : false,
                                        confirmButtonClass  : "btn btn-success",
                                        type                : 'success',
                                        showConfirmButton   : false,
                                        timer               : 1000
                                    }); 

                                        
                                    
                                    $('#form_negara').trigger("reset");

                                    $('#aksi').val('Tambah');

                                    

                                    $('.hapus-negara').removeAttr('hidden');

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
                                text                : 'Anda membatalkan hapus negara',
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