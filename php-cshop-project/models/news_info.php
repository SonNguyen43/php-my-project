<?php
    $str1 = 'database/connect_news_info.php';
    $str2 = '../database/connect_news_info.php';
    $str3 = '../../database/connect_news_info.php';
    $str4 = '../../../database/connect_news_info.php';
    $str5 = '../../../../database/connect_news_info.php';

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
  
    class NewsInfo extends DatabaseNewsInfo{
        
        public function AddNewsInfo($content, $news_id){
            $query = 'INSERT INTO new_info (content,news_id) VALUES (?,?)';
            $create = $this->connect->prepare($query);
            $create->execute(array($content, $news_id));
        }

        public function News_Info($id){
            $news = $this->connect->prepare("SELECT * FROM new_info WHERE news_id = ?");
            $news->setFetchMode(PDO::FETCH_OBJ);
            $news->execute(array($id));
            $info = $news->fetch();
            return $info;
        }

        public function CheckCountNewsInfo($id){
            $check = $this->connect->prepare("SELECT * FROM new_info WHERE news_id=?");
            $check->setFetchMode(PDO::FETCH_OBJ);
            $check->execute(array($id));
            $count = count($check->fetchAll());
            return $count;
        }

        public function EditNewsInfo($content,$news_id){
            $query = 'UPDATE new_info SET content=? WHERE news_id = ?';
            $Edit = $this->connect->prepare($query);
            $Edit->execute(array($content,$news_id));
        }

    }
?>