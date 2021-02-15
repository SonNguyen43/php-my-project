<?php
    $str1 = 'database/ketnoihoadon.php';
    $str2 = '../database/ketnoihoadon.php';
    $str3 = '../../database/ketnoihoadon.php';
    $str4 = '../../../database/ketnoihoadon.php';
    $str5 = '../../../../database/ketnoihoadon.php';

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
  
    class hoadon extends databaseHoaDon{
        public function tatcahoadon(){
            $query = $this->connect->prepare("SELECT * FROM hoadon ORDER BY ma_hoa_don DESC");
            $query->setFetchMode(PDO::FETCH_OBJ);
            $query->execute(array());
            $list = $query->fetchAll();
            return $list;
        }

        public function thongketheongay($ngaybatdau, $ngayketthuc){
            $query = $this->connect->prepare("SELECT * FROM hoadon WHERE ngay_lap >= ? AND ngay_lap <= ? ORDER BY ma_hoa_don DESC");
            $query->setFetchMode(PDO::FETCH_OBJ);
            $query->execute(array($ngaybatdau, $ngayketthuc));
            $list = $query->fetchAll();
            return $list;
        }

        public function hoadonhientai(){
            $query = $this->connect->prepare("SELECT MAX(ma_hoa_don) AS MAX FROM hoadon");
            $query->setFetchMode(PDO::FETCH_OBJ);
            $query->execute(array());
            $mahoadon = $query->fetch();
            return $mahoadon;
        }

        public function thongtinhoadon($mahoadon){
            $check = $this->connect->prepare("SELECT * FROM hoadon WHERE ma_hoa_don = ?");
            $check->setFetchMode(PDO::FETCH_OBJ);
            $check->execute(array($mahoadon));
            $list = $check->fetch();
            return $list;
        }

        public function themhoadon($ngay_lap,$ma_nhan_vien,$ma_khach_hang){
            $query = 'INSERT INTO hoadon (ngay_lap,ma_nhan_vien,ma_khach_hang) VALUES (?,?,?)';
            $create = $this->connect->prepare($query);
            $create->execute(array($ngay_lap,$ma_nhan_vien,$ma_khach_hang));
        }

        public function updatetonggia($tongtien, $mahoadon){
            $query = 'UPDATE hoadon SET tong_tien = ? WHERE ma_hoa_don = ?';
            $create = $this->connect->prepare($query);
            $create->execute(array($tongtien, $mahoadon));
        }

        public function xoahoadon($mahoadon){
            $query = 'DELETE FROM hoadon WHERE ma_hoa_don = ?';
            $create = $this->connect->prepare($query);
            $create->execute(array($mahoadon));
        }
    }
?>