

$(document).ready(function(){

    // if(  $("#match-menu").is(":visible") != true &&  $("#waiting-menu").is(":visible") != true  )
    // {
    //     console.log('hello');
    //     $("#waiting-menu").fadeIn("slow");
    // }

    if ( document.getElementById("menu").innerHTML == "connecting") {
        $("#connecting-menu").fadeIn("slow");
    }

    if ( document.getElementById("menu").innerHTML == "waiting") {
        $("#waiting-menu").fadeIn("slow");
    }

    if ( document.getElementById("menu").innerHTML == "ready" ) {

    }

    $('.option' ).click(function(){
        console.log('hi');
    })


    $('#ready-menu' ).click(function(){
        console.log('hi');
    })

});

var playerSelectedAnswer = 0;


// one of the most important methods
function optionPressed( questionId , option ) {

    if ( playerSelectedAnswer == 0 ) {

        playerSelectedAnswer = 1 ;

        $('#option-'+questionId+'-'+option).html("<img src='images\\waiting.gif' height='30' >");

        console.log('hi') ;

        $.get( "playerAnswer/"+questionId+"/"+option , function( data ) {
            if (data == "current") {
                $('#option-'+questionId+'-'+option).html("<img src='images\\true.png' height='30' >");
            } else if ( data == "wrong" ) {
                $('#option-'+questionId+'-'+option).html("<img src='images\\false.png' height='30' >");
            }
        });

    }


}







