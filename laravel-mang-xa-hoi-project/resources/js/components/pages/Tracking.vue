<template>
    <div class="row tracking">
        <div class="col-md-3 m-0">
            <left :InfoAdmin="InfoAdmin"></left>
        </div> 
        <div class="col-md-9">
            <div class="row">
                <div class="col-md-12">
                    <!-- NAV -->
                    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-bulma">
                        <div class="navbar-brand font-weight-bold">Joker - Control Panel</div>
                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <ul class="navbar-nav mr-auto">
                            
                            </ul>
                            <form class="form-inline my-2 my-lg-0">
                                <input class="form-control mr-sm-2" type="search" placeholder="Nhập từ khóa" aria-label="Search">
                                <button class="btn btn-success my-2 my-sm-0" type="submit">Tìm</button>
                            </form>
                        </div>
                    </nav> <!-- END NAV-->
                </div>
                <div class="col-md-8 m-0">
                    <right></right>
                </div> 
                <div class="col-md-4 m-0">
                    <detail></detail>
                </div>
            </div>
        </div> 
    </div>  
</template>

<script>
import Left from '../admin/Left.vue'
import Right from '../admin/Right.vue'
import Detail from '../admin/Detail.vue'

export default {
    props:['InfoAdmin'],
    components:{
        left: Left,
        right: Right,
        detail: Detail
    }
}
</script>

<style lang="css">
    .tracking{
        height: 100vh;
        overflow: hidden;
    }
</style>