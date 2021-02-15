<?php
    ob_start();
    session_start(); 

    # gọi model category để sử dụng những hàm đã được xây dựng
    require "../models/about.php";

    # nhận được yêu cầu 
    if(isset($_GET['yeucau'])){
        switch ($_GET['yeucau']) {
            case 'sua':
                if (isset($_POST['id']) && isset($_POST['address']) && isset($_POST['phone_number']) && isset($_POST['email']) && isset($_POST['business_code']) && isset($_POST['business_license'])) {
                    $id = $_POST['id'];
                    $address = $_POST['address'];
                    $phone_number = $_POST['phone_number'];
                    $email = $_POST['email'];
                    $business_code = $_POST['business_code'];
                    $business_license = $_POST['business_license'];

                    $about = new About();
                    $about -> EditAbout($address,$phone_number,$email,$business_code,$business_license,$id);
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