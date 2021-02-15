<?php
    require "../../../models/tacgia.php";

    if (isset($_POST['tentacgia'])) {
        $tentacgia = $_POST['tentacgia'];
        $tacgia = new tacgia();

        $tacgia->themtacgia($tentacgia);
    }
   
?>