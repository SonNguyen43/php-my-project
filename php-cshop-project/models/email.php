b<?php
    require "./product.php";
    require "./user.php";

    // Import PHPMailer classes into the global namespace
    // These must be at the top of your script, not inside a function
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

    // Load Composer's autoloader
    require '../vendor/autoload.php';

    // Instantiation and passing `true` enables exceptions
    $mail = new PHPMailer(true);

    if (isset($_POST['product_id']) && isset($_POST['user_id'])) {

        $product_id = $_POST['product_id'];
        $user_id = $_POST['user_id'];

        # thông tin sản phẩm
        $product = new Product;
        $info_product = $product->ProductInfo($product_id);

        # thông tin người dùng
        $user = new User;
        $info_user = $user->UserInfo($user_id);

       

        try {
            //Server settings
            $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      // Enable verbose debug output
            $mail->isSMTP();                                            // Send using SMTP
            $mail->Host       = 'smtp.gmail.com';                    // Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
            $mail->Username   = 'bsin2766@gmail.com';                     // SMTP username
            $mail->Password   = 'Namntnvl1';                               // SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
            $mail->Port       = 587;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above
            $mail->setLanguage('vi', '/optional/path/to/language/directory/');

            //Recipients
            $mail->setFrom('bsin2766@gmail.com', 'CShop');
            $mail->addAddress('nbhson43@gmail.com', 'Nam');     // Add a recipient

            // Attachments
            //$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
            //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

            // Content
            $mail->isHTML(true);                                  // Set email format to HTML
            $mail->Subject = 'Order Confirmed';
            $mail->Body    = '<b style="color: red;">XÁC NHẬN ĐẶT HÀNG THÀNH CÔNG</b> Chào bạn <b>'.$info_user->display_name.'</b> <br> Bạn đã đặt hàng thành công món hàng <b>'.$info_product->name . '</b>';

            $mail->send();
            echo 'Message has been sent';
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    }


?>


