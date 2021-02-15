<?php
    require "../../../ns-tn-model/nha-phan-phoi-class.php";
    require "../../../ns-tn-model/admin-class.php";
    require "../../../ns-tn-model/hang-ton-class.php";
    require "../../../ns-tn-model/hang-hoa-class.php";
    require "../../../ns-tn-model/cthh-hang-ton-class.php";

    # dữ liệu nhận được từ nha-phan-phoi.js
    if(isset($_REQUEST['tenkhachtim']) || isset($_REQUEST['sodienthoaikhachtim']) || isset($_REQUEST['ngaybatdautim']) || isset($_REQUEST['ngayketthuctim'])){
        $tenkhachtim = trim($_REQUEST['tenkhachtim']);
        $sodienthoaikhachtim = trim($_REQUEST['sodienthoaikhachtim']);
        $ngaybatdautim = trim($_REQUEST['ngaybatdautim']);
        $ngayketthuctim = trim($_REQUEST['ngayketthuctim']);
       
        ?>
            <!-- TABLE -->
            <table class="table table-hover table-bordered table-sm table-light text-center">
                <thead>
                    <tr>
                        <th scope="col" colspan="5">BẢNG TÌM KIẾM</th>
                    </tr>
                    <tr class="bg-browns text-light">
                    <th scope="col">#</th>
                        <th scope="col">Họ tên</th>
                        <th scope="col">Hàng hóa còn tồn</th>
                        <th scope="col">Ngày kiểm kê</th>
                        <th scope="col">Chức năng</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    $stt = 1;

                    $hangton = new hangtonclass();
                    
                    if($ngaybatdautim == "" || $ngayketthuctim == ""){
                        $thongtin = $hangton->TimHangTonKhongNgay($tenkhachtim, $sodienthoaikhachtim);
                    }else{
                        $thongtin = $hangton->TimHangTonCoNgay($tenkhachtim, $sodienthoaikhachtim, $ngaybatdautim, $ngayketthuctim);
                    }
                   
                    foreach ($thongtin as $tt) {
                ?>
                    <tr>
                        <th scope="row" class="font-weight-normal"><?php echo $stt++; ?></th>
                        <th scope="row" class="font-weight-normal"><?php echo $tt->hovaten; ?></th>
                        <th scope="col" class="font-weight-normal">
                            <?php
                                $chitiet = new cthhhtclass();
                                $thongtinchitiet = $chitiet->LayHangHoaCuaDonHang($tt->mahangton);
                                
                                foreach ($thongtinchitiet as $ttct) {
                                    echo "<strong> <span class='text-success'>" .  $hangton->LayHangTonTheoMa($ttct->mahanghoa)->tenhanghoa . "</span>: <span>" . $ttct->soluong . "</span></strong><br>";
                                }
                            ?>
                        </th>
                        <th scope="col" class="font-weight-normal">
                        
                        <?php  echo date("d-m-Y", strtotime($tt->ngaytao));  ?>
                        </th>
                        <th scope="col" class="font-weight-normal">
                            <?php
                                # lấy tên admin để show bằng modal
                                $admin = new adminclass();
                                $thongtin = $admin->LayThongTinAdminBangMa($tt->maadmin);
                                $tenadmin = $thongtin->hovaten;
                            ?>
                            <button type="button" class="btn btn-primary rounded-pill" data-toggle="modal" data-target="#chitietdonhang" onclick="ChiTietDonHangTon('<?php echo $tenadmin?>')">Chi tiết</button>
                            <a href="index.php?page=suadonhangton&id=<?php echo $tt->makhachhang?>&mahangton=<?php echo $tt->mahangton?>" class="btn btn-warning rounded-pill">Sửa</a>
                        </th>
                    </tr>
                <?php
                    }
                ?>
                </tbody>
            </table>    <!-- END TABLE -->
           <?php
    }else{  
        ?>
            <div class="alert alert-danger" role="alert">
                Lỗi... Không nhận được dữ liệu tìm kiếm...!
            </div>
        <?php
    }
?>