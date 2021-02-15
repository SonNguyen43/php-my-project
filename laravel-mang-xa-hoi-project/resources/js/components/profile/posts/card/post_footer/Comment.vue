<template>
    <div class="col-6 col-sm-6 col-md-6">
        <div class="row">
            <div class="col-md-4 text-center order-md-2"  @click="ShowComment(post.id)"><h6 class="w-100 icon text-primary"><i class="far fa-comments"></i> {{this.post.comment_post_parent.length}}</h6></div>
            <div class="col-md-8 text-center" @click="ShowComment(post.id)"><h6 class="comment w-100">Comment</h6></div>
        </div>

        <!-- MODAL -->
        <div class="modal fade" :id="'comment'+post.id" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-xl" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title text-success" id="exampleModalCenterTitle">
                            <!-- {{comments.count}} <small class="text-dark">(bình luận)</small> -->
                            <button type="button" class="btn btn-primary">
                                Tổng bình luận <span class="badge badge-light">{{this.post.comment_post_parent.length}}</span>
                                <span class="sr-only">unread messages</span>
                            </button>
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div v-for="(comment,index) in this.comments.comments_post_parent" :key="index">
                            <div class="media mt-3">
                                <span v-if="comment.user.avatar == 'noImage.png'">
                                    <img :src="'/storage/images/noImage.png'" width="40px" height="40px" class="rounded-circle align-self-center mr-3 d-inline" alt="...">
                                </span>
                                <span v-else>
                                    <img :src="'/storage/images/avatars/user_'+comment.user.id+'/'+comment.user.avatar" width="40px" height="40px" class="rounded-circle align-self-center mr-3 d-inline" alt="...">
                                </span>
                                <div class="media-body p-2 position-relative w-50" style="background: #F2F3F5; border-radius: 25px">
                                    <h6 class="mt-0">{{comment.user.name}}</h6>
                                    <span class="" v-html="comment.content"></span>
                                    <small class="float-right">{{comment.created_at}}</small>
                                    <span v-if="comment.user_id == UserLogged.id" class="">
                                        <div class="dropdown position-absolute" style="top:5px; right:15px">
                                            <i class="fas fa-ellipsis-h" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></i>
                                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                                                <span class="dropdown-item" @click="DeleleCommentPostParent(post.id,comment.id)">Xóa bình luận</span>
                                            </div>
                                        </div>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div>
                        <ckeditor :editor="editorSetting.editor" v-model="editorSetting.editorData" :config="editorSetting.editorConfig" v-on:keyup.enter="Comment(post.id)"></ckeditor>
                        <button class="btn btn-primary float-right text-right m-3" @click="Comment(post.id)">Bình luận <i class="fas fa-paper-plane"></i></button>
                    </div>
                </div>
            </div>
        </div> <!-- END MODAL -->
    </div>
</template>

<script>
import ClassicEditor from '@ckeditor/ckeditor5-build-classic';
// import DecoupledEditor from '@ckeditor/ckeditor5-build-decoupled-document';

export default {
     name: 'app',
     props:{
        post:{
            required: true
        },
        UserLogged:{
            required: true
        }
    },
    data(){
        return{
            comments:{
                comments_post_parent: [],
                count: this.post.comment_post_parent.length
            },
            editorSetting:{
                editor: ClassicEditor,
                editorData: '',
                editorConfig: {
                    toolbar: {
                        items: [
                            'bold','italic','bulletedList','numberedList','undo','redo',
                        ],
                    },  
                }
            }
        }
    },
    methods:{
        ShowComment(post_id){
            $("#comment"+post_id).modal('show')

            axios.post('/post/comments_post_parent',{
                post_id: post_id
            }).then((response) => {
                this.comments.comments_post_parent = response.data
                this.post.comment_post_parent.length = response.data.length
            })
        },
        Comment(post_id){
            if (this.editorSetting.editorData.trim() != '') {
                 axios.post('/post/comment_to_post_parent',{
                    post_id: post_id,
                    content: this.editorSetting.editorData.trim()
                }).then((response) => {
                    if(response.data.status == 'success'){
                        this.editorSetting.editorData = ''
                        this.ShowComment(post_id)
                        this.post.comment_post_parent.length+=1
                    }
                })
            }else{

            }
        },
        DeleleCommentPostParent(post_id,comment_post_parent_id){
            axios.post('/post/delete_comment_post_parent',{
                post_id: post_id,
                comment_post_parent_id: comment_post_parent_id
            }).then((response) => {
                if(response.data.status == 'success'){
                    this.ShowComment(post_id);
                }
            })
        },
    }
}
</script>

<style scoped>
    .modal{
        cursor: context-menu;
    }
    .badge{
        cursor: pointer;
    }
</style>