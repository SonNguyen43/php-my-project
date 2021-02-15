<!-- https://codepen.io/jamesbarnett/pen/vlpkh?__cf_chl_jschl_tk__=20ac8eea8a6226888b04ae6fd82166d883b285cd-1590242484-0-AUsz-LkfKDVoPSvFt37vzFTu3Lk7u9NvWeYMRFtIBiO4xr5H2iLtW_K58ZV54C1thL7CGQthJsfi7r57bNcpNJfIY2BDqxaTbObvaHPw6T-p9kEIW0QNw5NVEUHLpYF4YTQgI0V9_olfmG2zlGX1kBfg4GI-JiipfK1Q1EvjHqzaUY1XkT9zBKvN4Vqi2PqbUFqSC2nhQ6kfu836BQ6vDH5F_g8LHpHxFE7LMGiq7l3YPJ4Lua8FaxDbxAqCSTVRkgKr4ZCtP2UE3DsvxZPo5nU0MmcIMM3aES6P0lKkt0AiOS-JbFBt2GndqeMW6yBYSItAjqZdF8_a0oou805Ic8HrfZ3yTVWYo1EywCGUlDyF -->
<style>
    @import url(//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css);

    fieldset, label { margin: 0; padding: 0; }
    body{ margin: 20px; }
    h1 { font-size: 1.5em; margin: 10px; }

    /****** Style Star Rating Widget *****/

    .rating { 
        border: none;
        float: left;
    }

    .rating > input { display: none; } 
    .rating > label:before { 
        margin: 5px;
        font-size: 1.25em;
        font-family: FontAwesome;
        display: inline-block;
        content: "\f005";
    }

    .rating > .half:before { 
        content: "\f089";
        position: absolute;
    }

    .rating > label { 
        color: #ddd; 
        float: right; 
    }

    /***** CSS Magic to Highlight Stars on Hover *****/

    .rating > input:checked ~ label, /* show gold star when clicked */
    .rating:not(:checked) > label:hover, /* hover current star */
    .rating:not(:checked) > label:hover ~ label { color: #FFD700;  } /* hover previous stars in list */

    .rating > input:checked + label:hover, /* hover current star when changing rating */
    .rating > input:checked ~ label:hover,
    .rating > label:hover ~ input:checked ~ label, /* lighten current selection */
    .rating > input:checked ~ label:hover ~ label { color: #FFED85;  } 
</style>

<div class="container card mt-3 mb-3">
    <div class="row card-body">
        <?php
            if (isset($_SESSION['user'])) {
                ?>
                    <div class="col-md-12">
                        <h3>Bình luận</h3>
                        <hr>
                    </div>

                    <!-- FORM -->
                    <div class="col-md-12">
                        <form method="post" id="form_add_comment">
                            <!-- lấy từ details.php -->
                            <input type="text" value="<?php echo $product_id; ?>" name="product_id" class="d-none">
                            <input type="text" value="<?php echo $_SESSION['user']; ?>" name="user_id" class="d-none">
                            <label for="" class="d-block"><i class="fa fa-star"></i> Đánh giá: </label>
                            <fieldset class="rating d-block">
                                <input type="radio" id="star5" name="rating" value="5" /><label class = "full" for="star5" title="Awesome - 5 stars"></label>
                                <input type="radio" id="star4" name="rating" value="4" /><label class = "full" for="star4" title="Pretty good - 4 stars"></label>
                                <input type="radio" id="star3" name="rating" value="3" /><label class = "full" for="star3" title="Meh - 3 stars"></label>
                                <input type="radio" id="star2" name="rating" value="2" /><label class = "full" for="star2" title="Kinda bad - 2 stars"></label>
                                <input type="radio" id="star1" name="rating" value="1" /><label class = "full" for="star1" title="Sucks big time - 1 star"></label>
                            </fieldset>
                            <br>
                            <br>
                            <label for="" class="d-block float-left"><i class="fa fa-edit"></i> Nhận xét của bạn: </label>
                            <textarea name="contents" id="comment" cols="30" rows="10" class="form-control mt-5" required></textarea>
                        
                            <input type="submit" value="Bình luận" class="btn btn-success mt-3">
                        </form>
                    </div> <!-- END FORM -->

                    <!-- COMMENTS -->
                    <div class="col-md-12 mt-5">
                        <hr>
                        <h5>Tất cả bình luận: </h5>
                        <div id="all_comments"></div>
                        

                    </div> <!-- END COMMENTS -->
                <?php
            }else{
                ?>
                    <div class="alert alert-success w-100">Hãy <a href="?dang_nhap" class="text-decoration-none">đăng nhập </a> để bình luận !</div>
                <?php
            }
        ?>
        
    </div>
</div>

<script>
    $("#all_comments").load("views/quanli/user/product/all_comment.php", {product_id: <?php echo $_GET['id']; ?>});
    
    $(document).ready(function(){
        

        $('#form_add_comment').on('submit', function(e){
            e.preventDefault();

            if($('#comment').val() != '' && $('#comment').val().trim() != 0){
                var form_data = $(this).serialize();

                $.ajax({
                    url: 'controllers/comment_product_controller.php?yeucau=them',
                    method: 'POST',
                    data: form_data,
                    success: function(){
                        $('#form_add_comment')[0].reset();
                        // load lại danh sách
                        $("#all_comments").load("views/quanli/user/product/all_comment.php", {product_id: <?php echo $_GET['id']; ?>});
                    }
                })
            }else{
                Swal.fire({icon: 'error',title: 'Hãy thêm nội dung',showConfirmButton: false,timer: 1500});
            }
        });
    });
</script>