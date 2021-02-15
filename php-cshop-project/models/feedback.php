<?php

    $str1 = 'database/connect_feedback.php';
    $str2 = '../database/connect_feedback.php';
    $str3 = '../../database/connect_feedback.php';
    $str4 = '../../../database/connect_feedback.php';
    $str5 = '../../../../database/connect_feedback.php';

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

    class Feedback extends DatabaseFeedback{

        public function AllFeedback () {
            $feedback = $this->connect->prepare("SELECT * FROM feedback ORDER BY id DESC");
            $feedback->setFetchMode(PDO::FETCH_OBJ);
            $feedback->execute(array());
            $feedback = $feedback->fetchAll();
            return $feedback;
        }
        public function DeteleFeedback($id){
            $query = 'DELETE FROM feedback WHERE id = ?';
            $Detele = $this->connect->prepare($query);
            $Detele->execute(array($id));
        }

        public function AddFeedback($content,$user_id){
            $query = 'INSERT INTO feedback (content,user_id) VALUES (?,?)';
            $create = $this->connect->prepare($query);
            $create->execute(array($content,$user_id));
        }
    }
?>