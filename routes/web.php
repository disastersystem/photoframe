<?php

# views
Route::get('inside', function () {
    return view('index');
});

Route::get('/', function () {
    return view('login');
});

# api
Route::post('addgroup', 'GroupController@add');
Route::get('getgroups', 'GroupController@index');
Route::get('getgroup/{group_id}/', 'GroupController@specific');
Route::post('group/{group_id}/photo', 'GroupController@addPhoto');
Route::get('getphotos', 'GroupImageController@all');

Route::get('getuser/{id}', function() {
	// return Group::where('id', $id)->get();
});

// Route::post('sendEntryMail', 'MailController@sendEntryMail');


// Route::post('addTrip', 'TripController@add');
// Route::post('trip/{trip_id}/update', 'TripController@update');
// Route::post('trip/{trip_id}/activity', 'TripController@addActivity');
// Route::post('trip/{trip_id}/photo', 'TripController@addPhoto');
// Route::post('trip/{trip_id}/video', 'TripController@addVideo');

// Route::post('activity/{activity_id}/update', 'TripActivityController@update');
// Route::get('activity/{activity_id}/delete', 'TripActivityController@destroy');