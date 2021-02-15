<?php
    $str1 = 'database/connect_about.php';
    $str2 = '../database/connect_about.php';
    $str3 = '../../database/connect_about.php';
    $str4 = '../../../database/connect_about.php';
    $str5 = '../../../../database/connect_about.php';

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
  
    class About extends DatabaseAbout{
        
        public function AllAbout(){
            $about = $this->connect->prepare("SELECT * FROM about ORDER BY id DESC");
            $about->setFetchMode(PDO::FETCH_OBJ);
            $about->execute(array());
            $about = $about->fetchAll();
            return $about;
        }

        public function AboutInfo($id){
            $about = $this->connect->prepare("SELECT * FROM about WHERE id = ?");
            $about->setFetchMode(PDO::FETCH_OBJ);
            $about->execute(array($id));
            $info = $about->fetch();
            return $info;
        }

        public function EditAbout($address,$phone_number,$email,$business_code,$business_license,$id){
            $query = 'UPDATE about SET address = ?, phone_number=?,email=?,business_code=?,business_license=?   WHERE id = ?';
            $Edit = $this->connect->prepare($query);
            $Edit->execute(array($address,$phone_number,$email,$business_code,$business_license,$id));
        }
    }
?>
<!-- phone_number = ?, email = ?, business_code = ?, business_license = ? -->