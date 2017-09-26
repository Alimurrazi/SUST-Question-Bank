<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
 
Auth::routes();

Route::get('/home', 'HomeController@index');

Route::get('/profile','UserController@profile');
Route::post('/profile','UserController@update');

Route::get('/ask_question',function()
{
      return view('ask_question'); 
});
Route::post('/question_submit','QuestionSubmitController@submit');
Route::get('/show_question',function()
{
      return view('show_question'); 
}); 
