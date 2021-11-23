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
                <button class="btn btn-light float-right batal_nasabah"><i class="mdi mdi-close mdi-18px"></i></button>
                <h5 id="judul_atas">Tambah Data</h5></div>
            <form id="form_nasabah" autocomplete="off">
                <input type="hidden" name="id_nasabah" id="id_nasabah">
                <input type="hidden" name="aksi" id="aksi" value="Tambah">
                <div class="card-body d-flex justify-content-center">
                    <div class="col-md-9">
                        <div class="form-group row">
                            <label for="nama_value" class="col-sm-3 col-form-label text-left">Kode</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control">
                            </div>
                        </div>  
                        <div class="form-group row">
                            <label for="nama_value" class="col-sm-3 col-form-label text-left">Nama</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control">
                            </div>
                        </div>  
                        <div class="form-group row">
                            <label for="nama_value" class="col-sm-3 col-form-label text-left">Tanggal Lahir</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control datepicker">
                            </div>
                        </div> 
                        <div class="form-group row">
                            <label for="nama_value" class="col-sm-3 col-form-label text-left">Telepon</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control">
                            </div>
                        </div> 
                        <div class="form-group row">
                            <label for="nama_value" class="col-sm-3 col-form-label text-left">Jenis Kelamin</label>
                            <div class="col-sm-8">
                                <select name="" id="" class="form-control">
                                    <option value="Pilih"></option>
                                </select>
                            </div>
                        </div>  
                        <div class="form-group row">
                            <label for="nama_value" class="col-sm-3 col-form-label text-left">Tempat Dinas</label>
                            <div class="col-sm-8">
                            <textarea type="text" class="form-control" style="font-size: 14px;" name="nama_value" id="nama_value" placeholder="Masukkan Tempat Dinas" cols="5"></textarea>
                            </div>
                        </div>  
                        <div class="form-group row">
                            <label for="nama_value" class="col-sm-3 col-form-label text-left">Alamat Rumah</label>
                            <div class="col-sm-8">
                            <textarea type="text" class="form-control" style="font-size: 14px;" name="nama_value" id="nama_value" placeholder="Masukkan Alamat Rumah" cols="5"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer  d-flex justify-content-end">
                    <button type="button" class="btn btn-primary mt-1 mr-3" id="simpan_nasabah">Simpan</button>
                    <button type="button" class="btn btn-danger mt-1 batal_nasabah" id="">Batal</button>
                </div>
            </form>
        </div>
    </div>

    <div class="col-md-12">
        <div class="card shadow">
            <div class="card-header">
            <button class="btn btn-primary float-right" id="tambah_nasabah">Tambah Data</button>
            <h5 id="judul" class="mb-0 mt-1">Master Data Nasabah</h5>
            </div>
            <div class="card-body table-responsive">
                <table class="table table-bordered table-hover dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;" id="tabel_master_nasabah" width="100%" cellspacing="0">
                    <thead class="thead-light text-center">
                        <tr>
                            <th width="5%">No</th>
                            <th width="20%">Kode</th>
                            <th width="20%">Nama</th>
                            <th width="20%">Telepon</th>
                            <th width="20%">Tempat Dinas</th>
                            <th width="20%">Alamat Rumah</th>
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

        $('#tambah_nasabah').on('click', function () {

            $('.f_tambah').slideToggle('fast', function() {
                if ($(this).is(':visible')) {
                    $('#status_toggle').val(1);          
                } else {  
                    $('#status_toggle').val(0);            
                }        
            });

        })    

        $('.table').DataTable();

        // menampilkan list nasabah
        var tabel_list_nasabah = $('#tabel_master_nasabah1').DataTable({
            "processing"        : true,
            "serverSide"        : true,
            "order"             : [],
            "ajax"              : {
                "url"   : "tampil_data_nasabah",
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

        // aksi simpan data nasabah
        $('#simpan_nasabah').on('click', function () {

            var form_nasabah = $('#form_nasabah').serialize();
            var nama_nasabah = $('#nama_nasabah').val();

            if (nama_nasabah == '') {
                swal({
                    title               : "Peringatan",
                    text                : 'Nasabah harus terisi !',
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
                            url     : "simpan_data_nasabah",
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
                            data    : form_nasabah,
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
                
                                tabel_list_nasabah.ajax.reload(null,false);        
                                
                                $('#form_nasabah').trigger("reset");

                                

                                $('.hapus-nasabah').removeAttr('hidden');
                
                                $('#aksi').val('Tambah');

                                $('.f_tambah').slideToggle('fast', function() {
                                    if ($(this).is(':visible')) {
                                        $('#status_toggle').val(1);          
                                    } else {  
                                        $('#status_toggle').val(0);            
                                    }        
                                });

                                $('#tambah_nasabah').attr('hidden', false);
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

        // aksi batal nasabah
        $('.batal_nasabah').on('click', function () {

            $('#form_nasabah').trigger("reset");
            // 

            $('#aksi').val('Tambah');
            $('.hapus-nasabah').removeAttr('hidden');

            $('.f_tambah').slideToggle('fast', function() {
                if ($(this).is(':visible')) {
                    $('#status_toggle').val(1);          
                } else {  
                    $('#status_toggle').val(0);            
                }        
            });

            $('#tambah_nasabah').attr('hidden', false);
        })

        // edit data nasabah
        $('#tabel_master_nasabah').on('click', '.edit-nasabah', function () {

            $('.hapus-nasabah').attr('hidden', true);
            $('#tambah_nasabah').attr('hidden', true);

            var sts = $('#status_toggle').val();
            
            var id_nasabah     = $(this).data('id');
            var nama_nasabah   = $(this).attr('nama');

            $('#id_nasabah').val(id_nasabah);
            $('#nama_nasabah').val(nama_nasabah);

            $('#aksi').val('Ubah');
            $('#judul_atas').val('Ubah Data');
            $('#batal_nasabah').removeAttr('hidden');

            $('#nama_nasabah').attr('autofocus', true);

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

        // hapus nasabah
            $('#tabel_master_nasabah').on('click', '.hapus-nasabah', function () {
                
                var id_nasabah = $(this).data('id');
                var sts         = $('#status_toggle').val();
                var nama        = $(this).attr('nama');

                swal({
                    title       : 'Konfirmasi',
                    text        : 'Yakin akan hapus nasabah '+nama+' ?',
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
                            url         : "simpan_data_nasabah",
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
                            data        : {aksi:'Hapus', id_nasabah:id_nasabah},
                            dataType    : "JSON",
                            success     : function (data) {

                                    tabel_list_nasabah.ajax.reload(null,false);   

                                    swal({
                                        title               : 'Hapus nasabah',
                                        text                : 'Data Berhasil Dihapus',
                                        buttonsStyling      : false,
                                        confirmButtonClass  : "btn btn-success",
                                        type                : 'success',
                                        showConfirmButton   : false,
                                        timer               : 1000
                                    }); 

                                        
                                    
                                    $('#form_nasabah').trigger("reset");

                                    $('#aksi').val('Tambah');

                                    

                                    $('.hapus-nasabah').removeAttr('hidden');

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
                                text                : 'Anda membatalkan hapus nasabah',
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