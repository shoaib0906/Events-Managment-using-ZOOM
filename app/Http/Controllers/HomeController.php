<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Activity;
use App\Models\Auditorium;
use Auth;
use Zoom;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    /**
     * Show Admin Dashboard.
     * 
     * @return \Illuminate\Http\Response
     */
    public function index(){
    	    $date = \Carbon\Carbon::today()->subDays(30);
            $data['users'] = User::where('last_login', '>=', $date)->get();

            $data['activity'] = Activity::orderBy('id','desc')->get();
        	//dd($activity);
            return view('admin.home',$data);
    }
    public function form()
    {
        return view('admin.form');
    }
    public function data()
    {
        return view('admin.data');
    }
    public function mainhall()
    {	
    	return view('admin.mainhall.index');
    }
    public function auditorium()
    {
        $data['auditorium'] = $auditorium = Auditorium::first();
        //dd($auditorium->link);
        return view('admin.auditorium.auditorium',$data);
    }
    public function post_auditorium(Request $request)
    {
        $validatedData = $request->validate([
                'link' => 'required',                
            ], [
                'link.required' => 'Iframe code is required',                
            ]);

        $user = Auditorium::where('id','=','1')->update($validatedData);
        
        $notification = array(
            'message' => 'New Iframe code for auditorium Created successfully.', 
            'alert-type' => 'success'
            );
            activity()
           //->performedOn(Auth::user())
           //->causedBy($user)
           ->withProperties(['Creation user' => 'customValue'])
           ->log('New Iframe code for auditorium Created successfully.');
           return back()->with($notification);    
    }
    public function breakout()
    {
        /* Zoom::user()->create([
        'first_name' => 'First Name',
        'last_name' => 'Last Name',
        'email' => 'test@test.com',
        'password' => '12345678'
    ]); 
    // will return the created model so you can capture it if required.
    $user = Zoom::user()->create([
        'first_name' => 'First Name',
        'last_name' => 'Last Name',
        'email' => 'test@test.com',
        'password' => '12345678'
    ]); */
        $user = Zoom::user();
        dd($user);
    }
}