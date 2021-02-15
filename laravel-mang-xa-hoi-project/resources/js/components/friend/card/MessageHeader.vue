<template>
    <div class="card-header bg-white" style="border-radius: 15px 15px 0 0">
        <div v-on:click="ShowInfoUser" class="w-50">
            <span v-if="friend_info.avatar == 'noImage.png'"><img :src="'/storage/images/noImage.png'" width="40px" height="40px" class="rounded-circle  mr-1 d-inline" alt="..."></span>
            <span v-else><img :src="'/storage/images/avatars/user_'+friend_info.id+'/'+friend_info.avatar" width="40px" height="40px" class="rounded-circle  mr-1 d-inline" alt="..."></span>
            <h6 class="mt-0 d-inline">{{friend_info.name}}</h6>
        </div>
      

        <div class="position-relative"> 
            <div class="dropdown position-absolute" style="top: -30px; right: 5px">
                <i class="fas fa-ellipsis-h" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></i>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                    <span class="dropdown-item" v-on:click="ShowInfoUser">Ẩn/Hiện thông tin</span>
                </div>
            </div>
        </div>
        
    </div>
</template>

<script>
import {bus} from '../../../app.js'

export default {
    props:['friend_info'],
    methods: {
        ShowInfoUser(){
            bus.$emit('ChangeShow')
        }
    }
}
</script>