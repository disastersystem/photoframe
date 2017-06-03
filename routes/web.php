<?php

# views
Route::get('/', function () {
    return view('index');
});

Route::get('/admin', function() {
	return view('admin/index');
});

# api
Route::get('trip', 'TripController@specific');
Route::get('trips', 'TripController@index');
Route::get('videos', 'TripVideoController@all');

Route::post('sendEntryMail', 'MailController@sendEntryMail');


Route::post('addTrip', 'TripController@add');
Route::post('trip/{trip_id}/update', 'TripController@update');
Route::post('trip/{trip_id}/activity', 'TripController@addActivity');
Route::post('trip/{trip_id}/photo', 'TripController@addPhoto');
Route::post('trip/{trip_id}/video', 'TripController@addVideo');

Route::post('activity/{activity_id}/update', 'TripActivityController@update');
Route::get('activity/{activity_id}/delete', 'TripActivityController@destroy');

// Route::get('admin/trip/{trip}/edit', 'TripController@edit');

// Route::post('admin/trip', 'TripController@store');
// Route::post('admin/trip/{trip}/update', 'TripController@update');
// Route::post('admin/trip/{trip_id}/photos','TripController@addPhoto');
// Route::post('admin/trip/{trip_id}/videos', 'TripController@addVideo');
// Route::post('admin/trip-image/{img_id}/caption', 'TripImageController@updateCaption');

// Route::delete('admin/trip/{trip}', 'TripController@destroy');
// Route::delete('admin/trip/photos/{photo_id}', 'TripImageController@destroy');
// Route::delete('admin/trip/videos/{video_id}', 'TripVideoController@destroy');