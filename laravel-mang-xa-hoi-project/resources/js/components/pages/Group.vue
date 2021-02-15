<template>
    <div class="container-sm">
        <div class="row">
            <div class="col-md-12 mt-3 card shadow-sm" style="border-radius: 15px">
                <div class="row card-body">
                    <div class="col-md-6">             <create class="d-inline"></create> </div>
                    <div class="col-md-6 text-right">  <find class="d-inline"></find>     </div>
                </div>
            
                <listgroups :groups="groups"></listgroups>
            </div>
        </div>
    </div>
</template>

<script>
import ListGroups from '../group/index/ListGroups.vue'
import Create from '../group/index/Create.vue'
import Find from '../group/index/Find.vue'

export default {
    props:['groups'],
    components:{
        listgroups: ListGroups,
        create: Create,
        find: Find
    },
}
</script>