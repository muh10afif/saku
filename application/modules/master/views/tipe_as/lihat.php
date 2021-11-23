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
                <table class="table table-bordered table-hover dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;" id="tabel_master_tipe_as" width="100%" cellspacing="0">
                    <thead class="thead-light text-center">
                        <tr>
                            <th width="5%">No</th>
                            <th width="20%">Tipe Asuransi</th>
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
            <form id="form_tipe_as" autocomplete="off">
                <input type="hidden" name="id_tipe_as" id="id_tipe_as">
                <input type="hidden" name="aksi" id="aksi" value="Tambah">
                <div class="card-body d-flex justify-content-center">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="nama_tipe_as" class="col-form-label text-left">Tipe Asuransi<b style="color:red;">*</b></label>
                            <div class="">
                            <input type="text" class="form-control" name="nama_tipe_as" id="nama_tipe_as" placeholder="Masukkan Tipe Asuransi">
                            </div>
                        </div>
                        <i style="color:red;">('*') Menandakan Form Harus di Isi</i>
                        <hr>
                        <div class="form-group text-center mb-0 mt-1">
                            <button type="button" class="btn btn-primary mt-1 mr-2" id="simpan_tipe_as">Submit</button>
                            <button type="button" class="btn btn-secondary mt-1 batal_tipe_as" id="batal_tipe_as">Cancle</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script>

    $(document).ready(function () {

        // menampilkan list tipe_as
        var tabel_list_tipe_as = $('#tabel_master_tipe_as').DataTable({
            "processing"        : true,
            "serverSide"        : true,
            "order"             : [],
            "ajax"              : {
                "url"   : "<?= base_url() ?>master/tampil_data_tipe_as",
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

        // aksi simpan data tipe_as
        $('#simpan_tipe_as').on('click', function () {

            var form_tipe_as = $('#form_tipe_as').serialize();
            var nama_tipe_as = $('#nama_tipe_as').val();

            if (nama_tipe_as == '') {
                swal({
                    title               : "Peringatan",
                    text                : 'Tipe Asuransi harus terisi !',
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
                            url     : "<?= base_url() ?>master/simpan_data_tipe_as",
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
                            data    : form_tipe_as,
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

                                tabel_list_tipe_as.ajax.reload(null,false);

                                $('#form_tipe_as').trigger("reset");

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

        // aksi batal tipe_as
        $('.batal_tipe_as').on('click', function () {

            $('#form_tipe_as').trigger("reset");

            $('#aksi').val('Tambah');
            tabel_list_tipe_as.ajax.reload(null,false);

        })

        // edit data tipe_as
        $('#tabel_master_tipe_as').on('click', '.edit-tipe_as', function () {

            var id_tipe_as     = $(this).data('id');
            var nama_tipe_as   = $(this).attr('nama');

            $('#id_tipe_as').val(id_tipe_as);
            $('#nama_tipe_as').val(nama_tipe_as);

            $('#aksi').val('Ubah');

            $('#nama_tipe_as').attr('autofocus', true);

            $('html, body').animate({
                scrollTop: $('body').offset().top
            }, 800);

        })

        // hapus tipe_as
            $('#tabel_master_tipe_as').on('click', '.hapus-tipe_as', function () {

                var id_tipe_as  = $(this).data('id');
                var nama        = $(this).attr('nama');

                swal({
                    title       : 'Konfirmasi',
                    text        : 'Yakin akan hapus data '+nama+' ?',
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
                            url         : "<?= base_url() ?>master/simpan_data_tipe_as",
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
                            data        : {aksi:'Hapus', id_tipe_as:id_tipe_as},
                            dataType    : "JSON",
                            success     : function (data) {

                                    tabel_list_tipe_as.ajax.reload(null,false);

                                    swal({
                                        title               : 'Hapus Data',
                                        text                : 'Data Berhasil Dihapus',
                                        buttonsStyling      : false,
                                        confirmButtonClass  : "btn btn-success",
                                        type                : 'success',
                                        showConfirmButton   : false,
                                        timer               : 1000
                                    });



                                    $('#form_tipe_as').trigger("reset");

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
