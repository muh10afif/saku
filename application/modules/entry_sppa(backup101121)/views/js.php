<script>
    $(document).ready(function () {

        // 22-09-2021
        $('#id_insurer').on('change', function () {

            var id_asuransi = $(this).val();

            if (id_asuransi == '') {
                $('#premi').html("<option value=''>Pilih Premi</option>");
                $('#id_lob').html("<option value=''>Pilih Produk</option>");

                $('#id_lob').attr('disabled', true);
                $('#premi').attr('disabled', true);

                return false;
            }

            $.ajax({
                url     : "<?= base_url('entry_sppa/get_produk_asuransi') ?>",
                method  : "POST",
                data    : {id_asuransi:id_asuransi},
                dataType: "JSON",
                success : function (data) {

                    $('#id_lob').attr('disabled', false);
                    $('#id_lob').html(data.option);
                
                },
                error: function (jqXHR, textStatus, errorThrown)
                {
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

        // 22-09-2021
        $('#id_lob').on('change', function () {

            var id_lob      = $(this).val();
            var id_asuransi = $('#id_insurer').val();

            $('#txt_produk').text('');

            var t_lob = $(this).find(":selected").text();

            if (id_lob != '') {
                $('#txt_produk').text(t_lob);
            }

            $.ajax({
                url     : "<?= base_url('entry_sppa/get_premi') ?>",
                method  : "POST",
                data    : {id_lob:id_lob, id_asuransi:id_asuransi},
                dataType: "JSON",
                success : function (data) {

                    if (data.sts_aw == 't') {
                        $('.f_ahli_waris').fadeIn('fast');
                    } else {
                        $('.f_ahli_waris').fadeOut('fast');
                    }
                    
                    $('#premi').attr('disabled', false);
                    $('#premi').html(data.option);
                
                },
                error: function (jqXHR, textStatus, errorThrown)
                {
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

        // 23-09-2021
        $('#premi').on('change', function () {

            var isi = $(this).find(':selected').text();

            $('#txt_premi').text(isi);
            $('#txt_total').text(isi);
            
        });

        // 22-09-2021
        $('#id_pengguna_tertanggung').on('change', function () {

            var id_pengguna_ttg  = $(this).val();

            if (id_pengguna_ttg == '') {
                $('.detail_pengguna_ttg').slideUp('fast');
                return false;
            }

            $('.detail_pengguna_ttg').slideUp(500);

            $.ajax({
                url     : "<?= base_url('entry_sppa/detail_pengguna_ttg') ?>",
                method  : "POST",
                data    : {id_pengguna_ttg:id_pengguna_ttg},
                dataType: "JSON",
                success : function (data) {

                    var nik             = data.row.nik;
                    var tempat_lahir    = data.row.tempat_lahir;
                    var tgl_lahir       = data.row.tgl_lahir;
                    var jenis_kelamin   = data.row.jenis_kelamin;
                    var alamat          = data.row.alamat;
                    var pekerjaan       = data.row.id_pekerjaan;

                    if (nik != null && tempat_lahir != null && tgl_lahir != null && jenis_kelamin != null && alamat != null && pekerjaan != null) {
                        $('.detail_ptg').fadeOut('fast');
                        $('.detail_ptg_det').slideDown('fast');

                        $('#nik').val(data.row.nik);
                        $('#t_nik').text(": "+data.row.nik);
                        $('#t_nama').text(": "+data.row.nama);
                        $('#t_tempat_lahir').text(": "+data.row.tempat_lahir);
                        $('#t_tgl_lahir').text(": "+data.tgl_lahir);
                        $('#t_jenis_kelamin').text((data.row.jenis_kelamin == 't') ? ': Laki-laki' : ': Perempuan');
                        $('#t_alamat').text(": "+data.row.alamat);
                        $('#t_telp').text(": "+data.row.telp);
                        $('#t_pekerjaan').text(": "+data.row.pekerjaan);
                        $('#t_email').text(": "+data.row.email);

                        $('#aksi_ptg').val('lengkap');

                    } else {
                        $('.detail_ptg_det').fadeOut('fast');
                        $('.detail_ptg').slideDown('fast');

                        $("input[name='nik_ptg']").val((data.row.nik == null) ? null : data.row.nik);
                        $("input[name='nama_ptg']").val((data.row.nama == null) ? null : data.row.nama);
                        $("input[name='tempat_lahir_ptg']").val((data.row.tempat_lahir == null) ? null : data.row.tempat_lahir);
                        $("input[name='tgl_lahir_ptg']").val((data.row.tgl_lahir == null) ? null : data.tgl_lahir_dmy);

                        if (data.row.jenis_kelamin != null) {
                            if (data.row.jenis_kelamin == 't') {
                                $("#jenis_klm_ptg_1").prop("checked", true);
                            } else {
                                $("#jenis_klm_ptg_2").prop("checked", true);
                            }
                        }
                        
                        $("textarea[name='alamat_ptg']").val((data.row.alamat == null) ? null : data.row.alamat);
                        $("input[name='telp_ptg']").val((data.row.telp == null) ? null : data.row.telp);
                        $("input[name='pekerjaan_ptg']").val((data.row.id_pekerjaan == null) ? null : data.row.id_pekerjaan).trigger('change');
                        $("input[name='email_ptg']").val((data.row.email == null) ? null : data.row.email);

                        $('#aksi_ptg').val('lengkapi');
                    }
                    
                    $('.detail_pengguna_ttg').slideDown('fast');
                
                },
                error: function (jqXHR, textStatus, errorThrown)
                {
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

        // 23-09-2021
        $('.status_kk').on('change', function () {

            var isi       = $(this).val();
            var status_kk = $(this).attr('status_kk');

            if (isi == 0) {
                $('#alamat_'+status_kk).fadeIn('fast');
                $('#alamat_'+status_kk).attr('required', true);
            } else {
                $('#alamat_'+status_kk).fadeOut('fast');
                $('#alamat_'+status_kk).attr('required', false);
            }

            $.ajax({
                url     : "<?= base_url('entry_sppa/get_hubungan_klg') ?>",
                method  : "POST",
                data    : {sts_kk:isi},
                dataType: "JSON",
                success : function (data) {

                    $('#alamat_'+status_kk).attr('required', false);
                    $('#id_hubungan_klg_aw_'+status_kk).html(data.option);
                    
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

            return false;

        })

        $('.nik_aw').on('change', function () {

            var nik_aw_1 = $('#nik_aw_1').val();
            var nik_aw_2 = $('#nik_aw_2').val();
            var nik_ttg  = $('#nik').val();

            if (nik_ttg != '') {
               $.ajax({
                    url     : "<?= base_url('entry_sppa/cek_nik') ?>",
                    method  : "POST",
                    data    : {nik_aw_1:nik_aw_1, nik_aw_2:nik_aw_2, nik_ttg:nik_ttg},
                    dataType: "JSON",
                    success : function (data) {

                        if (data.status != '') {
                            swal({
                                title               : "Peringatan",
                                text                : data.status,
                                type                : 'warning',
                                showConfirmButton   : true,
                                buttonsStyling      : false,
                                confirmButtonClass  : "btn btn-primary",
                                allowOutsideClick   : false
                            });   

                            $('#simpan_entry').attr('disabled', true);
                        } else {
                            $('#simpan_entry').attr('disabled', false);
                        }

                        return false;
                        
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
            }
            
            return false;
            
        })
        
        $('.nik_aw').keyup( function(e){
            var max_chars = 16;

            if ($(this).val().length >= max_chars) { 
                $(this).val($(this).val().substr(0, max_chars));
            }
        });

        // 24-09-2021
        $('#form_entry').parsley();

        $("#id_insurer").change(function() {
            $(this).trigger('input')
        });
        $("#id_lob").change(function() {
            $(this).trigger('input')
        });
        $("#premi").change(function() {
            $(this).trigger('input')
        });
        $("#id_pengguna_tertanggung").change(function() {
            $(this).trigger('input')
        });
        $(".id_hubungan_klg_aw").change(function() {
            $(this).trigger('input')
        });

        $('#form_entry').on('submit', function () {

            var form_entry  = $('#form_entry').serialize();
            var payment     = $("input[name='pilihan_payment']").val();

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

                    if (payment == '3' || payment == '4') {

                        $.ajax({
                            url     : '<?= base_url('entry_sppa/simpan_entry')?>',
                            method  : "POST",
                            data    : form_entry,
                            dataType: "JSON",
                            success: function(data) {
                                
                            }
                        });         
                                
                    }

                    $.ajax({
                        url     : '<?= base_url('entry_sppa/simpan_entry')?>',
                        method  : "POST",
                        cache   : false,
                        data    : form_entry,
                        success: function(data) {
                            //location = data;
                            
                            var resultType = document.getElementById('result-type');
                            var resultData = document.getElementById('result-data');

                            function changeResult(type,data){
                            $("#result-type").val(type);
                            $("#result-data").val(JSON.stringify(data));
                            //resultType.innerHTML = type;
                            //resultData.innerHTML = JSON.stringify(data);
                            }

                            snap.pay(data, {
                            
                                onSuccess: function(result){
                                    changeResult('success', result);
                                    console.log(result.status_message);
                                    console.log(result);
                                    window.location.href = "<?= base_url('entry_sppa') ?>";
                                },
                                onPending: function(result){
                                    changeResult('pending', result);
                                    console.log(result.status_message);
                                    window.location.href = "<?= base_url('entry_sppa') ?>";
                                },
                                onError: function(result){
                                    changeResult('error', result);
                                    console.log(result.status_message);
                                    window.location.href = "<?= base_url('entry_sppa') ?>";
                                }
                            });
                        }
                    });
                    
                    
                    // $.ajax({
                    //     url     : "<?= base_url() ?>entry_sppa/simpan_entry",
                    //     type    : "POST",
                    //     beforeSend  : function () {
                    //         swal({
                    //             title   : 'Menunggu',
                    //             html    : 'Memproses Data',
                    //             onOpen  : () => {
                    //                 swal.showLoading();
                    //             },
                    //             allowOutsideClick   : false
                    //         })
                    //     },
                    //     data    : form_entry,
                    //     dataType: "JSON",
                    //     success : function (data) {
                            
                    //         swal({
                    //             title               : "Berhasil",
                    //             text                : 'Data berhasil disimpan',
                    //             buttonsStyling      : false,
                    //             confirmButtonClass  : "btn btn-success",
                    //             type                : 'success',
                    //             showConfirmButton   : false,
                    //             timer               : 3000,
                    //             allowOutsideClick   : false
                    //         });    

                    //         window.location.href = "<?= base_url('entry_sppa') ?>";

                    //         return false;
                    //     }, 
                    //     error   : function (jqXHR, textStatus, errorThrown) {

                    //         swal({
                    //             title               : "Gagal",
                    //             text                : 'Gagal proses data',
                    //             type                : 'error',
                    //             showConfirmButton   : false,
                    //             timer               : 3000,
                    //             allowOutsideClick   : false
                    //         }); 

                    //         return false;
                            
                    //     }
                    // })
            
                    return false;

                } else if (result.dismiss === swal.DismissReason.cancel) {
                    swal.close();
                }
            })

            return false;

        })

        // 27-09-2021

    })

    function set_no_reff(id_insured) {
        
        if (id_insured) {
            
            $.ajax({
                url     : "<?= base_url() ?>entry_sppa/get_list_mop",
                method  : "POST",
                data    : {id_insured:id_insured},
                dataType: "JSON",
                success : function (data) {

                    var option = "<option value=''>Pilih</option>";
                    data.forEach(function (item) {
                        option += "<option value='"+item.id_mop+"'>"+item.no_reff_mop+" - "+item.nama_mop+"</option>";
                    })
                    
                    $('#no_reff_mop').html(option);

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

        } else {

            $('#no_reff_mop').html("<option value=''>Pilih</option>");

            $('.det_mop').slideUp();
            $('#t_no_mop').text(': -');
            $('#t_asuransi').text(': -');
            $('#t_cob').text(': -');
            $('#t_lob').text(': -');
            
        }
        
    }

    function get_detail_mop(id_mop) {

        if (id_mop) {
            
            $.ajax({
                url     : "<?= base_url() ?>entry_sppa/get_detail_mop",
                method  : "POST",
                data    : {id_mop:id_mop},
                dataType: "JSON",
                success : function (data) {

                    $('.det_mop').slideDown();
                    $('#t_no_mop').text(": "+data.no_mop);
                    $('#t_asuransi').text(": "+data.nama_asuransi);
                    $('#t_cob').text(": "+data.cob);
                    $('#t_lob').text(": "+data.lob);

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

        } else {

            $('.det_mop').slideUp();
            $('#t_no_mop').text(': -');
            $('#t_asuransi').text(': -');
            $('#t_cob').text(': -');
            $('#t_lob').text(': -');
            
        }
        
    }
    
</script>