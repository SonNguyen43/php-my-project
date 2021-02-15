<?php
    $str1 = 'database/ketnoikhachhang.php';
    $str2 = '../database/ketnoikhachhang.php';
    $str3 = '../../database/ketnoikhachhang.php';
    $str4 = '../../../database/ketnoikhachhang.php';
    $str5 = '../../../../database/ketnoikhachhang.php';

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
  
    class khachhang extends databaseKhachHang{

        public function tatcakhachhang(){
            $check = $this->connect->prepare("SELECT * FROM khachhang ORDER BY ma_khach_hang DESC");
            $check->setFetchMode(PDO::FETCH_OBJ);
            $check->execute(array());
            $list = $check->fetchAll();
            return $list;
        }

        public function thongtinkhachhang($makhachhang){
            $check = $this->connect->prepare("SELECT * FROM khachhang WHERE ma_khach_hang = ?");
            $check->setFetchMode(PDO::FETCH_OBJ);
            $check->execute(array($makhachhang));
            $list = $check->fetchAll();
            return $list;
        }

        public function thongtinkhachhangbangmakhachhang($makhachhang){
            $check = $this->connect->prepare("SELECT * FROM khachhang WHERE ma_khach_hang = ?");
            $check->setFetchMode(PDO::FETCH_OBJ);
            $check->execute(array($makhachhang));
            $list = $check->fetch();
            return $list;
        }

        // public function thongtintenkhachhang($makhachhang){
        //     $check = $this->connect->prepare("SELECT tenkhachhang AS TenKhachHang FROM khachhang WHERE makhachhang = ?");
        //     $check->setFetchMode(PDO::FETCH_OBJ);
        //     $check->execute(array($makhachhang));
        //     $list = $check->fetch();
        //     return $list;
        // }

        public function themkhachhang($tenkhachhang, $diachi, $sodienthoai, $ngaysinh, $gioitinh, $email){
            $query = 'INSERT INTO khachhang (ten_khach_hang,dia_chi,so_dien_thoai,ngay_sinh,gioi_tinh, email) VALUES (?,?,?,?,?,?)';
            $create = $this->connect->prepare($query);
            $create->execute(array($tenkhachhang, $diachi, $sodienthoai, $ngaysinh, $gioitinh, $email));
        }

        public function suakhachhang($tenkhachhang, $sodienthoai, $diachi, $ngaysinh, $email, $gioitinh, $makhachhang){
            $query = 'UPDATE khachhang SET ten_khach_hang = ?, so_dien_thoai=?, dia_chi=?, ngay_sinh=?, email=?, gioi_tinh=? WHERE ma_khach_hang = ?';
            $create = $this->connect->prepare($query);
            $create->execute(array($tenkhachhang, $sodienthoai, $diachi, $ngaysinh, $email, $gioitinh, $makhachhang));
        }

        public function xoakhachhang($makhachhang){
            $query = 'DELETE FROM khachhang WHERE ma_khach_hang = ?';
            $create = $this->connect->prepare($query);
            $create->execute(array($makhachhang));
        }
    }
?>