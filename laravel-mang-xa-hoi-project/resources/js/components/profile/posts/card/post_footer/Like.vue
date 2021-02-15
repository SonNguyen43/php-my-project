<template>
    <div class="col-6 col-sm-6 col-md-6 border-right">
        <div class="row">
            <div class="col-md-4 text-center"  @click="ShowUserLike"><h6 class="w-100 icon text-danger">
                <!-- Chạy hàm để lấy dữ liệu trả về để kiểm tra và nếu liked thì chọn tim đầy -->
                <span v-if="CheckUserLike(post.id) || check_like == 'liked'">
                    <i class="fas fa-heart"></i>
                </span>
                <span v-else>
                    <i class="far fa-heart"></i>
                </span>
                {{post.like.length}}</h6>
            </div>
            <div class="col-md-8 text-center" @click="LikeTheArticle(post.id)"><h6 class="like w-100">Like</h6></div>
        </div>

        <!-- MODAL -->
        <div class="modal fade" :id="'like'+post.id" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalCenterTitle">
                            <!-- <span class="text-success"> {{post.like.length}}</span> <small>(lượt thích)</small> -->
                            <button type="button" class="btn btn-danger">
                                Tổng lượt thích <span class="badge badge-light">{{post.like.length}}</span>
                                <span class="sr-only">unread messages</span>
                            </button>
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div v-if="this.likes.users.length > 0">
                        <div class="modal-body">
                            <div v-for="(user,index) in this.likes.users" :key="index">
                                <div class="mb-2">
                                    <span v-if="user.user.avatar == 'noImage.png'">
                                        <img :src="'/storage/images/noImage.png'" width="40px" height="40px" class="rounded-circle align-self-center mr-3 d-inline" alt="...">
                                    </span>
                                    <span v-else>
                                        <img :src="'/storage/images/avatars/user_'+user.user.id+'/'+user.user.avatar" width="40px" height="40px" class="rounded-circle align-self-center mr-3 d-inline" alt="...">
                                    </span>
                                    <div class="d-inline">
                                        {{user.user.name}}
                                        <span class="float-right">{{user.created_at}}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                    </div>
                </div>
            </div>
        </div>  
    </div>
</template>

<script>
export default {
    props:['post'],
    data(){
        return{
            likes:{
                users: [],
            },
            check_like: ''
        }
    },
    methods:{
        LikeTheArticle(post_id){
            // kiểm tra đã like hay chưa để update vào csdl
            axios.post('/post/like_the_article',{
                post_id: this.post.id
            }).then(()=>{
                // mục đích cập nhật lại số lượng like và user like bài viết
                this.Likes()
            });
        },
        ShowUserLike(){
            this.Likes();
            $('#like'+this.post.id).modal('show')
        },
        Likes(){
            // lấy số lượng like cũng như những người like bài viết đó
            axios.post('/post/likes',{
                post_id: this.post.id
            }).then((response) => {
                this.post.like.length = response.data.length
                this.likes.users = response.data
            })
        },
        CheckUserLike(post_id){
            // kiểm tra thằng user đang đăng nhập có like không để hiển thị trái tim
            axios.post('/post/user_likes',{
                post_id: post_id
            }).then((response) => {
                 this.check_like = response.data.result
            })
        },
    }
}
</script>
