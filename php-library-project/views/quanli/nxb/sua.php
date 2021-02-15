<?php
    require "../../../models/nxb.php";

    if (isset($_POST['manxb']) && isset($_POST['tennxb'])) {
        $manxb = $_POST['manxb'];
        $tennxb = $_POST['tennxb'];

        $nxb = new nxb();
        $nxb->suanxb($tennxb,$manxb);
    }else{
        echo "Fail";
    }
   
?>