<template>
    <div class="mb-3">
        <div class="card border-0 shadow-sm" style="border-radius: 15px">
            <div class="card-body">
                <h5 class="d-inline">Danh sách bạn bè</h5>
                <small>(tất cả <span class="font-weight-bold text-success">{{listfriend.length}}</span>)</small>
                <hr>
                <div v-if="listfriend.length == 0">
                    <div class="alert alert-warning">Bạn chưa có bạn bè</div>
                </div>
                <div class="row text-center">
                    <div v-for="(friend,index) in listfriend.slice(0,3)" :key="index" class="col-md-4">
                        <span v-if="friend.avatar == 'noImage.png'"><img :src="'/storage/images/noImage.png'" width="90px" height="100px" class="rounded align-self-center mr-1 d-inline" alt="..."></span>
                        <span v-else> <img :src="'/storage/images/avatars/user_'+friend.id+'/'+friend.avatar" width="90px"  height="100px" class="rounded align-self-center mr-1 d-inline" alt="..."></span>
                        <h6 class="mt-0 d-inline">{{friend.name}}</h6>
                    </div>
                </div>
                <hr>
                <div>
                    <small class="m-0"><router-link to="/friend" class="text-decoration-none btn btn-light btn-sm btn-block"> 
                        <i class="fas fa-user-friends"></i> Xem chi tiết <i class="fas fa-angle-right"></i>
                        </router-link>
                    </small>
                </div>
               
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props:['listfriend'],
}
</script>