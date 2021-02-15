<?php
    session_start();

    require "../../../models/nhanvien.php";
    $nhanvien = new nhanvien();

    $type = $nhanvien->thongtinnhanvienbangmanhanvien($_SESSION['nhanvien'])->type;

    if($type == 'admin' && isset($_POST['matkhaumoi']) && isset($_POST["manhanvien"])){
        $manhanvien = $_POST["manhanvien"];
        $matkhaumoi = $_POST["matkhaumoi"];
        $nhanvien->suamatkhau(md5($matkhaumoi), $manhanvien);
        
        $data = array(
            'result'          =>      "Success",
        );
        echo json_encode($data);
        
    }else if(isset($_POST["manhanvien"]) && isset($_POST["matkhaucu"]) && isset($_POST['matkhaumoi']) && isset($_POST['matkhaumoinhaplai'])){
        $manhanvien = $_POST["manhanvien"];
        $matkhaucu = $_POST["matkhaucu"];
        $matkhaumoi = $_POST["matkhaumoi"];
        $matkhaumoinhaplai = $_POST["matkhaumoinhaplai"];
        # check mật khẩu cũ
        $count = $nhanvien->checkmatkhaucu(md5($matkhaucu));

        if($count > 0){
            $nhanvien->suamatkhau(md5($matkhaumoi), $manhanvien);
            $data = array(
                'result'          =>      "Success",
            );
        }else{
            # sai mật khẩu cũ
            $data = array(
                'result'          =>      "Fail",
            );
        }

        echo json_encode($data);

    }else{
        echo "OK";
    }
?>