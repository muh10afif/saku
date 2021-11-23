<script>

    // var sig = $('#sig').signature({syncField: '#signature64', syncFormat: 'PNG'});
    // $('#clear_ttd').click(function(e) {
    //     e.preventDefault();
    //     sig.signature('clear');
    //     $("#signature64").val('');
    // });
    $(document).ready(function () {

        // initiate jq-signature
        $('.js-signature').jqSignature({
            autoFit: true, // allow responsive
            height: 182, // set height
            border: '1px solid #a0a0a0', // set widget border
        });
        
        // create hook for clear button
        $('#clearBtn').on('click', function() {
            $('.js-signature').jqSignature('clearCanvas');
            $("#signature64").val(''); // clear the textarea as well
        });

        // update the generated encoded image in the textarea
        $('.js-signature').on('jq.signature.changed', function() {
            var data = $('.js-signature').jqSignature('getDataURL');
            $("#signature64").val(data);
        });

        
        // make_base();

       

        function make_base()
        {
            var canvas = document.getElementById('jq-signature-canvas-1');
            var context = canvas.getContext('2d');

            base_image = new Image();
            base_image.src = "<?= base_url('upload/616e7d305bd3c1634630960.png') ?>";
            base_image.onload = function(){
                context.drawImage(base_image, 0, 0);
            }
        }

        $('.tab_detail_claim').on('click', function () {

            $('#jq-signature-canvas-1').css('width', '270px')
            $('#jq-signature-canvas-1').attr('width', '270')

            // var aksi     = $('#aksi').val();

            // if (aksi == 'ubah') {
            //     var ttd     = $('#ttd').val();
            //     var id_user = "<?= $id_user ?>";

            //     var canvas = document.getElementById('jq-signature-canvas-1');
            //     var context = canvas.getContext('2d');

            //     base_image = new Image();
            //     base_image.src = "<?= $url_img ?>"+ttd;
            //     // base_image.src = "https://api.syariahasuransiku.app/static/dokumen_klaim/user_"+id_user+"/"+ttd;
            //     base_image.onload = function(){
            //         context.drawImage(base_image, 0, 0);
            //     }    
            // }

            // make_base();
        })

        // 25-10-2021
        $('.tab_dokumen').on('click', function () {

            var id_manfaat  = $('#id_manfaat').val();
            var aksi        = $('#aksi').val();

            if (aksi == 'ubah') {
                $('#id_manfaat').val(id_manfaat).trigger('change');            
            }

        })
        

        $('#simpan_form').on('click', function () {

            var signed = $('#signature64').val();

            $.ajax({
                url         : "<?= base_url() ?>entry_claim/coba_simpan_sg",
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
                data    : {signed:signed},
                dataType: "JSON",
                success : function (data) {

                    swal.close();
                    
                },
                error   : function (jqXHR, textStatus, errorThrown) {

                    swal({
                        title               : "Gagal",
                        text                : 'Gagal proses data',
                        type                : 'error',
                        showConfirmButton   : false,
                        timer               : 3000,
                        allowOutsideClick   : false
                    }); 

                    return false;
                    
                }
            })
            
        })

        // 15-10-2021
        $('.image-popup-no-margins').magnificPopup({
            type: 'image',
            closeOnContentClick: true,
            closeBtnInside: false,
            fixedContentPos: true,
            mainClass: 'mfp-no-margins mfp-with-zoom', // class to remove default margin from left and right side
            image: {
                verticalFit: true
            },
            zoom: {
                enabled: true,
                duration: 200 // don't foget to change the duration also in CSS
            }
        });

        $('.zoom-gallery').magnificPopup({
            delegate: 'a',
            type: 'image',
            closeOnContentClick: false,
            closeBtnInside: false,
            mainClass: 'mfp-with-zoom mfp-img-mobile',
            image: {
                verticalFit: true,
                titleSrc: function(item) {
                    // return item.el.attr('title') + ' &middot; <a href="'+item.el.attr('data-source')+'" target="_blank">image source</a>';
                    return item.el.attr('title');
                }
            },
            gallery: {
                enabled: true
            },
            zoom: {
                enabled: true,
                duration: 300, // don't foget to change the duration also in CSS
                opener: function(element) {
                    return element.find('img');
                }
            }
        });


        // 27-09-2021
        var tabel_klaim = $('#tabel_klaim').DataTable({
            "processing"        : true,
            "serverSide"        : true,
            "order"             : [],
            "ajax"              : {
                "url"   : "<?= base_url() ?>entry_claim/tampil_data_entry",
                "type"  : "POST",
                "data"  : function (data) {
                    data.read               = "<?= $role['read'] ?>";
                    data.create             = "<?= $role['create'] ?>";
                    data.update             = "<?= $role['update'] ?>";
                    data.delete             = "<?= $role['delete'] ?>";
                    data.id_user            = "<?= $id_user ?>";
                    data.id_lvl_otorisasi   = "<?= $id_lvl_otorisasi ?>";
                    data.status_klaim       = $('#tab_status_klaim').val();
                }
            },
            "columnDefs"        : [{
                "targets"   : [0,6],
                "orderable" : false
            }, {
                'targets'   : [0,5,6],
                'className' : 'text-center',
            }]
        })

        $('.t_status_klaim').on('click', function () {

            var status = $(this).attr('status');

            $('#tab_status_klaim').val(status);

            tabel_klaim.ajax.reload(null, false);

        })

        // 14-10-2021
        $('#tabel_klaim').on('click', '.detail', function () {

            var id_data_klaim = $(this).data('id');

            window.location.href = "<?= base_url() ?>entry_claim/detail_klaim/"+id_data_klaim;
            
        })


        // 28-09-2021
        $('#nomor_polis').on('change', function () {

            var id_sppa = $(this).val();

            if (id_sppa == '') {

                $('#id_pengguna_tertanggung').val('');
                $('#nama_asuransi').val('');
                $('#kode_cob').val('');
                $('#cob').val('');
                $('#kode_lob').val('');
                $('#lob').val('');
                $('#id_manfaat').html("<option value=''>Pilih Manfaat</option>");

                $('#detail_polis').attr('disabled', true);
                $('#detail_insured').attr('disabled', true);

                $('.t_tertanggung').text(": -");
                
                return false;
            }

            $.ajax({
                url         : "<?= base_url() ?>entry_claim/get_detail_polis",
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
                data    : {id_sppa:id_sppa},
                dataType: "JSON",
                success : function (data) {

                    swal.close();

                    $('#id_pengguna_tertanggung').val(data.list.id_pengguna_tertanggung);
                    $('#nama_asuransi').val(data.list.nama_asuransi);
                    $('#kode_cob').val(data.list.kode_cob);
                    $('#cob').val(data.list.cob);
                    $('#kode_lob').val(data.list.kode_lob);
                    $('#lob').val(data.list.lob);
                    $('#id_manfaat').html(data.option);

                    $('#detail_polis').attr('disabled', false);
                    $('#detail_insured').attr('disabled', false);

                    $('#t_no_polis').text(': '+data.list.no_polis);
                    $('.t_tertanggung').text(': '+data.list.nama);
                    $('#t_tgl_awal_polis').text(': '+data.tgl_awal_polis);
                    $('#t_tgl_akhir_polis').text(': '+data.tgl_akhir_polis);
                    $('#t_premi').text(': '+data.premi);
                    
                },
                error   : function (jqXHR, textStatus, errorThrown) {

                    swal({
                        title               : "Gagal",
                        text                : 'Gagal proses data',
                        type                : 'error',
                        showConfirmButton   : false,
                        timer               : 3000,
                        allowOutsideClick   : false
                    }); 

                    return false;
                    
                }
            })
            
        })

        $('#detail_polis').on('click', function () {

            $('#modal_detail_polis').modal('show');

        })

        // 21-10-2021
        $('#id_manfaat').on('change', function () {

            var id_manfaat  = $(this).val();
            var manfaat     = $(this).find(':selected').text();
            var aksi        = $('#aksi').val();

            if (id_manfaat == '') {
                $('.input_dokumen').fadeOut();
                return false;
            }

            if(manfaat.indexOf("sakit") >= 0){
                // kondisi ada
                var jenis = $('.input_dokumen').attr('jenis');

                $('.input_dokumen').each(function(i, obj) {
                    var jenis = $(this).attr('jenis');
                    var count = $(this).attr('count');

                    if (jenis == 'sakit') {
                        $(this).fadeIn();
                        if (aksi == 'ubah') {
                            $('#image'+count).removeAttr('required');
                        }
                    } else {
                        $(this).fadeOut();
                        $('#image'+count).removeAttr('required');
                    }
                });
                
            } else {
                
                $('.input_dokumen').fadeIn();
                
                $('.input_dokumen').each(function(i, obj) {
                    var count   = $(this).attr('count');
                    var isi     = $(this).attr('isi');

                    if (isi == 'ada') {
                        $('#image'+count).removeAttr('required');
                    } else {
                        $('#image'+count).attr('required', true);  
                    }

                });

            }
            
        })

        // 21-10-2021
        function readURL(input, imgControlName) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                $(imgControlName).attr('src', e.target.result);
                }
                reader.readAsDataURL(input.files[0]);
            }
        }

        for (let i = 1; i <= 6; i++) {

            $("#image"+i).change(function() {
                // add your logic to decide which image control you'll use
                var imgControlName = "#ImgPreview"+i;
                readURL(this, imgControlName);
                // $('.preview1').addClass('it');
                $('.card-img'+i).slideDown('fast');
                $('.btn-rmv'+i).addClass('rmv');
            });

            $("#removeImage"+i).click(function(e) {
                e.preventDefault();
                $("#image"+i).val("");
                $("#ImgPreview"+i).attr("src", "");
                // $('.preview1').removeClass('it');
                $('.btn-rmv'+i).removeClass('rmv');
                $('.card-img'+i).slideUp('fast');
            });
           
        }
        

        // 29-09-2021
        $('#detail_insured').on('click', function () {

            var id_pengguna_ptg = $('#id_pengguna_tertanggung').val();

            $.ajax({
                url         : "<?= base_url() ?>entry_claim/get_detail_pengguna_ptg",
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
                data        : {id_pengguna_ptg:id_pengguna_ptg},
                dataType    : "JSON",
                success     : function (data) {

                    swal.close();

                    $('#t_nik').html(": "+data.list.nik);
                    $('#t_nama').html(": "+data.list.nama);
                    $('#t_tempat_lahir').html(": "+data.list.tempat_lahir);
                    $('#t_tgl_lahir').html(": "+data.tgl_lahir);
                    $('#t_jenis_kelamin').html((data.list.jenis_kelamin == 't') ? ': Laki-laki' : ': Perempuan');
                    $('#t_alamat').html(": "+data.list.alamat);
                    $('#t_hp').html(": "+data.list.telp);
                    $('#t_pekerjaan').html(": "+data.list.pekerjaan);
                    $('#t_email').html(": "+data.list.email);

                    $('#modal_detail_ptg').modal('show');
                    
                },
                error   : function (jqXHR, textStatus, errorThrown) {

                    swal({
                        title               : "Gagal",
                        text                : 'Gagal proses data',
                        type                : 'error',
                        showConfirmButton   : false,
                        timer               : 3000,
                        allowOutsideClick   : false
                    }); 

                    return false;
                    
                }
            })
            
        })

        $('#form_klaim').parsley({
            errorsContainer: function(el) {
                return el.$element.closest('.form2');
            }
        });

        $("#nomor_polis").change(function() {
            $(this).trigger('input')
        });
        $("#id_manfaat").change(function() {
            $(this).trigger('input')
        });
        $("#bank").change(function() {
            $(this).trigger('input')
        });

        // 21-10-2021
        $('#form_klaim').on('submit', function () {

            var form_klaim = new FormData(this);

            var signed  = $('#signature64').val();
            var aksi    = $('#aksi').val();

            swal({
                title       : 'Konfirmasi',
                text        : 'Yakin akan simpan data',
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

                    var url = "";

                    if (aksi == 'ubah') {
                        url = "<?= base_url() ?>entry_claim/simpan_ubah_claim";
                    } else if (aksi == 'ajukan_kembali') {
                        url = "<?= base_url() ?>entry_claim/simpan_ajukan_kembali_claim";
                    } else {
                        url = "<?= base_url() ?>entry_claim/simpan_claim";
                    }
                    
                    $.ajax({
                        url     : url,
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
                        data            : form_klaim,
                        contentType     : false,
                        cache           : false,
                        processData     : false,
                        dataType: "JSON",
                        success : function (data) {

                            if (data.status == 'upload_gagal') {

                                swal({
                                    title               : "Peringatan",
                                    text                : 'Upload file gagal!',
                                    buttonsStyling      : false,
                                    confirmButtonClass  : "btn btn-primary",
                                    type                : 'warning',
                                    showConfirmButton   : true,
                                    allowOutsideClick   : false
                                });
                                
                                return false;
                            }
                            if (data.status == 'tipe_salah') {

                                swal({
                                    title               : "Peringatan",
                                    text                : 'Harap upload tipe image jpg atau png!',
                                    buttonsStyling      : false,
                                    confirmButtonClass  : "btn btn-primary",
                                    type                : 'warning',
                                    showConfirmButton   : true,
                                    allowOutsideClick   : false
                                });
                                
                                return false;
                            }

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
                            
                            swal({
                                title               : "Berhasil",
                                text                : 'Data berhasil disimpan',
                                buttonsStyling      : false,
                                confirmButtonClass  : "btn btn-success",
                                type                : 'success',
                                showConfirmButton   : false,
                                timer               : 3000,
                                allowOutsideClick   : false
                            }).then(function() {
                                location.href = "<?= base_url() ?>entry_claim";
                            });    

                        }
                    })
            
                    return false;

                } else if (result.dismiss === swal.DismissReason.cancel) {
                    swal.close();
                }
            })

            return false;
            
        })

        // 25-10-2021
        $('#tabel_klaim').on('click', '.edit', function () {

            var id_data_klaim   = $(this).data('id');
            var aksi            = $(this).attr('aksi');

            window.location.href = "<?= base_url() ?>entry_claim/ubah_klaim/"+id_data_klaim+"/"+aksi;

        })

        // 25-10-2021
        $('#tabel_klaim').on('click', '.hapus', function () {

            var id_data_klaim = $(this).data('id');

            swal({
                title       : 'Konfirmasi',
                text        : 'Yakin akan hapus data?',
                type        : 'warning',

                buttonsStyling      : false,
                confirmButtonClass  : "btn btn-danger",
                cancelButtonClass   : "btn btn-primary mr-3",

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
                        url     : "<?= base_url() ?>entry_claim/hapus_klaim",
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
                        data    : {id_data_klaim:id_data_klaim},
                        dataType: "JSON",
                        success : function (data) {

                            tabel_klaim.ajax.reload(null, false);
                            
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

                        }
                    })
            
                    return false;

                } else if (result.dismiss === swal.DismissReason.cancel) {
                    swal.close();
                }
            })

            return false;

        })

        // 26-10-2021
        $('#tabel_klaim').on('click', '.ubah_status_klaim', function () {

            var id_data_klaim   = $(this).attr('id_data_klaim');
            var no_polis        = $(this).attr('no_polis');
            var nama_nasabah    = $(this).attr('nama_nasabah');
            var status_klaim    = $(this).attr('status_klaim');
            var alasan_tolak    = $(this).attr('alasan_tolak');
            var nilai_ptg       = $(this).attr('nilai_ptg');

            $('#id_data_klaim').val(id_data_klaim);
            $('#nilai_ptg').val(nilai_ptg);
            $('#t_no_polis').text(": "+no_polis);
            $('#t_nama_nasabah').text(": "+nama_nasabah);
            $('#status_klaim').val(status_klaim).trigger('change');
           
            if (status_klaim == 3) {
                $('.alasan_tolak').fadeIn();
                $('#alasan_tolak').val(alasan_tolak);
            } else {
                $('.alasan_tolak').fadeOut();
                $('#alasan_tolak').val('');
            }

            $('#modal_status').modal('show');
            
        })

        // 26-10-2021
        $('#status_klaim').on('change', function () {

            var status_klaim = $(this).val();

            if (status_klaim == 3) {
                $('.alasan_tolak').slideDown('fast');
                $('#alasan_tolak').val('');
            } else {
                $('.alasan_tolak').slideUp('fast');
                $('#alasan_tolak').val('');
            }

        })

        // 26-10-2021
        $('#simpan_status').on('click', function () {

            var id_data_klaim   = $('#id_data_klaim').val();
            var status_klaim    = $('#status_klaim').val();
            var alasan_tolak    = $('#alasan_tolak').val();
            var nilai_ptg       = $('#nilai_ptg').val();

            if (status_klaim == 3) {
                if (alasan_tolak == '') {

                    swal({
                        title               : "Peringatan",
                        text                : 'Alasan Ditolak harus diisi!',
                        buttonsStyling      : false,
                        confirmButtonClass  : "btn btn-warning",
                        type                : 'warning',
                        showConfirmButton   : true,
                        allowOutsideClick   : false
                    });  
                    
                    return false;
                }
            }

            swal({
                    title       : 'Konfirmasi',
                    text        : 'Yakin akan ubah status klaim?',
                    type        : 'warning',

                    buttonsStyling      : false,
                    confirmButtonClass  : "btn btn-primary",
                    cancelButtonClass   : "btn btn-secondary mr-3",

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

                            url         : "<?= base_url() ?>entry_claim/ubah_status_klaim",
                            type        : "POST",
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
                            data        : {
                                status_klaim    : status_klaim, 
                                id_data_klaim   : id_data_klaim,
                                alasan_tolak    : alasan_tolak,
                                nilai_ptg       : nilai_ptg
                            
                            },
                            dataType    : "JSON",
                            success     : function (data) {

                                $('#modal_status').modal('hide');

                                swal({
                                    title               : "Berhasil",
                                    text                : 'Status klaim berhasil diubah',
                                    buttonsStyling      : false,
                                    confirmButtonClass  : "btn btn-success",
                                    type                : 'success',
                                    showConfirmButton   : false,
                                    timer               : 3000,
                                    allowOutsideClick   : false
                                });    

                
                                tabel_klaim.ajax.reload(null,false);
                                
                            },
                            error       : function(xhr, status, error) {

                                swal({
                                    title               : 'Gagal',
                                    text                : 'Ubah status klaim tidak berhasil',
                                    buttonsStyling      : false,
                                    confirmButtonClass  : "btn btn-success",
                                    type                : 'error',
                                    showConfirmButton   : false,
                                    timer               : 3000
                                }); 
                                
                                return false;
                            }

                        })
                    } else if (result.dismiss === swal.DismissReason.cancel) {

                        swal.close();

                    }
                    
                })

        })
        
        
    })
</script>