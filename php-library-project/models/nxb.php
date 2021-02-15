<?php
    $str1 = 'database/ketnoinxb.php';
    $str2 = '../database/ketnoinxb.php';
    $str3 = '../../database/ketnoinxb.php';
    $str4 = '../../../database/ketnoinxb.php';
    $str5 = '../../../../database/ketnoinxb.php';

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
  
    class nxb extends databaseNXB{
        public function tatcanxb(){
            $check = $this->connect->prepare("SELECT * FROM nhaxuatban ORDER BY manxb DESC");
            $check->setFetchMode(PDO::FETCH_OBJ);
            $check->execute(array());
            $list = $check->fetchAll();
            return $list;
        }

        public function thongtinnhaxuatban($manxb){
            $check = $this->connect->prepare("SELECT * FROM nhaxuatban WHERE manxb = ?");
            $check->setFetchMode(PDO::FETCH_OBJ);
            $check->execute(array($manxb));
            $list = $check->fetch();
            return $list;
        }

        public function themnxb($tennxb){
            $query = 'INSERT INTO nhaxuatban (tennxb) VALUES (?)';
            $create = $this->connect->prepare($query);
            $create->execute(array($tennxb));
        }

        public function suanxb($tennxb,$manxb){
            $query = 'UPDATE nhaxuatban SET tennxb = ? WHERE manxb = ?';
            $create = $this->connect->prepare($query);
            $create->execute(array($tennxb, $manxb));
        }

        public function xoanxb($manxb){
            $query = 'DELETE FROM nhaxuatban WHERE manxb = ?';
            $create = $this->connect->prepare($query);
            $create->execute(array($manxb));
        }
    }
?>