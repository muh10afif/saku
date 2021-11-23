<script>
    $(document).ready(function () {

        // 22-09-2021
        var tabel_entry = $('#tabel_entry').DataTable({
            "processing"        : true,
            "serverSide"        : true,
            "order"             : [],
            "ajax"              : {
                "url"   : "<?= base_url() ?>entry_sppa/tampil_data_entry",
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
                "targets"   : [0,8],
                "orderable" : false
            }, {
                'targets'   : [0,6,7,8],
                'className' : 'text-center',
            }, {
                targets: [0],
                className: 'dt-head-center'
            }
            ],
            "scrollX": true
        })
        
        // 24-09-2012
        $('#tabel_entry').on('click', '.detail', function () {

            var id_sppa = $(this).data('id');

            window.location.href = "<?= base_url() ?>entry_sppa/detail_sppa/"+id_sppa;
            
        })

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
        $('#id_pengguna_tertanggung2').on('change', function () {

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

                        $('.isi_detail_ptg').attr('required', false);

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

                        $('.isi_detail_ptg').attr('required', true);
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
        $("#method").change(function() {
            $(this).trigger('input')
        });
        $("#payment_method").change(function() {
            $(this).trigger('input')
        });
        $("#bank").change(function() {
            $(this).trigger('input')
        });
        $("#pilih_premi").change(function() {
            $(this).trigger('input')
        });
        $("#id_insured").change(function() {
            $(this).trigger('input')
        });
        $("#no_reff_mop").change(function() {
            $(this).trigger('input')
        });
        $("#id_pengguna_tertanggung").change(function() {
            $(this).trigger('input')
        });

        $('#form_entry').on('submit', function () {

            // var payment     = $("input[name='pilihan_payment']").val();
            var form_entry  = $('#form_entry').serialize();

            var label_dok  = [];
            $('.label_dok').each(function() { 
                label_dok.push($(this).text()); 
            });

            var i_dok       = [];
            $('.dokumen_entry').each(function() { 
                i_dok.push($(this).data('id')); 
            });

            let formData  = new FormData();

            var dokumen         = [];
            var nama_dok        = [];
            var desc_mop        = [];
            var desc_val        = [];
            for (let index = 0; index < i_dok.length; index++) {
                const element = i_dok[index];
                
                nama_dok[index] = "dokumen_"+element;
                desc_mop[index] = "desc_"+element;

                dokumen[index]  = document.getElementById('dokumen_'+element).files[0];

                desc_val[index] = $('#desc_'+element).val();
            }

            for (let i = 0; i < dokumen.length; i++) {

                formData.append(nama_dok[i], dokumen[i]);
                formData.append(desc_mop[i], desc_val[i]);
                
            }

            formData.append('jumlah', label_dok.length);
            formData.append('data_id_dokumen', JSON.stringify(i_dok));
            formData.append('form_entry', form_entry);

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
                        url     : "<?= base_url() ?>entry_sppa/simpan_entry",
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
                        data            : formData,
                        contentType     : false,
                        cache           : false,
                        processData     : false,
                        dataType        : "JSON",
                        success         : function (data) {
                            
                            swal({
                                title               : "Berhasil",
                                text                : 'Data berhasil disimpan',
                                buttonsStyling      : false,
                                confirmButtonClass  : "btn btn-success",
                                type                : 'success',
                                showConfirmButton   : false,
                                timer               : 2000,
                                allowOutsideClick   : false
                            }).then(function() {
                                window.location.href = "<?= base_url('entry_sppa') ?>";
                            }); 

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
            
                    return false;

                } else if (result.dismiss === swal.DismissReason.cancel) {
                    swal.close();
                }
            })

            return false;

        })

        // 15-11-2021
        $('#tabel_entry').on('click', '.hapus', function () {

            var id_sppa  = $(this).data('id');

            swal({
                title       : 'Konfirmasi',
                text        : 'Yakin akan hapus data ini?',
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
                        url         : "<?= base_url() ?>entry_sppa/hapus_entry",
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
                        data        : {id_sppa:id_sppa},
                        dataType    : "JSON",
                        success     : function (data) {

                                tabel_entry.ajax.reload(null,false);   

                                swal({
                                    title               : 'Hapus Data',
                                    text                : 'Data Berhasil Dihapus',
                                    buttonsStyling      : false,
                                    confirmButtonClass  : "btn btn-success",
                                    type                : 'success',
                                    showConfirmButton   : false,
                                    timer               : 3000,
                                    allowOutsideClick   : false
                                }).then(function() {
                                    window.location.href = "<?= base_url('entry_sppa') ?>";
                                });
                            
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

                    return false;
                } else if (result.dismiss === swal.DismissReason.cancel) {

                    swal.close();
                }
            })
            
        })

        // 15-11-2021
        $('#tabel_entry').on('click', '.edit', function () {

            var id_sppa = $(this).data('id');

            window.location.href = "<?= base_url() ?>entry_sppa/edit_sppa/"+id_sppa;
            
        })

        // 10-11-2021
        var a = 111;
        $('#tambah_dokumen').on('click', function () {

            $('#tabel_dok_entry').slideDown();

            list = 
                `
                <tr id="list_add`+a+`">
                    <td class="label_dok text-center" id="label_dok_`+a+`" data-id="`+a+`">`+a+`.</td>
                    <td>
                        <input type="file" id="dokumen_`+a+`" name="dokumen_`+a+`" class="form-control dokumen_entry" data-id="`+a+`">
                        <input type="hidden" class="file_edit" id="file_edit_`+a+`" name="file_edit_`+a+`" data-id="`+a+`" value="baru">
                    </td>
                    <td><textarea id="desc_`+a+`" name="desc_`+a+`" class="form-control desc_mop" data-id="`+a+`" placeholder="Deskripsi"></textarea></td>
                    <td align="center"><span style="cursor:pointer;" class="remove text-danger ttip" data-id="`+a+`"><i class="far fa-trash-alt fa-lg"></i></span></td>
                </tr>
                `;    

            $('#show_dokumen').append(list);
            $('#list_add'+a).hide().slideDown();

            ubah_label();

            a++;
        
        })

        // 10-11-2021
        $('#show_dokumen').on('click', '.remove', function() {

            var id = $(this).data('id');

            $('#list_add'+id).fadeOut(function(){ 

                $(this).remove();

                var label_dok = [];
                $('.label_dok').each(function() { 
                    label_dok.push($(this).val()); 
                });

                if (label_dok.length == 0) {

                    $('#tabel_dok_entry').slideUp(30);
                }

                ubah_label();
            });


        });

        // 10-11-2021
        function ubah_label() {

            var label_dok  = [];
            $('.label_dok').each(function() { 
                label_dok.push($(this).data('id')); 
            });

            let i = 1;
            for (let h = 0; h < label_dok.length; h++) {
                const element = label_dok[h];
                
                $('#label_dok_'+element).text(i+".");
            
                i++;
            }
            
        }

        // 16-11-2021
        $('#simpan_dok').on('click', function () {

            var form_data   = new FormData($('#form_dokumen')[0]);
            var aksi        = $('#aksi').val();

            if (aksi == 'Tambah') {
                var cek_dok = $("#doc")[0].files.length;
                if(cek_dok === 0){

                    swal({
                        title               : "Peringatan",
                        text                : 'File harus terisi!',
                        type                : 'warning',
                        showConfirmButton   : false,
                        timer               : 3000,
                        allowOutsideClick   : false
                    }); 

                    return false;
                    
                }  
            }
            

            let formData  = new FormData();

            formData.append("dokumen",document.getElementById('doc').files[0]);
            formData.append("desc", $('#desc').val());
            formData.append("aksi", $('#aksi').val());
            formData.append("id_dokumen", $('#id_dokumen').val());
            formData.append("nama_dokumen", $('#nama_dokumen').val());
            formData.append("id_sppa_dok", $('#id_sppa_dok').val());

            $.ajax({
                url: '<?= base_url("entry_sppa/simpan_dokumen") ?>',
                dataType: 'json',
                cache: false,
                contentType: false,
                processData: false,
                data: formData,
                type: 'post',
                success: function(data){
                tabel_dok.ajax.reload(null, false);

                $('#doc').val('');
                $('#desc').val('');
                $('#simpan_dok').text('Simpan');
                $('#aksi').val('Tambah');
                
                },
                error: function (jqXHR, textStatus, errorThrown)
                {
                    swal({
                        title               : "Gagal",
                        text                : 'Gagal simpan data',
                        type                : 'error',
                        showConfirmButton   : false,
                        timer               : 3000,
                        allowOutsideClick   : false
                    }); 

                    return false;
                }
            });

        })

        // menampilkan tabel dok
        var tabel_dok = $('#tabel_dok').DataTable({
            "processing"        : true,
            "order"             : [],
            "ajax"              : {
                "url"   : "<?= base_url() ?>entry_sppa/tampil_data_dokumen",
                "type"  : "POST",
                "data"  : function (data) {
                    data.id_sppa    = "<?= $id_sppa ?>";
                    data.aksi       = $('#aksi_dok').val();
                },
            },
            "columnDefs"        : [{
                "targets"   : [0,5],
                "orderable" : false
            }, {
                'targets'   : [0,4,5],
                'className' : 'text-center',
            }],
            "bDestroy" : true
        })

        $('#tabel_dok').on('click', '.edit', function () {

            var id_dokumen  = $(this).data('id');
            var desc        = $(this).attr('desc');
            var filename    = $(this).attr('filename');

            $('#id_dokumen').val(id_dokumen);
            $('#nama_dokumen').val(filename);
            $('#desc').val(desc);
            $('#simpan_dok').text('Ubah Data');

            $('#aksi').val('Ubah');

        })

        $('#batal_dok').on('click', function () {

            $('#doc').val('');
            $('#desc').val('');
            $('#simpan_dok').text('Simpan');
            $('#aksi').val('Tambah');

        })

        // hapus dokumen
        $('#tabel_dok').on('click', '.hapus', function () {
            
            var id_dokumen  = $(this).data('id');
            var filename    = $(this).attr('filename');

            swal({
                title       : 'Konfirmasi',
                text        : 'Yakin akan hapus dokumen ?',
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
                        url         : "<?= base_url() ?>entry_sppa/simpan_dokumen",
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
                        data        : {aksi:'Hapus', id_dokumen:id_dokumen, nama_dokumen:filename},
                        dataType    : "JSON",
                        success     : function (data) {

                            tabel_dok.ajax.reload(null,false);   

                                swal({
                                    title               : 'Hapus dokumen',
                                    text                : 'Data Berhasil Dihapus',
                                    buttonsStyling      : false,
                                    confirmButtonClass  : "btn btn-success",
                                    type                : 'success',
                                    showConfirmButton   : false,
                                    timer               : 3000,
                                    allowOutsideClick   : false
                                }); 
                                
                                $('#form_dokumen').trigger("reset");

                                $('#aksi').val('Tambah');
                            
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

                    return false;
                } else if (result.dismiss === swal.DismissReason.cancel) {

                    swal.close();
                }
            })

        })

    })

    // awal function

    var aksi = "<?= $aksi ?>";

    if (aksi == 'edit') {
        var id_insured          = "<?= $list['id_insured'] ?>";
        var id_mop              = "<?= $list['id_mop'] ?>";
        var id_pengguna_ttg     = "<?= $list['id_pengguna_tertanggung'] ?>";
        var id_produk_asuransi  = "<?= $list['id_produk_asuransi'] ?>";
        var id_method           = "<?= $list['id_method'] ?>";

        set_no_reff(id_insured);
        get_detail_mop(id_mop);
        detail_pengguna_ttg(id_pengguna_ttg);
        set_payment_method(id_method)
    }

    function set_no_reff(id_insured) {

        var edit_id_mop = "<?= $list['id_mop'] ?>";
        var aksi_simpan = "<?= $aksi ?>";
        
        if (id_insured) {
            
            $.ajax({
                url     : "<?= base_url() ?>entry_sppa/get_list_mop",
                method  : "POST",
                data    : {id_insured:id_insured},
                dataType: "JSON",
                success : function (data) {

                    var option = "<option value=''>Pilih</option>";
                    data.forEach(function (item) {
                        
                        var sel = "";

                        if (item.id_mop == edit_id_mop) {
                            sel = 'selected';
                        } else {
                            sel = '';
                        }
                        
                        option += "<option value='"+item.id_mop+"' "+sel+">"+item.no_reff_mop+" - "+item.nama_mop+"</option>";
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

            $('.f_ahli_waris').fadeOut('fast');

            $('.det_mop').slideUp();
            $('#t_no_mop').text(': -');
            $('#t_asuransi').text(': -');
            $('#t_cob').text(': -');
            $('#t_lob').text(': -');
            
        }
        
    }

    function number_format (number, decimals, dec_point, thousands_sep) {
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

    function get_detail_mop(id_mop) {

        if (id_mop) {
            
            $.ajax({
                url     : "<?= base_url() ?>entry_sppa/get_detail_mop",
                method  : "POST",
                data    : {id_mop:id_mop},
                dataType: "JSON",
                success : function (data) {

                    $('.det_mop').slideDown();
                    $('#t_no_mop').text(": "+data.det.no_mop);
                    $('#t_asuransi').text(": "+data.det.nama_asuransi);
                    $('#t_cob').text(": "+data.det.cob);
                    $('#t_lob').text(": "+data.det.lob);

                    if (data.det.punya_ahli_waris == 't') {
                        $('.f_ahli_waris').fadeIn('fast');
                    } else {
                        $('.f_ahli_waris').fadeOut('fast');
                    }

                    var option  = "<option value=''>Pilih</option>";
                    var sel     = "";

                    data.list_premi.forEach(function (item) {

                        if (item.id_tr_produk_asuransi == id_produk_asuransi) {
                            sel = "selected";
                        } else {
                            sel = "";
                        }
                        
                        option += "<option value='"+item.id_tr_produk_asuransi+"' data-premi='"+item.premi+"' "+sel+">"+number_format(item.premi,0,',','.')+"</option>";
                    });

                    $('#pilih_premi').html(option);
                    
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

            $('.f_ahli_waris').fadeOut('fast');
            $('#pilih_premi').html("<option value=''>Pilih</option>");

            $('.det_mop').slideUp();
            $('#t_no_mop').text(': -');
            $('#t_asuransi').text(': -');
            $('#t_cob').text(': -');
            $('#t_lob').text(': -');
            
        }
        
    }

    // var selected_text   = isi.options[isi.selectedIndex].innerHTML;
    // var selected_value  = isi.value;
    // var data-id         = isi.options[isi.selectedIndex].dataset.id);    
    
    // 11-11-2021
    function hitung_total() {

        var premi       = $('#pilih_premi').find(':selected').data('premi');
        var bya_admin   = $('#biaya_admin').val().split('.').join('');

        if (bya_admin == '') {
            bya_admin = 0;
        }

        if (premi) {
            $('#total_akhir_premi').val(number_format(premi,0,',','.'));

            var total = parseInt(premi) + parseInt(bya_admin);

            $('#total_tagihan').val(number_format(total,0,',','.'));
        } else {
            $('#total_akhir_premi').val('0');
            // $('#biaya_admin').val('0');
            $('#total_tagihan').val('0');
        }
        
    }

    // 11-11-2021
    function set_payment_method(id_method) {

        // if (id_method == 1) {
        //     $('#payment_method').attr('required', false);
        //     $('#bank').attr('required', true);

        //     $('.f_payment_method').fadeOut(50);
        //     $('.f_bank').fadeIn(100);

        //     return false;
        // }

        var id_payment_method = "<?= $list['id_payment_method'] ?>";
        
        if (id_method) {

            // $('.f_payment_method').fadeOut('fast');
            // $('.f_bank').fadeOut('fast');
            
            $.ajax({
                url     : "<?= base_url() ?>entry_sppa/get_list_payment_method",
                method  : "POST",
                data    : {id_method:id_method},
                dataType: "JSON",
                success : function (data) {

                    var option = "";

                    if (data.length != 0) {

                        if (data.length > 1) {
                           option = "<option value=''>Pilih</option>";
                           $('#payment_method').attr('required', true);
                        } else {
                            $('#payment_method').attr('required', false);
                            $('#payment_method').parsley().reset();
                        }

                        // $('#payment_method').attr('required', true);
                        // $('#bank').attr('required', false);

                        $('.f_payment_method').fadeIn('fast');

                        var sel = "";

                        data.forEach(function (item) {

                            if (item.id == id_payment_method) {
                                sel = "selected";
                            } else {
                                sel = "";
                            }
                            
                            option += "<option value='"+item.id+"' "+sel+">"+item.nama+"</option>";
                        })

                    }
                    
                    $('#payment_method').html(option);
                    
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

            // $('#payment_method').attr('required', true);
            // $('#bank').attr('required', true);

            // $('.f_bank').fadeOut('fast');
            // $('.f_payment_method').fadeOut('fast');
            $('#payment_method').attr('required', true);
            $('#payment_method').html("<option value=''>Pilih</option>");
            
        }
        
    }

    // 16-11-2021
    function detail_pengguna_ttg(id_pengguna_ttg) {

        // var id_pengguna_ttg  = $(this).val();

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

                    $('.isi_detail_ptg').attr('required', false);

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

                    $('.isi_detail_ptg').attr('required', true);
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
        
    }
    
</script>