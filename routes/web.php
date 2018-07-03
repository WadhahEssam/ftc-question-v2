<?php

/*
|--------------------------------------------------------------------------
| Main
|--------------------------------------------------------------------------
*/

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('testSocket' , function () {
    return view('testSocket') ;
});

Route::get('testSocketSend' , function () {
    return view('testSocketSend') ;
});

Route::get('test' , 'Controller@test' ) ;

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/', function () {
    return view('main' , ['menu'=>'main']);
});

// when a third person is trying to enter the game while it is lunching
Route::get('/notAllowed' ,'Controller@notAllowed') ;

Route::post('/loginAdmin' , 'Controller@loginAdmin') ;

Route::get('/admin' , 'Controller@showAdminPage' )->name('admin') ;

Route::post('/changeAdminPassword' , 'Controller@changeAdminPassword') ;

Route::get('/goToNewChallenge' , 'Controller@goToNewChallenge') ;


/*
|--------------------------------------------------------------------------
| Questions
|--------------------------------------------------------------------------
*/

Route::post('/addQuestion' , 'QuestionsController@addQuestion') ;

Route::get('/questions' , 'QuestionsController@getQuestions');

Route::delete('/deleteQuestion' , 'QuestionsController@deleteQuestion') ;

/*
|--------------------------------------------------------------------------
| Results
|--------------------------------------------------------------------------
*/

Route::get('/results' , 'ResultsController@getResults') ;



/*
|--------------------------------------------------------------------------
| Match
|--------------------------------------------------------------------------
*/

Route::post('/connectStudent' , 'MatchController@connectStudent') ;

Route::get('/registerStudent' , 'MatchController@registerStudent') ;

//todo: this should be deleted
Route::get('/resetMatch' , 'MatchController@resetMatch') ;

Route::get('/selectQuestions' , 'MatchController@selectQuestionsForNextRound') ;

Route::get('/selectedQuestions' , 'MatchController@getSelectedQuestions') ;

Route::get('/studentReadyToStart' , 'MatchController@studentReadyToStart') ;

Route::get('/playerAnswer/{questionId}/{answer}/{timer}' , 'MatchController@playerAnswer') ;

Route::get('/challengeFinished' , 'MatchController@challengeFinished') ;

Route::get('/forfeit' , 'MatchController@forfeit') ;

/*
|--------------------------------------------------------------------------
| Match
|--------------------------------------------------------------------------
*/

Route::get('/watchMatch' , 'WatchMatchController@watchMatch') ;

Route::get('/checkMatch' , 'WatchMatchController@checkMatch') ;

Route::get('/lastGameWinner' , 'WatchMatchController@getLastGameWinner') ;

Route::get('/getBestStudent' , 'WatchMatchController@getBestStudent') ;