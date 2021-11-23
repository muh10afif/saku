<script type="text/javascript">

    function preview() {  
      $('#exceltable').html('');  
      var regex = /^([a-zA-Z0-9\s_\\.\-:])+(.xlsx|.xls)$/;  
      /*Checks whether the file is a valid excel file*/  
      if (regex.test($("#excelfile").val().toLowerCase())) {  
          var xlsxflag = false; /*Flag for checking whether excel is .xls format or .xlsx format*/  
          if ($("#excelfile").val().toLowerCase().indexOf(".xlsx") > 0) {  
              xlsxflag = true;  
          }  
          /*Checks whether the browser supports HTML5*/  
          if (typeof (FileReader) != "undefined") {  
              var reader = new FileReader();  
              reader.onload = function (e) {  
                  var data = e.target.result;  
                  /*Converts the excel data in to object*/  
                  if (xlsxflag) {  
                      var workbook = XLSX.read(data, { type: 'binary' });  
                  }  
                  else {  
                      var workbook = XLS.read(data, { type: 'binary' });  
                  }  
                  /*Gets all the sheetnames of excel in to a variable*/  
                  var sheet_name_list = workbook.SheetNames;  
    
                  var cnt = 0; /*This is used for restricting the script to consider only first sheet of excel*/  
                  sheet_name_list.forEach(function (y) { /*Iterate through all sheets*/  
                      /*Convert the cell value to Json*/  
                      if (xlsxflag) {  
                          var exceljson = XLSX.utils.sheet_to_json(workbook.Sheets[y]);  
                      }  
                      else {  
                          var exceljson = XLS.utils.sheet_to_row_object_array(workbook.Sheets[y]);  
                      }  
                      if (exceljson.length > 0 && cnt == 0) {  
                          BindTable(exceljson, '#exceltable');  
                          cnt++;  
                      }  
                  });  
                  
                  $('#exceltable').show();  
                  $('#modal_preview').modal('show');
              }  
              if (xlsxflag) {/*If excel file is .xlsx extension than creates a Array Buffer from excel*/  
                  reader.readAsArrayBuffer($("#excelfile")[0].files[0]);  
              }  
              else {  
                  reader.readAsBinaryString($("#excelfile")[0].files[0]);  
              }  
          }  
          else {  

              swal({
                  title               : "Peringatan",
                  text                : 'Browser, tidak support HTML5',
                  type                : 'warning',
                  showConfirmButton   : false,
                  timer               : 3000,
                                allowOutsideClick   : false
              }); 

              return false;
          }  
      }  
      else {  

          swal({
              title               : "Peringatan",
              text                : 'Harap Upload file terlebih dahulu!',
              type                : 'warning',
              showConfirmButton   : false,
              timer               : 3000,
                                allowOutsideClick   : false
          }); 

          return false;
      }  
    }  

    function BindTable(jsondata, tableid) {/*Function used to convert the JSON array to Html Table*/  
        var columns = BindTableHeader(jsondata, tableid); /*Gets all the column headings of Excel*/  
        for (var i = 0; i < jsondata.length; i++) {  
            var row$ = $('<tr/>');  
            for (var colIndex = 0; colIndex < columns.length; colIndex++) {  
                var cellValue = jsondata[i][columns[colIndex]];  
                if (cellValue == null)  
                    cellValue = "";  
                row$.append($('<td/>').html(cellValue));  
            }  
            $(tableid).append(row$);  
        }  
    }  

    function BindTableHeader(jsondata, tableid) {/*Function used to get all column names from JSON and bind the html table header*/  
        var columnSet = [];  
        var headerTr$ = $('<tr/>');  
        for (var i = 0; i < jsondata.length; i++) {  
            var rowHash = jsondata[i];  
            for (var key in rowHash) {  
                if (rowHash.hasOwnProperty(key)) {  
                    if ($.inArray(key, columnSet) == -1) {/*Adding each unique column names to a variable array*/  
                        columnSet.push(key);  
                        headerTr$.append($('<th/>').html(key));  
                    }  
                }  
            }  
        }  
        $(tableid).append(headerTr$);  
        return columnSet;  
    } 
    
