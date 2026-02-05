<?php
// ============================================================
// index.php — Halaman Utama O'Clock
// Modern, Minimalist, Single Screen
// ============================================================

// require_once 'config/session.php';

// if (isLoggedIn()) {
//     header('Location: dashboard.php');
//     exit;
// }
?>

<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>O'Clock | Task Management with AI</title>

  <!-- Tailwind CSS -->
  <script src="https://cdn.tailwindcss.com"></script>

  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

  <style>
    * {
      font-family: 'Inter', sans-serif;
    }

    body {
      background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
      min-height: 100vh;
    }

    .glass-effect {
      background: rgba(255, 255, 255, 0.7);
      backdrop-filter: blur(10px);
      border: 1px solid rgba(255, 255, 255, 0.2);
    }

    .blue-glow {
      box-shadow: 0 10px 40px -10px rgba(59, 130, 246, 0.3);
    }

    .number-badge {
      width: 32px;
      height: 32px;
      display: flex;
      align-items: center;
      justify-content: center;
      border-radius: 50%;
      font-weight: 600;
      font-size: 14px;
    }

    .floating-animation {
      animation: float 6s ease-in-out infinite;
    }

    @keyframes float {

      0%,
      100% {
        transform: translateY(0px);
      }

      50% {
        transform: translateY(-10px);
      }
    }

    .feature-dot {
      width: 8px;
      height: 8px;
      border-radius: 50%;
      margin-right: 12px;
    }
  </style>
</head>

