<?php

namespace App\Http\Controllers;
use Carbon\Carbon;
use App\Models\User;
use Auth;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $data['user'] = User::all();
        return view('admin.user.index',$data);
        /*$notification = array(
            'message' => 'I am a successful message!', 
            'alert-type' => 'success'
        );
        return back()->with($notification);*/
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.user.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
                'name' => 'required',
                'type' => 'required',
                'password' => 'required|min:5',
                'email' => 'required|email|unique:users',
                'organisation' => 'required',
            ], [
                'name.required' => 'Name is required',
                'password.required' => 'Password is required',
                'email.required' => 'Password is required',
                'organisation.required' => 'Password is required',
            ]);
        
        $validatedData['user_type'] = $validatedData['type'];
        $validatedData['password'] = bcrypt($validatedData['password']);
        $user = User::create($validatedData);
      
        $notification = array(
            'message' => 'New User Created successfully.', 
            'alert-type' => 'success'
            );
            activity()
           ->performedOn(Auth::user())
           ->causedBy($user)
           ->withProperties(['Creation user' => 'customValue'])
           ->log('New User Created successfully.');
           return back()->with($notification); 
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('admin.user.edit',compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $validatedData = $request->validate([
                'name' => 'required',
                'type' => 'required',               
                //'email' => 'required|email|unique:users',
                'organisation' => 'required',
            ], [
                'name.required' => 'Name is required',
                'email.required' => 'Password is required',
                'organisation.required' => 'Password is required',
            ]);
        
        $validatedData['user_type'] = $validatedData['type'];
        $user = $user->update($validatedData);       
        $notification = array(
            'message' => 'User updated successfully.', 
            'alert-type' => 'success'
            );
            activity()
           //->performedOn()
           //->causedBy($user)
           ->withProperties(['Creation user' => 'customValue'])
           ->log('User updated successfully.');
           return back()->with($notification); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        if(Auth::user()->id == $user->id)
        {
            $notification = array(
            'message' => 'Admin Can not remove himself/herself', 
            'alert-type' => 'warning'
            );
            activity()
           ->performedOn($user)
           ->causedBy($user)
           ->withProperties(['remove user' => 'customValue'])
           ->log('Admin Can not remove himself/herself');
        }
        else
        {
            $user->delete();
            activity()
           ->performedOn(Auth::user())
           ->causedBy($user)
           ->withProperties(['remove user' => 'customValue'])
           ->log('Admin Can not remove himself/herself');
           $notification = array(
            'message' => 'User Deleted successfully', 
            'alert-type' => 'success'
            );
        }
        return back()->with($notification);        
    }
}
