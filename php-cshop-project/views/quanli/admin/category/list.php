<?php
    require "../../../../models/category.php";
    
    $stt= 1;
    $category = new Category();

    if(isset($_REQUEST['name'])){
        $name = $_REQUEST['name'];
        $info = $category->SearchCaterogy($name);
    }else{
        $info = $category->AllCategory();
    }
?>
<div class="table-responsive mb-3 table-sm shadow-bulma">
    <table class="table table-hover table-striped text-center table-light" id="table_catagory" data-page-length='5'>
        <thead>
            <tr style="background: #f26522;color: white">
                <th>#</th>
                <th>mã</th>
                <th>tên danh mục</th>
                <th>hình ảnh</th>
                <th>chức năng</th>
            </tr>
        </thead>
        <tbody>
            <?php
                foreach ($info as $if) {
                    ?>
                        <tr class="onRow border-bottom">
                            <td><?php echo $stt++; ?></td>
                            <td><?php echo $if->id; ?></td>
                            <td><?php echo $if-> name; ?></td>
                            <td><img src="views/quanli/admin/category/images/<?php echo $if->image?>" alt="" width="100px" height="100px"></td>
                            <td>
                                <button class="btn btn-primary" data-toggle="modal" data-target="#edit_category" onclick="GetInfoCategory(<?php echo $if->id?>, <?php echo $if->name?>)">Sửa</button>
                                <button class="btn btn-danger" data-toggle="modal" data-target="#delete_category">Xóa</button>
                            </td>
                        </tr>
                    <?php
                }
            ?>
        </tbody>
    </table>
</div>

<?php
    require "./modal/edit.php";
    require "./modal/delete.php";
?>

<script>
    $(document).ready(function(){
        $('#table_catagory').DataTable({
            scrollY: 350,
            searching: false,
            // paging: false
        });

        $('#table_catagory tr').click(function (e) {

            // gán dữ liệu cho modal xóa
            document.getElementById("catagory_id_delete").value = $(this).closest('.onRow').find('td:nth-child(2)').text().trim();
            document.getElementById("catagory_name_delete").innerHTML = $(this).closest('.onRow').find('td:nth-child(3)').text().trim();

            // gán dữ liệu cho modal sửa
            document.getElementById("catagory_id_edit").value = $(this).closest('.onRow').find('td:nth-child(2)').text().trim();
            document.getElementById("category_name_edit").value = $(this).closest('.onRow').find('td:nth-child(3)').text().trim();            
        });
    });
</script>


<style>
    #table_catagory_length{
        display: none;
    }
    a {
        color: #fff;
    }
    .paginate_button {
        background-color:#f26522;
    }
</style>
