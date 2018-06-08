<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Question ;

class QuestionsController extends Controller
{
    public function addQuestion ( Request $request ) {

        if ( $request->question == '' || $request->option1 == '' || $request->option2 == '' || $request->option3 == '' || $request->option4 == '') {
            $message = "املأ جميع الحقول" ;
            $menu = "add_question" ;
            return view('/admin' , ['message'=>$message , 'menu'=>$menu]) ;
        }

        $path="" ;

        if ( $request->hasFile('image') ){
            $path = $request->file('image')->store('questions') ;
        }
        $question = new Question ;

        $question->question = $request->question ;
        $question->option1 = $request->option1 ;
        $question->option2 = $request->option2 ;
        $question->option3 = $request->option3 ;
        $question->option4 = $request->option4 ;
        $question->answer  = $request->answer  ;
        $question->dif     = $request->dif     ;
        $question->imagePath = $path ;

        $question->save() ;

        //todo : i should have a solution for this problem > i have to redirect the user to the same addQuestion Page
        $message = "تم اضافة السؤال" ;
        $menu = "add_question" ;
        return view('/admin' , ['message'=>$message , 'menu'=>$menu]) ;
    }

    public function getQuestions() {
        $questions = Question::all() ;
        return view('questions' , ['questions'=>$questions ]) ;
    }

    //todo : i have to delete the image in the file if there is an image
    public function deleteQuestion (Request $request) {
        if ( session()->has('admin') ) {
            $question = Question::find($request->id);

            $question->delete() ;

            $message = "تم حذف السؤال" ;
            $menu = "show_questions" ;
            return view('/admin' , ['message'=>$message , 'menu'=>$menu]) ;
        } else {
            $message = "مسوي فيها الهاكر" ;
            return view('/' , ['message'=>$message]) ;
        }

    }
}
