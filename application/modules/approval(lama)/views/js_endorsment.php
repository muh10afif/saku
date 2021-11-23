
<script type="text/javascript">
  $(document).ready(function () {

    $('#sobb').change(function () {
      var id  = $(this).val();
      var txt = $(this).find(':selected').text();

      $('.nama_sob').val(txt);

      if (id == 'pilih') {

        $('.d2_sob').slideUp(100);
        $('#tocc').attr('disabled', true);
        $('#tocc').val('pilih').trigger('change');
        $('#lbln').text('Detail SOB');
        
      } else {

        $.ajax({
          type      :"GET",
          url       :"<?php echo base_url(); ?>entry_sppa/settoc/"+id,
          success   : function (data) {
            
            var hss = JSON.parse(data);

            if (hss[0].length <= 0) {

              swal({
                title             : "Peringatan",
                html              : "List data "+txt+" kosong",
                type              : 'warning',
                showConfirmButton : false,
                timer             : 3000
              });

              $('#lbln').html("SOB "+hss[1]);
              $('.d2_sob').slideUp();
              $('#tocc').attr('disabled', true);
              $('#tocc').val('pilih').trigger('change');

            } else {

              var opt = '<option value="pilih">Pilih</option>';
              for (var i = 0; i < hss[0].length; i++) {
                opt = opt+'<option value='+hss[0][i].id+'>'+hss[0][i].nama+'</option>';
              }

              $('#tocc').attr('disabled', false);
              $('#lbln').html("SOB "+hss[1]);
              $('#tocc').html(opt);
              $('.set-here').html('');

            }

            $('.d2_sob').slideUp();

          }
        }); 

      }

      disabled_client_data();
      
    });

    $('#tocc').change(function () {
      var id = $(this).val();
      var sb = $('#sobb').val();

      if (sb != 'pilih') {
        $.ajax({
          type      :"POST",
          url       :"<?php echo base_url(); ?>entry_sppa/showdetailn",
          
          data      : { isob:sb, ityp:id },
          dataType  : "JSON",
          success   : function (data) {

            if (data[0][0].nama) {
              $('#d2_telp').text(": "+data[0][0].telp);
              $('#d2_alamat').text(": "+data[0][0].alamat);
              $('.d2_sob').slideDown(); 
            } else {
              $('.d2_sob').slideUp(); 
            }

            
          }
        });
      }

      disabled_client_data();
    });

    $('#cobb').change(function () {
      var id = $(this).val();

      if (id == 'pilih') {

        var opt = '<option value="pilih">-- Pilih --</option>';
        $('#lobb').html(opt);
        $('#lobb').val('pilih').trigger('change');

        $('.c_lob').fadeOut(100);

      } else {

        $.ajax({
          type:"GET",
          url:"<?php echo base_url(); ?>entry_sppa/showboth/"+id,
          success  : function (data) {
            var hss = JSON.parse(data); 
            var opt = '<option value="pilih">-- Pilih --</option>';
            for (var i = 0; i < hss.length; i++) {
              opt = opt+'<option value='+hss[i].id_lob+' id_relasi='+hss[i].id_relasi_cob_lob+'>'+hss[i].lob+'</option>';
            }
            $('#lobb').html(opt);

            $('.c_lob').fadeIn();
          }
        });

      }

      disabled_client_data();
      
    });

    if( typeof window.tinymce != 'undefined' && $(window.tinymce.editors).length > 0 ){
        $(window.tinymce.editors).each(function(idx) {
            try {
            tinymce.remove(idx);
            } catch (e) {}
        });
    }

    $('#lobb').change(function () {
      var id        = $(this).val();
      var id_relasi = $(this).find(':selected').attr('id_relasi');

      $('.id_relasi').val(id_relasi);
      $('.id_lob').val(id);

      $.ajax({
        type      :"GET",
        url       :"<?php echo base_url(); ?>entry_sppa/shwfild/"+id_relasi,
        success   : function (data) {

          var hss   = JSON.parse(data); 
          var show  = '';

          var txta = '';
          for (var i = 0; i < hss.length; i++) {
            show = show+hss[i]['html'];
            
            if (hss[i]['txta'] != '') {
              txta = hss[i]['txta'];
            } else {
              txta = '';
            }
            
          }

          tinymce.remove("textarea.tiny");

          $('#here').html(show);

          $('.datepicker').datepicker({
              autoclose: true,
              todayHighlight: false,
              format: "dd-mm-yyyy",
              clearBtn: true,
              orientation: 'bottom'
          });

          tinymce.init({
                selector: "textarea.tiny",
                theme: "modern",
                height:300,
                plugins: [
                    "advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker",
                    "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
                    "save table contextmenu directionality emoticons template paste textcolor"
                ],
                toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | l      ink image | print preview media fullpage | forecolor backcolor emoticons",
                style_formats: [
                    {title: 'Bold text', inline: 'b'},
                    {title: 'Red text', inline: 'span', styles: {color: '#ff0000'}},
                    {title: 'Red header', block: 'h1', styles: {color: '#ff0000'}},
                    {title: 'Example 1', inline: 'span', classes: 'example1'},
                    {title: 'Example 2', inline: 'span', classes: 'example2'},
                    {title: 'Table styles'},
                    {title: 'Table row 1', selector: 'tr', classes: 'tablerow1'}
                ]
            });

          $('.numeric').numericOnly();

          $('.number_separator').divide({
              delimiter:'.',
              divideThousand: true, // 1,000..9,999
              delimiterRegExp: /[\.\,\s]/g
          });

          if (id != 'pilih') {
            $.ajax({
                type      : "GET",
                url       : "<?php echo base_url(); ?>entry_sppa/show_premi/"+id,
                dataType  : "JSON",
                success   : function (data) {
                  
                  $('#show_premi').html(data.htmlnya);
                  $('.lob_lain').html(data.option_lob);
                  $('#total_persen_premi').val(data.total_rate);
                  $('#tambah_additional').attr('id_lob', id);
                  $('#kondisi_diskon').val(data.kondisi_diskon);

                  $('.label_tipe_diskon').text("Discount terhadap "+data.kondisi_diskon);

                  $('.persen').keyup(function(){
                      var val = $(this).val();
                      if(isNaN(val)){
                          val = val.replace(/[^0-9\.]/g,'');
                          if(val.split('.').length>2) 
                              val =val.replace(/\.+$/,"");
                      }
                      $(this).val(val); 
                  });

                  var value         = $('#tsi').val().split('.').join('');

                  $('.total_premi').each(function () {
                            
                      var aksi      = $(this).attr('label');
                      var persen    = $(this).val();

                      var total     = value * (persen / 100);


                      $('.p_total_'+aksi).val(number_format(total,0,',','.'));
                      $('.p_total_asli_'+aksi).val(number_format(total,0,',','.'));
                      

                  })

                  if (data.htmlnya != '') {
                    total2();
                  }

                  if (hss.length == 0 && data.htmlnya == '') {

                    swal({
                        title               : "Peringatan",
                        text                : 'Field SPPA dan Coverage Belum Ada!',
                        buttonsStyling      : false,
                        type                : 'warning',
                        confirmButtonClass  : "btn btn-lg btn-primary",
                        confirmButtonText   : ' O K '
                    }); 

                    // $('.link_entry').addClass('disabled');
                    // $('.lanjutkan').attr('disabled', true);
                    
                  } else if (hss.length == 0) {
                    swal({
                        title               : "Peringatan",
                        text                : 'Field SPPA Belum Ada!',
                        buttonsStyling      : false,
                        type                : 'warning',
                        confirmButtonClass  : "btn btn-primary",
                        confirmButtonText   : ' O K '
                    }); 

                    // $('.link_entry').addClass('disabled');
                    // $('.lanjutkan').attr('disabled', true);
                  } else if (data.htmlnya == '') {
                    swal({
                        title               : "Peringatan",
                        text                : 'Coverage Belum Ada!',
                        buttonsStyling      : false,
                        type                : 'warning',
                        confirmButtonClass  : "btn btn-primary",
                        confirmButtonText   : ' O K '
                    }); 

                    // $('.link_entry').removeClass('disabled');
                    // $('.lanjutkan').attr('disabled', true);
                  } else {
                    // $('.link_entry').removeClass('disabled');
                    // $('.lanjutkan').attr('disabled', false);
                  }

                  
                }
            });

          } else {

            $('#show_premi').html('');
            $('.lob_lain').html('');
            total2();
            
          }

          disabled_client_data();

        }
      });
    });

    // fungsi disabled button client data
    function disabled_client_data() {
      var tocc = $('#tocc').val();
      var lobb = $('#lobb').val();

      if (tocc == 'pilih' || lobb == 'pilih') {
        $('#simpan_client').attr('disabled', true);
      } else {
        $('#simpan_client').attr('disabled', false);
      }
    }

    // AFIF

    var i = 1;

    $('#tambah_dok').on('click', function () {

        list = 
            `
            <div class="d-flex justify-content-center list_d" id="list_dok`+i+`">
                <div class="col-md-3 text-right mt-1">
                    <label class="col-form-label">Dokumen</label>
                </div>
                <div class="col-md-4">
                    <div class="form-group row p-0">
                        
                        <div class="col-sm-12">
                            <input type="file" class="form-control dok" id="dokumen`+i+`" name="dokumen[]" judul="dokumen" accept="application/msword, application/pdf">
                            <span class="text-danger" id="dokumen`+i+`_error"></span>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-2">
                    <div class="form-group row p-0">
                        <div class="col-sm-12">
                            <button type="button" data-toggle="tooltip" data-placement="top" title="Hapus" class="btn btn-danger remove ttip" data-id="`+i+`"><i class="fa fa-times"></i></button>
                        </div>
                    </div>
                    
                </div>
            </div>
            `;    

        $('.list_baru_dok').append(list);
        $('#list_dok'+i).hide().slideDown();

        i++;

    })

    $('.list_baru_dok').on('click', '.remove', function() {

        var id = $(this).data('id');

        $('#list_dok'+id).slideUp(function(){ $(this).remove();});

    });

    function total2() {

      var isi     = $('#diskon').val().split('.').join('');
      var kondisi = $('#kondisi_diskon').val();

      var total_krg = 0;

      if (kondisi == 'premi standar') {

        var isi_premi = $('.premi_asli_standar').val().split('.').join('');

        var total   = 0;
        var ttl_tt  = 0;

        if (isi == '' || isi == 0) {
          total   =  isi_premi;
          ttl_tt  = 0;
        } else {
          ttl_tt   = parseInt(isi_premi) * (isi / 100);
          total = parseInt(isi_premi) - parseInt(ttl_tt);
        }
        
        // $('.premi_standar').val(number_format(total,0,',','.'));   
        
      } else {

        var isi_premi_tt = $('#total_akhir_premi_asli').val().split('.').join('');

        var total_tt    = 0;
        var ttl_tt      = 0;

        if (isi == '' || isi == 0) {
          total_tt  =  isi_premi_tt;
          total_krg = 0
        } else {
          ttl_tt    = (parseInt(isi_premi_tt) / 100) * isi;
          total_tt  = parseInt(isi_premi_tt) - parseInt(ttl_tt);
          total_krg = ttl_tt;
        }
        
        $('#total_akhir_premi').val(number_format(total_tt,0,',','.'));

      }

      var total_persen        = 0;
      var total_persen_lain   = 0;
      var total_nilai         = 0;
      var total_nilai_lain    = 0;
      $('.total_premi').each(function () {
                
          var persen    = $(this).val();
          
          total_persen  += parseFloat(persen);

      })

      $('.premi_lain').each(function () {
                
          var persen1    = $(this).val();
          
          total_persen_lain  += parseFloat(persen1);

      })

      $('.total_premi_rp').each(function () {
                
          var nilai    = $(this).val().split('.').join('');
          
          total_nilai  += parseInt(nilai);

      })

      $('.premi_rp_lain').each(function () {
                
        var nilai1    = $(this).val().split('.').join('');
          
        total_nilai_lain  += parseInt(nilai1);

      })

      var tt_persen = total_persen.toFixed(4) + total_persen_lain.toFixed(4);

      var tap = (parseInt(total_nilai) + parseInt(total_nilai_lain) - (parseInt(total_krg))) - parseInt(ttl_tt);

      $('#total_persen_premi').val(parseFloat(tt_persen));
      $('#total_akhir_premi').val(number_format(tap,0,',','.'));
      $('#total_akhir_premi_asli').val(number_format(parseInt(total_nilai) + parseInt(total_nilai_lain),0,',','.'));
      $('#gross_premi').val(number_format(parseInt(total_nilai) + parseInt(total_nilai_lain),0,',','.'));
      $('#total_diskon').val(number_format(ttl_tt,0,',','.'));

      var biaya_admin = $('#biaya_admin').val().split('.').join('');
      var total_premi = $('#total_akhir_premi').val().split('.').join('');

      var tt_tagihan  = parseInt(biaya_admin) + parseInt(total_premi);

      if (biaya_admin == '') {
        tt_tagihan = total_premi;
      }

      $('#total_tagihan').val(number_format(tt_tagihan,0,',','.'));

      return true;

    }

    var a = 9999;
    // 11-05-2021
    $('#tambah_additional').on('click', function () {

      var id = $(this).attr('id_lob');

      list = 
            `
            <div class="row" id="list_add`+a+`">
              <div class="col-md-12">
                  <div class="form-group row p-0">
                      <div class="col-sm-12">
                          <button type="button" data-toggle="tooltip" data-placement="top" title="Hapus" class="btn btn-danger remove" data-id="`+a+`"><i class="fa fa-times"></i></button>
                      </div>
                  </div>
                  
              </div>
              <div class="col-md-6">
                  <div class="form-group row">
                      <label for="no_klaim" class="col-sm-4 col-form-label">Pilih LOB Lainnya</label>
                      <div class='col-sm-8'>
                        <select name="lob_lain" class="select2 lob_lain lob_adt">
                          <option value=""></option>
                        </select>
                      </div>
                  </div>    
                  <div class="form-group row">
                      <label for="no_klaim" class="col-sm-4 col-form-label">Kalkulasi Sum Insurance</label>
                      <div class='col-sm-8'>
                        <div class="input-group mb-3">
                          <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">Rp.</span>
                          </div>
                          <input type="text" class="text-right form-control kalkulasi_tsi_adt" id="kalkulasi`+a+`" placeholder="0" readonly>
                        </div>
                      </div>
                  </div>    
              </div>
              <div class="col-md-6">
                <div class="form-group row">
                      <label for="no_klaim" class="col-sm-4 col-form-label">Persentase Pengali TSI</label>
                      <div class='col-sm-8'>
                        <div class='input-group'>
                          <input type='text' class='form-control text-right persen pengali pengali_tsi_adt' data-id="`+a+`" placeholder="0">
                          <div class='input-group-append'>
                              <span class='input-group-text' id='basic-addon2'>%</span>
                          </div>
                        </div>
                      </div>
                  </div>  
                  <div class="form-group row">
                      <label for="no_klaim" class="col-sm-4 col-form-label">Premi</label>
                      <div class='col-sm-4'>
                        <div class='input-group'>
                          <input type='text' class='form-control text-right persen premi_lain rate_adt rate_`+a+`' data-id="`+a+`" placeholder="0">
                          <div class='input-group-append'>
                              <span class='input-group-text' id='basic-addon2'>%</span>
                          </div>
                        </div>
                      </div>
                      <div class="col-sm-4">
                          <input type="text" class="form-control text-right premi_rp_lain nominal_adt"  id="t_premi_lain`+a+`" value="0" readonly>
                      </div>
                  </div> 
              </div>
            </div>
            `;    

        $('#show_additional').append(list);
        $('#list_add'+a).hide().slideDown();

        $('.select2').select2({
            theme       : 'bootstrap4',
            width       : 'style',
            placeholder : $(this).attr('placeholder'),
            allowClear  : false
        });

        $('.persen').keyup(function(){
            var val = $(this).val();
            if(isNaN(val)){
                val = val.replace(/[^0-9\.]/g,'');
                if(val.split('.').length>2) 
                    val =val.replace(/\.+$/,"");
            }
            $(this).val(val); 
        });

        $.ajax({
            type:"GET",
            url:"<?php echo base_url(); ?>entry_sppa/show_premi/"+id,
            dataType : "JSON",
            success  : function (data) {
              
              $('.lob_lain').html(data.option_lob);

            }
        });

        a++;
      
    })

    $('#show_additional').on('click', '.remove', function() {

      var id = $(this).data('id');

      $('#list_add'+id).slideUp(function(){ 
        $(this).remove();

        total2();
      
      });

    });


    $('#show_additional').on('keyup', '.pengali', function () {

      var id    = $(this).data('id');
      var value = $(this).val();
      var tsi   = $('#tsi').val().split('.').join('');

      var total = tsi * (value / 100);

      $('#kalkulasi'+id).val(number_format(total,0,',','.'));

      var rate_lain = $('.rate_'+id).val();
      var kalkulasi = $('#kalkulasi'+id).val().split('.').join('');

      var totall = kalkulasi * (rate_lain / 100);

      $('#t_premi_lain'+id).val(number_format(totall,0,',','.'));

      total2();
      
    })

    $('#show_additional').on('keyup', '.premi_lain', function () {

      var id    = $(this).data('id');
      var value = $(this).val();
      var si    = $('#kalkulasi'+id).val().split('.').join('');

      var total = si * (value / 100);

      $('#t_premi_lain'+id).val(number_format(total,0,',','.'));

      total2();
      
    })

    $('#batal_dok').on('click', function () {

      $('#doc').val('');
      $('#desc').val('');
      $('#simpan_dok').text('Simpan');
      $('#aksi').val('Tambah');

    })


    // 10-05-2021
    $('#simpan_dok').on('click', function () {

        var form_data = new FormData($('#form_dokumen')[0]);

        $.ajax({
            url: '<?= base_url("entry_sppa/simpan_dokumen") ?>',
            dataType: 'json',
            cache: false,
            contentType: false,
            processData: false,
            data: form_data,
            type: 'post',
            success: function(data){
              tabel_dok.ajax.reload(null, false);

              $('#simpan_dok').text('Simpan');

              $('#doc').val('');
              $('#desc').val('');
              
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
                data.id_sppa  = $('#id_sppa_dok').val();
                data.aksi     = 'edit';
            },
        },
        "columnDefs"        : [{
            "targets"   : [0,5],
            "orderable" : false
        }, {
            'targets'   : [0,4,5],
            'className' : 'text-center',
        }]
    })

    $('#tabel_dok').on('click', '.edit', function () {

      var id_dokumen  = $(this).data('id');
      var desc        = $(this).attr('desc');
      var filename    = $(this).attr('filename');

      $('#id_dokumen').val(id_dokumen);
      $('#nama_dokumen').val(filename);
      $('#desc').val(desc);

      $('#simpan_dok').text('Ubah Dokumen');
      $('#aksi').val('Ubah');

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
                    error       : function(xhr, status, error) {
                        var err = eval("(" + xhr.responseText + ")");
                        alert(err.Message);
                    }

                })

                return false;
            } else if (result.dismiss === swal.DismissReason.cancel) {

                swal({
                        title               : 'Batal',
                        text                : 'Anda membatalkan hapus dokumen',
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

    $('.persen').keyup(function(){
        var val = $(this).val();
        if(isNaN(val)){
            val = val.replace(/[^0-9\.]/g,'');
            if(val.split('.').length>2) 
                val =val.replace(/\.+$/,"");
        }
        $(this).val(val); 
    });

    // 07-05-2021
    $('#diskon').on('keyup', function () {

      var value  = $(this).val().split('.').join('');

      $('#diskon').val(Math.max(Math.min(value, 100), -100)); 
      
      total2();
    
    })

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

    $('#tsi').on('keyup', function () {

      var value         = $(this).val().split('.').join('');

      $('.total_premi').each(function () {
                
          var aksi      = $(this).attr('label');
          var persen    = $(this).val();

          var total     = value * (persen / 100);


          $('.p_total_'+aksi).val(number_format(total,0,',','.'));
          $('.p_total_asli_'+aksi).val(number_format(total,0,',','.'));
          

      })

      total2();
      
    })

    $('#show_premi').on('keyup', '.total_premi', function () {
      
      var aksi      = $(this).attr('label');
      var persen    = $(this).val();
      var value     = $('#tsi').val().split('.').join('');

      var total     = value * (persen / 100);

      $('.p_total_'+aksi).val(number_format(total,0,',','.'));

      total2();

    })

    $('#biaya_admin').on('keyup', function () {

      var biaya_admin = $('#biaya_admin').val().split('.').join('');
      var total_premi = $('#total_akhir_premi').val().split('.').join('');

      var tt_tagihan  = parseInt(biaya_admin) + parseInt(total_premi);

      if (biaya_admin == '') {
        tt_tagihan = total_premi;
      }

      $('#total_tagihan').val(number_format(tt_tagihan,0,',','.'));
      
    })
    
    $('#payment_method').on('change', function () {

      var value = $(this).val();

      if (value == '') {
        $('.f_pay').fadeOut();
      } else {
        $('.f_pay').fadeIn();
      }
      
    })

    // 11-05-2021
    var tabel_termin = $('#tabel_termin').DataTable({
        "processing"        : true,
        "order"             : [],
        "ajax"              : {
            "url"   : "<?= base_url() ?>entry_sppa/tampil_data_termin",
            "type"  : "POST",
            "data"  : function (data) {
                data.id_sppa = $('#id_sppa_termin').val();
            },
        },
        "columnDefs"        : [{
            "targets"   : [0,6],
            "orderable" : false
        }, {
            'targets'   : [0,6],
            'className' : 'text-center',
        }],
        "bPaginate"     : false,
        "bLengthChange" : false,
        "bFilter"       : true,
        "bInfo"         : false
    })

    $('#tambah_pembayaran').on('click', function () {

      $('#modal_termin').modal('show');

      $('#form_termin_m').trigger("reset");

      $("#form_termin_m").parsley().reset();

      $('#aksi_termin').val('Tambah');
      
    })

    $('#form_termin_m').parsley({
        triggerAfterFailure: 'input change'
    });

    // aksi simpan data termin
    $('#form_termin_m').on('submit', function () {

      var form_termin = $('#form_termin_m').serialize();

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
                  url     : "<?= base_url() ?>entry_sppa/simpan_data_termin",
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
                  data    : form_termin,
                  dataType: "JSON",
                  success : function (data) {

                      $('#modal_termin').modal('hide');
                      
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
      
                      tabel_termin.ajax.reload(null,false);        
                      
                      $('#form_termin').trigger("reset");
      
                      $('#aksi_termin').val('Tambah');
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
                  timer               : 3000,
                                allowOutsideClick   : false
              }); 
          }
      })

      return false;

    })

    // edit data termin
    $('#tabel_termin').on('click', '.edit', function () {

      var id_termin  = $(this).data('id');

      $.ajax({
          url         : "<?= base_url() ?>entry_sppa/ambil_data_termin/"+id_termin,
          type        : "GET",
          beforeSend  : function () {
              swal({
                  title   : 'Menunggu',
                  html    : 'Memproses Data',
                  onOpen  : () => {
                      swal.showLoading();
                  }
              })
          },
          dataType    : "JSON",
          success     : function(data)
          {
              swal.close();

              $('#modal_termin').modal('show');
              
              $('#id_termin').val(data.id_termin_pembayaran);

              // $("#tgl_bayar").datepicker("setDate", data.tgl_bayar);
              // $("#tgl_terima").datepicker("setDate", data.tgl_terima);

              
              var myDateVal = moment(data.tgl_bayar).format('DD-MM-YYYY');
              $('#tgl_bayar').datepicker('setDate', myDateVal);    
              var myDateVal2 = moment(data.tgl_terima).format('DD-MM-YYYY');
              $('#tgl_terima').datepicker('setDate', myDateVal2);    
                                  
              $('#no_dokumen').val(data.no_dokumen);
              $('#cara_bayar').val(data.cara_bayar);
              $('#jumlah').val(data.jumlah);

              $('#aksi_termin').val('Ubah');

              return false;

          },
          error: function (jqXHR, textStatus, errorThrown)
          {
              alert('Error get data from ajax');
          }
      })

      return false;

    })

    // hapus termin
    $('#tabel_termin').on('click', '.hapus', function () {
        
        var id_termin   = $(this).data('id');
        swal({
            title       : 'Konfirmasi',
            text        : 'Yakin akan hapus termin ?',
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
                    url         : "<?= base_url() ?>entry_sppa/simpan_data_termin",
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
                    data        : {aksi:'Hapus', id_termin:id_termin},
                    dataType    : "JSON",
                    success     : function (data) {

                            tabel_termin.ajax.reload(null,false);   

                            swal({
                                title               : 'Hapus termin',
                                text                : 'Data Berhasil Dihapus',
                                buttonsStyling      : false,
                                confirmButtonClass  : "btn btn-success",
                                type                : 'success',
                                showConfirmButton   : false,
                                timer               : 3000,
                                allowOutsideClick   : false
                            }); 

                                
                            
                            $('#form_termin').trigger("reset");

                            $('#aksi_termin').val('Tambah');
                        
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
                        text                : 'Anda membatalkan hapus termin',
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

    // simpan data tiap tab

    $('#simpan_client').on('click', function () {

      var form_client = $('#form_client').serialize();

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
                  url     : "<?= base_url() ?>entry_sppa/simpan_data_client",
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
                  data    : form_client,
                  dataType: "JSON",
                  success : function (data) {

                    swal.close();

                    $('.link_detail').removeClass('disabled');
                    activaTab('t_detail');  
    
                    tabel_termin.ajax.reload(null,false);  
                    tabel_dok.ajax.reload(null,false);  
                    
                    $('.id_sppa').val(data.id_sppa);
                      
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
                  timer               : 3000,
                                allowOutsideClick   : false
              }); 
          }
      })

      return false;

    })

    function activaTab(tab){
      $('.nav-tabs a[href="#' + tab + '"]').tab('show');
    };

    // 15-05-2021
    $('#acc_mop').on('change', function () {
      var value = $(this).prop("checked");

      if (value) {
        $('.sel_mop').slideDown();

        $('.non_mop').slideUp();
        $('.link_entry').attr('hidden', true);

      } else {
        $('.sel_mop').slideUp();

        $('.non_mop').slideDown();
        $('.link_entry').attr('hidden', false);
      }

      
    })

    // 15-05-2021
    $('#simpan_detail').on('click', function () {

      var form_detail = $('#form_detail').serialize();

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
                  url     : "<?= base_url() ?>entry_sppa/simpan_data_detail",
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
                  data    : form_detail,
                  dataType: "JSON",
                  success : function (data) {

                    swal.close();

                    $('.link_dok').removeClass('disabled');
                    activaTab('t_dok');  
    
                    tabel_termin.ajax.reload(null,false);  
                    tabel_dok.ajax.reload(null,false);  
                      
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
                  timer               : 3000,
                                allowOutsideClick   : false
              }); 
          }
      })

      return false;
      
    })

    // 15-05-2021
    $('#simpan_tab_dok').on('click', function () {
      
      $('.link_premi').removeClass('disabled');
      activaTab('t_premi');  

      tabel_termin.ajax.reload(null,false); 
      
    })

    // 16-05-2021
    $('#simpan_premi').on('click', function () {

      var lob_adt           = [];
      var kalkulasi_tsi_adt = [];
      var pengali_tsi_adt   = [];
      var rate_adt          = [];
      var nominal_adt       = [];
      var rate_all_premi    = [];
      var nominal_all_premi = [];
      var id_coverage       = [];
      var premi_standar     = [];
      var premi_perluasan   = [];

      $('.lob_adt').each(function() { 
        lob_adt.push($(this).val()); 
      });
      $('.kalkulasi_tsi_adt').each(function() { 
        kalkulasi_tsi_adt.push($(this).val()); 
      });
      $('.pengali_tsi_adt').each(function() { 
        pengali_tsi_adt.push($(this).val()); 
      });
      $('.rate_adt').each(function() { 
        rate_adt.push($(this).val()); 
      });
      $('.nominal_adt').each(function() { 
        nominal_adt.push($(this).val()); 
      });
      $('.rate_all_premi').each(function() { 
        rate_all_premi.push($(this).val()); 
      });
      $('.nominal_all_premi').each(function() { 
        nominal_all_premi.push($(this).val()); 
        id_coverage.push($(this).attr('id_coverage')); 
      });
      $('.premi_standar').each(function() { 
        premi_standar.push($(this).val()); 
      });
      $('.premi_perluasan').each(function() { 
        premi_perluasan.push($(this).val()); 
      });

      var id_sppa_premi       = $('#id_sppa_premi').val();
      var tsi                 = $('#tsi').val();
      var diskon              = $('#diskon').val();
      var total_persen_premi  = $('#total_persen_premi').val();
      var total_akhir_premi   = $('#total_akhir_premi').val();
      var biaya_admin         = $('#biaya_admin').val();
      var total_tagihan       = $('#total_tagihan').val();
      var payment_method      = $('#payment_method').val();
      var tahun_pay           = $('#tahun_pay').val();
      var jumlah_cicilan      = $('#jumlah_cicilan').val();

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
                  url     : "<?= base_url() ?>entry_sppa/simpan_data_premi",
                  type    : "POST",
                  data    : {
                    id_sppa_premi       : id_sppa_premi,
                    tsi                 : tsi,
                    diskon              : diskon,
                    total_persen_premi  : total_persen_premi,
                    total_akhir_premi   : total_akhir_premi,
                    biaya_admin         : biaya_admin,
                    total_tagihan       : total_tagihan, 
                    payment_method      : payment_method,
                    tahun_pay           : tahun_pay,
                    jumlah_cicilan      : jumlah_cicilan,
                    lob_adt             : lob_adt, 
                    kalkulasi_tsi_adt   : kalkulasi_tsi_adt,
                    pengali_tsi_adt     : pengali_tsi_adt,
                    rate_adt            : rate_adt,
                    nominal_adt         : nominal_adt, 
                    rate_all_premi      : rate_all_premi,
                    nominal_all_premi   : nominal_all_premi,
                    id_coverage         : id_coverage,
                    premi_standar       : premi_standar,
                    premi_perluasan     : premi_perluasan
                  },
                  dataType: "JSON",
                  success : function (data) {

                    $('.link_released').removeClass('disabled');
                    activaTab('t_released');  
                      
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
                  timer               : 3000,
                                allowOutsideClick   : false
              }); 
          }
      })

      return false;

      
    })

    // 18-05-2021
    $('#simpan_edit').on('click', function () {

      var lob_adt           = [];
      var kalkulasi_tsi_adt = [];
      var pengali_tsi_adt   = [];
      var rate_adt          = [];
      var nominal_adt       = [];
      var rate_all_premi    = [];
      var nominal_all_premi = [];
      var id_coverage       = [];
      var premi_standar     = [];
      var premi_perluasan   = [];

      $('.lob_adt').each(function() { 
          lob_adt.push($(this).val()); 
      });
      $('.kalkulasi_tsi_adt').each(function() { 
          kalkulasi_tsi_adt.push($(this).val()); 
      });
      $('.pengali_tsi_adt').each(function() { 
          pengali_tsi_adt.push($(this).val()); 
      });
      $('.rate_adt').each(function() { 
          rate_adt.push($(this).val()); 
      });
      $('.nominal_adt').each(function() { 
          nominal_adt.push($(this).val()); 
      });
      $('.rate_all_premi').each(function() { 
          rate_all_premi.push($(this).val()); 
      });
      $('.nominal_all_premi').each(function() { 
          nominal_all_premi.push($(this).val()); 
          id_coverage.push($(this).attr('id_coverage')); 
      });
      $('.premi_standar').each(function() { 
          premi_standar.push($(this).val()); 
      });
      $('.premi_perluasan').each(function() { 
          premi_perluasan.push($(this).val()); 
      });

      var id_sppa_premi       = $('#id_sppa_premi').val();
      var tsi                 = $('#tsi').val();
      var diskon              = $('#diskon').val();
      var gross_premi         = $('#gross_premi').val();
      var total_diskon        = $('#total_diskon').val();
      var total_persen_premi  = $('#total_persen_premi').val();
      var total_akhir_premi   = $('#total_akhir_premi').val();
      var biaya_admin         = $('#biaya_admin').val();
      var total_tagihan       = $('#total_tagihan').val();
      var payment_method      = $('#payment_method').val();
      var tahun_pay           = $('#tahun_pay').val();
      var jumlah_cicilan      = $('#jumlah_cicilan').val();

      var id_sob              = $('#sobb').val();
      var id_cob              = $('#cobb').val();
      var id_lob              = $('#lobb').val();
      var nama_sob            = $('.nama_sob').val();
      var id_relasi           = $('.id_relasi').val();
      var sppa_number         = $('.sppa_number').val();
      var no_polis            = $('.no_polis').val();
      var no_invoice          = $('.no_invoice').val();

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
                  url     : "<?= base_url() ?>entry_sppa/simpan_data_edit_entry",
                  type    : "POST",
                  data    : {
                      id_sppa             : id_sppa_premi,
                      tsi                 : tsi,
                      diskon              : diskon,
                      gross_premi         : gross_premi,
                      total_diskon        : total_diskon,
                      total_persen_premi  : total_persen_premi,
                      total_akhir_premi   : total_akhir_premi,
                      biaya_admin         : biaya_admin,
                      total_tagihan       : total_tagihan, 
                      payment_method      : payment_method,
                      tahun_pay           : tahun_pay,
                      jumlah_cicilan      : jumlah_cicilan,
                      lob_adt             : lob_adt, 
                      kalkulasi_tsi_adt   : kalkulasi_tsi_adt,
                      pengali_tsi_adt     : pengali_tsi_adt,
                      rate_adt            : rate_adt,
                      nominal_adt         : nominal_adt, 
                      rate_all_premi      : rate_all_premi,
                      nominal_all_premi   : nominal_all_premi,
                      id_coverage         : id_coverage,
                      premi_standar       : premi_standar,
                      premi_perluasan     : premi_perluasan,
                      id_sob              : id_sob,              
                      id_cob              : id_cob,              
                      id_lob              : id_lob,              
                      nama_sob            : nama_sob,            
                      id_relasi           : id_relasi,           
                      sppa_number         : sppa_number,         
                      no_polis            : no_polis,    
                      no_invoice          : no_invoice,    
                      detail              : $('#form_detail').serializeArray()     
                  },
                  dataType: "JSON",
                  success : function (data) {

                    swal({
                        title               : "Berhasil",
                        text                : 'Data Berhasil Disimpan',
                        type                : 'success',
                        showConfirmButton   : false,
                        timer               : 3000,
                        allowOutsideClick   : false
                    }); 

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
                          text                : 'Gagal Disimpan',
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
                  title               : "Batal",
                  text                : 'Anda membatalkan simpan data',
                  buttonsStyling      : false,
                  confirmButtonClass  : "btn btn-primary",
                  type                : 'error',
                  showConfirmButton   : false,
                  timer               : 3000,
                                allowOutsideClick   : false
              }); 
          }
      })

      return false;

      })

    // - AFIF

    $("#here").on("keydown keyup", '.min_max', function(){
        var value       = $(this).val();
        var name        = $(this).attr('id');
        var minLength   = parseInt($(this).attr('min'));
        var maxLength   = parseInt($(this).attr('max'));

        if (value != '') {

          if (value.length < minLength) {
              $("#span_"+name).text("Minimal "+minLength+" Karakter");
              $('.simpan_semua').attr('disabled', true);
          } else if (value.length > maxLength) {
              $("#span_"+name).text("Maximal "+maxLength+" Karakter");
              $('.simpan_semua').attr('disabled', true);
          } else {
              $("#span_"+name).text("");
              $('.simpan_semua').attr('disabled', false);
          }

        } else {
          $("#span_"+name).text("");
          $('.simpan_semua').attr('disabled', false);
        }

        
    });
  })
</script>