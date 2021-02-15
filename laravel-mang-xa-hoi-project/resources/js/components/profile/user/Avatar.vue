<template>
    <div>
        <!-- ẢNH BÌA -->
        <div class="d-flex justify-content-center">
            <!-- Show ảnh bìa -->
            <div v-if="UserLogged.cover_image == 'noImage'">
                <img v-bind:src="'/storage/images/cover_images/cover_image.jpg'"
                id="cover_image_change"  style="width: 850px; height: 370px; border-radius: 20px;">
            </div>
            <div v-else>
                <img v-bind:src="'/storage/images/cover_images/user_'+UserLogged.id + '/' + UserLogged.cover_image"
                id="cover_image_change"  style="width: 850px; height: 370px; border-radius: 20px;">

            </div> <!-- end show ảnh-->

            <div class="position-relative">
                <div class="position-absolute btn btn-light pb-0 pt-0" style="bottom:15px; right:30px; width: 150px">
                    <div class="btn btn-light" data-toggle="modal" data-target="#ChangeCoverImage"><i class="fa fa-camera"></i> Chọn ảnh</div> 
                </div>
            </div>
           
        </div> <!-- END ẢNH BÌA-->

      
        <!-- avatar -->
        <div style="margin-top: -100px">
            <div class="img d-inline position-relative">
                <span v-if="UserLogged.avatar == 'noImage.png'"><img v-bind:src="'/storage/images/' + UserLogged.avatar" alt="" width="200px" height="200px" id="avatar" class="rounded-circle"></span>
                <span v-else><img v-bind:src="'/storage/images/avatars/user_'+ UserLogged.id + '/' + UserLogged.avatar" alt="" width="200px" height="200px" id="avatar" class="rounded-circle"></span>
                
                <div class="text-center text-light border position-absolute ChangeAvatar" data-toggle="modal" data-target="#ChangeAvatar">
                    <i class="fas fa-camera" aria-hidden="false"></i> Đổi ảnh
                </div>
            </div>  <!-- end avatar -->
        </div>

        <hr class="bg-dark w-50">

        <div class="position-relative">
            <div class="">
                <div class="info d-inline">
                <h2>{{UserLogged.name}}</h2>
                </div>
                <!-- Dữ liệu lấy từ app.js -->
                <small>( {{UserLogged.email}} )</small>
            </div>
        </div>
       
        <!-- MODAL AVATAR -->
        <div class="modal fade text-left" id="ChangeAvatar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="z-index: 2500">
            <div class="modal-dialog modal-dialog-centered " role="document">
                <div class="modal-content border">
                    <!-- WEBCAM -->
                    <div v-if="showWebcam">
                        <WebCam id="webcam" class="text-center"
                            ref="webcam"
                            width="100%"
                            height="100%"
                            >
                        </WebCam>
                    </div>
                    
                    <div class="row mt-2">
                        <div class="col-md-4">
                            <div class="btn btn-outline-success d-block" @click="onStart">Mở Camera</div>
                        </div>  
                         <div class="col-md-4">
                            <div class="btn btn-outline-warning d-block" @click="onStop">Đóng Camera</div>
                        </div>    
                        <div class="col-md-4">
                            <div class="btn btn-outline-danger d-block" v-on:click="onCapture()">Chụp</div>
                        </div>    
                    </div> 
                    <!-- END WEBCAM -->

                    <!-- FORM -->
                    <form method="POST" id="form_change_avatar" accept-charset="UTF-8" enctype="multipart/form-data" v-on:submit.prevent="ChangeAvatar">
                        <div class="modal-body">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>   
                            <label for="">Chọn ảnh</label>
                            <br>
                            <input class="personal border-top-0 border-left-0 border-right-0 w-100 d-none" style="font-size:20px;" name="id" type="text" value="4">
                            <div class="custom-file mt-3 mb-3">
                                <input accept="image/*" class="custom-file-input" id="chooseImage" name="avatar" type="file" v-on:change="ShowImage">
                                <label class="custom-file-label" for="chooseImage">Chọn file ảnh...</label>
                                <div class="invalid-feedback">Example invalid custom file feedback</div>
                            </div>
                            <div v-show="avatar.preview">
                                <label for="">Xem trước</label><br>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="d-flex justify-content-center">
                                            <img id="root_img" src="" alt="Chưa có ảnh được chọn" style="width: 200px; height: 200px; border-radius: 200px" class="shadow-sm border">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                            <button class="btn btn-success" type="submit">Thay đổi</button>
                        </div>
                    </form> <!-- END FORM-->
                </div>
            </div>
        </div> <!-- END AVATAR -->

          <!-- MODAL COVER IMAGES -->
        <div class="modal fade text-left" id="ChangeCoverImage" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="z-index: 2500">
            <div class="modal-dialog modal-dialog-centered " role="document">
                <div class="modal-content border">
                    <!-- FORM -->
                    <form method="POST" id="form_change_cover_image" accept-charset="UTF-8" enctype="multipart/form-data" v-on:submit.prevent="ChangeCoverImage">
                        <div class="modal-body">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>   
                            <label for="">Chọn ảnh</label>
                            <br>
                            <input class="personal border-top-0 border-left-0 border-right-0 w-100 d-none" style="font-size:20px;" name="id" type="text" value="4">
                            <div class="custom-file mt-3 mb-3">
                                <input accept="image/*" class="custom-file-input" id="chooseCoverImage" type="file" v-on:change="ShowCoverImage">
                                <label class="custom-file-label" for="chooseCoverImage">Chọn file ảnh...</label>
                                <div class="invalid-feedback">Example invalid custom file feedback</div>
                            </div>
                            <div v-show="cover_images.preview">
                                <label for="">Xem trước</label><br>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="d-flex justify-content-center">
                                            <img id="root_img_cover" src="" alt="Chưa có ảnh được chọn" style="width: 100%; border-radius: 10px" class="shadow-sm border">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                            <button class="btn btn-success" type="submit">Thay đổi</button>
                        </div>
                    </form> <!-- END MODAL COVER IMAGES -->
                </div>
            </div>
        </div> <!-- END AVATAR -->

    </div>
