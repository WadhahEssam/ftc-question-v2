

$(document).ready(function(){

    // if(  $("#match-menu").is(":visible") != true &&  $("#waiting-menu").is(":visible") != true  )
    // {
    //     console.log('hello');
    //     $("#waiting-menu").fadeIn("slow");
    // }


    if ( document.getElementById("menu").innerHTML == "waiting") {
        $("#waiting-menu").fadeIn("slow");
    }

    if ( document.getElementById("menu").innerHTML == "ready" ) {
        $("#ready-menu").fadeIn("slow");
    }



});



