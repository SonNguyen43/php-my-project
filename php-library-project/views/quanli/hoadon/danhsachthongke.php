<?php
    session_start();
    require "../../../models/hoadon.php";
    require "../../../models/sanphamchohoadon.php";
    require "../../../models/sach.php";
    require "../../../models/nhanvien.php";
    require "../../../models/khachhang.php";

    if (isset($_REQUEST['ngaybatdau']) && isset($_REQUEST['ngayketthuc'])) {
        $ngaybatdau = $_REQUEST['ngaybatdau'];
        $ngayketthuc = $_REQUEST['ngayketthuc'];

        $hoadon = new hoadon();
        $sanphamchohoadon = new sanphamchohoadon();
        $sach = new sach();
        $nhanvien = new nhanvien();
        $khachhang = new khachhang();

        $danhsach = $hoadon->thongketheongay($ngaybatdau, $ngayketthuc);
        ?>
            <div class="table-responsive mb-3 table-sm">
                <table class="table table-hover table-striped table-light text-center table-bordered" id="tablehoadon">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Mã</th>
                            <th>Sản_Phẩm</th>
                            <th>Tổng_Tiền</th>
                            <th>Ngày_Tạo</th>
                            <th>Tên KH</th>
                            <th>NV_Tạo</th>
                            <th>Chức nắng</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $tongtien = 0;
                            $stt = 1;
                            foreach ($danhsach as $ds) {
                                $makhachhang = $hoadon->thongtinhoadon($ds->ma_hoa_don)->ma_khach_hang;
                                ?>
                                    <tr class="onRow">
                                        <td><?php echo $stt++; ?></td>
                                        <td><?php echo $ds->ma_hoa_don; ?></td>
                                        <td>
                                            <?php 
                                                $sanpham = $sanphamchohoadon->sanphamchohoadhon($ds->ma_hoa_don);

                                                foreach ($sanpham as $sp) {
                                                    echo $sach->thongtinsach($sp->ma_sach)->ten_sach.": ". $sp->so_luong ."<br>";
                                                }
                                            ?>
                                        </td>
                                        <td> 
                                            <?php 
                                                echo number_format($ds->tong_tien);
                                                $tongtien += $ds->tong_tien;
                                            ?>
                                        </td>
                                        <td> <?php echo $ds->ngay_lap; ?></td>
                                        <td><?php echo $khachhang->thongtinkhachhangbangmakhachhang($makhachhang)->ten_khach_hang; ?></td>
                                        <td> <?php echo $nhanvien->thongtinnhanvienbangmanhanvien($ds->ma_nhan_vien)->ten_nhan_vien; ?></td>
                                        <td>
                                            <?php
                                                $nhavien = new nhanvien();
                                                if($nhavien->thongtinnhanvienbangmanhanvien($_SESSION['nhanvien'])->type == 'admin'){
                                                    ?>
                                                        <div class="btn btn-danger" id="delete_hoadon" data-toggle="modal" data-target="#xoahoadon">Xóa</div>
                                                        <form method="POST" action="createbill.php?ma_hoa_don=<?php echo $ds->ma_hoa_don?>" id="createBill" class="mb-3">
                                                            <button type="submit" class="btn btn-warning">In</button>
                                                        </form>
                                                    <?php
                                                }else{
                                                    ?>
                                                        <form method="POST" action="createbill.php?ma_hoa_don=<?php echo $ds->ma_hoa_don?>" id="createBill" class="mb-3">
                                                            <button type="submit" class="btn btn-warning">In</button>
                                                        </form>
                                                    <?php
                                                }
                                            ?>
                                        </td>
                                    </tr>
                                   
                                <?php
                            }
                            ?>
                                 <tr>
                                    <td colspan="8">
                                        <h3>Tổng Tiền: <span class="text-danger"><?php echo number_format($tongtien); ?></span> VNĐ</h3>
                                    </td>
                                </tr>
                            <?php
                        ?>
                    </tbody>
                </table>
            </div>
        <?php
    }
?>