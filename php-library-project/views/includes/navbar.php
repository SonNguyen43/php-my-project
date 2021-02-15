<nav class="navbar navbar-expand-lg navbar-light shadow-sm" id="navbar">
    <a class="navbar-brand" href="./"><i class="fas fa-book-open"></i> Hệ Thống Quản Lí Sách <small class="text-secondary">(by Hữu Tín)</small></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
        </ul>
        <!-- <form method="POST" action="controllers/nhanvienController.php?yeucau=dangxuat" class="form-inline mr-5 my-2 my-lg-0">
            <button class="btn btn-outline-danger btn-sm my-2 my-sm-0" type="submit">Đăng Xuất</button>
        </form> -->
    </div>
</nav>

<style>
    #navbar {
        transition: top 0.3s;
        width:100%;
        position:fixed;
        z-index:100;
        top: 0;
        background-color: rgba(255, 255, 255, 1);
    }
    .login{
        display:none;
    }   
    @media only screen and (max-width: 992px) {
        .form-inline{
            display:none;
        }
        .login{
            display: block;
        }
    }
</style>