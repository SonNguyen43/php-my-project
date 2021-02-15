<?php
    ob_start();
    session_start(); 

    # gọi model category để sử dụng những hàm đã được xây dựng
    require "../models/category.php";

    # nhận được yêu cầu 
    if(isset($_GET['yeucau'])){
        switch ($_GET['yeucau']) {
            case 'them':
                if (isset($_POST['name']) && isset($_POST) && !empty($_FILES['image'])) {
                    $name = $_POST['name'];
                    $fileName = rand() . $_FILES['image']['name'];
            
                    // tiến hành upload
                    move_uploaded_file($_FILES['image']['tmp_name'], '../views/quanli/admin/category/images/' . $fileName);
            
                    // thêm thông tin mới
                    $add = new Category();
                    $add->AddCategory($name,$fileName);
                }
            break;
            case 'xoa':
                if (isset($_POST['id'])) {
                    $id = $_POST['id'];

                    $catagory = new Category();
                    $image = $catagory->CatagoryInfo($id)->image;
                    
                    unlink('../views/quanli/admin/category/images/' . $image);

                    $catagory->DeteleCategory($id);
                }
            break;
            case 'sua':
                if (isset($_POST['id'])) {
                    $id = $_POST['id'];
                    $name = $_POST['name'];

                    $catagory = new Category();
                    $image = $catagory->EditNameCategory($name,$id);
                }
            break;
            case 'sua_anh':
                if (isset($_POST['id']) && isset($_POST['name']) && isset($_POST) && !empty($_FILES['image'])) {
                    $id = $_POST['id'];
                    $name = $_POST['name'];

                    $catagory = new Category();
                    // xóa ảnh cũ
                    $image = $catagory->CatagoryInfo($id)->image;
                    unlink('../views/quanli/admin/category/images/' . $image);

                    // tiến hành upload ảnh mới
                    $fileName = rand() . $_FILES['image']['name'];
                    move_uploaded_file($_FILES['image']['tmp_name'], '../views/quanli/admin/category/images/' . $fileName);

                    $catagory->EditImageCategory($name,$fileName,$id);
                }else{
                    echo $_POST['id'];
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