<?php

// require_once 'config/session.php';

// if (!isLoggedIn()) {
//     header('Location: login.php');
//     exit;
// }

include 'includes/header.php';
?>

<!-- hero section -->
<section class="flex-1 container mx-auto px-6 py-8 md:py-12">
  <div class="grid grid-cols-1 lg:grid-cols-2 ">
    <!-- left column - logo and description -->
    <div class="space-y-6">
      <!-- logo section -->
      <div class="flex items-center space-x-4">
        <div class="bg-blue-gradient rounded-2xl flex items-center w-14 h-14 justify-center shadow-lg">
          <i class="fas fa-clock text-3xl md:text-3xl text-white"></i>
        </div>
        <div>
          <h1 class="text-2xl md:text-4xl font-bold text-blue-600">O'Clock</h1>
          <p class="text-gray-600 font-medium text-sm md:text-base">Manajemen Tugas Prioritas</p>
        </div>
      </div>
      <!-- description -->
      <div class="my-4">
        <h2 class="text-gray-700 font-bold text-xl md:text-2xl">
          <i class="fa-solid fa-circle-nodes mr-2 text-blue-600 text-2xl md:text-3xl"></i>
          Powered by K-Means Clustering
        </h2>
        <p class="text-gray-600 text-base md:text-lg leading-relaxed">
          Aplikasi pintar yang menggunakan algoritma
          <span class="font-semibold text-blue-700">K-Means Clustering</span>
          untuk mengelompokkan dan memprioritaskan tugas Anda secara otomatis
          berdasarkan deadline, kompleksitas, dan urgensi.
        </p>
      </div>
      <div class="flex flex-col">
        <!-- stat badges -->
        <div class="flex flex-wrap gap-3">
          <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
            <i class="fas fa-bolt text-blue-600 mr-1.5"></i>
            95% Efisiensi
          </span>
          <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
            <i class="fas fa-chart-line text-green-600 mr-1.5"></i>
            +40% Produktivitas
          </span>
        </div>
        <!-- testimonials -->
        <div class="flex items-start mt-3">
          <div class="shrink-0">
            <div
              class="w-10 h-10 rounded-full bg-linear-to-r from-blue-400 to-blue-700 flex items-center justify-center text-white font-bold">
              GH
            </div>
          </div>
          <div class="ml-3">
            <p class="text-sm text-gray-700 italic">
              "O'Clock mengurangi waktu planning saya dari 1 jam menjadi 15 menit. AI-nya benar-benar memahami
              prioritas!"
            </p>
            <p class="text-xs text-gray-500 mt-1">— Genghis Khan, Product Manager</p>
            <div class="flex text-yellow-400 text-xs mt-1">
              ★★★★★
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- right column - form section -->
    <div
      class="mt-4 md:mt-0 bg-white rounded-lg md:rounded-xl shadow-lg md:shadow-xl p-6 md:p-8 border border-blue-200">
      <div class="space-y-4 md:space-y-6">
        <h3 class="text-xl md:text-2xl font-bold text-blue-700">Atur Waktu Lebih Efisien</h3>
        <div class="space-x-3 space-y-2">
          <div class="flex items-start space-x-3">
            <i class="fas fa-check-circle text-blue-600 mt-0.5 md:mt-1 text-sm md:text-base"></i>
            <p class="text-gray-700 text-sm md:text-base">Algoritma AI mengelompokkan tugas ke dalam kategori prioritas
            </p>
          </div>
          <div class="flex items-start space-x-3">
            <i class="fas fa-check-circle text-blue-600 mt-0.5 md:mt-1 text-sm md:text-base"></i>
            <p class="text-gray-700 text-sm md:text-base">Rekomendasi jadwal kerja yang optimal berdasarkan pola
              produktif
            </p>
          </div>
          <div class="flex items-start space-x-3">
            <i class="fas fa-check-circle text-blue-600 mt-0.5 md:mt-1 text-sm md:text-base"></i>
            <p class="text-gray-700 text-sm md:text-base">Monitoring progress secara real time
            </p>
          </div>
        </div>
        <!-- cta -->
        <div class="pt-2 md:pt-3">
          <a href="register.php"
            class="bg-blue-gradient w-full py-3 md:py-4 rounded-lg md:rounded-xl text-white font-bold text-base md:text-lg flex items-center justify-center hover:shadow-lg md:hover:shadow-xl space-x-2 md:space-x-3 transform hover:-translate-y-0.5 md:hover:-translate-y-1 transition-all duration-300 "><i
              class="fas fa-rocket text-sm md:text-base"></i>
            <span>Mulai Gratis Sekarang</span></a>
          <p class="text-center text-gray-600 text-xs md:text-sm mt-2 md:mt-3">
            Sudah punya akun?
            <a href="login.php" class="text-blue-600 font-medium hover:text-blue-800">
              Masuk di sini
            </a>
          </p>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- How It Works section -->
