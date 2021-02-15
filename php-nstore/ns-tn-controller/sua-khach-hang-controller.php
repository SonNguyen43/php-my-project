<?php
    ob_start();
    session_start();

    require "../ns-tn-model/sua-khach-hang-class.php";   

    if(isset($_GET["yeucau"])){
        $yeucau = $_GET["yeucau"];

        switch ($yeucau) {
            
            case '':
                
            break;
            default:
                # code...
                break;
        }
    }else{
        header("Location: ../index.php?ketqua=yeucaukhongxacdinh");
    }
    ob_end_flush();
?>