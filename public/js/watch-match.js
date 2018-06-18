

$(document).ready(function(){

    $('#connecting-menu').fadeIn('slow');

    $('#watch-game-home-button').click( function () {
        $('#watch-game-menu').fadeOut('slow' , function () {
            window.location.href='/admin';
        }) ;
    });


    $('#last-game').load('/lastGameWinner');

    $('#best-result').load('/getBestStudent');

});


