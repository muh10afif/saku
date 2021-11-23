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
            <button class="btn btn-light float-right batal_asuransi"><i class="mdi mdi-close mdi-18px"></i></button>
            <h5 id="judul_atas">Tambah Data</h5></div>
            <form id="form_asuransi" autocomplete="off">
                <input type="hidden" name="id_asuransi" id="id_asuransi">
                <input type="hidden" name="aksi" id="aksi" value="Tambah">
                <div class="card-body d-flex justify-content-center">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label for="nama_asuransi" class="col-md-3 col-form-label text-left">Kode</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" id="kode_asuransi" name="kode_asuransi" value="<?= $kode ?>" readonly>
                            </div>
                        </div>   
                        <div class="form-group row">
                            <label for="nama_asuransi" class="col-md-3 col-form-label text-left">Nama</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" name="nama_asuransi" id="nama_asuransi" placeholder="Masukkan Nama">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="nama_asuransi" class="col-md-3 col-form-label text-left">Singkatan</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" name="singkatan" id="singkatan" placeholder="Masukkan Singkatan">
                            </div>
                        </div>   
                        <div class="form-group row">
                            <label for="nama_asuransi" class="col-md-3 col-form-label text-left">Tipe Asuransi</label>
                            <div class="col-md-9">
                                <select name="id_tipe_as" id="id_tipe_as" class="select2" style="height: 80%;">
                                <option value="">Pilih Tipe Asuransi</option>
                                <?php foreach ($tipe_as as $ta): ?>
                                    <option value="<?= $ta['id_tipe_as'] ?>"><?= $ta['tipe_as'] ?></option>
                                <?php endforeach; ?>
                                </select>
                            </div>
                        </div>   
                        <div class="form-group row">
                            <label for="nama_asuransi" class="col-md-3 col-form-label text-left">Kategori Asuransi</label>
                            <div class="col-md-9">
                                <select name="id_kategori_as" id="id_kategori_as" class="select2">
                                <option value="">Pilih Kategori Asuransi</option>
                                <?php foreach ($kategori_as as $ka): ?>
                                    <option value="<?= $ka['id_kategori_as'] ?>"><?= $ka['kategori_as'] ?></option>
                                <?php endforeach; ?>
                                </select>
                            </div>
                        </div>  
                        <div class="form-group row">
                            <label for="nama_asuransi" class="col-md-3 col-form-label text-left">Alamat</label>
                            <div class="col-md-9">
                                <textarea cols="5" type="text" id="alamat" name="alamat" class="form-control" placeholder="Masukkan Alamat"></textarea>
                            </div>
                        </div>  
                        <div class="form-group row">
                            <label for="nama_asuransi" class="col-md-3 col-form-label text-left">Kota</label>
                            <div class="col-md-9">
                                <select name="id_kota" id="id_kota" class="select2">
                                <option value="">Pilih Kota</option>
                                <?php foreach ($kota as $kt): ?>
                                    <option value="<?= $kt['id_kota'] ?>"><?= $kt['kota'] ?></option>
                                <?php endforeach; ?>
                                </select>
                            </div>
                        </div>  
                        <div class="form-group row">
                            <label for="nama_asuransi" class="col-md-3 col-form-label text-left">Kode Pos</label>
                            <div class="col-md-9">
                                <input type="text" id="kode_pos" name="kode_pos" class="form-control" placeholder="Masukkan Kode Pos">
                            </div>
                        </div> 
                        
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label for="nama_asuransi" class="col-md-3 col-form-label text-left">Telepon</label>
                            <div class="col-md-9">
                                <input type="text" id="telp" name="telp" class="form-control" placeholder="Masukkan Telepon">
                            </div>
                        </div> 
                        <div class="form-group row">
                            <label for="nama_asuransi" class="col-md-3 col-form-label text-left">Fax</label>
                            <div class="col-md-9">
                                <input type="text" id="fax" name="fax" class="form-control" placeholder="Masukkan Fax">
                            </div>
                        </div> 
                        <div class="form-group row">
                            <label for="nama_asuransi" class="col-md-3 col-form-label text-left">Website</label>
                            <div class="col-md-9">
                                <input type="text" id="website" name="website" class="form-control" placeholder="Masukkan Website">
                            </div>
                        </div> 
                        <div class="form-group row">
                            <label for="nama_asuransi" class="col-md-3 col-form-label text-left">Email</label>
                            <div class="col-md-9">
                                <input type="text" id="email" name="email" class="form-control" placeholder="Masukkan Email">
                            </div>
                        </div> 
                        <div class="form-group row">
                            <label for="nama_asuransi" class="col-md-3 col-md-3 col-form-label text-left">PIC</label>
                            <div class="col-md-9">
                                <input type="text" id="pic" name="pic" class="form-control" placeholder="Masukkan PIC">
                            </div>
                        </div> 
                        <div class="form-group row">
                            <label for="nama_asuransi" class="col-md-3 col-form-label text-left">Alamat PIC</label>
                            <div class="col-md-9">
                                <textarea cols="5" id="alamat_pic" name="alamat_pic" type="text" class="form-control" placeholder="Masukkan Alamat PIC"></textarea>
                            </div>
                        </div> 
                        <div class="form-group row">
                            <label for="nama_asuransi" class="col-md-3 col-form-label text-left">Telepon PIC</label>
                            <div class="col-md-9">
                                <input type="text" id="telp_pic" name="telp_pic" class="form-control" placeholder="Masukkan Telepon PIC">
                            </div>
                        </div> 
                        <div class="form-group row">
                            <label for="nama_asuransi" class="col-md-3 col-form-label text-left">Email PIC</label>
                            <div class="col-md-9">
                                <input type="text" id="email_pic" name="email_pic" class="form-control" placeholder="Masukkan Email PIC">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="form-group text-right mb-0">
                        <button type="button" class="btn btn-primary mt-1 mr-2" id="simpan_asuransi">Simpan</button>
                        <button type="button" class="btn btn-secondary mt-1 batal_asuransi" id="batal_asuransi">Batal</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="col-md-12">
        <div class="card shadow">
            <div class="card-header">
                <button class="btn btn-primary float-right" id="tambah_asuransi">Tambah Data</button>
                <!-- <h5 id="judul" class="mb-0 mt-1">Master Data Bagian</h5> -->
            </div>
            <div class="card-body table-responsive">
                <table class="table table-bordered table-hover dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;" id="tabel_master_asuransi" width="100%" cellspacing="0">
                    <thead class="thead-light text-center">
                        <tr>
                            <th width="5%">No</th>
                            <th width="20%">Kode</th>
                            <th width="20%">Asuransi</th>
                            <th width="20%">Telepon</th>
                            <th width="20%">PIC</th>
                            <th width="20%">Kategori</th>
                            <th width="20%">Tipe</th>
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

        $('#tambah_asuransi').on('click', function () {

            $('.f_tambah').slideToggle('fast', function() {
                if ($(this).is(':visible')) {
                    $('#status_toggle').val(1);          
                } else {  
                    $('#status_toggle').val(0);            
                }        
            });

        })  

        // menampilkan list asuransi
        var tabel_list_asuransi = $('#tabel_master_asuransi').DataTable({
            "processing"        : true,
            "serverSide"        : true,
            "order"             : [],
            "ajax"              : {
                "url"   : "<?= base_url() ?>master/tampil_data_asuransi",
                "type"  : "POST"
            },
            "columnDefs"        : [{
                "targets"   : [0,4],
                "orderable" : false
            }, {
                'targets'   : [0,4],
                'className' : 'text-center',
            }]
        })

        // aksi simpan data asuransi
        $('#simpan_asuransi').on('click', function () {

            var form_asuransi = $('#form_asuransi').serialize();
            var nama_asuransi = $('#nama_asuransi').val();

            if (nama_asuransi == '') {
                swal({
                    title               : "Peringatan",
                    text                : 'Asuransi harus terisi !',
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
                            url     : "<?= base_url() ?>Master/simpan_data_asuransi",
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
                            data    : form_asuransi,
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
                
                                tabel_list_asuransi.ajax.reload(null,false);        
                                
                                $('#form_asuransi').trigger("reset");


                                $('.hapus-asuransi').removeAttr('hidden');
                
                                $('#aksi').val('Tambah');

                                $('.f_tambah').slideToggle('fast', function() {
                                    if ($(this).is(':visible')) {
                                        $('#status_toggle').val(1);          
                                    } else {  
                                        $('#status_toggle').val(0);            
                                    }        
                                });

                                $('#tambah_asuransi').attr('hidden', false);
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

        // aksi batal asuransi
        $('.batal_asuransi').on('click', function () {

            $('#form_asuransi').trigger("reset");
            // 

            $('#aksi').val('Tambah');
            $('.hapus-asuransi').removeAttr('hidden');

            $('.f_tambah').slideToggle('fast', function() {
                if ($(this).is(':visible')) {
                    $('#status_toggle').val(1);          
                } else {  
                    $('#status_toggle').val(0);            
                }        
            });

            $('#tambah_asuransi').attr('hidden', false);
        })

        // edit data asuransi
        $('#tabel_master_asuransi').on('click', '.edit-asuransi', function () {

            // $('.hapus-asuransi').attr('hidden', true);
            $('#tambah_asuransi').attr('hidden', true);

            var sts = $('#status_toggle').val();
            
            var id_asuransi     = $(this).data('id');
            var nama_asuransi   = $(this).attr('nama');

            $('#id_asuransi').val(id_asuransi);
            $('#nama_asuransi').val(nama_asuransi);

            $('#aksi').val('Ubah');
            $('#judul_atas').val('Ubah Data');
            $('#batal_asuransi').removeAttr('hidden');

            $('#nama_asuransi').attr('autofocus', true);


            $.ajax({
                url         : "<?= base_url() ?>Master/ambil_data_asuransi/"+id_asuransi,
                method      : "GET",
                dataType    : "JSON",
                success     : function (data) {

                    $('#kode_asuransi').val(data.kode_asuransi);
                    $('#nama_asuransi').val(data.nama_asuransi);
                    $('#singkatan').val(data.singkatan);
                    $('#id_tipe_as').val(data.id_tipe_as).trigger('change');
                    $('#id_kategori_as').val(data.id_kategori_as).trigger('change');
                    $('#alamat').val(data.alamat);
                    $('#id_kota').val(data.id_kota).trigger('change');
                    $('#kode_pos').val(data.kode_pos);
                    $('#telp').val(data.telp);
                    $('#fax').val(data.fax);
                    $('#website').val(data.website);
                    $('#email').val(data.email);
                    $('#pic').val(data.pic);
                    $('#alamat_pic').val(data.alamat_pic)
                    $('#telp_pic').val(data.telp_pic)
                    $('#email_pic').val(data.email_pic);
                    

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
                }
            })

        })

        // hapus asuransi
            $('#tabel_master_asuransi').on('click', '.hapus-asuransi', function () {
                
                var id_asuransi = $(this).data('id');
                var sts         = $('#status_toggle').val();
                var nama        = $(this).attr('nama');

                swal({
                    title       : 'Konfirmasi',
                    text        : 'Yakin akan hapus asuransi '+nama+' ?',
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
                            url         : "simpan_data_asuransi",
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
                            data        : {aksi:'Hapus', id_asuransi:id_asuransi},
                            dataType    : "JSON",
                            success     : function (data) {

                                    tabel_list_asuransi.ajax.reload(null,false);   

                                    swal({
                                        title               : 'Hapus asuransi',
                                        text                : 'Data Berhasil Dihapus',
                                        buttonsStyling      : false,
                                        confirmButtonClass  : "btn btn-success",
                                        type                : 'success',
                                        showConfirmButton   : false,
                                        timer               : 1000
                                    }); 
                                    
                                    $('#form_asuransi').trigger("reset");

                                    $('#aksi').val('Tambah');

                                    $('#kode_asuransi').val(data.kode_asuransi);

                                    $('.hapus-asuransi').removeAttr('hidden');

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
                                text                : 'Anda membatalkan hapus asuransi',
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