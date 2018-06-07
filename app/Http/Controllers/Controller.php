<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use App\Http\Requests ;
use App\Question ;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    //todo: remember to delete this
    public function test () {
        Question::find(41)->delete() ;
//        return view ('test' , ['me'=>$message]) ;
    }

    public function loginAdmin ( Request $request ) {
        //reading the passwords file
        $myfile = fopen("password.mtv", "r") or die("Unable to open file!");
        $password = fread($myfile,filesize("password.mtv"));
        fclose($myfile);

        //checking if the password is the same
        if ($request->password == $password) {
            session()->put('admin' , 'true' ) ;
            return redirect('/admin') ;
        } else {
            $message="كلمة المرور خاطئة" ;
            return view('main' )->with('message' , $message);
        }
    }

    public function changeAdminPassword ( Request $request ) {

        $myfile = fopen("password.mtv", "r") or die("Unable to open file!");
        $oldPassword = fread($myfile,filesize("password.mtv"));
        fclose($myfile);

//        return ' ' . $oldPassword . ' ' . $request->newPassword1 . ' '  . $request->oldPassword ;
        if ( $request->newPassword1 == $request->newPassword2 ) {
            if ( $request->oldPassword == $oldPassword ) {
                if ( strlen($request->newPassword1) > 0) {
                    $myfile = fopen("password.mtv", "w") or die("Unable to open file!");
                    $txt = $request->newPassword1;
                    fwrite($myfile, $txt);
                    fclose($myfile);
                    session()->put('admin', 'true') ;
                    $message = 'تم تغيير كلمة المرور' ;
                    return view('admin' , ['message'=>$message]) ;
                } else {
                    $message="كلمة المرور يجب ان لا تكون فارغة" ;
                    return view('admin' , ['message'=>$message] );
                }
            } else {
                $message="كلمة المرور الحالية خاطئة" ;
                return view('admin' , ['message'=>$message] );
            }
        } else {
            $message="كلمات المرور لا تتطابق" ;
            return view('admin', ['message'=>$message] );
        }
    }

    public function showAdminPage () {
        if (session()->has('admin') ) {
            return view('admin') ;
        } else {
            $message = "المشرفون فقط من يمكنهم رؤية هذه الصفحة" ;
            return view('admin' , ['message'=>$message]) ;
        }
    }

}
