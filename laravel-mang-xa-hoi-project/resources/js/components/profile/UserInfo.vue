<template>
    <div class="card mt-3 p-3 mb-3 shadow-sm border-0 text-center profile_info">
        <avatar v-bind:UserLogged="UserLogged"></avatar>
    </div>
</template>

<script>
import Avatar from './user/Avatar.vue';
export default {
    props:['UserLogged'],
    components:{
        avatar: Avatar,
    },
}
</script>