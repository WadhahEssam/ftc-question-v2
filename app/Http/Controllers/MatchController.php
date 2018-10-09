<?php

namespace App\Http\Controllers;

use App\Events\GameEvent;
use App\Events\GameFinished;
use App\Events\NextQuesiton;
use App\Events\Player2Ready;
use App\Events\PlayerForfeit;
use App\Events\PlayersAreReadyToStart ;
use App\Question;
use App\Result;
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
        $game->user_1_id = ' ' ;
        $game->user_2_id = ' ' ;
        $game->user_1_points = 0 ;
        $game->user_2_points = 0 ;
        $game->user_1_answer = 0 ;
        $game->user_2_answer = 0 ;
        $game->question_id = 1 ;
        $game->save() ;

        return 'the match has been reset ' ;
    }


    public function connectStudent (Request $request) {

        if ( isset($request->name) && isset($request->id) ){

            if ( strlen($request->id) == 9 ) {
                $results = Result::all() ;

                foreach ( $results as $result ) {
                    if (  ( $result->first_student_id == $request->id ) || ( $result->second_student_id == $request->id ) ) {
                        return view('main' , ['message'=>'لا يمكن المشاركة لأكثر من مرة' , 'menu'=>'student-login']) ;
                    }
                }

                session(['name'=>$request->name , 'id'=>$request->id]);
                return view('match' , ['menu'=>'connecting']);
            } else {
                return view('main' , ['message'=>'خطأ في الرقم الجامعي' , 'menu'=>'student-login']) ;
            }

        } else {
            return view('main' , ['message'=>'ادخل جميع الحقول' , 'menu'=>'student-login']) ;
        }

    }

    public function registerStudent() {

        $game = RunningGame::find(1) ;

        if ( $game->user_1_ready == 0 || $game->user_1_ready == 111 ) {
            $this->resetMatch() ;
            $game->user_1_ready = 1 ;
            $game->user_1_name = session()->get('name') ;
            $game->user_1_id = session()->get('id') ;
            $game->save() ;

            session(['player_number'=>'1']);

            $this->selectQuestionsForNextRound() ;

            return '1' ;

        } else if ( $game->user_2_ready == 0 ) {

            $game->user_2_ready = 2 ;
            $game->user_2_name = session()->get('name') ;
            $game->user_2_id = session()->get('id') ;
            $game->save() ;

            session(['player_number'=>'2']);

            event(new Player2Ready("Player2Ready") ) ;

            return '2';

        } else {
            //todo:didn't test this yet
            return '3' ;
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

    /**
     * @return SelectedQuestion[]|\Illuminate\Database\Eloquent\Collection
     */
    private function selectQuestionsForNextRound () {

        $questions = Question::select('id')->get() ;

        $questionsId = array () ;

        foreach ($questions as $question ) {
            array_push($questionsId , $question->id ) ;
        }

        $selectedQuestionsId = array_random($questionsId , 20) ;

        shuffle($selectedQuestionsId) ;

        $selectedQuestions = SelectedQuestion::all() ;

        for ( $i = 0 ; $i < 20 ; $i++ ) {
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
            // giving only the first name of the players
            $user1Name = strtok($game->user_1_name , " ");
            $user2Name = strtok($game->user_2_name , " ");

            event(new PlayersAreReadyToStart($game , $user1Name , $user2Name ) ) ;

        }

    }

    // one of the most important methods

    /**
     * @param $questionId
     * @param $answer
     * @param $timerClock
     * @return string
     */
    public function playerAnswer ($questionId , $answer , $timerClock) {

        // the main variables that will be used in the method
        $question = Question::find($questionId) ;
        $game = RunningGame::find(1) ;
        $timerClock = intval($timerClock) ;

        ///////////////// Calculating the points ////////////////////////////
        // the maximum points that you can get from a question is 25
        $questionPoints = 10 ;
        $timerFactor = intval ($timerClock * ( 5 / 15 ) ) ;
        if ( isset($question) ) {
            $difficultyFactor = $question->dif * 3 ;
        } else {
            $difficultyFactor = 0 ;
        }


        $totalPoints = $questionPoints + $timerFactor + $difficultyFactor ;

        //////////////////////////////////////////////////////////////////////

        // the time finished for the player
        // todo: i should make sure that when the timer finishes and both players already answered that i don't count that as a loss
        if ( $questionId == 0 ) {
            if (session()->get('player_number') == 1 ) {
                $game->user_1_answer = 2  ;
                $game->save() ;
                event(new GameEvent($game));
            } else {
                $game->user_2_answer = 2  ;
                $game->save() ;
                event(new GameEvent($game));
            }
        } else {


            if ( $answer == $question->answer ) {
                if (session()->get('player_number') == 1 ) {
                    $game->user_1_answer = 1  ;
                    $game->user_1_points = $game->user_1_points + $totalPoints  ; // adding the points
                    $game->save() ;
                    event(new GameEvent($game));
                } else {
                    $game->user_2_answer = 1  ;
                    $game->user_2_points = $game->user_2_points + $totalPoints; // adding the points
                    $game->save() ;
                    event(new GameEvent($game));
                }
                $answer = 'correct';
            } else {
                if (session()->get('player_number') == 1 ) {
                    $game->user_1_answer = 2  ;
                    $game->save() ;
                    event(new GameEvent($game));
                } else {
                    $game->user_2_answer = 2  ;
                    $game->save() ;
                    event(new GameEvent($game));
                }
                $answer = 'wrong' ;
            }

        }

        if ( $game->user_1_answer != 0 && $game->user_2_answer != 0 ) {
            $game->user_1_answer = 0 ;
            $game->user_2_answer = 0 ;
            $game->question_id = $game->question_id + 1 ;
            $game->save() ;
            event(new NextQuesiton($game->question_id)) ;
        }

        return $answer ;
    }

    public function challengeFinished () {
        $result = new Result ;
        $game = RunningGame::find(1) ;

        if ( ! $this->isDublicate($result->first_student_id) ) {

            $result->first_student_name = $game->user_1_name ;
            $result->first_student_id = $game->user_1_id ;
            $result->first_student_points = $game->user_1_points ;

            $result->second_student_name = $game->user_2_name ;
            $result->second_student_id = $game->user_2_id ;
            $result->second_student_points = $game->user_2_points ;

            if ( intval($game->user_1_points) > intval($game->user_2_points)) {
                $result->winner = 1 ;
            } else if ( intval($game->user_1_points) < intval($game->user_2_points) ) {
                $result->winner = 2 ;
            } else {
                $result->winner = 3 ;
            }

            if ($result->first_student_name != "null" ) {
                $result->save()  ;

                // this should be fired before resetting the match
                event(new GameFinished($game)) ;

                $this->resetMatch() ;
            }

        }

        else {

        }

    }

    public function forfeit () {

        $game = RunningGame::find(1) ;

        if ( $game->user_1_ready == '111' ) {
            $game->user_2_ready = '222' ;

            $this->resetMatch() ;

            $message = "خصمك انسحب من التحدي" ;
            return view('main', ['message'=>$message , 'menu'=>'main'] ) ;
        } else  {
            $game->user_1_ready = '111' ;
            $game->save() ;

            event ( new PlayerForfeit() ) ;

            $message = "تم الانسحاب من التحدي" ;

            return view('main', ['message'=>$message , 'menu'=>'main'] ) ;
        }

    }

    private function isDublicate($first_student_id) {
        $lastResult = Result::all()->last();

        if ( isset($lastResult) ) {
            if ( $lastResult->first_student_id == $first_student_id ) {
                return true ;
            } else {
                return false ;
            }
        } else {
            return false ;
        }


    }

}
