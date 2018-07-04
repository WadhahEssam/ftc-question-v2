<!doctype html>

<html lang="ar">

<head>
    <title> تحدي الند </title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <link rel="stylesheet" type="text/css" href="css/style.css" >
    <script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.2.1.min.js"></script>
    {{--<script src="https://js.pusher.com/4.1/pusher.min.js"></script>--}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/2.1.1/socket.io.dev.js"></script>
    <link rel="stylesheet" type="text/css" href="css/animate.css" >
    {{--todo : the shortcut icon must be changed--}}
    <link rel="shortcut icon"  href="images/chlogo.png">
    <link href="https://fonts.googleapis.com/css?family=Cairo" rel="stylesheet">
    <script src="js/script.js"></script>

    @yield('head')
</head>

<body>
    @yield('body')
</body>

</html>