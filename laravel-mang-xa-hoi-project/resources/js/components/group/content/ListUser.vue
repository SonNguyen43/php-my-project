<template>
    <div class="card shadow-sm mb-3" style="border-radius: 15px;">
        <div class="card-header bg-white" style="border-radius: 15px 15px 0 0 ;">
            <h4 class="d-inline">Thành viên</h4>
            <small class="text-success font-weight-bold d-inline">(tất cả {{user_of_group.length}})</small>
        </div>
        <div class="card-body">
            <div class="mt-3">
                <div class="alert" style="border-radius: 15px;" v-for="(friend,index) in user_of_group" :key="index">
                    <span v-if="friend.user.avatar == 'noImage.png'"> <img :src="'/storage/images/noImage.png'" width="50px" height="50px" class="rounded-circle align-self-center mr-1 d-inline" alt="..."></span>
                    <span v-else><img :src="'/storage/images/avatars/user_'+friend.user.id+'/'+friend.user.avatar" width="50px" height="50px" class="rounded-circle align-self-center mr-1 d-inline" alt="..."></span>
                    <h6 class="mt-0 d-inline">{{friend.user.name}}</h6> <span v-if="UserLogged.id == friend.user.id" class="text-success font-weight-bold">(Bạn)</span>
                    
                    <!-- none là tự out - kick là bị chủ phòng kịck -->
                    <div class="dropdown position-absolute p-1" style="top: -7px; right:5px">
                        <i class="fas fa-ellipsis-h" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                        v-if="UserLogged.id == friend.user.id || UserLogged.id == GroupInfo[0].user.id"></i>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                            <div class="dropdown-item text-danger" v-if="UserLogged.id == friend.user.id" @click="OutGroup(friend.user_id,'none')">Rời nhóm</div>
                            <div class="dropdown-item text-danger" v-else-if="UserLogged.id == GroupInfo[0].user.id" @click="OutGroup(friend.user_id,'kick')">Kích ra</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import {bus} from '../../../app.js'

export default {
    props:['UserLogged','GroupInfo'],
    data(){
        return{
            user_of_group:[]
        }
    },
    created(){
        this.getUserOfGroup()

        // nhận tại GroupMessageHeader
        bus.$on('ReloadUserOfGroup',()=>{
            this.getUserOfGroup()
        })
    },
    methods:{
        getUserOfGroup(){
            axios.post('/group/user_of_group',{
                group_id: this.$route.params.groupId
            }).then((response) => {
                this.user_of_group = response.data
            })
        },
        OutGroup(user_id, value = 'none'){
            axios.post('/group/out_group',{
                group_id: this.$route.params.groupId,
                user_id: user_id
            }).then((response) => {
                if (response.data.status == 'success') {
                    this.getUserOfGroup();

                    if (value == 'none') {
                        // điều hướng sau khi xóa tài khoản thành công => /group
                        this.$router.go(-1);
                        bus.$emit('ReloadGroup');
                    }
                }
            })
        }
    }
}
</script>

<style scoped>
    .card{
        height: 85vh;
    }
    .card-body{
        height: 70vh;
        overflow: scroll;
        overflow-x:hidden
    }
    
    img{
        border: 2px solid #000;
        border-radius: 50px;
    }

     .alert{
        color: #000;
        /* border-left: 2px #007bff solid; */
        background: rgba(0, 0, 0, .1);
    }
    .alert:hover{
        background: rgba(0, 0, 0, .2);
    }
    
    [data-theme="dark"] .alert{
        color: #fff;
    }
    [data-theme="dark"] .alert:hover{
        background: rgba(255, 255, 255, .1);
    }
</style>