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
            <button class="btn btn-light float-right batal_karyawan"><i class="mdi mdi-close mdi-18px"></i></button>
            <h5 id="judul_atas">Tambah Data</h5></div>
            <form id="form_karyawan" autocomplete="off">
                <input type="hidden" name="id_karyawan" id="id_karyawan">
                <input type="hidden" name="aksi" id="aksi" karyawan="Tambah">
                <div class="card-body d-flex justify-content-center">
                    <div class="col-md-9">
                        <div class="form-group row">
                            <label for="nama_karyawan" class="col-sm-3 col-form-label text-left">Nama</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control">
                            </div>
                        </div>   
                        <div class="form-group row">
                            <label for="nama_karyawan" class="col-sm-3 col-form-label text-left">Jabatan</label>
                            <div class="col-sm-8">
                                <select name="" id="" class="form-control">
                                <option value="">Pilih</option>
                                </select>
                            </div>
                        </div>   
                        <div class="form-group row">
                            <label for="nama_karyawan" class="col-sm-3 col-form-label text-left">Bagian</label>
                            <div class="col-sm-8">
                                <select name="" id="" class="form-control">
                                <option value="">Pilih</option>
                                </select>
                            </div>
                        </div>   
                        <div class="form-group row">
                            <label for="nama_karyawan" class="col-sm-3 col-form-label text-left">NIK</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control">
                            </div>
                        </div>  
                        <div class="form-group row">
                            <label for="nama_karyawan" class="col-sm-3 col-form-label text-left">Email</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control">
                            </div>
                        </div>  
                        <div class="form-group row">
                            <label for="nama_karyawan" class="col-sm-3 col-form-label text-left">Telepon</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control">
                            </div>
                        </div>  
                        <div class="form-group row">
                            <label for="nama_karyawan" class="col-sm-3 col-form-label text-left">Alamat</label>
                            <div class="col-sm-8">
                                <textarea type="text" class="form-control" cols="5"></textarea>
                            </div>
                        </div>   
                    </div>
                </div>
                <div class="card-footer  d-flex justify-content-end">
                    <button type="button" class="btn btn-primary mt-1 mr-3" id="simpan_karyawan">Simpan</button>
                    <button type="button" class="btn btn-danger mt-1 batal_karyawan" id="batal_karyawan">Batal</button>
                </div>
            </form>
        </div>
    </div>

    <div class="col-md-12">
        <div class="card shadow">
            <div class="card-header">
            <button class="btn btn-primary float-right" id="tambah_karyawan">Tambah Data</button>
            <h5 id="judul" class="mb-0 mt-1">Master Data Karyawan</h5>
            </div>
            <div class="card-body table-responsive">
                <table class="table table-bordered table-hover dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;" id="tabel_master_karyawan" width="100%" cellspacing="0">
                    <thead class="thead-light text-center">
                        <tr>
                            <th width="5%">No</th>
                            <th width="20%">Nama</th>
                            <th width="20%">Jabatan</th>
                            <th width="20%">Posisi</th>
                            <th width="20%">Email</th>
                            <th width="20%">Alamat</th>
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

        $('#tambah_karyawan').on('click', function () {

            $('.f_tambah').slideToggle('fast', function() {
                if ($(this).is(':visible')) {
                    $('#status_toggle').val(1);          
                } else {  
                    $('#status_toggle').val(0);            
                }        
            });

        })    

        $('.table').DataTable();

        // menampilkan list karyawan
        var tabel_list_karyawan = $('#tabel_master_karyawan1').DataTable({
            "processing"        : true,
            "serverSide"        : true,
            "order"             : [],
            "ajax"              : {
                "url"   : "tampil_data_karyawan",
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

        // aksi simpan data karyawan
        $('#simpan_karyawan').on('click', function () {

            var form_karyawan = $('#form_karyawan').serialize();
            var nama_karyawan = $('#nama_karyawan').val();

            if (nama_karyawan == '') {
                swal({
                    title               : "Peringatan",
                    text                : 'Karyawan harus terisi !',
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
                    if (result.karyawan) {
                        $.ajax({
                            url     : "simpan_data_karyawan",
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
                            data    : form_karyawan,
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
                
                                tabel_list_karyawan.ajax.reload(null,false);        
                                
                                $('#form_karyawan').trigger("reset");

                                

                                $('.hapus-karyawan').removeAttr('hidden');
                
                                $('#aksi').val('Tambah');

                                $('.f_tambah').slideToggle('fast', function() {
                                    if ($(this).is(':visible')) {
                                        $('#status_toggle').val(1);          
                                    } else {  
                                        $('#status_toggle').val(0);            
                                    }        
                                });

                                $('#tambah_karyawan').attr('hidden', false);
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

        // aksi batal karyawan
        $('.batal_karyawan').on('click', function () {

            $('#form_karyawan').trigger("reset");
            // 

            $('#aksi').val('Tambah');
            $('.hapus-karyawan').removeAttr('hidden');

            $('.f_tambah').slideToggle('fast', function() {
                if ($(this).is(':visible')) {
                    $('#status_toggle').val(1);          
                } else {  
                    $('#status_toggle').val(0);            
                }        
            });

            $('#tambah_karyawan').attr('hidden', false);
        })

        // edit data karyawan
        $('#tabel_master_karyawan').on('click', '.edit-karyawan', function () {

            $('.hapus-karyawan').attr('hidden', true);
            $('#tambah_karyawan').attr('hidden', true);

            var sts = $('#status_toggle').val();
            
            var id_karyawan     = $(this).data('id');
            var nama_karyawan   = $(this).attr('nama');

            $('#id_karyawan').val(id_karyawan);
            $('#nama_karyawan').val(nama_karyawan);

            $('#aksi').val('Ubah');
            $('#judul_atas').val('Ubah Data');
            $('#batal_karyawan').removeAttr('hidden');

            $('#nama_karyawan').attr('autofocus', true);

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

        // hapus karyawan
            $('#tabel_master_karyawan').on('click', '.hapus-karyawan', function () {
                
                var id_karyawan = $(this).data('id');
                var sts         = $('#status_toggle').val();
                var nama        = $(this).attr('nama');

                swal({
                    title       : 'Konfirmasi',
                    text        : 'Yakin akan hapus karyawan '+nama+' ?',
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
                    if (result.karyawan) {
                        $.ajax({
                            url         : "simpan_data_karyawan",
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
                            data        : {aksi:'Hapus', id_karyawan:id_karyawan},
                            dataType    : "JSON",
                            success     : function (data) {

                                    tabel_list_karyawan.ajax.reload(null,false);   

                                    swal({
                                        title               : 'Hapus karyawan',
                                        text                : 'Data Berhasil Dihapus',
                                        buttonsStyling      : false,
                                        confirmButtonClass  : "btn btn-success",
                                        type                : 'success',
                                        showConfirmButton   : false,
                                        timer               : 1000
                                    }); 

                                        
                                    
                                    $('#form_karyawan').trigger("reset");

                                    $('#aksi').val('Tambah');

                                    

                                    $('.hapus-karyawan').removeAttr('hidden');

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
                                text                : 'Anda membatalkan hapus karyawan',
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