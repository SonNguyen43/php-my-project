<template>
    <div class="right mt-3" id="right" style="margin-right: 3px">
        <findtracking></findtracking>
        
        <listtracking :all_tracking="all_tracking"></listtracking>  
    </div>
</template> 

<script>
import FindTracking from './tracking/FindTracking.vue';
import ListTracking from './tracking/ListTracking.vue';
import {bus} from '../../app.js';


export default {
    components:{
        listtracking: ListTracking,
        findtracking: FindTracking
    },
    data(){
        return{
            all_tracking: []
        }
    },
    created(){
        this.GetTracking();

        bus.$on('ReloadTracking', (data)=>{
            this.all_tracking = data;
        })

        bus.$on('AllTracking', ()=>{
            this.all_tracking = this.GetTracking();
        })

        
    },
    methods:{
        GetTracking(){
            axios.post('tracking/all_tracking').then((response) => {
                this.all_tracking = response.data;
            })
        }
    }
}
</script>

<style>
    .right{
        height: 90vh;
        /* overflow: scroll; */
        overflow-y: scroll;
        overflow-x: hidden;
    }
</style>