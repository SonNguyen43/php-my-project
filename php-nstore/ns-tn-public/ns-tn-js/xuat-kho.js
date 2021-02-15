function SoDienThoaiThemDonHang(){

    $(document).ready(function() {
        var sodienthoai = document.getElementById("sodienthoaithemdonhang").value.trim();
      
        $("#thongtinkhachthem").load("ns-tn-view/ns-tn-quan-li/ns-tn-xuat-kho/thong-tin-khach-them.php" , {sodienthoai: sodienthoai, sodienthoai: sodienthoai}); 
      
   });
}

function SuaThongTinHangHoaDonHang(madonhang,makhachhang,machitiethanghoadonhang, soluong, ngaysanxuat){
    var machitiethanghoadonhangsua = machitiethanghoadonhang;
    var soluongsua = soluong;
    var ngaysanxuatsua = ngaysanxuat;
    var makhachhangsua = makhachhang;
    var madonhangsua = madonhang;

    document.getElementById("machitiethanghoadonhangsua").value = machitiethanghoadonhangsua;
    document.getElementById("soluongsua").value = soluongsua;
    document.getElementById("ngaysanxuatsua").value = ngaysanxuatsua;
    document.getElementById("makhachhangsua").value = makhachhangsua;
    document.getElementById("madonhangsua").value = madonhangsua;

    document.getElementById("machitiethanghoadonhangsuadatao").value = machitiethanghoadonhangsua;
    document.getElementById("soluongsuadatao").value = soluongsua;
    document.getElementById("ngaysanxuatsuadatao").value = ngaysanxuatsua;
    document.getElementById("makhachhangsuadatao").value = makhachhangsua;
    document.getElementById("madonhangsuadatao").value = madonhangsua;
}

function ChiTietDonHang(ngaytao, mabill, maadmin){
    var thontinngaytao = ngaytao;
    var thontinmabill = mabill; 
    var thontinmaadmin = maadmin;

    var nam = ngaytao.slice(0,4);
    var thang = ngaytao.slice(5,7);
    var ngay = ngaytao.slice(8,10);
    var ngaytao_final = ngay + "-" + thang + "-" + nam;

    document.getElementById("mabillchitiet").value = thontinmabill;
    document.getElementById("nguoitao").value = thontinmaadmin;
    document.getElementById("ngaytao").value = ngaytao_final;
}

function TimDonHang(){
    $(document).ready(function() {
        var mabill = document.getElementById("mabill").value.trim();
        var tenkhach = document.getElementById("tenkhachtim").value.trim();
        var sodienthoai = document.getElementById("sodienthoaikhachtim").value.trim();
        var ngaybatdautim = document.getElementById("ngaybatdautim").value.trim();
        var ngayketthuctim = document.getElementById("ngayketthuctim").value.trim();
        
        $("#bangloc").load("ns-tn-view/ns-tn-quan-li/ns-tn-xuat-kho/boloc.php" , {tenkhach: tenkhach, sodienthoai: sodienthoai, ngaybatdautim: ngaybatdautim, ngayketthuctim: ngayketthuctim, mabill: mabill}); 
      
   });
}

function TimDonHangVoiNgaySanXuat(){
    $(document).ready(function() {
        var ngaysanxuatsanpham = document.getElementById("ngaysanxuatsanpham").value.trim();

        $("#bangloc").load("ns-tn-view/ns-tn-quan-li/ns-tn-xuat-kho/bolocngaysanxuat.php" , {ngaysanxuatsanpham: ngaysanxuatsanpham}); 
   });
}