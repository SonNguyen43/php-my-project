<?php
    ob_start();
    session_start(); 

    # gọi model category để sử dụng những hàm đã được xây dựng
    require "../models/cart.php";
    require "../models/cart_info.php";
    require "../models/user.php";
    require "../models/product.php";

    # nhận được yêu cầu 
    if(isset($_GET['yeucau'])){
        switch ($_GET['yeucau']) {
            case "them_san_pham_vao_gio_hang":
                # lấy cart của user đang đăng nhập
                $cart = new Cart;
                $cart_id = $cart->CartByUserID($_SESSION['user'])->id;

                if(isset($_POST['product_id'])){
                    $product_id = $_POST['product_id'];

                    $product = new Product;
                    $cart_info = new CartInfo;

                    # xem sản phẩm đã có trong giỏ hàng chưa
                    $check = count($cart_info->CheckProductInCart($product_id));

                    if($check <= 0){
                        # giá của sản phẩm
                        $into_money = $product->ProductInfo($product_id)->prices;

                        # thêm sản phẩm vào giỏ hàng của người đang đăng nhập
                        $cart_info->InsertProductToCart(1,$into_money,$product_id,$cart_id);
                    }else{
                        echo "Sản phẩm đã có trong giỏ hàng";
                    }

                   
                }
            break;
            case "cap_nhap_gia":
                    $number = $_POST['number'];
                    $cart_info_id = $_POST['cart_info_id'];
                    
                    $cart_info = new CartInfo;
                    $product = new Product;

                    # lấy giá của sản phẩm của cart_info để nhân với số lượng ra giá tổng
                    # giá gốc của sản phẩm
                    $product_id = $cart_info->CartInfos($cart_info_id)->product_id;
                    $price = $product->ProductInfo($product_id)->prices;

                    $into_money = $number * $price;

                    $cart_info->UpdatePriceProduct($number,$into_money,$cart_info_id);
            break;

            case "xoa_san_pham_tu_cart":
                $cart_info_id = $_POST['cart_info_id'];
                $cart_info = new CartInfo;

                $cart_info->DeleteProductFromCartInfo($cart_info_id);
            break;
        }
    }
    # không nhận được yêu cầu
    else{
        header("Location: ../?khong_co_du_lieu");
    }
    ob_end_flush();
?>