<?php
    $str1 = 'ns-tn-database/ket-noi-nha-phan-phoi.php';
    $str2 = '../ns-tn-database/ket-noi-nha-phan-phoi.php';
    $str3 = '../../../ns-tn-database/ket-noi-nha-phan-phoi.php';

    if(file_exists($str1)){
        $file = $str1;
    }else if(file_exists($str2)){
        $file = $str2;
    }else{
        $file = $str3;
    }
    require $file;
  
    class nhaphanphoiclass extends databaseNhaPhanPhoi{
        # lấy tất cả nhà phân phối lâu năm
        public function LayTatCaNhaPhanPhoiLauNam(){
            $khachhang = $this->connect->prepare('SELECT * FROM khachhang WHERE khachhang.loaikhachhang = "khachlaunam" ORDER BY khachhang.ngaytao DESC');
            $khachhang->setFetchMode(PDO::FETCH_OBJ);
            $khachhang->execute();
            $listkhachhang = $khachhang->fetchAll();
            return $listkhachhang;
        }

        # nhà phân phối có cửa hàng
        public function NhaPhanPhoiCoCuaHang(){
            $khachhang = $this->connect->prepare('SELECT * FROM khachhang WHERE macuahang != "" ORDER BY khachhang.ngaytao DESC');
            $khachhang->setFetchMode(PDO::FETCH_OBJ);
            $khachhang->execute();
            $listkhachhang = $khachhang->fetchAll();
            return $listkhachhang;
        }

        # lấy khách hàng mới nhất
        public function LayKhachHangMoiTao(){
            $khachhang = $this->connect->prepare('SELECT MAX(makhachhang) as MAX FROM khachhang');
            $khachhang->setFetchMode(PDO::FETCH_OBJ);
            $khachhang->execute();
            $listkhachhang = $khachhang->fetch();
            return $listkhachhang;
        }

        # Đếm xem có khách hàng nào với ID này không
        public function DemKhachhang($makhachhang){
            $check = $this->connect->prepare("SELECT * FROM khachhang WHERE makhachhang = ?");
            $check->setFetchMode(PDO::FETCH_OBJ);
            $check -> execute(array($makhachhang));
            $count = count($check->fetchAll());
            return $count;
        }

        # lấy thông tin của 1 tài khoản khách hàng bằng mã tài khoản
        public function LayThongTinKhachHangBangMa($makhachhang){
            $khachhang = $this->connect->prepare("SELECT * FROM khachhang  WHERE makhachhang=?");
			$khachhang->setFetchMode(PDO::FETCH_OBJ);
			$khachhang->execute(array($makhachhang));
			$list = $khachhang->fetch(); 
			return $list;
        }

         # lấy thông tin của 1 tài khoản khách hàng bằng số điện thoại
         public function LayThongTinKhachHangBangSoDienThoai($sodienthoai){
            $khachhang = $this->connect->prepare("SELECT * FROM khachhang  WHERE sodienthoai=? AND loaikhachhang = 'khachquaduong' ");
			$khachhang->setFetchMode(PDO::FETCH_OBJ);
			$khachhang->execute(array($sodienthoai));
			$list = $khachhang->fetch(); 
			return $list;
        }

        # thêm một nhà phân phối mới 
        public function ThemNhaPhanPhoiQuaDuong($hovaten, $sodienthoai, $cmnd, $diachi,  $maadmin, $ngaytao){
            $cauLenh = 'INSERT INTO khachhang (hovaten, sodienthoai, cmnd, diachi, maadmin, ngaytao) VALUES (?,?,?,?,?,?)';
            $themMoi = $this->connect->prepare($cauLenh);
            $themMoi->execute(array($hovaten, $sodienthoai, $cmnd, $diachi, $maadmin, $ngaytao));
        }

        # thêm một nhà phân phối mới và cửa hàng nếu có
        public function ThemNhaPhanPhoiVaCuaHang($hovaten, $sodienthoai, $cmnd, $diachi, $capbac, $tructhuoc, $mahopdong, $macuahang, $hethongnhaphanphoi, $loaikhachhang, $maadmin, $ngaytao){
            $cauLenh = 'INSERT INTO khachhang (hovaten, sodienthoai, cmnd, diachi, capbac, tructhuoc, mahopdong, macuahang, hethongnhaphanphoi, loaikhachhang, maadmin, ngaytao) VALUES (?,?,?,?,?,?,?,?,?,?,?,?)';
            $themMoi = $this->connect->prepare($cauLenh);
            $themMoi->execute(array($hovaten, $sodienthoai, $cmnd, $diachi, $capbac, $tructhuoc, $mahopdong, $macuahang, $hethongnhaphanphoi, $loaikhachhang, $maadmin, $ngaytao));
        }

        # sửa một nhà phân phối mới và cửa hàng nếu có
        public function SuaNhaPhanPhoiVaCuaHang($hovaten, $sodienthoai, $cmnd, $diachi, $capbac, $tructhuoc, $mahopdong, $macuahang, $hethongnhaphanphoi, $loaikhachhang, $maadmin, $danghi, $ngaysua, $ngaylencap, $maadminsua, $makhachhang){
            $cauLenh = ' UPDATE khachhang SET hovaten = ?, sodienthoai = ?, cmnd = ?, diachi = ?, capbac = ?, tructhuoc = ?, mahopdong = ?, macuahang = ?, hethongnhaphanphoi = ?, loaikhachhang = ?, maadmin = ?, danghi = ?, ngaysua = ? , ngaylencap = ? , maadminsua = ? WHERE khachhang.makhachhang = ?';
            $themMoi = $this->connect->prepare($cauLenh);
            $themMoi->execute(array($hovaten, $sodienthoai, $cmnd, $diachi, $capbac, $tructhuoc, $mahopdong, $macuahang, $hethongnhaphanphoi, $loaikhachhang, $maadmin, $danghi, $ngaysua, $ngaylencap, $maadminsua, $makhachhang));
        }

        public function SuaNhaPhanPhoiVaCuaHangKhongLenCap($hovaten, $sodienthoai, $cmnd, $diachi, $capbac, $tructhuoc, $mahopdong, $macuahang, $hethongnhaphanphoi, $loaikhachhang, $maadmin, $danghi, $ngaysua, $maadminsua, $makhachhang){
            $cauLenh = ' UPDATE khachhang SET hovaten = ?, sodienthoai = ?, cmnd = ?, diachi = ?, capbac = ?, tructhuoc = ?, mahopdong = ?, macuahang = ?, hethongnhaphanphoi = ?, loaikhachhang = ?, maadmin = ?, danghi = ?, ngaysua = ? , maadminsua = ? WHERE khachhang.makhachhang = ?';
            $themMoi = $this->connect->prepare($cauLenh);
            $themMoi->execute(array($hovaten, $sodienthoai, $cmnd, $diachi, $capbac, $tructhuoc, $mahopdong, $macuahang, $hethongnhaphanphoi, $loaikhachhang, $maadmin, $danghi, $ngaysua, $maadminsua, $makhachhang));
        }

        # sửa loại khách hàng
        public function SuaLoaiKhachHang($ngaytao, $maadmin,$sodienthoai,  $makhachhang){
            $cauLenh = ' UPDATE khachhang SET loaikhachhang = "khachlaunam", ngaytao = ? ,maadmin = ? WHERE khachhang.sodienthoai = ? AND khachhang.makhachhang = ?';
            $themMoi = $this->connect->prepare($cauLenh);
            $themMoi->execute(array($ngaytao, $maadmin,$sodienthoai, $makhachhang));
        }

        public function ThemNgayLenCap($ngaylencap, $makhachhang){
            $cauLenh = ' UPDATE khachhang SET ngaylencap = ? WHERE khachhang.makhachhang = ?';
            $themMoi = $this->connect->prepare($cauLenh);
            $themMoi->execute(array($ngaylencap, $makhachhang));
        }

        # tìm khách theo tên và số điện thoại
        public function TimNhaPhanPhoiTheoTenVaSoDienThoai($tenkhach, $sodienthoai, $cmnd){
            $khachhang = $this->connect->prepare("SELECT * FROM khachhang WHERE hovaten like '%$tenkhach%' AND sodienthoai like '%$sodienthoai%' AND cmnd like '%$cmnd%' ORDER BY khachhang.ngaytao DESC");
            $khachhang->setFetchMode(PDO::FETCH_OBJ);
			$khachhang->execute(array($tenkhach,$sodienthoai,$cmnd));
			$list = $khachhang->fetchAll(); 
			return $list;
        }

         # tìm khách theo tên và số điện thoại
         public function TimNhaPhanPhoiTheoTenVaSoDienThoaiCoCuaHang($tenkhach, $sodienthoai, $cmnd){
            $khachhang = $this->connect->prepare("SELECT * FROM khachhang WHERE hovaten like '%$tenkhach%' AND sodienthoai like '%$sodienthoai%' AND cmnd like '%$cmnd%' AND macuahang != '' ORDER BY khachhang.ngaytao DESC");
            $khachhang->setFetchMode(PDO::FETCH_OBJ);
			$khachhang->execute(array($tenkhach,$sodienthoai,$cmnd));
			$list = $khachhang->fetchAll(); 
			return $list;
        }

        # tìm khách theo số điện thoại
        public function TimNhaPhanPhoiTheoSoDienThoai($sodienthoai){
            $khachhang = $this->connect->prepare("SELECT * FROM khachhang WHERE sodienthoai like '%$sodienthoai%'");
            $khachhang->setFetchMode(PDO::FETCH_OBJ);
			$khachhang->execute(array($sodienthoai));
			$list = $khachhang->fetch(); 
			return $list;
        }
    }
?>