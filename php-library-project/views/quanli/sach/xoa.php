<?php
    require "../../../models/sach.php";

    if (isset($_POST['masach']) ) {
        $masach = $_POST['masach'];

        $sua = new Sach();
        $sua->xoasach($masach);
    }
   
?>