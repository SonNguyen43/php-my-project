<?php
    $str1 = 'database/connect_product_info.php';
    $str2 = '../database/connect_product_info.php';
    $str3 = '../../database/connect_product_info.php';
    $str4 = '../../../database/connect_product_info.php';
    $str5 = '../../../../database/connect_product_info.php';
    $str6 = '../../../../../database/connect_product_info.php';

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
  
    class ProductInfo extends DatabaseProductInfo{
        public function Product_Info($id){
            $product_info = $this->connect->prepare("SELECT * FROM product_info WHERE product_id = ?");
            $product_info->setFetchMode(PDO::FETCH_OBJ);
            $product_info->execute(array($id));
            $info = $product_info->fetch();
            return $info;
        }

        public function AddProductInfo($final_updated,$product_id){
            $query = 'INSERT INTO product_info (final_updated,product_id) VALUES (?,?)';
            $create = $this->connect->prepare($query);
            $create->execute(array($final_updated,$product_id));
        }

        public function UpdateInfoProduct($color,$size,$enventory_number,$description,$id){
            $query = 'UPDATE product_info SET color=?, size=?,enventory_number=?,description=? WHERE product_id = ?';
            $Edit = $this->connect->prepare($query);
            $Edit->execute(array($color,$size,$enventory_number,$description,$id));
        }
     }
?>