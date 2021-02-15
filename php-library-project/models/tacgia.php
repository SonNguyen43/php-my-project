<?php
    $str1 = 'database/ketnoitacgia.php';
    $str2 = '../database/ketnoitacgia.php';
    $str3 = '../../database/ketnoitacgia.php';
    $str4 = '../../../database/ketnoitacgia.php';
    $str5 = '../../../../database/ketnoitacgia.php';

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
  
    class tacgia extends databaseTacGia{
        public function tatcatacgia(){
            $check = $this->connect->prepare("SELECT * FROM tacgia ORDER BY ma_tac_gia DESC");
            $check->setFetchMode(PDO::FETCH_OBJ);
            $check->execute(array());
            $list = $check->fetchAll();
            return $list;
        }

        public function thongtintacgia($ma_tac_gia){
            $check = $this->connect->prepare("SELECT * FROM tacgia WHERE ma_tac_gia = ?");
            $check->setFetchMode(PDO::FETCH_OBJ);
            $check->execute(array($ma_tac_gia));
            $list = $check->fetch();
            return $list;
        }

        public function themtacgia($tentacgia){
            $query = 'INSERT INTO tacgia (ten_tac_gia) VALUES (?)';
            $create = $this->connect->prepare($query);
            $create->execute(array($tentacgia));
        }

        public function suatacgia($tentacgia,$matacgia){
            $query = 'UPDATE tacgia SET ten_tac_gia = ? WHERE ma_tac_gia = ?';
            $create = $this->connect->prepare($query);
            $create->execute(array($tentacgia, $matacgia));
        }

        public function xoatacgia($ma_tac_gia){
            $query = 'DELETE FROM tacgia WHERE ma_tac_gia = ?';
            $create = $this->connect->prepare($query);
            $create->execute(array($ma_tac_gia));
        }
    }
?>