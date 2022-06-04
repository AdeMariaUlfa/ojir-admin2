<?php

use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\BankSampahController;
use App\Http\Controllers\MemberController;
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

Route::get('/register/member', [RegisterController::class, 'showRegistrationFormMember'])->name('register.member');
Route::post('/register/member', [RegisterController::class, 'registerMember'])->name('registerMember');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/banksampah', [BankSampahController::class, 'index'])->name('banksampah');
Route::get('/updatebanksampah/{id}', [BankSampahController::class, 'update'])->name('updatebanksampah');
Route::get('/rejectbanksampah/{id}', [BankSampahController::class, 'reject'])->name('updatebanksampah');


Route::get('/member', [MemberController::class, 'indexMember'])->name('member');
Route::get('/updatemember/{id}', [MemberController::class, 'updateMember'])->name('updatemember');
Route::get('/rejectmember/{id}', [MemberController::class, 'rejectMember'])->name('updatemember');
