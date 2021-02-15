<?php
    require "../../../models/hoadon.php";
    require "../../../models/sanphamchohoadon.php";

    if(isset($_POST['mahoadon'])){
        $mahoadon = $_POST['mahoadon'];

        $sanphamchohoadon = new sanphamchohoadon();
        $hoadon = new hoadon();
    
        $total = $sanphamchohoadon->tonggiachohoadon($mahoadon)->tonggia;

        $hoadon->updatetonggia($total, $mahoadon);
    }


?>