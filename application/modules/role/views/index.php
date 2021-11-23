<div class="page-title-box">
  <div class="row align-items-center">
    <div class="col-sm-6"><h4><?= $title ?></h4></div>
    <div class="col-sm-6">
      <ol class="breadcrumb float-right">
        <li class="breadcrumb-item active"><?= $title ?></li>
      </ol>
    </div>
  </div>
</div>

<div class="row">
  <div class="col-md-12">
    <div class="card">
      <form method="post" id="inisemuaisi" enctype="multipart/form-data">
        <div class="card-body">
          <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>" style="display: none">
          <div class="form-group">
            <div class="row">
              <div style="padding-top:10px;" class="col-md-4 text-left">
                <input type="hidden" name="idjbtn" id="idjbtn" value="<?php echo $iddjabatan[0]->id_level_otorisasi; ?>">
                <b>Jenis Jabatan : </b><i><?php echo $iddjabatan[0]->level_otorisasi; ?></i>
              </div>
              <div style="padding-top:10px;" class="col-md-8 text-right">
                <div class="row">
                  <div class="col-md-4">
                    <div class="form-group row">
              				<div class="col-lg-12">
                        <select class="form-control" id="filterfilter" onchange="filterbysistem(this)" name="">
                          <option value="">-- Pilih Menu Sistem --</option>
                          <option value="home">Home</option>
                          <option value="ajk">Ajk</option>
                        </select>
              				</div>
              			</div>
                  </div>
                  <div class="col-md-5">
                    <div class="form-group row">
              				<div class="col-lg-12">
                        <input type="text" id="caricari" onkeyup="findfindfind()" class="form-control" name="cari_global" placeholder="Masukan kata kunci... (Nama Menu)"  >
              				</div>
              			</div>
                  </div>
                  <div class="col-md-3">
                    <button class="btn btn-success btn-labeled btn-xs" id="sendalldata"><b><i class="icon-files-empty2"></i></b> Simpan</button>
                    <a class="btn btn-danger btn-labeled btn-xs"  href="../../preference/user_administration/user_level/otorisasi"><b><i class="icon-arrow-left13"></i></b> Kembali</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <table class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
            <thead>
              <tr>
                <th rowspan="2" class="text-center"><label for="myMenu">Nama Menu</label><br><input type="checkbox" id="myMenu" value="ch_menu"></th>
                <th colspan="5" class="text-center">Previlege</th>
              </tr>
              <tr>
                <th class="text-center" ><input value="ch_insert" type="checkbox" id="myInsert"> <label for="myInsert">Create</label></th>
                <th class="text-center" ><input value="ch_read" type="checkbox" id="myRead"> <label for="myRead">Read</label></th>
                <th class="text-center" ><input value="ch_update" type="checkbox" id="myUpdate"> <label for="myUpdate">Update</label></th>
                <th class="text-center" ><input value="ch_delete" type="checkbox" id="myDelete"> <label for="myDelete">Delete</label></th>
                <th class="text-center" ><input value="ch_approv" type="checkbox" id="myApprov"> <label for="myApprov">Approval</label></th>
              </tr>
            </thead>
            <tbody id="myTable">
              <?php if (isset($categoryList)) {
                foreach ($categoryList as $key => $value) { $cb =""; $role = "";
                  if (isset($menuuser)) {
                    foreach ($menuuser as $keys => $values) {
                      if($values->id_menu==$value['id_menu']){
                        $cb = "checked=''"; $role = decode_role($values->action);
                      }
                    }
                  }
                  ?>
                  <tr>
                    <td><input type="checkbox" id="ch_menu_<?php echo $value['id_menu']; ?>" name="cb_pv[]" value="<?php echo $value['id_menu']; ?>" <?php echo $cb ?>>
                      <label for="ch_menu_<?php echo $value['id_menu']; ?>"><?php echo $value['nama_menu']; ?></label>
                    </td>
                    <td hidden><?php echo $value['sistem']; ?></td>
                    <td hidden><?php echo $value['parrent']; ?></td>
                    <td><input type="checkbox" id="ch_insert_<?php echo $value['id_menu']; ?>" name="role[<?php echo $value['id_menu']; ?>][]" value="C"
                      <?php echo (isset($role["create"]) && $role["create"] =="true") ? 'checked="" ' : '' ; ?>> <label for="ch_insert_<?php echo $value['id_menu']; ?>">Create</label>
                    </td>
                    <td><input type="checkbox" id="ch_read_<?php echo $value['id_menu']; ?>" name="role[<?php echo $value['id_menu']; ?>][]" value="R"
                      <?php echo (isset($role["read"]) && $role["read"] =="true") ? 'checked="" ' : '' ; ?>> <label for="ch_read_<?php echo $value['id_menu']; ?>">Read</label>
                    </td>
                    <td><input type="checkbox" id="ch_update_<?php echo $value['id_menu']; ?>" name="role[<?php echo $value['id_menu']; ?>][]" value="U"
                      <?php echo (isset($role["update"]) && $role["update"] =="true") ? 'checked="" ' : '' ; ?>> <label for="ch_update_<?php echo $value['id_menu']; ?>">Update</label>
                    </td>
                    <td><input type="checkbox" id="ch_delete_<?php echo $value['id_menu']; ?>" name="role[<?php echo $value['id_menu']; ?>][]" value="D"
                      <?php echo (isset($role["delete"]) && $role["delete"] =="true") ? 'checked="" ' : '' ; ?>> <label for="ch_delete_<?php echo $value['id_menu']; ?>">Delete</label>
                    </td>
                    <td><input type="checkbox" id="ch_approv_<?php echo $value['id_menu']; ?>" name="role[<?php echo $value['id_menu']; ?>][]" value="A"
                      <?php echo (isset($role["approve"]) && $role["approve"] =="true") ? 'checked="" ' : '' ; ?>> <label for="ch_approv_<?php echo $value['id_menu']; ?>">Approval</label>
                    </td>
                  </tr>
                  <?php
                }
              } ?>
            </tbody>
          </table>
        </div>
      </form>
    </div>
  </div>
