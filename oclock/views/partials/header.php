<!-- views/partials/header.php -->
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $pageTitle ?? 'OClock' ?> - Manajemen Tugas Prioritas</title>
    
    <!-- TailwindCSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: {
                            50:  '#eff6ff',
                            100: '#dbeafe',
                            200: '#bfdbfe',
                            300: '#93c5fd',
                            400: '#60a5fa',
                            500: '#3b82f6',
                            600: '#2563eb',
                            700: '#1d4ed8',
                            800: '#1e40af',
                            900: '#1e3a8a',
                        }
                    },
                    fontFamily: {
                        sans: ['Inter', 'sans-serif']
                    }
                }
            }
        }
    </script>
    
    <style>
        /* Custom scrollbar */
        ::-webkit-scrollbar { width: 8px; }
        ::-webkit-scrollbar-track { background: #f1f5f9; }
        ::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 4px; }
        ::-webkit-scrollbar-thumb:hover { background: #94a3b8; }
    </style>
</head>
<body class="bg-gray-50 font-sans antialiased">

<!-- Navbar -->
<nav class="bg-white border-b border-gray-200 sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16">
            
            <!-- Logo & Brand -->
            <a href="<?= url('home') ?>" class="flex items-center gap-3 group">
                <!-- Clock Icon -->
                <div class="relative w-10 h-10 flex items-center justify-center bg-primary-500 rounded-xl shadow-lg shadow-primary-200 group-hover:shadow-xl group-hover:bg-primary-600 transition-all">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <circle cx="12" cy="12" r="10"/>
                        <path stroke-linecap="round" d="M12 6v6l4 2"/>
                    </svg>
                </div>
                <span class="text-xl font-bold text-gray-900 group-hover:text-primary-600 transition-colors">
                    OClock
                </span>
            </a>
            
            <!-- Navigation Buttons -->
            <div class="flex items-center gap-3">
                <?php
                $currentPage = currentPage();
                
                if (!isLoggedIn()):
                    // Guest menu
                    if ($currentPage === 'login'): ?>
                        <a href="<?= url('register') ?>" class="px-4 py-2 text-sm font-medium text-primary-600 hover:text-primary-700 transition-colors">
                            Daftar
                        </a>
                    <?php elseif ($currentPage === 'register'): ?>
                        <a href="<?= url('login') ?>" class="px-4 py-2 text-sm font-medium text-primary-600 hover:text-primary-700 transition-colors">
                            Masuk
                        </a>
                    <?php else: ?>
                        <a href="<?= url('login') ?>" class="px-4 py-2 text-sm font-medium text-primary-600 hover:text-primary-700 transition-colors">
                            Masuk
                        </a>
                        <a href="<?= url('register') ?>" class="px-4 py-2 bg-primary-500 hover:bg-primary-600 text-white text-sm font-medium rounded-lg transition-colors shadow-md shadow-primary-200">
                            Daftar Gratis
                        </a>
                    <?php endif;
                    
                else:
                    // Logged in menu
                    $user = getUser();
                    ?>
                    <a href="<?= url('dashboard') ?>" class="px-4 py-2 text-sm font-medium text-gray-600 hover:text-gray-900 transition-colors">
                        Dashboard
                    </a>
                    <a href="<?= url('tasks') ?>" class="px-4 py-2 text-sm font-medium text-gray-600 hover:text-gray-900 transition-colors">
                        Tugas
                    </a>
                    
                    <?php if (isAdmin()): ?>
                    <a href="<?= url('admin') ?>" class="px-4 py-2 text-sm font-medium text-red-600 hover:text-red-700 transition-colors">
                        Admin
                    </a>
                    <?php endif; ?>
                    
                    <!-- User Dropdown -->
                    <div class="relative group">
                        <button class="flex items-center gap-2 px-3 py-2 rounded-lg hover:bg-gray-100 transition-colors">
                            <div class="w-8 h-8 bg-primary-500 rounded-full flex items-center justify-center">
                                <span class="text-white text-sm font-semibold">
                                    <?= strtoupper(substr($user['username'], 0, 2)) ?>
                                </span>
                            </div>
                            <svg class="w-4 h-4 text-gray-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/>
                            </svg>
                        </button>
                        
                        <!-- Dropdown Menu -->
                        <div class="absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-xl border border-gray-200 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all">
                            <div class="p-3 border-b border-gray-100">
                                <p class="text-sm font-medium text-gray-900"><?= htmlspecialchars($user['full_name']) ?></p>
                                <p class="text-xs text-gray-500">@<?= htmlspecialchars($user['username']) ?></p>
                            </div>
                            <a href="<?= url('profile') ?>" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50">
                                Edit Profil
                            </a>
                            <a href="<?= url('logout') ?>" class="block px-4 py-2 text-sm text-red-600 hover:bg-red-50">
                                Logout
                            </a>
                        </div>
                    </div>
                    
                <?php endif; ?>
            </div>
            
        </div>
    </div>
</nav>
