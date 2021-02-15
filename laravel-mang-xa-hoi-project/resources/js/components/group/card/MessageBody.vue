<template>
    <div class="card-body" id="messages">
        <!-- UserLogged để kiểm tra thằng đang đăng nhập thì hiển thị bên phải -->
        <div v-for="(message,index) in Messages" :key="index">
           
            <!-- bên phải -->
            <span v-if="message.user.id == UserLogged.id">
                <div class="mb-3 text-right" :title="message.created_at">
                    <div class="btn message text-right" style="background: #F2F3F5; border-radius: 25px">
                        <h6 class="mt-0">{{message.user.name}}</h6>
                        <span v-html="message.content" class=""></span>
                    </div>
                </div>
            </span> <!-- end phải -->
            <!-- bên trái -->
            <span v-else>
                <div class="mb-3" :title="message.created_at">
                    <span v-if="message.user.avatar == 'noImage.png'"><img :src="'/storage/images/noImage.png'" width="40px" height="40px" class="rounded-circle align-self-center mr-2 d-inline" alt="..."></span>
                    <span v-else><img :src="'/storage/images/avatars/user_'+message.user.id+'/'+message.user.avatar" width="40px" height="40px" class="rounded-circle align-self-center mr-2 d-inline" alt="..."></span>
                   <div class="btn text-left" style="background: #F2F3F5; border-radius: 25px" :title="message.created_at">
                        <h6 class="mt-0">{{message.user.name}}</h6>
                        <span v-html="message.content"></span>
                    </div>
                </div>
            </span> <!-- end trái -->
        </div>
    </div>
</template>

<script>
import {bus} from '../../../app.js'

export default {
    props:['Messages','UserLogged'],
    created(){
        setTimeout(function(){
            $("#messages").animate({ scrollTop: $('#messages').prop("scrollHeight")}, 500);
        }, 2000);
    },
}
</script>
