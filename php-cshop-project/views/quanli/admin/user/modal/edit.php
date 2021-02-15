<!-- Modal -->
<div class="modal fade" id="modal_edit_user" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-edit"></i> Sửa Người Dùng </h5>
                <button type="button" class="close close_form" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" id="form_edit_user">
                    <div class="form-group">
                        <input type="text" name="id" id="user_id_edit" class="p-0 d-none">
                        <label for="">Tên Hiển Thị</label>  
                        <input type="text" class="form-control" name="display_name" id="display_name_edit" required>
                    </div>
                    <div class="form-group">
                        <label for="">Email</label>  
                        <input type="email" class="form-control" name="email" id="user_email_edit" required>
                    </div>
                    <div class="form-group">
                        <label for="">Số Điện Thoại</label>  
                        <input type="number" class="form-control" name="phone_number" id="user_phone_number_edit" required>
                    </div>
                    <div class="form-group">
                        <label for="">Giới Tính</label>  
                        <input type="text" class="form-control" name="sex" id="user_sex_edit" required>
                    </div>
                    <div class="form-group">
                        <label for="">Ngày Sinh</label>  
                        <input type="date" class="form-control" name="birthday" id="user_birthday_edit" required>
                    </div>
                    <div class="form-group">
                        <label for="">Địa Chỉ Giao Hàng</label>  
                        <textarea class="form-control" name="ship_address" id="user_ship_address_edit" required></textarea>
                    </div>
                    <div class="float-right">
                        <button type="sumit" class="btn btn-outline-primary submit">Sửa</button>
                        <button type="button" class="btn btn-dark close_form" data-dismiss="modal">Đóng</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.js"></script>
<script>
    $(document).ready(function(){
        $("#form_edit_user").on('submit', function(event){
            // không load lại trang
            event.preventDefault();
            if($("#user_id_edit").val() != '' 
                && $("#display_name_edit").val() != '' && $("#display_name_edit").val().trim() != 0
                && $("#user_email_edit").val() != '' && $("#user_email_edit").val().trim() != 0
                && $("#user_phone_number_edit").val() != '' && $("#user_phone_number_edit").val().trim() != 0
                && $("#user_sex_edit").val() != '' && $("#user_sex_edit").val().trim() != 0
                && $("#user_birthday_edit").val() != '' && $("#user_birthday_edit").val().trim() != 0 
                && $("#user_ship_address_edit").val() != '' && $("#user_ship_address_edit").val().trim() != 0){
                
                var form_data = $(this).serialize();

                    $.ajax({
                        url: "controllers/user_controller.php?yeucau=sua",
                        method: "POST",
                        data: form_data,
                        success: function(data){
                            $(".submit").css("display", "none");
                            // thêm xong tự load
                            $(".close_form").click(function(){
                                $("#list_user").load("views/quanli/admin/user/list.php");
                                $("#statistical").load("views/quanli/admin/user/form/statistical.php");
                            });

                            Swal.fire({icon: 'success',title: 'Đã thay đổi thông tin',showConfirmButton: false,timer: 1500});
                        }
                    });
            }else{
                Swal.fire({icon: 'error',title: 'Không nhận được thông tin',showConfirmButton: false,timer: 1500});
            }
        });
    });
</script>

