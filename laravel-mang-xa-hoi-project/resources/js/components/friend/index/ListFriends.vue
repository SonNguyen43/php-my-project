<template>
    <div class="card mb-3 mt-3 border-0 shadow-sm" style="border-radius: 15px">
        <div class="card-body pb-0">
            <h4 class="d-inline">Danh sách </h4>
            <small class="d-inline">(tất cả <span class="font-weight-bold text-primary">{{listfriend.length}}</span>)</small>
            <!-- Tìm kiếm -->
            <div class="position-relative mb-3">
                <div class="position-absolute" style="right: 0; bottom: 10px"><i class="fas fa-search"></i></div>
                <input type="text" class="pr-4 pt-2 pb-2 border-bottom" placeholder="Nhập từ khóa" v-model="key" @keyup="FindFriends()">
            </div>
            <button type="button" class="btn btn-primary btn-sm d-block mb-3" @click="ReloadListFriend()">Cập nhật</button>
            
            <div class="row">
                <div v-for="(friend,index) in listfriend.slice(0,number_friend)" :key="index" class="friends col-md-6" v-on:scroll="handleScroll">
                    <div class="alert" style="border-radius: 15px;">
                        <router-link :to="`/friend/${friend.id}`" class="text-decoration-none">
                            <span v-if="friend.avatar == 'noImage.png'"><img :src="'/storage/images/noImage.png'" width="40px" height="40px" class="rounded-circle align-self-center mr-1 d-inline" alt="..."></span>
                            <span v-else> <img :src="'/storage/images/avatars/user_'+friend.id+'/'+friend.avatar" width="40px" height="40px" class="rounded-circle align-self-center mr-1 d-inline" alt="..."></span>
                            <h6 class="mt-0 d-inline">{{friend.name}}</h6>
                        </router-link>

                        <!-- Dropdown -->
                        <div class="dropdown position-absolute p-1" style="top: -8px; right:7px">
                            <i class="fas fa-ellipsis-h" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></i>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                                <span class="dropdown-item" @click="DeleteFriend(friend.id)"> Xóa người ngày</span>
                            </div>
                        </div> <!-- end dropdown-->
                    </div>
                </div> <!-- end loop-->
            </div>
        </div>  <!-- end card body -->
    </div>
</template>

<script>
import {bus} from '../../../app'

export default {
    props:['listfriend'],
    data(){
        return{
            key: '',
            number_friend: 20
        }
    },
    created(){
        window.addEventListener('scroll', this.handleScroll);
    },
    methods:{
        DeleteFriend(friend_id){
             axios.post('/friend/delete_friend',{
                friend_id: friend_id,
            }).then((response) => {
                 if(response.data.status == 'success'){
                     bus.$emit('ReloadListInvitation')
                 }
            })
        },
        ReloadListFriend(){
            bus.$emit('ReloadListInvitation')
        },
        FindFriends(){
            var value = this.key.toLowerCase();

            $(".friends").filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });      
        },
         handleScroll (event) {
            // chiều cao hiện tại
            // Math.floor là làm tròn xuống nên + 1 cho bằng tổng chiều cao 
            // console.log(Math.floor($(window).scrollTop() + $(window).height()) + 1 );
            // Tổng chiều cao
            // console.log($(document).height());

            // console.log('Chiều cao hiện tại: ' + Math.floor($(window).scrollTop() + $(window).height()) + " - Chiều cao màn hình: " + $(document).height())

            // khi bằng tổng chiều cao thì load thêm bài.
            if (Math.floor($(window).scrollTop() + $(window).height()) == $(document).height() 
                || Math.floor($(window).scrollTop() + $(window).height()) + 1 == $(document).height()) {
                this.number_friend++;
            }
        }
    }
}
</script>

<style scoped>
    img{
        border: 2px solid #000;
    }
    .badge{
        cursor: pointer;
    }
    .alert{
        color: #000;
        /* border-left: 2px #007bff solid; */
        background: rgba(0, 0, 0, .1);
    }
    .alert:hover{
        background: rgba(0, 0, 0, .2);
    }
    [data-theme="dark"] .alert:hover{
        background: rgba(255, 255, 255, .1);
    }
</style>