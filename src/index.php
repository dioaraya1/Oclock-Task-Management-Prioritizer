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
      <div class="space-y-4">
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
    </div>

    <!-- right column - form section -->
    <div class="flex items-center justify-center">
      <div class="w-full max-w-md">
        <h2 class="text-gray-700 font-bold text-xl md:text-2xl mb-4">
          <i class="fa-solid fa-user mr-2 text-blue-600 text-2xl md:text-3xl"></i>
          Daftar
        </h2>
      </div>
    </div>
  </div>
</section>

<?php
// Include footer
include 'includes/footer.php';
?>