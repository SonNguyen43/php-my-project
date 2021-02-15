<?php
    require "../../../../models/news.php";

    $stt= 1;
    $news = new News();
    $info = $news->AllNews();
?>
<div class="table-responsive mb-3 table-sm shadow-bulma">
    <table class="table table-hover table-striped text-center table-light" id="table_catagory">
        <thead>
            <tr style="background: #f26522;color: white">
                <th>#</th>
                <th>mã</th>
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
                            <td><img src="./views/quanli/admin/news/images/<?php echo $if->images; ?>" alt="" width="200px" height="100px"></td>
                            <td>
                                <a href="./?tin_tuc=sua&id=<?php echo $if->id;?>" class="btn btn-primary">Sửa</a>
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
    require "./modal/delete.php";
?>

<script>
    $(document).ready(function(){
        $('#table_catagory tr').click(function (e) {
            // gán dữ liệu cho modal xóa
            document.getElementById("news_id_delete").value = $(this).closest('.onRow').find('td:nth-child(2)').text().trim();
        });
    });
</script>
