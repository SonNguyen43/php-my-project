<template>
    <div> 
        <nav class="navbar navbar-expand-lg navbar-light text-center bg-white shadow-sm" id="navbar">
            <button class="navbar-toggler button-navbar-toggle border" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
               <i class="fas fa-bars"></i>
            </button>
            
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- CENTER  -->
                <div class="row w-100">
                    <div class="col-md-3">
                        <router-link to="/" class="navbar-brand"><img id="icon" width="55px" height="55px" src="/storage/images/logo/joker.png" alt=""></router-link>
                       
                    </div>
                    <div class="col-md-6 d-flex justify-content-center">
                        <ul class="navbar-nav ml-5">
                           <router-link to="/home"><li class="nav-item h-100 mt-2" style="width: 120px;"> <i class="fas fa-home"></i> Trang chủ</li></router-link>
                           <router-link to="/friend"><li class="nav-item h-100 mt-2" style="width: 120px;"><i class="fas fa-user-friends"></i> Bạn bè</li></router-link>
                           <router-link to="/group"><li class="nav-item h-100 mt-2" style="width: 120px;"><i class="fas fa-users"></i> Nhóm</li></router-link>
                        </ul>
                    </div>
                    <div class="col-md-3">
                        <!-- POFILE -->
                        <div class="btn-group mt-2">
                            <div class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span v-if="UserLogged.avatar == 'noImage.png'">
                                    <img v-bind:src="'/storage/images/' + UserLogged.avatar" alt="" width="30px" height="30px" class="rounded-circle" id="avatar_navbar">
                                </span>
                                <span v-else>
                                    <img v-bind:src="'/storage/images/avatars/user_'+ UserLogged.id + '/' + UserLogged.avatar" alt="" width="30px" height="30px" class="rounded-circle" id="avatar_navbar">
                                </span>
                                <span class="">{{UserLogged.name}}</span>
                            </div>

                            <div class="position-relative">
                                <div style="position: absolute; z-index: 1301; top:40px" class="">
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <router-link to="/profile" class="dropdown-item"><i class="fas fa-user-circle"></i> Trang cá nhân</router-link>
                                        <router-link to="/setting" class="dropdown-item mt-2"><i class="fas fa-user-cog"></i> Cài đặt</router-link>  
                                        <div class="btn-logout dropdown-item mt-2">
                                            <a class="logout" href="/logout" @click="Logout()">
                                                <i class="fas fa-sign-out-alt"></i> Đăng xuất
                                            </a>
                                            <form id="logout-form" action="/logout" method="POST" style="display: none;">
                                                <input type="hidden" name="_token" :value="csrfToken">
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>  <!-- END PROFILE -->
                    </div>
                </div> <!-- END CENTER -->

                
            </div>
        </nav>
        <!-- go top -->
        <a href="#" id="gotop">
            <div class="mt-5 gotop"> 
                <i class="fas fa-arrow-up"></i>
            </div>
        </a> <!-- end go top-->
    </div>
</template>

<script>
import { VueScrollProgressBar } from '@guillaumebriday/vue-scroll-progress-bar'
import {bus} from '../../app';

export default {
    props:['UserLogged','backgroundColor'],
    components:{
         VueScrollProgressBar
    },
    data () {
        return {   
            // csrf cho chức năng đăng xuất
            csrfToken: document.head.querySelector('meta[name="csrf-token"]').content,
        }
    },
    methods:{
        Logout(){
            event.preventDefault();
            document.getElementById('logout-form').submit();
        }
    }
}
</script>

<style scoped>
    .dropdown-menu{
        width: 250px;
    }
    .dropdown-toggle{
        cursor: pointer;
        padding: 5px;
    }
    .dropdown-toggle:hover{
        background: rgb(228, 228, 228);
        border-radius: 30px;
        padding: 5px;
        box-shadow:0 .125rem .25rem rgba(0,0,0,.075)!important
    }
    a{
        text-decoration: none;
        color: rgb(184, 184, 184);
        font-weight: bold;
    }
    li{
        margin: 0 10px;
    }

    .router-link-active{
        color: #1877f2;
        /* color: rgb(39, 39, 39); */
    }

    .router-link-active > li.nav-item{
       border-bottom: 4px solid #1877f2;
    }

    [data-theme="dark"] .router-link-active > li.nav-item {
        border-bottom: 4px solid #fff;
    }


    a.logout:hover{
        color: red;
        font-weight: bold;
    }
    nav{
        position: fixed;
        top: 0;
        padding: 0.5rem 1.5rem;
        width: 100%;
        transition: 0.4s;
        z-index: 1000;
        font-size: 1rem;
        font-weight: bold;
        background: #F2F3F5;
    }


    /* GO TOP */
    #gotop{
        opacity: 0;
        transition: .4s;
    }
    .gotop{
        width: 40px; 
        height: 40px;
        border-radius: 40px;
        background: rgb(139, 139, 139);
        bottom: 40px; 
        right:13px; 
        z-index: 2500;
        display: flex;
        justify-content: center;
        position: fixed; 
    }
    .gotop i{
        text-align: center; 
        line-height: 40px;
        color: #fff; 
        font-size: 22px  
    }

    #icon{
        width: 40px;
        height: 40px;
    }

    [data-theme="dark"] nav div ul li a{
        color: #6c757d;
    }
    [data-theme="dark"] .router-link-active {
        color: #fff;
    }
</style>