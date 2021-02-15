<template>
    <div class="left rounded-0 card shadow-bulma">
        <div class="text-center">
            <img id="icon" width="115px" src="/storage/images/logo/joker.png" alt="" class="mt-3">
        </div>

        <!-- INFO ADMIN -->
        <hr class="bg-dark">
        <h4 class="text-center font-weight-bold d-inline">{{InfoAdmin.name}} <small> (admin)</small></h4>
        <hr class="bg-dark"> <!-- END INFO ADMIN-->

        <!-- FUNCTION -->
        <div class="alert alert-secondary rounded-0" role="alert">
            <i class="fa fa-users"></i> Hệ thống theo dõi người dùng
        </div>
        <div class="alert alert-secondary rounded-0" role="alert">
            <i class="fa fa-users-cog"></i> Quản lí người dùng
        </div>
        <div class="alert alert-secondary rounded-0" role="alert">
            <i class="fa fa-list-ul"></i> Danh sách phản hồi
        </div>
        <div class="alert alert-secondary rounded-0" role="alert">
             <i class="fa fa-lock"></i> Bảo mật
        </div>



        <!-- LOG OUT -->
        <div class="btn-logout position-absolute" style="bottom:0; width:100%">
            <a class="logout text-light btn btn-danger rounded-0 d-block" href="/logout" onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();" style="text-decoration: none">
                <i class="fas fa-sign-out-alt"></i> Đăng xuất
            </a>
            <form id="logout-form" action="/logout" method="POST" style="display: none;">
                <input type="hidden" name="_token" :value="csrfToken">
            </form>
        </div>
    </div>
</template>

<script>
export default {
    props: ['InfoAdmin'],
    data () {
        return {   
            // csrf cho chức năng đăng xuất
            csrfToken: document.head.querySelector('meta[name="csrf-token"]').content,
        }
    },
}
</script>

<style >
    .left{
        height: 100vh;
        overflow: hidden;
    }
</style>