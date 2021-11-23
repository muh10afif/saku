

<script>

    $(document).ready(function () { 

        // 08-06-2021
        $('.grafik').on('click', function () {

            $.ajax({
                url     : "<?= base_url() ?>penilaian/get_halaman_grafik",
                success : function (data) {

                    $('.isi_grafik').html(data);

                    var sts2 = $('#status_toggle2').val();

                    $('html, body').animate({
                        scrollTop: $('body').offset().top
                    }, 800);

                    if (sts2 == 0) {
                        $('.f_grafik').slideToggle('fast', function() {
                            if ($(this).is(':visible')) {
                                $('#status_toggle2').val(1);          
                            } else {  
                                $('#status_toggle2').val(0);            
                            }        
                        });  
                    }

                    var sts = $('#status_toggle').val();

                    if (sts == 1) {
                        $('.f_nilai').slideToggle('fast', function() {
                            if ($(this).is(':visible')) {
                                $('#status_toggle').val(1);          
                            } else {  
                                $('#status_toggle').val(0);            
                            }        
                        });  
                    }

                }
            })
    
            return false;
            
        })

        function number_format(number, decimals, dec_point, thousands_point) {

            if (number == null || !isFinite(number)) {
                throw new TypeError("number is not valid");
            }

            if (!decimals) {
                var len = number.toString().split('.').length;
                decimals = len > 1 ? len : 0;
            }

            if (!dec_point) {
                dec_point = '.';
            }

            if (!thousands_point) {
                thousands_point = ',';
            }

            number = parseFloat(number).toFixed(decimals);

            number = number.replace(".", dec_point);

            var splitNum = number.split(dec_point);
            splitNum[0] = splitNum[0].replace(/\B(?=(\d{3})+(?!\d))/g, thousands_point);
            number = splitNum.join(dec_point);

            return number;
        }

        function number_format2 (number, decimals, dec_point, thousands_sep) {
            number = (number + '').replace(/[^0-9+\-Ee.]/g, '');

            var n = !isFinite(+number) ? 0 : +number,
            prec  = !isFinite(+decimals) ? 0 : Math.abs(decimals),
            sep   = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
            dec   = (typeof dec_point === 'undefined') ? '.' : dec_point,
            s = '',
            toFixedFix = function (n, prec) {
                var k = Math.pow(10, prec);
                return '' + Math.round(n * k) / k;
            };
            s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
            if (s[0].length > 3) {
                s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
            }
            if ((s[1] || '').length < prec) {
                s[1] = s[1] || '';
                s[1] += new Array(prec - s[1].length + 1).join('0');
            }
            return s.join(dec);

        }

        // 08-06-2021
        $('.input_nilai').on('keyup', function () {
            var id_param_scor   = $(this).attr('id_parameter_scoring');
            var nilai_parameter = $(this).attr('nilai_parameter').split('.').join('');
            var bobot           = $(this).attr('bobot');
            var type            = $(this).attr('typenya');
            var value           = $(this).val().split('.').join('');

            if (value == '') {
                value = 0;
            } else {
                value = value;
            }

            var tot = 0;

            if (type == 'max') {

                tot = (value / nilai_parameter) * bobot;
                
                if (parseFloat(value) > parseFloat(nilai_parameter)) {
                    tot = bobot;
                } else {
                    tot = (value / nilai_parameter) * bobot;
                }
            } else {

                if (value == '' || value == 0) {
                    tot = 0;
                } else {
                    tot = (nilai_parameter / value) * bobot;

                    if (parseFloat(value) < parseFloat(nilai_parameter)) { 
                        tot = bobot;
                    } else {
                        tot = (nilai_parameter / value) * bobot;
                    }
                }

            }
 
            $('.hasil_'+id_param_scor).text(number_format(tot,2,'.',','));
            $('.hasil2_'+id_param_scor).val(tot);

            total()
            
        })

        function total() {
            
            var total = 0;
            $('.hasil2').each(function () {

                // var value = $(this).text();
                var value = $(this).val();
                
                total += parseFloat(value);
      
            })

            $('.total').text(number_format(total,2,'.',','))
            // $('.total').text(total+)
        }

        // menampilkan list penilaian
        var tabel_list_penilaian = $('#tabel_master_asuransi').DataTable({
            "processing"        : true,
            "serverSide"        : true,
            "order"             : [],
            "ajax"              : {
                "url"   : "<?= base_url() ?>penilaian/tampil_data_penilaian",
                "type"  : "POST",
                "data"  : function (data) {
                    data.read               = "<?= $role['read'] ?>";
                    data.create             = "<?= $role['create'] ?>";
                    data.update             = "<?= $role['update'] ?>";
                    data.delete             = "<?= $role['delete'] ?>";
                    data.id_user            = "<?= $id_user ?>";
                    data.id_lvl_otorisasi   = "<?= $id_lvl_otorisasi ?>";
                }
            },
            "columnDefs"        : [{
                "targets"   : [0,4,5],
                "orderable" : false
            }, {
                'targets'   : [0,4,5],
                'className' : 'text-center',
            }]
        })

        // aksi simpan data penilaian
        $('#simpan_penilaian').on('click', function () {

            var id_asuransi     = $('#id_asuransi').val();
            var total           = $('.total').text();
            var nilai_input     = [];
            var id_param_scor   = [];
            var hasil           = [];

            $('.input_nilai').each(function() { 
                nilai_input.push($(this).val()); 
                id_param_scor.push($(this).attr('id_parameter_scoring'));
            });

            $('.hasil').each(function() { 
                hasil.push($(this).text()); 
            });

            swal({
                title       : 'Konfirmasi',
                text        : 'Yakin akan kirim data?',
                type        : 'warning',

                buttonsStyling      : false,
                confirmButtonClass  : "btn btn-primary",
                cancelButtonClass   : "btn btn-danger mr-3",

                showCancelButton    : true,
                confirmButtonText   : 'Ya, kirim',
                confirmButtonColor  : '#3085d6',
                cancelButtonColor   : '#d33',
                cancelButtonText    : 'Batal',
                reverseButtons      : true
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        url     : "<?= base_url() ?>penilaian/simpan_data_penilaian",
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
                        data    : {
                            id_asuransi     : id_asuransi,
                            nilai_input     : nilai_input,
                            id_param_scor   : id_param_scor,
                            hasil           : hasil,
                            total           : total
                        },
                        dataType: "JSON",
                        success : function (data) {
                            
                            swal({
                                title               : "Berhasil",
                                text                : 'Data berhasil disimpan',
                                buttonsStyling      : false,
                                confirmButtonClass  : "btn btn-success",
                                type                : 'success',
                                showConfirmButton   : false,
                                timer               : 3000,
                                allowOutsideClick   : false
                            }).then(function () {
                                location.reload();
                            });    
            
                            // tabel_list_penilaian.ajax.reload(null,false);  

                            // $('.f_nilai').slideToggle('fast', function() {
                            //     if ($(this).is(':visible')) {
                            //         $('#status_toggle').val(1);          
                            //     } else {  
                            //         $('#status_toggle').val(0);            
                            //     }        
                            // });

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
            
            
        })

        // aksi batal penilaian
        $('.batal_penilaian').on('click', function () {

            $('.f_nilai').slideToggle('fast', function() {
                if ($(this).is(':visible')) {
                    $('#status_toggle').val(1);          
                } else {  
                    $('#status_toggle').val(0);            
                }        
            });
        })

        $('.batal_grafik').on('click', function () {

            $('.f_grafik').slideToggle('fast', function() {
                if ($(this).is(':visible')) {
                    $('#status_toggle2').val(1);          
                } else {  
                    $('#status_toggle2').val(0);            
                }        
            });
        })

        // nilai
        $('#tabel_master_asuransi').on('click', '.nilai', function () {

            var id_asuransi = $(this).data('id');
            var nama_as     = $(this).attr('nama');

            $('#judul_atas').text("Form Penilaian ~ "+nama_as);

            $('#id_asuransi').val(id_asuransi);

            var sts = $('#status_toggle').val();

            $('html, body').animate({
                scrollTop: $('body').offset().top
            }, 800);

            if (sts == 0) {
                $('.f_nilai').slideToggle('fast', function() {
                    if ($(this).is(':visible')) {
                        $('#status_toggle').val(1);          
                    } else {  
                        $('#status_toggle').val(0);            
                    }        
                });  
            }

            var sts2 = $('#status_toggle2').val();

            if (sts2 == 1) {
                $('.f_grafik').slideToggle('fast', function() {
                    if ($(this).is(':visible')) {
                        $('#status_toggle2').val(1);          
                    } else {  
                        $('#status_toggle2').val(0);            
                    }        
                });  
            }

            $.ajax({
                url     : "<?= base_url() ?>penilaian/get_edit_nilai",
                type    : "POST",
                data    : {id_asuransi:id_asuransi},
                dataType: "JSON",
                success : function (data) {

                    $('.input_nilai').val('');
                    $('.hasil').text(0);
                    $('.hasil2').val(0);
                    $('.total').text(0);

                    if (data.list.length != 0) {
                        $.each(data.list, function(key, value) {

                            $('.input_'+value.id_parameter_scoring).val(value.input);
                            // $('.hasil_'+value.id_parameter_scoring).text(value.hasil);

                            hitung_semua(value.id_parameter_scoring, value.nilai_parameter, value.bobot, value.type, value.input);
                            
                        }); 

                        // $('.total').text(data.score);
                    }

                    

                }
            })
    
            return false;
            
        })

        // 21-07-2021
        function hitung_semua(id_param_scor, nilai_parameter, bobot, type, value) {
            // var id_param_scor   = $(this).attr('id_parameter_scoring');
            // var nilai_parameter = $(this).attr('nilai_parameter').split('.').join('');
            // var bobot           = $(this).attr('bobot');
            // var type            = $(this).attr('typenya');
            // var value           = $(this).val().split('.').join('');

            if (value == '') {
                value = 0;
            } else {
                value = value;
            }

            var tot = 0;

            if (type == 'max') {

                tot = (value / nilai_parameter) * bobot;
                
                if (parseFloat(value) > parseFloat(nilai_parameter)) {
                    tot = bobot;
                } else {
                    tot = (value / nilai_parameter) * bobot;
                }
            } else {

                tot = (nilai_parameter / value) * bobot;

                if (parseFloat(value) < parseFloat(nilai_parameter)) { 
                    tot = bobot;
                } else {
                    tot = (nilai_parameter / value) * bobot;
                }

            }
 
            $('.hasil_'+id_param_scor).text(number_format(tot,2,'.',','));
            $('.hasil2_'+id_param_scor).val(tot);

            total();

            return true;
            
        }
    })

</script>