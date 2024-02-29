<?php
    require_once '../../include/dbuser.php';

    $status = $_POST['status'];
    if($status == 'true')
        $stmp = $db->prepare("UPDATE site_config SET offline=1 WHERE id=1");
    else
        $stmp = $db->prepare("UPDATE site_config SET offline=0 WHERE id=1");
    $stmp->execute();
?>