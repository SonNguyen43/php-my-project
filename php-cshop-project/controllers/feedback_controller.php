<?php
    ob_start();
    session_start();

    # gọi model USER để sử dụng những hàm đã được xây dựng
    require "../models/feedback.php";

    # nhận được yêu cầu 
    if(isset($_GET['yeucau'])){
        switch ($_GET['yeucau']) {
            case 'xoa':
                if (isset($_POST['id'])) {
                    $id = $_POST['id'];

                    $feedback = new Feedback();
                    $feedback->DeteleFeedback($id);
                } 
            break;
            case 'them':
                if (isset($_POST['id']) && isset($_POST['content'])) {
                    $id = $_POST['id'];
                    $content = $_POST['content'];

                    $feedback = new Feedback();
                    $feedback->AddFeedback($content,$id);

                    require '../vendor/autoload.php';

                    #PUSHER
                    $options = array(
                        'cluster' => 'ap1',
                        'useTLS' => true
                    );
                    $pusher = new Pusher\Pusher(
                        'd35330d6cf9f6fa10fcd',
                        '5edbcd39e88a683f1f55',
                        '1008715',
                        $options
                    );

                    $data['message'] = 'reload feedback';
                    $pusher->trigger('my-channel', 'my-event', $data);
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