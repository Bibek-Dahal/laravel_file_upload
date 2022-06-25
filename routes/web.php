<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Models\{User,Post};
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

Route::get('/', [PostController::class,'index'])->middleware(['verified']);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';

Route::resource('posts', PostController::class)->except(['index']);

Route::get('user/{id}',function(Request $req,$id){
    // return User::findorFail($id)->posts;
    return dd($req->user()->gropus());
});

Route::get('post/{id}',function($id){
    return Post::find($id)->user;
});