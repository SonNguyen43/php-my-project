<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.0/jquery.min.js"></script> -->
<script>
    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
    });
</script>
<?php
    require "../../../ns-tn-model/nha-phan-phoi-class.php";
    require "../../../ns-tn-model/admin-class.php";
    require "../../../ns-tn-model/don-hang-class.php";
    require "../../../ns-tn-model/hang-hoa-class.php";
    require "../../../ns-tn-model/cthh-don-hang-class.php";

    # dữ liệu nhận được từ nha-phan-phoi.js
    if(isset($_REQUEST['ngaysanxuatsanpham'])){
        $ngaysanxuatsanpham = trim($_REQUEST['ngaysanxuatsanpham']);
        ?>
            <!-- TABLE -->
            <table class="table table-hover table-bordered table-sm table-light text-center">
                <thead>
                    <tr>
                        <th scope="col" colspan="7">BẢNG TÌM KIẾM</th>
                    </tr>
                    <tr class="bg-browns text-light">
                        <th scope="col">#</th>
                        <th scope="col">Họ tên</th>
                        <th scope="col">SĐT</th>
                        <th scope="col">Địa chỉ</th>
                        <th scope="col">Tên sp & số lượng</th>
                        <th scope="col">Ghi chú</th>
                        <th scope="col">Chức năng</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    $donhang = new donhangclass();
                    $thongtin = $donhang->TimDonHangTheoNgaySanXuat($ngaysanxuatsanpham);
                    $stt = 1;

                    if($ngaysanxuatsanpham == ''){
                        $thongtin = $donhang->LayTatCaDonHang();
                    }
                    
                    foreach ($thongtin as $tt) {
                ?>
                    <tr>
                        <th scope="row" class="font-weight-normal"><?php echo $stt++; ?></th>
                        <th scope="row" class="font-weight-normal"><?php echo $tt->hovaten; ?></th>
                        <th scope="row" class="font-weight-normal"><?php echo $tt->sodienthoai; ?></th>
                        <th scope="row" class="font-weight-normal"><?php echo $tt->diachi; ?></th>
                        <th scope="row" class="font-weight-normal">
                            <?php 
                                # lấy chi tiết đơn hàng thông qua mã đơn hàng
                                $chitiet = new cthhdhclass();
                                $sanpham = $chitiet->LayHangHoaCuaDonHang($tt->madonhang);

                                # lấy tên hàng hóa bằng mã hàng hóa của chi tiết đơn hàng
                                # sử dụng ở dòng foreach
                                $hanghoa = new hanghoaclass();

                                foreach ($sanpham as $sp) {
                                    echo "<strong><span class='text-success' data-toggle='tooltip' data-placement='top' title='Ngày sản xuất: $sp->ngaysanxuat'>" .  $hanghoa->LayHangHoaTheoMa($sp->mahanghoa)->tenhanghoa . "</span>: <span>" . $sp->soluong . "</span></strong><br>";
                                }

                            ?>
                        </th>
                        <th scope="row"  class="font-weight-normal"><?php echo $tt->ghichu; ?></th>
                        <th scope="row"  class="font-weight-normal">
                            <?php
                                # lấy tên admin để show bằng modal
                                $admin = new adminclass();
                                $thongtin = $admin->LayThongTinAdminBangMa($tt->maadmin);
                                $tenadmin = $thongtin->hovaten;
                            ?>
                            <a href="index.php?page=suadonhang&id=<?php echo $tt->makhachhang?>&madonhang=<?php echo $tt->madonhang?>" class="btn btn-warning rounded-pill">Sửa</a>
                            <button type="button" class="btn btn-primary rounded-pill" data-toggle="modal" data-target="#chitietdonhang" onclick="ChiTietDonHang('<?php echo $tt->ngaytao?>', '<?php echo $tt->mabill?>', '<?php echo $tenadmin?>')">Chi tiết</button>
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