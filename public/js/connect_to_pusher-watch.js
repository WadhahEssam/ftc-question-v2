
Pusher.logToConsole = false;

var pusher = new Pusher('49a0b1bfdd7b1ae72b2c', {
    cluster: 'eu',
    encrypted: true
});

var channel = pusher.subscribe('game');

channel.bind('testEvent', function(data) {
});

// a variable to indicate wither this game is the first game to watch or not
var gameStarted = 0 ;


channel.bind('pusher:subscription_succeeded', function(data) {
    $('#connecting-menu').fadeOut('slow', function() {
        $('#waiting-menu').fadeIn('slow' , function() {
            $.get( "/checkMatch", function(data) {


                if (data.user_1_name == 'null') {

                } else {

                    if ( gameStarted ==  0 ) {
                        $('#user_1_name').html(data.user_1_name) ;
                        $('#user_1_points').html(data.user_1_points) ;
                        $('#loading-user-1').fadeOut('slow' , function () {
                            $('#user-1-div').fadeIn('slow') ;
                        });
                    } else if ( gameStarted == 1 ) {
                        $('#user-1-div').fadeOut('slow' , function () {
                            $('#user_1_name').html(data.user_1_name) ;
                            $('#user_1_points').html(data.user_1_points) ;
                            $('#user_1_name').removeClass('winner-name');
                            $('#user_1_name').removeClass('loser-name');
                            $('#user-1-div').fadeIn('slow') ;


                        });
                    }

                }

                if (data.user_2_name == 'null') {

                } else {

                    // if this game is the first game to watch
                    if ( gameStarted == 0 ) {
                        $('#user_2_name').html(data.user_2_name) ;
                        $('#user_2_points').html(data.user_2_points) ;
                        $('#loading-user-2').fadeOut('slow' , function () {
                            $('#user-2-div').fadeIn('slow') ;
                        });
                        $('#questions-counter').html("السؤال " + data.question_id) ;
                    } else if ( gameStarted == 1 ) {
                        $('#user_2_div').fadeOut('slow' , function () {
                            $('#user_2_name').html(data.user_2_name) ;
                            $('#user_2_points').html(data.user_2_points) ;
                            $('#user_2_name').removeClass('winner-name');
                            $('#user_2_name').removeClass('loser-name');
                            $('#user-2-div').fadeIn('slow') ;
                        });
                        $('#questions-counter').html("السؤال " + data.question_id) ;
                    }


                    gameStarted = 1 ;

                }


                $('#waiting-menu').fadeOut('slow' , function () {
                    $('#watch-game-menu').fadeIn('slow') ;
                });
            });
        });
    });
});




channel.bind('PlayersAreReadyToStart', function(data) {


    $('#ftc-logo').animateCss('bounce');

    $('#user_1_state').html("<img class='user_state' src='images\\waiting.gif' height='20' >");
    $('#user_2_state').html("<img class='user_state' src='images\\waiting.gif' height='20' >");

    if ( gameStarted ==  0 ) {
        $("#user_1_name").html(data.user1Name ) ;
        $('#user_1_points').html(data.game.user_1_points) ;
        $('#loading-user-1').fadeOut('slow' , function () {
            $('#user-1-div').fadeIn('slow') ;
        });
    } else if ( gameStarted == 1 ) {
        $('#user-1-div').fadeOut('slow' , function () {
            $("#user_1_name").html(data.user1Name ) ;
            $('#user_1_points').html(data.game.user_1_points) ;
            $('#user_1_name').removeClass('winner-name');
            $('#user_1_name').removeClass('loser-name');
            $('#user-1-div').fadeIn('slow') ;
        });
    };

    // if this game is the first game to watch
    if ( gameStarted == 0 ) {
        $("#user_2_name").html(data.user2Name ) ;
        $('#user_2_points').html(data.game.user_2_points) ;
        $('#loading-user-2').fadeOut('slow' , function () {
            $('#user-2-div').fadeIn('slow') ;
        });
        $('#questions-counter').html("السؤال " + data.game.question_id) ;
    } else if ( gameStarted == 1 ) {
        $('#user-2-div').fadeOut('slow' , function () {
            $("#user_2_name").html(data.user2Name ) ;
            $('#user_2_points').html(data.game.user_2_points) ;
            $('#user_2_name').removeClass('winner-name');
            $('#user_2_name').removeClass('loser-name');
            $('#user-2-div').fadeIn('slow') ;
        });
        $('#questions-counter').html("السؤال " + data.game.question_id) ;
    }


    gameStarted = 1 ;


    $('#questions-counter').html("السؤال " + data.game.question_id) ;



});


channel.bind('playerAnswer', function(data) {


    if ( $('#user_1_points').html() < data.game.user_1_points ) {
        $('#user_1_points').animateCss('swing');
    } else if ( $('#user_2_points').html() < data.game.user_2_points ) {
        $('#user_2_points').animateCss('swing');
    }
    $('#user_1_points').delay(200).html(data.game.user_1_points) ;
    $('#user_2_points').delay(200).html(data.game.user_2_points) ;



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



channel.bind('NextQuestion', function(data) {


    // to change the number of questions change the number 
    if ( data.question_id  == 21 ) {

    } else {

        var question_id = parseInt ( data.question_id ) ;


        $('#questions-counter').delay( 1000 ).fadeOut('fast' , function () {

            $('#user_1_state').html("<img class='user_state' src='images\\waiting.gif' height='20' >");
            $('#user_2_state').html("<img class='user_state' src='images\\waiting.gif' height='20' >");
            $('#questions-counter').html("السؤال " + question_id) ;
            $('#ftc-logo').animateCss('rubberBand');
            // to change the number of questions change the number 
            if( data.question_id != 21 ) {
                $('#questions-counter').fadeIn('fast') ;
            }

        });

    }

});


channel.bind('GameFinished', function(data) {


    if ( parseInt(data.game.user_1_points) > parseInt(data.game.user_2_points) ) {
        $('#questions-counter').html('الفائز هو ' + data.game.user_1_name ) ;
        $('#user_1_name').addClass('winner-name');
        $('#user_2_name').addClass('loser-name');
        $('#user_1_state').html("<img class='user_state' src='images\\gold-medal.png' height='20' >");
        $('#user_2_state').html("<img class='user_state' src='images\\skull.png' height='20' >");

    } else if ( parseInt(data.game.user_1_points) < parseInt(data.game.user_2_points) ) {
        $('#questions-counter').html('الفائز هو ' + data.game.user_2_name ) ;
        $('#user_2_name').addClass('winner-name');
        $('#user_1_name').addClass('loser-name');
        $('#user_2_state').html("<img class='user_state' src='images\\gold-medal.png' height='20' >");
        $('#user_1_state').html("<img class='user_state' src='images\\skull.png' height='20' >");


    } else {
        $('#questions-counter').html('النتيجة هي تعادل') ;
    }


    $('#last-game').animateCss('wobble');

    $('#last-game').load('/lastGameWinner');

    $.get('/getBestStudent' , function(data) {
        if ($('#best-result').html() == data ) {
            // do nothing
        } else {
            $('#best-result').animateCss('flash');
            $('#best-result').html(data);
        }
    });

});


channel.bind('PlayerForfeit', function(data) {
    $('#questions-counter').html('انسحب احد اللاعبين')
    $('#user-1-div').fadeOut('slow', function () {
        $('#loading-user-1').fadeIn('slow') ;
    });

    $('#user-2-div').fadeOut('slow', function () {
        $('#loading-user-2').fadeIn('slow') ;
    });

    gameStarted = 0 ;
});
