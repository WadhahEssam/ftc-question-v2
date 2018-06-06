<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use App\Http\Requests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function loginAdmin ( Request $request ) {
        //reading the passwords file
        $myfile = fopen("password.mtv", "r") or die("Unable to open file!");
        $password = fread($myfile,filesize("password.mtv"));
        fclose($myfile);

        //checking if the password is the same
        if ($request->password == $password) {
            session('admin' , $request->password ) ;
            return redirect()->route('admin') ;
        } else {
            $message="The password is wrong" ;
            return view('/' , compact('message')) ;
        }
    }

}
