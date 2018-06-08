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
                <td class="running-match-stats-table-data"><h2>وضاح</h2><div id="points"><h3>108</h3></div><img style="margin-bottom: -5px;" src="images\waiting.gif" height="30" ></td>
                <td><img style="padding:0px 15px" src="images\vs.png" height="45"></td>
                <td class="running-match-stats-table-data"><h2>ريان</h2><div id="points"><h3>89</h3></div><img style="margin-bottom: -5px;" src="images\waiting.gif" height="30" ></td>
            </tr>

        </table>


        <div id="current-question-container">
            <div id="timer">
                <h1>3:44</h1>
                <h3 style="margin-top: -11px;">السؤال 2</h3>
            </div>
            <table id="current-question-table" >
                <tr>
                    <td colspan="4" id="question-table-data">
                        <h2 style="padding-bottom:13px">In whdfsfdsd fsadf  fds df asdf sadf sadf sadfas fwefsa dfse fers frs gi rg rdgfd gdfg rewgr gtch country the city aden is located</h2>
                        <img height="80" id="question-image" src="images\questionImageTest.jpg" >
                    </td>                </tr>
                <tr>
                    <td colspan="2" id="option-data-table-1" class="option-table-data"><h3>Test Option 1 </h3></td>
                    <td colspan="2" id="option-data-table-2" class="option-table-data"><h3>Test Option 2 </h3></td>
                </tr>
                <tr>                                                                
                    <td colspan="2" id="option-data-table-3" class="option-table-data"><h3>Test Option 3 </h3></td>
                    <td colspan="2" id="option-data-table-4" class="option-table-data"><h3>Test Option 4 </h3></td>
                </tr>
            </table>
        </div>

        <div id="forfeit-button" class="exit-button"><img width=30 src="images/exit.png"></img></div>


    </div>

    {{-----------------------------------------------------------------------------------------------}}


@endsection
