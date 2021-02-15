<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>N'Store by Thanh Nhi</title>

    <!-- CSS -->
    <link rel="stylesheet" href="ns-tn-public/ns-tn-css/bootstrap.css">
    <link rel="stylesheet" href="ns-tn-public/ns-tn-css/app.css">
    <link rel="stylesheet" href="ns-tn-public/ns-tn-css/dang-nhap.css">
    <link rel="stylesheet" href="ns-tn-public/ns-tn-css/quan-li.css">
    <link rel="stylesheet" href="ns-tn-public/ns-tn-css/hover.css">
    <link rel="stylesheet" href="ns-tn-public/ns-tn-css/loading.css">
    <link rel="stylesheet" href="ns-tn-public/ns-tn-css/noel.css">

    <!-- FONTS -->
    <link href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans:ital@1&display=swap" rel="stylesheet">
</head>
<body class="app">

    <div class="container-fluid" id="app">
       <?php require "ns-tn-view/app.php"; ?>      
    </div>

    <!-- SCRIPT -->
    <script src="ns-tn-public/ns-tn-js/jquery-3.3.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="ns-tn-public/ns-tn-js/app.js"></script>
    <script src="ns-tn-public/ns-tn-js/nha-phan-phoi.js"></script>
    <script src="ns-tn-public/ns-tn-js/dang-nhap.js"></script>
    <script src="ns-tn-public/ns-tn-js/xuat-kho.js"></script>
    <script src="ns-tn-public/ns-tn-js/hang-ton.js"></script>
    <script src="ns-tn-public/ns-tn-js/hang-hoa.js"></script>
    <script src="ns-tn-public/ns-tn-js/nha-thuoc.js"></script>
    <script src="//cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>

    <script>
        $(document).ready(function() {
            $("#app").animate({ scrollTop: $('#app').prop("scrollHeight")}, 500);
        });
    </script>

</body>
</html>