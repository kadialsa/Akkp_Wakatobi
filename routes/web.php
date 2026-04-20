<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\StrukturController;
use App\Http\Controllers\BeritaController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\SlidersController;
use App\Http\Controllers\ProdiController;
use App\Http\Controllers\AkreditasiController;
use App\Http\Controllers\ContactController;

use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| FRONTEND (PUBLIC)
|--------------------------------------------------------------------------
*/

// Route::get('/ekowisata', [EkowisataController::class, 'index'])->name('ekowisata.index');
// Route::get('/konservasi', [KonservasiController::class, 'index'])->name('konservasi.index');

// Halaman utama & statis
Route::get('/', [HomeController::class, 'index'])->name('home.index');
Route::get('/about', [AboutController::class, 'index'])->name('about.index');
Route::get('/struktur', [StrukturController::class, 'index'])->name('struktur.index');

// Berita publik
Route::get('/berita', [BeritaController::class, 'index'])->name('berita.index');
Route::get('/berita/{slug}', [BeritaController::class, 'show'])->name('berita.detail');

// Prodi publik
Route::get('/prodi/{slug}', [ProdiController::class, 'show'])->name('prodi.show');

// Contact publik
Route::get('/contact', [AdminController::class, 'contact'])->name('contact');
Route::post('/contact', [AdminController::class, 'contactStore'])->name('contact.store');

// video terkait
Route::get('/video', [AdminController::class, 'videoUser'])->name('video.user');

// akreditas
Route::get('/akreditasi', [AkreditasiController::class, 'publicIndex'])->name('akreditasi.public');


/*
|--------------------------------------------------------------------------
| ADMIN PANEL (WAJIB LOGIN)
|--------------------------------------------------------------------------
*/

