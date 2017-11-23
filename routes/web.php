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
  
Route::get('/welcomet', function () {
    return view('welcomet');
});


Route::get('/tag2', function () {
    return view('tag2');
});

Route::get('/tag','TagController@all');
Route::get('/tag/{id}','TagController@specific');
 
Route::get('/users','ShowUsersController@index');

/*
Route::get('/tag', function () {
    return view('tag');
});
*/
  
Route::get('/api/tags',function(){
return App\tag::where('tag_name','LIKE','%'.request('q').'%')->paginate(10);
});
 
 
Auth::routes(); 

Route::get('/home', 'HomeController@index'); 
 
Route::get('/profile/{id}','UserController@profile'); 
Route::post('/profile','UserController@update');

Route::get('/notification/{id}','NotificationController@index');

/*
Route::get('/ask_question',function()
{
      return view('ask_question'); 
});
*/

Route::get('/ask_question','AskController@index');

Route::post('/question_submit','QuestionSubmitController@submit');

Route::get('/show_question/{id}','QuestionSubmitController@show');

Route::get('/edit_question/{id}','QuestionEditController@index');

Route::post('/remove_question/{id}','removeQuesAnsController@question');
/*
Route::get('/show_question',function()
{
      return view('show_question'); 
});
*/
   

Route::get('autocomplete-search',array('as'=>'autocomplete.search','uses'=>'TagController@index'));

Route::get('autocomplete-ajax',array('as'=>'tagcomplete.ajax','uses'=>'TagController@ajax'));

Route::post('/add-answer/{id}','AnswerSubmitController@submit');
Route::post('/edit-answer/{id}','AnswerSubmitController@edit');
Route::post('/remove-answer/{id}','removeQuesAnsController@answer');

Route::post('/select-answer/{id}','AnswerSubmitController@select');

Route::post('/voting/{id}','VotingController@submit');

Route::get('/academic_archive', function () {
    return view('academic_archive');
});

Route::post('/academic_archive_submitted','academicArchiveController@store');

Route::get('/academic_archive_file_view', function () {
    return view('academic_archive_file_view');
});

Route::get('/academic_archive_file_view','academicArchiveController@show');

Route::post('/academic_archive_file_view','academicArchiveController@search');