<?php
    require "../../../ns-tn-model/hang-hoa-class.php";

    # dữ liệu nhận được từ nha-phan-phoi.js
    if(isset($_REQUEST['tenhanghoa'])){
        $tenhanghoa = trim($_REQUEST['tenhanghoa']);
            ?>
                <table class="table table-hover table-bordered table-sm table-light text-center mb-3">
                        <thead>
                            <tr>
                                <th scope="col" colspan="8">TẤT CẢ HÀNG HÓA</th>
                            </tr>
                            <tr class="bg-browns text-light">
                                <th scope="col">#</th>
                                <th scope="col">Tên Hàng Hóa</th>
                                <th scope="col">Chức năng</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                            $hanghoa = new hanghoaclass();
                            $thongtin = $hanghoa->TimHangHoa($tenhanghoa);
                            $stt = 1;
                        
                            foreach ($thongtin as $tt) {
                        ?>
                            <tr>
                                <th scope="row"><?php echo $stt++; ?></th>
                                <td><b><?php echo $tt->tenhanghoa ?></b></td>
                                <td>
                                    <button class="btn btn-primary rounded-pill" data-toggle="modal" data-target="#suahanghoa" onclick="SuaHangHoa('<?php echo $tt->mahanghoa;?>','<?php echo $tt->tenhanghoa ?>')">Sửa</button>
                                    <button class="btn btn-danger rounded-pill" title="Nhấp 2 lần" ondblclick="XoaHangHoa('<?php echo $tt->mahanghoa;?>','<?php echo $tt->tenhanghoa ?>')">Xóa</button>  
                                </td>
                            </tr>
                        <?php
                            }
                        ?>
                        </tbody>
                    </table>    <!-- END TABLE -->
            <?php
    }else{  
        ?>
            <div class="alert alert-danger" role="alert">
                Lỗi... Không nhận được dữ liệu tìm kiếm...!
            </div>
        <?php
    }
?>