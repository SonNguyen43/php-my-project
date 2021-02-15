<?php
    require "../../../models/nhanvien.php";

    if (isset($_POST['sodienthoaithem'])) {
        $sodienthoaithem = $_POST['sodienthoaithem'];

        $check = new nhanvien();
        $count = $check->checksodienthoai($sodienthoaithem);

        if($count >= 1){
            $data = array(
                'result'          =>      "0",
            );
        }else{
            $data = array(
                'result'          =>      "1",
            );
        }

        echo json_encode($data);
    }
?>