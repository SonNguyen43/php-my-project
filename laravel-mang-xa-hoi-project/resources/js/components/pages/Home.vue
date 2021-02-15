<template>
    <div>
    <div class="row">
        <div class="col-md-3 position-relative">
            <create class="mt-3"></create> 
            <div class="sticky-top home-left m-0">
                <gotoprofile :UserLogged="UserLogged"></gotoprofile>
                <div class="card mb-3 shadow-sm" style="border-radius: 15px">
                    <div class="card-body">
                        <i class="fas fa-gamepad"></i> Game - Video - Stream
                    </div>
                </div>
                <listfriends :listfriend="listfriend"></listfriends>
                <listgroups :groups="groups"></listgroups>

                <div class="card shadow-sm mb-3 p-3 border-0 shadow-sm" style="border-radius: 15px">
                    © Sơn Nguyễn 2020, All Rights Reserved
                </div>
            </div>
        </div>
        <div class="col-md-6 center">
            <listpost :UserLogged="UserLogged"></listpost>
        </div>
        <div class="col-md-3 position-relative">
            <div class="sticky-top home-right">
                <listfriendsformessage :listfriend="listfriend"></listfriendsformessage>
                <gotoprofile :UserLogged="UserLogged"></gotoprofile>
            </div>
        </div>
    </div>
    </div>
</template>

<script>
import ListPost from '../home/ListPost.vue'
import Create from '../profile/posts/Create';
import GoToProfile from '../home/GoToProfile';
import ListFriends from '../home/ListFriends';
import ListFriendsForMessage from '../home/ListFriendsForMessage';
import ListGroups from '../home/ListGroups';

export default {
    props:['UserLogged','listfriend','groups'],
    components:{
        listpost: ListPost,
        create: Create,
        gotoprofile: GoToProfile,
        listfriends: ListFriends,
        listgroups: ListGroups,
        listfriendsformessage: ListFriendsForMessage
    },    
}
</script>

<style lang="css" scoped>
    .home-left, .home-right{
       z-index: 1;
    }
</style>