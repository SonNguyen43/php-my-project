function SoDienThoaiThemDonHangTon(){

    $(document).ready(function() {
        var sodienthoai = document.getElementById("sodienthoaithemdonhang").value.trim();
      
        $("#thongtinkhachthem").load("ns-tn-view/ns-tn-quan-li/ns-tn-ton-kho/thong-tin-khach-them.php" , {sodienthoai: sodienthoai, sodienthoai: sodienthoai}); 
    });
}

function TimDonHangTon(){
    $(document).ready(function() {
        var tenkhachtim = document.getElementById("tenkhachtim").value.trim();
        var sodienthoaikhachtim = document.getElementById("sodienthoaikhachtim").value.trim();
        var ngaybatdautim = document.getElementById("ngaybatdautim").value.trim();
        var ngayketthuctim = document.getElementById("ngayketthuctim").value.trim();

      
        $("#bangloc").load("ns-tn-view/ns-tn-quan-li/ns-tn-ton-kho/boloc.php" , {tenkhachtim: tenkhachtim, sodienthoaikhachtim: sodienthoaikhachtim, ngaybatdautim: ngaybatdautim, ngayketthuctim: ngayketthuctim}); 
    });
}

function SuaThongTinHangHoaDonHangTon(mahangton, makhachhang ,machitiethanghoahangton, soluong){
    var mahangtonsua = mahangton;
    var machitiethanghoadonhangsua = machitiethanghoahangton;
    var soluongsua = soluong;
    var makhachhangsua = makhachhang;
   
    document.getElementById("makhachhangsuahangton").value = makhachhangsua;
    document.getElementById("mahangtonsua").value = mahangtonsua;
    document.getElementById("machitiethanghoadonhangsua").value = machitiethanghoadonhangsua;
    document.getElementById("soluongsua").value = soluongsua;

    document.getElementById("makhachhangsuadatao").value = makhachhangsua;
    document.getElementById("madonhangsuadatao").value = mahangtonsua;
    document.getElementById("machitiethanghoadonhangsuadatao").value = machitiethanghoadonhangsua;
    document.getElementById("soluongsuadatao").value = soluongsua;
}

function ChiTietDonHangTon(tenadmin){
    var tenadmintao = tenadmin;

    document.getElementById("nguoitao").innerHTML = tenadmintao;
}