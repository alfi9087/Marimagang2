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
use App\Http\Controllers\AdminController;
use App\Http\Controllers\DataBidangController;
use App\Http\Controllers\PengajuanController;

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

// Route Landing Page
Route::get('/marimagang', [HomeController::class, 'home'])->name('home');

// Route Forms (Login Register)
Route::get('/forms', [FormsController::class, 'form'])->name('forms');

// Route Post Register
Route::post('/register', [RegisterController::class, 'store'])->name('register.submit');

// Route Post Login
Route::post('/login', [LoginController::class, 'authenticate'])->name('login.submit');

// Notifikasi
Route::get('/notif', [NotifikasiController::class, 'notif']);

// Route Logout
Route::get('/logout', [LoginController::class, 'logout']);

// Route Detail (Home)
Route::get('/homedetail/{id}', [HomeController::class, 'detail']);

// Email Verifikasi Mahasiswa
Route::get('/verification/{user}', [MahasiswaController::class, 'verify'])->name('verify');

// Route Mahasiswa
Route::middleware(['auth:web'])->group(function () {
    Route::get('/pengajuan/{id}', [DashboardMahasiswaController::class, 'pengajuan']);
    Route::get('/alurmagang/{id}', [DashboardMahasiswaController::class, 'alurmagang']);
    Route::get('/anggota/{id}', [DashboardMahasiswaController::class, 'anggota']);
    Route::get('/logbook/{id}', [DashboardMahasiswaController::class, 'logbook']);
    Route::post('/logbook/store/{id}', [PengajuanController::class, 'logbook'])->name('logbook.store');
    Route::put('/kesbangpol', [PengajuanController::class, 'kesbangpol'])->name('kesbangpol.submit');
    Route::put('/laporan', [PengajuanController::class, 'laporan'])->name('laporan.submit');

    Route::get('/mahasiswa/{id}', [DashboardMahasiswaController::class, 'index'])->name('mahasiswa');
    Route::post('/profil/submit/{id}', [MahasiswaController::class, 'store'])->name('mahasiswa.submit');
    Route::put('/mahasiswaupdate/{id}', [MahasiswaController::class, 'update']);

    Route::post('/pengajuan-submite/submite', [PengajuanController::class, 'store'])->name('pengajuan.submit');
    Route::get('/pengajuan/pilihan-skill/{databidang_id}', [DashboardMahasiswaController::class, 'select_skill']);

    Route::post('/tambahanggota', [PengajuanController::class, 'tambahanggota'])->name('tambah.anggota');
    Route::put('/editanggota/{id}', [PengajuanController::class, 'editanggota'])->name('edit.anggota');
    Route::delete('/hapusanggota/{id}', [PengajuanController::class, 'deleteanggota'])->name('delete.anggota');
});

// Route Admin
Route::middleware(['auth:admin'])->group(function () {
    Route::get('/dashboardadmin', [DashboardAdminController::class, 'index']);

    Route::get('/admin', [DashboardAdminController::class, 'admin']);
    Route::post('/adminpost', [AdminController::class, 'store'])->name('adminpost');
    Route::put('/adminupdate/{id}', [AdminController::class, 'update']);
    Route::get('/admindelete/{id}', [AdminController::class, 'delete']);

    Route::get('/block/{id}', [MahasiswaController::class, 'block'])->name('mahasiswa.block');
    Route::get('/verify/{id}', [MahasiswaController::class, 'verifyAdmin'])->name('mahasiswa.verify');

    Route::get('/user', [DashboardAdminController::class, 'user']);
    Route::get('/detail/{id}', [DashboardAdminController::class, 'detail'])->name('dashboard.detail');

    // Route Pengajuan
    Route::get('/pengajuan/update-skill/{databidang_id}', [DashboardAdminController::class, 'select_skill']);

    // Route Dashboard Admin
    Route::get('/pengajuanadmin', [DashboardAdminController::class, 'pengajuan']);
    Route::get('/pengajuanditeruskan', [DashboardAdminController::class, 'diteruskan']);
    Route::get('/pengajuanaccadmin', [DashboardAdminController::class, 'konfirmasi']);
    Route::get('/magang', [DashboardAdminController::class, 'magang']);
    Route::put('/diteruskan/{id}', [PengajuanController::class, 'updatebidang']);
    Route::put('/ditolakadmin/{id}', [PengajuanController::class, 'ditolakadmin']);
    Route::get('/userdetailadmin/{id}', [DashboardAdminController::class, 'userdetail']);
    Route::put('/diterimaadmin/{id}', [PengajuanController::class, 'diterimaadmin']);
    Route::put('/selesai', [PengajuanController::class, 'selesai']);

    Route::get('/pdfadmin', [DashboardAdminController::class, 'pdfadmin'])->name('pdfadmin');

    // Route Kirim Email 
    Route::post('/kirim-email', [PengajuanController::class, 'email']);
});


// Route Bidang
Route::middleware(['auth:bidang'])->group(function () {
    Route::get('/pengajuanbidang/{id}', [DashboardBidangController::class, 'pengajuan']);
    Route::get('/userdetailbidang/{id}', [DashboardBidangController::class, 'userdetail']);
    Route::put('/ditolakbidang/{id}', [PengajuanController::class, 'ditolakbidang']);
    Route::put('/diterimabidang/{id}', [PengajuanController::class, 'diterimabidang']);

    Route::get('/pdfbidang/{id}', [DashboardBidangController::class, 'pdfbidang'])->name('pdfbidang');
    Route::get('/magangbidang/{id}', [DashboardBidangController::class, 'magangbidang']);

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
