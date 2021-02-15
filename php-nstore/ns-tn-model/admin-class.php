<?php
    $str1 = 'ns-tn-database/ket-noi-admin.php';
    $str2 = '../ns-tn-database/ket-noi-admin.php';
    $str3 = '../../../ns-tn-database/ket-noi-admin.php';

    if(file_exists($str1)){
        $file = $str1;
    }else if(file_exists($str2)){
        $file = $str2;
    }else{
        $file = $str3;
    }
    require $file;
  
    class adminclass extends databaseAdmin{
        
        # Kiểm tra đăng nhập
        public function CheckDangNhap($tentaikhoan, $matkhau){
            $check = $this->connect->prepare("SELECT * FROM admin WHERE tentaikhoan=? AND matkhau=?");
            $check->setFetchMode(PDO::FETCH_OBJ);
            $check->execute(array($tentaikhoan, $matkhau));
            $list = $check->fetch();
            
            if($list != NULL){
                return $list->kieuadmin;
            }
            else{
                return NULL;
            }
        }

        # lấy thông tin của 1 tài khoản admin bằng tên tài khoản
        public function LayThongTinAdminBangTen($tentaikhoan){
            $admin = $this->connect->prepare("SELECT * FROM admin WHERE tentaikhoan=?");
			$admin->setFetchMode(PDO::FETCH_OBJ);
			$admin->execute(array($tentaikhoan));
			$list = $admin->fetch(); 
			return $list;
        }

        # kiểm tra mật khẩu cũ
        public function CheckMatKhauCu($tentaikhoan, $matkhau){
            $check = $this->connect->prepare("SELECT * FROM admin WHERE tentaikhoan=? AND matkhau=?");
            $check->setFetchMode(PDO::FETCH_OBJ);
            $check->execute(array($tentaikhoan, $matkhau));
            $count = count($check->fetchAll());
            return $count;
        }

        # lấy thông tin của 1 tài khoản admin bằng mã tài khoản
        public function LayThongTinAdminBangMa($maadmin){
            $admin = $this->connect->prepare("SELECT * FROM admin WHERE maadmin=?");
			$admin->setFetchMode(PDO::FETCH_OBJ);
			$admin->execute(array($maadmin));
			$list = $admin->fetch(); 
			return $list;
        }

        # sửa mật khẩu
        public function SuaThongTinMatKhau($matkhaumoi, $maadmin){
            $cauLenh = 'UPDATE admin SET admin.matkhau = ? WHERE admin.maadmin = ?';
            $capNhat = $this->connect->prepare($cauLenh);
            $capNhat->execute(array($matkhaumoi, $maadmin));
        }
    }
?>