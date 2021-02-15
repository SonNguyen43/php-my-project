<?php
    require "../../../models/sanpham.php";

    if (isset($_POST['masanpham'])) {
        $masanpham = $_POST['masanpham'];

        $xoa = new sanpham();
        $xoa->xoasanpham($masanpham);
    }
?>