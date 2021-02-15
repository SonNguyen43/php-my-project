<template>
    <div class="card border-0 shadow-sm mb-3" style="border-radius: 15px">
        <div class="card-body">
            <h5 class="d-inline">Danh sách nhóm</h5> 
            <small class="d-inline">(đã tham gia <span class="text-primary font-weight-bold">{{groups.length}}</span>)</small>
            <hr>
            <div v-if="groups.length == 0">
                <div class="alert alert-success">Bạn chưa tham gia nhóm nào</div>
            </div>
            <div class="mt-2" v-for="(group,index) in groups.slice(0,2)" :key="index">
                <router-link :to="`/group/${group.id}`" class="text-decoration-none">
                    <span>
                        <img src="/storage/images/group/cover_image_default.png" alt="" width="40px" height="40px" class="rounded-circle d-inline mr-3">
                        <b class="d-inline group-name">{{group.name}}</b>
                    </span>
                </router-link>
            </div>
            <hr>
            <small> 
                <router-link to="/group" class="text-decoration-none btn btn-light btn-block btn-sm"> 
                    <i class="fas fa-users"></i> Xem chi tiết <i class="fas fa-angle-right"></i>
                </router-link>
            </small>
        </div>
    </div>
</template>

<script>
import {bus} from '../../app.js'

export default {
    props:['groups']
}
</script>

<style scoped>
    .group-name{
        color: rgb(46, 46, 46);
    }
    [data-theme="dark"] .group-name {
        color: #fff;
    }
</style>