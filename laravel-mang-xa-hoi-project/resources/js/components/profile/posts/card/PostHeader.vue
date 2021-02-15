<template>
    <div class="card-header bg-white border-0" style="border-radius: 15px 15px 0 0">
        <div class="row">
            <!-- menu trái - hiển thị thông tin người dùng-->
            <div class="col-10">
                <div class="text-left">
                    <div class="d-flex flex-row bd-highlight">
                        <div class="bd-highlight mr-3">
                            <span v-if="post.avatar == 'noImage.png'"><img v-bind:src="'/storage/images/' + post.user.avatar" alt="" width="40px" height="40px" class="rounded-circle"></span>
                            <span v-else><img v-bind:src="'/storage/images/avatars/user_'+ post.user.id + '/' + post.user.avatar" alt="" width="40px" height="40px" class="rounded-circle"></span>
                        </div>
                        <div class="bd-highlight"> 
                            <h6 class="m-0">{{post.user.name}}</h6>
                            <small class="m-0 create_at">({{post.created_at}})</small>
                        </div>
                    </div>
                </div>
            </div>  <!-- end menu phải -->
            <!-- menu bên phải - xóa bài viết -->
            <div class="col-2">
                <div class="text-right">
                    <div class="dropdown">
                        <i class="fas fa-ellipsis-h" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></i>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                            <span v-if="post.user.id == UserLogged.id">
                                <span class="dropdown-item" data-toggle="modal" :data-target="'#editPost' + post.id"><i class="fas fa-edit text-primary"></i> Sửa bài viết</span>
                                <span class="dropdown-item" @click="DeletePost(post.id)"><i class="fas fa-trash text-danger"></i> Xóa bài viết</span>
                            </span>
                            <span class="dropdown-item" v-else>Không thể thao tác</span>
                        </div>
                    </div>
                </div>
            </div>  <!-- end menu trái-->
        </div>

        <div class="modal fade" :id="'editPost' + post.id" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Sửa bài viết</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="post" enctype="multipart/form-data" 
                        v-on:submit.prevent="EditPost">
                            <div class="form-group">
                                <label for=""><small>Nội dung:</small></label>
                                <!-- <input type="text" :value="post.id"> -->
                                <ckeditor :editor="editorSetting.editor" 
                                v-model="post.content" :config="editorSetting.editorConfig" 
                                class="ckeditor" required></ckeditor>
                            </div>
                            <div class="form-group">
                                <!-- hiển thị ảnh -chuyển JSON thành đối tượng và loop ra -->
                                <div v-if="post.images != null">
                                    <div class="row mb-2" style="max-height:70px; overflow:hidden">
                                        <span v-for="(image, index) in JSON.parse(post.images)" :key="index" class="col m-0 p-0 text-center" data-toggle="modal" data-target="#exampleModalCenter">
                                            <img v-bind:src="'/storage/posts/user_'+post.user_id+'/'+'images/'+ image" class="mb-1 image_post" style=" width: 50px" @click="DeleteImage(image, post.id)">
                                        </span>
                                    </div>
                                </div>  <!-- end hiển thị ảnh -->
                            </div>
                             <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                                <button type="submit" class="btn btn-primary">Thay đổi</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import {bus} from '../../../../app.js'

import Swal from 'sweetalert2/dist/sweetalert2.js'
import 'sweetalert2/src/sweetalert2.scss'

import ClassicEditor from '@ckeditor/ckeditor5-build-classic';

export default {
    data(){
        return{
            editorSetting:{
                editor: ClassicEditor,
                editorConfig: {
                    toolbar: {
                        items: [
                            'heading','|',
                            'bold','italic','bulletedList','numberedList','insertTable','undo','redo',
                        ],
                       
                    },
                }
            },
            post_edit:{
                id: this.post.id
            }
        }
    },
    // InfoAdmin: nhận từ Posts
    props:['post','UserLogged'],
    methods:{
        DeletePost(post_id){
            axios.post('/post/delete_post_with_id',{
                post_id: post_id
            }).then((response) => {
                if(response.data.status == 'success'){
                    Swal.fire({icon: 'success', title: 'Đã xóa bài viết..!', showConfirmButton: false,timer: 1500})
                    bus.$emit('ReloadPost')
                }
            })  
        },
        EditPost(){
            var formData = new FormData()
            formData.append('id',this.post.id)
            formData.append('content',this.post.content)

            axios.post('/post/edit_post',formData).then((response) => {
                if(response.data.result == 'success'){
                    $('#editPost'+ this.post.id).modal('hide')
                    bus.$emit('ReloadPost')
                }
            })
        },
        DeleteImage(name_img, post_id){
             axios.post('/post/delete_img_in_post',{
                 name_img: name_img,
                 post_id: post_id
             }).then((response) => {
                if(response.data.result == 'success'){
                    $('#editPost'+ this.post.id).modal('hide')
                    bus.$emit('ReloadPost')
                }
            })
        }
    }
}
</script>

<style scoped>
    #dropdownMenuButton:hover{
        cursor: pointer;
    }
</style>