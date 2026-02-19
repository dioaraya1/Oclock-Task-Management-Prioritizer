<?php
// views/pages/home.php
$pageTitle = 'Beranda';
require_once __DIR__ . '/../partials/header.php';
?>

<!-- Hero Section -->
<div class="bg-gradient-to-br from-primary-50 via-blue-50 to-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20">
        <div class="text-center max-w-3xl mx-auto">
            
            <!-- Badge -->
            <div class="inline-flex items-center gap-2 px-4 py-2 bg-primary-100 text-primary-700 rounded-full text-sm font-medium mb-6">
                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                </svg>
                Prioritas Otomatis dengan AI
            </div>
            
            <!-- Heading -->
            <h1 class="text-5xl font-bold text-gray-900 mb-6 leading-tight">
                Kelola Tugas dengan
                <span class="text-primary-600">Prioritas Cerdas</span>
            </h1>
            
            <p class="text-xl text-gray-600 mb-8 leading-relaxed">
                OClock menggunakan <strong>K-Means Clustering</strong> untuk menghitung prioritas tugas secara otomatis berdasarkan deadline, tingkat kesulitan, estimasi waktu, dan kepentingan.
            </p>
            
            <!-- CTA Buttons -->
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="<?= url('register') ?>" class="px-8 py-3 bg-primary-600 hover:bg-primary-700 text-white font-semibold rounded-lg shadow-lg shadow-primary-200 transition-all">
                    Mulai Gratis
                </a>
                <a href="#cara-kerja" class="px-8 py-3 bg-white hover:bg-gray-50 text-primary-600 font-semibold rounded-lg border-2 border-primary-200 transition-all">
                    Pelajari Lebih Lanjut
                </a>
            </div>
            
        </div>
    </div>
</div>

<!-- Features Section -->
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
    <div class="text-center mb-12">
        <h2 class="text-3xl font-bold text-gray-900 mb-3">Fitur Unggulan</h2>
        <p class="text-gray-600">Manajemen tugas yang lebih pintar dan efisien</p>
    </div>
    
    <div class="grid md:grid-cols-3 gap-8">
        
        <!-- Feature 1 -->
        <div class="bg-white p-6 rounded-xl border border-gray-200 hover:shadow-lg transition-shadow">
            <div class="w-12 h-12 bg-primary-100 rounded-lg flex items-center justify-center mb-4">
                <svg class="w-6 h-6 text-primary-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                </svg>
            </div>
            <h3 class="text-lg font-semibold text-gray-900 mb-2">Prioritas Otomatis</h3>
            <p class="text-gray-600 text-sm">
                AI menghitung prioritas tugas (Tinggi/Sedang/Rendah) berdasarkan 4 parameter penting secara real-time.
            </p>
        </div>
        
        <!-- Feature 2 -->
        <div class="bg-white p-6 rounded-xl border border-gray-200 hover:shadow-lg transition-shadow">
            <div class="w-12 h-12 bg-primary-100 rounded-lg flex items-center justify-center mb-4">
                <svg class="w-6 h-6 text-primary-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                </svg>
            </div>
            <h3 class="text-lg font-semibold text-gray-900 mb-2">Dashboard Intuitif</h3>
            <p class="text-gray-600 text-sm">
                Lihat statistik tugas, grafik prioritas, dan progress dalam satu tampilan yang mudah dipahami.
            </p>
        </div>
        
        <!-- Feature 3 -->
        <div class="bg-white p-6 rounded-xl border border-gray-200 hover:shadow-lg transition-shadow">
            <div class="w-12 h-12 bg-primary-100 rounded-lg flex items-center justify-center mb-4">
                <svg class="w-6 h-6 text-primary-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                </svg>
            </div>
            <h3 class="text-lg font-semibold text-gray-900 mb-2">Multi-User & Admin</h3>
            <p class="text-gray-600 text-sm">
                Support untuk banyak user dengan panel admin yang dapat mengelola akun dan melihat semua data tugas.
            </p>
        </div>
        
    </div>
</div>

