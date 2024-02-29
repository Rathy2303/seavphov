<?php
    $status = $_POST['status'];
    $myfile = fopen("../../site_config.txt",'w');
    fwrite($myfile,"site_contruction = ".$status);
    fclose($myfile);
?>