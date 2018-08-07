<?php
/**
 * Created by PhpStorm.
 * Auth: nathanael79
 * Date: 23/07/18
 * Time: 23:42
 */

namespace App\Http\Controllers\API;


use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class ApiLoginController extends Controller
{
    public function login(Request $request)
    {
        $email = $request->email;
        $password = sha1($request->password);

        $activeUser = User::where('email',$email)->first();
        if(is_null($activeUser))
        {
            return response()->json([
               "status"=>"email not found",
            ]);
        }

        if($activeUser->password!=$password)
        {
            return response()->json('Password salah');
        }
        return response()->json([
            'status'=>true,
            'code'=>200,
            'description'=>'success',
            'message'=>'login berhasil',
            'data'=>$activeUser,
        ]);
    }
}