<!-- How It Works Section -->
<div id="cara-kerja" class="bg-gray-100 py-16">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-bold text-gray-900 mb-3">Cara Kerja K-Means Clustering</h2>
            <p class="text-gray-600">Algoritma AI yang menghitung prioritas tugas Anda</p>
        </div>
        
        <div class="bg-white rounded-2xl p-8 shadow-lg">
            
            <!-- Step 1 -->
            <div class="flex gap-6 mb-8 pb-8 border-b border-gray-200">
                <div class="flex-shrink-0 w-12 h-12 bg-primary-500 text-white rounded-full flex items-center justify-center font-bold text-lg">
                    1
                </div>
                <div>
                    <h3 class="font-semibold text-gray-900 mb-2">Input 4 Parameter</h3>
                    <p class="text-gray-600 text-sm mb-3">Saat membuat tugas, Anda mengisi:</p>
                    <ul class="space-y-1 text-sm text-gray-600">
                        <li class="flex items-center gap-2">
                            <span class="w-1.5 h-1.5 bg-primary-500 rounded-full"></span>
                            <strong>Deadline</strong> - Kapan tugas harus selesai
                        </li>
                        <li class="flex items-center gap-2">
                            <span class="w-1.5 h-1.5 bg-primary-500 rounded-full"></span>
                            <strong>Pentingnya</strong> - Rendah, Sedang, atau Tinggi
                        </li>
                        <li class="flex items-center gap-2">
                            <span class="w-1.5 h-1.5 bg-primary-500 rounded-full"></span>
                            <strong>Estimasi Pengerjaan</strong> - Berapa jam dibutuhkan
                        </li>
                        <li class="flex items-center gap-2">
                            <span class="w-1.5 h-1.5 bg-primary-500 rounded-full"></span>
                            <strong>Tingkat Kesulitan</strong> - Mudah, Sedang, atau Sulit
                        </li>
                    </ul>
                </div>
            </div>
            
            <!-- Step 2 -->
            <div class="flex gap-6 mb-8 pb-8 border-b border-gray-200">
                <div class="flex-shrink-0 w-12 h-12 bg-primary-500 text-white rounded-full flex items-center justify-center font-bold text-lg">
                    2
                </div>
                <div>
                    <h3 class="font-semibold text-gray-900 mb-2">K-Means Clustering</h3>
                    <p class="text-gray-600 text-sm">
                        Algoritma AI mengelompokkan tugas ke dalam 3 cluster (Tinggi, Sedang, Rendah) berdasarkan kemiripan karakteristik. Tugas dengan deadline dekat, tingkat kesulitan tinggi, dan penting akan otomatis masuk ke cluster "Prioritas Tinggi".
                    </p>
                </div>
            </div>
            
            <!-- Step 3 -->
            <div class="flex gap-6">
                <div class="flex-shrink-0 w-12 h-12 bg-primary-500 text-white rounded-full flex items-center justify-center font-bold text-lg">
                    3
                </div>
                <div>
                    <h3 class="font-semibold text-gray-900 mb-2">Hasil Prioritas</h3>
                    <p class="text-gray-600 text-sm mb-3">Tugas otomatis diberi label:</p>
                    <div class="flex gap-3">
                        <span class="px-3 py-1 bg-red-100 text-red-700 text-xs font-semibold rounded-full">Tinggi</span>
                        <span class="px-3 py-1 bg-yellow-100 text-yellow-700 text-xs font-semibold rounded-full">Sedang</span>
                        <span class="px-3 py-1 bg-green-100 text-green-700 text-xs font-semibold rounded-full">Rendah</span>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
</div>

<!-- CTA Section -->
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
    <div class="bg-gradient-to-r from-primary-600 to-blue-600 rounded-2xl p-12 text-center text-white">
        <h2 class="text-3xl font-bold mb-4">Siap Mengelola Tugas Lebih Efisien?</h2>
        <p class="text-lg mb-8 text-primary-100">Daftar sekarang dan rasakan manfaat prioritas otomatis dengan AI</p>
        <a href="<?= url('register') ?>" class="inline-block px-8 py-3 bg-white text-primary-600 font-semibold rounded-lg hover:bg-gray-100 transition-colors shadow-xl">
            Daftar Gratis Sekarang
        </a>
    </div>
</div>

<?php require_once __DIR__ . '/../partials/footer.php'; ?>
