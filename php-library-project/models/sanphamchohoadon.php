<?php
    $str1 = 'database/ketnoisanphamchohoadon.php';
    $str2 = '../database/ketnoisanphamchohoadon.php';
    $str3 = '../../database/ketnoisanphamchohoadon.php';
    $str4 = '../../../database/ketnoisanphamchohoadon.php';
    $str5 = '../../../../database/ketnoisanphamchohoadon.php';

    if(file_exists($str1)){
        $file = $str1;
    }else if(file_exists($str2)){
        $file = $str2;
    }else if(file_exists($str3)){
        $file = $str3;
    }else if(file_exists($str4)){
        $file = $str4;
    }else{
        $file = $str5;
    }

    # gọi file vào
    require $file;
  
    class sanphamchohoadon extends databaseSanPhamChoHoaDon{
        public function sanphamchohoadhon($mahoadon){
            $query = $this->connect->prepare("SELECT * FROM chitiethoadon WHERE ma_hoa_don = ?");
            $query->setFetchMode(PDO::FETCH_OBJ);
            $query->execute(array($mahoadon));
            $list = $query->fetchAll();
            return $list;
        }

        public function checkchonsanpham($masanpham, $mahoadon){
            $query = $this->connect->prepare("SELECT * FROM chitiethoadon WHERE ma_sach = ? AND ma_hoa_don = ?");
            $query->setFetchMode(PDO::FETCH_OBJ);
            $query->execute(array($masanpham, $mahoadon));
            $list = $query->fetchAll();
            return $list;
        }

        public function tonggiachohoadon($mahoadon){
            $query = $this->connect->prepare("SELECT SUM(tong_tien) AS tonggia FROM chitiethoadon WHERE ma_hoa_don = ?");
            $query->setFetchMode(PDO::FETCH_OBJ);
            $query->execute(array($mahoadon));
            $total = $query->fetch();
            return $total;
        }

        public function themsanphamchohoadon($masanpham, $soluong, $tonggia, $mahoadon){
            $query = 'INSERT INTO chitiethoadon (ma_sach, so_luong, tong_tien, ma_hoa_don) VALUES (?,?,?,?)';
            $create = $this->connect->prepare($query);
            $create->execute(array($masanpham, $soluong, $tonggia, $mahoadon));
        }

        public function xoasanphamcuahoadon($mahoadon){
            $query = 'DELETE FROM chitiethoadon WHERE ma_hoa_don = ?';
            $create = $this->connect->prepare($query);
            $create->execute(array($mahoadon));
        }

        public function xoamotsanphamtronghoadon($masanphamchohoadon, $mahoadon){
            $query = 'DELETE FROM chitiethoadon WHERE ma_chi_tiet_hoa_don = ? AND ma_hoa_don = ?';
            $create = $this->connect->prepare($query);
            $create->execute(array($masanphamchohoadon, $mahoadon));
        }
    }
?>