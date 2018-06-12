@extends('layouts\app')

@section('head')
    {{--todo : the place of this file should be changed because now when it is here a connection is established every time i open the main page --}}
    <script src="js/connect_to_pusher.js"></script>
    <script src="js/match.js"></script>
@endsection

@section('body')

    {{--used to determine which menu i should open to the user--}}
    <p id="menu" style="display:none">{{$menu}}</p>

    {{-----------------------------------------------------------------------------------------------}}

    <div class="container" id="connecting-menu" style="display:none" >

        <br>
        <img height='100' src="images\loading.gif">
        <h1>جاري التوصيل</h1>

    </div>

    {{-----------------------------------------------------------------------------------------------}}

    <div class="container" id="waiting-menu" style="display:none" >

        <br>
        <img height='100' src="images\loading.gif">
        <h1>في انتظار دخول خصمك</h1>

    </div>


    {{-----------------------------------------------------------------------------------------------}}

    <div class="container" id="ready-menu" style="display:none" >

        <br>
        <img height='100' src="images\downloading.gif">
        <h1>جاري تحميل الاسئلة</h1>

    </div>


    {{-----------------------------------------------------------------------------------------------}}

    <div class="container" id="match-menu" style="display:none" >

        <table id="running-match-stats-table" >

            <tr>
                <td class="running-match-stats-table-data" id="current-user-1"><h2 id="user_1_name">وضاح</h2><div id="points"><h3 id="user_1_points">0</h3></div><div id="user_1_state"><img style="margin-bottom: -5px;padding-top: 2px;" src="images\waiting.gif" height="30" ></div></td>
                <td><img style="padding:0px 15px" src="images\vs.png" height="45"></td>
                <td class="running-match-stats-table-data" id="current-user-2"><h2 id="user_2_name">ريان</h2><div id="points"><h3 id="user_2_points">0</h3></div><div id="user_2_state"><img style="margin-bottom: -5px;padding-top: 2px;" src="images\waiting.gif" height="30"> </div></td>
            </tr>

        </table>




        <div id="questions-container">

        </div>

        <div id="forfeit-button" class="exit-button"><img width=30 src="images/exit.png"></img></div>


    </div>

    {{-----------------------------------------------------------------------------------------------}}


@endsection
