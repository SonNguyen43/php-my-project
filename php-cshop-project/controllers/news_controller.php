<?php
    ob_start();
    session_start(); 

    # gọi model category để sử dụng những hàm đã được xây dựng
    require "../models/news.php";
    require "../models/news_info.php";

    # nhận được yêu cầu 
    if(isset($_GET['yeucau'])){
        switch ($_GET['yeucau']) {
            case 'them_tin_moi':
                if (isset($_POST) && !empty($_FILES['image'])) {
                    $fileName = rand() . $_FILES['image']['name'];
            
                    // tiến hành upload
                    move_uploaded_file($_FILES['image']['tmp_name'], '../views/quanli/admin/news/images/' . $fileName);
            
                    // thêm thông tin mới
                    $add = new News();
                    $add->AddNews($fileName);
                }
            break;
            case 'xoa_tin_tuc':
                if (isset($_POST['id'])) {
                    $id = $_POST['id'];

                    $news = new News();
                    $image = $news->NewInfos($id)->images;
                    
                    unlink('../views/quanli/admin/news/images/' . $image);

                    $news->DeleteNews($id);
                }
            break;
            case 'them_news_info':
                if (isset($_POST['content']) && isset($_POST['news_id'])) {
                    $news_id = $_POST['news_id'];
                    $content = $_POST['content'];

                    $news_info = new NewsInfo();
                    $news_info->AddNewsInfo($content, $news_id);
                }
            break;

            case 'sua_news_info':
                if (isset($_POST['content']) && isset($_POST['news_id'])) {
                    $news_id = $_POST['news_id'];
                    $content = $_POST['content'];

                    $news_info = new NewsInfo();
                    $news_info->EditNewsInfo($content,$news_id);
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

