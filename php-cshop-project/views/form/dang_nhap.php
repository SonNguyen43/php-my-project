<div class="height d-flex align-items-center ">
    <div class="jumbotron mt-4 d-flex align-items-center w-100 rounded-0">
        <div class="row d-flex justify-content-center align-items-center w-100">
            <div class="col-md-5 d-flex justify-content-center position-relative box" id="left">
                <span class="position-absolute shop">
                    <span>Shop</span>
                </span>
                <img src="./public/images/logo/logo.png" width="300px" height="280px" class="">
            </div>
            <div class="col-md-7">
                <div class="card p-3">
                    <div class="card-body">
                        <form action="controllers/user_controller.php?yeucau=dangnhap" method="post">
                            <h3>ĐĂNG NHẬP</h3>
                            <div class="row">
                                <div class="col-md-12">
                                    <input type="text" class="form-control mt-3" placeholder="Tên đăng nhập" required name="user_name" autocomplete="off" autofocus>
                                </div>
                                <div class="col-md-12">
                                    <label class="sr-only" for="inlineFormInputGroup">Username</label>
                                    <div class="input-group mt-3">
                                        <input type="password" class="form-control" id="password" placeholder="Mật khẩu"  required name="password" autocomplete="off">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text" onclick="ShowPass()"><i class="fas fa-eye"></i></div>
                                        </div>
                                       
                                        <!-- <input type="" class="form-control mt-3" placeholder="Mật khẩu"> -->
                                    </div>
                                </div>
                            </div>

                            <button type="submit" class="btn submit mt-5 w-100 text-white">ĐĂNG NHẬP</button>
                        </form>
                        
                        <div class="text-left d-inline mt-1">
                            <a href="./" class="d-inline font-weight-bold text-muted text-decoration-none">Trang chủ</a>
                        </div>
                        <div class="float-right mt-1 d-inline">
                            <div class="text-muted font-weight-bold d-inline">Bạn chưa có tài khoản ? </div> <a href="./?dang_ki" class="d-inline font-weight-bold text-dang-ki text-decoration-none">Đăng kí ngay !</a>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript" src="./public/js/vanilla-tilt.js"></script>
<script>
    function ShowPass(){
        var pass = document.getElementById("password");

        if(pass.type == "password"){
            pass.type = "text";
        }else{
            pass.type = "password"
        }
    }

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
