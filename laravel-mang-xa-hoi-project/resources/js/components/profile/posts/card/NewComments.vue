<template>
    <div>
        <span v-if="setting.show == true"><small @click="setting.show = !setting.show" class="show">Thu nhỏ...</small></span>
        <span v-else><small @click="ShowComment(post.id)" class="show ml-2">Hiển thị comment mới nhất...</small></span>

        <div v-if="setting.show">
            <div v-for="(comment,index) in this.comments.top_comments" :key="index">
                <div class="media m-3">
                    <span v-if="comment.user.avatar == 'noImage.png'"><img :src="'/storage/images/noImage.png'" width="40px" height="40px" class="rounded-circle align-self-center mr-3 d-inline" alt="..."></span>
                    <span v-else> <img :src="'/storage/images/avatars/user_'+comment.user.id+'/'+comment.user.avatar" width="40px" height="40px" class="rounded-circle align-self-center mr-3 d-inline" alt="..."></span>
                    <div class="media-body p-2 position-relative w-50" style="background: #F2F3F5; border-radius: 25px">
                        <h6 class="mt-0">{{comment.user.name}}</h6>
                        <span class="" v-html="comment.content"></span>
                        <small class="float-right">{{comment.created_at}}</small>
                        <span v-if="comment.user_id == UserLogged.id" class="">
                            <span class="position-absolute badge badge-danger" style="top:5px; right:15px" @click="DeleleCommentPostParent(post.id,comment.id)">Xóa</span>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {    
    props:['post','UserLogged'],
    data(){
        return{
            comments:{
                top_comments: []
            },
            setting:{
                show: false
            }
        }
    },
    methods:{
         ShowComment(post_id){
            axios.post('/post/top_comments',{
                post_id: post_id
            }).then((response) => {
                this.comments.top_comments = response.data
                this.setting.show = true
            })
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
    .badge:hover{
        cursor: pointer;
    }
    small.show{
        cursor: pointer;
    }
</style>