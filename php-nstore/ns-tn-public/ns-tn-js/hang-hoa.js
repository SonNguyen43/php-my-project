function SuaHangHoa(mahanghoa, tenhanghoa){
    document.getElementById('mahanghoasua').value = mahanghoa;
    document.getElementById('tenhanghoasua').value = tenhanghoa;
}

function XoaHangHoa(mahanghoa, tenhanghoa){
    $('#xoahanghoa').modal('show')
    document.getElementById('mahanghoaxoa').value = mahanghoa;
    document.getElementById('tenhanghoaxoa').innerHTML = tenhanghoa;
}

function TimHangHoa(){
    $(document).ready(function() {
        var tenhanghoa = document.getElementById("tenhanghoatim").value.trim();

        $("#bangloc").load("ns-tn-view/ns-tn-quan-li/ns-tn-hang-hoa/boloc.php" , {tenhanghoa: tenhanghoa}); 
    });
}