<?php
/**
 * Created by PhpStorm.
 * User: nathanael79
 * Date: 26/07/18
 * Time: 16:25
 */

namespace App\Http\Controllers\API;


use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\Request;

class ApiEventController extends Controller
{
    public function create(Request $request)
    {
        if($request->name)
        {
            $activeEvent = Event::where('name',$request->name)->first();
            if(is_null($activeEvent))
            {
                Event::create([
                    "name"=> $request->name,
                    "address"=>$request->address,
                    "regency_id"=>$request->regency_id,
                    "price"=>$request->price,
                    "quota"=>$request->quota,
                    "category_id"=>$request->category_id,
                    "start_date"=>$request->start_date,
                    "end_date"=>$request->end_date,
                    "description"=>$request->description,
                    "confirmation_date"=>$request->confirmation_date,
                    "photo"=>$request->photo, //belum fix
                    "status"=>$request->event,
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
                    "code"=>500,
                ]);
            }
        }
        else
        {
            return response()->json([
                "status"=>false,
                "code"=>500,
            ]);
        }

    }

    public function update(Request $request, $id)
    {
        $event = Event::find($id);

        if($event!=null)
        {
            $event->update([
                'name'=>$request->name, //masalahnya di sini
                'address'=>$request->address, //masalahnya di sini
                'regency_id'=>$request->regency_id,
                'price'=>$request->price,
                'quota'=>$request->quota,
                'category_id'=>$request->category_id,
                'start_date'=>$request->start_date,
                'end_date'=>$request->end_date,
                'description'=>$request->description,
                'confirmation_date'=>$request->confirmation_date,
                'photo'=>$request->photo, //belum fix
                'status'=>$request->status,
                'gender'=>$request->gender,
            ]);

            return response()->json([
                'status'=>'berhasil',
                'code'=>200,
                'data'=>$event,
            ]);
        }
    }

    public function show()
    {
        return response()->json([
            "status"=>"berhasil",
            "code"=>200,
            'data'=>Event::all()
        ]);
    }

    public function search(Request $request, $name)
    {
        $query = $request->get('$name');
        $hasil = Event::where('name','LIKE','%'.$query.'%');

        return response()->json([
            "status"=>"berhasil",
            "code"=>200,
            "data"=>$hasil,
        ]);
    }


    // public function search(Request $request)
    // {
    //     $data = $request->get('data');

    //     $search = Event::where('name', 'LIKE', "%{$data}%")
    //                      ->get();

    //     return Response()->json([
    //         'status'=>'berhasil',
    //         'code'=>200,
    //         'data'=> $search
    //     ]);
    // }


    public function showById($id)
    {
        return response()->json([
            'status'=>'berhasil',
            'code'=>200,
            'data'=>Event::where('id',$id),
        ]);
    }

    public function delete($id)
    {
        $event = Event::findOrFail($id);
        $event->delete();
        return response()->json([
            "status"=>"berhasil",
            "code"=>500,
        ]);
    }

}