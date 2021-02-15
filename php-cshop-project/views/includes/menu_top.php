<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-bulma border border-dark sticky-top">
    <a class="navbar-brand" href="?trang_chu"><b>CShop Manager</b></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
        
        </ul>
        <?php
            if(isset($_SESSION['admin'])){
                ?>
                    <form method="POST" action="controllers/user_controller.php?yeucau=dangxuat" class="form-inline my-2 my-lg-0 float-right">
                        <button class="btn btn-danger btn-sm my-2 my-sm-0" type="submit" style="color: #f26522; background: white; font-weight: 500">Đăng Xuất</button>
                    </form>
                <?php
            }
       ?>
    </div>
</nav>