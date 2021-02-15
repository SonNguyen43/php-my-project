<div class="container">
    <div class="card" style="margin-top: 120px">
        <h3 class="mt-3 ml-3"><i class="fas fa-shopping-cart"></i> Giỏ hàng của bạn</h3>    
        
        <div id="info_cart" class="mb-3"></div>
    </div>
</div>

<style>
    .buttons_added {
        opacity:1;
        display:inline-block;
        display:-ms-inline-flexbox;
        display:inline-flex;
        white-space:nowrap;
        vertical-align:top;
    }
    .is-form {
        overflow:hidden;
        position:relative;
        background-color:#f9f9f9;
        height:2.2rem;
        width:1.9rem;
        padding:0;
        text-shadow:1px 1px 1px #fff;
        border:1px solid #ddd;
    }
    .is-form:focus,.input-text:focus {
        outline:none;
    }
    .is-form.minus {
        border-radius:4px 0 0 4px;
    }
    .is-form.plus {
        border-radius:0 4px 4px 0;
    }
    .input-qty {
        width: 80px;
        background-color:#fff;
        height:2.2rem;
        text-align:center;
        font-size:1rem;
        display:inline-block;
        vertical-align:top;
        margin:0;
        border-top:1px solid #ddd;
        border-bottom:1px solid #ddd;
        border-left:0;
        border-right:0;
        padding:0;
    }
    .input-qty::-webkit-outer-spin-button,.input-qty::-webkit-inner-spin-button {
        -webkit-appearance:none;
        margin:0;
    }

</style>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    $(document).ready(function(){
        $("#info_cart").load("views/quanli/user/cart/info.php");
    });
</script>