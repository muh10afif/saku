<script type="text/javascript">

  var table_user = '';
  $(document).ready(function () {
    
    // TABEL USER DATA
    var act = "<?=$role['update'].'_'.$role['delete']?>";
    table_user = $('#datatable').DataTable({
      "processing" : true,
      "serverSide" : true,
      "order" : [],
      "ajax" : {
        "url" : "<?php echo base_url(); ?>user/ajaxdata/"+act,
        "type" : "POST"
      },
      "columnDefs" : [{
        "targets" : [0,3,6],
        "orderable" : false
      },{
        'targets' : [0,6],
        'className' : 'text-center',
      }]
    });

    // 30-09-2021
    $('#pil_cdb2').on('change', function () {
      
      var id_sob = $(this).val();

      var isi_flag_table              = $('#isi_flag_table').val();
      var isi_id_pengguna_tertanggung = $('#isi_id_pengguna_tertanggung').val();
      var isi_id_insured              = $('#isi_id_insured').val();

      $.ajax({
        url     : "<?= base_url() ?>user/get_data_sob",
        method  : "POST",
        data    : {id_sob:id_sob, isi_id_pengguna_tertanggung:isi_id_pengguna_tertanggung},
        dataType: "JSON",
        success : function (data) {
 
          $('#pil_tertanggung').html(data.option_set_cdb);

          if (isi_flag_table != '') {
            $('#pil_tertanggung').val(isi_id_insured).trigger('change');
          }
          
          $('#t_cdb').html("Pilih CDB "+data.nama_sob+" <b style='color:red;'>*</b>");
          
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

    $('#pil_tertanggung2').on('change', function () {

      var id_tertanggung = $(this).val();
      var isi_flag_table              = $('#isi_flag_table').val();
      var isi_id_pengguna_tertanggung = $('#isi_id_pengguna_tertanggung').val();
      var isi_id_insured              = $('#isi_id_insured').val();

      $.ajax({
        url     : "<?= base_url() ?>user/get_data_pengguna_ptg",
        method  : "POST",
        data    : {id_tertanggung:id_tertanggung},
        dataType: "JSON",
        success : function (data) {
 
          $('#pilkarya').html(data.option);

          if (isi_id_pengguna_tertanggung != '') {
            $('#pilkarya').val(isi_id_pengguna_tertanggung).trigger('chang');
          }
          
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

    // CHANGE PILIHAN LEVEL USER
    // $('#sikaryawan').hide();
    // $('#otorisa').hide();
    $('#tertanggungdata').hide();
    $('#form_induk_kumpulan').hide();

    $('[name="pilihn"]').on('change', function () {
      $('#sikaryawan').show();
      // $("#pilkarya").empty();
      $('#lvloto').empty();
      $('#lvloto').html("<option value=''>Pilih</option>");

      $('.f_pgn_tertanggung').hide();
      $('#form_induk_kumpulan').hide();
      $('#tertanggungdata').hide();
      
      var cnd = '';
      if ($(this).val() == 'Tertanggung') { // tertanggung
        cnd = 2;
        $('#otorisa').show();
        $('#tertanggungdata').show();
        $('#jdclient').val(null).trigger('change');

        $('.pil_cdb').slideUp();
        $('.pil_tertanggung').slideUp();
      } else if ($(this).val() == 'Asuransi') { // asuransi
        cnd = 1;
        $('#otorisa').show();
        $('#tertanggungdata').hide();
        $('#jdclient').val(null).trigger('change');

        $('.pil_cdb').slideUp();
        $('.pil_tertanggung').slideUp();
      } else if ($(this).val() == 'Pengguna Tertanggung') { // pengguna tertanggung
        cnd = 3;
        // $('#otorisa').show();
        // $('#tertanggungdata').hide();
        // $('#jdclient').val(null).trigger('change');

        // $('.pil_cdb').slideDown();
        // $('.pil_tertanggung').slideDown();
        // $('.pil_pengguna').slideDown();

        $('#otorisa').show();
        $('#sikaryawan').hide();

        $('#form_induk_kumpulan').show();
        $('.f_pgn_tertanggung').show();
        
      } else if ($(this).val() == 'Broker') { // broker
        cnd = 0;
        $('#otorisa').show();
        $('#tertanggungdata').hide();
        $('#jdclient').val(null).trigger('change');

        $('.pil_cdb').slideUp();
        $('.pil_tertanggung').slideUp();
      } else if ($(this).val() == 'Induk Kumpulan') {

        // menampilkan pilihan tertanggung mana
        // menampikan list pengguna

        cnd = 4;
        $('#otorisa').show();
        $('#sikaryawan').hide();
        // $('#tertanggungdata').show();
        // $('#jdclient').val(null).trigger('change');

        $('#form_induk_kumpulan').show();

        // $('.pil_cdb').slideUp();
        // $('.pil_tertanggung').slideUp();
        
      }

      if (cnd == 1 || cnd == 0 || cnd == 3) {
        $.ajax({
          type:"GET",
          url:"<?php echo base_url(); ?>user/getlistnya/"+cnd,
          success  : function (data) {
            // $("#pilkarya").empty();
            $("#pilkarya").attr('disabled', false);
            var hss = JSON.parse(data);
            var newOption = "";
            for (var i = 0; i < hss.length; i++) {
              if (cnd == 0) {
                newOption = newOption+"<option value='"+hss[i].id_karyawan+"'>"+hss[i].nama_karyawan+"</option>";
              } else if (cnd == 1) {
                newOption = newOption+"<option value='"+hss[i].id_asuransi+"'>"+hss[i].nama_asuransi+"</option>";
              } else {
                // newOption = newOption+"<option value='"+hss[i].id_pengguna_tertanggung+"'>"+hss[i].nama+"</option>";
              }
            }
            $('#pilkarya').append(newOption).trigger('change');
          }
        });
        $('#pilkarya').val(null).trigger('change');
      } else {
        $("#pilkarya").attr('disabled', true);
      }
    });

    // CHANGE PILIHAN PENGGUNA
    $('#pilkarya').on('change', function (e) {
      e.preventDefault();
      var idpeng = $(this).val();
      var has = "";
      // var id_level_user = $('input[name="pilihn"]:checked').data('idleveluser');
      var ft_tertanggung = $('#jdclient').val();
      var penggn = $('[name="pilihn"]');
      for (var i = 0; i < penggn.length; i++) {
        if (penggn[i].checked) {
          has = penggn[i].value;
          break;
        }
      }
      // if (has == 'Induk Kumpulan') {

      //   $.ajax({
      //     type:"POST",
      //     url:"<?php echo base_url(); ?>user/get_induk_kumpulan",
      //     data:{tertanggung:idpeng, ft_tertanggung:ft_tertanggung},
      //     dataType:"JSON",
      //     success:function (data) {
      //       $('#pil_induk_kumpulan').html(data.list_ik);
      //     }
      //   });
        
      // }
      
      if (idpeng != "") {
        $('#lvloto').empty();
        $.ajax({
          type:"POST",
          url:"<?php echo base_url(); ?>user/getlistoto",
          data:{idp:idpeng, lvl:has},
          dataType:"JSON",
          success:function (data) {
            var id_lvl_oto = $('#id_lvl_oto').val();
            
            var otto = "";

            if (data.length <= 1) {
              otto = "";
            } else {
              otto = '<option value="">Pilih</option>';
            }
            for (var i = 0; i < data.length; i++) {
              if (id_lvl_oto != '') {
                if (id_lvl_oto == data[i].id_level_otorisasi) {
                  $sel = 'selected';
                } else {
                  $sel = '';
                }
              } else {
                $sel = '';
              }
              
              otto = otto+'<option value='+data[i].id_level_otorisasi+' '+$sel+'>'+data[i].level_otorisasi+'</option>';
            }
            $('#lvloto').attr('disabled', false);
            $('#lvloto').html(otto);
          }
        });
      } else {
        $('#lvloto').attr('disabled', true);
        $('#lvloto').html('<option value="">Pilih</option>');
      }
    });

    // TOGGLE PASSWORD ICON
    $(".toggle-password").click(function() {
      $(this).toggleClass("fa-smile-beam fa-meh-rolling-eyes");
      var input = $($(this).attr("toggle"));
      if (input.attr("type") == "password") {
        input.attr("type", "text");
      } else {
        input.attr("type", "password");
      }
    });
    $(".toggle-password-con").click(function() {
      $(this).toggleClass("fa-smile-beam fa-meh-rolling-eyes");
      var input = $($(this).attr("toggle"));
      if (input.attr("type") == "password") {
        input.attr("type", "text");
      } else {
        input.attr("type", "password");
      }
    });

    // SIMPAN DATA
    $('#senddata').on('click', function () {
      if ($('#usname').val() != "" && $('#usname').val() != " ") {
        if ($('#password').val() == $('#con_pass').val()) {
          var idus = $('#idusr').val();
          var lvsr = $('[name="pilihn"]');
          var fcek = '';
          for (var i = 0; i < lvsr.length; i++) {
            if (lvsr[i].checked) {
              fcek = lvsr[i].value;
              break;
            }
          }
          if (idus == "") {
            // var pil_cdb           = $('#pil_cdb').val();
            // var pil_tertanggung   = $('#pil_tertanggung').val();
            var jdclient          = $('#jdclient').val();

            // var fltabl = '';

            // if (pil_cdb != '') {
            //   fltabl = pil_cdb;
            // } else {
            //   fltabl = jdclient;
            // }
            
            $.ajax({
              type:"POST",
              url:"<?php echo base_url(); ?>user/add",
              beforeSend : function () {
                swal({
                  title  : 'Menunggu',
                  html   : 'Memproses Data',
                  onOpen : () => {
                    swal.showLoading();
                  }
                })
              },
              data: {
                idkywn              : $('#pilkarya').val(),
                usernm              : $('#usname').val(),
                passwd              : $('#password').val(),
                lvotor              : $('#lvloto').val(),
                // pil_tertanggung   : pil_tertanggung,
                fltabl              : jdclient,
                lvlusr              : fcek,
                id_induk_kumpulan   : $('#id_induk_kumpulan').val(),
                pil_pgn_tertanggung : $('#pil_pgn_tertanggung').val()
              },
              dataType : "JSON",
              success  : function (data) {
                swal({
                  title             : data['judul'],
                  text              : data['status'],
                  type              : data['tipe'],
                  showConfirmButton : false,
                  timer             : 3000
                });
                table_user.ajax.reload();
                if (data['tipe'] == 'success') {
                  $('#clearall').trigger('click');
                }
                return true;
              },
              error: function (jqXHR, textStatus, errorThrown) {
                swal({
                  title             : "Peringatan",
                  text              : "Koneksi Tidak Terhubung",
                  type              : 'warning',
                  showConfirmButton : false,
                  timer             : 3000
                });
                return false;
              }
            });
          } else {
            $.ajax({
              type:"POST",
              url:"<?php echo base_url(); ?>user/edit/"+idus,
              beforeSend : function () {
                swal({
                  title  : 'Menunggu',
                  html   : 'Memproses Data',
                  onOpen : () => {
                    swal.showLoading();
                  }
                })
              },
              data: {
                idkywn              :$('#pilkarya').val(),
                usernm              :$('#usname').val(),
                passwd              :$('#password').val(),
                lvotor              :$('#lvloto').val(),
                fltabl              :$('#jdclient').val(),
                lvlusr              :fcek,
                id_induk_kumpulan   :$('#id_induk_kumpulan').val(),
                pil_pgn_tertanggung :$('#pil_pgn_tertanggung').val()
              },
              dataType : "JSON",
              success  : function (data) {
                swal({
                  title             : data['judul'],
                  text              : data['status'],
                  type              : data['tipe'],
                  showConfirmButton : false,
                  timer             : 3000
                });
                table_user.ajax.reload();
                if (data['tipe'] == 'success') {
                  $('#clearall').trigger('click');
                }
                lvsr.attr("disabled",false);
                return true;
              },
              error: function (jqXHR, textStatus, errorThrown) {
                swal({
                  title             : "Peringatan",
                  text              : "Koneksi Tidak Terhubung",
                  type              : 'warning',
                  showConfirmButton : false,
                  timer             : 3000
                });
                return false;
              }
            });
          }
        } else {
          swal({
            title             : "Peringatan",
            text              : "Password Tidak Sama",
            type              : 'warning',
            showConfirmButton : false,
            timer             : 3000
          });
          return false;
        }
      } else {
        swal({
          title             : "Peringatan",
          text              : "Username tidak Boleh Kosong atau Spasi",
          type              : 'warning',
          showConfirmButton : false,
          timer             : 3000
        });
      }
    });

    // CLEAR FORM
    $('#clearall').on('click', function () {
      $('#idusr').val('');
      // $('#pilkarya').val(null).trigger('change');
      $('#usname').val('');
      $('#password').val('');
      $('#con_pass').val('');
      // $('#lvloto').val(null).trigger('change');
      // $('[name="pilihn"]').attr('checked', false);
      // $('#sikaryawan').hide();
      // $('#otorisa').hide();
      $('#sikaryawan').show();
      $('#pilkarya').attr('disabled', true);
      $('#lvloto').attr('disabled', true);
      $('#lvloto').empty();
      $('#tertanggungdata').hide();
      $('#jdclient').val(null).trigger('change');
      var lvsr = $('[name="pilihn"]');
      for (var i = 0; i < lvsr.length; i++) {
        if (lvsr[i].checked) {
          lvsr[i].checked = false;
        }
      }
      lvsr.attr("disabled",false);

      $('#form_induk_kumpulan').hide();

      $('#jenis_client_ttg').val('').trigger('change');
      $('#ft_tertanggung_edit').val(null);
      $('#tertanggung_edit').val(null);
      $('#ft_induk_kumpulan_edit').val(null);
      $('#induk_kumpulan_edit').val(null);
      
      $('#id_induk_kumpulan').val(null);
      
      $('.f_pgn_tertanggung').hide();
      $('#pil_pgn_tertanggung').val('').trigger('change');

      // $('#isi_flag_table').val('');
      // $('#isi_id_pengguna_tertanggung').val('');
      // $('#isi_id_insured').val('');

      // $('.pil_cdb').slideUp();
      // $('.pil_tertanggung').slideUp();
      // $('.pil_pengguna').slideUp();
    });

    // INDUK KUMPULAN
    $('#pil_induk_kumpulan').on('change', function () {

      var id_induk_kumpulan         = $('option:selected', this).attr('induk_kumpulan');
      var pil_pgn_tertanggung_edit  = $('#pil_pgn_tertanggung_edit').val();

      $('#id_induk_kumpulan').val(id_induk_kumpulan);

      var penggn = $('[name="pilihn"]');  
      for (var i = 0; i < penggn.length; i++) {
        if (penggn[i].checked) {
          has = penggn[i].value;
          break;
        }
      }

      var lvl_user = $('input[name="pilihn"]:checked').val();

      if (lvl_user == 'Pengguna Tertanggung') {

        $.ajax({
          type  :"POST",
          url   :"<?php echo base_url(); ?>user/get_pgn_tertanggung",
          data  :{id_induk_kumpulan:id_induk_kumpulan},
          dataType:"JSON",
          success:function (data) {
            
            var option_pgn_ttg = "";
            if (data.length > 1) {
              option_pgn_ttg = "<option value=''>Pilih</option>";
            }
             
            var sel = "";
            data.forEach(function (item) {

              if (item.id_pengguna_tertanggung == pil_pgn_tertanggung_edit) {
                sel = "selected";
              } else {
                sel = "";
              }
              option_pgn_ttg += "<option value='"+item.id_pengguna_tertanggung+"' "+sel+">"+item.nama+"</option>";
            });

            $('#pil_pgn_tertanggung').html(option_pgn_ttg);
          }
        });
        
      }

      if (id_induk_kumpulan) {
        $('#lvloto').empty();
        $.ajax({
          type:"POST",
          url:"<?php echo base_url(); ?>user/getlistoto",
          data:{idp:0, lvl:has},
          dataType:"JSON",
          success:function (data) {
            var id_lvl_oto = $('#id_lvl_oto').val();
            
            var otto = "";

            if (data.length <= 1) {
              otto = "";
            } else {
              otto = '<option value="">Pilih</option>';
            }
            for (var i = 0; i < data.length; i++) {
              if (id_lvl_oto != '') {
                if (id_lvl_oto == data[i].id_level_otorisasi) {
                  $sel = 'selected';
                } else {
                  $sel = '';
                }
              } else {
                $sel = '';
              }
              
              otto = otto+'<option value='+data[i].id_level_otorisasi+' '+$sel+'>'+data[i].level_otorisasi+'</option>';
            }
            $('#lvloto').attr('disabled', false);
            $('#lvloto').html(otto);
          }
        });
      } else {
        $('#lvloto').attr('disabled', true);
        $('#lvloto').html('<option value="">Pilih</option>');
      }

    });

  });

  // UBAH DATA
  function ubahubah(id) {
    window.scrollTo(0,0);
    $('input[name=pilihn]').attr('checked', false);
    $.ajax({
      type:"GET",
      url:"<?php echo base_url(); ?>user/show/"+id,
      dataType:"JSON",
      success  : function (hss) {

        $('#form_induk_kumpulan').hide();
        $('#tertanggungdata').hide();
        $('.f_pgn_tertanggung').hide();

        $('#pilkarya').empty();
        $('#idusr').val(hss.list.id_user);
        $('#usname').val(hss.list.username);
        $('#password').val(hss.list.password);
        $('#con_pass').val(hss.list.password);
        var lvsr = $('[name="pilihn"]');
        for (var i = 0; i < lvsr.length; i++) {
          if (lvsr[i].value == hss.list.level_user) {
            lvsr[i].checked = true;
          }
        }
        lvsr.attr("disabled",true);

        var id_lvl_oto = hss.list.id_level_otorisasi;

        $('#id_lvl_oto').val(id_lvl_oto);

        seeoto(hss.list.id_karyawan, hss.list.level_user, hss.list.id_level_otorisasi);
        switch (hss.list.level_user) {
          case 'Broker':
            $('#sikaryawan').show();
            $('#otorisa').show();
            $('#tertanggungdata').hide();
            $('#jdclient').val('').trigger('change');
            setuptertb(hss.list.id_karyawan);
            break;
          case 'Asuransi':
            $('#sikaryawan').show();
            $('#otorisa').show();
            $('#tertanggungdata').hide();
            $('#jdclient').val('').trigger('change');
            setupterta(hss.list.id_karyawan);
            break;
          case 'Tertanggung':
            $('#sikaryawan').show();
            $('#otorisa').show();
            $('#tertanggungdata').show();
            $('#jdclient').val(hss.list.flag_table).trigger('change');
            setupclient({value:hss.list.flag_table}, hss.list.id_karyawan);
            break;
          case 'Pengguna Tertanggung':
            // $('#sikaryawan').show();
            // $('#otorisa').show();
            // $('#tertanggungdata').hide();
            // $('#jdclient').val('').trigger('change');

            // $('.pil_cdb').slideDown();
            // $('.pil_tertanggung').slideDown();
            // $('.pil_pengguna').slideDown();

            // $('#isi_flag_table').val(hss.list.flag_table); 
            // $('#isi_id_pengguna_tertanggung').val(hss.list.id_pengguna_tertanggung); 
            // $('#isi_id_insured').val(hss.id_insured); 

            // $('#pil_cdb').val(hss.list.flag_table).trigger('change');

            
            // setUpPenggunaPtg(hss.list.flag_table, hss.list.id_pengguna_tertanggung, hss.id_insured)
            
            // setuptertc(hss[0].id_karyawan);

            $('#ft_tertanggung_edit').val(hss.list.ft_tertanggung);
            $('#tertanggung_edit').val(hss.list.tertanggung);
            $('#ft_induk_kumpulan_edit').val(hss.list.ft_induk_kumpulan);
            $('#induk_kumpulan_edit').val(hss.list.induk_kumpulan);

            $('#id_induk_kumpulan').val(hss.list.id);

            $('#jenis_client_ttg').val(hss.list.ft_tertanggung).trigger('change');
            $('.f_pgn_tertanggung').show();
            $('#pil_pgn_tertanggung_edit').val(hss.list.id_pengguna_tertanggung);
            
            $('#sikaryawan').hide();
            $('#form_induk_kumpulan').show();

            break;
          case 'Induk Kumpulan': 

            $('#ft_tertanggung_edit').val(hss.list.ft_tertanggung);
            $('#tertanggung_edit').val(hss.list.tertanggung);
            $('#ft_induk_kumpulan_edit').val(hss.list.ft_induk_kumpulan);
            $('#induk_kumpulan_edit').val(hss.list.induk_kumpulan);

            $('#id_induk_kumpulan').val(hss.list.id);

            $('#jenis_client_ttg').val(hss.list.ft_tertanggung).trigger('change');
            
            $('#sikaryawan').hide();
            $('#form_induk_kumpulan').show();
            break;
        }
        $('#pilkarya').attr('disabled', false);
        $('#lvloto').attr('disabled', false);

        
      },
      error: function (jqXHR, textStatus, errorThrown) {
        swal({
          title             : "Peringatan",
          text              : "Koneksi Tidak Terhubung",
          type              : 'warning',
          showConfirmButton : false,
          timer             : 3000
        });
        return false;
      }
    });
  }

  // PENGGUNA TERTANGGUNG
  function setUpPenggunaPtg(flag_table, id_pgn_ttg, id_insured) {

    $.ajax({
      type    :"POST",
      url     :"<?php echo base_url(); ?>user/set_pengguna_ptg",
      data    :{flag_table:flag_table, id_pgn_ttg:id_pgn_ttg, id_insured:id_insured},
      dataType:"JSON",
      success:function (data) {
        
        $('#pil_tertanggung').html(data.list_det_cdb);
        
      }
    });
    
  }

  // otorisasi
  function seeoto(idp, lv, oto) {
    $('#lvloto').empty();
    $.ajax({
      type:"POST",
      url:"<?php echo base_url(); ?>user/getlistoto",
      data:{idp:idp, lvl:lv},
      dataType:"JSON",
      success:function (data) {
        var id_lvl_oto  = $('#id_lvl_oto').val();
        var otto        = '<option value="">Pilih</option>';
        
        for (var i = 0; i < data.length; i++) {
          if (oto == data[i].id_level_otorisasi) {
            otto = otto+'<option value='+data[i].id_level_otorisasi+' selected>'+data[i].level_otorisasi+'</option>';
          } else {
            otto = otto+'<option value='+data[i].id_level_otorisasi+'>'+data[i].level_otorisasi+'</option>';
          }
        }
        $('#lvloto').html(otto);
      }
    });
  }

  // broker
  function setuptertb(idk) {
    $('#pilkarya').empty();
    $.ajax({
      type:"GET",
      url:"<?php echo base_url(); ?>user/getlistnya/"+0,
      success  : function (data) {
        var hsx = JSON.parse(data); var newOption = "<option value=''>Pilih</option>";
        for (var i = 0; i < hsx.length; i++) {
          if (idk == hsx[i].id_karyawan) {
            newOption = newOption+"<option value='"+hsx[i].id_karyawan+"' selected>"+hsx[i].nama_karyawan+"</option>";
          } else {
            newOption = newOption+"<option value='"+hsx[i].id_karyawan+"'>"+hsx[i].nama_karyawan+"</option>";
          }
        }
        $('#pilkarya').append(newOption);
      }
    });
  }

  // asuransi
  function setupterta(idnya) {
    $('#pilkarya').empty();
    $.ajax({
      type:"GET",
      url:"<?php echo base_url(); ?>user/getlistnya/"+1,
      success  : function (data) {
        var hss = JSON.parse(data); var newOption = "<option value=''>Pilih</option>";
        for (var i = 0; i < hss.length; i++) {
          if (hss[i].id_asuransi == idnya) {
            newOption = newOption+"<option value='"+hss[i].id_asuransi+"' selected>"+hss[i].nama_asuransi+"</option>";
          } else {
            newOption = newOption+"<option value='"+hss[i].id_asuransi+"'>"+hss[i].nama_asuransi+"</option>";
          }
        }
        $('#pilkarya').append(newOption);
      }
    });
  }

  // peng tertanggung
  function setuptertc(idnya) {
    $('#pilkarya').empty();
    $.ajax({
      type:"GET",
      url:"<?php echo base_url(); ?>user/getlistnya/"+3,
      success  : function (data) {
        var hss = JSON.parse(data); var newOption = "<option value=''>Pilih</option>";
        for (var i = 0; i < hss.length; i++) {
          if (hss[i].id_nasabah == idnya) {
            newOption = newOption+"<option value='"+hss[i].id_nasabah+"' selected>"+hss[i].nama_nasabah+"</option>";
          } else {
            newOption = newOption+"<option value='"+hss[i].id_nasabah+"'>"+hss[i].nama_nasabah+"</option>";
          }
        }
        $('#pilkarya').append(newOption);
      }
    });
  }

  //jika Tertanggung
  function setupclient(isinya, idk) {
    $('#pilkarya').empty();
    if (isinya.value != '') {
      $.ajax({
        type:"GET",
        url:"<?php echo base_url(); ?>user/getfromdb/"+isinya.value,
        success  : function (data) {
          $('#pilkarya').empty();
          $('#pilkarya').attr('disabled', false);
          var hss = JSON.parse(data); var newOption = '<option value="">Pilih</option>';
          for (var i = 0; i < hss.length; i++) {
            if (hss[i].id == idk) {
              newOption = newOption+"<option value='"+hss[i].id+"' selected>"+hss[i].nama+"</option>";
            } else {
              newOption = newOption+"<option value='"+hss[i].id+"'>"+hss[i].nama+"</option>";
            }
          }
          $('#pilkarya').html(newOption);
        }
      });
    } else {
      $('#pilkarya').attr('disabled', true);
      $('#pilkarya').append("<option value=''>Pilih</option>").trigger('change');
    }
  }

  // HAPUS DATA
  function deletedel(id) {
    swal({
      title       : 'Konfirmasi',
      text        : 'Yakin akan Menghapus User',
      type        : 'warning',
      buttonsStyling      : false,
      confirmButtonClass  : "btn btn-primary",
      cancelButtonClass   : "btn btn-warning mr-3",
      showCancelButton    : true,
      confirmButtonText   : 'Ya',
      confirmButtonColor  : '#3085d6',
      cancelButtonColor   : '#d33',
      cancelButtonText    : 'Batal',
      reverseButtons      : true
    }).then((result) => {
      if (result.value) {
        $.ajax({
          type:"GET",
          url:"<?php echo base_url(); ?>user/remove/"+id,
          beforeSend : function () {
            swal({
              title  : 'Menunggu',
              html   : 'Memproses Data',
              onOpen : () => {
                swal.showLoading();
              }
            })
          },
          success  : function (data) {
            swal({
              title             : "Berhasil",
              text              : "Karyawan telah di Hapus",
              type              : 'success',
              showConfirmButton : false,
              timer             : 3000
            });
            table_user.ajax.reload();
            return true;
          },
          error: function (jqXHR, textStatus, errorThrown) {
            swal({
              title             : "Peringatan",
              text              : "Koneksi Tidak Terhubung",
              type              : 'warning',
              showConfirmButton : false,
              timer             : 3000
            });
            return false;
          }
        });
      } else if (result.dismiss === swal.DismissReason.cancel) {
        swal({
          title               : "Batal",
          text                : 'Anda membatalkan Hapus karyawan',
          buttonsStyling      : false,
          confirmButtonClass  : "btn btn-primary",
          type                : 'error',
          showConfirmButton   : false,
          timer               : 3000
        });
      }
    });
  }

  //jika Tertanggung
  function setupclient_ttg(ft_tertanggung) {
    $('#pil_tertanggung').empty();

    // $('#jenis_client_ttg_edit').val(ft_tertanggung);
    // var idk = $('#tertanggung_edit').val();

    var ft_tertanggung_edit     = $('#ft_tertanggung_edit').val();
    var tertanggung_edit        = $('#tertanggung_edit').val();
    var ft_induk_kumpulan_edit  = $('#ft_induk_kumpulan_edit').val();
    var induk_kumpulan_edit     = $('#induk_kumpulan_edit').val();
    
    if (ft_tertanggung != '') {
      $.ajax({
          type        :"POST",
          url         :"<?php echo base_url(); ?>pengguna_tertanggung/get_list_tertanggung/",
          data        : {ft_tertanggung:ft_tertanggung},
          dataType    : "JSON",
          success     : function (data) {
          $('#pil_tertanggung').empty();
          $('#jenis_client_ik').empty();
          $('#pil_induk_kumpulan').empty();
          $('#jenis_client_ik').html("<option value=''>Pilih</option>");
          $('#pil_induk_kumpulan').html("<option value=''>Pilih</option>");
          
          //   var hss = JSON.parse(data); 
          //   var newOption = '<option value="">Pilih</option>';
          //   for (var i = 0; i < hss.length; i++) {
          //     if (hss[i].id == idk) {
          //       newOption = newOption+"<option value='"+hss[i].id+"' selected>"+hss[i].nama+"</option>";
          //     } else {
          //       newOption = newOption+"<option value='"+hss[i].id+"'>"+hss[i].nama+"</option>";
          //     }
          //   }
          // console.log(data.option_ttg);
          $('#pil_tertanggung').html(data.option_ttg);

          $('#pil_tertanggung').val(tertanggung_edit).trigger('change');

          // $("#pil_tertanggung").select2("val", data.idk);
          }
      });
    } else {
        $('#id_induk_kumpulan').val('');
        $('#pil_tertanggung').append("<option value=''>Pilih</option>").trigger('change');
    }
  }

    // pilih flag table induk kumpulan
    function setupclient_jenis_client_ik(ft_tertanggung, tertanggung) {
        $('#jenis_client_ik').empty();

        // var jenis_client_ttg = $('#jenis_client_ttg_edit').val();

        var ft_tertanggung_edit     = $('#ft_tertanggung_edit').val();
        var tertanggung_edit        = $('#tertanggung_edit').val();
        var ft_induk_kumpulan_edit  = $('#ft_induk_kumpulan_edit').val();
        var induk_kumpulan_edit     = $('#induk_kumpulan_edit').val();
        
        if (tertanggung != '') {
            $.ajax({
                type        :"POST",
                url         :"<?php echo base_url(); ?>pengguna_tertanggung/get_list_client_ik/",
                data        : {ft_tertanggung:ft_tertanggung, tertanggung:tertanggung},
                dataType    : "JSON",
                success     : function (data) {
                    // console.log(data.option_cdb_ik);
                    $('#jenis_client_ik').empty();
                    $('#pil_induk_kumpulan').html("<option value=''>Pilih</option>");
                    $('#jenis_client_ik').html(data.option_cdb_ik);
                    $('#jenis_client_ik').val(ft_induk_kumpulan_edit).trigger('change');
                }
            });
        } else {
            $('#id_induk_kumpulan').val('');
            $('#jenis_client_ik').append("<option value=''>Pilih</option>").trigger('change');
        }
    }

    //jika Induk Kumpulan
    function setupclient_ik(ft_tertanggung, tertanggung, ft_induk_kumpulan) {
        $('#pil_induk_kumpulan').empty();

        var ft_tertanggung_edit     = $('#ft_tertanggung_edit').val();
        var tertanggung_edit        = $('#tertanggung_edit').val();
        var ft_induk_kumpulan_edit  = $('#ft_induk_kumpulan_edit').val();
        var induk_kumpulan_edit     = $('#induk_kumpulan_edit').val();
        
        if (ft_induk_kumpulan != '') {
        $.ajax({
            type        :"POST",
            url         :"<?php echo base_url(); ?>pengguna_tertanggung/get_list_tertanggung_ik/",
            data        : {ft_tertanggung:ft_tertanggung, tertanggung:tertanggung, ft_induk_kumpulan:ft_induk_kumpulan},
            dataType    : "JSON",
            success  : function (data) {
            //   $('#pilkarya').empty();
            //   var hss = JSON.parse(data); var newOption = '<option value="">Pilih</option>';
            //   for (var i = 0; i < hss.length; i++) {
            //     if (hss[i].id == idk) {
            //       newOption = newOption+"<option value='"+hss[i].id+"' selected>"+hss[i].nama+"</option>";
            //     } else {
            //       newOption = newOption+"<option value='"+hss[i].id+"'>"+hss[i].nama+"</option>";
            //     }
            //   }
            $('#pil_induk_kumpulan').html(data.option_ttg_ik);
            $('#pil_induk_kumpulan').val(induk_kumpulan_edit).trigger('change');
            }
        });
        } else {
          $('#id_induk_kumpulan').val('');
          $('#pil_induk_kumpulan').append("<option value=''>Pilih</option>").trigger('change');
        }
    }
  
</script>
