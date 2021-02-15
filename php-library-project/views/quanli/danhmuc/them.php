<?php
    require "../../../models/danhmuc.php";

    if (isset($_POST['tenloaisach'])) {
        $tenloaisach = $_POST['tenloaisach'];

        $them = new danhmuc();
        $them->themdanhmuc($tenloaisach);
    }
   
?>