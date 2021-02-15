<div class="card mt-3 mb-3 shadow-bulma border-warning">
    <div class="card-body">
        <form method="post" id="form_add_category">
        <h3>Thêm danh mục</h3>
            <div class="form_group">
                <div class="input-group">
                    <input type="text" class="form-control" name="name" id="name_caterogy" aria-describedby="inputGroupPrepend" required placeholder="Tên danh mục">
                    <div class="invalid-feedback">
                        Please choose a username.
                    </div>
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="inputGroupPrepend"><i class="fas fa-plus-circle"></i></span>
                    </div>
                </div>
            </div>
            <div class="form-group mt-3">
                <div class="custom-file">
                    <input type="file" class="custom-file-input" id="image_add" required name="image">
                    <label class="custom-file-label" for="image_add">Choose file...</label>
                    <div class="invalid-feedback">Example invalid custom file feedback</div>
                </div>
            </div>
            <div class="form-group mt-3">
                <input type="submit" class="btn btn-success" value="Thêm mới">
            </div>
        </form>
    </div>
</div>

<!-- JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.js"></script>
<script>
    $(document).ready(function(){
        $("#form_add_category").on('submit', function(event){
            // không load lại trang
             event.preventDefault();
            if($("#name_caterogy").val() != '' && $("#name_caterogy").val().trim() != 0){
                // thêm ảnh
                //Lấy ra files
                var file_data = $('#image_add').prop('files')[0];
                //lấy ra kiểu file
                var type = file_data.type;
                //khởi tạo đối tượng form data
                var form_data = new FormData();
                //thêm files vào trong form data
                form_data.append('image', file_data);
                form_data.append('name', $("#name_caterogy").val());

                $.ajax({
                    url: "controllers/category_controller.php?yeucau=them",
                    method: "POST",
                    dataType: 'text',
                    data: form_data,
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: function(data){
                        // làm trống ô nhập
                        $('#form_add_category')[0].reset();
                        // thêm xong tự load
                        $("#list_category").load("views/quanli/admin/category/list.php");

                        Swal.fire({icon: 'success',title: 'Đã thêm',showConfirmButton: false,timer: 1500});
                        $("#statistical").load("views/quanli/admin/category/form/statistical.php");
                    }
                });
            }else{
                $('#form_add_category')[0].reset();
                Swal.fire({icon: 'error',title: 'Vui lòng điền đầy đủ thông tin',showConfirmButton: false,timer: 1500});
            }
        });
    });
</script>



