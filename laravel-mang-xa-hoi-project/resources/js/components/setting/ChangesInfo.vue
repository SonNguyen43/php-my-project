<template>
    <div class="">
        <div class="mb-3 d-block list" @click="setting.show_info = !setting.show_info">
            &#8226; Thay đổi thông tin cá nhân
        </div>

        <div v-if="setting.show_info" class="card p-3 mb-3">
            <form method="post" class="text-left" v-on:submit.prevent="ChangeInfoUser" id="edit_user_form">
                <div class="row">
                    <div class="col-md-6">
                         <div class="form-group">
                            <label for="" class=""><small><em>Họ tên:</em></small></label>
                            <input type="text" required autocomplete="off" v-model="UserLogged.name">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for=""><small><em>Số điện thoại:</em> </small></label>
                            <input type="number" required autocomplete="off" v-model="UserLogged.phone_number">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="" class=""><small><em>Địa chỉ:</em></small> </label>
                            <input type="text" required autocomplete="off" v-model="UserLogged.address">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for=""><small><em>Ngày sinh:</em></small></label>
                            <input type="date" name="birthday" required v-model="UserLogged.birthday">
                        </div>
                    </div>
                </div>
               
                <div class="form-group">
                    <button type="submit" class="btn btn-success"><i class="fas fa-save"></i> Lưu lại</button>
                </div>
            </form>
        </div>
    </div>
</template>

<script>
import Swal from 'sweetalert2/dist/sweetalert2.js'
import 'sweetalert2/src/sweetalert2.scss'

export default {
    props:['UserLogged'],
    data(){
        return{
            setting:{
                show_info: false,
            }
        }
    },
    methods:{
        ChangeInfoUser(){
            // kiểm tra thông tin có rỗng không
            if(this.UserLogged.name.trim() != '' && this.UserLogged.address.trim() != ''
                && this.UserLogged.phone_number.trim() != 0 && this.UserLogged.birthday != ''){
                axios.post('/setting/change_info_user',{
                    name: this.UserLogged.name.trim(),
                    address: this.UserLogged.address.trim(),
                    phone_number: this.UserLogged.phone_number.trim(),
                    birthday: this.UserLogged.birthday
                }).then(response =>{
                    if (response.data.result == 'success') {
                        // hiện thông báo thành công
                        Swal.fire({icon: 'success', title: 'Đã thay đổi thông tin..!', showConfirmButton: false,timer: 1500})
                    }else if(response.data.result = 'already_exist'){
                        Swal.fire({icon: 'error', title: 'Đã tồn tại số điện thoại này..!', showConfirmButton: false,timer: 1500})
                    }
                })
            }else{
                // hiện thông báo thất bại 
               Swal.fire({icon: 'error', title: 'Vui lòng điền đầy đủ thông tin..!', showConfirmButton: false,timer: 1500})
            }
        },
    }
}
</script>

<style scoped>
    .list{
        cursor: pointer;
    }
</style>