<template>
    <div class="mt-3 mb-3">
        <div class="card border-0 shadow-sm mb-3" style="border-radius: 15px">
            <div class="card-body">
                <h5 class="d-inline">Message</h5>
                <small>(Đang online <span class="font-weight-bold text-success">{{listfriend.length}}</span>)</small>
            </div>
        </div>
        <div class="card list-friend border-0 shadow-sm" style="border-radius: 15px">
            <div class="card-body">
                <div v-if="listfriend.length == 0">
                    <div class="alert alert-warning">Bạn chưa có bạn bè</div>
                </div>
                <div v-for="(friend,index) in listfriend" :key="index" class="alert" style="border-radius: 15px">
                    <router-link :to="`/friend/${friend.id}`" class="text-decoration-none">
                        <span v-if="friend.avatar == 'noImage.png'"><img :src="'/storage/images/noImage.png'" width="40px" height="40px" class="rounded-circle align-self-center mr-1 d-inline" alt="..."></span>
                        <span v-else> <img :src="'/storage/images/avatars/user_'+friend.id+'/'+friend.avatar" width="40px"  height="40px" class="rounded-circle align-self-center mr-1 d-inline" alt="..."></span>
                        <h6 class="mt-0 d-inline">{{friend.name}}</h6>
                    </router-link>
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

<style scoped>
    .alert{
        color: #000;
        /* border-left: 2px #007bff solid; */
        background: rgba(0, 0, 0, .1);
    }
    .alert:hover{
        background: rgba(0, 0, 0, .2);
    }
    [data-theme="dark"] .alert:hover{
        background: rgba(255, 255, 255, .1);
    }

    .list-friend{
        overflow: scroll;
        height: 78vh;
    }

    .card{
          overflow-x: hidden;
    }
</style>