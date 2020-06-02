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
})->name('welcome');

Route::get('/articulosInteresantes', 'InicioController@articulos')->name('articulosInteresantes');
Route::get('/masDeMi', 'InicioController@informacion')->name('masDeMi');

Route::get('/blog', function () {
    return view('auth.login');
});
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/post','PostController@post');
Route::get('/profile','ProfileController@profile');
Route::get('/category','CategoryController@category');
Route::post('/addCategory','CategoryController@addCategory');
Route::post('/addProfile','ProfileController@addProfile');
Route::post('/addPost','PostController@addPost');
Route::get('/view','PostController@view')->name('posts.view');
Route::get('/edit/{id}','PostController@edit')->name('posts.edit');
Route::put('/edit/{id}','PostController@editPost')->name('posts.update');
Route::delete('/delete/{id}','PostController@deletePost')->name('posts.delete');
Route::get('/category/{id}','PostController@category')->name('posts.category'); //
Route::post('/like','PostController@like');
Route::get('/dislike/{id}','PostController@dislike')->name('dislike');
