<?php
    // require './models/nhanvien.php';

    $nhanvien = new nhanvien();

    $thongtin = $nhanvien->thongtinnhanvienbangmanhanvien($_SESSION['nhanvien']);

    if($thongtin->type == 'admin'){
?>

<div class="card mb-3 shadow-bm">
    <div class="card-body pb-0">
        <form method="post" id="form-themnhanvien">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="">Tên nhân viên: </label>    
                    <input type="text" required name="tennhanvien" id="tennhanvienthem"><div style="margin-top:-25px"><i class="fas fa-signature"></i></div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="">Giới tính: </label> 
                    <select required name="gioitinh" id="gioitinhthem">
                        <option value="Nam">Nam</option>
                        <option value="Nữ">Nữ</option>
                    </select>   
                    <div style="margin-top:-25px"><i class="fas fa-genderless"></i></div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="">Ngày sinh: </label>    
                    <input type="date" required name="ngaysinh" id="ngaysinhthem"><div style="margin-top:-25px"><i class="fas fa-birthday-cake"></i></div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="">Số điện thoại: </label>    
                    <input type="number" required name="sodienthoai" id="sodienthoaithem"><div style="margin-top:-25px"><i class="fas fa-phone-volume"></i></div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="">Mật khẩu: </label>    
                    <input type="password" required name="matkhau" id="matkhauthem"><div style="margin-top:-25px"><i class="fas fa-unlock-alt"></i></div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="">Trạng thái làm việc: </label> 
                    <select required name="trangthailamviec" id="trangthailamviecthem">
                        <option value="Còn Làm">Còn Làm</option>
                        <option value="Nghĩ Làm">Nghĩ Làm</option>
                    </select>   
                    <div style="margin-top:-25px"><i class="fas fa-genderless"></i></div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <label for="">Địa chỉ: </label>    
                    <input type="text" required name="diachi" id="diachithem"><div style="margin-top:-25px"><i class="fas fa-map-marker-alt"></i></div>
                </div>
            </div>
        </div>
            <div class="form-group">
                <input type="submit" class="btn btn-success" value="Thêm mới">
            </div>
        </form>
    </div>
</div>

    <?php }?>


<script>
    $(document).ready(function(){

        $("#sodienthoaithem").on('keyup', function(){
            var sodienthoaithem = $("#sodienthoaithem").val();

            // kiểm tra
            $.ajax({
                url: "views/quanli/nhanvien/checksodienthoai.php",
                method: "POST",
                data:{sodienthoaithem: sodienthoaithem},
                dataType:"json",
                success: function(data){
                    if (data.result == "0") {
                        $('#sodienthoaithem').css('border-bottom','2px solid red');

                        Swal.fire({ title: 'Đã Tồn Tại Số Điện Thoại Này', icon: 'error', confirmButtonText: 'Đóng' })
                    }else{
                        $('#sodienthoaithem').css('border-bottom','1px solid #000');
                    }
                },
            });
        })

        $("#form-themnhanvien").on('submit', function(event){
            event.preventDefault();

            if($("#tennhanvienthem").val() != '' && $("#tennhanvienthem").val().trim() != 0
                && $("#matkhauthem").val() != '' && $("#matkhauthem").val().trim() != 0
                && $("#sodienthoaithem").val() != '' && $("#sodienthoaithem").val().trim() != 0
                && $("#diachithem").val() != '' && $("#diachithem").val().trim() != 0
                && $("#ngaysinhthem").val() != '' && $("#ngaysinhthem").val().trim() != 0
                && $("#gioitinh").val() != ''){
                // lấy dữ liệu trong các ô input
                var form_data = $(this).serialize();
                // thêm 
                $.ajax({
                    url: "views/quanli/nhanvien/them.php",
                    method: "POST",
                    data: form_data,
                    dataType:"json",
                    success: function(data){
                        if (data.result == "0") {
                            $('#manhanvienthem').css('border-bottom','2px solid red');
                            Swal.fire({ title: 'Đã Tồn Tại Số Điện Thoại Này',  icon: 'error', confirmButtonText: 'Đóng' })
                        }else{
                            Swal.fire({icon: 'success',  title: 'Đã thêm nhân viên mới',    showConfirmButton: false, timer: 1500 })
                        }
                    }
                });
                
                // reload để hiển thị
                $("#danhsachnhanvien").load("views/quanli/nhanvien/danhsach.php");
            }else{
                Swal.fire({ title: 'Error!',title: 'Vui lòng điền đầy đủ thông tin', icon: 'error', confirmButtonText: 'Đóng'})
            }
        });
    });
</script>


