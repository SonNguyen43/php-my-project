<?php
    require "../../../models/danhmuc.php";

    if (isset($_POST['maloaisach'])) {
        $maloaisach = $_POST['maloaisach'];

        $xoa = new danhmuc();
        $xoa->xoadanhmuc($maloaisach);
    }
   
?>