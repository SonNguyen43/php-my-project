<template>
    <div class="container-sm">
        <div class="row">
            <div class="col-md-7">
                <listfriends :listfriend="listfriend"></listfriends>
            </div> 
            <div class="col-md-5">  
                <lookingforfriends :UserLogged="UserLogged"></lookingforfriends>
                <listinvitation></listinvitation>
            </div>
        </div>
    </div>
</template>

<script>
import LookingForFriends from '../friend/index/LookingForFriends.vue'
import ListFriends from '../friend/index/ListFriends.vue'
import ListInvitation from '../friend/index/ListInvitation.vue'
import {bus} from '../../app.js'

export default {
    props:['UserLogged','listfriend'],
    components:{
        lookingforfriends: LookingForFriends,
        listfriends: ListFriends,
        listinvitation: ListInvitation
    },
}
</script>