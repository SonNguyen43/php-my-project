<?php
    require "../../../models/sach.php";

    if (isset($_POST['masach']) && isset($_POST['tensach']) && isset($_POST['soluong']) && isset($_POST['nxb'])  
    && isset($_POST['dongia'])  && isset($_POST['mota'])  && isset($_POST['namsuatban']) && isset($_POST['tacgia']) ) {
        $masach = $_POST['masach'];
        $tensach = $_POST['tensach'];
        $soluong = $_POST['soluong'];
        $nxb = $_POST['nxb'];
        $dongia = $_POST['dongia'];
        $mota = $_POST['mota'];
        $namsuatban = $_POST['namsuatban'];
        $tacgia = $_POST['tacgia'];

        $sua = new Sach();
        $sua->suasach($tensach, $soluong, $nxb, $dongia, $mota, $namsuatban, $tacgia, $masach);
    }
   
?>