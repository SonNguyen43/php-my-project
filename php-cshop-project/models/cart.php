<?php
    $str1 = 'database/connect_cart.php';
    $str2 = '../database/connect_cart.php';
    $str3 = '../../database/connect_cart.php';
    $str4 = '../../../database/connect_cart.php';
    $str5 = '../../../../database/connect_cart.php';
    $str6 = '../../../../../database/connect_cart.php';

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
  
    class Cart extends DatabaseCart{
        public function CartByUserID($user_id){
            $cart = $this->connect->prepare("SELECT * FROM cart WHERE user_id = ?");
            $cart->setFetchMode(PDO::FETCH_OBJ);
            $cart->execute(array($user_id));
            $info = $cart->fetch();
            return $info;
        }

        public function TotalPrice($cart_id){
            $cart = $this->connect->prepare(" SELECT SUM(into_money) as total_price FROM cart_info WHERE cart_id = ?");
            $cart->setFetchMode(PDO::FETCH_OBJ);
            $cart->execute(array($cart_id));
            $info = $cart->fetch();
            return $info;
        }
        
        public function AddCartForUser($user_id){
            $query = 'INSERT INTO cart (user_id) VALUES (?)';
            $add = $this->connect->prepare($query);
            $add->execute(array($user_id));
        }
    }
?>