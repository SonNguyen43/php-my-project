<?php
    $str1 = 'ns-tn-database/ket-noi-cthhht.php';
    $str2 = '../ns-tn-database/ket-noi-cthhht.php';
    $str3 = '../../../ns-tn-database/ket-noi-cthhht.php';

    if(file_exists($str1)){
        $file = $str1;
    }else if(file_exists($str2)){
        $file = $str2;
    }else{
        $file = $str3;
    }
    require $file;
  
    class cthhhtclass extends databaseCTHHHT{

        # lấy các thông tin của đơn hàng và chi tiết đơn hàng
        public function LayHangHoaCuaDonHang($mahangton){
            $hanghoa = $this->connect->prepare('SELECT * FROM chitiethanghoahangton cthhht, hanghoa hh, hangton ht WHERE ht.mahangton = cthhht.mahangton AND hh.mahanghoa = cthhht.mahanghoa AND cthhht.mahangton = ?');
            $hanghoa->setFetchMode(PDO::FETCH_OBJ);
            $hanghoa-> execute(array($mahangton));
            $listhanghoa = $hanghoa->fetchAll();
            return $listhanghoa;
        }

        # thêm chi tiết đơn hàng cho đơn hàng tồn
        public function ThemHangHoaVaSoLuong($soluong, $mahanghoa, $mahangton){
            $cauLenh = 'INSERT INTO chitiethanghoahangton (soluong, mahanghoa, mahangton) VALUES (?,?,?);';
            $themMoi = $this->connect->prepare($cauLenh);
            $themMoi->execute(array($soluong, $mahanghoa, $mahangton));
        }

         # xóa 1 hàng hóa trong đơn hàng
         public function XoaMotHangHoaTrongDonHang($makhachhang , $mahangton, $machitiethanghoahangton){
            $cauLenh = 'DELETE chitiethanghoahangton FROM chitiethanghoahangton, hangton WHERE hangton.mahangton = chitiethanghoahangton.mahangton AND hangton.makhachhang = ? AND hangton.mahangton = ? AND chitiethanghoahangton.machitiethanghoahangton = ?';
            $xoa = $this->connect->prepare($cauLenh);
            $xoa->execute(array($makhachhang , $mahangton, $machitiethanghoahangton));
        }

         # sửa thông tin chi tiết hàng hóa 
         public function SuaThongTinHangHoa($soluong, $machitiethanghoahangton, $makhachhang){
            $cauLenh = 'UPDATE chitiethanghoahangton, hangton SET chitiethanghoahangton.soluong = ? WHERE hangton.mahangton = chitiethanghoahangton.mahangton AND chitiethanghoahangton.machitiethanghoahangton = ? AND hangton.makhachhang = ?';
            $capNhat = $this->connect->prepare($cauLenh);
            $capNhat->execute(array($soluong, $machitiethanghoahangton, $makhachhang));
        }
    }
?>