Route::middleware(['authadmin'])->prefix('admin')->name('admin.')->group(function () {

    // Dashboard
    Route::get('/', [AdminController::class, 'index'])->name('index');

    // About/sambutan
    Route::get('/about', [AdminController::class, 'aboutEdit'])->name('about.edit');
    Route::put('/about/{id}', [AdminController::class, 'aboutUpdate'])->name('about.update');

    // Visimisi, sejarah, tupoksi, struktur
    Route::get('/visi-misi', [AdminController::class, 'visiMisiEdit'])->name('visimisi.edit');
    Route::put('/visi-misi', [AdminController::class, 'visiMisiUpdate'])->name('visimisi.update');

    Route::get('/sejarah', [AdminController::class, 'sejarahEdit'])->name('sejarah.edit');
    Route::put('/sejarah', [AdminController::class, 'sejarahUpdate'])->name('sejarah.update');

    Route::get('/tupoksi', [AdminController::class, 'tupoksiEdit'])->name('tupoksi.edit');
    Route::put('/tupoksi', [AdminController::class, 'tupoksiUpdate'])->name('tupoksi.update');

    Route::get('/struktur', [AdminController::class, 'strukturEdit'])->name('struktur.edit');
    Route::put('/struktur', [AdminController::class, 'strukturUpdate'])->name('struktur.update');

    // Sliders
    // Route::resource('slides', SlidersController::class);

    Route::get('/slides', [SlidersController::class, 'index'])->name('slides.index');
    Route::get('/slide/create', [SlidersController::class, 'create'])->name('slides.create');
    Route::post('/slide', [SlidersController::class, 'store'])->name('slides.store');
    Route::get('/slide/{slider}/edit', [SlidersController::class, 'edit'])->name('slides.edit');
    Route::put('/slide/{slider}', [SlidersController::class, 'update'])->name('slides.update');
    Route::delete('/slide/{slider}', [SlidersController::class, 'destroy'])->name('slides.destroy');

    // Cooperation / Kerjasama
    Route::get('/cooperations', [AdminController::class, 'coperation_index'])->name('cooperation.index');
    Route::get('/cooperation/create', [AdminController::class, 'cooperation_create'])->name('cooperation.create');
    Route::post('/cooperation', [AdminController::class, 'cooperation_store'])->name('cooperation.store');
    Route::get('/cooperation/{cooperation}/edit', [AdminController::class, 'cooperation_edit'])->name('cooperation.edit');
    Route::put('/cooperation/{cooperation}', [AdminController::class, 'cooperation_update'])->name('cooperation.update');
    Route::delete('/cooperation/{cooperation}', [AdminController::class, 'cooperation_destroy'])->name('cooperation.destroy');

    // leader / struktur organisasi
    Route::get('/leader/create/{section}', [AdminController::class, 'leader_create'])->name('leader.create');
    Route::post('/leader', [AdminController::class, 'leader_Store'])->name('leader.store');
    Route::get('/leader/{leader}/edit', [AdminController::class, 'leader_edit'])->name('leader.edit');
    Route::put('/leader/{leader}', [AdminController::class, 'leader_Update'])->name('leader.update');
    Route::delete('/leader/{leader}', [AdminController::class, 'leader_Destroy'])->name('leader.destroy');

    // Section / struktur organisasi
    Route::get('/sections', [AdminController::class, 'section_index'])->name('section.index');
    Route::get('/section/create', [AdminController::class, 'section_create'])->name('section.create');
    Route::post('/section', [AdminController::class, 'section_store'])->name('section.store');
    Route::get('/section/{section}/edit', [AdminController::class, 'section_edit'])->name('section.edit');
    Route::put('/section/{section}', [AdminController::class, 'section_update'])->name('section.update');
    Route::delete('/section/{section}', [AdminController::class, 'section_destroy'])->name('section.destroy');

    // Prodi (admin)
    Route::resource('prodi', ProdiController::class)->except(['show']);

    // Akreditasi
    Route::resource('akreditasi', AkreditasiController::class);

    // Berita admin
    Route::get('/berita', [AdminController::class, 'beritaIndex'])->name('berita.index');
    Route::get('/berita/create', [AdminController::class, 'beritaCreate'])->name('berita.create');
    Route::post('/berita/store', [AdminController::class, 'beritaStore'])->name('berita.store');
    Route::get('/berita/edit/{id}', [AdminController::class, 'beritaEdit'])->name('berita.edit');
    Route::put('/berita/update/{id}', [AdminController::class, 'beritaUpdate'])->name('berita.update');
    Route::delete('/berita/delete/{id}', [AdminController::class, 'beritaDestroy'])->name('berita.delete');
    Route::get('/berita/show/{id}', [AdminController::class, 'beritaShow'])->name('berita.show');

     Route::post('upload-ckeditor', [AdminController::class, 'uploadCkeditor'])
        ->name('upload.ckeditor');


    // Contact admin
    Route::get('/contact', [ContactController::class, 'contactIndex'])->name('contact.index');
    Route::get('/contact/{id}', [ContactController::class, 'contactShow'])->name('contact.show');
    Route::delete('/contact/{id}', [ContactController::class, 'contactDelete'])->name('contact.delete');

    // Kelola Admin
    Route::get('/users', [AdminUserController::class, 'index'])->name('users.index');
    Route::get('/users/create', [AdminUserController::class, 'create'])->name('users.create');
    Route::post('/users/store', [AdminUserController::class, 'store'])->name('users.store');
    Route::get('/users/{id}', [AdminUserController::class, 'show'])->name('users.show');
    Route::get('/users/edit/{id}', [AdminUserController::class, 'edit'])->name('users.edit');
    Route::put('/users/update/{id}', [AdminUserController::class, 'update'])->name('users.update');
    Route::delete('/users/{id}', [AdminUserController::class, 'destroy'])->name('users.delete');

    // videos

    Route::get('/video', [AdminController::class, 'videoIndex'])->name('video.index');
    Route::get('/video/create', [AdminController::class, 'videoCreate'])->name('video.create');
    Route::post('/video/store', [AdminController::class, 'videoStore'])->name('video.store');
    Route::get('/video/edit/{id}', [AdminController::class, 'videoEdit'])->name('video.edit');
    Route::post('/video/update/{id}', [AdminController::class, 'videoUpdate'])->name('video.update');
    Route::delete('/video/delete/{id}', [AdminController::class, 'videoDelete'])->name('video.delete');

    // Header Image
    Route::get('/header', [AdminController::class, 'headerEdit'])->name('header.edit');
    Route::post('/header', [AdminController::class, 'headerUpdate'])->name('header.update');
});

/*
|--------------------------------------------------------------------------
| PROFILE (BREEZE)
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


/*
|--------------------------------------------------------------------------
| AUTH ROUTES (LOGIN / REGISTER)
|--------------------------------------------------------------------------
*/

require __DIR__ . '/auth.php';
