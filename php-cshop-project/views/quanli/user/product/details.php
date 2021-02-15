<style>
    ul{
        list-style-type: none;
    }
    span.text{
        font-weight: 700;
    }
    /* Slide ảnh */
    .swiper-container {
        width: 100%;
        height: 100%;
    }
    .swiper-slide {
        text-align: center;
        font-size: 18px;
        background: #fff;

        /* Center slide text vertically */
        display: -webkit-box;
        display: -ms-flexbox;
        display: -webkit-flex;
        display: flex;
        -webkit-box-pack: center;
        -ms-flex-pack: center;
        -webkit-justify-content: center;
        justify-content: center;
        -webkit-box-align: center;
        -ms-flex-align: center;
        -webkit-align-items: center;
        align-items: center;
    }
</style>
<!-- https://gextend.net/threads/tao-hieu-ung-zoom-hinh-anh-voi-thu-vien-multizoom-js.211/ -->
<link rel="stylesheet" href="./public/css/multizoom.css">
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8/jquery.min.js"></script>

<!-- Slide ảnh -->
<link rel="stylesheet" href="https://unpkg.com/swiper/css/swiper.min.css">
<?php
    require "./models/category.php";
    require "./models/product.php";
    require "./models/product_info.php";

    $product = new Product();
    $category = new Category();
    $product_info = new ProductInfo();

    if(isset($_GET['san_pham']) && isset($_GET['id'])){

        $product_id = $_GET['id'];

        $count = $product->CheckProduct($product_id);

        # kiểm tra xem có sản phẩm đó ko
        if($count > 0){
            # thông tin sản phẩm bởi id
            $info = $product->ProductInfo($product_id);

            # lấy ra thông tin chi tiết sản phẩm
            $info_product = $product_info->Product_Info($product_id);
            ?>  
                <div class="container card" style="margin-top: 130px;">
                    <div class="row card-body">
                        <!-- LEFT -->
                        <div class="col-md-5">
                            <div class="row">
                                <div class="col-md-12 d-flex justify-content-center" style="height:450px;">
                                    <?php 
                                        $arrImages = json_decode($info->images, true); 
                                    ?>
                                    <img src="./views/quanli/admin/product/images/<?php echo $arrImages[0];?>" alt="" id="show_image" height="100%" class="shadow-bulma">
                                </div>
                                <div class="col-md-12 mt-3" style="height: 100px">
                                    <!-- Swiper -->
                                    <div class="swiper-container shadow-sm">
                                        <div class="swiper-wrapper">
                                            <?php 
                                                foreach ($arrImages as $img) {
                                                   ?>
                                                        <div class="swiper-slide"><img src="./views/quanli/admin/product/images/<?php echo $img;?>" alt="" height="100%" onclick="ShowImage('./views/quanli/admin/product/images/<?php echo $img;?>')"></div>
                                                   <?php
                                                }
                                            ?>
                                        </div>
                                        <!-- Add Pagination -->
                                        <div class="swiper-pagination"></div>
                                    </div>  <!-- End Swiper -->
                                </div>
                            </div>
                        </div>
                        <!-- END LEFT -->
                        <!-- RIGHT -->
                        <div class="col-md-7">
                            <h3><?php echo $info->name; ?></h3>
                            <a href="?danh_muc&id=<?php echo $category->CatagoryInfo($info->category_id)->id;?>" class="text-secondary d-inline">
                                <small class="text-success"><i><i class="fa fa-tag"></i> <?php echo $category->CatagoryInfo($info->category_id)->name; ?></i></small>
                            </a>

                            <div class="d-inline float-right"><i class="fas fa-heart text-danger"></i> <?php echo $info_product->likes; ?> likes</div>
                            <hr>
                                <h4 class="text-danger d-block mt-3"><i> Giá: <?php echo number_format($info->prices);?> VNĐ</i></h4>
                            <hr>
                                <h4>Thông tin</h4>
                                <div><span class="text"><i class="fas fa-palette"></i> Màu sắc:</span> <?php echo $info_product->color; ?></div>
                                <div><span class="text"><i class="fas fa-sitemap"></i> Size: </span> <?php echo $info_product->size; ?></div>
                                <div><span class="text"><i class="fas fa-sort-amount-down"></i> Số lượng còn: </span> <?php echo $info_product->enventory_number; ?></div>
                                <div><span class="text"><i class="fas fa-file-medical-alt"></i> Mô tả: </span> <?php echo $info_product->description; ?></div>
                                <div><span class="text"><i class="fas fa-clock"></i> Cập nhật: </span> <?php echo $info_product->final_updated    ; ?></div>

                                <hr>
                                <?php
                                    if (isset($_SESSION['user'])) {
                                       ?>
                                        <button class="btn btn-success" data-toggle="modal" data-target="#MuaNgay"><i class="fas fa-credit-card"></i> Mua ngay</button>
                                        <form method="post" class="d-inline" id="form_add_product_to_cart">
                                            <input type="text" value="<?php echo $product_id;?>" name="product_id" id="product_id" class="d-none">
                                            <button type="submit" class="btn btn-warning"><i class="fas fa-cart-plus"></i> Thêm vào giỏ hàng</button>
                                        </form>
                                       <?php
                                    }else{
                                        ?>
                                            <div class="alert alert-warning">Hãy đăng nhập để mua hàng !</div>
                                        <?php
                                    }
                                ?>
                               
                        </div>
                        <!-- END RIGHT -->
                    </div>
                </div>

                <!-- COMMENTS -->
                <?php
                    require "./views/quanli/user/product/comment.php";
                ?>
            <?php
        }else{
            ?>
                <div style="margin-top: 110px"><?php  require "./views/includes/404.php"; ?></div>
            <?php
        }
    }else{
        ?>
            <div style="margin-top: 110px"><?php  require "./views/includes/404.php"; ?></div>
        <?php
    }
