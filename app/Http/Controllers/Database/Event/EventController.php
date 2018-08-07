<?php
/**
 * Created by PhpStorm.
 * User: nathanael79
 * Date: 25/07/18
 * Time: 1:34
 */

namespace App\Http\Controllers\Database\Event;


use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Event;
use Carbon\Carbon;
use Illuminate\Http\Request;
use DB;
use Yajra\DataTables\DataTables;
use Validator;

class EventController extends Controller
{
    public function index()
    {
        return view('Database.Event.event');
    }

    public function getDataTable()
    {
        return DataTables::of(Event::all())->make(true);
    }

    public function create()
    {
        $data = [
            'category' => DB::table('category')->get(),
            'regency' => DB::table('regencies')->get(),
            'province'=> DB::table('provinces')->get(),
        ];

        return view('Database.Event.insert',$data);
    }

    public function store(Request $request)
    {
        if($request->file("photo"))
        {
            $time = Carbon::now();
            $extension = $request->file('photo')->getClientOriginalExtension();
            $directory = 'Images/Event/';
            $filename = str_slug($request->input('name')).'-'.date_format($time,'d').rand(1,999).date_format($time,'h').".".$extension;
            $upload_success = $request->file("photo")->storeAs($directory,$filename,'public');
        }
        else
        {
            $filename = '';
        }

        Validator::make($request->only(['name','address','regency_id','price','start_date','end_date','confirmation_date','status']),[
            'name'=>'required',
            'address'=>'required',
            'regency_id'=>'required',
            'price'=>'required',
            'start_date'=>'required',
            'end_date'=>'required',
            'confirmation_date'=>'required',
            'status'=>'required',
        ]);

        $activeEvent = Event::where('name',$request->name)->first();
        if(is_null($activeEvent))
        {
            $event =[
                'name'=>$request->name,
                'address'=>$request->address,
                'regency_id'=>$request->regency_id,
                'price'=>$request->price,
                'quota'=>$request->quota,
                'category_id'=>$request->category_id,
                'start_date'=>$request->start_date,
                'end_date'=>$request->end_date,
                'description'=>$request->description,
                'confirmation_date'=>$request->confirmation_date,
                'photo'=>$filename,
                'status'=>$request->status,
            ];
            if(Event::create($event))
            {
                return view("Database.Event.event");
            }
        }
        else
        {
            echo "event telah ada";
        }
    }

    public function edit($id)
    {
        $data=[
            'event' => Event::find($id),
            'category' => DB::table('category')->get(),
            'regencies'=> DB::table('regencies')->get(),
        ];
        return view('Database.Event.edit',$data);
    }

    public function update(Request $request, $id)
    {
        if($request->file("photo"))
        {
            $time = Carbon::now();
            $extension = $request->file('photo')->getClientOriginalExtension();
            $directory = 'Images/Event/';
            $filename = str_slug($request->input('name')).'-'.date_format($time,'d').rand(1,999).date_format($time,'h').".".$extension;
            $upload_success = $request->file("photo")->storeAs($directory,$filename,'public');
        }
        else
        {
            $filename = '';
        }

        //$activeEvent = Event::find($name);

        $event =[
            'name'=>$request->name,
            'address'=>$request->address,
            'regency_id'=>$request->regency_id,
            'price'=>$request->price,
            'quota'=>$request->quota,
            'category_id'=>$request->category_id,
            'start_date'=>$request->start_date,
            'end_date'=>$request->end_date,
            'description'=>$request->description,
            'confirmation_date'=>$request->confirmation_date,
            'photo'=>$filename,
            'status'=>$request->status,
        ];

        Validator::make($event,[
            'name'=>'required',
            'address'=>'required',
            'regency_id'=>'required',
            'price'=>'required',
            'start_date'=>'required',
            'end_date'=>'required',
            'description'=>'required',
            'confirmation_date'=>'required',
            'status'=>'required',
        ]);

        if(Event::find($id)->update($event))
        {
            return redirect('/event');
        }
    }

    public function delete($id)
    {
        if(Event::destroy($id))
        {
            return view("Database.Event.event");
        }

    }
}