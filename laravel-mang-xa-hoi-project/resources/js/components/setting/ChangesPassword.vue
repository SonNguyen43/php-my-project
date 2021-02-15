<template>
    <div>
        <div class="mb-3 d-block list" v-on:click="setting.show_password = !setting.show_password">
            &#8226; Thay đổi thông tin mật khẩu
        </div>

        <div v-if="setting.show_password" class="card p-3 mb-3 ">
            <form method="post" class="text-left" v-on:submit.prevent="ChangePassword" id="edit_password_form">
                <div class="form-group">
                    <label for="" class=""><small><em>Mật khẩu cũ:</em></small> </label>
                    <input type="password" name="old_password" v-model="password.old_password" required autocomplete="off" placeholder="ex. *****">
                </div>
                <div class="form-group">
                    <label for="" class=""><small><em>Mật khẩu mới:</em></small></label>
                    <input type="password" name="new_password" v-model="password.new_password" required autocomplete="off" placeholder="ex. *****">
                </div>
                <div class="form-group">
                    <label for=""><small><em>Xác nhận mật khẩu mới:</em> </small></label>
                    <input type="password" name="confirm_new_password" v-model="password.confirm_new_password" required autocomplete="off" placeholder="ex. *****">
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
    data(){
        return{
            setting:{
                show_password: false,
            },
            password:{
                old_password: '',
                new_password: '',
                confirm_new_password:''
            }
        }
    }, 
    methods:{
        ChangePassword(){
            // kiểm tra rỗng
            if(this.password.old_password.trim() != '' && this.password.new_password.trim() != '' && this.password.confirm_new_password.trim() != ''){
                // độ dài mật khẩu mới có dài không
                if(this.password.new_password.length > 5){
                    // xác nhận mật khẩu mới có trùng không
                    if(this.password.new_password.trim() == this.password.confirm_new_password.trim()){
                        axios.post('/setting/change_password',{
                            old_password: this.password.old_password.trim(),
                            new_password: this.password.new_password.trim(),
                            confirm_new_password: this.password.confirm_new_password.trim()
                        }).then(response =>{
                            if(response.data.result == 'success'){
                                /* hiện thông báo thành công */
                                Swal.fire({icon: 'success', title: 'Thay đổi mật khẩu thành công..!', showConfirmButton: false,timer: 1500})
                            }else{
                                Swal.fire({icon: 'error', title: 'Mật khẩu cũ không chính xác..!', showConfirmButton: false,timer: 1500})
                            }
                            $('#edit_password_form')[0].reset();
                        });
                    }else{
                        Swal.fire({icon: 'error', title: 'Mật khẩu xác nhận không giống nhau..!', showConfirmButton: false,timer: 1500})
                    }
                }else{
                    Swal.fire({icon: 'error', title: 'Độ dài mật khẩu ít nhất 6 kí tự..!', showConfirmButton: false,timer: 1500})
                }
            }else{
                Swal.fire({icon: 'error', title: 'Vui lòng điền đầy đủ thông tin..!', showConfirmButton: false,timer: 1500})
            }
        }
    }
}
</script>

<style scoped>
    .list{
        cursor: pointer;
    }
</style>