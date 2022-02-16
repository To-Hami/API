<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;



Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


/**************************  api routes   *****************************/


Route::get('users','apiController@index');


Route::get('posts','apiController@posts');
Route::get('showPost/{id}','apiController@show');
Route::post('addPosts','apiController@addPosts');
Route::post('updatePost/{id}','apiController@updatePost');
Route::get('deletePost/{id}','apiController@delete');

