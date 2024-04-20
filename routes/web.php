<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\FormulirController;
use App\Http\Controllers\VisitorController;
use App\Http\Controllers\VipController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\KaryawanController;
use App\Http\Controllers\FeedbackController;

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
Route::get('/', [UserController::class, 'index']);
Route::get('/Daftar-Tamu-Kunjungan', [FormulirController::class, 'daftar'])->name('daftartamukunjungan');
Route::get('/Survey-Kepuasan-Pengguna', [FormulirController::class, 'survey'])->name('surveypengguna');
Route::get('/Input-Vip', [HomeController::class, 'codevip'])->name('codevip');
Route::get('/register', [RegisterController::class, 'index']);
Route::post('/register', [RegisterController::class, 'register'])->name('register');
Route::post('/form', [FormulirController::class, 'storeForm']);
Route::get('/Formulir-Tamu',[FormulirController::class,'index'])->name('form-kunjungan');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
Route::post('/logout', [LogoutController::class, 'logout'])->name('logout');
Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
    
// Route::controller(LoginController::class)->group(function () {
//     Route::match(['GET', 'POST'],'/login', 'login')->name('login');
//     Route::get('/logout', 'index')->name('logout');

// });

// Route::middleware('auth')->group(function () {
//     Route::prefix('admin')->group(function () {
Route::get('/table',[HomeController::class,'tabler'])->name('table');
Route::get('/dashboard',[HomeController::class,'dashboard'])->name('dashboard')->middleware('auth.admin');
Route::get('/element',[VisitorController::class,'index'])->name('element')->middleware('auth.admin');
Route::post('/tambahdata', [VisitorController::class, 'store'])->name('tambahdata');
Route::get('/profile',[ProfileController::class,'index'])->name('profile')->middleware('auth.admin');
Route::post('/tambahakun',[ProfileController::class,'store'])->name('tambahakun');
Route::get('/vip',[VipController::class,'index'])->name('vip')->middleware('auth.admin');
Route::post('/tambahvip',[VipController::class,'store'])->name('tambahvip');
Route::get('/karyawan',[KaryawanController::class,'index'])->name('karyawan')->middleware('auth.admin');
Route::post('/tambahkaryawan',[KaryawanController::class,'store'])->name('tambahkaryawan');
Route::get('/feedback',[FeedbackController::class,'index'])->name('feedback');
Route::post('/feedback', [FeedbackController::class, 'store'])->name('feedback');

Route::get('/profile/{id}/edit', [ProfileController::class, 'edit'])->name('profile.edit');
Route::put('/profile/{id}', [ProfileController::class, 'update'])->name('profile.update');
// Route::delete('/profiles/{id}', [ProfileController::class, 'destroy'])->name('profiles.destroy');


Route::controller(VisitorController::class)->group(function () {
    Route::get('/cetak-tamu', 'cetakTamu')->name('cetak-tamu'); 
    Route::get('/excel', 'xlsx')->name('xlsx'); 

});
//     });
    
// });






