<template>
    <router-link to="/profile">
        <div class="btn bg-white p-3 mb-3 w-100 text-left border-0 shadow-sm gotoprofile" style="border-radius: 15px">
            <span v-if="UserLogged.avatar == 'noImage.png'"><img v-bind:src="'/storage/images/' + UserLogged.avatar" alt="" width="35px" height="35px" class="rounded-circle" id="avatar_navbar"></span>
            <span v-else><img v-bind:src="'/storage/images/avatars/user_'+ UserLogged.id + '/' + UserLogged.avatar" alt="" width="35px" height="35px" class="rounded-circle" id="avatar_navbar"></span>
            <b>{{UserLogged.name}}</b> <small>(Trang cá nhân)</small>
        </div>
    </router-link>
</template>

<script>
export default {
    props:['UserLogged'],
}
</script>