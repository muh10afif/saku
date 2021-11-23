<script>
    $(document).ready(function () {

        // 31-08-2021
        var tabel_prod_as = $('#tabel_prod_as').DataTable({
            "processing"        : true,
            "order"             : [],
            "ajax"              : {
                "url"   : "<?= base_url() ?>mop/tampil_produk_asuransi",
                "type"  : "POST",
                "data"  : function (data) {
                    data.id_mop = "<?= $id_mop ?>";
                }
            },
            "columnDefs"        : [{
                "targets"   : [0,3,4],
                "orderable" : false
            }, {
                'targets'   : [0,3,4],
                'className' : 'text-center',
            }],
            "bPaginate"     : false,
            "bLengthChange" : false,
            "bFilter"       : true,
            "bInfo"         : true
        })

        function ucword(str) {
            
            str = str.toLowerCase().replace(/\b[a-z]/g, function(letter) {
                return letter.toUpperCase();
            });

            return str;
        }

        function reset_form() {
            $('.aksi').val('Tambah');
            $('#form_manfaat').trigger('reset');
            $('#form_syarat').trigger('reset');
            $('#form_pengecualian').trigger('reset');
            $('#form_manfaat').parsley().reset();
            $('#form_syarat').parsley().reset();
            $('#form_pengecualian').parsley().reset();
        }

        $('.batal').on('click', function () {

            reset_form();
            
        })

        function sekrol() {
            $('html, body').animate({
                scrollTop: $('.row_detail').offset().top -160
            }, 1000);
        }

        $('#tabel_prod_as').on('click', '.btn_detail', function () {

            var id_produk_asuransi  = $(this).data('id');
            var tipe                = $(this).attr('tipe');
            var lob                 = $(this).attr('lob');
            var premi               = $(this).attr('premi');

            $('.id_produk_asuransi').val(id_produk_asuransi);

            tabel_manfaat.ajax.reload(null, false);
            tabel_syarat.ajax.reload(null, false);
            tabel_pengecualian.ajax.reload(null, false);

            $('.tipe').val(tipe);

            $('.t_produk').text(": "+lob);
            $('.t_premi').text(": "+premi);
            
            $('#judul').text(ucword(tipe));
            $('.row_detail').slideDown('fast');
            $('.card_detail').fadeOut('fast');
            $('.row_'+tipe).fadeIn('fast');

            sekrol();
        })

        $('.close').on('click', function () {

            $('.id_produk_asuransi').val('');
            $('.row_detail').slideUp('fast');
            $('.row_manfaat').fadeOut('fast');
            $('.row_syarat').fadeOut('fast');
            $('.row_pengecualian').fadeOut('fast');
        })

        $('#form_manfaat').parsley();
        $('#form_syarat').parsley();
        $('#form_pengecualian').parsley();

        // 31-08-2021
        var tabel_manfaat = $('#tabel_manfaat').DataTable({
            "processing"        : true,
            "order"             : [],
            "ajax"              : {
                "url"   : "<?= base_url() ?>mop/tampil_manfaat",
                "type"  : "POST",
                "data"  : function (data) {
                    data.id_produk_asuransi = $('.id_produk_asuransi').val();
                }
            },
            "columnDefs"        : [{
                "targets"   : [0,4],
                "orderable" : false
            }, {
                'targets'   : [0,4],
                'className' : 'text-center',
            },
            { 
                "width": "10%", "targets": 4
            },
            { 
                "width": "15%", "targets": 2
            }
            ],
            "autoWidth"     : false,
            "bPaginate"     : false,
            "bLengthChange" : false,
            "bFilter"       : true,
            "bInfo"         : true
        })

        // 31-08-2021
        var tabel_syarat = $('#tabel_syarat').DataTable({
            "processing"        : true,
            "order"             : [],
            "ajax"              : {
                "url"   : "<?= base_url() ?>mop/tampil_syarat",
                "type"  : "POST",
                "data"  : function (data) {
                    data.id_produk_asuransi = $('.id_produk_asuransi').val();
                }
            },
            "columnDefs"        : [{
                "targets"   : [0,2],
                "orderable" : false
            }, {
                'targets'   : [0,2],
                'className' : 'text-center',
            },
            { 
                "width": "15%", "targets": 2
            }
            ],
            "autoWidth"     : false,
            "bPaginate"     : false,
            "bLengthChange" : false,
            "bFilter"       : true,
            "bInfo"         : true
        })

        // 31-08-2021
        var tabel_pengecualian = $('#tabel_pengecualian').DataTable({
            "processing"        : true,
            "order"             : [],
            "ajax"              : {
                "url"   : "<?= base_url() ?>mop/tampil_pengecualian",
                "type"  : "POST",
                "data"  : function (data) {
                    data.id_produk_asuransi = $('.id_produk_asuransi').val();
                }
            },
            "columnDefs"        : [{
                "targets"   : [0,2],
                "orderable" : false
            }, {
                'targets'   : [0,2],
                'className' : 'text-center',
            },
            { 
                "width": "15%", "targets": 2
            }
            ],
            "autoWidth"     : false,
            "bLengthChange" : false,
            "bFilter"       : true,
            "bInfo"         : true
        })

        $('#form_manfaat').on('submit', function () {

            var tipe    = $('.tipe').val();

            simpan_data_detail(tipe);

            return false;

        })

        $('#form_syarat').on('submit', function () {

            var tipe    = $('.tipe').val();

            simpan_data_detail(tipe);

            return false;

        })

        $('#form_pengecualian').on('submit', function () {

            var tipe    = $('.tipe').val();

            simpan_data_detail(tipe);

            return false;

        })

        // 31-09-2021
        function simpan_data_detail(tipe) {

            var form = $("#form_"+tipe).serialize();

            var tabel = "tabel_"+tipe;

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
                reverseButtons      : true,

                allowOutsideClick   : false
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        url     : "<?= base_url() ?>mop/simpan_data_detail",
                        type    : "POST",
                        beforeSend  : function () {
                            swal({
                                title   : 'Menunggu',
                                html    : 'Memproses Data',
                                onOpen  : () => {
                                    swal.showLoading();
                                },
                                allowOutsideClick   : false
                            })
                        },
                        data    : form,
                        dataType: "JSON",
                        success : function (data) {

                            if (data.status == 'gagal') {

                                swal({
                                    title               : "Peringatan",
                                    text                : 'Data sudah ada, harap ganti!',
                                    buttonsStyling      : false,
                                    confirmButtonClass  : "btn btn-primary",
                                    type                : 'warning',
                                    showConfirmButton   : true
                                });    

                                return false;
                            }
                            
                            swal({
                                title               : "Berhasil",
                                text                : 'Data berhasil disimpan',
                                buttonsStyling      : false,
                                confirmButtonClass  : "btn btn-success",
                                type                : 'success',
                                showConfirmButton   : false,
                                timer               : 3000,
                                allowOutsideClick   : false
                            });    

                            reset_form();

                            if (tipe == 'manfaat') {
                                tabel_manfaat.ajax.reload(null,false);    
                            } else if (tipe == 'syarat') {
                                tabel_syarat.ajax.reload(null,false);   
                            } else {
                                tabel_pengecualian.ajax.reload(null,false);   
                            }   
                            
                        }
                    })
            
                    return false;

                } else if (result.dismiss === swal.DismissReason.cancel) {
                    swal.close();
                }
            })

            return true;
            
        }

        $('#tabel_manfaat').on('click', '.edit', function () {

            var id_manfaat          = $(this).data('id');
            var manfaat             = $(this).attr('manfaat');
            var nilai               = $(this).attr('nilai');
            var keterangan          = $(this).attr('keterangan');

            $('.aksi').val('Ubah');
            $('#id_manfaat').val(id_manfaat);
            $('#manfaat').val(manfaat);          
            $('#nilai').val(nilai);
            $('#keterangan').val(keterangan);

            sekrol();

        })

        $('#tabel_syarat').on('click', '.edit', function () {

            var id_syarat   = $(this).data('id');
            var syarat      = $(this).attr('syarat');

            $('.aksi').val('Ubah');
            $('#id_syarat').val(id_syarat);
            $('#syarat').val(syarat);          

            sekrol();

        })

        $('#tabel_pengecualian').on('click', '.edit', function () {

            var id_pengecualian = $(this).data('id');
            var pengecualian    = $(this).attr('pengecualian');

            $('.aksi').val('Ubah');
            $('#id_pengecualian').val(id_pengecualian);
            $('#pengecualian').val(pengecualian);          

            sekrol();

        })

        function hapus_data_detail(tipe, id) {

            swal({
                title       : 'Konfirmasi',
                text        : 'Yakin akan hapus data?',
                type        : 'warning',

                buttonsStyling      : false,
                confirmButtonClass  : "btn btn-danger",
                cancelButtonClass   : "btn btn-primary mr-3",

                showCancelButton    : true,
                confirmButtonText   : 'Hapus',
                confirmButtonColor  : '#d33',
                cancelButtonColor   : '#3085d6',
                cancelButtonText    : 'Batal',
                reverseButtons      : true,

                allowOutsideClick   : false
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        url         : "<?= base_url() ?>mop/simpan_data_detail",
                        type      : "POST",
                        beforeSend  : function () {
                            swal({
                                title   : 'Menunggu',
                                html    : 'Memproses Data',
                                onOpen  : () => {
                                    swal.showLoading();
                                },
                                allowOutsideClick   : false
                            })
                        },
                        data        : {aksi:'Hapus', tipe:tipe, id_hapus:id},
                        dataType    : "JSON",
                        success     : function (data) {

                            swal({
                                title               : "Berhasil",
                                text                : 'Data berhasil dihapus',
                                buttonsStyling      : false,
                                confirmButtonClass  : "btn btn-success",
                                type                : 'success',
                                showConfirmButton   : false,
                                timer               : 3000,
                                allowOutsideClick   : false
                            });    

                            reset_form();
            
                            if (tipe == 'manfaat') {
                                tabel_manfaat.ajax.reload(null,false);    
                            } else if (tipe == 'syarat') {
                                tabel_syarat.ajax.reload(null,false);   
                            } else {
                                tabel_pengecualian.ajax.reload(null,false);   
                            }   
                            
                        },
                        error       : function(xhr, status, error) {

                            swal({
                                title               : 'Gagal',
                                text                : 'Hapus data tidak berhasil',
                                buttonsStyling      : false,
                                confirmButtonClass  : "btn btn-success",
                                type                : 'error',
                                showConfirmButton   : false,
                                timer               : 3000
                            }); 
                            
                            return false;
                        }

                    })

                    return false;
                } else if (result.dismiss === swal.DismissReason.cancel) {

                    swal.close();
                }
            })

            return true;
            
        }

        $('#tabel_manfaat').on('click', '.hapus', function () {

            var tipe    = $('.tipe').val();

            var id      = $(this).data('id');

            hapus_data_detail(tipe, id);

            return false;

        })
        
        $('#tabel_syarat').on('click', '.hapus', function () {

            var tipe    = $('.tipe').val();

            var id      = $(this).data('id');

            hapus_data_detail(tipe, id);

            return false;

        })

        $('#tabel_pengecualian').on('click', '.hapus', function () {

            var tipe    = $('.tipe').val();

            var id      = $(this).data('id');

            hapus_data_detail(tipe, id);

            return false;

        })

        $('#tambah_prod_as').on('click', function () {

            $('#modal_prod_as').modal('show');
            $('#aksi_prod_as').val('Tambah');
            $('#id_lob').val('').trigger('change');
            $('#premi').val('');
            $('#form_prod_as').trigger('reset');
            $('#form_prod_as').parsley().reset();
            
        })

        $("#id_lob").change(function() {
            $(this).trigger('input')
        });

        $('#form_prod_as').parsley();

        $('#form_prod_as').on('submit', function () {

            var form = $('#form_prod_as').serialize();

            swal({
                title       : 'Konfirmasi',
                text        : 'Yakin akan simpan data?',
                type        : 'warning',

                buttonsStyling      : false,
                confirmButtonClass  : "btn btn-primary",
                cancelButtonClass   : "btn btn-danger mr-3",

                showCancelButton    : true,
                confirmButtonText   : 'Ya',
                confirmButtonColor  : '#3085d6',
                cancelButtonColor   : '#d33',
                cancelButtonText    : 'Batal',
                reverseButtons      : true,

                allowOutsideClick   : false
            }).then((result) => {
                if (result.value) {
                    
                    $.ajax({
                        url         : "<?= base_url() ?>mop/simpan_prod_as",
                        type      : "POST",
                        beforeSend  : function () {
                            swal({
                                title   : 'Menunggu',
                                html    : 'Memproses Data',
                                onOpen  : () => {
                                    swal.showLoading();
                                },
                                allowOutsideClick   : false
                            })
                        },
                        data        : form,
                        dataType    : "JSON",
                        success     : function (data) {

                            if (data.status == 'gagal') {

                                swal({
                                    title               : "Peringatan",
                                    text                : 'Data yang diinput sudah ada, harap ganti!',
                                    buttonsStyling      : false,
                                    confirmButtonClass  : "btn btn-primary",
                                    type                : 'warning',
                                    showConfirmButton   : true,
                                    allowOutsideClick   : false
                                });

                                return false;
                            }

                            $('#modal_prod_as').modal('hide');

                            swal({
                                title               : "Berhasil",
                                text                : 'Data berhasil disimpan',
                                buttonsStyling      : false,
                                confirmButtonClass  : "btn btn-success",
                                type                : 'success',
                                showConfirmButton   : false,
                                timer               : 3000,
                                allowOutsideClick   : false
                            });    

                            tabel_prod_as.ajax.reload(null,false);   
                            
                            
                        },
                        error       : function(xhr, status, error) {

                            swal({
                                title               : 'Gagal',
                                text                : 'Simpan data tidak berhasil',
                                buttonsStyling      : false,
                                confirmButtonClass  : "btn btn-success",
                                type                : 'error',
                                showConfirmButton   : false,
                                timer               : 3000
                            }); 
                            
                            return false;
                        }

                    })

                    return false;

                } else if (result.dismiss === swal.DismissReason.cancel) {
                    swal.close();
                }
            })

            return false;

        })

        // 01-09-2021
        $('#tabel_prod_as').on('click', '.edit', function () {

            var id_prod_as  = $(this).data('id');
            var id_lob      = $(this).attr('id_lob');
            var premi       = $(this).attr('premi');

            $('#aksi_prod_as').val('Ubah');
            $('#id_prod_as').val(id_prod_as);
            $('#id_lob').val(id_lob).trigger('change');  
            $('#premi').val(premi);  

            $('#form_prod_as').parsley().reset();

            $('#modal_prod_as').modal('show');
            
        })

        $('#tabel_prod_as').on('click', '.hapus', function () {

            var id_prod_as  = $(this).data('id');

            swal({
                title       : 'Konfirmasi',
                text        : 'Yakin akan hapus data?',
                type        : 'warning',

                buttonsStyling      : false,
                confirmButtonClass  : "btn btn-danger",
                cancelButtonClass   : "btn btn-primary mr-3",

                showCancelButton    : true,
                confirmButtonText   : 'Hapus',
                confirmButtonColor  : '#d33',
                cancelButtonColor   : '#3085d6',
                cancelButtonText    : 'Batal',
                reverseButtons      : true,

                allowOutsideClick   : false
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        url         : "<?= base_url() ?>mop/simpan_prod_as",
                        type      : "POST",
                        beforeSend  : function () {
                            swal({
                                title   : 'Menunggu',
                                html    : 'Memproses Data',
                                onOpen  : () => {
                                    swal.showLoading();
                                },
                                allowOutsideClick   : false
                            })
                        },
                        data        : {aksi:'Hapus', id_produk_asuransi:id_prod_as},
                        dataType    : "JSON",
                        success     : function (data) {

                            swal({
                                title               : "Berhasil",
                                text                : 'Data berhasil dihapus',
                                buttonsStyling      : false,
                                confirmButtonClass  : "btn btn-success",
                                type                : 'success',
                                showConfirmButton   : false,
                                timer               : 3000,
                                allowOutsideClick   : false
                            });    

                            tabel_prod_as.ajax.reload(null,false);   
                            
                        },
                        error       : function(xhr, status, error) {

                            swal({
                                title               : 'Gagal',
                                text                : 'Hapus data tidak berhasil',
                                buttonsStyling      : false,
                                confirmButtonClass  : "btn btn-success",
                                type                : 'error',
                                showConfirmButton   : false,
                                timer               : 3000
                            }); 
                            
                            return false;
                        }

                    })

                    return false;
                } else if (result.dismiss === swal.DismissReason.cancel) {

                    swal.close();
                }
            })

            return false;
            
        })
        
    })
</script>