<template>
    <div>
        <div class="card mb-3 shadow-bulma border-0 shadow-sm" v-for="(post,index) in myPosts.slice(0,number_post)" 
        :key="index" v-on:scroll="handleScroll" style="border-radius: 15px"> 
            <postheader :post="post" :UserLogged="UserLogged"></postheader>
            <postbody :post="post"></postbody>
            <postfooter :post="post" :UserLogged="UserLogged"></postfooter>
            <newcomments :post="post" :UserLogged="UserLogged"></newcomments>
        </div>
    </div>
</template>

<script>
import PostHeader from './card/PostHeader.vue'
import PostBody from './card/PostBody.vue'
import PostFooter from './card/PostFooter.vue'
import NewComments from './card/NewComments.vue'

export default {
    props:['myPosts','UserLogged'],
    components:{
        postheader: PostHeader,
        postbody: PostBody,
        postfooter: PostFooter,
        newcomments: NewComments
    },
    data(){
        return{
            number_post: 3
        }
    },
    created(){
        window.addEventListener('scroll', this.handleScroll);
    },
    methods:{
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
                this.number_post++;
            }
        }
    }
}
</script>

