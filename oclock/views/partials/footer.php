<!-- views/partials/footer.php -->

<footer class="bg-white border-t border-gray-200 mt-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="flex flex-col md:flex-row justify-between items-center gap-4">
            
            <!-- Brand -->
            <div class="flex items-center gap-2">
                <div class="w-8 h-8 bg-primary-500 rounded-lg flex items-center justify-center">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <circle cx="12" cy="12" r="10"/>
                        <path stroke-linecap="round" d="M12 6v6l4 2"/>
                    </svg>
                </div>
                <span class="text-sm font-semibold text-gray-600">OClock &copy; <?= date('Y') ?></span>
            </div>
            
            <!-- Links -->
            <div class="flex gap-6 text-sm text-gray-500">
                <a href="<?= url('home') ?>" class="hover:text-primary-600 transition-colors">Beranda</a>
                <span class="text-gray-300">|</span>
                <a href="#" class="hover:text-primary-600 transition-colors">Tentang</a>
                <span class="text-gray-300">|</span>
                <a href="#" class="hover:text-primary-600 transition-colors">Bantuan</a>
            </div>
            
            <!-- Made with -->
            <div class="text-sm text-gray-500">
                Dibuat dengan <span class="text-red-500">❤</span> menggunakan PHP & TailwindCSS
            </div>
            
        </div>
    </div>
</footer>

</body>
</html>
