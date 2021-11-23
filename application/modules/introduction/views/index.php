<div class="page-title-box">
  <div class="row align-items-center">
    <div class="col-sm-6"><h4 class="page-title"><?= $title ?></h4></div>
    <div class="col-sm-6">
      <?php echo bredcumx(); ?>
    </div>
  </div>
</div>

<div class="card">
  <div class="card-body shadow">
    <div class="form-group">
      <input type="hidden" name="idntro" id="idntro" value="<?php echo $intro[0]->id_introduction; ?>">
      <textarea name="nntro" id="nntro"><?php echo $intro[0]->introduction; ?></textarea>
    </div>
    <?php if ($role['create'] == true || $role == null): ?>
      <div class="form-group text-right">
        <button class="btn btn-primary waves-effect waves-light" id="sendntro">Submit</button>
        <button class="btn btn-secondary waves-effect m-l-5" id="clearntro">Cancel</button>
      </div>
    <?php endif; ?>
  </div>
</div>

<script type="text/javascript">
  $(document).ready(function () {
    $('#sendntro').on('click', function () {
      var dt = tinymce.get("nntro").getContent();
      var id = $('#idntro').val();
      if (dt != '') {
        if (id == "") {
          $.ajax({
            type:"POST",
            url:"<?php echo base_url(); ?>introduction/insupintro/0",
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
                text              : "Introduction telah di Tambahkan",
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
            url:"<?php echo base_url(); ?>introduction/insupintro/"+id,
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
                text              : "Introduction telah di Update",
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
      } else {
        swal({
          title             : "Gagal",
          text              : "Text Introduction Kosong",
          type              : 'error',
          showConfirmButton : false,
          timer             : 1500
        });
      }
    });

    if($("#nntro").length > 0){
      tinymce.init({
        selector: "textarea#nntro",
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
