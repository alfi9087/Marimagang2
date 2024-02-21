<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\FormsController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\DashboardMahasiswaController;
use App\Http\Controllers\DashboardAdminController;
use App\Http\Controllers\DashboardBidangController;
use App\Http\Controllers\BidangController;
use App\Http\Controllers\NotifikasiController;
use App\Http\Controllers\DetailController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\DataBidangController;
use App\Http\Controllers\PengajuanController;
use App\Models\DataBidang;
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
Route::get('/forms', [FormsController::class, 'form'])->name('forms');

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

//Route Dashboard Admin (Detail Bidang)
Route::get('/detail/{id}', [DashboardAdminController::class, 'detail'])->name('dashboard.detail')->middleware('auth:admin');

//Route Edit Profil
Route::get('/pengajuan/{id}', [DashboardMahasiswaController::class, 'pengajuan'])->middleware('auth:web');
Route::put('/kesbangpol', [PengajuanController::class, 'kesbangpol'])->name('kesbangpol.submit')->middleware('auth:web');
Route::put('/laporan', [PengajuanController::class, 'laporan'])->name('laporan.submit')->middleware('auth:web');

//Route Dashboard Bidang
Route::middleware(['auth:bidang'])->group(function () {
    Route::get('/dashboardbidang/{id}', [DashboardBidangController::class, 'index'])->name('dashboard.bidang');

    // Route Akun Bidang (CRUD Akun Bidang)
    Route::get('/bidang/{id}', [DashboardBidangController::class, 'bidang']);
    Route::post('/bidangpost', [BidangController::class, 'store'])->name('bidangpost');
    Route::put('/bidangupdate/{id}', [BidangController::class, 'update']);
    Route::get('/bidangdelete/{id}', [BidangController::class, 'delete']);

    // Route Data Bidang
    Route::get('/databidang/{id}', [DashboardBidangController::class, 'databidang']);
    Route::post('/databidang/submit', [DataBidangController::class, 'store'])->name('databidang.submit');
    Route::get('/databidangdelete/{id}', [DataBidangController::class, 'delete'])->name('databidangdelete');
    Route::get('/open/{id}', [DataBidangController::class, 'open']);
    Route::get('/close/{id}', [DataBidangController::class, 'close'])->name('bidang.close');
    Route::get('/detail/{id}', [DashboardBidangController::class, 'detail'])->name('dashboard.detail');
});

// Route Pengajuan
Route::post('/pengajuan-submite/submite', [PengajuanController::class, 'store'])->name('pengajuan.submit')->middleware('auth:web');
Route::get('/pengajuan/pilihan-skill/{databidang_id}', [DashboardMahasiswaController::class, 'select_skill'])->middleware('auth:web');
Route::get('/pengajuan/update-skill/{databidang_id}', [DashboardAdminController::class, 'select_skill'])->middleware('auth:admin');

// Route Dashboard Admin
Route::get('/pengajuanadmin', [DashboardAdminController::class, 'pengajuan'])->middleware('auth:admin');
Route::get('/pengajuanditeruskan', [DashboardAdminController::class, 'diteruskan'])->middleware('auth:admin');
Route::get('/pengajuanaccadmin', [DashboardAdminController::class, 'konfirmasi'])->middleware('auth:admin');
Route::get('/magang', [DashboardAdminController::class, 'magang'])->middleware('auth:admin');
Route::put('/diteruskan/{id}', [PengajuanController::class, 'updatebidang'])->middleware('auth:admin');
Route::put('/ditolakadmin/{id}', [PengajuanController::class, 'ditolakadmin'])->middleware('auth:admin');
Route::get('/userdetailadmin/{id}', [DashboardAdminController::class, 'userdetail'])->middleware('auth:admin');
Route::put('/diterimaadmin/{id}', [PengajuanController::class, 'diterimaadmin'])->middleware('auth:admin');
Route::put('/selesai', [PengajuanController::class, 'selesai'])->middleware('auth:admin');

// Route Dashboard Bidang
Route::get('/pengajuanbidang/{id}', [DashboardBidangController::class, 'pengajuan'])->middleware('auth:bidang');
Route::get('/userdetailbidang/{id}', [DashboardBidangController::class, 'userdetail'])->middleware('auth:bidang');
Route::put('/ditolakbidang/{id}', [PengajuanController::class, 'ditolakbidang'])->middleware('auth:bidang');
Route::put('/diterimabidang/{id}', [PengajuanController::class, 'diterimabidang'])->middleware('auth:bidang');

// Route Dashboard Mahasiswa Anggota
Route::post('/tambahanggota', [PengajuanController::class, 'tambahanggota'])->name('tambah.anggota')->middleware('auth:web');
Route::put('/editanggota/{id}', [PengajuanController::class, 'editanggota'])->name('edit.anggota')->middleware('auth:web');
Route::delete('/hapusanggota/{id}', [PengajuanController::class, 'deleteanggota'])->name('delete.anggota')->middleware('auth:web');
