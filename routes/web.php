<?php

use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\BankSampahController;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\PointController; 
use App\Http\Controllers\HomeController; 
use App\Http\Controllers\Auth\LoginController; 
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
Route::get('/', [App\Http\Controllers\WelcomeController::class, 'index']);

Auth::routes();

//firebase
Route::post('/firebase/login', [LoginController::class, 'loginFirebase'])->name('firebaseLogin');
Route::post('/firebase/logout', [LoginController::class, 'logoutFirebase'])->name('logoutFirebase');

Route::namespace('b')->group(function() {});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/register/member', [RegisterController::class, 'showRegistrationFormMember'])->name('register.member');
Route::post('/register/member', [RegisterController::class, 'createMember'])->name('registerMember');
Route::post('/register/bank_sampah', [RegisterController::class, 'create']);
Route::get('/register/memberGetBankSampah', [RegisterController::class, 'showBankSampah'])->name('showBankSampah');


// Route login dengan role admin
Route::group(['middleware' => ['routefirebase:admin']], function () {
Route::get('/banksampah', [BankSampahController::class, 'index'])->name('banksampah');
Route::get('/updatebanksampah/{id}', [BankSampahController::class, 'update'])->name('updatebanksampah');
Route::get('/rejectbanksampah/{id}', [BankSampahController::class, 'reject'])->name('updatebanksampah');

Route::get('/member', [MemberController::class, 'indexMember'])->name('member');
Route::get('/updatemember/{id}', [MemberController::class, 'updateMember'])->name('updatemember');
Route::get('/rejectmember/{id}', [MemberController::class, 'rejectMember'])->name('updatemember');

});

Route::group(['middleware' => ['routefirebase:admin,banksampah,keuangan']], function () {
Route::get('/member', [MemberController::class, 'indexMember'])->name('member');
Route::get('/updatemember/{id}', [MemberController::class, 'updateMember'])->name('updatemember');
Route::get('/rejectmember/{id}', [MemberController::class, 'rejectMember'])->name('updatemember');
});


// Route login dengan role admin

//Route::middleware(['auth', 'role:banksampah,keuangan,admin'])->group(function () {

// Route::middleware(['auth', 'role:banksampah,keuangan'])->group(function () {
Route::group(['middleware' => ['routefirebase:banksampah,keuangan']], function () {


	Route::get('/client', [MemberController::class, 'indexClient'])->name('client');
	Route::get('/updateclient/{id}', [MemberController::class, 'updateClient'])->name('updateclient');
	Route::get('/rejectclient/{id}', [MemberController::class, 'rejectClient'])->name('updateclient');

	Route::get('/localhero', [MemberController::class, 'indexLocalHero'])->name('localhero');
	Route::get('/updatelocalhero/{id}', [MemberController::class, 'updateLocalHero'])->name('updatelocalhero');
	Route::get('/rejectlocalhero/{id}', [MemberController::class, 'rejectLocalHero'])->name('updatelocalhero');

	Route::get('/point', [PointController::class, 'index'])->name('point');
	Route::get('/addpoint', [PointController::class, 'addpoint'])->name('addpoint');
	Route::post('/postpoint', [PointController::class, 'postpoint'])->name('postpoint');
	Route::get('/viewpoint/{id}', [PointController::class, 'viewpoint'])->name('viewpoint');
	Route::post('/updatepoint/{id}', [PointController::class, 'updatepoint'])->name('updatepoint');
	Route::get('/deletepoint/{id}', [PointController::class, 'deletepoint'])->name('deletepoint');
	Route::get('/laporan', [PointController::class, 'laporan'])->name('laporan');

});

// Route login dengan role client

// Route::middleware(['auth', 'role:client,localhero,admin'])->group(function () {
// Route::get('/pointMember', [PointController::class, 'indexMember'])->name('pointMember');
// });

Route::group(['middleware' => ['routefirebase:client,localhero,banksampah,keuangan']], function () {
	Route::get('/pointMember', [PointController::class, 'indexMember'])->name('pointMember');
});

// Route login dengan role admin
Route::group(['middleware' => ['routefirebase:localhero']], function () {
	Route::get('/addpointMember', [PointController::class, 'addpointMember'])->name('addpointMember');
	Route::post('/postpointMember', [PointController::class, 'postpointMember'])->name('postpoint');
});

//Route::get('/laporan', [PointController::class, 'laporan'])->name('laporan');



//apimobile
Route::post('/api/get_point/member', [PointController::class, 'getGurrentPointBankSampa']);
Route::get('/api/get_harga/all', [PointController::class, 'getAllPoints']);
Route::get('/manualbook', [HomeController::class, 'manualbook'])->name('manualbook');
