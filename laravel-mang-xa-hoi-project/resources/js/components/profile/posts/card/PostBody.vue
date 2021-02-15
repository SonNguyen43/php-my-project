<template>
    <div class="card-body overflow-hidden p-0">
        <div class="text-justify m-2" v-html="post.content"></div>
        <!-- Đếm số lượng ảnh -->
        <!-- {{Object.keys(JSON.parse(post.images)).length }}  -->
        
        <!-- hiển thị ảnh -chuyển JSON thành đối tượng và loop ra -->
        <div v-if="post.images != null">
            <div class="row mb-2" style="max-height:400px; overflow:hidden">
                <span v-for="(image, index) in JSON.parse(post.images)" :key="index" class="col m-0 p-0 text-center" data-toggle="modal" data-target="#exampleModalCenter">
                    <img v-bind:src="'/storage/posts/user_'+post.user_id+'/'+'images/'+ image" class="mb-1 image_post w-100" @click="ShowImage(post.user_id,image)">
                </span>
            </div>
        </div>  <!-- end hiển thị ảnh -->
        <!-- hiển thị video -->
        <div v-if="post.video != null">
            <video controls class="w-100" style="max-height: 400px;"> 
                <source v-bind:src="'/storage/posts/user_'+post.user_id+'/'+'videos/'+post.video">
            </video>
        </div> <!-- end hiển thị ảnh -->

        <!-- modal hiển thị ảnh -->
        <div class="modal fade" id="imagemodal" style="background-color: rgba(0,0,0,0.3)" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <button type="button" class="close position-absolute" style="top: 15px; right:15px" data-dismiss="modal" aria-label="Close">
                <i class="fas fa-times text-white"></i>
            </button>
            <div class="modal-dialog modal-dialog-centered" role="document">
                <img src="" id="imagepreview" class="w-100 h-100 rounded border-dark">
            </div>
        </div> <!-- end modal-->
    </div>
</template>

<script>
export default {
    data(){
        return{
            setting:{
                showMore: false
            }
        }
    },
    props:['post'],
    methods:{
        // truyền vào user_id và tên ảnh để đúng đường dẫn lấy ảnh
        ShowImage(user_id,imagename){
            document.getElementById('imagepreview').src = '/storage/posts/user_'+user_id+'/'+'images/'+ imagename;
            $('#imagemodal').modal('show'); 
        }
    }
}
</script>

<style scoped>
    img.image_post:hover{
        opacity: .8;
    }
</style>