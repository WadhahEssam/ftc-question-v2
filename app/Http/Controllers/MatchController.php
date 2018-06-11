<?php

namespace App\Http\Controllers;

use App\Events\GameEvent;
use App\Events\NextQuesiton;
use App\Events\Player2Ready;
use App\Events\PlayersAreReadyToStart ;
use App\Question;
use App\SelectedQuestion;
use Illuminate\Http\Request;
use App\RunningGame ;
use Whoops\Run;


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
        $game->user_1_answer = 0 ;
        $game->user_2_answer = 0 ;
        $game->question_id = 1 ;
        $game->save() ;

        return 'the match has been reset ' ;
    }

    public function connectStudent (Request $request) {
        session(['name'=>$request->name , 'id'=>$request->id]);
        return view('match' , ['menu'=>'connecting']);
    }

    public function registerStudent() {

        $game = RunningGame::find(1) ;

        if ( $game->user_1_ready == 0 ) {

            $game->user_1_ready = 1 ;
            $game->user_1_name = session()->get('name') ;
            $game->save() ;

            session(['player_number'=>'1']);

            $this->selectQuestionsForNextRound() ;

            return '1' ;

        } else if ( $game->user_2_ready == 0 ) {

            $game->user_2_ready = 2 ;
            $game->user_2_name = session()->get('name') ;
            $game->save() ;

            session(['player_number'=>'2']);

            event(new Player2Ready("Player2Ready") ) ;

            return '2';

        } else {
            //todo:didn't test this yet
            return view('/main' , ['message'=>'معليش غير مصمم لأكثر من مباراة']);
        }

    }

    public function getSelectedQuestions() {
        $selectedQuestions = SelectedQuestion::all() ;
        $questions = array () ;

        foreach($selectedQuestions as $selectedQuestion){
            array_push( $questions ,  Question::find($selectedQuestion->question_id) ) ;
        }

        return view('selectedQuestions' , ['selectedQuestions'=>$questions ]) ;
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

    public function studentReadyToStart() {
        $game = RunningGame::find(1) ;

        if ( session()->get('player_number') == 1 ) {
            $game->user_1_ready = 11 ;
            $game->save() ;
        }
        else if ( session()->get('player_number') == 2) {
            $game->user_2_ready = 22 ;
            $game->save() ;
        }

        if ( $game->user_2_ready == 22 && $game->user_1_ready == 11 ) {
            event(new PlayersAreReadyToStart($game) ) ;
        }

    }

    // one of the most important methods
    public function playerAnswer ( $questionId , $answer) {

        // the main variables that will be used in the method
        $question = Question::find($questionId) ;
        $game = RunningGame::find(1) ;

        // the time finished for the player
        // todo: i should make sure that when the timer finishes and both players already answered that i don't count that as a loss
        if ( $questionId == 0 ) {
            if (session()->get('player_number') == 1 ) {
                $game->user_1_answer = 2  ;
                $game->user_1_points = $game->user_1_points - 5 ; // adding the points
                $game->save() ;
                event(new GameEvent($game));
            } else {
                $game->user_2_answer = 2  ;
                $game->user_2_points = $game->user_2_points - 5 ; // adding the points
                $game->save() ;
                event(new GameEvent($game));
            }
        } else {


            if ( $answer == $question->answer ) {
                if (session()->get('player_number') == 1 ) {
                    $game->user_1_answer = 1  ;
                    $game->user_1_points = $game->user_1_points + 10 ; // adding the points
                    $game->save() ;
                    event(new GameEvent($game));
                } else {
                    $game->user_2_answer = 1  ;
                    $game->user_2_points = $game->user_2_points + 10 ; // adding the points
                    $game->save() ;
                    event(new GameEvent($game));
                }
                echo 'current';
            } else {
                if (session()->get('player_number') == 1 ) {
                    $game->user_1_answer = 2  ;
                    $game->user_1_points = $game->user_1_points - 5 ; // adding the points
                    $game->save() ;
                    event(new GameEvent($game));
                } else {
                    $game->user_2_answer = 2  ;
                    $game->user_2_points = $game->user_2_points - 5 ; // adding the points
                    $game->save() ;
                    event(new GameEvent($game));
                }
                echo 'wrong' ;
            }

        }

        if ( $game->user_1_answer != 0 && $game->user_2_answer != 0 ) {
            $game->user_1_answer = 0 ;
            $game->user_2_answer = 0 ;
            $game->question_id = $game->question_id + 1 ;
            $game->save() ;
            event(new NextQuesiton($game->question_id)) ; // todo : where i stopped
        }



        return ;
    }



}
