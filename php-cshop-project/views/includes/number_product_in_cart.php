<?php
    session_start();
    require "../../models/cart_info.php";
    require "../../models/cart.php";

    # chọn cart của user
    $cart = new Cart;
    $cart_id = $cart->CartByUserID($_SESSION['user'])->id;

    # sản phẩm của trong cart (cart_info)
    $cart_info = new CartInfo;
    $count = count($cart_info->AllProductInCart($cart_id));

?>

<div class="position-absolute bg-white text-danger rounded-circle text-center" 
style="width: 25px; height: 25px; top:-5px; left:-10px">
    <?php
        echo $count;
    ?>
</div>
