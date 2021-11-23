<script type="text/javascript">
  $(document).ready(function () {
    $.ajax({
      type:"GET",
      url:"<?php echo base_url(); ?>field_sppa/listfield/",
      success  : function (data) {
        var hss = JSON.parse(data); var fmisi = '<option value="">-- Pilih --</option>';
        for (var i = 0; i < hss.length; i++) {
          fmisi = fmisi+'<option value="'+hss[i]['id_field_sppa']+'">'+hss[i]['field_sppa']+'</option>';
        }
        $('#isfild').html(fmisi);
      }
    });

    $('#gotofieldsppa').on('click', function () {
      window.location.href = "<?php echo base_url(); ?>master/class_business/field_sppa";
    });

    $('#saveprop').on('click', function (e) {
      e.preventDefault();
      swal({
        title       : 'Konfirmasi',
        text        : 'Yakin data yang di input Sudah Benar ?',
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
          if ($('#dtty').val() == "") {
            swal({
              title             : "Gagal",
              text              : "Label Belum di Isi",
              type              : 'Warning',
              showConfirmButton : false,
              timer             : 3000
            });
            return false;
          } else {
            var dataa = $('#colectprop').serialize();
            // if ($('#inty').val() == 'T' || $('#inty').val() == 'N' || $('#inty').val() == 'A') {
              // if ($('#lng_min').val() == '' || $('#lng_max').val() == '') {
              //   swal({
              //     title             : "Gagal",
              //     text              : "Min Length atau Max Lengt Tidak di Isi !",
              //     type              : 'warning',
              //     showConfirmButton : false,
              //     timer             : 1500
              //   });
              // } else {
                // setcolect(dataa);
              // }
            // } else {
              setcolect(dataa);
            // }
          }
        } else if (result.dismiss === swal.DismissReason.cancel) {
          swal({
            title               : "Batal",
            text                : 'Anda membatalkan Penginputan Properties',
            buttonsStyling      : false,
            confirmButtonClass  : "btn btn-primary",
            type                : 'error',
            showConfirmButton   : false,
            timer               : 1000
          });
        }
      });
    });

    function setcolect(daata) {
      $.ajax({
        type:"POST",
        url:"<?php echo base_url(); ?>business_specifications/setprop",
        beforeSend : function () {
          swal({
            title  : 'Menunggu',
            html   : 'Memproses Data',
            onOpen : () => {
              swal.showLoading();
            }
          })
        },
        data : daata,
        success  : function (data) {
          swal({
            title             : "Berhasil",
            text              : "Properties telah di Buat",
            type              : 'success',
            showConfirmButton : false,
            timer             : 3000
          });
          storedata(1,data);
          $('#myModal').modal('hide');
          $('#conditional').hide();
          $('#condlength').hide();
          $('#spartor').hide();
          $('input[name="sprt"][value="0"]').prop('checked', false);
          $('input[name="sprt"][value="1"]').prop('checked', false);
          $('input[name="mnu"][value="0"]').prop('checked', false);
          $('input[name="mnu"][value="1"]').prop('checked', false);
          $('#dtty').val('');
          $('#inty').val('');
          $('#lng_max').val('');
          $('#lng_min').val('');
          var tempel = '<tr>'+
          '<td><input type="text" name="foval[]" id="foval" class="form-control" placeholder="Values" value=""></td>'+
          '<td><input type="text" name="fonme[]" id="fonme" class="form-control" placeholder="Name Option" value=""></td>'+
          '<td><a class="btn btn-success waves-effect waves-light" onclick="addopt()"><i class="icon-plus"></i></a></td>'+
          '</tr>';
          $('#istable').html(tempel);
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

    $('#myModal').on('hidden.bs.modal', function (e) {
      $('#myModal').modal('hide');
      $('#conditional').hide();
      $('#condlength').hide();
      $('#spartor').hide();
      $('input[name="sprt"][value="0"]').prop('checked', false);
      $('input[name="sprt"][value="1"]').prop('checked', false);
      $('input[name="mnu"][value="0"]').prop('checked', false);
      $('input[name="mnu"][value="1"]').prop('checked', false);
      $('#dtty').val('');
      $('#inty').val('');
      $('#lng_max').val('');
      $('#lng_min').val('');
      var tempel = '<tr>'+
                    '<td><input type="text" name="foval[]" id="foval" class="form-control" placeholder="Values" value=""></td>'+
                    '<td><input type="text" name="fonme[]" id="fonme" class="form-control" placeholder="Name Option" value=""></td>'+
                    '<td><a class="btn btn-success waves-effect waves-light" onclick="addopt()"><i class="icon-plus"></i></a></td>'+
                   '</tr>';
      $('#istable').html(tempel);
    });

    $('#setosend').on('click', function (e) {
      e.preventDefault();
      swal({
        title       : 'Konfirmasi',
        text        : 'Yakin data yang di input Sudah Benar ?',
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
          if ($('#idlob').val() == "") {
            swal({
              title             : "Perhatian",
              text              : "LOB Belum di Pilih",
              type              : 'warning',
              showConfirmButton : false,
              timer             : 3000
            });
            return false;
          } else if ($('#slcob').val() == "") {
            swal({
              title             : "Perhatian",
              text              : "COB Belum di Pilih",
              type              : 'warning',
              showConfirmButton : false,
              timer             : 3000
            });
            return false;
          } else {
            $.ajax({
            type:"POST",
            url:"<?php echo base_url(); ?>business_specifications/add",
            beforeSend : function () {
              swal({
                title  : 'Menunggu',
                html   : 'Memproses Data',
                onOpen : () => {
                  swal.showLoading();
                }
              })
            },
            data : $('#sendbspc').serialize(),
            success  : function (data) {
              swal({
                title             : "Berhasil",
                text              : "Business Specifications telah di Buat",
                type              : 'success',
                showConfirmButton : false,
                timer             : 3000
              });
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
        } else if (result.dismiss === swal.DismissReason.cancel) {
          swal({
            title               : "Batal",
            text                : 'Anda membatalkan Penginputan Business Specifications',
            buttonsStyling      : false,
            confirmButtonClass  : "btn btn-primary",
            type                : 'error',
            showConfirmButton   : false,
            timer               : 1000
          });
        }
      });
    });

    $('#setpreview').on('click', function (e) {
      $.ajax({
        type:"POST",
        url:"<?php echo base_url(); ?>business_specifications/previewn",
        beforeSend : function () {
          swal({
            title  : 'Menunggu',
            html   : 'Memproses Data',
            onOpen : () => {
              swal.showLoading();
            }
          })
        },
        data : $('#sendbspc').serialize(),
        dataType : "JSON",
        success  : function (data) {
          swal({
            title             : "Berhasil",
            text              : "Business Specifications telah di Buat",
            type              : 'success',
            showConfirmButton : false,
            timer             : 3000
          });
          var ttx = ''
          for (var i = 0; i < data['hasil'].length; i++) {
            ttx = ttx+data['hasil'][i][0];
          }
          swal({
            title             : "Preview Form Set Business Specification",
            html              : ttx,
            customClass       : 'swal-wide',
            showCancelButton  : false,
            confirmButtonClass: "btn-primary",
            confirmButtonText : "Kembali",
            closeOnConfirm    : false
          });
          return true;
        },
        error: function (jqXHR, textStatus, errorThrown) {
          swal({
            title             : "Peringatan",
            text              : "Tidak Bisa Menampilkan Preview Form",
            type              : 'warning',
            showConfirmButton : false,
            timer             : 3000
          });
          return false;
        }
      });
    });

    $('#caseone').hide();
    $('#casetwo').hide();
    $('[name="mnu"]').on('click', function () {
      if ($(this).val() == 0) {
        $('#caseone').show();
        $('#casetwo').hide();
      } else {
        $('#caseone').hide();
        $('#casetwo').show();
      }
    });

    $.ajax({
      type:"GET",
      url:"<?php echo base_url(); ?>business_specifications/listmastermenu",
      success  : function (data) {
        var hss = JSON.parse(data); var fmisi = '<option value="">-- Pilih --</option>';
        for (var i = 0; i < hss.length; i++) {
          fmisi = fmisi+'<option value="'+hss[i]['table_name']+'">'+hss[i]['table_name']+'</option>';
        }
        $('#frdbs').html(fmisi);
      }
    });
  });

  $('#conditional').hide();
  $('#condlength').hide();
  $('#spartor').hide();
  function changetypen(wsh) {
    if (wsh.value == 'S') {
      $('#conditional').show();
      $('#condlength').hide();
      $('#spartor').hide();
    } else if (wsh.value == 'C') {
      $('#conditional').hide();
      $('#condlength').hide();
      $('#spartor').hide();
    } else if (wsh.value != 'C' || wsh.value != 'S') {
      $('#conditional').hide();
      $('#condlength').show();
      $('#spartor').hide();
      if (wsh.value == 'N') {
        $('#spartor').show();
      } else {
        $('#spartor').hide();
      }
    } else {
      $('#spartor').hide();
      $('#conditional').hide();
      $('#condlength').hide();
      var tempel = "<tr>"+
                    "<td>"+aropti[0]+"</td>"+
                    "<td>"+aropti[1]+"</td>"+
                    "<td>"+aropti[2]+"</td>"+
                   "</tr>";
      $('#istable').html(tempel);
    }
  }

  function isJson(str) {
    try {
        JSON.parse(str);
    } catch (e) {
        return false;
    }
    return true;
  }

  var ccx = '';
  function storedata(hyy,list) {
    var tabx = document.getElementById('istable');
    var haa = list.parentElement;
    if (hyy == 0) {
      ccx = haa.getElementsByTagName('input');
      if (ccx[0].value != "") {
        var resx = JSON.parse(ccx[0].value);
        $('#dtty').val(resx.type);
        $('#inty').val(resx.intp);
        var cex = '';
        if (typeof resx.unqe == 'boolean') {
          cex = (resx.unqe == true) ? 't':'f';
        } else {
          cex = resx.unqe;
        }
        $('[name="stat"]').each(function () {
          if (this.value == cex)
            this.checked = true;
        });
        if (resx.opti != "null" && resx.opti != null) {
          $('input[name="mnu"][value="'+resx.opfl+'"]').prop('checked', true);
          if (resx.opfl == 1) {
            var fdb = isJson(resx.opti) == false ? resx.opti : JSON.parse(resx.opti);
            $('#frdbs').val(fdb.tbnme);
            $('#caseone').hide();
            $('#casetwo').show();
          } else {
            var redata = Array.isArray(resx.opti) == true ? resx.opti : JSON.parse(resx.opti);
            var opisi = redata;
            tabx.innerHTML = '';
            $.each(opisi, function (i, val) {
              var row = tabx.insertRow(i);

              var cell1 = row.insertCell(0);
              var cell2 = row.insertCell(1);
              var cell3 = row.insertCell(2);

              cell3.classList.add('text-center');

              cell1.innerHTML = '<input type="text" name="foval[]" id="foval" class="form-control" placeholder="Values" value="'+val.valuen+'">';
              cell2.innerHTML = '<input type="text" name="fonme[]" id="fonme" class="form-control" placeholder="Name Option" value="'+val.nameny+'">';
              cell3.innerHTML = '<a class="btn btn-danger waves-effect waves-light" onclick="rmvopt(this)"><i class="icon-trash-bin"></i></a>';
            });
            tabx.rows[tabx.rows.length-1].cells[2].innerHTML = '<a class="btn btn-success waves-effect waves-light" onclick="addopt()"><i class="icon-plus"></i></a>';
            $('#caseone').show();
            $('#casetwo').hide();
          }
          $('#condlength').hide();
          $('#conditional').show();
        } else {
          $('#conditional').hide();
          $('#condlength').hide();
        }
        if (resx.lngh != "" && resx.lngh != null && resx.lngh != "null") {
          var xzc = isJson(resx.lngh) == true ? JSON.parse(resx.lngh) : resx.lngh;
          $('#condlength').show();
          $('#lng_max').val(xzc.max);
          $('#lng_min').val(xzc.min);
        } else {
          $('#condlength').hide();
          $('#lng_max').val('');
          $('#lng_min').val('');
        }
      } else {
        var se_index = haa.parentElement.cells[0].getElementsByTagName('select')[0];
        var isi_text = se_index.getElementsByTagName('option')[se_index.selectedIndex].text;
        if (isi_text.split(' ').length > 1) {
          var set_text = "";
          for (var i = 0; i < isi_text.split(' ').length; i++) {
            set_text = set_text+isi_text.split(' ')[i]+'_';
          }
          $('#dtty').val(set_text.substr(0,set_text.length-1));
        } else {
          $('#dtty').val(isi_text);
        }
        $('#inty').val('');
        $('#conditional').hide();
        $('#condlength').hide();
      }

    }

    if (hyy == 1) {
      ccx[0].value = list;
      var setc = ccx[0].parentElement;
      if (list != '') {
        setc.getElementsByTagName('a')[0].removeAttribute('class');
        setc.getElementsByTagName('a')[0].setAttribute('class','btn btn-secondary btn-outline-danger waves-effect waves-light');
      } else {
        setc.getElementsByTagName('a')[0].setAttribute('class','btn btn-secondary waves-effect waves-light');
      }
      $('#dtty').val('');
      $('#inty').val('');
      $('#conditional').hide();
      $('#condlength').hide();
    }
  }

  function findfindfind() {
    var input, filter, table, tr, td, i;
    input = document.getElementById("caricari");
    filter = input.value.toUpperCase();
    table = document.getElementById("myTable");
    tr = table.getElementsByTagName("tr");

    for (i = 0; i < tr.length; i++) {
      td = tr[i].getElementsByTagName("td")[0];
      if (td) {
        if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
          tr[i].style.display = "";
        } else {
          tr[i].style.display = "none";
        }
      }
    }
  }

  var locl = document.getElementById('myTable');

  function clearfomisi() {
    var clearset = '<tr>'+
                     '<td>'+
                       '<select class="form-control" name="isfild[]" id="isfild" onchange="getvalueopt(this)">'+
                         '<option value="">-- Pilih --</option>'+
                       '</select>'+
                     '</td>'+
                     '<td class="text-center">'+
                       '<a class="btn btn-secondary waves-effect waves-light" onclick="storedata(0,this)" data-toggle="modal" data-target="#myModal">'+
                         '<i class="icon-pen-pencil-ruler fa-lg"></i> Input Properties'+
                       '</a>'+
                       '<input type="hidden" name="propasset[]" id="propasset" value="">'+
                     '</td>'+
                     '<td class="text-center">'+
                       '<a style="cursor:pointer" data-toggle="tooltip" data-placement="top" title="Tambah" class="btn btn-success waves-effect waves-light" onclick="addrow()"><i class="icon-plus"></i></a>'+
                     '</td>'+
                    '</tr>';
    $('#listinput').html(clearset);
    $.ajax({
      type:"GET",
      url:"<?php echo base_url(); ?>field_sppa/listfield/",
      success  : function (data) {
        var hss = JSON.parse(data); var fmisi = '<option value="">-- Pilih --</option>';
        for (var i = 0; i < hss.length; i++) {
          fmisi = fmisi+'<option value="'+hss[i]['id_field_sppa']+'">'+hss[i]['field_sppa']+'</option>';
        }
        $('#isfild').html(fmisi);
      }
    });
  }

  function setlisttab(id) {
    var ky = id.value;
    if (ky != "") {
      $.ajax({
        type:"GET",
        url:"<?php echo base_url(); ?>business_specifications/showboth/"+ky,
        success  : function (data) {
          var hss = JSON.parse(data);
          var tabbl = '';
          for (var i = 0; i < hss.length; i++) {
            var forbtn = '<button style="cursor:pointer" data-toggle="tooltip" data-placement="top" title="Set" class="btn btn-primary waves-effect waves-light" onclick="setform(this,'+hss[i]['id_relasi_cob_lob']+')"><i class="icon-pencil fa-lg"></i></button>';
            tabbl = tabbl+'<tr><td>'+hss[i]['lob']+'</td><td class="text-center">'+forbtn+'</td></tr>';
          }
          $('#myTable').html(tabbl);
          clearfomisi();
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
  }

  function setform(tagg,id) {
    var sty = tagg.parentElement.parentElement;
    $('#setnmlob').html(sty.cells[0].innerHTML);
    $('#idlob').val(id);
    cekdata(id);
    for (var i = 0; i < sty.parentElement.rows.length; i++) {
      sty.parentElement.rows[i].style.backgroundColor = '#fff';
    }
    sty.style.backgroundColor = '#c2f1f0';
  }

  function getfielddata() {
    var hss = '';
    $.ajax({
      type:"GET",
      url:"<?php echo base_url(); ?>field_sppa/listfield/",
      success  : function (data) {
        hss = JSON.parse(data);
      },
      async: hss
    });
    return hss;
  }

  function cekdata(id) {
    $.ajax({
      type:"GET",
      url:"<?php echo base_url(); ?>business_specifications/getdatan/"+id,
      success:function (hasil) {
        var data = JSON.parse(hasil);
        if (data.length > 0) {
          var tabx = document.getElementById('listinput');
          var ckk = getfielddata();
          tabx.innerHTML = '';  var rmv = [];
          for (var i = 0; i < data.length; i++) {
            var opp = '<option value="">-- Pilih --</option>';
            rmv.push(data[i].type_field);
            for (var x = 0; x < ckk.length; x++) {
              if (data[i].type_field == ckk[x].id_field_sppa) {
                opp = opp+'<option value="'+ckk[x].id_field_sppa+'" selected>'+ckk[x].field_sppa+' - '+ckk[x].data_type+'</option>';
              } else {
                opp = opp+'<option value="'+ckk[x].id_field_sppa+'">'+ckk[x].field_sppa+' - '+ckk[x].data_type+'</option>';
              }
            }
            var isln = data[i].input_length == "\"\""?"":data[i].input_length;
            var axz = {
              type:data[i].key_to_param,
              intp:data[i].input_type,
              unqe:data[i].field_unique,
              lngh:isln,
              opfl:data[i].option_flag,
              opti:data[i].if_input_type_select
            };
            var syx = JSON.stringify(axz);

            var row = tabx.insertRow(i);

            var cell1 = row.insertCell(0);
        		var cell2 = row.insertCell(1);
        		var cell3 = row.insertCell(2);

            cell2.classList.add('text-center');
            cell3.classList.add('text-center');

            var hsisi = syx != ''?'btn-outline-danger':'';
            cell1.innerHTML = '<select class="form-control" name="isfild[]" id="isfild" onchange="getvalueopt(this)">'+opp+'</select>';
            cell2.innerHTML = '<a class="btn btn-secondary '+hsisi+' waves-effect waves-light" onclick="storedata(0,this)" data-toggle="modal" data-target="#myModal">'+
                                '<i class="icon-pen-pencil-ruler fa-lg"></i> Input Properties'+
                              '</a><input type="hidden" name="propasset[]" id="propasset" value='+syx+'>';
            cell3.innerHTML = '<a style="cursor:pointer" data-toggle="tooltip" data-placement="top" title="Hapus" class="btn btn-danger waves-effect waves-light" onclick="removee(this)"><i class="icon-trash-bin"></i></a>';
          }
          tabx.rows[data.length-1].cells[2].innerHTML = '<a style="cursor:pointer" data-toggle="tooltip" data-placement="top" title="Tambah" class="btn btn-success waves-effect waves-light" onclick="addrow()"><i class="icon-plus"></i></a>'+
                                                          '&nbsp;'+
                                                        '<a style="cursor:pointer" data-toggle="tooltip" data-placement="top" title="Hapus" class="btn btn-danger waves-effect waves-light" onclick="removee(this)"><i class="icon-trash-bin"></i></a>';
          clearselect(tabx, rmv);
        } else {
          clearfomisi();
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

  function clearselect(tble, dta) {
    for (var i = 0; i < tble.rows.length; i++) {
      var slobj = tble.rows[i].cells[0].getElementsByTagName('select')[0];
      for (var x = 0; x < slobj.length; x++) {
        for (var y = 0; y < dta.length; y++) {
          if (slobj.options[x].selected == false && slobj.options[x].value == dta[y]) {
            slobj.remove(x);
          }
        }
      }
    }
  }

  var gettable = document.getElementById('listinput');

  var arinput = [
    '<select class="form-control" name="isfild[]" id="isfild" onchange="getvalueopt(this)"><option value="">-- Pilih --</option></select>',
    '<a class="btn btn-secondary waves-effect waves-light" onclick="storedata(0,this)" data-toggle="modal" data-target="#myModal"><i class="icon-pen-pencil-ruler fa-lg"></i> Input Properties</a>',
    '<a style="cursor:pointer" data-toggle="tooltip" data-placement="top" title="Tambah" class="btn btn-success waves-effect waves-light" onclick="addrow()"><i class="icon-plus"></i></a>',
    '<a style="cursor:pointer" data-toggle="tooltip" data-placement="top" title="Hapus" class="btn btn-danger waves-effect waves-light" onclick="removee(this)"><i class="icon-trash-bin"></i></a>',
    '<input type="hidden" name="propasset[]" id="propasset" value="">'
  ];

  var arlst = [];

  function getvalueopt(shw) {
    var zx = shw.parentElement;
		var zu = zx.parentElement;
		var z = zu.rowIndex-1;

    var nmeopt = '';
    var fro = shw.getElementsByTagName('option');
    for (var i = 0; i < fro.length; i++) {
      if (fro[i].value == shw.value) {
        nmeopt = fro[i].innerHTML;
        break;
      }
    }

    var waschng = '<option value="'+shw.value+'">'+nmeopt+'</option>';
    arlst.push(waschng);
    if (arlst.length != gettable.rows.length) {
      arlst.pop();
      var slctd = [];
      for (var i = 0; i < gettable.rows.length; i++) {
        var rra = gettable.rows[i].cells[0].getElementsByTagName('select')[0];
        slctd.push(rra.value);
        if (i != z) {
          rra.innerHTML += arlst[z];
        }
      }
      for (var i = 0; i < gettable.rows.length; i++) {
        gettable.rows[i].cells[0].getElementsByTagName('select')[0].value = slctd[i];
      }
    }

    for (var i = 0; i < gettable.rows.length; i++) {
      var whr = gettable.rows[i].cells[0].getElementsByTagName('select')[0];
      if (i != z) {
        for (var x = 0; x < whr.length; x++) {
          if (whr.options[x].value == shw.value) {
            whr.remove(x);
          }
        }
      }
    }
  }

  var tabopt = document.getElementById('istable');

  var aropti = [
    '<input type="text" name="foval[]" id="foval" class="form-control" placeholder="Values" value="">',
    '<input type="text" name="fonme[]" id="fonme" class="form-control" placeholder="Name Option" value="">',
    '<a class="btn btn-success waves-effect waves-light" onclick="addopt()"><i class="icon-plus"></i></a>',
    '<a class="btn btn-danger waves-effect waves-light" onclick="rmvopt(this)"><i class="icon-trash-bin"></i></a>'
  ];

  function addopt() {
    var pjg = tabopt.rows.length;
		var row = tabopt.insertRow(pjg);

    var cell1 = row.insertCell(0);
		var cell2 = row.insertCell(1);
		var cell3 = row.insertCell(2);

    cell3.classList.add('text-center');

    cell1.innerHTML = aropti[0];
    cell2.innerHTML = aropti[1];
    cell3.innerHTML = aropti[2];
    tabopt.rows[pjg-1].cells[2].innerHTML = aropti[3];
  }

  function rmvopt(wsx) {
    var zx = wsx.parentElement;
		var zu = zx.parentElement;
		var z = zu.rowIndex-1;

    tabopt.deleteRow(z);

    var wp = tabopt.rows.length-1;
    tabopt.rows[wp].cells[2].innerHTML = aropti[2];
  }

  function addrow() {
    var pjg = gettable.rows.length;
		var row = gettable.insertRow(pjg);

    var cell1 = row.insertCell(0);
		var cell2 = row.insertCell(1);
		var cell3 = row.insertCell(2);

    cell2.classList.add('text-center');
    cell3.classList.add('text-center');

    cell1.innerHTML = arinput[0];
    cell2.innerHTML = arinput[1]+arinput[4];
    var ckop = gettable.rows[pjg-1].cells[0].getElementsByTagName('select')[0];
    if (ckop.getElementsByTagName('option').length-1 == 2) {
      cell3.innerHTML = arinput[3];
    } else {
      cell3.innerHTML = arinput[2]+'&nbsp;'+arinput[3];
    }

    gettable.rows[pjg-1].cells[2].innerHTML = arinput[3];

    var getopt = gettable.rows[pjg-1].cells[0].getElementsByTagName('select')[0];
    var valoption = getopt.value;
    if (valoption != '') {
      var newopt = getopt.getElementsByTagName('option');
      var isopt = '';
      for (var i = 0; i < newopt.length; i++) {
        if (newopt[i].value != valoption) {
          isopt = isopt+'<option value="'+newopt[i].value+'">'+newopt[i].innerHTML+'</option>';
        }
      }
      gettable.rows[pjg].cells[0].getElementsByTagName('select')[0].innerHTML = isopt;
    }
  }

  function removee(iss) {
    var zx = iss.parentElement;
		var zu = zx.parentElement;
		var z = zu.rowIndex-1;

    var opt = zu.getElementsByTagName('select')[0];
    var old = opt.getElementsByTagName('option');
    var infld = '';
    for (var i = 0; i < old.length; i++) {
      if (old[i].value != '') {
        if (old[i].value == opt.value) {
          infld = old[i].innerHTML;
          break;
        }
      }
    }
    gettable.deleteRow(z);
    if (opt.value != '') {
      var shww = [];
      var wasrmv = '<option value="'+opt.value+'">'+infld+'</option>';
      for (var i = 0; i < gettable.rows.length; i++) {
        var setsl = gettable.rows[i].cells[0];
        shww.push(setsl.getElementsByTagName('select')[0].value);
        setsl.getElementsByTagName('select')[0].innerHTML += wasrmv;
      }
      for (var i = 0; i < gettable.rows.length; i++) {
        gettable.rows[i].cells[0].getElementsByTagName('select')[0].value = shww[i];
      }
    }
    var wp = gettable.rows.length-1;
    if (wp == 0) {
      gettable.rows[wp].cells[2].innerHTML = arinput[2];
    } else {
      gettable.rows[wp].cells[2].innerHTML = arinput[2]+'&nbsp;'+arinput[3];
    }
  }
</script>
