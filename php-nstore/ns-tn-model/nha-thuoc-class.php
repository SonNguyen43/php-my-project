<?php
    $str1 = 'ns-tn-database/ket-noi-nha-thuoc.php';
    $str2 = '../ns-tn-database/ket-noi-nha-thuoc.php';
    $str3 = '../../../ns-tn-database/ket-noi-nha-thuoc.php';

    if(file_exists($str1)){
        $file = $str1;
    }else if(file_exists($str2)){
        $file = $str2;
    }else{
        $file = $str3;
    }
    require $file;
  
    class nhathuocclass extends databaseNhaThuoc{
        public function TatCaNhaThuoc(){
            $nhathuoc = $this->connect->prepare("SELECT * FROM nhathuoc ORDER BY nhathuoc.manhathuoc DESC");
            $nhathuoc->setFetchMode(PDO::FETCH_OBJ);
            $nhathuoc-> execute();
            $all = $nhathuoc->fetchAll();
            return $all;
        }

        public function Them($tennhathuoc,$sodienthoai,$diachi,$ngaybatdau,$khuvuc){
            $cauLenh = 'INSERT INTO nhathuoc (tennhathuoc,sodienthoai,diachi,ngaybatdau,khuvuc) VALUES (?,?,?,?,?);';
            $themMoi = $this->connect->prepare($cauLenh);
            $themMoi->execute(array($tennhathuoc,$sodienthoai,$diachi,$ngaybatdau,$khuvuc));
        }

        public function SuaNgungBan($trangthai,$ngayngungban,$manhathuoc){
            $cauLenh = 'UPDATE nhathuoc SET ngungban = ?, ngayngungban=? WHERE nhathuoc.manhathuoc = ?';
            $themMoi = $this->connect->prepare($cauLenh);
            $themMoi->execute(array($trangthai,$ngayngungban,$manhathuoc));
        }

        public function TimNhaThuoc($tennhathuoc, $sodienthoai){
            $cauLenh = $this->connect->prepare("SELECT * FROM nhathuoc WHERE tennhathuoc like '%$tennhathuoc%' AND sodienthoai like '%$sodienthoai%' ORDER BY nhathuoc.manhathuoc DESC");
            $cauLenh->setFetchMode(PDO::FETCH_OBJ);
			$cauLenh->execute(array($tennhathuoc, $sodienthoai));
			$list = $cauLenh->fetchAll(); 
			return $list;
        }

        public function LocKhuVuc(){
            $cauLenh = $this->connect->prepare("SELECT * FROM nhathuoc ORDER BY khuvuc ASC");
            $cauLenh->setFetchMode(PDO::FETCH_OBJ);
			$cauLenh->execute(array());
			$list = $cauLenh->fetchAll(); 
			return $list;
        }

        public function TonTaiNhaThuoc($manhathuoc){
            $check = $this->connect->prepare("SELECT * FROM nhathuoc WHERE manhathuoc = ?");
            $check->setFetchMode(PDO::FETCH_OBJ);
            $check -> execute(array($manhathuoc));
            $count = count($check->fetchAll());
            return $count;
        }

        public function LayThongTinNhaThuocBangMa($manhathuoc){
            $nhathuoc = $this->connect->prepare("SELECT * FROM nhathuoc WHERE manhathuoc=?");
			$nhathuoc->setFetchMode(PDO::FETCH_OBJ);
			$nhathuoc->execute(array($manhathuoc));
			$list = $nhathuoc->fetch(); 
			return $list;
        }

        public function SuaNhaThuoc($tennhathuoc,$diachi, $sodienthoai,$manhathuoc){
            $cauLenh = 'UPDATE nhathuoc SET tennhathuoc = ?, diachi = ?, sodienthoai = ? WHERE manhathuoc = ?';
            $sua = $this->connect->prepare($cauLenh);
            $sua->execute(array($tennhathuoc,$diachi, $sodienthoai,$manhathuoc));
        }

        public function NhaThuocConBan(){
            $check = $this->connect->prepare("SELECT * FROM nhathuoc WHERE ngungban = 'conban'");
            $check->setFetchMode(PDO::FETCH_OBJ);
            $check -> execute(array());
            $count = count($check->fetchAll());
            return $count;
        }

        public function NhaThuocNghiBan(){
            $check = $this->connect->prepare("SELECT * FROM nhathuoc WHERE ngungban = 'ngungban'");
            $check->setFetchMode(PDO::FETCH_OBJ);
            $check -> execute(array());
            $count = count($check->fetchAll());
            return $count;
        }

        public function Xoa($manhathuoc){
            $cauLenh = 'DELETE FROM nhathuoc WHERE manhathuoc = ?';
            $xoa = $this->connect->prepare($cauLenh);
            $xoa->execute(array($manhathuoc));
        }
    }
?>