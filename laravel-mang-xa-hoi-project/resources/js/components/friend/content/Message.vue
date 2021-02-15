<template>
    <div>
        <messageheader :friend_info="friend_info"></messageheader>
        <messagebody :UserLogged="UserLogged" :Messages="Messages"></messagebody>
        <messagefooter></messagefooter>
    </div> 
</template>

<script>
import {bus} from '../../../app.js'
import MessageHeader from '../card/MessageHeader.vue'
import MessageBody from '../card/MessageBody.vue'
import MessageFooter from '../card/MessageFooter.vue'

export default {
    props:['UserLogged','listfriend','friend_info'],
    components:{
        messageheader: MessageHeader,
        messagebody: MessageBody,
        messagefooter: MessageFooter,
    },
    created(){
        this.getMessages()

        // cập nhật tin nhắn
        bus.$on('ReloadMessage',(data)=>{
           this.Messages.push(data)
            $("#messages").animate({ scrollTop: $('#messages').prop("scrollHeight")}, 500);
        });
        
        // nhận sự kiện
        // chỗ này còn lỗi props của UserLogged
        // không nhận được UserLogged thì sẽ bị lỗi không nhận được sự kiện
        Echo.private("user."+this.$route.params.friendId+"_to_user."+this.UserLogged.id)
        .listen('MessageUser', (e) => {
            this.Messages.push(e.content)
            $("#messages").animate({ scrollTop: $('#messages').prop("scrollHeight")}, 500);

            // âm thanh nhận - Content.vue (#sound-response)
            document.getElementById('sound-response').play();
        })
    },
    beforeDestroy () {
      // huỷ lắng nghe nếu user thoát ra
        Echo.leave(`friend.${this.$route.params.friendId}`) 
    },
    data(){
        return{
            Messages: [],
        }
    },
    methods:{
        getMessages(){
            axios.post(`/message/user/${this.$route.params.friendId}`).then((response) => {
                this.Messages = response.data;
            })
        },
    }
}
</script>
