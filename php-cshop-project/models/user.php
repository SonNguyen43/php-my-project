<?php
    $str1 = 'database/connect_user.php';
    $str2 = '../database/connect_user.php';
    $str3 = '../../database/connect_user.php';
    $str4 = '../../../database/connect_user.php';
    $str5 = '../../../../database/connect_user.php';
    $str6 = '../../../../../database/connect_user.php';

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
  
    class User extends DatabaseUser{
        public function DangNhap($user_name, $password){
            $query = $this->connect->prepare("SELECT * FROM user WHERE user_name=? AND password=?");
            $query->setFetchMode(PDO::FETCH_OBJ);
            $query->execute(array($user_name, $password));
            $info = $query->fetch();
            
            if($info != NULL){
                return $info->id;
            }
            else{
                return NULL;
            }
        }

        public function MaxUserID(){
            $product = $this->connect->prepare("SELECT MAX(user.id) as id FROM user");
            $product->setFetchMode(PDO::FETCH_OBJ);
            $product->execute(array());
            $product = $product->fetch();
            return $product;
        }

        public function AddUser($display_name,$email,$phone_number,$user_name,$password){
            $query = 'INSERT INTO user (display_name,email,phone_number,user_name,password) VALUES (?,?,?,?,?)';
            $add = $this->connect->prepare($query);
            $add->execute(array($display_name,$email,$phone_number,$user_name,$password));
        }

        public function UserInfo($id){
            $user = $this->connect->prepare("SELECT * FROM user WHERE id = ?");
            $user->setFetchMode(PDO::FETCH_OBJ);
            $user->execute(array($id));
            $info = $user->fetch();
            return $info;
        }

        public function CheckUserName($user_name){
            $check = $this->connect->prepare("SELECT * FROM user WHERE user_name=?");
            $check->setFetchMode(PDO::FETCH_OBJ);
            $check->execute(array($user_name));
            $count = count($check->fetchAll());
            return $count;
        }

        public function CheckID($id){
            $check = $this->connect->prepare("SELECT * FROM user WHERE id=?");
            $check->setFetchMode(PDO::FETCH_OBJ);
            $check->execute(array($user_name));
            $count = count($check->fetchAll());
            return $count;
        }

        public function CheckOldPassword($password,$id){
            $check = $this->connect->prepare("SELECT * FROM user WHERE password=? AND id=?");
            $check->setFetchMode(PDO::FETCH_OBJ);
            $check->execute(array($password,$id));
            $count = count($check->fetchAll());
            return $count;
        }
        
        public function AddUserForAdmin($user_name,$password,$display_name,$email,$phone_number,$sex,$birthday,$ship_address){
            $query = 'INSERT INTO user (user_name,password,display_name,email,phone_number,sex,birthday,ship_address) VALUES (?,?,?,?,?,?,?,?)';
            $add = $this->connect->prepare($query);
            $add->execute(array($user_name,$password,$display_name,$email,$phone_number,$sex,$birthday,$ship_address));
        }

        public function AllUser(){
            $user = $this->connect->prepare("SELECT * FROM user WHERE user_type = 'user' ORDER BY id DESC ");
            $user->setFetchMode(PDO::FETCH_OBJ);
            $user->execute(array());
            $list = $user->fetchAll();
            return $list;
        }

        public function EditUser($display_name,$email,$phone_number,$sex,$birthday,$ship_address,$id){
            $query = 'UPDATE user SET display_name=?,email=?,phone_number=?,sex=?,birthday=?,ship_address=? WHERE id = ?';
            $edit = $this->connect->prepare($query);
            $edit->execute(array($display_name,$email,$phone_number,$sex,$birthday,$ship_address,$id));
        }

        public function EditAvatar($avatar,$id){
            $query = 'UPDATE user SET avatar=? WHERE id = ?';
            $edit = $this->connect->prepare($query);
            $edit->execute(array($avatar,$id));
        }

        public function EditPassword($password,$id){
            $query = 'UPDATE user SET password=? WHERE id = ?';
            $edit = $this->connect->prepare($query);
            $edit->execute(array($password,$id));
        }

        public function DeleteUser($id){
            $query = 'DELETE FROM user WHERE id = ?';
            $Detele = $this->connect->prepare($query);
            $Detele->execute(array($id));
        }
    }
?>