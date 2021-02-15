<?php
    $str1 = 'database/connect_product.php';
    $str2 = '../database/connect_product.php';
    $str3 = '../../database/connect_product.php';
    $str4 = '../../../database/connect_product.php';
    $str5 = '../../../../database/connect_product.php';

    if(file_exists($str1)){
        $file = $str1;
    }else if(file_exists($str2)){
        $file = $str2;
    }else if(file_exists($str3)){
        $file = $str3;
    }else if(file_exists($str4)){
        $file = $str4;
    }else{
        $file = $str5;
    }
    # gọi file vào - lúc này đã có kết nối đến csdl
    require $file;
  
    class Product extends DatabaseProduct{
        
        public function AddProduct($name,$prices,$images,$category_id){
            $query = 'INSERT INTO product (name,prices,images,category_id) VALUES (?,?,?,?)';
            $create = $this->connect->prepare($query);
            $create->execute(array($name,$prices,$images,$category_id));
        }

        public function AllProduct(){
            $product = $this->connect->prepare("SELECT * FROM product ORDER BY id DESC");
            $product->setFetchMode(PDO::FETCH_OBJ);
            $product->execute(array());
            $product = $product->fetchAll();
            return $product;
        }

        public function FindProducts($ten_san_pham){
            $product = $this->connect->prepare("SELECT * FROM product WHERE name LIKE '%$ten_san_pham%' ORDER BY id DESC");
            $product->setFetchMode(PDO::FETCH_OBJ);
            $product->execute(array($ten_san_pham));
            $product = $product->fetchAll();
            return $product;
        }

        public function AllProductByCategory($id){
            $product = $this->connect->prepare("SELECT * FROM product WHERE category_id = ? ORDER BY id DESC");
            $product->setFetchMode(PDO::FETCH_OBJ);
            $product->execute(array($id));
            $product = $product->fetchAll();
            return $product;
        }

        public function CheckProduct($id){
            $check = $this->connect->prepare("SELECT * FROM product WHERE id=?");
            $check->setFetchMode(PDO::FETCH_OBJ);
            $check->execute(array($id));
            $count = count($check->fetchAll());
            return $count;
        }

        public function MaxProductID(){
            $product = $this->connect->prepare("SELECT MAX(product.id) as id FROM product");
            $product->setFetchMode(PDO::FETCH_OBJ);
            $product->execute(array());
            $product = $product->fetch();
            return $product;
        }

        public function CategoryInfo($id){
            $product = $this->connect->prepare("SELECT * FROM category WHERE id = ?");
            $product->setFetchMode(PDO::FETCH_OBJ);
            $product->execute(array($id));
            $info = $product->fetch();
            return $info;
        }

        public function ProductInfo($id){
            $product = $this->connect->prepare("SELECT * FROM product WHERE id = ?");
            $product->setFetchMode(PDO::FETCH_OBJ);
            $product->execute(array($id));
            $info = $product->fetch();
            return $info;
        }
        public function DeleteProduct($id){
            $query = 'DELETE FROM product WHERE id = ?';
            $Detele = $this->connect->prepare($query);
            $Detele->execute(array($id));
        }

        public function SearchProduct($name){
            $category = $this->connect->prepare("SELECT * FROM product WHERE name LIKE '%$name%' ORDER BY id DESC");
            $category->setFetchMode(PDO::FETCH_OBJ);
			$category->execute(array($name));
			$list = $category->fetchAll(); 
			return $list;
        }
     }
?>