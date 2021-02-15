<?php
    require "../../../models/danhmuc.php";

    if (isset($_POST['maloaisach']) && isset($_POST['tenloaisach'])) {
        $maloaisach = $_POST['maloaisach'];
        $tenloaisach = $_POST['tenloaisach'];

        $sua = new danhmuc();
        $sua->suadanhmuc($tenloaisach,$maloaisach);
    }
   
?>