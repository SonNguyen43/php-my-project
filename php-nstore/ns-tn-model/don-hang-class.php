<?php
    $str1 = 'ns-tn-database/ket-noi-don-hang.php';
    $str2 = '../ns-tn-database/ket-noi-don-hang.php';
    $str3 = '../../../ns-tn-database/ket-noi-don-hang.php';

    if(file_exists($str1)){
        $file = $str1;
    }else if(file_exists($str2)){
        $file = $str2;
    }else{
        $file = $str3;
    }
    require $file;
  
    class donhangclass extends databaseDonHang{

        # lấy tên hàng hóa theo mã
        public function LayHangTonTheoMa($mahanghoa){
            $hanghoa = $this->connect->prepare("SELECT * FROM hanghoa WHERE mahanghoa=?");
			$hanghoa->setFetchMode(PDO::FETCH_OBJ);
			$hanghoa->execute(array($mahanghoa));
			$list = $hanghoa->fetch(); 
			return $list;
        }

        # Tìm đơn hàng có phải của người nào đó không
        public function TimDonHangCuaKhachHang($makhachhang, $madonhang){
            $check = $this->connect->prepare("SELECT * FROM donhang WHERE makhachhang = ? AND madonhang = ?");
            $check->setFetchMode(PDO::FETCH_OBJ);
            $check -> execute(array($makhachhang, $madonhang));
            $count = count($check->fetchAll());
            return $count;
        }

        # tính sản phẩm
        public function TinhTongSanPhamKhongNgay($tenkhach, $sodienthoai, $mabill){
            $donhang = $this->connect->prepare("SELECT hanghoa.tenhanghoa, SUM(chitiethanghoadonhang.soluong) AS soluong FROM donhang, khachhang, chitiethanghoadonhang, hanghoa WHERE khachhang.makhachhang = donhang.makhachhang AND donhang.madonhang = chitiethanghoadonhang.madonhang AND chitiethanghoadonhang.mahanghoa = hanghoa.mahanghoa AND khachhang.hovaten LIKE '%$tenkhach%' AND khachhang.sodienthoai LIKE '%$sodienthoai%' AND donhang.mabill LIKE '%$mabill%' GROUP BY hanghoa.tenhanghoa ORDER BY donhang.ngaytao DESC");
            $donhang->setFetchMode(PDO::FETCH_OBJ);
			$donhang->execute(array($tenkhach, $sodienthoai, $mabill));
			$list = $donhang->fetchAll(); 
			return $list;
        }

         # tính sản phẩm có ngày
         public function TinhTongSanPhamCoNgay($tenkhach, $sodienthoai, $mabill,$ngaybatdau, $ngayketthuc){
            $donhang = $this->connect->prepare("SELECT hanghoa.tenhanghoa, SUM(chitiethanghoadonhang.soluong) AS soluong FROM donhang, khachhang, chitiethanghoadonhang, hanghoa WHERE khachhang.makhachhang = donhang.makhachhang AND donhang.madonhang = chitiethanghoadonhang.madonhang AND chitiethanghoadonhang.mahanghoa = hanghoa.mahanghoa AND khachhang.hovaten LIKE '%$tenkhach%' AND khachhang.sodienthoai LIKE '%$sodienthoai%' AND donhang.mabill LIKE '%$mabill%' AND donhang.ngaytao <= '$ngayketthuc' AND donhang.ngaytao >= '$ngaybatdau' GROUP BY hanghoa.tenhanghoa ORDER BY donhang.ngaytao DESC");
            $donhang->setFetchMode(PDO::FETCH_OBJ);
			$donhang->execute(array($tenkhach, $sodienthoai, $mabill,$ngaybatdau, $ngayketthuc));
			$list = $donhang->fetchAll(); 
			return $list;
        }

        # tìm đơn hàng
        public function TimDonHangKhongNgay($tenkhach, $sodienthoai, $mabill){
            $donhang = $this->connect->prepare("SELECT khachhang.makhachhang, khachhang.hovaten, khachhang.sodienthoai, khachhang.diachi, donhang.madonhang, donhang.mabill, donhang.maadmin,donhang.ngaytao, donhang.ghichu FROM donhang, khachhang WHERE donhang.makhachhang = khachhang.makhachhang AND khachhang.hovaten LIKE '%$tenkhach%' AND khachhang.sodienthoai LIKE '%$sodienthoai%' AND donhang.mabill LIKE '%$mabill%' ORDER BY donhang.ngaytao DESC");
            $donhang->setFetchMode(PDO::FETCH_OBJ);
			$donhang->execute(array($tenkhach, $sodienthoai, $mabill));
			$list = $donhang->fetchAll(); 
			return $list;
        }

        # tìm đơn hàng có ngày
        public function TimDonHangCoNgay($tenkhach, $sodienthoai, $mabill, $ngaybatdau, $ngayketthuc){
            $donhang = $this->connect->prepare("SELECT khachhang.hovaten, khachhang.sodienthoai, khachhang.diachi, donhang.madonhang, donhang.mabill, donhang.maadmin,donhang.ngaytao, donhang.ghichu FROM donhang, khachhang WHERE donhang.makhachhang = khachhang.makhachhang AND khachhang.hovaten LIKE '%$tenkhach%' AND khachhang.sodienthoai LIKE '%$sodienthoai%' AND donhang.mabill LIKE '%$mabill%' AND donhang.ngaytao <= '$ngayketthuc' AND donhang.ngaytao >= '$ngaybatdau' ORDER BY donhang.ngaytao DESC");
            $donhang->setFetchMode(PDO::FETCH_OBJ);
			$donhang->execute(array($tenkhach, $sodienthoai, $mabill, $ngaybatdau, $ngayketthuc));
			$list = $donhang->fetchAll(); 
			return $list;
        }

        # tìm đơn hàng theo ngày sản xuất
        public function TimDonHangTheoNgaySanXuat($ngaysanxuat){
            $donhang = $this->connect->prepare("SELECT khachhang.hovaten, khachhang.sodienthoai, khachhang.diachi, donhang.madonhang, donhang.mabill, donhang.maadmin,donhang.ngaytao, donhang.ghichu FROM donhang, khachhang, chitiethanghoadonhang WHERE donhang.makhachhang = khachhang.makhachhang AND donhang.madonhang = chitiethanghoadonhang.madonhang AND chitiethanghoadonhang.ngaysanxuat = '$ngaysanxuat' ORDER BY khachhang.makhachhang DESC");
            $donhang->setFetchMode(PDO::FETCH_OBJ);
			$donhang->execute(array($ngaysanxuat));
			$list = $donhang->fetchAll(); 
			return $list;
        }

        # lấy tất cả các đơn hàng đã đặt
        public function LayTatCaDonHang(){
            $donhang = $this->connect->prepare('SELECT kh.makhachhang, kh.hovaten, kh.sodienthoai, kh.diachi, dh.madonhang, dh.mabill, dh.maadmin, dh.ngaytao, dh.ghichu FROM donhang dh, khachhang kh WHERE kh.makhachhang = dh.makhachhang ORDER BY dh.ngaytao DESC');
            $donhang->setFetchMode(PDO::FETCH_OBJ);
            $donhang->execute();
            $listdonhang = $donhang->fetchAll();
            return $listdonhang;
        }

        # thêm một đơn hàng mới
        public function ThemNhaPhanPhoiVaCuaHang($mabill, $ngaytao, $makhachhang, $ghichu, $maadmin){
            $cauLenh = 'INSERT INTO donhang (mabill, ngaytao, makhachhang, ghichu, maadmin) VALUES (?,?,?,?,?)';
            $themMoi = $this->connect->prepare($cauLenh);
            $themMoi->execute(array($mabill, $ngaytao, $makhachhang,$ghichu, $maadmin));
        }

        # lấy mã đơn hàng đang thêm cho khách hàng
        public function LayDonHang($makhachhang){
            $donhangcho = $this->connect->prepare("SELECT MAX(dh.madonhang) AS MAX FROM donhang dh, khachhang kh WHERE dh.makhachhang = kh.makhachhang AND dh.makhachhang = ?");
			$donhangcho->setFetchMode(PDO::FETCH_OBJ);
			$donhangcho->execute(array($makhachhang));
			$list = $donhangcho->fetch(); 
			return $list;
        }

        # xóa các hàng hóa trong đơn hàng
        public function XoaHangHoaTrongDonHang($makhachhang , $madonhang){
            # xóa các món hàng trong chi tiet hàng hóa
            $cauLenh = 'DELETE chitiethanghoadonhang , donhang FROM chitiethanghoadonhang, donhang WHERE donhang.madonhang = chitiethanghoadonhang.madonhang AND donhang.makhachhang = ? AND donhang.madonhang = ?';
            $xoa = $this->connect->prepare($cauLenh);
            $xoa->execute(array($makhachhang, $madonhang));

            # sao đó xóa đơn hàng
            $cauLenh = 'DELETE FROM donhang WHERE donhang.madonhang = ?';
            $xoa = $this->connect->prepare($cauLenh);
            $xoa->execute(array($madonhang));
        }
    }
?>

