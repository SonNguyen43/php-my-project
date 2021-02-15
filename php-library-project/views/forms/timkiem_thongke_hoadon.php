<div class="card shadow-bm pb-4">
    <div class="card-body">
        <div class="text-center mb-3">
            <h4>Chọn Ngày Xem Thống Kê Doanh Thu</h4>
        </div>
        
        <form id="form-tim">
            <label for="">Ngày bắt đầu tìm: </label>
            <input type="date" class="form-control" id="ngaybatdau">
            <label for="">Ngày kết thúc tìm: </label>
            <input type="date" class="form-control" id="ngayketthuc">
            <input type="submit" class="btn btn-primary mt-3" value="Tìm kiếm">
            <input type="reset" class="btn btn-outline-warning ml-3 mt-3" value="Làm mới" onclick="Reset()">
        </form>
    </div>
</div>

<script>
    $(document).ready(function(){
        // tìm
        $("#form-tim").on('submit', function(event){
            event.preventDefault();

            var ngaybatdau = document.getElementById("ngaybatdau").value;
            var ngayketthuc = document.getElementById("ngayketthuc").value;

            if(ngaybatdau != '' && ngayketthuc != ''){
                // console.log("Ngày bắt đầu: " + ngaybatdau + " - " + "Ngày kết thúc: " + ngayketthuc)    

                // tìm 
                $.ajax({
                    url: "views/quanli/hoadon/danhsachthongke.php",
                    method: "POST",
                    data: {ngaybatdau: ngaybatdau, ngayketthuc: ngayketthuc},
                    success: function(data){
                        $("#danhsachhoadon").html(data);
                        
                    }
                });
            }else{
                $('#form-tim')[0].reset();
                Swal.fire({  title: 'Error!',title: 'Vui lòng điền đầy đủ thông tin',icon: 'error',confirmButtonText: 'Đóng'});
            }
        });
    });

    function Reset(){
        $("#danhsachhoadon").load("views/quanli/hoadon/danhsach.php");
    }
</script>