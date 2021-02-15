<div class="card mb-3 shadow-bm" id="cardthemhoadon">
    <div class="card-body">
    <div class="text-center mb-3">
            <h4>Lập Hóa Đơn</h4>
        </div>
        <form method="post" id="formtaohoadon" class="text-left">
            <!-- <h3 class="text-primary" style="font-family: 'Baloo Bhai', cursive;">Thêm Nhân Viên</h3> -->
            <div class="form-group">
                <label for="">Mã Nhân Viên: <i>(đang đăng nhập)</i> </label>    
                <input type="search" name="manhanvien" id="manhanvienthem" value="<?php echo $_SESSION['nhanvien']; ?>" readonly><div style="margin-top:-25px"><i class="fas fa-sort-numeric-down"></i></div>
            </div>
            <div class="form-group">
                <label for="">Mã Khách Hàng: </label>    
                <input type="search" name="makhachhang" id="makhachhangthem"><div style="margin-top:-25px"><i class="fas fa-sort-numeric-down"></i></div>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-success mt-3" id="themmoihoadon">Thêm mới</button>
            </div>
        </form>
    </div>
</div>

<div class="card mb-3 pb-3 shadow-sm" id="cardthemsanpham">
</div>


<script>
    $(document).ready(function(){
        $('#cardthemsanpham').css('display','none');
        
        $("#formtaohoadon").on('submit', function(event){
            event.preventDefault();

            if($("#makhachhangthem").val() != '' && $("#makhachhangthem").val().trim() != 0){
 
                // lấy dữ liệu trong các ô input
                var form_data = $(this).serialize();

                // thêm 
                $.ajax({
                    url: "views/quanli/hoadon/themsanpham.php",
                    method: "POST",
                    data: form_data,
                    dataType: 'json',
                    success: function(data){
                        if(data.result == "1"){
                            $('#cardthemhoadon').css('display','none');

                            $('#cardthemsanpham').css('display','inline-block');
                            $("#cardthemsanpham").load("views/quanli/hoadon/cardthemsanpham.php");
                        }else{
                            // alert thông báo
                            Swal.fire({
                                title: 'Error!',
                                title: 'Không tìm thấy thông tin khách hàng này',
                                icon: 'error',
                                confirmButtonText: 'Đóng'
                            });
                        }
                    }
                });
            }else{
                $('#formtaohoadon')[0].reset();
                Swal.fire({
                    title: 'Error!',
                    title: 'Vui lòng điền đầy đủ thông tin',
                    icon: 'error',
                    confirmButtonText: 'Đóng'
                })
            }
        });
    });
</script>


