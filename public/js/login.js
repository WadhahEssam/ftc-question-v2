

$(document).ready(function(){

    // starting the website

    if(  $("#login-menu").is(":visible") != true &&  $("#admin-login-menu").is(":visible") != true  && $("#student-login-menu").is(":visible") != true )
    {
        $("#login-menu").slideDown("slow" , function () {
            $("#student-button").animate( { opacity : 1  } , 500 ) ;
            $("#admin-button").animate( { opacity : 1  } , 500 ) ;
        });
    } else {
        $("#student-button").animate( { opacity : 1  } , 500 ) ;
        $("#admin-button").animate( { opacity : 1  } , 500 ) ;
    }

    // pressing one of the options

    $("#student-button").click(function(){
        $("#login-menu").fadeOut("fast" , function () {
            $("#student-login-menu").fadeIn("fast");
            $('#message').fadeOut('fast');
        });
    });

    $("#admin-button").click(function(){
        $("#login-menu").fadeOut("fast" , function () {
            $("#admin-login-menu").fadeIn("fast");
            $('#message').fadeOut('fast');
        })
    });

    // pressing the home button

    $("#admin-login-home-button").click(function(){
        $("#admin-login-menu").fadeOut("fast" , function () {
            $("#login-menu").fadeIn("fast");
        });
    });

    $("#student-login-home-button").click(function(){
        $("#student-login-menu").fadeOut("fast" , function () {
            $("#login-menu").fadeIn("fast");
        });
    });

});

// will be called before the submitting of the form
function submitForm() {

    $('#admin-login-menu').fadeOut("fast");
    $('#student-login-menu').fadeOut("fast");

    return true ;
}

