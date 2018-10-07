@extends('layouts.app')


@section('head')
    <script src="js/login.js"></script>
@endsection

@section('body')

    @if(isset($menu))
        {{--used to determine which menu i should open to the user--}}
        <p id="menu" style="display:none">{{$menu}}</p>
    @endif


    {{-----------------------------------------------------------------------------------------------}}

    <div class="container" id="login-menu" style="display:none">

        <table id='role-table'>
            <tr>
                <td><div class="main-button " id="admin-button" ><h1 class="role">مشرف</h1></div></td>
                <td><div class="main-button " id="student-button" ><h1 class="role">طالب</h1></div></td>
            </tr>
        </table>



        <h2>هذا التحدي برعاية</h2>
        <h3>نادي تقنية المستقبل</h3>

        <td> <img id="ftc-logo" height=170 style="margin-top:5px" src="images/ftc-logo.png" > </td>

    </div>

    {{------------------------------------------------------------------------------------------------}}

    <div  dir="rtl" class="container" id="student-login-menu" style="display:none" >
        <h1> شروط المسابقة :</h1>
        <h3>1 - أدخل بياناتك بشكل صحيح</h3>
        <h3>2 - لديك عشرة اسئلة لتجيب عنها </h3>
        <h3>3 - سرعتك في الاجابة يمنحك نقاط اعلى </h3>
        <h3>4 - يحق لك المشاركة لمرة واحدة فقط</h3>
        <br>

        <div id="student-login-home-button" class="home-button"><img width=30 src="images/home.png"></div>

        <h1>التسجيل </h1>
        {!! Form::open(['action'=>'MatchController@connectStudent' , 'method' => 'post' , 'id'=>'register-student-form' , 'style'=>'margin:5px 0px;' , 'onsubmit'=>'return submitForm()' ]) !!}
            {!!  Form::token() !!}
            <label style="margin-left:5px">اسم الطالب / الطالبة</label><input type="text" name="name" placeholder="مثال : محمد"/><br>
            <label style="margin-left:36px;position:relative;right:20px;">الرقم الجامعي</label><input type="text" size=6 name="id" placeholder="مثال : 435108270"/>
            <br>
            <input type="submit" value="ابدأ"/>
        {!! Form::close() !!}


    </div>

    {{------------------------------------------------------------------------------------------------}}

    <div dir="rtl" class="container" id="admin-login-menu" style="display:none">

        <h1>دخول للمشرفين</h1>
        <div id="admin-login-home-button" class="home-button"><img width=30 src="images/home.png"></div>
        <form id="register-admin-form" action="/loginAdmin" method="post" style="margin:5px 0px;" onsubmit="return submitForm()" >
            {!!  Form::token() !!}
            <label style="margin-left:36px;position:relative;right:20px;">كلمة المرور</label><input type="password" size=6 name="password"/>

            <br>
            <input type="submit" value="دخول"/>
        </form>
    </div>


    {{------------------------------------------------------------------------------------------------}}

    @include('message')

@endsection

