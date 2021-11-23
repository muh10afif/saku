<div class="row">
  <div class="col-md-12">
    <form method="post" action="<?= base_url('entry_claim/server_ttd') ?>" id="registerform" novalidate="novalidate">
      <div class="form-group">
        <p class="text-left"><strong>Draw Signature</strong></p>

        <!-- js signature widget -->
        <div class='js-signature'></div>

        <!-- action button to clear the signature -->
        <p><button type="button" id="clearBtn" class="btn btn-default">Clear Signature</button></p>
        
        <!-- populate the base64 encoded image in the textarea -->
        <textarea id="signature64" name="signed" style="display: none" cols="50" rows="10"></textarea>
      </div>
      <div class="form-group">
        <button type="button" class="btn btn-lg btn-primary" id="simpan_form">Register</button>
      </div>
    </form>
  </div>
</div>

<script>

    $(document).ready(function () {

        // initiate jq-signature
        $('.js-signature').jqSignature({
            autoFit: true, // allow responsive
            height: 182, // set height
            border: '1px solid #a0a0a0', // set widget border
        });
        
        // create hook for clear button
        $('#clearBtn').on('click', function () {
            $('.js-signature').jqSignature('clearCanvas');
            $("#signature64").val(''); // clear the textarea as well
        })
            

        // update the generated encoded image in the textarea
        $('.js-signature').on('jq.signature.changed', function() {
            var data = $('.js-signature').jqSignature('getDataURL');
            $("#signature64").val(data);
        });

        $('#simpan_form').on('click', function () {

            var signed = $('#signature64').val();

            $.ajax({
                url         : "<?= base_url() ?>entry_claim/server_ttd",
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
                data    : {signed:signed},
                dataType: "JSON",
                success : function (data) {

                    swal.close();
                    
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

    });
 </script>