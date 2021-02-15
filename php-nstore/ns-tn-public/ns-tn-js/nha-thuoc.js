// function SuaHangHoa(mahanghoa, tenhanghoa){
//     document.getElementById('mahanghoasua').value = mahanghoa;
//     document.getElementById('tenhanghoasua').value = tenhanghoa;
// }

// function XoaHangHoa(mahanghoa, tenhanghoa){
//     $('#xoahanghoa').modal('show')
//     document.getElementById('mahanghoaxoa').value = mahanghoa;
//     document.getElementById('tenhanghoaxoa').innerHTML = tenhanghoa;
// }

function TimNhaThuoc(){
    $(document).ready(function() {
        var tennhathuoc = document.getElementById("tennhathuoc").value.trim();
        var sodienthoai = document.getElementById("sodienthoainhathuoc").value.trim();
        
        $("#bangloc").load("ns-tn-view/ns-tn-quan-li/ns-tn-nha-thuoc/boloc.php" , {tennhathuoc: tennhathuoc, sodienthoai: sodienthoai}); 
            
    });
}


