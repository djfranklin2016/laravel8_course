<?php

use App\Http\Controllers\PostsController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\HomeController;
use Illuminate\Http\Request;
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


// HomeController has many functions so call correct one via an array
// NB DON'T FORGET TO ADD CLASS AT TOP OF THIS PAGE !!!
Route::get('/', [HomeController::class, 'home'])
    ->name('home.index')
    // ->middleware('auth') // protects this route from unauthorised viwers (not logged in)
    ;

    // better way is via the actual Controller - see PostsController!

Route::get('/contact', [HomeController::class, 'contact'])->name('home.contact');

Route::get('/secret', [HomeController::class, 'secret'])
    ->name('secret')
    ->middleware('can:home.secret');        // only Admins can access home/secret page

// CREATE ROUTES FOR ALL POSTCONTROLLERS IN A SINGLE LINE
// NB DON'T FORGET TO ADD CLASS AT TOP OF THIS PAGE !!!

Route::resource('posts', PostsController::class);

Auth::routes();     // registers ALL Auth routtes

