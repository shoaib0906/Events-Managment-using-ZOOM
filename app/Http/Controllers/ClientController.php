<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Announce;
use App\Models\Auditorium;
use App\Models\Agenda;
use App\Models\Resource;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use Zoom;
use DB;
use Session;
class ClientController extends Controller
{
    
    /**
     * Show Admin Dashboard.
     * 
     * @return \Illuminate\Http\Response
     */
    public function login()
    {
        return view('client.login');
    }
    public function postlogin(Request $request)
    {
        $validatedData = $request->validate([
                'name' => 'required',
                'code' => 'required',
            ], 
            [
                'name.required' => 'Student Name is required',
                'code.required' => 'Student Code is required',
            ]);
        $student = DB::table('students')->where('name','=',$request['name'])->where('code','=',$request['code'])->first();
        if (isset($student)) {
            $request->session()->put('name', $student->name);
            $request->session()->put('code', $student->code);
            return redirect()->route('/');
        }
        //Session::flush('error','Provided Information does not match with our existing records. ');
        return view('client.login')->withErrors('Provided Information does not match with our existing records. ');

    }
    public function clientLogout(Request $request)
    {
        $request->session()->forget('name');
        $request->session()->forget('code');
        return redirect()->route('/');

    }
    public function auditorium()
    {
         if(empty(session('name')))
            return redirect()->route('student_login')->withErrors('Please login to access this Menu');;
        $data['auditorium'] = $auditorium = Auditorium::first();
        $data['agenda'] = Agenda::all();
        return view('client.auditorium',$data);
    }
    public function breakout()
    {
         if(empty(session('name')))
            return redirect()->route('student_login')->withErrors('Please login to access this Menu');;
        $data['meetings'] = Zoom::user()->find('ashoab@ymail.com')->meetings()->where('type', 'scheduled')->orderBy('start_time')->get();
        //dd($data['meetings']);
        return view('client.breakout',$data);
    }
    public function program()
    {
         if(empty(session('name')))
            return redirect()->route('student_login')->withErrors('Please login to access this Menu');;

        $data['agenda'] = Agenda::orderBy('start_time','asc')->get();
        return view('client.program',$data);
    }
    public function resource()
    {
         if(empty(session('name')))
            return redirect()->route('student_login')->withErrors('Please login to access this Menu');
        $data['resource'] = Resource::orderBy('id','desc')->get();
        return view('client.resource',$data);
    }
}