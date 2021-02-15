<template>
    <div class="container-sm">
        <div class="row">
            <div class="col-md-7 mt-3">
                <messages :Messages="Messages" :GroupInfo="GroupInfo" :UserLogged="UserLogged"></messages>
            </div>
            <div class="col-md-5 mt-3">
                <listuser :GroupInfo="GroupInfo" :UserLogged="UserLogged"></listuser>

                <!-- FILE ÂM THANH -->
                <div class="d-none">
                    <audio src="/storage/sound/request.mp3" controls id="sound-request">
                        Trình duyệt không hỗ trợ phát âm thanh
                    </audio>
                    <audio src="/storage/sound/response.mp3" controls id="sound-response">
                        Trình duyệt không hỗ trợ phát âm thanh
                    </audio>
                </div>
                <!-- END FILE ÂM THANH -->
            </div>
        </div>
    </div>
</template>

<script>
import {bus} from '../../../app.js'
import $ from 'jquery'
import Message from './Message'
import ListUser from './ListUser'

export default {
    // nhận user đang đăng nhập thẳng ở đây luôn
    props:['UserLogged'],
    components:{
        messages: Message,
        listuser: ListUser
    },
    data(){
        return{
            GroupInfo: [],
            Messages: [],
        }
    },
    created(){
        this.checkUserOfGroup()

        // nhận từ GroupMessageFooter.vue
        bus.$on('ReloadMessage',(data)=>{
            this.Messages.push(data)
            $("#messages").animate({ scrollTop: $('#messages').prop("scrollHeight")}, 500)
        });

        // lắng nghe sự kiện
        Echo.private(`group.${this.$route.params.groupId}`)
        .listen('MessageGroup', (data) => {
            this.Messages.push(data.content)
            $("#messages").animate({ scrollTop: $('#messages').prop("scrollHeight")}, 500);

            // âm thanh nhận - Content.vue (#sound-response)
            document.getElementById('sound-response').play();
        })
    },
    beforeDestroy () {
        // huỷ lắng nghe nếu user thoát ra
        Echo.leave(`group.${this.$route.params.groupId}`) 
    },
    methods:{
        getMessages(){
            axios.post(`/message/group/${this.$route.params.groupId}`).then((response) => {
                this.Messages = response.data
            })
        },
        getInfoGroup(){
            axios.post('/group/info_group',{
                group_id: this.$route.params.groupId
            }).then((response) => {
                this.GroupInfo = response.data;
            })
        },

        // Kiểm tra xem thằng này có phải là thành viên của nhóm không
        checkUserOfGroup(){
            axios.post('/group/check_user_of_group',{
                group_id: this.$route.params.groupId,
                user_id: this.UserLogged.id
            }).then((response) => {
                // có trong nhóm mới tiến hành load dữ liệu
                if (response.data.result == "true") {
                    // SẼ XUẤT HIỆN LỖI TẠI ListUser 
                    // nó không nhận được GroupInfo[0].user
                    // bởi vì khi load trang thì nó đã kiểm tra rồi
                    // checkUserOfGroup sẽ trả dữ liệu getInfoGroup về chậm nên nó xuất hiện lỗi
                    // => không ảnh hưởng

                    // để 2 hàm dưới đây lên created() sẽ ổn
                    this.getMessages()
                    this.getInfoGroup()
                }else{
                    this.$router.go(-1);
                }
            })
        }
    }
}
</script>