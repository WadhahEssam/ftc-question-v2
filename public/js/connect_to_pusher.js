
// todo: Enable pusher logging - don't include this in production
Pusher.logToConsole = true;

var pusher = new Pusher('49a0b1bfdd7b1ae72b2c', {
    cluster: 'eu',
    encrypted: true
});

var channel = pusher.subscribe('game');

channel.bind('testEvent', function(data) {
    // alert(data.);
});
channel.bind('Player_2_Ready', function(data) {
    $("#waiting-menu").fadeOut("slow" , function () {
        $("#ready-menu").fadeIn("slow");
    });
});
