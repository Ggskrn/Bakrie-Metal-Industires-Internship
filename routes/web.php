<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\GoogleController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboard;
use App\Http\Controllers\Kepala\DashboardController as KepalaDashboard;
use App\Http\Controllers\AnnouncementController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/


// Halaman Utama
Route::get('/', function () {
    $kontenBeranda = \App\Models\ProdukLayananKonten::where('slug', 'beranda')->first();
    $kontenAnggota = \App\Models\ProdukLayananKonten::where('slug', 'jumlah_anggota')->first();
    $dbMemberCount = \App\Models\User::where('role', 'public')->count();
    $totalAnggota = ($kontenAnggota ? (int)$kontenAnggota->description : 1200) + $dbMemberCount;
    return view('home', compact('kontenBeranda', 'totalAnggota'));
})->name('home');

Route::get('/produk', function () {
    return redirect()->route('products.sembako');
})->name('products');

Route::get('/tentang', function () {
    $kontenTentang = \App\Models\ProdukLayananKonten::where('slug', 'tentang')->first();
    return view('about', compact('kontenTentang'));
})->name('about');

Route::get('/berita', function () {
    return view('news');
})->name('news');

Route::get('/kontak', function () {
    $kontenHubungi = \App\Models\ProdukLayananKonten::where('slug', 'hubungi_kami')->first();
    return view('contact', compact('kontenHubungi'));
})->name('contact');

Route::get('/proyek', function () {
    return view('projects');
})->name('projects');

// ========== PRODUK ==========
Route::prefix('produk')->group(function () {
    Route::get('/sembako', function () {
        $products = [
            [
                'name' => 'Beras Premium',
                'image' => 'product-beras.jpeg',
                'desc' => 'Beras kualitas super, pulen, kemasan 5kg dan 10kg.',
                'details' => ['5kg: Rp 65.000', '10kg: Rp 125.000', 'Asli dari petani lokal']
            ],
            [
                'name' => 'Minyak Goreng',
                'image' => 'product-minyak.jpg',
                'desc' => 'Minyak goreng berkualitas, kemasan 1L and 2L.',
                'details' => ['1L: Rp 18.000', '2L: Rp 35.000', 'Bebas kolesterol']
            ],
            [
                'name' => 'Gula Pasir',
                'image' => 'product-gula.jpg',
                'desc' => 'Gula pasir putih berkualitas, kemasan 1kg.',
                'details' => ['1kg: Rp 17.000', 'Bersih dan manis']
            ],
            [
                'name' => 'Telur Ayam',
                'image' => 'product-telur.JPEG',
                'desc' => 'Telur ayam segar, kemasan 1 tray (30 butir).',
                'details' => ['1 tray: Rp 55.000', 'Segar dari peternak lokal']
            ],
            [
                'name' => 'Tepung Terigu',
                'image' => 'product-terigu.jpg',
                'desc' => 'Tepung terigu serbaguna, kemasan 1kg.',
                'details' => ['1kg: Rp 12.000', 'Untuk roti, kue, dan gorengan']
            ],
            [
                'name' => 'Susu Kental Manis',
                'image' => 'product-susu.JPEG',
                'desc' => 'Susu kental manis kemasan 380ml.',
                'details' => ['380ml: Rp 15.000', 'Manis dan bergizi']
            ]
        ];
        return view('products.sembako', compact('products'));
    })->name('products.sembako');

    Route::get('/logistik', function () {
        return view('products.logistik');
    })->name('products.logistik');

    Route::get('/agrobisnis', function () {
        return view('products.agrobisnis');
    })->name('products.agrobisnis');
});

// ========== LAYANAN ==========
Route::get('/layanan', function () {
    return view('services');
})->name('services');

