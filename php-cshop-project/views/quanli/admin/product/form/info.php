
<?php
    require "../../../../../models/product_info.php";
    
    if (isset($_REQUEST['id'])) {
        $id = $_REQUEST['id'];

        $product_info = new ProductInfo();
        $info = $product_info->Product_Info($id);
        ?> 
            <div class="form-group">
                <label for="">Số lượng tồn kho:</label>  
                <input type="text" class="form-control" name="enventory_number" required value="<?php echo $info->enventory_number;?>">
            </div>
            <div class="form-group">
                <label for="">Mô tả:</label> 
                <textarea name="description" id="" cols="30" rows="10" class="form-control"><?php echo $info->description;?></textarea> 
            </div> 
        <?php
    }
?>