<?php
    ob_start();
    session_start();

    require_once __DIR__ . '/vendor/autoload.php';
   
    require "models/hoadon.php";
    require "models/sanphamchohoadon.php";
    require "models/sach.php";
    require "models/nhanvien.php";
    require "models/khachhang.php";

    if(isset($_REQUEST['ma_hoa_don'])){
        $ma_hoa_don = $_REQUEST['ma_hoa_don'];

        $hoadon = new hoadon();
        $sanphamchohoadon = new sanphamchohoadon();
        $sach = new sach();
        $nhanvien = new nhanvien();
        $khachhang = new khachhang();

        $thongtinhoadon = $hoadon->thongtinhoadon($ma_hoa_don);
        $thongtinkhachhang = $khachhang->thongtinkhachhangbangmakhachhang($thongtinhoadon->ma_khach_hang);
        $sanphamchohoadon = $sanphamchohoadon->sanphamchohoadhon($ma_hoa_don);

        $mpdf = new \Mpdf\Mpdf();

        $table = "";

        foreach ($sanphamchohoadon as $ds) {
            $table .= '
            <tr class="onRow">
                <td style="text-align: center">'.$sach->thongtinsach($ds->ma_sach)->ten_sach .'</td>
                <td style="text-align: center">
                    <b><span class="badge badge-primary">'. $ds->so_luong .'</span></b>
                </td>
                <td style="text-align: center">
                    '.number_format($ds->tong_tien) .' VNĐ
                </td>
            </tr>
            ';
        }

        $data = '
        <div style="width:150px">
            <img src="./public/images/danhmuc.jpeg"  alt="">
        </div>

        <h2 style="position: absolute; top:70px;right:40px">Nhà Sách Giá Trên Trời</h2>

        <div style="text-align: center">
            <h1>Hóa Đơn Thanh Toán</h1>
            <h4> Tên Khách Hàng: '.$thongtinkhachhang->ten_khach_hang.'</h4>
            <small>(Ngày lập: '.$thongtinhoadon->ngay_lap.')</small>
        </div>
        <hr>
        <h4 style="text-align: left">Nhân viên: <span style="color: blue;"><u>'. $nhanvien->thongtinnhanvienbangmanhanvien($thongtinhoadon->ma_nhan_vien)->ten_nhan_vien . '</u></span></h4>
        <h2 style="text-align: center">Chi tiết hóa đơn</h2>
        <div class="table-responsive">
            <table width="100%" border="1" cellpadding="5px" cellspacing="0px">
                <thead>
                    <tr>
                        <th>Tên Sản Phẩm</th>
                        <th class="text-center">Số Lượng</th>
                        <th class="text-center">Tổng Tiền</th>
                    </tr>
                </thead>
                <tbody>
                    '.$table.'
                </tbody>
            </table>
        </div>

        <hr>

        <h2 style="text-align: right">Thanh Toán: <span style="color: red;"><u>'. number_format($thongtinhoadon->tong_tien) . '</u></span> VNĐ</h2>
        <h5 style="text-align: center"><span style="color: #000;">-- Hẹn Gặp Lại Quý Khách --</span></h5>
        ';
        
        
        # in ra
        $mpdf->WriteHTML($data);
        $mpdf->Output('HoaDon.pdf','D'); 
    }
    
    ob_end_flush();
?>