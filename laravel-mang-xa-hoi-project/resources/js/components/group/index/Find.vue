<template>
    <div class="position-relative">
        <div class="position-absolute" style="right: 0; top: 0"><i class="fas fa-search"></i></div>
        <input type="text" class="pr-4 pt-2 pb-2" placeholder="Nhập từ khóa" v-model="key" @keyup="FindGroup()">
    </div>
</template>

<script>
import {bus} from '../../../app.js';

export default {
    data(){
        return{
            key:''
        }
    },
    methods:{
        FindGroup(){
            var value = this.key.toLowerCase();
            $("#groups div.col-md-4").filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });      
        }
    }
}
</script>

<style scoped>
    input[type='text']{
        border-bottom: 1px solid #3c3c3c;
    }
</style>