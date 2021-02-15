<template>
    <div class="card mb-3 mt-3 shadow-sm text-center" style="border-radius: 15px;">
        <div class="mt-3">
            <span v-if="friend_info.avatar == 'noImage.png'"><img :src="'/storage/images/noImage.png'" width="150px" height="150px" class="rounded-circle align-self-center mr-1 d-inline" style=""></span>
            <span v-else><img :src="'/storage/images/avatars/user_'+friend_info.id+'/'+friend_info.avatar" width="150px" height="150px" class="rounded-circle align-self-center mr-1 d-inline" style=""></span>
        </div>
        <div class="card-body">
            <div class="info d-inline">
                <h4>{{friend_info.name}}</h4>
            </div>
            <!-- Dữ liệu lấy từ app.js -->
            <small>( {{friend_info.email}} )</small>
            <hr>
            <div class="text-left">
                <div class="form-group">    <span>Giới thiệu</span></div>
                <div class="form-group">    <i class="fas fa-signature"></i> Họ tên <span>{{friend_info.name}}</span></div>
                <div class="form-group">    <i class="fas fa-map-marker"></i> Địa chỉ <span>{{friend_info.address}}</span></div>
                <div class="form-group">    <i class="fas fa-phone"></i> Số điện thoại <span>{{friend_info.phone_number}}</span></div>
                <div class="form-group">    <i class="fas fa-birthday-cake"></i> Sinh nhật <span>{{friend_info.birthday}}</span></div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props:['friend_info'],

}
</script>

<style scoped>
    div.form-group span{
        font-weight: bold;
    }

    [data-theme='dark'] img{
        border: 7px solid #111;
    }
</style>