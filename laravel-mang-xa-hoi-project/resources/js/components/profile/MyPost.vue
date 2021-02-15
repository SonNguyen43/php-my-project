<template>
    <div>
        <create></create> 
        <posts :myPosts="myPosts" :UserLogged="UserLogged"></posts>
    </div> 
</template>

<script>
import {bus} from '../../app';
import Create from './posts/Create.vue';
import Posts from './posts/Posts.vue';

export default {
    props:['UserLogged'],
    components:{
        create: Create,
        posts: Posts,
    },
    data(){
        return{
            myPosts: [],
        }
    },
    created(){
        this.MyPosts();
        // nhận sự kiện từ Create.vue để cập nhật post vừa đăng
        bus.$on('ReloadPost',() =>{
           this.MyPosts();  
        });
    },
    methods:{
        MyPosts(){
            axios.post('/post/my_post').then((response) => {
                this.myPosts = response.data;
            })
        },
    },
}
</script>

<style>
    table{
        width: 100%;
        text-align: center;
    }
</style>