?>

<!-- https://github.com/nolimits4web/Swiper/blob/master/demos/110-slides-per-view.html -->
<script src="https://unpkg.com/swiper/js/swiper.min.js"></script>
<!-- https://gextend.net/threads/tao-hieu-ung-zoom-hinh-anh-voi-thu-vien-multizoom-js.211/ -->
<script src="./public/js/multizoom.js"></script>

<script type="text/javascript">
    // Slide ảnh
    var swiper = new Swiper('.swiper-container', {
        slidesPerView: 3,
        spaceBetween: 30,
        pagination: {
            el: '.swiper-pagination',
            clickable: true,
        },
    });

    function ShowImage(url){
        document.getElementById('show_image').src = url;
    }

    // Zoom ảnh
    jQuery(document).ready(function($){
        $('#show_image').addimagezoom({ // single image zoom
            zoomrange: [3, 10],
            magnifiersize: [400,400],
            magnifierpos: 'right',
            cursorshade: true,
        });
    });
</script>

<!-- JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.js"></script>
<script>
    $(document).ready(function(){
        $("#form_add_product_to_cart").on('submit', function(event){
            // không load lại trang
             event.preventDefault();
            if($("#product_id").val() != '' && $("#product_id").val().trim() != 0){
            
                var product_id = $("#product_id").val();

                $.ajax({
                    url: "controllers/cart_controller.php?yeucau=them_san_pham_vao_gio_hang",
                    method: "POST",
                    dataType: 'text',
                    data: {product_id: product_id},
                    success: function(data){
                        Swal.fire({icon: 'success',title: 'Đã thêm vào giỏ hàng',showConfirmButton: false,timer: 1500})
                        $("#number_product_in_cart").load("views/includes/number_product_in_cart.php");
                    }
                });
            }else{
                $('#form_add_category')[0].reset();
                Swal.fire({icon: 'error',title: 'Vui lòng điền đầy đủ thông tin',showConfirmButton: false,timer: 1500});
            }
        });
    });
</script>



<!-- Modal -->
<div class="modal fade" id="MuaNgay" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Xác nhận đơn hàng</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            Đơn hàng của bạn sẽ được vận chuyển đến: <br>
            <?php 
                $date = getdate();  
                $ngay_cong_10 = $date['mday'] + 10;  

                $user = new User;
                echo "<b>Địa chỉ: </b>" . $user->UserInfo($_SESSION['user'])->ship_address . "<br>";
                echo "<b>Người nhận: </b>" . $user->UserInfo($_SESSION['user'])->display_name . "<br>"; 
                echo "<b>Thời gian nhận: </b>" . date('Y-m-d',time()) . " <b>đến</b> " . date('Y-m-d',time()); 
            ?>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
            <form id="form_confirm_mua_hang">
                <input type="text" value="<?php echo $product_id;?>" name="product_id" id="product_id_send_email" class="d-none">
                <input type="text" value="<?php echo $_SESSION['user'];?>" name="user_id" id="user_id_send_email" class="d-none">
                <button type="submit" class="btn btn-success">Xác nhận</button>
            </form>
        </div>
        </div>
    </div>
</div>


<!-- JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.js"></script>
<script>
    $(document).ready(function(){
        $("#form_confirm_mua_hang").on('submit', function(event){
            // không load lại trang
             event.preventDefault();
            if($("#product_id_send_email").val() != '' && $("#product_id_send_email").val().trim() != 0
               && $("#user_id_send_email").val() != '' && $("#user_id_send_email").val().trim() != 0 ){

                $.ajax({
                    url: "models/email.php",
                    method: "POST",
                    dataType: 'text',
                    data: {product_id: $("#product_id_send_email").val(), user_id: $("#user_id_send_email").val()},
                    success: function(data){
                        Swal.fire({icon: 'success',title: 'Chúng tôi đã gửi email xác nhận cho bạn',showConfirmButton: false,timer: 1500});
                    }
                });
            }else{
                Swal.fire({icon: 'error',title: 'Vui lòng điền đầy đủ thông tin',showConfirmButton: false,timer: 1500});
            }
        });
    });
</script>
