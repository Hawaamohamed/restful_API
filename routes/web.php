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
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

//routes for profile
Route::get('/profile','profileController@index')->name('profile');
Route::put('/profile/update','profileController@update')->name('profile.update');

//routes for posts
Route::get('/posts','postController@index')->name('posts');
Route::get('/posts/trashed','postController@postsTrashed')->name('posts.trashed');
Route::get('/posts/create','postController@create')->name('posts.create');
Route::post('/post/store','postController@store')->name('post.store');
Route::get('/post/show/{slug}','postController@show')->name('post.show');
Route::get('/post/{id}','postController@edit')->name('post.edit');
Route::post('/post/update/{id}','postController@update')->name('post.update');
Route::get('/post/destroy/{id}','postController@destroy')->name('post.destroy'); //soft delete
Route::get('/post/hard_delete/{id}','postController@hard_delete')->name('post.hard_delete'); //hard delete
Route::get('/post/restore/{id}','postController@restore')->name('post.restore'); //restore


//routes for tags
 Route::get('/tags','App\Http\controllers\TagController@index')->name('tags'); 
// Route::get('/tag/create','App\Http\controllers\TagController@create')->name('tags.create');
// Route::tag('/tag/store','App\Http\controllers\TagController@store')->name('tag.store'); 
// Route::get('/tag/{id}','App\Http\controllers\TagController@edit')->name('tag.edit');
// Route::tag('/tag/update/{id}','App\Http\controllers\TagController@update')->name('tag.update');

// Route::get('/tag/destroy/{id}','App\Http\controllers\TagController@destroy')->name('tag.destroy');   



//routes for users
Route::get('/users','userController@index')->name('users'); 
Route::get('/user/create','userController@create')->name('user.create');
Route::post('/user/store','userController@store')->name('user.store'); 
Route::get('/user/destroy/{id}','userController@destroy')->name('user.destroy'); //soft delete  

//comments 
Route::resource('post/comments','commentController');

  