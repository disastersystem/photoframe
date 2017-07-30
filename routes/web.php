<?php

# views
Route::get('inside', function () {
    return view('index');
});

Route::get('/', function () {
    return view('login');
});

# api
Route::get('group/all/get', 'GroupController@index');
Route::get('group/{group_id}/get', 'GroupController@specific');
Route::get('group/{group_id}/photos/get', 'GroupController@photos');
Route::get('photo/all/get', 'GroupPhotoController@all');

Route::post('group/{group_id}/photo/add', 'GroupController@addPhoto');
Route::post('group/add', 'GroupController@add');


// Route::get('group/{group_id}/delete', 'GroupController@destroy');