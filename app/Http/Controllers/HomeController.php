<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use File;
use Auth;
use Session;
use App\Services\PayUService\Exception;
use Illuminate\Support\Facades\Hash;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }
    
    public function passw(Request $request)
    {

        $uid=Auth::id();
        $current_password = Auth::User()->password;
        if(Hash::check($request->pass1, $current_password))
        {
            if($request->pass2==$request->pass3)
            {
                if (strlen($request->pass2) <= 8) {
                    Session::flash('message','Таны нууц үг 8 тэмдэгтээс илүү байх ёстой.');
                    return redirect('config');
                }

                if(!preg_match("#[0-9]+#",$request->pass2)) {
                    $passwordErr = "Your Password Must Contain At Least 1 Number!";
                    Session::flash('message','Таны нууц үг дор хаяж 1 тоо агуулах ёстой.');
                    return redirect('config');
                }
                if(!preg_match("#[A-Z]+#",$request->pass2)) {
                    Session::flash('message','Таны нууц үг дор хаяж 1 том үсэг агуулах ёстой.');
                    return redirect('config');

                }
                if(!preg_match("#[a-z]+#",$request->pass2)) {
                    Session::flash('message','Таны нууц үг дор хаяж 1 жижиг үсэг агуулах ёстой.');
                    return redirect('config');

                }
                if(!preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/', $request->pass2)) {
                    Session::flash('message','Таны нууц үг дор хаяж 1 тэмдэгт агуулах ёстой.');
                    return redirect('config');
                }
                else{
                    $newpass=Hash::make($request->pass2);
                    $cnt = DB::update("update users set password='$newpass' where id=$uid");
                    Session::flash('message','Амжилттай боллоо.');
                    return redirect('config');
                }

            }
            else
                {
                    Session::flash('message','Баталгаажуулах нууц үг тохирсонгүй.');
                    return redirect('config');
                }
        }
        else
        {
            Session::flash('message','Амжилтгүй. Одоогийн нууц үг тохирсонгүй.');
            return redirect('config');
        }

    }
}
