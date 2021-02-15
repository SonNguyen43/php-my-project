<?php
    $str1 = 'ns-tn-database/ket-noi-sua-khach-hang.php';
    $str2 = '../ns-tn-database/ket-noi-sua-khach-hang.php';
    $str3 = '../../../ns-tn-database/ket-noi-sua-khach-hang.php';

    if(file_exists($str1)){
        $file = $str1;
    }else if(file_exists($str2)){
        $file = $str2;
    }else{
        $file = $str3;
    }
    require $file;
  
    class suakhachhangclass extends databaseSuaKhachHang{
         # lấy tất cả lich su nhà phân phối 
         public function LayLichSuSua($makhachhang){
            $khachhang = $this->connect->prepare('SELECT * FROM suakhachhang WHERE makhachhang = ? ORDER BY suakhachhang.ngaytao DESC');
            $khachhang->setFetchMode(PDO::FETCH_OBJ);
            $khachhang->execute(array($makhachhang));
            $listkhachhang = $khachhang->fetchAll();
            return $listkhachhang;
        }

        public function ThemLichSuSua($maadmin, $makhachhang, $ngaytao, $noidungsua){
            $cauLenh = 'INSERT INTO suakhachhang (maadmin, makhachhang, ngaytao, noidungsua) VALUES (?,?,?,?)';
            $themMoi = $this->connect->prepare($cauLenh);
            $themMoi->execute(array($maadmin, $makhachhang, $ngaytao, $noidungsua));
        }
    }
?>