<?php

namespace App\Http\Controllers;
use Auth;
use App\Models\Announce;
use Illuminate\Http\Request;

class AnnounceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['announce'] = Announce::all();
        return view('admin.announce.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.announce.create');
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
                'title' => 'required',
                'date' => 'required',
                'start_time' => 'required',
                'desc' => 'required',
            ], 
            [
                'title.required' => 'Announcement Title is required',
                'date.required' => 'Date is required',
                'start_time.required' => 'Start Time is required',
                'desc.required' => 'Description is required',
                
            ]);
        $validatedData['date'] = date('Y-m-d',strtotime($request['date']));
        $user = Announce::create($validatedData);
        $notification = array(
            'message' => 'Announce Created successfully.', 
            'alert-type' => 'success'
            );
            activity()
           ->performedOn(Auth::user())
           ->causedBy($user)
           ->withProperties(['Creation user' => 'customValue'])
           ->log('Announce Created successfully.');
           return back()->with($notification);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Announce  $announce
     * @return \Illuminate\Http\Response
     */
    public function show(Announce $announce)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Announce  $announce
     * @return \Illuminate\Http\Response
     */
    public function edit(Announce $announce)
    {
        return view('admin.announce.edit',compact('announce'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Announce  $announce
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Announce $announce)
    {
        $validatedData = $request->validate([
                'title' => 'required',
                'date' => 'required',
                'start_time' => 'required',
                'desc' => 'required',
            ], [
                'title.required' => 'Announcement Title is required',
                'date.required' => 'Date is required',
                'start_time.required' => 'Start Time is required',
                'desc.required' => 'Description is required',
                
            ]);
        $validatedData['date'] = date('Y-m-d',strtotime($request['date']));
        $user = $announce->update($validatedData);       
        $notification = array(
            'message' => 'Announcement updated successfully.', 
            'alert-type' => 'success'
            );
            activity()        
           ->withProperties(['Resource updated' => 'customValue'])
           ->log('Announcement updated successfully.');
        return back()->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Announce  $announce
     * @return \Illuminate\Http\Response
     */
    public function destroy(Announce $announce)
    {
        $announce->delete();
            activity()
           ->performedOn(Auth::user())
           ->causedBy($announce)
           ->withProperties(['announce delete' => 'customValue'])
           ->log('Announcement Deleted successfully');
           $notification = array(
            'message' => 'Announcement Deleted successfully', 
            'alert-type' => 'success'
            );
        
        return back()->with($notification);  
    }
}
