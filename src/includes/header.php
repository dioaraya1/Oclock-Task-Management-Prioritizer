<?php
require_once BASE_PATH . "/backend/config/session.php";
$isLoggedIn = isLoggedIn();
?>

<!-- header/navigation -->
<nav class="bg-white shadow-sm py-4 px-4 mobile-padding">
  <div class="container mx-auto flex justify-between items-center mobile-padding">
    <!-- logo -->
    <div class="flex items-center space-x-2">
      <div class="bg-blue-gradient rounded-2xl flex items-center w-12 h-12 justify-center shadow-lg lg:w-14 lg:h-14">
        <i class="fa-solid fa-clock text-2xl text-white lg:text-3xl "></i>
      </div>
      <span class="text-xl font-bold text-blue-600">Oclock</span>
    </div>
    <!-- login button -->
    <?php if (!isLoggedIn()): ?>
      <?php if ($page === 'index'): ?>
        <a href="?page=login"
          class=" text-blue-600 hover:text-blue-800 font-medium px-4 py-2 sm:text-base button-responsive">
          <i class="fas fa-sign-in-alt mr-1 sm:mr-2"></i>
          <span class="hidden sm:inline">Masuk</span>
          <span class="sm:hidden">Login</span>
        </a>
      <?php elseif ($page === 'register'): ?>
        <a href="?page=login"
          class="text-blue-600 hover:text-blue-800 font-medium px-4 py-2 sm:text-base button-responsive">
          <i class="fas fa-sign-in-alt mr-1 sm:mr-2"></i>
          <span class="hidden sm:inline">Masuk</span>
          <span class="sm:hidden">Login</span>
        </a>
      <?php elseif ($page === 'login'): ?>
        <a href="?page=register"
          class="text-blue-600 hover:text-blue-800 font-medium px-4 py-2 sm:text-base button-responsive">
          <i class="fas fa-user-plus mr-1 sm:mr-2"></i>
          <span class="hidden sm:inline">Daftar</span>
          <span class="sm:hidden">Register</span>
        </a>
      <?php endif; ?>
    <?php else: ?>
      <!-- logout button -->
      <?php if (isLoggedIn() && $page === 'dashboard'): ?>
        <a href="?page=logout"
          class="text-blue-600 hover:text-blue-800 font-medium px-4 py-2 sm:text-base button-responsive">
          <i class="fas fa-sign-out-alt mr-1 sm:mr-2"></i>
          <span class="hidden sm:inline">Keluar</span>
        </a>
      <?php else: ?>

        <a href="?page=login"
          class="text-blue-600 hover:text-blue-800 font-medium px-4  py-2 sm:text-base button-responsive">
          <i class="fas fa-sign-in-alt mr-1 sm:mr-2"></i>
          <span class="hidden sm:inline">Masuk</span>
          <span class="sm:hidden">Login</span>
        </a>
      <?php endif; ?>
    <?php endif; ?>
  </div>
</nav>