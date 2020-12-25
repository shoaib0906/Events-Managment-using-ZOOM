<?php

namespace App\Http\Controllers\Zoom;

use App\Models\User;
use App\Models\Auditorium;
use Auth;
use Zoom;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MeetingController extends Controller
{

	public function breakout()
    {
    	
	    $data['meetings'] = Zoom::user()->find('ashoab@ymail.com')->meetings;
	    //dd($data['meetings']);
	    return view('admin.zoom.index',$data);  
    }
    public function start_meeting($id)
    {
    	$meeting = Zoom::meeting()->find($id);
	    //dd($meeting->start_url);
	    return redirect()->intended($meeting->start_url);
    }
    public function usercreate(Request $request)
    {
    	//dd($request['first_name']);
    	Zoom::user()->create(
    		['first_name'=> $request['first_name'],
    		'last_name'=> $request['last_name'],
    		'email'=> $request['email'],
    		'type' => 1,//2=license
    		'password'=> 'Aadmin12345'
    				]);
    	dd($request->all());

    }
	
    public function list(Request $request)
	{
		    $path = 'users/me/meetings';
		    $response = $this->zoomGet($path);

		    $data = json_decode($response->body(), true);
		    $data['meetings'] = array_map(function (&$m) {
		        $m['start_at'] = $this->toUnixTimeStamp($m['start_time'], $m['timezone']);
		        return $m;
		    }, $data['meetings']);

		    return [
		        'success' => $response->ok(),
		        'data' => $data,
		    ];
	}
	public function create()
	{
		return view('admin.zoom.create_meeting');	
	}
	public function postcreate(Request $request)
	{

	    $validator = $request->validate([
                'topics' => 'required|string',
		        //'start_time'=>'after:'.date(DATE_ATOM, time() + (.5 * 60 * 60)),
		        'start_time' => 'required',
		        'agenda' => 'string|nullable',
		        'duration'=> 'required',
            ], 
            [
                'topics.required' => 'Topics Title is required',
                'start_time.required' => 'Start Time is required',
                //'start_time.after' => 'Please create Meeting at least after 30 minutes',
                'agenda.required' => 'Agenda is required',
                'duration.required'=>'Please Enter Duration of the Meeting'
            ]);
	    if(date('Y-m-d\Th:i',strtotime($request['start_time'])) <= date('Y-m-d\Th:i',strtotime(date(DATE_ATOM, time() + (.5 * 60 * 60)))))
		{
			$notification = array(
            'message' => 'Please create Meeting at least after 30 minutes', 
            'alert-type' => 'error'
            );
           return redirect()->back()->withInput()->with($notification);
           //return redirect()->route('admin.meetings')->with($notification);
		}
	    //dd(date(DATE_ATOM, time() + (.5 * 60 * 60))."--".$request['start_time']);
	    //dd($request['start_time']);
	    $meeting = Zoom::meeting()->make([
		      	'topic' => $request['topics'],
		        'type' => 2,
		        'start_time' => $request['start_time'],
		        'duration' => $request['duration'],
		        'agenda' => $request['agenda'], // best to use a Carbon instance here.
		        'timezone'=>'UTC',
		    ]);

		   /* $meeting->recurrence()->make([
		      'type' => 2,
		      'repeat_interval' => 1,
		      'weekly_days' => 2,
		      'end_times' => 5
		    ]);*/

		    $meeting->settings()->make([
		      'join_before_host' => true,
		      'approval_type' => 1,
		      'registration_type' => 2,
		      'enforce_login' => false,
		      'waiting_room' => false,
		    ]);

	    	$user = Zoom::user()->find('ashoab@ymail.com');
		    $user->meetings()->save($meeting);		    

			$notification = array(
            'message' => 'New Meeting Created successfully.', 
            'alert-type' => 'success'
            );
            activity()
           ->withProperties(['Creation user' => 'customValue'])
           ->log('New Meeting Created successfully.');
           return redirect()->route('admin.meetings')->with($notification);

	}
	public function get(Request $request,$id)
	{
	    $data['meeting'] = $meeting = Zoom::meeting()->find($id);
	    //dd($meeting->liveStream);
	    
	    return view('admin.zoom.edit_meeting',$data);
	}
	public function update(Request $request, string $id)
	{
		$validator = $request->validate([
                'topics' => 'required|string',
		        'start_time' => 'required',
		        'agenda' => 'string|nullable',
		        'duration'=> 'required',
		        //'start_time'=>'after:'.date(DATE_ATOM, time() + (2 * 60 * 60)),
            ], 
            [
                'topics.required' => 'Topics Title is required',
                'start_time.required' => 'Start Time is required',
                //'start_time.after' => 'Please create Meeting at least after 2 hour',
                'agenda.required' => 'Agenda is required',
                'duration.required'=>'Please Enter Duration of the Meeting'
            ]);
		$meeting = Zoom::meeting()->find($id);
		
		if(date('Y-m-d\Th:i',strtotime($meeting->start_time)) != date('Y-m-d\Th:i',strtotime($request['start_time'])))
		{
			$validator = $request->validate([                
		        'start_time'=>'after:'.date(DATE_ATOM, time() + (.5 * 60 * 60)),
            ], 
            [
                'start_time.after' => 'Please create Meeting at least after 30 minutes',
            ]);
		}
		//dd(Zoom::meeting()->find($id));
	    $meeting = $meeting->update([
		      	'topic' => $request['topics'],
		        'type' => 2,
		        'start_time' => $request['start_time'],
		        'duration' => $request['duration'],
		        'agenda' => $request['agenda'], // best to use a Carbon instance here.
		    ]);

	    	    

			$notification = array(
	            'message' => 'New Meeting updated successfully.', 
	            'alert-type' => 'success'
            );
            activity()
           ->withProperties(['Creation user' => 'customValue'])
           ->log('Meeting ID '.$id.' updated successfully.');
           return redirect()->route('admin.meetings')->with($notification);
	    
	}
	public function delete(Request $request, string $id)
	{
	    $meeting = Zoom::meeting()->find($id)->delete();		    

			$notification = array(
            'message' => 'Meeting ID: '.$id.' Deleted successfully.', 
            'alert-type' => 'warning'
            );
            activity()
           ->withProperties(['Creation user' => 'customValue'])
           ->log('Meeting ID '.$id.' Deleted successfully.');
           return redirect()->route('admin.meetings')->with($notification);
	}
}
