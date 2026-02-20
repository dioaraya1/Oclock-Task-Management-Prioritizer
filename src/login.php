<?php
require_once __DIR__ . "/../backend/config/session.php";

$page = $_GET['page'] ?? 'login';

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
  <?php
  require_once BASE_PATH . "/src/includes/header.php";
  ?>
  <main class="flex flex-col my-12">
    <!-- Login section -->

    <div class="w-full max-w-sm animate-fade-in flex flex-col mx-auto mobile-padding">

      <!-- Logo & Heading -->
      <div class="text-center mb-8 animate-fade-up">
        <div
          class="inline-flex items-center justify-center w-16 h-16 rounded-2xl bg-blue-gradient shadow-lg shadow-blue-200 mb-4">
          <!-- Icon: checkmark list -->
          <i class="fa-solid fa-clock text-white text-3xl md:text-4xl"></i>
        </div>
        <h1 class="text-3xl font-bold text-blue-900 tracking-tight">O'clock</h1>
        <p class="text-base text-blue-600 mt-1">Selamat datang kembali</p>
      </div>

      <!-- Form Card -->
      <div class="bg-white rounded-2xl shadow-xl shadow-blue-100/60 border border-blue-100 p-8 animate-fade-up-2">

        <!-- Error message -->
        <!-- <?php if ($error): ?>
        <div
          class="flex items-center gap-2 bg-red-50 border border-red-200 text-red-600 text-sm rounded-xl px-4 py-3 mb-6">
          <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <circle cx="12" cy="12" r="10" />
            <path stroke-linecap="round" d="M12 8v4m0 4h.01" />
          </svg>
          <?= htmlspecialchars($error) ?>
        </div>
        <?php endif; ?> -->

        <form method="POST" action="" novalidate>

          <!-- Username -->
          <div class="mb-5 animate-fade-up-2">
            <label class="block text-xs font-medium text-blue-700 mb-1.5 tracking-wide uppercase">
              Username
            </label>
            <div class="relative">
              <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-blue-300 pointer-events-none">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round"
                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                </svg>
              </span>
              <input type="text" name="username" placeholder="Masukkan username"
                value="<?= htmlspecialchars($_POST['username'] ?? '') ?>" required autofocus class="w-full pl-9 pr-4 py-2.5 text-sm text-blue-900 placeholder-blue-200 bg-blue-50/60 border border-blue-100 rounded-xl outline-none transition-all duration-200
                     focus:bg-white focus:border-blue-400 focus:ring-4 focus:ring-blue-100">
            </div>
          </div>

          <!-- Password -->
          <div class="mb-6 animate-fade-up-3">
            <div class="flex items-center justify-between mb-1.5">
              <label class="text-xs font-medium text-blue-700 tracking-wide uppercase">Password</label>
              <!-- <a href="forgot.php" class="text-xs text-blue-500 hover:text-blue-700 transition-colors">Lupa
                password?</a> -->
            </div>
            <div class="relative">
              <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-blue-300 pointer-events-none">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                  <rect x="3" y="11" width="18" height="11" rx="2" ry="2" />
                  <path stroke-linecap="round" stroke-linejoin="round" d="M7 11V7a5 5 0 0110 0v4" />
                </svg>
              </span>
              <input type="password" name="password" id="password" placeholder="••••••••" required class="w-full pl-9 pr-10 py-2.5 text-sm text-blue-900 placeholder-blue-200 bg-blue-50/60 border border-blue-100 rounded-xl outline-none transition-all duration-200
                     focus:bg-white focus:border-blue-400 focus:ring-4 focus:ring-blue-100">
              <!-- Toggle show/hide password -->
              <button type="button" onclick="togglePassword()"
                class="absolute inset-y-0 right-0 flex items-center pr-3 text-blue-300 hover:text-blue-500 transition-colors"
                tabindex="-1">
                <i id="eye-icon" class="fa-solid fa-eye text-sm"></i>
              </button>
            </div>
          </div>

          <!-- Remember me -->
          <div class="flex items-center mb-6 animate-fade-up-3">
            <input type="checkbox" id="remember" name="remember"
              class="w-4 h-4 rounded border-blue-200 text-blue-600 cursor-pointer focus:ring-blue-400 focus:ring-offset-0">
            <label for="remember" class="ml-2 text-sm text-blue-500 select-none cursor-pointer">
              Ingat saya
            </label>
          </div>

          <!-- Submit Button -->
          <button type="submit"
            class="btn-shine w-full py-2.5 bg-blue-600 hover:bg-blue-700 active:bg-blue-800 text-white text-sm font-medium rounded-xl transition-all duration-200 shadow-md shadow-blue-200 hover:shadow-lg hover:shadow-blue-300 animate-fade-up-4 cursor-pointer">
            Masuk
          </button>

        </form>
      </div>

      <!-- Register link -->
      <p class="text-center text-sm text-blue-400 mt-6 animate-fade-up-4">
        Belum punya akun?
        <a href="register.php" class="text-blue-600 font-medium hover:text-blue-800 transition-colors">
          Daftar sekarang
        </a>
      </p>

    </div>

    <?php require_once __DIR__ . "/../src/includes/footer.php"; ?>