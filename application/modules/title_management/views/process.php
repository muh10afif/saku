<script type="text/javascript">
  var titlex = '';
  var subtitle = '';
  var namex = '';
  $(document).ready(function () {
    var act = "<?=$role['update'].'_'.$role['delete']?>";
    titlex = $('#datatable1').DataTable({
      "processing" : true,
      "serverSide" : true,
      "order" : [],
      "ajax" : {
        "url" : "<?php echo base_url(); ?>title_management/ajaxdatatitle/"+act,
        "type" : "POST"
      },
      "columnDefs" : [{
        "targets" : [0,2],
        "orderable" : false
      },{
        'targets' : [0,2],
        'className' : 'text-center',
      }],
      "scrollX" : true
    });
    subtitle = $('#datatable2').DataTable({
      "processing" : true,
      "serverSide" : true,
      "order" : [],
      "ajax" : {
        "url" : "<?php echo base_url(); ?>title_management/ajaxdatasubtitle/"+act,
        "type" : "POST"
      },
      "columnDefs" : [{
        "targets" : [0,3],
        "orderable" : false
      },{
        'targets' : [0,3],
        'className' : 'text-center',
      }]
    });
    namex = $('#datatable3').DataTable({
      "processing" : true,
      "serverSide" : true,
      "order" : [],
      "ajax" : {
        "url" : "<?php echo base_url(); ?>title_management/ajaxdataname/"+act,
        "type" : "POST"
      },
      "columnDefs" : [{
        "targets" : [0,4],
        "orderable" : false
      },{
        'targets' : [0,4],
        'className' : 'text-center',
      }]
    });

    $('#cleartm').on('click', function () {
      $('#idtm').val('');
      $('#nmtm').val('');
    });
    $('#clearsm').on('click', function () {
      $('#idsm').val('');
      $('#idtmt').val(null).trigger('change');
      $('#nmsm').val('');
    });
    $('#clearnm').on('click', function () {
      $('#idsm').val('');
      $('#idtmtn').val(null).trigger('change');
      $('#idsbmn').val(null).trigger('change');
      $('#nmnm').val('');
    });

    $('#sendtm').on('click', function () {
      var timn = $('#nmtm').val();
      var idmn = $('#idtm').val();
      var selct = $('#idtmt');
      if (idmn == "") {
        $.ajax({
          type:"POST",
          url:"<?php echo base_url(); ?>title_management/add_title",
          beforeSend : function () {
            swal({
              title  : 'Menunggu',
              html   : 'Memproses Data',
              onOpen : () => {
                swal.showLoading();
              }
            })
          },
          data: { timng:timn },
          dataType : "JSON",
          success  : function (data) {
            swal({
              title             : data['status'],
              text              : data['pesan'],
              type              : data['altr'],
              showConfirmButton : false,
              timer             : 3000
            });
            if (data['altr'] == 'success') {
              var o = $('<option/>', {value: data['list']}).text(timn);
              o.appendTo(selct);
              $('#nmtm').val('');
              $('#idtm').val('');
            }
            titlex.ajax.reload();
            subtitle.ajax.reload();
            namex.ajax.reload();
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
          url:"<?php echo base_url(); ?>title_management/edit_title/"+idmn,
          beforeSend : function () {
            swal({
              title  : 'Menunggu',
              html   : 'Memproses Data',
              onOpen : () => {
                swal.showLoading();
              }
            })
          },
          data: { timng:timn },
          dataType : "JSON",
          success  : function (data) {
            swal({
              title             : data['status'],
              text              : data['pesan'],
              type              : data['altr'],
              showConfirmButton : false,
              timer             : 3000
            });
            if (data['altr'] == 'success') {
              $('#nmtm').val('');
              $('#idtm').val('');
              for (var i = 0; i < selct[0].length; i++) {
                if (selct[0][i].value == idmn) {
                  selct[0][i].innerHTML = timn;
                }
              }
            }
            titlex.ajax.reload();
            subtitle.ajax.reload();
            namex.ajax.reload();
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
    });
    $('#sendsm').on('click', function () {
      var idsm = $('#idsm').val();
      var idmn = $('#idtmt').val();
      var nmsm = $('#nmsm').val();
      var selct = $('#idsbm');
      if (idsm == "") {
        $.ajax({
          type:"POST",
          url:"<?php echo base_url(); ?>title_management/add_subtitle",
          beforeSend : function () {
            swal({
              title  : 'Menunggu',
              html   : 'Memproses Data',
              onOpen : () => {
                swal.showLoading();
              }
            })
          },
          data: { idtimng:idmn, subtimng:nmsm },
          dataType : "JSON",
          success  : function (data) {
            swal({
              title             : data['status'],
              text              : data['pesan'],
              type              : data['altr'],
              showConfirmButton : false,
              timer             : 3000
            });
            if (data['altr'] == 'success') {
              $('#clearsm').trigger('click');
              var o = $('<option/>', {value: data['list']}).text(nmsm);
              o.appendTo(selct);
            }
            // $('#idsm').val('');
            // $('#idtmt').val('');
            // $('#nmsm').val('');
            titlex.ajax.reload();
            subtitle.ajax.reload();
            namex.ajax.reload();
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
          url:"<?php echo base_url(); ?>title_management/edit_subtitle/"+idsm,
          beforeSend : function () {
            swal({
              title  : 'Menunggu',
              html   : 'Memproses Data',
              onOpen : () => {
                swal.showLoading();
              }
            })
          },
          data: { idtimng:idmn, subtimng:nmsm },
          dataType : "JSON",
          success  : function (data) {
            swal({
              title             : data['status'],
              text              : data['pesan'],
              type              : data['altr'],
              showConfirmButton : false,
              timer             : 3000
            });
            if (data['altr'] == 'success') {
              $('#clearsm').trigger('click');
              // for (var i = 0; i < selct[0].length; i++) {
              //   if (selct[0][i].value == idsm) {
              //     selct[0][i].innerHTML = nmsm;
              //   }
              // }

              titlex.ajax.reload(null, false);
              subtitle.ajax.reload(null, false);
              namex.ajax.reload(null, false);
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
      }
    });
    $('#sendnm').on('click', function () {
      var idsm = $('#idnm').val();
      var idmn = $('#idtmtn').val();
      var idsn = $('#idsbmn').val();
      var nmnm = $('#nmnm').val();
      if (idsm == "") {
        $.ajax({
          type:"POST",
          url:"<?php echo base_url(); ?>title_management/add_name",
          beforeSend : function () {
            swal({
              title  : 'Menunggu',
              html   : 'Memproses Data',
              onOpen : () => {
                swal.showLoading();
              }
            })
          },
          data: { idsbmng:idsn, nmemng:nmnm },
          dataType : "JSON",
          success  : function (data) {
            swal({
              title             : data['status'],
              text              : data['pesan'],
              type              : data['altr'],
              showConfirmButton : false,
              timer             : 3000
            });
            if (data['altr'] == 'success') {
              $('#clearnm').trigger('click');
            }
            // $('#idsm').val('');
            // $('#idtmt').val('');
            // $('#idsbm').val('');
            // $('#nmnm').val('');
            titlex.ajax.reload();
            subtitle.ajax.reload();
            namex.ajax.reload();
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
          url:"<?php echo base_url(); ?>title_management/edit_name/"+idsm,
          beforeSend : function () {
            swal({
              title  : 'Menunggu',
              html   : 'Memproses Data',
              onOpen : () => {
                swal.showLoading();
              }
            })
          },
          data: { idsbmng:idsn, nmemng:nmnm },
          dataType : "JSON",
          success  : function (data) {
            swal({
              title             : data['status'],
              text              : data['pesan'],
              type              : data['altr'],
              showConfirmButton : false,
              timer             : 3000
            });
            if (data['altr'] == 'success') {
              $('#clearnm').trigger('click');
            }
            // $('#idsm').val('');
            // $('#idtmt').val('');
            // $('#idsbm').val('');
            // $('#nmnm').val('');
            titlex.ajax.reload();
            subtitle.ajax.reload();
            namex.ajax.reload();
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
    });

  });

  function setsubt(idx, ck) {
    $.ajax({
      type:"GET",
      url:"<?php echo base_url(); ?>/title_management/subtitlebyidtitle/"+idx,
      success : function (data) {
        var hss = JSON.parse(data); var o = '<option value="">-- Pilih --</option>';
        for (var i = 0; i < hss.length; i++) {
          if (ck == 0) {
            var o = o+'<option value='+hss[i].id_subtitle_management+'>'+hss[i].subtitle_management+'</option>';
          } else {
            if (ck == hss[i].id_subtitle_management) {
              var o = o+'<option value='+hss[i].id_subtitle_management+' selected>'+hss[i].subtitle_management+'</option>';
            } else {
              var o = o+'<option value='+hss[i].id_subtitle_management+'>'+hss[i].subtitle_management+'</option>';
            }
          }
        }
        $('#idsbmn').html(o);
      }
    });
  }

  function ubahubah(id, set) {
    window.scrollTo(0,0);
    var urll = '';
    if (set == 1) {
      urll = "<?php echo base_url(); ?>/title_management/showtitle/"+id;
    } else if (set == 2) {
      urll = "<?php echo base_url(); ?>/title_management/showsubtitle/"+id;
    } else {
      urll = "<?php echo base_url(); ?>/title_management/showname/"+id;
    }

    $.ajax({
      type:"GET", url:urll,
      success : function (data) {
        var hss = JSON.parse(data);
        if (set == 1) {
          $('#idtm').val(hss[0]['id_title_management']);
          $('#nmtm').val(hss[0]['title_management']);
        } else if (set == 2) {
          $('#idsm').val(hss[0]['id_subtitle_management']);
          $('#idtmt').val(hss[0]['id_title_management']).trigger('change');
          $('#nmsm').val(hss[0]['subtitle_management']);
        } else {
          $('#idnm').val(hss[0]['id_name_management']);
          $('#idtmtn').val(hss[0]['id_title_management']).trigger('change');
          setsubt(hss[0]['id_title_management'], hss[0]['id_subtitle_management']);
          $('#nmnm').val(hss[0]['name_management']);
        }
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

  function deletedel(id, set) {
    var urll = '';
    var selct = '';
    var selcs = '';
    if (set == 1) {
      urll = "<?php echo base_url(); ?>/title_management/remove_title/"+id;
      selct = $('#idtmt'); selcs = $('#idsbm');
    } else if (set == 2) {
      urll = "<?php echo base_url(); ?>/title_management/remove_subtitle/"+id;
      selct = $('#idtmt'); selcs = $('#idsbm');
    } else {
      urll = "<?php echo base_url(); ?>/title_management/remove_name/"+id;
      selct = ''; selcs = '';
    }

    swal({
      title       : 'Konfirmasi',
      text        : 'Yakin akan Menghapus Data Tersebut',
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
          type:"GET", url:urll,
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
              text              : "Data telah di Hapus",
              type              : 'success',
              showConfirmButton : false,
              timer             : 3000
            });
            titlex.ajax.reload();
            subtitle.ajax.reload();
            namex.ajax.reload();
            if (selct != '') {
              for (var i = 0; i < selct[0].length; i++) {
                if (selct[0][i].value == id) {
                  $(selct[0][i]).remove();
                }
              }
            }
            if (selcs != '') {
              for (var i = 0; i < selcs[0].length; i++) {
                if (selcs[0][i].value == id) {
                  $(selcs[0][i]).remove();
                }
              }
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
      } else if (result.dismiss === swal.DismissReason.cancel) {
        swal({
          title               : "Batal",
          text                : 'Anda membatalkan Hapus Data',
          buttonsStyling      : false,
          confirmButtonClass  : "btn btn-primary",
          type                : 'error',
          showConfirmButton   : false,
          timer               : 3000
        });
      }
    });
  }
</script>