</div>

<script type="text/javascript">
  $(document).ready(function() {
    $('#myMenu').click(function() { trigerfun(this); });
    $('#myInsert').click(function () { trigerfun(this); });
    $('#myRead').click(function () { trigerfun(this); });
    $('#myUpdate').click(function () { trigerfun(this); });
    $('#myDelete').click(function () { trigerfun(this); });
    $('#myApprov').click(function () { trigerfun(this); });

    function trigerfun(iss) {
      var isChecked= $(iss).prop("checked");
      $('#myTable tr:has(td)').each(function () {
        if ($($(this)[0]).children()[1].innerHTML == $('#filterfilter').val()) {
          console.log($($(this)[0]).children().find('input[id^='+$(iss).val()+']'));
          $($(this)[0]).children().find('input[id^='+$(iss).val()+']').prop('checked', isChecked);
        }
      });
    }

    $('#ckmnu').on('click', function () {
      console.log($(this).html());
    });

    $('#myTable tr:has(td)').find('input[type="checkbox"]').click(function() {
      var ck = $(this).parent(); var cb = $(ck[0]).parent();
      var cm = $(cb[0]).parent(); var tb = $(cm[0]).parent();
      var ch = $(tb[0]).children(); var cl = $(ch[0]).children();
      var isChecked = $(this).prop("checked");

      if ($(this).attr('id') == 'ch_menu') {
        var isHeaderChecked = $(cl[0]).children().find('input[type=checkbox]').prop("checked");
        if (isChecked == false && isHeaderChecked) {
          $("#"+$(cl[0]).children().find('input[type=checkbox]').attr('id')).prop('checked', isChecked);
        } else {
          $($(ch[1]).children()).children().find('input[id='+$(this).attr('id')+']').each(function() {
            if ($(this).prop("checked") == false)
              isChecked = false;
          });
          $("#"+$(cl[0]).children().find('input[type=checkbox]').attr('id')).prop('checked', isChecked);
        }
        var row_index = $(ch[1]).children()[$(cb[0]).index()].cells[2].innerHTML;
        var wascek = $($(ch[1]).children()[$(cb[0]).index()].cells[0]).find('input[id='+$(this).attr('id')+']').prop('checked');
        $($(ch[1]).children()).children().find('input[value='+row_index+']').each(function() {
          if ($(this).prop("checked") != true)
            $(this).prop('checked', wascek);

          var rw_dex = $(this).parent().parent()[0].cells[2].innerHTML;
          $($(ch[1]).children()).children().find('input[value='+rw_dex+']').each(function() {
            if ($(this).prop("checked") != true)
              $(this).prop('checked', wascek);
          });
        });
      } else {
        for (var i = 0; i < $(cl[1]).children().length; i++) {
          var ck = $($(cl[1]).children()[i]).find('input[type=checkbox]').val();
          if (ck == $(this).attr('id')) {
            var isHeaderChecked = $($(cl[0]).children()[i]).find('input[type=checkbox]').prop("checked");
            if (isChecked == false && isHeaderChecked) {
              $($(cl[1]).children()[i]).find('input[type=checkbox]').prop('checked', isChecked);
            } else {
              $($(ch[1]).children()).children().find('input[id='+$(this).attr('id')+']').each(function() {
                if ($(this).prop("checked") == false)
                  isChecked = false;
              });
              $($(cl[1]).children()[i]).find('input[type=checkbox]').prop('checked', isChecked);
            }
          }
        }
      }
    });
  });

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

  $('#myTable').hide();
  function filterbysistem(isinya) {
    if (isinya.value == '') {
      $('#myTable').hide();
    } else {
      $('#myTable').show();
      var input, filter, table, tr, td, i;
      filter = isinya.value.toUpperCase();
      table = document.getElementById("myTable");
      tr = table.getElementsByTagName("tr");
      for (i = 0; i < tr.length; i++) {
        td = tr[i].getElementsByTagName("td")[1];
        if (td) {
          if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
            tr[i].style.display = "";
          } else {
            tr[i].style.display = "none";
          }
        }
      }
    }
    var cy = [], arnn = [0,3,4,5,6,7];
    for (var i = 0; i < arnn.length; i++) {
      var pjg = 0, cyc = [];
      $('#myTable tr:has(td)').each(function () {
        if ($($(this)[0]).children()[1].innerHTML == isinya.value) {
          pjg = pjg+1;
          var jz = $($($(this)[0]).children()[arnn[i]]).find('input[type=checkbox]').prop('checked');
          if (jz == true) { cyc.push(jz); }
        }
      });
      cy.push(cyc);
    }
    $('thead').find('input[type=checkbox]').prop('checked', false);
  }

  $(document).ready(function () {
    function onlyUnique(value, index, self) {
      return self.indexOf(value) === index;
    }

    $('#sendalldata').on('click', function (e) {
      e.preventDefault();
      swal({
        title       : 'Konfirmasi',
        text        : 'Yakin data yang di input Benar ?, dan Pastikan aksi yang dipilih mempunyai pasangan Menu !',
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
          var alc = $("#inisemuaisi").serializeArray(); var aris = [];
          $.each(alc, function (i,v) {
            if (v.name.search(new RegExp(/role/i)) != -1) {
              var fs_sp = v.name.split('role[');
              var ls_sp = fs_sp[1].split('][]');
              aris.push(ls_sp[0]);
            }
          });
          var unique = aris.filter(onlyUnique);
          var cn = [];
          for (var i = 0; i < unique.length; i++) {
            var mm = $('#myTable tr:has(td)').find('input[value='+unique[i]+']').prop('checked');
            if (mm == false) {
              cn.push(mm);
            }
          }
          console.log(cn.length);
          if (cn.length != 0) {
            swal({
              title               : "Gagal",
              text                : 'Ada Aksi yang tidak Memiliki Pasangan Menu',
              buttonsStyling      : false,
              confirmButtonClass  : "btn btn-primary",
              type                : 'warning',
              showConfirmButton   : false,
              timer               : 2000
            });
          } else {
            $.ajax({
              type:"POST",
              url:"<?php echo base_url(); ?>role/update",
              beforeSend : function () {
                swal({
                  title  : 'Menunggu',
                  html   : 'Memproses Data',
                  onOpen : () => {
                    swal.showLoading();
                  }
                })
              },
              data : $('#inisemuaisi').serialize(),
              dataType : "JSON",
              success  : function (data) {
                swal({
                  title             : "Berhasil",
                  text              : "Role telah di Buat",
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
            window.location.href = "../../preference/user_administration/user_level/otorisasi";
          }
        } else if (result.dismiss === swal.DismissReason.cancel) {
          swal({
            title               : "Batal",
            text                : 'Anda membatalkan Penyimpanan Data',
            buttonsStyling      : false,
            confirmButtonClass  : "btn btn-primary",
            type                : 'error',
            showConfirmButton   : false,
            timer               : 1000
          });
        }
      });
    });
  });
</script>
