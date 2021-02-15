<?php
    require "../../../../models/about.php";

    $stt= 1;
    $about= new About();
    $info = $about->AllAbout();
?>
<div class="table-responsive mb-3 table-sm shadow-bulma border mt-3">
    <table class="table table-hover table-striped text-center table-light" id="table_about">
        <thead>
            <tr class="text-center">
                <th colspan="8"><h3>GIỚI THIỆU TRANG WEB</h3></th>
            </tr>
            <tr style="background: #f26522;color: white">
                <th>mã</th>
                <th>địa chỉ</th>
                <th>SĐT</th>
                <th>email</th>
                <th>mã DN</th>
                <th>GPKD</th>
                <th>chức năng</th>
            </tr>
        </thead>
        <tbody>
            <?php
                foreach ($info as $if) {
                    ?>
                        <tr class="onRow">
                            <td><?php echo $if->id; ?></td>
                            <td><?php echo $if->address; ?></td>
                            <td><?php echo $if->phone_number; ?></td>
                            <td><?php echo $if->email; ?></td>
                            <td><?php echo $if->business_code; ?></td>
                            <td><?php echo $if->business_license; ?></td>
                            <td>
                                <button class="btn btn-primary" data-toggle="modal" data-target="#edit_about">Sửa</button>
                            </td>
                        </tr>
                    <?php
                }
            ?>
        </tbody>
    </table>
</div>
<?php
    require "modal/edit.php"
?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.js"></script>
<script>
    $(document).ready(function(){
        $('#table_about tr.onRow').click(function (e) {
            // gán dữ liệu cho modal sửa
            document.getElementById("about_id_edit").value = $(this).closest('.onRow').find('td:nth-child(1)').text().trim();
            document.getElementById("about_address_edit").value = $(this).closest('.onRow').find('td:nth-child(2)').text().trim();
            document.getElementById("about_phone_number_edit").value = $(this).closest('.onRow').find('td:nth-child(3)').text().trim();
            document.getElementById("about_email_edit").value = $(this).closest('.onRow').find('td:nth-child(4)').text().trim();
            document.getElementById("about_business_code_edit").value = $(this).closest('.onRow').find('td:nth-child(5)').text().trim();
            document.getElementById("about_business_license_edit").value = $(this).closest('.onRow').find('td:nth-child(6)').text().trim();
            
        });
    });
</script>