<?php
$base_url = "/";
// ============================================================
// login.php — Halaman Login O'Clock
// Clean & Modern Design with Blue Theme
// ============================================================

// session_start();

// // Jika sudah login, redirect ke dashboard
// if (isset($_SESSION['user_id'])) {
//   header('Location: dashboard.php');
//   exit;
// }

// // Include config jika diperlukan
// require_once 'config/session.php';

// $error = '';
// $email = '';

// // Handle form submission
// if ($_SERVER['REQUEST_METHOD'] === 'POST') {
//   $email = $_POST['email'] ?? '';
//   $password = $_POST['password'] ?? '';

//   if (empty($email) || empty($password)) {
//     $error = 'Email dan password harus diisi';
//   } else {
//     // Validasi demo (ganti dengan koneksi database)
//     if ($email === 'demo@oclock.com' && $password === 'demo123') {
//       $_SESSION['user_id'] = 1;
//       $_SESSION['user_email'] = $email;
//       $_SESSION['user_name'] = 'Demo User';
//       header('Location: dashboard.php');
//       exit;
//     } else {
//       $error = 'Email atau password salah';
//     }
//   }
// }
?>

<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login - O'Clock Task Manager</title>

  <!-- tailwindcss -->
  <link rel="stylesheet" href="<?php echo $base_url; ?>public/assets/css/styles.css?v=<?php echo time(); ?>">


  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

  <style>
    body {
      background: linear-gradient(135deg, #0ea5e9 0%, #3b82f6 25%, #1d4ed8 50%, #3730a3 75%, #7c3aed 100%);
      background-size: 400% 400%;
      animation: linearShift 15s ease infinite;
      min-height: 100vh;
      overflow-x: hidden;
    }

    @keyframes linearShift {
      0% {
        background-position: 0% 50%;
      }

      50% {
        background-position: 100% 50%;
      }

      100% {
        background-position: 0% 50%;
      }
    }

    .login-card {
      background: rgba(255, 255, 255, 0.95);
      backdrop-filter: blur(20px);
      border: 1px solid rgba(255, 255, 255, 0.3);
      box-shadow:
        0 20px 40px rgba(0, 0, 0, 0.1),
        0 0 0 1px rgba(255, 255, 255, 0.2),
        inset 0 0 40px rgba(255, 255, 255, 0.3);
    }

    .orb {
      position: absolute;
      border-radius: 50%;
      background: radial-linear(circle at 30% 30%, rgba(255, 255, 255, 0.2), rgba(255, 255, 255, 0.1));
      filter: blur(20px);
      z-index: 0;
    }

    .orb-1 {
      width: 300px;
      height: 300px;
      top: -100px;
      right: -100px;
      animation: floatOrb 25s ease-in-out infinite;
    }

    .orb-2 {
      width: 200px;
      height: 200px;
      bottom: -50px;
      left: -50px;
      animation: floatOrb 30s ease-in-out infinite reverse;
    }

    .orb-3 {
      width: 150px;
      height: 150px;
      top: 50%;
      left: 10%;
      animation: floatOrb 20s ease-in-out infinite;
    }

    @keyframes floatOrb {

      0%,
      100% {
        transform: translate(0, 0) scale(1);
      }

      25% {
        transform: translate(30px, -30px) scale(1.1);
      }

      50% {
        transform: translate(-20px, 20px) scale(0.9);
      }

      75% {
        transform: translate(-30px, -20px) scale(1.05);
      }
    }

    .floating-icon {
      position: absolute;
      color: rgba(255, 255, 255, 0.1);
      z-index: 0;
      animation: floatIcon 8s ease-in-out infinite;
    }

    @keyframes floatIcon {

      0%,
      100% {
        transform: translateY(0) rotate(0deg);
      }

      50% {
        transform: translateY(-20px) rotate(10deg);
      }
    }

    .input-focus:focus {
      border-color: #3b82f6;
      box-shadow:
        0 0 0 3px rgba(59, 130, 246, 0.1),
        inset 0 0 0 1px #3b82f6;
    }

    .btn-primary {
      background: linear-linear(135deg, #1d4ed8 0%, #3b82f6 100%);
      box-shadow: 0 10px 20px rgba(29, 78, 216, 0.3);
      transition: all 0.3s ease;
    }

    .btn-primary:hover {
      background: linear-linear(135deg, #1e40af 0%, #2563eb 100%);
      transform: translateY(-2px);
      box-shadow: 0 15px 25px rgba(29, 78, 216, 0.4);
    }

    /* Animation delays */
    .delay-1 {
      animation-delay: 1s;
    }

    .delay-2 {
      animation-delay: 2s;
    }

    .delay-3 {
      animation-delay: 3s;
    }

    .delay-4 {
      animation-delay: 4s;
    }

    /* Mobile optimizations */
    @media (max-width: 768px) {
      .login-card {
        margin: 1rem;
        padding: 1.5rem;
      }

      .orb-1,
      .orb-2,
      .orb-3 {
        display: none;
      }

      .floating-icon {
        display: none;
      }

      .absolute.top-0.left-0,
      .absolute.bottom-0.right-0,
      .absolute.top-1\\/2.left-1\\/2 {
        display: none;
      }
    }


    /* Fix untuk backdrop-filter di Safari */
    @supports (-webkit-backdrop-filter: none) or (backdrop-filter: none) {
      .login-card {
        -webkit-backdrop-filter: blur(20px);
        backdrop-filter: blur(20px);
      }
    }
  </style>
</head>

<body class="relative font-sans">
  <!-- Background Orbs -->
  <div class="orb orb-1"></div>
  <div class="orb orb-2"></div>
  <div class="orb orb-3"></div>

  <!-- Floating Icons -->
  <div class="floating-icon" style="top: 15%; left: 5%;">
    <i class="fas fa-clock text-4xl md:text-6xl"></i>
  </div>
  <div class="floating-icon delay-1" style="top: 70%; right: 10%;">
    <i class="fas fa-calendar-alt text-3xl md:text-5xl"></i>
  </div>
  <div class="floating-icon delay-2" style="top: 30%; right: 15%;">
    <i class="fas fa-tasks text-4xl md:text-6xl"></i>
  </div>
  <div class="floating-icon delay-3" style="top: 60%; left: 15%;">
    <i class="fas fa-chart-line text-3xl md:text-5xl"></i>
  </div>

  <!-- Geometric Shapes -->
  <div class="absolute top-0 left-0 w-64 h-64 border-2 border-white/10 rounded-full -translate-x-1/2 -translate-y-1/2">
  </div>
  <div
    class="absolute bottom-0 right-0 w-96 h-96 border-2 border-white/10 rounded-full translate-x-1/3 translate-y-1/3">
  </div>
  <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 border border-white/10 rotate-45">
  </div>

  <!-- Navigation -->
  <nav class="relative z-10 py-6 px-4 md:px-12">
    <div class="container mx-auto flex justify-between items-center">
      <!-- Logo -->
      <a href="index.php" class="flex items-center space-x-3 group">
        <div
          class="w-10 h-10 rounded-xl bg-white/20 backdrop-blur-sm flex items-center justify-center group-hover:bg-white/30 transition duration-300">
          <i class="fas fa-clock text-white text-xl"></i>
        </div>
        <div>
          <h1 class="text-xl font-bold text-white">O'Clock</h1>
          <p class="text-white/80 text-xs">Smart Task Manager</p>
        </div>
      </a>

      <!-- Navigation Links -->
      <div class="flex items-center space-x-3 md:space-x-6">
        <a href="index.php"
          class="text-white/80 hover:text-white font-medium text-sm md:text-base transition duration-300">
          <i class="fas fa-home mr-2"></i>
          <span class="hidden md:inline">Home</span>
        </a>
        <a href="register.php"
          class="px-4 py-2 rounded-lg bg-white/20 backdrop-blur-sm text-white hover:bg-white/30 transition duration-300 font-medium text-sm">
          <i class="fas fa-user-plus mr-2"></i>
          Daftar
        </a>
        <a href="#"
          class="px-4 py-2 rounded-lg bg-linear-to-r from-cyan-400 to-blue-500 text-white hover:from-cyan-500 hover:to-blue-600 transition duration-300 font-medium text-sm">
          <i class="fas fa-play-circle mr-2"></i>
          Demo
        </a>
      </div>
    </div>
  </nav>

  <!-- Main Content -->
  <main class="relative z-10 flex-1 flex items-center justify-center px-4 py-8">
    <div class="w-full max-w-md">
      <!-- Login Card -->
      <div class="login-card rounded-3xl p-6 md:p-8">
        <!-- Header -->
        <div class="text-center mb-8">
          <div
            class="w-20 h-20 mx-auto rounded-full bg-linear-to-br from-blue-500 to-blue-700 flex items-center justify-center mb-6 shadow-lg">
            <i class="fas fa-user-shield text-3xl text-white"></i>
          </div>
          <h2 class="text-2xl md:text-3xl font-bold text-gray-800 mb-2">
            Selamat Datang Kembali
          </h2>
          <p class="text-gray-600">
            Masuk untuk mengelola tugas Anda
          </p>
        </div>

        <!-- Error Message -->
        <?php if (isset($error) && !empty($error)): ?>
          <div class="mb-6 p-4 bg-red-50 border border-red-200 rounded-xl">
            <div class="flex items-center">
              <div class="w-8 h-8 rounded-full bg-red-100 flex items-center justify-center mr-3">
                <i class="fas fa-exclamation text-red-500"></i>
              </div>
              <p class="text-red-700"><?php echo htmlspecialchars($error); ?></p>
            </div>
          </div>
        <?php endif; ?>

        <!-- Login Form -->
        <form method="POST" action="" class="space-y-6">
          <!-- Email Field -->
          <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">
              <i class="fas fa-envelope text-blue-500 mr-2"></i>
              Email Address
            </label>
            <div class="relative">
              <input type="email" name="email" value="<?php echo isset($email) ? htmlspecialchars($email) : ''; ?>"
                required
                class="w-full px-4 py-3 pl-12 bg-white border border-gray-300 rounded-xl focus:outline-none input-focus transition duration-300"
                placeholder="you@example.com">
              <div class="absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-400">
                <i class="fas fa-user"></i>
              </div>
            </div>
          </div>

          <!-- Password Field -->
          <div>
            <div class="flex justify-between items-center mb-2">
              <label class="block text-sm font-medium text-gray-700">
                <i class="fas fa-lock text-blue-500 mr-2"></i>
                Password
              </label>
              <a href="forgot-password.php" class="text-sm text-blue-600 hover:text-blue-800 font-medium">
                Lupa password?
              </a>
            </div>
            <div class="relative">
              <input type="password" name="password" required id="password"
                class="w-full px-4 py-3 pl-12 bg-white border border-gray-300 rounded-xl focus:outline-none input-focus transition duration-300"
                placeholder="••••••••">
              <div class="absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-400">
                <i class="fas fa-key"></i>
              </div>
              <button type="button" onclick="togglePassword()"
                class="absolute right-4 top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-gray-600 focus:outline-none">
                <i class="fas fa-eye" id="toggleIcon"></i>
              </button>
            </div>
          </div>

          <!-- Remember Me & Demo -->
          <div class="flex flex-col sm:flex-row justify-between items-center space-y-4 sm:space-y-0">
            <label class="flex items-center space-x-2 cursor-pointer">
              <div class="relative">
                <input type="checkbox" name="remember" class="sr-only peer">
                <div
                  class="w-5 h-5 bg-gray-200 rounded peer-checked:bg-blue-500 peer-checked:border-blue-500 border-2 border-gray-300 transition duration-200 flex items-center justify-center">
                  <i
                    class="fas fa-check text-white text-xs opacity-0 peer-checked:opacity-100 transition duration-200"></i>
                </div>
              </div>
              <span class="text-sm text-gray-700">Ingat saya</span>
            </label>

            <button type="button" onclick="fillDemoCredentials()"
              class="text-sm text-blue-600 hover:text-blue-800 font-medium flex items-center focus:outline-none">
              <i class="fas fa-magic mr-2"></i>
              Coba Akun Demo
            </button>
          </div>

          <!-- Submit Button -->
          <button type="submit"
            class="bg-blue-500 w-full py-3 px-4 text-white font-semibold rounded-xl transition-all duration-300 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
            <i class="fas fa-sign-in-alt mr-2"></i>
            Masuk ke Dashboard
          </button>
        </form>

        <!-- Divider -->
        <div class="my-8 flex items-center">
          <div class="flex-1 h-px bg-gray-300"></div>
          <span class="px-4 text-gray-500 text-sm">atau lanjutkan dengan</span>
          <div class="flex-1 h-px bg-gray-300"></div>
        </div>

        <!-- Social Login (Placeholder) -->
        <div class="grid grid-cols-2 gap-3 mb-8">
          <button type="button"
            class="py-3 px-4 bg-white border border-gray-300 rounded-xl hover:bg-gray-50 transition duration-300 flex items-center justify-center space-x-2 focus:outline-none focus:ring-2 focus:ring-gray-200">
            <i class="fab fa-google text-red-500"></i>
            <span class="text-sm font-medium">Google</span>
          </button>
          <button type="button"
            class="py-3 px-4 bg-white border border-gray-300 rounded-xl hover:bg-gray-50 transition duration-300 flex items-center justify-center space-x-2 focus:outline-none focus:ring-2 focus:ring-gray-200">
            <i class="fab fa-microsoft text-blue-500"></i>
            <span class="text-sm font-medium">Microsoft</span>
          </button>
        </div>

        <!-- Register Link -->
        <div class="text-center">
          <p class="text-gray-600">
            Belum punya akun?
            <a href="register.php" class="text-blue-600 font-semibold hover:text-blue-800 ml-1">
              Daftar sekarang
            </a>
          </p>
          <p class="text-gray-500 text-sm mt-2">
            Gratis selama 14 hari • Tanpa kartu kredit
          </p>
        </div>
      </div>

      <!-- App Features Preview -->
      <div class="mt-8 text-center">
        <p class="text-white/90 text-sm mb-4">Dengan O'Clock Anda bisa:</p>
        <div class="flex flex-wrap justify-center gap-4">
          <div class="flex items-center space-x-2">
            <div class="w-6 h-6 rounded-full bg-white/20 flex items-center justify-center">
              <i class="fas fa-check text-white text-xs"></i>
            </div>
            <span class="text-white text-sm">Prioritas otomatis</span>
          </div>
          <div class="flex items-center space-x-2">
            <div class="w-6 h-6 rounded-full bg-white/20 flex items-center justify-center">
              <i class="fas fa-check text-white text-xs"></i>
            </div>
            <span class="text-white text-sm">Analisis AI</span>
          </div>
          <div class="flex items-center space-x-2">
            <div class="w-6 h-6 rounded-full bg-white/20 flex items-center justify-center">
              <i class="fas fa-check text-white text-xs"></i>
            </div>
            <span class="text-white text-sm">Notifikasi pintar</span>
          </div>
        </div>
      </div>
    </div>
  </main>

  <!-- Footer -->
  <footer class="relative z-10 py-6 px-4 md:px-12 mt-8">
    <div class="container mx-auto">
      <div class="border-t border-white/20 pt-6">
        <div class="flex flex-col md:flex-row justify-between items-center space-y-4 md:space-y-0">
          <!-- Copyright -->
          <div class="text-white/70 text-sm">
            &copy; <?php echo date('Y'); ?> O'Clock. All rights reserved.
          </div>

          <!-- Links -->
          <div class="flex flex-wrap justify-center gap-4 md:gap-6">
            <a href="#" class="text-white/70 hover:text-white text-sm transition duration-300">Privacy</a>
            <a href="#" class="text-white/70 hover:text-white text-sm transition duration-300">Terms</a>
            <a href="#" class="text-white/70 hover:text-white text-sm transition duration-300">Security</a>
            <a href="#" class="text-white/70 hover:text-white text-sm transition duration-300">Contact</a>
            <a href="#" class="text-white/70 hover:text-white text-sm transition duration-300">Help</a>
          </div>
        </div>

        <!-- Social Media -->
        <div class="flex justify-center space-x-4 mt-6">
          <a href="#" class="text-white/70 hover:text-white transition duration-300">
            <i class="fab fa-twitter"></i>
          </a>
          <a href="#" class="text-white/70 hover:text-white transition duration-300">
            <i class="fab fa-facebook"></i>
          </a>
          <a href="#" class="text-white/70 hover:text-white transition duration-300">
            <i class="fab fa-linkedin"></i>
          </a>
          <a href="#" class="text-white/70 hover:text-white transition duration-300">
            <i class="fab fa-github"></i>
          </a>
        </div>
      </div>
    </div>
  </footer>

  <!-- JavaScript -->
  <script>
    // Toggle password visibility
    function togglePassword() {
      const passwordInput = document.getElementById('password');
      const toggleIcon = document.getElementById('toggleIcon');

      if (passwordInput.type === 'password') {
        passwordInput.type = 'text';
        toggleIcon.classList.remove('fa-eye');
        toggleIcon.classList.add('fa-eye-slash');
      } else {
        passwordInput.type = 'password';
        toggleIcon.classList.remove('fa-eye-slash');
        toggleIcon.classList.add('fa-eye');
      }

      // Focus kembali ke input
      passwordInput.focus();
    }

    // Fill demo credentials
    function fillDemoCredentials() {
      const emailInput = document.querySelector('input[name="email"]');
      const passwordInput = document.getElementById('password');

      emailInput.value = 'demo@oclock.com';
      passwordInput.value = 'demo123';

      // Remove existing success/error messages
      const existingMsg = document.querySelector('.bg-red-50, .bg-green-50');
      if (existingMsg) {
        existingMsg.remove();
      }

      // Add success message
      const successMsg = document.createElement('div');
      successMsg.className = 'mt-4 p-4 bg-green-50 border border-green-200 rounded-xl';
      successMsg.innerHTML = `
        <div class="flex items-center">
          <div class="w-8 h-8 rounded-full bg-green-100 flex items-center justify-center mr-3">
            <i class="fas fa-check text-green-500"></i>
          </div>
          <div>
            <p class="font-medium text-green-800">Akun demo telah diisi!</p>
            <p class="text-green-600 text-sm">Klik "Masuk ke Dashboard" untuk melanjutkan</p>
          </div>
        </div>
      `;

      // Insert message after form
      const form = document.querySelector('form');
      form.parentNode.insertBefore(successMsg, form.nextSibling);

      // Auto scroll to message
      successMsg.scrollIntoView({ behavior: 'smooth', block: 'center' });
    }

    // Add floating animation delay classes
    document.querySelectorAll('.floating-icon').forEach((icon, index) => {
      icon.classList.add(`delay-${index + 1}`);
    });

    // Add interactivity to inputs
    document.querySelectorAll('input').forEach(input => {
      input.addEventListener('focus', function () {
        this.parentElement.style.transform = 'translateY(-2px)';
        this.parentElement.style.transition = 'transform 0.3s ease';
      });

      input.addEventListener('blur', function () {
        this.parentElement.style.transform = 'translateY(0)';
      });
    });

    // Add ripple effect to buttons
    document.querySelectorAll('button').forEach(button => {
      button.addEventListener('click', function (e) {
        // Skip if button is inside form (to avoid form submission)
        if (this.type === 'submit') return;

        const rect = this.getBoundingClientRect();
        const size = Math.max(rect.width, rect.height);
        const x = e.clientX - rect.left - size / 2;
        const y = e.clientY - rect.top - size / 2;

        // Remove existing ripples
        const existingRipples = this.querySelectorAll('.ripple-effect');
        existingRipples.forEach(ripple => ripple.remove());

        const ripple = document.createElement('span');
        ripple.className = 'ripple-effect';
        ripple.style.cssText = `
          position: absolute;
          border-radius: 50%;
          background: rgba(255, 255, 255, 0.5);
          transform: scale(0);
          animation: ripple 0.6s linear;
          width: ${size}px;
          height: ${size}px;
          top: ${y}px;
          left: ${x}px;
          pointer-events: none;
        `;

        this.style.position = 'relative';
        this.style.overflow = 'hidden';
        this.appendChild(ripple);

        setTimeout(() => ripple.remove(), 600);
      });
    });

    // Add ripple animation style
    const style = document.createElement('style');
    style.textContent = `
      @keyframes ripple {
        to {
          transform: scale(4);
          opacity: 0;
        }
      }
    `;
    document.head.appendChild(style);

    // Prevent form submission for demo button
    document.querySelector('button[onclick="fillDemoCredentials()"]').addEventListener('click', function (e) {
      e.preventDefault();
    });
  </script>
</body>

</html>