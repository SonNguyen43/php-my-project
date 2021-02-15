<?php
    session_start();

    require "../../../../models/cart.php";
    require "../../../../models/cart_info.php";
    require "../../../../models/product.php";
    require "../../../../models/category.php";

    $product = new Product;
    $category = new Category;

    # lấy id của cart bằng user_id
    $cart = new Cart;
    $cart_id = $cart->CartByUserID($_SESSION['user'])->id;

    # lấy tất cả món hàng trong cart đó
    $cart_info = new CartInfo;
    $all_product_in_cart = $cart_info->AllProductInCart($cart_id);

    foreach ($all_product_in_cart as $cart) {
        ?>
            <div class="card mb-3">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-5">
                            <?php 
                                $arrImages = json_decode($product->ProductInfo($cart->product_id)->images, true); 
                            ?>
                            <div class="row">
                                <div class="col-md-2">
                                    <img src="./views/quanli/admin/product/images/<?php echo $arrImages[0];?>" alt="" id="show_image" width="100%">
                                </div>
                                <div class="col-md-10 text-center">
                                    <b><?php
                                        echo $product->ProductInfo($cart->product_id)->name;
                                    ?></b>
                                </div>
                            </div>
                           
                           
                        </div>
                        <div class="col-md-2 text-primary text-center">
                            <a href="?danh_muc&id=<?php echo $category->CatagoryInfo($product->ProductInfo($cart->product_id)->category_id)->id;?>" class="text-decoration-none">
                                <i class="fa fa-tag"></i>
                                <?php
                                    echo $category->CatagoryInfo($product->ProductInfo($cart->product_id)->category_id)->name;
                                ?>
                            </a>
                        </div>
                        <div class="col-md-2 text-center">
                            <b class="text-danger" id="<?php echo $cart->id ?>">
                            <?php
                                echo number_format($cart->into_money) . " đ";
                            ?></b>
                        </div>
                        <div class="col-md-2 text-center" style="margin-top: -7px;">
                            <div class="buttons_added">
                                <input class="minus is-form" type="button" value="-">
                                <input aria-label="quantity" class="input-qty" id="<?php echo "c".$cart->id?>" 
                                min="1" name="" type="number" value="<?php echo $cart->selected_product_number;?>"
                                onchange="ChangePrice(<?php echo $cart->id; ?>, '<?php echo 'c'.$cart->id; ?>')">
                                <input class="plus is-form" type="button" value="+">
                            </div>
                        </div>
                        <div class="col-md-1 text-center" style="margin-top: -5px;">
                            <input type="button" value="xóa" class="btn btn-danger btn-sm" onclick="DeleteProDuctFromCart(<?php echo $cart->id; ?>)">
                        </div>
                    </div>
                </div>
            </div>
        <?php
    }
?>
<hr>
<div class="row">
    <div class="col-md-12">
        <div class="text-right">
            <h4 class="mr-3">Tổng tiền: 
            <?php
                $cart = new Cart;
                $cart_id = $cart->CartByUserID($_SESSION['user'])->id;
                echo "<b class='text-danger'><i>" . number_format($cart->TotalPrice($cart_id)->total_price) . "</i></b> VNĐ"; 
            ?>
            </h4>
        </div>
    </div>
</div>

        
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    function ChangePrice(cart_info_id, number_id){

        var number =document.getElementById(number_id).value;

        if(number == "" || number < 1){
            Swal.fire({icon: 'error',title: 'Giá trị không hợp lệ !',showConfirmButton: false,timer: 1500})
        }else{
            $.ajax({
                url: "controllers/cart_controller.php?yeucau=cap_nhap_gia",
                method: "POST",
                dataType: 'text',
                data: {number: number, cart_info_id: cart_info_id},
                success: function(data){
                    $("#info_cart").load("views/quanli/user/cart/info.php");  
                }
            });
        }
        
    }

    function DeleteProDuctFromCart(cart_info_id){
        $.ajax({
            url: "controllers/cart_controller.php?yeucau=xoa_san_pham_tu_cart",
            method: "POST",
            dataType: 'text',
            data: {cart_info_id: cart_info_id},
            success: function(data){
                $("#info_cart").load("views/quanli/user/cart/info.php");  
                $("#number_product_in_cart").load("views/includes/number_product_in_cart.php");
            }
        });
    }
</script>