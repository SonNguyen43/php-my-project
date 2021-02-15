<template>
    <div>
        <!-- ADMIN -->
        <div v-if="UserLogged.type == 'admin'">
            <tracking :InfoAdmin="UserLogged" class="w-100"></tracking>
        </div>
        
        <!-- USER -->
        <div v-if="UserLogged.type == 'user'">
            <navbar :UserLogged="UserLogged"></navbar>

            <div class="container-fluid" style="margin-top: 65px">
                <transition :name="transitionName" mode="out-in" appear>
                    <router-view v-bind:UserLogged="UserLogged" :listfriend="listfriend" :groups="groups"></router-view>
                </transition>
            </div>  
        </div>

    </div>
</template>

<script>
import {bus} from './app';
import Navbar from './components/includes/Navbar.vue'
import Tracking from './components/pages/Tracking.vue'

export default {
    components:{
        navbar: Navbar,
        tracking: Tracking
    },
    data(){
        return{
            UserLogged: [],
            listfriend:[],
            groups: [],
            transitionName: 'fade',
        }
    },
    created(){
        this.InfoUserLogged()
        this.ListFriend()
        this.LoadGroup()
       
        
        // update thông tin người dùng đăng nhập khi thay đổi avatar
        // trực tiếp thay đổi ảnh tại Navbar.vue
        bus.$on('ChangeAvatar',()=>{
            this.InfoUserLogged();
        })

        // thay đổi ảnh đại diện
        bus.$on('ChangeCoverImage',()=>{
            this.InfoUserLogged();
        })

        // reload lại danh sách bạn bè
        bus.$on('ReloadListInvitation', ()=>{
            this.ListFriend() 
        })

        // reload lại danh sách nhóm
        bus.$on('ReloadGroup', ()=>{
            this.LoadGroup()
        })
    },
    methods:{
        // load thông tin người đang đăng nhập
        InfoUserLogged(){
            axios.post('/profile')
            .then(response => {
                // console.log(response.data);
                this.UserLogged = response.data

                // có thông tin ng đăng nhập => lưu tracking
                
            })
        },

        // load danh sách bạn bè
        ListFriend(){
            axios.post('/friend/list_friend').then((response) => {
                this.listfriend = response.data
            })
        },

        // load danh sách nhóm
        LoadGroup(){
            axios.post('/group/all_group_of_user').then((response) => {
                this.groups = response.data;
            })
        },
    },
    watch: {
        '$route.name': function (newValue, oldValue) {
            if (newValue === 'home') {
                this.transitionName = 'slide-left'
            } else {
                this.transitionName = 'slide-right'
            }
        }
    }
}
</script>

<style>
    .fade-enter-active {
        transition: all .3s ease;
    }
    .fade-leave-active{
        transition: all .5s cubic-bezier(1.0, 0.5, 0.8, 1.0);
    }
    .fade-enter, .fade-leave-to /* .fade-leave-active below version 2.1.8 */ {
        transform: translateX(10px);
        opacity: 0;
    }
</style>