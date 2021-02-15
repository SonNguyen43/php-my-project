<?php
    if(isset($_SESSION['admin'])){
      
        ?><div class="mt-3"></div><?php

        require "ns-tn-view/ns-tn-include/logo.php";
        require "ns-tn-view/ns-tn-include/message.php";

        if(isset($_GET['page'])){
            $page = $_GET['page'];
            switch ($page) {
                case 'quanli':
                    require "ns-tn-quan-li/index.php";
                break;
                # quản lí nhà phân phôi
                case 'quanlinhaphanphoi':
                    require "ns-tn-quan-li/ns-tn-nha-phan-phoi/index.php";
                break;
                case 'nhaphanphoivacuahang':
                    require "ns-tn-quan-li/ns-tn-nha-phan-phoi/nhaphanphoivacuahang/phan-phoi-va-cua-hang.php";
                break;
                case 'taomoinhaphanphoi':
                    require "ns-tn-quan-li/ns-tn-nha-phan-phoi/tao-moi-nha-phan-phoi.php";
                break;
                case 'suanhaphanphoi':
                    require "ns-tn-quan-li/ns-tn-nha-phan-phoi/sua-nha-phan-phoi.php";
                break;
                case 'lichsusuanhaphanphoi':
                    require "ns-tn-quan-li/ns-tn-nha-phan-phoi/lich-su-sua-nha-phan-phoi.php";
                break;
                # quản lí xuất kho
                case 'quanlixuatkho':
                    require "ns-tn-quan-li/ns-tn-xuat-kho/index.php";
                break;
                case 'thongke':
                    require "ns-tn-quan-li/ns-tn-xuat-kho/thong-ke/thong-ke.php";
                break;
                case 'taomoidonhang':
                    require "ns-tn-quan-li/ns-tn-xuat-kho/tao-moi-don-hang.php";
                break;
                case 'suadonhang':
                    require "ns-tn-quan-li/ns-tn-xuat-kho/sua-don-hang.php";
                break;
                 # quản lí hàng tồn
                case 'quanlitonkho':
                    require "ns-tn-quan-li/ns-tn-ton-kho/index.php";
                break;
                case 'taomoihangton':
                    require "ns-tn-quan-li/ns-tn-ton-kho/tao-moi-hang-ton.php";
                break;
                case 'suadonhangton':
                    require "ns-tn-quan-li/ns-tn-ton-kho/sua-don-hang.php";
                break;
                case 'hanghoa':
                    require "ns-tn-quan-li/ns-tn-hang-hoa/index.php";
                break;
                case 'nhathuoc':
                    require "ns-tn-quan-li/ns-tn-nha-thuoc/index.php";
                break;
                case 'taomoinhathuoc':
                    require "ns-tn-quan-li/ns-tn-nha-thuoc/tao-moi-nha-thuoc.php";
                break;
                case 'suanhathuoc':
                    require "ns-tn-quan-li/ns-tn-nha-thuoc/sua-nha-thuoc.php";
                break;
                default:
                    require "ns-tn-include/404.php";
                break;
            }
        }else{
            require "ns-tn-quan-li/index.php";
        }
    }else {
        if (isset($_GET['page'])) {
            $page = $_GET['page'];

            switch ($page) {
                case 'doimatkhau':
                    require "ns-tn-dang-nhap/doimatkhau.php";
                    break;
                
                default:
                    require "ns-tn-dang-nhap/index.php";
                    break;
            }
        }else{
            require "ns-tn-dang-nhap/index.php";
        }
    }
?>