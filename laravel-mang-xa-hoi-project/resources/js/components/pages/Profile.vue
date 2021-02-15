<template>
    <div>
        <div class="row">
            <div class="col-md-12">
                <userinfo :UserLogged="UserLogged"></userinfo>
            </div>
            <div class="col-md-12">
                <div class="container">
                    <div class="row">
                        <div class="col-md-5">
                            <info v-bind:UserLogged="UserLogged"></info>
                            <listfriend :listfriend="listfriend"></listfriend>
                            <listgroup :groups="groups"></listgroup>
                        </div>
                        <div class="col-md-7">
                            <mypost :UserLogged="UserLogged"></mypost>
                        </div>
                    </div>
                </div>
            </div> 
        </div>
    </div>
</template>

<script>
import UserInfo from '../profile/UserInfo.vue'
import MyPost from '../profile/MyPost.vue'
import Info from '../profile/user/Info.vue';
import ListFriend from '../home/ListFriends.vue'
import ListGroup from '../home/ListGroups.vue'

export default {
    props:['UserLogged','listfriend','groups'],
    components:{
        userinfo: UserInfo,
        mypost: MyPost,
        info: Info,
        listfriend: ListFriend,
        listgroup: ListGroup,
    }
}
</script>