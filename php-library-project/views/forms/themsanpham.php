<?php
    require "models/danhmuc.php";

    $danhmuc = new danhmuc();
    $danhsachdanhmuc = $danhmuc->tatcadanhmuc();
?>

<div class="card mb-3 shadow-bm">
    <div class="card-body pb-0">
        <form method="post" id="form-themsanpham">
            <!-- <h3 class="text-primary" style="font-family: 'Baloo Bhai', cursive;">Thêm Nhân Viên</h3> -->
            <div class="form-group">
                <label for="">Tên sản phẩm: </label>    
                <input type="text" required name="tensanpham" id="tensanphamthem"><div style="margin-top:-25px"><i class="fas fa-sort-numeric-down"></i></div>
            </div>
            <div class="form-group">
                <label for="">Gía sản phẩm: </label>    
                <input type="number" required name="gia" id="giathem"><div style="margin-top:-25px"><i class="fas fa-key"></i></div>
            </div>
            <div class="form-group">
                <label for="">Danh mục: </label> 
                <select id="inlineFormCustomSelect" required name="madanhmuc" id="madanhmucthem">
                    <?php
                        foreach ($danhsachdanhmuc as $dsdm) {
                            ?>
                                <option value="<?php echo $dsdm->MaDanhMuc; ?>"><?php echo $dsdm->TenDanhMuc;?></option>
                            <?php
                        }
                    ?>
                </select>   
                <div style="margin-top:-25px"><i class="fas fa-genderless"></i></div>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-success" value="Thêm mới">
            </div>
        </form>
    </div>
</div>


<script>
    $(document).ready(function(){
        $("#form-themsanpham").on('submit', function(event){
            event.preventDefault();

            if($("#tensanphamthem").val() != '' && $("#tensanphamthem").val().trim() != 0 
                && $("#giathem").val() != '' && $("#giathem").val().trim() != 0
                && $("#madanhmucthem").val() != ''){

                // lấy dữ liệu trong các ô input
                var form_data = $(this).serialize();

                // thêm 
                $.ajax({
                    url: "views/quanli/sanpham/them.php",
                    method: "POST",
                    data: form_data,
                    success: function(data){
                        $('#form-themsanpham')[0].reset();

                        // alert thông báo
                        Swal.fire({
                            // position: 'top-end',
                            icon: 'success',
                            title: 'Đã thêm sản phẩm mới',
                            showConfirmButton: false,
                            timer: 1500
                        });

                        // // reload để hiển thị
                        $.ajax({
                            url: "views/quanli/sanpham/danhsach.php",
                            success: function(result){
                                $("#danhsachsanpham").html(result);
                            }
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
    });
</script>


