<template>
    <div class="card border-0 shadow-sm mt-3 mb-3 card-body" style="border-radius: 15px">
        <h4>Tìm bạn mới</h4>
        <div class="input-group mb-3 mr-sm-2">
            <input type="text" class="form-control" v-model="user.key" @keyup.enter="FindUser()">
            <div class="input-group-prepend">
                <div class="input-group-text"><i class="fas fa-search"></i></div>
            </div>
        </div>

        <button type="button" class="btn btn-primary mb-3" @click="FindUser()">Tìm</button>

        <!-- nếu không tìm thấy user nào -->
        <div v-if="user.user_info == 'no_result'">
            <div class="alert alert-warning">Không tìm thấy dữ liệu !</div>
        </div>
        <!-- Tìm thấy user và hiển thị -->
        <div v-if="user.user_info != '' && user.user_info != 'no_result'">
            <div class="alert alert-secondary" v-for="(info, index) in user.user_info" :key="index">
                <span v-if="info[0].avatar == 'noImage.png'"><img :src="'/storage/images/noImage.png'" width="40px" height="40px" class="rounded-circle align-self-center mr-1 d-inline" alt="..."></span>
                <span v-else><img :src="'/storage/images/avatars/user_'+info[0].id+'/'+info[0].avatar" width="40px" height="40px" class="rounded-circle align-self-center mr-1 d-inline" alt="..."></span>
                <h6 class="mt-0 d-inline">{{info[0].name}}</h6>
                <!-- kiểm tra các trạng thái kết bạn -->
                <!-- UserLogged.id != user.user_info[0].id  tự tìm bản thân => cả 3 điều kiện đều sai nên ko hiển thị trạng thái nào -->
                <span v-if="UserLogged.id != info[0].id && info[1] == 'not_friend_request'">
                    <span class="badge badge-primary position-absolute p-1" style="top: 0; right:0" @click="AddFriend(info[0].id)">Kết bạn</span>
                </span>
                <!-- Đã gửi lời mời -->
                <span v-else-if="UserLogged.id != info[0].id && info[1] == 'friend_requested'">
                    <span class="badge badge-warning position-absolute p-1" style="top: 0; right:0">Chờ xác nhận</span>
                </span>
                <!-- Đã là bạn bè -->
                <span v-else-if="UserLogged.id != info[0].id && info[1] == 'friended'">
                    <span class="badge badge-success position-absolute p-1" style="top: 0; right:0">Bạn bè</span>
                </span>
            </div>
        </div>
        <!-- Rỗng - mặc định -->
        <div v-else></div>
    </div>
</template>

<script>
import {bus} from '../../../app.js'

export default {
    props:['UserLogged'],
    created(){
        // reload lại thằng đang tìm và danh sách lời mời
        bus.$on('ReloadListInvitation', ()=>{
            this.FindUser()
        })
    },
    data(){
        return{
            user:{
                user_info: [],
                key: '',
            }
        }
    },
    methods:{
        FindUser(){
            if(this.user.key.trim() != ''){
                this.user.user_info = ''

                axios.post('/friend/find_user',{
                    key: this.user.key                                                                                                                                                                                            
                }).then((response) => {
                    // nếu không tìm được kết quả thì không cần gán dữ liệu cho user_info[]
                    if(response.data.length > 0){
                        // nhận 2 giá trị trả về gồm user và thông tin đã kết bạn chưa
                        this.user.user_info = response.data
                        // this.user.friend_request = response.data[1]
                        
                    }else{
                        this.user.user_info = 'no_result';
                    }
                })                                                                                                          
            }else{
                 this.user.user_info = ''
            }
        },
        AddFriend(to_user_id){
            axios.post('/friend/add_friend',{
                to_user_id: to_user_id                                                                                                                                                                                           
            }).then(() => {
                // cập nhật lại trạng thái kết bạn => chờ xác nhận
                this.FindUser()

                bus.$emit('ReloadListInvitation')
            })    
        },
    }
}
</script>

<style scoped>
    .badge, span.show{
        cursor: pointer;
    }
</style>