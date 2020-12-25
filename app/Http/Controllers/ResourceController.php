<?php

namespace App\Http\Controllers;
use Auth;
use App\Models\Resource;
use Illuminate\Http\Request;

class ResourceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['resource'] = Resource::all();
        return view('admin.resource.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.resource.create');
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
                'link' => 'required',
            ], [
                'name.required' => 'Name is required',
                'type.required' => 'Resource Type is required',
                'link.required' => 'Resource link is required',
                
            ]);
        
        $user = Resource::create($validatedData);
        $notification = array(
            'message' => 'Resource Created successfully.', 
            'alert-type' => 'success'
            );
            activity()
           ->performedOn(Auth::user())
           ->causedBy($user)
           ->withProperties(['Creation user' => 'customValue'])
           ->log('New Resource Created successfully.');
           return back()->with($notification); 
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Resource  $resource
     * @return \Illuminate\Http\Response
     */
    public function show(Resource $resource)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Resource  $resource
     * @return \Illuminate\Http\Response
     */
    public function edit(Resource $resource)
    {
        $rsr = $resource;
        return view('admin.resource.edit',compact('rsr'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Resource  $resource
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Resource $resource)
    {
        $validatedData = $request->validate([
                    'name' => 'required',
                    'type' => 'required',
                    'link' => 'required',
                ], [
                    'name.required' => 'Name is required',
                    'type.required' => 'Resource Type is required',
                    'link.required' => 'Resource link is required',
                    
                ]);        
        
        $user = $resource->update($validatedData);       
        $notification = array(
            'message' => 'Resource updated successfully.', 
            'alert-type' => 'success'
            );
            activity()        
           ->withProperties(['Resource updated' => 'customValue'])
           ->log('Resource updated successfully.');
        return back()->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Resource  $resource
     * @return \Illuminate\Http\Response
     */
    public function destroy(Resource $resource)
    {
        $resource->delete();
            activity()
           ->performedOn(Auth::user())
           ->causedBy($resource)
           ->withProperties(['remove user' => 'customValue'])
           ->log('Resource Deleted successfully');
           $notification = array(
            'message' => 'Resource Deleted successfully', 
            'alert-type' => 'success'
            );
        
        return back()->with($notification);  
    }
}
