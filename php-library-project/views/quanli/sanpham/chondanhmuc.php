<?php
    require "../../../models/danhmuc.php";
    require "../../../models/sanpham.php";

    $output = "";

    if(isset($_POST['masanpham'])){
        $masanpham = $_POST['masanpham'];

        $sanpham= new sanpham();
        $ttsp = $sanpham->thongtinsanpham($masanpham);

        $danhmuc = new danhmuc();
        $danhsachdanhmuc = $danhmuc->tatcadanhmuc();

        ?>
            <select required name="madanhmuc" id="madanhmucsua">
                <?php
                    foreach ($danhsachdanhmuc as $dsdm) {
                        ?>
                            <option value="<?php echo $dsdm->MaDanhMuc; ?>" <?php if($dsdm->MaDanhMuc == $ttsp->MaDanhMuc) echo "selected" ?> >
                                <?php echo $dsdm->TenDanhMuc;?>
                            </option>
                        <?php
                    }
                ?>
            </select>
        <?php
    }
?>
   
