<template>
    <div>
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-secondary mb-3" data-toggle="modal" data-target="#createGroup">
            <i class="fas fa-plus-circle"></i> Tạo nhóm mới
        </button>

        <!-- Modal -->
        <div class="modal fade" id="createGroup" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-plus-circle"></i> Tạo mới</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group position-relative">
                            <label for="">Tên nhóm: </label>
                            
                            <input class="pl-4" type="text" v-model="group.name" @keyup.enter="CreateGroup()">
                            <i class="fas fa-signature position-absolute" style="bottom: 0; left: 0;"></i>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                        <button type="button" class="btn btn-primary" @click="CreateGroup()">Tạo</button>
                    </div>
                </div>
            </div>
        </div> <!-- end modal -->
    </div>
</template>

<script>
import {bus} from '../../../app.js'

export default {
    data(){
        return{
            group:{
                name: ''
            }
        }
    },
    methods:{
        CreateGroup(){
            if(this.group.name.trim() != ''){
                axios.post('/group/create',{
                    name: this.group.name
                }).then((response) => {
                    if(response.data.status == 'success'){
                        $('#createGroup').modal('hide')
                        bus.$emit('ReloadGroup');
                        this.group.name = '';
                    }
                })
            }
        }
    }
}
</script>

<style scoped>
    input[type='text']{
        border-bottom: 1px solid #000;
    }
</style>