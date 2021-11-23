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
                <button class="btn btn-light float-right batal_wilayah"><i class="mdi mdi-close mdi-18px"></i></button>
                <h5 id="judul_atas">Tambah Data</h5></div>
            <form id="form_wilayah" autocomplete="off">
                <input type="hidden" name="id_wilayah" id="id_wilayah">
                <input type="hidden" name="aksi" id="aksi" value="Tambah">
                <div class="card-body d-flex justify-content-center">
                    <div class="col-md-8">
                        <div class="form-group row">
                            <label for="nama_wilayah" class="col-sm-3 col-form-label">Parent</label>
                            <div class="col-sm-8">
                                <select name="soc" id="soc" class="form-control">
                                    <option value="">Pilih</option>
                                </select>
                            </div>
                        </div>  
                        <div class="form-group row">
                            <label for="nama_wilayah" class="col-sm-3 col-form-label">Level</label>
                            <div class="col-sm-8">
                                <select name="soc" id="soc" class="form-control">
                                    <option value="">Pilih</option>
                                </select>
                            </div>
                        </div>  
                        <div class="form-group row">
                            <label for="nama_wilayah" class="col-sm-3 col-form-label">Kode</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control">
                            </div>
                        </div>  
                        <div class="form-group row">
                            <label for="nama_wilayah" class="col-sm-3 col-form-label">Nama</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control">
                            </div>
                        </div>  
                    </div>
                </div>
                <div class="card-footer  d-flex justify-content-end">
                    <button type="button" class="btn btn-primary mt-1 mr-3" id="simpan_wilayah">Simpan</button>
                    <button type="button" class="btn btn-danger mt-1 batal_wilayah" id="">Batal</button>
                </div>
            </form>
        </div>
    </div>

    <div class="col-md-12">
        <div class="card shadow">
            <div class="card-header">
            <button class="btn btn-primary float-right" id="tambah_wilayah">Tambah Data</button>
            <h5 id="judul" class="mb-0 mt-1">Master Data Wilayah</h5>
            </div>
            <div class="card-body table-responsive">
                <table class="table table-bordered table-hover dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;" id="tabel_master_wilayah" width="100%" cellspacing="0">
                    <thead class="thead-light text-center">
                        <tr>
                            <th width="5%">No</th>
                            <th width="20%">Kode</th>
                            <th width="20%">Wilayah</th>
                            <th width="5%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                         <tr>
                             <td align="center">1.</td>
                             <td>KDHD00</td>
                             <td>Bandung</td>
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

        $('#tambah_wilayah').on('click', function () {

            $('.f_tambah').slideToggle('fast', function() {
                if ($(this).is(':visible')) {
                    $('#status_toggle').val(1);          
                } else {  
                    $('#status_toggle').val(0);            
                }        
            });

        })    

        $('.table').DataTable();

        // menampilkan list wilayah
        var tabel_list_wilayah = $('#tabel_master_wilayah2').DataTable({
            "processing"        : true,
            "serverSide"        : true,
            "order"             : [],
            "ajax"              : {
                "url"   : "tampil_data_wilayah",
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

        // aksi simpan data wilayah
        $('#simpan_wilayah').on('click', function () {

            var form_wilayah = $('#form_wilayah').serialize();
            var nama_wilayah = $('#nama_wilayah').val();

            if (nama_wilayah == '') {
                swal({
                    title               : "Peringatan",
                    text                : 'Wilayah harus terisi !',
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
                            url     : "simpan_data_wilayah",
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
                            data    : form_wilayah,
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
                
                                tabel_list_wilayah.ajax.reload(null,false);        
                                
                                $('#form_wilayah').trigger("reset");

                                

                                $('.hapus-wilayah').removeAttr('hidden');
                
                                $('#aksi').val('Tambah');

                                $('.f_tambah').slideToggle('fast', function() {
                                    if ($(this).is(':visible')) {
                                        $('#status_toggle').val(1);          
                                    } else {  
                                        $('#status_toggle').val(0);            
                                    }        
                                });

                                $('#tambah_wilayah').attr('hidden', false);
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

        // aksi batal wilayah
        $('.batal_wilayah').on('click', function () {

            $('#form_wilayah').trigger("reset");
            // 

            $('#aksi').val('Tambah');
            $('.hapus-wilayah').removeAttr('hidden');

            $('.f_tambah').slideToggle('fast', function() {
                if ($(this).is(':visible')) {
                    $('#status_toggle').val(1);          
                } else {  
                    $('#status_toggle').val(0);            
                }        
            });

            $('#tambah_wilayah').attr('hidden', false);
        })

        // edit data wilayah
        $('#tabel_master_wilayah').on('click', '.edit-wilayah', function () {

            $('.hapus-wilayah').attr('hidden', true);
            $('#tambah_wilayah').attr('hidden', true);

            var sts = $('#status_toggle').val();
            
            var id_wilayah     = $(this).data('id');
            var nama_wilayah   = $(this).attr('nama');

            $('#id_wilayah').val(id_wilayah);
            $('#nama_wilayah').val(nama_wilayah);

            $('#aksi').val('Ubah');
            $('#judul_atas').val('Ubah Data');
            $('#batal_wilayah').removeAttr('hidden');

            $('#nama_wilayah').attr('autofocus', true);

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

        // hapus wilayah
            $('#tabel_master_wilayah').on('click', '.hapus-wilayah', function () {
                
                var id_wilayah = $(this).data('id');
                var sts         = $('#status_toggle').val();
                var nama        = $(this).attr('nama');

                swal({
                    title       : 'Konfirmasi',
                    text        : 'Yakin akan hapus wilayah '+nama+' ?',
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
                            url         : "simpan_data_wilayah",
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
                            data        : {aksi:'Hapus', id_wilayah:id_wilayah},
                            dataType    : "JSON",
                            success     : function (data) {

                                    tabel_list_wilayah.ajax.reload(null,false);   

                                    swal({
                                        title               : 'Hapus wilayah',
                                        text                : 'Data Berhasil Dihapus',
                                        buttonsStyling      : false,
                                        confirmButtonClass  : "btn btn-success",
                                        type                : 'success',
                                        showConfirmButton   : false,
                                        timer               : 1000
                                    }); 

                                        
                                    
                                    $('#form_wilayah').trigger("reset");

                                    $('#aksi').val('Tambah');

                                    

                                    $('.hapus-wilayah').removeAttr('hidden');

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
                                text                : 'Anda membatalkan hapus wilayah',
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