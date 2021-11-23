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
                <table class="table table-bordered table-hover dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;" id="tabel_master_misi" width="100%" cellspacing="0">
                    <thead class="thead-light text-center">
                        <tr>
                            <th width="5%">No</th>
                            <th width="20%">Misi</th>
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
            <form id="form_misi" autocomplete="off">
                <input type="hidden" name="id_misi" id="id_misi">
                <input type="hidden" name="aksi" id="aksi" value="Tambah">
                <div class="card-body d-flex justify-content-center">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="nama_misi" class="col-form-label text-right">Misi</label>
                            <div class="">
                            <textarea type="text" class="form-control" style="font-size: 14px;" name="nama_misi" id="nama_misi" placeholder="Masukkan Misi" cols="5"></textarea>
                            </div>
                        </div>  <hr>
                        <div class="form-group text-center mb-0">
                            <button type="button" class="btn btn-primary mt-1 mr-3" id="simpan_misi">Simpan</button>
                            <button type="button" class="btn btn-danger mt-1 batal_misi" id="batal_misi">Batal</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script>

    $(document).ready(function () {

        $('#tambah_misi').on('click', function () {

            $('.f_tambah').slideToggle('fast', function() {
                if ($(this).is(':visible')) {
                    $('#status_toggle').val(1);          
                } else {  
                    $('#status_toggle').val(0);            
                }        
            });

        })    

        // menampilkan list misi
        var tabel_list_misi = $('#tabel_master_misi').DataTable({
            "processing"        : true,
            "serverSide"        : true,
            "order"             : [],
            "ajax"              : {
                "url"   : "tampil_data_misi",
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

        // aksi simpan data misi
        $('#simpan_misi').on('click', function () {

            var form_misi = $('#form_misi').serialize();
            var nama_misi = $('#nama_misi').val();

            if (nama_misi == '') {
                swal({
                    title               : "Peringatan",
                    text                : 'Misi harus terisi !',
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
                            url     : "simpan_data_misi",
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
                            data    : form_misi,
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
                
                                tabel_list_misi.ajax.reload(null,false);        
                                
                                $('#form_misi').trigger("reset");

                                $('.hapus-misi').removeAttr('hidden');
                
                                $('#aksi').val('Tambah');
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

        // aksi batal misi
        $('.batal_misi').on('click', function () {

            $('#form_misi').trigger("reset");

            $('#aksi').val('Tambah');

            tabel_list_misi.ajax.reload(null,false);    
        })

        // edit data misi
        $('#tabel_master_misi').on('click', '.edit-misi', function () {
            
            var id_misi     = $(this).data('id');
            var nama_misi   = $(this).attr('nama');

            $('#id_misi').val(id_misi);
            $('#nama_misi').val(nama_misi);

            $('#aksi').val('Ubah');

            $('#nama_misi').attr('autofocus', true);

            $('html, body').animate({
                scrollTop: $('body').offset().top
            }, 800);

        })

        // hapus misi
            $('#tabel_master_misi').on('click', '.hapus-misi', function () {
                
                var id_misi     = $(this).data('id');
                var nama        = $(this).attr('nama');

                swal({
                    title       : 'Konfirmasi',
                    text        : 'Yakin akan hapus misi '+nama+' ?',
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
                            url         : "simpan_data_misi",
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
                            data        : {aksi:'Hapus', id_misi:id_misi},
                            dataType    : "JSON",
                            success     : function (data) {

                                    tabel_list_misi.ajax.reload(null,false);   

                                    swal({
                                        title               : 'Hapus misi',
                                        text                : 'Data Berhasil Dihapus',
                                        buttonsStyling      : false,
                                        confirmButtonClass  : "btn btn-success",
                                        type                : 'success',
                                        showConfirmButton   : false,
                                        timer               : 1000
                                    }); 

                                        
                                    
                                    $('#form_misi').trigger("reset");

                                    $('#aksi').val('Tambah');
                                
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
                                text                : 'Anda membatalkan hapus misi',
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