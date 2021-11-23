<!DOCTYPE html>
<html>
<head>
    <title>PHP Signature Pad Example - Medikre.com</title>
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/css/bootstrap.css">
  
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script> 
    <link type="text/css" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/south-street/jquery-ui.css" rel="stylesheet"> 
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
  
    <script type="text/javascript" src="<?= base_url() ?>assets/signature/js/jquery.signature.min.js"></script>
    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/signature/css/jquery.signature.css">
  
    <style>
        .kbw-signature { width: 400px; height: 200px;}
        #sig canvas{
            width: 100% !important;
            height: auto;
        }
    </style>
  
</head>
<body>
  
<div class="container">
  
    <form id="form_ttd">
  
        <h1>PHP Signature Pad Example - Medikre.com</h1>
  
        <div class="col-md-12">
            <label class="" for="">Signature:</label>
            <br/>
            <div id="sig" ></div>
            <br/>
            <button id="clear" class="btn btn-secondary">Clear Signature</button>
            <textarea id="signature64" name="signed" style="display: none" class="form-control"></textarea>
        </div>
  
        <br/>
        <button class="btn btn-success">Submit</button>

    </form>
  
</div>
  
<script type="text/javascript">
    var sig = $('#sig').signature({syncField: '#signature64', syncFormat: 'PNG'});
    $('#clear').click(function(e) {
        e.preventDefault();
        sig.signature('clear');
        $("#signature64").val('');
    });

    $('#form_ttd').on('submit', function () {

            var form_ttd = new FormData(this);

            $.ajax({
                url     : "<?= base_url() ?>polis_saku/upload_ttd",
                type    : "POST",
                data            : form_ttd,
                contentType     : false,
                cache           : false,
                processData     : false,
                dataType        : "JSON",
                success : function (data) {
                    

                    location.reload();
    
                    
                }
            })
    
            return false;

    })

</script>
  
</body>
</html>