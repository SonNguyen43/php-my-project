@extends('layouts.app')

@section('content')

<style>
    *{
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        list-style: none;
        text-decoration: none;
    }

    body{
        background-color: #f3f5f9;
    }

    .wrapper{
        display: flex;
        position: relative;
    }

    .wrapper .sidebar{
        width: 200px;
        height: 100%;
        background: #4b4276;
        padding: 30px 0px;
        position: fixed;
    }

    .wrapper .sidebar h2{
        color: #fff;
        text-transform: uppercase;
        text-align: center;
        margin-bottom: 30px;
    }

    .wrapper .sidebar ul li{
        padding: 15px;
        border-bottom: 1px solid #bdb8d7;
        border-bottom: 1px solid rgba(0,0,0,0.05);
        border-top: 1px solid rgba(255,255,255,0.05);
    }    

    .wrapper .sidebar ul li a{
        color: #bdb8d7;
        display: block;
    }

    .wrapper .sidebar ul li a .fas{
        width: 25px;
    }

    .wrapper .sidebar ul li:hover{
        background-color: #594f8d;
        border-bottom: 5px solid red;
    }
        
    .wrapper .sidebar ul li:hover a{
        color: #fff;
    }
    
    .wrapper .sidebar .social_media{
        position: absolute;
        bottom: 0;
        left: 50%;
        transform: translateX(-50%);
        display: flex;
    }

    .wrapper .sidebar .social_media a{
        display: block;
        width: 40px;
        background: #594f8d;
        height: 40px;
        line-height: 45px;
        text-align: center;
        margin: 0 5px;
        color: #bdb8d7;
        border-top-left-radius: 5px;
        border-top-right-radius: 5px;
    }

    .wrapper .main_content{
        width: 100%;
        margin-left: 200px;
    }

    .wrapper .main_content .header{
        padding: 20px;
        background: #fff;
        color: #717171;
        border-bottom: 1px solid #e0e4e8;
    }

    .wrapper .main_content .info{
        margin: 20px;
        color: #717171;
        line-height: 25px;
    }

    .wrapper .main_content .info div{
        margin-bottom: 20px;
    }

    @media (max-height: 500px){
        .social_media{
            display: none !important;
        }
    }
</style>

<div class="wrapper">
    @include('home.menu')

    <div class="main_content" id="main_content">
        @include('include.navbar')

        @include('include.message')

        @if (isset($categories))
            @include('home.catagories.content_catagories')
        @elseif (isset($edit_categorie))
            @include('home.catagories.edit_categorie')
        @elseif (isset($foods))
            @include('home.foods.content_foods')
        @elseif (isset($create_food))
            @include('home.foods.create_food')
        @elseif (isset($edit_food))
            @include('home.foods.edit_food')
        @elseif (isset($bookrooms))
            @include('home.bookroom.content_bookroom')
        @elseif (isset($bookeds))
            @include('home.bookroom.content_booked')
        @elseif (isset($rooms))
            @include('home.rooms.content_rooms')
        @elseif (isset($images))
            @include('home.images.content_images')
        @elseif (isset($feedbacks))
            @include('home.feedback.content_feedback')
        @elseif (isset($bookrooms))
            @include('home.bookroom.content_bookroom')
        @else
        <style>
            @import url('https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800&display=swap');

            .content{
                display: flex;
                justify-content: center;
                align-items: center;
                min-height: 50vh;

                margin: 0;
                padding: 0;
                box-sizing: border-box;
                font-family: 'Open Sans', sans-serif;
            }

            #clock h2{
                position: relative;
                display: block;
                text-align: center;
                margin: 10px 0;
                font-weight: 700;
                text-transform: uppercase;
                letter-spacing: 0.4em;
                font-size: 0.8em;
            }

            #clock #time{
                display: flex;
            }
            #clock #time div{
                position: relative;
                margin: 0 5px;

                -webkit-box-reflect: below 1px linear-gradient(transparent, #0004);
            }
            #clock #time div span{
                position: relative;
                display: block;
                width: 300px;
                height: 210px;
                background: #2196f3;
                color: #fff;
                font-weight: 300;
                display: flex;
                justify-content: center;
                align-items: center;
                font-size: 5em;
                z-index: 10;
                box-shadow: 0 0 0 1px rgba(0, 0, 0, 0.2);
            }

            #clock #time div span:nth-child(2){
                height: 30px;
                font-size: 1em;
                letter-spacing: 0.2em;
                font-weight: 500;
                z-index: 9;
                box-shadow: none;
                background: #127fd6;
                text-transform: uppercase;

            }
            #clock #time div:last-child span{
                background: #ff006a;
            }
            #clock #time div:last-child span:nth-child(2){
                background: #ec0062;
            }
        </style>

            <div class="content">
                <div id="clock">
                    <h2>Chúc Bạn Một Ngày Tốt Lành</h2>
                    <div id="time">
                        <div><span id="hour">00</span><span>Hours</span></div>
                        <div><span id="minutes">00</span><span>Minutes</span></div>
                        <div><span id="seconds">00</span><span>Seconds</span></div>
                    </div>
                </div>
            </div>

        <script>
            function clock() {
                var hours = document.getElementById("hour");
                var minutes = document.getElementById("minutes");
                var seconds= document.getElementById("seconds");

                var h = new Date().getHours();
                var m = new Date().getMinutes();
                var s = new Date().getSeconds();

                hours.innerHTML = h;
                minutes.innerHTML = m;
                seconds.innerHTML = s;
            }

            var interval = setInterval(clock, 1000);
        </script>
        
        @endif
    </div>
   
</div>
@endsection
