<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\FormsController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\DashboardMahasiswaController;
use App\Http\Controllers\DashboardAdminController;
use App\Http\Controllers\BidangController;
use App\Http\Controllers\NotifikasiController;
use App\Http\Controllers\DetailController;
use App\Http\Controllers\AdminController;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

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

//Route Landing Page
Route::get('/', [HomeController::class, 'home']);

//Route Forms
Route::get('/forms', [FormsController::class, 'form']);

//Route Post Register
Route::post('/register/submit', [RegisterController::class, 'store'])->name('register.submit');

//Route Post Login
Route::post('/login/submit', [LoginController::class, 'authenticate'])->name('login.submit');

//Route Mahasiswa
Route::get('/mahasiswa/{id}', [DashboardMahasiswaController::class, 'index'])->name('mahasiswa')->middleware('auth:web');

//Route Dashboard Admin
Route::get('/dashboard', [DashboardAdminController::class, 'index'])->middleware('auth:admin');

// Dashboard -> Admin
Route::get('/admin', [DashboardAdminController::class, 'admin'])->middleware('auth:admin');
Route::post('/adminpost', [AdminController::class, 'store'])->name('adminpost')->middleware('auth:admin');
Route::put('/adminupdate/{id}', [AdminController::class, 'update'])->middleware('auth:admin');
Route::get('/admindelete/{id}', [AdminController::class, 'delete'])->middleware('auth:admin');

// Dashboard -> User (Mahasiswa)
Route::get('/user', [DashboardAdminController::class, 'user'])->middleware('auth:admin');
Route::get('/userdetail/{id}', [DashboardAdminController::class, 'userdetail'])->middleware('auth:admin');
Route::get('/verify/{id}', [MahasiswaController::class, 'verify'])->middleware('auth:admin');
Route::get('/block/{id}', [MahasiswaController::class, 'block'])->middleware('auth:admin')->name('mahasiswa.block');

//Notifikasi
Route::get('/notif', [NotifikasiController::class, 'notif']);

//Route Logout
Route::get('/logout', [LoginController::class, 'logout']);

//Route Detail (Home)
Route::get('/homedetail/{id}', [HomeController::class, 'detail']);

//Route Profil
Route::post('/profil/submit/{id}', [MahasiswaController::class, 'store'])->name('mahasiswa.submit')->middleware('auth:web');

//Route Edit Profil
Route::put('/mahasiswaupdate/{id}', [MahasiswaController::class, 'update'])->middleware('auth:web');

//Route Dashboard Admin
Route::get('/dashboard/home', [DashboardAdminController::class, 'home'])->name('dashboard.home')->middleware('auth:admin');
Route::post('/home/submit', [BidangController::class, 'store'])->name('home.submit')->middleware('auth:admin');
Route::get('/bidangdelete/{id}', [BidangController::class, 'destroy'])->name('bidang.delete')->middleware('auth:admin');

//Route Dashboard Admin (Detail Bidang)
Route::get('/detail/{id}', [DashboardAdminController::class, 'detail'])->name('dashboard.detail')->middleware('auth:admin');

//Route Edit Profil
Route::get('/pengajuan/{id}', [DashboardMahasiswaController::class, 'pengajuan'])->middleware('auth:web');
