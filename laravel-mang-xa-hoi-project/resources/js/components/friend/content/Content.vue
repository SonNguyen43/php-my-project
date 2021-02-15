<template>
    <div class="container-sm">
        <div class="row mb-3 d-flex justify-content-center">
            <transition name="fade">
                <div class="col-md-5" v-if="show">
                    <infouser :UserLogged="UserLogged" :friend_info="friend_info"></infouser>
                </div> 
            </transition>
            <div class="col-md-7">
                <div class="card mt-3 mb-3 shadow-sm" style="border-radius: 15px">
                    <message :UserLogged="UserLogged" :friend_info="friend_info"></message>
                </div>
                <!-- FILE ÂM THANH -->
                <div class="d-none">
                    <audio src="/storage/sound/request.mp3" controls id="sound-request">
                        Trình duyệt không hỗ trợ phát âm thanh
                    </audio>
                    <audio src="/storage/sound/response.mp3" controls id="sound-response">
                        Trình duyệt không hỗ trợ phát âm thanh
                    </audio>
                </div> <!-- END FILE ÂM THANH -->
            </div> 
        </div> 
    </div>
</template>

<script>
import InfoUser from './InfoUser.vue'
import Message from './Message.vue'
import { bus } from '../../../app'

export default {
    props:['UserLogged'],
    components:{
        infouser: InfoUser,
        message: Message
    },
    data(){
        return{
            friend_info:'',
            show: false
        }
    },
    created(){
        this.CheckUser()
        this.InfoToUser()

        bus.$on('ChangeShow', ()=>{
            this.show = !this.show
        })
    },
    methods:{
        InfoToUser(){
            // lấy của thằng được nhắn
            axios.post('/friend/info_friend',{
                friend_id: this.$route.params.friendId
            }).then((response) => {
                this.friend_info = response.data
            })
        },

        CheckUser(){
            axios.post('/friend/check_friend',{
                friend_id: this.$route.params.friendId
            }).then((response) => {
                if(response.data.result == 'true'){

                }else{
                    this.$router.go(-1);
                }
            })
        }
    }
}
</script>

<style scoped>
    .slide-fade-enter-active {
        transition: all .8s ease;
    }
    .slide-fade-leave-active {
        transition: all .8s cubic-bezier(1.0, 0.5, 0.8, 1.0);
    }
    .slide-fade-enter, .slide-fade-leave-to
        /* .slide-fade-leave-active below version 2.1.8 */ {
        transform: translateX(10px);
        opacity: 0;
    }
</style>