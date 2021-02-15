<?php
    $str1 = 'database/ketnoidanhmuc.php';
    $str2 = '../database/ketnoidanhmuc.php';
    $str3 = '../../database/ketnoidanhmuc.php';
    $str4 = '../../../database/ketnoidanhmuc.php';
    $str5 = '../../../../database/ketnoidanhmuc.php';

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
  
    class danhmuc extends databaseDanhMuc{
        public function tatcadanhmuc(){
            $check = $this->connect->prepare("SELECT * FROM loaisach ORDER BY ma_loai_sach DESC");
            $check->setFetchMode(PDO::FETCH_OBJ);
            $check->execute(array());
            $list = $check->fetchAll();
            return $list;
        }

        // public function thongtindanhmuc($madanhmuc){
        //     $check = $this->connect->prepare("SELECT * FROM danhmuc WHERE madanhmuc = ?");
        //     $check->setFetchMode(PDO::FETCH_OBJ);
        //     $check->execute(array($madanhmuc));
        //     $list = $check->fetch();
        //     return $list;
        // }

        public function themdanhmuc($tenloaisach){
            $query = 'INSERT INTO loaisach (ten_loai_sach) VALUES (?)';
            $create = $this->connect->prepare($query);
            $create->execute(array($tenloaisach));
        }

        public function suadanhmuc($tenloaisach,$maloaisach){
            $query = 'UPDATE loaisach SET ten_loai_sach = ? WHERE ma_loai_sach = ?';
            $create = $this->connect->prepare($query);
            $create->execute(array($tenloaisach, $maloaisach));
        }

        public function xoadanhmuc($maloaisach){
            $query = 'DELETE FROM loaisach WHERE ma_loai_sach = ?';
            $create = $this->connect->prepare($query);
            $create->execute(array($maloaisach));
        }
    }
?>