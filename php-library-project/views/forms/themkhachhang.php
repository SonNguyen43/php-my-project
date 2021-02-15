<div class="card mb-3 shadow-bm">
    <div class="card-body pb-0">
        <form method="post" id="form-themkhachhang">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="">Tên khách hàng: </label>    
                        <input type="text" required name="tenkhachhang" id="tenkhachhangthem"><div style="margin-top:-25px"><i class="fas fa-signature"></i></div>
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
                        <label for="">Địa chỉ: </label>    
                        <input type="text" required name="diachi" id="diachithem"><div style="margin-top:-25px"><i class="fas fa-map-marker-alt"></i></div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="">Email: </label>    
                        <input type="email" required name="email" id="emailthem"><div style="margin-top:-25px"><i class="fas fa-envelope-open"></i></div>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-success" value="Thêm mới">
            </div>
        </form>
    </div>
</div>


<script>
    $(document).ready(function(){
        $("#form-themkhachhang").on('submit', function(event){
            event.preventDefault();

            if($("#tenkhachhangthem").val() != '' && $("#tenkhachhangthem").val().trim() != 0
                && $("#sodienthoaithem").val() != '' && $("#sodienthoaithem").val().trim() != 0
                && $("#diachithem").val() != '' && $("#diachithem").val().trim() != 0
                && $("#ngaysinhthem").val() != '' && $("#ngaysinhthem").val().trim() != 0
                && $("#gioitinh").val() != ''){
                // lấy dữ liệu trong các ô input
                var form_data = $(this).serialize();
                // thêm 
                $.ajax({
                    url: "views/quanli/khachhang/them.php",
                    method: "POST",
                    data: form_data,
                    success: function(data){
                        // reload để hiển thị
                        $("#danhsachkhachhang").load("views/quanli/khachhang/danhsach.php");
                        //load thông tin
                        $("#thongtin").load("views/quanli/khachhang/thongtin.php");

                        Swal.fire({icon: 'success', title: 'Đã thêm khách hàng', showConfirmButton: false,  timer: 1500  });
                    }
                });
            }else{
                Swal.fire({ title: 'Error!',title: 'Vui lòng điền đầy đủ thông tin', icon: 'error', confirmButtonText: 'Đóng'})
            }
        });
    });
</script>


