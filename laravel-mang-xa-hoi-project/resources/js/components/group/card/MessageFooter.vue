<template>
    <div class="card-footer p-0" style="margin-top:-15px">
        <div class="input-group">
            <input type="text" class="form-control" v-model="message" @keyup.enter="sendMessage()" style="border-radius: 0 0 0 15px">
            <div class="input-group-prepend" @click="sendMessage()" style="outline: none;">
                <div class="input-group-text" style="border-radius:0 0 15px 0"><i class="fas fa-paper-plane text-success"></i></div>
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
        sendMessage(){
            if(this.message.trim() != ''){
                axios.post('/message/send_group_message',{
                    content: this.message,
                    group_id: this.$route.params.groupId
                }).then((response) => {
                    this.message = ''
                    if(response.data.status == 'success'){
                        // cập nhật tại Content.vue
                        bus.$emit('ReloadMessage',response.data.group_messages);

                        // âm thanh gửi - Content.vue (#sound-request)
                        document.getElementById('sound-request').play();
                    }
                })
            }
        }
    }
}
</script>