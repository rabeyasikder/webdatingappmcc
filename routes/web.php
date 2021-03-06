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

Route::get('/', 'HomeController@index');
Route::get('/home', 'HomeController@index');
Route::post('/user','HomeController@store');


Route::get('test',function (){
    $lat = Auth::user()->lat;
    $lng = Auth::user()->lng;
    $radius = 5;

    $string = "SELECT id,image, gender, dateofbirth, address , ( 6371 * acos( cos( radians(?) ) *
        cos( radians( lat ) ) * cos( radians( lng ) - radians(?) ) + sin( radians(?) ) * sin( radians( lat ) ) ) )
        AS distance FROM profiles HAVING distance < ? ORDER BY distance LIMIT 0 , 20;";

    $args = [$lat, $lng, $lat, $radius];

    $data = DB::select($string, $args);

    return ($data) ? $data : null;
});


Route::get('/p/create','PostsController@create');
Route::post('/p','PostsController@store');
Route::get('/p/{post}','PostsController@show');



Route::get('/profile/{user}', 'ProfileController@index')->name('profile.show');
Route::get('/profile/{user}/edit', 'ProfileController@edit')->name('profile.edit');
Route::patch('/profile/{user}', 'ProfileController@update')->name('profile.update');


