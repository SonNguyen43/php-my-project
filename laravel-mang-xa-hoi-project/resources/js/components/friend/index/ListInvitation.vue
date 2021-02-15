<template>
    <div class="card border-0 mt-3" style="border-radius: 15px">
        <div class="card-body">
            <h4>Lời mời kết bạn</h4>
            <div v-if="list_invitation.length <= 0">
                <div class="alert alert-secondary">Không có lời mời kết bạn</div>
            </div>
            <div v-for="(friend,index) in list_invitation" :key="index">
                <div class="alert alert-success" style="border-radius: 15px">
                    <span v-if="friend.user.avatar == 'noImage.png'"><img :src="'/storage/images/noImage.png'" width="40px" height="40px" class="rounded-circle align-self-center mr-1 d-inline" alt="..."></span>
                    <span v-else><img :src="'/storage/images/avatars/user_'+friend.user.id+'/'+friend.user.avatar" width="40px" height="40px" class="rounded-circle align-self-center mr-1 d-inline" alt="..."></span>
                    <h6 class="mt-0 d-inline">{{friend.user.name}}</h6>
                    <span>
                        <span class="badge badge-danger position-absolute p-1" style="top: 0; right:5px" @click="Agree(friend.id)">Đồng ý</span>
                        <span class="badge badge-dark position-absolute p-1" style="top: 0; right:55px" @click="Destroy(friend.id)">Hủy</span>
                    </span>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import {bus} from '../../../app.js'
import Swal from 'sweetalert2/dist/sweetalert2.js'
import 'sweetalert2/src/sweetalert2.scss'

export default {
    data(){
        return{
            list_invitation: []
        }
    },
    created(){
        bus.$on('ReloadListInvitation', ()=>{
             this.ListInvitation();
        })

        this.ListInvitation();
    },
    methods:{
        Agree(friend_id){
            axios.post('/friend/agree',{
                friend_id: friend_id,
            }).then((response) => {
                if(response.data.status == 'success'){
                    Swal.fire({icon: 'success', title: 'Đã thêm bạn..!', showConfirmButton: false,timer: 1500})
                    // reload lại thằng đang tìm và danh sách lời mời - LookingForFriend.vue && danh sách bạn Friend.vue
                    bus.$emit('ReloadListInvitation')
                }
            });
        },
        Destroy(friend_id){
            axios.post('/friend/destroy',{
                friend_id: friend_id,
            }).then((response) => {
                if(response.data.status == 'success'){
                    Swal.fire({icon: 'success', title: 'Đã hủy lời mời..!', showConfirmButton: false,timer: 1500})
                    // reload lại thằng đang tìm và danh sách lời mời - LookingForFriend.vue && danh sách bạn Friend.vue
                    bus.$emit('ReloadListInvitation')
                }
            });
        },
         ListInvitation(){
            axios.post('/friend/list_invitation').then((response) => {
                this.list_invitation = response.data
            })  
        }
    }
}
</script>

<style scoped>
    .badge{
        cursor: pointer;
    }
</style>