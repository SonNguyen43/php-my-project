<?php
    ob_start();
    session_start(); 

    # gọi model category để sử dụng những hàm đã được xây dựng
    require "../models/comment_product.php";
    require "../models/user.php";

    # nhận được yêu cầu 
    if(isset($_GET['yeucau'])){
        switch ($_GET['yeucau']) {
            case 'them':
                if (isset($_POST['contents']) && isset($_POST['product_id']) && isset($_POST['rating']) && isset($_POST['user_id'])) {
                    $contents = $_POST['contents'];
                    $product_id = $_POST['product_id'];
                    $rate = $_POST['rating'];

                    date_default_timezone_set('Asia/Ho_Chi_Minh');
                    $created_at = date('Y-m-d H:i:s',time());

                    $user_id = $_POST['user_id'];

                    $comment = new CommentProduct();
                    $comment -> AddComment($contents,$rate,$created_at,$product_id,$user_id);
                }
            break;
            case 'xoa':
                if (isset($_POST['comment_id'])) {
                    $comment_id = $_POST['comment_id'];

                    $comment = new CommentProduct();
                    $comment -> DeteleComment($comment_id);
                }
            break;
        }
    }
    # không nhận được yêu cầu
    else{
        header("Location: ../?khong_co_du_lieu");
    }
    ob_end_flush();
?>