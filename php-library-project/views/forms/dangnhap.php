<div class="container">
    <form method="POST" action="controllers/nhanvienController.php?yeucau=dangnhap" class="col-md-6 offset-md-1 p-5 mt-4 card shadow border-none" style="border-radius: 40px;">
        <h3 class="text-center">ĐĂNG NHẬP</h3>
        <div class="form-group">
            <label for="">Số điện thoại: </label>
            <input type="text" name="sodienthoai" class="" required><div style="margin-top:-25px"><i class="fas fa-user"></i></div>
        </div>
        <div class="form-group">
            <label for="">Mật khẩu: </label>
            <input type="password" name="matkhau" class="" required><div style="margin-top:-25px"><i class="fas fa-key"></i></div>
        </div>
        <div class="form-group text-center">
            <input type="submit" value="Đăng Nhập" class="btn btn-success">
        </div>
        <small class="text-center mt-3">- Hệ Thống Quản Lí Bán Sách -</small>
    </form>
</div>

<style>
    body{
        height: 100vh;
        overflow: hidden;
        background: url('./public/images/background.jpg');
        background-size: cover;
    }
    .card{
        background-color: rgba(255, 255, 255, 0.9);
    }
    .container{
        height:100vh;
    }
    form{
        position: absolute;
        top: 40%;
        transform: translateY(-40%);
    }
    input[type="text"], input[type="password"] {
        width:100%;
        border:none;
        border-bottom:1px solid #ccc;
        outline:none;
        padding-left:25px;
        font-size: 18px;
        background: rgba(255,255,255,.0);
    }

    input[type="text"]:hover, input[type="password"]:hover {
        border-bottom:1px solid #000;
    }

    input[type="text"]:focus, input[type="password"]:focus {
        border-bottom:1px solid #000;
    }
</style>