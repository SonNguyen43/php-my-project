<template>
    <div>
        <div class="card-header bg-white" v-for="(group,index) in GroupInfo" :key="index" style="border-radius: 15px 15px 0 0">
            <b>{{group.name}}</b> - Chủ phòng <b class="text-success">{{group.user.name}}</b>
            <!-- menu right -->
            <span class="float-right">
                <div class="btn-group ">
                    <i class="fas fa-ellipsis-h menu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></i>
                    <div class="position-relative">
                        <div class="dropdown-menu dropdown-menu-right">
                            <div class="dropdown-item" data-toggle="modal" data-target="#listFriend" @click="LoadListFriend(group.id)"><i class="fas fa-plus-circle"></i>  Thêm vào nhóm</div>
                            <div class="dropdown-item" data-toggle="modal" data-target="#editName"><i class="fas fa-edit"></i> Đổi tên nhóm</div>
                            <span v-if="UserLogged.id == group.user.id">
                                <div class="dropdown-item text-danger" @click="DeleteGroup(group.id)"><i class="fas fa-trash"></i> Xóa nhóm</div>
                            </span>
                        </div>
                    </div>
                </div>
            </span> <!-- end menu right -->

            <!-- modal thêm người vào nhóm -->
            <div class="modal fade" id="listFriend" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-scrollable" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalScrollableTitle"><i class="fas fa-plus-circle"></i> Thêm người dùng</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body" id="friend_users">
                            <div class="position-relative">
                                <i class="fas fa-search position-absolute" style="left:0;bottom:27px"></i>
                                <input type="text" class="pl-4 pt-2 pb-2 mb-3 border-bottom" placeholder="Nhập từ khóa" v-model="key" @keyup="FindGroup()">
                            </div>
                            

                            <div v-for="(friend,index) in friend.listfriend" :key="index" class="friends">
                                <div class="alert alert-primary">
                                    <span v-if="friend.avatar == 'noImage.png'"> <img :src="'/storage/images/noImage.png'" width="40px" height="40px" class="rounded-circle align-self-center mr-1 d-inline" alt="..."></span>
                                    <span v-else> <img :src="'/storage/images/avatars/user_'+friend.id+'/'+friend.avatar" width="40px" height="40px" class="rounded-circle align-self-center mr-1 d-inline" alt="..."></span>
                                    <h6 class="mt-0 d-inline">{{friend.name}}</h6>
                                    <span class="badge badge-primary position-absolute p-1" style="top: 0; right:0" @click="AddUserToGroup(friend.id,group.id)">Thêm</span>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                        </div>
                    </div>
                </div>
            </div>  <!-- end modal thêm người vào nhóm-->

            <!-- modal sửa tên nhóm -->
            <div class="modal fade" id="editName" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-edit"></i> Thay đổi tên nhóm</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group position-relative">
                                <input class="pl-4" type="text" v-model="group.name" @keyup.enter="EditName(group.name,group.id)">
                                <i class="fas fa-signature position-absolute" style="bottom: 0; left: 0;"></i>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                            <button type="button" class="btn btn-primary" @click="EditName(group.name,group.id)">Thay đổi</button>
                        </div>
                    </div>
                </div>
            </div>  <!-- end modal sửa tên nhóm -->

        </div>
    </div>
</template>

<script>
import {bus} from '../../../app.js'
import Swal from 'sweetalert2/dist/sweetalert2.js'
import 'sweetalert2/src/sweetalert2.scss'


export default {
    props:['GroupInfo','UserLogged'],
    data(){
        return{
            friend:{
                listfriend: []
            },
            key: ''
        }
    },
    methods:{
        LoadListFriend(group_id){
            axios.post('/friend/list_friend',{
                group_id: group_id
            }).then((response) => {
                this.friend.listfriend = response.data  
            })
        },
        AddUserToGroup(friend_id,group_id){
            axios.post('/user_of_group/add',{
                friend_id: friend_id,
                group_id: group_id
            }).then((response) => {  
                if(response.data.status == 'success'){
                    // gửi qua UserOfGroup.vue
                    bus.$emit('ReloadUserOfGroup');
                }else{
                     Swal.fire({icon: 'warning', title: 'Người này đã có trong nhóm..!', showConfirmButton: false,timer: 1500})
                }
            })
        },
        DeleteGroup(group_id){
            axios.post('/group/delete_group',{
                group_id: group_id
            }).then((response) => {
                if(response.data.status == 'success'){
                    // điều hướng sau khi xóa tài khoản thành công => /group
                    bus.$emit('ReloadGroup');
                    this.$router.go(-1);
                }
            })
        },
        EditName(name,id){
            axios.post('/group/edit_name',{
                name: name,
                id: id 
            }).then((response) => {
                if(response.data.status == 'success'){
                    $('#editName').modal('hide')
                    Swal.fire({icon: 'success', title: 'Đã thay đổi..!', showConfirmButton: false,timer: 1500})
                    bus.$emit('ReloadGroup')
                }
            });
        },
        FindGroup(){
            var value = this.key.toLowerCase();
            $("#friend_users div.friends").filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });      
        }
    }
}
</script>

<style scoped>
    .menu{
        cursor: pointer;
    }
</style>