</template>

<script>
import {bus} from '../../../app';
import Swal from 'sweetalert2/dist/sweetalert2.js'
import 'sweetalert2/src/sweetalert2.scss'

import { WebCam } from 'vue-cam-vision'

export default {
    props:['UserLogged'],
    components: {
        WebCam
    },
    data(){
        return{
            avatar:{
                preview: false,
                attactment: '',
            },
            cover_images:{
                preview: false,
                attactment: ''
            },

            form: new FormData,

            captures: [],
            imgReport: [],
            frontCam: true,
            webcam: null,
            img: null,
            camera: null,
            deviceId: null,
            devices: [],
            googleKey: process.env.VUE_APP_OCR_GVA,

            showWebcam: false
        }
    },
    methods:{
        ShowImage(e){
            // console.log(e);
            // xem trước ảnh
            let chooseImage = document.getElementById("chooseImage")
            let root_img = document.getElementById("root_img")
            root_img.src = URL.createObjectURL(e.target.files[0])
            this.avatar.preview = true;
            
            // lấy ảnh, bước chuẩn bị gửi qua server
            let selectFile = e.target.files[0]
            this.avatar.attactment = selectFile
        },

         ShowCoverImage(e){
            // console.log(e);
            // xem trước ảnh
            let chooseImage = document.getElementById("chooseCoverImage")
            let root_img = document.getElementById("root_img_cover")
            root_img.src = URL.createObjectURL(e.target.files[0])
            this.cover_images.preview = true;
            
            // lấy ảnh, bước chuẩn bị gửi qua server
            let selectFile = e.target.files[0]
            this.cover_images.attactment = selectFile
        },

        ChangeAvatar(e){
            // trường hợp người dùng chưa chọn hay chụp ảnh thì attactment sẽ rỗng và không nhấn được submit
            if(this.avatar.attactment != ''){
                this.form.append('avatar',this.avatar.attactment)

                axios.post('/profile/change_avatar',this.form).then(response =>{
                    // console.log(response.data);
                    if(response.data.result == 'success'){
                        // ẩn modal 
                        $('#ChangeAvatar').modal('hide')
                        // hiện thông báo thành công 
                        Swal.fire({icon: 'success', title: 'Đã thay đổi thông tin..!', showConfirmButton: false,timer: 1500, index: 1500})
                        // update ảnh và hiển thị ra ngoài 
                        let path_avatar = '/storage/images/avatars/user_'+ response.data.user_id +'/'+ response.data.file_name
                        document.getElementById('avatar').src = path_avatar
                    
                        // bắt sự kiện này tại App.vue => update ảnh ở Navbar.vue
                        bus.$emit('ChangeAvatar')

                        // tắt webcam 
                        this.onStop()

                        // reset form
                        this.avatar.attactment = ''
                        e.target.reset();
                    }else{
                        Swal.fire({icon: 'error', title: 'Thay đổi thất bại.!', showConfirmButton: false,timer: 1500})
                    }
                })
                this.avatar.preview = false;
            }else{
                // ẩn modal 
                $('#ChangeAvatar').modal('hide')
                Swal.fire({icon: 'error', title: 'Vui lòng chọn ảnh.!', showConfirmButton: false,timer: 1500})
            }
           
        },

        ChangeCoverImage(e){
            if(this.cover_images.attactment != ''){

                var formData = new FormData()
                formData.append('cover_image',this.cover_images.attactment)

                axios.post('/profile/change_cover_image',formData).then(response =>{
                    // console.log(response.data);
                    if(response.data.result == 'success'){
                        // ẩn modal 
                        $('#ChangeCoverImage').modal('hide')
                        // hiện thông báo thành công 
                        Swal.fire({icon: 'success', title: 'Đã thay đổi thông tin..!', showConfirmButton: false,timer: 1500, index: 1500})
                        // update ảnh và hiển thị ra ngoài 
                        let path_avatar = '/storage/images/cover_images/user_'+ response.data.user_id +'/'+ response.data.file_name
                        document.getElementById('cover_image_change').src = path_avatar

                        bus.$emit('ChangeCoverImage')

                        // reset form
                        this.cover_images.attactment = ''
                        e.target.reset();
                    }else{
                        $('#ChangeCoverImage').modal('hide')
                        Swal.fire({icon: 'error', title: 'Thay đổi thất bại.!', showConfirmButton: false,timer: 1500})
                    }
                })
                this.cover_images.preview = false;
            }else{
                // ẩn modal 
                $('#ChangeCoverImage').modal('hide')
                Swal.fire({icon: 'error', title: 'Vui lòng chọn ảnh.!', showConfirmButton: false,timer: 1500})
            }
        },

        // chụp ảnh
        async onCapture () {
             try {
                this.avatar.preview = true;
                document.getElementById('root_img').src = await this.$refs.webcam.capture()
                this.avatar.attactment = await this.$refs.webcam.capture()

                //  await this.$refs.webcam.capture() đang là base64
            } catch (error) {
                $('#ChangeAvatar').modal('hide')
                Swal.fire({icon: 'error', title: 'Hãy mở webcam.!', showConfirmButton: false,timer: 1500})
            }
           
        },

        // dừng máy ảnh
        onStop () {
             // chỗ này không try catch là bị lỗi
            try {
                this.$refs.webcam.stop()
                $('#webcam').css('display', 'none')
            } catch (error) {
                
            }
        },

        // mở máy ảnh
        onStart () {
            // mở webcam - khi vừa load thì nó ẩn
            this.showWebcam = true

            // chỗ này không try catch là bị lỗi
            try {
                this.$refs.webcam.start()
                $('#webcam').css('display', 'block')
            } catch (error) {
                
            }
        },
    }
}
</script>

<style scoped>
    .ChangeAvatar{
        opacity: 0;
        top: 0;
        left: 0px;
        width: 200px;
        height: 100px;
        line-height: 100px;
        margin-top: 15px;
        font-size: 20px;
        background: #000;
        border-radius: 0 0 200px 200px;
        transition: .4s ease-in;
        z-index: 1s linear;
        cursor: pointer;
    }
    .avatar:hover ~ .ChangeAvatar{
        opacity: 1;
    }

    .ChangeAvatar:hover{
        opacity: 1;
    }

    #avatar{
        border: 7px solid #fff
    }

    [data-theme="dark"] #avatar{
        border: 7px solid #000;
    }
</style>