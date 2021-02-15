<?php
    require "../../../models/tacgia.php";

    if (isset($_POST['matacgia'])) {
        echo $matacgia = $_POST['matacgia'];

        $tacgia = new tacgia();
        $tacgia->xoatacgia($matacgia);
    }else{
        echo "Fail";
    }
   
?>