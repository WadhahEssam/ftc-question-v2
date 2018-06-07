// script for all the pages

$(document).ready(function() {


    // starting the website

    if ($("#message").is(":visible") != true) {
        $('#message').fadeIn('slow' , function () {
            setTimeout( messageOut , 3000 );
        });
    }
    function messageOut() {
        $('#message').fadeOut('slow');
    }

}) ;