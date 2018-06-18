@extends('layouts.app')

@section('head')
    <script src="js/connect_to_pusher-watch.js"></script>
    <script src="js/watch-match.js"></script>
@endsection

@section('body')

    {{--so they can be loaded faster--}}
    <img style="display:none" src='images\waiting3.gif' height='35' >
    <img style="display:none" src='images\true.png' height='35' >
    <img style="display:none" src='images\false.png' height='35' >


    {{-----------------------------------------------------------------------------------------------}}

    <div class="container" id="connecting-menu" style="display:none" >

        <br>
        <img height='100' src="images\loading.gif">
        <h1>جاري الاتصال</h1>

    </div>


    {{-----------------------------------------------------------------------------------------------}}

    <div class="container" id="waiting-menu" style="display:none" >

        <br>
        <img height='100' src="images\downloading.gif">
        <h1>جاري التحميل</h1>

    </div>

    {{-----------------------------------------------------------------------------------------------}}

    <div class="container" id="watch-game-menu" style="display:none" >
        <div id="watch-game-home-button" class="home-button"><img width=30 src="images/home.png"></img></div>

        <table id="running-match-stats-table" >

            <tr>
                <td class="running-match-stats-table-data" id="current-user-1"><img id="loading-user-1" src="images/loading2.gif" height="50" style="padding:20px 0px;margin: 0px -10px;"> <div id="user-1-div" style="display:none"> <h2 id="user_1_name">اسم اللاعب</h2><div id="points"><h3 id="user_1_points">0</h3></div><div id="user_1_state"><img style="margin-bottom: -5px;padding-top: 2px;" src="images\waiting.gif" height="30" ></div></div></td>
                <td><img style="padding:0px 15px" src="images\vs.png" height="45"></td>
                <td class="running-match-stats-table-data" id="current-user-2"><img id="loading-user-2" src="images/loading2.gif" height="50" style="padding:20px 0px;margin: 0px -10px;"> <div id="user-2-div" style="display:none"> <h2 id="user_2_name">اسم اللاعب</h2><div id="points"><h3 id="user_2_points">0</h3></div><div id="user_2_state"><img style="margin-bottom: -5px;padding-top: 2px;" src="images\waiting.gif" height="30"> </div></div></td>
            </tr>

        </table>

        <div dir="rtl" id="watch-match-question-counter">
            <h3 id="questions-counter" >في انتظار اللاعبين</h3>
        </div>


         <img id="ftc-logo" height=120 style="margin-top:5px" src="images/ftc-logo.png" >


        <div id="last-game-result-container">
            <h2>نتيجة اخر تحدي</h2>
            <h3 id="last-game" >فوز عبدالعزيز</h3>
        </div>

        <div dir="rtl" id="best-result-container">
            <h2>
            <img style="margin: 1px 1px -4px 4px;" id="star-image" src="images/star.gif" height="20">
            افضل نتيجة
            <img style="margin: 1px 4px -4px 1px;" id="star-image" src="images/star.gif" height="20">
            </h2>

            <h3 id="best-result" >عبدالعزيز</h3>
        </div>

    </div>




@endsection
