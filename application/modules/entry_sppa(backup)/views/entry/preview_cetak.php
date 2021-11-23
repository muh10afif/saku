<?php 
            
$filepath = base_url('upload/klaim/tes_MPDF.pdf');
// Header content type
header("Content-type: application/pdf");
header("Content-disposition: inline;     
filename=".basename($filepath));
ob_end_clean();
// Send the file to the browser.
readfile($filepath);

?>