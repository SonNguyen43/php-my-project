<div class="card mt-3 mb-3 shadow-bulma border-warning">
    <div class="card-body">
        <form method="post" id="form_add_news">
        <h3>Thêm tin mới</h3>
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
        $("#form_add_news").on('submit', function(event){
        // không load lại trang
            event.preventDefault();
            // thêm ảnh
            //Lấy ra files
            var file_data = $('#image_add').prop('files')[0];
            //lấy ra kiểu file
            var type = file_data.type;
            //khởi tạo đối tượng form data
            var form_data = new FormData();
            //thêm files vào trong form data
            form_data.append('image', file_data);

            $.ajax({
                url: "controllers/news_controller.php?yeucau=them_tin_moi",
                method: "POST",
                dataType: 'text',
                data: form_data,
                cache: false,
                contentType: false,
                processData: false,
                success: function(data){
                    Swal.fire({icon: 'success',title: 'Đã thêm',showConfirmButton: false,timer: 1500});
                    $("#list_news").load("views/quanli/admin/news/list.php");
                }
            });
        });
    });
</script>



