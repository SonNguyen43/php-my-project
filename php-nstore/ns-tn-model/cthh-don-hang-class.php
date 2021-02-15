<?php
    $str1 = 'ns-tn-database/ket-noi-cthhdh.php';
    $str2 = '../ns-tn-database/ket-noi-cthhdh.php';
    $str3 = '../../../ns-tn-database/ket-noi-cthhdh.php';
    $str4 = '../../../../ns-tn-database/ket-noi-cthhdh.php';

    if(file_exists($str1)){
        $file = $str1;
    }else if(file_exists($str2)){
        $file = $str2;
    }else if(file_exists($str3)){
        $file = $str3;
    }else{
        $file = $str4;
    }
    require $file;
  
    class cthhdhclass extends databaseCTHHDH{
        # lấy các thông tin của đơn hàng và chi tiết đơn hàng
        public function LayHangHoaCuaDonHang($madonhang){
            $hanghoa = $this->connect->prepare('SELECT cthhdh.machitiethanghoadonhang, cthhdh.mahanghoa, hh.tenhanghoa, cthhdh.soluong, cthhdh.ngaysanxuat, dh.makhachhang, dh.madonhang FROM chitiethanghoadonhang cthhdh, hanghoa hh, donhang dh WHERE dh.madonhang = cthhdh.madonhang AND hh.mahanghoa = cthhdh.mahanghoa AND cthhdh.madonhang = ?');
            $hanghoa->setFetchMode(PDO::FETCH_OBJ);
            $hanghoa-> execute(array($madonhang));
            $listhanghoa = $hanghoa->fetchAll();
            return $listhanghoa;
        }

        # thêm chi tiết đơn hàng cho đơn hàng
        public function ThemHangHoaVaSoLuong($soluong, $ngaysanxuat, $mahanghoa, $madonhang){
            $cauLenh = 'INSERT INTO chitiethanghoadonhang (soluong, ngaysanxuat, mahanghoa, madonhang) VALUES (?,?,?,?);';
            $themMoi = $this->connect->prepare($cauLenh);
            $themMoi->execute(array($soluong, $ngaysanxuat, $mahanghoa, $madonhang));
        }

        # sửa thông tin chi tiết hàng hóa 
        public function SuaThongTinHangHoa($soluong, $ngaysanxuat, $machitiethanghoadonhang, $makhachhang){
            $cauLenh = 'UPDATE chitiethanghoadonhang, donhang SET chitiethanghoadonhang.soluong = ?, chitiethanghoadonhang.ngaysanxuat = ? WHERE donhang.madonhang = chitiethanghoadonhang.madonhang AND chitiethanghoadonhang.machitiethanghoadonhang = ? AND donhang.makhachhang = ?';
            $capNhat = $this->connect->prepare($cauLenh);
            $capNhat->execute(array($soluong, $ngaysanxuat, $machitiethanghoadonhang, $makhachhang));
        }

        # xóa 1 hàng hóa trong đơn hàng
        public function XoaMotHangHoaTrongDonHang($makhachhang , $madonhang, $machitiethanghoadonhang){
            $cauLenh = 'DELETE chitiethanghoadonhang FROM chitiethanghoadonhang, donhang WHERE donhang.madonhang = chitiethanghoadonhang.madonhang AND donhang.makhachhang = ? AND donhang.madonhang = ? AND chitiethanghoadonhang.machitiethanghoadonhang = ?';
            $xoa = $this->connect->prepare($cauLenh);
            $xoa->execute(array($makhachhang , $madonhang, $machitiethanghoadonhang));
        }

        # Thống kê đơn hàng
        public function ThongkeDonHang(){
            $hanghoa = $this->connect->prepare('SELECT ct.mahanghoa, hh.tenhanghoa, SUM(ct.soluong) as "tongsoluong" FROM chitiethanghoadonhang ct, hanghoa hh WHERE ct.mahanghoa = hh.mahanghoa GROUP BY ct.mahanghoa');
            $hanghoa->setFetchMode(PDO::FETCH_OBJ);
            $hanghoa-> execute(array());
            $listsoluong = $hanghoa->fetchAll();
            return $listsoluong;
        }
        
    }
?>




