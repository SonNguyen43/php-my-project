/* Sử dụng cho thông báo alert - Khi ấn phím bất kì thì thông báo với id alert sẽ biến mất */
window.onkeypress = function(event){
    if(event.keyCode == 32){   
        var alertSuccess = document.getElementById("message");
        if(alertSuccess != null){
            alertSuccess.style.display = 'none';
        }
    }
}

window.onload = function()
{
    if ($('#thongtincanhandangki').length) {
        document.getElementById("thongtincanhandangki").style.display = "none";
    }

    console.error("%c CẢNH BÁO %c", 
    'font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;font-size:24px;color:red;-webkit-text-fill-color:red;-webkit-text-stroke: 1px red;',
     "font-size:12px;color:red;");

    console.warn("%c ĐÂY LÀ CHỨC NĂNG DÀNH CHO NHÀ PHÁT TRIỂN %c", 
    'font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;font-size:24px;color:red;-webkit-text-fill-color:red;-webkit-text-stroke: 1px red;',
     "font-size:12px;color:red;");

    console.warn("Đây là một tính năng của trình duyệt dành cho các nhà phát triển. Nếu ai đó bảo bạn sao chép-dán nội dung nào đó vào đây để bật một tính năng của N'Store by Thanh Nhi hoặc 'hack' tài khoản của người khác, thì đó là hành vi lừa đảo và sẽ khiến họ có thể truy cập vào tài khoản N'Store by Thanh Nhi của bạn");

};



