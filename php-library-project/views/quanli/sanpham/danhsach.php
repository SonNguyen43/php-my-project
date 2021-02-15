<?php
    require "../../../models/danhmuc.php";
    require "../../../models/sanpham.php";

    $stt= 1;
    $sanpham = new sanpham();
    $danhsachsanpham = $sanpham->tatcasanpham();

    $danhmuc = new danhmuc();
    $danhsachdanhmuc = $danhmuc->tatcadanhmuc();
?>

<div class="table-responsive mb-3">
    <table class="table table-hover table-striped table-light text-center table-bordered" id="tablesanpham">
        <thead>
            <tr>
                <th>#</th>
                <th>Mã</th>
                <th>Tên_Sản_Phẩm</th>
                <th>Giá</th>
                <th>Danh_Mục</th>
                <th>Chức_Năng</th>
            </tr>
        </thead>
        <tbody>
            <?php
                foreach ($danhsachsanpham as $ds) {
                    $color = rand(1, 7);
                    ?>
                        <tr class="onRow">
                            <td><?php echo $stt++; ?></td>
                            <td><?php echo $ds->MaSanPham; ?></td>
                            <td>
                                <?php 
                                    switch ($color) {
                                        case '1':
                                            echo "<b><span class='text-primary'>".$ds->TenSanPham."</span></b>"; 
                                            break;
                                        case '2':
                                            echo "<b><span class='text-secondary'>".$ds->TenSanPham."</span></b>"; 
                                            break;
                                        case '3':
                                            echo "<b><span class='text-success '>".$ds->TenSanPham."</span></b>"; 
                                            break;
                                        case '4':
                                            echo "<b><span class='text-danger '>".$ds->TenSanPham."</span></b>"; 
                                            break;
                                        case '5':
                                            echo "<b><span class='text-warning '>".$ds->TenSanPham."</span></b>"; 
                                            break;
                                        case '6':
                                            echo "<b><span class='text-info '>".$ds->TenSanPham."</span></b>"; 
                                            break;
                                        case '7':
                                            echo "<b><span class='text-dark '>".$ds->TenSanPham."</span></b>"; 
                                            break;
                                        default:
                                            break;
                                    }
                                ?>
                            </td>
                            <td><?php echo number_format($ds->Gia); ?></td>
                            <td>
                                <?php
                                    # Xử lí trường hợp danh mục đã xóa nhưng sản phẩm vẫn còn 
                                    foreach ($danhsachdanhmuc as $dsdm) {
                                        if($dsdm->MaDanhMuc == $ds->MaDanhMuc){
                                            switch ($dsdm->TenDanhMuc) {
                                                case 'Điện thoại':
                                                case 'Điện Thoại':
                                                    echo "<span class='badge badge-danger'>".$danhmuc->thongtindanhmuc($ds->MaDanhMuc)->TenDanhMuc."</span>"; 
                                                    break;
                                                case 'Máy tính bảng':
                                                case 'Máy Tính Bảng':
                                                    echo "<span class='badge badge-primary'>".$danhmuc->thongtindanhmuc($ds->MaDanhMuc)->TenDanhMuc."</span>"; 
                                                    break;
                                                case 'Laptop':
                                                    echo "<span class='badge badge-warning'>".$danhmuc->thongtindanhmuc($ds->MaDanhMuc)->TenDanhMuc."</span>"; 
                                                    break;
                                                case 'Phụ kiện':
                                                case 'Phụ Kiện':
                                                    echo "<span class='badge badge-success'>".$danhmuc->thongtindanhmuc($ds->MaDanhMuc)->TenDanhMuc."</span>"; 
                                                    break;
                                                default:
                                                    echo "<span class='badge badge-secondary'>".$danhmuc->thongtindanhmuc($ds->MaDanhMuc)->TenDanhMuc."</span>"; 
                                                    break;
                                            }
                                        }
                                    }
                                ?>
                                </td>
                            <td>
                                <button class="btn btn-primary" id="btn-suasanpham" data-toggle="modal" data-target="#suasanpham">Sửa</button>
                                <button class="btn btn-danger" data-toggle="modal" data-target="#xoasanpham">Xóa</button>
                            </td>
                        </tr>
                    <?php
                }
            ?>
        </tbody>
    </table>
</div>


