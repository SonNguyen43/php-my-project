<div class="height d-flex align-items-center">
    <div class="jumbotron mt-4 d-flex align-items-center rounded-0 w-100">
        <div class="row d-flex justify-content-center align-items-center w-100">
            <div class="col-md-5 d-flex justify-content-center position-relative box" style="display: none">
                <span class="position-absolute shop">
                    <span>Shop</span>
                </span>
                <img src="./public/images/logo/logo.png" width="300px" height="280px" class="">
            </div>
            <div class="col-md-7">
                <div class="card p-3">
                    <div class="card-body">
                        <form action="controllers/user_controller.php?yeucau=dangki" method="post">
                            <h3>ĐĂNG KÍ</h3>
                            <div class="row">
                                <div class="col-md-6">
                                    <input type="text" class="form-control mt-3" placeholder="Tên hiển thị" required name="display_name" autocomplete="off" tabindex="1" autofocus>
                                </div>
                                <div class="col-md-6">
                                    <input type="text" class="form-control mt-3" placeholder="Tên đăng nhập" required name="user_name" autocomplete="off" tabindex="4">
                                </div>
                                <div class="col-md-6">
                                    <input type="email" class="form-control mt-3" placeholder="Email" required name="email" autocomplete="off" tabindex="2">
                                </div>
                                <div class="col-md-6">
                                    <input type="password" class="form-control mt-3" placeholder="Mật khẩu" required name="password" autocomplete="off" tabindex="5">
                                </div>
                                <div class="col-md-6">
                                    <input type="number" class="form-control mt-3" placeholder="Số điện thoại" required name="phone_number" autocomplete="off" tabindex="3">
                                </div>
                                <div class="col-md-6">
                                    <input type="password" class="form-control mt-3" placeholder="Xác nhận mật khẩu" required name="password_confirm" autocomplete="off" tabindex="6">
                                </div>
                            </div>

                            <button type="submit" class="btn submit mt-5 w-100 text-white">ĐĂNG KÍ</button>
                        </form>
                        
                        <div class="text-right mt-1">
                            <div class="text-muted font-weight-bold d-inline">Bạn đã có tài khoản ? </div> <a href="./?dang_nhap" class="d-inline font-weight-bold text-dang-ki text-decoration-none">Đăng nhập ngay !</a>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript" src="./public/js/vanilla-tilt.js"></script>
<script>
    VanillaTilt.init(document.querySelectorAll(".box"), {
        max: 25,
        speed: 400
    });
</script>

<style>
    .jumbotron{
        /* background: #f26522; */
        height: 86vh;
        background: linear-gradient(to bottom, #f53d2d,#ff6433);
    }
    button.submit{
        /* background: #f26522; */
        background: linear-gradient(to bottom, #f53d2d,#ff6433);
        
    }
    .text-dang-ki{
        color: #f26522;
    }
    .height{
        height: 100vh;
        overflow: hidden;
    }
    .shop{
        line-height: 315px;
        font-size: 85px;
        color: white;
        font-family: 'Dancing Script', cursive;
        text-shadow: 3px 4px 5px rgba(0,0,0,.7);
    }
    h3{
        font-family: 'Roboto', sans-serif;
    }

    @media only screen and (max-width: 768px){
        img{
            display: none;
        }

        .row{
            margin-left:2px;
            padding: 0;
        }
    }

</style>
