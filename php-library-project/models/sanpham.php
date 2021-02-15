<?php
    $str1 = 'database/ketnoisanpham.php';
    $str2 = '../database/ketnoisanpham.php';
    $str3 = '../../database/ketnoisanpham.php';
    $str4 = '../../../database/ketnoisanpham.php';
    $str5 = '../../../../database/ketnoisanpham.php';

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
  
    class sanpham extends databaseSanPham{
        public function tatcasanpham(){
            $check = $this->connect->prepare("SELECT * FROM sanpham ORDER BY masanpham DESC");
            $check->setFetchMode(PDO::FETCH_OBJ);
            $check->execute(array());
            $list = $check->fetchAll();
            return $list;
        }

        public function thongtinsanpham($masanpham){
            $check = $this->connect->prepare("SELECT * FROM sanpham WHERE masanpham =?");
            $check->setFetchMode(PDO::FETCH_OBJ);
            $check->execute(array($masanpham));
            $list = $check->fetch();
            return $list;
        }

        public function thongtindanhmucsanpham($madanhmuc){
            $check = $this->connect->prepare("SELECT * FROM sanpham WHERE madanhmuc =?");
            $check->setFetchMode(PDO::FETCH_OBJ);
            $check->execute(array($madanhmuc));
            $count = count($check->fetchAll());
            return $count;
        }

        public function themsanpham($tensanpham, $gia, $madanhmuc){
            $query = 'INSERT INTO sanpham (tensanpham, gia, madanhmuc) VALUES (?,?,?)';
            $create = $this->connect->prepare($query);
            $create->execute(array($tensanpham, $gia, $madanhmuc));
        }

        public function suasanpham($tensanpham, $gia,$madanhmuc,$masanpham){
            $query = 'UPDATE sanpham SET tensanpham = ?, gia=?, madanhmuc=? WHERE masanpham = ?';
            $create = $this->connect->prepare($query);
            $create->execute(array($tensanpham, $gia,$madanhmuc,$masanpham));
        }

        public function xoasanpham($masanpham){
            $query = 'DELETE FROM sanpham WHERE masanpham = ?';
            $create = $this->connect->prepare($query);
            $create->execute(array($masanpham));
        }
    }
?>