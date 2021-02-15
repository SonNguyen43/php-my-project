<?php
    require "../../../models/tacgia.php";

    if (isset($_POST['matacgia']) && isset($_POST['tentacgia'])) {
        $matacgia = $_POST['matacgia'];
        $tentacgia = $_POST['tentacgia'];

        $tacgia = new tacgia();
        $tacgia->suatacgia($tentacgia,$matacgia);
    }else{
        echo "Fail";
    }
   
?>