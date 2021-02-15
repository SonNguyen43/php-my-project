<template>
    <div>
        <table class="table table-bordered table-sm bg-white table-hover shadow-bulma table-striped" id="table_tracking">
            <thead>
                <tr class="text-center">
                     <th colspan="6" class="pt-3 pl-3"><h5><i class="fas fa-th-list"></i> HOẠT ĐỘNG NGƯỜI DÙNG</h5></th>
                </tr>
                <tr class="bg-dark text-white">
                    <th scope="col">Mã Theo Dõi</th>
                    <th scope="col">Người Dùng</th>
                    <th scope="col">Hành Động</th>
                    <!-- <th scope="col">IP</th>
                    <th scope="col">Device</th> -->
                    <th scope="col">Thời Gian</th>
                    <th scope="col">Bài Viết</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(tracking,index) in all_tracking.slice(0,number_tracking)" :key="index" @click="BindDetails(tracking)" class="info" v-on:scroll="handleScroll">
                    <td>{{tracking.id}}</td>
                    <td>{{tracking.user.name}}</td>
                    <td>
                        <span v-if="tracking.action == 'Đăng nhập'" class="badge badge-success">{{tracking.action}}</span>
                        <span v-if="tracking.action == 'Đăng xuất'" class="badge badge-danger">{{tracking.action}}</span>
                        <span v-if="tracking.action == 'Comment bài viết'" class="badge badge-warning">{{tracking.action}}</span>
                        <span v-if="tracking.action == 'Thích bài viết'" class="badge badge-primary">{{tracking.action}}</span>
                        <span v-if="tracking.action == 'Hủy thích bài viết'" class="badge badge-dark">{{tracking.action}}</span>
                        <span v-if="tracking.action == 'Tạo mới bài viết'" class="badge badge-light">{{tracking.action}}</span>
                        <span v-if="tracking.action == 'Xóa bài viết'" class="badge badge-secondary">{{tracking.action}}</span>
                        <span v-if="tracking.action == 'Xóa comment'" class="badge badge-info">{{tracking.action}}</span>
                    </td>
                    <!-- <td>{{tracking.ip_address}}</td>
                    <td>{{tracking.device}}</td> -->
                    <td>{{tracking.created_at}}</td>
                    <td>
                        <div v-if="tracking.post_id">
                            <div><b>{{tracking.post_id}}</b></div>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
import {bus} from '../../../app.js';

export default {
    props:['all_tracking'],
    data(){
        return{
            number_tracking: 18
        }
    },
    created(){
        setTimeout(() => {
            document.getElementById('right').addEventListener('scroll', this.handleScroll);
        }, 1000);
        
    },
    methods:{
        BindDetails(tracking){
            bus.$emit('ShowDetail',tracking);
        },

        handleScroll (event) {
            // chiều cao hiện tại
            // Math.floor là làm tròn xuống nên + 1 cho bằng tổng chiều cao 
            // console.log(Math.floor($(window).scrollTop() + $(window).height()) + 1 );
            // Tổng chiều cao
            // console.log($(document).height());

            // console.log('Chiều cao hiện tại: ' + Math.floor($(window).scrollTop() + $(window).height()) + " - Chiều cao màn hình: " + $(document).height())

            // khi bằng tổng chiều cao thì load thêm bài.
            if (Math.floor($(window).scrollTop() + $(window).height()) == $(document).height() 
                || Math.floor($(window).scrollTop() + $(window).height()) + 1 == $(document).height()) {
                this.number_tracking++;
            }
        }
    }
    
}
</script>

<style>
    [data-theme="dark"] table{
        color: white;
    }
</style>