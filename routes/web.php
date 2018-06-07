<?php

/*
|--------------------------------------------------------------------------
| Main
|--------------------------------------------------------------------------
*/

//todo : remember to delete this
Route::get('test' , 'Controller@test' ) ;

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/', function () {
    return view('main');
});

Route::post('/loginAdmin' , 'Controller@loginAdmin') ;

// todo : this should be removed after production
//Route::get('/testAdmin' , function(){
//    return view('admin') ;
//});


Route::get('/admin' , 'Controller@showAdminPage' )->name('admin') ;

Route::post('/changeAdminPassword' , 'Controller@changeAdminPassword') ;


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






