<?php
    require "../../../models/nhanvien.php";

    if (isset($_POST['matkhau']) && isset($_POST['tennhanvien']) && isset($_POST['sodienthoai']) 
        && isset($_POST['diachi']) && isset($_POST['ngaysinh']) && isset($_POST['gioitinh']) 
        && isset($_POST['trangthailamviec'])) {
       
        $tennhanvien = $_POST['tennhanvien'];
        $gioitinh = $_POST['gioitinh'];
        $ngaysinh = $_POST['ngaysinh'];
        $sodienthoai = $_POST['sodienthoai'];
        $diachi = $_POST['diachi'];
        $matkhau = md5($_POST['matkhau']);
        $trangthailamviec = $_POST['trangthailamviec'];

        $them = new nhanvien();

        // kiểm tra mã nhân viên có trùng không
        $count = $them->checksodienthoai($sodienthoai);
        if($count >= 1){
            // đã tồn tại - trả về không được thêms
            $data = array(
                'result'          =>      "0",
            );
        }else{
            // chưa tồn tại - trả về được thêm
            $data = array(
                'result'          =>      "1",
            );

            // thêm
            $them->themnhanvien($tennhanvien,$gioitinh, $ngaysinh, $sodienthoai, $diachi, $matkhau, $trangthailamviec);
        }
        
        echo json_encode($data);
    }
   
?>