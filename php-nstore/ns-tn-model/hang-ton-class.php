<?php
    $str1 = 'ns-tn-database/ket-noi-hang-ton.php';
    $str2 = '../ns-tn-database/ket-noi-hang-ton.php';
    $str3 = '../../../ns-tn-database/ket-noi-hang-ton.php';

    if(file_exists($str1)){
        $file = $str1;
    }else if(file_exists($str2)){
        $file = $str2;
    }else{
        $file = $str3;
    }
    require $file;
  
    class hangtonclass extends databaseHangTon{

        # Tìm đơn hàng có phải của người nào đó không
        public function TimDonHangCuaKhachHang($makhachhang, $mahangton){
            $check = $this->connect->prepare("SELECT * FROM hangton WHERE makhachhang = ? AND mahangton = ?");
            $check->setFetchMode(PDO::FETCH_OBJ);
            $check -> execute(array($makhachhang, $mahangton));
            $count = count($check->fetchAll());
            return $count;
        }

        public function LayTatCaHangTon(){
            $donhang = $this->connect->prepare('SELECT *, hangton.ngaytao AS ngaytaohangton FROM hangton, khachhang WHERE hangton.makhachhang = khachhang.makhachhang ORDER BY hangton.ngaytao DESC');
            $donhang->setFetchMode(PDO::FETCH_OBJ);
            $donhang->execute();
            $listdonhang = $donhang->fetchAll();
            return $listdonhang;
        }

        # lấy tên hàng hóa theo mã
        public function LayHangTonTheoMa($mahanghoa){
            $hanghoa = $this->connect->prepare("SELECT * FROM hanghoa WHERE mahanghoa=?");
			$hanghoa->setFetchMode(PDO::FETCH_OBJ);
			$hanghoa->execute(array($mahanghoa));
			$list = $hanghoa->fetch(); 
			return $list;
        }

        # thêm một đơn hàng mới
        public function ThemDonHangTon($ngaytao, $makhachhang, $maadmin){
            $cauLenh = 'INSERT INTO hangton (ngaytao, makhachhang, maadmin) VALUES (?,?,?)';
            $themMoi = $this->connect->prepare($cauLenh);
            $themMoi->execute(array($ngaytao, $makhachhang, $maadmin));
        }

        # lấy mã đơn hàng đang thêm cho khách hàng
        public function LayDonHang($makhachhang){
            $donhangcho = $this->connect->prepare("SELECT MAX(ht.mahangton) AS MAX FROM hangton ht, khachhang kh WHERE ht.makhachhang = kh.makhachhang AND ht.makhachhang = ?");
            $donhangcho->setFetchMode(PDO::FETCH_OBJ);
            $donhangcho->execute(array($makhachhang));
            $list = $donhangcho->fetch(); 
            return $list;
        }

        # xóa các hàng hóa trong đơn hàng
        public function XoaHangHoaTrongDonHang($makhachhang , $mahangton){
            # xóa các món hàng trong chi tiet hàng hóa
            $cauLenh = 'DELETE chitiethanghoahangton , hangton FROM chitiethanghoahangton, hangton WHERE hangton.mahangton = chitiethanghoahangton.mahangton AND hangton.makhachhang = ? AND hangton.mahangton = ?';
            $xoa = $this->connect->prepare($cauLenh);
            $xoa->execute(array($makhachhang, $mahangton));

            # sao đó xóa đơn hàng
            $cauLenh = 'DELETE FROM hangton WHERE hangton.mahangton = ?';
            $xoa = $this->connect->prepare($cauLenh);
            $xoa->execute(array($mahangton));
        }

        # tìm đơn hàng
        public function TimHangTonKhongNgay($tenkhach, $sodienthoai){
            $hangton = $this->connect->prepare("SELECT khachhang.makhachhang, khachhang.hovaten, hangton.mahangton, hangton.ngaytao, hangton.maadmin FROM hangton, khachhang WHERE hangton.makhachhang = khachhang.makhachhang AND khachhang.hovaten LIKE '%$tenkhach%' AND khachhang.sodienthoai LIKE '%$sodienthoai%'  ORDER BY hangton.ngaytao DESC");
            $hangton->setFetchMode(PDO::FETCH_OBJ);
			$hangton->execute(array($tenkhach, $sodienthoai));
			$list = $hangton->fetchAll(); 
			return $list;
        }

        # tìm đơn hàng có ngày
        public function TimHangTonCoNgay($tenkhach, $sodienthoai, $ngaybatdau, $ngayketthuc){
            $donhang = $this->connect->prepare("SELECT khachhang.makhachhang, khachhang.hovaten, hangton.mahangton, hangton.ngaytao, hangton.maadmin FROM hangton, khachhang WHERE hangton.makhachhang = khachhang.makhachhang AND khachhang.hovaten LIKE '%$tenkhach%' AND khachhang.sodienthoai LIKE '%$sodienthoai%' AND hangton.ngaytao <= '$ngayketthuc' AND hangton.ngaytao >= '$ngaybatdau'  ORDER BY hangton.ngaytao DESC");
            $donhang->setFetchMode(PDO::FETCH_OBJ);
			$donhang->execute(array($tenkhach, $sodienthoai, $ngaybatdau, $ngayketthuc));
			$list = $donhang->fetchAll(); 
			return $list;
        }
    }
?>