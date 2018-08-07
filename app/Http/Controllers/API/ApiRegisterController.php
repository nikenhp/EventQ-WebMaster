<?php
/**
 * Created by PhpStorm.
 * Auth: nathanael79
 * Date: 23/07/18
 * Time: 23:44
 */

namespace App\Http\Controllers\API;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ApiRegisterController extends Controller
{
    public function create(Request $request)
    {
        if($request->email && $request->password){
            $activeUser = User::where('email',$request->email)->first();
            if(is_null($activeUser))
            {
                User::create([
                    "name"=>$request->name,
                    "email"=>$request->email,
                    "password"=>sha1($request->password),
                    "user_role" => 0
                ]);

                return response()->json([
                    "status"=>true,
                    "code"=>200,
                ]);
            }
            else
            {
                return response()->json([
                    "status"=>false,
                    "code"=>500
                ]);
            }
        }
        else
        {
            return response()->json([
                "status"=>"false",
                "code"=>500
            ]);
        }
    }

    

    public function show() //Read All
    {
        //User::update()->all()
        return response()->json([
            'status'=>'berhasil',
            'code'=>200,
            'data'=>User::all()
        ]);
    }

    public function detailuser($id){
        $cekuser=User::where(['id'=>$id])->first();
        if (is_null($cekuser)){
            $params = [
                'code' => 404,
                'status'=>'false',
                'description' => 'Error Null',
                'message' => 'error bro',
            ];
            return response()->json($params);
        }
        $params=[
            'code' => 200,
            'status'=>'true',
            'description' => 'Found',
            'message' => 'yay berhasil',
            'data'=>$cekuser
        ];
        return response()->json($params);
    }

    public function delete($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return response()->json([
            "status"=>"berhasil",
            "code"=>500,
        ]);
    }

    public function updateuser(Request $request,$id){
        $user = User::where('id',$id)->first();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->address = $request->address;
        $user->gender = $request->gender;
        $user->photo = $request->photo;

        $user->save();
        $params = [
            'code' => 200,
            'description' => 'Success',
            'message' => 'Data berhasil ditambahkan',
            'data'=>$user,
        ];

        return response()->json($params);
    }
}