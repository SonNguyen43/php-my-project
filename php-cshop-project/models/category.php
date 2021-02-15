<?php
    $str1 = 'database/connect_category.php';
    $str2 = '../database/connect_category.php';
    $str3 = '../../database/connect_category.php';
    $str4 = '../../../database/connect_category.php';
    $str5 = '../../../../database/connect_category.php';
    $str6 = '../../../../../database/connect_category.php';

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
  
    class Category extends DatabaseCategory{
        
        public function AllCategory(){
            $category = $this->connect->prepare("SELECT * FROM category ORDER BY id DESC");
            $category->setFetchMode(PDO::FETCH_OBJ);
            $category->execute(array());
            $category = $category->fetchAll();
            return $category;
        }

        public function CheckCategory($id){
            $check = $this->connect->prepare("SELECT * FROM category WHERE id=?");
            $check->setFetchMode(PDO::FETCH_OBJ);
            $check->execute(array($id));
            $count = count($check->fetchAll());
            return $count;
        }

        public function CatagoryInfo($id){
            $category = $this->connect->prepare("SELECT * FROM category WHERE id = ?");
            $category->setFetchMode(PDO::FETCH_OBJ);
            $category->execute(array($id));
            $info = $category->fetch();
            return $info;
        }

        public function AddCategory($name,$image){
            $query = 'INSERT INTO category (name,image) VALUES (?,?)';
            $create = $this->connect->prepare($query);
            $create->execute(array($name,$image));
        }

        public function EditNameCategory($name,$id){
            $query = 'UPDATE category SET name = ? WHERE id = ?';
            $Edit = $this->connect->prepare($query);
            $Edit->execute(array($name,$id));
        }
        public function EditImageCategory($name,$image,$id){
            $query = 'UPDATE category SET name=?, image = ? WHERE id = ?';
            $Edit = $this->connect->prepare($query);
            $Edit->execute(array($name,$image,$id));
        }

        public function DeteleCategory($id){
            $query = 'DELETE FROM category WHERE id = ?';
            $Detele = $this->connect->prepare($query);
            $Detele->execute(array($id));
        }

        public function SearchCaterogy($name){
            $category = $this->connect->prepare("SELECT * FROM category WHERE name LIKE '%$name%' ORDER BY id DESC");
            $category->setFetchMode(PDO::FETCH_OBJ);
			$category->execute(array($name));
			$list = $category->fetchAll(); 
			return $list;
        }
    }
?>