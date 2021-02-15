
<?php
    ob_start();
    session_start(); 

    # gọi model product để sử dụng những hàm đã được xây dựng
    require "../models/product.php";
    require "../models/product_info.php";

    # nhận được yêu cầu 
    if(isset($_GET['yeucau'])){
        switch ($_GET['yeucau']) {
            case 'them':
                if (isset($_POST['name']) && isset($_POST['prices'])  && isset($_POST['category_id']) && !empty($_FILES['files'])) {               
                    
                        $name = $_POST['name'];
                        $prices = $_POST['prices'];
                        $category_id = $_POST['category_id'];

                        $arrImg = array();

                        for($i=0;$i<count($_FILES["files"]["name"]);$i++)
                        {
                            $images=$_FILES["files"]["tmp_name"][$i];
                            $folder="../views/quanli/admin/product/images/";
                            $arrImg[$i] = rand().$_FILES["files"]["name"][$i];
                            move_uploaded_file($_FILES["files"]["tmp_name"][$i], "$folder".$arrImg[$i]);
                           
                        }

                        $strImg = json_encode($arrImg);

                        # thêm sản phẩm
                        $product = new Product();
                        $product->AddProduct($name,$prices,$strImg,$category_id);

                        # kiểm tra sản phẩm mới tạo
                        $maxID = $product->MaxProductID()->id;

                        # thêm chi tiết sản phẩm
                        date_default_timezone_set('Asia/Ho_Chi_Minh');
                        $final_updated = date('Y-m-d H:i:s',time());
                        $product_info = new ProductInfo();
                        $product_info->AddProductInfo($final_updated,$maxID);

                        
                }else{
                    echo "Không nhận được dữ liệu";
                }
            break;
            case 'xoa':
                if (isset($_POST['id'])) {
                    $id = $_POST['id'];

                    $product = new Product();

                    // xóa ảnh
                    $jsonImg = $product->ProductInfo($id)->images;
                    $arrImg = json_decode($jsonImg, true); # true chuyển về array

                    foreach ($arrImg as $img) {
                        unlink('../views/quanli/admin/product/images/' . $img);
                    }
                    // xóa csdl
                    $product->DeleteProduct($id);
                }
            break;
            case 'sua_thong_tin_san_pham':
                if (isset($_POST['id']) && isset($_POST['color']) && isset($_POST['size']) && isset($_POST['enventory_number']) && isset($_POST['description']))  {
                    $id = $_POST['id'];
                    $color = $_POST['color'];
                    $size = $_POST['size'];
                    $enventory_number = $_POST['enventory_number'];
                    $description = $_POST['description'];

                    $product_info = new ProductInfo();
                    $product_info->UpdateInfoProduct($color,$size,$enventory_number,$description,$id);

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