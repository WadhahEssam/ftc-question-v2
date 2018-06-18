<?php

namespace App\Http\Controllers;

use App\Result;
use App\RunningGame;
use Illuminate\Http\Request;

class WatchMatchController extends Controller
{

    public function watchMatch () {
        return view('watch_match') ;
    }

    public function checkMatch () {
        $game = RunningGame::find(1) ;
        return $game ;
    }

    public function getLastGameWinner() {
        $lastGame = Result::all()->last() ;
        if ( $lastGame->winner == 1 ) {
            return "فوز " . $lastGame->first_student_name ;
        } else if  ( $lastGame->winner == 2 ) {
            return "فوز " . $lastGame->second_student_name;
        } else {
            return "تعادل بين ". $lastGame->first_student_name . " و بين " . $lastGame->second_student_name ;
        }
    }

    public function getBestStudent() {
        $results = Result::all() ;


        $bestStudentName = $results[0]->first_student_name ;
        $bestStudentPoints = $results[0]->first_student_points ;

        foreach( $results as $result ) {

            if ($result->first_student_points > $bestStudentPoints ) {
                $bestStudentName = $result->first_student_name ;
                $bestStudentPoints = $result->first_student_points ;
            }

            if ($result->second_student_points > $bestStudentPoints ) {
                $bestStudentName = $result->second_student_name ;
                $bestStudentPoints = $result->second_student_points ;
            }
        }


        return $bestStudentName . "<br>" . $bestStudentPoints ;
    }


}
