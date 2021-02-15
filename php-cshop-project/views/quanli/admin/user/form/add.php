<div class="card mt-3 mb-3 shadow-bulma border-warning">
    <div class="card-body">
        <form method="post" id="form_add_user_for_admin">
        <h3>Thêm người dùng</h3>
            <div class="form_group">
                <div class="row">
                    <div class="input-group mt-3 col-md-6">
                        <input type="text" class="form-control" name="user_name" id="user_name" aria-describedby="inputGroupPrepend" required placeholder="Tên người dùng">
                    </div>
                    <div class="input-group mt-3 col-md-6">
                        <input type="password" class="form-control" name="password" id="password" aria-describedby="inputGroupPrepend" required placeholder="Mật khẩu">
                    </div>
                    <div class="input-group mt-3 col-md-6">
                        <input type="text" class="form-control" name="display_name" id="display_name" aria-describedby="inputGroupPrepend" required placeholder="Tên hiển thị">
                    </div>
                    <div class="input-group mt-3 col-md-6">
                        <input type="email" class="form-control" name="email" id="email" aria-describedby="inputGroupPrepend" required placeholder="Email">
                    </div>
                    <div class="input-group mt-3 col-md-6">
                        <input type="number" class="form-control" name="phone_number" id="phone_number" aria-describedby="inputGroupPrepend" required placeholder="SĐT">
                    </div>
                    <div class="input-group mt-3 col-md-6">
                        <input type="text" class="form-control" name="sex" id="sex" aria-describedby="inputGroupPrepend" required placeholder="Giới Tính">
                    </div>
                    <div class="input-group mt-3 col-md-6">
                        <input type="date" class="form-control" name="birthday" id="birthday" aria-describedby="inputGroupPrepend" required placeholder="Ngày sinh">
                    </div>
                    <div class="input-group mt-3 col-md-6">
                        <input type="text" class="form-control" name="ship_address" id="ship_address" aria-describedby="inputGroupPrepend" required placeholder="Địa chỉ GH">
                    </div>
                </div>
            </div>
            <div class="form-group mt-3">
                <input type="submit" class="btn btn-success " value="Thêm mới">
            </div>
        </form>
    </div>
</div>

<!-- JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.js"></script>
<script>
    $(document).ready(function(){
        $("#form_add_user_for_admin").on('submit', function(event){
            // không load lại trang
             event.preventDefault();
            if($("#user_name").val() != '' && $("#user_name").val().trim() != 0
                && $("#password").val() != '' && $("#password").val().trim() != 0
                && $("#display_name").val() != '' && $("#display_name").val().trim() != 0
                && $("#email").val() != '' && $("#email").val().trim() != 0
                && $("#phone_number").val() != '' && $("#phone_number").val().trim() != 0
                && $("#sex").val() != '' && $("#sex").val().trim() != 0
                && $("#birthday").val() != '' && $("#birthday").val().trim() != 0
                &&  $("#ship_address").val() != '' && $("#ship_address").val().trim() != 0){
               
               var form_data = $(this).serialize();

                $.ajax({
                    url: "controllers/user_controller.php?yeucau=dangkichoadmin",
                    method: "POST",
                    data: form_data,
                    success: function(data){
                        // làm trống ô nhập
                        $('#form_add_user_for_admin')[0].reset();
                        // thêm xong tự load
                        $("#list_user").load("views/quanli/admin/user/list.php");
                        $("#statistical").load("views/quanli/admin/user/form/statistical.php");

                        Swal.fire({icon: 'success',title: 'Đã thêm',showConfirmButton: false,timer: 1500});
                    }
                });
            }else{
                $('#form_add_user_for_admin')[0].reset();
                Swal.fire({icon: 'error',title: 'Không nhận được thông tin',showConfirmButton: false,timer: 1500});
            }
        });
    });
</script>



