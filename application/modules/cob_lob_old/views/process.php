<script type="text/javascript">
  var cob = '';
  var lob = '';
  var col = '';
  var cov = '';
  $(document).ready(function () {
    cob = $('#datatable1').DataTable({
      "processing" : true,
      "serverSide" : true,
      "order" : [],
      "ajax" : {
        "url" : "<?php echo base_url(); ?>cob_lob/ajaxdatacob",
        "type" : "POST"
      },
      "columnDefs" : [{
        "targets" : [0,4],
        "orderable" : false
      },{
        'targets' : [0,4],
        'className' : 'text-center',
      }],
      "scrollX" : true
    });
    lob = $('#datatable2').DataTable({
      "processing" : true,
      "serverSide" : true,
      "order" : [],
      "ajax" : {
        "url" : "<?php echo base_url(); ?>cob_lob/ajaxdatalob",
        "type" : "POST"
      },
      "columnDefs" : [{
        "targets" : [0,3],
        "orderable" : false
      },{
        'targets' : [0,3],
        'className' : 'text-center',
      }],
      // "scrollX" : true
    });
    col = $('#datatable3').DataTable({
      "processing" : true,
      "serverSide" : true,
      "order" : [],
      "ajax" : {
        "url" : "<?php echo base_url(); ?>cob_lob/ajaxdataboth",
        "type" : "POST"
      },
      "columnDefs" : [{
        "targets" : [0,4],
        "orderable" : false
      },{
        'targets' : [0,4],
        'className' : 'text-center',
      }],
      // "scrollX" : true
    });

    $(".modal").on("hidden.bs.modal", function(){
      $('#idcov').val('');
      $('#lbcov').val('');
      $('#lacov').val('');
      $("#racov").val('');
      $('#stcov').val('');
    });

    $('#clearcob').on('click', function () {
      $('#idcob').val('');
      $('#cobnme').val('');
      $('#cobtyp').val('');
    });
    $('#clearlob').on('click', function () {
      $('#idlob').val('');
      $('#lobnme').val('');
      $('#tdisk').val('');
    });
    $('#clearall').on('click', function () {
      $('#idrel').val('');
      $('#cobty').val('');
      $('#lobty').val('');
    });

    $('#sendcob').on('click', function () {
      var idcob = $('#idcob').val();
      var nmcob = $('#cobnme').val();
      var tycob = $('#cobtyp').val();
      var selct = $('#cobty');
      if (idcob == "") { //insert
        $.ajax({
          type:"POST",
          url:"<?php echo base_url(); ?>cob_lob/addcob",
          beforeSend : function () {
            swal({
              title  : 'Menunggu',
              html   : 'Memproses Data',
              onOpen : () => {
                swal.showLoading();
              }
            })
          },
          data: { nmcob:nmcob, tycob:tycob },
          dataType : "JSON",
          success  : function (data) {
            swal({
              title             : "Berhasil",
              text              : "COB telah di Tambahkan",
              type              : 'success',
              showConfirmButton : false,
              timer             : 1000
            });
            var o = $('<option/>', {value: data['list']}).text(nmcob);
            o.appendTo(selct);
            $('#idcob').val('');
            $('#cobnme').val('');
            $('#cobtyp').val('');
            cob.ajax.reload();
            lob.ajax.reload();
            col.ajax.reload();
            return true;
          },
          error: function (jqXHR, textStatus, errorThrown) {
            swal({
              title             : "Peringatan",
              text              : "Koneksi Tidak Terhubung",
              type              : 'warning',
              showConfirmButton : false,
              timer             : 1000
            });
            return false;
          }
        });
      } else { //update
        $.ajax({
          type:"POST",
          url:"<?php echo base_url(); ?>cob_lob/editcob/"+idcob,
          beforeSend : function () {
            swal({
              title  : 'Menunggu',
              html   : 'Memproses Data',
              onOpen : () => {
                swal.showLoading();
              }
            })
          },
          data: { nmcob:nmcob, tycob:tycob },
          dataType : "JSON",
          success  : function (data) {
            swal({
              title             : "Berhasil",
              text              : "COB telah di Update",
              type              : 'success',
              showConfirmButton : false,
              timer             : 1000
            });
            var o = $('<option/>', {value: idcob}).text(nmcob);
            $('#idcob').val('');
            $('#cobnme').val('');
            $('#cobtyp').val('');
            cob.ajax.reload();
            lob.ajax.reload();
            col.ajax.reload();
            for (var i = 0; i < selct[0].length; i++) {
              if (selct[0][i].value == idcob) {
                selct[0][i].innerHTML = nmcob;
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
              timer             : 1000
            });
            return false;
          }
        });
      }
    });

    $('#sendlob').on('click', function () {
      var idlob = $('#idlob').val();
      var nmlob = $('#lobnme').val();
      var tplob = $('#tdisk').val();
      var selcx = $('#lobty');
      if (idlob == "") { //insert
        $.ajax({
          type:"POST",
          url:"<?php echo base_url(); ?>cob_lob/addlob",
          beforeSend : function () {
            swal({
              title  : 'Menunggu',
              html   : 'Memproses Data',
              onOpen : () => {
                swal.showLoading();
              }
            })
          },
          data: { nmlob:nmlob, tplob:tplob },
          dataType : "JSON",
          success  : function (data) {
            swal({
              title             : "Berhasil",
              text              : "LOB telah di Tambahkan",
              type              : 'success',
              showConfirmButton : false,
              timer             : 1000
            });
            var o = $('<option/>', {value: data['list']}).text(nmlob);
            o.appendTo(selcx);
            cob.ajax.reload();
            lob.ajax.reload();
            col.ajax.reload();
            return true;
          },
          error: function (jqXHR, textStatus, errorThrown) {
            swal({
              title             : "Peringatan",
              text              : "Koneksi Tidak Terhubung",
              type              : 'warning',
              showConfirmButton : false,
              timer             : 1000
            });
            return false;
          }
        });
      } else { //update
        $.ajax({
          type:"POST",
          url:"<?php echo base_url(); ?>cob_lob/editlob/"+idlob,
          beforeSend : function () {
            swal({
              title  : 'Menunggu',
              html   : 'Memproses Data',
              onOpen : () => {
                swal.showLoading();
              }
            })
          },
          data: { nmlob:nmlob, tplob:tplob },
          dataType : "JSON",
          success  : function (data) {
            swal({
              title             : "Berhasil",
              text              : "LOB telah di Update",
              type              : 'success',
              showConfirmButton : false,
              timer             : 1000
            });
            var o = $('<option/>', {value: idlob}).text(nmlob);
            cob.ajax.reload();
            lob.ajax.reload();
            col.ajax.reload();
            for (var i = 0; i < selcx[0].length; i++) {
              if (selcx[0][i].value == idlob) {
                selcx[0][i].innerHTML = nmlob;
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
              timer             : 1000
            });
            return false;
          }
        });
      }
      $('#idlob').val('');
      $('#lobnme').val('');
      $('#tdisk').val('');
    });

    $('#sendall').on('click', function () {
      var idrel = $('#idrel').val();
      var cobrl = $('#cobty').val();
      var lobrl = $('#lobty').val();
      if (idrel == "") { //insert
        $.ajax({
          type:"POST",
          url:"<?php echo base_url(); ?>cob_lob/addbth",
          beforeSend : function () {
            swal({
              title  : 'Menunggu',
              html   : 'Memproses Data',
              onOpen : () => {
                swal.showLoading();
              }
            })
          },
          data: { cobrl:cobrl, lobrl:lobrl },
          dataType : "JSON",
          success  : function (data) {
            swal({
              title             : "Berhasil",
              text              : "Relasi COB dan LOB telah di Tambahkan",
              type              : 'success',
              showConfirmButton : false,
              timer             : 1000
            });
            $('#idrel').val('');
            $('#cobty').val('');
            $('#lobty').val('');
            cob.ajax.reload();
            lob.ajax.reload();
            col.ajax.reload();
            return true;
          },
          error: function (jqXHR, textStatus, errorThrown) {
            swal({
              title             : "Peringatan",
              text              : "Koneksi Tidak Terhubung",
              type              : 'warning',
              showConfirmButton : false,
              timer             : 1000
            });
            return false;
          }
        });
      } else { //update
        $.ajax({
          type:"POST",
          url:"<?php echo base_url(); ?>cob_lob/editbth/"+idrel,
          beforeSend : function () {
            swal({
              title  : 'Menunggu',
              html   : 'Memproses Data',
              onOpen : () => {
                swal.showLoading();
              }
            })
          },
          data: { cobrl:cobrl, lobrl:lobrl },
          dataType : "JSON",
          success  : function (data) {
            swal({
              title             : "Berhasil",
              text              : "Relasi COB dan LOB telah di Update",
              type              : 'success',
              showConfirmButton : false,
              timer             : 1000
            });
            $('#idrel').val('');
            $('#cobty').val('');
            $('#lobty').val('');
            cob.ajax.reload();
            lob.ajax.reload();
            col.ajax.reload();
            return true;
          },
          error: function (jqXHR, textStatus, errorThrown) {
            swal({
              title             : "Peringatan",
              text              : "Koneksi Tidak Terhubung",
              type              : 'warning',
              showConfirmButton : false,
              timer             : 1000
            });
            return false;
          }
        });
      }
    });

    $('#sendcove').on('click', function () {
      var covla = $('#lacov').val();
      var covra = $('#racov').val();
      var covlb = $('#lbcov').val();
      var covst = $('#stcov').val();
      var covid = $('#idcov').val();
      if (covid == "") {
        $.ajax({
          type:"POST",
          url:"<?php echo base_url(); ?>coverage/add",
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
            labc:covla,
            ratc:covra,
            stac:covst,
            lobc:covlb
          },
          dataType : "JSON",
          success  : function (data) {
            swal({
              title             : "Berhasil",
              text              : "Coverage telah di Tambahkan",
              type              : 'success',
              showConfirmButton : false,
              timer             : 1000
            });
            return true;
          },
          error: function (jqXHR, textStatus, errorThrown) {
            swal({
              title             : "Peringatan",
              text              : "Koneksi Tidak Terhubung",
              type              : 'warning',
              showConfirmButton : false,
              timer             : 1000
            });
            return false;
          }
        });
      } else {
        $.ajax({
          type:"POST",
          url:"<?php echo base_url(); ?>coverage/edit/"+covid,
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
            labc:covla,
            ratc:covra,
            stac:covst,
            lobc:covlb
          },
          dataType : "JSON",
          success  : function (data) {
            swal({
              title             : "Berhasil",
              text              : "Coverage Data telah di Update",
              type              : 'success',
              showConfirmButton : false,
              timer             : 1000
            });
            return true;
          },
          error: function (jqXHR, textStatus, errorThrown) {
            swal({
              title             : "Peringatan",
              text              : "Koneksi Tidak Terhubung",
              type              : 'warning',
              showConfirmButton : false,
              timer             : 1000
            });
            return false;
          }
        });
      }
      $('#lacov').val('');
      $('#racov').val('');
      $('#stcov').val('');
      $('#idcov').val('');
      cov.ajax.reload();
    });
  });

  function ubahubah(id, set) {
    window.scrollTo(0,0);
    var urll = '';
    if (set == 1) {
      urll = "<?php echo base_url(); ?>/cob_lob/showcob/"+id;
    } else if (set == 2) {
      urll = "<?php echo base_url(); ?>/cob_lob/showlob/"+id;
    } else {
      urll = "<?php echo base_url(); ?>/cob_lob/showbth/"+id;
    }

    $.ajax({
      type:"GET", url:urll,
      success : function (data) {
        var hss = JSON.parse(data);
        if (set == 1) {
          $('#idcob').val(hss[0]['id_cob']);
          $('#cobnme').val(hss[0]['cob']);
          $('#cobtyp').val(hss[0]['id_tipe_cob']);
        } else if (set == 2) {
          $('#idlob').val(hss[0]['id_lob']);
          $('#lobnme').val(hss[0]['lob']);
          $('#tdisk').val(hss[0]['diskon']);
        } else {
          $('#idrel').val(hss[0]['id_relasi_cob_lob']);
          $('#cobty').val(hss[0]['id_cob']);
          $('#lobty').val(hss[0]['id_lob']);
        }
      },
      error: function (jqXHR, textStatus, errorThrown) {
        swal({
          title             : "Peringatan",
          text              : "Koneksi Tidak Terhubung",
          type              : 'warning',
          showConfirmButton : false,
          timer             : 1000
        });
        return false;
      }
    });
  }

  function deletedel(id, set) {
    var urll = ''; var selcw = '';
    if (set == 1) {
      urll = "<?php echo base_url(); ?>/cob_lob/removecob/"+id;
      selcw = $('#cobty');
    } else if (set == 2) {
      urll = "<?php echo base_url(); ?>/cob_lob/removelob/"+id;
      selcw = $('#lobty');
    } else {
      urll = "<?php echo base_url(); ?>/cob_lob/removebth/"+id;
      selcw = '';
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
              timer             : 1000
            });
            cob.ajax.reload();
            lob.ajax.reload();
            col.ajax.reload();
            if (selcw != '') {
              for (var i = 0; i < selcw[0].length; i++) {
                if (selcw[0][i].value == id) {
                  $(selcw[0][i]).remove();
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
              timer             : 1000
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
          timer               : 1000
        });
      }
    });
  }

  function createcoverage(id_lob) {
    $('#lbcov').val(id_lob);
    cov = $('#coveraged').DataTable({
      "destroy" : true,
      "processing" : true,
      "serverSide" : true,
      "order" : [],
      "ajax" : {
        "type" : "POST",
        "url" : "<?php echo base_url(); ?>coverage/ajaxdata",
        "data" : { id_lob: id_lob }
      },
      "columnDefs" : [{
        "targets" : [0,4],
        "orderable" : false
      },{
        'targets' : [0,4],
        'className' : 'text-center',
      }]
    });
    $('#coveraged_filter').css('margin-left', '-50px');
  }

  function ubahlob(id) {
    $.ajax({
      type:"GET",
      url:"<?php echo base_url(); ?>coverage/show/"+id,
      success  : function (data) {
        var hss = JSON.parse(data);
        $('#lacov').val(hss[0].label);
        $('#racov').val(hss[0].rate);
        $('#stcov').val(hss[0].status);
        $('#idcov').val(hss[0].id_coverage);
      },
      error: function (jqXHR, textStatus, errorThrown) {
        swal({
          title             : "Peringatan",
          text              : "Koneksi Tidak Terhubung",
          type              : 'warning',
          showConfirmButton : false,
          timer             : 1000
        });
        return false;
      }
    });
  }

  function deletelob(id) {
    swal({
      title       : 'Konfirmasi',
      text        : 'Yakin akan Menghapus Coverage',
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
          url:"<?php echo base_url(); ?>coverage/remove/"+id,
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
              text              : "Coverage telah di Hapus",
              type              : 'success',
              showConfirmButton : false,
              timer             : 1000
            });
            table_coverage.ajax.reload();
            return true;
          },
          error: function (jqXHR, textStatus, errorThrown) {
            swal({
              title             : "Peringatan",
              text              : "Koneksi Tidak Terhubung",
              type              : 'warning',
              showConfirmButton : false,
              timer             : 1000
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
          timer               : 1000
        });
      }
    });
  }
</script>
