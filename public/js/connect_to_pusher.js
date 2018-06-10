
// todo: Enable pusher logging - don't include this in production
Pusher.logToConsole = true;

var pusher = new Pusher('49a0b1bfdd7b1ae72b2c', {
    cluster: 'eu',
    encrypted: true
});

var channel = pusher.subscribe('game');

channel.bind('testEvent', function(data) {
});

channel.bind('Player_2_Ready', function(data) {
    $("#waiting-menu").fadeOut("slow" , function () {
        $("#ready-menu").fadeIn("slow");
        $('#questions-container').load('/selectedQuestions' , function () {
            $.get("/studentReadyToStart");
        }) ;
    });
});


channel.bind('PlayersAreReadyToStart', function(data) {
    $("#ready-menu").fadeOut("slow" , function () {
        $("#match-menu").fadeIn("slow");
    });

    console.log(data.game.user_2_name) ;

    $("#user_1_name").html(data.game.user_1_name ) ;
    $("#user_2_name").html(data.game.user_2_name ) ;

    window.setInterval(function(){
        $("#timer-clock").html( $("#timer-clock").html() - 1 );


        if ( $("#timer-clock").html() == 0 ) {
            console.log('timer is now zero') ;
        }
    }, 2000);

});

channel.bind('playerAnswer', function(data) {
    $('#user_1_points').html(data.game.user_1_points) ;
    $('#user_2_points').html(data.game.user_2_points) ;

    if(data.game.user_1_answer == 1 ) {
        $('#user_1_state').html("<img class='user_state' src='images\\true.png' height='20' >");
    } else if (data.game.user_1_answer == 2 )  {
        $('#user_1_state').html("<img class='user_state' src='images\\false.png' height='20' >");
    }

    if(data.game.user_2_answer == 1 ) {
        $('#user_2_state').html("<img class='user_state' src='images\\true.png' height='20' >");
    } else if (data.game.user_2_answer == 2 ) {
        $('#user_2_state').html("<img class='user_state' src='images\\false.png' height='20' >");
    }

});

channel.bind('pusher:subscription_succeeded', function(data) {
    $.get( "/registerStudent", function(data) {
        if ( data == 1 ) {
            console.log('you are the user number one') ;
            $('#connecting-menu').fadeOut('slow' , function () {
                $("#waiting-menu").fadeIn("slow");
            });
        } else if ( data == 2 ) {
            console.log('you are the user number two') ;
            $('#connecting-menu').fadeOut('slow' , function () {
                $("#ready-menu").fadeIn("slow");
                $('#questions-container').load('/selectedQuestions' , function () {
                    $.get("/studentReadyToStart");
                }) ;
            });
        }
    } );
});



