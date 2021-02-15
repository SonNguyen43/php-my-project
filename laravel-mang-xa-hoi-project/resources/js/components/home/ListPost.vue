<template>
    <div class="mt-3 post-home">
        <posts :myPosts="myPosts" :UserLogged="UserLogged"></posts>
    </div> 
</template>

<script>
import {bus} from '../../app.js';
import Posts from '../profile/posts/Posts';

export default {
    props:['UserLogged'],
    components:{
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
            axios.post('/home/posts_with_friend').then((response) => {
                this.myPosts = response.data;

                console.log(this.myPosts);
                
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

    .post-home{
        padding-left: 50px;
        padding-right: 50px;
    }

    
    @media screen and (max-width: 1200px){
       .post-home{
            padding-left: 10px;
            padding-right: 10px;
        }
    }
    @media screen and (max-width: 920px) {
        .post-home{
            padding-left: 5px;
            padding-right: 5px;
        }
    }
    @media screen and (max-width: 768px) {
        .post-home{
            padding-left: 0px;
            padding-right: 0px;
        }
    }
</style>


