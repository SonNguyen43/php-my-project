<template>
    <div>
        <div class="card mb-3 shadow-sm" style="border-radius: 15px 15px">
            <messageheader :UserLogged="UserLogged" :GroupInfo="GroupInfo"></messageheader>
            <messagebody :Messages="Messages" :UserLogged="UserLogged"></messagebody>
            <messagefooter></messagefooter>
        </div>
    </div>
</template>

<script>
import MessageHeader from '../card/MessageHeader.vue'
import MessageBody from '../card/MessageBody.vue'
import MessageFooter from '../card/MessageFooter.vue'

export default {
    props:['Messages','GroupInfo','UserLogged'],
    components:{
        messageheader: MessageHeader,
        messagebody: MessageBody,
        messagefooter: MessageFooter,
    },
}
</script>

<style scoped>
    .card{
        height: 85vh;
    }
    .card-body{
        overflow: scroll;
        overflow-x:hidden
    }
</style>