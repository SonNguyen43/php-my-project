<?php
    require "../../../../models/feedback.php";
    require "../../../../models/user.php";

    $user= new User();

    $stt= 1;
    $feedback = new Feedback();
    $info = $feedback->AllFeedback();

?>
<div class="table-responsive mb-3 table-sm shadow-bulma border">
    <table class="table table-hover table-striped text-center table-light" id="table_feedback" data-page-length='10'>
        <thead>
            <tr class="text-center">
                <th colspan="5"><h3>PHẢN HỒI CỦA NGƯỜI DÙNG</h3></th>
            </tr>
            <tr style="background: #f26522;color: white">
                <th>#</th>
                <th>mã</th>
                <th>tên người dùng</th>
                <th>nội dung</th>
                <th>chức năng</th>
            </tr>
        </thead>
        <tbody>
            <?php
                foreach ($info as $if) {
                    ?>
                        <tr class="onRow">
                            <td><?php echo $stt++; ?></td>
                            <td><?php echo $if->id; ?></td>
                            <td><?php echo  $user-> UserInfo($if->user_id)->display_name; ?></td>
                            <td><?php echo $if-> content; ?></td>
                            <td>
                                <button class="btn btn-danger" data-toggle="modal" data-target="#delete_feedback">Xóa</button>
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
        $('#table_feedback').DataTable({
            searching: false,
            // paging: false
        });

        $('#table_feedback tr.onRow').click(function (e) {
            // gán dữ liệu cho modal xóa
            document.getElementById("feedback_id_delete").value = $(this).closest('.onRow').find('td:nth-child(2)').text().trim();
            document.getElementById("feedback_name_delete").innerHTML = $(this).closest('.onRow').find('td:nth-child(3)').text().trim();
        });
    });
</script>

<style>
    #table_feedback_length{
        display: none;
    }
    .dataTables_paginate {
        color: #fff;
    }
    .paginate_button {
        background-color:#f26522;
    }
</style>