Route::prefix('layanan')->group(function () {
    Route::get('/simpan-pinjam', function () {
        return view('services.simpan-pinjam');
    })->name('services.simpanpinjam');
    

    Route::get('/kemitraan', function () {
        return view('services.kemitraan');
    })->name('services.kemitraan');

    Route::get('/konsultasi', function () {
        return view('services.konsultasi');
    })->name('services.konsultasi');

    Route::get('/pelayanan-anggota', function () {
        return view('services.pelayanan');
    })->name('services.pelayanan');

    Route::get('/pemasaran', function () {
        return view('services.pemasaran');
    })->name('services.pemasaran');

    Route::get('/pelatihan', function () {
        return view('services.pelatihan');
    })->name('services.pelatihan');
});



// Authentication Routes
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Public Dashboard Route
Route::middleware(['auth', 'role:public'])->group(function () {
    Route::get('/dashboard', function () {
        return view('public.dashboard');
    })->name('public.dashboard');
});

// Admin routes
Route::middleware(['auth', 'role:admin'])->prefix('admin')->group(function () {
    Route::get('/dashboard', [AdminDashboard::class, 'index'])->name('admin.dashboard');
    
    // Kelola Stok Sembako
    Route::post('/stok', [App\Http\Controllers\Admin\StokController::class, 'store'])->name('admin.stok.store');
    Route::put('/stok/{id}', [App\Http\Controllers\Admin\StokController::class, 'update'])->name('admin.stok.update');
    Route::delete('/stok/{id}', [App\Http\Controllers\Admin\StokController::class, 'destroy'])->name('admin.stok.destroy');
    
    // Kelola Berita
    Route::post('/berita', [App\Http\Controllers\Admin\BeritaController::class, 'store'])->name('admin.berita.store');
    Route::put('/berita/{id}', [App\Http\Controllers\Admin\BeritaController::class, 'update'])->name('admin.berita.update');
    Route::delete('/berita/{id}', [App\Http\Controllers\Admin\BeritaController::class, 'destroy'])->name('admin.berita.destroy');

    // Balas Catatan Kepala
    Route::post('/reply-kepala/{id}', [AdminDashboard::class, 'replyAnnouncement'])->name('admin.reply.kepala');

    Route::post('/whatsapp/reply/{id}', [AdminDashboard::class, 'replyWhatsApp'])->name('admin.whatsapp.reply');

    // Kelola Minat Kategori (Admin)
    Route::post('/minat/update', [AdminDashboard::class, 'updateMinat'])->name('admin.minat.update');

    // Kelola Konten Produk & Layanan (Admin)
    Route::post('/konten/update/{slug}', [AdminDashboard::class, 'updateKonten'])->name('admin.konten.update');
});

// Kepala routes
Route::middleware(['auth', 'role:kepala'])->prefix('kepala')->group(function () {
    Route::get('/dashboard', [KepalaDashboard::class, 'index'])->name('kepala.dashboard');
    Route::post('/announce', [AnnouncementController::class, 'store'])->name('kepala.announce');

    // Approval Sembako
    Route::post('/stok/approve/{id}', [KepalaDashboard::class, 'approveStok'])->name('kepala.stok.approve');
    Route::post('/stok/reject/{id}', [KepalaDashboard::class, 'rejectStok'])->name('kepala.stok.reject');

    // Approval Berita
    Route::post('/berita/approve/{id}', [KepalaDashboard::class, 'approveBerita'])->name('kepala.berita.approve');
    Route::post('/berita/reject/{id}', [KepalaDashboard::class, 'rejectBerita'])->name('kepala.berita.reject');

    // Approval Minat (Kepala)
    Route::post('/minat/approve/{id}', [KepalaDashboard::class, 'approveMinat'])->name('kepala.minat.approve');
    Route::post('/minat/reject/{id}', [KepalaDashboard::class, 'rejectMinat'])->name('kepala.minat.reject');

    // Approval Konten (Kepala)
    Route::post('/konten/approve/{id}', [KepalaDashboard::class, 'approveKonten'])->name('kepala.konten.approve');
    Route::post('/konten/reject/{id}', [KepalaDashboard::class, 'rejectKonten'])->name('kepala.konten.reject');
});
