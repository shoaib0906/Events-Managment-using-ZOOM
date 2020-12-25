<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
})->name('/');

Route::get('student_login','ClientController@login')->name('student_login');
Route::post('student_login','ClientController@postlogin')->name('student_login');
Route::get('student_logout','ClientController@clientLogout')->name('student_logout');



Route::get('auditorium', 'ClientController@auditorium');
Route::get('breakout', 'ClientController@breakout');
Route::get('program','ClientController@program');
Route::get('resource', 'ClientController@resource');

/*Route::get('auditorium', function () {
    return view('client.auditorium');
});
Route::get('breakout', function () {
    return view('client.breakout');
});
Route::get('program', function () {
    return view('client.program');
});
Route::get('resource', function () {
    return view('client.resource');
});
*/



Route::group(['middleware' => ['auth'],'prefix' => 'admin' ], function () { 
	//dd(Auth::check());
	//if (Auth:: =='0')
	{
	Route::get('home','HomeController@index');
	Route::get('form','HomeController@form');
	Route::get('data','HomeController@data');

	Route::get('auditorium','HomeController@auditorium');
	Route::post('auditorium','HomeController@post_auditorium')->name('auditorium.store');
	

	Route::get('mainhall','HomeController@mainhall');
	Route::resource('users','EmployeeController');
	Route::resource('resource','ResourceController');
	Route::resource('agenda','AgendaController');
	Route::resource('announce','AnnounceController');


	Route::get('change-password', 'ChangePasswordController@index');
	Route::post('change-password', 'ChangePasswordController@store')->name('change.password');

	/*===================================================*/
	/*=====================Zoom Meeting==================*/
	/*===================================================*/
	Route::get('meetings','Zoom\MeetingController@breakout')->name('admin.meetings');

	Route::post('meetings/usercreate','Zoom\MeetingController@usercreate')->name('zoom.user.create');
	Route::get('meetings/create','Zoom\MeetingController@create')->name('meeting.create');
	Route::post('meetings/create','Zoom\MeetingController@postcreate')->name('meeting.store');
	Route::put('meetings/update/{id}','Zoom\MeetingController@update')->name('meeting.update');
	Route::post('meetings/delete','Zoom\MeetingController@postcreate')->name('meeting.delete');
	Route::get('start_meeting/{id}','Zoom\MeetingController@start_meeting')->name('meeting.start');
	
	
	//Route::get('/meetings', 'Zoom\MeetingController@list');

	// Create meeting room using topic, agenda, start_time.
	//Route::post('/meetings', 'Zoom\MeetingController@create');

	// Get information of the meeting room by ID.
	Route::get('/meetings/{id}', 'Zoom\MeetingController@get')->where('id', '[0-9]+');
	Route::patch('/meetings/{id}', 'Zoom\MeetingController@update')->where('id', '[0-9]+');
	Route::delete('/meetings/{id}', 'Zoom\MeetingController@delete')->where('id', '[0-9]+')->name('meetings.destroy');

	/*===================================================*/
	/*==================End Zoom Meeting=================*/
	/*===================================================*/

	}
});



Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return Inertia\Inertia::render('Dashboard');
})->name('dashboard');
