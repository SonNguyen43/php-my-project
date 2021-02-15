<style>
    input[type='text'], input[type='email'], input[type='date'],input[type='password'], input[type='number'], select{
        width: 100%;
        border: 0;
        outline: none;
    }

    input[type='text']:hover, input[type='email']:hover, input[type='date']:hover, input[type='password']:hover, input[type='number']:hover, select:hover{
        border-bottom: 1px solid gray;
    }

    input[type='text']:focus, input[type='email']:focus, input[type='date']:focus, input[type='password']:focus, input[type='number']:focus, select:focus{
        border-bottom: 1px solid #000;
    }
    .ChangeAvatar{
        opacity: 0;
        top: 0;
        right: 0;
        width: 150px;
        height: 75px;
        line-height: 75px;
        margin-top: 15px;
        font-size: 20px;
        background: #000;
        border-radius: 0 0 150px 150px;
        transition: .4s ease-in;
        z-index: 1s linear;
        cursor: pointer;
    }
    .avatar:hover ~ .ChangeAvatar{
        opacity: 1;
    }
    .ChangeAvatar:hover{
        opacity: 1;
    }
</style>

<?php 
    $user = new User();
    $user_id = $_SESSION['user'];

    $user_info = $user->UserInfo($user_id);
?>

<!-- THÔNG TIN TÀI KHOẢN -->
<div id="user_info" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
    <div class="card mb-3 shadow-bulma">
        <div class="card-body">
            <div class="row">
                <div class="col-md-12 text-center">
                    <!-- avatar -->
                    <div class="img d-inline position-relative">
                        <img src="<?php if($user_info->avatar == "noImage.png") echo './public/images/noImage.png' ; else echo './views/quanli/user/avatar/'.$user_info->avatar; ?>" alt="" width="150px" height="150px" id="avatar" class="rounded-circle"> 
                        
                        <div class="text-center text-light border position-absolute ChangeAvatar" data-toggle="modal" data-target="#ChangeAvatar">
                            <i class="fas fa-camera" aria-hidden="false"></i> Đổi ảnh
                        </div>
                    </div>  <!-- end avatar -->

                    <!-- modal -->
                    <div class="modal fade text-left" id="ChangeAvatar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="z-index: 2500">
                        <div class="modal-dialog modal-dialog-centered " role="document">
                            <div class="modal-content border">
                                <form method="POST" accept-charset="UTF-8" enctype="multipart/form-data" id="FormChangeAvatar">
                                    <div class="modal-body">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>   
                                        <label for="">Chọn ảnh</label>
                                        <br>
                                        <input class="personal border-top-0 border-left-0 border-right-0 w-100 d-none" style="font-size:20px;" id="user_id" name="id" type="text" value="<?php echo $_SESSION['user']?>">
                                        <div class="custom-file mt-3 mb-3">
                                            <input accept="image/*" class="custom-file-input" id="chooseImage" name="avatar" type="file" required>
                                            <label class="custom-file-label" for="chooseImage">Chọn file ảnh...</label>
                                            <div class="invalid-feedback">Example invalid custom file feedback</div>
                                        </div>
                                        <div>
                                            <label for="">Xem trước</label><br>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="d-flex justify-content-center">
                                                        <img id="root_img" src="" style="width: 150px; height: 150px; border-radius: 150px" class="shadow-sm border">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                                        <button class="btn btn-success" id="submitChangeAvatar" type="submit">Thay đổi</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div> <!-- end modal -->

                </div>
            </div>

            <form method="post" id="change_info_user">
                <h3 class="text-center mt-3">Thay đổi thông tin cá nhân</h3>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Tên tài khoản:</label>
                            <input type="text" value="<?php echo $user_info->user_name;?>" disabled title="Không thể thay đổi">

                            <input type="text" name="id" id="user_id_change" value="<?php echo $user_info->id;?>" class="d-none">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Tên hiển thị:</label>
                            <input type="text" id="display_name_change" name="display_name" value="<?php echo $user_info->display_name;?>">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Email:</label>
                            <input type="email" id="email_change" name="email" value="<?php echo $user_info->email;?>">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Số điện thoại:</label>
                            <input type="number" id="phone_number_change" name="phone_number" value="<?php echo $user_info->phone_number;?>">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Giới tính:</label>
                            <select class="" id="" name="sex">
                                <option value="Nam" <?php if($user_info->sex == 'Nam') echo 'selected'?>>Nam</option>
                                <option value="Nữ" <?php if($user_info->sex == 'Nữ') echo 'selected'?>>Nữ</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Ngày sinh:</label>
                            <input type="date" id="birthday_change" name="birthday" value="<?php echo $user_info->birthday;?>">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="">Địa chỉ giao hàng:</label>
                            <input type="text" id="ship_address_change" name="ship_address" value="<?php echo $user_info->ship_address;?>">
                        </div>
                    </div>
                </div>
                <div>
                    <input type="submit" value="Thay đổi" class="btn btn-success">
                </div>
            </form>
        </div>
    </div>
</div>  <!-- END THÔNG TIN TÀI KHOẢN -->

<!-- MẬT KHẨU -->
<div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
    <div class="card mb-3 shadow-bulma">
        <div class="card-body">
            <form method="post" id="change_password">
                <h3>Thay đổi thông mật khẩu</h3>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                        <input type="text" name="id" value="<?php echo $user_info->id;?>" class="d-none">

                            <label for="">Mật khẩu cũ:</label>
                            <input type="password" id="password_old_change" name="password" placeholder="ex: ****">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Mật khẩu mới</label>
                            <input type="password" id="password_new_change" name="password_new" placeholder="ex: ****">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Xác nhận:</label>
                            <input type="password" id="password_new_confirm_change" name="password_new_confirm" placeholder="ex: ****">
                        </div>
                    </div>
                </div>
                <div>
                    <input type="submit" value="Thay đổi" class="btn btn-success">
                </div>
            </form>
        </div>
    </div>
