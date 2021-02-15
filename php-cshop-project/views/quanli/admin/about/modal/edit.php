<!-- Modal -->
<div class="modal fade" id="edit_about" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-edit"></i> Sửa Giới Thiệu </h5>
                <button type="button" class="close close_form" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" id="form_edit_about">
                    <div class="form-group">
                        <input type="text" name="id" id="about_id_edit" class="p-0 d-none">
                        <label for="">Địa Chỉ:</label>  
                        <input type="text" class="form-control" name="address" id="about_address_edit" required>
                    </div>
                    <div class="form-group">
                        <label for="">Số Điện Thoại:</label>  
                        <input type="number" class="form-control" name="phone_number" id="about_phone_number_edit" required>
                    </div>
                    <div class="form-group">
                        <label for="">Email:</label>  
                        <input type="email" class="form-control" name="email" id="about_email_edit" required>
                    </div>
                    <div class="form-group">
                        <label for="">Business_license:</label>  
                        <input type="text" class="form-control" name="business_code" id="about_business_code_edit" required>
                    </div>
                    <div class="form-group">
                        <label for="">Giấy Phép Kinh Doanh:</label>  
                        <textarea class="form-control" name="business_license" id="about_business_license_edit" required></textarea>
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
        $("#form_edit_about").on('submit', function(event){
            // không load lại trang
            event.preventDefault();
            if($("#about_id_edit").val() != '' 
            && $("#about_address_edit").val() != '' && $("#about_address_edit").val().trim() != 0
            && $("#about_phone_number_edit").val() != '' && $("#about_phone_number_edit").val().trim() != 0
            && $("#about_email_edit").val() != '' && $("#about_email_edit").val().trim() != 0
            && $("#about_business_code_edit").val() != '' && $("#about_business_code_edit").val().trim() != 0
            && $("#about_business_license_edit").val() != ''&& $("#about_business_license_edit").val().trim() != 0) {
                
                var form_data = $(this).serialize();

                    $.ajax({
                        url: "controllers/about_controller.php?yeucau=sua",
                        method: "POST",
                        data: form_data,
                        success: function(data){
                            $(".submit").css("display", "none");
                            // thêm xong tự load
                            $(".close_form").click(function(){
                                $("#list_about").load("views/quanli/admin/about/about.php");
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