<?php
    $str1 = 'database/ketnoinhanvien.php';
    $str2 = '../database/ketnoinhanvien.php';
    $str3 = '../../database/ketnoinhanvien.php';
    $str4 = '../../../database/ketnoinhanvien.php';
    $str5 = '../../../../database/ketnoinhanvien.php';

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
  
    class nhanvien extends databaseNhanVien{
        # trả về mã nhân viên
        public function dangnhap($sodienthoai, $matkhau){
            $check = $this->connect->prepare("SELECT * FROM nhanvien WHERE so_dien_thoai=? AND mat_khau=?");
            $check->setFetchMode(PDO::FETCH_OBJ);
            $check->execute(array($sodienthoai, $matkhau));
            $info_user = $check->fetch();
            
            if($info_user != NULL){
                return $info_user->ma_nhan_vien;
            }
            else{
                return NULL;
            }
        }

        public function checksodienthoai($sodienthoai){
            $check = $this->connect->prepare("SELECT * FROM nhanvien WHERE so_dien_thoai=?");
            $check->setFetchMode(PDO::FETCH_OBJ);  
            $check->execute(array($sodienthoai));
            $count = count($check->fetchAll());
            return $count;
        }

        public function checkmatkhaucu($matkhau){
            $check = $this->connect->prepare("SELECT * FROM nhanvien WHERE mat_khau=?");
            $check->setFetchMode(PDO::FETCH_OBJ);  
            $check->execute(array($matkhau));
            $count = count($check->fetchAll());
            return $count;
        }

        public function thongtinnhanvien($manhanvien){
            $check = $this->connect->prepare("SELECT * FROM nhanvien WHERE ma_nhan_vien=?");
            $check->setFetchMode(PDO::FETCH_OBJ);  
            $check->execute(array($manhanvien));
            $count = count($check->fetchAll());
            return $count;
        }

        public function thongtinnhanvienbangmanhanvien($manhanvien){
            $check = $this->connect->prepare("SELECT * FROM nhanvien WHERE ma_nhan_vien=?");
            $check->setFetchMode(PDO::FETCH_OBJ);  
            $check->execute(array($manhanvien));
            $info = $check->fetch();
            return $info;
        }

        public function thongtinnhanvienbangsodienthoai($sodienthoai){
            $query = $this->connect->prepare("SELECT * FROM nhanvien WHERE so_dien_thoai=?");
            $query->setFetchMode(PDO::FETCH_OBJ);
            $query->execute(array($sodienthoai));
            $info = $query->fetch();
            return $info;
        }

        public function tatcanhanvien(){
            $query = $this->connect->prepare("SELECT * FROM nhanvien ORDER BY ma_nhan_vien DESC");
            $query->setFetchMode(PDO::FETCH_OBJ);
            $query->execute(array());
            $list = $query->fetchAll();
            return $list;
        }

        public function themnhanvien($tennhanvien,$gioitinh, $ngaysinh, $sodienthoai, $diachi, $matkhau, $trangthailamviec){
            $query = 'INSERT INTO nhanvien (ten_nhan_vien,gioi_tinh, ngay_sinh, so_dien_thoai, dia_chi, mat_khau, trang_thai_lam_viec) VALUES (?,?,?,?,?,?,?)';
            $create = $this->connect->prepare($query);
            $create->execute(array($tennhanvien,$gioitinh, $ngaysinh, $sodienthoai, $diachi, $matkhau, $trangthailamviec));
        }

        public function suanhanvien($tennhanvien, $sodienthoai, $diachi, $ngaysinh, $gioitinh, $trangthai, $manhanvien){
            $query = 'UPDATE nhanvien SET ten_nhan_vien = ?, so_dien_thoai=?, dia_chi=?, ngay_sinh=?,gioi_tinh=?, trang_thai_lam_viec=? WHERE ma_nhan_vien = ?';
            $create = $this->connect->prepare($query);
            $create->execute(array($tennhanvien, $sodienthoai, $diachi, $ngaysinh, $gioitinh, $trangthai, $manhanvien));
        }

        public function suamatkhau($matkhau, $manhanvien){
            $query = 'UPDATE nhanvien SET mat_khau=? WHERE ma_nhan_vien = ?';
            $create = $this->connect->prepare($query);
            $create->execute(array($matkhau, $manhanvien));
        }

        public function xoanhanvien($manhanvien){
            $query = 'DELETE FROM nhanvien WHERE ma_nhan_vien = ?';
            $create = $this->connect->prepare($query);
            $create->execute(array($manhanvien));
        }
    }
?>