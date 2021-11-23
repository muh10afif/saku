<script type="text/javascript">
  $(document).ready(function () {
    $('#sendvis').on('click', function () {
      var dt = tinymce.get("nvisi").getContent();
      var id = $('#idvis').val();
      if (id == "") {
        $.ajax({
          type:"POST",
          url:"<?php echo base_url(); ?>visi_misi/insupvisi/0",
          beforeSend : function () {
            swal({
              title  : 'Menunggu',
              html   : 'Memproses Data',
              onOpen : () => {
                swal.showLoading();
              }
            })
          },
          data: {isi:dt},
          dataType:"JSON",
          success:function (data) {
            swal({
              title             : "Berhasil",
              text              : "Visi telah di Tambahkan",
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
          url:"<?php echo base_url(); ?>visi_misi/insupvisi/"+id,
          beforeSend : function () {
            swal({
              title  : 'Menunggu',
              html   : 'Memproses Data',
              onOpen : () => {
                swal.showLoading();
              }
            })
          },
          data: {isi:dt},
          dataType:"JSON",
          success:function (data) {
            swal({
              title             : "Berhasil",
              text              : "Visi telah di Update",
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
    });
    $('#sendmis').on('click', function () {
      var dt = tinymce.get("nmisi").getContent();
      var id = $('#idmis').val();
      if (id == "") {
        $.ajax({
          type:"POST",
          url:"<?php echo base_url(); ?>visi_misi/insupmisi/0",
          beforeSend : function () {
            swal({
              title  : 'Menunggu',
              html   : 'Memproses Data',
              onOpen : () => {
                swal.showLoading();
              }
            })
          },
          data: {isi:dt},
          dataType:"JSON",
          success:function (data) {
            swal({
              title             : "Berhasil",
              text              : "Misi telah di Tambahkan",
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
          url:"<?php echo base_url(); ?>visi_misi/insupmisi/"+id,
          beforeSend : function () {
            swal({
              title  : 'Menunggu',
              html   : 'Memproses Data',
              onOpen : () => {
                swal.showLoading();
              }
            })
          },
          data: {isi:dt},
          dataType:"JSON",
          success:function (data) {
            swal({
              title             : "Berhasil",
              text              : "Misi telah di Update",
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
    });
    $('#sendval').on('click', function () {
      var dt = tinymce.get("nval").getContent();
      var id = $('#idval').val();
      if (id == "") {
        $.ajax({
          type:"POST",
          url:"<?php echo base_url(); ?>visi_misi/insupvale/0",
          beforeSend : function () {
            swal({
              title  : 'Menunggu',
              html   : 'Memproses Data',
              onOpen : () => {
                swal.showLoading();
              }
            })
          },
          data: {isi:dt},
          dataType:"JSON",
          success:function (data) {
            swal({
              title             : "Berhasil",
              text              : "Value telah di Tambahkan",
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
          url:"<?php echo base_url(); ?>visi_misi/insupvale/"+id,
          beforeSend : function () {
            swal({
              title  : 'Menunggu',
              html   : 'Memproses Data',
              onOpen : () => {
                swal.showLoading();
              }
            })
          },
          data: {isi:dt},
          dataType:"JSON",
          success:function (data) {
            swal({
              title             : "Berhasil",
              text              : "Value telah di Upda",
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
    });

    if($("#nvisi").length > 0){
      tinymce.init({
        selector: "textarea#nvisi",
        theme: "modern",
        height:300,
        content_style: "body {font-size: 18pt;}",
        fontsize_formats:"8pt 9pt 10pt 11pt 12pt 14pt 18pt 24pt 30pt 36pt 48pt 60pt 72pt 96pt",
        plugins: [
          "advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker",
          "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
          "save table contextmenu directionality emoticons template paste textcolor"
        ],
        toolbar: "insertfile undo redo | styleselect | fontsizeselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | l      ink image | print preview media fullpage | forecolor backcolor emoticons",
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
    }
    if($("#nmisi").length > 0){
      tinymce.init({
        selector: "textarea#nmisi",
        theme: "modern",
        height:300,
        content_style: "body {font-size: 18pt;}",
        fontsize_formats:"8pt 9pt 10pt 11pt 12pt 14pt 18pt 24pt 30pt 36pt 48pt 60pt 72pt 96pt",
        plugins: [
          "advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker",
          "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
          "save table contextmenu directionality emoticons template paste textcolor"
        ],
        toolbar: "insertfile undo redo | styleselect | fontsizeselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | l      ink image | print preview media fullpage | forecolor backcolor emoticons",
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
    }
    if($("#nval").length > 0){
      tinymce.init({
        selector: "textarea#nval",
        theme: "modern",
        height:300,
        content_style: "body {font-size: 18pt;}",
        fontsize_formats:"8pt 9pt 10pt 11pt 12pt 14pt 18pt 24pt 30pt 36pt 48pt 60pt 72pt 96pt",
        plugins: [
          "advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker",
          "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
          "save table contextmenu directionality emoticons template paste textcolor"
        ],
        toolbar: "insertfile undo redo | styleselect | fontsizeselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | l      ink image | print preview media fullpage | forecolor backcolor emoticons",
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
    }
  });
</script>
