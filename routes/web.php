<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\EDMyJobController;
use App\Http\Controllers\JSDMyProfileController;
use App\Http\Controllers\VerificationController;

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

Route::get('/', [HomeController::class, 'developerlook_index'])->name('home');
Route::post('/login', [HomeController::class, 'developerlook_login'])->name('login');
Route::post('/logout', [HomeController::class, 'developerlook_logout'])->name('logout');
Route::get('/filter-data', [EDMyJobController::class, 'developerlook_index'])->name('filterData');
Route::post('/delete-list', [EDMyJobController::class, 'developerlook_delete_list'])->name('delete-list');
Route::post('/nearby-zip-codes', [EDMyJobController::class, 'nearby']);
Route::get('/upload-file', [JSDMyProfileController::class, 'developerlook_index'])->name('uploadFile');
Route::post('/upload-file', [JSDMyProfileController::class, 'uploadSubmit'])->name('uploadSubmit');
Route::post('/filter-data', [EDMyJobController::class, 'developerlook_index'])->name('location');
// Route::get('/suggest-locations', [EDMyJobController::class, 'suggestLocations'])->name('suggestLocations');
// Route::post('/nearby-zip-codes', [EDMyJobController::class, 'nearby'])->name('nearby');
Route::post('/update', [EDMyJobController::class, 'update'])->name('update');
Route::post('/update_exp', [EDMyJobController::class, 'update_exp'])->name('update_exp');
Route::post('/show-list', [EDMyJobController::class, 'showlist'])->name('record-selected');
// new updated code 
Route::get('/all-list', [EDMyJobController::class, 'developerlook_all_list'])->name('all_list');
Route::get('/delete_single/{id}', [EDMyJobController::class, 'developerlook_delete_single'])->name('delete_single');
Route::get('/admin-post-single/{id}', [EDMyJobController::class, 'developerlook_admin_single'])->name('admin_single');
Route::get('/export-to-csv/{id}', [EDMyJobController::class, 'developerlook_exportToCsv'])->name('exportCsv');
Route::get('/Allexport-to-csv', [EDMyJobController::class, 'developerlook_exportToCsvAll'])->name('AllexportCsv');
Route::get('/delete_data_single/{dataId}/{id}', [EDMyJobController::class, 'developerlook_data_single_data'])->name('delete_data_single');


// user routes
Route::get('/user-signup', [UserController::class, 'developerlook_index'])->name('userSignup');
Route::get('/verification/{service}/{token}', [VerificationController::class, 'verify'])->name('verification.verify');
Route::post('/user-signup', [UserController::class, 'developerlook_user_store'])->name('userSignupPost');
Route::get('/user-verify', [UserController::class, 'developerlook_index_verify'])->name('userVerify');
Route::post('/user-verify', [UserController::class, 'developerlook_user_verify'])->name('user_verify');
Route::get('/post', [UserController::class, 'developerlook_timeline'])->name('timeline');
Route::get('/profile', [UserController::class, 'developerlook_profile'])->name('profile');
Route::get('/payment', [UserController::class, 'developerlook_payment'])->name('payment');
Route::get('/credit', [UserController::class, 'developerlook_credit'])->name('credit');
Route::get('/passChange', [UserController::class, 'developerlook_passChange'])->name('passChange');
Route::post('/passChange', [UserController::class, 'developerlook_passChangePost'])->name('passChangePost');
Route::get('/stripe/{amount}', [UserController::class, 'stripe'])->name('stripe');
Route::post('/stripe', [UserController::class, 'stripePost'])->name('stripe.post');
Route::get('/post-single/{id}', [UserController::class, 'developerlook_single'])->name('single');
Route::post('/download', [UserController::class, 'developerlook_download'])->name('download');
Route::get('/admin-download/{id}', [EDMyJobController::class, 'developerlook_admin_download'])->name('admin_download');