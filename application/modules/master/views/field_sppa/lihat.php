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
                <table class="table table-bordered table-hover dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;" id="tabel_master_field_sppa" width="100%" cellspacing="0">
                    <thead class="thead-light text-center">
                        <tr>
                            <th width="5%">No</th>
                            <th width="20%">Field SPPA</th>
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
            <form id="form_field_sppa" autocomplete="off">
                <input type="hidden" name="id_field_sppa" id="id_field_sppa">
                <input type="hidden" name="aksi" id="aksi" value="Tambah">
                <div class="card-body d-flex justify-content-center">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="nama_field_sppa" class="col-form-label text-right">Field SPPA</label>
                            <div class="">
                                <input type="text" class="form-control" name="field_sppa" id="field_sppa" placeholder="Field SPPA">
                            </div>
                            <label for="tipe" class="col-form-label text-right">Type</label>
                            <div class="">
                               <input type="radio" name="tipe" id="tipe1" class="mt-1" value="text">
                                <input type="text" class="form-control" value="Tipe Text" readonly>
                               <input type="radio" name="tipe" id="tipe2" class="mt-1" value="textarea">
                               <textarea cols="5" class="form-control" readonly>Tipe Textarea</textarea>
                               <input type="radio" name="tipe" id="tipe3" class="mt-1" value="option">
                               <select class="form-control" readonly>
                                   <option value="">Tipe Select Option</option>
                               </select>
                            </div>
                        </div>  <hr>
                        <div class="form-group text-center mb-0">
                            <button type="button" class="btn btn-primary mt-1 mr-3" id="simpan_field_sppa">Simpan</button>
                            <button type="button" class="btn btn-danger mt-1 batal_field_sppa" id="batal_field_sppa">Batal</button>
                        </div> 
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script>

    $(document).ready(function () {

        // menampilkan list field_sppa
        var tabel_list_field_sppa = $('#tabel_master_field_sppa').DataTable({
            "processing"        : true,
            "serverSide"        : true,
            "order"             : [],
            "ajax"              : {
                "url"   : "<?= base_url() ?>master/tampil_data_field_sppa",
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

        // aksi simpan data field_sppa
        $('#simpan_field_sppa').on('click', function () {

            var form_field_sppa = $('#form_field_sppa').serialize();
            var nama_field_sppa = $('#field_sppa').val();

            if (nama_field_sppa == '') {
                swal({
                    title               : "Peringatan",
                    text                : 'Field SPPA harus terisi !',
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
                            url     : "<?= base_url() ?>master/simpan_data_field_sppa",
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
                            data    : form_field_sppa,
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
                
                                tabel_list_field_sppa.ajax.reload(null,false);        
                                
                                $('#form_field_sppa').trigger("reset");
                
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

        // aksi batal field_sppa
        $('.batal_field_sppa').on('click', function () {

            $('#form_field_sppa').trigger("reset");

            $('#aksi').val('Tambah');
            $('.hapus-field_sppa').removeAttr('hidden');

            tabel_list_field_sppa.ajax.reload(null,false); 

        })

        // edit data field_sppa
        $('#tabel_master_field_sppa').on('click', '.edit-field_sppa', function () {
            
            var id_field_sppa     = $(this).data('id');
            var nama_field_sppa   = $(this).attr('nama');

            $('#id_field_sppa').val(id_field_sppa);
            $('#field_sppa').val(nama_field_sppa);

            $('#aksi').val('Ubah');

            $('#field_sppa').attr('autofocus', true);

            $('html, body').animate({
                scrollTop: $('body').offset().top
            }, 800);

        })

        // hapus field_sppa
            $('#tabel_master_field_sppa').on('click', '.hapus-field_sppa', function () {
                
                var id_field_sppa = $(this).data('id');
                var sts         = $('#status_toggle').val();
                var nama        = $(this).attr('nama');

                swal({
                    title       : 'Konfirmasi',
                    text        : 'Yakin akan hapus field sppa '+nama+' ?',
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
                            url         : "<?= base_url() ?>master/simpan_data_field_sppa",
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
                            data        : {aksi:'Hapus', id_field_sppa:id_field_sppa},
                            dataType    : "JSON",
                            success     : function (data) {

                                    tabel_list_field_sppa.ajax.reload(null,false);   

                                    swal({
                                        title               : 'Hapus field sppa',
                                        text                : 'Data Berhasil Dihapus',
                                        buttonsStyling      : false,
                                        confirmButtonClass  : "btn btn-success",
                                        type                : 'success',
                                        showConfirmButton   : false,
                                        timer               : 1000
                                    }); 

                                        
                                    
                                    $('#form_field_sppa').trigger("reset");

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
                                text                : 'Anda membatalkan hapus data',
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