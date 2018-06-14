
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

    if ( playerNumber == 1 ) {
        $('#user_1_name').addClass('current-user');
    } else if ( playerNumber == 2 ) {
        $('#user_2_name').addClass('current-user');
    }

    $("#user_1_name").html(data.user1Name ) ;
    $("#user_2_name").html(data.user2Name ) ;

    window.setInterval(function(){
        // if it is allow to move the counter
        if( stopCounter == 0 ) {
            $("#timer-clock").html( $("#timer-clock").html() - 1 );
        }

        if ( $("#timer-clock").html() <= 0 ) {
            $("#timer-clock").html(0) ;
            console.log('timesToForfeit = ' + timesToForfeit ) ;
            if ( timesToForfeit == 0 ) {
                optionPressed(0 , 5) ;
                timesToForfeit = 1  ;
            }
        }
    }, 1000);

});

channel.bind('playerAnswer', function(data) {
    console.log('playerAnswerEvent') ;

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
            playerNumber = 1 ;
        } else if ( user == 2 ) {
            console.log('you are the user number two');
            $('#connecting-menu').fadeOut('slow', function () {
                $("#ready-menu").fadeIn("slow");
                $('#questions-container').load('/selectedQuestions', function () {
                    $.get("/studentReadyToStart");
                });
            });
            playerNumber = 2;
        } else if ( user == 3 ) {
            window.location.href='/notAllowed';
        }

    } );
});





channel.bind('NextQuestion', function(data) {
    console.log('nextQuestionEvent') ;

    if ( data.question_id  == 11 ) {
        $.get('/challengeFinished');
    }

    var question_id = parseInt ( data.question_id ) ;

    // don't change the next line from its place


    // to raise the counter of the questions by one

    $('#question-container-' + ( question_id - 1 ) ).delay( 1000 ).slideUp('fast' , function() {
        // don't change the next line from its place
        playerSelectedAnswer = 0;
        $('#question-container-' + ( question_id ) ).slideDown('fast' , function () {


        }) ;

        $("#timer-clock").html(15) ;
        timesToForfeit =  0 ;
        if( data.question_id != 11 ) {
            stopCounter = 0 ; // continue counting
        }

        $('#questions-counter').html('السؤال ' + ++questions_counter);

        if (data.question_id != 11 ) {
            $('#user_1_state').html("<img class='user_state' src='images\\waiting.gif' height='20' >");
            $('#user_2_state').html("<img class='user_state' src='images\\waiting.gif' height='20' >");
            // so player can choose from the new question
        }

    });

    $('#timer').delay( 1000 ).slideUp('fast' , function () {
        if( data.question_id != 11 ) {
            $('#timer').slideDown('fast') ;
        }
    });


});



channel.bind('GameFinished', function(data) {
    if ( parseInt(data.game.user_1_points) > parseInt(data.game.user_2_points) ) {
        $('#winner').html('الفائز هو <br>' + data.game.user_1_name ) ;
        $('#user_1_name').addClass('winner-name');
        $('#user_2_name').addClass('loser-name');
        $('#user_1_state').html("<img class='user_state' src='images\\gold-medal.png' height='20' >");
        $('#user_2_state').html("<img class='user_state' src='images\\skull.png' height='20' >");

    } else if ( parseInt(data.game.user_1_points) < parseInt(data.game.user_2_points) ) {
        $('#winner').html('الفائز هو <br>' + data.game.user_2_name ) ;
        $('#user_2_name').addClass('winner-name');
        $('#user_1_name').addClass('loser-name');
        $('#user_2_state').html("<img class='user_state' src='images\\gold-medal.png' height='20' >");
        $('#user_1_state').html("<img class='user_state' src='images\\skull.png' height='20' >");


    } else {
        $('#winner').html('النتيجة هي تعادل') ;
    }
});

channel.bind('PlayerForfeit', function(data) {
    $('#match-menu').fadeOut('fast' , function () {
        window.location.href='/forfeit';
    }) ;
});
