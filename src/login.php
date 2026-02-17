<?php
require_once __DIR__ . "/../backend/config/session.php";

require_once __DIR__ . "/../src/includes/header.php";
?>

<!-- Login section -->

<div class="flex flex-col justify-center items-center py-8">
  <div class="w-full max-w-sm animate-fade-in">

    <!-- Logo & Heading -->
    <div class="text-center mb-8 animate-fade-up">
      <div
        class="inline-flex items-center justify-center w-12 h-12 rounded-2xl bg-blue-600 shadow-lg shadow-blue-200 mb-4">
        <!-- Icon: checkmark list -->
        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" stroke-width="2.2" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round"
            d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 012-2h2a2 2 0 012 2M9 12l2 2 4-4" />
        </svg>
      </div>
      <h1 class="text-2xl font-semibold text-blue-900 tracking-tight">TaskPro</h1>
      <p class="text-sm text-blue-400 mt-1">Selamat datang kembali</p>
    </div>

    <!-- Form Card -->
    <div class="bg-white rounded-2xl shadow-xl shadow-blue-100/60 border border-blue-100 p-8 animate-fade-up-2">

      <!-- Error message -->
      <!-- <?php if ($error): ?>
    <div class="flex items-center gap-2 bg-red-50 border border-red-200 text-red-600 text-sm rounded-xl px-4 py-3 mb-6">
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
            <a href="forgot.php" class="text-xs text-blue-500 hover:text-blue-700 transition-colors">Lupa password?</a>
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
              <svg id="eye-icon" class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                <path stroke-linecap="round" stroke-linejoin="round"
                  d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
              </svg>
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
          class="btn-shine w-full py-2.5 bg-blue-600 hover:bg-blue-700 active:bg-blue-800 text-white text-sm font-medium rounded-xl transition-all duration-200 shadow-md shadow-blue-200 hover:shadow-lg hover:shadow-blue-300 animate-fade-up-4">
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
</div>
<?php require_once __DIR__ . "/../src/includes/footer.php"; ?>