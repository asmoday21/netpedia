<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\GuruController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\SiswaController as GeneralSiswaController;
use App\Http\Controllers\UserManagementController; // Ensure this class exists in the specified namespace
use App\Http\Controllers\ForgotPasswordController; // Ensure this class exists in the specified namespace
use App\Http\Controllers\SiswaDashboardController;
use App\Http\Controllers\ResetPasswordController; // Ensure this class exists in the specified namespace
use App\Http\Controllers\ExportController; // Ensure this class exists in the specified namespace
use App\Http\Controllers\RegisterController; // Ensure this class exists in the specified namespace
use App\Http\Controllers\LoginController; // Ensure this class exists in the specified namespace
use App\Http\Controllers\UserController; // Ensure this class exists in the specified namespace
use App\Http\Controllers\ModulController; // Ensure this class exists in the specified namespace
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\Siswa\SiswaMateriController;
use App\Http\Controllers\Siswa\SiswaTugasController;
use App\Http\Controllers\Siswa\SiswaUjianController;
use App\Http\Controllers\GuruTugasController;
use App\Http\Controllers\Guru\GuruMateriController;
use App\Http\Controllers\GuruSiswaController;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\QuizResultController; // Ensure this class exists in the specified namespace

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
    return view('homepage.master');
});

// Route::get('/admin/logout', [AdminController::class, 'destroy'])->name('admin.logout');
// Route::get('/admin/profile', [AdminController::class, 'profile'])->name('admin.profile');
// Route::get('/edit/profile', [AdminController::class, 'editprofile'])->name('edit.profile');

Route::controller(AdminController::class)->group(function(){
    Route::get('/admin/logout', 'destroy')->name('admin.logout');
    Route::get('/admin/profile','profile')->name('admin.profile');
    Route::get('/edit/profile', 'editprofile')->name('edit.profile');
    Route::post('/store/profile', 'storeprofile')->name('store.profile');
});

Route::prefix('admin')->name('admin.')->group(function() {
    Route::resource('users', \App\Http\Controllers\Admin\UserController::class);

    Route::get('/guru', [\App\Http\Controllers\Admin\UserController::class, 'guruIndex'])->name('guru.index');
    Route::get('/siswa', [\App\Http\Controllers\Admin\UserController::class, 'siswaIndex'])->name('siswa.index');


    // Rute untuk Halaman Kelas Siswa
    Route::get('/kelas/tjkt_1', [\App\Http\Controllers\Admin\KelasController::class, 'tjkt1'])->name('kelas.tjkt_1');
    Route::get('/kelas/tjkt_2', [\App\Http\Controllers\Admin\KelasController::class, 'tjkt2'])->name('kelas.tjkt_2');
    // Tambahkan rute untuk kelas lainnya di sini
});    



use App\Http\Controllers\Admin\KelasController;

Route::prefix('admin')->middleware(['auth'])->group(function () {
    Route::get('/kelas', [KelasController::class, 'index'])->name('admin.kelas.index');        // daftar kelas
    Route::get('/kelas/create', [KelasController::class, 'create'])->name('admin.kelas.create'); // form tambah kelas
    Route::post('/kelas', [KelasController::class, 'store'])->name('admin.kelas.store');         // simpan kelas baru
    Route::get('/kelas/{id}', [KelasController::class, 'show'])->name('admin.kelas.show');       // detail siswa per kelas
    Route::get('/kelas/{id}/edit', [KelasController::class, 'edit'])->name('admin.kelas.edit');  // form edit kelas
    Route::put('/kelas/{id}', [KelasController::class, 'update'])->name('admin.kelas.update');   // update kelas
    Route::delete('/kelas/{id}', [KelasController::class, 'destroy'])->name('admin.kelas.destroy'); // hapus kelas
});



Route::get('forgot-password', function () {
    return view('auth.forgot-password');
})->middleware('guest')->name('password.request');

Route::post('forgot-password', [\App\Http\Controllers\ForgotPasswordController::class, 'sendResetLinkEmail'])->middleware('guest')->name('password.email');

