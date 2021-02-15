<div class="card mb-3 shadow-bm">
    <div class="card-body">
        <form method="post" id="form-themdanhmuc">
            <!-- <h3 class="text-primary" style="font-family: 'Baloo Bhai', cursive;">Thêm Danh Mục</h3> -->
            <div class="form-group">
                <label for="">Tên danh mục: </label>    
                <input type="text" required name="tenloaisach" id="tenloaisachthem"><div style="margin-top:-25px"><i class="fas fa-plus-circle text-success"></i></div>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-success" value="Thêm mới">
            </div>
        </form>
    </div>
</div>


<script>
    $(document).ready(function(){
        $("#form-themdanhmuc").on('submit', function(event){
            event.preventDefault();

            if($("#tenloaisachthem").val() != '' && $("#tenloaisachthem").val().trim() != 0){
                // lấy dữ liệu trong các ô input
                var form_data = $(this).serialize();

                // thêm 
                $.ajax({
                    url: "views/quanli/danhmuc/them.php",
                    method: "POST",
                    data: form_data,
                    success: function(data){
                        // làm trống ô nhập
                        $('#form-themdanhmuc')[0].reset();

                        // alert thông báo
                        Swal.fire({icon: 'success', title: 'Đã thêm danh mục mới', showConfirmButton: false,  timer: 1500  });

                         // reload để hiển thị
                         $("#danhsachdanhmuc").load("views/quanli/danhmuc/danhsach.php");
                    }
                });
            }else{
                $('#form-themdanhmuc')[0].reset();
                Swal.fire({  title: 'Error!', title: 'Vui lòng điền đầy đủ thông tin', icon: 'error',confirmButtonText: 'Đóng'})
            }
        });
    });
</script>


