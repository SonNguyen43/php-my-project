<?php
    session_start();

    require "../../../models/hoadon.php";
    require "../../../models/sanphamchohoadon.php";
    require "../../../models/sach.php";
    require "../../../models/nhanvien.php";
    require "../../../models/khachhang.php";


    $stt= 1;

    $hoadon = new hoadon();

    $sanphamchohoadon = new sanphamchohoadon();

    $sach = new sach();

    $nhanvien = new nhanvien();

    $khachhang = new khachhang();
    
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
               
                $danhsachhoadon = $hoadon->tatcahoadon();

                foreach ($danhsachhoadon as $ds) {
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
                            <td> <?php echo number_format($ds->tong_tien); ?></td>
                            <td> <?php echo $ds->ngay_lap; ?></td>
                            <td><?php echo $khachhang->thongtinkhachhangbangmakhachhang($makhachhang)->ten_khach_hang; ?></td>
                            <td> <?php echo $nhanvien->thongtinnhanvienbangmanhanvien($ds->ma_nhan_vien)->ten_nhan_vien; ?></td>
                            <td>
                                <?php
                                    $nhavien = new nhanvien();
                                    if($nhavien->thongtinnhanvienbangmanhanvien($_SESSION['nhanvien'])->type == 'admin'){
                                        ?>
                                            <div class="btn btn-danger btn-sm" id="delete_hoadon" data-toggle="modal" data-target="#xoahoadon">Xóa</div>
                                            <form method="POST" action="createbill.php?ma_hoa_don=<?php echo $ds->ma_hoa_don?>" id="createBill" class="mb-3">
                                                <button type="submit" class="btn btn-warning btn-sm">In HD</button>
                                            </form>
                                        <?php
                                    }else{
                                        ?>
                                            <form method="POST" action="createbill.php?ma_hoa_don=<?php echo $ds->ma_hoa_don?>" id="createBill" class="mb-3">
                                                <button type="submit" class="btn btn-warning btn-sm">In HD</button>
                                            </form>
                                        <?php
                                    }
                                ?>
                            </td>
                        </tr>
                    <?php
                }
            ?>
        </tbody>
    </table>
</div>

<div class="modal fade" id="xoahoadon" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel"><i class="fas fa-trash-alt text-danger"></i>Xóa hóa đơn</h5>
                <button type="button" class="close dongform" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" id="formxoahoadon" class="text-left">
                    <div class="form-group">
                        <label for=""><b>Bạn muốn xóa hóa đơn này:</b></label>
                        <input type="text" name="mahoadon" id="mahoadonxoa" class="p-0 border-0">
                    </div>
                    <div class="float-right">
                        <button type="sumit" class="btn btn-outline-danger save">Xóa</button>
                        <button type="button" class="btn btn-secondary dongform" data-dismiss="modal">Đóng</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>

    function reloaddanhsach(){
        // reload để hiển thị
        $.ajax({
            url: "views/quanli/hoadon/danhsach.php",
            success: function(result){
                $("#danhsachhoadon").html(result);
            }
        });
    }


    $(document).ready(function(){
       
        $('#delete_hoadon').click(function (e) {
            var mahoadon = $(this).closest('.onRow').find('td:nth-child(2)').text().trim();
            document.getElementById("mahoadonxoa").value = $(this).closest('.onRow').find('td:nth-child(2)').text().trim();
        });

    
        // xóa
        $("#formxoahoadon").on('submit', function(event){
            event.preventDefault();

            if($("#mahoadonxoa").val() != ''){
                // lấy dữ liệu trong các ô input
                var form_data = $(this).serialize();
 
                $.ajax({
                    url: "views/quanli/hoadon/huyhoadon.php",
                    method: "POST",
                    data: form_data,
                    success: function(data){
                        $(".save").addClass("d-none");
                        Swal.fire({
                            // position: 'top-end',
                            icon: 'success',
                            title: 'Đã Xóa',
                            showConfirmButton: false,
                            timer: 1500
                        });
                    }
                });
            }else{
                Swal.fire({
                    title: 'Error!',
                    title: 'Không nhận đủ thông tin',
                    icon: 'error',
                    confirmButtonText: 'Đóng'
                });
            }
        });

        $(".dongform").click(function(){
            reloaddanhsach();
        });

    });
</script>