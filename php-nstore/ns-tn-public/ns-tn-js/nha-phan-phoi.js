/* Xem thêm những thông tin của nhà phân phối */
function XemThemThongTin(makhachhang, hovaten, mahopdong, macuahang, hethongnhaphanphoi, danghi, tenadmin,ngaytao, ngaysua, ngaylencap){
   
    var xem_hovaten = hovaten;
    var xem_mahopdong = mahopdong;
    var xem_macuahang = macuahang;
    var xem_hethongnhaphanphoi = hethongnhaphanphoi;
    var xem_danghi = danghi;
    var xem_tenadmin = tenadmin;
    var xem_ngaytao = ngaytao;
    var xem_ngaysua = ngaysua;
    var xem_ngaylencap = ngaylencap;

    // debugger

    var xem_lichsuthaydoi = "index.php?page=lichsusuanhaphanphoi&id=" + makhachhang;

    if(xem_danghi == "chuanghi"){
        xem_danghi = "Chưa nghĩ";
    }else{
        xem_danghi = "Đã nghĩ";
    }
   
    var nam = xem_ngaylencap.slice(0,4);
    var thang = xem_ngaylencap.slice(5,7);
    var ngay = xem_ngaylencap.slice(8,10);
    var ngaylencap_final = ngay + "-" + thang + "-" + nam;

    var nam = xem_ngaytao.slice(0,4);
    var thang = xem_ngaytao.slice(5,7);
    var ngay = xem_ngaytao.slice(8,10);
    var ngaytao_final = ngay + "-" + thang + "-" + nam;

    var nam = xem_ngaysua.slice(0,4);
    var thang = xem_ngaysua.slice(5,7);
    var ngay = xem_ngaysua.slice(8,10);
    var ngaysua_final = ngay + "-" + thang + "-" + nam;


    document.getElementById("xem_tenkhachhang").innerHTML = xem_hovaten;
    document.getElementById("xem_mahopdong").innerHTML = xem_mahopdong;
    document.getElementById("xem_macuahang").innerHTML = xem_macuahang;
    document.getElementById("xem_hethongnhaphanphoi").innerHTML = xem_hethongnhaphanphoi;
    document.getElementById("xem_danghi").innerHTML = xem_danghi;
    document.getElementById("xem_tenadmin").innerHTML = xem_tenadmin;
    document.getElementById("xem_ngaytao").innerHTML = ngaytao_final;
    document.getElementById("xem_ngaysua").innerHTML = ngaysua_final;
    document.getElementById("xem_ngaylencap").innerHTML = ngaylencap_final;
    
    document.getElementById("xem_lichsuthaydoi").href = xem_lichsuthaydoi;
    
}

function TimKhachHang(){
    $(document).ready(function() {
        var tenkhach = document.getElementById("tenkhachtim").value.trim();
        var sodienthoai = document.getElementById("sodienthoaikhachtim").value.trim();
        var cmnd = document.getElementById("cmnd").value.trim();
      
        $("#bangloc").load("ns-tn-view/ns-tn-quan-li/ns-tn-nha-phan-phoi/boloc.php" , {tenkhach: tenkhach, sodienthoai: sodienthoai,cmnd: cmnd}); 
      
   });
}

function TimKhachHangCoCuaHang(){
    $(document).ready(function() {
        var tenkhach = document.getElementById("tenkhachtim").value.trim();
        var sodienthoai = document.getElementById("sodienthoaikhachtim").value.trim();
        var cmnd = document.getElementById("cmnd").value.trim();
      
        $("#bangloc").load("ns-tn-view/ns-tn-quan-li/ns-tn-nha-phan-phoi/boloc-cuahang.php" , {tenkhach: tenkhach, sodienthoai: sodienthoai,cmnd: cmnd}); 
      
   });
}

function CheckSoDienThoai(){
    $(document).ready(function() {
        var sodienthoai = document.getElementById("sodienthoaicheck").value.trim();
        
        $("#showthongtinsodienthoai").load("ns-tn-view/ns-tn-quan-li/ns-tn-nha-phan-phoi/tao-nha-phan-phoi-qua-duong.php" , {sodienthoai: sodienthoai}); 
      
   });
}