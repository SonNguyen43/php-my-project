<script src="https://cdn.ckeditor.com/ckeditor5/19.0.0/classic/ckeditor.js"></script>
<script src="https://ckeditor.com/apps/ckfinder/3.5.0/ckfinder.js"></script>
<div class="card mt-3">
    <div class="card-body">
    <?php
        require './models/news.php';
        require './models/news_info.php';

        $news = new News();
        $news_info = new NewsInfo();
        

        if(isset($_GET['tin_tuc']) && $_GET['tin_tuc'] == 'sua' && $_GET['id'] != ''){

            $id = $_GET['id'];
            // kiểm tra news info của news tồn tại chưa
            $checkNewsInfo = $news_info->CheckCountNewsInfo($id);

            $checkID = $news->CkeckNewInfos($id);

            // có news tồn tại, nhưng news info chưa tồn tại => thêm news info
            if($checkNewsInfo <= 0 && $checkID > 0){
                ?>
                    <div class="mt-3 mb-3">
                        <form method="post" id="form_add_news">
                            <h3 class="alert alert-light pl-0"><i class="fas fa-edit"></i> Thêm nội dung tin tức</h3>
                            <input type="text" name="news_id" value="<?php echo $id?>" class="d-none">
                            <textarea id="editor" name="content" class="mt-3"></textarea>
                            <input type="submit" class="btn btn-success mt-3" value="Thay đổi nội dung">
                        </form>
                    </div>
                    
                <?php
            // có news tồn tại và news info  tồn tại => sửa news info
            }else if($checkNewsInfo > 0 && $checkID > 0){
                ?>
            
                    <div class="mt-3 mb-3">
                        <form method="post" id="form_edit_news">
                            <h3 class="alert alert-light pl-0"><i class="fas fa-edit"></i> Sửa nội dung tin tức</h3>
                            <input type="text" name="news_id" value="<?php echo $id?>" class="d-none">
                            <textarea id="editor" name="content" class="mt-3"><?php  echo $news_info->News_Info($id)->content;?></textarea>
                            <input type="submit" class="btn btn-success mt-3" value="Thay đổi nội dung">
                        </form>
                    </div>
                    
                <?php
            }
            else{
                ?>
                    <div class="alert alert-danger mt-3" role="alert">Không tìm thấy tin tức này </div>
                <?php
            }
        }else{
            ?>
                <div class="alert alert-danger mt-3" role="alert">Thông tin có sự sai lệch. Vui lòng kiểm tra lại</div>
            <?php
        }
    ?>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.js"></script>
<script>
    // cheditor
    ClassicEditor.create(document.querySelector( '#editor' ),
    {
       
        ckfinder: {
            // Upload the images to the server using the CKFinder QuickUpload command.
            uploadUrl: './public/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images&responseType=json',

            // Define the CKFinder configuration (if necessary).
            options: {
                resourceType: 'Images'
            }
        }
    })
    .then( editor => {
        console.log( editor );
    })
    .catch( error => {
        console.error( error );
    });

    $(document).ready(function(){
         // thêm
        $("#form_add_news").on('submit', function(event){
            // không load lại trang
            event.preventDefault();
            if($("#editor").val() != '' && $("#editor").val().trim() != 0){
                var form_data = $(this).serialize();
                $.ajax({
                    url: "controllers/news_controller.php?yeucau=them_news_info",
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

        // sửa
        $("#form_edit_news").on('submit', function(event){
            // không load lại trang
            event.preventDefault();

            if($("#editor").val() != '' && $("#editor").val().trim() != 0){
                var form_data = $(this).serialize();
                $.ajax({
                    url: "controllers/news_controller.php?yeucau=sua_news_info",
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
    });
</script>