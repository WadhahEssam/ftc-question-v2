<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Result ;

class ResultsController extends Controller
{
    public function getResults() {
        $results = Result::all() ;
        return view('results' , ['results'=>$results]) ;
    }
}
