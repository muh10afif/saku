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
            <div class="card-body">
                <table class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;" id="tabel_master_introduction" width="100%" cellspacing="0">
                    <thead class="thead-light text-center">
                        <tr>
                            <th>No</th>
                            <th>Introduction</th>
                            <th>Aksi</th>
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
            <form id="form_introduction" autocomplete="off">
                <input type="hidden" name="id_introduction" id="id_introduction">
                <input type="hidden" name="aksi" id="aksi" value="Tambah">
                <div class="card-body row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="nama_introduction" class="col-form-label text-right">Introduction</label>
                            <div class="">
                                <input type="text" class="form-control" placeholder="Introduction" id="introduction" name="introduction">
                            </div>
                        </div>  <hr>
                        <div class="form-group text-center mb-0">
                            <button type="button" class="btn btn-primary mt-1 mr-3" id="simpan_introduction">Simpan</button>
                            <button type="button" class="btn btn-danger mt-1 batal_introduction" id="batal_introduction">Batal</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

</div>

<script>

    $(document).ready(function () {

        // menampilkan list introduction
        var tabel_list_introduction = $('#tabel_master_introduction').DataTable({
            "processing"        : true,
            "serverSide"        : true,
            "order"             : [],
            "ajax"              : {
                "url"   : "<?= base_url() ?>master/tampil_data_introduction",
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

        // aksi simpan data introduction
        $('#simpan_introduction').on('click', function () {

            var form_introduction = $('#form_introduction').serialize();
            var nama_introduction = $('#nama_introduction').val();

            if (nama_introduction == '') {
                swal({
                    title               : "Peringatan",
                    text                : 'Introduction harus terisi !',
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
                            url     : "<?= base_url() ?>master/simpan_data_introduction",
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
                            data    : form_introduction,
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

                                tabel_list_introduction.ajax.reload(null,false);

                                $('#form_introduction').trigger("reset");
                                $('.hapus-introduction').removeAttr('hidden');

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

        // aksi batal introduction
        $('.batal_introduction').on('click', function () {

            $('#form_introduction').trigger("reset");
            $('#aksi').val('Tambah');

            tabel_list_introduction.ajax.reload(null,false);
        })

        // edit data introduction
        $('#tabel_master_introduction').on('click', '.edit-introduction', function () {

            var id_introduction     = $(this).data('id');
            var nama_introduction   = $(this).attr('nama');

            $('#id_introduction').val(id_introduction);
            $('#introduction').val(nama_introduction);

            $('#aksi').val('Ubah');

            $('#nama_introduction').attr('autofocus', true);

            $('html, body').animate({
                scrollTop: $('body').offset().top
            }, 800);

        })

        // hapus introduction
            $('#tabel_master_introduction').on('click', '.hapus-introduction', function () {

                var id_introduction = $(this).data('id');
                var sts         = $('#status_toggle').val();
                var nama        = $(this).attr('nama');

                swal({
                    title       : 'Konfirmasi',
                    text        : 'Yakin akan hapus introduction '+nama+' ?',
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
                            url         : "<?= base_url() ?>master/simpan_data_introduction",
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
                            data        : {aksi:'Hapus', id_introduction:id_introduction},
                            dataType    : "JSON",
                            success     : function (data) {

                                    tabel_list_introduction.ajax.reload(null,false);

                                    swal({
                                        title               : 'Hapus introduction',
                                        text                : 'Data Berhasil Dihapus',
                                        buttonsStyling      : false,
                                        confirmButtonClass  : "btn btn-success",
                                        type                : 'success',
                                        showConfirmButton   : false,
                                        timer               : 1000
                                    });



                                    $('#form_introduction').trigger("reset");

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
                                text                : 'Anda membatalkan hapus introduction',
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
