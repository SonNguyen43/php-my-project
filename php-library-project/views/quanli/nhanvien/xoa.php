<?php
    require "../../../models/nhanvien.php";

    if (isset($_POST['manhanvien'])) {
        $manhanvien = $_POST['manhanvien'];

        $xoa = new nhanvien();
        $xoa->xoanhanvien($manhanvien);
    }
   
?>