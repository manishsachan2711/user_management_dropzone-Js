<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DropzoneRegisterController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// Route::post('/storeimgae', [App\Http\Controllers\Auth\RegisterController::class,'storeImage']);


Route::get('/register', [DropzoneRegisterController::class,'dropzoneform'])->name('register');

//Rout for submitting the form datat
Route::post('/storeInput', [DropzoneRegisterController::class,'storeInput'])->name('form.data');

//Route for submitting dropzone data
Route::post('/storeimgae', [DropzoneRegisterController::class,'storeImage']);



Auth::routes(['register' => false]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::prefix('admin')->middleware(['auth'])->name('admin.')->group(function(){

Route::get('profile/edit', [ProfileController::class,'edit'])->name('profile');
Route::post('profile/update', [ProfileController::class,'update'])->name('profile.update');
Route::get('/user',[UserController::class,'index'])->name('user');

});

