<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/2.1.1/socket.io.slim.js"></script>
    <title>Document</title>
</head>
<body>

    <script>
        var socket = io.connect("http://localhost:3010");
        socket.on("new_order" , function (data) {
            console.log(data) ;
        })
    </script>

</body>
</html>