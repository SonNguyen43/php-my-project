<?php
    require "../../../models/nxb.php";

    if (isset($_POST['tennhaxuatban'])) {
        echo $tennhaxuatban = $_POST['tennhaxuatban'];
        $nxb = new nxb();

        $nxb->themnxb($tennhaxuatban);
    }else{
        echo "Fail";
    }
   
?>