</script>
<script>

    $(document).ready(function () {

        // 15-06-2021
        $('#preview').on('click', function () {

            preview();
            
        })

        $('#clear').on('click', function () {
            $('#exceltable').html('');  
            $('#excelfile').val('');
        })

        $('#form_mop').parsley();

        $("#id_insured").change(function() {
            $(this).trigger('input')
        });
        $("#id_insurer").change(function() {
            $(this).trigger('input')
        });
        $("#id_cob").change(function() {
            $(this).trigger('input')
        });
        $("#id_lob").change(function() {
            $(this).trigger('input')
        });

        $("#tgl_awal_polis").change(function() {
            $(this).trigger('input')
        });
        $("#tgl_akhir_polis").change(function() {
            $(this).trigger('input')
        });
        $("#penyampaian_deklarasi").change(function() {
            $(this).trigger('input')
        });

        tinymce.triggerSave();

        // var myinput = document.getElementsByClassName('ribuan')[0];

        // myinput.addEventListener('keyup', function() {
        // var val = this.value;
        // val = val.replace(/[^0-9\.]/g,'');

        // if(val != "") {
        //     valArr = val.split('.');
        //     valArr[0] = (parseInt(valArr[0],10)).toLocaleString();
        //     val = valArr.join('.');
        // }

        // this.value = val;
        // });

        // 27-05-2021
        $('#id_sob').on('change', function () {

            var id_sob      = $(this).val();
            var d_sob_sel   = $('#d_sob_sel').val();

            if (id_sob == '') {
                d_sob_sel = '';
            } else {
                d_sob_sel = d_sob_sel;
            }

            $.ajax({
                url     : "<?= base_url('mop/option_detail_sob') ?>",
                method  : "POST",
                data    : {id_sob:id_sob, d_sob_sel:d_sob_sel},
                dataType: "JSON",
                success : function (data) {

                    $('#l_detail').text(data.nama_sob)
                    $('#detail_sob').attr('disabled', true);
                    $('#d_sob').attr('disabled', false);
                    $('#d_sob').html(data.option);

                    sel_d_sob(d_sob_sel)

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
            
        })

        function sel_d_sob(id_d_sob) {
            if (id_d_sob == '') {
                $('#detail_sob').attr('disabled', true);
            } else {
                $('#detail_sob').attr('disabled', false);
            }
        }

        // 27-05-2021
        $('#d_sob').on('change', function () {

            var id_d_sob    = $(this).val();

            if (id_d_sob == '') {
                $('#detail_sob').attr('disabled', true);
            } else {
                $('#detail_sob').attr('disabled', false);
            }
            
        })

        // 27-05-2021
        $('#detail_sob').on('click', function () {

            var id_d_sob    = $('#d_sob').val();
            var id_sob      = $('#id_sob').val();

            $.ajax({
                url     : "<?= base_url('mop/ambil_detail_sob') ?>",
                method  : "POST",
                data    : {id_d_sob:id_d_sob, id_sob:id_sob},
                dataType: "JSON",
                success : function (data) {

                    $('#modal_detail').modal('show');

                    $('#t_nama').text(": "+data.sob.nama);
                    $('#t_telp').text(": "+data.sob.telp);
                    $('#t_alamat').text(": "+data.sob.alamat);

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
            
        })

        // 18-05-2021
        $('#id_cob').on('change', function () {

            var id_cob      = $(this).val();
            var id_lob_sel  = $('#id_lob_sel').val();

            if (id_cob == '') {

                var option = "<option value=''>Pilih LOB</option>";
                $('#id_lob').html(option);

                $('#isi_coverage').html('');
                $('.t_coverage').slideUp();

            } else {
                $.ajax({
                    url     : "<?= base_url('mop/option_lob') ?>",
                    method  : "POST",
                    data    : {id_cob:id_cob, id_lob_sel:id_lob_sel},
                    dataType: "JSON",
                    success : function (data) {

                        $('#isi_coverage').html('');
                        $('.t_coverage').slideUp();
                        $('#id_lob').html(data.option);

                        var aksi    = $('#aksi').val();
                        var id_mop  = $('#id_mop').val();

                        if (aksi == 'Ubah') {
                            list_lob(id_mop);
                        }

                    },
                    error: function (jqXHR, textStatus, errorThrown)
                    {
                        swal({
                            title               : "Gagal",
                            text                : 'Gagal menampilkan data',
                            type                : 'error',
                            showConfirmButton   : false,
                            timer               : 3000,
                                allowOutsideClick   : false
                        }); 

                        return false;
                    }
                }) 

                return false;
            }
            
            
            
        })

        function list_lob(id_mop) {

            $.ajax({
                url     : "<?= base_url('mop/list_coverage_mop') ?>",
                method  : "POST",
                data    : {id_mop:id_mop},
                dataType: "JSON",
                success : function (data) {

                    var tr = "";

                    if (data.length == 0) {

                        tr = `<tr>
                            <td colspan='4' align='center'>Data Coverage Kosong</td>
                        </tr>`;
                        
                    } else {
                        var i = 0;
                        $.each(data, function(key, value) {

                            tr += `<tr id="list_`+i+`">
                                <td><input value='`+value.label+`' class='form-control label_mop'></td>
                                <td><input value='`+value.rate+`' class='form-control rate_mop'></td>
                                <td>
                                    <select class='form-control status_mop'>
                                        <option value='standar' `+(value.status == 'standar' ? 'selected' : '' ) +` >Standar</option>
                                        <option value='perluasan' `+(value.status == 'perluasan' ? 'selected' : '' )+`>Perluasan</option>
                                    </select>
                                </td>
                                <td align='center'><span class='text-danger remove ttip' data-id='`+i+`' style='cursor:pointer' data-trigger='hover' data-toggle='tooltip' data-placement='top' title='Hapus'><i class='mdi mdi-trash-can-outline mdi-24px'></i></span></td>
                            </tr>`;
                            
                            i++;
                        }); 
                    }

                    $('#isi_coverage').html(tr);

                    $('.t_coverage').slideDown();
                    
                },
                error: function (jqXHR, textStatus, errorThrown)
                {
                    swal({
                        title               : "Gagal",
                        text                : 'Gagal menampilkan data',
                        type                : 'error',
                        showConfirmButton   : false,
                        timer               : 3000,
                                allowOutsideClick   : false
                    }); 

                    return false;
                }
            })
            
        }

        // 18-05-2021
        $('#id_lob').on('change', function () {

            var id_lob      = $(this).val();

            if (id_lob == null || id_lob == '') {
                $('.t_coverage').slideUp();

                $('#download').attr('disabled', true);
                $('#preview').attr('disabled', true);
                $('#clear').attr('disabled', true);

                return false;
            }

            $('.t_coverage').slideUp();

            $.ajax({
                url     : "<?= base_url('mop/list_coverage') ?>",
                method  : "POST",
                data    : {id_lob:id_lob},
                dataType: "JSON",
                success : function (data) {

                    var tr = "";

                    if (data == null) {

                        tr = `<tr>
                            <td colspan='4' align='center'>Data Coverage Kosong</td>
                        </tr>`;
                        
                    } else {
                        var i = 0;
                        $.each(data, function(key, value) {

                            tr += `<tr id="list_`+i+`">
                                <td><input value='`+value.label+`' class='form-control label_mop'></td>
                                <td><input value='`+value.rate+`' class='form-control rate_mop'></td>
                                <td>
                                    <select class='form-control status_mop'>
                                        <option value='standar' `+(value.status == 'standar' ? 'selected' : '' ) +` >Standar</option>
                                        <option value='perluasan' `+(value.status == 'perluasan' ? 'selected' : '' ) +`>Perluasan</option>
                                    </select>
                                </td>
                                <td align='center'><span class='text-danger remove ttip' data-id='`+i+`' style='cursor:pointer' data-trigger='hover' data-toggle='tooltip' data-placement='top' title='Hapus'><i class='mdi mdi-trash-can-outline mdi-24px'></i></span></td>
                            </tr>`;
                            
                            i++;
                        }); 
                    }

                    $('#isi_coverage').html(tr);

                    $('.t_coverage').slideDown();

                    var id_relasi = $('#id_lob').find(':selected').attr('id_relasi');
                    $('#url_format').attr('href', "<?= base_url() ?>entry_sppa/format_excel/"+id_relasi);

                    $('#download').attr('disabled', false);
                    $('#preview').attr('disabled', false);
                    $('#clear').attr('disabled', false);
                    
                },
                error: function (jqXHR, textStatus, errorThrown)
                {
                    swal({
                        title               : "Gagal",
                        text                : 'Gagal menampilkan data',
                        type                : 'error',
                        showConfirmButton   : false,
                        timer               : 3000,
                                allowOutsideClick   : false
                    }); 

                    return false;
                }
            })

        })

        $('#isi_coverage').on('click', '.remove', function() {

            var id = $(this).data('id');

            // $('#list_'+id).slideUp(3000, function(){ $(this).remove();});

            $('#list_'+id).fadeOut(function(){ 
                $(this).remove(); 
            
                var label_mop = [];
                $('.label_mop').each(function() { 
                    label_mop.push($(this).val()); 
                });

                if (label_mop.length == 0) {

                    tr = `<tr>
                            <td colspan='4' align='center'>Data Coverage Kosong</td>
                         </tr>`;
                    
                    $('#isi_coverage').html(tr);
                }
            
            });

        });

        var b = 8000;
        // 27-05-2021
        $('#tambah_coverage').on('click', function () {

            var label_mop = [];
            $('.label_mop').each(function() { 
                label_mop.push($(this).val()); 
            });

            if (label_mop.length == 0) {
                $('#isi_coverage').html('');
            }

            var tr = "";

            tr = `<tr id="list_`+b+`">
                    <td><input class='form-control label_mop' placeholder='Label'></td>
                    <td><input class='form-control rate_mop persen' placeholder='Contoh: 0.0001'></td>
                    <td>
                        <select class='form-control status_mop'>
                            <option value='standar'>Standar</option>
                            <option value='perluasan'>Perluasan</option>
                        </select>
                    </td>
                    <td align='center'><span class='text-danger remove ttip' data-id='`+b+`' style='cursor:pointer' data-trigger='hover' data-toggle='tooltip' data-placement='top' title='Hapus'><i class='mdi mdi-trash-can-outline mdi-24px'></i></span></td>
                </tr>`;
            
            $('#isi_coverage').append(tr);
            $('#list_'+b).hide().fadeIn();

            $('.persen').keyup(function(){
                var val = $(this).val();
                if(isNaN(val)){
                    val = val.replace(/[^0-9\.]/g,'');
                    if(val.split('.').length>2) 
                        val =val.replace(/\.+$/,"");
                }
                $(this).val(val); 
            });

            b++;
        })

        $('#tambah_mop').on('click', function () {

            $('#tambah_prod_as').attr('disabled', true);
            
            $("#form_mop").parsley().reset();

            $('.tb_dok').fadeOut();

            $('#id_negara').val('').trigger('change');

            $('#id_negara_sel').val('');
            $('#id_provinsi_sel').val('');
            $('#id_kota_sel').val('');
            $('#id_kecamatan_sel').val('');
            $('#id_desa_sel').val('');

            $('#show_dokumen').html('');
            
            $('#form_mop').trigger('reset');

            $('#id_sob').val('').trigger('change');
            $('#d_sob').val('').trigger('change');
            $('#id_insured').val('').trigger('change');
            $('#id_insurer').val('').trigger('change');
            $('#id_cob').val('').trigger('change');
            $('#id_lob').val('').trigger('change');

            $('#isi_coverage').html('');
            $('.t_coverage').slideUp();

            $('html, body').animate({
                scrollTop: $('body').offset().top
            }, 800);

            var sts = $('#status_toggle').val();

            if (sts == 0) {
                $('.f_tambah').slideToggle('fast', function() {
                    if ($(this).is(':visible')) {
                        $('#status_toggle').val(1);          
                    } else {  
                        $('#status_toggle').val(0);            
                    }        
                });  
            }

            $.ajax({
                url     : "<?= base_url('mop/get_kode') ?>",
                method  : "POST",
                dataType: "JSON",
                success : function (data) {

                    $('#no_reff_mop').val(data.no_reff_mop);

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

            $('.tb_dok').slideUp();
            $('#aksi').val('Tambah');
        })  

        $('.persen').keyup(function(){
            var val = $(this).val();
            if(isNaN(val)){
                val = val.replace(/[^0-9\.]/g,'');
                if(val.split('.').length>2) 
                    val =val.replace(/\.+$/,"");
            }
            $(this).val(val); 
        });

        // 18-05-2021
        // menampilkan list mop
        var tabel_list_mop = $('#tabel_master_mop').DataTable({
            "processing"        : true,
            "serverSide"        : true,
            "order"             : [],
            "ajax"              : {
                "url"   : "<?= base_url() ?>mop/tampil_data_mop",
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
                "targets"   : [0,5],
                "orderable" : false
            }, {
                'targets'   : [0,5],
                'className' : 'text-center',
            }]
        })

        // 14-07-2021
        $('#tabel_master_mop').on('click', '.detail', function () {

            var id_mop = $(this).data('id');

            location.href   = "<?= base_url('mop/detail_mop/') ?>"+id_mop;

            // $.ajax({
            //     url     : "<?= base_url('mop/detail_mop') ?>",
            //     method  : "POST",
            //     beforeSend  : function () {
            //         swal({
            //             title   : 'Menunggu',
            //             html    : 'Memproses Halaman',
            //             onOpen  : () => {
            //                 swal.showLoading();
            //             },
            //             showConfirmButton   : false,
            //             allowOutsideClick   : false
            //         })
            //     },
            //     data    : {id_mop:id_mop},
            //     success : function (data) {

            //         swal.close();

            //         $('#modal_detail_mop').modal('show');
            //         $('.isi_detail').html(data);

            //     },
            //     error: function (jqXHR, textStatus, errorThrown)
            //     {
            //         swal({
            //             title               : "Gagal",
            //             text                : 'Gagal menampilkan data',
            //             type                : 'error',
            //             showConfirmButton   : false,
            //             timer               : 3000,
            //             allowOutsideClick   : false
            //         }); 

            //         return false;
            //     }
            // })

            // return false;

        })

        // aksi simpan data mop
        $('#form_mop').on('submit', function () {

            // tinymce.triggerSave();

            var aksi                    = $('#aksi').val();
            var id_mop                  = $('#id_mop').val();
            var no_reff_mop             = $('#no_reff_mop').val();
            var no_mop                  = $('#no_mop').val();
            var nama_mop                = $('#nama_mop').val();
            var no_polis_induk          = $('#no_polis_induk').val();
            var id_insured              = $('#id_insured').val();
            var id_insurer              = $('#id_insurer').val();
            var id_cob                  = $('#id_cob').val();
            var id_lob                  = $('#id_lob').val();
            var id_sob                  = $('#id_sob').val();
            var id_d_sob                = $('#d_sob').val();
            var nilai_pertanggungan     = $('#nilai_pertanggungan').val();
            var objek_tertanggung       = tinymce.get('objek_tertanggung').getContent();
            var kondisi_pertanggungan   = tinymce.get('kondisi_pertanggungan').getContent();
            var pengecualian            = tinymce.get('pengecualian').getContent();
            var keterangan_premi        = tinymce.get('keterangan_premi').getContent();
            var resiko_sendiri          = tinymce.get('resiko_sendiri').getContent();
            var limit_minimal           = $('#limit_minimal').val();
            var berlaku_paling_lambat   = $('#berlaku_paling_lambat').val();
            var batas_wilayah           = $('#batas_wilayah').val();
            var penyampaian_deklarasi   = tinymce.get('penyampaian_deklarasi').getContent();
            var maksimal_pelaporan      = $('#maksimal_pelaporan').val();

            var tgl_awal_polis          = $('#tgl_awal_polis').val();
            var tgl_akhir_polis         = $('#tgl_akhir_polis').val();

            var id_negara               = $('#id_negara').val();
            var id_provinsi             = $('#id_provinsi').val();
            var id_kota                 = $('#id_kota').val();
            var id_kecamatan            = $('#id_kecamatan').val();
            var id_desa                 = $('#id_desa').val();

            var label_mop   = [];
            $('.label_mop').each(function() { 
                label_mop.push($(this).val()); 
            });
            var rate_mop    = [];
            $('.rate_mop').each(function() { 
                rate_mop.push($(this).val()); 
            });
            var status_mop  = [];
            $('.status_mop').each(function() { 
                status_mop.push($(this).val()); 
            });
            var label_dok  = [];
            $('.label_dok').each(function() { 
                label_dok.push($(this).text()); 
            });
            var list_lob  = [];
            $('.list_lob').each(function() { 
                list_lob.push($(this).val()); 
            });
            var list_premi  = [];
            $('.list_premi').each(function() { 
                list_premi.push($(this).val().split('.').join('')); 
            });

            let formData  = new FormData();

            // var excelfile = document.getElementById('excelfile').files[0];

            var i_dok       = [];
            var i_dok_mop   = [];
            $('.dokumen_mop').each(function() { 
                i_dok.push($(this).data('id')); 
                i_dok_mop.push($(this).attr('id_dokumen_mop')); 
            });

            var dokumen         = [];
            var nama_dok        = [];
            var desc_mop        = [];
            var desc_val        = [];
            var file_edit       = [];
            var file_edit_val   = [];
            var desc_edit       = [];
            var desc_edit_val   = [];
            for (let index = 0; index < i_dok.length; index++) {
                const element = i_dok[index];
                
                nama_dok[index]     = "dokumen_"+index;
                desc_mop[index]     = "desc_"+index;
                file_edit[index]    = "file_edit_"+index;
                desc_edit[index]    = "desc_edit_"+index;

                dokumen[index]  = document.getElementById('dokumen_'+element).files[0];

                desc_val[index]         = $('#desc_'+element).val();
                file_edit_val[index]    = $('#file_edit_'+element).val();
                desc_edit_val[index]    = $('#desc_edit_'+element).val();
            }

            console.log(dokumen[0]);

            for (let i = 0; i < dokumen.length; i++) {

                formData.append(nama_dok[i], dokumen[i]);
                formData.append(desc_mop[i], desc_val[i]);
                formData.append(file_edit[i], file_edit_val[i]);
                formData.append(desc_edit[i], desc_edit_val[i]);
                
            }

            // formData.append('upload_excel', excelfile);
            formData.append('jumlah', label_dok.length);
            formData.append('aksi', aksi);
            formData.append('no_reff_mop', no_reff_mop);
            formData.append('no_mop', no_mop);
            formData.append('nama_mop', nama_mop);
            formData.append('no_polis_induk', no_polis_induk);
            formData.append('id_insured', id_insured);
            formData.append('id_insurer', id_insurer);
            formData.append('id_cob', id_cob);
            formData.append('id_lob', id_lob);
            formData.append('nilai_pertanggungan', nilai_pertanggungan);
            formData.append('objek_tertanggung', objek_tertanggung);
            formData.append('kondisi_pertanggungan', kondisi_pertanggungan);
            formData.append('pengecualian', pengecualian);
            formData.append('keterangan_premi', keterangan_premi);
            formData.append('resiko_sendiri', resiko_sendiri);
            formData.append('limit_minimal', limit_minimal);
            formData.append('berlaku_paling_lambat', berlaku_paling_lambat);
            formData.append('batas_wilayah', batas_wilayah);
            formData.append('penyampaian_deklarasi', penyampaian_deklarasi);
            formData.append('maksimal_pelaporan', maksimal_pelaporan);
            formData.append('label_mop', JSON.stringify(label_mop));
            formData.append('rate_mop', JSON.stringify(rate_mop));
            formData.append('status_mop', JSON.stringify(status_mop));
            formData.append('id_sob', id_sob);
            formData.append('id_d_sob', id_d_sob);
            formData.append('id_mop', id_mop);
            formData.append('i_dok_mop', JSON.stringify(i_dok_mop));
            formData.append('list_lob', JSON.stringify(list_lob));
            formData.append('list_premi', JSON.stringify(list_premi));
            formData.append('tgl_awal_polis', tgl_awal_polis);
            formData.append('tgl_akhir_polis', tgl_akhir_polis);

            formData.append('id_negara', id_negara);
            formData.append('id_provinsi', id_provinsi);
            formData.append('id_kota', id_kota);
            formData.append('id_kecamatan', id_kecamatan);
            formData.append('id_desa', id_desa);

                // maksimal_pelaporan      : maksimal_pelaporan,
                // label_mop               : label_mop,
                // rate_mop                : rate_mop,
                // status_mop              : status_mop,
                // id_sob                  : id_sob,
                // id_d_sob                : id_d_sob,
                // id_mop                  : id_mop

            swal({
                title       : 'Konfirmasi',
                text        : 'Yakin akan simpan data',
                type        : 'warning',

                buttonsStyling      : false,
                confirmButtonClass  : "btn btn-primary",
                cancelButtonClass   : "btn btn-danger mr-3",

                showCancelButton    : true,
                confirmButtonText   : 'Ya, simpan',
                confirmButtonColor  : '#3085d6',
                cancelButtonColor   : '#d33',
                cancelButtonText    : 'Batal',
                reverseButtons      : true
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        url     : "<?= base_url() ?>mop/simpan_data_mop",
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
                        data    : formData,
                        // data    : {
                        //     aksi                    : aksi,
                        //     no_reff_mop             : no_reff_mop,
                        //     no_mop                  : no_mop,
                        //     nama_mop                : nama_mop,         
                        //     no_polis_induk          : no_polis_induk,
                        //     id_insured              : id_insured,
                        //     id_insurer              : id_insurer,
                        //     id_cob                  : id_cob,
                        //     id_lob                  : id_lob,
                        //     nilai_pertanggungan     : nilai_pertanggungan,
                        //     objek_tertanggung       : objek_tertanggung,
                        //     kondisi_pertanggungan   : kondisi_pertanggungan,
                        //     pengecualian            : pengecualian,
                        //     keterangan_premi        : keterangan_premi,
                        //     resiko_sendiri          : resiko_sendiri,
                        //     limit_minimal           : limit_minimal,
                        //     berlaku_paling_lambat   : berlaku_paling_lambat,
                        //     batas_wilayah           : batas_wilayah,
                        //     penyampaian_deklarasi   : penyampaian_deklarasi,
                        //     maksimal_pelaporan      : maksimal_pelaporan,
                        //     label_mop               : label_mop,
                        //     rate_mop                : rate_mop,
                        //     status_mop              : status_mop,
                        //     id_sob                  : id_sob,
                        //     id_d_sob                : id_d_sob,
                        //     id_mop                  : id_mop
                        // },
                        contentType     : false,
                        cache           : false,
                        processData     : false,
                        dataType: "JSON",
                        success : function (data) {

                            if (data.status == 'gagal') {

                                swal({
                                    title               : "Peringatan",
                                    text                : 'Nomor MOP telah ada, harap ganti!',
                                    buttonsStyling      : false,
                                    confirmButtonClass  : "btn btn-primary",
                                    type                : 'warning',
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
                            });    
            
                            tabel_list_mop.ajax.reload(null,false);        
                            
                            $('#form_mop').trigger("reset");
            
                            $('#aksi').val('Tambah');

                            $('#no_reff_mop').val(data.no_reff_mop);

                            $('.f_tambah').slideToggle('fast', function() {
                                if ($(this).is(':visible')) {
                                    $('#status_toggle').val(1);          
                                } else {  
                                    $('#status_toggle').val(0);            
                                }        
                            });

                        },
                        error: function (jqXHR, textStatus, errorThrown)
                        {
                            swal({
                                title               : "Gagal",
                                text                : 'Gagal Simpan data',
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

                    // swal({
                    //     title               : "Batal",
                    //     text                : 'Anda membatalkan simpan data',
                    //     buttonsStyling      : false,
                    //     confirmButtonClass  : "btn btn-primary",
                    //     type                : 'error',
                    //     showConfirmButton   : false,
                    //     timer               : 3000,
                    //             allowOutsideClick   : false
                    // }); 
                }
            })

            return false;
            
            
        })

        // aksi batal mop
        $('.batal_mop').on('click', function () {

            $('#form_mop').trigger("reset");

            $('#aksi').val('Tambah');
            $('.hapus-mop').removeAttr('hidden');

            

            $('.f_tambah').slideToggle('fast', function() {
                if ($(this).is(':visible')) {
                    $('#status_toggle').val(1);          
                } else {  
                    $('#status_toggle').val(0);            
                }       
                
                $('html, body').animate({
                   scrollTop: $('body').offset().top
                }, 800);
            });



            $('#tambah_mop').attr('hidden', false);
        })

        // edit data mop
        $('#tabel_master_mop').on('click', '.edit-mop', function () {

            $("#form_mop").parsley().reset();

            var id_mop = $(this).data('id');
            // $('.hapus-mop').attr('hidden', true);
            // $('#tambah_mop').attr('hidden', true);

            var sts = $('#status_toggle').val();
            
            $('#judul_atas').val('Ubah Data');
            $('#batal_mop').removeAttr('hidden');

            $.ajax({
                url         : "<?= base_url() ?>mop/ambil_data_mop/"+id_mop,
                method      : "GET",
                dataType    : "JSON",
                success     : function (data) {

                    $('#aksi').val('Ubah');
                    $('#id_mop').val(data.cari_data.id_mop);
                    $('#no_reff_mop').val(data.cari_data.no_reff_mop);
                    $('#nama_mop').val(data.cari_data.nama_mop);
                    $('#no_polis_induk').val(data.cari_data.no_polis_induk);
                    $('#no_mop').val(data.cari_data.no_mop);
                    $('#id_insured').val(data.cari_data.id_insured).trigger('change');
                    $('#id_insurer').val(data.cari_data.id_insurer).trigger('change');
                    $('#nilai_pertanggungan').val(data.cari_data.nilai_pertanggungan);
                    $('#limit_minimal').val(data.cari_data.limit_minimal);
                    $('#berlaku_paling_lambat').val(data.cari_data.berlaku_paling_lambat);
                    $('#batas_wilayah').val(data.cari_data.batas_wilayah);
                    $('#maksimal_pelaporan').val(data.cari_data.maksimal_pelaporan);
                    
                    tinymce.get('objek_tertanggung').setContent(data.cari_data.objek_tertanggung);
                    tinymce.get('kondisi_pertanggungan').setContent(data.cari_data.kondisi_pertanggungan);
                    // tinymce.get('pengecualian').setContent(data.cari_data.pengecualian);
                    tinymce.get('keterangan_premi').setContent(data.cari_data.keterangan_premi);
                    tinymce.get('penyampaian_deklarasi').setContent(data.cari_data.penyampaian_deklarasi);
                    tinymce.get('resiko_sendiri').setContent(data.cari_data.resiko_sendiri);

                    $('#d_sob').val(data.cari_data.id_detail_sob).trigger('change');
                    $('#d_sob_sel').val(data.cari_data.id_detail_sob);

                    $('#id_sob').val(data.cari_data.id_sob).trigger('change');
                    $('#id_sob_sel').val(data.cari_data.id_sob);

                    $('#id_lob').val(data.cari_data.id_lob).trigger('change');
                    $('#id_lob_sel').val(data.cari_data.id_lob);
                    
                    $('#id_cob').val(data.cari_data.id_cob).trigger('change');
                    $('#id_cob_sel').val(data.cari_data.id_cob);

                    $('#id_negara_sel').val(data.cari_data.id_negara);
                    $('#id_provinsi_sel').val(data.cari_data.id_provinsi);
                    $('#id_kota_sel').val(data.cari_data.id_kota);
                    $('#id_kecamatan_sel').val(data.cari_data.id_kecamatan);
                    $('#id_desa_sel').val(data.cari_data.id_desa);

                    $('#id_negara').val(data.cari_data.id_negara).trigger('change');
                    
                    $('#tgl_awal_polis').val(data.tgl_awal_polis).trigger('change');
                    $('#tgl_akhir_polis').val(data.tgl_akhir_polis).trigger('change');

                    $('#tambah_prod_as').attr('disabled', false);
                    $('#id_asuransi_prod_as').val(data.cari_data.id_insurer);
                    $('#id_mop_prod_as').val(data.cari_data.id_mop);
                    tabel_prod_as.ajax.reload(null, false);

                    // sel_negara(data.cari_data.id_negara, data.cari_data.id_provinsi)
                    // sel_provinsi(data.cari_data.id_provinsi, data.cari_data.id_kota);
                    // sel_kota(data.cari_data.id_kota, data.cari_data.id_kecamatan);
                    // sel_kecamatan(data.cari_data.id_kecamatan, data.cari_data.id_desa);

                    $('#show_dokumen').html("");

                    if (data.list_dok.length != 0) {

                        var tr  = "";
                        var j   = 1;
                        var k   = 9000;
                        $.each(data.list_dok, function(key, value) {

                            var upd = "";
                            if (value.updated_time == null) {
                                upd = '-';
                            } else {
                                upd2 = value.updated_time;

                                // moment(upd2).format('DD-MM-YYYY h:mm:ss A');

                                var upd = moment(upd2).format('DD-MM-YYYY HH:mm:ss');
                            }

                            var fi = "";
                            var hi = "";
                            if (value.filename == null) {
                                fi = '-';
                                hi = 'hidden';
                            } else {
                                fi = value.filename;
                                hi = '';
                            }

                            tr += ` <tr id="list_add`+k+`">
                                        <td class="label_dok text-center" id="label_dok_`+k+`" data-id="`+k+`">`+j+`.</td>
                                        <td>
                                        Filename: <br> `+fi+` <br><br>
                                        <input type="file" id="dokumen_`+k+`" name="dokumen_`+k+`" class="form-control dokumen_mop" data-id="`+k+`" id_dokumen_mop="`+value.id_dokumen_mop+`">
                                        <input type="hidden" class="file_edit" id="file_edit_`+k+`" name="file_edit_`+k+`" data-id="`+k+`" value="`+value.filename+`">
                                        <br>
                                        Last update: `+upd+`
                                        </td>
                                        <td>
                                        <textarea id="desc_`+k+`" name="desc_`+k+`" rows='6' class="form-control desc_mop" data-id="`+k+`" placeholder="Deskripsi">`+value.description+`</textarea>
                                        <input type="hidden" class="desc_edit" id="desc_edit_`+k+`" name="desc_edit_`+k+`" data-id="`+k+`" value="`+value.description+`">
                                        </td>
                                        <td align="center">
                                        <span style="cursor:pointer;" data-toggle="tooltip" data-placement="top" title="Download" class="text-primary" data-id="`+k+`" `+hi+`><a href="<?= base_url() ?>upload/dokumen/`+value.filename+`"><i class="mdi mdi-file-document-outline mdi-24px"></i></a></span>
                                        <span style="cursor:pointer;" data-toggle="tooltip" data-placement="top" title="Hapus" class="remove text-danger" data-id="`+k+`"><i class="mdi mdi-trash-can-outline mdi-24px"></i></span></td>
                                    </tr>`;
                            
                            j++;
                            k++;
                        }); 

                        $('.tb_dok').slideDown();
                        $('#show_dokumen').html(tr);

                    }

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
                },
                error: function (jqXHR, textStatus, errorThrown)
                {
                    swal({
                        title               : "Gagal",
                        text                : 'Gagal Menampilkan data',
                        type                : 'error',
                        showConfirmButton   : false,
                        timer               : 3000,
                                allowOutsideClick   : false
                    }); 

                    return false;
                }
            })

        })

        // hapus mop
        $('#tabel_master_mop').on('click', '.hapus-mop', function () {
            
            var id_mop  = $(this).data('id');
            var sts     = $('#status_toggle').val();

            swal({
                title       : 'Konfirmasi',
                text        : 'Yakin akan hapus mop ?',
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
                        url         : "<?= base_url() ?>mop/simpan_data_mop",
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
                        data        : {aksi:'Hapus', id_mop:id_mop},
                        dataType    : "JSON",
                        success     : function (data) {

                                tabel_list_mop.ajax.reload(null,false);   

                                swal({
                                    title               : 'Hapus mop',
                                    text                : 'Data Berhasil Dihapus',
                                    buttonsStyling      : false,
                                    confirmButtonClass  : "btn btn-success",
                                    type                : 'success',
                                    showConfirmButton   : false,
                                    timer               : 3000,
                                allowOutsideClick   : false
                                }); 
                                
                                $('#form_mop').trigger("reset");

                                $('#aksi').val('Tambah');

                                $('#no_reff_mop').val(data.no_mop);

                                $('.hapus-mop').removeAttr('hidden');

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
                        error: function (jqXHR, textStatus, errorThrown)
                        {
                            swal({
                                title               : "Gagal",
                                text                : 'Gagal hapus data',
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

                    swal({
                            title               : 'Batal',
                            text                : 'Anda membatalkan hapus mop',
                            buttonsStyling      : false,
                            confirmButtonClass  : "btn btn-primary",
                            type                : 'error',
                            showConfirmButton   : false,
                            timer               : 3000,
                                allowOutsideClick   : false
                        }); 
                }
            })

        })

        // 11-06-2021
        // var a = 1;
        // $('#tambah_dokumen').on('click', function () {

        //     list = 
        //         `
        //         <div class="row" id="list_add`+a+`">
        //             <div class="col-md-12">
        //                 <div class="form-group row">
        //                     <label for="maksimal_pelaporan" class="col-md-3 col-form-label text-left label_dok" id="label_dok_`+a+`" data-id="`+a+`">Upload Dokumen `+a+`</label>
        //                     <div class="col-md-7">
        //                         <input type="file" id="dokumen_`+a+`" name="dokumen_`+a+`" class="form-control dokumen_mop" data-id="`+a+`">
        //                     </div>
        //                     <div class="col-md-2">
        //                         <button type="button" data-toggle="tooltip" data-placement="top" title="Hapus" class="btn btn-danger remove" data-id="`+a+`"><i class="fa fa-times"></i></button>
        //                     </div>
        //                     <label for="maksimal_pelaporan" class="col-md-3 mt-2 col-form-label text-left label_desc" id="label_desc_`+a+`" data-id="`+a+`">Deskripsi `+a+`</label>
        //                     <div class="col-md-7 mt-2">
        //                         <textarea id="desc_`+a+`" name="desc_`+a+`" class="form-control desc_mop" data-id="`+a+`" placeholder="Deskripsi"></textarea>
        //                     </div>
        //                 </div> 
        //                 <hr>
        //             </div>
        //         </div>
        //         `;    

        //     $('#show_dokumen').append(list);
        //     $('#list_add'+a).hide().slideDown();

        //     ubah_label();

        //     a++;
        
        // })

        // 30-08-2021
        $('#id_insurer').on('change', function () {

            var id_insurer  = $(this).val();
            var aksi        = $('#aksi').val();

            if (id_insurer == '') {

                if (aksi == 'Tambah') {
                    $('#tambah_produk_asuransi').attr('hidden', false);
                    $('#tambah_produk_asuransi').attr('disabled', true);
                } else {
                    $('#tambah_prod_as').attr('hidden', false);
                    $('#tambah_prod_as').attr('disabled', true);
                }
                
            } else {

                if (aksi == 'Tambah') {
                    $('#tambah_prod_as').attr('hidden', true);
                    $('#tambah_produk_asuransi').attr('hidden', false);
                    $('#tambah_produk_asuransi').attr('disabled', false);
                } else {
                    $('#tambah_produk_asuransi').attr('hidden', true);
                    $('#tambah_prod_as').attr('hidden', false);
                    $('#tambah_prod_as').attr('disabled', false);
                }

            }

            // $.ajax({
            //     url     : "<?= base_url() ?>mop/tampil_list_lob",
            //     method  : "POST",
            //     data    : {id_insurer:id_insurer},
            //     dataType: "JSON",
            //     success : function (data) {

            //         if (data.list_data == '') {
            //             tr = `<tr>
            //                     <td colspan='4' align='center'>Data Produk Asuransi Kosong</td>
            //                 </tr>`;

            //             $('#show_prod_as').html(tr);
            //         } else {
            //             $('#show_prod_as').html(data.list_data);
            //         }

            //         $('.select2').select2({
            //             theme       : 'bootstrap4',
            //             width       : 'style',
            //             placeholder : $(this).attr('placeholder'),
            //             allowClear  : false
            //         });

            //     },
            //     error: function (jqXHR, textStatus, errorThrown)
            //     {
            //         swal({
            //             title               : "Gagal",
            //             text                : 'Gagal menampilkan data',
            //             type                : 'error',
            //             showConfirmButton   : true,
            //             allowOutsideClick   : false
            //         }); 

            //         return false;
            //     }
            // }) 

            // return false;
            
        })

        // 30-08-2021
        var pa = 10000;
        $('#tambah_produk_asuransi').on('click', function () {

            var list_lob = $('#list_lob').html();

            var label_prod_as = [];
            $('.label_prod_as').each(function() { 
                label_prod_as.push($(this).val()); 
            });

            if (label_prod_as.length == 0) {
                $('#show_prod_as').html('');
            }

            var list = "";

            list = 
                `
                <tr id="list_add_prod_as`+pa+`">
                    <td class="label_prod_as text-center" id="label_prod_as_`+pa+`" data-id="`+pa+`">`+pa+`.</td>
                    <td width="50%">
                        <select name="lob_`+pa+`" id="lob_`+pa+`" data-id="`+pa+`" class="form-control select2 list_lob">
                            `+list_lob+`
                        </select>
                    </td>
                    <td>
                        <input type="text" class="form-control text-right numeric number_separator list_premi" name="premi_`+pa+`" id="premi_`+pa+`" data-id="`+pa+`" placeholder="0">
                    </td>
                    <td align="center">
                        <span style="cursor:pointer;" class="remove text-danger" data-id="`+pa+`"><i class="mdi mdi-trash-can-outline mdi-24px"></i></span>
                    </td>
                </tr>
                `;    

            $('#show_prod_as').append(list);
            $('#list_add_prod_as'+pa).hide().slideDown();

            $('.numeric').numericOnly();

            $('.number_separator').divide({
                delimiter:'.',
                divideThousand: true, // 1,000..9,999
                delimiterRegExp: /[\.\,\s]/g
            });

            $('.select2').select2({
                theme       : 'bootstrap4',
                width       : 'style',
                placeholder : $(this).attr('placeholder'),
                allowClear  : false
            });


            ubah_label_prod_as();

            pa++;
            
        })

        // 11-06-2021
        $('#show_prod_as').on('click', '.remove', function() {

            var id = $(this).data('id');

            $('#list_add_prod_as'+id).fadeOut(function(){ 

                $(this).remove();

                var label_prod_as = [];
                $('.label_prod_as').each(function() { 
                    label_prod_as.push($(this).val()); 
                });

                if (label_prod_as.length == 0) {

                    tr = `<tr>
                            <td colspan='4' align='center'>Data Produk Asuransi Kosong</td>
                        </tr>`;

                    $('#show_prod_as').html(tr);
                }

                ubah_label_prod_as();
            });


        });

        // ubah label
        function ubah_label_prod_as() {

            var label_prod_as  = [];
            $('.label_prod_as').each(function() { 
                label_prod_as.push($(this).data('id')); 
            });

            let i = 1;
            for (let h = 0; h < label_prod_as.length; h++) {
                const element = label_prod_as[h];
                
                $('#label_prod_as_'+element).text(i+".");

                i++;
            }

        }

        // 14-06-2021
        var a = 1;
        $('#tambah_dokumen').on('click', function () {

            $('.tb_dok').slideDown();

            list = 
                `
                <tr id="list_add`+a+`">
                    <td class="label_dok text-center" id="label_dok_`+a+`" data-id="`+a+`">`+a+`.</td>
                    <td>
                        <input type="file" id="dokumen_`+a+`" name="dokumen_`+a+`" class="form-control dokumen_mop" data-id="`+a+`" id_dokumen_mop="">
                        <input type="hidden" class="file_edit" id="file_edit_`+a+`" name="file_edit_`+a+`" data-id="`+a+`" value="baru">
                    </td>
                    <td><textarea id="desc_`+a+`" name="desc_`+a+`" class="form-control desc_mop" data-id="`+a+`" placeholder="Deskripsi"></textarea></td>
                    <td align="center"><span style="cursor:pointer;" data-toggle="tooltip" data-placement="top" title="Hapus" class="remove text-danger" data-id="`+a+`"><i class="mdi mdi-trash-can-outline mdi-24px"></i></span></td>
                </tr>
                `;    

            $('#show_dokumen').append(list);
            $('#list_add'+a).hide().slideDown();

            ubah_label();

            a++;
        
        })

        // 11-06-2021
        $('#show_dokumen').on('click', '.remove', function() {

            var id = $(this).data('id');

            $('#list_add'+id).fadeOut(function(){ 

                $(this).remove();

                var label_dok = [];
                $('.label_dok').each(function() { 
                    label_dok.push($(this).val()); 
                });

                if (label_dok.length == 0) {

                    $('.tb_dok').slideUp(30);
                }

                ubah_label();
            });


        });

        // ubah label
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

        // 22-06-2021
        $('#id_negara').on('change', function () {

            var id_negara       = $(this).val();
            var id_provinsi     = $('#id_provinsi_sel').val();

            $.ajax({
                url     : "<?= base_url() ?>mop/option_provinsi",
                method  : "POST",
                data    : {id_negara:id_negara},
                dataType: "JSON",
                success : function (data) {

                    if (data.jumlah == 0) {
                        $('#id_kota').val('').trigger('change');
                        $('#id_kecamatan').val('').trigger('change');
                        $('#id_desa').val('').trigger('change');

                        $('#id_provinsi').attr('disabled', true);
                        $('#id_kota').attr('disabled', true);
                        $('#id_kecamatan').attr('disabled', true);
                        $('#id_desa').attr('disabled', true);
                    } else {
                        $('#id_provinsi').attr('disabled', false);
                    }

                    $('#id_provinsi').html(data.option);
                    $('#id_provinsi').val(id_provinsi).trigger('change');

                },
                error: function (jqXHR, textStatus, errorThrown)
                {
                    swal({
                        title               : "Gagal",
                        text                : 'Gagal menampilkan data',
                        type                : 'error',
                        showConfirmButton   : false,
                        timer               : 3000,
                                allowOutsideClick   : false
                    }); 

                    return false;
                }
            }) 

            return false;

            // var id_negara_sel   = $('#id_negara_sel').val();
            // var id_provinsi     = $('#id_provinsi_sel').val();

            // console.log(id_negara);

            // // if (id_negara_sel != '') {

            // //     if (id_negara == '') {
            // //         id_negara = id_negara;
            // //     } else {
            // //        id_negara = id_negara_sel; 
            // //     }
                
            // // } else {
            // //     id_negara = id_negara;
            // // }

            // if (id_provinsi != '') {
            //     sel_negara(id_negara, id_provinsi);
            // }

        })

        // 22-06-2021
        $('#id_provinsi').on('change', function () {

            var id_provinsi     = $(this).val();
            var id_kota         = $('#id_kota_sel').val();
            
            $.ajax({
                url     : "<?= base_url() ?>mop/option_kota",
                method  : "POST",
                data    : {id_provinsi:id_provinsi},
                dataType: "JSON",
                success : function (data) {

                    if (data.jumlah == 0) {

                        $('#id_kecamatan').val('').trigger('change');
                        $('#id_desa').val('').trigger('change');

                        $('#id_kota').attr('disabled', true);
                        $('#id_kecamatan').attr('disabled', true);
                        $('#id_desa').attr('disabled', true);
                    } else {
                        $('#id_kota').attr('disabled', false);
                    }

                    $('#id_kota').html(data.option);
                    $('#id_kota').val(id_kota).trigger('change');


                    // $('#id_kecamatan').val('').trigger('change');
                    // $('#id_desa').val('').trigger('change');
                    // $('#id_kecamatan').attr('disabled', true);
                    // $('#id_desa').attr('disabled', true);

                },
                error: function (jqXHR, textStatus, errorThrown)
                {
                    swal({
                        title               : "Gagal",
                        text                : 'Gagal menampilkan data',
                        type                : 'error',
                        showConfirmButton   : false,
                        timer               : 3000,
                                allowOutsideClick   : false
                    }); 

                    return false;
                }
            }) 

            return false;

            // var id_provinsi_sel = $('#id_provinsi_sel').val();
            // var id_kota         = $('#id_kota_sel').val();

            // console.log(id_provinsi);

            // // if (id_provinsi_sel != '') {

            // //     if (id_provinsi == '') {
            // //         id_provinsi = id_provinsi;
            // //     } else {
            // //        id_provinsi = id_provinsi_sel; 
            // //     }

            // // } else {
            // //     id_provinsi = id_provinsi;
            // // }
            
            // if (id_kota != '') {
            //     sel_provinsi(id_provinsi, id_kota);
            // }
            

        })

        // 22-06-2021
        $('#id_kota').on('change', function () {

            var id_kota         = $(this).val();
            var id_kecamatan    = $('#id_kecamatan_sel').val();

            $.ajax({
                url     : "<?= base_url() ?>mop/option_kecamatan",
                method  : "POST",
                data    : {id_kota:id_kota},
                dataType: "JSON",
                success : function (data) {

                    if (data.jumlah == 0) {

                        $('#id_desa').val('').trigger('change');

                        $('#id_kecamatan').attr('disabled', true);
                        $('#id_desa').attr('disabled', true);
                    } else {
                        $('#id_kecamatan').attr('disabled', false);
                    }

                    $('#id_kecamatan').html(data.option);
                    $('#id_kecamatan').val(id_kecamatan).trigger('change');

                    // $('#id_desa').val('').trigger('change');
                    // $('#id_desa').attr('disabled', true);

                },
                error: function (jqXHR, textStatus, errorThrown)
                {
                    swal({
                        title               : "Gagal",
                        text                : 'Gagal menampilkan data',
                        type                : 'error',
                        showConfirmButton   : false,
                        timer               : 3000,
                                allowOutsideClick   : false
                    }); 

                    return false;
                }
            }) 

            return false;

            // var id_kota_sel     = $('#id_kota_sel').val();
            // var id_kecamatan    = $('#id_kecamatan_sel').val();

            // console.log(id_kota);
            
            // // if (id_kota_sel != '') {

            // //     if (id_kota == '') {
            // //         id_kota = id_kota;
            // //     } else {
            // //        id_kota = id_kota_sel; 
            // //     }

            // // } else {
            // //     id_kota = id_kota;
            // // }

            // if (id_kecamatan != '') {
            //     sel_kota(id_kota, id_kecamatan);
            // }
            

        })

        // 22-06-2021
        $('#id_kecamatan').on('change', function () {

            var id_kecamatan        = $(this).val();
            var id_desa             = $('#id_desa_sel').val();

            $.ajax({
                url     : "<?= base_url() ?>mop/option_desa",
                method  : "POST",
                data    : {id_kecamatan:id_kecamatan},
                dataType: "JSON",
                success : function (data) {

                    if (data.jumlah == 0) {
                        $('#id_desa').attr('disabled', true);
                    } else {
                        $('#id_desa').attr('disabled', false);
                    }

                    $('#id_desa').html(data.option);
                    
                    $('#id_desa').val(id_desa).trigger('change');
                    

                },
                error: function (jqXHR, textStatus, errorThrown)
                {
                    swal({
                        title               : "Gagal",
                        text                : 'Gagal menampilkan data',
                        type                : 'error',
                        showConfirmButton   : false,
                        timer               : 3000,
                                allowOutsideClick   : false
                    }); 

                    return false;
                }
            }) 

            return false;

            // $('#id_kecamatan_sel').val('baru');

            // var id_kecamatan_sel    = $('#id_kecamatan_sel').val();

            // // if (id_kecamatan_sel != '') {

            // //     if (id_kecamatan == '') {
            // //         id_kecamatan = id_kecamatan;
            // //     } else {
            // //        id_kecamatan = id_kecamatan_sel; 
            // //     }

            // // } else {
            // //     id_kecamatan = id_kecamatan;
            // // }

            // console.log(id_kecamatan_sel);

            // if (id_kecamatan_sel == 'baru') {
            //     console.log('masuk');
            //   sel_kecamatan(id_kecamatan, '');  
            // }

        })

        // 01-09-2021
        var tabel_prod_as = $('#tabel_prod_as').DataTable({
            "processing"        : true,
            "order"             : [],
            "ajax"              : {
                "url"   : "<?= base_url() ?>mop/tampil_produk_asuransi",
                "type"  : "POST",
                "data"  : function (data) {
                    data.id_mop = $('#id_mop').val();
                    data.aksi   = "edit";
                }
            },
            "columnDefs"        : [{
                "targets"   : [0,3],
                "orderable" : false
            }, {
                'targets'   : [0,3],
                'className' : 'text-center',
            }],
            "bPaginate"     : false,
            "bLengthChange" : false,
            "bFilter"       : false,
            "bInfo"         : false,
            "language": {
                "emptyTable": "Data Produksi Kosong"
            }
        })

        $('#tambah_prod_as').on('click', function () {

            $('#modal_prod_as').modal('show');
            $('#aksi_prod_as').val('Tambah');
            $('#id_lob').val('').trigger('change');
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