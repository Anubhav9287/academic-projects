<?php

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

use App\Mail\NewUserWelcomeMail;
use App\Mail\ContactUsMail;

use Illuminate\Support\Facades\DB;

// Welcome page
Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

// Reminder Email
Route::get('/profile/{user}/email','ProfileController@sendreminder');




// Contact Us
Route::get('/contactus', 'ProfileController@contactus')->name('contactus');

// Make user active
Route::post('/changestatus/{u_id}', 'ProfileController@changestatus');

Route::get('/profile/{user}', 'ProfileController@index')->name('profile.show');

Route::get('/profile/{user}/edit', 'ProfileController@edit')->name('profile_edit');
Route::patch('/profile/{user}/', 'ProfileController@update')->name('profile_update');

Route::get('/profile/{user}/delete', 'ProfileController@viewuser');

Route::delete('/profile/{user}/', 'ProfileController@destroy')->name('profile_delete');

// Route::get('/profile/{user}', 'ProfileController@update')->name('profile.update');
