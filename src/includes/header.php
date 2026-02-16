<?php
$page = $_GET['page'] ?? 'index';

// whitelist halaman yang boleh diakses
$allowedPages = ['index', 'login', 'register', 'dashboard'];

// kalau page tidak valid → fallback ke index
if (!in_array($page, $allowedPages)) {
  $page = 'index';
}
$base_url = '/';// Laragon otomatis serve dari root
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Oclock - Manajemen Tugas Prioritas</title>
  <!-- tailwindcss -->
  <link rel="stylesheet" href="<?php $base_url ?>assets/css/styles.css?v=<?php echo time(); ?>">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
</head>

<body class="font-sans bg-light-gradient">
  <!-- Main container -->
  <main class="min-h-screen flex flex-col">
    <!-- header/navigation -->
    <nav class="bg-white shadow-sm py-4 px-4 mobile-padding">
      <div class="container mx-auto flex justify-between items-center mobile-padding">
        <!-- logo -->
        <div class="flex items-center space-x-2">
          <div
            class="bg-blue-gradient rounded-2xl flex items-center w-12 h-12 justify-center shadow-lg lg:w-14 lg:h-14">
            <i class="fa-solid fa-clock text-2xl text-white lg:text-3xl "></i>
          </div>
          <span class="text-xl font-bold text-blue-600">Oclock</span>
        </div>
        <!-- login button -->
        <?php if (!isLoggedIn()): ?>
          <?php if ($page === 'index'): ?>
            <a href="/src/login.php"
              class=" text-blue-600 hover:text-blue-800 font-medium px-4 py-2 sm:text-base button-responsive">
              <i class="fas fa-sign-in-alt mr-1 sm:mr-2"></i>
              <span class="hidden sm:inline">Masuk</span>
              <span class="sm:hidden">Login</span>
            </a>
          <?php elseif ($page === 'register'): ?>
            <a href="login.php"
              class="text-blue-600 hover:text-blue-800 font-medium px-4 py-2 sm:text-base button-responsive">
              <i class="fas fa-sign-in-alt mr-1 sm:mr-2"></i>
              <span class="hidden sm:inline">Masuk</span>
              <span class="sm:hidden">Login</span>
            </a>
          <?php endif; ?>
        <?php else: ?>
          <!-- logout button -->
          <?php if (isLoggedIn() && $page === 'dashboard'): ?>
            <a href="logout.php"
              class="text-blue-600 hover:text-blue-800 font-medium px-4 py-2 sm:text-base button-responsive">
              <i class="fas fa-sign-out-alt mr-1 sm:mr-2"></i>
              <span class="hidden sm:inline">Keluar</span>
            </a>
          <?php else: ?>
            <a href=" login.php"
              class="text-blue-600 hover:text-blue-800 font-medium px-4  py-2 sm:text-base button-responsive">
              <i class="fas fa-sign-in-alt mr-1 sm:mr-2"></i>
              <span class="hidden sm:inline">Masuk</span>
              <span class="sm:hidden">Login</span>
            </a>
          <?php endif; ?>
        <?php endif; ?>
      </div>
    </nav>