<?php
    $str1 = 'database/connect_news.php';
    $str2 = '../database/connect_news.php';
    $str3 = '../../database/connect_news.php';
    $str4 = '../../../database/connect_news.php';
    $str5 = '../../../../database/connect_news.php';

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
  
    class News extends DatabaseNews{
        
        public function AddNews($image){
            $query = 'INSERT INTO news (images) VALUES (?)';
            $create = $this->connect->prepare($query);
            $create->execute(array($image));
        }

        public function AllNews(){
            $news = $this->connect->prepare("SELECT * FROM news ORDER BY id DESC");
            $news->setFetchMode(PDO::FETCH_OBJ);
            $news->execute(array());
            $news = $news->fetchAll();
            return $news;
        }

        public function NewInfos($id){
            $news = $this->connect->prepare("SELECT * FROM news WHERE id = ?");
            $news->setFetchMode(PDO::FETCH_OBJ);
            $news->execute(array($id));
            $info = $news->fetch();
            return $info;
        }

        public function DeleteNews($id){
            $query = 'DELETE FROM news WHERE id = ?';
            $Detele = $this->connect->prepare($query);
            $Detele->execute(array($id));
        }

        public function CkeckNewInfos($id){
            $check = $this->connect->prepare("SELECT * FROM news WHERE id=?");
            $check->setFetchMode(PDO::FETCH_OBJ);
            $check->execute(array($id));
            $count = count($check->fetchAll());
            return $count;
        }
    }
?>