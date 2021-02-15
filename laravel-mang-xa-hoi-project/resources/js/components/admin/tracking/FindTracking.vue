<template>
    <div class="mb-3 position-relative">
        <div class="card shadow-bulma">
            <div class="card-body">
                <form method="post">
                    <h4 class="text-left"><i class="fas fa-search"></i> Tìm kiếm</h4>
                    <div class="row">
                        <div class="col-md-6">
                            <label for="">Nhập tên: </label>
                            <input type="text" class="form-control rounded-pill key" v-model="name" @keyup="Find()" tabindex="1" autofocus>
                        </div>
                        <div class="col-md-6">
                            <label for="">Chọn ngày: </label>
                            <input type="date" class="form-control rounded-pill key" v-model="created_at" @change="Find()" tabindex="2">
                        </div>
                         <div class="col-md-12">
                            <label for="">Hoạt động: </label>
                             <div class="control_wrapper">
                                <ejs-autocomplete :dataSource='sportsData' 
                                                  :placeholder="waterMark" 
                                                  v-model="action" 
                                                  @change="Find()"
                                                  tabindex="3">
                                </ejs-autocomplete>
                            </div>
                        </div>
                    </div>
                   
                </form>
            </div>    
        </div>        
    </div>
</template>

<script>
import {bus} from '../../../app.js';
import Vue from 'vue';
import { AutoCompletePlugin } from '@syncfusion/ej2-vue-dropdowns';

Vue.use(AutoCompletePlugin);

export default {
    data(){
        return{
            name: '',
            created_at: '',
            action: '',

            waterMark : 'e.g. Đăng nhập',
            sportsData: [
                'Đăng nhập', 'Đăng xuất', 'Comment bài viết', 'Thích bài viết',
                'Hủy thích bài viết', 'Tạo mới bài viết', 'Xóa bài viết',
            ]
        }
    },
    methods:{
        Find(){
            console.log(this.action);
            
            axios.post('/tracking/find_user',{
                name: this.name,
                created_at: this.created_at,
                action: this.action
            }).then((response) => {
                bus.$emit('ReloadTracking', response.data)
            })
        }
    }
}
</script>

<style>
    @import url("https://cdn.syncfusion.com/ej2/material.css");

    #ej2_dropdownlist_0{
        font-size: 16px;
    }
    
    [data-theme="dark"] #ej2_dropdownlist_0 {
        color: #eee;
        border-bottom: 1px solid red;
    }
</style>