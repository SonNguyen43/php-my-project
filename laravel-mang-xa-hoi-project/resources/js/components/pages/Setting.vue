<template>
    <div class="container-sm">
        <div class="row">
            <div class="col-md-12">
                <div class="card mt-3 p-3 shadow-bulma border-0 mb-3">
                    <h3><i class="fas fa-address-card"></i> Cài đặt chung</h3><hr>
                    <changeinfo v-bind:UserLogged="UserLogged"></changeinfo>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card p-3 border-0 mb-3 shadow-bulma">
                    <h3><i class="fas fa-shield-alt"></i> Bảo mật</h3><hr>
                    <changepassword></changepassword>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card p-3 border-0 mb-3 shadow-bulma">
                    <h3><i class="fas fa-window-restore"></i> Khác</h3><hr>
                    <other></other>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import {bus} from '../../app'
import ChangInfo from '../setting/ChangesInfo.vue'
import ChangesPassword from '../setting/ChangesPassword.vue'
import Other from '../setting/Other.vue'

export default {
    props:['UserLogged'],
    components:{
        changeinfo: ChangInfo,
        changepassword: ChangesPassword,
        other: Other
    }
}
</script>

<style>
    input{
        width: 100%;
        outline: none;
        border: none;
        background: transparent;
    }
    input:hover{
        border-bottom: 1px solid #ccc;
    }
    input:focus{
        border-bottom: 1px solid #000;
    }
    .show{
        cursor: pointer;
    }
</style>