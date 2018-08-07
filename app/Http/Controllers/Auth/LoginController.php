<?php
/**
 * Created by PhpStorm.
 * Auth: nathanael79
 * Date: 23/07/18
 * Time: 14:57
 */

namespace App\Http\Controllers\Auth;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class LoginController extends Controller
{
    public function index()
    {
        return view('Auth.login');
    }

    public function loginUser(Request $request)
    {
        $email = $request->input('email');
        $password = sha1($request->input('password'));

        $activeUser = User::where([
            'email'=>$email,
            'password'=>$password
        ])->first();

        if(is_null($activeUser))
        {
            return "<div class='alert alert-danger'>Pengguna Tidak Ditemukan!</div>";
        }
        else
        {
            if($activeUser->password!= $password)
            {
                return "<div class='alert alert-danger'>Password Salah!</div>";
            }
            else
            {
                $request->session()->put('activeUser',$activeUser);
                return redirect("/home");
            }
        }
    }

    public function logoutUser(Request $request)
    {
        $request->session()->flush();
        return redirect('/');
    }

}