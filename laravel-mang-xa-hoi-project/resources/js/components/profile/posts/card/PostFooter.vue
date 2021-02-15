<template>
    <div class="card-footer bg-white p-0" style="margin-top:-10px">
        <div class="row p-2">
            <like :post="post"></like>
            <comment :post="post" :UserLogged="UserLogged"></comment>
        </div>
    </div>
</template>

<script>
import Like from './post_footer/Like.vue'
import Comment from './post_footer/Comment.vue'

export default {
    components:{
        like: Like,
        comment: Comment
    },
    props:['post','UserLogged'],
}
</script>

<style>
    .like, .comment, .icon{
        cursor: pointer;
        padding: 10px;
        margin: 0;
    }
    .like:hover, .comment:hover{
        background: rgb(228, 228, 228);
        overflow: hidden;
        color: black;
        border-radius: 15px;
    }
</style>