</div>  <!-- END MẬT KHẨU-->

<!-- PHẢN HỒI -->
<div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
    <div class="card shadow-bulma mb-3">
        <div class="card-body">
            <form method="post" id="add_feedback">
                <h3>Phản hồi</h3>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="">Ý kiến của bạn:</label>
                            <input type="text" name="id" value="<?php echo $user_info->id;?>" class="d-none">
                            <textarea name="content" id="content" cols="30" rows="10" class="form-control"></textarea>
                        </div>
                    </div>
                </div>
                <div>
                    <input type="submit" value="Gửi đi" class="btn btn-success">
                </div>
            </form>
        </div>
    </div>
</div>  <!-- END PHẢN HỒI -->


<!-- JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.js"></script>
<script>
    $(document).ready(function(){
        // THÔNG TIN TÀI KHOẢN
        $("#change_info_user").on('submit', function(event){
            // không load lại trang
             event.preventDefault();

            if($("#user_id_change").val() != '' && $("#birthday_change").val() != ''
                && $("#display_name_change").val() != '' && $("#display_name_change").val().trim() != 0
                && $("#email_change").val() != '' && $("#email_change").val().trim() != 0
                && $("#phone_number_change").val() != '' && $("#phone_number_change").val().trim() != 0
                && $("#ship_address_change").val() != '' && $("#ship_address_change").val().trim() != 0){
               
               var form_data = $(this).serialize();

                $.ajax({
                    url: "controllers/user_controller.php?yeucau=sua",
                    method: "POST",
                    data: form_data,
                    success: function(data){
                        Swal.fire({icon: 'success',title: 'Đã thay đổi',showConfirmButton: false,timer: 1500});
                    }
                });
            }else{
                Swal.fire({icon: 'error',title: 'Không nhận được thông tin',showConfirmButton: false,timer: 1500});
            }
        });

        // MẬT KHẨU
        $("#change_password").on('submit', function(event){
            // không load lại trang
             event.preventDefault();

            if($("#password_old_change").val() != '' && $("#password_old_change").val().trim() != 0
                && $("#password_new_change").val() != '' && $("#password_new_change").val().trim() != 0
                && $("#password_new_confirm_change").val() != '' && $("#password_new_confirm_change").val().trim() != 0){
               
                var form_data = $(this).serialize();

                if($("#password_new_change").val() == $("#password_new_confirm_change").val()){
                    $.ajax({
                        url: "controllers/user_controller.php?yeucau=suamatkhau",
                        method: "POST",
                        data: form_data,
                        dataType:"json",
                        success: function(data){
                            if (data.result == "0") {
                                Swal.fire({icon: 'error',title: 'Mật khẩu cũ không đúng',showConfirmButton: false,timer: 1500});
                            }else{
                                $('#change_password')[0].reset();
                                Swal.fire({icon: 'success',title: 'Đã thay đổi',showConfirmButton: false,timer: 1500});
                            }
                        }
                    });
                }else{
                    Swal.fire({icon: 'error',title: 'Mật khẩu xác nhận không trùng',showConfirmButton: false,timer: 1500});
                }
            }else{
                Swal.fire({icon: 'error',title: 'Không nhận được thông tin',showConfirmButton: false,timer: 1500});
            }
        });

        // PHẢN HỒI
        $("#add_feedback").on('submit', function(event){
            // không load lại trang
             event.preventDefault();

            if($("#content").val() != '' && $("#content").val().trim() != 0){
               
                var form_data = $(this).serialize();

                $.ajax({
                    url: "controllers/feedback_controller.php?yeucau=them",
                    method: "POST",
                    data: form_data,
                    success: function(data){
                        $('#add_feedback')[0].reset();
                        Swal.fire({icon: 'success',title: 'Đã ghi nhận',showConfirmButton: false,timer: 1500});
                    }
                });
            }else{
                Swal.fire({icon: 'error',title: 'Không nhận được thông tin',showConfirmButton: false,timer: 1500});
            }
        });

        // THAY ẢNH
        $("#FormChangeAvatar").on('submit', function(event){
            // không load lại trang
            event.preventDefault();

            //Lấy ra files
            var file_data = $('#chooseImage').prop('files')[0];
            //lấy ra kiểu file
            var type = file_data.type;
            //khởi tạo đối tượng form data
            var form_data = new FormData();
            //thêm files vào trong form data
            form_data.append('avatar', file_data);
            form_data.append('user_id', $('#user_id').val());

            $.ajax({
                url: "controllers/user_controller.php?yeucau=doiavatar",
                method: "POST",
                dataType: 'text',
                data: form_data,
                cache: false,
                contentType: false,
                processData: false,
                dataType:"json",
                success: function(data){

                    if (data.result != '') {
                        document.getElementById('avatar').src = './views/quanli/user/avatar/' + data.result;
                        document.getElementById('avatar_navbar').src = './views/quanli/user/avatar/' + data.result;
                    }
                }
            });
           
        });
    });

    /* Show ảnh khi đã chọn */
    let chooseImage = document.getElementById("chooseImage");
    let root_img = document.getElementById("root_img");

    chooseImage.addEventListener('change', (e) =>{
        root_img.src = URL.createObjectURL(e.target.files[0]); 
    });
</script>
