<template>
    <div class="row" id="groups">
        <div class="col-md-4" v-for="(group,index) in groups.slice(0,number_group)" :key="index" v-on:scroll="handleScroll">
            <router-link :to="`/group/${group.id}`" class="text-decoration-none">
                <div class="card mb-3 shadow-sm text-center border" style="border-radius: 15px">
                    <img src="/storage/images/group/cover_image_default.png" width="250px" height="250px" class="card-img-top" style="border-radius: 15px 15px 0 0">
                    <div class="card-body border-top">
                        <b class="d-inline group-name">{{group.name}}</b>
                    </div>
                </div>
            </router-link>
        </div>
    </div>
</template>

<script>
export default {
    props:['groups'],
    data(){
        return{
            number_group: 20
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
                this.number_friend++;
            }
        }
    }
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