Route::get('reset-password/{token}', function ($token) {
    return view('auth.reset-password', ['token' => $token]);
})->middleware('guest')->name('password.reset');

Route::post('reset-password', [\App\Http\Controllers\ResetPasswordController::class, 'reset'])->middleware('guest')->name('password.update');


Route::get('forgot-password', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('forgot-password', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');

Route::get('reset-password/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('reset-password', [ResetPasswordController::class, 'reset'])->name('password.update');

Route::get('export-users', [ExportController::class, 'export'])->name('export.users');
Route::get('admin/filter', [AdminController::class, 'filter'])->name('admin.filter');

Route::get('/cp-atp', function () {
    return view('homepage.cp-atp');
})->name('cp-atp');

Route::get('/referensi', function () {
    return view('homepage.referensi');
})->name('referensi');

Route::get('/materi', function () {
    return view('homepage.materi');
})->name('materi');



Route::get('/dashboard', function () {
    return view('admin.index');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.admin_master');
});


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Authenticated user role-based redirect
Route::middleware(['auth'])->group(function () {
    Route::get('/redirect-by-role', function () {
        $role = auth()->user()->role;

        return match ($role) {
            'admin' => redirect()->route('admin.admin_master'),
            default => abort(403),
        };
    });

});

Route::get('/redirect-by-role', function () {
    $role = Auth::user()->role;

    if ($role === 'admin') {
        return redirect()->route('admin.admin_master');
    } elseif ($role === 'guru') {
        return redirect()->route('guru.guru_master');
    } elseif ($role === 'siswa') {
        return redirect()->route('siswa.siswa_master');
    }

    return abort(403, 'Unauthorized role.');
});

Route::get('/admin/dashboard', function () {
    return view('admin.index');
})->middleware(['auth'])->name('admin.admin_master');

Route::get('/guru/dashboard', function () {
    return view('guru.index');
})->middleware(['auth'])->name('guru.guru_master');

Route::get('/siswa/dashboard', function () {
    return view('siswa.index');
})->middleware(['auth'])->name('siswa.siswa_master');

Route::get('/home', function () {
    return view('homepage.master'); // buat view home.blade.php
})->middleware('auth');


Route::get('/guru/profile/edit', [GuruController::class, 'editProfile'])->name('guru.edit.profile');
Route::post('/guru/profile/store', [GuruController::class, 'storeProfile'])->name('guru.store.profile');

Route::get('/guru/profile', [GuruController::class, 'profile'])->name('guru.profile');
Route::get('/guru/profile/edit', [GuruController::class, 'editProfile'])->name('guru.edit.profile');
Route::post('/guru/profile/store', [GuruController::class, 'storeProfile'])->name('guru.store.profile');


Route::get('/guru/logout', [GuruController::class, 'logout'])->name('guru.logout');

// Halaman profil guru
Route::get('/guru/profile', [GuruController::class, 'Profile'])->name('guru.profile');

// Halaman edit profil
Route::get('/guru/edit/profile', [GuruController::class, 'EditProfile'])->name('guru.edit.profile');

// Simpan perubahan profil
Route::post('/guru/store/profile', [GuruController::class, 'StoreProfile'])->name('guru.store.profile');


Route::middleware(['auth'])->group(function () {
    // Halaman Profil Guru
    Route::get('/guru/profile', [GuruController::class, 'Profile'])->name('guru.profile');
    Route::get('/guru/profile/edit', [GuruController::class, 'EditProfile'])->name('guru.edit.profile');
    Route::post('/guru/profile/store', [GuruController::class, 'StoreProfile'])->name('guru.store.profile');

    // Halaman Daftar Siswa untuk Guru
    Route::get('/guru/siswa', [GuruController::class, 'index'])->name('guru.siswa.index');
});

Route::get('/guru/logout', [GuruController::class, 'logout'])->name('guru.logout');

Route::prefix('guru')->middleware(['auth'])->group(function () {
    // Menampilkan daftar siswa
    Route::get('/siswa', [GuruController::class, 'siswaIndex'])->name('guru.siswa.index');

    // Menampilkan form untuk menambah siswa
    Route::get('/siswa/create', [GuruController::class, 'siswaCreate'])->name('guru.siswa.create');

    // Menyimpan data siswa
    Route::post('/siswa', [GuruController::class, 'siswaStore'])->name('guru.siswa.store');

    // Menampilkan form untuk mengedit siswa
    Route::get('/siswa/{id}/edit', [GuruController::class, 'siswaEdit'])->name('guru.siswa.edit');

    // Menghapus siswa
    Route::delete('/siswa/{id}', [GuruController::class, 'siswaDestroy'])->name('guru.siswa.destroy');

    // Route untuk memperbarui data siswa
    Route::put('/siswa/{id}', [GuruController::class, 'siswaUpdate'])->name('guru.siswa.update');
    
});




Route::prefix('guru')->middleware('auth')->group(function () {
    
    // Materi
    Route::get('/materi', [GuruController::class, 'unggahMateriForm'])->name('guru.materi.index');
    Route::post('/materi', [GuruController::class, 'unggahMateri'])->name('guru.materi.upload');
    
Route::prefix('guru')->middleware(['auth', 'role:guru'])->group(function () {
    Route::get('/materi', [GuruMateriController::class, 'index'])->name('guru.materi.index');
    Route::post('/materi', [GuruMateriController::class, 'store'])->name('guru.materi.store');

    Route::get('/materi/{id}/edit', [GuruMateriController::class, 'edit'])->name('guru.materi.edit');
    Route::put('/materi/{id}', [GuruMateriController::class, 'update'])->name('guru.materi.update');
    Route::get('/materi/create', [GuruMateriController::class, 'create'])->name('guru.materi.create');
    Route::get('/materi/{id}', [GuruMateriController::class, 'show'])->name('guru.materi.show');
    Route::delete('/materi/{id}', [GuruMateriController::class, 'destroy'])->name('guru.materi.destroy');
    

});


    
    // Laporan
    Route::get('/laporan', [GuruController::class, 'laporanNilai'])->name('guru.laporan.index');
    Route::get('/laporan/export', [GuruController::class, 'exportLaporan'])->name('guru.laporan.export');
    Route::get('/guru/laporan-nilai', [GuruController::class, 'laporanNilai'])->name('guru.laporan.nilai');
    Route::get('/guru/laporan-nilai/generate', [GuruController::class, 'generate'])->name('guru.laporan.generate');



Route::prefix('guru/guru/laporan-nilai')->middleware(['auth', 'role:guru'])->group(function () {
    Route::get('/', [GuruController::class, 'laporanNilai'])->name('guru.laporan.index');
    Route::post('/generate', [GuruController::class, 'generate'])->name('guru.laporan.generate'); // <- tambahkan ini
});


    
    // Tugas - pakai resource route + custom name
    Route::resource('tugas', GuruController::class)->names([
        'index'   => 'guru.tugas.index',
        'create'  => 'guru.tugas.create',
        'store'   => 'guru.tugas.store',
        'edit'    => 'guru.tugas.edit',
        'update'  => 'guru.tugas.update',
        'destroy' => 'guru.tugas.destroy',
        'show'    => 'guru.tugas.show', // opsional, kalau dipakai
    ])->except(['show']); // hilangkan jika tidak pakai show
});

Route::prefix('guru')->middleware(['auth'])->group(function () {
    Route::post('/guru/materi/upload', [App\Http\Controllers\GuruController::class, 'uploadMateri'])->name('guru.materi.upload');


    Route::get('tugas/{id}/jawaban', [GuruTugasController::class, 'lihatJawaban'])->name('guru.tugas.jawaban');
    Route::post('tugas/jawaban/{id}/nilai', [GuruTugasController::class, 'beriNilai'])->name('guru.tugas.berinilai');

    Route::post('/guru/tugas/sort', [GuruTugasController::class, 'sort'])->name('guru.tugas.sort');


});



use App\Http\Controllers\Guru\TugasController;

Route::prefix('guru')->middleware('auth')->group(function () {
    // Tugas
    Route::get('/tugas', [TugasController::class, 'index'])->name('guru.tugas.index');
    Route::get('/tugas/create', [TugasController::class, 'create'])->name('guru.tugas.create');
    Route::post('/tugas', [TugasController::class, 'store'])->name('guru.tugas.store');
    Route::get('/tugas/{id}/edit', [TugasController::class, 'edit'])->name('guru.tugas.edit');
    Route::put('/tugas/{id}', [TugasController::class, 'update'])->name('guru.tugas.update');
    Route::delete('/tugas/{id}', [TugasController::class, 'destroy'])->name('guru.tugas.destroy');
    Route::get('guru/nilai', [App\Http\Controllers\Guru\TugasController::class, 'indexNilai'])->name('guru.nilai.index');


});

use App\Http\Controllers\Guru\NilaiImportController;

Route::prefix('guru')->middleware(['auth', 'role:guru'])->group(function () {
    Route::get('/nilai', [NilaiImportController::class, 'index'])->name('guru.nilai.index');
    Route::get('/upload-nilai', [NilaiImportController::class, 'form'])->name('guru.nilai.upload');
    Route::post('/upload-nilai', [NilaiImportController::class, 'import'])->name('guru.nilai.import');
    Route::delete('/guru/nilai/{id}', [NilaiImportController::class, 'destroy'])->name('guru.nilai.destroy');
});

Route::prefix('siswa')->middleware(['auth', 'role:siswa'])->group(function () {
    Route::get('/nilai', [\App\Http\Controllers\Siswa\NilaiController::class, 'index'])->name('siswa.nilai.index');
});



Route::prefix('guru')->name('guru.')->group(function () {
    Route::get('tugas', [GuruTugasController::class, 'index'])->name('tugas.index'); // load page blade
    Route::get('tugas/data', [GuruTugasController::class, 'getData'])->name('tugas.data'); // load data JSON AJAX
    Route::post('tugas/sort', [GuruTugasController::class, 'sort'])->name('tugas.sort'); // sorting update
    // routes lain buat create, store, edit, update, destroy seperti biasa
});

// Guru
Route::prefix('guru/tugas')->middleware('auth:guru')->group(function () {
    Route::get('{id}/pengumpulan', [TugasController::class, 'showPengumpulan'])->name('guru.tugas.pengumpulan');
    Route::post('nilai/{id}', [TugasController::class, 'nilai'])->name('guru.tugas.nilai');
});

// Siswa
Route::post('siswa/tugas/{id}/upload', [SiswaTugasController::class, 'uploadJawaban'])->name('siswa.tugas.upload');
Route::get('siswa/tugas', [SiswaTugasController::class, 'index'])->name('siswa.tugas.index');
Route::get('siswa/tugas/{id}', [SiswaTugasController::class, 'show'])->name('siswa.tugas.show');
Route::post('siswa/tugas/{id}/upload', [SiswaTugasController::class, 'upload'])->name('siswa.tugas.upload');

// Siswa
Route::prefix('siswa')->middleware(['auth', 'role:siswa'])->group(function () {
    Route::get('/tugas', [SiswaTugasController::class, 'index'])->name('siswa.tugas.index');
    Route::get('/tugas/{id}', [SiswaTugasController::class, 'show'])->name('siswa.tugas.show');
    Route::post('/tugas/{id}/submit', [SiswaTugasController::class, 'submit'])->name('siswa.tugas.submit');
});



use App\Http\Controllers\Guru\MateriController;
use App\Http\Controllers\UjianController;
use App\Http\Controllers\GuruUjianController;

Route::prefix('guru')->middleware('auth')->group(function () {
    // Materi
    Route::get('/materi', [MateriController::class, 'index'])->name('guru.materi.index');
    Route::post('/materi', [MateriController::class, 'upload'])->name('guru.materi.upload');
});





Route::middleware(['auth'])->group(function () {
    Route::get('/siswa/profile', [SiswaController::class, 'Profile'])->name('siswa.profile');
    Route::get('/siswa/logout', [SiswaController::class, 'Logout'])->name('siswa.logout');
    Route::get('/siswa/profile', [SiswaController::class, 'Profile'])->name('siswa.profile');
    Route::post('/siswa/profile/store', [SiswaController::class, 'StoreProfile'])->name('siswa.store.profile');
    
});



Route::prefix('siswa')->middleware(['auth', 'role:siswa'])->group(function () {
    Route::get('/profile', [SiswaController::class, 'profile'])->name('siswa.profile');
    Route::get('/profile/edit', [SiswaController::class, 'editProfile'])->name('siswa.siswa_edit_profile');
    Route::post('/profile/store', [SiswaController::class, 'storeProfile'])->name('siswa.store_profile');
});


Route::prefix('guru')->name('guru.')->middleware(['auth', 'role:guru'])->group(function () {
    Route::resource('tugas', GuruTugasController::class);
});
Route::prefix('guru')->middleware(['auth', 'role:guru'])->group(function() {
    Route::resource('tugas', GuruTugasController::class);
});

Route::prefix('guru/tugas')->middleware(['auth', 'role:guru'])->group(function () {
    Route::get('/', [GuruTugasController::class, 'index'])->name('guru.tugas.index');
    Route::get('/create', [GuruTugasController::class, 'create'])->name('guru.tugas.create');
    Route::post('/store', [GuruTugasController::class, 'store'])->name('guru.tugas.store');
    Route::get('/{id}', [GuruTugasController::class, 'show'])->name('guru.tugas.show');
    Route::delete('/{id}', [GuruTugasController::class, 'destroy'])->name('guru.tugas.destroy');
});


Route::get('/guru/siswa/create', [GuruSiswaController::class, 'create'])->name('guru.siswa.create');

Route::post('/siswa/update-profile', [SiswaController::class, 'storeProfile'])->name('siswa.store.profile');

Route::get('/siswa/edit-profile', [SiswaController::class, 'editProfile'])->name('siswa.edit.profile');


Route::middleware(['auth'])->group(function () {
    // Tampilkan form edit profil siswa
    Route::get('/siswa/edit-profile', [SiswaController::class, 'editProfile'])->name('siswa.edit.profile');

    // Simpan perubahan profil siswa
    Route::post('/siswa/store-profile', [SiswaController::class, 'storeProfile'])->name('siswa.store.profile');

    // Logout siswa
    Route::post('/siswa/logout', [SiswaController::class, 'logout'])->name('siswa.logout');

    Route::get('/siswa/profile', [SiswaController::class, 'editProfile'])->name('siswa.profile');
    Route::get('/siswa/profile', [SiswaController::class, 'viewProfile'])->name('siswa.siswa_profile');
    Route::get('/siswa/profile/edit', [SiswaController::class, 'editProfile'])->name('siswa.siswa_edit_profile');


});

Route::prefix('guru')->middleware(['auth', 'role:guru'])->group(function () {
    Route::get('/siswa', [App\Http\Controllers\Guru\SiswaController::class, 'index'])->name('guru.siswa.index');
    Route::get('/siswa/create', [App\Http\Controllers\Guru\SiswaController::class, 'create'])->name('guru.siswa.create');
    Route::post('/siswa', [App\Http\Controllers\Guru\SiswaController::class, 'store'])->name('guru.siswa.store');
    Route::get('siswa/{id}', [App\Http\Controllers\Guru\SiswaController::class, 'show'])->name('guru.siswa.show');
});
// Route untuk Guru - Manajemen Siswa
Route::prefix('guru/siswa')->name('guru.siswa.')->group(function () {
    Route::get('/', [SiswaController::class, 'index'])->name('index');
    Route::get('/create', [SiswaController::class, 'create'])->name('create');
    Route::post('/', [SiswaController::class, 'store'])->name('store');
    Route::get('/{id}/edit', [SiswaController::class, 'edit'])->name('edit');
    Route::put('/{id}', [SiswaController::class, 'update'])->name('update');
    Route::delete('/{id}', [SiswaController::class, 'destroy'])->name('destroy');
});

Route::get('/siswa/daftar-siswa', [SiswaController::class, 'semuaSiswa'])->name('siswa.semua_siswa');

Route::get('/siswa/daftar-siswa', [SiswaController::class, 'semuaSiswa'])->name('siswa.semua_siswa');



Route::prefix('guru')->middleware(['auth', 'role:guru'])->group(function () {
    Route::get('/siswa', [GuruSiswaController::class, 'index'])->name('guru.siswa.index');
    Route::get('/siswa/create', [GuruSiswaController::class, 'create'])->name('guru.siswa.create');
    Route::post('/siswa', [GuruSiswaController::class, 'store'])->name('guru.siswa.store');
    Route::get('/siswa/{id}/edit', [GuruSiswaController::class, 'edit'])->name('guru.siswa.edit');
    Route::put('/siswa/{id}', [GuruSiswaController::class, 'update'])->name('guru.siswa.update');
    Route::delete('/siswa/{id}', [GuruSiswaController::class, 'destroy'])->name('guru.siswa.destroy');
});


Route::post('/ckeditor/upload', [App\Http\Controllers\CKEditorController::class, 'upload'])->name('ckeditor.upload');
Route::post('/summernote/upload', [App\Http\Controllers\SummernoteController::class, 'upload'])->name('summernote.upload');


use App\Http\Controllers\Admin\ModulController as AdminModulController;
use App\Http\Controllers\Guru\ModulController as GuruModulController;
use App\Http\Controllers\Siswa\ModulController as SiswaModulController;

// ADMIN ROUTES
    Route::prefix('admin')->name('admin.')->middleware('role:admin')->group(function () {
        Route::resource('modul', AdminModulController::class);
        // resource/controller admin lain
    });

    // GURU ROUTES
    Route::prefix('guru')->name('guru.')->middleware('role:guru')->group(function () {
        Route::resource('modul', GuruModulController::class);
        // resource/controller guru lain
    });

    // SISWA ROUTES (batasi hanya index & show)
    Route::prefix('siswa')->name('siswa.')->middleware('role:siswa')->group(function () {
        Route::get('modul', [SiswaModulController::class, 'index'])->name('modul.index');
        Route::get('modul/{modul}', [SiswaModulController::class, 'show'])->name('modul.show');
    });



use App\Http\Controllers\Admin\QuizController as AdminQuizController;
use App\Http\Controllers\Guru\QuizController as GuruQuizController;
use App\Http\Controllers\Siswa\QuizController as SiswaQuizController;

// Middleware dan prefix sesuai role (contoh memakai middleware auth dan role)
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function() {
    Route::resource('quiz', AdminQuizController::class);
    // route admin lain bisa ditambahkan di sini
});

Route::middleware(['auth', 'role:guru'])->prefix('guru')->name('guru.')->group(function() {
    Route::resource('quiz', GuruQuizController::class);
    Route::delete('/guru/quiz/{id}', [GuruQuizController::class, 'destroy'])->name('guru.quiz.destroy');

    // route guru lain bisa ditambahkan di sini
});

Route::middleware(['auth', 'role:siswa'])->prefix('siswa')->name('siswa.')->group(function() {
    Route::resource('quiz', SiswaQuizController::class)->only(['index', 'show']);
    // siswa biasanya cuma lihat quiz, jadi cukup index dan show
});


// use App\Http\Controllers\Guru\NilaiController as GuruNilaiController; // Alias untuk controller guru

// Route::prefix('guru')->name('guru.')->middleware(['auth', 'role:guru'])->group(function () {
//     Route::get('nilai', [GuruNilaiController::class, 'index'])->name('nilai.index');
//     Route::get('nilai/upload', [GuruNilaiController::class, 'showUploadForm'])->name('nilai.upload');
//     Route::post('nilai/upload', [GuruNilaiController::class, 'upload'])->name('nilai.upload');
//     Route::delete('/guru/nilai/{id}', [GuruNilaiController::class, 'destroy'])->name('nilai.destroy');

// });


Route::get('/guru/materi', [GuruMateriController::class, 'index'])->name('guru.materi.index');

Route::get('/guru/materi/{id}', [GuruMateriController::class, 'show'])->name('guru.materi.show');



Route::prefix('siswa')->middleware(['auth', 'role:siswa'])->group(function () {

    // Materi
    Route::get('/materi', [App\Http\Controllers\Siswa\SiswaMateriController::class, 'index'])->name('siswa.materi.index');
    Route::get('/materi/{id}', [App\Http\Controllers\Siswa\SiswaMateriController::class, 'show'])->name('siswa.materi.show');


    // Daftar tugas
    Route::get('/tugas', [SiswaTugasController::class, 'index'])->name('siswa.tugas.index');

    // Detail tugas & status pengumpulan
    Route::get('/tugas/{id}', [SiswaTugasController::class, 'show'])->name('siswa.tugas.show');

    // Form upload jawaban (create & edit disatukan)
    Route::get('/tugas/{id}/create', [SiswaTugasController::class, 'formJawaban'])->name('siswa.tugas.create');
    Route::get('/tugas/{id}/edit', [SiswaTugasController::class, 'formJawaban'])->name('siswa.tugas.edit');

    // Kirim jawaban (upload multiple file)
    Route::get('/tugas/{id}/kirim', [SiswaTugasController::class, 'kirimJawaban'])->name('siswa.tugas.formJawaban');});
    Route::post('tugas/{id}/kirim', [SiswaTugasController::class, 'kirimJawaban'])->name('siswa.tugas.kirimJawaban');
    Route::delete('/siswa/tugas/file/{fileId}', [SiswaTugasController::class, 'hapusFileJawaban'])->name('siswa.tugas.file.hapus');

Route::get('/nilai', [SiswaController::class, 'nilaiSiswa'])->name('siswa.nilai');


// routes/web.php
Route::prefix('guru')->middleware(['auth', 'role:guru'])->group(function () {
    // Materi Routes
    Route::resource('materi', \App\Http\Controllers\Guru\MateriController::class);
    
    // Upload gambar untuk editor
    Route::post('upload/image', function(Request $request) {
        if ($request->hasFile('file')) {
            $path = $request->file('file')->store('editor_images', 'public');
            return response()->json([
                'location' => asset('storage/' . $path)
            ]);
        }
    })->name('guru.upload.image');
});


use App\Http\Controllers\Guru\MateriTetapController;

Route::get('tcp-ip', [MateriTetapController::class, 'tcpIp'])->name('guru.materi.tcp_ip');
Route::get('layanan-jaringan', [MateriTetapController::class, 'layananJaringan'])->name('guru.materi.layanan_jaringan');
Route::get('keamanan-jaringan', [MateriTetapController::class, 'keamananJaringan'])->name('guru.materi.keamanan_jaringan');
Route::get('seluler', [MateriTetapController::class, 'seluler'])->name('guru.materi.seluler');
Route::get('optik', [MateriTetapController::class, 'optik'])->name('guru.materi.optik');


use App\Http\Controllers\Siswa\MateriTetapController as SiswaMateriTetapController;
Route::get('siswa/tcp-ip', [SiswaMateriTetapController::class, 'tcpIp'])->name('siswa.materi.tcp_ip');
Route::get('siswa/layanan-jaringan', [SiswaMateriTetapController::class, 'layananJaringan'])->name('siswa.materi.layanan_jaringan');
Route::get('siswa/keamanan-jaringan', [SiswaMateriTetapController::class, 'keamananJaringan'])->name('siswa.materi.keamanan_jaringan');
Route::get('siswa/seluler', [SiswaMateriTetapController::class, 'seluler'])->name('siswa.materi.seluler');
Route::get('siswa/optik', [SiswaMateriTetapController::class, 'optik'])->name('siswa.materi.optik');

require __DIR__.'/auth.php';
