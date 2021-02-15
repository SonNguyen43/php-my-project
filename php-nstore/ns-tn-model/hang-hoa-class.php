<?php
    $str1 = 'ns-tn-database/ket-noi-hang-hoa.php';
    $str2 = '../ns-tn-database/ket-noi-hang-hoa.php';
    $str3 = '../../../ns-tn-database/ket-noi-hang-hoa.php';

    if(file_exists($str1)){
        $file = $str1;
    }else if(file_exists($str2)){
        $file = $str2;
    }else{
        $file = $str3;
    }
    require $file;
  
    class hanghoaclass extends databaseHangHoa{

        # lấy tất cả hàng hóa
        public function LayTatCaHangHoa(){
            $hanghoa = $this->connect->prepare('SELECT * FROM hanghoa');
            $hanghoa->setFetchMode(PDO::FETCH_OBJ);
            $hanghoa->execute();
            $listhanghoa = $hanghoa->fetchAll();
            return $listhanghoa;
        }

        # lấy tất cả hàng hóa mà khách từng mua
        public function LayTatCaHangHoaKhachDaDat($makhachhang){
            $hanghoa = $this->connect->prepare('SELECT DISTINCT hanghoa.mahanghoa, hanghoa.tenhanghoa FROM donhang, chitiethanghoadonhang, hanghoa WHERE chitiethanghoadonhang.mahanghoa = hanghoa.mahanghoa AND donhang.madonhang = chitiethanghoadonhang.madonhang AND donhang.makhachhang = ?');
            $hanghoa->setFetchMode(PDO::FETCH_OBJ);
            $hanghoa->execute(array($makhachhang));
            $listhanghoa = $hanghoa->fetchAll();
            return $listhanghoa;
        }

         # lấy tên hàng hóa theo mã
         public function LayHangHoaTheoMa($mahanghoa){
            $hanghoa = $this->connect->prepare("SELECT * FROM hanghoa WHERE mahanghoa=?");
			$hanghoa->setFetchMode(PDO::FETCH_OBJ);
			$hanghoa->execute(array($mahanghoa));
			$list = $hanghoa->fetch(); 
			return $list;
        }

         # tìm xem món hàng đó đã thêm vào đơn hàng chưa
         public function TimHangHoaDaThem($mahanghoa , $madonhang){
            $check = $this->connect->prepare("SELECT * FROM chitiethanghoadonhang WHERE mahanghoa =? AND madonhang = ?");
            $check->setFetchMode(PDO::FETCH_OBJ);
            $check -> execute(array($mahanghoa, $madonhang));
            $count = count($check->fetchAll());
            return $count;
        }

         # tìm xem món hàng đó đã thêm vào đơn hàng chưa
         public function TimHangHoaDaThemHangTon($mahanghoa , $mahangton){
            $check = $this->connect->prepare("SELECT * FROM chitiethanghoahangton WHERE mahanghoa =? AND mahangton = ?");
            $check->setFetchMode(PDO::FETCH_OBJ);
            $check -> execute(array($mahanghoa, $mahangton));
            $count = count($check->fetchAll());
            return $count;
        }

        # thêm
        public function ThemMoi($tenhanghoa){
            $cauLenh = 'INSERT INTO hanghoa (tenhanghoa) VALUES (?);';
            $themMoi = $this->connect->prepare($cauLenh);
            $themMoi->execute(array($tenhanghoa));
        }

        # sửa 
        public function SuaHangHoa($tenhanghoa, $mahanghoa){
            $cauLenh = ' UPDATE hanghoa SET tenhanghoa = ? WHERE hanghoa.mahanghoa = ?';
            $themMoi = $this->connect->prepare($cauLenh);
            $themMoi->execute(array($tenhanghoa, $mahanghoa));
        }

        # xóa
        public function XoaHangHoa($mahanghoa){
            $cauLenh = 'DELETE FROM hanghoa WHERE hanghoa.mahanghoa = ?';
            $xoa = $this->connect->prepare($cauLenh);
            $xoa->execute(array($mahanghoa));
        }

        # tìm khách theo tên và số điện thoại
        public function TimHangHoa($tenhanghoa){
            $hanghoa = $this->connect->prepare("SELECT * FROM hanghoa WHERE tenhanghoa like '%$tenhanghoa%' ORDER BY hanghoa.mahanghoa DESC");
            $hanghoa->setFetchMode(PDO::FETCH_OBJ);
			$hanghoa->execute(array($tenhanghoa));
			$list = $hanghoa->fetchAll(); 
			return $list;
        }
    }
?>