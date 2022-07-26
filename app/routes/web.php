<?php

use Illuminate\Support\Facades\Auth;
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
    return redirect()->route('threads.index');
});

Route::resource("threads", "App\Http\Controllers\ThreadController");
Route::resource("channels", "App\Http\Controllers\ChannelController");
Route::resource("replies", "App\Http\Controllers\ReplyController");
Route::post('replies/store', "App\Http\Controllers\ReplyController@store")->name('replies.store');

Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
