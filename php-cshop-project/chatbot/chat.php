<?php
    require_once 'vendor/autoload.php';

    use BotMan\BotMan\BotMan;
    use BotMan\BotMan\BotManFactory;
    use BotMan\BotMan\Drivers\DriverManager;
    
    $config = [
        // Your driver-specific configuration
        // "telegram" => [
        //    "token" => "TOKEN"
        // ]
    ];

    DriverManager::loadDriver(\BotMan\Drivers\Web\WebDriver::class);
    $botman = BotManFactory::create($config);

    // Give the bot something to listen for.
    $botman->hears('Xin chào', function (BotMan $bot) {
        $bot->reply('Chào bạn');
    });
    $botman->hears('Tôi muốn mua hàng', function (BotMan $bot) {
        $bot->reply('Rất đơn giản, bạn chỉ cần nhấn vào chi tiết của một sản phẩm nào đó và ấn mua ngay, hoặc bạn có thể ấn để thêm nó vào giỏ hàng để thực hiện thanh toán những lần sau.');
    });
    $botman->hears('Tôi muốn liên hệ người bán', function (BotMan $bot) {
        $bot->reply('Bạn có thể liên hệ bằng cách sau: 0766899363 (điện thoại) hoặc nbhson43@gmail.com (email)');
    });
    $botman->fallback(function($bot) {
        $bot->reply('Ohh !!!, tôi chưa được lập trình để hiểu ý này của bạn !!!');
    });

    // Start listening
    $botman->listen();