<body class="text-gray-800">
  <!-- Main Container -->
  <div class="min-h-screen flex flex-col">

    <!-- Minimal Header -->
    <header class="py-6 px-6 md:px-12">
      <div class="flex justify-between items-center">
        <!-- Logo -->
        <div class="flex items-center space-x-3">
          <div
            class="w-10 h-10 rounded-xl bg-gradient-to-br from-blue-500 to-blue-700 flex items-center justify-center">
            <i class="fas fa-clock text-white"></i>
          </div>
          <div>
            <h1 class="text-xl font-bold bg-gradient-to-r from-blue-600 to-blue-800 bg-clip-text text-transparent">
              O'Clock
            </h1>
            <p class="text-xs text-gray-500">AI Task Manager</p>
          </div>
        </div>

        <!-- Login Button -->
        <a href="login.php"
          class="px-4 py-2 rounded-lg border border-blue-200 text-blue-600 hover:bg-blue-50 transition-colors duration-200 text-sm font-medium">
          Sign In
        </a>
      </div>
    </header>

    <!-- Hero Section - Split Layout -->
    <main class="flex-1 px-6 md:px-12 py-8 md:py-16">
      <div class="max-w-7xl mx-auto">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 lg:gap-20 items-center">

          <!-- Left Side - Visual & Logo -->
          <div class="relative">
            <!-- Floating Elements -->
            <div class="relative">
              <!-- Main Circle -->
              <div
                class="w-64 h-64 mx-auto rounded-full bg-gradient-to-br from-blue-100 to-blue-50 flex items-center justify-center blue-glow floating-animation">
                <div
                  class="w-48 h-48 rounded-full bg-gradient-to-br from-blue-200 to-blue-100 flex items-center justify-center">
                  <div
                    class="w-32 h-32 rounded-full bg-gradient-to-br from-blue-300 to-blue-200 flex items-center justify-center">
                    <i class="fas fa-brain text-4xl text-blue-600"></i>
                  </div>
                </div>
              </div>

              <!-- Floating Items -->
              <div
                class="absolute top-6 left-6 w-14 h-14 rounded-2xl bg-white shadow-lg flex items-center justify-center glass-effect">
                <i class="fas fa-tasks text-blue-500"></i>
              </div>
              <div
                class="absolute top-6 right-6 w-14 h-14 rounded-2xl bg-white shadow-lg flex items-center justify-center glass-effect">
                <i class="fas fa-chart-pie text-blue-500"></i>
              </div>
              <div
                class="absolute bottom-6 left-10 w-14 h-14 rounded-2xl bg-white shadow-lg flex items-center justify-center glass-effect">
                <i class="fas fa-bolt text-blue-500"></i>
              </div>
              <div
                class="absolute bottom-6 right-10 w-14 h-14 rounded-2xl bg-white shadow-lg flex items-center justify-center glass-effect">
                <i class="fas fa-clock text-blue-500"></i>
              </div>
            </div>

            <!-- App Name & Tagline -->
            <div class="text-center mt-10">
              <div class="inline-flex items-center space-x-2 bg-blue-50 px-4 py-2 rounded-full mb-4">
                <span class="feature-dot bg-blue-500"></span>
                <span class="text-sm font-medium text-blue-700">K-Means Clustering</span>
              </div>
              <h2 class="text-3xl md:text-4xl font-bold text-gray-900">
                Smart Task<br>Prioritization
              </h2>
            </div>
          </div>

          <!-- Right Side - Content & CTA -->
          <div class="space-y-8">
            <!-- Main Description -->
            <div class="space-y-6">
              <h3 class="text-2xl md:text-3xl font-bold">
                <span class="bg-gradient-to-r from-blue-600 to-blue-800 bg-clip-text text-transparent">
                  Work Smarter,<br>
                  Not Harder
                </span>
              </h3>

              <p class="text-gray-600 text-lg leading-relaxed">
                O'Clock uses <span class="font-semibold text-blue-600">AI-powered K-Means Clustering</span> to
                automatically organize and prioritize your tasks based on urgency, complexity, and deadlines.
              </p>
            </div>

            <!-- Features List -->
            <div class="space-y-4">
              <div class="flex items-start space-x-3">
                <div class="number-badge bg-blue-100 text-blue-700">1</div>
                <div>
                  <h4 class="font-semibold text-gray-800">Auto-Prioritization</h4>
                  <p class="text-gray-600 text-sm">AI categorizes tasks by importance</p>
                </div>
              </div>

              <div class="flex items-start space-x-3">
                <div class="number-badge bg-blue-100 text-blue-700">2</div>
                <div>
                  <h4 class="font-semibold text-gray-800">Smart Scheduling</h4>
                  <p class="text-gray-600 text-sm">Optimal time allocation based on patterns</p>
                </div>
              </div>

              <div class="flex items-start space-x-3">
                <div class="number-badge bg-blue-100 text-blue-700">3</div>
                <div>
                  <h4 class="font-semibold text-gray-800">Progress Tracking</h4>
                  <p class="text-gray-600 text-sm">Real-time monitoring and insights</p>
                </div>
              </div>
            </div>

            <!-- CTA Section -->
            <div class="pt-6">
              <a href="register.php"
                class="block w-full py-4 px-6 rounded-xl bg-gradient-to-r from-blue-600 to-blue-700 
                                      text-white font-semibold text-center hover:from-blue-700 hover:to-blue-800 
                                      transition-all duration-300 shadow-lg hover:shadow-xl transform hover:-translate-y-1">
                <div class="flex items-center justify-center space-x-3">
                  <i class="fas fa-play-circle"></i>
                  <span>Start Free Trial</span>
                </div>
              </a>

              <p class="text-center text-gray-500 text-sm mt-4">
                No credit card required •
                <a href="login.php" class="text-blue-600 hover:text-blue-800 font-medium ml-1">
                  Already have an account?
                </a>
              </p>
            </div>
          </div>
        </div>

        <!-- How It Works - Minimal -->
        <div class="mt-20 md:mt-24">
          <div class="text-center mb-10">
            <h3 class="text-2xl font-bold text-gray-900 mb-2">
              How It Works
            </h3>
            <p class="text-gray-600 max-w-md mx-auto">
              Simple process, powerful results
            </p>
          </div>

          <!-- Timeline Steps -->
          <div class="flex flex-col md:flex-row justify-between items-center relative">
            <!-- Connecting Line -->
            <div
              class="hidden md:block absolute top-6 left-0 right-0 h-0.5 bg-gradient-to-r from-blue-200 via-blue-400 to-blue-200 z-0">
            </div>

            <!-- Step 1 -->
            <div class="relative z-10 text-center mb-8 md:mb-0">
              <div
                class="w-12 h-12 rounded-full bg-white shadow-lg flex items-center justify-center mx-auto mb-4 border border-blue-100">
                <i class="fas fa-edit text-blue-600"></i>
              </div>
              <h4 class="font-semibold text-gray-800">Add Tasks</h4>
              <p class="text-gray-600 text-sm mt-1">Input your tasks</p>
            </div>

            <!-- Step 2 -->
            <div class="relative z-10 text-center mb-8 md:mb-0">
              <div
                class="w-12 h-12 rounded-full bg-white shadow-lg flex items-center justify-center mx-auto mb-4 border border-blue-100">
                <i class="fas fa-cogs text-blue-600"></i>
              </div>
              <h4 class="font-semibold text-gray-800">AI Processes</h4>
              <p class="text-gray-600 text-sm mt-1">K-Means analyzes & groups</p>
            </div>

            <!-- Step 3 -->
            <div class="relative z-10 text-center">
              <div
                class="w-12 h-12 rounded-full bg-white shadow-lg flex items-center justify-center mx-auto mb-4 border border-blue-100">
                <i class="fas fa-check-circle text-blue-600"></i>
              </div>
              <h4 class="font-semibold text-gray-800">Execute</h4>
              <p class="text-gray-600 text-sm mt-1">Work on prioritized list</p>
            </div>
          </div>
        </div>
      </div>
    </main>

    <!-- Minimal Footer -->
    <footer class="mt-auto py-8 px-6 md:px-12 border-t border-gray-200">
      <div class="max-w-7xl mx-auto">
        <div class="flex flex-col md:flex-row justify-between items-center space-y-4 md:space-y-0">
          <!-- Copyright -->
          <div class="text-gray-500 text-sm">
            &copy; <?php echo date('Y'); ?> O'Clock. All rights reserved.
          </div>

          <!-- Links -->
          <div class="flex space-x-6">
            <a href="#" class="text-gray-500 hover:text-blue-600 text-sm">Privacy</a>
            <a href="#" class="text-gray-500 hover:text-blue-600 text-sm">Terms</a>
            <a href="#" class="text-gray-500 hover:text-blue-600 text-sm">Contact</a>
          </div>

          <!-- Social -->
          <div class="flex space-x-4">
            <a href="#" class="text-gray-400 hover:text-blue-600">
              <i class="fab fa-twitter"></i>
            </a>
            <a href="#" class="text-gray-400 hover:text-blue-600">
              <i class="fab fa-github"></i>
            </a>
            <a href="#" class="text-gray-400 hover:text-blue-600">
              <i class="fab fa-linkedin"></i>
            </a>
          </div>
        </div>
      </div>
    </footer>
  </div>

  <!-- Simple Animation Script -->
  <script>
    // Add hover effect to CTA button
    const ctaButton = document.querySelector('a[href="register.php"]');
    if (ctaButton) {
      ctaButton.addEventListener('mouseenter', () => {
        ctaButton.style.transform = 'translateY(-2px)';
        ctaButton.style.boxShadow = '0 20px 25px -5px rgba(59, 130, 246, 0.2)';
      });

      ctaButton.addEventListener('mouseleave', () => {
        ctaButton.style.transform = 'translateY(0)';
        ctaButton.style.boxShadow = '0 10px 15px -3px rgba(0, 0, 0, 0.1)';
      });
    }

    // Simple scroll animation for steps
    const observer = new IntersectionObserver((entries) => {
      entries.forEach(entry => {
        if (entry.isIntersecting) {
          entry.target.style.opacity = '1';
          entry.target.style.transform = 'translateY(0)';
        }
      });
    }, { threshold: 0.1 });

    // Observe steps
    document.querySelectorAll('.text-center').forEach((step, index) => {
      step.style.opacity = '0';
      step.style.transform = 'translateY(20px)';
      step.style.transition = `opacity 0.5s ease ${index * 0.2}s, transform 0.5s ease ${index * 0.2}s`;
      observer.observe(step);
    });
  </script>
</body>

</html>