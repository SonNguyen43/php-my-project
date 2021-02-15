<!-- Modal -->
<div class="modal fade" id="edit_category" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-edit"></i> Sửa Danh Mục</h5>
                <button type="button" class="close close_form" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" id="form_edit_category">
                    <div class="form-group">
                        <input type="text" name="id" id="catagory_id_edit" class="p-0 d-none">
                        <label for="">Tên danh mục:</label>  
                        <input type="text" class="form-control" name="name" id="category_name_edit" required>
                    </div>
                    <div class="form-group">
                        <label for="">Hình ảnh:</label>  
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="image_edit" name="image" accept="image/*">
                            <label class="custom-file-label">Chọn để thay đổi...</label>
                            <div class="invalid-feedback">Example invalid custom file feedback</div>
                        </div>
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
<script>
    $(document).ready(function(){
        $("#form_edit_category").on('submit', function(event){
            // không load lại trang
            event.preventDefault();
            if($("#catagory_id_edit").val() != '' && $("#category_name_edit").val() != '' && $("#category_name_edit").val().trim() != 0){
                
                var file = $('#image_edit').prop('files')[0];

                // có ảnh
                if(typeof file === 'object' && file.constructor === File){
                    //Lấy ra files
                    var file_data = $('#image_edit').prop('files')[0];
                    //lấy ra kiểu file
                    var type = file_data.type;
                    //khởi tạo đối tượng form data
                    var form_data = new FormData();
                    //thêm files vào trong form data
                    form_data.append('image', file_data);
                    form_data.append('id', $("#catagory_id_edit").val());
                    form_data.append('name', $("#category_name_edit").val());

                    $.ajax({
                        url: "controllers/category_controller.php?yeucau=sua_anh",
                        method: "POST",
                        dataType: 'text',
                        data: form_data,
                        cache: false,
                        contentType: false,
                        processData: false,
                        success: function(data){
                            $(".submit").css("display", "none");
                            // thêm xong tự load
                            $(".close_form").click(function(){
                                $("#list_category").load("views/quanli/admin/category/list.php");
                            });

                            Swal.fire({icon: 'success',title: 'Thay đổi thành công',showConfirmButton: false,timer: 1500});
                            $("#statistical").load("views/quanli/admin/category/form/statistical.php");
                        }
                    });
                }else{
                    // không ảnh
                    var form_data = $(this).serialize();    
                    $.ajax({
                        url: "controllers/category_controller.php?yeucau=sua",
                        method: "POST",
                        data: form_data,
                        success: function(data){
                            $(".submit").css("display", "none");

                            $(".close_form").click(function(){
                                $("#list_category").load("views/quanli/admin/category/list.php");
                            });
                            Swal.fire({icon: 'success',title: 'Thay đổi thành công',showConfirmButton: false,timer: 1500});
                            $("#statistical").load("views/quanli/admin/category/form/statistical.php");
                        }
                    });
                }
            }else{
                Swal.fire({icon: 'error',title: 'Không nhận đủ thông tin',showConfirmButton: false,timer: 1500});
            }
        });
    });
</script>