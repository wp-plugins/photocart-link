<?php
error_reporting(0);
header("Cache-control: private"); 
$new =  base64_decode($_REQUEST['id']);
header("Content-type: image/jpeg");
header("Content-transfer-encoding: binary\n"); 
header("Content-Disposition: filename=do_not_copy_these_images");
header('Cache-control: no-cache');
@readfile($new);
?>