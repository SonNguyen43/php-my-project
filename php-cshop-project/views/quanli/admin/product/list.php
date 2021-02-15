<?php
    require "../../../../models/product.php";

    $stt= 1;
    $product = new Product();

    if(isset($_REQUEST['name'])){
        $info = $product->SearchProduct($_REQUEST['name']);
    }else{
        $info = $product->AllProduct();
    }

?>
<div class="table-responsive mb-3 table-sm shadow-bulma">
    <table class="table table-hover table-striped text-center table-light" id="table_product"  data-page-length='3'>
        <thead>
            <tr style="background: #f26522;color: white">
                <th>#</th>
                <th>mã</th>
                <th>Tên_sản_phẩm</th>
                <th>Đơn giá</th>
                <th>Tên_danh_mục</th>
                <th>Chức năng</th>
            </tr>
        </thead>
        <tbody>
            <?php
                foreach ($info as $if) {
                    ?>
                        <tr class="onRow border-bottom">
                            <td><?php echo $stt++; ?></td>
                            <td><?php echo $if->id; ?></td>
                            <td><?php echo $if->name; ?></td>
                            <td><?php echo number_format($if->prices) ; ?></td>
                            <td><?php echo $product->CategoryInfo($if->category_id)->name; ?></td>
                            <td>
                                <button class="btn btn-primary" data-toggle="modal" data-target="#modal_edit_product_info">Sửa</button>
                                <button class="btn btn-danger" data-toggle="modal" data-target="#modal_delete_product">Xóa</button>
                            </td>
                        </tr>
                    <?php
                }
            ?>
        </tbody>
    </table>
</div>
<?php
    require "modal/delete.php";
    require "modal/edit.php";
?> 
 <!-- JS -->
<script>
    $(document).ready(function(){
        $('#table_product').DataTable({
            scrollY: 200,
            searching: false,
            // paging: false
        });

        $('#table_product tr').click(function (e) {
            // gán dữ liệu cho modal xóa
            document.getElementById("product_id_delete").value = $(this).closest('.onRow').find('td:nth-child(2)').text().trim();
            //gán dữ liệu cho sửa
            document.getElementById("product_id_edit").value = $(this).closest('.onRow').find('td:nth-child(2)').text().trim();

            //
            var id = $(this).closest('.onRow').find('td:nth-child(2)').text().trim();
            $("#info_product").load("views/quanli/admin/product/form/info.php" , {id: id}); 
        });
    });
</script>

<style>
    #table_product_length{
        display: none;
    }
    .dataTables_paginate {
        color: #fff;
    }
    .paginate_button {
        background-color:#f26522;
    }
</style>