<section class="container mx-auto px-6 pb-12 md:pb-16 mobile-padding">
  <div class="text-center mb-8 md:mb-10">
    <h2 class="text-2xl md:text-3xl font-bold text-blue-900 mb-2 md:mb-3">
      <i class="fas fa-cogs mr-2 md:mr-3 text-blue-600"></i>
      Cara Kerja Oclock
    </h2>
    <p class="text-gray-700 text-sm md:text-base max-w-2xl mx-auto">
      Tiga langkah mudah menuju produktivitas maksimal
    </p>
  </div>
  <div class="grid grid-cols-1 md:grid-cols-3 gap-4 md:gap-8">
    <!-- Step 1 -->
    <div
      class="feature-card bg-white rounded-xl p-4 md:p-6 shadow-sm md:shadow-md border border-blue-50 hover:shadow-md md:hover:shadow-xl transition-all duration-300">
      <div class="flex items-center justify-between mb-3 md:mb-4">
        <div class="w-10 h-10 md:w-12 md:h-12 rounded-lg bg-blue-100 flex items-center justify-center">
          <span class="text-blue-700 font-bold text-lg md:text-xl">1</span>
        </div>
        <i class="fas fa-tasks text-xl md:text-2xl text-blue-600 feature-icon"></i>
      </div>
      <h3 class="text-lg md:text-xl font-bold text-blue-800 mb-2 md:mb-3">Input Tugas</h3>
      <p class="text-gray-600 text-sm md:text-base">
        Tambahkan tugas dengan detail deadline, estimasi waktu, dan tingkat kesulitan.
      </p>
    </div>
    <!-- Step 2 -->
    <div
      class="feature-card bg-white rounded-xl p-4 md:p-6 shadow-sm md:shadow-md border border-blue-50 hover:shadow-md md:hover:shadow-xl transition-all duration-300">
      <div class="flex items-center justify-between mb-3 md:mb-4">
        <div class="w-10 h-10 md:w-12 md:h-12 rounded-lg bg-blue-100 flex items-center justify-center">
          <span class="text-blue-700 font-bold text-lg md:text-xl">2</span>
        </div>
        <i class="fa-solid fa-circle-nodes text-xl md:text-2xl text-blue-600 feature-icon"></i>
      </div>
      <h3 class="text-lg md:text-xl font-bold text-blue-800 mb-2 md:mb-3">AI Analisis</h3>
      <p class="text-gray-600 text-sm md:text-base">
        K-Means Clustering mengelompokkan tugas ke dalam kategori prioritas secara otomatis.
      </p>
    </div>

    <!-- Step 3 -->
    <div
      class="feature-card bg-white rounded-xl p-4 md:p-6 shadow-sm md:shadow-md border border-blue-50 hover:shadow-md md:hover:shadow-xl transition-all duration-300">
      <div class="flex items-center justify-between mb-3 md:mb-4">
        <div class="w-10 h-10 md:w-12 md:h-12 rounded-lg bg-blue-100 flex items-center justify-center">
          <span class="text-blue-700 font-bold text-lg md:text-xl">3</span>
        </div>
        <i class="fas fa-check-double text-xl md:text-2xl text-blue-600 feature-icon"></i>
      </div>
      <h3 class="text-lg md:text-xl font-bold text-blue-800 mb-2 md:mb-3">Eksekusi</h3>
      <p class="text-gray-600 text-sm md:text-base">
        Kerjakan tugas sesuai urutan prioritas yang sudah dioptimalkan oleh sistem.
      </p>
    </div>
  </div>
</section>

<?php
// Include footer
include 'includes/footer.php';
?>