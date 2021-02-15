<?php
    $str1 = 'database/connect_cart_info.php';
    $str2 = '../database/connect_cart_info.php';
    $str3 = '../../database/connect_cart_info.php';
    $str4 = '../../../database/connect_cart_info.php';
    $str5 = '../../../../database/connect_cart_info.php';
    $str6 = '../../../../../database/connect_cart_info.php';

    # kiểm tra tồn tại của file
    if(file_exists($str1)){
        $file = $str1;
    }else if(file_exists($str2)){
        $file = $str2;
    }else if(file_exists($str3)){
        $file = $str3;
    }else if(file_exists($str4)){
        $file = $str4;
    }else if(file_exists($str5)){
        $file = $str5;
    }else{
        $file = $str6;
    }
    # gọi file vào - lúc này đã có kết nối đến csdl
    require $file;
  
    class CartInfo extends DatabaseCartInfo{

        public function CartInfos($cart_info_id){
            $product = $this->connect->prepare("SELECT * FROM cart_info WHERE id = ?");
            $product->setFetchMode(PDO::FETCH_OBJ);
            $product->execute(array($cart_info_id));
            $info = $product->fetch();
            return $info;
        }

        public function CheckProductInCart($product_id){
            $product = $this->connect->prepare("SELECT * FROM cart_info WHERE product_id = ?");
            $product->setFetchMode(PDO::FETCH_OBJ);
            $product->execute(array($product_id));
            $info = $product->fetchAll();
            return $info;
        }

        public function AllProductInCart($cart_id){
            $cart = $this->connect->prepare("SELECT * FROM cart_info WHERE cart_id = ?");
            $cart->setFetchMode(PDO::FETCH_OBJ);
            $cart->execute(array($cart_id));
            $info = $cart->fetchAll();
            return $info;
        }

        public function InsertProductToCart($selected_product_number,$into_money,$product_id,$cart_id){
            $query = 'INSERT INTO cart_info (selected_product_number,into_money,product_id,cart_id) VALUES (?,?,?,?)';
            $add = $this->connect->prepare($query);
            $add->execute(array($selected_product_number,$into_money,$product_id,$cart_id));
        }

        public function UpdatePriceProduct($selected_product_number,$into_money,$id){
            $query = 'UPDATE cart_info SET selected_product_number=?, into_money = ? WHERE id = ?';
            $Edit = $this->connect->prepare($query);
            $Edit->execute(array($selected_product_number,$into_money,$id));
        }
        
        public function DeleteProductFromCartInfo($cart_info_id){
            $query = 'DELETE FROM cart_info WHERE id = ?';
            $Detele = $this->connect->prepare($query);
            $Detele->execute(array($cart_info_id));
        }
    }
?>