
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
        // if it is allow to move the counter
        if( stopCounter == 0 ) {
            $("#timer-clock").html( $("#timer-clock").html() - 1 );
        }

        if ( $("#timer-clock").html() <= 0 ) {
            $("#timer-clock").html(0) ;
            optionPressed(0 , 5) ;
        }
    }, 1000);

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
    console.log("data : " + data )  ;
    $.get( "/registerStudent", function(user) {
        console.log("user : " + user) ;
        if ( user == 1 ) {
            console.log('you are the user number one') ;
            $('#connecting-menu').fadeOut('slow' , function () {
                $("#waiting-menu").fadeIn("slow");
                $('#questions-container').load('/selectedQuestions' , function () {
                    $.get("/studentReadyToStart");
                }) ;
            });
        } else if ( user == 2 ) {
            console.log('you are the user number two');
            $('#connecting-menu').fadeOut('slow', function () {
                $("#ready-menu").fadeIn("slow");
                $('#questions-container').load('/selectedQuestions', function () {
                    $.get("/studentReadyToStart");
                });
            });
        }
    } );
});





channel.bind('NextQuestion', function(data) {

    if ( data.question_id  == 11 ) {
        $.get('/challengeFinished');
    }
    // i should sleep for one second and half so the players can see what the other choosed
    var question_id = parseInt ( data.question_id ) ;

    // don't change the next line from its place
    playerSelectedAnswer = 0;

    // sleep(2000);

    $('#question-container-' + ( question_id - 1 ) ).delay( 1000 ).slideUp('fast' , function() {
        $('#question-container-' + ( question_id ) ).slideDown('fast' , function () {
            $("#timer-clock").html(15) ;
            if( data.question_id != 11 ) {
                stopCounter = 0 ; // continue counting
            }
        }) ;

        $('#user_1_state').html("<img class='user_state' src='images\\waiting.gif' height='20' >");
        $('#user_2_state').html("<img class='user_state' src='images\\waiting.gif' height='20' >");
        // so player can choose from the new question
    });
});


function sleep(miliseconds) {
    var currentTime = new Date().getTime();
    while (currentTime + miliseconds >= new Date().getTime()) {
    }
}
