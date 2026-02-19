<?php
// views/pages/register.php
requireGuest();

$pageTitle = 'Daftar';
require_once __DIR__ . '/../partials/header.php';

$flash = getFlash();
?>

<div class="min-h-[calc(100vh-4rem)] flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-md w-full">
        
        <!-- Header -->
        <div class="text-center mb-8">
            <div class="inline-flex items-center justify-center w-16 h-16 bg-primary-100 rounded-2xl mb-4">
                <svg class="w-8 h-8 text-primary-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/>
                </svg>
            </div>
            <h2 class="text-3xl font-bold text-gray-900">Buat Akun Baru</h2>
            <p class="mt-2 text-gray-600">Bergabung dengan OClock gratis</p>
        </div>
        
        <!-- Form Card -->
        <div class="bg-white rounded-2xl shadow-xl border border-gray-200 p-8">
            
            <!-- Flash Message -->
            <?php if ($flash): ?>
                <div class="mb-6 p-4 rounded-lg <?= $flash['type'] === 'success' ? 'bg-green-50 text-green-700 border border-green-200' : 'bg-red-50 text-red-700 border border-red-200' ?>">
                    <?= htmlspecialchars($flash['message']) ?>
                </div>
            <?php endif; ?>
            
            <form method="POST" action="<?= url('') ?>?action=register" class="space-y-5">
                
                <!-- Full Name -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Nama Lengkap
                    </label>
                    <input 
                        type="text" 
                        name="full_name" 
                        required
                        class="block w-full px-3 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent outline-none transition-all"
                        placeholder="Nama lengkap Anda"
                    >
                </div>
                
                <!-- Username -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Username
                    </label>
                    <input 
                        type="text" 
                        name="username" 
                        required
                        pattern="[a-zA-Z0-9_]{3,20}"
                        class="block w-full px-3 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent outline-none transition-all"
                        placeholder="username (3-20 karakter)"
                    >
                    <p class="mt-1 text-xs text-gray-500">Hanya huruf, angka, dan underscore</p>
                </div>
                
                <!-- Email -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Email
                    </label>
                    <input 
                        type="email" 
                        name="email" 
                        required
                        class="block w-full px-3 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent outline-none transition-all"
                        placeholder="email@contoh.com"
                    >
                </div>
                
                <!-- Password -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Password
                    </label>
                    <input 
                        type="password" 
                        name="password" 
                        required
                        minlength="6"
                        class="block w-full px-3 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent outline-none transition-all"
                        placeholder="Minimal 6 karakter"
                    >
                </div>
                
                <!-- Confirm Password -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Konfirmasi Password
                    </label>
                    <input 
                        type="password" 
                        name="confirm_password" 
                        required
                        minlength="6"
                        class="block w-full px-3 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent outline-none transition-all"
                        placeholder="Ulangi password"
                    >
                </div>
                
                <!-- Terms -->
                <div class="flex items-start">
                    <input 
                        type="checkbox" 
                        name="terms" 
                        required
                        class="mt-1 w-4 h-4 text-primary-600 border-gray-300 rounded focus:ring-primary-500"
                    >
                    <label class="ml-2 text-sm text-gray-600">
                        Saya setuju dengan <a href="#" class="text-primary-600 hover:text-primary-700 font-medium">Syarat & Ketentuan</a> serta <a href="#" class="text-primary-600 hover:text-primary-700 font-medium">Kebijakan Privasi</a>
                    </label>
                </div>
                
                <!-- Submit Button -->
                <button 
                    type="submit"
                    class="w-full py-2.5 bg-primary-600 hover:bg-primary-700 text-white font-semibold rounded-lg transition-colors shadow-lg shadow-primary-200"
                >
                    Daftar Sekarang
                </button>
                
            </form>
            
            <!-- Login Link -->
            <p class="mt-6 text-center text-sm text-gray-600">
                Sudah punya akun?
                <a href="<?= url('login') ?>" class="text-primary-600 hover:text-primary-700 font-semibold">
                    Masuk di sini
                </a>
            </p>
            
        </div>
        
    </div>
</div>

<?php require_once __DIR__ . '/../partials/footer.php'; ?>