<!-- Modal sửa -->
<div class="modal fade" id="suasanpham" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel"><i class="fas fa-edit text-warning"></i> Sửa Sản Phẩm</h5>
                <button type="button" class="close dongform" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" id="form_suasanpham">
                    <!-- <h3 class="text-primary" style="font-family: 'Baloo Bhai', cursive;">Thêm Nhân Viên</h3> -->
                    <div class="form-group">
                        <label for="">Tên sản phẩm: </label>    
                        <input type="text" required name="masanpham" id="masanphamsua" class="d-none">
                        <input type="text" required name="tensanpham" id="tensanphamsua"><div style="margin-top:-25px"><i class="fas fa-sort-numeric-down"></i></div>
                    </div>
                    <div class="form-group">
                        <label for="">Gía sản phẩm: </label>    
                        <input type="number" required name="gia" id="giasua"><div style="margin-top:-25px"><i class="fas fa-key"></i></div>
                    </div>
                    <div class="form-group">
                        <label for="">Danh mục: </label> 

                        <div id="showmadanhmucsua">
                           
                        </div>   
                        <div style="margin-top:-25px"><i class="fas fa-genderless"></i></div>
                    </div>
                    <div class="form-group float-right">
                        <input type="submit" class="btn btn-outline-primary save" value="Thay Đổi">
                        <button type="button" class="btn btn-secondary dongform" data-dismiss="modal">Đóng</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Model xóa -->
<div class="modal fade" id="xoasanpham" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel"><i class="fas fa-trash-alt text-danger"></i> Xóa sản phẩm</h5>
                <button type="button" class="close save" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" id="form_xoasanpham" class="text-left">
                    <input type="text" name="masanpham" id="masanphamxoa" class="p-0 d-none">
                    <div class="form-group">
                        <label for=""><b>Bạn muốn xóa sản phẩm này:</b></label>
                        <div type="text" name="tensanpham" id="tensanphamxoa" class="p-0 border-0"></div>
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
            url: "views/quanli/sanpham/danhsach.php",
            success: function(result){
                $("#danhsachsanpham").html(result);
            }
        });
    }

    $(document).ready(function(){

        $('#tablesanpham tr').click(function (e) {
            document.getElementById("masanphamxoa").value = $(this).closest('.onRow').find('td:nth-child(2)').text().trim();
            document.getElementById("tensanphamxoa").innerHTML = $(this).closest('.onRow').find('td:nth-child(3)').text().trim();

            var masanpham = document.getElementById("masanphamsua").value = $(this).closest('.onRow').find('td:nth-child(2)').text().trim();
            document.getElementById("tensanphamsua").value = $(this).closest('.onRow').find('td:nth-child(3)').text().trim();
            document.getElementById("giasua").value = $(this).closest('.onRow').find('td:nth-child(4)').text().trim().replace(/,/g, "");
        
            // chọn sẵn danh mục
            $.ajax({
                url: "views/quanli/sanpham/chondanhmuc.php",
                method: "POST",
                data: {masanpham: masanpham},
                success: function(result){
                    $("#showmadanhmucsua").html(result);
                }
            });
        });

        // $('option').attr({
        //     'selected': 'selected',
        // });

        // sửa
        $("#form_suasanpham").on('submit', function(event){
            event.preventDefault();

            if($("#tensanphamsua").val() != '' && $("#tensanphamsua").val().trim() != 0 && $("#masanphamsua").val() != '' && $("#masanphamsua").val().trim() != '' && $("#giasua").val() != ''){
                // lấy dữ liệu trong các ô input
                var form_data = $(this).serialize();

                // sửa 
                $.ajax({
                    url: "views/quanli/sanpham/sua.php",
                    method: "POST",
                    data: form_data,
                    success: function(data){
                        $(".save").addClass("d-none");
                        Swal.fire({
                            // position: 'top-end',
                            icon: 'success',
                            title: 'Đã sửa',
                            showConfirmButton: false,
                            timer: 1500
                        });

                         // load thông tin
                         $("#thongtin").load("views/quanli/sanpham/thongtin.php");
                    }
                });
            }else{
                Swal.fire({
                    title: 'Error!',
                    title: 'Vui lòng điền đầy đủ thông tin',
                    icon: 'error',
                    confirmButtonText: 'Đóng'
                });
            }
        });

        // xóa
        $("#form_xoasanpham").on('submit', function(event){
            event.preventDefault();

            if($("#masanphamxoa").val() != 0){
                // lấy dữ liệu trong các ô input
                var form_data = $(this).serialize();

                // xóa 
                $.ajax({
                    url: "views/quanli/sanpham/xoa.php",
                    method: "POST",
                    data: form_data,
                    success: function(data){
                        $(".save").addClass("d-none");
                        Swal.fire({
                            // position: 'top-end',
                            icon: 'success',
                            title: 'Đã xóa',
                            showConfirmButton: false,
                            timer: 1500
                        });

                        // load thông tin
                        $("#thongtin").load("views/quanli/sanpham/thongtin.php");
                    }
                });
            }else{
                $('#form_suadanhmuc')[0].reset();
                Swal.fire({
                    title: 'Error!',
                    title: 'Không nhận được thông tin',
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
