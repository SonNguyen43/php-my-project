<template>
    <div class="card border-0 mb-3 shadow-sm" style="z-index: 1; border-radius: 15px">
        <div class="card-body">
            <div class="info d-inline">
                <h4>{{UserLogged.name}}</h4>
            </div>
            <!-- Dữ liệu lấy từ app.js -->
            <!-- <small>( {{UserLogged.email}} )</small> -->
            <hr class="bg-dark">
            <div class="text-left">
                <div class="form-group">    <span>Giới thiệu</span></div>
                <div class="form-group">    <i class="fas fa-signature"></i> Họ tên <span>{{UserLogged.name}}</span></div>
                <div class="form-group">    <i class="fas fa-map-marker"></i> Địa chỉ <span>{{UserLogged.address}}</span></div>
                <div class="form-group">    <i class="fas fa-phone"></i> Số điện thoại <span>{{UserLogged.phone_number}}</span></div>
                <div class="form-group">    <i class="fas fa-envelope"></i> Email <span>{{UserLogged.email}}</span></div>
                <div class="form-group">    <i class="fas fa-birthday-cake"></i> Sinh nhật <span>{{UserLogged.birthday}}</span></div>
            </div>
            <hr>
            <router-link to="/setting" class="text-white btn btn-secondary text-decoration-none d-flex justify-content-center">
                Bạn muốn thay đổi thông tin cá nhân?
            </router-link>
        </div>
    </div>
</template>

<script>
export default {
    props:['UserLogged']
}
</script>

<style scoped>
    div.form-group span{
        font-weight: bold;
    }
</style>