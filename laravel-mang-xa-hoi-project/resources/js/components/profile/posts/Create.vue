<template>
    <div>
        <button class="btn bg-white p-3 mb-3 w-100 text-left shadow-sm border-0 create-post" data-toggle="modal" data-target="#CreateNewPost" style="border-radius: 15px;">
            <i class="fas fa-feather-alt"></i> Tạo bài viết mới...
        </button>

        <!-- modal -->
        <div class="modal fade" id="CreateNewPost" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" >
            <div class="modal-dialog" role="document" >
                <div class="modal-content" >
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-plus-circle"></i> Tạo mới</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="post" id="create_post" enctype="multipart/form-data" v-on:submit.prevent="CreatePostWithFile">
                            <div class="form-group">
                                <label for=""><small>Nội dung:</small></label>
                                <ckeditor :editor="editorSetting.editor" v-model="post.content" :config="editorSetting.editorConfig" class="ckeditor"></ckeditor>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="" v-on:click="setting.openImages = !setting.openImages"><small><i class="fas fa-images"></i> Thêm ảnh</small></label>
                                        <div class="custom-file" v-if="setting.openImages">
                                            <input type="file" accept="image/*" multiple class="custom-file-input" id="customFile" v-on:change="ImgChange">
                                            <label class="custom-file-label" for="customFile">Tối đa 3 ảnh</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group text-right">
                                        <label for=""  v-on:click="setting.openVideo = !setting.openVideo"><small><i class="fas fa-video"></i> Thêm video</small></label>
                                        <div class="custom-file text-left" v-if="setting.openVideo">
                                            <input type="file" accept="video/mp4" class="custom-file-input" id="customFile" v-on:change="VidChange">
                                            <label class="custom-file-label" for="customFile">Tối đa 1 video</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" @click="setting.btnSubmit == true" data-dismiss="modal">Đóng</button>
                                <button type="submit" class="btn btn-success" v-if="setting.btnSubmit">Đăng bài</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div> <!-- end modal -->
    </div>
</template>

<script>
import ClassicEditor from '@ckeditor/ckeditor5-build-classic';
import {bus} from '../../../app';

import Swal from 'sweetalert2/dist/sweetalert2.js'
import 'sweetalert2/src/sweetalert2.scss'

export default {
    name: 'app',
    data(){
        return{
            setting:{
                openImages: false,
                openVideo: false,
                btnSubmit: true
            },
            post:{
                content: '',
                arrImg: [],
                video: '',
            },
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
            }
        }
    },
    methods:{
        VidChange(e){
            // console.log(e.target.files[0]);
            var selectFiles = e.target.files[0];
            this.post.video = selectFiles;
        },
        ImgChange(e){
            // console.log(e.target.files);
            var selectFiles = e.target.files;

            for (let i = 0; i < selectFiles.length; i++) {
                this.post.arrImg.push(selectFiles[i]);
            }
        },
        CreatePostWithFile(){
            var formData = new FormData()
            formData.append('content',this.post.content)
            formData.append('video',this.post.video)

            for (let i = 0; i < this.post.arrImg.length; i++) {
                formData.append('images[]',this.post.arrImg[i])
            }

            if(this.post.content.trim() != '' || this.post.arrImg.length > 0 || this.post.video != ''){
                // Swal.fire({icon: 'success', title: 'Tạo bài viết thành công..!', showConfirmButton: false,timer: 1500})
                this.setting.btnSubmit = false

                axios.post('/post/create_post',formData).then((response) => {
                    if(response.data.status == 'success'){
                        $('#CreateNewPost').modal('hide')
                        $('#create_post')[0].reset()

                        bus.$emit('ReloadPost')
                    }
                    // cập nhật lại cái dữ liệu mà formData đang chứa
                    this.post.content = ''
                    this.post.video = ''
                    this.post.arrImg = []

                    this.setting.btnSubmit = true
                });
            }else{
                $('#CreateNewPost').modal('hide')
                Swal.fire({icon: 'error', title: 'Vui lòng thêm nội dung..!', showConfirmButton: false,timer: 1500})
            }
        }
    }
}
</script>

<style scoped>
    label{
        cursor: pointer;
    }

    #CreateNewPost{
        z-index: 3750;
    }
</style>