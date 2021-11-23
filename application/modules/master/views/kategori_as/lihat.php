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
                <table class="table table-bordered table-hover dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;" id="tabel_master_kategori_as" width="100%" cellspacing="0">
                    <thead class="thead-light text-center">
                        <tr>
                            <th width="5%">No</th>
                            <th width="20%">Kategori Asuransi</th>
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
            <form id="form_kategori_as" autocomplete="off">
                <input type="hidden" name="id_kategori_as" id="id_kategori_as">
                <input type="hidden" name="aksi" id="aksi" value="Tambah">
                <div class="card-body d-flex justify-content-center">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="nama_kategori_as" class="col-form-label text-right">Kategori Asuransi<b style="color:red;">*</b></label>
                            <div class="">
                                <input type="text" class="form-control" id="nama_kategori_as" name="nama_kategori_as" placeholder="Kategori Asuransi">
                            </div>
                        </div>
                        <i style="color:red;">('*') Menandakan Form Harus di Isi</i>
                        <hr>
                        <div class="form-group text-center mb-0">
                            <button type="button" class="btn btn-primary waves-effect waves-light mt-1 mr-3" id="simpan_kategori_as">Submit</button>
                            <button type="button" class="btn btn-secondary waves-effect mt-1 batal_kategori_as" id="batal_kategori_as">Cancle</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script>

    $(document).ready(function () {

        // menampilkan list kategori_as
        var tabel_list_kategori_as = $('#tabel_master_kategori_as').DataTable({
            "processing"        : true,
            "serverSide"        : true,
            "order"             : [],
            "ajax"              : {
                "url"   : "<?= base_url() ?>master/tampil_data_kategori_as",
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

        // aksi simpan data kategori_as
        $('#simpan_kategori_as').on('click', function () {

            var form_kategori_as = $('#form_kategori_as').serialize();
            var nama_kategori_as = $('#nama_kategori_as').val();

            if (nama_kategori_as == '') {
                swal({
                    title               : "Peringatan",
                    text                : 'Kategori Asuransi harus terisi !',
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
                            url     : "<?= base_url() ?>master/simpan_data_kategori_as",
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
                            data    : form_kategori_as,
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

                                tabel_list_kategori_as.ajax.reload(null,false);

                                $('#form_kategori_as').trigger("reset");

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

        // aksi batal kategori_as
        $('.batal_kategori_as').on('click', function () {

            $('#form_kategori_as').trigger("reset");

            $('#aksi').val('Tambah');

            tabel_list_kategori_as.ajax.reload(null,false);
        })

        // edit data kategori_as
        $('#tabel_master_kategori_as').on('click', '.edit-kategori_as', function () {

            var id_kategori_as     = $(this).data('id');
            var nama_kategori_as   = $(this).attr('nama');

            $('#id_kategori_as').val(id_kategori_as);
            $('#nama_kategori_as').val(nama_kategori_as);

            $('#aksi').val('Ubah');

            $('#nama_kategori_as').attr('autofocus', true);

        })

        // hapus kategori_as
            $('#tabel_master_kategori_as').on('click', '.hapus-kategori_as', function () {

                var id_kategori_as  = $(this).data('id');
                var nama            = $(this).attr('nama');

                swal({
                    title       : 'Konfirmasi',
                    text        : 'Yakin akan hapus '+nama+' ?',
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
                            url         : "<?= base_url() ?>master/simpan_data_kategori_as",
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
                            data        : {aksi:'Hapus', id_kategori_as:id_kategori_as},
                            dataType    : "JSON",
                            success     : function (data) {

                                    tabel_list_kategori_as.ajax.reload(null,false);

                                    swal({
                                        title               : 'Hapus data',
                                        text                : 'Data Berhasil Dihapus',
                                        buttonsStyling      : false,
                                        confirmButtonClass  : "btn btn-success",
                                        type                : 'success',
                                        showConfirmButton   : false,
                                        timer               : 1000
                                    });



                                    $('#form_kategori_as').trigger("reset");

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
