@extends('layouts\app')



@section('head')
    <script src="js/admin.js"></script>
@endsection

@section('body')

    {{---------------------------------------------------------------------------------------------------------------------------------------------------}}


    <div dir="rtl" class="container" id="admin-menu" style="display:none" >

        <div id="exit-button" class="exit-button"><img width=30 src="images/exit.png"></img></div>

        <div class="main-button" id="watch-game-button" ><h2>مشاهدة التحدي الحالي</h2></div>
        <div class="main-button" id="add-questions-button" ><h2 >اضافة اسئلة</h2></div>
        <div class="main-button" id="show-questions-button" ><h2 >عرض الاسئلة</h2></div>
        <div class="main-button" id="results-button" ><h2 >النتائج</h2></div>
        <div class="main-button" id="change-password-button" ><h2 >تغيير كلمة المرور</h2></div>

    </div>

    {{---------------------------------------------------------------------------------------------------------------------------------------------------}}

    <div dir="rtl" class="container" id="watch-game-menu" style="display:none" >
        <div id="watch-game-home-button" class="home-button"><img width=30 src="images/home.png"></img></div>


    </div>

    {{---------------------------------------------------------------------------------------------------------------------------------------------------}}

    <div dir="rtl" class="container" id="add-question-menu" @if( isset($menu) ) @if ( $menu != 'add_question') style="display:none"  @endif @else style="display:none" @endif >

        <div id="add-question-home-button" class="home-button"><img width=30 src="images/home.png"></img></div>

        <h1>اضافة سؤال </h1>
        <br>


        {!! Form::open(['method'=>'post' , 'url'=>'/addQuestion' , 'files'=>true , 'style'=>'margin:5px 0px;']) !!}
            <textarea name="question"></textarea> <br>
            <label style="margin-left:5px">الخيار 1</label><input type="text" name="option1"/><br>
            <label style="margin-left:5px">الخيار 2</label><input type="text" name="option2"/><br>
            <label style="margin-left:5px">الخيار 3</label><input type="text" name="option3"/><br>
            <label style="margin-left:5px">الخيار 4</label><input type="text" name="option4"/><br>
            <label id="browse-label" for="uploadfile" >رفع صورة </label><input type="file" value="file" name="image" id="uploadfile" accept="image/*"> </br>

            <div id="options" style="margin-top:15px">
                <label style="margin-left:5px;">الاجابة :</label>
                <select name="answer">
                    <option>1</option>
                    <option>2</option>
                    <option>3</option>
                    <option>4</option>
                </select>

                <label style="margin-left:5px;margin-right:10px">صعوبة السؤال :</label>
                <select name="dif">
                    <option>1</option>
                    <option>2</option>
                    <option>3</option>
                </select>
            </div>

            <br>
            <input type="submit" value="اضافة" style="margin-top:0px;"/>
        {!! Form::close() !!}

    </div>

    {{---------------------------------------------------------------------------------------------------------------------------------------------------}}

    <div dir="rtl" class="container" id="show-questions-menu" @if( isset($menu) ) @if ( $menu != 'show_questions') style="display:none"  @endif @else style="display:none" @endif >
        <div id="show-questions-home-button" class="home-button"><img width=30 src="images/home.png"></img></div>
        <div id="show-questions-refresh-button" class="refresh-button"><img width=30 src="images/refresh.png"></img></div>

        <div id="questions-container">
            <p>لا توجد اسئلة</p>
        </div>

    </div>

    {{---------------------------------------------------------------------------------------------------------------------------------------------------}}

    <div dir="rtl" class="container" id="results-menu"  style="display:none" >
        <div id="results-home-button" class="home-button"><img width=30 src="images/home.png"></img></div>
        <div id="refresh-button" class="refresh-button"><img width=30 src="images/refresh.png"></img></div>
        <div id="results-container">

        </div>

    </div>

    {{---------------------------------------------------------------------------------------------------------------------------------------------------}}

    <div dir="rtl" class="container" id="change-password-menu" style="display:none" >
        <div id="change-password-home-button" class="home-button"><img width=30 src="images/home.png"></img></div>

        <h1>تغيير كلمة المرور </h1>
        <form id="register-student-form" action="/changeAdminPassword" method="post" style="margin:5px 0px;" onsubmit="return submitForm()" >
            {!!  Form::token() !!}
            <label style="margin-left: 57px;position: relative;right: 44px;">كلمة المرور الحالية</label><input type="password" name="oldPassword" size=6 name="id"/>
            <br>
            <label style="margin-left: 52px;position: relative;right: 39px;;">كلمة المرور الجديدة</label><input type="password" name="newPassword1" size=6 name="id"/>
            <br>
            <label style="margin-left:30px;position:relative;right:17px;">كرر ادخال الكلمة الجديدة</label><input type="password" name="newPassword2" size=6 name="id"/>
            <br>
            <input type="submit" value="تغيير"/>
        </form>

    </div>

    {{---------------------------------------------------------------------------------------------------------------------------------------------------}}

    @include('message')

@endsection

