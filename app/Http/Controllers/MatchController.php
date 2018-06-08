<?php

namespace App\Http\Controllers;

use App\Events\Player2Ready;
use App\Question;
use App\SelectedQuestion;
use Illuminate\Http\Request;
use App\RunningGame ;

class MatchController extends Controller
{

    public function resetMatch () {
        $game = RunningGame::find(1) ;
        $game->user_1_ready = 0 ;
        $game->user_2_ready = 0 ;
        $game->user_1_name = 'null' ;
        $game->user_2_name = 'null' ;
        $game->user_1_points = 0 ;
        $game->user_2_points = 0 ;
        $game->save() ;

        return 'the match has been reset ' ;
    }

    public function registerStudent(Request $request) {

        $game = RunningGame::find(1) ;

        if ( $game->user_1_ready == 0 ) {

            $game->user_1_ready = 1 ;
            $game->user_1_name = $request->name ;
            $game->save() ;

            session(['name'=>$request->name , 'id'=>$request->id]);

            $this->selectQuestionsForNextRound() ;

            return view('match' , ['menu'=>'waiting']) ;

        } else if ( $game->user_2_ready == 0 ) {

            $game->user_2_ready = 1 ;
            $game->user_2_name = $request->name ;
            $game->save() ;

            session(['name'=>$request->name , 'id'=>$request->id]);

            event(new Player2Ready("Player2Ready") ) ;
//            return 'event is sent' ;
            return view('match' , ['menu'=>'ready']);

        } else {
            //todo:didn't test this yet
            return view('/main' , ['message'=>'معليش غير مصمم لأكثر من مباراة']);
        }

    }

    public function getSelectedQuestions() {
        $selectedQuestions = SelectedQuestion::all() ;
        $questions = array () ;

        foreach($selectedQuestions as $selectedQuestion){
            array_push( $questions ,  Question::find($selectedQuestion->id) ) ;
        }
        return $questions ;
    }


    private function selectQuestionsForNextRound () {

        $questions = Question::select('id')->get() ;

        $questionsId = array () ;

        foreach ($questions as $question ) {
            array_push($questionsId , $question->id ) ;
        }

        $selectedQuestionsId = array_random($questionsId , 15) ;

        shuffle($selectedQuestionsId) ;

        $selectedQuestions = SelectedQuestion::all() ;

        for ( $i = 0 ; $i < 15 ; $i++ ) {
            $selectedQuestions[$i]->question_id = $selectedQuestionsId[$i] ;
            $selectedQuestions[$i]->save() ;
        }

        return $selectedQuestions ;

    }

}
