<?php
    require "../../../ns-tn-model/nha-phan-phoi-class.php";
    require "../../../ns-tn-model/admin-class.php";

    # dữ liệu nhận được từ nha-phan-phoi.js
    if(isset($_REQUEST['tenkhach']) || isset($_REQUEST['sodienthoai']) || isset($_REQUEST['cmnd'])){
        $tenkhach = trim($_REQUEST['tenkhach']);
        $sodienthoai = trim($_REQUEST['sodienthoai']);
        $cmnd = trim($_REQUEST['cmnd']);

            # tìm kiếm
            $khachhang = new nhaphanphoiclass();
            $thongtin = $khachhang->TimNhaPhanPhoiTheoTenVaSoDienThoai($tenkhach, $sodienthoai,$cmnd);
            ?>
                <table class="table table-hover table-bordered table-sm table-light text-center">
                    <thead>
                        <tr>
                            <th scope="col" colspan="8">Bảng Tìm Kiếm</th>
                        </tr>
                        <tr class="bg-browns text-light">
                            <th scope="col">#</th>
                            <th scope="col">Họ tên</th>
                            <th scope="col">SĐT</th>
                            <th scope="col">CMND</th>
                            <th scope="col">Địa chỉ</th>
                            <th scope="col">Cấp bậc</th>
                            <th scope="col">Trực thuộc</th>
                            <th scope="col">Chức năng</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                        $stt = 1;
                    
                        # hiển thị thông tin tìm được
                        foreach ($thongtin as $tt) {
                            $admin = new adminclass();
                            $thongtinadmin = $admin->LayThongTinAdminBangMa($tt->maadmin);

                            if($tt->loaikhachhang == "khachlaunam"){
                    ?>
                            <tr <?php if($tt->danghi == 'danghi') echo 'style="color: #D8D8D8 "' ?>>
                                <th scope="row"><?php echo $stt++; ?></th>
                                <td><?php echo $tt->hovaten ?></td>
                                <td><?php echo $tt->sodienthoai; ?></td>
                                <td><?php echo $tt->cmnd; ?></td>
                                <td><?php echo $tt->diachi; ?></td>
                                <td>
                                <?php 
                                    if($tt->capbac == 'le') echo 'Khách lẻ'; 
                                    else if($tt->capbac == 'si') echo 'Khách sĩ';
                                    else if($tt->capbac == 'chinhanh') echo 'Chi nhánh';  
                                    else if($tt->capbac == 'daili') echo 'Đại lí'; 
                                    else if($tt->capbac == 'tongdaili') echo 'Tổng đại lí'; 
                                    else if($tt->capbac == 'nhaphanphoi') echo 'Nhà phân phối';
                                    else if($tt->capbac == 'nhaphanphoivang') echo 'Nhà phân phối vàng';
                                    else if($tt->capbac == 'nhaphanphoikimcuong') echo 'Nhà phân phối kim cương';
                                    else if($tt->capbac == 'giamdockinhdoanh') echo 'Giám đốc kinh doanh';
                                ?>
                                </td>
                                <td><?php echo $tt->tructhuoc; ?></td>
                                <td>
                                    <a href="index.php?page=suanhaphanphoi&id=<?php echo $tt->makhachhang; ?>" class="btn btn-warning rounded-pill">Sửa</a>
                                    <button type="button" class="btn btn-primary rounded-pill" data-toggle="modal" data-target="#xemthongtinchitiet" onclick="XemThemThongTin('<?php echo $tt->makhachhang;?>','<?php echo $tt->hovaten ?>','<?php echo $tt->mahopdong;?>', '<?php echo $tt->macuahang;?>', '<?php echo $tt->hethongnhaphanphoi;?>', '<?php echo $tt->danghi;?>', '<?php echo $thongtinadmin->hovaten;?>','<?php echo $tt->ngaytao;?>', '<?php echo $tt->ngaysua; ?>' ,'<?php echo $tt->ngaylencap; ?>')">Xem chi tiết</button>
                                </td>
                            </tr>
                    <?php
                        }
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