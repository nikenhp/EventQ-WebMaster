<?php
/**
 * Created by PhpStorm.
 * User: nathanael79
 * Date: 26/07/18
 * Time: 16:25
 */

namespace App\Http\Controllers\API;


use App\Http\Controllers\Controller;
use App\Models\Eventparticipant;
use Illuminate\Http\Request;

/**
 * 
 */
class ApiEventParticipantController extends Controller
{
    public function register(Request $request)
    {
        $registeredUser = Eventparticipant::where('user_id',$request->user_id)->first();
        if(is_null($registeredUser))
        {
            Eventparticipant::create([
                "user_id"=>$request->user_id,
                "event_id"=>$request->event_id,
                "payment_status"=>"0",
                "attendance"=>"0"
                ]);

             return response()->json([
                    "status"=>true,
                    "code"=>200,
                ]);
        }
        else
        {
            echo "User sudah pernah terdaftar !";
            
            return response()->json([
                "status"=>false,
                "code"=>500,
            ]);
        }
    }

    public function show(Request $request)
    {
        $registeredEvent = Eventparticipant::all();
        return response()->json([
            "status"=> "berhasil",
            "data"=>$registeredEvent,
        ]);
    }

}

/*class ApiEventParticipantController extends Controller
{

    public function create(Request $request)
    {
        if($request->user_id && $request->event_id){
            $participant = Eventparticipant::where('user_id',$request->user_id)->first();
            if(is_null($participant)) {
                Eventparticipant::create([
                    "user_id"=>$request->user_id,
                    "event_id"=>$request->event_id,
                    "payment_status"=>"belum",
                    "attendance"=>"belum",
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
}*/