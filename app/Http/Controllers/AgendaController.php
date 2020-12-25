<?php

namespace App\Http\Controllers;
use Auth;
use App\Models\Agenda;
use Illuminate\Http\Request;

class AgendaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['agenda'] = Agenda::all();
        return view('admin.agenda.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.agenda.create');
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
                'topic' => 'required',
                'start_time' => 'required',
                'stop_time' => 'required',
                'link' => 'required',
            ], [
                'topic.required' => 'Topic is required',
                'start_time.required' => 'Start Time is required',
                'stop_time.required' => 'Stop Time is required',
                'link.required' => 'Link is required',
                
            ]);
        
        $user = Agenda::create($validatedData);
        $notification = array(
            'message' => 'Agenda Created successfully.', 
            'alert-type' => 'success'
            );
            activity()
           ->performedOn(Auth::user())
           ->causedBy($user)
           ->withProperties(['Creation user' => 'customValue'])
           ->log('Agenda Created successfully.');
           return back()->with($notification);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Agenda  $agenda
     * @return \Illuminate\Http\Response
     */
    public function show(Agenda $agenda)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Agenda  $agenda
     * @return \Illuminate\Http\Response
     */
    public function edit(Agenda $agenda)
    {
        //dd($agenda);
        //$agenda = $agenda;
        return view('admin.agenda.edit',compact('agenda'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Agenda  $agenda
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Agenda $agenda)
    {
        $validatedData = $request->validate([
                'topic' => 'required',
                'start_time' => 'required',
                'stop_time' => 'required',
                'link' => 'required',
            ], [
                'topic.required' => 'Topic is required',
                'start_time.required' => 'Start Time is required',
                'stop_time.required' => 'Stop Time is required',
                'link.required' => 'Link is required',
                
            ]);
        
        $user = $agenda->update($validatedData);       
        $notification = array(
            'message' => 'Agenda updated successfully.', 
            'alert-type' => 'success'
            );
            activity()        
           ->withProperties(['Resource updated' => 'customValue'])
           ->log('Agenda updated successfully.');
        return back()->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Agenda  $agenda
     * @return \Illuminate\Http\Response
     */
    public function destroy(Agenda $agenda)
    {
        $agenda->delete();
            activity()
           ->performedOn(Auth::user())
           ->causedBy($agenda)
           ->withProperties(['Agenda delete' => 'customValue'])
           ->log('Agenda Deleted successfully');
           $notification = array(
            'message' => 'Agenda Deleted successfully', 
            'alert-type' => 'success'
            );
        
        return back()->with($notification);  
    }
}
