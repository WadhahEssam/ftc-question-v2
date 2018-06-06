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
        echo $password ;
        echo $request->password ;
        //checking if the password is the same
        if ($request->password == $password) {
            session()->put('admin' , $password ) ;

            return redirect('/admin') ;
        } else {
            $message="The password is wrong" ;
            return redirect('/' );
        }
    }

    public function changeAdminPassword ( Request $request ) {

        $myfile = fopen("password.mtv", "r") or die("Unable to open file!");
        $oldPassword = fread($myfile,filesize("password.mtv"));
        fclose($myfile);

//        return ' ' . $oldPassword . ' ' . $request->newPassword1 . ' '  . $request->oldPassword ;
        if ( $request->newPassword1 == $request->newPassword2 ) {
            if ( $request->oldPassword == $oldPassword ) {
                $myfile = fopen("password.mtv", "w") or die("Unable to open file!");
                $txt = $request->newPassword1;
                fwrite($myfile, $txt);
                fclose($myfile);
                session()->put('admin', $request->newPassword1) ;
                return redirect('/admin') ;
            } else {
                $message="The old password is wrong" ;
                return redirect('/admin' );
            }
        } else {
            $message="New passwords don't match" ;
            return redirect('/admin' );
        }
    }

    public function showAdminPage () {
        if (session()->has('admin') ) {
            return view('admin') ;
        } else {
            $message = "Only Admin can see this page" ;
            return redirect('/') ;
        }
    }

}
