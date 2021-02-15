<template>
   <div class="card-footer p-0">
        <div class="input-group">
            <input type="text" class="form-control"  v-model="message" @keyup.enter="sendMessage()" style="border-radius: 0 0 0 15px">
            <div class="input-group-prepend" @click="sendMessage()">
                <div class="input-group-text" style="border-radius: 0 0 15px 0"><i class="fas fa-paper-plane text-success"></i></div>
            </div>
        </div>
    </div>
</template>

<script>
import {bus} from '../../../app.js'

export default {
    data(){
        return{
            message: ''
        }
    },
    methods:{
        // to_user_id lúc này đang trên URL 
        // nên dùng this.$route.params.friendId để lấy
        sendMessage(){
            if(this.message.trim() != ''){
                axios.post('/message/send_user_message',{
                    content: this.message,
                    to_user_id: this.$route.params.friendId
                }).then((response) => {
                    this.message = ''
                    if(response.data.status == 'success'){
                        // cập nhật tại Group.vue
                        bus.$emit('ReloadMessage',response.data.user_message);

                        // âm thanh đã gửi - Content.vue (#sound-request)
                        document.getElementById('sound-request').play();
                    }
                })
            }
        }
    }
}
</script>