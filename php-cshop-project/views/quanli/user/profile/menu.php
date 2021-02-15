<div style="margin-top: 130px">
    <div class="container">
        <?php
            if(isset($_SESSION['user'])){
                ?>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="accordion shadow-bulma card mb-3" id="accordionExample">
                                <h3 class="mt-2 ml-2"><i class="fa fa-bars"></i> Menu</h3>
                                <hr>
                                <div class="card-header" id="headingOne">
                                    <div class="mb-0">
                                        <div class="text-left text-decoration-none"  data-toggle="collapse" data-target="#user_info" aria-expanded="true" aria-controls="collapseOne">
                                            <i class="fa fa-info"></i> Thông tin cá nhân
                                        </div>
                                    </div>
                                </div>
                                <div class="card-header mt-3" id="headingTwo">
                                    <div class="mb-0">
                                        <div class=" text-left collapsed text-decoration-none"  data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                        <i class="fa fa-unlock"></i> Thay đổi mật khẩu
                                        </div>
                                    </div>
                                </div>
                                <div class="card-header mt-3" id="headingThree">
                                    <div class="mb-0">
                                        <div class=" text-left collapsed text-decoration-none"  data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                        <i class="fa fa-signature"></i> Phản hồi
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <?php
                                require "./views/quanli/user/profile/content.php";
                            ?>
                        </div>
                    </div>
                   
                <?php
            }else{
               require "./views/includes/404.php";
            }
        ?>
    </div>
</div>

<style>
    div.text-decoration-none{
        cursor: pointer;
    }
</style>