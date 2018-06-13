

$(document).ready(function(){

    if ( document.getElementById("menu").innerHTML == "connecting") {
        $("#connecting-menu").fadeIn("slow");
    }

    if ( document.getElementById("menu").innerHTML == "waiting") {
        $("#waiting-menu").fadeIn("slow");
    }

});


let playerSelectedAnswer = 0;
let stopCounter = 0 ;
let questions_counter = 1 ;
let timesToForfeit = 0 ;
let playerNumber = 0 ; // it will be determined by the connecting event

// one of the most important methods
function optionPressed( questionId , option ) {

    console.log('optionPressed()') ;

    if ( playerSelectedAnswer == 0 ) {

        playerSelectedAnswer = 1 ;
        stopCounter = 1 ;

        if ( option == 5 ) {
            $.get( "playerAnswer/"+questionId+"/"+option );
        } else {
            $('#option-'+questionId+'-'+option).html("<img src='images\\waiting3.gif' height='35' >");

            $.get( "playerAnswer/"+questionId+"/"+option , function( data ) {
                if (data == "correct") {
                    $('#option-'+questionId+'-'+option).html("<img src='images\\true.png' height='30' >");
                } else if ( data == "wrong" ) {
                    $('#option-'+questionId+'-'+option).html("<img src='images\\false.png' height='30' >");
                }
            });
        }

    }

}






