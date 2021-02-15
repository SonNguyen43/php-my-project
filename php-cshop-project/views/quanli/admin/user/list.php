<?php
    require "../../../../models/user.php";

    $stt= 1;
    $user= new User();
    $info = $user->AllUser();
?>
<div class="table-responsive mb-3 table-sm shadow-bulma border">
    <table class="table table-hover table-striped text-center table-light" id="table_user">
        <thead>
            <tr style="background: #f26522;color: white">
                <th>#</th>
                <th>mã</th>
                <th>Tên_Người_Dùng</th>
                <th>Tên_Hiển_Thị</th>
                <th>Email</th>
                <th>SĐT</th>
                <th>Giới_Tính</th>
                <th>Ngày_Sinh</th>
                <th>Địa_Chỉ_GH</th>
                <th>Chức_Năng</th>
            </tr>
        </thead>
        <tbody>
            <?php
                foreach ($info as $if) {
                    ?>
                        <tr class="onRow">
                            <td><?php echo $stt++; ?></td>
                            <td><?php echo $if->id; ?></td>
                            <td><?php echo $if->user_name; ?></td>
                            <td><?php echo $if->display_name; ?></td>
                            <td><?php echo $if->email; ?></td>
                            <td><?php echo $if->phone_number; ?></td>
                            <td><?php echo $if->sex; ?></td>
                            <td><?php echo $if->birthday; ?></td>
                            <td><?php echo $if->ship_address; ?></td>
                            <td>
                                <button class="btn btn-primary" data-toggle="modal" data-target="#modal_edit_user">Sửa</button>
                                <button class="btn btn-danger" data-toggle="modal" data-target="#modal_delete_user">Xóa</button>
                            </td>
                        </tr>
                    <?php
                }
            ?>
        </tbody>
    </table>
</div>
<?php
    require "modal/edit.php";
    require "modal/delete.php";
?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.js"></script>
<script>
    $(document).ready(function(){
        $('#table_user tr.onRow').click(function (e){
            // gán dữ liệu cho modal sửa
            document.getElementById("user_id_edit").value = $(this).closest('.onRow').find('td:nth-child(2)').text().trim();
            document.getElementById("display_name_edit").value = $(this).closest('.onRow').find('td:nth-child(4)').text().trim();
            document.getElementById("user_email_edit").value = $(this).closest('.onRow').find('td:nth-child(5)').text().trim();
            document.getElementById("user_phone_number_edit").value = $(this).closest('.onRow').find('td:nth-child(6)').text().trim();
            document.getElementById("user_sex_edit").value = $(this).closest('.onRow').find('td:nth-child(7)').text().trim();
            document.getElementById("user_birthday_edit").value = $(this).closest('.onRow').find('td:nth-child(8)').text().trim();
            document.getElementById("user_ship_address_edit").value = $(this).closest('.onRow').find('td:nth-child(9)').text().trim();
            // gán dữ liệu cho modal xóa
            document.getElementById("user_id_delete").value = $(this).closest('.onRow').find('td:nth-child(2)').text().trim();
            document.getElementById("display_name_delete").value = $(this).closest('.onRow').find('td:nth-child(4)').text().trim();
            document.getElementById("user_email_delete").value = $(this).closest('.onRow').find('td:nth-child(5)').text().trim();
            document.getElementById("user_phone_number_delete").value = $(this).closest('.onRow').find('td:nth-child(6)').text().trim();
            document.getElementById("user_sex_delete").value = $(this).closest('.onRow').find('td:nth-child(7)').text().trim();
            document.getElementById("user_birthday_delete").value = $(this).closest('.onRow').find('td:nth-child(8)').text().trim();
            document.getElementById("user_ship_address_delete").value = $(this).closest('.onRow').find('td:nth-child(9)').text().trim();

        });
    });
</script>
