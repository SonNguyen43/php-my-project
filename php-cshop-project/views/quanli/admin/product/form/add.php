<?php
    require "./models/category.php";

    $category = new Category();
    $list_caterogy = $category->AllCategory();
?>
<div class="card mt-3 mb-3 shadow-bulma border-warning">
    <div class="card-body">
        <form method="post" id="form_add_product">
        <h3>Thêm sản phẩm</h3>
            <div class="form_group">
                <div class="row">
                    <div class="input-group mt-3 col-md-6">
                        <input type="text" class="form-control" name="name" id="name" aria-describedby="inputGroupPrepend" required placeholder="Tên sản phẩm">
                    </div>
                    <div class="input-group mt-3 col-md-6">
                        <input type="number" class="form-control" name="prices" id="prices" aria-describedby="inputGroupPrepend" required placeholder="Đơn giá">
                    </div>
                    <div class="input-group mt-3 col-md-6">
                        <div class="custom-file">
                            <input name="images[]" type="file" multiple="multiple"  id="image_add" class="custom-file-input"  required/>
                            <label class="custom-file-label" for="validatedCustomFile">Choose file...</label>
                            <div class="invalid-feedback">Example invalid custom file feedback</div>
                        </div>
                    </div>
                    <div class="col-md-6 mt-3">
                        <div class="form-group"> 
                            <select class="form-control" required name="category_id" id="category_id">
                                <?php
                                    foreach ($list_caterogy as $ifls) {
                                        ?>
                                            <option value="<?php echo $ifls->id; ?>"><?php echo $ifls->name;?></option>
                                        <?php
                                    }
                                ?>
                            </select>  
                        </div>
                    </div>  
                </div>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-success " value="Thêm mới">
            </div>
        </form>
    </div>
</div>

<!-- JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.js"></script>
<script>
    $(document).ready(function(){
        $("#form_add_product").on('submit', function(event){
            // không load lại trang
             event.preventDefault();
            if($("#name").val() != '' && $("#name").val().trim() != 0
                && $("#prices").val() != '' && $("#prices").val().trim() != 0){
               
                // FILE
                var file_data = new Array();
                var total_file=document.getElementById("image_add").files.length;
               
                
                //khởi tạo đối tượng form data
                var form_data = new FormData();
                //thêm files vào trong form data
                // form_data.append('images', file_data);
                for(var i = 0; i < total_file ;i++)
                {
                    // file_data[i] = $('#image_add').prop('files')[i];
                    form_data.append("files[]", document.getElementById('image_add').files[i]);
                }
                form_data.append('name', $("#name").val());
                form_data.append('prices', $("#prices").val());
                form_data.append('category_id', $("#category_id").val());

               $.ajax({
                    url: "controllers/product_controller.php?yeucau=them",
                    method: "POST",
                    dataType: 'text',
                    data: form_data,
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: function(data){
                        $('#form_add_product')[0].reset();

                        // alert thông báo
                        Swal.fire({icon: 'success',  title: 'Đã thêm sản phẩm mới',  showConfirmButton: false, timer: 1500 });

                        // // reload để hiển thị danh sách
                        $("#list_product").load("views/quanli/admin/product/list.php");
                    }
                });
            }else{
                Swal.fire({icon: 'error',  title: 'Vui lòng điền đầy đủ thông tin',  showConfirmButton: false, timer: 1500 });
            }
        });
    });
</script>



