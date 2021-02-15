<?php
    require "../../../models/sanphamchohoadon.php";
    require "../../../models/sach.php";

    if (isset($_POST['masanpham']) && isset($_POST['soluong']) && isset($_POST['mahoadon'])) {
        $masanpham = $_POST['masanpham'];
        $soluong = $_POST['soluong'];
        $mahoadon = $_POST['mahoadon'];

        $sanphamchohoadon = new sanphamchohoadon();
        $count = count($sanphamchohoadon->checkchonsanpham($masanpham, $mahoadon));

        $sach = new sach();
        $tonggia = $sach->thongtinsach($masanpham)->don_gia * $soluong;

        if($count >= 1){
            // đã tồn tại - trả về không được thêm
            $data = array(
                'result'          =>      "0",
            );
        }else{
            // chưa tồn tại - trả về được thêm
            $data = array(
                'result'          =>      "1",
            );

            // thêm
            $sanphamchohoadon->themsanphamchohoadon($masanpham, $soluong, $tonggia, $mahoadon);

            // update số lượng cho sản phẩm khi thêm vào hóa đơn
            $soluonghientai = $sach->thongtinsach($masanpham)->so_luong;
            $soluongcon = $sach->capnhatsoluongsach($soluonghientai - $soluong, $masanpham);
        }
        
        echo json_encode($data);
        
    }
   
?>