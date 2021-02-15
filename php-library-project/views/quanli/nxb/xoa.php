<?php
    require "../../../models/nxb.php";

    if (isset($_POST['manxb'])) {
        $manxb = $_POST['manxb'];

        $nxb = new nxb();
        $nxb->xoanxb($manxb);
    }else{
        echo "Fail";
    }
   
?>