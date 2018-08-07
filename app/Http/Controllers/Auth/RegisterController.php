<?php
/**
 * Created by PhpStorm.
 * Auth: nathanael79
 * Date: 23/07/18
 * Time: 14:52
 */

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    public function index()
    {
        return view('Auth.register');
    }

    public function createUser(Request $request)
    {
        //$user->getVillageId();
        $user =
            [
                'name'=>$request->name,
                'email'=>$request->email,
                'password'=>sha1($request->password),
                'gender'=>$request->gender,
            ];

        Validator::make($user,[
            'name'=>'required|string|max:255',
            'email'=>'required|email|string|max:255|unique:users',
            'password'=>'required|string|min:6|confirmed',
            'gender'=>'required|string',
        ]);


        if(User::create($user)) {
            return view('Auth.login');
        }
    }

}