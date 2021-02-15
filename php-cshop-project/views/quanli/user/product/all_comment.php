<?php
    session_start();
    require "../../../../models/comment_product.php";
    require "../../../../models/user.php";

    $comment_product = new CommentProduct();
    $user = new User();

    # nhận từ comment.php
    $product_id = $_REQUEST['product_id'];

    $all_comment = $comment_product->AllCommentByProductID($product_id);

    foreach ($all_comment as $comment) {
        ?>
            <div class="media border-bottom mt-3">
                <div class="media-body position-relative">
                    <h6 class="mt-0 d-inline"><i class="fas fa-user"></i> <?php echo $user->UserInfo($comment->user_id)->display_name; ?></h6>
                    <?php
                        if ($comment->user_id == $_SESSION['user']) {
                           ?>
                            <form method="post" class="" id="form_delete_comment">
                                <input type="text" name="comment_id" value="<?php echo $comment->id; ?>" class="d-none" id="comment_id">
                                <button type="submit" class="delete btn btn-outline-danger btn-sm position-absolute" style="bottom: 0; right:30px">xóa</button>
                            </form>
                           <?php
                        }
                    ?>
                   
                    <small class="d-inline float-right"><?php echo $comment->rate; ?> <i class="fa fa-star text-warning"></i></small>
                    <div class="ml-5"><i><?php echo $comment->contents; ?></i></div>
                </div>
            </div>
        <?php
    }
?>

<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.js"></script> -->
<script>
    $(document).ready(function(){
        $("#form_delete_comment").on('submit', function(event){
            // không load lại trang
             event.preventDefault();
            if($("#comment_id").val() != ''){
                var form_data = $(this).serialize();

                $.ajax({
                    url: "controllers/comment_product_controller.php?yeucau=xoa",
                    method: "POST",
                    dataType: 'text',
                    data: form_data,
                    success: function(data){
                        $("#all_comments").load("views/quanli/user/product/all_comment.php", {product_id: <?php echo $product_id ?>});
                    }
                });
            }else{
                $('#form_add_category')[0].reset();
                Swal.fire({icon: 'error',title: 'Không nhận được thông tin',showConfirmButton: false,timer: 1500});
            }
        });
    });
</script>

