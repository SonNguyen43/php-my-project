<?php
    require "../../../models/sanphamchohoadon.php";

    if (isset($_POST['mahoadon']) && isset($_POST['masanphamchohoadon'])) {
        echo $masanphamchohoadon = $_POST['masanphamchohoadon'];
        echo $mahoadon = $_POST['mahoadon'];
        
        $sanphamchohoadon = new sanphamchohoadon();

        $sanphamchohoadon->xoamotsanphamtronghoadon($masanphamchohoadon, $mahoadon);
    }
   
?>