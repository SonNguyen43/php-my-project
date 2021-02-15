<?php
    $str1 = 'database/ketnoisach.php';
    $str2 = '../database/ketnoisach.php';
    $str3 = '../../database/ketnoisach.php';
    $str4 = '../../../database/ketnoisach.php';
    $str5 = '../../../../database/ketnoisach.php';

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
  
    class Sach extends databaseSach{

        public function tatcasach(){
            $check = $this->connect->prepare("SELECT * FROM sach ORDER BY ma_sach DESC");
            $check->setFetchMode(PDO::FETCH_OBJ);
            $check->execute(array());
            $list = $check->fetchAll();
            return $list;
        }

        public function thongtinsach($ma_sach){
            $check = $this->connect->prepare("SELECT * FROM sach WHERE ma_sach =?");
            $check->setFetchMode(PDO::FETCH_OBJ);
            $check->execute(array($ma_sach));
            $list = $check->fetch();
            return $list;
        }
        
        public function themsach($tensach,$soluong, $dongia, $mota, $namxuatban, $tacgia, $nxb){
            $query = 'INSERT INTO sach (ten_sach,so_luong,don_gia,mo_ta,nam_xuat_ban, ma_tac_gia,ma_nha_xuat_ban) VALUES (?,?,?,?,?,?,?)';
            $create = $this->connect->prepare($query);
            $create->execute(array($tensach,$soluong, $dongia, $mota, $namxuatban, $tacgia, $nxb));
        }

        public function suasach($tensach, $soluong, $nxb, $dongia, $mota, $namsuatban, $tacgia, $masach){
            $query = 'UPDATE sach SET ten_sach = ?, so_luong=?, ma_nha_xuat_ban=?, don_gia=?, mo_ta=?, nam_xuat_ban=?, ma_tac_gia = ? WHERE ma_sach = ?';
            $create = $this->connect->prepare($query);
            $create->execute(array($tensach, $soluong, $nxb, $dongia, $mota, $namsuatban, $tacgia, $masach));
        }

        public function capnhatsoluongsach($soluong, $masach){
            $query = 'UPDATE sach SET so_luong = ? WHERE ma_sach = ?';
            $create = $this->connect->prepare($query);
            $create->execute(array($soluong, $masach));
        }

        public function xoasach($masach){
            $query = 'DELETE FROM sach WHERE ma_sach = ?';
            $create = $this->connect->prepare($query);
            $create->execute(array($masach));
        }
    }
?>