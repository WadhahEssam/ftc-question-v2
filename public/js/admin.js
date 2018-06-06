

$(document).ready(function(){

    // starting the website
    if(  $("#admin-menu").is(":visible") != true &&  $("#watch-game-menu").is(":visible") != true  && $("#add-question-menu").is(":visible") != true  && $("#results-menu").is(":visible") != true )
    {
        $("#admin-menu").fadeIn("slow");
    }


    // pressing one of the options

    $("#watch-game-button").click(function(){
        $("#admin-menu").fadeOut("fast" , function () {
            $("#watch-game-menu").fadeIn("fast");
        });
    });

    $("#add-questions-button").click(function(){
        $("#admin-menu").fadeOut("fast" , function () {
            $("#add-question-menu").fadeIn("fast");
        })
    });

    $("#results-button").click(function(){
        $("#admin-menu").fadeOut("fast" , function () {
            $("#results-menu").fadeIn("fast");
        })
    });

    $("#change-password-button").click(function(){
        $("#admin-menu").fadeOut("fast" , function () {
            $("#change-password-menu").fadeIn("fast");
        })
    });

    $("#show-questions-button").click(function(){
        $("#admin-menu").fadeOut("fast" , function () {
            $("#show-questions-menu").fadeIn("fast");
        })
    });


    // pressing the home button

    $("#add-question-home-button").click(function(){
        $("#add-question-menu").fadeOut("fast" , function () {
            $("#admin-menu").fadeIn("fast");
        });
    });

    $("#results-home-button").click(function(){
        $("#results-menu").fadeOut("fast" , function () {
            $("#admin-menu").fadeIn("fast");
        });
    });

    $("#watch-game-home-button").click(function(){
        $("#watch-game-menu").fadeOut("fast" , function () {
            $("#admin-menu").fadeIn("fast");
        });
    });

    $("#change-password-home-button").click(function(){
        $("#change-password-menu").fadeOut("fast" , function () {
            $("#admin-menu").fadeIn("fast");
        });
    });

    $("#show-questions-home-button").click(function(){
        $("#show-questions-menu").fadeOut("fast" , function () {
            $("#admin-menu").fadeIn("fast");
        });
    });



    // the log out button
    $("#exit-button").click(function(){
        $("#admin-menu").fadeOut("fast" , function () {
            window.location.href = "/";
        }) ;
    });

});


// will be called before the submitting of the form
function submitForm() {

    $('#change-password-menu').fadeOut("fast");
    $('#add-question-menu').fadeOut("fast");

    return true ;
}

