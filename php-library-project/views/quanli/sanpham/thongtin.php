<?php
    require "../../../models/sanpham.php";
    require "../../../models/danhmuc.php";

    $sanpham = new sanpham();
    $danhmuc = new danhmuc();

    $thongtinsanpham = $sanpham->tatcasanpham();
    $thongtindanhmuc = $danhmuc->tatcadanhmuc();
?>

<div class="card mb-3" style="max-width: 540px;">
    <div class="row no-gutters">
        <div class="col-md-4 pt-3 pl-3">
            <img src="public/images/sanpham.jpg" class="card-img">
        </div>
        <div class="col-md-8">
            <div class="card-body">
                <h5 class="card-title"><b>Thông tin</b></h5>
                <p class="card-text">
                    
                    <button type="button" class="btn btn-primary">
                    Tổng số sản phẩm: <span class="badge badge-light"><i class=""><?php echo count($thongtinsanpham)?></i></span>
                        <span class="sr-only"> </span>
                    </button>

                </p>
                <p class="card-text">
                    <?php
                        foreach ($thongtindanhmuc as $ttdm) {
                            $color = $ttdm->TenDanhMuc;
                            switch ($color) {
                                case 'Máy tính bảng':
                                case 'Máy Tính Bảng':
                                    echo $ttdm->TenDanhMuc . ": <span class='badge badge-primary float-right'>" . $sanpham->thongtindanhmucsanpham($ttdm->MaDanhMuc) . " món</span><br>";
                                    break;
                                case 'Phụ kiện':
                                case 'Phụ Kiện':
                                    echo $ttdm->TenDanhMuc . ": <span class='badge badge-success float-right'>" . $sanpham->thongtindanhmucsanpham($ttdm->MaDanhMuc) . " món</span><br>";
                                    break;
                                case 'Điện thoại':
                                case 'Điện Thoại':
                                    echo $ttdm->TenDanhMuc . ": <span class='badge badge-danger float-right'>" . $sanpham->thongtindanhmucsanpham($ttdm->MaDanhMuc) . " món</span><br>";
                                    break;
                                case 'Laptop':
                                    echo $ttdm->TenDanhMuc . ": <span class='badge badge-warning float-right'>" . $sanpham->thongtindanhmucsanpham($ttdm->MaDanhMuc) . " món</span><br>";
                                    break;
                                default:
                                    break;
                            }
                        }
                    ?>
                </p>
            </div>
        </div>
    </div>
</div>