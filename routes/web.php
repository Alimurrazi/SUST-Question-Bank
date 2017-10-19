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

Route::get('/tag2', function () {
    return view('tag2');
});
 
Route::get('/api/tags',function(){
return App\tag::where('tag_name','LIKE','%'.request('q').'%')->paginate(10);
});

 
Auth::routes(); 

Route::get('/home', 'HomeController@index');
 
Route::get('/profile','UserController@profile');
Route::post('/profile','UserController@update');

/*
Route::get('/ask_question',function()
{
      return view('ask_question'); 
});
*/

Route::get('/ask_question','AskController@index');

Route::post('/question_submit','QuestionSubmitController@submit');

Route::get('/show_question/{id}','QuestionSubmitController@show');

/*
Route::get('/show_question',function()
{
      return view('show_question'); 
});
*/


Route::get('autocomplete-search',array('as'=>'autocomplete.search','uses'=>'TagController@index'));

Route::get('autocomplete-ajax',array('as'=>'tagcomplete.ajax','uses'=>'TagController@ajax'));