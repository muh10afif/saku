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
                <table class="table table-bordered table-hover dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;" id="tabel_master_provinsi" width="100%" cellspacing="0">
                    <thead class="thead-light text-center">
                        <tr>
                            <th width="5%">No</th>
                            <th width="20%">Provinsi</th>
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
            <form id="form_provinsi" autocomplete="off">
                <input type="hidden" name="id_provinsi" id="id_provinsi">
                <input type="hidden" name="aksi" id="aksi" value="Tambah">
                <div class="card-body d-flex justify-content-center">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="nama_produk" class="col-form-label text-left">Negara</label>
                            <div class="">
                                <select name="negara" id="negara" class="form-control select2">
                                  <option value="">-- Pilih --</option>
                                    <?php foreach ($negara as $n) : ?>
                                        <option value="<?= $n['id_negara'] ?>"><?= $n['negara'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="nama_provinsi" class="col-form-label text-left">Provinsi</label>
                            <div class="">
                            <input type="text" class="form-control" name="nama_provinsi" id="nama_provinsi" placeholder="Masukkan Provinsi">
                            </div>
                        </div>
                        <hr>
                    <div class="form-group text-center mb-0">
                        <button type="button" class="btn btn-primary mt-1 mr-3" id="simpan_provinsi">Simpan</button>
                        <button type="button" class="btn btn-danger mt-1 batal_provinsi" id="batal_provinsi">Batal</button>
                    </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script>

    $(document).ready(function () {

        $('#tambah_provinsi').on('click', function () {

            $('.f_tambah').slideToggle('fast', function() {
                if ($(this).is(':visible')) {
                    $('#status_toggle').val(1);
                } else {
                    $('#status_toggle').val(0);
                }
            });

        })

        // menampilkan list provinsi
        var tabel_list_provinsi = $('#tabel_master_provinsi').DataTable({
            "processing"        : true,
            "serverSide"        : true,
            "order"             : [],
            "ajax"              : {
                "url"   : "<?= base_url() ?>Master/tampil_data_provinsi",
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

        // aksi simpan data provinsi
        $('#simpan_provinsi').on('click', function () {

            var form_provinsi = $('#form_provinsi').serialize();
            var nama_provinsi = $('#nama_provinsi').val();

            if (nama_provinsi == '') {
                swal({
                    title               : "Peringatan",
                    text                : 'Provinsi harus terisi !',
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
                            url     : "simpan_data_provinsi",
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
                            data    : form_provinsi,
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

                                tabel_list_provinsi.ajax.reload(null,false);

                                $('#form_provinsi').trigger("reset");



                                $('.hapus-provinsi').removeAttr('hidden');

                                $('#aksi').val('Tambah');

                                $('.f_tambah').slideToggle('fast', function() {
                                    if ($(this).is(':visible')) {
                                        $('#status_toggle').val(1);
                                    } else {
                                        $('#status_toggle').val(0);
                                    }
                                });

                                $('#tambah_provinsi').attr('hidden', false);
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

        // aksi batal provinsi
        $('.batal_provinsi').on('click', function () {

            $('#form_provinsi').trigger("reset");
            //

            $('#aksi').val('Tambah');
            $('.hapus-provinsi').removeAttr('hidden');

            $('.f_tambah').slideToggle('fast', function() {
                if ($(this).is(':visible')) {
                    $('#status_toggle').val(1);
                } else {
                    $('#status_toggle').val(0);
                }
            });

            $('#tambah_provinsi').attr('hidden', false);
        })

        // edit data provinsi
        $('#tabel_master_provinsi').on('click', '.edit-provinsi', function () {

            // $('.hapus-provinsi').attr('hidden', true);
            $('#tambah_provinsi').attr('hidden', true);

            var sts = $('#status_toggle').val();

            var id_provinsi     = $(this).data('id');
            var nama_provinsi   = $(this).attr('nama');

            // .trigger('change')
            $('#id_provinsi').val(id_provinsi);
            $('#nama_provinsi').val(nama_provinsi);

            $('#aksi').val('Ubah');
            $('#judul_atas').val('Ubah Data');
            $('#batal_provinsi').removeAttr('hidden');

            $('#nama_provinsi').attr('autofocus', true);

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

        // hapus provinsi
            $('#tabel_master_provinsi').on('click', '.hapus-provinsi', function () {

                var id_provinsi = $(this).data('id');
                var sts         = $('#status_toggle').val();
                var nama        = $(this).attr('nama');

                swal({
                    title       : 'Konfirmasi',
                    text        : 'Yakin akan hapus provinsi '+nama+' ?',
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
                            url         : "simpan_data_provinsi",
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
                            data        : {aksi:'Hapus', id_provinsi:id_provinsi},
                            dataType    : "JSON",
                            success     : function (data) {

                                    tabel_list_provinsi.ajax.reload(null,false);

                                    swal({
                                        title               : 'Hapus provinsi',
                                        text                : 'Data Berhasil Dihapus',
                                        buttonsStyling      : false,
                                        confirmButtonClass  : "btn btn-success",
                                        type                : 'success',
                                        showConfirmButton   : false,
                                        timer               : 1000
                                    });



                                    $('#form_provinsi').trigger("reset");

                                    $('#aksi').val('Tambah');



                                    $('.hapus-provinsi').removeAttr('hidden');

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
                                text                : 'Anda membatalkan hapus provinsi',
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
