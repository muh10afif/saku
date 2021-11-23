<script>
    $(document).ready(function() {

        // 12-08-2021
        $('#check_histori').on('change', function () {

            var value = $(this).is(':checked');

            if (value) {
                $('.sel_histori').fadeIn();
            } else {
                $('.sel_histori').fadeOut();
            }
            
        })

        // 12-08-2021
        $('#buat_jurnal').on('click', function () {

            var check_histori   = $('#check_histori').is(':checked');
            var nama_transaksi  = $('#nama_transaksi').val();
            var history_trans   = $('#history_trans').val();
            var sts_buat_jurnal = $('#status_buat_jurnal').val();

            if (sts_buat_jurnal == 1) {

                swal({
                    title       : 'Konfirmasi',
                    text        : 'Yakin akan membatalkan buat jurnal?',
                    type        : 'warning',

                    buttonsStyling      : false,
                    confirmButtonClass  : "btn btn-danger",
                    cancelButtonClass   : "btn btn-primary mr-3",

                    showCancelButton    : true,
                    confirmButtonText   : 'Ya, batalkan',
                    confirmButtonColor  : '#d33',
                    cancelButtonColor   : '#3085d6',
                    cancelButtonText    : 'Tidak',
                    reverseButtons      : true,
                    allowOutsideClick   : false

                }).then((result) => {
                    if (result.value) {

                        $('#check_histori').prop('checked', false).change();
                        $('#history_trans').val('').trigger('change');
                        $('#nama_transaksi').val('');

                        $('#status_buat_jurnal').val(0);
                        $('#buat_jurnal').removeClass("btn-danger");
                        $('#buat_jurnal').addClass("btn-primary");
                        $('#buat_jurnal').html("<i class='fas fa-check mr-2'></i>Buat Jurnal");
                        $('.form_jurnal').slideUp('fast');
                        $('.check_histori').attr('hidden', false);

                        return false;
                        
                    } else if (result.dismiss === swal.DismissReason.cancel) {

                        swal({
                            title               : 'Batal',
                            text                : 'Anda membatalkan buat jurnal',
                            buttonsStyling      : false,
                            confirmButtonClass  : "btn btn-primary",
                            type                : 'error',
                            showConfirmButton   : false,
                            timer               : 1500,
                            allowOutsideClick   : false
                        }); 
                    }
                })
                
            }

            var label_jurnal = [];
            $('.label_jurnal').each(function() { 
                label_jurnal.push($(this).val()); 
            });

            if (label_jurnal.length == 0) {
                $('#baris_jurnal').html('');
            }

            if (label_jurnal.length <= 2) {

                var list_coa_asli       = $('.list_coa_asli').html();
                var list_pelaksana_asli = $('.list_pelaksana_asli').html();

                $('#baris_jurnal').html('');

                for (let a = 1; a < 3; a++) {
                    
                    list = 
                        `
                        <tr id="list_add`+a+`">
                            <td align="center" class="label_jurnal" id="label_jurnal_`+a+`" data-id="`+a+`">`+a+`.</td>
                            <td align="center">
                                <select name="coa_`+a+`" id="coa_`+a+`" class="form-control select2 list_coa">
                                    `+list_coa_asli+`
                                </select>
                            </td>
                            <td align="center">
                                <select name="pelaksana_`+a+`" id="pelaksana_`+a+`" class="form-control select2 list_pelaksana" data-id="`+a+`">
                                    `+list_pelaksana_asli+`
                                </select>
                            </td>
                            <td align="center">
                                <input type="text" id="tgl_`+a+`" data-id="`+a+`" class="list_tgl form-control datepicker text-center" placeholder="Pilih Tanggal">
                            </td>
                            <td align="center">
                                <input type="text" id="debit_`+a+`" data-id="`+a+`" class="list_debit form-control text-center number_separator numeric" placeholder="0">
                            </td>
                            <td align="center">
                                <input type="text" id="kredit_`+a+`" data-id="`+a+`" class="list_kredit form-control text-center number_separator numeric" placeholder="0">
                            </td>
                            <td align="center">
                                <span style="cursor: pointer;" data-toggle="tooltip" data-placement="top" title="Hapus" class='ttip remove text-danger' data-id="`+a+`"><i class="far fa-trash-alt fa-lg"></i></span>
                            </td>
                        </tr>
                    
                        `;    

                    $('#baris_jurnal').append(list);
                    // $('#list_add'+a).hide().slideDown();

                    $('.datepicker').datepicker({
                        autoclose: true,
                        todayHighlight: false,
                        format: "dd-mm-yyyy",
                        clearBtn: true,
                        orientation: 'auto'
                    });

                    $('.select2').select2({
                        theme       : 'bootstrap4',
                        width       : 'style',
                        placeholder : $(this).attr('placeholder'),
                        allowClear  : false
                    });

                    $('.numeric').numericOnly();

                    $('.number_separator').divide({
                        delimiter:'.',
                        divideThousand: true, // 1,000..9,999
                        delimiterRegExp: /[\.\,\s]/g
                    });

                    $('body').tooltip({
                        selector: '.ttip',
                        trigger : 'hover'
                    });

                    $('[data-toggle="tooltip"]').click(function () {
                        $('[data-toggle="tooltip"]').tooltip("hide");
                    });
                    
                }
                
            }

            if (nama_transaksi == '') {

                swal({
                    title               : "Peringatan",
                    text                : "Nama Transaksi harap diisi!",
                    type                : 'warning',
                    showConfirmButton   : true,
                    buttonsStyling      : false,
                    confirmButtonClass  : "btn btn-primary",
                    confirmButtonText   : 'OK',
                    allowOutsideClick   : false
                });

                return false;

            }

            if (check_histori) {

                if (history_trans == '') {

                    swal({
                        title               : "Peringatan",
                        text                : "Parap pilih histori transaksi dahulu!",
                        type                : 'warning',
                        showConfirmButton   : true,
                        buttonsStyling      : false,
                        confirmButtonClass  : "btn btn-primary",
                        confirmButtonText   : 'OK',
                        allowOutsideClick   : false
                    });

                    return false;
                    
                }
                
            } else {
                $('.check_histori').attr('hidden', true);
            }

            $('#status_buat_jurnal').val(1);
            $('#buat_jurnal').removeClass("btn-primary");
            $('#buat_jurnal').addClass("btn-danger");
            $('#buat_jurnal').html("<i class='fas fa-times mr-2'></i>Batalkan Buat Jurnal");
            $('.form_jurnal').slideDown('fast');

            
        })

        // 12-08-2021
        var a = 1000;
        $('#tambah_baris_baru').on('click', function () {

            var label_jurnal = [];
            $('.label_jurnal').each(function() { 
                label_jurnal.push($(this).val()); 
            });

            if (label_jurnal.length == 0) {
                $('#baris_jurnal').html('');
            }

            var list_coa_asli       = $('.list_coa_asli').html();
            var list_pelaksana_asli = $('.list_pelaksana_asli').html();

            var list = "";

            list = 
                `
                <tr id="list_add`+a+`">
                    <td align="center" class="label_jurnal" id="label_jurnal_`+a+`" data-id="`+a+`">`+a+`.</td>
                    <td align="center">
                        <select name="coa_`+a+`" id="coa_`+a+`" class="form-control select2 list_coa">
                            `+list_coa_asli+`
                        </select>
                    </td>
                    <td align="center">
                        <select name="pelaksana_`+a+`" id="pelaksana_`+a+`" class="form-control select2 list_pelaksana" data-id="`+a+`">
                            `+list_pelaksana_asli+`
                        </select>
                    </td>
                    <td align="center">
                        <input type="text" id="tgl_`+a+`" data-id="`+a+`" class="list_tgl form-control datepicker text-center" placeholder="Pilih Tanggal">
                    </td>
                    <td align="center">
                        <input type="text" id="debit_`+a+`" data-id="`+a+`" class="list_debit form-control text-center number_separator numeric" placeholder="0">
                    </td>
                    <td align="center">
                        <input type="text" id="kredit_`+a+`" data-id="`+a+`" class="list_kredit form-control text-center number_separator numeric" placeholder="0">
                    </td>
                    <td align="center">
                        <span style="cursor: pointer;" data-toggle="tooltip" data-placement="top" title="Hapus" class='ttip remove text-danger' data-id="`+a+`"><i class="far fa-trash-alt fa-lg"></i></span>
                    </td>
                </tr>
               
                `;    

            $('#baris_jurnal').append(list);
            $('#list_add'+a).hide().slideDown();

            $('.datepicker').datepicker({
                autoclose: true,
                todayHighlight: false,
                format: "dd-mm-yyyy",
                clearBtn: true,
                orientation: 'auto'
            });

            $('.select2').select2({
                theme       : 'bootstrap4',
                width       : 'style',
                placeholder : $(this).attr('placeholder'),
                allowClear  : false
            });

            $('.numeric').numericOnly();

            $('.number_separator').divide({
                delimiter:'.',
                divideThousand: true, // 1,000..9,999
                delimiterRegExp: /[\.\,\s]/g
            });

            $('body').tooltip({
                selector: '.ttip',
                trigger : 'hover'
            });

            $('[data-toggle="tooltip"]').click(function () {
                $('[data-toggle="tooltip"]').tooltip("hide");
            });

            ubah_label();

            hitung_kredit_debit();

            a++;
            
        })

        $('#baris_jurnal').on('click', '.remove', function() {

            var id = $(this).data('id');

            $('#list_add'+id).fadeOut(function(){ 

                $(this).remove();

                var label_jurnal = [];
                $('.label_jurnal').each(function() { 
                    label_jurnal.push($(this).val()); 
                });

                if (label_jurnal.length == 0) {

                    tr = `<tr>
                            <td colspan='7' align='center'>Isi Jurnal Kosong</td>
                         </tr>`;
                    
                    $('#baris_jurnal').html(tr);

                }

                ubah_label();

                hitung_kredit_debit();
            });


        });
        
        // ubah label
        function ubah_label() {

            var label_jurnal  = [];
            $('.label_jurnal').each(function() { 
                label_jurnal.push($(this).data('id')); 
            });

            let i = 1;
            for (let h = 0; h < label_jurnal.length; h++) {
                const element = label_jurnal[h];
                
                $('#label_jurnal_'+element).text(i+".");

                i++;
            }

        }

        // 12-08-2021
        $('#baris_jurnal').on('keyup', '.list_debit', function () {

            var isi = $(this).val();
            var id  = $(this).data('id');

            if (isi != '') {
                $('#kredit_'+id).attr('disabled', true);
            } else {
                $('#kredit_'+id).attr('disabled', false);
            }
            
            hitung_kredit_debit();
        })

        // 12-08-2021
        $('#baris_jurnal').on('keyup', '.list_kredit', function () {

            var isi = $(this).val();
            var id  = $(this).data('id');

            if (isi != '') {
                $('#debit_'+id).attr('disabled', true);
            } else {
                $('#debit_'+id).attr('disabled', false);
            }

            hitung_kredit_debit();

        })

        function hitung_kredit_debit() {

            var total_debit = 0;
            $('.list_debit').each(function() { 

                var isi_debit = $(this).val();
                
                total_debit += parseFloat((isi_debit == '') ? 0 : isi_debit);

            });

            var total_kredit = 0;
            $('.list_kredit').each(function() { 

                var isi_kredit = $(this).val();
                
                total_kredit += parseFloat((isi_kredit == '') ? 0 : isi_kredit);

            });

            if (total_debit == total_kredit) {

                $('#total_debit').val(total_debit);
                $('#total_kredit').val(total_kredit);
                $('#btn_simpan').attr('disabled', false);
                $('.ket_balance').removeClass('text-danger').addClass('text-primary');
                $('.ket_balance').text('*DATA BALANCE');

                return true;
            } else {
                $('#btn_simpan').attr('disabled', true);
                $('.ket_balance').removeClass('text-primary').addClass('text-danger');
                $('.ket_balance').text('*DATA TIDAK BALANCE')

                return false;
            }
            
        }

        // 12-08-2021
        $('#btn_simpan').on('click', function () {

            var nama_tr         = $('#nama_transaksi').val();
            var total_debit     = $('#total_debit').val();
            var total_kredit    = $('#total_kredit').val();
            var status_jurnal   = $('#status_jurnal').val();
            var id_jurnal_edit  = $('#id_jurnal_edit').val();

            var list_coa   = [];
            $('.list_coa').each(function() { 
                list_coa.push($(this).val()); 
            });

            var list_pelaksana   = [];
            $('.list_pelaksana').each(function() { 
                list_pelaksana.push($(this).val()); 
            });

            var list_tgl   = [];
            $('.list_tgl').each(function() { 
                list_tgl.push($(this).val()); 
            });

            var list_debit   = [];
            $('.list_debit').each(function() { 
                list_debit.push(parseInt(($(this).val() == '') ? 0 : $(this).val())); 
            });

            var list_kredit   = [];
            $('.list_kredit').each(function() { 
                list_kredit.push(parseInt(($(this).val() == '') ? 0 : $(this).val())); 
            });
            
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
                        url     : "<?= base_url() ?>Jurnal_buku_besar/simpan_jurnal",
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
                            nama_tr         : nama_tr,
                            list_coa        : list_coa,
                            list_pelaksana  : list_pelaksana,
                            list_tgl        : list_tgl,
                            list_debit      : list_debit,
                            list_kredit     : list_kredit,
                            total_debit     : total_debit,
                            total_kredit    : total_kredit,
                            status_jurnal   : status_jurnal,
                            id_jurnal_edit  : id_jurnal_edit
                        },
                        dataType: "JSON",
                        success : function (data) {
                            
                            swal({
                                title               : "Berhasil",
                                text                : "Data berhasil disimpan",
                                type                : 'success',
                                showConfirmButton   : false,
                                timer               : 2000,
                                allowOutsideClick   : false
                            }).then(function() {
                                location.href = "<?= base_url('Jurnal_buku_besar') ?>";
                            });
                            
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
                        timer               : 1500
                    }); 
                }
            })

            return false;
        })
        
    });
</script>