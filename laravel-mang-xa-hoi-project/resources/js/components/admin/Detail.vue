<template>
    <div v-if="details != ''" class="details mt-3">
        <div class="row ml-0" style="margin-right: 1px">
            <div class="card shadow-bulma w-100">
                <div class="card-body">
                    <h3 class="text-center">Thông tin người dùng</h3>
                    <div class="text-center">
                        <span v-if="details.user.avatar == 'noImage.png'">
                            <img v-bind:src="'/storage/images/' + details.user.avatar" alt="" width="150px" height="150px" class="rounded-circle" id="avatar_navbar">
                        </span>
                            <span v-else>
                            <img v-bind:src="'/storage/images/avatars/user_'+ details.user.id + '/' + details.user.avatar" alt="" width="150px" height="150px" class="rounded-circle" id="avatar_navbar">
                        </span>
                    </div>
                    <div><i class="fas fa-code"></i> <span class="text">Mã người dùng:</span> {{details.user.id}}</div>
                    <div><i class="fas fa-signature"></i> <span class="text">Họ tên:</span> {{details.user.name}}</div>
                    <div><i class="fas fa-envelope-open-text"></i> <span class="text">Email:</span> {{details.user.email}}</div>
                    <div><i class="fas fa-map-marker"></i> <span class="text">Địa chỉ:</span> {{details.user.address}}</div>
                    <div><i class="fas fa-phone"></i> <span class="text">Số điện thoại:</span> {{details.user.phone_number}}</div>
                    <div><i class="fas fa-birthday-cake"></i> <span class="text">Ngày sinh:</span> {{details.user.birthday}}</div>

                    <hr>

                    <h3 class="text-center">Thông tin truy cập</h3>
                    <div v-if="details.content"><i class="fas fa-pen"></i> <span class="text">Nội dung:</span> {{details.content}}</div>
                    <div><i class="fas fa-map-pin"></i> <span class="text">IP:</span> {{details.ip_address}}</div>
                    <div><i class="fas fa-laptop"></i> <span class="text">Thiết bị:</span> {{details.device}}</div>           
                </div>
            </div>

            <div class="mt-3" v-if="details.post">
                <!-- detail_post lúc này là bài post với id (1 bài) || details.post.user_id là người tạo ra bài viết-->
                <!-- gửi InfoAdmin sang Posts->Header -->
                <posts :myPosts="detail_post" :UserLogged="details.post.user_id" :InfoAdmin="InfoAdmin" class="w-100 shadow-bulma"></posts>
            </div>
        </div>
    </div>
</template>

<script>
import {bus} from '../../app.js';
import Post from '../profile/posts/Posts';

export default {
    props:['InfoAdmin'],
    components:{
        posts: Post
    },
    data(){
        return{
            details:'',
            detail_post: '',
        }
    },
    created(){
        bus.$on('ShowDetail', (data)=>{
            this.details = data;
            // console.log(this.details);

            if (this.details.post) {
                 axios.post('/post/detail_post',{
                    // người tạo ra bài viết
                    user_id: this.details.post.user_id,
                    // mã bài viết
                    post_id: this.details.post.id
                }).then((response) => {
                    this.detail_post = response.data
                })
            }
        })
    },
    methods:{
    
    }
}
</script>

<style>
    span.text{
        font-weight: bold;
    }
    .details{
        height: 90vh;
        /* overflow: scroll; */
        
        overflow-y: scroll;
        overflow-x: hidden;
    }
    
</style>