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
Route::get('/marimagang/forms', [FormsController::class, 'form'])->name('forms');

// Route Post Register
Route::post('/marimagang/register', [RegisterController::class, 'store'])->name('register.submit');

// Route Post Login
Route::post('/marimagang/login', [LoginController::class, 'authenticate'])->name('login.submit');

// Notifikasi
Route::get('/marimagang/notif', [NotifikasiController::class, 'notif']);

// Route Logout
Route::get('/marimagang/logout', [LoginController::class, 'logout']);

// Route Detail (Home)
Route::get('/marimagang/homedetail/{id}', [HomeController::class, 'detail']);

// Email Verifikasi Mahasiswa
Route::get('/marimagang/verification/{user}', [MahasiswaController::class, 'verify'])->name('verify');

// Route Mahasiswa
Route::middleware(['auth:web'])->group(function () {
    Route::get('/marimagang/pengajuan/{id}', [DashboardMahasiswaController::class, 'pengajuan']);
    Route::get('/marimagang/anggota/{id}', [DashboardMahasiswaController::class, 'anggota']);
    Route::get('/marimagang/logbook/{id}', [DashboardMahasiswaController::class, 'logbook']);
    Route::post('/marimagang/logbook/store/{id}', [PengajuanController::class, 'logbook'])->name('logbook.store');
    Route::put('/marimagang/kesbangpol', [PengajuanController::class, 'kesbangpol'])->name('kesbangpol.submit');
    Route::put('/marimagang/laporan', [PengajuanController::class, 'laporan'])->name('laporan.submit');

    Route::get('/marimagang/mahasiswa/{id}', [DashboardMahasiswaController::class, 'index'])->name('mahasiswa');
    Route::post('/marimagang/profil/submit/{id}', [MahasiswaController::class, 'store'])->name('mahasiswa.submit');
    Route::put('/marimagang/mahasiswaupdate/{id}', [MahasiswaController::class, 'update']);

    Route::post('/marimagang/pengajuan-submite/submite', [PengajuanController::class, 'store'])->name('pengajuan.submit');
    Route::get('/marimagang/pengajuan/pilihan-skill/{databidang_id}', [DashboardMahasiswaController::class, 'select_skill']);

    Route::post('/marimagang/tambahanggota', [PengajuanController::class, 'tambahanggota'])->name('tambah.anggota');
    Route::put('/marimagang/editanggota/{id}', [PengajuanController::class, 'editanggota'])->name('edit.anggota');
    Route::delete('/marimagang/hapusanggota/{id}', [PengajuanController::class, 'deleteanggota'])->name('delete.anggota');
});

// Route Admin
Route::middleware(['auth:admin'])->group(function () {
    Route::get('/marimagang/dashboardadmin', [DashboardAdminController::class, 'index']);

    Route::get('/marimagang/admin', [DashboardAdminController::class, 'admin']);
    Route::post('/marimagang/adminpost', [AdminController::class, 'store'])->name('adminpost');
    Route::put('/marimagang/adminupdate/{id}', [AdminController::class, 'update']);
    Route::get('/marimagang/admindelete/{id}', [AdminController::class, 'delete']);

    Route::get('/marimagang/block/{id}', [MahasiswaController::class, 'block'])->name('mahasiswa.block');
    Route::get('/marimagang/verify/{id}', [MahasiswaController::class, 'verifyAdmin'])->name('mahasiswa.verify');

    Route::get('/marimagang/user', [DashboardAdminController::class, 'user']);
    Route::get('/marimagang/detail/{id}', [DashboardAdminController::class, 'detail'])->name('dashboard.detail');

    // Route Pengajuan
    Route::get('/marimagang/pengajuan/update-skill/{databidang_id}', [DashboardAdminController::class, 'select_skill']);

    // Route Dashboard Admin
    Route::get('/marimagang/pengajuanadmin', [DashboardAdminController::class, 'pengajuan']);
    Route::get('/marimagang/pengajuanditeruskan', [DashboardAdminController::class, 'diteruskan']);
    Route::get('/marimagang/pengajuanaccadmin', [DashboardAdminController::class, 'konfirmasi']);
    Route::get('/marimagang/magang', [DashboardAdminController::class, 'magang']);
    Route::put('/marimagang/diteruskan/{id}', [PengajuanController::class, 'updatebidang']);
    Route::put('/marimagang/ditolakadmin/{id}', [PengajuanController::class, 'ditolakadmin']);
    Route::get('/marimagang/userdetailadmin/{id}', [DashboardAdminController::class, 'userdetail']);
    Route::put('/marimagang/diterimaadmin/{id}', [PengajuanController::class, 'diterimaadmin']);
    Route::put('/marimagang/selesai', [PengajuanController::class, 'selesai']);

    Route::get('/marimagang/pdfadmin', [DashboardAdminController::class, 'pdfadmin'])->name('pdfadmin');

    // Route Kirim Email 
    Route::post('/marimagang/kirim-email', [PengajuanController::class, 'email']);
});


// Route Bidang
Route::middleware(['auth:bidang'])->group(function () {
    Route::get('/marimagang/pengajuanbidang/{id}', [DashboardBidangController::class, 'pengajuan']);
    Route::get('/marimagang/userdetailbidang/{id}', [DashboardBidangController::class, 'userdetail']);
    Route::put('/marimagang/ditolakbidang/{id}', [PengajuanController::class, 'ditolakbidang']);
    Route::put('/marimagang/diterimabidang/{id}', [PengajuanController::class, 'diterimabidang']);

    Route::get('/marimagang/pdfbidang/{id}', [DashboardBidangController::class, 'pdfbidang'])->name('pdfbidang');
    Route::get('/marimagang/magangbidang/{id}', [DashboardBidangController::class, 'magangbidang']);

    Route::get('marimagang/dashboardbidang/{id}', [DashboardBidangController::class, 'index'])->name('dashboard.bidang');

    // Route Akun Bidang (CRUD Akun Bidang)
    Route::get('/marimagang/bidang/{id}', [DashboardBidangController::class, 'bidang']);
    Route::post('/marimagang/bidangpost', [BidangController::class, 'store'])->name('bidangpost');
    Route::put('/marimagang/bidangupdate/{id}', [BidangController::class, 'update']);
    Route::get('/marimagang/bidangdelete/{id}', [BidangController::class, 'delete']);

    // Route Data Bidang
    Route::get('/marimagang/databidang/{id}', [DashboardBidangController::class, 'databidang']);
    Route::post('/marimagang/databidang/submit', [DataBidangController::class, 'store'])->name('databidang.submit');
    Route::get('/marimagang/databidangdelete/{id}', [DataBidangController::class, 'delete'])->name('databidangdelete');
    Route::get('/marimagang/open/{id}', [DataBidangController::class, 'open']);
    Route::get('/marimagang/close/{id}', [DataBidangController::class, 'close'])->name('bidang.close');
    Route::get('/marimagang/detail/{id}', [DashboardBidangController::class, 'detail'])->name('dashboard.detail');
});
